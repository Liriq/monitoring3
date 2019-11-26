@extends('layouts.admin')

@section('breadcrumbs', Breadcrumbs::render('admin-templates-create') )

@push('styles')
    <link href="{{ asset('css/admin/bootstrap-colorpicker.min.css') }}" rel="stylesheet">
@endpush

@section('content')
<div class="content mt-3">
    <div class="animated fadeIn">
        <div class="card">
            <div class="card-header">
                <strong>{{ _i('Create template') }}</strong>
            </div>
            <div id="template-block" class="card-body card-block">
                 @include('admin.templates._form')
            </div>
        </div>
    </div><!-- .animated -->
</div><!-- .content -->
@endsection


@push('scripts')
    <script src="/js/admin/bootstrap-colorpicker.min.js" ></script>
@endpush
