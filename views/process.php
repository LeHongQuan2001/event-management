<?php 

require_once '../library/config.php';
require_once '../library/functions.php';
require_once '../library/mail.php';
require '../Classes/PHPExcel.php';

$cmd = isset($_GET['cmd']) ? $_GET['cmd'] : '';

switch($cmd) {
	
	case 'create':
		createUser();
	break;
	case 'createClass':
		createClass();
	break;
	case 'createHocKy':
		createHocKy();
	break;
	case 'createHocPhan':
		createHocPhan();
	break;
	case 'change':
		changeStatus();
	break;
	case 'createkh':
		createkehoach();
	break;	
	
	default :
	break;
}

function createUser() {
	$name 		= $_POST['name'];
	$idname = $_POST['idname'];
	$fullname=$_POST['fullname'];
	$address 	= $_POST['address'];
	$phone 		= $_POST['phone'];
	$email 		= $_POST['email'];
	$type		= $_POST['type'];
	
	//TODO first check if that date has a holiday
	$hsql	= "SELECT * FROM tbl_users WHERE name = '$name'";
	$hresult = dbQuery($hsql);
	if (dbNumRows($hresult) > 0) {
		$errorMessage = 'User with same name already exist. Please try another day.';
		header('Location: ../views/?v=CREATE&err=' . urlencode($errorMessage));
		exit();
	}
	$pwd = random_string();
	$sql = "INSERT INTO tbl_users (name, idName, pwd, address, phone, email, type, status, bdate, fullName)
			VALUES ('$name','$idname', '$pwd', '$address', '$phone', '$email', '$type', 'active', NOW(), '$fullname')";	
	dbQuery($sql);
	
	//send email on registration confirmation
	$bodymsg = "User $name booked the date slot on $bkdate. Requesting you to please take further action on user booking.<br/>Mbr/>Tousif Khan";
	$data = array('to' => '$email', 'sub' => 'Booking on $rdate.', 'msg' => $bodymsg);
	//send_email($data);
	header('Location: ../views/?v=USERS&msg=' . urlencode('User successfully registered.'));
	exit();
}

function createClass() {
	$idMaLop		= $_POST['idMaLop'];
	$tenLop 	= $_POST['tenLop'];
	
	//TODO first check if that date has a holiday
	$hsql	= "SELECT * FROM lop WHERE tenLop = '$tenLop'";
	$hresult = dbQuery($hsql);
	if (dbNumRows($hresult) > 0) {
		$errorMessage = 'User with same name already exist. Please try another day.';
		header('Location: ../views/?v=CREATECLASS&err=' . urlencode($errorMessage));
		exit();
	}
	$pwd = random_string();
	$sql = "INSERT INTO lop (idMaLop, tenLop)
			VALUES ('$idMaLop', '$tenLop')";	
	dbQuery($sql);
	$bodymsg = "Class $tenLop booked the date slot on. Requesting you to please take further action on user booking.<br/>Mbr/>Tousif Khan";
	$data = array('to' => '$email', 'sub' => 'Booking on $rdate.', 'msg' => $bodymsg);
	header('Location: ../views/?v=CLASS&msg=' . urlencode('User successfully registered.'));
	exit();
	
}

function createHocKy() {
	$maHocKy		= $_POST['maHocKy'];
	$tenHocKy 	= $_POST['tenHocKy'];
	
	//TODO first check if that date has a holiday
	$hsql	= "SELECT * FROM hocky WHERE tenHocKy = '$tenHocKy'";
	$hresult = dbQuery($hsql);
	if (dbNumRows($hresult) > 0) {
		$errorMessage = 'User with same name already exist. Please try another day.';
		header('Location: ../views/?v=CREATEHOCKY&err=' . urlencode($errorMessage));
		exit();
	}
	$pwd = random_string();
	$sql = "INSERT INTO hocky (maHocKy,tenHocKy)
			VALUES ('$maHocKy', '$tenHocKy')";	
	dbQuery($sql);
	$bodymsg = "Class $tenHocKy booked the date slot on. Requesting you to please take further action on user booking.<br/>Mbr/>Tousif Khan";
	$data = array('to' => '$email', 'sub' => 'Booking on $rdate.', 'msg' => $bodymsg);
	header('Location: ../views/?v=HOCKY&msg=' . urlencode('User successfully registered.'));
	exit();
}

function createHocPhan() {
	$maHocPhan		= $_POST['maHocPhan'];
	$tenHocPhan 	= $_POST['tenHocPhan'];
	$soTinChi       = $_POST['soTinChi'];
	$tenGiangVien 	= $_POST['tenGiangVien'];
	
	//TODO first check if that date has a holiday
	$hsql	= "SELECT * FROM hocphan WHERE tenHocPhan = '$tenHocPhan'";
	$hresult = dbQuery($hsql);
	if (dbNumRows($hresult) > 0) {
		$errorMessage = 'User with same name already exist. Please try another day.';
		header('Location: ../views/?v=CREATEHOCPHAN&err=' . urlencode($errorMessage));
		exit();
	}
	$pwd = random_string();
	$sql = "INSERT INTO hocphan (maHocPhan,tenHocPhan,soTinChi,tenGiangVien)
			VALUES ('$maHocPhan', '$tenHocPhan', '$soTinChi','$tenGiangVien')";	
	dbQuery($sql);
	$bodymsg = "Học phần $tenHocPhan booked the date slot on. Requesting you to please take further action on user booking.<br/>Mbr/>Tousif Khan";
	$data = array('to' => '$email', 'sub' => 'Booking on $rdate.', 'msg' => $bodymsg);
	header('Location: ../views/?v=HOCPHAN&msg=' . urlencode('User successfully registered.'));
	exit();
	
}

//http://localhost/houda/views/process.php?cmd=change&action=inactive&userId=1
function changeStatus() {
	$action 	= $_GET['action'];
	$userId 	= (int)$_GET['userId'];
	
	
	$sql = "UPDATE tbl_users SET status = '$action' WHERE id = $userId";	
	dbQuery($sql);
	
	//send email on registration confirmation
	$bodymsg = "User $name booked the date slot on $bkdate. Requesting you to please take further action on user booking.<br/>Mbr/>Tousif Khan";
	$data = array('to' => '$email', 'sub' => 'Booking on $rdate.', 'msg' => $bodymsg);
	//send_email($data);
	header('Location: ../views/?v=USERS&msg=' . urlencode('User status successfully updated.'));
	exit();
}

function createkehoach() {
	$khoa 		= $_POST['khoa'];
	$hocky		= $_POST['hocky'];
	$lop 		= $_POST['lop'];
	$mon 		= $_POST['mon'];
	

	$sql = "INSERT INTO tbl_kehoach (Khoa,HocKy,Lop,TenMon) VALUES ('$khoa', '$hocky', '$lop', '$mon');";
	dbQuery($sql);

	header('Location: ../index.php?msg=' . urlencode('successfully'));
	exit();


}
?>