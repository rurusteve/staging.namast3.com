<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Input;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;
use Illuminate\Database;



class UserController extends Controller{

    public function create(){
        return view('inputuser');

        $users = DB::table('users')->get();

        return view('user.index', ['users' => $users]);
    }

    public function inputuser(Request $request)
    {
        echo $request->nip;
        $users = new User();

        $this->validate($request,[
            'nip' => 'required',
            'name' => 'required|max:255|min:5',
            'email' => 'required|email',
            'password' => 'required|string|min:6|confirmed',
            'admin' => 'required',
            'logintype' => 'required',
        ]);

        $users->nip = $request->nip;
        $users->name = $request->name;
        $users->email = $request->email;
        $users->password = Hash::make($request->password);
        $users->admin = $request->admin;
        $users->logintype = $request->logintype;

        $users->save();
        return redirect ('/');
    }
    public function index(){

        $users = DB::table('users')->paginate(10);

        return view('userlist', ['users' => $users]);
    }
    public function edit($id) {
        $users = User::find($id);
        return view('edit', compact('users'));
    }
    public function account() {
        $users = Auth::User();

        return view('account', compact('users'));
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {
        // Simpan Edit Siswa
        $users = User::find($id);
        $users->name = $request->name;
        $users->email = $request->email;
        $users->positionid = $request->positionid;
        $users->joindate = $request->joindate;
        $users->institution = $request->institution;
        $users->city = $request->city;
        $users->status = $request->status;
        $users->salary = $request->salary;
        $users->positionallowance = $request->positionallowance;
        $users->healthallowance = $request->healthallowance;
        $users->additionalallowance = $request->additionalallowance;
        $users->transportfee = $request->transportfee;
        $users->overtimefee = $request->overtimefee;
        $users->grade = $request->grade;
        $users->bankaccount = $request->bankaccount;
        $users->npwp = $request->npwp;
        $users->ptkp = $request->ptkp;

        $users->update();
        return redirect('/userlist')->with('alert-success', 'Data berhasil diubah!');
    }
    public function destroy($id) {
        $users = User::find($id);
        $users -> delete();
        echo '<a href = "/userlist">Click Here</a> to go back.';
    }

    public function editpassword(){
        return view('auth.resetpassword');
    }

    public function editemployeepassword(){
        return view('auth.resetemployeepassword');
    }

    public function updatepassword(Request $request){
        $user = User::findOrFail($request->id);

        /*
        * Validate all input fields
        */
        $this->validate($request, [
//            'newpassword' => 'confirmed|max:8|different:password',
            'newpassword' => 'confirmed|max:8|different:password',
            'newpassword_confirmation' => 'required_with:newpassword|same:newpassword|min:8'

        ]);

        if (Hash::check($request->password, $user->password)) {
            $user->fill([
                'password' => Hash::make($request->newpassword)
            ])->save();

//            $request->session()->flash('success', 'Password changed');
            return redirect()->route('house')->with('success', 'Password changed');

        } else {
//            $request->session()->flash('error', 'Password does not match');
            return redirect()->route('house')->with('error', 'Password does not match');
        }
    }
    public function updateemployeepassword(Request $request, $id){

        $this->validate($request, [
            'newpassword' => 'confirmed|max:8',
            'newpassword_confirmation' => 'required_with:newpassword|same:newpassword|min:8'
        ]);

        $user = User::where('nip', $request->nip)->update(['password' => Hash::make($request->newpassword)]);
        return redirect('/payroll/data/'.$id.'/edit')->with('passwordsuccess', 'Password changed');
    }
}
