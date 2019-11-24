<?php 
require_once("sessionadmin.php");
require_once("config.php");

$nim = $_SESSION["adm"];

$result = mysqli_query($con, "SELECT * FROM tb_activity WHERE deleted = 0");

?>

<html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Activity Management</title>
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
	}
	table.table td a:hover {
		color: #2196F3;
	}
    table.table td a.approve {
        color: #10c469;
    }
	table.table td a.reject {
        color: #ff5b5b;
    }
    table.table td a.delete {
        color: #62c9e8;
    }
    table.table td i {
        font-size: 19px;
    }
	table.table .avatar {
		border-radius: 50%;
		vertical-align: middle;
		margin-right: 10px;
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
</style>
<script type="text/javascript">
$(document).ready(function(){
	$('[data-toggle="tooltip"]').tooltip();
});
</script>
</head>
<body>
    <div class="container">
        <div class="table-wrapper">
            <div class="table-title">
                <div class="row">
                    <div class="col-sm-5">
						<h2>Student Activity <b>Management</b></h2>
                    </div>
                    <div class="col-sm-6">
                        <a href="logoutadmin.php" class="btn btn-danger"><i class="material-icons">&#xE15C;</i> <span>Log out</span></a>
						<a href="report-management.php" class="btn btn-success"><i class="material-icons">&#xE147;</i> <span>Report Section</span></a>
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
						<th>Action</th>
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
                            <a href="#" class="approve" data-toggle="modal" data-target="#approveActivityModal<?php echo $row['id_activity'];?>"><i class="material-icons" data-toggle="tooltip" title="Approve">&#xe5ca;</i></a>
							<a href="#" class="reject" data-toggle="modal" data-target="#rejectActivityModal<?php echo $row['id_activity'];?>"><i class="material-icons" data-toggle="tooltip" title="Reject">&#xe14c;</i></a>
							<a href="#" class="delete" data-toggle="modal" data-target="#deleteActivityModal<?php echo $row['id_activity'];?>"><i class="material-icons" data-toggle="tooltip" title="Delete">&#xe872;</i></a>
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

				if(isset($_POST['approveActivity'.$row['id_activity']])){
					
				$idact = $row['id_activity'];

				$appr = mysqli_query($con, "UPDATE tb_activity SET status='2' WHERE id_activity='$idact'");

				echo("<meta http-equiv='refresh' content='1'>");
				}
				?>
				<!-- Approve Modal HTML -->
				<div id="approveActivityModal<?php echo $row['id_activity'];?>" class="modal fade">
					<div class="modal-dialog">
						<div class="modal-content">
							<form action="" method="POST">
								<div class="modal-header">						
									<h4 class="modal-title">Approve Activity</h4>
									<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
								</div>
								<div class="modal-body">					
									<p>Are you sure you want to approve this activity?</p>
									<p class="text-warning"><small>This action cannot be undone.</small></p>
								</div>
								<div class="modal-footer">
									<input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
									<input type="submit" class="btn btn-success" value="Approve" name="approveActivity<?php echo $row['id_activity'];?>">
								</div>
							</form>
						</div>
					</div>
				</div>
				<?php
				include_once("config.php");

				if(isset($_POST['rejectActivity'.$row['id_activity']])){
					
				$idact = $row['id_activity'];

				$reje = mysqli_query($con, "UPDATE tb_activity SET status='0' WHERE id_activity='$idact'");

				echo("<meta http-equiv='refresh' content='1'>");
				}
				?>
				<!-- Reject Modal HTML -->
				<div id="rejectActivityModal<?php echo $row['id_activity'];?>" class="modal fade">
					<div class="modal-dialog">
						<div class="modal-content">
							<form action="" method="POST">
								<div class="modal-header">						
									<h4 class="modal-title">Reject Activity</h4>
									<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
								</div>
								<div class="modal-body">					
									<p>Are you sure you want to reject this activity?</p>
									<p class="text-warning"><small>This action cannot be undone.</small></p>
								</div>
								<div class="modal-footer">
									<input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
									<input type="submit" class="btn btn-danger" value="Reject" name="rejectActivity<?php echo $row['id_activity'];?>">
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
                </tbody>
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
</body>
</html>                                		                            