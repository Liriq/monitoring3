new Vue({
    el: '#map-reports',
    data: {
        areas: areas,
        map: null,
        infoWindow: null,
        longitude: 30.7998284183,
        latitude: latitude,
        zoom: zoom
    },
    methods: {
        initMap: function () {
            this.map = new google.maps.Map(document.getElementById('google-map'), {
              center: {lat: this.latitude, lng: this.longitude},
              zoom: this.zoom
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
                    fillColor: area.template_color || '#fc0909',
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
