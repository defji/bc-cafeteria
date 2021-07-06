<?php

namespace App\Http\Controllers;

use App\Http\Requests\CafeteriaRequest;
use App\Models\Cafeteria;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class CafeteriaController extends Controller
{


    /**
     * Returns latest saved cafeteria data
     * @return Application|ResponseFactory|Response
     */
    public function index()
    {
        return response(Cafeteria::latest()->first() ?? []);
    }

    public function store(CafeteriaRequest $request)
    {
        return response(Cafeteria::create([
            "yearly_limit" => $request->fullLimit,
            "slot_limit"   => $request->slotLimit,
            "data"         => $request->cafData,
        ]));
    }
}
