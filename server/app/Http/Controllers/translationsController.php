<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\translate;

class translationsController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function translationsSettingSite($id){
        $translates = translate::all();
        $translateEdit = translate::where("id", $id)->first();
        $data = array("translates" => $translates, "translateEdit" => $translateEdit, "id" => $id);
        return view("translates.setting")->with($data);
    }    

    public function translationsSetting(request $request){
        if($request->translate_id == 0){
            return $this->translationsAdd($request);
        } else {
            return $this->translationsEdit($request);
        }
    }

    public function translationsAdd($request){
        $translate = new translate;
        $translate->vietnamese = $request->vietnamese;
        $translate->japanese = $request->japanese;
        $translate->save();
        return redirect("/translations/0");
    }

    public function translationsEdit($request){
        translate::where("id", $request->translate_id)
            ->update([
                "vietnamese" => $request->vietnamese,
                "japanese" => $request->japanese
            ]);
        return redirect("/translations/0");
    }

}
