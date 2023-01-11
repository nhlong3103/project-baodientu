<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Danhmuc extends Model
{
    use HasFactory;
    protected $fillable = ['ten_danh_muc', 'trang_thai'];
    protected $primarykey = 'id';
    protected $table = 'danhmuc';

    public function baiviet()
    {
        return $this->hasMany(baiviet::class);
    }
}