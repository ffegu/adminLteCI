<?php

namespace App\Controllers;

use App\Repositories\UserRepository;
use App\Repositories\SchoolRepository;
use App\Models\SchoolModel;
use CodeIgniter\API\ResponseTrait;

class SchoolController extends BaseController
{
	use ResponseTrait;

	/** @var SchoolRepository */
	protected $repo, $model;

	public function __construct()
	{
			$this->repo = new SchoolRepository();
			$this->model = new SchoolModel();
	}

	public function index()
	{
		if ($this->request->isAJAX()) {
  	   return $this->respond($this->repo->all($this->request));
		}
	 return $this->render('Manage.School.index', [
			'title' => 'School | Manage',
			'table_id' => "table-school",
			'url' => "school",
		]);
	}

	public function show(){
	  	return $this->render('Manage.School.show', [
				'title' => 'Create Shcool',
				'principals' => (array) (new UserRepository())->principals()
			]);
	}

	public function create()
	{
			if (!$this->validate($this->model->validationRules)) {
				 return redirect()->back()->withInput()
													 ->with('error', $this->validator->getErrors());
			}
	    $this->repo->create($this->request);
			return redirect()->to(route_to('school'));
	}

}
