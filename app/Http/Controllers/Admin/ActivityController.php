<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Activity;

class ActivityController extends Controller
{
	public function manageActivity()
	{
		$activity = Activity::get();
		return view('admin.activity.list',compact('activity'));
	}

	public function addActivity(Request $request)
	{
		if(isset($request->id))
        {
            $activity = Activity::find($request->id);
            $output = "update";
        }
        else
        {
		$activity = new Activity;
        $output = "success";
    	}

        $activity->name = $request->name;
        $activity->points = $request->points;
        $activity->save();

	    return redirect()->back()->with('output',$output);
	}
}