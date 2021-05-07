<?php
get_currentuserinfo();

$user_id = get_current_user_id();
$single = true;
$id = 'user_registration_id';
$userMetaValue = get_user_meta( $user_id, $id,$single);
//echo'<center>Patient ID: ' . $userMetaValue. "</center>";
$wpdb->query(
      $wpdb->prepare("SELECT * FROM SSDD,Doctors WHERE SSDD.PatientID = %.00f
         AND SSDD.DrID=Doctors.DrID",$userMetaValue)
   );

   echo'<center>Doctor ID: ' . $wpdb->last_result[0]->DrID. "</center>";
   echo'<center>Doctor Name: ' . $wpdb->last_result[0]->NameFirst ." ".
      $wpdb->last_result[0]->NameLast."</center>";
   echo"</br></br></br>";
   echo"<center>If you would like to change your Doctor, fill out the form below.</center>";

   if (!empty($_POST)) {
      $table = SSDD;
      $data = array(
          'DrID' => $_POST['DrID']
      );
      $where = array(
          'PatientID' => $userMetaValue
      );
      $success=$wpdb->update( $table, $data, $where );
      if($success){
           echo '<center>Primary Doctor updated sucessfully!</center>' ;
      }
   } else {
      ?>
      <form method="post">
           New Doctor's ID Number: <input type="float" name="DrID"></br>
           <input type="submit">
      </form>
      <?php
   }
?>
