var z=angular.module("a",[]);
z.controller("mc",["$scope",function($scope){
	$('#myModal').modal({'show':false});

	$scope.check=true;
	$scope.distance=0;$scope.priceP=0;$scope.priceD=0;
	$scope.lat='';$scope.lat1='';
	$scope.long2='';$scope.long1='';
	$scope.submit=function(a,b,c,d)
	{$scope.l=d;
		if(c==1)
		{$scope.price=15;}
	else
	{$scope.price=5;}
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
			$scope.long2=results[0].geometry.location.lng();
		/*	alert($scope.lat+" "+$scope.long);*/}});
	var g1=new google.maps.Geocoder();

		//	alert(typeof(g));
			g1.geocode({'address':b.toString()},function(results,status){
			if(status==google.maps.GeocoderStatus.OK)
				{
				$scope.lat1=results[0].geometry.location.lat();
				$scope.long1=results[0].geometry.location.lng();
				/*alert($scope.lat1+" "+$scope.long1);*/$scope.dist();}});

	}


	//var latitude1 = 39.46;
	//var longitude1 = -0.36;
	//var latitude2 = 40.40;
	//var longitude2 = -3.68;
//alert($scope.lat+" "+$scope.long+" "+$scope.lat1+" "+$scope.long1);
$scope.dist=function()
{
	var distanc = google.maps.geometry.spherical.computeDistanceBetween(new google.maps.LatLng($scope.lat, $scope.long2), new google.maps.LatLng($scope.lat1, $scope.long1));
	// alert(distanc/1000);
	 var distance=distanc/1000;
	 var rateP=(distance/$scope.price)*70;
	 var rateD=(distance/$scope.price)*55;
//alert("detail are as--");
$scope.priceP=Math.ceil(rateP+$scope.l);
$scope.priceD=Math.ceil(rateD+$scope.l);//alert("lll");
$scope.distance=Math.ceil(distance);$scope.check=false;
$('#myModal').modal('show');
	 //alert(distance+" "+rateP+" "+rateD+" "+$scope.l);
}
	}]);
			/*g.geocode({'latLng':results[0].geometry.location},function(results,status){
				if(status==google.maps.GeocoderStatus.OK)
					{if(results[1])
					{

					var x=getLocality(results);
					}}
			});


			}


	});
	}


	getLocality=function(result)
	{
		//alert(result[0].formatted_address);
		var m=result[0].address_components;
		var x=0;var t;
		alert(m);
		for(;x<m.length;++x)
			{
			t=m[x].types;
			if(comp(t,'administrative_area_level_1'))
			{alert(m[x].long_name);}
			else if(comp(t,'locality'))
				{alert(m[x].long_name);}
			}



	}
	comp=function(t,s)
	{
		var z =0;
		for(;z<t.length;++z)
			{
			if(t[z]==s)
				{return true;}
			else
				{return false;}

			}

			}*/
