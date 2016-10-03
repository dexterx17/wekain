class UserOrigenController{
    constructor(API, ToastService, $log, $scope){
        'ngInject';
        var self=this;
        this.API= API;
        this.ToastService = ToastService;
        this.$log = $log;
        this.isDisabled    = false;

        self.mouse_lat = 0;
        self.mouse_lng = 0;
        self.click_lat = 0;
        self.click_lng = 0;

        // list of `state` value/display objects
        this.paises        = [];
        this.querySearch   = function(query) {
            var results = query ? this.paises.filter( this.createFilterFor(query) ) : this.paises;
            return results;
        }
        this.selectedItemChange = function(item) {
          this.$log.info('Item changed to ' + angular.toJson(item));
        };

        this.searchTextChange   = function (text) {
          this.$log.info('Text changed to ' + text);
        };

        this.getData();
        var capas = {
            openstreetmap: {
                name:"OSM",
                url: "http://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png",
                options: {
                    attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
                },
                type:"xyz"
            },
            dos: {
                name:"OSM",
                url: "https://{s}.tiles.mapbox.com/v4/{id}/{z}/{x}/{y}.png?access_token=pk.eyJ1IjoiZGV4dGVyeDE3IiwiYSI6ImRJbWtsbnMifQ.PILxOmw0bK2YcyL-UYDFeQ",
                options: {
                    attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
                },
                type:"xyz"
            },
            personalizado: {
                name:"Mapbox",
                //id:"dexterx17.lhea37cm",
                url: "https://{s}.tiles.mapbox.com/v4/{id}/{z}/{x}/{y}.png?access_token=pk.eyJ1IjoiZGV4dGVyeDE3IiwiYSI6ImRJbWtsbnMifQ.PILxOmw0bK2YcyL-UYDFeQ",
                type:"xyz",
                options:{
                    apikey: 'pk.eyJ1IjoiZGV4dGVyeDE3IiwiYSI6ImRJbWtsbnMifQ.PILxOmw0bK2YcyL-UYDFeQ',
                    mapid:"dexterx17.lhea37cm",
                    attribution: 'Map data &copy; <a href="http://openstreetmap.org">OpenStreetMap</a> contributors,  <a href="http://mapbox.com">Mapbox</a>'
                }
            }
        };

        var sobrecapas = {
            paises: {
                name:'Paises',
                type:'wms',
                visible:true,
                crs: L.CRS.EPSG4326,
                url:'http://127.0.0.1/cgi-bin/mapserv?map=/var/www/html/wekain-angular/mapas/global.map',
                layerParams: {
                    layers: 'paises',
                    crs: L.CRS.EPSG4326,
                    format: 'image/png',
                    transparent: true
                },
                layerOptions: {
                  attribution: "laey options"
                }
            }
        };

        angular.extend($scope, {
                center: {
                    lat:   24.5271348225978,
                    lng:  -14.765625000000002,
                    zoom:2
                },
                markers: {
                    taipei: {
                        lat: 25.0391667,
                        lng: 121.525
                    }
                },
                layers: {
                    baselayers:capas,
                    overlays:sobrecapas
                }
            });

         $scope.$on('leafletDirectiveMap.mymap.click', function(e,wrap){
            $log.log(wrap);
            self.click_lat = wrap.leafletEvent.latlng.lat;
            self.click_lng = wrap.leafletEvent.latlng.lng;
            $scope.eventDetected = e.name;
        });

        $scope.$on('leafletDirectiveMap.mymap.mousemove', function(e,wrap){
            self.mouse_lat = wrap.leafletEvent.latlng.lat;
            self.mouse_lng = wrap.leafletEvent.latlng.lng;
            $scope.eventDetected = e.name;
        });

        $scope.$watch('center.zoom', function(newValue){
                $scope.layers.overlays.paises.visible = newValue >= 4;
            });
    }

    getData(){
        var paises= this.paises ;
        this.API.all('paises').get('')
        .then((response)=> {
            angular.forEach(response.data, function(pais){
                pais.display = pais.pais;
                pais.pais = pais.pais.toLowerCase();
                pais.value = pais.id;
                //paises.push({value:pais,display:value});
                paises.push(pais);
            });
        });
    }



    /**
     * Create filter function for a query string
     */
    createFilterFor(query) {
      var lowercaseQuery = angular.lowercase(query);
      return function filterFn(pais) {
        return (pais.pais.indexOf(lowercaseQuery) === 0);
      };
    }
}

export const UserOrigenComponent = {
    templateUrl: './views/app/components/user-origen/user-origen.component.html',
    controller: UserOrigenController,
    controllerAs: 'vm',
    bindings: {}
}
