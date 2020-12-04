<?php

namespace App\Http\Controllers;

use App\Rules\Npa;
use App\Rules\Phone;
use App\Services\UserImageService;
use App\Services\YandexDiskProvider;
use App\UserImages;
use Illuminate\Http\Request;

class ImageController extends Controller
{

    /**
     * @var UserImageService
     */
    private $service;

    public function __construct(UserImageService $service)
    {
        $this->service = $service;
    }

    /**
     * Форма
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function imageForm(Request $request)
    {
        if ($request->has('success')) {
            $item = UserImages::find($request->get('item'));
            if($item && !in_array($item->id, session()->get('image_id'))){
                $item = null;
            }
            return view('image-form-success', compact('item'));
        }
        return view('image-form');
    }

    /**
     * Форма
     * @param Request $request
     * @return array
     */
    public function imageFormLoad(Request $request)
    {
        $request->validate([
            "npaId"         => ['required',new Npa],
            "fio1"          => 'required',
            "fio2"          => 'required',
            "qualification" => 'required',
            "phone"         => ['required', new Phone],
            "email"         => ['required', 'email:rfc,dns'],
            "instagram"     => 'required',
            "files"         => 'required',
            "files.*"       => 'required|image|dimensions:min_width=1000,min_height=1000|min:512',
        ]);

        $item = $this->service->storeRequest($request);

        session()->push('image_id', $item->id);

        return [
            'success'  => true,
            'redirect' => route('imageForm', ['success' => true, 'item' => $item->id]),
        ];
    }
}
