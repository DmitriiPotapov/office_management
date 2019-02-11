<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Illuminate\Support\Facades\Hash;
use App\User;
use App\Models\BaseUserGroups;
use App\Models\BasePermissions;
use App\Models\BaseRoles;
use App\Models\DataPermissions;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    //
    protected $username;
    protected $role;
    
    public function __constuct() 
    {
        parent::__constuct();
        $this->middleware('auth');
    }

    public function showAddUser()
    {
        if( !Auth::check() )
            return redirect()->route('login');
            
        $roles = BaseRoles::where('inuse', 1)->get()->toArray();
        $groups = BaseUserGroups::where('inuse', 1)->get()->toArray();
        $permissions = BasePermissions::where('inuse', 1)->get()->toArray();
        return view('user.adduser', compact('roles','groups','permissions'));
    }

    public function addnewuser(Request $request)
    {
        if( !Auth::check() )
            return redirect()->route('login');

        $validator = Validator::make($request->all(), [
            'fullname' => ['required', 'string', 'max:255'],
            'username' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255'],
            'password' => ['required', 'string', 'min:6', 'confirmed'],
        ]);


        $user = new user();
        $user->fullname = $request->input('fullname');
        $user->username = $request->input('username');
        $user->password = Hash::make($request->input('password'));
        $user->email = $request->input('email');
        $user->ui_language = $request->input('ui_language');
        $user->role = $request->input('role');
        $user->user_group = $request->input('user_group');
        $user->isactive = $request->input('isactive');

        for ($i = 0 ; $i < 31; $i ++)
        {
            $str1 = 'checkbox'.$i;
            $str2 = 'label'.$i;
            $value[$i] = $request->input($str1);
            $labelstr[$i] = $request->input($str2);
            if($value[$i] == "")
                $value[$i] = "off";
        }
    //    $user->created_at = date('M d, Y');
    //    $user->updated_at = date('M d, Y');
        $user->save();

        $permissions = BasePermissions::where('inuse', 1)->get()->toArray();

        for ($i = 0 ; $i < 31 ; $i ++)
        {
            $permissiondata = new DataPermissions();
            $permissiondata->user_id = $user->id;
            $permissiondata->permission_id = BasePermissions::where('permission_name', $labelstr[$i])->first()->id;
            $permissiondata->value = $value[$i];

            $permissiondata->save();
        }


        return redirect('/user/showAllUser');
    }

    public function updateUser(Request $request)
    {
        if( !Auth::check() )
            return redirect()->route('login');

        $validator = Validator::make($request->all(), [
            'fullname' => ['required', 'string', 'max:255'],
            'username' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255'],
            'password' => ['required', 'string', 'min:6', 'confirmed'],
        ]);

        $user = User::find($request->input('selid'));
        $user->fullname = $request->input('fullname');
        $user->username = $request->input('username');
        $user->password = Hash::make($request->input('password'));
        $user->email = $request->input('email');
        $user->ui_language = $request->input('ui_language');
        $user->role = $request->input('role');
        $user->user_group = $request->input('user_group');
        $user->isactive = $request->input('isactive');
        $user->update();

        for ($i = 0 ; $i < 31; $i ++)
        {
            $str1 = 'checkbox'.$i;
            $str2 = 'label'.$i;
            $value[$i] = $request->input($str1);
            $labelstr[$i] = $request->input($str2);
            if($value[$i] == "")
                $value[$i] = "off";
            else {
                $value[$i] = "on";
            }
        }
        
        $permissions = BasePermissions::where('inuse', 1)->get()->toArray();

        for ($i = 0 ; $i < 31 ; $i ++)
        {
            $permission_id = BasePermissions::where('permission_name', $labelstr[$i])->first()->id;
            $permissiondata = DataPermissions::where('user_id', $user->id)->where('permission_id', $permission_id)->first();
            if ($permissiondata) {
                $permissiondata->value = $value[$i];
                $permissiondata->update();
            } else {
                $datapermission = new DataPermissions();
                $datapermission->user_id = $user->id;
                $datapermission->permission_id = $permission_id;
                $datapermission->value = $value[$i];
                $datapermission->save();
            }

        }

        return redirect('/user/showAllUser');
    }

    public function showAllUser()
    {
        if( !Auth::check() )
            return redirect()->route('login');

        $users = User::where('inuse', 1)->get()->toArray();
        return view('user.showalluser',compact('users'));
    }

    public function deleteUser($id)
    {
        $user = User::find($id);
        $user->inuse = 0;
        $user->update();
        return redirect('/user/showAllUser');
    }

    public function showeditUser($id)
    {
        if( !Auth::check() )
            return redirect()->route('login');

        $seluser = User::find($id);
        $roles = BaseRoles::where('inuse', 1)->get()->toArray();
        $groups = BaseUserGroups::where('inuse', 1)->get()->toArray();
        $permissions = BasePermissions::where('inuse', 1)->get()->toArray();
        $dataPermission = DataPermissions::where('user_id', $id)->get()->toArray();
        
        $permissionarray = array();
        foreach($dataPermission as $item) {
            $id = $item['permission_id'];
            $val = $item['value'];
            $permissionarray[$id] =  $val;
        }

        return view('user.edituser',compact('seluser','roles','groups','permissions','permissionarray', 'dataPermission'));
    }

    public function showAddUsergroup()
    {
        if( !Auth::check() )
            return redirect()->route('login');

        return view('user.addusergroup');
    }

    public function addnewusergroup(Request $request)
    {

        $group = new BaseUserGroups();
        $group->group_name = $request->input('group_name');
        
        $group->save();
        return redirect('/user/showAllUsergroup');
    }

    public function updateUsergroup(Request $request)
    {
        
        $group = BaseUserGroups::find($request->input('selid'));
        $group->group_name = $request->input('group_name');
        $group->update();
        return redirect('/user/showAllUsergroup');
    }

    public function showAllUsergroup()
    {
        if( !Auth::check() )
            return redirect()->route('login');

        $groups = BaseUserGroups::where('inuse', 1)->get()->toArray();
        return view('user.showallusergroup',compact('groups'));
    }

    public function deleteUsergroup($id)
    {
        $group = BaseUserGroups::find($id);
        $group->inuse = 0;
        $group->update();
        return redirect('/user/showAllUsergroup');
    }

    public function showeditUsergroup($id)
    {
        if( !Auth::check() )
            return redirect()->route('login');

        $selgroup = BaseUserGroups::find($id);
        return view('user.editusergroup',compact('selgroup'));
    }

    public function showAddPermission()
    {
        if( !Auth::check() )
            return redirect()->route('login');

        return view('user.addPermission');
    }

    public function addnewPermission(Request $request)
    {

        $permission = new BasePermissions();
        $permission->permission_name = $request->input('permission_name');
        
        $permission->save();
        return redirect('/user/showAllPermission');
    }

    public function updatePermission(Request $request)
    {
        
        $permission = BasePermissions::find($request->input('selid'));
        $permission->permission_name = $request->input('permission_name');
        $permission->update();
        return redirect('/user/showAllPermission');
    }

    public function showAllPermission()
    {
        $permissions = BasePermissions::where('inuse', 1)->get()->toArray();
        return view('user.showallPermission',compact('permissions'));
    }

    public function deletePermission($id)
    {
        $permission = BasePermissions::find($id);
        $permission->inuse = 0;
        $permission->update();
        return redirect('/user/showAllPermission');
    }

    public function showeditPermission($id)
    {
        if( !Auth::check() )
            return redirect()->route('login');

        $selpermission = BasePermissions::find($id);
        return view('user.editPermission',compact('selpermission'));
    }

    public function showAddrole()
    {
        return view('user.addrole');
    }

    public function addnewrole(Request $request)
    {

        $role = new BaseRoles();
        $role->role_name = $request->input('role_name');
        
        $role->save();
        return redirect('/user/showAllrole');
    }

    public function updaterole(Request $request)
    {
        
        $role = BaseRoles::find($request->input('selid'));
        $role->role_name = $request->input('role_name');
        $role->update();
        return redirect('/user/showAllrole');
    }

    public function showAllrole()
    {
        if( !Auth::check() )
            return redirect()->route('login');

        $roles = BaseRoles::where('inuse', 1)->get()->toArray();
        return view('user.showallrole',compact('roles'));
    }

    public function deleterole($id)
    {
        $role = BaseRoles::find($id);
        $role->inuse = 0;
        $role->update();
        return redirect('/user/showAllrole');
    }

    public function showeditrole($id)
    {
        if( !Auth::check() )
            return redirect()->route('login');
            
        $selrole = BaseRoles::find($id);
        return view('user.editrole',compact('selrole'));
    }
}
