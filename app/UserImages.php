<?php

namespace App;

use App\Services\YandexDiskProvider;
use App\Traits\AsJsonTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

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


    public function getPhotos()
    {
        $links = [];
        foreach ($this->photos as $photo) {
            if ($photo['type'] == 'yc') {
                $photoLink = Storage::disk('yandex')->url($photo['path']);
                $links[] = [
                    'name' => $photo['filename'],
                    'path' => $photoLink,
                ];
            }
        }

        return $links;
    }
}
