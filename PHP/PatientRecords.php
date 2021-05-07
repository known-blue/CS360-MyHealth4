<?php
   get_currentuserinfo();

   $user_id = get_current_user_id();
   $single = true;
   $id = 'user_registration_id';
   $userMetaValue = get_user_meta( $user_id, $id,$single);
   //echo'<center>Patient ID: ' . $userMetaValue. "</center>";
   $wpdb->query(
         $wpdb->prepare("SELECT * FROM PatientNotes WHERE PatientID = %.00f OR
               DrID = %.00f",$userMetaValue,$userMetaValue)
      );
      //Since there can be multiple row results from a query (or none),
      // we have a loop to list them all
   $length = count($wpdb->last_result);
   echo '&nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp'.'<u>Diagnosis: </u></br>';
   if($length == 0)
   {
      echo '<center> You currently have no notes.</center>';
   }
   for($i = 0;$i<$length;$i++)
   {
      //if statements to check current role and display appropriate info %.00f
      if(get_userdata($user_id)->roles[0] == 'doctor')
      {
         echo'<center>Patient ID: ' . $wpdb->last_result[$i]->PatientID. "</center>";
      }
      if(get_userdata($user_id)->roles[0] == 'patient')
      {
         echo'<center>Doctor ID: ' . $wpdb->last_result[$i]->DrID. "</center>";
      }
      echo'<center>Note ID: ' . $wpdb->last_result[$i]->PatientNoteID. "</center>";
      echo'<center>Date: ' . $wpdb->last_result[$i]->Date. "</center>";
      echo'<center>Note(s): ' . $wpdb->last_result[$i]->Notes. "</center>";
      echo'<center>Diagnosis: ' . $wpdb->last_result[$i]->Diagnosis. "</center>";
      if($length > 1 && $i != $length-1) //seperates listings, also checks if its on the last listing
      {
         echo'<center>----------------------------------------------------------</center>';
      }
   }
   echo'<center><b>-------------------------------------------------</b></center>';
   //&nbsp is tab
   echo '&nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp <u>Treatments: </u></br>';
   $wpdb->query(
         $wpdb->prepare("SELECT Perscriptions.TreatmentID, Treatments.TreatmentName
             FROM Treatments,Perscriptions
             WHERE Treatments.TreatmentID = Perscriptions.TreatmentID
             AND PatientID = %.00f ",$userMetaValue)
      );
      //Since there can be multiple row results from a query (or none),
      // we have a loop to list them all
   $length = count($wpdb->last_result);
   if($length == 0)
   {
      echo '<center> Wow, its looking pretty empty here</center>';
   }
   for($j = 0;$j<$length;$j++)
   {
      echo'<center>Treatment ID: ' . $wpdb->last_result[$j]->TreatmentID. "</center>";
      echo'<center>Name: ' . $wpdb->last_result[$j]->TreatmentName. "</center>";
      if($length > 1 && $j != $length-1) //seperates listings, also checks if its on the last listing
      {
         echo'<center>----------------------------------------------------------</center>';
      }
   }
?>
