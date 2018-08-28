<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\files;
use Illuminate\Support\Facades\Storage;
use DB;


class filesController extends Controller
{   
    public function showStore($page){
        if($page<1) {
            return redirect('files/store/1');
        }
        $files = files::orderBy('updated_at','desc')
			->skip(($page-1)*20)
			->take(20)
            ->get();
        if(count($files)==0 and $page!=1){
            return redirect('files/store/'.strval(intval((files::count()-1)/20+1)));
        }
        $data = array(
            'files' => $files,
            'pageNum' => $page
        );
        return view('fileCtrl.store')->with($data);
    }

    public function store(request $request){
        $this->validate($request, [
            'file' => 'max:1999'
        ]);

        if($request->hasFile('file')){
            // Get filename with the extension
            $filenameWithExt = $request->file('file')->getClientOriginalName();
            // Get just filename
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            // Get just ext
            $extension = $request->file('file')->getClientOriginalExtension();
            // Filename to store
            $fileNameToStore= $filename.'_'.time().'.'.$extension;
            // Upload Image
            $path = $request->file('file')->storeAs('public/file', $fileNameToStore);
        } else {
            return redirect('files/store/1');
        }
        $file = new files;
        $file->file_url = $fileNameToStore;
        $file->save();
        return redirect('files/store/1');
    }

    public function delete($id){
        $file = files::where('id', $id)->first();
        if($file == null){
            return redirect('files/store/1');
        }
        Storage::delete('public/file/'.$file->file_url);
        files::where('id', $id)->delete();
        return redirect('files/store/1');
    }

    public function banner(request $request){
        $this->validate($request, [
            'file' => 'max:1999'
        ]);
        if($request->hasFile('file')){
            $path = $request->file('file')->storeAs('public/file', "banner.jpg");
        } else {
            return redirect('home');
        }
        return redirect('home');
    }
}
