<?php
	get_currentuserinfo();

	$user_id = get_current_user_id();
	$single = true;
	$id = 'user_registration_id';
	$userMetaValue = get_user_meta( $user_id, $id,$single);
	//echo'<center>Patient ID: ' . $userMetaValue. "</center>";
	$wpdb->query(
		 $wpdb->prepare("SELECT * FROM HospitalBills WHERE PatientID = %.00f",$userMetaValue)
	);
	$length = count($wpdb->last_result);
	if($length == 0)
	{
		echo '<center> You currently have no Hospital bills.</center>';
	}
	for($i = 0;$i<$length;$i++)
	{
		echo'<center>Date: ' . $wpdb->last_result[0]->Date. "</center>";
		echo'<center>Total Cost: ' . $wpdb->last_result[0]->TotalCost. "</center>";
		echo'<center>Insurance Paid: ' . $wpdb->last_result[0]->AmtInsurancePaid. "</center>";
		echo'<center>Patient Paid: ' . $wpdb->last_result[0]->AmtPatientPaid. "</center>";
		if($length > 1 && $i != $length-1) //seperates listings, also checks if its on the last listing
		{
			echo'<center>----------------------------------------------------------</center>';
		}
	}
	$wpdb->query(
		$wpdb->prepare("SELECT * FROM PharmacyBills WHERE PatientID = %.00f", $userMetaValue)
	);
	$length = count($wpdb->last_result);
	if($length == 0)
	{
		echo '<center>You currently have no Pharmacy bills.</center>';
	}
	for($i = 0;$i<$length;$i++)
	{
		if(get_userdata($user_id)->roles[0] == 'doctor')
		{
			echo'<center>Patient ID: ' . $wpdb->last_result[$i]->PatientID. "</center>";
		}
		if(get_userdata($user_id)->roles[0] == 'patient')
		{
			echo'<center>Doctor ID: ' . $wpdb->last_result[$i]->DrID. "</center>";
		}
		echo'<center>Date: ' . $wpdb->last_result[0]->Date. "</center>";
		echo'<center>Total Cost: ' . $wpdb->last_result[0]->TotalCost. "</center>";
		echo'<center>Insurance Paid: ' . $wpdb->last_result[0]->AmtInsurancePaid. "</center>";
		echo'<center>Patient Paid: ' . $wpdb->last_result[0]->AmtPatientPaid. "</center>";
		if($length > 1 && $i != $length-1) //seperates listings, also checks if its on the last listing
		{
			echo'<center>----------------------------------------------------------</center>';
		}
	}
?>
