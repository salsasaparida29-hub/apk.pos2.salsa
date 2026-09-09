<?php

namespace App\Http\Controllers;

use App\Http\Requests\SearchRequest;
use App\Models\Penjualan;
use App\Models\Produk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PenjualanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(SearchRequest $request)
    {
        $user = Auth::user();
        $keyword = $request->input('search');

        $sales = Penjualan::query()
            ->when($user->role->name === 'kasir', function ($query) use ($user) {
                $query->where('user_id', $user->id);
            })
            ->when($keyword, function ($query) use ($keyword) {
                $query->whereHas('user', function ($q) use ($keyword) {
                    $q->where('name', 'like', '%' . $keyword . '%');
                });
            })
            ->latest()
            ->paginate(10)
            ->withQueryString();

        return view('penjualan.index', compact('sales'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(SearchRequest $request)
    {
        $sale = Penjualan::firstOrCreate(
            [
                'user_id' => Auth::id(),
                'status' => 'OPEN'
            ],
            [
                'total_pembayaran' => 0,
                'metode_pembayaran' => 'CASH'
            ]
        );

        $keyword = $request->input('search');

        if($keyword) {
            $products = Produk::when($keyword, function ($query) use ($keyword) {
                $query->where('nama', 'like', '%' . $keyword . '%');
            })
            ->orderBy('nama')
            ->get();
        } else {
            $products = Produk::orderBy('nama')->get();
        }

        $mode = 'create';

        return view('penjualan.pos', compact('sale', 'products', 'mode'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Penjualan $penjualan)
    {
        $penjualan->load('user', 'itemPenjualan.produk');

        return view('penjualan.show', compact('penjualan'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Penjualan $penjualan)
    {
        $sale = $penjualan;
        $sale->load('itemPenjualan');
        $products = Produk::orderBy('nama')->get();
        $mode = 'edit';

        return view('penjualan.pos', compact('sale', 'products', 'mode'));
    }

    /**
     * Update the specified resource in storage.
     */
   public function update(Request $request, Penjualan $penjualan)
{
    $request->validate([
        'payment_method' => 'required|in:CASH,QRIS',
        'uang_masuk'     => 'required_if:payment_method,CASH|nullable|numeric|min:0',
    ]);

    if ($penjualan->itemPenjualan()->count() === 0) {
        return back()->with('errors', 'Keranjang masih kosong');
    }

    $total     = $penjualan->itemPenjualan()->sum('subtotal');
    $uangMasuk = 0;
    $kembalian = 0;

    if ($request->payment_method === 'CASH') {
        $uangMasuk = (int) $request->uang_masuk;

        if ($uangMasuk < $total) {
            return back()->with('errors', 'Uang yang diberikan kurang dari total belanja');
        }

        $kembalian = $uangMasuk - $total;
    }

    DB::transaction(function () use ($penjualan, $request, $total, $uangMasuk, $kembalian) {
        $penjualan->update([
            'metode_pembayaran' => $request->payment_method,
            'total_pembayaran'  => $total,
            'uang_masuk'        => $uangMasuk,
            'kembalian'         => $kembalian,
            'status'            => 'COMPLETED',
            'created_at'        => now(),
        ]);
    });

    return redirect()
        ->route('penjualan.index')
        ->with('success', 'Transaksi berhasil diselesaikan');
}

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Penjualan $penjualan)
    {
        if ($penjualan->user_id !== Auth::id()) {
            return redirect()->route('penjualan.create');
        }

        DB::transaction(function () use ($penjualan) {
            foreach ($penjualan->itemPenjualan as $item) {
                // kembalikan stok produk jika dibatalkan
                $item->produk->increment('stok', $item->kuantitas);
            }

            $penjualan->itemPenjualan()->delete();
            $penjualan->delete();
        });

        return redirect()
            ->route('penjualan.index')
            ->with('success', 'Transaksi berhasil dibatalkan');
    }
}
