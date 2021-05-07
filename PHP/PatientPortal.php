<?php
   get_currentuserinfo();

   $user_id = get_current_user_id();
   $single = true;
   $id = 'user_registration_id';
   $userMetaValue = get_user_meta( $user_id, $id,$single);
   //echo'<center>Patient ID: ' . $userMetaValue. "</center>";
   $wpdb->query(
         $wpdb->prepare("SELECT * FROM Patients WHERE PatientID = %.00f",$userMetaValue)
      );
   echo'<center>Patient ID: ' . $wpdb->last_result[0]->PatientID. "</center>";
   echo'<center>First Name: ' . $wpdb->last_result[0]->NameFirst. "</center>";
   echo'<center>Last Name: ' . $wpdb->last_result[0]->NameLast. "</center>";
   echo'<center>DOB: ' . $wpdb->last_result[0]->DOB. "</center>";
   echo'<center>Address: ' . $wpdb->last_result[0]->Address. "</center>";
   echo'<center>Email: ' . $wpdb->last_result[0]->Email. "</center>";
   echo'<center>Phone: ' . $wpdb->last_result[0]->Phone. "</center>";
   echo'<center>Emergency Contact: ' . $wpdb->last_result[0]->EmergencyName. "</center>";
   echo'<center>Emergency Phone Number: ' . $wpdb->last_result[0]->EmergencyPhone. "</center>";
?>
