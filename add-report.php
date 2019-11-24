<?php
session_start();
require_once("config.php");

$target_dir = "uploads/";
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
// Check if image file is a actual image or fake image
if(isset($_POST["addReport"])) {
    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
    if($check !== false) {
        $uploadOk = 1;
    } else {
        $uploadOk = 0;
    }
}
// Check if file already exists
if (file_exists($target_file)) {
    $uploadOk = 0;
}
// Check file size
if ($_FILES["fileToUpload"]["size"] > 500000) {
    $uploadOk = 0;
}
// Allow certain file formats
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
&& $imageFileType != "gif" ) {
    $uploadOk = 0;
}
// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
    echo "Sorry, your file was not uploaded.";
// if everything is ok, try to upload file
} else {
    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
        $message = "Report has been recorded";
        echo "<script type='text/javascript'>alert('$message');</script>";

        $namakegiatan = $_POST['namakegiatan'];
        $tglmulai = $_POST['tglmulai'];
        $tglselesai = $_POST['tglselesai'];
        $jenis = $_POST['jenis'];
        $deskripsi = $_POST['deskripsi'];
        $filebukti = $target_file;
        $nim = $_SESSION['user'];

        $result = mysqli_query($con, "INSERT INTO tb_report(namakegiatan, tglmulai, tglselesai, jenis, deskripsi, filebukti, id_mahasiswa) VALUES('$namakegiatan', '$tglmulai', '$tglselesai', '$jenis', '$deskripsi', '$filebukti', '$nim')");

        header("Refresh:0; url=report.php");
    } else {
        echo "Sorry, there was an error.";
    }
}
?>