<?php 
    include_once("DatabaseManager.php");
    
    $DatabaseManager = new DatabaseManager("localhost","root","","warships");

    $todo = htmlspecialchars($_GET["todo"]) ?? "";
    $confirm = htmlspecialchars($_GET["confirm"]) ?? "";
    $confirmres = htmlspecialchars($_GET["confirmres"]) ?? "";
    $id = htmlspecialchars($_GET["id"]) ?? "";
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
    if ($confirm == "sent") {
        echo "<b>To confirm deletion, scroll to the selected item and click the confirm deletion button!</b>";
    }
    if ($confirmres == "true") {
        $DatabaseManager->RemoveFromDB($id);
    }
    $Data = $DatabaseManager->GetAllData();

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
                if ($confirm != "yes") {
                    foreach($Data as $d){
                        echo "<tr>";
                        echo "<td>$d->name</td>";
                        echo "<td>$d->class</td>";
                        echo "<td>$d->type</td>";
                        echo "<td>$d->launched</td>";
                        echo "<td>$d->MainGunCaliber</td>";
                        echo "<td>$d->country</td>";
                        if ($confirm == "sent" && $id == $d->id) {
                            echo "<td><a href='index.php?id=$d->id&confirm=done&confirmres=true' class='btn btn-danger'>Confirm deletion</td>";        
                            echo "<td><a href='index.php?id=$d->id&confirm=done&confirmres=false' class='btn btn-danger'>Cancel</td>";        

                        }
                        else{
                            echo "<td><a href='index.php?id=$d->id&confirm=sent' class='btn btn-warning'>Delete</td>";
                        }
                        echo "</tr>";
                    }
                }

                ?>
            </tbody>
        </table>
    </div>
</body>
</html>