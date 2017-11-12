<?php

namespace App\Http\Controllers\CoC;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\CharactersService;

class CharactersController extends Controller
{
    public function get(Request $request, CharactersService $service)
    {
        $page = $request->page;
        return response()->json($service->getPagenated($page));
    }

    public function getOwned(Request $request, CharactersService $service)
    {
        return response()->json($service->getAllOwn());
    }
}
