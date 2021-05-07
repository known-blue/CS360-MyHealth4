<?php
   get_currentuserinfo();

   $user_id = get_current_user_id();
   $single = true;
   $id = 'user_registration_id';
   $userMetaValue = get_user_meta( $user_id, $id,$single);
   //echo'<center>Patient ID: ' . $userMetaValue. "</center>"; %.00f
   $wpdb->query(
         $wpdb->prepare("SELECT * FROM Appointments,Patients WHERE Appointments.DrID = %.00f AND
            Patients.PatientID = Appointments.PatientID",$userMetaValue)
      );
      //Since there can be multiple row results from a query (or none),
      // we have a loop to list them all
   $length = count($wpdb->last_result);
   if($length == 0)
   {
      echo '<center>You have no Appointments at the moment.</center>';
   }
   for($i = 0;$i<$length;$i++)
   {
      echo'<center>Appointment ID: ' . $wpdb->last_result[$i]->AppointmentID. "</center>";
      echo'<center>PatientID: ' . $wpdb->last_result[$i]->PatientID. "</center>";
      echo'<center>Patient Name: ' . $wpdb->last_result[$i]->NameFirst." ".
         $wpdb->last_result[$i]->NameLast. "</center>";
      if($length > 1 && $i != $length-1) //seperates listings, also checks if its on the last listing
      {
         echo'<center>----------------------------------------------------------</center>';
      }
   }

?>
