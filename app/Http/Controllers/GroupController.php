<?php

namespace App\Http\Controllers;

use App\Division;
use App\Group;
use Illuminate\Http\Request;

class GroupController extends Controller
{
    public function index()
    {
        $groups = Group::leftJoin('divisions', 'groups.division_id', '=', 'divisions.id')
        ->select('groups.id as id', 'divisions.name as division', 'groups.*')->get();
        return view('employees.groups.index', ['groups' => $groups]);
    }

    public function create()
    {
        $groups = Group::all();
        $divisions = Division::all();
        return view('employees.groups.create', ['groups' => $groups], ['divisions' => $divisions]);
    }

    public function store(Request $request)
    {
        $group = new Group();
        $group->division_id = $request->division_id;
        $group->name = $request->name;
        $group->code = $request->code;
        $group->save();
        return redirect()->back();
    }

    public function delete($id)
    {
        $group = Group::find($id);
        $group->delete();
        return redirect()->back();
    }
}
