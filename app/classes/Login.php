<?php


namespace App\classes;

use App\classes\Database;
class Login
{
    public function login_check(){
        $link = Database::db_connect();
        $loginSql = "SELECT * FROM users WHERE user_name='$_POST[user_name]' AND password='$_POST[password]'";
        if (mysqli_query($link,$loginSql)){
            $userInfo = mysqli_query($link,$loginSql);
            if (mysqli_num_rows($userInfo)>0){
                $userInfo = mysqli_fetch_assoc($userInfo);
                $_SESSION['userinfo'] = $userInfo;
                header('location: dashboard.php');
            }else{
                return 'User Name or Password is error';
            }
        } else {
            die('Login Query Error : ' .mysqli_error($link));
        }
    }

    public function logout(){
        session_destroy();
        header('location: index.php');
    }

    public function selectUsers(){
        $link = Database::db_connect();
        $user = $_SESSION['userinfo']['user_name'];
        $sql = "SELECT * FROM users WHERE user_name != '$user'";
        if (mysqli_query($link,$sql)){
            return mysqli_query($link,$sql);
        } else {
            die('All Users Query Error : '.mysqli_error($link));
        }
    }

    public function reset_password(){
        $link = Database::db_connect();
        $user = $_SESSION['userinfo']['user_name'];
        $sql = "UPDATE users SET password = '$_POST[new_password]' WHERE user_name = '$user'";
        if (mysqli_query($link,$sql)){
            return 'Password Updated successfully!<br>Please Logout and Login with new password. Thanks';
        } else {
            die('reset_password Query Error: '.mysqli_error($link));
        }
    }
}