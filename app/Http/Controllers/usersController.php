<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

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
            return view('user-edit', compact('user'));
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

     public function insert(Request $request)
     {
       $user = new User();
       $user->first_name = $request->input('first_name');
       $user->last_name = $request->input('last_name');
       $user->email = $request->input('email');
       $user->position = $request->input('position');
       $user->password = $request->input('password');
       $user->save();
       return redirect('/')->with('success','User added!');
     }




}
