<?php
include_once("Controller/cDish.php");
include_once("Controller/cStatistic.php");
$sta = new ControlStatistic();

$p = new controlDish();

$listNguyenLieu = $p->getAllNguyenLieu();


if (isset($_REQUEST["btn_addIngreIdient"])) {
    $error = array();
    foreach ($listNguyenLieu  as $item) {
        if (strcasecmp(trim($_REQUEST["tenNguyenLieu"]), trim($item['tenNguyenLieu'])) == 0) {
            $error['tenNguyenLieu'] = 'Nguyên liệu đã tồn tại !';
        }
        if (empty($_REQUEST['tenNguyenLieu'])) {
            $error['empty']['tenNguyenLieu'] = 'Chưa nhập nguyên liệu *';
        }
    }
}
?>

<div class="container-fluid px-4 add">
    <div class="upload">
        <h2 class="mt-4 m-3">Thêm nguyên liệu mới</h2>
        <form action="" enctype="multipart/form-data" method="post">
            <table class="admin_upload">

                <tr>
                    <th>Tên nguyên liệu:</th>
                    <th><input type="text" name="tenNguyenLieu" placeholder="Nhập tên nguyên liệu">
                        <p class="text-danger"><?php if (!empty($error['tenNguyenLieu'])) {
                                                    echo   $error['tenNguyenLieu'];
                                                } elseif (!empty($error['empty']['tenNguyenLieu'])) {
                                                    echo   $error['empty']['tenNguyenLieu'];
                                                } ?></p>
                    </th>
                </tr>

                <tr>
                    <th>Ảnh nguyên liệu:</th>
                    <th><input type="file" name="upfile" id=""></th>
                </tr>
                <tr>

                    <td>

                    </td>
                    <td>
                        <input type="submit" value="Thêm" id="submit" name="btn_addIngreIdient">
                        <input type="reset" value="Hủy" id="reset" name="btn_file">


                    </td>
                </tr>


            </table>
        </form>
    </div>
</div>

</body>

</html>

<?php

if (isset($_POST['btn_addIngreIdient'])) {
    if (empty($error)) {

        $tenNguyenLieu = $_POST['tenNguyenLieu'];
        $hinhAnh = $_FILES["upfile"]["name"];
        $tmpimg = $_FILES["upfile"]["tmp_name"];
        $typeimg = $_FILES["upfile"]["type"];
        $sizeimg = $_FILES["upfile"]["size"];
        $ngayTao = Date("Y-m-d H:i:s");

        $kq = $p->InsertIngerdienthNew($tenNguyenLieu, $hinhAnh, $ngayTao, $typeimg, $tmpimg, $sizeimg);
        if ($kq == 1) {
            $noiDung = "Bạn đã thêm nguyên liệu";
            $thoiGian =  date('Y-m-d H:i:s');
            $idTaiKhoan = $_SESSION['is_login']['idTaiKhoan'];
            $sta->InsertThongBao($noiDung, $thoiGian, $idTaiKhoan);
            echo '<script>alert("Thêm nguyên liệu thành công")</script>';
        } elseif ($kq == 0) {
            echo '<script>alert("Không thể thêm nguyên liệu")</script>';
        } elseif ($kq == -1) {
            echo '<script>alert("Không thể Upload ảnh")</script>';
        } elseif ($kq == -2) {
            echo '<script>alert("Kích thước size phải nhỏ hơn 10MB")</script>';
        } elseif ($kq == -3) {
            echo '<script>alert("File thêm dữ liệu phải là file ảnh")</script>';
        } else {
            echo "Lỗi";
        }
    }
}
