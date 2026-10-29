<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SchoolSetting extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',          // Ongeza hii hapa ili kuruhusu mass assignment kwa kitambulisho
        'location',
        'phone',
        'email',
    ];
}