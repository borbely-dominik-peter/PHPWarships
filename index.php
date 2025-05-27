<?php 
    include_once("DatabaseManager.php");
    
    $DatabaseManager = new DatabaseManager("localhost","root","","warships");
    $Data = $DatabaseManager->GetAllData();
    $todo = htmlspecialchars($_GET["todo"]) ?? "";
    $confirm = htmlspecialchars($_GET["confirm"]) ?? "";
    if ($todo == "add") {
        $name = htmlspecialchars($_POST["name"]) ?? "";
        $class = htmlspecialchars($_POST["class"]) ?? "";
        $year = htmlspecialchars($_POST["launched"]) ?? -1;
        $type = htmlspecialchars($_POST["type"]) ?? "";
        $MainGunCaliber = htmlspecialchars($_POST["MGunCal"]) ?? "";
        $country = htmlspecialchars($_POST["country"]) ?? "";
        $NewShip = new Ship(null,$name,$class,$type,$year,$MainGunCaliber,$country);
        $DatabaseManager->AddToDB($NewShip);
    }
    if ($confirm == "yes") {
        echo "
    <p>Are you sure you want do delete?</p>
    <h1>THIS ACTION IS NOT REVERSABLE!!!</h1>
    <form action='del.php' method='post'>
        <div class='mb-3'>
            <label for='yes' class='form-check-label'>Yes</label>
            <input type='radio' class='form-check-input' name='yes' value='yes'>
        </div>
        <div>
            <label for='no' class='form-check-label'>No</label>
            <input type='radio' class='form-check-input' id='no' name='yes' value='no' checked>
        </div>
        <button type='submit' class='btn btn-warning'>Confirm</button>
    </form>";
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4Q6Gf2aSP4eDXB8Miphtr37CMZZQ5oXLH2yaXMJ2w8e2ZtHTl7GptT4jmndRuHDT" crossorigin="anonymous">
    <title>WW1 Warships</title>
</head>
<body>
    <div id="main" class="container">
        <h1>WW1 Warships</h1>
        <a href="AddNew.php" class="btn btn-success">Add New</a>
        <table class="table table-striped">
            <thead>
                <th>Name</th>
                <th>Class</th>
                <th>Type</th>
                <th>Launched</th>
                <th>Main gun caliber</th>
                <th>Country</th>
                <th>Delete</th>
            </thead>
            <tbody>
                <?php 
                    foreach($Data as $d){
                        echo "<tr>";
                        echo "<td>$d->name</td>";
                        echo "<td>$d->class</td>";
                        echo "<td>$d->type</td>";
                        echo "<td>$d->launched</td>";
                        echo "<td>$d->MainGunCaliber</td>";
                        echo "<td>$d->country</td>";
                        echo "<td><a href='index.php?id=$d->id&confirm=yes' class='btn btn-danger'>Delete</td>";
                        echo "</tr>";
                    }
                ?>
            </tbody>
        </table>
    </div>
</body>
</html>