<?php
session_start();
require_once("config.php");

if(isset($_POST['addActivity'])){
    $namakegiatan = $_POST['namakegiatan'];
    $tglmulai = $_POST['tglmulai'];
    $tglselesai = $_POST['tglselesai'];
    $jenis = $_POST['jenis'];
    $ketua = $_POST['ketua'];
    $deskripsi = $_POST['deskripsi'];
    $nim = $_SESSION['user'];

    $result = mysqli_query($con, "INSERT INTO tb_activity(namakegiatan, tglmulai, tglselesai, jenis, ketua, deskripsi, id_mahasiswa) VALUES('$namakegiatan', '$tglmulai', '$tglselesai', '$jenis', '$ketua', '$deskripsi', '$nim')");

    header("Refresh:0; url=activity.php");
}
?>