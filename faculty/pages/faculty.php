<?php
include('../components/header.php');
?>
<main class="main-container container bg-light">
    <?php
    if (isset($_GET['page'])) {
    ?>
        <input type="hidden" id="userId" value="<?= $user_id ?>">
        <?php
        if ($_GET['page'] == 'inbox') {
        ?>
            <div class="container message-content-container">
                <div class="message-content-container-iside container" id="messageContainer">

                </div>
                <script>
                    const getMessages = () => {
                        var userId = $("#userId").val();
                        console.log(userId);
                        $.ajax({
                            type: "GET",
                            url: "../../backend/endpoints/admin/get-request.php",
                            data: {
                                submitType: "getMessages",
                                userId: userId,
                            },
                            success: function(response) {
                                $("#messageContainer").html(response);
                            },
                        });
                    }

                    setInterval(getMessages, 100);
                </script>
                <form class="container mt-2 d-flex" id="frmSendMessage">
                    <input type="text" id="txtSendMessage" class="form-control m-1" required>
                    <button type="submit" class="btn btn-dark m-1">Send</button>
                </form>
            </div>
            <?php
        } elseif ($_GET['page'] == 'SharedFiles') {
            if (isset($_GET['file'])) {
                $checkFile = $admin_db->getFile($_GET['file']);
                if ($checkFile->num_rows > 0) {
                    $file = $checkFile->fetch_assoc();
                    $dateTimeString = $file['DATETIME'];
                    $dateTime = new DateTime($dateTimeString);
                    $formattedDateTime = $dateTime->format('F j, Y g:i a');
            ?>
                    <!-- End Page Title -->
                    <div class="pagetitle mt-3 d-flex justify-content-between">
                        <nav>
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="faculty.php?page=SharedFiles">Shared Files</a></li>
                                <li class="breadcrumb-item"><?= $file['DISPLAY_FILE_NAME'] ?></li>
                            </ol>
                        </nav>
                    </div>
                    <!-- End Page Title -->
                    <div class="">
                        <div class="container file-main-container p-3 pt-5 pb-5 card">
                            <div class="d-flex justify-content-between">
                                <h4 class="hightlight-color"><i class="bi bi-file-earmark-fill"></i><?= $file['DISPLAY_FILE_NAME'] ?></h4>
                                <div>
                                    <button class="btn btnEditFile" data-id="<?= $file['ID'] ?>" data-name="<?= $file['DISPLAY_FILE_NAME'] ?>" data-notes="<?= $file['NOTES'] ?>" data-tags="<?= $file['TAGS'] ?>"><i class="bi bi-pencil"></i></button>
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
                        </div>
                    </div>
                <?php
                } else {
                    header('Location: faculty.php?page=SharedFiles');
                }
            } else {
                ?>
                <div class="container">
                    <table class="table">
                        <thead>
                            <tr>
                                <th class="">Name</th>
                                <th class="">Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $getSharedFiles = $admin_db->getSharedFiles($user_id);
                            if ($getSharedFiles->num_rows > 0) {
                                while ($file = $getSharedFiles->fetch_assoc()) {
                            ?>
                                    <tr>
                                        <td><i class="bi bi-file-earmark"></i> <a href="faculty.php?page=SharedFiles&file=<?= $file['ID'] ?>" class="text-dark txt-folder-link"><?= $file['DISPLAY_FILE_NAME'] ?></a></td>
                                        <td><?= $file['DATETIME'] ?></td>
                                    </tr>
                                <?php
                                }
                            } else {
                                ?>
                                <tr>
                                    <td colspan="3">
                                        <center>No shared files.</center>
                                    </td>
                                </tr>
                            <?php
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            <?php
            }
        } elseif ($_GET['page'] == 'ManageAccount') {
            ?>
            <div class="edit-user-container container">
                <?php
                $checkUser = $db->getUser($user_id);
                if ($checkUser->num_rows > 0) {
                    $user = $checkUser->fetch_assoc();
                ?>
                    <form id="frmEditUser">
                        <div class="mt-5">
                            <label for="editName">Name:</label>
                            <input type="text" class="form-control" id="editName" name="editName" value="<?= $user['NAME'] ?>">
                        </div>

                        <div class="mt-3">
                            <label for="editEmail">Email:</label>
                            <input type="text" class="form-control" id="editEmail" name="editEmail" value="<?= $user['EMAIL'] ?>">
                        </div>
                        <div class="mt-3">
                            <label for="editUsername">Username:</label>
                            <input type="text" class="form-control" id="editUsername" name="editUsername" value="<?= $user['USERNAME'] ?>">
                        </div>
                        <div class="mt-3">
                            <label for="editPassword">Password:</label>
                            <input type="password" class="form-control" id="editPassword" name="editPassword" value="<?= $user['PASSWORD'] ?>">
                        </div>
                        <div class="mt-4 d-flex justify-content-end">
                            <button type="submit" class="btn btn-dark">Save Changes</button>
                        </div>
                    </form>
                <?php
                } else {
                ?>
                    <center class="mt-3">
                        <h5> Please select user. </h5>
                    </center>
                <?php
                }
                ?>
            </div>
    <?php
        }
    }
    ?>
</main>
<?php
include('../components/footer.php');
