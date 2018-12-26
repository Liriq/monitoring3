@extends('layouts.admin')

@section('breadcrumbs', Breadcrumbs::render('admin-templates-edit', $template) )

@push('styles')
@endpush

@section('content')
<div class="content mt-3">
    <div class="animated fadeIn">
        <div class="card">
            <div class="card-header">
                <strong>{{ _i('Edit template') }}</strong>
            </div>
            <div id="template-block" class="card-body card-block">
                 @include('admin.templates._form')                 
            </div>
        </div>
    </div><!-- .animated -->
</div><!-- .content -->
@endsection


@push('scripts')
@endpush