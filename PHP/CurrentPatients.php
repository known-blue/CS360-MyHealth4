<?php
   get_currentuserinfo();

   $user_id = get_current_user_id();
   $single = true;
   $id = 'user_registration_id';
   $userMetaValue = get_user_meta( $user_id, $id,$single);
   //echo'<center>Patient ID: ' . $userMetaValue. "</center>";
   $wpdb->query(
         $wpdb->prepare("SELECT * FROM SSDD,Patients WHERE SSDD.PatientID = Patients.PatientID
            AND DrID = %.00f",$userMetaValue)
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

      echo'<center>Patient ID: ' . $wpdb->last_result[$i]->PatientID. "</center>";
      echo'<center>Patient Name: ' . $wpdb->last_result[$i]->NameFirst.' ' .$wpdb->last_result[$i]->NameLast."</center>";
      if($length > 1 && $i != $length-1) //seperates listings, also checks if its on the last listing
      {
         echo'<center>----------------------------------------------------------</center>';
      }
   }

?>
