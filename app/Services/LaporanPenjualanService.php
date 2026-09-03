<?php

namespace App\Services;

use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class LaporanPenjualanService
{
    public function ringkasanHariIni(): array
    {
        // Mengambil tanggal hari ini berdasarkan timezone aplikasi
        $today = Carbon::today()->format('Y-m-d');

        // Menggunakan LOWER agar otomatis membaca status 'COMPLETED' maupun 'completed'
        $data = DB::table('penjualan')
            ->whereDate('created_at', $today)
            ->whereRaw('LOWER(status) = ?', ['completed'])
            ->selectRaw("
                COUNT(*) as total_transaksi,
                SUM(total_pembayaran) as total_penjualan,
                SUM(CASE WHEN LOWER(metode_pembayaran) = 'cash' THEN total_pembayaran ELSE 0 END) as total_cash,
                SUM(CASE WHEN LOWER(metode_pembayaran) != 'cash' THEN total_pembayaran ELSE 0 END) as total_non_tunai
            ")
            ->first();

        return [
            'total_transaksi' => (int) ($data->total_transaksi ?? 0),
            'total_penjualan' => (float) ($data->total_penjualan ?? 0),
            'total_cash' => (float) ($data->total_cash ?? 0),
            'total_non_tunai' => (float) ($data->total_non_tunai ?? 0),
        ];
    }

    public function produkTerlarisHariIni(int $limit = 5)
    {
        $today = Carbon::today()->format('Y-m-d');

        return DB::table('item_penjualan')
            ->join('penjualan', 'penjualan.id', '=', 'item_penjualan.penjualan_id')
            ->join('produk', 'produk.id', '=', 'item_penjualan.produk_id')
            ->whereDate('penjualan.created_at', $today)
            ->whereRaw('LOWER(penjualan.status) = ?', ['completed'])
            ->groupBy('produk.id', 'produk.nama', 'produk.stok')
            ->select(
                'produk.nama',
                'produk.stok',
                DB::raw('SUM(item_penjualan.kuantitas) as total_terjual')
            )
            ->orderByDesc('total_terjual')
            ->limit($limit)
            ->get();
    }
}
