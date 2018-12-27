@extends('layouts.admin')

@section('breadcrumbs', Breadcrumbs::render('admin-reports-create') )

@push('styles')
@endpush

@section('content')
<div class="content mt-3">
    <div class="animated fadeIn">
        <div class="card">
            <div class="card-header">
                <strong>{{ _i('Create report') }}</strong>
            </div>
            <div class="card-body card-block" id="report-form-block">
                 @include('admin.reports._form')                 
            </div>
        </div>
    </div><!-- .animated -->
</div><!-- .content -->
@endsection


@push('scripts')
@endpush