<?php
include "./dbconn.inc.php";

$conn = openCon();
$car_id = $_REQUEST["car_id"];
$sql = "SELECT * FROM categorieOptional ORDER BY Nome ASC";
$query = mysqli_query($conn, $sql);
$models_json = "";

if (mysqli_num_rows($query) > 0) {
    while ($row = mysqli_fetch_assoc($query)) {
        $models_json .= "<option value='" . $row["CategoriaID"] . "'>" . $row["Nome"] . "</option>";
    }
}
closeCon($conn);
echo json_encode($models_json);
die();