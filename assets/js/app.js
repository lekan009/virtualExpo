var myApp = angular.module('myApp', ['ngRoute']);

myApp.config( function ($routeProvider) {
	$routeProvider
		.when("/home", {
			templateUrl: "partials/home.html",
			controller: "EventController"
		})
		.when("/event/:eventId", {
			templateUrl: "partials/show_event.html",
			controller: "ShowEventController"
		})
	.otherwise({
		redirectTo: "/home"
	});
});

// myApp.factory("goodFactory", function() {
//   doLotsOfThings();
//   butDontReturnAValue();

//   return {
//       doTheThing: function methodThatDoesAThing() {
//       }
//   };
// });


myApp.factory('Events',['$log', '$http', function($log, $http) {

	var events = [{"id":"1","event_place_name":"The Grandeur Events Center","event_place_location":"17, Billings Way Oregun, Lagos, Nigeria","latitude":"6.6061305","longtitude":"3.3305475","image":"The_Grandeur_Events_Cente1478308831.png"},{"id":"2","event_place_name":" K & G Events Center","event_place_location":"Kudirat Abiola Way, Lagos, Nigeria","latitude":"6.6067559","longtitude":"3.2892537","image":"_K_G_Events_Center1478309324.png"},{"id":"3","event_place_name":"Merry Makers Event Centre","event_place_location":"793,A07 KASHIM IBRAHIM WAY\/DAR-ES-SALAM STREET\/ODA","latitude":"9.0757133","longtitude":"7.3990451","image":"Merry_Makers_Event_Centre1478309582.jpg"},{"id":"4","event_place_name":"Transcorp Hilton Abuja","event_place_location":"1 Aguiyi Ironsi St, Abuja, Nigeria","latitude":"9.0745204","longtitude":"7.4249754","image":"Transcorp_Hilton_Abuja1478309745.jpg"},{"id":"5","event_place_name":"Spring Place Event Centre","event_place_location":"Peter Odili Road, Port Harcourt, Nigeria","latitude":"4.8032594","longtitude":"6.9797914","image":"Spring_Place_Event_Centre1478309888.jpg"},{"id":"6","event_place_name":"The Atrium","event_place_location":"28, Stadium Road, Port Harcourt, Rivers State, Nig","latitude":"4.8222398","longtitude":"6.9472954","image":"The_Atrium1478310022.jpg"}];

	// var events = [];

	// $http.get('api/v1/events/eventList').success(function(data) {
	// 	events = data;
	// 	// $log.info(events);
	// 	// alert(events);
	// 	// return events;
	// 	function places() {
	// 		alert(events);
	// 		return events;
	// 		$log.info(events);
	// 	}
	// 	places();
	// });
	
	return {
        list:function()
        {
          return events;
        },

        get:function(id)
        {
          return events[id];
        },
    };


}]);



// myApp.factory('Events', function ($log, $http) {

// 	var events = [];

// 	return $http.get('api/v1/events/eventList').success(function(data) {
// 		events = data;
// 		$log.info(events);
// 		return
// 		list:function list()
// 		{ events = '20'; 
// 			return events;
// 			$log.info(events);
// 		}
// 		get:function get(id)
// 		{
// 			return events[id];
// 		};
// 	}).error(function(error) {
// 		return error;
// 	});

	// return {
 //        list:function()
 //        {
 //          return events;
 //        },

 //        get:function(id)
 //        {
 //          return events[id];
 //        },
 //    };
// });
 
myApp.controller('EventsCtrl', function ($scope, $log, $http) {
 
    $http.get('api/v1/events/eventList').success(function(data){
        $scope.events = data;
    }).error(function(data){
        $scope.events = data;
    });
 
    $scope.refresh = function(){
        $http.get('api/v1/events/eventList').success(function(data){
            $scope.events = data;
        }).error(function(data){
            $scope.events = data;
        });
    }
 
    $scope.addTask = function(){
        var newTask = {title: $scope.taskTitle};
        $http.post('api/tasks', newTask).success(function(data){
            $scope.refresh();
            $scope.taskTitle = '';
        }).error(function(data){
            alert(data.error);
        });
    }
});

myApp.controller('EventController', ['$scope', '$log', '$routeParams', '$http', 'Events', function ($scope, $log, $routeParams, $http, Events) {

    var myLatlng = new google.maps.LatLng(6.4302829, 3.4297145);

    var iconBase = 'https://maps.google.com/mapfiles/kml/shapes/';

    var mapOptions = {
        zoom: 11,
        scrollwheel: false,
        center: myLatlng,
        styles: [ { "stylers": [ { "hue": "#4bd6bf" }, { "gamma": "1.58" } ] } ],
        mapTypeId: google.maps.MapTypeId.ROADMAP
    }

	if (navigator.geolocation) {
		navigator.geolocation.getCurrentPosition(function (position) {
			initialLocation = new google.maps.LatLng(position.coords.latitude, position.coords.longitude);
		});
	}
	if (true) {};

    $scope.map = new google.maps.Map(document.getElementById('map'), mapOptions);

    //Create LatLngBounds object.
    var latlngbounds = new google.maps.LatLngBounds();

    $scope.markers = [];
    
    var infoWindow = new google.maps.InfoWindow();
    
    var createMarker = function (info){
        
        var marker = new google.maps.Marker({
            map: $scope.map,
            position: new google.maps.LatLng(info.latitude, info.longtitude),
            icon: 'http://maps.gstatic.com/mapfiles/ridefinder-images/mm_20_blue.png',
            title: info.event_place_name
        });
        // $log.info(info.latitude, info.longitude, info.rating);
        marker.content = '<div class="infoWindowContent">' + info.event_place_name + '</div>';
        
        google.maps.event.addListener(marker, 'mouseover', function(){
            infoWindow.setContent('<strong>' + info.event_place_name + '</strong><br> Location: ' + info.event_place_location);
            infoWindow.open($scope.map, marker);
        });

        google.maps.event.addListener(marker, 'click', function(){
        	// document.getElementById("event-details").innerHTML = "<strong>"+ info.event_place_name + "</strong><br> Location: " + info.event_place_location ;
        	// alert(marker.title);
        	window.open("#/event/"+info.id, '_parent');
        });
        
        //Extend each marker's position in LatLngBounds object.
        latlngbounds.extend(marker.position);
        
        //Get the boundaries of the Map.
        var bounds = new google.maps.LatLngBounds();
 
        //Center map and adjust Zoom based on the position of all markers.
        $scope.map.setCenter(latlngbounds.getCenter());
        $scope.map.fitBounds(latlngbounds);

        $scope.markers.push(marker);
        
    }  
    
    for (i = 0; i < Events.list().length; i++){
        createMarker(Events.list()[i]);
    }


    $scope.openInfoWindow = function(e, selectedMarker){
        e.preventDefault();
        google.maps.event.trigger(selectedMarker, 'click');
    }

}]);

myApp.controller('ShowEventController', ['$scope', '$log', '$routeParams', 'Events', function ($scope, $log, $routeParams, Events) {

	var id = $scope.event_id = $routeParams.eventId;
    $scope.events = Events.get(id);

}]);
