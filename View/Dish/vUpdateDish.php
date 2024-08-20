<?php
include_once("Controller/cDish.php");
include_once("Controller/cStatistic.php");
$sta = new ControlStatistic();

$p = new controlDish();

$list_loai  = $p->getAllLoaiMonAn();
$list_nguyenlieu = $p->getAllNguyenLieu();

$idMonAn = $_GET['idMonAn'];
$dish = $p->getLoaiMonAnById($idMonAn);

$listDishIngredient =  $p->gettAllDishIngredient($idMonAn);

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
        <h2 class="mt-4">Sửa món ăn</h2>
        <form action="#" enctype="multipart/form-data" method="post">
            <table class="admin_upload">

                <tr>
                    <th>Tên món ăn:</th>
                    <th><input type="text" name="tenMon" id="manv" placeholder="Nhập tên món ăn" value="<?php echo $dish['tenMon'] ?>"></th>
                </tr>
                <tr>
                    <th>giá:</th>
                    <th><input type="number" id="gia" name="gia" placeholder="nhập giá" value="<?php echo $dish['gia'] ?>"></th>
                </tr>

                <tr>
                    <th>Mô tả</th>
                    <th><textarea name="mota" id="" cols="30" rows="10"><?php echo $dish['Mota'] ?></textarea></th>
                </tr>
                <tr>
                    <th>Loại món ăn:</th>
                    <th> <select name="loaiMon" id="option" class="insert">
                            <?php foreach ($list_loai  as $title_item) {
                                if ($title_item['idLoaiMon'] == $dish['idLoaiMon']) {
                            ?>
                                    <option value="<?php echo $title_item['idLoaiMon'] ?>" selected><?php echo $title_item['tenLoai'] ?></option>
                                <?php  } else {
                                ?>
                                    <option value="<?php echo $title_item['idLoaiMon'] ?>"><?php echo $title_item['tenLoai'] ?></option>
                            <?php }
                            } ?>
                        </select></th>
                </tr>


                <tr>
                    <th><span>Trọng lượng nguyên liệu cần nấu giá trị/suất ăn:</span></th>

                    <th>


                        <?php
                        if (!empty($listDishIngredient)) {
                            foreach ($listDishIngredient as $index => $item) {
                        ?>
                                <label id="tenNguyenLieu<?php echo $item['idNguyenLieu'] ?>" for="checkbox<?php echo $index ?>">Cân nặng của <?php echo $item['tenNguyenLieu'] ?> (g):</label>
                                <input type="text" id="weight<?php echo $item['idNguyenLieu'] ?>" name="weight<?php echo $item['idNguyenLieu'] ?>" value="<?php echo $item['soLuong'] ?>">
                        <?php
                            }
                        } ?>


                    </th>
                </tr>

                <tr>

                    <th colspan="2" style="text-align: center;" class="justify-content-center">
                        <button class="btn btn-warning"><a href="admin.php?mod=UpDateIngredient&idMonAn=<?php echo $_GET['idMonAn'] ?>">Thay đổi nguyên liệu</a></button>
                    </th>


                </tr>
                <tr>
                    <th>Ảnh hiện tại:</th>
                    <th> <img style="width: 150px;" src="./assets/imageDish/<?php echo $dish['hinhAnhMon'] ?>" alt=""></th>
                </tr>

                <tr>
                    <th>Cập nhật ảnh mới:</th>
                    <th><input type="file" name="upfile" id=""></th>
                </tr>
                <tr>

                    <td>
                        <input type="hidden" name="img_old" value="<?php echo $dish['hinhAnhMon']; ?>">
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
</script>

<?php

if (isset($_POST['btn_addDish'])) {
    $tenMon = $_POST['tenMon'];
    $gia = $_POST['gia'];
    $Mota = $_POST['mota'];
    $idLoaiMon = $_POST['loaiMon'];

    if ($_FILES["upfile"]["name"] != '') {
        $tmpimg = $_FILES["upfile"]["tmp_name"];
        $typeimg = $_FILES["upfile"]["type"];
        $hinhAnhMon = $_FILES["upfile"]["name"];
        $sizeimg = $_FILES["upfile"]["size"];
    } else {
        $hinhAnhMon = $_REQUEST['img_old'];
        $tmpimg = '';
        $typeimg = '';
        $sizeimg = '';
    }

    $kq = $p->UpdateDishById($idMonAn, $tenMon, $gia, $Mota, $hinhAnhMon, $idLoaiMon, $tmpimg, $typeimg, $sizeimg);

    if ($kq == 1) {
       $p->DeleteNguyenLieuByIdMonAn($idMonAn);
       $noiDung = "Bạn đã cập nhật món ăn";
       $thoiGian =  date('Y-m-d H:i:s');
       $idTaiKhoan = $_SESSION['is_login']['idTaiKhoan'];
       $sta->InsertThongBao($noiDung, $thoiGian, $idTaiKhoan);
           echo '<script>alert("Cập nhật món ăn thành công")</script>';
        $listNlWeight = array();
        foreach ($listDishIngredient  as $index => $ngl) {
                  $nl = $ngl['idNguyenLieu'];
            $listNlWeight[] = [
                'nguyenlieu' => $ngl['idNguyenLieu'],
                'weight' =>  $_POST["weight$nl"],
            ];
        }


         $p->InsertUpdateChiTietNguyenLieuMonAn($listNlWeight, $idMonAn);
         echo header("refresh: 0; url='admin.php?mod=ListDishAdmin'");
    } elseif ($kq == 0) {
        echo '<script>alert("Không thể thêm món ăn")</script>';
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

?>
<script>
    <?php foreach ($list_nguyenlieu as $index => $item) {
        foreach ($listDishIngredient as $di) {
            if ($di['idNguyenLieu'] == $item['idNguyenLieu']) {
    ?>
                const checkbox<?php echo $index ?> = document.getElementById("checkbox<?php echo $index ?>");
                const weight<?php echo $item['idNguyenLieu'] ?> = document.getElementById("weight<?php echo $item['idNguyenLieu'] ?>");
                const tenNguyenLieu<?php echo $item['idNguyenLieu'] ?> = document.getElementById("tenNguyenLieu<?php echo $item['idNguyenLieu'] ?>");
                checkbox<?php echo $index ?>.addEventListener("change", function() {
                    if (!checkbox<?php echo $index ?>.checked) {
                        weight<?php echo $item['idNguyenLieu'] ?>.style.display = "none"; // Ẩn thẻ text khi checkbox bị bỏ check
                        tenNguyenLieu<?php echo $item['idNguyenLieu'] ?>.style.display = "none";
                    }
                });
    <?php }
        }
    } ?>
</script>