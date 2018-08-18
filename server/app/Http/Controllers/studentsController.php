<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\define;
use App\student;
use App\assign;

class studentsController extends Controller
{
    // Student Setting
    public function studentsShowingSite(){
        $students = student::all();
        return view("students.setting")->with("students", $students);
    }

    // Student Adding
    public function studentsAddingSite(){
        $definitions = define::all();
        return view("students.add")->with("definitions", $definitions);
    }

    public function studentsAdding(request $request){
        $student = new student;
        $student->name = $request->name;
        $student->note = $request->note;
        if(!isset($student->name)) return redirect("/students/add");
        if( $student->save() ){
            $studentID = student::orderBy('updated_at','desc')
                ->select("id")
                ->first()
                ->id;
            $definitions = define::all();
            foreach($definitions as $definition){
                $value = $definition->id;
                $assignment = new assign;
                $assignment->student_id = $studentID;
                $assignment->define_id = $definition->id;
                $assignment->value = $request->$value;
                $assignment->save();
            }
            return redirect("/students");
        }
        return "Error";
    }

    // Student Deleting
    public function studentsDeletingSite($id){
        $student = student::where("id", $id);
        if(!$student==null){
            student::where("id", $id)->delete();
        }
        return redirect("/students");
    }

    // Student Viewing 
    public function studentsViewingSite($id){
        $data = $this->studentInfoTaker($id);
        return view("students.view")->with($data);
    }

    // Student Editing
    public function studentsEditingSite($id){
        $data = $this->studentInfoTaker($id);
        return view("students.edit")->with($data);
    }

    public function studentsEditing(request $request){
        //return $request;
        $id = $request->id; // Student ID
        $defines = define::all();
        student::where("id", $id)
            ->update([
                "name" => $request->name,
                "note" => $request->note
            ]);
        foreach($defines as $define){
            $defineID = $define->id;
            if(!isset($request->$defineID)) continue;
            assign::where('student_id', $id)
            ->where("define_id", $defineID)
            ->update([
                'value' => $request->$defineID
            ]);
        }
        return redirect("/students/view/".$id);
    }

    // Student Addon Function
    public function studentInfoTaker($id){
        // Fill non-existed info with null
        $defines = define::all();
        $assign = new assign;
        $assign->student_id = $id;
        $assign->value = null;
        foreach($defines as $define){
            if(assign::where("student_id", $id)
                ->where("define_id", $define->id)
                ->first()==null){
                $assign->define_id = $define->id;
                $assign->save();
            }
        }

        // Take student info
        $student = student::where("id", $id)->first();
        $assignments = DB::table("assigns")
            ->where("student_id", $id)
            ->join("defines", "assigns.define_id", "=", "defines.id")
            ->select("assigns.define_id", "assigns.value", "defines.define1", "defines.name")
            ->get();

        $data = array("student"=>$student, "assignments"=>$assignments);
        return $data;
    }

}
