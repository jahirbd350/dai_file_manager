<?php


namespace App\classes;


class FileManager
{
    private $link;

    public function __construct()
    {
        $this->link = Database::db_connect();
    }

    protected static function uploadFile() {
        $pictureName = $_FILES['file']['name'];
        $directory = 'files/'.$_SESSION['userinfo']['user_name'].'/';
        $targetFile = $directory . $pictureName;
        $fileType = pathinfo($pictureName, PATHINFO_EXTENSION);
        $check = filesize($_FILES['file']['tmp_name']);
        if ($check) {
            if (!file_exists($targetFile)) {
                if ($fileType == 'jpg' || $fileType == 'png' || $fileType == 'jpeg'|| $fileType == 'pdf'|| $fileType == 'docx'|| $fileType == 'xlsx'|| $fileType == 'doc'|| $fileType == 'xlx' || $fileType == 'ppt' || $fileType == 'pptx') {
                    if ($_FILES['file']['size'] < 536870912) {
                        move_uploaded_file($_FILES['file']['tmp_name'], $targetFile);
                        return $targetFile;
                    } else {
                        $_SESSION['message'] = 'Your file size is too large. Maximum File size is 100MB. Thanks !!!';
                    }
                } else {
                    $_SESSION['message'] = 'Please use jpg, jpeg, png, pdf, doc, docx, xlsx, xlx and ppt file. Thanks !!!';
                }
            } else {
                $_SESSION['message'] = 'File Name already exist. Please Rename and upload again. Thanks !!!';
            }
        } else {
            $_SESSION['message'] = 'Problem with the file! Please another file. Thanks !!!';
        }
    }

    public function sendFile(){
        $targetFile = FileManager::uploadFile();
        if (!$targetFile){
            return 'File Upload Error! ';
        } else {
            $user = $_SESSION['userinfo']['user_name'];
            $sql = "INSERT INTO files (file_name, authority, file_info, from_section, to_section) VALUES ('$_POST[file_name]', '$_POST[authority]', '$targetFile','$user', '$_POST[to_section]')";
            if (mysqli_query($this->link, $sql)) {
                return "New File Sent successfully";
            } else {
                die('sendFile Query Problem' . mysqli_error($this->link));
            }
        }
    }

    public function addSelfFile(){
        $targetFile = FileManager::uploadFile();
        if (!$targetFile){
            return 'File Upload Error! ';
        } else {
            $user = $_SESSION['userinfo']['user_name'];
            $sql = "INSERT INTO files (file_name, authority, file_info, from_section) VALUES ('$_POST[file_name]', '$_POST[authority]', '$targetFile','$user')";
            if (mysqli_query($this->link, $sql)) {
                return "New File Added successfully";
            } else {
                die('addSelfFile Query Problem' . mysqli_error($this->link));
            }
        }
    }

    public function allFileByUser(){
        $user = $_SESSION['userinfo']['user_name'];
        $sql = "SELECT * FROM files WHERE from_section = '$user' AND to_section IS NULL ORDER BY id DESC";
        if (mysqli_query($this->link, $sql)) {
            return mysqli_query($this->link, $sql);
        } else {
            die('allFileByUser Query Problem ' . mysqli_error($this->link));
        }
    }

    public function allFileReceived(){
        $user = $_SESSION['userinfo']['user_name'];
        $sql = "SELECT * FROM files LEFT JOIN users ON (files.from_section = users.user_name) WHERE files.to_section = '$user' ORDER BY files.id DESC";
        if (mysqli_query($this->link, $sql)) {
            return mysqli_query($this->link, $sql);
        } else {
            die('allFileReceived Query Problem ' . mysqli_error($this->link));
        }
    }

    public function allFileSent(){
        $user = $_SESSION['userinfo']['user_name'];
        $sql = "SELECT * FROM files LEFT JOIN users ON (files.to_section = users.user_name) WHERE files.from_section = '$user' AND files.to_section != '' ORDER BY files.id DESC";
        if (mysqli_query($this->link, $sql)) {
            return mysqli_query($this->link, $sql);
        } else {
            die('allFileReceived Query Problem ' . mysqli_error($this->link));
        }
    }

    public function deleteFileById($id){
        $sql = "DELETE FROM files WHERE id = '$id'";
        if (mysqli_query($this->link, $sql)) {
            return 'File Deleted Successfully';
        } else {
            die('deleteFileById Query Problem ' . mysqli_error($this->link));
        }
    }



}