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
                {{ Form::select("template_id", $templates->pluck('name', 'id'), null, ["class" => "form-control", 'required' => 'required', 'placeholder' => _i('Choose template'), "v-on:change"=>"showBlocks", "v-model"=>"selectedTemplateId", "v-bind:readonly"=>"isDisabled"]) }}
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
        
        <div class="row form-group" v-show="isShowBlocks">
            <div class="col col-md-3">
                {{ Form::label('user_id', _i('Employee'), ['class' => 'form-control-label']) }}
            </div>
            <div class="col-12 col-md-9">
                <select
                    v-model="selectedEmployeeId" 
                    class="form-control" 
                    name="user_id" 
                    required>
                    <option value="" selected="selected">{{ _i('Choose employee') }}</option>
                    <option v-for="employee in employees" v-bind:value="employee.id" v-text="employee.name + ' ' + employee.lastname"></option>
                </select> 
            </div>
        </div>
        
        <div id="questions-block" v-show="isShowBlocks">
            <template-question
                v-for="(answer, index) in answers"
                v-bind:is_disabled="isDisabled"
                v-bind:key="index"
                v-bind:answer_types="answerTypes"
                v-bind:type_select="typeSelect"   
                v-bind:number="index"
                v-bind:answer="answer"
                v-bind:translations="translations"
                v-on:remove="answers.splice(index, 1)"
            >
            </template-question>
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
        var report = {!! $report->toJson() !!};
        var employeesByTemplate = {!! $employeesByTemplate->toJson() !!};        
        var questionsByTemplate = {!! $questionsByTemplate->toJson() !!};
        var answerTypes = {!! json_encode($answerTypes) !!};
        var typeSelect =  {!! json_encode($typeSelect) !!}; 
        var translations = {
                question: '{{ _i("Question") }}',
                answer: '{{ _i("Answer") }}',
                hint: '{{ _i("Hint") }}',
                requiredField: '{{ _i("Required field") }}',
                answerType: '{{ _i("Answer type") }}',
                chooseAnswerType: '{{ _i("Choose answer type") }}',
                answerVariants: '{{ _i("Answer variants") }}',
                typeAnswerVariants: '{{ _i("Type your answer and press Enter") }}',
                answerTypes: {
                    text: '{{ _i("text") }}',
                    boolean: '{{ _i("boolean") }}',
                    date: '{{ _i("date") }}',
                    number: '{{ _i("number") }}',
                    select: '{{ _i("select") }}',
                    multiselect: '{{ _i("multiselect") }}',
                },
            };            
    </script>
    <script src="/js/admin/reports.js" ></script>
@endpush