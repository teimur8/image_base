<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ImageController extends Controller
{
    /**
     * Форма
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function imageForm()
    {
        return view('image-form');
    }

    /**
     * Форма
     * @param Request $request
     * @return void
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
            "photos.*"      => 'required|image',
        ]);


    }
}
