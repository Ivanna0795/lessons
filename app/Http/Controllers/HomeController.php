<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;
use App\Task;
use App\Lesson;
use Session;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
		$HtmlTaskCount = 0;
		$CssTaskCount  = 0;
		$AllTest = Task::get();
		$AllTest->load('lessonType');
		foreach($AllTest as $at)
		{
			if ($at->lessonType->HTML_CSS == 1) $HtmlTaskCount++;
			if ($at->lessonType->HTML_CSS == 2) $CssTaskCount++;
		}
		Session::put('HTML_TASK_COUNT',$HtmlTaskCount);
		Session::put('CSS_TASK_COUNT',$CssTaskCount);
        return view('welcome');
    }
}
