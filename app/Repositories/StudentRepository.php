<?php

namespace App\Repositories;

use App\Models\UserModel;
use agungsugiarto\boilerplate\Entities\Collection;
use App\Entities\User;

class StudentRepository extends DataTableRepository
{
   public $model;

   public function __construct()
   {
      $this->model = new UserModel();
   }

   public function all($request)
   {
     $this->init($request, $this->model);
     $collection  = $this->principalCollection();
     return $collection;
   }

   public function principalCollection()
   {

    return Collection::datatable(
          $this->model->getPrincipals($this->search)->orderBy($this->order, $this->dir)
                      ->limit($this->length, $this->start)->get()->getResultObject(),
          $this->model->getPrincipals()->countAllResults(),
          $this->model->getPrincipals($this->search)->countAllResults()
      );
   }

   public function create($request)
   {
     //can do more validation to make the insertion sure
     //btw no worries our model is also validating as well
     //TODO - add school student counting in schools table

        return $insert = $this->model->insert(new User([
            'first_name' => $request->getPost('first_name'),
            'last_name' => $request->getPost('last_name'),
            'email' => $request->getPost('email'),
            'student_code' => $request->getPost('student_code'),
            'school_id' => $request->getPost('school_id'),
            'father_name' => $request->getPost('father_name'),
            'father_mobile' => $request->getPost('father_mobile'),
            'username' => $request->getPost('username'),
            'password' => $request->getPost('password'),
            'active'   => 1,
         ]));
   }

   public function total()
   {
     //returns total users
      return $this->model->countAll();
   }
}
