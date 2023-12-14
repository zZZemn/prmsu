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
            $checkFacultyId = $this->getFacultyUsingSectionId($facultyId);
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
}
