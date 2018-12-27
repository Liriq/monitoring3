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
        
        
        <hr/>
        <h3 class="margin-bottom-1">{{ _i('Questions') }}:</h3>
        <div class="form-group">
            <button class="btn btn-warning" @click="addNewQuestion">{{ _i('Add question') }} <i class="fas fa-plus-circle"></i></button>
        </div>
        <div id="questions-block">
            <template-question
                v-for="(question, index) in questions"
                v-bind:key="index"
                v-bind:answer_types="answer_types"
                v-bind:number="index"
                v-bind:question="question"
                v-bind:translations="translations"
                v-on:remove="questions.splice(index, 1)"
            >
            </template-question>
        </div>
        
        <div class="form-group">
            <div class="float-right">
                {{ Form::submit( !empty($template->id) ? _i('Edit') : _i('Save'), ['class' => 'btn btn-success']) }}
            </div>
            <div class="">
                <a href="{{ route('admin.templates.index') }}" class="btn btn-danger">{{ _i('Cancel') }}</a>
            </div>
        </div>
{{ Form::close() }}

@push('scripts')
    <script>
        var translations = {
                question: '{{ _i("Question") }}',
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
        var questions = {!! $template->questions->toJson() !!};
        var answerTypes = {!! json_encode($answerTypes) !!};
    </script>
    <script src="/js/admin/templates.js" ></script>
@endpush