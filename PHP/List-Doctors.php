<?php
$wpdb->query(
      $wpdb->prepare("SELECT * FROM Doctors")
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
         echo'<center>Doctor Name: ' . $wpdb->last_result[$i]->NameFirst." ".
            $wpdb->last_result[$i]->NameLast. "</center>";
         echo'<center>ID #: ' . $wpdb->last_result[$i]->DrID. "</center>";
         echo"<center><b>---------------------------------------------------</b></center>";
      }
   }

 ?>
