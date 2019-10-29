<?php 

require_once("config.php");

if(isset($_POST['loginmaha'])){

    $username = $_POST['username'];
    $password = $_POST['password'];
 
    $query = mysqli_query($con, "SELECT * FROM tb_mahasiswa WHERE username='$username' AND password='$password'");
    $cek = mysqli_num_rows($query);

    $user = mysqli_query($con, "SELECT id_mahasiswa FROM tb_mahasiswa WHERE username='$username' AND password='$password'");
    $nim = mysqli_fetch_assoc($user);

    if($cek == 1){
        session_start();
        $_SESSION["user"] = $nim["id_mahasiswa"];
        header("Location: activity.php");
    } else {
        header("Location: login.php");
    }
}
?>