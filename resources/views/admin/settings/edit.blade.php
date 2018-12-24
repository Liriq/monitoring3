@extends('layouts.admin')

@section('breadcrumbs', Breadcrumbs::render('admin-settings-edit', $setting) )

@push('styles')
@endpush

@section('content')
<div class="content mt-3">
    <div class="animated fadeIn">
        <div class="card">
            <div class="card-header">
                <strong>{{ _i('Edit setting') }}</strong>
            </div>
            <div class="card-body card-block">
                 @include('admin.settings._form')                 
            </div>
        </div>
    </div><!-- .animated -->
</div><!-- .content -->
@endsection


@push('scripts')
@endpush