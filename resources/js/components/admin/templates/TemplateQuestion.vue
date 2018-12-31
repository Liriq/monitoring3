<template>
    <div>
        <hr/>
        <div class="form-group">
            <b>№{{ number + 1 }}</b>
            <button class="btn btn-danger float-right" v-on:click.prevent="$emit('remove')"><i class="far fa-trash-alt"></i></button>
            <input type="hidden" :name="'questions[' + number + '][id]'" :value="question.id">
        </div>
        <div class="row form-group">
            <div class="col col-md-3">
                <label :for="'questions[' + number + '][question]'" class="form-control-label">{{translations.question}}</label>
            </div>
            <div class="col-12 col-md-9">
                <input class="form-control" v-model="question.question" :placeholder="translations.question" :name="'questions[' + number + '][question]'" type="text" required />
            </div>
        </div>
        
        <div class="row form-group">
            <div class="col col-md-3">
                <label :for="'questions[' + number + '][hint]'" class="form-control-label">{{translations.hint}}</label>
            </div>
            <div class="col-12 col-md-9">
                <input class="form-control" v-model="question.hint" :placeholder="translations.hint" :name="'questions[' + number + '][hint]'" type="text" />
            </div>
        </div> 
        
        <div class="row form-group">
            <div class="col col-md-3">
                <label :for="'questions[' + number + '][is_required]'" class="form-control-label" v-html="translations.requiredField"></label>
            </div>
            <div class="col-12 col-md-9">
                <label class="switch switch-default switch-pill switch-warning mr-2">
                    <input :name="'questions[' + number + '][is_required]'" type="checkbox" class="switch-input" :checked="question.is_required" value="1"> 
                    <span class="switch-label"></span> <span class="switch-handle"></span>
                </label>
            </div>
        </div>        

        <div class="row form-group">
            <div class="col col-md-3">
                <label :for="'questions[' + number + '][answer_type]'" class="form-control-label" v-html="translations.answerType"></label>
            </div>
            <div class="col-12 col-md-9">
                <select
                    class="form-control" 
                    :name="'questions[' + number + '][answer_type]'" 
                    v-model="question.answer_type"
                    :selected="question.answer_type ? question.answer_type : 0"
                    required>
                    <option v-for="(answer_type, key) in answer_types" v-bind:value="key" v-text="translations.answerTypes[answer_type]"></option>
                </select> 
            </div>
        </div>           
        
        <div class="row form-group" v-show="question.answer_type == type_select">
            <div class="col col-md-3">
                <label :for="'questions[' + number + '][answer_variants]'" class="form-control-label">{{translations.answerVariants}}</label>
            </div>
            <div class="col-12 col-md-9">                    
                <tags-input
                    :element-id="'questions[' + number + '][answer_variants]'"
                    :placeholder="translations.typeAnswerVariants"
                    v-model="question.answer_variants"
                    :typeahead="true"
                    >
                </tags-input>                    
            </div>
        </div>               
                        
    </div>
</template>

<script>
    export default {
        props: ['question', 'translations', 'number', 'answer_types', 'type_select'],
    }
</script>