<?php

namespace App\Repositories;

use App\Models\UserModel;

class UserRepository extends DataTableRepository
{
    public $model;

    public function __construct()
    {
      $this->model = new UserModel();
    }

    public function principals()
    {
       return $this->model->principals();
    }
}
