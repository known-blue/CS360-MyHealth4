<?php
get_currentuserinfo();

$user_id = get_current_user_id();
$single = true;
$id = 'user_registration_id';
$userMetaValue = get_user_meta( $user_id, $id,$single);
//echo'<center>Patient ID: ' . $userMetaValue. "</center>";
echo "List of all user data. If you want a physical copy: In your browser, go to the three dots in the right corner and select print.";
echo "If you notice some data is incorrect, please contact us at 208-555-5555 and we can correct it.";
$wpdb->query(
      $wpdb->prepare("SELECT * FROM Patients WHERE PatientID = %.00f",$userMetaValue)
   );
$length = count($wpdb->last_result);
if($length == 0)
{
   pass;
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
