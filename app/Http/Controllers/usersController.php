<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\HardwareAssets;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class usersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

     public function edit($id)
     {
            $user = User::find($id);
            return view('user-edit', compact('user'),
            ['users_assets' => HardwareAssets::where('users', $id)->get()]);
     }

     public function update(Request $request, $id)
     {
            $user = User::find($id);
            $user->first_name = $request->Input('first_name');
            $user->last_name = $request->Input('last_name');
            $user->email = $request->Input('email');
            $user->position = $request->Input('position');
            $user->save();
            return redirect('/users')->with('success', 'User has been updated');
     }

     public function add()
     {
              return view('user-add');
     }

     public static function insert(Request $request)
     {
       $user = new User();
       $user->first_name = $request->input('first_name');
       $user->last_name = $request->input('last_name');
       $user->email = $request->input('email');
       $user->position = $request->input('position');
       $user->password = Hash::make($request->input('password'));
       $user->save();
       return redirect('/')->with('success','User added!');
     }
     public function remove($id)
       {
              $user = User::find($id);
              $user->delete();
              return redirect('/users')->with('success', 'User account has been removed');
       }
}
