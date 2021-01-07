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

if (isset($_POST['send_file'])) {
    /*echo '<pre>';
    print_r($_FILES);
    echo '</pre>';*/
    $newFile = new FileManager();
    $message = $newFile->sendFile();
}

if (isset($_POST['addSelfFile'])){
    $FileManager = new FileManager();
    $message = $FileManager->addSelfFile();

}

$Login = new Login();
$allUsers = $Login->selectUsers();
$currentPage = 'dashboard';
include 'header.php';
?>

    <div class="section p-2">
        <h4 class="text-center text-warning"><?php echo $message; ?></h4>
        <h4 class="text-center text-danger"><?php if (isset($_SESSION['message'])) {
                echo $_SESSION['message'];
                unset($_SESSION['message']);
            } ?></h4>
        <div class="modal fade bs-example-modal-center" id="addFileForSelf" tabindex="-1" role="dialog"
             aria-labelledby="mySmallModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title mt-0">Add New File</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="" method="POST" enctype="multipart/form-data" id="sendFileForm">
                            <div class="form-group row mb-4">
                                <label for="file_name" class="col-sm-3 col-form-label">File Name</label>
                                <div class="col-sm-9">
                                    <input type="text" id="file_name" name="file_name" class="form-control" required/>
                                </div>
                            </div>
                            <div class="form-group row mb-4">
                                <label for="authority" class="col-sm-3 col-form-label">Authority/ Additional
                                    Info</label>
                                <div class="col-sm-9">
                                    <input type="text" name="authority" class="form-control" id="authority"/>
                                </div>
                            </div>
                            <div class="form-group row mb-4">
                                <label for="file" class="col-sm-3 col-form-label">File</label>
                                <div class="col-sm-9">
                                    <input type="file" name="file" class="form-control" id="userImage" required/>
                                </div>
                            </div>
                            <div class="form-group row justify-content-end">
                                <div class="col-sm-9">
                                    <div id="progress-div">
                                        <div id="progress-bar"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row justify-content-end">
                                <div class="col-sm-9">
                                    <div>
                                        <button type="submit" name="addSelfFile" class="btn btn-primary w-md">Add New
                                            File
                                        </button>
                                    </div>
                                </div>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade bs-example-modal-center" id="sendFile" tabindex="-1" role="dialog"
             aria-labelledby="mySmallModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title mt-0">Add New File</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="" method="POST" enctype="multipart/form-data" id="sendFileForm">
                            <div class="form-group row mb-4">
                                <label for="file_name" class="col-sm-3 col-form-label">File Name</label>
                                <div class="col-sm-9">
                                    <input type="text" id="file_name" name="file_name" class="form-control" required/>
                                </div>
                            </div>
                            <div class="form-group row mb-4">
                                <label for="authority" class="col-sm-3 col-form-label">Authority/ Additional
                                    Info</label>
                                <div class="col-sm-9">
                                    <input type="text" name="authority" class="form-control" id="authority"/>
                                </div>
                            </div>
                            <div class="form-group row mb-4">
                                <label for="file" class="col-sm-3 col-form-label">File</label>
                                <div class="col-sm-9">
                                    <input type="file" name="file" class="form-control demoInputBox" id="userImage" required/>
                                </div>
                            </div>
                            <div class="form-group row mb-4">
                                <label for="authority" class="col-sm-3 col-form-label">Send To</label>
                                <div class="col-sm-9">
                                    <select class="form-control" name="to_section" aria-label="Default select example" required>
                                        <option disabled selected> --- Select Section Name ---</option>
                                        <?php while ($allUsersInfo = mysqli_fetch_assoc($allUsers)) { ?>
                                            <option value="<?php echo $allUsersInfo['user_name']; ?>"><?php echo $allUsersInfo['section_name']; ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row mb-4 justify-content-end">
                                <div class="col-sm-9">
                                    <div id="progress-div">
                                        <div id="progress-bar"></div>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group row ">
                                <div class="col-sm-9">
                                    <div>
                                        <button type="submit" name="send_file" class="btn btn-primary w-md">Send The File</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="section">
        <div class="card">
            <h5 class="card-header bg-primary text-light text-center">Dashboard</h5>
            <div class="card-body" style="height: 200%">
                <div class="row">
                    <div class="col-md-4 offset-2">
                        <div class="card">
                            <h5 class="card-header bg-light text-primary text-center">Upload for Self</h5>
                            <div class="card-body">
                                <button type="submit" class="btn btn-success btn-block" title="Add new file" data-toggle="modal"
                                        data-target="#addFileForSelf">Add New File
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card">
                            <h5 class="card-header bg-light text-primary text-center">Send to Others</h5>
                            <div class="card-body">
                                <button type="submit" class="btn btn-success btn-block" title="Send a File" data-toggle="modal"
                                        data-target="#sendFile">Send a File
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php
include 'footer.php';
?>
<script type="text/javascript">
    $(document).ready(function () {
        $('#sendFileForm').submit(function (e) {
            //alert('Form Submitted!');
            if ($('#userImage').val()) {
                //alert('File Added!');
                //e.preventDefault();
                $(this).ajaxSubmit({
                    target: '#targetLayer',
                    beforeSubmit: function () {
                        $("#progress-bar").width('0%');
                    },
                    uploadProgress: function (event, position, total, percentComplete) {
                        $("#progress-bar").width(percentComplete + '%');
                        $("#progress-bar").html('<div id="progress-status">' + percentComplete + ' %</div>')
                    },
                    resetForm: true
                });
                return true;
            }
        });
    });

</script>
