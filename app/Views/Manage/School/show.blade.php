@include('load/select2')
@extends('render.index')
@section('content')
  <div class="row">
      <div class="col-md-12">
          <div class="card card-outline card-info">
              <div class="card-header">
                  <div class="float-left">
                      <div class="btn-group">
                          <a href="{{ route_to('school') }}" class="btn btn-sm btn-block btn-secondary">
                            <i class="fas fa-arrow-left">
                            </i>
                          </a>
                      </div>
                  </div>
              </div>
              <div class="card-body">
                  <form action="{{ route_to("school.create") }}" method="post" class="form-horizontal" enctype="multipart/form-data">
                       {!! csrf_field() !!}
                      <div class="form-group row">
                        <div class="col-md-6">
                            @include('components.form.label-input', [
                              'name' => 'name',
                              'type' => 'text',
                              'label' => 'School Name',
                              'icon' => 'school'
                            ])
                        </div>
                          <div class="col-md-6">
                              @include('components.form.label-input', [
                                'name' => 'logo',
                                'type' => 'file',
                                'label' => 'School Logo',
                              ])
                          </div>
                      </div>

                      <div class="form-group row">
                        <div class="col-md-6">
                            @include('components.form.label-input', [
                              'name' => 'user_id',
                              'type' => 'model-select',
                              'label' => 'Select Principal',
                              'icon' => 'chalkboard-teacher',
                              'items' => $principals,
                              'option' => "first_name",
                              'option2' => "last_name"
                            ])
                        </div>
                        <div class="col-md-6">
                            @include('components.form.label-input', [
                              'name' => 'theme_color',
                              'type' => 'text',
                              'label' => 'Theme Color',
                              'icon' => 'palette'
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
