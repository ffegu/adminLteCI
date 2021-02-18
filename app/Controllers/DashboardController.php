<?php

namespace App\Controllers;
use App\Repositories\SchoolRepository;
use App\Repositories\StudentRepository;
use App\Models\UserModel;

/**
 * Class DashboardController.
 */
class DashboardController extends BaseController
{
    public function index()
    {
        $data = [
            'title' => 'Dashboard',
            'schools' => (new SchoolRepository())->total(),
            'students' => (new StudentRepository())->total(),
            'users' => (new UserModel())->countAll()
        ];
        return $this->render('dashboard', $data);
    }
}
