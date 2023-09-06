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
            $sql .=" and Event  Like '%$rdoTrangThai%' ";
        }
        $result = $conn->query($sql);
    }
    // Thực thi câu lệnh truy vấn
   
    // printf($result->num_rows);
?>
<?php
$resthucgiang=[];
if (isset($_GET["timKiem"])){
    $sqlthucgiang = "SELECT DISTINCT soTinChi FROM tbl_thoikhoabieu WHERE 1=1";
        $lophocphan=$_GET["lophocphan"];
        if(isset($_GET["lophocphan"]) && $lophocphan !=""){
            $sqlthucgiang .=" and Subject  = '$lophocphan' ";
        }
            $resthucgiang = $conn->query($sqlthucgiang);
}
?>
<div id="container">
    <form method="get">
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
                                <input type="date" id="datestart" name="datestart"
                                    value="<?php if(isset($_GET["datestart"])) echo $_GET["datestart"];?>">
                                <input type="date" id="dateend" name="dateend"
                                    value="<?php if(isset($_GET["dateend"])) echo $_GET["dateend"];?>"><br><br>
                            </div>
                        </td>

                        <td> <label>Lớp học phần <span>(*)</span></label><br>
                            <select name="lophocphan" id="lophocphan"
                                value="<?php if(isset($_GET["lophocphan"])) echo $_GET["lophocphan"];?>">
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
                                <input checked="checked" id="rdoTrangThai" name="rdoTrangThai" type="radio" value="">
                                Tất cả
                                <input id="rdoTrangThai" name="rdoTrangThai" type="radio" value="1"> Thiếu sót
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td colspan='4' style='margin-right'>
                            <button style="margin-left: 10px;" type="submit" class="btn btn-info" name="timKiem"><i
                                    aria-hidden="true" value="Xem thống kê"></i>&nbsp;Xem thống kê</button>
                            <!-- <input type="submit" value="Xem thống kê" name="confirm" class="btn btn-success" /> -->
                        <td>
                    </tr>
                </table>
                <table border="1" style=" width: 98%; text-align-last: center;">
                    <thead>
                        <tr>
                            <th>STT</th>
                            <th>Ngày chấm </th>
                            <th>Kế hoạch</th>
                            <th>Thực giảng</th>
                            <th>Thiếu sót </th>
                            <th>Lớp học </th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        $stt=0;
                        $sum = 0;
                        $sum1=0;
                        if($result){
                             // đọc từng dòng trong tập kết quả
                            while($row = $result->fetch_assoc()):
                                $stt++; 
                                $thucgiang=$row["Event"];
                                if($row["Event"]==0){
                                    $thucgiang = 0;
                                } else {
                                    $thucgiang = $row["soTiet"];
                                }
                                if($row["Event"]==0){
                                    $thieusot = $row["soTiet"];
                                } else {
                                    $thieusot = 0;
                                }
                                $sum1 += $thieusot;
                                $sum += $thucgiang;
                    ?>
                        <tr>
                            <th class="text-center"><?php echo $stt;?></th>
                            <td><?php echo $row["startDate"];?></td>
                            <td><?php echo $row["soTiet"];?></td>
                            <td> <?php echo $thucgiang;?> </td>
                            <td> <?php echo $thieusot;?> </td>
                            <td><?php echo $row["Location"];?></td>
                        </tr>
                        <?php
                        endwhile;
                    } 
                    ?>
                    </tbody>
                    <tfoot>
                        <th colspan=2>Tổng</th>
                        <th> <?php 
                        if($resthucgiang):
                            while($khoa = $resthucgiang->fetch_array()):
                               $soTiet = $khoa["soTinChi"];
                                  echo $soTiet*15;
                            endwhile; 
                            endif;
                            ?></th>
                        <th><?php echo $sum; ?></th>
                        <th><?php echo $sum1; ?></th>
                    </tfoot>
                </table>

            </div>
    </form>
</div>