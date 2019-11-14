new Vue({
    el: '#map-reports',
    data: {
        areas: areas,
        usersWithCompletedReports: usersWithCompletedReports,
        map: null,
        infoWindow: null,
        longitude: 30.7998284183,  
        latitude: 49.5510679,
    },
    methods: {
        initMap: function () {     
            this.map = new google.maps.Map(document.getElementById('google-map'), {
              center: {lat: this.latitude, lng: this.longitude},
              zoom: 6
            });
            this.infoWindow = new google.maps.InfoWindow();
            this.initOthersAreas();
        },
        initOthersAreas: function () {
            var vm = this;
            if (vm.areas.lenght < 1) {
                return false;
            }
            var circle;
            vm.areas.forEach(function(area, i) {          
                circle = new google.maps.Circle({
                    center: {lat: Number(area.latitude), lng: Number(area.longitude)},
                    radius: Number(area.radius),
                    strokeColor: '#ffa500',
                    strokeOpacity: 1,
                    strokeWeight: 3,
                    fillColor: this.usersWithCompletedReports[area.user_id] ? '#06c406' : '#fc0909',
                    fillOpacity: 0.6,
                });
                
                circle.setMap(vm.map);    
                
                circle.addListener('click', function() {
                    vm.infoWindow.setContent(area.report_table);
                    vm.infoWindow.setPosition({lat: Number(area.latitude), lng: Number(area.longitude)});                    
                    vm.infoWindow.open(vm.map); 
                });      
            });            
        },         
    },   
    mounted: function () {
      this.initMap();
    },    
})