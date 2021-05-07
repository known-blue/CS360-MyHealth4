<?php
   get_currentuserinfo();

   $user_id = get_current_user_id();
   $single = true;
   $id = 'user_registration_id';
   $userMetaValue = get_user_meta( $user_id, $id,$single);
   //echo'<center>Patient ID: ' . $userMetaValue. "</center>"; %.00f
   $wpdb->query(
         $wpdb->prepare("SELECT Labs.LabName, Labs.LabID FROM Labs,SSDL WHERE Labs.LabID = SSDL.LabID AND SSDL.PatientID = %.00f",$userMetaValue)
      );
      //Since there can be multiple row results from a query (or none),
      // we have a loop to list them all
   $length = count($wpdb->last_result);
   if($length == 0)
   {
      echo '<center> You currently have no labs.</center>';
   }
   for($i = 0;$i<$length;$i++)
   {
      echo'<center>Lab ID: ' . $wpdb->last_result[$i]->LabID. "</center>";
      echo'<center>Lab: ' . $wpdb->last_result[$i]->LabName. "</center>";
      if($length > 1 && $i != $length-1) //seperates listings, also checks if its on the last listing
      {
         echo'<center>----------------------------------------------------------</center>';
      }
   }

?>
