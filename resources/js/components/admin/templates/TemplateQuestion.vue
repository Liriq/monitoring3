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
                <label :for="'questions[' + number + '][is_required]'" class="form-control-label" v-html="translations.required_field"></label>
            </div>
            <div class="col-12 col-md-9">
                <label class="switch switch-default switch-pill switch-warning mr-2">
                    <input :name="'questions[' + number + '][is_required]'" type="checkbox" class="switch-input" :checked="question.is_required" value="1"> 
                    <span class="switch-label"></span> <span class="switch-handle"></span>
                </label>
            </div>
        </div>                  
    </div>
</template>

<script>
    export default {
        props: ['question', 'translations', 'number'],
    }
</script>