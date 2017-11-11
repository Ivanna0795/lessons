<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
use App\Http\Requests;
use Auth;
use App\CompletedTask;
use App\Task;
use App\Lesson;

class CabinetController extends Controller
{

    public function getCompletedByType($type)
    {
        $UserCompTaskCompleted = CompletedTask::where('user_id', Auth::user()->id)->get();
        $array = array();
        foreach ($UserCompTaskCompleted as $utc)
            $array[] = $utc->task_id;
        $TasksNames = Task::whereIn('id', $array)->get();
        $TasksNames->load('lessonType');
        $i = 0;
        foreach ($TasksNames as $t) {
            if ($t->lessonType->HTML_CSS == $type) $i++;
        }
        return $i;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $UserCompTaskCompleted = CompletedTask::where('user_id', Auth::user()->id)->get();
        $array = array();
        foreach ($UserCompTaskCompleted as $utc)
            $array[] = $utc->task_id;
        $TasksNames = Task::whereIn('id', $array)->get();
        $TasksNames->load('lessonType');

        if (self::getCompletedByType('1') == (Session::get('HTML_TASK_COUNT') - 1)) {
            $html_lessons = Lesson::where('HTML_CSS', '1')->get();
        } else $html_lessons = Lesson::where('HTML_CSS', '1')->where('id', '!=', Lesson::where('HTML_CSS', '1')->orderBy('id', 'desc')->first()->id)->get();

        $html_lessons->load('tasks');

        if (self::getCompletedByType('2') == (Session::get('CSS_TASK_COUNT') - 1)) {
            $css_lessons = Lesson::where('HTML_CSS', '2')->get();
        } else $css_lessons = Lesson::where('HTML_CSS', '2')->where('id', '!=', Lesson::where('HTML_CSS', '2')->orderBy('id', 'desc')->first()->id)->get();
        $css_lessons->load('tasks');


        return view('cabinet', ['completed' => $TasksNames, 'html_lessons' => $html_lessons, 'css_lessons' => $css_lessons, 'completed_tasks_ids' => $array]);
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
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
