<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Asso extends Model
{
    use HasFactory;

    protected $table = 'assos';

    protected $fillable = [
        'name',
        'slug',
        'image',
        'logo',
        'link',
        'description',
        'indicator_label_1',
        'indicator_value_1',
        'indicator_unit_1',
        'indicator_label_2',
        'indicator_value_2',
        'indicator_unit_2',
        'indicator_label_3',
        'indicator_value_3',
        'indicator_unit_3',
    ];
}
