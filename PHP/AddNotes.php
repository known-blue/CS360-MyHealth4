<?php
   get_currentuserinfo();

   $user_id = get_current_user_id();
   $single = true;
   $id = 'user_registration_id';
   $userMetaValue = get_user_meta( $user_id, $id,$single);

    if (!empty($_POST)) {
        global $wpdb;
        $table = PatientNotes;
        $data = array(
           //'NoteID',
           'DrID' => $userMetaValue,
           'PatientID' => $_POST['patientID'],
           'Date' => $_POST['date'],
           'Notes'=> $_POST['note'],
           'Diagnosis' => $_POST['diagnosis']
        );
        $format = array(
            '%.00f',
            '%.00f',
            '%.00f',
            '%s',
            '%s',
            'date' //Textual
        );
        $success=$wpdb->insert( $table, $data, $format );
        if($success){
            echo '<center>Note submitted sucessfully!</center>' ;
        }
    } else {
        ?>
        <form method="post">
            Patient ID Number: <input type="float" name="patientID"></br>
            Notes: <input type="string" name="note"></br>
            Diagnosis: <input type="string" name="diagnosis"></br>
            Date: <input type="date" name="date"></br></textarea>
            <input type="submit">
        </form>
        <?php
    }
?>
