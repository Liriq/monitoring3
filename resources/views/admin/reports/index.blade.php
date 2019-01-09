@extends('layouts.admin')

@section('breadcrumbs', Breadcrumbs::render('admin-reports') )

@push('styles')
@endpush

@section('content')
<div class="content mt-3">
    <div class="animated fadeIn">
        <div class="row">
            <div id="map-reports">
                <div class="col-md-12">
                    <div class="card">  
                        <div class="card-header">
                            <strong class="card-title">{{ _i("Deadline Reporting") . ': ' . $finish->format('d-m-Y') }}</strong>
                        </div>                        
                        <div class="card-body">              
                            <div id="google-map">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>    
        <div class="row"> 
            <div class="col-md-12 margin-bottom-1">
                <a href="{{ route('admin.reports.create') }}" class="btn btn-success float-right">{{ _i('Add') }}</a>  
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
                                    <th>{{ _i('ID') }}</th>
                                    <th>{{ _i('Name') }}</th>
                                    <th>{{ _i('Employee') }}</th>
                                    <th>{{ _i('Published at') }}</th>
                                    <th>{{ _i('Actions') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($reports as $report)                                      
                                    <tr>
                                        <td>{{ $report->id }}</td>
                                        <td>{{ $report->name }}</td>
                                        <td>{{ $report->user->fullName }}</td>
                                        <td>{{ $report->published_at }}</td>
                                        <td>
                                            <a href="{{ route('admin.reports.edit', $report->id) }}" class="btn btn-warning">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            
                                            
                                            <a href="#" onclick="event.preventDefault();document.getElementById('destroy_reports_form_{{ $report->id }}').submit();" class="btn btn-danger">
                                                <i class="fa fa-trash"></i>
                                            </a>
                                            {{Form::open(['id'=>'destroy_reports_form_'.$report->id, 'method'  => 'DELETE', 'route' => ['admin.reports.destroy', $report->id], 'class'=>"delete-form"])}}
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
        var areas = {!! $areas->isNotEmpty() ? $areas->toJson() : json_encode([])  !!}; 
        var usersWithCompletedReports = {!! $usersWithCompletedReports->isNotEmpty() ? $usersWithCompletedReports->toJson() : json_encode([])  !!};
    </script>
    <script type="text/javascript" src="//maps.googleapis.com/maps/api/js?v=3.34&key={{ ENV('GOOGLE_API_KEY') }}"></script>
    <script src="/js/admin/reports-list.js" ></script>
@endpush