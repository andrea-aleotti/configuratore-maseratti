<?php
include "./dbconn.inc.php";

$conn = openCon();
$car_id = $_REQUEST["car_id"];
$optional_id = $_REQUEST["optional_id"];

$sql = "SELECT optional.*, modelli.PrezzoBase AS 'PrezzoBase' FROM optional INNER JOIN modelli ON 
        optional.ModelloID=modelli.ModelloID WHERE optional.ModelloID = $car_id AND optional.OptionalID = $optional_id";
$query = mysqli_query($conn, $sql);
$json = "";

if(mysqli_num_rows($query) > 0) {
    $row = mysqli_fetch_assoc($query);
    $json .= "<p>" . round($row["PrezzoBase"] + $row["Prezzo"], 2) . " €</p>";
}

closeCon($conn);
echo json_encode($json);
die();