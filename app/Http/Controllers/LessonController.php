<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use \Serverfireteam\Panel\CrudController;

use Illuminate\Http\Request;
use App\Lesson;
use App\Task;
use App\CompletedTask;
use Session;
use Auth;
use Input;

class LessonController extends CrudController
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


    public function indexHtml()
    {
        if (Session::has('page')) Session::forget('page');
        if (LessonController::getCompletedByType('1') == (Session::get('HTML_TASK_COUNT') - 1)) {
            $lessons = Lesson::where('HTML_CSS', '1')->paginate(10);
        } else $lessons = Lesson::where('HTML_CSS', '1')->where('id', '!=', Lesson::where('HTML_CSS', '1')->orderBy('id', 'desc')->first()->id)->paginate(10);
        $lessons->load('tasks');
        Session::put('page', 'html');
        return view('Lessons', ['allLessons' => $lessons]);
    }

    public function indexCss()
    {
        if (Session::has('page')) Session::forget('page');
        if (LessonController::getCompletedByType('2') == (Session::get('CSS_TASK_COUNT') - 1)) {
            $lessons = Lesson::where('HTML_CSS', '2')->paginate(10);
        } else $lessons = Lesson::where('HTML_CSS', '2')->where('id', '!=', Lesson::where('HTML_CSS', '2')->orderBy('id', 'desc')->first()->id)->paginate(10);
        $lessons->load('tasks');
        Session::put('page', 'css');
        return view('Lessons', ['allLessons' => $lessons]);
    }

    public function reviewLesson(Lesson $lesson)
    {
        return view('lesson', ['currlesson' => $lesson]);
    }

    public function reviewTask(Task $test)
    {
        return view('testingPage', ['currtest' => $test]);
    }

    public function check()
    {
        $in = Input::all();
        $ans = Task::where('id', $in['id'])->first()->answer;
        if (strnatcasecmp($in['content'], $ans) == 0) {
            Session::put('type', 'BootstrapDialog.TYPE_SUCCESS');
            if (is_null(CompletedTask::where('user_id', Auth::user()->id)->where('task_id', $in['id'])->first())) {
                $SuccessAnswer = new CompletedTask;
                $SuccessAnswer->user_id = Auth::user()->id;
                $SuccessAnswer->task_id = $in['id'];
                $SuccessAnswer->save();
            } else {
                $ReAnswer = CompletedTask::where('user_id', Auth::user()->id)->where('task_id', $in['id'])->first();
                $ReAnswer->touch();
            }
            return redirect("/" . Session::get('page') . "/")->withSuccess("'Відповідь правильна!'");
        } else {
            Session::put('type', 'BootstrapDialog.TYPE_DANGER');
            Session::put('repeat', '1');
            return redirect("/" . Session::get('page') . "/")->withSuccess("'Відповідь не правильна!'");
        }
    }

    public function all($entity)
    {
        parent::all($entity);

        $this->filter = \DataFilter::source(new \App\Lesson);
        $this->filter->add('Header', 'Header', 'text');
        $this->filter->submit('search');
        $this->filter->reset('reset');
        $this->filter->build();

        $this->grid = \DataGrid::source($this->filter);
        $this->grid->add('id', 'Код уроку');
        $this->grid->add('Header', 'Назва');
        $this->grid->add('about_article', 'Короткий опис');
        $this->grid->add('article', 'Текст уроку');
        $this->grid->add('HTML_CSS', 'Тип');
        $this->grid->add('created_at', 'Час створення');
        $this->addStylesToGrid();

        return $this->returnView();
    }

    public function edit($entity)
    {

        parent::edit($entity);

        $this->edit = \DataEdit::source(new \App\Lesson());

        $this->edit->label('Редагувати урок');

        $this->edit->add('Header', 'Назва', 'text');
        $this->edit->add('about_article', 'Короткий опис', 'text');
        $this->edit->add('article', 'Текст уроку', 'redactor');
        $this->edit->add('HTML_CSS', 'Тип', 'text');

        return $this->returnEditView();
    }
}
