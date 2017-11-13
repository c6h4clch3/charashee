<?php

namespace App\Http\Controllers\Coc;

use App\Services\GroupsService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class GroupsController extends Controller
{
    public function get(Request $request, GroupsService $service)
    {
        return $service->getAll();
    }

    public function find(Request $request, GroupsService $service)
    {
        $group = $service->getAll();
    }
}
