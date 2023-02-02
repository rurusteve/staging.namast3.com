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
        $position = new Positions();
        $position->name = $request->name;
        $position->save();
        return redirect()->back();
    }

    public function delete($id)
    {
        $position = Positions::find($id);
        $position->delete();
        return redirect()->back();
    }
}
