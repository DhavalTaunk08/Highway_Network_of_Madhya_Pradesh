<?php
echo "
<!-- Latest compiled and minified CSS -->
<link rel='stylesheet' href='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css'>

<!-- jQuery library -->
<script src='https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js'></script>

<!-- Latest compiled JavaScript -->
<script src='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js'></script>
<script src='https://maps.googleapis.com/maps/api/js?libraries=places&libraries=geometry&key=AIzaSyBRt2I3ScvWqwE3Q_aHIwKrPAUfv8qHRYI'></script>

<script src='https://ajax.googleapis.com/ajax/libs/angularjs/1.6.4/angular.min.js'></script>
<script src='locate.js'></script>
<style>
body{background-image:url('10.jpg');background-size:1400px 1000px;}
</style>
"

;
session_start();

$link=mysqli_connect('localhost','root','');

if(!$link)
{
    die('Failed to connect to server: ' . mysqli_error());
}

$db = mysqli_select_db($link,'highway');

if(!$db)
{
    die("Unable to select database");
}
$c1=$_POST["city1"];
$c2=$_POST["city2"];
$c3=$_POST["vehicle"];

$qry = "SELECT pincode FROM cities
        WHERE city='$c1'";

$result = mysqli_query($link,$qry);

while ($row = mysqli_fetch_assoc($result))
{
  $i=$row['pincode'];
}

$qry = "SELECT pincode FROM cities
        WHERE city='$c2'";

$result = mysqli_query($link,$qry);

while ($row = mysqli_fetch_assoc($result))
{
  $j=$row['pincode'];
}

if($c3=="Car/Van"){
  $qry = "SELECT toll_price FROM highway_details
          WHERE  start_city=$i AND end_city=$j
          OR start_city=$j AND end_city=$i";

  $result = mysqli_query($link,$qry);

  while ($row = mysqli_fetch_assoc($result))
  {
    $k=$row['toll_price'];
  }
}
  else {
    $qry = "SELECT toll_price2 FROM highway_details
            WHERE  start_city=$i AND end_city=$j
            OR start_city=$j AND end_city=$i";

    $result = mysqli_query($link,$qry);

    while ($row = mysqli_fetch_assoc($result))
    {
      $k=$row['toll_price2'];
    }
  }
  if($i==$j){
    header('location:redirect1.html');
  }
  else{
  $city = array($i, $j, $k);
 /* for ($a=0; $a < 3; $a++) {
      echo $city[$a]."<br>";
  }*/
    $_SESSION['çity']=$city;echo "<body ng-app='a' ng-controller='mc' ng-model='check'>";

echo "<button  ng-show='check' type='button' class='btn btn-primary btn-lg btn-block' ng-click='submit($city[0],$city[1],$c3,$city[2])' style='position:relative;top:200px;' >";
echo "Double Click To Calculate</button><br>";
echo "<div ng-hide='check' style='font-size:30px;'><a href='index2.html' style='font-size:25px;color:white;vertical-align:text-top'>Home</a><div class='modal-dialog'><div class='modal-content'><div class='modal-header'><h1><b>STATS<span class='glyphicon glyphicon-th'></span></b></div><div class='modal-body'><p>Rs. {{priceP}} if using PETROL vehicle</p><p>Rs. {{priceD}} if using DIESEL vehicle</p><p>{{distance}}kms is the total DISTANCE travelled </div><h4 style:'position:realtive;left:50px;'>NOTE: Petrol Price = Rs70(approx) <br>Diesel Price = Rs55(approx)<br><br>Mileage: Car/Van = 15km/lit. <br> Bus/Truck = 5km/lit.</h4></div></div>";
/*echo "<!-- Modal -->
<div ng-hide='check' id='myModal' class='modal fade' role='dialog'>
  <div class='modal-dialog'>

    <!-- Modal cont>
    <div class='modal-content'>
      <div class='modal-header'>
        <button type='button' class='close' data-dismiss='modal'>&times;</button>
        <h4 class='modal-title'>STATS Of Your Trip</h4>
      </div>
      <div class='modal-body'>
        <p ng-model='priceP'>Rs{{priceP}} if using PETROL </p>
		<p ng-model='priceD'>Rs {{priceD}} if using DIESEL</p>
		<p ng-model='distance'>{{distance}}kms is the total distance between two cities</p>
      </div>
      <div class='modal-footer'>
        <button type='button' class='btn btn-default' data-dismiss='modal'>Close</button>
      </div>
    </div>

  </div>
</div>";*/
}

  ?>
