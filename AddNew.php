<?php 
    include_once("DatabaseManager.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4Q6Gf2aSP4eDXB8Miphtr37CMZZQ5oXLH2yaXMJ2w8e2ZtHTl7GptT4jmndRuHDT" crossorigin="anonymous">

    <title>Add New</title>
</head>
<body>
    <form method="POST" action="index.php?todo=add">
        <div class="mb-3">
            <label for="name" class="form-label">Name:</label>
            <input type="text" class="form-control" id="name" name="name">
        </div>
        <div class="mb-3">
            <label for="class" class="form-label">Class:</label>
            <input type="text" class="form-control" id="class" name="class">
        </div>
        <div class="mb-3">
            <select name="type" id="type">
                <?php 
                    $Options = ["Battleship", "Battlecruiser", "Armoured Cruiser", "Protected Cruiser", "Scout Cruiser", "Light Cruiser", "Destroyer", "Submarine"];
                    foreach($Options as $opt){
                        echo "<option value='$opt'>$opt</option>";
                    }
                ?>
            </select>
        </div>
        <div class="mb-3">
            <label for="launched" class="form-label">Launch Year:</label>
            <input type="number" class="form-control" id="launched" name="launched">
        </div>
        <div class="mb-3">
            <label for="MGunCal" class="form-label">Main gun caliber:</label>
            <input type="text" class="form-control" id="MGunCal" name="MGunCal">
        </div>
        <div class="mb-3">
            <label for="country" class="form-label">Country:</label>
            <input type="text" class="form-control" id="country" name="country">
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</body>
</html>