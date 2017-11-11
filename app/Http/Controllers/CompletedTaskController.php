<?php 

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use \Serverfireteam\Panel\CrudController;

use Illuminate\Http\Request;

class CompletedTaskController extends CrudController{

    public function all($entity){
        parent::all($entity); 
			$this->filter = \DataFilter::source(new \App\CompletedTask);
			$this->filter->add('user_id', 'Код користувача', 'text');
			$this->filter->add('task_id', 'Код завдання', 'text');
			$this->filter->submit('search');
			$this->filter->reset('reset');
			$this->filter->build();

			$this->grid = \DataGrid::source($this->filter);
			$this->grid->add('user_id', 'Код користувача');
			$this->grid->add('task_id', 'Код завдання');
			$this->addStylesToGrid();
      
        return $this->returnView();
    }
    
    public function  edit($entity){
        
        parent::edit($entity);

        /* Simple code of  edit part , List of all fields here : http://laravelpanel.com/docs/master/crud-fields
	
			$this->edit = \DataEdit::source(new \App\Category());

			$this->edit->label('Edit Category');

			$this->edit->add('name', 'Name', 'text');
		
			$this->edit->add('code', 'Code', 'text')->rule('required');


        */
       
        return $this->returnEditView();
    }    
}
