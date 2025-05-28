<?php 
    include_once("DatabaseManager.php");

    if ($_GET["mod"] == "true") {
        $id = $_GET["id"] ?? -1;
        $name = $_GET["name"] ?? "";
        $class = $_GET["class"] ?? "";
        $type = $_GET["type"] ?? "";
        $launched = $_GET["launched"] ?? -1;
        $MGunCal = $_GET["MGunCal"] ?? "";
        $country = $_GET["country"] ?? "";
    }
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
    <form method="POST" action="<?php if ($_GET["mod"] == "true") {
        echo "index.php?todo=mod";
    }else {
        echo "index.php?todo=add";
    }?>">
        <input type="number" name="id" id="id" hidden value="<?php 
                if ($_GET["mod"] == "true" && $id != "") {
                    echo $id;
                }
            ?>">
        <div class="mb-3">
            <label for="name" class="form-label">Name:</label>
            <input type="text" class="form-control" id="name" name="name" value="<?php 
                if ($_GET["mod"] == "true" && $name != "") {
                    echo " $name ";
                }
            ?>">
        </div>
        <div class="mb-3">
            <label for="class" class="form-label">Class:</label>
            <input type="text" class="form-control" id="class" name="class" value="<?php 
                if ($_GET["mod"] == "true" && $class != "") {
                    echo " $class ";
                }
            ?>">
        </div>
        <div class="mb-3">
            <select name="type" id="type">
                <?php 
                    $Options = ["Battleship", "Battlecruiser", "Armoured Cruiser", "Protected Cruiser", "Scout Cruiser", "Light Cruiser", "Destroyer", "Submarine"];
                    foreach($Options as $opt){
                        if ($_GET["mod"] == "true" && $opt == $type) {
                            echo "<option value='$opt' selected >$opt</option>";
                        }
                        else{
                            echo "<option value='$opt'>$opt</option>";
                        }
                    }
                ?>
            </select>
        </div>
        <div class="mb-3">
            <label for="launched" class="form-label">Launch Year:</label>
            <input type="number" class="form-control" id="launched" name="launched" value="<?php 
                if ($_GET["mod"] == "true" && $launched != "") {
                    echo $launched;
                }
            ?>">
        </div>
        <div class="mb-3">
            <label for="MGunCal" class="form-label">Main gun caliber:</label>
            <input type="text" class="form-control" id="MGunCal" name="MGunCal" value="<?php 
                if ($_GET["mod"] == "true" && $MGunCal != "") {
                    echo " $MGunCal ";
                }
            ?>">
        </div>
        <div class="mb-3">
            <label for="country" class="form-label">Country:</label>
            <input type="text" class="form-control" id="country" name="country" value="<?php 
                if ($_GET["mod"] == "true" && $country != "") {
                    echo " $country ";
                }
            ?>">
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</body>
</html>