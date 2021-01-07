<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>DAI File Manager</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="assets/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <link rel="stylesheet" href="assets/css/font-awesome/all.css">
    <link rel="stylesheet" href="style.css">
    <link rel = "icon" href ="assets/icon.png" type = "image/x-icon">
    <style>
        .active {
            color: #fff;
            background-color: #17a2b8;
            border-color: #17a2b8;
        }
    </style>
</head>
<body>
<div class="main">
<div class="container">
    <div class="section">
        <nav class="navbar navbar-expand-lg navbar-light navbar-right" style="background-color:#e3f2fd;">
            <a class="navbar-brand btn btn-outline-info <?php if($currentPage =='dashboard'){echo 'active';}?>" href="dashboard.php"><b>Dashboard</b></a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                    aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav nav-pills me-auto mb-2 mb-lg-0">
                    <li class="nav-item " style="margin-right: 10px">
                        <a class="btn btn-outline-info <?php if($currentPage =='my_files'){echo 'active';}?>" href="my_files.php"><b>My Files</b></a>
                    </li>
                    <li class="nav-item"  style="margin-right: 10px">
                        <a class="btn btn-outline-info <?php if($currentPage =='sent'){echo 'active';}?>" href="sent.php"><b>Sent</b></a>
                    </li>
                    <li class="nav-item"  style="margin-right: 10px">
                        <a class="btn btn-outline-info <?php if($currentPage =='inbox'){echo 'active';}?>" href="inbox.php"><b>Inbox</b></a>
                    </li>
                </ul>
            </div>
            <ul class="nav navbar-nav">
                <li class="dropdown">
                    <button class="btn btn-outline-info dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown"
                            aria-haspopup="true" aria-expanded="false">
                        <?php echo "Welcome: ".'<b>'. $_SESSION['userinfo']['section_name'].'</b>'; ?>
                    </button>
                    <div class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuButton">
                        <a class="dropdown-item" href="reset_password.php">Change Password</a>
                        <hr>
                        <a href="?status=logout" class="dropdown-item">Logout</a>
                    </div>
                </li>
            </ul>
        </nav>
    </div>
