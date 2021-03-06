<?php

namespace App\Http\Controllers\Coc;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\CharactersService;
use App\Http\Requests\Coc\CharactersRequest;
use Log;

class CharactersController extends Controller
{
    public function get(Request $request, CharactersService $service)
    {
        return response()->json($service->getAll());
    }

    public function getOwned(Request $request, CharactersService $service)
    {
        return response()->json($service->getAllOwn());
    }

    public function getById(Request $request, CharactersService $service)
    {
        $id = $request->id;
        return response()->json($service->getById($id));
    }

    public function getPagenated(Request $request, CharactersService $service)
    {
        Log::debug($request->page);
        $page = (int)$request->page;
        return response()->json($service->getPagenated($page));
    }

    public function getByIdWithGuard(Request $request, CharactersService $service)
    {
        $id = (int)$request->id;
        $character = $service->getById($id);
        $isOwn = $service->isOwn($id);
        return response(
        )->json([
            'status' => $isOwn,
            'character' => $character,
        ]);
    }

    public function create(Request $request, CharactersService $service)
    {
        $character = $request->input('character');

        Log::debug('', [$character, $request->isJson(), $request->header('content-type')]);

        return response()->json($service->create($character));
    }

    public function update(Request $request, CharactersService $service)
    {
        $id = (int)$request->id;
        $character = $request->input('character');

        Log::debug('', [$character]);

        return response()->json($service->update($id, $character));
    }

    public function delete(Request $request, CharactersService $service)
    {
        $id = (int)$request->id;

        return response()->json([
            "deleted" => $service->delete($id)
        ]);
    }
}
