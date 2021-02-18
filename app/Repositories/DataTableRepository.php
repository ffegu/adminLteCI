<?php

namespace App\Repositories;
/**
 * datatable.net repository for better response optimize
 */
use agungsugiarto\boilerplate\Entities\Collection;

class DataTableRepository
{

    public $start, $length, $search, $order, $dir;

    public $model;

    public function init($request, $model) {
      $this->start = $request->getGet("start");
      $this->length = $request->getGet("length");
      $this->search = $request->getGet("search[value]");
      $this->order = $model::ORDERABLE[$request->getGet('order[0][column]')];
      $this->dir = $request->getGet("order[0][dir]");
      $this->model = $model;
    }

    public function collection()
    {

     return Collection::datatable(
           $this->model->getResource($this->search)->orderBy($this->order, $this->dir)
                       ->limit($this->length, $this->start)->get()->getResultObject(),
           $this->model->getResource()->countAllResults(),
           $this->model->getResource($this->search)->countAllResults()
       );
    }

    public function test(){
      print_r('test passed');
    }

}
