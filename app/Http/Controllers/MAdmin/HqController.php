<?php

namespace App\Http\Controllers\MAdmin;

use App\Role;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class HqController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users=User::role('hq_admin')->get();
        return view('admin.hq.index',compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Role::where('name','hq_admin')->get();
        return view('admin.hq.create', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6|confirmed',
            'roles' => 'required'
        ]);
        $api_token = str_random(64);
        while (1){
            $tokenExist = User::where('api_token', $api_token)->first();
            if(!$tokenExist)
                break;
            else
                $api_token = str_random(64);
        }



        $user =User::create(['name'=>$request->name,
            'email'=>$request->email,
            'password'=>bcrypt($request->password),
            'api_token'=>$api_token,
        ]);

        if($request->roles <> ''){
            $user->roles()->attach($request->roles);
        }
        flash('HQ Admin has been created')->important()->success();
        return redirect()->route('hq.index');
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
        $user = User::findOrFail($id);
        $roles = Role::where('name','hq_admin')->get();
        return view('superadmin.user.edit', compact('user', 'roles'));
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
        $user = User::findOrFail($id);
        $this->validate($request, [
            'name'=>'required|max:120',
            'email'=>'required|email',
            'roles' => 'required'
        ]);
        $input = $request->except('roles');
        //dd($input);
        $user->fill($input)->save();
        if ($request->roles <> '') {
            $user->roles()->sync($request->roles);
        }
        else {
            $user->roles()->detach();
        }
        flash('HQ Admin successfully updated')->important()->success();
        return redirect()->route('hq.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        flash('HQ Admin successfully deleted')->important()->success();
        return redirect()->route('hq.index');
    }
}
