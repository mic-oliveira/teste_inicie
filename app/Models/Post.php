<?php

namespace App\Models;

use App\Traits\GorestModel;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Http;

class Post extends Model
{
    use HasFactory;
    use GorestModel;

    protected $table = 'posts';

    protected $fillable = [
        'id',
        'user_id',
        'title',
        'body',
    ];
}
