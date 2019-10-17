<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Auth;
use DB;
use App\User;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
	public function __construct() {

        $this->middleware('auth');

    }

    public function index() {

        $id_user = Auth::User()->id;

    	$datas = DB::table('users')
    				->select('id', 'name', 'role', 'email')
                    ->where('id', '!=', $id_user)
    				->get();

    	return view('admin.index', compact('datas'));

    }

    public function store(Request $request) {

    	$add = new User();
        $add->name = $request['name'];
        $add->password = Hash::make($request['password']);
        $add->email = $request['email'];
        $add->role = $request['role'];
        $add->save();

    	return redirect('admin');

    }

    public function update(Request $request) {

    	$id_user = $request['id_edit'];

    	$update = User::where('id', $id_user)->first();
        $update->name =  $request['name_edit'];
        $update->email = $request['email_edit'];
        if($request['role_edit'] != NULL) {
        	$update->role = $request['role_edit'];
        }
        $update->update();

    	return redirect('admin');

    }

    public function delete_user($id) {

    	$delete = User::find($id);
    	$delete->delete();

    	return redirect('admin');

    }

}
