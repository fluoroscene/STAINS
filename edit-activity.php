<?php

include_once("config.php");
$hasil = mysqli_query($con, "SELECT * FROM tb_activity WHERE id_mahasiswa = '$nim'");
$id = mysqli_fetch_assoc($hasil);

if(isset($_POST['editActivity'.$id])){

    $namakegiatan = $_POST['namakegiatan'];
    $tglmulai = $_POST['tglmulai'];
    $tglselesai = $_POST['tglselesai'];
    $jenis = $_POST['jenis'];
    $ketua = $_POST['ketua'];
    $deskripsi = $_POST['deskripsi'];

    $result = mysqli_query($con, "UPDATE tb_activity SET namakegiatan='$namakegiatan', tglmulai='$tglmulai', tglselesai='$tglselesai', jenis='$jenis', ketua='$ketua', deskripsi='$deskripsi' WHERE id_activity='$id'");

    header("Refresh:0; url=activity.php");
}

?>