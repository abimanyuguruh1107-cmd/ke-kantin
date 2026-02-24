<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class nis extends Model
{
    use HasFactory;

    protected $table = 'nis';

     protected $fillable = [
        'nis',
        'nama'
    ];
}
