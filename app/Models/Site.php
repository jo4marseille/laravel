<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Site extends Model
{
    use HasFactory;

    protected $table = 'sites';

    protected $fillable = [
        'name',
        'image',
        'link',
        'description',
        'video',
        'status',
        'git_depo',
        'desc_techno',
        'app_link_android',
        'app_link_ios',
        'asso_id',
    ];
}
