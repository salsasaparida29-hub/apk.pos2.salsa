<?php

namespace App\Http\Controllers;

use App\Http\Requests\Produk\StoreRequest;
use App\Http\Requests\Produk\UpdateRequest;
use App\Http\Requests\SearchRequest;
use App\Models\Produk;
use App\Models\Jenis;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ProdukController extends Controller
{
    public function index(SearchRequest $request)
    {
        $this->authorize('viewAny', Produk::class);

        $keyword = $request->input('search');

        if ($keyword) {
            $products = Produk::with('jenis')
                ->when($keyword, function ($query) use ($keyword) {
                    $query->where('nama', 'like', '%' . $keyword . '%');
                })
                ->orderBy('nama')
                ->paginate(10)
                ->withQueryString();
        } else {
            $products = Produk::with('jenis')
                ->latest()
                ->paginate(10)
                ->withQueryString();
        }

        return view('produk.index', compact('products'));
    }

    public function create()
    {
        $this->authorize('create', Produk::class);

        $jenis = Jenis::all(); 

        return view('produk.create', compact('jenis'));
    }

    public function store(StoreRequest $request)
    {
        $this->authorize('create', Produk::class);

        $dataReq = $request->validated();

        $data['user_id'] = Auth::id();
        $data['jenis_id'] = $request->input('jenis_id'); 
        $data['nama'] = $dataReq['name'];
        $data['harga_beli'] = $dataReq['purchase_price'];
        $data['harga_jual'] = $dataReq['selling_price'];
        $data['stok'] = $dataReq['stock'] ?? 0;

        if ($request->hasFile('gambar')) {
            $data['foto'] = $request->file('gambar')->store('products', 'public');
        }

        Produk::create($data);

        return redirect()
            ->route('produk.index')
            ->with('success', 'Produk berhasil ditambahkan');
    }

    public function show(string $id)
    {
        //
    }

    public function edit(Produk $produk)
    {
        $this->authorize('update', $produk);

        $jenis = Jenis::all(); 

        return view('produk.edit', compact('produk', 'jenis'));
    }

    public function update(UpdateRequest $request, Produk $produk)
    {
        $this->authorize('update', $produk);

        $dataReq = $request->validated();

        $data = [
            'user_id'    => Auth::id(),
            'jenis_id'   => $request->input('jenis_id'),
            'nama'       => $dataReq['name'], 
            'harga_beli' => $dataReq['purchase_price'],
            'harga_jual' => $dataReq['selling_price'],
            'stok'       => $dataReq['stock'],
        ];

        if ($request->hasFile('gambar')) {
            if ($produk->foto) {
                Storage::disk('public')->delete($produk->foto);
            }
            $data['foto'] = $request->file('gambar')->store('products', 'public');
        }

        $produk->update($data);

        return redirect()
            ->route('produk.index')
            ->with('success', 'Produk berhasil diperbarui');
    }

    public function destroy(Produk $produk)
    {
        $this->authorize('delete', $produk);

        $produk->itemPenjualan()->delete();
        
        if ($produk->foto) {
            Storage::disk('public')->delete($produk->foto);
        }

        $produk->delete();

        return redirect()
            ->route('produk.index')
            ->with('success', 'Produk berhasil dihapus');
    }
}