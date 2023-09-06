
<?php 
require_once '../library/config.php';
require_once '../library/functions.php';


$ID = (isset($_GET['ID']) && $_GET['ID'] != '') ? $_GET['ID'] : 0;
$usql	= "SELECT * FROM tbl_thoikhoabieu  WHERE ID = $ID";
$res 	= dbQuery($usql);
while($row = dbFetchAssoc($res)) {
	extract($row);


?>
<form method ="POST">
<div class="col-md-9">
  <div class="box box-solid">
    <div class="box-header with-border"> <i class="fa fa-text-width"></i>
      <h3 class="box-title">Thông tin</h3>
    </div>
    <!-- /.box-header -->
    <div class="box-body">
      <dl class="dl-horizontal">
        <dt>Thông tin buổi học</dt>  <dd><?php echo $startDate; ?></dd>
        <dd><?php echo $Description; ?></dd>
        

		<dt>Xác nhận đã giảng dạy</dt>
    
   <dd> <?php
						if($Event==1)
						{
							echo"Đã giảng dạy";
						}
							else
							echo('<button type="submit" name="submit" class="btn btn-primary">Xác nhận giảng dạy</button>');
            
					?> </dd>

      </dl>
    </div>
    <!-- /.box-body -->
  </div>
  <!-- /.box -->
</div>
</form>
<?php 
}
?>
<?php
if(isset($_POST["submit"]))
    {
      $sql = "update tbl_thoikhoabieu set Event='1' where ID='$ID'";
      dbQuery($sql);
      ?>
      <script>
      location.href="?>views/?v=LTT";
      </script>
      <?php
    }
?>