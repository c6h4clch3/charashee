<?php

namespace App\Http\Controllers\CoC;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\SkillsetsService;

class SkillsetsController extends Controller
{
    public function get(Request $request, SkillsetsService $service)
    {
        return response()->json($service->getAll());
    }

    public function find(Request $request, SkillsetsService $service)
    {
        $id = (int)$request->id;
        return response()->json($service->getById($id));
    }
}
