<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FaviconAndTitle extends Model
{
    use HasFactory;

    protected $table = 'favicon_and_title';

    protected $fillable = [
        'favicon',
        'title'
    ];
}
