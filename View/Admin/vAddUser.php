<?php

include_once("Controller/cManagement.php");
include_once("Controller/cStatistic.php");
$sta = new ControlStatistic();
$p = new controlManagement();

$list_user = $p->getAllRole();


$taiKhoan  = $p->SelectUsers();

if (isset($_REQUEST["btn_file"])) {
    $error = array();
    foreach ($taiKhoan as $item) {
        if ($_REQUEST["manv"] == $item['maNhanVien']) {
            $error['maNhanVien'] = 'Mã nhân viên đã tồn tại !';
        }
        if ($_REQUEST["username"] == $item['tenDangNhap']) {
            $error['username'] = 'tên đăng nhập đã tồn tại !';
        }
        if ($_REQUEST["sodt"] == $item['soDienThoai']) {
            $error['sodt'] = 'Số điện thoại đã tồn tại !';
        }
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
    }
}



?>

<div class="container-fluid px-4 add mt-3">
    <div class="upload p-3" style="position: relative;">
        <h3 class="mb-5">Thêm người dùng</h3>
    

        <button style="position: absolute; right: 10px; top:40px;" type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#myModal">
            <i class="bi bi-file-earmark-spreadsheet"></i>
            Thêm nhiều người dùng
        </button>


        <!-- The Modal -->
        <div class="modal fade" id="myModal">
            <div class="modal-dialog">
                <div class="modal-content">

                    <!-- Modal Header -->
                    <div class="modal-header">
                        <h4 class="modal-title">Thêm nhiều người dùng</h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>

                    <!-- Modal body -->
                    <div class="modal-body">


                        <form action="" enctype="multipart/form-data" method="post">
                            <div class="form-group m-1">
                                <label for="file">Chọn file Excel:</label>
                                <input type="file" class="form-control" id="file" name="file" required>
                            </div>
                            <button type="submit" class="btn btn-success m-1" name="btn_gui">Thêm</button>
                        </form>

                    </div>

                    <!-- Modal footer -->
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                    </div>

                </div>
            </div>
        </div>
        <table class="admin_upload">
            <form action="" enctype="multipart/form-data" method="post">
                <tr>
                    <th>Mã nhân viên:</th>
                    <th><input type="text" name="manv" id="manv" placeholder="Nhập mã nhân viên" value="<?php if (isset($_REQUEST["manv"])) {
                                                                                                            echo $_REQUEST["manv"];
                                                                                                        } ?>" oninput="validateManv()">
                        <p class="text-danger" id="manvError"><?php if (!empty($error['maNhanVien'])) {
                                                                    echo  $error['maNhanVien'];
                                                                } elseif (!empty($error['empty']['manv'])) {
                                                                    echo  $error['empty']['manv'];
                                                                }   ?></p>
                    </th>
                </tr>
                <tr>
                    <th>Mật khẩu:</th>
                    <th><input type="password" id="password" name="password" placeholder="nhập mật khẩu" value="123456" oninput="validatePassword()">
                        <p class="text-danger" id="passwordError"></p>

                    </th>
                </tr>

                <tr>
                    <th>Tên đăng nhập:</th>
                    <th><input type="text" name="username" id="username" placeholder="Nhập tên đăng nhập" value="<?php if (isset($_REQUEST["username"])) {
                                                                                                                        echo $_REQUEST["username"];
                                                                                                                    } ?>" oninput="validateUsername()">
                        <p class="text-danger" id="usernameError"><?php if (!empty($error['username'])) {
                                                                        echo  $error['username'];
                                                                    } elseif (!empty($error['empty']['username'])) {
                                                                        echo  $error['empty']['username'];
                                                                    }    ?></p>
                    </th>
                </tr>
                <tr>
                    <th>Họ tên:</th>
                    <th><input type="text" name="hoten" id="hoten" placeholder="Nhập họ tên" value="<?php if (isset($_REQUEST["hoten"])) {
                                                                                                        echo $_REQUEST["hoten"];
                                                                                                    } ?>" oninput="validateHoten()">

                        <p class="text-danger" id="hotenError"><?php if (!empty($error['empty']['hoten'])) {
                                                                    echo  $error['empty']['hoten'];
                                                                }    ?></p>
                    </th>
                </tr>
                <tr>
                <tr>
                    <th>Số điện thoại:</th>
                    <th><input type="number" name="sodt" id="sodt" placeholder="Nhập số điện thoại" value="<?php if (isset($_REQUEST["sodt"])) {
                                                                                                                echo $_REQUEST["sodt"];
                                                                                                            } ?>" oninput="validateSodt()">
                        <p class="text-danger" id="sodtError"><?php if (!empty($error['sodt'])) {
                                                                    echo  $error['sodt'];
                                                                } elseif (!empty($error['empty']['sodt'])) {
                                                                    echo  $error['empty']['sodt'];
                                                                }   ?></p>
                    </th>
                </tr>
                <tr>
                    <th>Email:</th>
                    <th><input type="text" name="email" id="email" placeholder="Nhập email" value="<?php if (isset($_REQUEST["email"])) {
                                                                                                        echo $_REQUEST["email"];
                                                                                                    } ?>" oninput="validateEmail()">
                        <p class="text-danger" id="emailError"><?php if (!empty($error['email'])) {
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
                        <?php foreach ($list_user as $title_item) { ?>
                            <input type="radio" id="" name="management" value="<?php echo $title_item['idRole'] ?>">
                            <label for="age1"><?php echo $title_item['tenRole'] ?></label>
                            <span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
                        <?php  } ?>
                        <p class="text-danger"><?php if (!empty($error['empty']['management'])) {
                                                    echo  $error['empty']['management'];
                                                }    ?></p>
                    </th>
                </tr>
                <tr>

                    <td>

                    </td>
                    <td>
                        <input type="submit" value="Thêm" id="submit" name="btn_file">
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
        if (isset($_REQUEST["management"])) {
            $Role = $_REQUEST["management"];
        } else {
            $Role = "";
        }
        $tmpimg = $_FILES["upfile"]["tmp_name"];
        $typeimg = $_FILES["upfile"]["type"];
        $hinhAnh = $_FILES["upfile"]["name"];
        $sizeimg = $_FILES["upfile"]["size"];

        date_default_timezone_set('Asia/Ho_Chi_Minh');
        $now = new DateTime();
        $ngayTao = $now->format('Y-m-d H:i:s');



        $p = new controlManagement();

        $kq = $p->addManager(
            $tenDangNhap,
            $matKhau,
            $maNhanVien,
            $hoTen,
            $soDienThoai,
            $email,
            $hinhAnh,
            $ngayTao,
            $Role,
            $tmpimg,
            $typeimg,
            $sizeimg
        );
        if ($kq == 1) {

            $noiDung = "Bạn đã thêm người dùng";
            $thoiGian =  date('Y-m-d H:i:s');
            $idTaiKhoan = $_SESSION['is_login']['idTaiKhoan'];

            $sta->InsertThongBao($noiDung, $thoiGian, $idTaiKhoan);
            echo '<script>alert("Thêm nhân viên thành công")</script>';
            require 'sendmail.php';
        } elseif ($kq == 0) {
            echo '<script>alert("Không thể thêm nhân viên")</script>';
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

if (isset($_POST['btn_gui'])) {
    $file = $_FILES['file']['tmp_name'];

    $objReader = PHPExcel_IOFactory::createReaderForFile($file);
    // $objReader->setLoadSheetsOnly('Huan1');
    $objExcel = $objReader->load($file);
    $sheetData = $objExcel->getActiveSheet()->toArray();

    $errorExcel = array();
    foreach ($taiKhoan as $item) {
        for ($i = 1; $i < count($sheetData); $i++) {
            $error = $i + 1;

            $tenDangNhap  = $sheetData[$i][0];
            if ($item['tenDangNhap'] == $tenDangNhap) {
                $errorExcel['tenDangNhap'] = " Tên đăng nhập đã tồn tại ở hàng $error của file Excel !\\n\\n";
            } elseif (strlen($tenDangNhap) < 8 || strlen($tenDangNhap) > 16) {
                $errorExcel['tenDangNhap'] = "Tên đăng nhập ở hàng $error của file Excel phải có độ dài từ 8-16 kí tự !\\n\\n";
            }
            $matKhau = $sheetData[$i][1];
            $maNhanVien = $sheetData[$i][2];
            if ($item['maNhanVien'] == $maNhanVien) {
                $errorExcel['maNhanVien'] = " Mã nhân viên đã tồn tại ở hàng $error của file Excel !\\n\\n";
            } elseif (strlen($maNhanVien) < 8 || strlen($maNhanVien) > 16) {
                $errorExcel['maNhanVien'] = "Mã nhân viên ở hàng $error của file Excel phải có độ dài từ 8-16 kí tự !\\n\\n";
            }
            $hoTen = $sheetData[$i][3];
            if (!preg_match('/^[A-ZÀ-Ỹ][a-zà-ỹ]*( [A-ZÀ-Ỹ][a-zà-ỹ]*)*$/', $hoTen)) {
                $errorExcel['hoTen'] = "Họ tên ở hàng $error của file Excel phải từ 2 kí tự và mỗi chữ đầu tiên của từ phải viết hoa !\\n\\n";
            }
            $soDienThoai = $sheetData[$i][4];
            if ($item['soDienThoai'] ==  $soDienThoai) {
                $errorExcel['soDienThoai'] = " Số điện thoại đã tồn tại ở hàng $error của file Excel !\\n\\n";
            } elseif (!preg_match('/^0[0-9]{9,10}$/', $soDienThoai)) {
                $errorExcel['soDienThoai'] = "Số điện thoại ở hàng $error của file Excel phải bắt đầu từ số 0 và có 10 hoặc 11 số !\\n\\n";
            }
            $email = $sheetData[$i][5];
            if ($item['email'] ==  $email) {
                $errorExcel['email'] = " Email đã tồn tại ở hàng $error của file Excel !";
            } elseif (!preg_match('/^[^\s@]+@[^\s@]+\.[^\s@]+$/', $email)) {
                $errorExcel['email'] = "Email ở hàng $error của file Excel không đúng định dạng !\\n\\n";
            }
            $Role = $sheetData[$i][6];
        }
    }

    if (!empty($errorExcel)) {
        $redColor = "\u{1F534}";
        $greenColor = "\u{1F7E2}";
        $loi = $greenColor.'Không thể thêm nhân viên khi đang bị lỗi:\\n\\n';
        if (!empty($errorExcel['tenDangNhap'])) {
            $loi .= $redColor . $errorExcel['tenDangNhap'];
        }
        if (!empty($errorExcel['maNhanVien'])) {
            $loi .= $redColor . $errorExcel['maNhanVien'];
        }
        if (!empty($errorExcel['soDienThoai'])) {
            $loi .= $redColor . $errorExcel['soDienThoai'];
        }
        if (!empty($errorExcel['email'])) {
            $loi .= $redColor . $errorExcel['email'];
        }
        if (!empty($errorExcel['hoTen'])) {
            $loi .= $redColor . $errorExcel['hoTen'];
        }
        echo "<script>alert('$loi')</script>";
    } else {

        $kq =   $p->InsertManagerExcel($sheetData);
        if ($kq == 1) {

            $noiDung = "Bạn đã thêm người dùng";
            $thoiGian =  date('Y-m-d H:i:s');
            $sta->InsertThongBao($noiDung, $thoiGian, $idTaiKhoan);
            echo '<script>alert("Thêm nhân viên thành công")</script>';
            require 'sendmailExcel.php';
        } elseif ($kq == 0) {
            echo '<script>alert("Không thể thêm nhân viên")</script>';
        }
    }
}
?>

<script>
    function validateUsername() {
        var username = document.getElementById("username").value;
        var errorElement = document.getElementById("usernameError");
        if (username.length < 8 || username.length > 16) {
            errorElement.textContent = "Tên đăng nhập phải có độ dài từ 8 đến 16 kí tự !";
        } else {
            errorElement.textContent = "";
        }
    }

    function validateManv() {
        var manv = document.getElementById("manv").value;
        var errorElement = document.getElementById("manvError");
        if (manv.length < 8 || manv.length > 16) {
            errorElement.textContent = "Mã nhân viên phải có độ dài từ 8 đến 16 kí tự !";
        } else {
            errorElement.textContent = "";
        }
    }

    function validatePassword() {
        var password = document.getElementById("password").value;
        var errorElement = document.getElementById("passwordError");
        if (password.length < 6) {
            errorElement.textContent = "Mật khẩu phải có ít nhất 6 kí tự !";
        } else {
            errorElement.textContent = "";
        }
    }

    function validateHoten() {
        var hoten = document.getElementById("hoten").value;
        var errorElement = document.getElementById("hotenError");
        var nameRegex = /^[A-ZÀ-Ỹ][a-zà-ỹ]*( [A-ZÀ-Ỹ][a-zà-ỹ]*)*$/;

        if (hoten.length < 2 || !nameRegex.test(hoten)) {
            errorElement.textContent = "Họ tên phải từ 2 kí tự và mỗi chữ đầu tiên của từ phải viết hoa !";
        } else {
            errorElement.textContent = "";
        }
    }

    function validateSodt() {
        var sodt = document.getElementById("sodt").value;
        var errorElement = document.getElementById("sodtError");
        var phoneRegex = /^0\d{9,10}$/;
        if (!phoneRegex.test(sodt)) {
            errorElement.textContent = "Số điện thoại phải bắt đầu từ số 0 và có 10 hoặc 11 số !";
        } else {
            errorElement.textContent = "";
        }
    }

    function validateEmail() {
        var email = document.getElementById("email").value;
        var errorElement = document.getElementById("emailError");
        var emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        if (!emailRegex.test(email)) {
            errorElement.textContent = "Email không đúng định dạng !";
        } else {
            errorElement.textContent = "";
        }
    }
</script>