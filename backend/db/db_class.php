<?php
include('db.php');
date_default_timezone_set('Asia/Manila');

class global_class extends db_connect
{
    public function __construct()
    {
        $this->connect();
    }

    public function login($username, $password, $userType)
    {
        $query = $this->conn->prepare("SELECT * FROM `users` WHERE `USERNAME` = '$username' AND `PASSWORD` = '$password' AND `USER_TYPE` = '$userType'");
        if ($query->execute()) {
            $result = $query->get_result();
            return $result;
        }
    }

    public function getUser($id)
    {
        $query = $this->conn->prepare("SELECT * FROM `users` WHERE `ID` = '$id'");
        if ($query->execute()) {
            $result = $query->get_result();
            return $result;
        }
    }
}


class admin_class extends db_connect
{
    public function __construct()
    {
        $this->connect();
    }

    public function generateRandomString($length)
    {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, strlen($characters) - 1)];
        }
        return $randomString;
    }

    public function dateTime()
    {
        $timezone = new DateTimeZone('Asia/Manila');
        $dateTime = new DateTime('now', $timezone);
        return $dateTime->format('Y-m-d H:i:s');
    }

    // Section
    public function getSections()
    {
        $query = $this->conn->prepare("SELECT * FROM `section` WHERE `STATUS` = 'active'");
        if ($query->execute()) {
            $result = $query->get_result();
            return $result;
        }
    }

    public function getSectionsId($sectionId)
    {
        $query = $this->conn->prepare("SELECT * FROM `section` WHERE `ID` = '$sectionId' AND `STATUS` = 'active'");
        if ($query->execute()) {
            $result = $query->get_result();
            return $result;
        }
    }

    public function addNewSection($sectionName)
    {
        do {
            $sectionId = 'SECTION_' . str_pad(random_int(0, 999999), 6, '0', STR_PAD_LEFT);
            $checkSectionId = $this->conn->prepare("SELECT * FROM `section` WHERE `ID` = ?");
            $checkSectionId->bind_param('s', $sectionId);
        } while ($checkSectionId->execute() && $checkSectionId->get_result()->num_rows > 0);

        $query = $this->conn->prepare("INSERT INTO `section`(`ID`, `SECTION_NAME`, `STATUS`) VALUES ('$sectionId','$sectionName','active')");
        if ($query->execute()) {
            return 200;
        }
    }

    public function deleteSection($sectionId)
    {
        $query = $this->conn->prepare("UPDATE `section` SET `STATUS`='deleted' WHERE `ID` = '$sectionId'");
        if ($query->execute()) {
            return 200;
        }
    }

    public function renameSection($sectionId, $sectionName)
    {
        $query = $this->conn->prepare("UPDATE `section` SET `SECTION_NAME`='$sectionName' WHERE `ID` = '$sectionId'");
        if ($query->execute()) {
            return 200;
        }
    }

    // Faculty ---------------------------------
    public function getFaculty($facultyId)
    {
        $query = $this->conn->prepare("SELECT * FROM `faculty_folder` WHERE `ID` = '$facultyId' AND `STATUS` = 'active'");
        if ($query->execute()) {
            $result = $query->get_result();
            return $result;
        }
    }

    public function getFacultyUsingSectionId($sectionId)
    {
        $query = $this->conn->prepare("SELECT * FROM `faculty_folder` WHERE `SECTION_ID` = '$sectionId' AND `STATUS` = 'active'");
        if ($query->execute()) {
            $result = $query->get_result();
            return $result;
        }
    }

    public function addNewFaculty($facultyName, $sectionId)
    {
        $dateTime = $this->dateTime();
        do {
            $facultyId = 'FAC_' . str_pad(random_int(0, 999999), 6, '0', STR_PAD_LEFT);
            $checkFacultyId = $this->getFaculty($facultyId);
        } while ($checkFacultyId->num_rows > 0);

        $query = $this->conn->prepare("INSERT INTO `faculty_folder`(`ID`, `SECTION_ID`, `FACULTY_NAME`, `DATETIME`, `STATUS`) VALUES ('$facultyId','$sectionId','$facultyName','$dateTime','active')");
        if ($query->execute()) {
            return 200;
        }
    }

    public function deleteFaculty($facultyId)
    {
        $query = $this->conn->prepare("UPDATE `faculty_folder` SET `STATUS`='deleted' WHERE `ID` = '$facultyId'");
        if ($query->execute()) {
            return 200;
        }
    }

    public function renameFaculty($facultyId, $facultyName)
    {
        $query = $this->conn->prepare("UPDATE `faculty_folder` SET `FACULTY_NAME`='$facultyName' WHERE `ID` = '$facultyId'");
        if ($query->execute()) {
            return 200;
        }
    }

    // Files Folder ----------------------------------

    public function getFilesFolderUsingFacultyId($facultyId)
    {
        $query = $this->conn->prepare("SELECT * FROM `files_folder` WHERE `FACULTY_ID` = '$facultyId' AND `STATUS` = 'active'");
        if ($query->execute()) {
            $result = $query->get_result();
            return $result;
        }
    }

    public function getFileFolder($folderId)
    {
        $query = $this->conn->prepare("SELECT * FROM `files_folder` WHERE `ID` = '$folderId' AND `STATUS` = 'active'");
        if ($query->execute()) {
            $result = $query->get_result();
            return $result;
        }
    }

    public function addFileFolder($folderName, $facultyId)
    {
        $dateTime = $this->dateTime();
        do {
            $folderId = 'FF_' . str_pad(random_int(0, 999999), 6, '0', STR_PAD_LEFT);
            $checkFolderId = $this->getFileFolder($folderId);
        } while ($checkFolderId->num_rows > 0);

        $query = $this->conn->prepare("INSERT INTO `files_folder`(`ID`, `FACULTY_ID`, `FOLDER_NAME`, `DATETIME`, `STATUS`) VALUES ('$folderId','$facultyId','$folderName','$dateTime','active')");
        if ($query->execute()) {
            return 200;
        }
    }

    public function renameFileFolder($folderId, $folderName)
    {
        $query = $this->conn->prepare("UPDATE `files_folder` SET `FOLDER_NAME`='$folderName' WHERE `ID` = '$folderId'");
        if ($query->execute()) {
            return 200;
        }
    }

    public function deleteFileFolder($folderId)
    {
        $query = $this->conn->prepare("UPDATE `files_folder` SET `STATUS`='deleted' WHERE `ID` = '$folderId'");
        if ($query->execute()) {
            return 200;
        }
    }

    // Files  ----------------------------------

    public function getFileUsingFolderId($folderId)
    {
        $query = $this->conn->prepare("SELECT * FROM `files` WHERE `FOLDER_ID` = '$folderId' AND `STATUS` = 'active'");
        if ($query->execute()) {
            $result = $query->get_result();
            return $result;
        }
    }

    public function deleteFile($fileId)
    {
        $query = $this->conn->prepare("UPDATE `files` SET `STATUS`='deleted' WHERE `ID` = '$fileId'");
        if ($query->execute()) {
            return 200;
        }
    }

    public function getFile($fileId)
    {
        $query = $this->conn->prepare("SELECT * FROM `files` WHERE `ID` = '$fileId' AND `STATUS` = 'active'");
        if ($query->execute()) {
            $result = $query->get_result();
            return $result;
        }
    }

    public function getFileName($fileName)
    {
        $query = $this->conn->prepare("SELECT * FROM `files` WHERE `FILE_NAME` = '$fileName'");
        if ($query->execute()) {
            $result = $query->get_result();
            return $result;
        }
    }

    public function addNewFile($post, $file)
    {
        $folderId = $post['folderId'];
        $notes = $post['notes'];
        $tags = $post['tags'];

        $dateTime = $this->dateTime();

        do {
            $fileId = 'FILE_' . str_pad(random_int(0, 9999999999), 10, '0', STR_PAD_LEFT);
            $checkFileId = $this->getFile($fileId);
        } while ($checkFileId->num_rows > 0);

        do {
            $fileName = 'prmsu_' . $this->generateRandomString(12);
            $checkFileName = $this->getFileName($fileName);
        } while ($checkFileName->num_rows > 0);

        if (!empty($_FILES['file']['size'])) {
            $file_name = $file['name'];
            $file_tmp = $file['tmp_name'];
            $extension = pathinfo($file_name, PATHINFO_EXTENSION);
            $destinationDirectory = __DIR__ . '/../filesFolder/';
            $newFileName = $fileName . '.' . $extension;
            $destination = $destinationDirectory . $newFileName;
            if (is_uploaded_file($file_tmp)) {
                if (move_uploaded_file($file_tmp, $destination)) {
                    $query = $this->conn->prepare("INSERT INTO `files`(`ID`, `FOLDER_ID`, `FILE_NAME`, `DISPLAY_FILE_NAME`, `NOTES`, `TAGS`, `DATETIME`, `STATUS`) VALUES ('$fileId','$folderId','$fileName','$file_name','$notes','$tags','$dateTime','active')");
                    if ($query->execute()) {
                        return 200;
                    }
                } else {
                    // return 'Uploading file unsuccessfull';
                    return $destination;
                }
            } else {
                return "Error: File upload failed or file not found.";
            }
        } else {
            return 'File is empty';
        }
    }
}
