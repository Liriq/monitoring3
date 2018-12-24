{{ Form::model($setting, ['route' => !empty($setting->id)? ['admin.settings.update', $setting->id] : ['admin.settings.store'], 'class' => 'form-horizontal form-label-left', 'id' => 'settings-form', 'enctype' => 'multipart/form-data']) }}   
        @method(!empty($setting->id)? 'PUT' : 'POST')
        @if (!empty($setting->id))
            {{ Form::hidden('id', $setting->id) }}
        @endif   
        
        <div class="row form-group">
            <div class="col col-md-3">
                {{ Form::label('input_name', _i('Name'), ['class' => 'form-control-label']) }}
            </div>
            <div class="col-12 col-md-9">
                {{ Form::text("name", $setting->name, ["class" => "form-control", "placeholder" => _i('Name'), "id"=>"input_name", 'required' => 'required']) }}
            </div>
        </div>
        
        <div class="row form-group">
            <div class="col col-md-3">
                {{ Form::label('input_value', _i('Value'), ['class' => 'form-control-label']) }}
            </div>
            <div class="col-12 col-md-9">
                {{ Form::text("value", $setting->value, ["class" => "form-control", "placeholder" => _i('Value'), "id"=>"input_value", 'required' => 'required']) }}
            </div>
        </div>
        
        <div class="row form-group">
            <div class="col col-md-3">
                {{ Form::label('input_description', _i('Description'), ['class' => 'form-control-label']) }}
            </div>
            <div class="col-12 col-md-9">
                {{ Form::textarea("description", $setting->description, ["class" => "form-control", "placeholder" => _i('Description'), "id"=>"input_description"]) }}
            </div>
        </div> 

        <div class="ln_solid"></div>
        <div class="form-group">
            <div class="float-right">
                {{ Form::submit( !empty($setting->id) ? _i('Edit') : _i('Save'), ['class' => 'btn btn-success']) }}
            </div>
            <div class="">
                <a href="{{ route('admin.settings.index') }}" class="btn btn-danger">{{ _i('Cancel') }}</a>
            </div>
        </div>
{{ Form::close() }}