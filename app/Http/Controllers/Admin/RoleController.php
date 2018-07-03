<?php
namespace App\Http\Controllers\Admin;
use App\Role;
use App\Permission;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
class RoleController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        $roles = Role::all();
        return view('superadmin.role.index',compact('roles'));
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $permissions = Permission::all();//Get all permissions
        return view('superadmin.role.create', compact('permissions'));
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
                'name'=>'required|unique:roles|max:10',
                'permissions' =>'required',
            ]
        );
        $role = new Role();
        $role->name = $request->name;
        $role->save();
        if($request->permissions <> ''){
            $role->permissions()->attach($request->permissions);
        }
        flash('Roles added successfully')->important()->success();
        return redirect()->route('roles.index');
    }

    public function edit($id) {
        $role = Role::findOrFail($id);
        $permissions = Permission::all();
        $my_permissions =$role->permissions()->get();

        return view('superadmin.role.edit', compact('role', 'permissions','my_permissions'));
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
        $role = Role::findOrFail($id);//Get role with the given id
        //Validate name and permission fields
        $this->validate($request, [
            'name'=>'required|max:10|unique:roles,name,'.$id,
            'permissions' =>'required',
        ]);
        $input = $request->except(['permissions']);
        $role->fill($input)->save();
        if($request->permissions <> ''){
            $role->permissions()->sync($request->permissions);
        }
        flash('Roles updated successfully')->important()->success();
        return redirect()->route('roles.index');
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $role = Role::findOrFail($id);
        $role->delete();
        flash('Role deleted successfully')->important()->success();
        return redirect()->route('roles.index');
    }
}