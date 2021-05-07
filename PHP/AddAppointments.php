<?php
   get_currentuserinfo();

   $user_id = get_current_user_id();
   $single = true;
   $id = 'user_registration_id';
   $userMetaValue = get_user_meta( $user_id, $id,$single);
   //echo'<center>Patient ID: ' . $userMetaValue. "</center>";
   $wpdb->query(
         $wpdb->prepare("SELECT * FROM SSDD,Doctors WHERE SSDD.PatientID = %.00f AND
             Doctors.DrID = SSDD.DrID",$userMetaValue)
      );
   $length = count($wpdb->last_result);
   if($length > 0)
   {
      $dr = $wpdb->last_result[0]->DrID;
     echo '<center>Your appointment will be with your current doctor: Dr. '.
         $wpdb->last_result[0]->NameFirst ." ".$wpdb->last_result[0]->NameLast.'</center>';
     if (!empty($_POST)) {
         $table = Appointments;
         $data = array(
            'DrID' => $dr,
            'PatientID' => $userMetaValue,
            'Date' => $_POST['date'],
            'Time'=> $_POST['time']
         );
         $format = array(
             '%.00f',
             '%.00f',
             '%.00f',
             '%s', //Date is a varchar
             '%s'//Time is a varchar in the Appointments database
         );
         $success=$wpdb->insert( $table, $data, $format );
         if($success){
             echo '<center>Appointment submitted sucessfully!</center>' ;
         }
     } else {
       ?>
         <form method="post">
             Date: (Ex. January 1, 2021) <input type="string" name="date"></br>
             Time: (Ex. 4:00PM) <input type="string" name="time"></br></textarea>
             <input type="submit">
         </form>
         <?php
      }
   }
      else{
         echo '<center>If you dont know the Dr ID you would like, visit the Doctor page and select'.
            '"List of All Doctors"</center>';
         if (!empty($_POST)) {
             $table = Appointments;
             $data = array(
                'DrID' => $_POST['drID'],
                'PatientID' => $userMetaValue,
                'Date' => $_POST['date'],
                'Time'=> $_POST['time']
             );
             $format = array(
                 '%.00f',
                 '%.00f',
                 '%.00f',
                 '%s', //Date is a varchar
                 '%s'//Time is a varchar in the Appointments database
             );
             $success=$wpdb->insert( $table, $data, $format );
             if($success){
                 echo '<center>Appointment submitted sucessfully!</center>' ;
             }
         } else {
          ?>
             <form method="post">
                 Dr: <input type="float" name="drID"></br>
                 Date: (Ex. January 1, 2021) <input type="string" name="date"></br>
                 Time: (Ex. 4:00PM) <input type="string" name="time"></br></textarea>
                 <input type="submit">
             </form>
             <?php
      }
   }

   $wpdb->query(
         $wpdb->prepare("SELECT * FROM Appointments,Doctors WHERE Appointments.PatientID = %.00f AND
             Doctors.DrID =Appointments.DrID",$userMetaValue)
      );
   $length = count($wpdb->last_result);
   if($length > 0)
   {
      echo'</br></br></br>';
      echo'<center>Heres a list of all current Appointments:</center></br>';
      for($i = 0;$i<$length;$i++)
      {
         echo'<center>Doctor Name: ' . $wpdb->last_result[$i]->NameFirst ." ".
            $wpdb->last_result[$i]->NameLast."</center>";
         echo'<center>Appointment time: '.$wpdb->last_result[$i]->Date ." at ".
            $wpdb->last_result[$i]->Time."</center>";
         echo '<center>Appointment ID:' . $wpdb->last_result[$i]->AppointmentID . "</center>";
         if($length > 1 && $i != $length-1) //seperates listings, also checks if its on the last listing
         {
            echo'<center>----------------------------------------------------------</center>';
         }
      }
      echo '</br></br></br>';
      echo '<center> If you would like to cancel, fill out the form below with the corresponding'.
         ' Appointment ID:</center>';
     if (!empty($_POST)) {
        $table = Appointments;
        $where = array(
            'AppointmentID' => $_POST['appID']
        );
        $success=$wpdb->delete( $table, $where );
        if($success){
             echo '<center>Appointment canceled!</center>' ;
        }
     } else {
       ?>
         <form method="post">
             Appointment ID: <input type="float" name="appID"></br>
             <input type="submit">
         </form>
         <?php
      }
   }
?>
