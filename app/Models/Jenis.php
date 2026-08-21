<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jenis extends Model
{
    use HasFactory;

    // Menentukan nama tabel di database
    protected $table = 'jenis'; 

    // Menentukan kolom apa saja yang boleh diisi
    protected $fillable = ['nama_jenis']; 
}
