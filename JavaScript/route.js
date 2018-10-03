var q=angular.module("a",[]);
q.controller("mc",["$scope",function($scope){
	$scope.name;$scope.name1;$scope.name2;
	$scope.lat='';$scope.lat1='';
	$scope.long2='';$scope.long1='';
	$scope.submit=function(c2,c1,a,b)
	{
		$scope.name=c1;
		$scope.name1=c2;
		//alert(c2);
		//alert(c1);
		//alert("in submit");
		//alert(a+" "+b);
		var g=new google.maps.Geocoder();
	//	alert(typeof(g));
		//alert("l");
		g.geocode({'address':a.toString()},function(results,status){
		if(status==google.maps.GeocoderStatus.OK)
			{
			//alert("in");
			$scope.lat=results[0].geometry.location.lat();
		$scope.long2=results[0].geometry.location.lng();}});
			//alert($scope.lat+" "+$scope.long2);}});
	var g1=new google.maps.Geocoder();

		//	alert(typeof(g));
			g1.geocode({'address':b.toString()},function(results,status){
			if(status==google.maps.GeocoderStatus.OK)
				{
				$scope.lat1=results[0].geometry.location.lat();
				$scope.long1=results[0].geometry.location.lng();
		$scope.route();}});}
	//	alert("pp");
			$scope.route=function()
			{
				//var x=20.99
				 var myStyle = [
       {
         featureType: "administrative",
         elementType: "labels",
         stylers: [
           { visibility: "on" }
         ]
       },{
         featureType: "poi",
         elementType: "labels",
         stylers: [
           { visibility: "on" }
         ]
       },{
         featureType: "water",
         elementType: "labels",
         stylers: [
           { visibility: "on" }
         ]
       },{
         featureType: "road",
         elementType: "labels",
         stylers: [
           { visibility: "off" }
         ]
       }
     ];
			    var markers = [
			            {
			               // "title": $scope.name,
			                "lat": $scope.lat,
			                "lng": $scope.long2,
			                "description": $scope.name
			            }
			        ,
			            {
			               // "title": $scope.name,
			                "lat": $scope.lat1,
			                "lng": $scope.long1,
			                "description": $scope.name
			            }
			        ,
			            {
			                //"title": $scope.name,
			                "lat": $scope.lat,
			                "lng": $scope.long2,
			                "description":$scope.name
			            }
			    ];

				var mapOptions = {
					mapTypeControlOptions: {
         mapTypeIds: ['mystyle', google.maps.MapTypeId.ROADMAP, google.maps.MapTypeId.TERRAIN]
       },
		                center: new google.maps.LatLng(markers[0].lat, markers[0].lng),
		                zoom: 7,
		                mapTypeId: 'mystyle'
		            };
					var map = new google.maps.Map(document.getElementById("map"), mapOptions);
					 map.mapTypes.set('mystyle', new google.maps.StyledMapType(myStyle, { name: 'My Style' }));
		            //var map = new google.maps.Map(document.getElementById("map"), mapOptions);
		            var infoWindow = new google.maps.InfoWindow();
		            var lat_lng = new Array();
		            var latlngbounds = new google.maps.LatLngBounds();
		            for (i = 0; i < markers.length; i++) {
		                var data = markers[i]
		                var myLatlng = new google.maps.LatLng(data.lat, data.lng);
		                lat_lng.push(myLatlng);
		                var marker = new google.maps.Marker({
		                    position: myLatlng,
		                    map: map,
		                    title: data.title
		                });
		                latlngbounds.extend(marker.position);
		                (function (marker, data) {
		                    google.maps.event.addListener(marker, "click", function (e) {
		                        infoWindow.setContent(data.description+"---\ntotal length of the complete highway="+$scope.name1+"kms");
		                        infoWindow.open(map, marker);
		                    });
		                })(marker, data);
		            }
		            map.setCenter(latlngbounds.getCenter());
		            map.fitBounds(latlngbounds);

		            //***********ROUTING****************//

		            //Initialize the Path Array
		            var path = new google.maps.MVCArray();

		            //Initialize the Direction Service
		            var service = new google.maps.DirectionsService();

		            //Set the Path Stroke Color
		            var poly = new google.maps.Polyline({ map: map, strokeColor: '#4986E7' });

		            //Loop and Draw Path Route between the Points on MAP
		            for (var i = 0; i < lat_lng.length; i++) {
		                if ((i + 1) < lat_lng.length) {
		                    var src = lat_lng[i];
		                    var des = lat_lng[i + 1];
		                    path.push(src);
		                    poly.setPath(path);
		                    service.route({
		                        origin: src,
		                        destination: des,
		                        travelMode: google.maps.DirectionsTravelMode.DRIVING
		                    }, function (result, status) {
		                        if (status == google.maps.DirectionsStatus.OK) {
		                            for (var i = 0, len = result.routes[0].overview_path.length; i < len; i++) {
		                                path.push(result.routes[0].overview_path[i]);
		                            }
		                        }
		                    });
		                }
		            }


			}



}]);
