<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\document;
use App\assignDocument;
use App\define;

class documentsController extends Controller
{   
    public function __construct()
    {
        $this->middleware('auth');
    }
    // Setting - List all
    public function documentsSettingSite(){
        $documents = document::all();
        return view("documents.setting")->with("documents", $documents);
    }

    // Adding
    public function documentsAddingSite(){
        return view("documents.add");
    }

    public function documentsAdding(request $request){
        $document = new document;
        $document->document_name = $request->document_name;
        $document->save();
        return redirect("/documents");
    }

    // Editing
    public function documentsEditingSite($id){
        $data  = $this->documentInfoTaker($id);
        return view ("documents.edit")->with($data);
    }

    public function documentsEditing(request $request){
        $documentID = $request->id;
        $defines = define::all();
        foreach($defines as $define){
            $defineID = $define->id;
            assignDocument::where("define_id", $defineID)
                ->where("document_id", $documentID)
                ->delete();
            if( isset($request->$defineID) ){
                $assignDocument = new assignDocument;
                $assignDocument->document_id = $documentID;
                $assignDocument->define_id = $defineID;
                $assignDocument->save();
            }
        }
        return redirect("/documents/view/".$documentID);
    }

    // Viewing
    public function documentsViewingSite($id){
        $data  = $this->documentInfoTaker($id);
        return view ("documents.view")->with($data);
    }

    // Deleting
    public function documentsDeleting($id){
        assignDocument::where("document_id", $id)->delete();
        document::where("id", $id)->delete();
        return redirect("/documents");
    }

    // Addon Function
    public function documentInfoTaker($id){
        $documentHasDefines = array();
        $documentNotHasDefines = array();

        //Take defines'id that in document
        $assignDocuments = assignDocument::where("document_id", $id)
            ->select("define_id")
            ->get();
        foreach($assignDocuments as $assignDocument){
            array_push($documentHasDefines, $assignDocument->define_id);
        }
        //Take defines that in document
        $hasDefine = define::whereIn("id", $documentHasDefines)->get();

        //Take defines that NOT in document
        $notHasDefine = define::whereNotIn("id", $documentHasDefines)->get();
            

        //Prepare for view
        $document = document::where("id", $id)->first();
        $data = array("hasDefines" => $hasDefine, 
            "notHasDefines" => $notHasDefine,
            "document" => $document,
        );
        return $data;
    }
    

}
