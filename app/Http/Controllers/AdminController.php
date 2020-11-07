<?php

namespace App\Http\Controllers;

use App\Services\UserImageService;
use App\UserImages;
use Illuminate\Http\Request;

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


    public function images(Request $request)
    {
        $q = UserImages::query()->orderBy('created_at', 'desc');

        if ($search = $request->get('q')) {
            $q->where(function ($query) use ($search) {
                $query
                    ->orWhere('npaId', 'like', "%$search%")
                    ->orWhere('fio1', 'like', "%$search%")
                    ->orWhere('fio2', 'like', "%$search%")
                    ->orWhere('qualification', 'like', "%$search%")
                    ->orWhere('phone', 'like', "%$search%")
                    ->orWhere('email', 'like', "%$search%")
                    ->orWhere('instagram', 'like', "%$search%");
            });
        }

        $items = $q->paginate(3);

        return view('image-admin', compact('items'));
    }


}
