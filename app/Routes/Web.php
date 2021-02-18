<?php

$routes->setDefaultNamespace('App\Controllers');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
$routes->setAutoRoute(true);


$routes->group('manage', function($routes){
      $routes->get('school', 'SchoolController::index', ['as'=>'school', 'filter'=>'permission:view-school']);
      $routes->get('school/new', 'SchoolController::show',['as'=>'school.new', 'filter'=>'permission:add-school']);
      $routes->post('school/create', 'SchoolController::create',['as'=>'school.create', 'filter'=>'permission:add-school']);
      $routes->post('school/delete', 'SchoolController::delete',['as'=>'school.delete', 'filter'=>'permission:delete-school']);


      $routes->get('student', 'StudentController::index', ['as'=>'student', 'filter'=>'permission:view-student']);
      $routes->get('student/new', 'StudentController::show',['as'=>'student.new', 'filter'=>'permission:add-student']);
      $routes->post('student/create', 'StudentController::create',['as'=>'student.create', 'filter'=>'permission:add-student']);
      $routes->get('student/:id/edit', 'StudentController::edit',['as'=>'student.edit', 'filter'=>'permission:edit-student']);
      $routes->post('student/delete', 'StudentController::delete',['as'=>'student.delete', 'filter'=>'permission:delete-student']);

});
