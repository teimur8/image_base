<?php

namespace App\Services;

use App\UserImages;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

/**
 * Class UserImageService
 *
 * @package App\Services
 */
class UserImageService
{

    public function storeRequest(Request $request)
    {
        $item = new UserImages($request->only(["npaId",
            "fio1",
            "fio2",
            "qualification",
            "phone",
            "email",
            "instagram",
        ]));

        $photos = [];
        foreach ($request->file('files', []) as $file) {
            $path = '/images/' . date('Ymd') . '/' . $item->npaId;
            $fileName = Str::slug($file->getClientOriginalName()) . '.' . $file->clientExtension();
            $photos[] = "$path/$fileName";
            $file->storeAs($path, $fileName, ['disk' => 'public']);
        }

        $item->photos = $photos;
        $item->save();

        return $item;
    }
}
