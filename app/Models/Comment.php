<?php

namespace App\Models;

use App\Traits\GorestModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;
    use GorestModel;

    protected $table = 'comments';

    protected $fillable = [
        'id',
        'post_id',
        'name',
        'email',
        'body',
    ];
}
