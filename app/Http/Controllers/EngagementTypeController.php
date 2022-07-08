<?php

namespace App\Http\Controllers;

use App\EngagementType;
use Illuminate\Http\Request;

class EngagementTypeController extends Controller
{
    public function index()
    {
        $engagementTypes = EngagementType::all();
        return view('time-report.engagement-types.index', ['engagementTypes' => $engagementTypes]);
    }

    public function create()
    {
        return view('time-report.engagement-types.create');
    }

    public function store(Request $request)
    {
        $engagementTypes = new EngagementType();
        $engagementTypes->name = $request->name;
        $engagementTypes->code = $request->code;
        $engagementTypes->save();

        $engagementTypes = EngagementType::all();
        return view('time-report.engagement-types.index', ['engagementTypes' => $engagementTypes]);
    }
}
