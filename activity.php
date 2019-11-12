<?php
require_once("sessionmahasiswa.php");
require_once("config.php");

$nim = $_SESSION["user"];

$query = mysqli_query($con, "SELECT nama FROM tb_mahasiswa WHERE id_mahasiswa = '$nim'");
$nama = mysqli_fetch_assoc($query);

$result = mysqli_query($con, "SELECT * FROM tb_activity WHERE id_mahasiswa = '$nim' AND deleted='0'");

?>

<html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Activity</title>
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto|Varela+Round">
<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<style type="text/css">
    body {
        color: #566787;
		background: #f5f5f5;
		font-family: 'Varela Round', sans-serif;
		font-size: 13px;
	}
	.table-wrapper {
        background: #fff;
        padding: 20px 25px;
        margin: 30px 0;
		border-radius: 3px;
        box-shadow: 0 1px 1px rgba(0,0,0,.05);
    }
	.table-title {        
		padding-bottom: 15px;
		background: #9b3cd6;
		color: #fff;
		padding: 16px 30px;
		margin: -20px -25px 10px;
		border-radius: 3px 3px 0 0;
    }
    .table-title h2 {
		margin: 5px 0 0;
		font-size: 24px;
	}
	.table-title .btn-group {
		float: right;
	}
	.table-title .btn {
		color: #fff;
		float: right;
		font-size: 13px;
		border: none;
		min-width: 50px;
		border-radius: 2px;
		border: none;
		outline: none !important;
		margin-left: 10px;
	}
	.table-title .btn i {
		float: left;
		font-size: 21px;
		margin-right: 5px;
	}
	.table-title .btn span {
		float: left;
		margin-top: 2px;
	}
    table.table tr th, table.table tr td {
        border-color: #e9e9e9;
		padding: 12px 15px;
		vertical-align: middle;
    }
	table.table tr th:first-child {
		width: 60px;
	}
	table.table tr th:last-child {
		width: 100px;
	}
    table.table-striped tbody tr:nth-of-type(odd) {
    	background-color: #fcfcfc;
	}
	table.table-striped.table-hover tbody tr:hover {
		background: #f5f5f5;
	}
    table.table th i {
        font-size: 13px;
        margin: 0 5px;
        cursor: pointer;
    }	
    table.table td:last-child i {
		opacity: 0.9;
		font-size: 22px;
        margin: 0 5px;
    }
	table.table td a {
		font-weight: bold;
		color: #566787;
		display: inline-block;
		text-decoration: none;
		outline: none !important;
	}
	table.table td a:hover {
		color: #2196F3;
	}
	table.table td a.edit {
        color: #FFC107;
    }
    table.table td a.delete {
        color: #F44336;
    }
    table.table td i {
        font-size: 19px;
    }
	table.table .avatar {
		border-radius: 50%;
		vertical-align: middle;
		margin-right: 10px;
	}
    .pagination {
        float: right;
        margin: 0 0 5px;
    }
    .pagination li a {
        border: none;
        font-size: 13px;
        min-width: 30px;
        min-height: 30px;
        color: #999;
        margin: 0 2px;
        line-height: 30px;
        border-radius: 2px !important;
        text-align: center;
        padding: 0 6px;
    }
    .pagination li a:hover {
        color: #666;
    }	
    .pagination li.active a, .pagination li.active a.page-link {
        background: #03A9F4;
    }
    .pagination li.active a:hover {        
        background: #0397d6;
    }
	.pagination li.disabled i {
        color: #ccc;
    }
    .pagination li i {
        font-size: 16px;
        padding-top: 6px
    }
    .hint-text {
        float: left;
        margin-top: 10px;
        font-size: 13px;
    }    
	/* Custom checkbox */
	.custom-checkbox {
		position: relative;
	}
	.custom-checkbox input[type="checkbox"] {    
		opacity: 0;
		position: absolute;
		margin: 5px 0 0 3px;
		z-index: 9;
	}
	.custom-checkbox label:before{
		width: 18px;
		height: 18px;
	}
	.custom-checkbox label:before {
		content: '';
		margin-right: 10px;
		display: inline-block;
		vertical-align: text-top;
		background: white;
		border: 1px solid #bbb;
		border-radius: 2px;
		box-sizing: border-box;
		z-index: 2;
	}
	.custom-checkbox input[type="checkbox"]:checked + label:after {
		content: '';
		position: absolute;
		left: 6px;
		top: 3px;
		width: 6px;
		height: 11px;
		border: solid #000;
		border-width: 0 3px 3px 0;
		transform: inherit;
		z-index: 3;
		transform: rotateZ(45deg);
	}
	.custom-checkbox input[type="checkbox"]:checked + label:before {
		border-color: #03A9F4;
		background: #03A9F4;
	}
	.custom-checkbox input[type="checkbox"]:checked + label:after {
		border-color: #fff;
	}
	.custom-checkbox input[type="checkbox"]:disabled + label:before {
		color: #b8b8b8;
		cursor: auto;
		box-shadow: none;
		background: #ddd;
	}
	/* Modal styles */
	.modal .modal-dialog {
		max-width: 400px;
	}
	.modal .modal-header, .modal .modal-body, .modal .modal-footer {
		padding: 20px 30px;
	}
	.modal .modal-content {
		border-radius: 3px;
	}
	.modal .modal-footer {
		background: #ecf0f1;
		border-radius: 0 0 3px 3px;
	}
    .modal .modal-title {
        display: inline-block;
    }
	.modal .form-control {
		border-radius: 2px;
		box-shadow: none;
		border-color: #dddddd;
	}
	.modal textarea.form-control {
		resize: vertical;
	}
	.modal .btn {
		border-radius: 2px;
		min-width: 100px;
	}	
	.modal form label {
		font-weight: normal;
	}
	.status {
		font-size: 30px;
		margin: 2px 2px 0 0;
		display: inline-block;
		vertical-align: middle;
		line-height: 10px;
	}
    .text-success {
        color: #10c469;
    }
    .text-info {
        color: #62c9e8;
    }
    .text-warning {
        color: #FFC107;
    }
    .text-danger {
        color: #ff5b5b;
    }
