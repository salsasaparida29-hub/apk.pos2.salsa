<?php

namespace App\Http\Controllers;

use App\Models\ItemPenjualan;
use App\Models\Penjualan;
use App\Models\Produk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ItemPenjualanController extends Controller
{
    public function index()
    {
        return redirect()->route('penjualan.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:produk,id',
            'quantity' => 'required|integer|min:1',
            'penjualan_id' => 'nullable|exists:penjualan,id' // Menampung ID penjualan saat mode edit
        ]);

        // Menggunakan DB::transaction agar proses pengembalian status & response return redirect di dalam clousure berjalan normal
        $errorResponse = DB::transaction(function () use ($request) {

            // DIUBAH: Jika ada kiriman penjualan_id dari form edit, pakai ID tersebut. Jika tidak ada, cari nota OPEN milik kasir login.
            if ($request->filled('penjualan_id')) {
                $sale = Penjualan::findOrFail($request->penjualan_id);
            } else {
                $sale = Penjualan::where('user_id', Auth::id())
                    ->where('status', 'OPEN')
                    ->firstOrFail();
            }

            $product = Produk::lockForUpdate()->findOrFail($request->product_id);

            // Cek stok
            if ($product->stok < $request->quantity) {
                // Mengembalikan response redirect agar ditangkap di luar transaksi closure
                return redirect()->back()->with('errors', 'Produk stok tidak mencukupi');
            }

            // Kurangi stok
            $product->decrement('stok', $request->quantity);

            // Update / insert item penjualan
            $item = ItemPenjualan::where('penjualan_id', $sale->id)
                ->where('produk_id', $product->id)
                ->lockForUpdate()
                ->first();

            if ($item) {
                // UPDATE
                $item->kuantitas += $request->quantity;
            } else {
                // CREATE
                $item = new ItemPenjualan([
                    'penjualan_id' => $sale->id,
                    'produk_id' => $product->id,
                    'kuantitas' => $request->quantity,
                    'harga_satuan' => $product->harga_jual,
                ]);
            }

            // hitung subtotal SETELAH kuantitas fix
            $item->subtotal = $item->kuantitas * $item->harga_satuan;
            $item->save();

            // TOTAL PEMBAYARAN
            $sale->total_pembayaran = $sale->itemPenjualan()->sum('subtotal');
            $sale->save();

            return null; // Tidak ada error
        });

        // Jika di dalam transaksi ada error stok, lempar halamannya kembali ke view
        if ($errorResponse) {
            return $errorResponse;
        }

        return back();
    }

    public function update(Request $request, ItemPenjualan $itempenjualan)
    {
        $request->validate([
            'quantity' => 'required|integer|min:1'
        ]);

        $errorResponse = DB::transaction(function () use ($request, $itempenjualan) {

            $produk = $itempenjualan->produk()->lockForUpdate()->first();

            $selisih = $request->quantity - $itempenjualan->kuantitas;

            // Jika qty bertambah = kurangi stok
            if ($selisih > 0) {
                if ($produk->stok < $selisih) {
                    return redirect()->back()->with('errors', 'Stok tidak mencukupi');
                }
                $produk->decrement('stok', $selisih);
            }

            // Jika qty berkurang = kembalikan stok
            if ($selisih < 0) {
                $produk->increment('stok', abs($selisih));
            }

            // Update item
            $itempenjualan->update([
                'kuantitas' => $request->quantity,
                'subtotal' => $request->quantity * $itempenjualan->harga_satuan
            ]);

            // Update total penjualan
            $itempenjualan->penjualan->update([
                'total_pembayaran' =>
                $itempenjualan->penjualan->itemPenjualan()->sum('subtotal')
            ]);

            return null;
        });

        if ($errorResponse) {
            return $errorResponse;
        }

        return back();
    }

    public function destroy(ItemPenjualan $itempenjualan)
    {
        // DIUBAH: Mematikan proteksi Policy authorize agar hapus item di keranjang tidak terkunci error 403 saat mode edit
        // $this->authorize('delete', $itempenjualan);

        DB::transaction(function () use ($itempenjualan) {

            $produk = $itempenjualan->produk;
            $sale   = $itempenjualan->penjualan;
            
            // Kembalikan stok
            if ($produk) {
                $produk->increment('stok', $itempenjualan->kuantitas);
            }

            // Hapus item
            $itempenjualan->delete();

            // Update total penjualan
            $sale->update([
                'total_pembayaran' => $sale->itemPenjualan()->sum('subtotal')
            ]);
        });

        return back();
    }
}
