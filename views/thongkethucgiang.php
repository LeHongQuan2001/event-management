<?php 
require_once '../library/config.php';
require_once '../api/process.php';
require_once '../library/functions.php';
    // sử dụng hàm kết nối csdl mysqli
    $conn = new mysqli("localhost","root","","db_event_management");
$records=getlopid();

?>
<?php

   $result=[];
    if(isset($_GET["timKiem"])){
        $sql = "SELECT * FROM tbl_thoikhoabieu WHERE 1=1 ";
         $datestart=$_GET["datestart"];
        $dateend=$_GET["dateend"];
        if(isset($_GET["datestart"])||isset($_GET["dateend"]) && $datestart !="" && $dateend !=""){
            $sql .=" and startDate BETWEEN '$datestart' AND '$dateend'";
        }
        $lophocphan=$_GET["lophocphan"];
        if(isset($_GET["lophocphan"]) && $lophocphan !=""){
            $sql .=" and Subject='$lophocphan' ";
        }
        $rdoTrangThai=$_GET["rdoTrangThai"];
        if(isset($_GET["rdoTrangThai"]) && $rdoTrangThai !=""){
            $sql .=" and Event  = '$rdoTrangThai' ";
        }
        $result = $conn->query($sql);
    }
    // Thực thi câu lệnh truy vấn
   
    // printf($result->num_rows);
?>
<div id="container">
    <form method="get" action="<?php echo WEB_ROOT; ?>views/?v=TKTG">
        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title">Danh sách lớp học</h3>

            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <table class="table table-bordered">
                    <tr>
                        <td>
                            <div>
                                <label>Thời gian <span>(*)</span></label><br>
                                <input type="date" id="datestart" name="datestart" value="<?php if(isset($_GET["datestart"])) echo $_GET["datestart"];?>">
                                <input type="date" id="dateend" name="dateend" value="<?php if(isset($_GET["dateend"])) echo $_GET["dateend"];?>"><br><br>
                            </div>
                        </td>

                        <td> <label>Lớp học phần <span>(*)</span></label><br>
                            <select name="lophocphan" id="lophocphan" value="<?php if(isset($_GET["lophocphan"])) echo $_GET["lophocphan"];?>">
                                <option>Chọn</option>
                                <?php 
                        foreach ($records as $rec) {
                            extract($rec);
                            ?>
                                <option><?php echo $lsubject; ?> </option>
                                <?php 
                                }
                            ?>
                            </select>
                        </td>
                        <td>
                            <div>
                                <label>Trạng thái</label><br>
                                <input checked="checked" id="rdoTrangThai" name="rdoTrangThai" type="radio" value="0">
                                Tất cả
                                <input id="rdoTrangThai" name="rdoTrangThai" type="radio" value="1"> Thiếu sót
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td colspan='4' style='margin-right'>

                            <button style="margin-left: 10px;" type="submit" class="btn btn-info"  name="timKiem" value="Xem thống kê"><i aria-hidden="true"></i>&nbsp;Xem thống kê</button>
                            <!-- <input type="submit" value="Xem thống kê" name="confirm" class="btn btn-success" /> -->

                        <td>
                    </tr>
                </table>
                <table border="1" style=" width: 98%; text-align-last: center;">
                    <thead>
                        <tr>
                            <th>STT</th>
                            <th>Ngày chấm </th>
                            <th>Thực giảng</th>
                            <th>Lớp học </th>
                        </tr>
                    </thead>
                    <tbody>
                        <td id="txtstt"> </td>
                        <td id="txtngaycham"> </td>
                        <td id="txtthucgiang"> </td>
                        <td id="txtlophoc"> </td>
                        <?php 
                        $stt=0;
                        if($result){
                             // đọc từng dòng trong tập kết quả
                            while($row = $result->fetch_assoc()):
                                $stt++; 
                    ?>
                        <tr>
                            <th class="text-center"><?php echo $stt;?></th>
                            <td><?php echo $row["startDate"];?></td>
                            <td><?php echo $row["soTiet"];?></td>
                            <td><?php echo $row["Location"];?></td>
                        </tr>
                        <?php
                        endwhile;
                    }
                    ?>
                    </tbody>
                </table>

            </div>
            <!-- /.box-body -->

    </form>



</div>



<!-- /.box -->