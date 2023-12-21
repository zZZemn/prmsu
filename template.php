<!-- File -->
<!-- End Page Title -->
<div class="pagetitle mt-3 d-flex justify-content-between">
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="admin.php">Home</a></li>
            <li class="breadcrumb-item"><a href="admin.php?section=<?= $sectionId ?>"><?= $section['SECTION_NAME'] ?></a></li>
            <li class="breadcrumb-item"><a href="admin.php?section=<?= $sectionId ?>&faculty=<?= $facultyId ?>"><?= $faculty['FACULTY_NAME'] ?></a></li>
            <li class="breadcrumb-item"><a href="admin.php?section=<?= $sectionId ?>&faculty=<?= $facultyId ?>&folder=<?= $folderId ?>"><?= $filesFolder['FOLDER_NAME'] ?></a></li>
            <li class="breadcrumb-item"><?= $file['DISPLAY_FILE_NAME'] ?></li>
        </ol>
    </nav>
    <!-- <button class="btn btn-dark" id="btnAddFile" data-id="<?= $folderId ?>">New File</button> -->
</div>
<!-- End Page Title -->
<div class="">
    <div class="container file-main-container p-3 pt-5 pb-5 card">
        <div class="d-flex justify-content-between">
            <h4 class="hightlight-color"><i class="bi bi-file-earmark-fill"></i><?= $file['DISPLAY_FILE_NAME'] ?></h4>
            <div>
                <button class="btn btnEditFile" data-id="<?= $file['ID'] ?>" data-name="<?= $file['DISPLAY_FILE_NAME'] ?>" data-notes="<?= $file['NOTES'] ?>" data-tags="<?= $file['TAGS'] ?>"><i class="bi bi-pencil"></i></button>
                <button class="btn btnDeleteFile" data-id="<?= $file['ID'] ?>"><i class="bi bi-trash"></i></button>
                <a class="btn" href="../../backend/filesFolder/<?= $file['FILE_NAME'] ?>" download><i class="bi bi-box-arrow-down"></i></a>
            </div>
        </div>
        <div class="mt-4">
            <h6 class="hightlight-color">Notes:</h6>
            <textarea class="form-control" readonly><?= $file['NOTES'] ?></textarea>
        </div>
        <div class="mt-3">
            <h6 class="hightlight-color">Tags:</h6>
            <textarea class="form-control" readonly><?= $file['TAGS'] ?></textarea>
        </div>

        <div class="d-flex mt-3">
            <div class="">
                <h6 class="hightlight-color">Document ID</h6>
                <input type="text" class="form-control" value="<?= $file['ID'] ?>">
            </div>
            <div class="file-date-container">
                <h6 class="hightlight-color">Date</h6>
                <input type="text" class="form-control" value="<?= $formattedDateTime ?>">
            </div>
        </div>

        <hr class="mt-5">

        <div class="mt-4">
            <h6 class="hightlight-color">Shared To</h6>
            <ul class="list-group">
                <?php
                $getSharedFiles = $admin_db->getSharedFilesJoinUsers($fileId);
                if ($getSharedFiles->num_rows > 0) {
                    while ($sharedFile = $getSharedFiles->fetch_assoc()) {
                ?>
                        <li class="list-group-item"><?= $sharedFile['F_NAME'] . ' ' . $sharedFile['MI'] . ' ' . $sharedFile['L_NAME'] . ' ' . $sharedFile['SUFFIX'] ?></li>
                    <?php
                    }
                } else {
                    ?>
                    <li class="list-group-item">You don't share this files to anyone.</li>
                <?php
                }
                ?>
                <li class="list-group-item">
                    <h6>Share This File: </h6>
                    <div class="d-flex">
                        <input type="hidden" id="hiddenFileId" value="<?= $fileId ?>">
                        <select id="sharedFileTo" class="form-control m-1">
                            <option value=""></option>
                            <?php
                            $getFaculty = $db->getFacultyUsers();
                            if ($getFaculty->num_rows > 0) {
                                while ($facultyPerson = $getFaculty->fetch_assoc()) {
                                    $facultyPersonId = $facultyPerson['ID'];
                                    $checkSharedFiled = $admin_db->checkSharedFiled($facultyPersonId, $fileId);
                                    echo ($checkSharedFiled->num_rows > 0) ? '' : '<option value="' . $facultyPerson['ID'] . '">' . $facultyPerson['F_NAME'] . ' ' . $facultyPerson['MI'] . ' ' . $facultyPerson['L_NAME'] . ' ' . $facultyPerson['SUFFIX'] . '</option>';
                                }
                            }
                            ?>
                        </select>
                        <button type="button" class="btn btn-dark m-1" id="btnShareFile">Share</button>
                    </div>
                </li>
            </ul>
        </div>

        <hr class="mt-5">

        <div class="mt-4">
            <h6 class="hightlight-color">Audit Log</h6>
            <table class="table">
                <tr>
                    <th>Time</th>
                    <th>User</th>
                    <th>Action</th>
                </tr>
                <tr>
                    <?php
                    $getAuditLog = $admin_db->getAuditLog($fileId);
                    if ($getAuditLog->num_rows > 0) {
                        while ($audit = $getAuditLog->fetch_assoc()) {
                    ?>
                <tr>
                    <td><?= $audit['DATE_TIME'] ?></td>
                    <td><?= $audit['USER_ID'] ?></td>
                    <td><?= $audit['ACTION'] ?></td>
                </tr>
            <?php
                        }
                    } else {
            ?>
            <tr>
                <td colspan="3">
                    <center>No Audit Yet</center>
                </td>
            </tr>
        <?php
                    }
        ?>
        </tr>
            </table>
        </div>
    </div>
</div>
<!-- End of File -->