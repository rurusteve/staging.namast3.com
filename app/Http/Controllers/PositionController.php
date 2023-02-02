<?php

namespace App\Http\Controllers;

use App\Division;
use App\Group;
use App\Positions;
use Illuminate\Http\Request;

class PositionController extends Controller
{
    public function index()
    {
        $positions = Positions::all();
        return view('employees.positions.index', ['positions' => $positions]);
    }

    public function create()
    {
        $positions = Positions::all();
        return view('employees.positions.create', ['positions' => $positions]);
    }

    public function store(Request $request)
    {
        $group = new Positions();
        $group->name = $request->name;
        $group->save();
        return redirect()->back();
    }

    public function delete($id)
    {
        $group = Positions::find($id);
        $group->delete();
        return redirect()->back();
    }
}
