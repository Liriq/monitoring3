{{ Form::model($user, ['route' => !empty($user->id)? ['admin.users.update', $user->id] : ['admin.users.store'], 'class' => 'form-horizontal form-label-left', 'id' => 'users-form', 'enctype' => 'multipart/form-data']) }}   
        @method(!empty($user->id)? 'PUT' : 'POST')
        @if (!empty($user->id))
            {{ Form::hidden('id', $user->id) }}
        @endif   
        
        <div class="row form-group">
            <div class="col col-md-3">
                {{ Form::label('input_name', _i('Name'), ['class' => 'form-control-label']) }}
            </div>
            <div class="col-12 col-md-9">
                {{ Form::text("name", $user->name, ["class" => "form-control", "placeholder" => _i('Name'), "id"=>"input_name", 'required' => 'required']) }}
            </div>
        </div>
        
        <div class="row form-group">
            <div class="col col-md-3">
                {{ Form::label('input_lastname', _i('Lastname'), ['class' => 'form-control-label']) }}
            </div>
            <div class="col-12 col-md-9">
                {{ Form::text("lastname", $user->lastname, ["class" => "form-control", "placeholder" => _i('Lastname'), "id"=>"input_lastname", 'required' => 'required']) }}
            </div>
        </div> 
        
        <div class="row form-group">
            <div class="col col-md-3">
                {{ Form::label('email', _i('Email'), ['class' => 'form-control-label']) }}
            </div>
            <div class="col-12 col-md-9">
                {{ Form::email("email", $user->email, ["class" => "form-control", "placeholder" => _i('Email'), "id"=>"email", 'required' => 'required']) }}
            </div>
        </div> 
        
        <div class="row form-group">
            <div class="col col-md-3">
                {{ Form::label('role_id', _i('Role'), ['class' => 'form-control-label']) }}
            </div>
            <div class="col-12 col-md-9">
                {{ Form::select('role_id', $roles, $user->roles->isNotEmpty() ? $user->roles->pluck('id') : null, ['placeholder' => _i('Role'),'class' => 'form-control select2']) }}
            </div>
        </div>        
        
        <div class="row form-group">
            <div class="col col-md-3">
                {{ Form::label('password', _i('Password'), ['class' => 'form-control-label']) }} 
            </div>
            <div class="col-12 col-md-9">
                {{ Form::password('password', ["class" => "form-control", "placeholder" => _i('Password'), "id"=>"password"]) }}
            </div>
        </div>     
        
        <div class="row form-group">
            <div class="col col-md-3">
                {{ Form::label('note', _i('Note'), ['class' => 'form-control-label']) }}
            </div>
            <div class="col-12 col-md-9">
                {{ Form::textarea("note", ($user->notes->isNotEmpty())? $user->notes->first()->text : '', ["class" => "form-control", "placeholder" => _i('Note'), "id"=>"note"]) }}
            </div>
        </div>   

        <div class="ln_solid"></div>
        <div class="form-group">
            <div class="float-right">
                {{ Form::submit( !empty($user->id) ? _i('Edit') : _i('Save'), ['class' => 'btn btn-success']) }}
            </div>
            <div class="">
                <a href="{{ route('admin.users.index') }}" class="btn btn-danger">{{ _i('Cancel') }}</a>
            </div>
        </div>
{{ Form::close() }}