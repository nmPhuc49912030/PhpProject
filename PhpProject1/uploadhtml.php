<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <title>Upload Form</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
    </head>
    <body>
        <form action="loginform.php" method="post" enctype="multipart/form-data">
            Select File to upload<br/>
            <input type="file" name="fileupload">
            <input type="hidden" name="action" value="upload">
            <input type="submit" name="submit" value="Upload">
        </form>
    </body>
</html>
