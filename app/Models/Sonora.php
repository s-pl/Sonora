<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sonora extends Model
{
    protected $table = 'sonora';

    protected $fillable = [
        'name',
        'artist',
        'album',
        'genre',
        'year',
        'cover_url',
        'audio_file',
    ];
}
