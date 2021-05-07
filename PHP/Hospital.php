<?php
get_currentuserinfo();

$user_id = get_current_user_id();
$single = true;
$id = 'user_registration_id';
$userMetaValue = get_user_meta( $user_id, $id,$single);
//echo'<center>Patient ID: ' . $userMetaValue. "</center>";
$wpdb->query(
      $wpdb->prepare("SELECT * FROM SSDH,Hospitals WHERE SSDH.PatientID = %.00f
         AND SSDH.HospitalID=Hospitals.HospitalID",$userMetaValue)
   );

   echo'<center>Hospital ID: ' . $wpdb->last_result[0]->HospitalID. "</center>";
   echo'<center>Hospital Name: ' . $wpdb->last_result[0]->HospitalName . "</center>";
   echo"</br></br></br>";
   echo"<center>If you would like to change hospitals, fill out the form below.</center>";

   if (!empty($_POST)) {
      $table = SSDH;
      $data = array(
          'HospitalID' => $_POST['hospitalID']
      );
      $where = array(
          'PatientID' => $userMetaValue
      );
      $success=$wpdb->update( $table, $data, $where );
      if($success){
           echo '<center>Hospital updated sucessfully!</center>' ;
      }
   } else {
      ?>
      <form method="post">
           New Hospital's ID Number: <input type="float" name="hospitalID"></br>
           <input type="submit">
      </form>
      <?php
   }
?>
