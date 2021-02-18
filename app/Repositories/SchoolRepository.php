<?php

namespace App\Repositories;

/**
* repository for SchoolModel for better code maintainence
*/

use App\Models\SchoolModel;

class SchoolRepository extends DataTableRepository
{

     public $model;

     public function __construct()
     {
         $this->model = new SchoolModel();
     }

     public function all($request){
        $this->init($request, $this->model);
        $collection  = $this->collection();
        return $collection;
     }

     public function create($request)
     {
        $logo = $request->getFile("logo");

        //here we are validating logo, todo - make redirect if error
        if ($logo->isValid()) {
          $newName = $logo->getRandomName();
          $path = ROOTPATH.'public/uploads/schools/logo/';
          $logo->move($path, $newName);
        }

        $this->model->insert([
           'name' => $request->getPost('name'),
           'user_id' => $request->getPost('user_id'),
           'logo' => 'uploads/schools/logo/'.$newName,
           'theme_color' => $request->getPost('theme_color'),
        ]);
        //can write more validation for insert data is really happnded or not
       return true;
     }

     public function schools()
     {
        return $this->model->schools(1);
     }

     public function total()
     {
       return $this->model->countAll();
     }


}
