<?php

namespace App\Http\Controllers\Coc;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\SkillsService;
use Log;

class SkillsController extends Controller
{
    public function getAsOptions(Request $request, SkillsService $service)
    {
        return response()->json($service->getStandard());
    }
}
