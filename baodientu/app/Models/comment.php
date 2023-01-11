<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class comment extends Model
{
    use HasFactory;
    protected $fillable = ['user_id', 'baiviet_id', 'reply_id', 'content'];
    protected $primarykey = 'id';
    protected $table = 'comment';

    public function user()
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }

    public function replies()
    {
        return $this->hasMany(Comment::class, 'reply_id', 'id');
    }
}