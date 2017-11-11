<?php 

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use \Serverfireteam\Panel\CrudController;

use Illuminate\Http\Request;
use App\AboutPage;
class AboutPageController extends CrudController{

	
	public function index()
    {
        $content = AboutPage::first();
		return view('aboutpage',['about'=>$content]);
    }
	
    public function all($entity){
        parent::all($entity); 

			$this->filter = \DataFilter::source(new \App\AboutPage);


			$this->grid = \DataGrid::source($this->filter);
			$this->grid->add('header', 'Заголовок');
			$this->grid->add('content', 'Тіло сторінки');
			$this->addStylesToGrid();
                 
        return $this->returnView();
    }
    
    public function  edit($entity){
        
        parent::edit($entity);

			$this->edit = \DataEdit::source(new \App\AboutPage());

			$this->edit->label('Edit Category');

			$this->edit->add('header', 'Заголовок', 'text');
		
			$this->edit->add('content', 'Тіло сторінки', 'redactor');
        return $this->returnEditView();
    }    
}
