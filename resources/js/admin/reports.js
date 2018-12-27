new Vue({
    el: '#report-form-block',
    data: {
        selectedEmployeeId: selectedEmployeeId,
        selectedTemplateId: selectedTemplateId,
        isShowEmployees: (selectedEmployeeId > 0),
        employeesByTemplate: employeesByTemplate,
        employees: [
            
        ],    
    },
    methods: {
        showEmployees: function () {
            if (this.selectedTemplateId) {       
                this.loadEmployees();                
            } else {
                this.isShowEmployees = false;
            }
        },
        loadEmployees: function () {
            this.employees = [];
            this.employees = $.merge(this.employeesByTemplate[this.selectedTemplateId], this.employees);
            this.isShowEmployees = true;
        },
    },
    created: function () {
        if (this.selectedTemplateId) {
            this.loadEmployees();
        }        
    }    
})