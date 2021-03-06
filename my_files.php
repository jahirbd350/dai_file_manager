<?php
$message = '';
session_start();

include 'vendor/autoload.php';

use App\classes\Login;
use App\classes\FileManager;

if (!isset($_SESSION['userinfo']['id'])) {
    header('location: index.php');
}

if (isset($_GET['status'])) {
    if ($_GET['status'] == 'logout') {
        $login = new Login();
        $message = $login->logout();
    }
    if ($_GET['status'] == 'delete') {
        if (unlink($_GET['file'])) {
            $fileManager = new FileManager();
            $message = $fileManager->deleteFileById($_GET['id']);
        } else {
            $message = 'File Delete Problem!';
        }
    }
}

$fileManager = new FileManager();
$allFiles = $fileManager->allFileByUser();

$Login = new Login();
$allUsers = $Login->selectUsers();
$currentPage = 'my_files';
include 'header.php';
?>
    <div class="section p-2">
        <h4 class="text-center text-warning"><?php echo $message; ?></h4>
        <h4 class="text-center text-danger"><?php if (isset($_SESSION['message'])) {
                echo $_SESSION['message'];
                unset($_SESSION['message']);
            } ?>
        </h4>
    </div>
<div class="section">
    <div class="card">
        <h5 class="card-header bg-success text-light text-center">My Files</h5>
        <div class="card-body">
            <table class="table table-bordered table-striped" id="dataTable" width="100%" cellspacing="0">
                <thead>
                <tr>
                    <th width="10%" text-allign="center">Ser No</th>
                    <th width="20%">File Name</th>
                    <th width="35%">Authority</th>
                    <th width="15%">File</th>
                    <th width="10%">Date</th>
                    <th width="10%">Action</th>
                </tr>
                </thead>
                <tfoot>
                <tr>
                    <th width="10%" text-allign="center">Ser No</th>
                    <th width="20%">File Name</th>
                    <th width="35%">Authority</th>
                    <th width="15%">File</th>
                    <th width="10%">Date</th>
                    <th width="10%">Action</th>
                </tr>
                </tfoot>
                <tbody>
                <?php
                $ser = 0;
                while ($allFilesInfo = mysqli_fetch_assoc($allFiles)) {
                    $ser++;
                    ?>
                    <tr>
                        <th class="text-center"><?php echo $ser; ?></th>
                        <td><?php echo $allFilesInfo['file_name'] ?></td>
                        <td><?php echo $allFilesInfo['authority'] ?></td>
                        <td class="text-center"><a href="<?php echo $allFilesInfo['file_info'] ?>"
                                                   download="<?php echo $allFilesInfo['file_info'] ?>"><button class="btn btn-outline-info" type="button">Download</button></a></td>
                        <td class="text-center"><?php echo date('d M y h:i A', strtotime($allFilesInfo['submitted_at'])); ?></td>
                        <td class="text-center">
                            <a href="?status=delete&&id=<?php echo $allFilesInfo['id']; ?>&&file=<?php echo $allFilesInfo['file_info']; ?>"
                               class="btn btn-sm btn-danger delete-sub-category" title="Delete File">
                                <i class="fas fa-trash"></i></i>
                            </a>
                        </td>
                    </tr>
                <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>


<?php
include 'footer.php';
?>
