<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\define;
use App\assign;
use App\assignDocument;

class definitionsController extends Controller
{   
    public function __construct()
    {
        $this->middleware('auth');
    }

    // Definitions Setting Page
    public function definitionsSettingSite(){
        $definitions = define::orderBy("position")->get();
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
            $define->position = 1000000;
            $define->save();
            $this->definitionsResetPosition();
        }  
        return "Error, something wrong. Not saved!";
    }

    // Deleting Definition
    public function definitionsDeleting($id){
        define::where("id", $id)->delete();
        assign::where("define_id", $id)->delete();
        assignDocument::where("define_id", $id)->delete();
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

    // Change Position
    public function definitionsChangePositionUp($position){
        $defines = define::where("position", "<=", $position)
            ->orderBy('position','desc')
            ->limit(2)
            ->get();
        if(count($defines) == 2){
            define::where('id', $defines[0]->id)
            ->update([
                'position' => $defines[1]->position
            ]);

            define::where('id', $defines[1]->id)
            ->update([
                'position' => $defines[0]->position
            ]);
        }
        return redirect("/definitions");
    }

    public function definitionsChangePositionDown($position){
        $defines = define::where("position", ">=", $position)
            ->orderBy('position')
            ->limit(2)
            ->get();
        if(count($defines) == 2){
            define::where('id', $defines[0]->id)
            ->update([
                'position' => $defines[1]->position
            ]);

            define::where('id', $defines[1]->id)
            ->update([
                'position' => $defines[0]->position
            ]);
        }
        return redirect("/definitions");
    }

    public function definitionsChangePosition(request $request){
        $definitonCount = define::count();
        $curr = $request->currentPosition;
        $newP = $request->newPosition;
        $randNumber = 123852987;
        if($newP<1){
            $newP = 1;
        } else if($newP>$definitonCount){
            $newP = $definitonCount;
        }
        define::where("position", $curr)
            ->update([
                'position' => $randNumber
            ]);
        if($curr>$newP){
            define::where("position", "<", $curr)
                ->where("position", ">=", $newP)
                ->increment('position');
        } else if($curr<$newP){
            define::where("position", ">", $curr)
                ->where("position", "<=", $newP)
                ->decrement('position');
        }
        define::where("position", $randNumber)
            ->update([
                'position' => $newP
            ]);
        $this->definitionsResetPosition();
        return redirect("/definitions");
        return $request;
    }

    public function definitionsFullfillPosition(){
        $defines = define::whereNull('position')->get();
        foreach($defines as $define){
            define::where('id', $define->id)
            ->update([
                'position' => $define->id
            ]);
        }
        
        return $defines;
    }

    public function definitionsResetPosition(){
        $defines = define::orderBy("position")->get();
        $curr = 0;
        foreach($defines as $define){
            $curr = $curr+1;
            if($define->position!=$curr){
                define::where('id', $define->id)
                ->update([
                    'position' => $curr
                ]);
            }
        }
        
        return $curr;
    }

}
