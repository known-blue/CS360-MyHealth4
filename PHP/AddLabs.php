<?php
    if (!empty($_POST)) {
        global $wpdb;
        $table = SSDL;
        $data = array(
           'PatientID' => $_POST['patientID'],
           'LabID'=> $_POST['labID']
        );
        $format = array(
            '%.00f',
            '%.00f'
        );
        $success=$wpdb->insert( $table, $data, $format );
        if($success){
            echo '<center>Lab data submitted sucessfully!</center>' ;
        }
    } else {
        ?>
        <form method="post">
            Patient ID Number: <input type="float" name="patientID"></br>
            Lab ID Number: <input type="float" name="labID"></br></textarea>
            <input type="submit">
        </form>
        <?php
    }
?>
