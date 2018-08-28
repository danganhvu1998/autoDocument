<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\define;
use App\student;
use App\assign;
use App\document;
use App\assignDocument;
use App\assignStudentDocument;
use App\studentNote;

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
    public function studentsDeleting($id){
        student::where("id", $id)->delete();
        assign::where('student_id', $id)->delete();
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

    // Student Checking Accuracy
    public function studentsCheckingSite($id){
        $student = student::where("id", $id)->first();
        $errorInfos = $this->ErrorInfoTaker($id);
        $data = array(
            "errorInfos" => $errorInfos,
            "student" => $student
        );
        //return $data;
        return view("students.check")->with($data);
    }


    // Student Addon Functions
    public function ErrorInfoTaker($studentID){
        $assignStudentDocuments = DB::table("assign_student_documents")
            ->where("student_id", $studentID)
            ->join("assign_documents", "assign_student_documents.assign_document_id", "=", "assign_documents.id")
            ->join("defines", "assign_documents.define_id", "=", "defines.id")
            ->join("documents", "assign_documents.document_id", "=", "documents.id")
            ->select("assign_student_documents.value", "documents.document_name", "defines.name", "defines.id")
            ->get();
        
        $studentAssigns = assign::where("student_id", $studentID)
            ->select("value", "define_id")
            ->get();
        $infoChecker = array();
        foreach($studentAssigns as $studentAssign){
            $infoChecker[$studentAssign->define_id] = $studentAssign->value;
        }
        $errorInfos = array();
        foreach($assignStudentDocuments as $assignStudentDocument){
            if($assignStudentDocument->value!=$infoChecker[$assignStudentDocument->id]){
                $error = $assignStudentDocument;
                $error->origin_value=$infoChecker[$assignStudentDocument->id];
                array_push($errorInfos, $error);
            }
        }
        return $errorInfos;
    }

    public function studentInfoTaker($id){
        // Fill non-existed info with null
        // Fix later with less request to MysqlServer
        $defines = define::all();
        foreach($defines as $define){
            if(assign::where("student_id", $id)
                ->where("define_id", $define->id)
                ->first()==null
            ){
                $assign = new assign;                    
                $assign->student_id = $id;
                $assign->value = null;
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
            ->orderBy("position")
            ->get();
        
        // Take all documents
        $documents = document::all();

        $data = array("student" => $student, 
            "assignments"=> $assignments, 
            "documents" => $documents);
        return $data;
    }


    //******************************* END STUDENT FUNCTION *******************************\\
    //                                                                                    \\
    //                                                                                    \\
    //                                                                                    \\
    //                                                                                    \\
    //************************ START STUDENT - DOCUMENT FUNCTION *************************\\

    // Student - Document Editing
    public function studentsDocumentEditingSite($documentID, $studentID){
        $data = $this->studentDocumentInfoTaker($documentID, $studentID);
        return view("studentDocuments.edit")->with($data);
    }

    public function studentsDocumentEditing(request $request){
        $assignStudentDocumentsID = $this->takeID(request()->getContent());
        foreach($assignStudentDocumentsID as $assignStudentDocumentID){
            assignStudentDocument::where("id", $assignStudentDocumentID)
                ->update(["value" => $request->$assignStudentDocumentID]);
        }
        return redirect("/students/document/view/".$request->document_id."/".$request->student_id);
    }

    // Student - Document Viewing
    public function studentsDocumentViewingSite($documentID, $studentID){
        $data = $this->studentDocumentInfoTaker($documentID, $studentID);
        return view("studentDocuments.view")->with($data);
    }

    // Student - Document Addon Functions
    public function studentDocumentInfoTaker($documentID, $studentID){
        $student = student::where("id", $studentID)->first();
        $document = document::where("id", $documentID)->first();
        $assignDocuments = assignDocument::where("document_id", $documentID)->get();
        $assignDocumentsID = array();
        foreach($assignDocuments as $assignDocument){
            array_push($assignDocumentsID, $assignDocument->id);
            if(assignStudentDocument::where("student_id", $studentID)
                ->where("assign_document_id", $assignDocument->id)
                ->first()==null
            ){  
                $assignStudentDocument = new assignStudentDocument;
                $assignStudentDocument->student_id = $studentID;
                $assignStudentDocument->assign_document_id = $assignDocument->id;
                $assignStudentDocument->value = "";
                $assignStudentDocument->save();
            }
        }
        $assignStudentDocuments = DB::table("assign_student_documents")
            ->where("student_id", $studentID)
            ->whereIn("assign_document_id", $assignDocumentsID)
            ->join("assign_documents", "assign_student_documents.assign_document_id", "=", "assign_documents.id")
            ->join("defines", "assign_documents.define_id", "=", "defines.id")
            ->select("assign_student_documents.*", "defines.name")
            ->get();
        //return $assignStudentDocuments;
        $data = array("document"=>$document, 
            "student"=>$student, 
            "assignStudentDocuments"=>$assignStudentDocuments);
        return $data;
    }

    //************************** END STUDENT - DOCUMENT FUNCTION **************************\\
    //                                                                                     \\
    //                                                                                     \\
    //                                                                                     \\
    //                                                                                     \\
    //*************************** START STUDENT - NOTE FUNCTION ***************************\\

    // Student - Note Viewing
    public function studentsNoteViewingSite($id){
        $data = $this->studentsNoteInfoTaker($id);
        return view("studentNotes.view")->with($data);
    }
    
    // Student - Note Editing
    public function studentsNoteEditingSite($id){
        $data = $this->studentsNoteInfoTaker($id);
        return view("studentNotes.edit")->with($data);
    }

    public function studentsNoteEditing(request $request){
        $studentNotesID = $this->takeID(request()->getContent());
        foreach($studentNotesID as $studentNoteID){
            studentNote::where("id", $studentNoteID)
                ->update([
                    "note_value" => $request->$studentNoteID
                ]);
        }
        return redirect("/students/note/view/".$request->student_id);
    }

    // Student - Note Adding
    public function studentsNoteAddingSite($id){
        $student = student::where("id", $id)->first();
        return view("studentNotes.add")->with("student", $student);
    }

    public function studentsNoteAdding(request $request){
        $studentNote = new studentNote;
        $studentNote->note_name = $request->note_name;
        $studentNote->student_id = $request->student_id;
        $studentNote->note_value = "";
        $studentNote->save();
        return redirect("/students/note/edit/".$request->student_id);
    }

    // Student - Note Deleting
    public function studentsNoteDeleting($studentID, $noteID){
        studentNote::where("id", $noteID)->delete();
        return redirect("/students/note/edit/".$studentID);
    }
    
    // Student - Note Addon Functions
    public function studentsNoteInfoTaker($id){
        $student = student::where("id", $id)->first();
        $studentNotes = studentNote::where("student_id", $id)->get();
        $data = array(
            "student" => $student,
            "studentNotes" => $studentNotes
        );
        return $data;
    }

    //**************************** END STUDENT - NOTE FUNCTION ****************************\\
    //                                                                                     \\
    //                                                                                     \\
    //                                                                                     \\
    //                                                                                     \\
    //*********************************** ADDON FUNCTION **********************************\\
    public function takeID($str){
        $str = "&".$str;
        $ans = array();
        $length = strlen($str);
        $curr = "";
        for($i=0; $i<$length; $i++){
            if(strlen($curr)>0){
                if($str[$i]!="=") $curr .= $str[$i];
                else {
                    array_push($ans, (int)$curr);
                    $curr = "";
                }
            } else {
                if($str[$i]=="&" && $str[$i+1]<="9" && $str[$i+1]>="0"){
                    $curr = " ";
                }
            }
        }
        return $ans;
    }

}
