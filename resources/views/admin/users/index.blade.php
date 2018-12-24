@extends('layouts.admin')

@push('styles')
@endpush

@section('content')
<div class="content mt-3">
    <div class="animated fadeIn">
        <div class="row">
            <div class="col-md-12">
                <a href="{{ route('admin.users.create') }}" class="btn btn-success float-right">{{ _i('Add') }}</a>      
                <nav>
                  <div class="nav nav-tabs" id="nav-tab" role="tablist">
                    <a class="nav-item nav-link active" id="nav-employees-tab" data-toggle="tab" href="#nav-employees" role="tab" aria-controls="nav-home" aria-selected="true">
                        <i class="fas fa-user-tie"></i> {{ _i('Employees') }}
                    </a>
                    <a class="nav-item nav-link" id="nav-admins-tab" data-toggle="tab" href="#nav-admins" role="tab" aria-controls="nav-profile" aria-selected="false">
                        <i class="fas fa-user-cog"></i> {{ _i('Admins') }}
                    </a>            
                  </div>
                </nav>
                <div class="tab-content" id="nav-tabContent">
                    <div class="tab-pane fade show active" id="nav-employees" role="tabpanel" aria-labelledby="nav-employees-tab">
                      <div class="card">
                          <div class="card-header">
                              <strong class="card-title"></strong>
                          </div>
                          <div class="card-body">
                              <table class="data-table-custom table table-striped table-bordered">
                                  <thead>
                                      <tr>
                                          <th>{{ _i('Name') }}</th>
                                          <th>{{ _i('Role') }}</th>
                                          <th>{{ _i('Actions') }}</th>
                                      </tr>
                                  </thead>
                                  <tbody>
                                      @foreach($employees as $employee)                                      
                                          <tr>
                                              <td>{{ $employee->name }}</td>
                                              <td>{{ $employee->roles->pluck('name') }}</td>
                                              <td>
                                                  <a href="{{ route('admin.users.edit', $employee->id) }}" class="btn btn-warning">
                                                      <i class="fas fa-edit"></i>
                                                  </a>
                                                  
                                                  
                                                  <a href="#" onclick="event.preventDefault();document.getElementById('destroy_users_form_{{ $employee->id }}').submit();" class="btn btn-danger">
                                                      <i class="fa fa-trash"></i>
                                                  </a>
                                                  {{Form::open(['id'=>'destroy_users_form_'.$employee->id, 'method'  => 'DELETE', 'route' => ['admin.users.destroy', $employee->id], 'class'=>"delete-form"])}}
                                                  {{ Form::close() }}  
                                              </td>
                                          </tr>                                      
                                      @endforeach
                                  </tbody>
                              </table>
                          </div>
                      </div>                 
                    </div>
                  <div class="tab-pane fade" id="nav-admins" role="tabpanel" aria-labelledby="nav-admins-tab">        
                      <div class="card">
                          <div class="card-header">
                              <strong class="card-title"></strong>
                          </div>
                          <div class="card-body">
                              <table class="data-table-custom table table-striped table-bordered">
                                  <thead>
                                      <tr>
                                          <th>{{ _i('Name') }}</th>
                                          <th>{{ _i('Role') }}</th>
                                          <th>{{ _i('Actions') }}</th>
                                      </tr>
                                  </thead>
                                  <tbody>
                                      @foreach($admins as $admin)                                      
                                          <tr>
                                              <td>{{ $admin->name }}</td>
                                              <td>{{ $admin->roles->pluck('name') }}</td>
                                              <td>                                                  
                                                  <a href="{{ route('admin.users.edit', $admin->id) }}" class="btn btn-warning">
                                                      <i class="fas fa-edit"></i>
                                                  </a>
                                                  
                                                  <a href="#" onclick="event.preventDefault();document.getElementById('destroy_users_form_{{ $admin->id }}').submit();" class="btn btn-danger">
                                                      <i class="fa fa-trash"></i>
                                                  </a>
                                                  {{Form::open(['id'=>'destroy_users_form_'.$admin->id, 'method'  => 'DELETE', 'route' => ['admin.users.destroy', $admin->id], 'class'=>"delete-form"])}}
                                                  {{ Form::close() }}                                                 
                                              </td>
                                          </tr>                                      
                                      @endforeach
                                  </tbody>
                              </table>
                          </div>
                      </div>               
                  </div>
                </div>        
            </div>
        </div> 
    </div><!-- .animated -->
</div><!-- .content -->
@endsection


@push('scripts')
<script>
    (function ($) {
        $('.data-table-custom').DataTable({
            lengthMenu: [[10, 20, 50, -1], [10, 20, 50, "All"]],
        });
        
       $(".delete-form").on("submit", function(){
           return confirm('{{ _i("Are you sure?") }}');
       }); 
    })(jQuery);   
</script>
@endpush