@extends('layouts.admin')

@section('breadcrumbs', Breadcrumbs::render('dashboard-reports-create') )

@push('styles')
@endpush

@section('content')
<div class="content mt-3">
    <div class="animated fadeIn">
        <div class="card">
            <div class="card-header">
                <strong>{{ _i('Create report') }}</strong>
            </div>
            <div class="card-body card-block">
                {{ Form::model($report, ['route' => ['dashboard.reports.store'], 'class' => 'form-horizontal form-label-left', 'id' => 'reports-form', 'enctype' => 'multipart/form-data']) }}   
                        @method(!empty($report->id)? 'PUT' : 'POST')  
                        
                        <div class="row form-group">
                            <div class="col col-md-3">
                                {{ Form::label('published_at', _i('Published at'), ['class' => 'form-control-label']) }}
                            </div>
                            <div class="col-12 col-md-9">
                                {{ Form::date("published_at", $report->published_at, ["class" => "form-control ", 'required' => 'required']) }}
                            </div>
                        </div>
                        
                        <div id="questions-block" >
                            @foreach($questions as $question)
                                <hr/>
                                <div class="form-group">
                                    <b>№{{ $loop->iteration }}</b>
                                    {{ Form::hidden("answers[{$loop->iteration}][question_id]", $question->id) }}
                                </div>
                                
                                <div class="row form-group">
                                    <div class="col col-md-3">
                                        {{ Form::label("answers[{$loop->iteration}][question]", _i('Question'), ['class' => 'form-control-label']) }}
                                    </div>
                                    <div class="col-12 col-md-9">
                                        {{ Form::text("answers[{$loop->iteration}][question]", $question->question, ["class" => "form-control", 'placeholder' => _i('Question'), 'disabled' => true]) }}
                                    </div>
                                </div>
                                
                                <div class="row form-group">
                                    <div class="col col-md-3">
                                        {{ Form::label("answers[{$loop->iteration}][hint]", _i('Hint'), ['class' => 'form-control-label']) }}
                                    </div>
                                    <div class="col-12 col-md-9">
                                        {{ Form::text("answers[{$loop->iteration}][hint]", $question->hint, ["class" => "form-control", 'placeholder' => _i('Hint'), 'disabled' => true]) }}
                                    </div>
                                </div> 
                                
                                <div class="row form-group">
                                    <div class="col col-md-3">
                                        {{ Form::label("answers[{$loop->iteration}][is_required]", _i('Is required'), ['class' => 'form-control-label']) }}
                                    </div>
                                    <div class="col-12 col-md-9">
                                        <label class="switch switch-default switch-pill switch-warning mr-2">
                                            <input :name="answers[{$loop->iteration}][is_required]" type="checkbox" class="switch-input" checked="{{ $question->is_required }}" value="1" disabled="true" /> 
                                            <span class="switch-label"></span>
                                            <span class="switch-handle"></span>
                                        </label>
                                    </div>
                                </div>

                                <div class="row form-group">
                                    <div class="col col-md-3">
                                        {{ Form::label("answers[{$loop->iteration}][answer_type]", _i('Answer type'), ['class' => 'form-control-label']) }}
                                    </div>
                                    <div class="col-12 col-md-9">
                                        {{ Form::text("answers[{$loop->iteration}][answer_type]", _i($question->answer_type), ["class" => "form-control", 'placeholder' => _i('Answer type'), 'disabled' => true]) }}
                                    </div>
                                </div>           
                                
                                
                                <div class="row form-group">
                                    <div class="col col-md-3">
                                        {{ Form::label("answers[{$loop->iteration}][answer]", _i('Answer'), ['class' => 'form-control-label']) }}
                                    </div>
                                    <div class="col-12 col-md-9">
                                        @if (empty($selectTypes['select'][$question->answer_type]) && empty($selectTypes['multiselect'][$question->answer_type]))
                                            {{ Form::text("answers[{$loop->iteration}][answer]", $question->answer, ["class" => "form-control", 'placeholder' => _i('Answer'), 'required' => 'required']) }}
                                        @else
                                            {{ Form::select("answers[{$loop->iteration}][answer]", array_combine($question->answer_variants, $question->answer_variants), $question->answer, ["class" => "form-control", 'required' => 'required', 'multiple' => !empty($selectTypes['multiselect'][$question->answer_type])]) }}
                                        @endif                
                                    </div>
                                </div> 
                            @endforeach 
                        </div>
                        
                        <div class="form-group">
                            <div class="float-right">
                                {{ Form::submit( !empty($report->id) ? _i('Edit') : _i('Save'), ['class' => 'btn btn-success']) }}
                            </div>
                            <div class="">
                                <a href="{{ route('dashboard.reports.index') }}" class="btn btn-danger">{{ _i('Cancel') }}</a>
                            </div>
                        </div>
                {{ Form::close() }}                              
            </div>
        </div>
    </div><!-- .animated -->
</div><!-- .content -->
@endsection


@push('scripts')
@endpush