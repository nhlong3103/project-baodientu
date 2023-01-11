<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class baiviet extends Model
{
    use HasFactory;
    protected $fillable = ['tieu_de', 'gioi_thieu', 'anh_gioi_thieu', 'noi_dung', 'trang_thai', 'danhmuc_id'];
    protected $primarykey = 'id';
    protected $table = 'baiviet';

    public function danhmuc()
    {
        return $this->belongsTo(Danhmuc::class, 'danhmuc_id', 'id');
    }
}