<template>
    <div>
        <hr/>
        <div class="form-group">
            <b>№{{ number + 1 }}</b>
            <button class="btn btn-danger float-right" v-on:click.prevent="$emit('remove')">
                <i class="far fa-trash-alt"></i>
            </button>
            <input type="hidden" :name="'answers[' + number + '][id]'" :value="answer.id">
        </div>
        
        <div class="row form-group">
            <div class="col col-md-3">
                <label :for="'answers[' + number + '][question]'" class="form-control-label">{{translations.question}}</label>
            </div>
            <div class="col-12 col-md-9">
                <input class="form-control" v-model="answer.question" :placeholder="translations.question" :name="'answers[' + number + '][question]'" type="text" required v-bind:readonly="is_disabled" />
            </div>
        </div>
        
        <div class="row form-group">
            <div class="col col-md-3">
                <label :for="'answers[' + number + '][hint]'" class="form-control-label">{{translations.hint}}</label>
            </div>
            <div class="col-12 col-md-9">
                <input class="form-control" v-model="answer.hint" :placeholder="translations.hint" :name="'answers[' + number + '][hint]'" type="text" v-bind:readonly="is_disabled" />
            </div>
        </div> 
        
        <div class="row form-group">
            <div class="col col-md-3">
                <label :for="'answers[' + number + '][is_required]'" class="form-control-label" v-html="translations.requiredField"></label>
            </div>
            <div class="col-12 col-md-9">
                <label class="switch switch-default switch-pill switch-warning mr-2">
                    <input :name="'answers[' + number + '][is_required]'" type="checkbox" class="switch-input" :checked="answer.is_required" value="1" v-bind:readonly="is_disabled" /> 
                    <span class="switch-label"></span> <span class="switch-handle"></span>
                </label>
            </div>
        </div>

        <div class="row form-group">
            <div class="col col-md-3">
                <label :for="'answers[' + number + '][answer_type]'" class="form-control-label" v-html="translations.answerType"></label>
            </div>
            <div class="col-12 col-md-9">
                <select
                    class="form-control" 
                    :name="'answers[' + number + '][answer_type]'" 
                    v-model="answer.answer_type"
                    :selected="answer.answer_type ? answer.answer_type : 0"
                    v-bind:readonly="is_disabled"
                    required>
                    <option v-for="(answer_type, key) in answer_types" v-bind:value="key" v-text="translations.answerTypes[answer_type]"></option>
                </select> 
            </div>
        </div>
        
 
        
                <div class="row form-group hidden">
                    <div class="col col-md-3">
                        <label :for="'answers[' + number + '][answer_variants]'" class="form-control-label">{{translations.answerVariants}}</label>
                    </div>
                    <div class="col-12 col-md-9">                    
                        <tags-input
                            :element-id="'answers[' + number + '][answer_variants]'"
                            :placeholder="translations.typeAnswerVariants"
                            v-model="answer.answer_variants"
                            :only-existing-tags="is_disabled"
                            :typeahead="true">
                        </tags-input>                    
                    </div>
                </div>              
        
        <div class="row form-group">
            <div class="col col-md-3">
                <label :for="'answers[' + number + '][answer]'" class="form-control-label">{{translations.answer}}</label>
            </div>
            <div class="col-12 col-md-9">
                <div v-if="(answer.answer_type == type_select)">
                    <select
                        class="form-control" 
                        :name="'answers[' + number + '][answer]'" 
                        v-model="answer.answer"
                        :disabled="!(answer.answer_type == type_select)"
                        required>
                        
                        <option v-for="(answer_variant, key) in answer.answer_variants"
                            v-bind:key="key"  
                            v-bind:value="answer_variant" 
                            v-text="answer_variant">
                        </option>
                    </select>  
                </div>
                <div v-else>
                    <input class="form-control" 
                        v-model="answer.answer" 
                        :placeholder="translations.answer" 
                        :name="'answers[' + number + '][answer]'"
                        type="text" 
                        :disabled="!(type_select.indexOf(answer.answer_type) == -1)"
                        required />
                </div>  
            </div>
        </div>                    
                        
    </div>
</template>

<script>
    export default {
        props: ['answer', 'translations', 'number', 'answer_types', 'is_disabled', 'type_select'],
    }
</script>