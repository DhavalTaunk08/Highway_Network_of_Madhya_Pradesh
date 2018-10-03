<?php

session_start();
echo "
<!-- Latest compiled and minified CSS -->
<link rel='stylesheet' href='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css'>

<!-- jQuery library -->
<script src='https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js'></script>

<!-- Latest compiled JavaScript -->
<script src='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js'></script>
<script src='https://maps.googleapis.com/maps/api/js?libraries=places&libraries=geometry&key=AIzaSyBRt2I3ScvWqwE3Q_aHIwKrPAUfv8qHRYI'></script>

<script src='https://ajax.googleapis.com/ajax/libs/angularjs/1.6.4/angular.min.js'></script>
<script src='route.js'>
</script>
<style>
body{background-image:url('3.jpg');background-size:1368px 1000px;}
</style>

";
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

$qry = "SELECT highway_num FROM highway_details
         WHERE start_city=$i AND end_city=$j
         OR start_city=$j AND end_city=$i";

$result = mysqli_query($link,$qry);

while ($row = mysqli_fetch_assoc($result))
{
    $k=$row['highway_num'];
}

$qry = "SELECT length FROM highways
         WHERE highway_no='$k'";

$result = mysqli_query($link, $qry);

while ($row = mysqli_fetch_assoc($result))
{
    $l = $row['length'];
}

$qry = "SELECT passing_cities FROM highways
         WHERE highway_no='$k'";

$result = mysqli_query($link, $qry);

while ($row = mysqli_fetch_assoc($result))
{
    $m = $row['passing_cities'];
}
if($i==$j){
  header('location:redirect.html');
}
else{
$city = array($i, $j, $k, $l, $m);
/*for ($a=0; $a < 3; $a++) {
    echo $city[$a]."<br>";
}*/
$_SESSION['city']=$city;

echo "<body ng-app='a' ng-controller='mc'><button style='position:relative;top:300px;' type='button' class='btn btn-success btn-block btn-lg' ng-click=submit('$l','$k','$city[0]','$city[1]')>Click To See Route</button><div id='map' style='height:1000px;width:1400px' style='border:1px inset black'></div></body>";
}
?>
