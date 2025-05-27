<?php 
    $id = htmlspecialchars($_GET["id"]) ?? -1;
    echo $id;
    include_once("DatabaseManager.php");
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $yes = $_POST["yes"] ?? false;
        $no = $_POST["no"] ?? false;
        if ($yes === "yes") {
            $id = htmlspecialchars($_GET["id"]) ?? -1;
            header("Location: index.php?todo=del&id=$id");
        }
        else{
            header("Location: index.php");
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4Q6Gf2aSP4eDXB8Miphtr37CMZZQ5oXLH2yaXMJ2w8e2ZtHTl7GptT4jmndRuHDT" crossorigin="anonymous">
    <title>Delete</title>
</head>
<body>
    <p>Are you sure you want do delete?</p>
    <h1>THIS ACTION IS NOT REVERSABLE!!!</h1>
    <form action="del.php" method="post">
        <div class="mb-3">
            <label for="yes" class="form-check-label">Yes</label>
            <input type="radio" class="form-check-input" name="yes" value="yes">
        </div>
        <div>
            <label for="no" class="form-check-label">No</label>
            <input type="radio" class="form-check-input" id="no" name="yes" value="no" checked>
        </div>
        <button type="submit" class="btn btn-warning">Confirm</button>
    </form>
</body>
</html>