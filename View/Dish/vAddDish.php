<?php
include_once("Controller/cDish.php");
include_once("lib/price.php");
include_once("Controller/cStatistic.php");
$sta = new ControlStatistic();
$p = new controlDish();

$list_loai  = $p->getAllLoaiMonAn();
$list_nguyenlieu = $p->getAllNguyenLieu();
$listMonAn = $p->getAllDish();


if (isset($_REQUEST["btn_addDish"])) {
    $error = array();
    foreach ($listMonAn as $item) {
        if (strcasecmp(trim($_REQUEST["tenMon"]), trim($item['tenMon'])) == 0) {
            $error['tenMon'] = 'Món ăn đã tồn tại !';
        }
        if (empty($_REQUEST['tenMon'])) {
            $error['empty']['tenMon'] = 'Tên món ăn không được để trống !';
        }
        if (empty($_REQUEST['gia'])) {
            $error['empty']['gia'] = 'Giá món ăn không được để trống !';
        }
        if (empty($_REQUEST['mota'])) {
            $error['empty']['mota'] = 'Vui lòng thêm mô tả cho món ăn !';
        }
        if ($_REQUEST['loaiMon'] == 0) {
            $error['empty']['loaiMon'] = 'Chưa chọn loại món ăn !';
        }
        if ($_REQUEST['gia'] <= 1000) {
            $error['gia'] = "Giá tối thiểu từ 1000 trở lên!";
        }
    }
}

?>
<style>
    .form-container {
        display: none;
    }

    .admin_upload .nguyenlieu {
        border: 1px solid #000;
        display: inline-block;
        width: 140px;
        position: relative;
        margin: 10px;
        padding: 2px 5px;
    }

    .admin_upload input[type="checkbox"] {
        position: absolute;
        right: -10px;
        top: 6px;
    }
</style>
<div class="container-fluid px-4 add">
    <div class="upload">
        <h2 class="mt-4 m-3">Thêm món ăn mới</h2>
        <form action="" enctype="multipart/form-data" method="post">
            <table class="admin_upload">

                <tr>
                    <th>Tên món ăn:</th>
                    <th><input type="text" name="tenMon" id="manv tenMon" placeholder="Nhập tên món ăn" onblur="validateTenMon()">
                        <p class="text-danger" id="tenmonError"><?php if (!empty($error['tenMon'])) {
                                                                    echo  $error['tenMon'];
                                                                } elseif (!empty($error['empty']['tenMon'])) {
                                                                    echo  $error['empty']['tenMon'];
                                                                } ?></p>


                    </th>
                </tr>
                <tr>
                    <th>giá:</th>
                    <th><input type="number" id="gia" name="gia" placeholder="nhập giá" onblur="validatePrice()">
                        <p class="text-danger" id="priceError"><?php if (!empty($error['empty']['gia'])) {
                                                                    echo  $error['empty']['gia'];
                                                                }
                                                                if (!empty($error['gia'])) {
                                                                    echo   $error['gia'];
                                                                } ?></p>

                    </th>
                </tr>

                <tr>
                    <th>Mô tả</th>
                    <th><textarea name="mota" id="mota" cols="30" rows="10" onblur="validateDescribe()"></textarea>
                        <p class="text-danger" id="describeError"><?php if (!empty($error['empty']['mota'])) {
                                                                        echo  $error['empty']['mota'];
                                                                    }

                                                                    ?></p>

                    </th>
                </tr>
                <tr>
                    <th>Loại món ăn:</th>
                    <th>

                        <select name="loaiMon" id="option" class="insert">
                            <option value="0">chọn Loại món....</option>

                            <?php foreach ($list_loai  as $title_item) { ?>
                                <option value="<?php echo $title_item['idLoaiMon'] ?>"><?php echo $title_item['tenLoai'] ?></option>
                            <?php  } ?>
                        </select>

                        <p class="text-danger"><?php if (!empty($error['empty']['loaiMon']))   echo  $error['empty']['loaiMon'];   ?></p>

                    </th>
                </tr>
                <tr>

                    <th>Nguyên liệu cho món ăn:</th>
                    <th>


                        <?php foreach ($list_nguyenlieu as $index => $item) { ?>
                            <div class="nguyenlieu">
                                <label for="checkbox<?php echo $index ?>"><?php echo $item['tenNguyenLieu'] ?></label>
                                <input type="checkbox" class="show-form" data-form="form<?php echo $index ?>" id="checkbox<?php echo $index ?>" style="margin-right:20px;" name="nguyenlieu[]" id="" value="<?php echo $item['idNguyenLieu'] ?>">
                            </div>
                        <?php  } ?>


                    </th>

                </tr>
                <tr>
                    <th><span>Trọng lượng nguyên liệu cần nấu giá trị/suất ăn:</span>

                    </th>
                    <th>
                        <div id="checkboxes-container"> </div>
                    </th>
                </tr>

                <tr>
                    <th>Ảnh món ăn:</th>
                    <th><input type="file" name="upfile" id="" required></th>
                </tr>
                <tr>

                    <td>

                    </td>
                    <td>
                        <input type="submit" value="Thêm" id="submit" name="btn_addDish">
                        <input type="reset" value="Hủy" id="reset" name="btn_file">


                    </td>
                </tr>


            </table>
        </form>
    </div>
