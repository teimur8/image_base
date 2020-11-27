<?php

namespace App\Services;

use App\UserImages;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
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
        # готовим данные
        $item = new UserImages($request->only([
            "npaId",
            "fio1",
            "fio2",
            "qualification",
            "phone",
            "email",
            "instagram",
        ]));

        $item->npaId = preg_replace('#[^0-9]#', '', $item->npaId);
        $item->phone = preg_replace('#[^0-9\+]#', '', $item->phone);
        $item->save();

        $path = "/images/" . $item->npaId . "_" . date('Ymd');

        # сохраянем изображения
        $photos = $this->imageStore($request, $path);
        $item->photos = $photos;
        $item->save();

        # текстовая информация
        $this->saveTextInfoToStorage($item, $path);

        return $item;
    }

    /**
     * Сохраняем на яндекс диск
     * @param $request
     * @param $path
     * @return array
     */
    public function imageStore($request, $path)
    {
        $photos = [];
        /** @var UploadedFile $file */
        foreach ($request->file('files', []) as $file) {
            $fileName = Str::slug($file->getClientOriginalName()) . '.' . $file->clientExtension();
            Storage::disk('yandex')->putFileAs($path, $file, $fileName);
            Storage::disk('yandex')->setVisibility($path . '/' . $fileName, 'public');
            $photos[] = [
                'path'     => $path . '/' . $fileName,
                'filename' => $fileName,
                'type'     => 'yc',
            ];
        }

        return $photos;
    }

    /**
     * @param UserImages $item
     * @param string $path
     * @return void
     */
    private function saveTextInfoToStorage(UserImages $item, string $path)
    {
        $text = '';
        $text .= "NPA: " . $item->npaId . PHP_EOL;
        $text .= "Fio contract holder: " . $item->fio1 . PHP_EOL;
        $text .= "Fio designated person: " . $item->fio2 . PHP_EOL;
        $text .= "Qualification: " . $item->qualification . PHP_EOL;
        $text .= "Phone: " . $item->phone . PHP_EOL;
        $text .= "Email: " . $item->email . PHP_EOL;
        $text .= "Instagram : " . $item->instagram . PHP_EOL;
        foreach ($item->getPhotos() as $photo) {
            $text .= "Photo : " . $photo['path'] . PHP_EOL;
        }
        $text .= PHP_EOL;
        $text .= PHP_EOL;

        Storage::disk('yandex')->put($path.'/info.txt', $text);
    }

}
