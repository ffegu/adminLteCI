@include('load/select2')
@extends('render.index')
@section('content')
  <div class="row">
      <div class="col-md-12">
          <div class="card card-outline card-info">
              <div class="card-header">
                  <div class="float-left">
                      <div class="btn-group">
                          <a href="{{ route_to('student') }}" class="btn btn-sm btn-block btn-secondary">
                            <i class="fas fa-arrow-left">
                            </i>
                          </a>
                      </div>
                  </div>
              </div>
              <div class="card-body">
                  <form action="{{ route_to("student.create") }}" method="post" class="form-horizontal" enctype="multipart/form-data">
                       {!! csrf_field() !!}
                      <div class="form-group row">
                        <div class="col-md-6">
                            @include('components.form.label-input', [
                              'name' => 'first_name',
                              'type' => 'text',
                              'label' => 'First Name',
                              'icon' => 'user',
                              'required' => true
                            ])
                        </div>
                        <div class="col-md-6">
                            @include('components.form.label-input', [
                              'name' => 'last_name',
                              'type' => 'text',
                              'label' => 'Last Name',
                              'icon' => 'user',
                              'required' => true,
                            ])
                        </div>
                      </div>

                      <div class="form-group row">
                        <div class="col-md-6">
                            @include('components.form.label-input', [
                              'name' => 'email',
                              'type' => 'email',
                              'label' => 'Student Email',
                              'icon' => 'envelope',
                              'required' => true
                            ])
                        </div>
                        <div class="col-md-6">
                            @include('components.form.label-input', [
                              'name' => 'student_code',
                              'required' => true,
                              'type' => 'text',
                              'label' => 'Student Code',
                              'icon' => 'code'
                            ])
                        </div>
                      </div>

                      <div class="form-group row">
                        <div class="col-md-6">
                            @include('components.form.label-input', [
                              'name' => 'father_name',
                              'required' => true,
                              'type' => 'text',
                              'label' => "Father's Name",
                              'icon' => 'user'
                            ])
                        </div>
                        <div class="col-md-6">
                            @include('components.form.label-input', [
                              'name' => 'father_mobile',
                              'required' => true,
                              'type' => 'text',
                              'label' => "Father's Mobile",
                              'icon' => 'phone'
                            ])
                        </div>
                      </div>

                      <div class="form-group row">
                        <div class="col-md-6">
                            @include('components.form.label-input', [
                              'name' => 'school_id',
                              'required' => true,
                              'type' => 'model-select',
                              'label' => "School",
                              'icon' => 'school',
                              'items' => $schools,
                              'option' => 'name'
                            ])
                        </div>
                        <div class="col-md-6">
                            @include('components.form.label-input', [
                              'name' => 'username',
                              'required' => true,
                              'type' => 'text',
                              'label' => "Username",
                              'icon' => 'user',
                            ])
                        </div>
                      </div>

                      <div class="form-group row">
                        <div class="col-md-6">
                          @include('components.form.label-input', [
                            'name' => 'password',
                            'required' => true,
                            'type' => 'password',
                            'label' => "Password",
                            'icon' => 'key'
                          ])
                        </div>
                        <div class="col-md-6">
                          @include('components.form.label-input', [
                            'name' => 'pass_confirm',
                            'required' => true,
                            'type' => 'password',
                            'label' => "Password Confirmation",
                            'icon' => 'key'
                          ])
                        </div>
                      </div>

                      @include('components.buttons.submit', ['name' => 'create'])
                  </form>
              </div>
          </div>
      </div>
  </div>
@endsection
