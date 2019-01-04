{{ Form::model($user, ['route' => !empty($user->id)? ['admin.users.update', $user->id] : ['admin.users.store'], 'class' => 'form-horizontal form-label-left', 'id' => 'users-form', 'enctype' => 'multipart/form-data']) }}   
        @method(!empty($user->id)? 'PUT' : 'POST')
        @if (!empty($user->id))
            {{ Form::hidden('id', $user->id) }}
        @endif   
        
        <nav>
          <div class="nav nav-tabs" id="nav-tab" role="tablist">
            <a class="nav-item nav-link active" id="nav-personal-tab" data-toggle="tab" href="#nav-personal" role="tab" aria-controls="nav-personal" aria-selected="true">
                <i class="fas fa-user-alt"></i> {{ _i('Personal data') }}
            </a>
            <a class="nav-item nav-link" id="nav-settings-tab" data-toggle="tab" href="#nav-settings" role="tab" aria-controls="nav-settings" aria-selected="false"  v-show="isShowSettings" @click="initMap">
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
                      <div class="row form-group">
                          <div class="col col-md-3">
                              {{ Form::label('areas', _i('Specify the map area'), ['class' => 'form-control-label']) }}
                          </div>
                          <div class="col-12 col-md-9">
                              <div id="google-map">
                              </div>
                              <input type="hidden" name="areas[latitude]" v-model="latitude" />
                              <input type="hidden" name="areas[longitude]" v-model="longitude" />
                              <input type="hidden" name="areas[radius]" v-model="radius" />
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
    <script type="text/javascript" src="//maps.googleapis.com/maps/api/js?v=3.34&key={{ ENV('GOOGLE_API_KEY') }}"></script>
    <script>
        var employeeRoleId = "{{ optional($roles->where('name', 'employee')->first())->id }}";
        var selectedRoleId = "{{ optional($user->roles()->first())->id }}";    
        var area = {!! $user->area ? $user->area->toJson() : json_encode([])  !!};
    </script>
    <script src="{{ asset('/js/admin/users.js') }}" ></script>
@endpush