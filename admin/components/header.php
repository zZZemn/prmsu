<?php
ob_start();

function backToIndex()
{
    header('Location: ../../index.php');
    exit;
}

function backToAdminMain()
{
    header('Location: admin.php');
    exit;
}

include('../../backend/db/db_class.php');
$db = new global_class();
$admin_db = new admin_class();

session_start();
if (!isset($_SESSION['user_id'])) {
    backToIndex();
}

$getUser = $db->getUser($_SESSION['user_id']);
if ($getUser->num_rows > 0) {
    $user = $getUser->fetch_assoc();
    if ($user['USER_TYPE'] != 'admin') {
        backToIndex();
    }
} else {
    backToIndex();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>PRMSU COE-DMS | Admin</title>

    <link rel="stylesheet" href="../../node_modules/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="../../node_modules/bootstrap-icons/font/bootstrap-icons.css">
    <link rel="stylesheet" href="../css/nav.css" />
    <link rel="stylesheet" href="../css/styles.css" />

    <script src="../../node_modules/jquery/dist/jquery.min.js"></script>
</head>

<body>
    <div class="alert"></div>

    <nav class="top-nav bg-dark d-flex align-items-center justify-content-between">
        <h4 class="top-nav-title">PRMSU COE-DMS</h4>
        <h5 class="text-light txt-welcome-admin">Welcome Admin!</h5>
    </nav>
    <aside class="side-bar bg-light text-light">
        <div class="nav-search-bar p-2">
            <input type="search" class="form-control" placeholder="Search files...">
        </div>
        <ul class="side-nav-ul list-group p-2">
            <li class="side-nav-li">
                <a href="#" class="a-inbox">
                    <i class="bi bi-chat-dots-fill"></i> Inbox
                </a>
            </li>
            <?php
            $getSections = $admin_db->getSections();
            while ($section = $getSections->fetch_assoc()) {
            ?>
                <li class="side-nav-li">
                    <a href="admin.php?section=<?= $section['ID'] ?>" class="<?= (isset($_GET['section']) && $_GET['section'] == $section['ID']) ? 'side-nav-active' : '' ?>"><?= $section['SECTION_NAME'] ?></a>
                    <button class="btn btn-toggle-section-menu">
                        <i class="bi bi-gear-fill"></i>
                    </button>
                    <ul class="list-group section-menu-container">
                        <li>
                            <button class="btnRename" data-id="<?= $section['ID'] ?>" data-name="<?= $section['SECTION_NAME'] ?>">Rename</button>
                        </li>
                        <li>
                            <button class="btnDelete" data-id="<?= $section['ID'] ?>">Delete</button>
                        </li>
                    </ul>
                </li>
            <?php
            }
            ?>
            <li class="side-nav-li">
                <button class="btn-create-new-section" id="btnCreateNewSection">
                    <i class="bi bi-plus"></i> Create New Section
                </button>
            </li>
        </ul>
        <ul class="list-group mt-3 p-2">
            <div class="admin-tools-label">
                <p>Admin Tools</p>
            </div>
            <li class="side-nav-li">
                <a href="#">Manage Users</a>
            </li>
            <li class="side-nav-li">
                <a href="#">Recycle Bin</a>
            </li>
            <li class="side-nav-li">
                <a href="../../logout.php">Log Out</a>
            </li>
        </ul>
    </aside>