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
    } elseif ($submitType == 'AddNewFileFolder') {
        $folderName = $_POST['folderName'];
        $facultyId = $_POST['facultyId'];
        echo $admin_db->addFileFolder($folderName, $facultyId);
    } elseif ($submitType == 'RenameFileFolder') {
        $folderId = $_POST['folderId'];
        $folderName = $_POST['folderName'];
        echo $admin_db->renameFileFolder($folderId, $folderName);
    } elseif ($submitType == 'DeleteFileFolder') {
        $folderId = $_POST['folderId'];
        echo $admin_db->deleteFileFolder($folderId);
    } elseif ($submitType == 'AddNewFile') {
        $notes = $_POST['notes'];
        $tags = $_POST['tags'];
        echo $admin_db->addNewFile($_POST, $_FILES['file']);
    } elseif ($submitType == 'EditFile') {
        $fileId = $_POST['fileId'];
        $notes = $_POST['notes'];
        $tags = $_POST['tags'];
        $fileName = $_POST['fileName'];
        echo $admin_db->editFile($fileId, $fileName, $tags, $notes);
    } elseif ($submitType == 'DeleteFile') {
        $fileId = $_POST['fileId'];
        echo $admin_db->deleteFile($fileId);
    } elseif ($submitType == 'ShareFile') {
        $userId = $_POST['userId'];
        $fileId = $_POST['fileId'];
        echo $admin_db->shareFile($fileId, $userId);
    } elseif ($submitType == 'sendMessage') {
        $message = $_POST['message'];
        $userId = $_POST['userId'];
        $senderId = $_POST['senderId'];
        echo $admin_db->sendMessage($senderId, $userId, $message);
    }
}
