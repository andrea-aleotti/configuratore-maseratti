<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Configuratore Maserati</title>
    <!-- Font awesome -->
    <script src="https://kit.fontawesome.com/3ac5c91e2b.js" crossorigin="anonymous"></script>
    <!-- Bootstrap 5-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- jQuery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <!-- stili -->
    <link rel="stylesheet" href="assets/css/style.css">
</head>

<body>
    <?php include "assets/parts/header.php"; ?>
    <?php include "assets/parts/carousel.php"; ?>
    <div id="configuratore" class="my-5 container-fluid px-5">
        <h1 class="mb-3">Configuratore</h1>
        <div class="row mb-5" id="selection">
            <!-- Modello -->
            <select class="col-md-3 mb-3 mx-3" id="models" name="models">
                <option value="-1" selected>Modello</option>
                <?php
                include "assets/includes/dbconn.inc.php";
                $conn = openCon();
                $sql = "SELECT * FROM modelli ORDER BY Nome ASC";
                $query = mysqli_query($conn, $sql);
                while ($row = mysqli_fetch_assoc($query)) {
                    echo "<option value='" . $row['ModelloID'] . "'>" . ucfirst($row["Nome"]) . "</option>";
                }
                mysqli_close($conn);
                ?>
            </select>

            <!-- Categoria optional -->
            <select class="col-md-3 mb-3 mx-3" id="categories" disabled>
                <option selected>Categoria optional</option>
            </select>

            <!-- Optional -->
            <select class="col-md-3 mb-3 mx-3" id="optionals" name="optionals" disabled>
                <option selected>Optional</option>
            </select>
        </div>
    </div>

    <?php include "assets/parts/footer.php"; ?>
    <script src="assets/js/script.js"></script>
</body>

</html>