<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\Support\Facades\Session;


class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $user = User::all();
        return view ('admin.user.index',compact('user'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //session
        Session::put('admin_page','user');
        //
        return view ('admin.user.create');

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
         //session
         Session::put('admin_page','user');
         //
        $data = $request->all();
        $validateData = $request->validate([
            'username' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()]
            
        ]);
        $user = new User();
        $user->name = $data['username'];
        $user->email = $data['email'];
        $user->password = Hash::make($data['password']);
        $status =  $user->save();
        if ($status) {
            Session::flash('success_message', 'User Has Been Added Successfully');
        } else
            Session::flash('error_message', 'User could not be added');
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //session
        Session::put('admin_page','user');
        //
        $user = User::findorfail($id);
        return view('admin.user.edit',compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data = $request->all();
        $validateData = $request->validate([
            'password' => ['required','confirmed', Rules\Password::defaults()] 
        ]);
        $user = User::findorfail($id);
        $user->password = Hash::make($data['password']);
        $status =  $user->save();
        if ($status) {
            Session::flash('success_message', 'Password Reset Successfully');
        } else
            Session::flash('error_message', 'Password could not be Reset');
        return redirect()->route('admin.users.index');
       
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $user = User::findorfail($id);
        $status =  $user->delete();
        if ($status) {
            Session::flash('success_message', 'User deleted Successfully');
        } else
            Session::flash('error_message', 'User could not be deleted');
        return redirect()->back();
    }
}
