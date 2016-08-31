<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <title>Registration Form</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <style>
            div{
                height: 30px;
                width: 200px;
                display: inline-block;
            }
        </style>
    </head>
    <body>
        <?php
            include 'loginform.php';
        
            $id = $pw = "";
            $iderr = $pwerr = "";

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $id = input_filter($_POST["regid"]);
            $pw = input_filter($_POST["regpw"]);
            $check = true;
            if (empty($id)) {
                $iderr = "ID required";
                $check = FALSE;
            } else if (!preg_match("/[\w\d]+/", $id)) {
                $iderr = "Invalid ID";
                $check = FALSE;
            }

            if (empty($pw)) {
                $pwerr = "Password required";
                $check = FALSE;
            } else if (!preg_match("/.{8,}/", $pw)) {
                $pwerr = "Invalid Password";
                $check = FALSE;
            }
            if ($check == FALSE) {
                htmlspecialchars($_SERVER["PHP_SELF"]);
            }           
            else {
                register();
            }
        }
        
        function input_filter($input) {
            $input = trim($input);
            $input = stripslashes($input);
            $input = htmlspecialchars($input);
            return $input;
        }
        ?>
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"])?>">
            <div>ID</div> <input type="text" name="regid"> <span> <?php echo $iderr ?></span><br/>
            <div>Password</div> <input type="password" name="regpw"><span> <?php echo $pwerr ?></span><br/>
            <!--<div>Confirm password</div> <input type="password" name="regconfirmpw"><br/>-->            
            <input type="hidden" name="action" value="register"/>
            <input type="submit" value="Register">
        </form>
<!--        <script>
            function validate() {
                var id = document.getElementsByName("regid")[0].value;
                var pw = document.getElementsByName("regpw")[0].value;
                var valid = true;
                //document.write("ID is"+id+" PW is"+pw);
                if (id == "") {
                    document.getElementById("error1").innerHTML = "Enter an ID";
                    valid = false;
                }
                if (pw == "") {
                    document.getElementById("error1").innerHTML = "Enter an Password";
                    valid = false;
                }
                return valid;
            }
        </script>-->       
        
    </body>
</html>
