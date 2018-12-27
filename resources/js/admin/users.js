new Vue({
  el: '#user-form-block',
  data: {
    selectedRoleId: selectedRoleId,
    employeeRoleId: employeeRoleId,
    isShowSettings: selectedRoleId == employeeRoleId
  },
  methods: {
    showSettings: function () {
        this.isShowSettings = this.selectedRoleId == this.employeeRoleId;
    }
  }
})