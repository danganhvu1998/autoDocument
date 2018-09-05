<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;


class employeesController extends Controller
{   
    public function __construct()
    {
        $this->middleware('auth');
    }
    //
    public function userLevelCheck(){
        if(Auth::user()->level >= 99) return 1;
        return 0;
    }
    
    public function employeesSettingSite(){
        if(!$this->userLevelCheck()) return redirect("/home");
        $users = User::all();
        return view("employees.setting")->with("users", $users);
    }

    public function employeesDeleting($employee_id){
        if(!$this->userLevelCheck()) return redirect("/home");
        if($employee_id!=1) user::where("id", $employee_id)->delete();
        return redirect("/employees");
    }

    public function employeesAdding(request $request){
        if(!$this->userLevelCheck()) return redirect("/home");
        $user = new User;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->level = 1;
        $user->save();
        return redirect("/employees");
    }

    public function employeesViewingSite($employee_id){
        if(!$this->userLevelCheck()) return redirect("/home");
        $user = User::where("id", $employee_id)->first();
        $data = array(
            "user" => $user
        );
        return view("employees.view")->with($data);
    }

    public function employeesEdit(request $request){
        if(Auth::user()->level <= $request->level) {
            return redirect("/employees/view/".$request->employee_id);
        }
        if( $request->employee_id == 1 ) {
            return redirect("/employees/view/".$request->employee_id);
        }
        if($request->level<1) $request->level=1;
        if($request->level>1 and $request->level<99) $request->level=2;

        User::where("id", $request->employee_id)
            ->update([
                "level" => $request->level
            ]);
        return redirect("/employees/view/".$request->employee_id);
        
    }
}
