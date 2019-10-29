<?php 

require_once("config.php");

if(isset($_POST['loginadm'])){

    $username = $_POST['username'];
    $password = $_POST['password'];
 
    $query = mysqli_query($con, "SELECT * FROM tb_admin WHERE username='$username' AND password='$password'");
    $cek = mysqli_num_rows($query);

    $user = mysqli_query($con, "SELECT id_admin FROM tb_admin WHERE username='$username' AND password='$password'");
    $id = mysqli_fetch_assoc($user);

    if($cek == 1){
        session_start();
        $_SESSION["adm"] = $id["id_admin"];
        header("Location: activity-management.php");
    } else {
        header("Location: login.php");
    }
}
?>