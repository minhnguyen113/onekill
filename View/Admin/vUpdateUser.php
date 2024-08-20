<?php

include_once("Controller/cManagement.php");
include_once("Controller/cStatistic.php");
$sta = new ControlStatistic();
$p = new controlManagement();
$list_user = $p->getAllRole();

$idTaiKhoan = $_GET['idTaiKhoan'];
$user  = $p->getUserById($idTaiKhoan);
$diff = $p->getUsersDiffByIdTaiKhoan($idTaiKhoan);

if (isset($_REQUEST["btn_file"])) {
    $error = array();
    foreach ($diff  as $item) {
        if ($_REQUEST["email"] == $item['email']) {
            $error['email'] = 'Email đã tồn tại !';
        }
        if (empty($_REQUEST['manv'])) {
            $error['empty']['manv'] = 'Chưa nhập mã nhân viên *';
        }
        if (empty($_REQUEST['username'])) {
            $error['empty']['username'] = 'Chưa nhập tên đăng nhập *';
        }
        if (empty($_REQUEST['hoten'])) {
            $error['empty']['hoten'] = 'Chưa nhập họ tên *';
        }
        if (empty($_REQUEST['sodt'])) {
            $error['empty']['sodt'] = 'Chưa nhập số điện thoại *';
        }
        if (empty($_REQUEST['email'])) {
            $error['empty']['email'] = 'Chưa nhập email *';
        }
        if (empty($_REQUEST['management'])) {
            $error['empty']['management'] = 'Chưa chọn chức vụ *';
        }
        if ($_REQUEST["manv"] == $item['maNhanVien']) {
            $error['maNhanVien'] = 'Mã nhân viên đã tồn tại !';
        }
        if ($_REQUEST["username"] == $item['tenDangNhap']) {
            $error['username'] = 'tên đăng nhập đã tồn tại !';
        }
        if ($_REQUEST["sodt"] == $item['soDienThoai']) {
            $error['sodt'] = 'Số điện thoại đã tồn tại !';
        }
    }
}

?>

