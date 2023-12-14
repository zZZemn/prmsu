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
    } elseif ($submitType == 'AddNewFaculty') {
        $facultyName = $_POST['facultyName'];
        $sectionId = $_POST['sectionId'];
        echo $admin_db->addNewFaculty($facultyName, $sectionId);
    } elseif ($submitType == 'RenameFaculty') {
        $facultyId = $_POST['facultyId'];
        $facultyName = $_POST['facultyName'];
        echo $admin_db->renameFaculty($facultyId, $facultyName);
    } elseif ($submitType == 'DeleteFaculty') {
        $facultyId = $_POST['facultyId'];
        echo $admin_db->deleteFaculty($facultyId);
    }
}
