<?php
include('../components/header.php');
?>
<main class="main-container container bg-light">
    <?php
    if (isset($_GET['file'])) {
        echo 'fileid';
    } elseif (isset($_GET['folder'])) {
        echo 'folder';
    } elseif (isset($_GET['faculty'])) {
        echo 'faculty';
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
