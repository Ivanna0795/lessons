<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Lesson;
use App\Task;
use App\CompletedTask;
use Session;
use Auth;
use Input;

class LessonsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function indexHtml()
    {
		if (Session::has('page')) Session::forget('page');
		$lessons = Lesson::where('HTML_CSS','1')->paginate(10);
		$lessons->load('tasks');
		Session::put('page','html');
		return view('Lessons',['allLessons' => $lessons]);
    }
	
	public function indexCss()
    {
		if (Session::has('page')) Session::forget('page');
		$lessons = Lesson::where('HTML_CSS','2')->paginate(10);
		$lessons->load('tasks');
		Session::put('page','css');
		return view('Lessons',['allLessons' => $lessons]);
    }
	
	public function reviewLesson(Lesson $lesson)
	{
		return view('lesson',['currlesson' => $lesson]);
	}
	
	public function reviewTask(Task $test)
	{
		return view('testingPage',['currtest' => $test]);
	}
	
	public function check()
    {
        $in = Input::all();
		$ans = Task::where('id',$in['id'])->first()->answer;
		if (strnatcasecmp($in['content'],$ans)==0) {
			Session::put('type','BootstrapDialog.TYPE_SUCCESS');
			if(is_null(CompletedTask::where('user_id',Auth::user()->id)->where('task_id',$in['id'])->first()))
			{
				$SuccessAnswer = new CompletedTask;	
				$SuccessAnswer->user_id=Auth::user()->id;	
				$SuccessAnswer->task_id=$in['id'];
				$SuccessAnswer->save();
			} else
			{
				$ReAnswer = CompletedTask::where('user_id',Auth::user()->id)->where('task_id',$in['id'])->first();
				$ReAnswer->touch();
			}
			return redirect("/".Session::get('page')."/")->withSuccess("'Відповідь правильна!'");
		} else {
			Session::put('type','BootstrapDialog.TYPE_DANGER');
			Session::put('repeat','1');
			return redirect("/".Session::get('page')."/")->withSuccess("'Відповідь не правильна!'");
		}
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
