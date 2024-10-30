<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Follow extends Model
{
    use HasFactory;

    protected $primaryKey = ['follow_id', 'follower_id'];
    public $incrementing = false;
    public $timestamps = false;

    protected $fillable = [
        'follow_id',
        'follower_id'
    ];
}
