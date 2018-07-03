<?php

namespace App\Http\Controllers\Admin;

use App\Category;
use App\Role;
use App\User;
use App\VendorProfile;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpKernel\Profiler\Profile;

class UserController extends Controller
{
    public function index()
    {
        $users=User::get();
       // dd($users);
        return view('superadmin.user.index',compact('users'));
    }
    public function vendors()
    {
        $vendors=User::role('Vendor')->get();
        return view('superadmin.user.vendorList',compact('vendors'));
    }
    public function updateUserStatus(Request $request)
    {
        $user_id=$request->user_id;
        if($request->status==0)
        {
            User::where('id',$user_id)->update(array('is_deleted'=>'1'));
        }
        else
        {
            User::where('id',$user_id)->update(array('is_deleted'=>'0'));
        }
        return response()->json(true);
    }
    public function create()
    {
        $roles = Role::get();
        return view('superadmin.user.create', compact('roles'));
    }
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email|unique:users',
           // 'user_name' => 'required|min:5|unique:users',
            'password' => 'required|min:6|confirmed',
            'roles' => 'required'
        ]);
       // $user = User::create($request->except('roles'));
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
        flash('User has been created')->important()->success();
        return redirect()->route('users.index');

    }
    public function edit($id) {
        $user = User::findOrFail($id);
        $roles = Role::get();
        return view('superadmin.user.edit', compact('user', 'roles'));
    }
    public function update(Request $request, $id) {

        $user = User::findOrFail($id);
        $this->validate($request, [
            'name'=>'required|max:120',
         /*   'email'=>'required|email|unique:users,email',*/
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
        flash('User successfully updated')->important()->success();
        return redirect()->route('users.index');
    }
    public function destroy($id) {
        $user = User::findOrFail($id);
        $user->delete();
        flash('User successfully deleted')->important()->success();
        return redirect()->route('users.index');
    }
    public function createProfile($id)//create Vendor profile
    {
        $details=User::where('id',$id)->first();
        $profile=VendorProfile::where('vendor_id',$id)->first();
        $categories=Category::all();
       // dd($details);
        return view('superadmin.user.profile',compact('details','categories','id','profile'));
    }

    public function storeProfile(Request $request,$id)
    {
        $this->validate($request, [
            'name'=>'required|max:120',
        ]);
        $file=$request->file('image');

        $path='';
        if(count($file))
        {
            $path = $file->storeAs('/vendor_profile', str_slug('vendor_profile') . mt_rand() . '.' . $file->extension(), 'uploads');

        }


        $category='';
        for($i=0;$i<count($request->category);$i++)
        {
            if($category=='')
            {
                $category=$request->category[$i];
            }
            else
            {
                $category=$category.','.$request->category[$i];
            }
        }
     //   dd($category);
        $rr=VendorProfile::where('vendor_id',$id)->first();
        if(count($rr))
        {
            if(count($file))
            {
                VendorProfile::where("vendor_id",$id)->update(array("image"=>$path,"categories"=>$category,"description"=>$request->description1));
            }
            else
            {
                VendorProfile::where("vendor_id",$id)->update(array("categories"=>$category,"description"=>$request->description1));
            }
        }
        else
        {
            VendorProfile::create(['vendor_id'=>$id,
                'image'=>$path,
                'categories'=>$category,
                'description'=>$request->description1,
            ]);
        }

        flash('User profile updated successfully')->important()->success();
        return redirect()->back();
        //return redirect()->route('user.index');
    }

    public function checkImage(Request $request)
    {
        $pro=VendorProfile::where('vendor_id',$request->id)->first();
        if(count($pro))
        {
            if($pro['image']=='')
            {
                return response()->json(false);
            }
            else
            {
                return response()->json(true);
            }
        }
        else
        {
            return response()->json(false);
        }
    }
    public function userProfileUpdate()
    {
        $id=Auth::User()->id;
        $details=User::where('id',$id)->first();
        $profile=VendorProfile::where('vendor_id',$id)->first();
        $categories=Category::all();
        // dd($details);
        return view('superadmin.user.profile',compact('details','categories','id','profile'));
    }
}
