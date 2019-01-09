new Vue({
    el: '#user-form-block',   
    data: {
        areas: areas,
        selectedRoleId: selectedRoleId,
        employeeRoleId: employeeRoleId,
        isShowSettings: selectedRoleId == employeeRoleId,
        circle: null,
        infoWindow: null,
        map: null,
        radius: Number(area.radius) || 1000,  
        longitude: Number(area.longitude) || 30.7998284183,  
        latitude: Number(area.latitude) || 46.5510679,  
    },
    methods: {
        showSettings: function () {
            this.isShowSettings = this.selectedRoleId == this.employeeRoleId;
        },
        initMap: function () {
            console.log('initMap vue');
            var center = {lat: this.latitude, lng: this.longitude};
            this.map = new google.maps.Map(document.getElementById('google-map'), {
              center: center,
              zoom: 12
            });
            
            this.circle = new google.maps.Circle({
                center: center,
                radius: this.radius,
                strokeColor: '#ffa500',
                strokeOpacity: 1,
                strokeWeight: 3,
                fillColor: '#ffc800',
                fillOpacity: 0.6,
                editable: true,
                draggable: true,
            });  
            
            this.circle.setMap(this.map);   
            
            // Add an event listener on the rectangle.
            this.circle.addListener('bounds_changed', this.showNewCoordinates);        
            
            // Define an info window on the map.
            this.infoWindow = new google.maps.InfoWindow();
            this.initOthersAreas();
        },
        showNewCoordinates: function () {        
            var center = this.circle.getCenter();      
            var bounds = this.circle.getBounds();
            var ne = bounds.getNorthEast();
            var sw = bounds.getSouthWest();
            this.longitude = center.lng();
            this.latitude = center.lat();
            this.radius = this.circle.getRadius(); 
            console.log( this.radius, this.latitude, this.longitude );
            
            var contentString = '<b>Circle moved.</b><br>' +
                'New center: ' + this.latitude + ', ' + this.longitude + '<br>' +
                'New radius: ' + this.radius;
            
            // Set the info window's content and position.
            this.infoWindow.setContent(contentString);
            this.infoWindow.setPosition(ne);
            
            this.infoWindow.open(this.map);                    
        },
        initOthersAreas: function () {
            console.log('initOthersAreas');
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
                    fillColor: '#a2a0a0',
                    fillOpacity: 0.6,
                });
                
                circle.setMap(vm.map);          
            });            
        },
    }
})