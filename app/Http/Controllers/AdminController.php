<?php

namespace App\Http\Controllers;

use App\Services\UserImageService;
use App\UserImages;

class AdminController extends Controller
{

    /**
     * @var UserImageService
     */
    private $service;

    public function __construct(UserImageService $service)
    {
        $this->service = $service;
    }


    public function images()
    {
        $items = UserImages::paginate();

        return view('image-admin', compact('items'));
    }


}
