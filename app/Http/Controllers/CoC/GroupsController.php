<?php

namespace App\Http\Controllers\Coc;

use App\Services\GroupsService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class GroupsController extends Controller
{
    public function get(Request $request, GroupsService $service)
    {
        return response()->json($service->getAll());
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
}
