<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\define;
use App\assign;

class definitionsController extends Controller
{   
    // Definitions Setting Page
    public function definitionsSettingSite(){
        $definitions = define::all();
        return view("definitions.setting")->with("definitions", $definitions);
    }

    // Adding Definition
    public function definitionsAddingSite(){
        return view("definitions.add");
    }

    public function definitionsAdding(request $request){
        $define = new define;
        if(isset($request->name) && isset($request->define1)){
            $define->name = $request->name;
            $define->define1 = $request->define1;
            $define->define2 = $request->define2;
            if( $define->save() ) {
                return redirect("/definitions");
            }
        }  
        return "Error, something wrong. Not saved!";
    }

    // Deleting Definition
    public function definitionsDeletingSite($id){
        $definition = define::where("id", $id);
        if(!$definition==null){
            define::where("id", $id)->delete();
            assign::where("define_id", $id)->delete();
        }
        return redirect("/definitions");
    }

    // Editing Definition
    public function definitionsEditingSite($id){
        $definition = define::where("id", $id)->first();
        if(!$definition==null){
            //return $definition;
            return view("definitions.edit")->with("definition", $definition);
        }
        return redirect("/definitions");
    }

    public function definitionsEditing(request $request){
        $definition = define::where("id", $request->id)->first();
        if(!$definition==null){
            if(isset($request->name) && isset($request->define1)){
                define::where('id', $request->id)
                    ->update([
                        'name' => $request->name,
                        'define1' => $request->define1,
                        'define2' => $request->define2,
                    ]);
            }  
        }
        return redirect("/definitions");
    }

}
