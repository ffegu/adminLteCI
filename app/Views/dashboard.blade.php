@extends('render.index')
<!-- Section content -->
@section('content')
  <div class="row">
     <div class="col-md-3 info-box text-center">
           <span class="info-box-icon bg-blue">
             <i class="fas fa-school"></i>
           </span>
           <div class="info-box-content">
             <span class="info-box-text">Schools</span>
             <span class="info-box-number">{{ $schools }}</span>
           </div>
     </div>

     <div class="col-md-3 info-box text-center">
           <span class="info-box-icon bg-yellow">
             <i class="fas fa-user-graduate"></i>
           </span>
           <div class="info-box-content">
             <span class="info-box-text">Students</span>
             <span class="info-box-number">{{ $students }}</span>
           </div>
     </div>

     <div class="col-md-3 info-box text-center">
           <span class="info-box-icon bg-yellow">
             <i class="fas fa-users"></i>
           </span>
           <div class="info-box-content">
             <span class="info-box-text">Users</span>
             <span class="info-box-number">{{ $users }}</span>
           </div>
     </div>

  </div>
@endsection
