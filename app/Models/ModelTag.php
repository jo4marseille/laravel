<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ModelTag extends Model
{
    use HasFactory;

    protected $table = 'model_tags';
    public $timestamps = false;

    protected $fillable = [
        'model_id',
        'model_name',
        'tag_id',
    ];
}
