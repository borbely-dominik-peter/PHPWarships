<?php 
    include_once("DatabaseManager.php");
    include_once("Sort.php");
    
    $DatabaseManager = new DatabaseManager("localhost","root","","warships");

    $todo = $_GET["todo"] ?? "";
    $todo = htmlspecialchars($todo);

    $confirm = $_GET["confirm"] ?? "";
    $confirm = htmlspecialchars($confirm);

    $confirmres = $_GET["confirmres"] ?? "";
    $confirmres = htmlspecialchars($confirmres);

    $sort = $_GET["sort"] ?? "";
    $sort = htmlspecialchars($sort);

    $dir = $_GET["dir"] ?? "";
    $dir = htmlspecialchars($dir);

    $id = $_GET["id"] ?? -1;
    $id = htmlspecialchars($id);

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
        $WarningStr = "To confirm deletion, scroll to the selected item and click the confirm deletion button!";
        //echo "<b>To confirm deletion, scroll to the selected item and click the confirm deletion button!</b>";
    }
    if ($confirmres == "true") {
        $DatabaseManager->RemoveFromDB($id);
    }
    if ($todo == "mod") {
        var_dump($_POST);
        $name = htmlspecialchars($_POST["name"]) ?? "";
        $class = htmlspecialchars($_POST["class"]) ?? "";
        $year = htmlspecialchars($_POST["launched"]) ?? -1;
        $type = htmlspecialchars($_POST["type"]) ?? "";
        $MainGunCaliber = htmlspecialchars($_POST["MGunCal"]) ?? "";
        $country = htmlspecialchars($_POST["country"]) ?? "";
        $id = htmlspecialchars($_POST["id"]) ?? -1;
        $NewShip = new Ship($id,$name,$class,$type,$year,$MainGunCaliber,$country);
        $DatabaseManager->ModifyinDB($NewShip);
    }

    $Data = $DatabaseManager->GetAllData();
    if ($todo == "search") {
        $SearchQuery = $_POST["search"] ?? "";
        if ($SearchQuery === "") {
            $SearchQuery = $_GET["SQuery"] ?? "";
        }
        $Data = $DatabaseManager->Search($Data, $SearchQuery);
        echo sizeof($Data);
    }
    if ($sort != "") {
        $Data = TableSort($sort, $dir, $Data);
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
        <h1 class="text-center my-5">WW1 Warships</h1>
        <?php 
            if ($confirm == "sent") {
                echo "<p style='color:red; text-align:center;'><b>$WarningStr</b></p>";
            }
        ?>
        <div class="row mb-2">
            <div class="col-md-4 col-sm-12">
                <a href="Details.php?mod=false" class="btn btn-success">Add New</a>
            </div>
            <div class="col-md-6 col-sm-12">
                <form action="index.php?todo=search" method="POST">
                    <label for="search">Search(by name):</label>
                    <input type="text" id="search" name="search">
                    <button type="submit" class="btn btn-primary">Search</button>
                </form>
            </div>
            <div class="col-md-2">
                <a href="index.php" class="btn btn-warning">Reset Search and Sort</a>
            </div>
        </div>
        <table class="table table-striped">
            <thead>
                <th>Name <a href="index.php?<?= $SearchQuery !== null ? "todo=$todo&SQuery=$SearchQuery&" : "" ?>sort=name&dir=up">&uarr;</a> | <a href="index.php?<?= $SearchQuery !== null ? "todo=$todo&SQuery=$SearchQuery&" : "" ?>sort=name&dir=down">&darr;</a></th>
                <th>Class <a href="index.php?<?= $SearchQuery !== null ? "todo=$todo&SQuery=$SearchQuery&" : "" ?>sort=class&dir=up">&uarr;</a> | <a href="index.php?<?= $SearchQuery !== null ? "todo=$todo&SQuery=$SearchQuery&" : "" ?>sort=class&dir=down">&darr;</a></th>
                <th>Type <a href="index.php?<?= $SearchQuery !== null ? "todo=$todo&SQuery=$SearchQuery&" : "" ?>sort=type&dir=up">&uarr;</a> | <a href="index.php?<?= $SearchQuery !== null ? "todo=$todo&SQuery=$SearchQuery&" : "" ?>sort=type&dir=down">&darr;</a></th>
                <th>Launched <a href="index.php?<?= $SearchQuery !== null ? "todo=$todo&SQuery=$SearchQuery&" : "" ?>sort=launched&dir=up">&uarr;</a> | <a href="index.php?<?= $SearchQuery !== null ? "todo=$todo&SQuery=$SearchQuery&" : "" ?>sort=launched&dir=down">&darr;</a></th>
                <th>Main gun caliber <a href="index.php?<?= $SearchQuery !== null ? "todo=$todo&SQuery=$SearchQuery&" : "" ?>sort=MainGunCaliber&dir=up">&uarr;</a> | <a href="index.php?<?= $SearchQuery !== null ? "todo=$todo&SQuery=$SearchQuery&" : "" ?>sort=MainGunCaliber&dir=down">&darr;</a></th>
                <th>Country <a href="index.php?<?= $SearchQuery !== null ? "todo=$todo&SQuery=$SearchQuery&" : "" ?>sort=country&dir=up">&uarr;</a> | <a href="index.php?<?= $SearchQuery !== null ? "todo=$todo&SQuery=$SearchQuery&" : "" ?>sort=country&dir=down">&darr;</a></th>
                <th>Delete</th>
                <th>Modify</th>
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
                            echo "<td><a href='index.php?id=$d->id&confirm=done&confirmres=false' class='btn btn-success'>Cancel</td>";        
                        }
                        else{
                            echo "<td><a href='index.php?id=$d->id&confirm=sent' class='btn btn-warning'>Delete</td>";
                        }
                        echo "<td><a href='Details.php?mod=true&name=$d->name&class=$d->class&type=$d->type&launched=$d->launched&MGunCal=$d->MainGunCaliber&country=$d->country&id=$d->id' class='btn btn-secondary'>Modify</td>";
                        echo "</tr>";
                    }
                }

                ?>
            </tbody>
        </table>
    </div>
</body>
</html>