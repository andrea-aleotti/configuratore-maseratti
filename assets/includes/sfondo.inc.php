<?php
include "./dbconn.inc.php";

$conn = openCon();
$car_id = $_REQUEST["car_id"];

$sql = "SELECT * FROM modelli WHERE ModelloID = $car_id";
//echo $sql;
$query = mysqli_query($conn, $sql);
$models_json = "";

if(mysqli_num_rows($query) > 0) {
    $result = mysqli_fetch_assoc($query);
    $models_json .= "'assets/img/auto/".$result["Nome"]."/".$result["FileImageSfondo"]."'";
}

closeCon($conn);
echo json_encode($models_json);
die();

?>