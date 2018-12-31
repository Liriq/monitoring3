Vue.component('template-question', require('../components/admin/templates/TemplateQuestion.vue').default);

new Vue({
  el: '#template-block',
  data: {
    questions: questions,
    translations: translations,
    answerTypes: answerTypes,
    typeSelect: typeSelect,
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