</div>

</body>

</html>

<script>
    <?php $tenMonAn = array();
    foreach ($list_nguyenlieu as $nguyenLieu) {
        $tenMonAn[] = $nguyenLieu['tenNguyenLieu'];
    }
    ?>
    var ingredients = <?php echo json_encode($tenMonAn); ?>;


    var formsContainer = document.getElementById('checkboxes-container');

    for (var i = 0; i < ingredients.length; i++) {


        // Tạo form
        var form = document.createElement('div');
        form.id = 'form' + i;
        form.className = 'form-container';
        form.innerHTML = `
               
                    <label for="weight${i}">Cân nặng của ${ingredients[i]} (g):</label>
                    <input type="text" id="weight${i}" name="weight${i}"><br>
                    <div id="result${i}"></div>
             
            `;
        formsContainer.appendChild(form);

    }

    var checkboxes = document.querySelectorAll('.show-form');
    checkboxes.forEach(function(checkbox) {
        checkbox.addEventListener('change', function() {
            var formId = this.getAttribute('data-form');
            var formContainer = document.getElementById(formId);

            if (this.checked) {
                formContainer.style.display = 'block';
            } else {
                formContainer.style.display = 'none';
            }
        });
    });


    function validateTenMon() {
        var tenMon = document.getElementById("manv tenMon").value;
        var errorElement = document.getElementById("tenmonError");
        if (tenMon.length == 0) {
            errorElement.textContent = "Tên món ăn không được để trống !";
        } else {
            errorElement.textContent = "";
        }
    }

    function validatePrice() {
        var gia = document.getElementById("gia").value;
        var errorElement = document.getElementById("priceError");
        if (gia.length == 0) {
            errorElement.textContent = "Giá món ăn không được để trống !";
        } else if (gia < 1000) {
            errorElement.textContent = "Giá tối thiểu từ 1000 trở lên!";
        } else {
            errorElement.textContent = "";
        }
    }


    function validateDescribe() {
        var text = document.getElementById("mota").value;
        var errorElement = document.getElementById("describeError");
        if (text.length == 0) {
            errorElement.textContent = "Vui lòng thêm mô tả cho món ăn !";
        } else {
            errorElement.textContent = "";
        }
    }
</script>

<?php

if (isset($_POST['btn_addDish'])) {
    if (empty($error)) {
        $tenMon = $_POST['tenMon'];
        $gia = $_POST['gia'];
        $Mota = $_POST['mota'];
        $idLoaiMon = $_POST['loaiMon'];
        $hinhAnh = $_FILES["upfile"]["name"];
        $tmpimg = $_FILES["upfile"]["tmp_name"];
        $typeimg = $_FILES["upfile"]["type"];
        $sizeimg = $_FILES["upfile"]["size"];


        $kq = $p->InsertDish($tenMon, $gia, $Mota, $hinhAnh, $idLoaiMon, $tmpimg, $typeimg, $sizeimg);

        if ($kq == 1) {
            $noiDung = "Bạn đã thêm món ăn";
            $thoiGian =  date('Y-m-d H:i:s');
            $idTaiKhoan = $_SESSION['is_login']['idTaiKhoan'];
            $sta->InsertThongBao($noiDung, $thoiGian, $idTaiKhoan);
            echo '<script>alert("Thêm món thành công")</script>';


            $listNlWeight = array();

            foreach ($list_nguyenlieu as $index => $ngl) {
                if (isset($_POST["nguyenlieu"]) && !empty($_POST["weight$index"])) {
                    $listNlWeight[] = [
                        'nguyenlieu' => $_POST["nguyenlieu"],
                        'weight' => $_POST["weight$index"]
                    ];
                }
            }

            $idMA = $p->getDishNew();
            $idMonAn = $idMA['idMonAn'];
            $p->InsertChiTietNguyenLieuMonAn($listNlWeight, $idMonAn);
        } elseif ($kq == 0) {
            echo '<script>alert("Không thể thêm món")</script>';
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
