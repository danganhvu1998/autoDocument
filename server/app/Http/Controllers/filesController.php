<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\file;
use Illuminate\Support\Facades\Storage;
use DB;


class filesController extends Controller
{   
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function filesViewingSite(){
        $files = file::orderBy('updated_at','desc')
            ->get();
        $data = array(
            'files' => $files,
        );
        return view('files.view')->with($data);
    }

    public function filesAdding(request $request){
        $this->validate($request, [
            'file' => 'max:1999'
        ]);

        if($request->hasFile('file')){
            // Get just ext
            $extension = $request->file('file')->getClientOriginalExtension();
            if($extension!="docx" && $extension!="xlsx") return redirect('files');
            // Filename to store
            $fileNameToStore = $request->file('file')->getClientOriginalName();
            // Upload File
            $path = $request->file('file')->storeAs('public/file', $fileNameToStore);

            $file = new file;
            $file->file_url = $fileNameToStore;
            $file->save();
        } else {
            return redirect('files');
        }
        
        return redirect('files');
    }

    public function filesDeleting($id){
        $file = file::where('id', $id)->first();
        if($file == null){
            return redirect('files');
        }
        Storage::delete('public/file/'.$file->file_url);
        file::where('id', $id)->delete();
        return redirect('files');
    }
}
