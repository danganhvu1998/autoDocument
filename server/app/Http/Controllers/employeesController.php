<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\studentControlList;
use App\student;

class employeesController extends Controller
{   
    public function __construct()
    {
        $this->middleware(['auth', 'checkLevel']);
    }
    //
    public function userLevelCheck(){
        if(Auth::user()->level >= 99) return 1;
        return 0;
    }
    
    public function employeesSettingSite(){
        $users = User::all();
        return view("employees.setting")->with("users", $users);
    }

    public function employeesDeleting($employee_id){
        if($employee_id!=1) user::where("id", $employee_id)->delete();
        studentControlList::where("user_id", $employee_id)->delete();
        return redirect("/employees");
    }

    public function employeesAdding(request $request){
        if(isset($request->name) and isset($request->email) and isset($request->password)){
            $user = new User;
            $user->name = $request->name;
            $user->email = $request->email;
            $user->password = Hash::make($request->password);
            $user->level = 1;
            $user->save();
        }
        return redirect("/employees");
    }

    public function employeesViewingSite($employee_id){
        $user = User::where("id", $employee_id)->first();
        $students = $this->employeesStudentsList($employee_id);
        $data = array(
            "user" => $user,
            "students" => $students
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

    public function employeesAddStudent(Request $request){
        if(student::where("id",$request->student_id)->first() == null){
            return redirect("/employees/view/".$request->employee_id);
        }
        $this->employeesRmStudent($request->employee_id, $request->student_id);
        $employeeStudent = new studentControlList;
        $employeeStudent->user_id = $request->employee_id;
        $employeeStudent->student_id = $request->student_id;
        $employeeStudent->save();
        return redirect("/employees/view/".$request->employee_id);
        
    }

    public function employeesRmStudent($employee_id, $student_id){
        studentControlList::where("user_id", $employee_id)
            ->where("student_id", $student_id)
            ->delete();
        return redirect("/employees/view/".$employee_id);
    }

    public function employeesStudentsList($employee_id){
        $students = studentControlList::where("user_id", $employee_id)
            ->orderBy("student_control_lists.id", "desc")
            ->join("students", "student_control_lists.student_id", "=", "students.id")
            ->get();
        return $students;
    }
}
