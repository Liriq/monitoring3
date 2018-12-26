@extends('layouts.admin')

@section('breadcrumbs', Breadcrumbs::render('admin-reports-edit', $report) )

@push('styles')
@endpush

@section('content')
<div class="content mt-3">
    <div class="animated fadeIn">
        <div class="card">
            <div class="card-header">
                <strong>{{ _i('Edit report') }}</strong>
            </div>
            <div class="card-body card-block">
                 @include('admin.reports._form')                 
            </div>
        </div>
    </div><!-- .animated -->
</div><!-- .content -->
@endsection


@push('scripts')
@endpush