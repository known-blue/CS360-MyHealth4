<?php
   get_currentuserinfo();

   $user_id = get_current_user_id();
   $single = true;
   $id = 'user_registration_id';
   $userMetaValue = get_user_meta( $user_id, $id,$single);
   $date = current_time( 'mysql');

    if (!empty($_POST)) {
        global $wpdb;
        $table = Perscriptions;
        $data = array(
           'DrID' => $userMetaValue,
           'PatientID' => $_POST['patientID'],
           'TreatmentID' => $_POST['treatmentID'],
           'Quantity'=> $_POST['quantity'],
           'Date' => $date

        );
        $format = array(
            '%.00f',
            '%.00f',
            '%.00f',
            '%s',
            'date' //Textual
        );
        $success=$wpdb->insert( $table, $data, $format );
        if($success){
            echo '<center>Prescription submitted sucessfully!</center>' ;
        }
    } else {
        ?>
        <form method="post">
            Patient ID Number: <input type="float" name="patientID"></br>
            Treatment ID Number: <input type="float" name="treatmentID"></br></textarea>
            Quantity: <input type="string" name="quantity"></br></textarea>
            <input type="submit">
        </form>
        <?php
    }
?>
