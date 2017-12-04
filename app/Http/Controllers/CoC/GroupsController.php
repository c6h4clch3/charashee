<?php

namespace App\Http\Controllers\Coc;

use App\Services\GroupsService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class GroupsController extends Controller
{
    public function get(Request $request, GroupsService $service)
    {
        return response()->json($service->getAllOwn());
    }

    public function find(Request $request, GroupsService $service)
    {
        $id = (int)$request->id;
        $group = $service->getById($id);

        return response()->json($group);
    }

    public function create(Request $request, GroupsService $service)
    {
        $name = $request->name;

        return response()->json($service->create($name));
    }

    public function update(Request $request, GroupsService $service)
    {
        $id = $request->id;
        $name = $request->name;

        return response()->json($service->update($id, $name));
    }

    public function addAll(Request $request, GroupsService $service)
    {
        $id = $request->id;
        $character_ids = $request->input('character_ids');

        return response()->json($service->registerAll($id, $character_ids));
    }

    public function add(Request $request, GroupsService $service)
    {
        $id = $request->id;
        $character_id = $request->input('character_id');

        return response()->json($service->register($id, $character_id));
    }

    public function remove(Request $request, GroupsService $service)
    {
        $id = $request->id;
        $character_id = $request->character_id;

        return response()->json($service->unregister($id, $character_id));
    }
}
