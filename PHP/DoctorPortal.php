<?php
   get_currentuserinfo();

   $user_id = get_current_user_id();
   $single = true;
   $id = 'user_registration_id';
   $userMetaValue = get_user_meta( $user_id, $id,$single);
   //echo'<center>Patient ID: ' . $userMetaValue. "</center>";
   $wpdb->query(
         $wpdb->prepare("SELECT * FROM Doctors WHERE DrID = %.00f",$userMetaValue)
      );
   echo'<center>Doctor ID: ' . $wpdb->last_result[0]->DrID. "</center>";
   echo'<center>First Name: ' . $wpdb->last_result[0]->NameFirst. "</center>";
   echo'<center>Last Name: ' . $wpdb->last_result[0]->NameLast. "</center>";
   echo'<center>Email: ' . $wpdb->last_result[0]->Email. "</center>";

?>
