<?php
echo "<!-- Latest compiled and minified CSS -->
<link rel='stylesheet' href='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css'>

<!-- jQuery library -->
<script src='https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js'></script>

<!-- Latest compiled JavaScript -->
<script src='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js'></script>";
session_start();

$link=mysqli_connect('localhost','root','');

if(!$link)
{
    die('Failed to connect to server: ' . mysqli_error($link));
}

$db = mysqli_select_db($link,'highway');

if(!$db)
{
    die("Unable to select database");
}

$qry = "SELECT * FROM highways";

$result = mysqli_query($link,$qry);
echo "<a href='index2.html' style='font-size:25px;color:black;vertical-align:text-top'>Home</a>";
echo "<h1><marquee>MAJOR HIGHWAYS AND ROAD ROUTES</marquee></h1>";
echo "<table class='table table-hover table-bordered' height='500px' width='500px'>

<th> Highway Number</th>
<th> Length </th>
 <th> Passing Cities </th>";

while ($row = mysqli_fetch_assoc($result))
{
    echo"<tr class='success'>

  <td>".$row['highway_no']."</td>
  <td>".$row['length']."</td>
  <td>".$row['passing_cities']."</td>

  </tr>";
}
echo '</table>';
?>
