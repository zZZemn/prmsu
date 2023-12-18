<?php
include('../components/header.php');
?>
<main class="main-container container bg-light">
    <?php
    if (isset($_GET['page'])) {
        if ($_GET['page'] == 'inbox') {
    ?>
            <div class="container message-content-container">
                <div class="message-content-container-iside container" id="messageContainer">

                </div>
                <input type="hidden" id="userId" value="<?= $user_id ?>">
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
        ?>
            <div class="container">
                <table class="table">
                    <thead>
                        <tr>
                            <th class="">Name</th>
                            <th class="">Date</th>
                            <th class="">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $getSharedFiles = $admin_db->getSharedFiles($user_id);
                        if ($getSharedFiles->num_rows > 0) {
                            while ($file = $getSharedFiles->fetch_assoc()) {
                        ?>
                                <tr>
                                    <td><?= $file['DISPLAY_FILE_NAME'] ?></td>
                                    <td><?= $file['DATETIME'] ?></td>
                                    <td><?= $user_id ?></td>
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
    }
    ?>
</main>
<?php
include('../components/footer.php');
