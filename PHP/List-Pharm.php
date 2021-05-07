<?php
$wpdb->query(
      $wpdb->prepare("SELECT * FROM Pharmacies")
   );
   $length = count($wpdb->last_result);
   if($length == 0)
   {
      echo '<center> Something went wrong... Try again in a few moments.</center>';
   }
   else{
      echo '&nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp'.
         'This is a list of every Pharmacy that works with our service.</br></br>';
      for($i = 0;$i<$length;$i++)
      {
         echo'<center>Pharmacy Name: ' . $wpdb->last_result[$i]->PharmacyName. "</center>";
         echo'<center>ID #: ' . $wpdb->last_result[$i]->PharmacyID. "</center>";
         echo'<center>Address: ' . $wpdb->last_result[$i]->Address. "</center>";
         echo'<center>Phone Number: ' . $wpdb->last_result[$i]->PhoneNumber . "</center>";
         echo"<center><b>---------------------------------------------------</b></center>";
      }
   }

 ?>
