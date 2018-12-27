Vue.component('template-question', require('../components/admin/templates/TemplateQuestion.vue').default);

new Vue({
  el: '#template-block',
  data: {
    questions: questions,
    translations: translations,
    answer_types: answerTypes,
  },
  methods: {
    addNewQuestion: function (event) {
        event.preventDefault();
        this.questions.push({
            // id: 0,
            is_required: 1,
        })
    }
  }
})