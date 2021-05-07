<?php
   get_currentuserinfo();

   $user_id = get_current_user_id();
   $single = true;
   $id = 'user_registration_id';
   $userMetaValue = get_user_meta( $user_id, $id,$single);
   //echo'<center>Patient ID: ' . $userMetaValue. "</center>"; %.00f
   $wpdb->query(
         $wpdb->prepare("SELECT * FROM Pharmacies WHERE PharmacyID =
           (SELECT PharmacyID FROM SSDO WHERE PatientID = %.00f)",$userMetaValue)
      );
      //Since there can be multiple row results from a query (or none),
      // we have a loop to list them all
   $length = count($wpdb->last_result);
   if($length == 0)
   {
      echo '<center> Wow, its looking pretty empty here</center>';
   }
   echo'   Current Pharmacy: </br>';
   for($i = 0;$i<$length;$i++)
   {
      echo'<center>Pharmacy ID: ' . $wpdb->last_result[$i]->PharmacyID. "</center>";
      echo'<center>Name: ' . $wpdb->last_result[$i]->PharmacyName. "</center>";
      echo'<center>Address: ' . $wpdb->last_result[$i]->Address. "</center>";
      echo'<center>Email: ' . $wpdb->last_result[$i]->Email. "</center>";
      echo'<center>Phone Number: ' . $wpdb->last_result[$i]->PhoneNumber. "</center>";
      if($length > 1 && $i != $length-1) //seperates listings, also checks if its on the last listing
      {
         echo'<center>---------------------------------------------------------</center>';
      }
   }
   echo'<center><b>-------------------------------------------------</b></center>';
   echo'</br></br></br>';
   echo'If you would like to change Pharmacies, please fill out the form below with the new Pharmacy\'s ID number.</br>';
   echo'A list of all available Pharmacies is also provided below.';

   if (!empty($_POST)) {
      $table = SSDO;
      $data = array(
          'PharmacyID' => $_POST['pharmID']
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
           New Pharmacy's ID Number: <input type="float" name="DrID"></br>
           <input type="submit">
      </form>
      <?php
   }

?>
