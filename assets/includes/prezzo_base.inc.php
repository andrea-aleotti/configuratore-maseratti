<?php
include "./dbconn.inc.php";

$conn = openCon();
$car_id = $_REQUEST["car_id"];
$sql = "SELECT * FROM modelli WHERE ModelloID = $car_id";
$query = mysqli_query($conn, $sql);
$json = "";

if(mysqli_num_rows($query) > 0) {
    $row = mysqli_fetch_assoc($query);
    $json .= "<h5 class='text-muted'>Prezzo base</h5>";
    $json .= "<p>" . $row["PrezzoBase"] . " € </p>";
}

closeCon($conn);
echo json_encode($json);
die();