<?php

namespace App\Http\Controllers;

use App\ClientDelegations;
use App\Group;
use App\MasterClient;
use Illuminate\Http\Request;

class DelegationController extends Controller
{
    public function index()
    {
        $delegations = ClientDelegations::select('client_delegations.id as id', 'masterclients.clientname as clientName',
                                            'masterclients.engagementtype as engagementType',
                                            'masterclients.engagementperiod as engagementPeriod',
                                            'groups.name as groupName',
                                            'groups.code as groupCode',
                                            'masteremployee.nama as pic',
                                            'masterclients.institusi as institusi',
                                            'masterclients.branch as branch')
                                        ->join('masterclients', 'client_delegations.client_id', '=', 'masterclients.id')
                                        ->join('groups', 'client_delegations.group_id', '=', 'groups.id')
                                        ->join('masteremployee', 'client_delegations.group_id', '=', 'masteremployee.divisi')
                                        ->where('masteremployee.inchargestatus', 1)
                                        ->get();
        
        return view('employees.delegations.index', ['delegations' => $delegations]);
    }

    public function create()
    {
        $clients = MasterClient::all();
        $groups = Group::all();
        return view('employees.delegations.create', ['clients' => $clients], ['groups' => $groups]);
    }

    public function store(Request $request)
    {
        
        
        $delegation = new ClientDelegations();
        $delegation->client_id = $request->client_id;
        $delegation->group_id = $request->group_id;
        
        $delegations = ClientDelegations::select('client_delegations.id as id', 'masterclients.clientname as clientName',
                                            'masterclients.engagementtype as engagementType',
                                            'masterclients.engagementperiod as engagementPeriod',
                                            'groups.name as groupName',
                                            'groups.code as groupCode')
                                        ->join('masterclients', 'client_delegations.client_id', '=', 'masterclients.id')
                                        ->join('groups', 'client_delegations.group_id', '=', 'groups.id')
                                        ->get();
        $delegation->save();
        return view('employees.delegations.index', ['delegations' => $delegations]);    }

    public function delete($id)
    {
        $delegation = ClientDelegations::find($id);
        $delegation->delete();
        return redirect()->back();
    }
}
