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
   echo'   Prescription(s): ';
   $wpdb->query(
         $wpdb->prepare("SELECT * FROM Perscriptions WHERE PatientID = %.00f",$userMetaValue)
      );
      //Since there can be multiple row results from a query (or none),
      // we have a loop to list them all
   $length = count($wpdb->last_result);
   if($length == 0)
   {
      echo '<center> Wow, its looking pretty empty here</center>';
   }
   for($i = 0;$i<$length;$i++)
   {
     if(get_userdata($user_id)->roles[0] == 'doctor')
      {
         echo'<center>Patient ID: ' . $wpdb->last_result[$i]->PatientID. "</center>";
      }
      if(get_userdata($user_id)->roles[0] == 'patient')
      {
         echo'<center>Doctor ID: ' . $wpdb->last_result[$i]->DrID. "</center>";
      }
      echo'<center>Prescription ID: ' . $wpdb->last_result[$i]->TreatmentID. "</center>";
      echo'<center>Date: ' . $wpdb->last_result[$i]->Date. "</center>";
      echo'<center>Quantity: ' . $wpdb->last_result[$i]->Quantity. "</center>";
      if($length > 1 && $i != $length-1) //seperates listings, also checks if its on the last listing
      {
         echo'<center>----------------------------------------------------------</center>';
      }
   }

?>
