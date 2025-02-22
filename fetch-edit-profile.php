<?php
      include_once 'connect.php';

if(isset($_POST['profileID'])){
      $profileID = $_POST['profileID'];

      $query = "SELECT * FROM tbl_profile
            WHERE profileID='$profileID'";
      $result = mysqli_query($con, $query);



     $row = mysqli_fetch_array($result);
     echo json_encode($row);  

      	$con->close();

}
?>