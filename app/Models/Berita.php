<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Berita extends Model
{
    use HasFactory;

    protected $fillable = [
        'slug', 'judul', 'konten', 'created_by', 'gambar'
    ];

    public static function slugify($judul) {
        return Str::slug($judul, '-', 'id');
    }

    public function user() {
        return $this->hasOne(User::class, 'id', 'created_by');
    }
}
