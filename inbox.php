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
}

$fileManager = new FileManager();
$allFiles = $fileManager->allFileReceived();
$currentPage = 'inbox';
include 'header.php';
?>

<div class="section p-2">
    <h4 class="text-center text-warning"><?php echo $message; ?></h4>
    <h4 class="text-center text-danger"><?php if (isset($_SESSION['message'])) {
            echo $_SESSION['message'];
            unset($_SESSION['message']);
        } ?></h4>
</div>
<div class="row">
    <div class="col-12">


    <div class="card mb-4">
        <h5 class="card-header bg-success text-light text-center">Inbox</h5>
        <div class="card-body">
            <table class="table table-bordered table-striped" id="dataTable">
                <thead class="text-center bg-secondary">
                <tr>
                    <th width="10%" text-allign="center">Ser No</th>
                    <th width="20%">File Name</th>
                    <th width="30%">Authority</th>
                    <th width="15%">File</th>
                    <th width="15%">Sent From</th>
                    <th width="10%">Date</th>
                </tr>
                </thead>
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
                        <td class="text-center"><?php echo $allFilesInfo['section_name'] ?></td>
                        <td class="text-center"><?php echo date('d M y h:i A', strtotime($allFilesInfo['submitted_at'])); ?></td>
                    </tr>
                <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
    </div>
</div>
<?php
include 'footer.php';
?>
