<?php
$wpdb->query(
      $wpdb->prepare("SELECT * FROM Hospitals")
   );
   $length = count($wpdb->last_result);
   if($length == 0)
   {
      echo '<center> Something went wrong... Try again in a few moments.</center>';
   }
   else{
      echo '&nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp'.
         'This is a list of every Hospital that works with our service.</br></br>';
      for($i = 0;$i<$length;$i++)
      {
         echo'<center>Hospital Name: ' . $wpdb->last_result[$i]->HospitalName. "</center>";
         echo'<center>ID #: ' . $wpdb->last_result[$i]->HospitalID. "</center>";
         echo'<center>Address: ' . $wpdb->last_result[$i]->Address. "</center>";
         echo"<center><b>---------------------------------------------------</b></center>";
      }
   }

 ?>
