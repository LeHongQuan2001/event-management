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
    $objReader ->setLoadSheetsOnly('LichImport');

    $objExcel = $objReader ->load($file);
    $sheetData = $objExcel->getActiveSheet()->toArray('null',true,true,true);

    //    print_r($sheetData);
     $highestRow = $objExcel ->setActiveSheetIndex()->getHighestRow();

    for($row=2; $row<=$highestRow; $row++){
        $Subject = $sheetData[$row]['A'];
        $startDate = $sheetData[$row]['B'];
        $startTime = $sheetData[$row]['C'];
        $endDate = $sheetData[$row]['D'];
        $endTime = $sheetData[$row]['E'];
        $Event = $sheetData[$row]['F'];
        $Description = $sheetData[$row]['G'];
        $Location = $sheetData[$row]['H'];
        $CBGD = $sheetData[$row]['I'];
        $soTiet = $sheetData[$row]['J'];
        $soTinChi = $sheetData[$row]['K'];
        $sql = "Insert into tbl_thoikhoabieu(Subject,startDate,startTime,endDate,endTime,Event,Description,Location,CBGD,soTiet,soTinChi) values('$Subject','$startDate','$startTime','$endDate','$endTime','$Event','$Description','$Location','$CBGD','$soTiet','$soTinChi')";
        dbQuery($sql);
    }
    echo("Successful");

	
}

?>

<div class="box box-primary">
  <div class="box-header with-border">
    <h3 class="box-title"><b>Thêm kế hoạch giảng dạy</b></h3>
  </div>
  <!-- /.box-header -->
  <!-- form start -->
  <form method="post" enctype="multipart/form-data">
    <input type="file" name="file">
    <!-- /.box-body -->
    <div class="box-footer">
      <button type="submit" name="btnSave" class="btn btn-primary">Submit</button>
    </div>
  </form>
</div>