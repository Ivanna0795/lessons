<?php 

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use \Serverfireteam\Panel\CrudController;

use Illuminate\Http\Request;

class UserController extends CrudController{

    public function all($entity){
        parent::all($entity); 


			$this->filter = \DataFilter::source(new \App\User);
			$this->filter->add('name', 'Ім\'я', 'text');
			$this->filter->add('email', 'E-mail', 'text');
			$this->filter->add('created_at', 'Зареєстровано', 'date');
			$this->filter->submit('search');
			$this->filter->reset('reset');
			$this->filter->build();

			$this->grid = \DataGrid::source($this->filter);
			$this->grid->add('name', 'Ім\'я', 'text');
			$this->grid->add('email', 'E-mail', 'text');
			$this->grid->add('created_at', 'Зареєстровано', 'date');
			$this->addStylesToGrid();

                 
        return $this->returnView();
    }
    
    public function  edit($entity){
        
        parent::edit($entity);
			$this->edit = \DataEdit::source(new \App\User());

			$this->edit->label('Edit User');

			$this->edit->add('name', 'Name', 'text');
			$this->edit->add('email', 'E-mail', 'text');
			$this->edit->add('password', 'Password', 'password');
       
        return $this->returnEditView();
    }    
}