</style>
<script type="text/javascript">
$(document).ready(function(){
	// Activate tooltip
	$('[data-toggle="tooltip"]').tooltip();
	
	// Select/Deselect checkboxes
	var checkbox = $('table tbody input[type="checkbox"]');
	$("#selectAll").click(function(){
		if(this.checked){
			checkbox.each(function(){
				this.checked = true;                        
			});
		} else{
			checkbox.each(function(){
				this.checked = false;                        
			});
		} 
	});
	checkbox.click(function(){
		if(!this.checked){
			$("#selectAll").prop("checked", false);
		}
	});
});
</script>
</head>
<body>
    <div class="container">
        <div class="table-wrapper">
            <div class="table-title">
                <div class="row">
                    <div class="col-sm-6">
						<h2>Your <b>Activity </b> (<?php echo $nama["nama"]; ?>)</h2>
					</div>
					<div class="col-sm-6">
						<a href="#addActivityModal" class="btn btn-success" data-toggle="modal"><i class="material-icons">&#xE147;</i> <span>Add New Activity</span></a>
						<a href="logoutmahasiswa.php" class="btn btn-danger"><i class="material-icons">&#xE15C;</i> <span>Log out</span></a>			
						<a href="#addReportModal" class="btn btn-success" data-toggle="modal"><i class="material-icons">&#xE147;</i> <span>Add New Report</span></a>			
					</div>
                </div>
            </div>
            <table class="table table-striped table-hover">
                <thead>
                    <tr>
						<th>No</th>
                        <th>Nama Acara</th>
                        <th>Tanggal Diajukan</th>
						<th>Jenis</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
				<?php
					$no = 1;
					while($row = mysqli_fetch_assoc($result))
					{
				?>
							<tr>
							<td><?php echo $no++;?></td>
							<td><a href="#" data-toggle="modal" data-target="#openActivityModal<?php echo $row['id_activity'];?>"><?php echo $row['namakegiatan']?></td>
							<td><?php echo $row['tgldiajukan'];?></td>
							<td><?php echo $row['jenis'];?></td>
							<?php
							if($row['status'] == 0){
								echo "<td><span class='status text-danger'>&bull;</span>Rejected</td>";
							}
							else if($row['status'] == 1){
								echo "<td><span class='status text-warning'>&bull;</span>Pending</td>";
							}
							else if($row['status'] == 2){
								echo "<td><span class='status text-success'>&bull;</span>Approved</td>";
							}
							?>
							<td>
                            <a href="#" data-toggle="modal" data-target="#editActivityModal<?php echo $row['id_activity'];?>"><i class='material-icons' data-toggle='tooltip' title='Edit'>&#xE254;</i></a>
                            <a href="#" data-toggle="modal" data-target="#deleteActivityModal<?php echo $row['id_activity'];?>"><i class='material-icons' data-toggle='tooltip' title='Delete'>&#xE872;</i></a>
                        	</td>
							</tr>
                </tbody>
				<!-- Open Modal HTML -->
				<div id="openActivityModal<?php echo $row['id_activity'];?>" class="modal fade" role="dialog">
					<div class="modal-dialog">
						<div class="modal-content">
							<form>
								<div class="modal-header">						
									<h4 class="modal-title">Activity Details</h4>
									<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
								</div>
								<div class="modal-body">
									<div class="form-group">
										<label>Nama Acara</label>
										<label class="form-control"><?php echo $row['namakegiatan'];?></label>
									</div>
									<div class="form-group">
										<label>Tanggal Mulai</label>
										<label class="form-control"><?php echo $row['tglmulai'];?></label>
									</div>
									<div class="form-group">
										<label>Tanggal Selesai</label>
										<label class="form-control"><?php echo $row['tglselesai'];?></label>
									</div>
									<div class="form-group">
										<label>Jenis Kegiatan</label>
										<label class="form-control"><?php echo $row['jenis'];?></label>
									</div>
									<div class="form-group">
										<label>Ketua Panitia</label>
										<label class="form-control"><?php echo $row['ketua'];?></label>
									</div>
									<div class="form-group">
										<label>Deskripsi</label>
										<textarea class="form-control" rows="5" readonly><?php echo $row['deskripsi'];?></textarea>
									</div>
								</div>
								<div class="modal-footer">
									<input type="button" class="btn btn-default" data-dismiss="modal" value="Close">
								</div>
							</form>
						</div>
					</div>
				</div>
				<?php
				include_once("config.php");

				if(isset($_POST['editActivity'.$row['id_activity']])){
					
				$idact = $row['id_activity'];
				$namakegiatan = $_POST['namakegiatan'];
				$tglmulai = $_POST['tglmulai'];
				$tglselesai = $_POST['tglselesai'];
				$jenis = $_POST['jenis'];
				$ketua = $_POST['ketua'];
				$deskripsi = $_POST['deskripsi'];

				$updet = mysqli_query($con, "UPDATE tb_activity SET namakegiatan='$namakegiatan', tglmulai='$tglmulai', tglselesai='$tglselesai', jenis='$jenis', ketua='$ketua', deskripsi='$deskripsi', status='1', tgldiajukan=CURRENT_TIMESTAMP WHERE id_activity='$idact'");

				echo("<meta http-equiv='refresh' content='1'>");
				}
				?>
				<?php

				$idact = $row['id_activity'];

				$nampil = mysqli_query($con, "SELECT * FROM tb_activity WHERE id_activity='$idact'");

				while($data_act = mysqli_fetch_array($nampil)){
					$namakeg = $data_act['namakegiatan'];
					$tglmulai = $data_act['tglmulai'];
					$tglselesai = $data_act['tglselesai'];
					$jeniskeg = $data_act['jenis'];
					$ketua = $data_act['ketua'];
					$deskripsi = $data_act['deskripsi'];
				}
				?>
				<!-- Edit Modal HTML -->
				<div id="editActivityModal<?php echo $row['id_activity'];?>" class="modal fade">
					<div class="modal-dialog">
						<div class="modal-content">
							<form action="" method="POST">
								<div class="modal-header">						
									<h4 class="modal-title">Edit Activity</h4>
									<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
								</div>
								<div class="modal-body">
									<div class="form-group">
										<label>Nama Kegiatan</label>
										<input type="text" name="namakegiatan" value="<?php echo $namakeg;?>" class="form-control" required>
									</div>
									<div class="form-group">
										<label>Tanggal Mulai</label>
										<input type="date" name="tglmulai" value="<?php echo $tglmulai;?>" class="form-control" required>
									</div>
									<div class="form-group">
										<label>Tanggal Selesai</label>
										<input type="date" name="tglselesai" value="<?php echo $tglselesai;?>" class="form-control" required>
									</div>
									<div class="form-group">
										<label>Jenis Acara</label>
										<select name="jenis" value="<?php echo $jeniskeg;?>" class="form-control" required> 
										<option value="Hiburan">Hiburan</option>
										<option value="Akademik">Akademik</option>
										<option value="Training">Training</option>
										<option value="Festival">Festival</option>
										</select>
									</div>
									<div class="form-group">
										<label>Ketua Panitia</label>
										<input type="text" name="ketua" value="<?php echo $ketua;?>" class="form-control" required>
									</div>
									<div class="form-group">
										<label>Deskripsi Kegiatan</label>
										<textarea name="deskripsi" rows="5" class="form-control" required><?php echo $deskripsi;?></textarea>
									</div>
								</div>
								<div class="modal-footer">
									<input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
									<input type="submit" class="btn btn-success" value="Save" name="editActivity<?php echo $row['id_activity'];?>">
								</div>
							</form>
						</div>
					</div>
				</div>
				<?php
				include_once("config.php");

				if(isset($_POST['deleteActivity'.$row['id_activity']])){
					
				$idact = $row['id_activity'];

				$delet = mysqli_query($con, "UPDATE tb_activity SET deleted='1' WHERE id_activity='$idact'");

				echo("<meta http-equiv='refresh' content='1'>");
				}
				?>
				<!-- Delete Modal HTML -->
				<div id="deleteActivityModal<?php echo $row['id_activity'];?>" class="modal fade">
					<div class="modal-dialog">
						<div class="modal-content">
							<form action="" method="POST">
								<div class="modal-header">						
									<h4 class="modal-title">Delete Activity</h4>
									<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
								</div>
								<div class="modal-body">					
									<p>Are you sure you want to delete these Records?</p>
									<p class="text-warning"><small>This action cannot be undone.</small></p>
								</div>
								<div class="modal-footer">
									<input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
									<input type="submit" class="btn btn-danger" value="Delete" name="deleteActivity<?php echo $row['id_activity'];?>">
								</div>
							</form>
						</div>
					</div>
				</div>
				<?php
					}
				?>
            </table>
			<div class="clearfix">
                <ul class="pagination">
                    <li class="page-item disabled"><a href="#">Previous</a></li>
                    <li class="page-item active"><a href="#" class="page-link">1</a></li>
                    <li class="page-item"><a href="#" class="page-link">Next</a></li>
                </ul>
            </div>
        </div>
    </div>
	<!-- Add Modal HTML -->
	<div id="addActivityModal" class="modal fade">
		<div class="modal-dialog">
			<div class="modal-content">
				<form action="add-activity.php" method="POST">
					<div class="modal-header">						
						<h4 class="modal-title">Add Activity</h4>
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					</div>
					<div class="modal-body">
						<div class="form-group">
							<label>Nama Kegiatan</label>
							<input type="text" name="namakegiatan" class="form-control" required>
						</div>
						<div class="form-group">
							<label>Tanggal Mulai</label>
							<input type="date" name="tglmulai" class="form-control" required>
						</div>
						<div class="form-group">
							<label>Tanggal Selesai</label>
							<input type="date" name="tglselesai" class="form-control" required>
						</div>
						<div class="form-group">
							<label>Jenis Acara</label>
							<select name="jenis" class="form-control" required> 
  							<option value="Hiburan">Hiburan</option>
							<option value="Akademik">Akademik</option>
							<option value="Training">Training</option>
							<option value="Festival">Festival</option>
							</select>
						</div>
						<div class="form-group">
							<label>Ketua Panitia</label>
							<input type="text" name="ketua" class="form-control" required>
						</div>
						<div class="form-group">
							<label>Deskripsi Kegiatan</label>
							<textarea name="deskripsi" rows="5" class="form-control" required></textarea>
						</div>
					</div>
					<div class="modal-footer">
						<input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
						<input type="submit" class="btn btn-success" value="Add" name="addActivity">
					</div>
				</form>
			</div>
		</div>
	</div>
	<!-- Add Modal HTML -->
	<div id="addReportModal" class="modal fade">
		<div class="modal-dialog">
			<div class="modal-content">
				<form action="add-activity.php" method="POST">
					<div class="modal-header">						
						<h4 class="modal-title">Add Report</h4>
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					</div>
					<div class="modal-body">
						<div class="form-group">
							<label>Nama Kegiatan</label>
							<input type="text" name="namakegiatan" class="form-control" required>
						</div>
						<div class="form-group">
							<label>Tanggal Mulai</label>
							<input type="date" name="tglmulai" class="form-control" required>
						</div>
						<div class="form-group">
							<label>Tanggal Selesai</label>
							<input type="date" name="tglselesai" class="form-control" required>
						</div>
						<div class="form-group">
							<label>Jenis Acara</label>
							<select name="jenis" class="form-control" required> 
  							<option value="Hiburan">Hiburan</option>
							<option value="Akademik">Akademik</option>
							<option value="Training">Training</option>
							<option value="Festival">Festival</option>
							</select>
						</div>
						<div class="form-group">
							<label>Deskripsi Kegiatan</label>
							<textarea name="deskripsi" rows="5" class="form-control" required></textarea>
						</div>
						<div class="form-group">
							<label>Bukti</label><br/>
							<input type="button" class="btn btn-default" value="Upload" name="Upload">
						</div>
					</div>
					<div class="modal-footer">
						<input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
						<input type="submit" class="btn btn-success" value="Add" name="addReport">
					</div>
				</form>
			</div>
		</div>
	</div>
</body>
</html>