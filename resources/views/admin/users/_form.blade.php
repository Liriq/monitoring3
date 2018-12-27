{{ Form::model($user, ['route' => !empty($user->id)? ['admin.users.update', $user->id] : ['admin.users.store'], 'class' => 'form-horizontal form-label-left', 'id' => 'users-form', 'enctype' => 'multipart/form-data']) }}   
        @method(!empty($user->id)? 'PUT' : 'POST')
        @if (!empty($user->id))
            {{ Form::hidden('id', $user->id) }}
        @endif   
        
        <nav>
          <div class="nav nav-tabs" id="nav-tab" role="tablist">
            <a class="nav-item nav-link active" id="nav-personal-tab" data-toggle="tab" href="#nav-personal" role="tab" aria-controls="nav-home" aria-selected="true">
                <i class="fas fa-user-alt"></i> {{ _i('Personal data') }}
            </a>
            <a class="nav-item nav-link" id="nav-settings-tab" data-toggle="tab" href="#nav-settings" role="tab" aria-controls="nav-profile" aria-selected="false"  v-show="isShowSettings">
                <i class="fas fa-tools"></i> {{ _i('Settings') }}
            </a>            
          </div>
        </nav>
        
        <div class="tab-content" id="nav-tabContent">
            <div class="tab-pane fade show active" id="nav-personal" role="tabpanel" aria-labelledby="nav-personal-tab">
                  <div class="card">
                      <div class="card-header">
                          <strong class="card-title"></strong>
                      </div>
                      <div class="card-body">
                          
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
                                  {{ Form::label('input_lastname', _i('Last name'), ['class' => 'form-control-label']) }}
                              </div>
                              <div class="col-12 col-md-9">
                                  {{ Form::text("lastname", $user->lastname, ["class" => "form-control", "placeholder" => _i('Last name'), "id"=>"input_lastname", 'required' => 'required']) }}
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
                                  {{ Form::select('role_id', $roles->pluck('name', 'id'), null, ['placeholder' => _i('Role'),'class' => 'form-control', 'required' => 'required', "v-on:change"=>"showSettings", "v-model"=>"selectedRoleId"]) }}
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
                      </div>
                  </div>                 
            </div>
            <div class="tab-pane fade" id="nav-settings" role="tabpanel" aria-labelledby="nav-settings-tab">        
              <div class="card">
                  <div class="card-header">
                      <strong class="card-title"></strong>
                  </div>
                  <div class="card-body">

                      <div class="row form-group">
                          <div class="col col-md-3">
                              {{ Form::label('template_id', _i('Template'), ['class' => 'form-control-label']) }}
                          </div>
                          <div class="col-12 col-md-9">
                              {{ Form::select('template_id', $templates, $user->template_id, ['placeholder' => _i('Choose template'),'class' => 'form-control', 'required' => 'required', 'v-bind:disabled'=>'!isShowSettings']) }}
                          </div>
                      </div>
                      
                  </div>
              </div>               
          </div>
        </div>
        
        <div class="form-group">
            <div class="float-right">
                {{ Form::submit( !empty($user->id) ? _i('Edit') : _i('Save'), ['class' => 'btn btn-success']) }}
            </div>
            <div class="">
                <a href="{{ route('admin.users.index') }}" class="btn btn-danger">{{ _i('Cancel') }}</a>
            </div>
        </div>
{{ Form::close() }}

@push('scripts')
    <script>
        var employeeRoleId = "{{ optional($roles->where('name', 'employee')->first())->id }}";
        var selectedRoleId = '{{ optional($user->roles()->first())->id }}';
    </script>
    <script src="/js/admin/users.js" ></script>
@endpush