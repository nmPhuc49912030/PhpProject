<?php
$conn = "";

//        // Create connection
//        $conn = new mysqli($servername, $username, $password);
//
//        // Check connection
//        if ($conn->connect_error) {
//            die("Connection failed: " . $conn->connect_error);
//        }
//        echo "Connected successfully";
function connectDB($dbname) {
    try {
        $servername = "localhost";
        $username = "root";
        $password = "";
        $GLOBALS['conn'] = new PDO("mysql:host=$servername;dbname=" . $dbname . "", $username, $password);
        // set the PDO error mode to exception
        $GLOBALS['conn']->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        echo "Connected successfully<br/>";
    } catch (PDOException $e) {
        echo "Connection failed: " . $e->getMessage();
    }
}

function insertData() {
    $n = htmlspecialchars($_POST["fname"]);
    $q = htmlspecialchars($_POST["fquantity"]);
    $p = htmlspecialchars($_POST["fprice"]);

    if ($n != "" and $q != 0 and $p != 0) {
        $sql = "INSERT INTO cdinfo(Name, Quantity, Price) VALUES ('$n','$q','$p')";
        try {
            $GLOBALS['conn']->exec($sql);
            echo "New record created successfully";
        } catch (PDOException $e) {
            echo $sql . "<br>" . $e->getMessage();
        }
    }
}

function printData() {
    $sql = "SELECT id, Name, quantity, price FROM cdinfo";
    $statement = $GLOBALS['conn']->prepare($sql);
    try {
        $statement->execute();
        //$row = $statement->fetch();
        //$statement->bind_result($id, $name, $quan, $price);                
        echo "Records extracted successfully<br/>";
        echo "<table><tr><th>ID</th><th>Name</th><th>Quantity</th><th>Price</th></tr>";
        while ($row = $statement->fetch(PDO::FETCH_NUM, PDO::FETCH_ORI_NEXT)) {
            echo "<tr><td>" . $row[0] . "</td><td>" . $row[1] . "</td><td>" . $row[2] . "</td><td>" . $row[3] . "</td></tr>";
        }
        echo "</table>";
    } catch (Exception $e) {
        echo $sql . "<br>" . $e->getMessage();
    }
}

$conn = NULL;
?> 
