@extends('layouts.frontend')

@section('breadcrumbs', Breadcrumbs::render('frontend-reports') )

@push('styles')
<style type="text/css">
    #google-map {
        height: 800px;
        width: 1200px;
        margin-top: 2%;
    }
</style>
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
    </div><!-- .animated -->
</div><!-- .content -->
@endsection


@push('scripts')
    <script> 
        var areas = {!! $areas->isNotEmpty() ? $areas->toJson() : json_encode([])  !!}; 
        var usersWithCompletedReports = {!! $usersWithCompletedReports->isNotEmpty() ? $usersWithCompletedReports->toJson() : json_encode([])  !!};
        var latitude = {!! 49.5510679 !!};
        var zoom = {!! 6 !!};
    </script>
    <script type="text/javascript" src="//maps.googleapis.com/maps/api/js?v=3.34&key={{ ENV('GOOGLE_API_KEY') }}"></script>
    <script src="/js/admin/reports-list.js" ></script>
@endpush