@extends('layouts.admin')

@section('breadcrumbs', Breadcrumbs::render('admin-settings') )

@push('styles')
@endpush

@section('content')
<div class="content mt-3">
    <div class="animated fadeIn">
        <div class="row"> 
            <div class="col-md-12 margin-bottom-1">
                <a href="{{ route('admin.settings.create') }}" class="btn btn-success float-right">{{ _i('Add') }}</a>  
            </div>
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <strong class="card-title"></strong>
                    </div>
                    <div class="card-body">
                        <table class="data-table-custom table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th>{{ _i('Name') }}</th>
                                    <th>{{ _i('Value') }}</th>
                                    <th>{{ _i('Description') }}</th>
                                    <th>{{ _i('Actions') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($settings as $setting)                                      
                                    <tr>
                                        <td>{{ $setting->name }}</td>
                                        <td>{{ $setting->value }}</td>
                                        <td>{{ $setting->description }}</td>
                                        <td>
                                            <a href="{{ route('admin.settings.edit', $setting->id) }}" class="btn btn-warning">
                                                <i class="fas fa-edit"></i>
                                            </a>                                           
                                            
                                            <a href="#" onclick="event.preventDefault();document.getElementById('destroy_settings_form_{{ $setting->id }}').submit();" class="btn btn-danger">
                                                <i class="fa fa-trash"></i>
                                            </a>
                                            {{Form::open(['id'=>'destroy_settings_form_'.$setting->id, 'method'  => 'DELETE', 'route' => ['admin.settings.destroy', $setting->id], 'class'=>"delete-form"])}}
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
    </div><!-- .animated -->
</div><!-- .content -->

@endsection


@push('scripts')
<script>
    (function ($) {
        $('.data-table-custom').DataTable({
            lengthMenu: [[10, 20, 50, -1], [10, 20, 50, "All"]],
        });
    })(jQuery);   
</script>
@endpush