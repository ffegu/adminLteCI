<?php

namespace App\Controllers;

use App\Repositories\SchoolRepository;
use App\Repositories\StudentRepository;

class StudentController extends BaseController
{

	public function __construct()
	{
	    $this->repo = new StudentRepository();
	}

	public function index()
	{
		if ($this->request->isAJAX()) {
			 return $this->respond($this->repo->all($this->request));
		}
		 return $this->render('Manage.Student.index', [
			  'title'     => 'Student | Manage',
				'table_id'  => 'table-student',
				'url'       => 'student'
		 ]);
	}

	public function show()
	{
		return $this->render('Manage.Student.show', [
			 'title'     => 'Student | Manage',
			 'schools' => (array) (new SchoolRepository())->schools()
		]);
	}

	public function create()
	{
		if (!$this->validate([
	  		'first_name' => 'required',
				'email' => 'required|is_unique[users.email]',
				'last_name' => 'required',
				'student_code' => 'required|is_unique[users.student_code]',
				'father_name' => 'required',
				'father_mobile' => 'required',
			  'school_id' => 'required',
				'username'     => 'required|is_unique[users.username]',
				'password'     => 'required',
				'pass_confirm' => 'required|matches[password]',
			])) {
			 return redirect()->back()->withInput()
												 ->with('error', $this->validator->getErrors());
		}
		$this->repo->create($this->request);
		return redirect()->to(route_to('student'));
	}

}
