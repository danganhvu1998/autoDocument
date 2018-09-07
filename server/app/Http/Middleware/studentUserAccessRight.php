<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use App\studentControlList;


class studentUserAccessRight
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if(Auth::user()->level>=99) return $next($request);
        if(isset($request->id)){
            $STID = $request->id;
        } else if(isset($request->student_id)){
            $STID = $request->student_id;
        } else if(isset($request->studentID)){
            $STID = $request->studentID;
        } else {
            return redirect("/home");
        }
        if(studentControlList::where("user_id", Auth::user()->id)
            ->where("student_id", $STID)
            ->first() != null){
            return $next($request);
        }
        return redirect("/students");
    }
}
