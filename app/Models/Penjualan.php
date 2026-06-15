<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\User;

class Penjualan extends Model
{
    use HasFactory;

    protected $table = 'penjualan';
    
    protected $fillable = [
        'user_id',
        'total_pembayaran',
        'metode_pembayaran',
        'status',
    ];

    public function itemPenjualan()
    {
        return $this->hasMany(ItemPenjualan::class, 'penjualan_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
