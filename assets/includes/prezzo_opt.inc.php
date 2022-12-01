<?php
include "./dbconn.inc.php";

$conn = openCon();
$category_id = $_REQUEST["category_id"];
$optional_id = $_REQUEST["optional_id"];

$sql = "SELECT optional.*, categorieOptional.Nome AS 'NomeOptional' FROM optional INNER JOIN categorieOptional ON 
        optional.CategoriaOptionalID=categorieOptional.CategoriaID WHERE optional.CategoriaOptionalID = $category_id AND optional.OptionalID = $optional_id";
$query = mysqli_query($conn, $sql);
$json = "";

if(mysqli_num_rows($query) > 0) {
    $row = mysqli_fetch_assoc($query);
    $json .= "<h6>" . $row["NomeOptional"] . "</h6>";
    $json .= "<p>" . $row["Nome"] . ": " . $row["Prezzo"] . " €";
}

closeCon($conn);
echo json_encode($json);
die();