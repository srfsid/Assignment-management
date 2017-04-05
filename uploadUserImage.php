<?php
require 'core.php';
require 'connect.php';

if($_SESSION['user_type']==1){
    $target_dir = "uploads/teacher/UserImages/";
}
else{
    $target_dir = "uploads/student/UserImages/";
}

$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
$uploadOk = 1;
$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
// Check if image file is a actual image or fake image
if(isset($_POST["submit"])) {
    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
    if($check !== false) {
        //echo "File is an image - " . $check["mime"] . ".";
        $uploadOk = 1;
        
    } else {
        echo "File is not an image.";
        $uploadOk = 0;
    }

}
// Check if file already exists
if (file_exists($target_file)) {
    echo "Sorry, file already exists.";
    $uploadOk = 0;
}
// Check file size
if ($_FILES["fileToUpload"]["size"] > 5000000) {
    echo "Sorry, your file is too large.";
    $uploadOk = 0;
}
// Allow certain file formats
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
&& $imageFileType != "gif" ) {
    echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
    $uploadOk = 0;
}
// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
    echo "Sorry, your file was not uploaded.";
// if everything is ok, try to upload file
} else {
    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
        //echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";
        if($_SESSION['user_type']==1){

            $query = sprintf("SELECT * FROM images WHERE UserType = '%d' AND ID = '%d'",
                mysqli_real_escape_string($link,$_SESSION['user_type']),
                mysqli_real_escape_string($link,$_SESSION['user_id'])
                );
            $query_run = mysqli_query($link,$query);
            if($query_run){
                $query_num_rows = mysqli_num_rows($query_run);
                if($query_num_rows==0){
                    $query = sprintf("INSERT INTO images VALUES('','1','%d','%s');",
                              mysqli_real_escape_string($link,$_SESSION['user_id']),
                              mysqli_real_escape_string($link,$target_file));
                    $query_run = mysqli_query($link,$query);
                    if($query_run){
                        header('Location: profile_teacher.php');
                    }

                }
                else{

                    $query = sprintf("UPDATE images SET Link = '%s' ",
                              mysqli_real_escape_string($link,$target_file));
                    $query_run = mysqli_query($link,$query);
                    if($query_run){
                        header('Location: profile_teacher.php');
                    }
                }
            }


        }
        else if($_SESSION['user_type']==2){
            $query = sprintf("SELECT * FROM images WHERE UserType = '%d' AND ID = '%d'",
                mysqli_real_escape_string($link,$_SESSION['user_type']),
                mysqli_real_escape_string($link,$_SESSION['user_id'])
                );
            $query_run = mysqli_query($link,$query);
            if($query_run){
                $query_num_rows = mysqli_num_rows($query_run);
                if($query_num_rows==0){
                    $query = sprintf("INSERT INTO images VALUES('','2','%d','%s');",
                              mysqli_real_escape_string($link,$_SESSION['user_id']),
                              mysqli_real_escape_string($link,$target_file));
                    $query_run = mysqli_query($link,$query);
                    if($query_run){
                        header('Location: profile_student.php');
                    }

                }
                else{

                    $query = sprintf("UPDATE images SET Link = '%s' ",
                              mysqli_real_escape_string($link,$target_file));
                    $query_run = mysqli_query($link,$query);
                    if($query_run){
                        header('Location: profile_student.php');
                    }
                }
            }  
        }
    
    } else {
        echo "Sorry, there was an error uploading your file.";
    }
}

/*

<!DOCTYPE HTML>
<html>
<head> </head>
<body>
<img src="." id = "img">
</body>
</html>

*/

?>



