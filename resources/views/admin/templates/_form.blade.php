{{ Form::model($template, ['route' => !empty($template->id)? ['admin.templates.update', $template->id] : ['admin.templates.store'], 'class' => 'form-horizontal form-label-left', 'id' => 'templates-form', 'enctype' => 'multipart/form-data']) }}   
        @method(!empty($template->id)? 'PUT' : 'POST')
        @if (!empty($template->id))
            {{ Form::hidden('id', $template->id) }}
        @endif   
        
        <div class="row form-group">
            <div class="col col-md-3">
                {{ Form::label('input_name', _i('Name'), ['class' => 'form-control-label']) }}
            </div>
            <div class="col-12 col-md-9">
                {{ Form::text("name", $template->name, ["class" => "form-control", "placeholder" => _i('Name'), "id"=>"input_name", 'required' => 'required']) }}
            </div>
        </div>

        <div class="ln_solid"></div>
        <div class="form-group">
            <div class="float-right">
                {{ Form::submit( !empty($template->id) ? _i('Edit') : _i('Save'), ['class' => 'btn btn-success']) }}
            </div>
            <div class="">
                <a href="{{ route('admin.templates.index') }}" class="btn btn-danger">{{ _i('Cancel') }}</a>
            </div>
        </div>
{{ Form::close() }}