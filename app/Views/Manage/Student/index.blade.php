@include('load/datatables')
@extends('render.index')
@section('content')
  <div class="card card-default">
    <div class="card-header">
        <div class="card-tools">
            <div class="btn-group">
                <a href="{{ route_to('student.new') }}"
                   class="btn btn-sm btn-block btn-primary">
                   <i class="fa fa-plus"></i>
                   add school
                </a>
            </div>
        </div>
    </div>
      <div class="card-body">
          <div class="row">
              <div class="col-md-12">
                  <div class="table-responsive">
                      <table id="{{ $table_id }}" class="table table-striped table-hover va-middle">
                          <thead>
                              <tr>
                                  <th>#</th>
                                  <th>First Name</th>
                                  <th>Last Name</th>
                                  <th>School Name</th>
                                  <th>Student Code</th>
                                  <th>Father's Name</th>
                                  <th>Father's Mobile</th>
                                  <th>Added Date</th>
                                  <th>Actions</th>
                              </tr>
                          </thead>
                          <tbody>
                          </tbody>
                      </table>
                  </div>
              </div>
          </div>
      </div>
  </div>
@endsection
@section('js')
  <script>
      var tableUser = $('#{{ $table_id }}').DataTable({
          processing: true,
          serverSide: true,
          autoWidth: false,
          order: [[1, 'asc']],

          ajax: {
              url: '{{ route_to($url) }}',
              method: 'GET'
          },
          columnDefs: [{
              orderable: false,
              targets: [1]
          }],
          columns: [
            { 'data' : null },
            { 'data' :  'first_name' },
            { 'data' :  'last_name' },
            { 'data' :  'name' },
            { 'data' :  'student_code' },
            { 'data' :  'father_name' },
            { 'data' :  'father_mobile' },
            { 'data' :  'created_at' },
            { "data" : function(data){
              return `@include('Manage.Student.actions')`
            } }
          ]
      });

      tableUser.on('draw.dt', function() {
          var PageInfo = $('#{{ $table_id }}').DataTable().page.info();
          tableUser.column(0, {
              page: 'current'
          }).nodes().each(function(cell, i) {
              cell.innerHTML = i + 1 + PageInfo.start;
          });
      });

      $(document).on('click', '.btn-delete', function(e) {
          Swal.fire({
                  title: '{{ lang('boilerplate.global.sweet.title') }}',
                  text: "{{ lang('boilerplate.global.sweet.text') }}",
                  icon: 'warning',
                  showCancelButton: true,
                  confirmButtonColor: '#3085d6',
                  cancelButtonColor: '#d33',
                  confirmButtonText: '{{ lang('boilerplate.global.sweet.confirm_delete') }}'
              })
              .then((result) => {
                  if (result.value) {
                      $.ajax({
                          url: `{{ route_to('admin/user/manage') }}/${$(this).attr('data-id')}`,
                          method: 'DELETE',
                      }).done((data, textStatus, jqXHR) => {
                          Toast.fire({
                              icon: 'success',
                              title: jqXHR.statusText,
                          });
                          tableUser.ajax.reload();
                      }).fail((error) => {
                          Toast.fire({
                              icon: 'error',
                              title: error.responseJSON.messages.error,
                          });
                      })
                  }
              })
      });

      tableUser.on('order.dt search.dt', () => {
          tableUser.column(0, {
              search: 'applied',
              order: 'applied'
          }).nodes().each(function(cell, i) {
              cell.innerHTML = i + 1;
          });
      }).draw();
  </script>
@endsection
