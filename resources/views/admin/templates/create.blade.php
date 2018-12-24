@extends('layouts.admin')

@section('breadcrumbs', Breadcrumbs::render('admin-templates-create') )

@push('styles')
@endpush

@section('content')
<div class="content mt-3">
    <div class="animated fadeIn">
        <div class="card">
            <div class="card-header">
                <strong>{{ _i('Create template') }}</strong>
            </div>
            <div class="card-body card-block">
                 @include('admin.templates._form')                 
            </div>
        </div>
    </div><!-- .animated -->
</div><!-- .content -->
@endsection


@push('scripts')
@endpush