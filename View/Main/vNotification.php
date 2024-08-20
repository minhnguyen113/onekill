<?php
include_once("Controller/cStatistic.php");
$sta = new ControlStatistic();
$idTaiKhoan = $_SESSION['is_login']['idTaiKhoan'];

$thongbao =  $sta->getThongBao($trangThaiXem = '', $idTaiKhoan);


?>
<div class="container">
    <div style="width: 60%; background-color: #Fff; margin: auto; margin-top: 100px; padding: 10px; box-shadow: 1px 2px 3px #000; border-radius: 10px;">
        <h3 class="m-3" ><b>Thông báo</b></h3>

        <?php 
        if(!empty($thongbao)){
        foreach($thongbao as $item){ ?>
        <div style="display: flex; align-items: center; border-bottom: 1px solid #ccc; ">
        <i style="font-size: 30px;" class="bi bi-check-circle text-success"></i>
        <span  class="m-3"><?php echo $item['noiDung'] ?>.</span>
            
         </div>

      <?php }} else { ?>

      <h3 class="text-danger text-center">Không có thông báo nào</h3>
    <?php  } ?>
        

    </div>
</div>