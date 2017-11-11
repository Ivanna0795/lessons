<?php 

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use \Serverfireteam\Panel\CrudController;

use Illuminate\Http\Request;

class TaskController extends CrudController{

    public function all($entity){
        parent::all($entity); 

			$this->filter = \DataFilter::source(new \App\Task);
			$this->filter->add('id', '№', 'text');
			$this->filter->submit('search');
			$this->filter->reset('reset');
			$this->filter->build();

			$this->grid = \DataGrid::source($this->filter);
			$this->grid->add('task_text', 'Текст завдання');
			$this->grid->add('user_task', 'Вхідні дані');
			$this->grid->add('answer', 'Відповідь');
			$this->grid->add('lesson_id', 'Код уроку');
			$this->addStylesToGrid();
                 
        return $this->returnView();
    }
    
    public function  edit($entity){
        
        parent::edit($entity);
	
			$this->edit = \DataEdit::source(new \App\Task());

			$this->edit->add('task_text', 'Текст завдання','redactor');
			$this->edit->add('user_task', 'Вхідні дані','textarea');
			$this->edit->add('answer', 'Відповідь','textarea');
			$this->edit->add('lesson_id', 'Урок','select')->options(\App\Lesson::lists("Header","id")->all());
        return $this->returnEditView();
    }    
}
