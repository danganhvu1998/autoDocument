<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\groupFile;
use App\assignGroupFile;
use App\file;

class groupFilesController extends Controller
{   
    public function __construct()
    {
        $this->middleware(['auth', 'checkLevel2']);
    }

    // Setting - List all
    public function groupFilesSettingSite(){
        $groupFiles = groupFile::all();
        return view("groupFiles.setting")->with("groupFiles", $groupFiles);
    }

    // Adding
    public function groupFilesAddingSite(){
        return view("groupFiles.add");
    }

    public function groupFilesAdding(request $request){
        $groupFile = new groupFile;
        $groupFile->name = $request->groupFile_name;
        if(isset($request->groupFile_note)) {
            $groupFile->note = $request->groupFile_note;
        } else {
            $groupFile->note = "";
        }
        $groupFile->save();
        return redirect("/groupFiles");
    }

    // Editing
    public function groupFilesEditingSite($id){
        $data  = $this->groupFileInfoTaker($id);
        return view ("groupFiles.edit")->with($data);
    }

    public function groupFilesEditing(request $request){
        //return $request;
        $groupFileID = $request->id;
        $files = file::all();
        foreach($files as $file){
            $fileID = $file->id;
            assignGroupFile::where("file_id", $fileID)
                ->where("group_file_id", $groupFileID)
                ->delete();
            if( isset($request->$fileID) ){
                $assignGroupFile = new assignGroupFile;
                $assignGroupFile->group_file_id = $groupFileID;
                $assignGroupFile->file_id = $fileID;
                $assignGroupFile->save();
            }
        }
        return redirect("/groupFiles/view/".$groupFileID);
    }

    // Viewing
    public function groupFilesViewingSite($id){
        $data  = $this->groupFileInfoTaker($id);
        return view ("groupFiles.view")->with($data);
    }

    // Deleting
    public function groupFilesDeleting($id){
        assignGroupFile::where("group_file_id", $id)->delete();
        groupFile::where("id", $id)->delete();
        return redirect("/groupFiles");
    }

    // Addon Function
    public function groupFileInfoTaker($id){
        $groupFileHasfiles = array();
        $groupFileNotHasfiles = array();

        //Take files'id that in groupFile
        $assignGroupFiles = assignGroupFile::where("group_file_id", $id)
            ->select("file_id")
            ->get();
        foreach($assignGroupFiles as $assignGroupFile){
            array_push($groupFileHasfiles, $assignGroupFile->file_id);
        }
        //Take files that in groupFile
        $hasfile = file::whereIn("id", $groupFileHasfiles)->get();

        //Take files that NOT in groupFile
        $notHasfile = file::whereNotIn("id", $groupFileHasfiles)->get();
            

        //Prepare for view
        $groupFile = groupFile::where("id", $id)->first();
        $data = array("hasFiles" => $hasfile, 
            "notHasFiles" => $notHasfile,
            "groupFile" => $groupFile,
        );
        return $data;
    }
    

}
