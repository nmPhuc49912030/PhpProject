<?php

include 'index.php';
connectDB("loginform");

//$accid =  $accpw = $id0 = $pw0 = "";      
function login() {
    $accid = htmlspecialchars(isset($_POST["id"]) ? $_POST["id"] : '');
    $accpw = htmlspecialchars(isset($_POST["pw"]) ? $_POST["pw"] : '');
    $sql = "select AccID, AccPW from logindata where AccID = ?";
    $stm = $GLOBALS['conn']->prepare($sql);

    try {
        $stm->execute(array($accid));
        $rs = $stm->fetch(PDO::FETCH_NUM, PDO::FETCH_ORI_NEXT);        
        if ($rs == false) {
            echo "<div>The Account does not exist</div>";
        } else if ($rs[1] != $accpw) {
            echo "<div>Wrong password</div>";
        } else {
            header("Location: http://google.com");
            exit();
        }
    } catch (Exception $ex) {
        echo $sql . "<br>" . $ex->getMessage();
    }
}

function register() {

    $id0 = htmlspecialchars(isset($_POST['regid']) ? $_POST['regid'] : '');
    $pw0 = htmlspecialchars(isset($_POST['regpw']) ? $_POST['regpw'] : '');
    
    if ($id0 != "" and $pw0 != "") {
        $sql = "INSERT INTO logindata(AccID, AccPW) VALUES ('" . $id0 . "','" . $pw0 . "')";
        try {            
            $GLOBALS['conn']->exec($sql);
            echo "Account created successfully<br/>";
            echo "<a href=\"login.html\">Click to login</a>";
        } catch (PDOException $e) {
            echo $sql . "<br>" . $e->getMessage();
        }
    }
}

function uploadFile (){
    $target_dir = "PhpProject1/";
    $file = $_FILES["fileupload"]["name"];
    $target_file = "C:/xampp/htdocs/PhpProject1/". basename($file);
    
    $uploadOK = 1;
    
    if ($_FILES["fileupload"]["size"] > 500){
        echo "File too large";
        $uploadOK = 0;
    }
    
    if ($uploadOK == 1){        
        if (move_uploaded_file($_FILES["fileupload"]["tmp_name"], $target_file)){
            echo "The file".basename($file)." has been uploaded";
        }
        else{
            echo "upload error";
        }
    }
    else{
        echo "file cannot be uploaded";
    }
}

$action = htmlspecialchars(isset($_POST['action']) ? $_POST['action'] : '');
//if ($action == 'register') {
//    register();
//} else 
if ($action == 'login'){
    login();
} else if ($action == 'upload'){
    uploadFile();
}

?>    





