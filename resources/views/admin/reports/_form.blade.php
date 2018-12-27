{{ Form::model($report, ['route' => !empty($report->id)? ['admin.reports.update', $report->id] : ['admin.reports.store'], 'class' => 'form-horizontal form-label-left', 'id' => 'reports-form', 'enctype' => 'multipart/form-data']) }}   
        @method(!empty($report->id)? 'PUT' : 'POST')
        @if (!empty($report->id))
            {{ Form::hidden('id', $report->id) }}
        @endif   
        
        <div class="row form-group">
            <div class="col col-md-3">
                {{ Form::label('template_id', _i('Template'), ['class' => 'form-control-label']) }}
            </div>
            <div class="col-12 col-md-9">
                {{ Form::select("template_id", $templates->pluck('name', 'id'), null, ["class" => "form-control", 'required' => 'required', 'placeholder' => _i('Choose template'), "v-on:change"=>"showEmployees", "v-model"=>"selectedTemplateId"]) }}
            </div>
        </div>       
        
        <div class="row form-group">
            <div class="col col-md-3">
                {{ Form::label('published_at', _i('Published at'), ['class' => 'form-control-label']) }}
            </div>
            <div class="col-12 col-md-9">
                {{ Form::date("published_at", $report->published_at, ["class" => "form-control ", 'required' => 'required']) }}
            </div>
        </div>        
        
        <div class="row form-group" v-show="isShowEmployees">
            <div class="col col-md-3">
                {{ Form::label('user_id', _i('Employee'), ['class' => 'form-control-label']) }}
            </div>
            <div class="col-12 col-md-9">
                <select 
                    v-bind:disabled="!isShowEmployees"
                    v-model="selectedEmployeeId" 
                    class="form-control" 
                    name="user_id" 
                    required>
                    <option value="" selected="selected">{{ _i('Choose employee') }}</option>
                    <option v-for="employee in employees" v-bind:value="employee.id" v-text="employee.name + ' ' + employee.lastname"></option>
                </select> 
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

@push('scripts')
    <script>
        var selectedEmployeeId = '{{ optional($report)->user_id }}';
        var selectedTemplateId = '{{ optional($report->template)->id }}';
        var employeesByTemplate = {!! $employeesByTemplate->toJson() !!};          
    </script>
    <script src="/js/admin/reports.js" ></script>
@endpush