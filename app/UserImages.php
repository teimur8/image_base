<?php

namespace App;

use App\Traits\AsJsonTrait;
use Illuminate\Database\Eloquent\Model;

class UserImages extends Model
{
    use AsJsonTrait;

    protected $table = 'user_images';
    protected $fillable = [
        'npaId',
        'fio1',
        'fio2',
        'qualification',
        'phone',
        'email',
        'instagram',
        'photos',
    ];

    protected $casts = [
        'photos' => 'json',
    ];
}
