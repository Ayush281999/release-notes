<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReleaseNote extends Model
{
    use HasFactory;

    public $table = 'release_notes';

    protected $fillable = [
        'version',
        'details',
    ];
}
