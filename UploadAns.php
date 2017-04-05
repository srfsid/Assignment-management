


<!DOCTYPE html>
<html>
<head>
   <title></title>
   <link type="text/css" rel="stylesheet" href="stylesheet.css"/>
</head>
<body>
<div class="centered">
<?php
require 'core.php';
require 'connect.php';

echo '<h3>Preview of uploaded file</h3>';

   if(isset($_FILES['ans'])){
      $errors= array();
      $file_name = $_FILES['ans']['name'];
      $file_size = $_FILES['ans']['size'];
      $file_tmp = $_FILES['ans']['tmp_name'];
      $file_type = $_FILES['ans']['type'];
      $file_ext=strtolower(end(explode('.',$_FILES['ans']['name'])));
      
      $expensions= array("txt");
      
      if(in_array($file_ext,$expensions)=== false){
         $errors[]="extension not allowed, please choose a .txt file.";
      }
      
      if($file_size > 2097152) {
         $errors[]='File size must be less than 2 MB';
      }
      
      if(empty($errors)==true) {
         move_uploaded_file($file_tmp,"uploads/teacher/Files/".$file_name);
         chmod ("uploads/teacher/Files/".$file_name ,0777);
         $rfile = fopen("uploads/teacher/Files/".$file_name,"r");
         $setn=0;
         $tset=1;
         while(!feof($rfile)) {
           $line = fgets($rfile);
		   echo nl2br($line."\n");
           if(strcmp($line,"Ans ".$tset.":\n")==0){
               $setn=$setn+1;
               $tset=$setn+1;
               $_SESSION['assign_ans'.$setn]="";
           }
           else
               $_SESSION['assign_ans'.$setn] = $_SESSION['assign_ans'.$setn].$line; 
          // echo $_SESSION['assign_ans'.$setn]; 
         }
         fclose($rfile);
		$_SESSION['auto_ans_set']=$setn;

      }else{
         print_r($errors);
      }
   }


   if(isset($_POST['Confirm'])){
      header('Location: assignment_success_auto.php');
   }
   
    if(isset($_POST['Cancel'])){
      header('Location: VariableAuto3.php');
   }

 
?>
      <form action = "assignment_success_auto.php" method = "POST">
         <button type = "submit" name = "ans" value = "Confirm">Confirm</button>
      </form>
	  
	  <form action = "VariableAuto3.php" method = "POST">
		 <button type = "submit" name = "cancel" value = "Cancel">Cancel</button>
      </form>

</div>
</body>
</html>

