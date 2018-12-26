{{ Form::model($report, ['route' => !empty($report->id)? ['admin.reports.update', $report->id] : ['admin.reports.store'], 'class' => 'form-horizontal form-label-left', 'id' => 'reports-form', 'enctype' => 'multipart/form-data']) }}   
        @method(!empty($report->id)? 'PUT' : 'POST')
        @if (!empty($report->id))
            {{ Form::hidden('id', $report->id) }}
        @endif   
        
        <div class="row form-group">
            <div class="col col-md-2">
                {{ Form::label('template_id', _i('Template'), ['class' => 'form-control-label']) }}
            </div>
            <div class="col-2 col-md-2">
                {{ Form::select("template_id", $templates->pluck('name', 'id'), null, ["class" => "form-control", 'required' => 'required', 'placeholder' => _i('Choose template')]) }}
            </div>
        </div>
        
        <div class="row form-group">
            <div class="col col-md-2">
                {{ Form::label('user_id', _i('Employee'), ['class' => 'form-control-label']) }}
            </div>
            <div class="col-2 col-md-2">
                {{ Form::select("user_id", $employees, null, ["class" => "form-control", 'required' => 'required', 'placeholder' => _i('Choose employee')]) }}
            </div>
        </div>        
        
        <div class="row form-group">
            <div class="col col-md-2">
                {{ Form::label('published_at', _i('Published at'), ['class' => 'form-control-label']) }}
            </div>
            <div class="col-2 col-md-2">
                {{ Form::date("published_at", null, ["class" => "form-control", 'required' => 'required']) }}
            </div>
        </div>
        
        <div class="form-group">
            <div class="float-right">
                {{ Form::submit( !empty($report->id) ? _i('Edit') : _i('Save'), ['class' => 'btn btn-success']) }}
            </div>
            <div class="">
                <a href="{{ route('admin.reports.index') }}" class="btn btn-danger">{{ _i('Cancel') }}</a>
            </div>
        </div>
{{ Form::close() }}