<div class="container-fluid px-4 add mt-3">
    <div class="upload p-3" style="position: relative;">
        <h3 class="mb-5">Sửa người dùng</h3>


        <table class="admin_upload">
            <form action="" enctype="multipart/form-data" method="post">
                <tr>
                    <th>Mã nhân viên:</th>
                    <th><input type="text" name="manv" id="manv" placeholder="Nhập mã nhân viên" value="<?php echo $user['maNhanVien'] ?>">
                        <p class="text-danger"><?php if (!empty($error['maNhanVien'])) {
                                                    echo  $error['maNhanVien'];
                                                } elseif (!empty($error['empty']['manv'])) {
                                                    echo  $error['empty']['manv'];
                                                }   ?></p>
                    </th>
                    </th>
                </tr>
                <tr>
                    <th>Mật khẩu:</th>
                    <th><input type="password" id="password" name="password" placeholder="nhập mật khẩu" value="<?php echo $user['matKhau'] ?>">

                    </th>
                </tr>

                <tr>
                    <th>Tên đăng nhập:</th>
                    <th><input type="text" name="username" id="username" placeholder="Nhập tên đăng nhập" value="<?php echo $user['tenDangNhap'] ?>">
                        <p class="text-danger"><?php if (!empty($error['username'])) {
                                                    echo  $error['username'];
                                                } elseif (!empty($error['empty']['username'])) {
                                                    echo  $error['empty']['username'];
                                                }    ?></p>
                    </th>
                </tr>
                <tr>
                    <th>Họ tên:</th>
                    <th><input type="text" name="hoten" placeholder="Nhập họ tên" value="<?php echo $user['hoTen'] ?>">
                        <p class="text-danger"><?php if (!empty($error['empty']['hoten'])) {
                                                    echo  $error['empty']['hoten'];
                                                }    ?></p>
                    </th>
                </tr>
                <tr>
                <tr>
                    <th>Số điện thoại:</th>
                    <th><input type="number" name="sodt" placeholder="Nhập số điện thoại" value="<?php echo $user['soDienThoai'] ?>">
                        <p class="text-danger"><?php if (!empty($error['sodt'])) {
                                                    echo  $error['sodt'];
                                                } elseif (!empty($error['empty']['sodt'])) {
                                                    echo  $error['empty']['sodt'];
                                                }   ?></p>
                    </th>
                </tr>
                <tr>
                    <th>Email:</th>
                    <th><input type="text" name="email" placeholder="Nhập email" value="<?php echo $user['email'] ?>">
                        <p class="text-danger"><?php if (!empty($error['email'])) {
                                                    echo  $error['email'];
                                                } elseif (!empty($error['empty']['email'])) {
                                                    echo  $error['empty']['email'];
                                                }   ?></p>
                    </th>
                </tr>
                <tr>
                    <th>Thêm ảnh:</th>
                    <th>
                        <input type="file" name="upfile" id="">

                    </th>
                </tr>
                <tr>
                    <th>Chọn chức vụ:</th>
                    <th>
                        <?php foreach ($list_user as $title_item) {

                            if ($user['Role'] == $title_item['idRole']) { ?>
                                <input checked type="radio" id="" name="management" value="<?php echo $title_item['idRole'] ?>">
                                <label for="age1"><?php echo $title_item['tenRole'] ?></label>
                                <span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>


                            <?php } else {
                            ?><input type="radio" id="" name="management" value="<?php echo $title_item['idRole'] ?>">
                                <label for="age1"><?php echo $title_item['tenRole'] ?></label>
                                <span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
                        <?php }
                        } ?>
                        <p class="text-danger"><?php if (!empty($error['empty']['management'])) {
                                                    echo  $error['empty']['management'];
                                                }    ?></p>
                    </th>
                </tr>
                <tr>

                    <td>
                        <input type="hidden" name="hinhAnh" value="<?php echo $user['hinhAnh'] ?>">

                    </td>
                    <td>
                        <input type="submit" value="Cập nhật" id="submit" name="btn_file">
                        <input type="reset" value="Hủy" id="reset" name="btn_file">


                    </td>
                </tr>
            </form>
        </table>
    </div>
</div>

</body>

</html>
<?php


if (isset($_REQUEST["btn_file"])) {
    if (empty($error)) {

    $maNhanVien = $_REQUEST["manv"];
    $matKhau = $_REQUEST["password"];
    $tenDangNhap = $_REQUEST["username"];
    $hoTen = $_REQUEST["hoten"];
    $soDienThoai = $_REQUEST["sodt"];
    $email = $_REQUEST["email"];
    $Role = $_REQUEST["management"];
    $hinhAnh = $_REQUEST['hinhAnh'];




    $p = new controlManagement();

    $kq = $p->UpdateUser($idTaiKhoan, $matKhau, $maNhanVien, $hoTen, $soDienThoai, $email, $hinhAnh, $Role, $tmpimg = '', $typeimg = '', $sizeimg = '');

    if ($kq == 1) {
        $noiDung = "Bạn vừa chỉnh sửa người dùng có tên: $hoTen, mã nhân viên: $maNhanVien";
        $thoiGian =  date('Y-m-d H:i:s');
        $idTaiKhoan = $_SESSION['is_login']['idTaiKhoan'];

        $sta->InsertThongBao($noiDung, $thoiGian, $idTaiKhoan);
        echo '<script>alert("Sửa nhân viên thành công")</script>';
        if ($_GET['po'] == 'Kitchen') {
            echo header("refresh:0; url='admin.php?mod=KitchenManager");
        } else {
            echo header("refresh:0; url='admin.php?mod=CustomerManagement'");
        }
    } elseif ($kq == 0) {
        echo '<script>alert("Không thể sửa nhân viên")</script>';
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
?>