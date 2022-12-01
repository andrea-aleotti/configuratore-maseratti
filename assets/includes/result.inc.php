<?php
include "./dbconn.inc.php";

$conn = openCon();
$car_id = $_REQUEST["car_id"];
$optional_id = $_REQUEST["optional_id"];

$sql = "SELECT optional.*, modelli.Nome AS 'NomeModello' FROM optional INNER JOIN modelli
        ON modelli.ModelloID=optional.ModelloID WHERE optional.ModelloID = $car_id AND optional.OptionalID = $optional_id";
//echo $sql;
$query = mysqli_query($conn, $sql);
$models_json = "";

if(mysqli_num_rows($query) > 0) {
    $result = mysqli_fetch_assoc($query);
    $models_json .= "<img src='assets/img/auto/".$result["NomeModello"]."/".$result["FileImage"]."' alt='immagine optional'>";
}

closeCon($conn);
echo json_encode($models_json);
die();

?>