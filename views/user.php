<?php 
$ID = (isset($_GET['ID']) && $_GET['ID'] != '') ? $_GET['ID'] : 0;
$usql	= "SELECT * FROM tbl_thoikhoabieu  WHERE ID = $ID";
$res 	= dbQuery($usql);
while($row = dbFetchAssoc($res)) {
	extract($row);
// 	$stat = '';
	
// 	if($status == "active") {$stat = 'success';}
// 	else if($status == "lock") {$stat = 'warning';}
// 	else if($status == "inactive") {$stat = 'warning';}
// 	else if($status == "delete") {$stat = 'danger';}
?>
<div class="col-md-9">
  <div class="box box-solid">
    <div class="box-header with-border"> <i class="fa fa-text-width"></i>
      <h3 class="box-title">Thông tin</h3>
    </div>
    <!-- /.box-header -->
    <div class="box-body">
      <dl class="dl-horizontal">
        <dt>Thông tin buổi học</dt>
        <dd><?php echo $Description; ?></dd>
        
		
		<dt>Xác nhận đã giảng dạy</dt>
        <dd><span class="label label-<?php echo $stat; ?>"><?php echo $status; ?></span></dd>
		
      </dl>
    </div>
    <!-- /.box-body -->
  </div>
  <!-- /.box -->
</div>
<?php 
}
?>
