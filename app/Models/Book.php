<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Book extends Model
{
    use HasFactory;

    protected $fillable = ['isbn','judul','halaman','kategori','penerbit','image'];


    protected $append = [
        'image',
    ];
    public function getImageUrlAttribute()
    {
        //Cek apakah image merupakan URL, jika ya maka gunakan URL tersebut
        if (filter_var($this->image, FILTER_VALIDATE_URL)) {
            return $this->image;
        }
        //Jika bukan URL, maka gunakan Storage::url untuk mengambil URL dari path gambar
        return $this->image ? Storage::url($this->image) : null;
    }
}
