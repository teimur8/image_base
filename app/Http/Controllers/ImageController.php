<?php

namespace App\Http\Controllers;

use App\Services\UserImageService;
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
        return $request->has('success')
            ? view('image-form-success')
            : view('image-form');
    }

    /**
     * Форма
     * @param Request $request
     * @return array
     */
    public function imageFormLoad(Request $request)
    {
        $request->validate([
            "npaId"         => 'required',
            "fio1"          => 'required',
            "fio2"          => 'required',
            "qualification" => 'required',
            "phone"         => 'required',
            "email"         => 'required',
            "instagram"     => 'required',
            "files"         => 'required',
            "files.*"       => 'required|image',
        ]);

        return [
            'success'  => true,
            'redirect' => route('imageForm', ['success' => true]),
        ];
    }
}
