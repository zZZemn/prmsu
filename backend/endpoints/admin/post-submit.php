<?php
if (isset($_POST['submitType'])) {
    include('../../db/db_class.php');
    $admin_db = new admin_class();
    $submitType = $_POST['submitType'];

    if ($submitType == 'AddNewSection') {
        $sectionName = $_POST['sectionName'];
        echo $admin_db->addNewSection($sectionName);
    } elseif ($submitType == 'DeleteSection') {
        $sectionId = $_POST['sectionId'];
        echo $admin_db->deleteSection($sectionId);
    } elseif ($submitType == 'RenameSection') {
        $sectionId = $_POST['sectionId'];
        $sectionName = $_POST['sectionName'];
        echo $admin_db->renameSection($sectionId, $sectionName);
    }
}
