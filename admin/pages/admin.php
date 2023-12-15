<?php
include('../components/header.php');
?>
<main class="main-container container bg-light">
    <?php
    if (isset($_GET['file'])) {
        echo 'fileid';
    } elseif (isset($_GET['folder'])) {
        if (isset($_GET['faculty'])) {
            if (isset($_GET['section'])) {
                $folderId = $_GET['folder'];
                $facultyId = $_GET['faculty'];
                $sectionId = $_GET['section'];

                $checkSectionId = $admin_db->getSectionsId($sectionId);
                if ($checkSectionId->num_rows > 0) {
                    $section = $checkSectionId->fetch_assoc();
                    $checkFacultyId = $admin_db->getFaculty($facultyId);
                    if ($checkFacultyId->num_rows > 0) {
                        $faculty = $checkFacultyId->fetch_assoc();
                        $getFilesFolder = $admin_db->getFileFolder($folderId);
                        if ($getFilesFolder->num_rows > 0) {
                            $filesFolder = $getFilesFolder->fetch_assoc();
    ?>
                            <!-- Files Folder -->
                            <!-- End Page Title -->
                            <div class="pagetitle mt-3 d-flex justify-content-between">
                                <nav>
                                    <ol class="breadcrumb">
                                        <li class="breadcrumb-item"><a href="admin.php">Home</a></li>
                                        <li class="breadcrumb-item"><a href="admin.php?section=<?= $sectionId ?>"><?= $section['SECTION_NAME'] ?></a></li>
                                        <li class="breadcrumb-item"><a href="admin.php?section=<?= $sectionId ?>&faculty=<?= $facultyId ?>"><?= $faculty['FACULTY_NAME'] ?></a></li>
                                        <li class="breadcrumb-item"><?= $filesFolder['FOLDER_NAME'] ?></li>
                                    </ol>
                                </nav>
                                <button class="btn btn-dark" id="btnAddFile" data-id="<?= $folderId ?>">New File</button>
                            </div>
                            <!-- End Page Title -->

                            <div class="">
                                <table class="table">
                                    <tr>
                                        <th class="">Name</th>
                                        <th class="">Date</th>
                                        <th class="">Action</th>
                                    </tr>
                                    <?php
                                    $getFiles = $admin_db->getFileUsingFolderId($folderId);
                                    if ($getFiles->num_rows > 0) {
                                        while ($file = $getFiles->fetch_assoc()) {
                                    ?>
                                            <tr>
                                                <td>
                                                    <a href="admin.php?section=<?= $sectionId ?>&faculty=<?= $facultyId ?>&folder=<?= $folderId ?>&file=<?= $file['ID'] ?>" class="text-dark txt-folder-link">
                                                        <i class="bi bi-file-earmark"></i> <?= $file['DISPLAY_FILE_NAME'] ?>
                                                    </a>
                                                </td>
                                                <td>
                                                    <?php
                                                    $dateTimeString = $file['DATETIME'];
                                                    $dateTime = new DateTime($dateTimeString);
                                                    $formattedDateTime = $dateTime->format('F j, Y g:i a'); // Format as "Month day, Year Hour:Minute AM/PM"

                                                    echo $formattedDateTime;
                                                    ?>
                                                </td>
                                                <td>
                                                    <button class="btn btnEditFile" data-id="<?= $file['ID'] ?>" data-name="<?= $file['DISPLAY_FILE_NAME'] ?>" data-notes="<?= $file['NOTES'] ?>" data-tags="<?= $file['TAGS'] ?>"><i class="bi bi-pencil"></i></button>
                                                    <button class="btn btnDeleteFile" data-id="<?= $file['ID'] ?>"><i class="bi bi-trash"></i></button>
                                                    <button class="btn btnDownloadFile"><i class="bi bi-box-arrow-down"></i></button>
                                                </td>
                                            </tr>
                                        <?php
                                        }
                                    } else {
                                        ?>
                                        <tr>
                                            <td colspan="3">
                                                <center>No File Found</center>
                                            </td>
                                        </tr>
                                    <?php
                                    }
                                    ?>
                                </table>
                            </div>

                            <!-- End of Files Folder  -->
                    <?php
                        } else {
                            backToAdminMain();
                        }
                    } else {
                        backToAdminMain();
                    }
                } else {
                    backToAdminMain();
                }
            } else {
                backToAdminMain();
            }
        } else {
            backToAdminMain();
        }
    } elseif (isset($_GET['faculty'])) {
        if (isset($_GET['section'])) {
            $sectionId = $_GET['section'];
            $facultyId = $_GET['faculty'];
            $checkSectionId = $admin_db->getSectionsId($sectionId);
            if ($checkSectionId->num_rows > 0) {
                $section = $checkSectionId->fetch_assoc();
                $getFaculty = $admin_db->getFaculty($facultyId);
                if ($getFaculty->num_rows > 0) {
                    $faculty = $getFaculty->fetch_assoc();
                    ?>
                    <!-- Faculty -->
                    <!-- End Page Title -->
                    <div class="pagetitle mt-3 d-flex justify-content-between">
                        <nav>
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="admin.php">Home</a></li>
                                <li class="breadcrumb-item"><a href="admin.php?section=<?= $sectionId ?>"><?= $section['SECTION_NAME'] ?></a></li>
                                <li class="breadcrumb-item"><?= $faculty['FACULTY_NAME'] ?></li>
                            </ol>
                        </nav>
                        <button class="btn btn-dark" id="btnAddFileFolder" data-id="<?= $facultyId ?>">New Folder</button>
                    </div>
                    <!-- End Page Title -->

                    <div class="">
                        <table class="table">
                            <tr>
                                <th class="">Name</th>
                                <th class="">Date</th>
                                <th class="">Action</th>
                            </tr>
                            <?php
                            $getFilesFolder = $admin_db->getFilesFolderUsingFacultyId($facultyId);
                            if ($getFilesFolder->num_rows > 0) {
                                while ($filesFolder = $getFilesFolder->fetch_assoc()) {
                            ?>
                                    <tr>
                                        <td>
                                            <a href="admin.php?section=<?= $sectionId ?>&faculty=<?= $faculty['ID'] ?>&folder=<?= $filesFolder['ID'] ?>" class="text-dark txt-folder-link">
                                                <i class="bi bi-file-earmark"></i> <?= $filesFolder['FOLDER_NAME'] ?>
                                            </a>
                                        </td>
                                        <td>
                                            <?php
                                            $dateTimeString = $filesFolder['DATETIME'];
                                            $dateTime = new DateTime($dateTimeString);
                                            $formattedDateTime = $dateTime->format('F j, Y g:i a'); // Format as "Month day, Year Hour:Minute AM/PM"

                                            echo $formattedDateTime;
                                            ?>
                                        </td>
                                        <td>
                                            <button class="btn btnEditFileFolder" data-id="<?= $filesFolder['ID'] ?>" data-name="<?= $filesFolder['FOLDER_NAME'] ?>"><i class="bi bi-pencil"></i></button>
                                            <button class="btn btnDeleteFileFolder" data-id="<?= $filesFolder['ID'] ?>"><i class="bi bi-trash"></i></button>
                                            <button class="btn btnDownloadFileFolder"><i class="bi bi-box-arrow-down"></i></button>
                                        </td>
                                    </tr>
                                <?php
                                }
                            } else {
                                ?>
                                <tr>
                                    <td colspan="3">
                                        <center>No Folder Found</center>
                                    </td>
                                </tr>
                            <?php
                            }
                            ?>
                        </table>
                    </div>

                    <!-- End of Faculty  -->
            <?php
                } else {
                    backToAdminMain();
                }
            } else {
                backToAdminMain();
            }
        } else {
            backToAdminMain();
        }
    } elseif (isset($_GET['section'])) {
        $sectionId = $_GET['section'];
        $result = $admin_db->getSectionsId($sectionId);
        if ($result->num_rows > 0) {
            $section = $result->fetch_assoc();
            ?>
            <!-- Section  -->

            <!-- End Page Title -->
            <div class="pagetitle mt-3 d-flex justify-content-between">
                <nav>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="admin.php">Home</a></li>
                        <li class="breadcrumb-item"><?= $section['SECTION_NAME'] ?></li>
                    </ol>
                </nav>
                <button class="btn btn-dark" id="btnAddFacultyFolder" data-id="<?= $sectionId ?>">New Folder</button>
            </div>
            <!-- End Page Title -->

            <div class="">
                <table class="table">
                    <tr>
                        <th class="">Name</th>
                        <th class="">Date</th>
                        <th class="">Action</th>
                    </tr>
                    <?php
                    $getFaculty = $admin_db->getFacultyUsingSectionId($sectionId);
                    if ($getFaculty->num_rows > 0) {
                        while ($faculty = $getFaculty->fetch_assoc()) {
                    ?>
                            <tr>
                                <td>
                                    <a href="admin.php?section=<?= $sectionId ?>&faculty=<?= $faculty['ID'] ?>" class="text-dark txt-folder-link">
                                        <i class="bi bi-file-earmark"></i> <?= $faculty['FACULTY_NAME'] ?>
                                    </a>
                                </td>
                                <td>
                                    <?php
                                    $dateTimeString = $faculty['DATETIME'];
                                    $dateTime = new DateTime($dateTimeString);
                                    $formattedDateTime = $dateTime->format('F j, Y g:i a'); // Format as "Month day, Year Hour:Minute AM/PM"

                                    echo $formattedDateTime;
                                    ?>
                                </td>
                                <td>
                                    <button class="btn btnEditFaculty" data-id="<?= $faculty['ID'] ?>" data-name="<?= $faculty['FACULTY_NAME'] ?>"><i class="bi bi-pencil"></i></button>
                                    <button class="btn btnDeleteFaculty" data-id="<?= $faculty['ID'] ?>"><i class="bi bi-trash"></i></button>
                                    <button class="btn btnDownloadFaculty"><i class="bi bi-box-arrow-down"></i></button>
                                </td>
                            </tr>
                        <?php
                        }
                    } else {
                        ?>
                        <tr>
                            <td colspan="3">
                                <center>No Folder Found</center>
                            </td>
                        </tr>
                    <?php
                    }
                    ?>
                </table>
            </div>

            <!-- End of Section  -->
    <?php
        } else {
            backToAdminMain();
        }
    }
    ?>
</main>
<?php
include('../components/footer.php');
