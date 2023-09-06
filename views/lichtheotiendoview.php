<?php 
// require_once '../library/functions.php';
$records = getlichtheotiendo();
?>
<form method="post" enctype="multipart/form-data">
<div class="box">
  <div class="box-header with-border">
    <h3 class="box-title">Lịch theo tiến độ</h3>
    <input type="file" name="file"> <button type="submit" name="btnSave">Import</button>
  </div>
  <!-- /.box-header -->
  <div class="box-body">
    <table class="table table-bordered">
      <tr>
        <th style="width: 10px">#</th>
        <th>Mã môn học </th>
        <th>Tên môn học</th>
        <th>Số tín chỉ </th>
        <th>Mã lớp </th>
        <th>Thứ </th>
        <th>Tiết bắt đầu </th>
        <th>Số tiết </th>
        <th>Phòng học</th>
        <th>Tuần </th>
      </tr>
      <?php
	  $idx = 1;
	  foreach($records as $rec) {
	  	extract($rec);
	  ?>
      <tr>
        <td><?php echo $idx++; ?></td>
        <td><?php echo $maMH; ?></td>
        <td><?php echo $tenMH; ?></a></td>
        <td><?php echo $soTinChi ; ?></td>
        <td><?php echo $maLop ; ?></td>
        <td><?php echo $thu ; ?></td>
        <td><?php echo $tietBD ; ?></td>
        <td><?php echo $soTiet ; ?></td>
        <td><?php echo $phong ; ?></td>
        <td><?php echo $tuan ; ?></td>

         </tr>
      <?php } ?>
    </table>
    
  </div>
  </form>
  <?PHP
require_once '../library/config.php';
require_once '../library/functions.php';
require_once '../library/mail.php';
require_once '../Classes/PHPExcel.php';

if(isset($_POST['btnSave'])){
    $file = $_FILES['file']['tmp_name'];
	
	$objReader = PHPExcel_IOFactory::createReaderForFile($file);
   // $listWorkSheets = $objReader->listWorkSheetNames($file);
    // foreach($listWorkSheets as $name){
    //     $sql = "insert into lop(name) values('$name')";
    //     $mysqli->query($sql);
    //     $id_lop = $mysqli->insert_id;

    //     $objReader = $setLoadSheetsOnly($name);
    // }
    $objReader ->setLoadSheetsOnly('ThoiKhoaBieu');

    $objExcel = $objReader ->load($file);
    $sheetData = $objExcel->getActiveSheet()->toArray('null',true,true,true);

    // print_r($sheetData);
    // die();

    //    print_r($sheetData);
     $highestRow = $objExcel ->setActiveSheetIndex()->getHighestRow();

    for($row=2; $row<=$highestRow; $row++){
        $maMH = $sheetData[$row]['A'];
        $tenMH = $sheetData[$row]['B'];
        $soTinChi = $sheetData[$row]['D'];
        $maLop = $sheetData[$row]['E'];
        $soTCHP = $sheetData[$row]['F'];
        $thu = $sheetData[$row]['I'];
        $tietBD = $sheetData[$row]['J'];
        $soTiet = $sheetData[$row]['K'];
        $phong = $sheetData[$row]['L'];
        $CBGD = $sheetData[$row]['M'];
        $tuan = $sheetData[$row]['N'];
        $sql = "Insert into tbl_lichtheotiendo(maMH,tenMH,soTinChi,maLop,soTCHP,thu,tietBD,soTiet,phong,CBGD,tuan) values('$maMH','$tenMH','$soTinChi','$maLop','$soTCHP','$thu','$tietBD','$soTiet','$phong','$CBGD','$tuan')";
        dbQuery($sql);
    }
    echo("Successful");
}

?>
  
