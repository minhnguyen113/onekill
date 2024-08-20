<?php
include_once("Controller/cOrder.php");
include_once("Controller/cManagement.php");
$p = new controlOrder();
$us = new controlManagement();

$list = $p->getSumOrder();

$user = $us->SelectUsers();

$listNoPay = $p->SelectOrderNoPay();

?>
<style>
    .checkboxThree {
        width: 60px;
        height: 20px;
        background: #333;
        margin: 20px 60px;
        border-radius: 50px;
        position: relative;
    }

    .checkboxThree:before {
        content: 'Unpaid';
        position: absolute;
        top: 0px;
        left: -50px;
        height: 2px;
        color: red;
        font-size: 12px;
        font-weight: 700;
    }

    .checkboxThree:after {
        content: 'Pay';
        position: absolute;
        top: 0px;
        right: -30px;
        height: 2px;
        color: green;
        font-size: 12px;
        font-weight: 700;

    }

    .checkboxThree label {
        display: block;
        width: 22px;
        height: 19px;
        border-radius: 50px;
        -webkit-transition: all .5s ease;
        -moz-transition: all .5s ease;
        -o-transition: all .5s ease;
        -ms-transition: all .5s ease;
        transition: all .5s ease;
        cursor: pointer;
        position: absolute;
        top: 9px;
        z-index: 1;
        left: 0px;
        background: red;
        top: 0px;
    }  .checkboxThree input[type=checkbox] {
         position: absolute;
         right: -20px;
         opacity: 0;
       
    }

    .checkboxThree input[type=checkbox]:checked+label {
        left: 36px;
        background: #26ca28;
    }
</style>
<main id="main" class="main">

    <div class="pagetitle">

        <h1>Thanh toán tại bếp</h1>

        <nav>
            <ol class="breadcrumb">

                <li class="breadcrumb-item">thanh toán</li>

            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section">
  

        <div class="row">
            <div class="col-lg-12">

                <div class="card">
                    <div class="card-body">
                        <form action="admin.php?mod=PayKitchenSuccess" method="post" onsubmit="return validateForm()">
                            <table class="table datatable">
                                <thead>
                                    <tr>
                                        <th scope="col">STT</th>
                                        <th scope="col">Mã nhân viên</th>
                                        <th scope="col">Họ tên</th>
                                        <th scope="col">Điện thoại</th>
                                        <th scope="col">Email</th>
                                        <th scope="col">Số Tiền cần trả</th>
                                        <th scope="col">Thanh toán</th>




                                    </tr>
                                </thead>
                                <tbody>
                                    <?php

                                    $i = 1;
                                    if (!empty($list)) {
                                        foreach ($list as $order) {

                                    ?>
                                            <tr>
                                                <input style="display: none;" type="number" name="taiKhoan<?php echo $order['idTaiKhoan'] ?>" value="<?php echo $order['idTaiKhoan'] ?>">
                                                <input style="display: none;" type="number" name="tongTien<?php echo $order['idTaiKhoan'] ?>" value="<?php echo $order['TongTien'] ?>">
                                              
                                                <th scope="row"><?php echo $i++; ?></th>
                                                <td><?php echo $order['maNhanVien']; ?></td>
                                                <td><?php echo $order['hoTen']; ?></td>
                                                <td><?php echo $order['soDienThoai']; ?></td>
                                                <td><?php echo $order['email']; ?></td>
                                                
                                                <td><?php echo currency_format($order['TongTien']); ?></td>
                                                <td>
                                                    <div class="checkboxThree">
                                                     
                                                        <input style="width: 100px; margin-top: 5px;" type="checkbox" id="checkboxThreeInput" name="<?php echo $order['idTaiKhoan'] ?>">
                                                        <label for="checkboxThreeInput"></label>

                                                    </div>
                                                </td>


                                            </tr>
                                    <?php
                                        }
                                    }
                                    ?>

                                </tbody>
                            </table>

                            <input class="btn btn-success" type="submit" value="Thanh toán" name="thanhtoan">
                            <a style="float: right;" href="admin.php?mod=ListInvoiceKitchen" class="btn btn-primary m-3"><b><i style="font-size: 30px;" class="bi bi-printer m-1"></i>In hóa đơn</b></a>
                        </form>
                        
                    </div>
                </div>


            </div>
        </div>
    </section>

</main>

<script>
    function validateForm() {
      // Lấy tất cả các checkbox
      var checkboxes = document.querySelectorAll('input[type="checkbox"]');
      
      // Kiểm tra xem có checkbox nào chưa được chọn không
      var isChecked = Array.from(checkboxes).some(function(checkbox) {
        return checkbox.checked;
      });

      // Nếu có checkbox chưa được chọn, hiển thị thông báo và ngăn chặn submit
      if (!isChecked) {
        alert("Vui lòng chọn ít nhất một người để thanh toán phí ăn !");
        return false;
      }

      // Cho phép submit nếu tất cả các checkbox đều đã được chọn
      return true;
    }
  </script>