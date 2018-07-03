<?php
namespace App\Http\Controllers\Admin;
use App\Permission;
use App\Role;
use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
class PermissionController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        $permissions = Permission::all();
        return view('superadmin.permission.index',compact('permissions'));
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Role::get(); //Get all roles
        return view('superadmin.permission.create',compact('roles'));
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
            'name'=>'required|max:40',
        ]);
        $permission = new Permission();
        $permission->name = $request->name;
        $permission->save();
        if ($request->roles <> '') {
            foreach ($request->roles as $key=>$value) {
                $role = Role::find($value);
                $role->permissions()->attach($permission);
            }
        }
        flash('Permission added successfully')->important()->success();
        return redirect()->route('permissions.index');
    }

    public function edit(Permission $permission)
    {
        return view('superadmin.permission.edit', compact('permission'));
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Permission  $permission
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Permission $permission)
    {
        $this->validate($request, [
            'name'=>'required',
        ]);
        $permission->name=$request->name;
        $permission->save();
        flash('Permission '. $permission->name.' updated!')->important()->success();
        return redirect()->route('permissions.index');
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Permission  $permission
     * @return \Illuminate\Http\Response
     */
    public function destroy(Permission $permission)
    {
        $permission->delete();
        flash('Permission deleted successfully!')->important()->success();
        return redirect()->route('permissions.index');
    }
}