Vue.component('template-question', require('../components/admin/reports/ReportQuestion.vue').default);

new Vue({
    el: '#report-form-block',
    data: {
        report: report,
        selectedEmployeeId: report.user_id,
        selectedTemplateId: report.template_id,
        isShowBlocks: false,
        employeesByTemplate: employeesByTemplate,
        employees: [], 
        answers: [],
        questionsByTemplate: questionsByTemplate,
        translations: translations,
        answerTypes: answerTypes,
        isDisabled: (report.id > 0)           
    },
    methods: {
        showBlocks: function () {
            if (this.selectedTemplateId) {       
                this.loadEmployees();  
                this.loadAnswers();  
                this.isDisabled = this.isShowBlocks = true;              
            } else {
                this.isShowBlocks = false;
            }
        },
        loadEmployees: function () {
            this.employees = this.employeesByTemplate[this.selectedTemplateId];
            
        },
        loadAnswers: function () {
            var body = {report_id: this.report.id, template_id: this.selectedTemplateId}
            axios.post('/admin/reports/get-answers', body)
            .then (response => {
                this.answers = response.data;
            })
            .catch (e => {
                console.log('ERROR', e)
            })
            
        },
    },
    created: function () {
        if (this.selectedTemplateId) {
            this.loadEmployees();
            this.loadAnswers();
            this.isDisabled = this.isShowBlocks = true; 
        }        
    }    
})