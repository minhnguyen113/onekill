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
        <h2 class="mt-4">Món ăn mới</h2>
        <form action="" enctype="multipart/form-data" method="post">
            <table class="admin_upload">
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

                    <td>

                    </td>
                    <td>
                        <input type="submit" value="Cập nhật" id="submit" name="btn_addDish">
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
    $listNlWeight = array();

    foreach ($list_nguyenlieu as $index => $ngl) {
        if (isset($_POST["nguyenlieu"]) && !empty($_POST["weight$index"])) {
            $listNlWeight[] = [
                'nguyenlieu' => $_POST["nguyenlieu"],
                'weight' => $_POST["weight$index"]
            ];
        }
    }
    if (!empty($listNlWeight)) {
        $p->DeleteNguyenLieuByIdMonAn($idMonAn);

        $idMonAn = $_GET['idMonAn'];
        $kq = $p->InsertChiTietNguyenLieuMonAn($listNlWeight, $idMonAn);

        if ($kq == 1) {
            $noiDung = "Bạn đã cập nhật nguyên liệu cho món ăn";
            $thoiGian =  date('Y-m-d H:i:s');
            $idTaiKhoan = $_SESSION['is_login']['idTaiKhoan'];
            $sta->InsertThongBao($noiDung, $thoiGian, $idTaiKhoan);
            echo '<script>alert("Cập nhật nguyên liệu thành công")</script>';
            echo header("refresh: 0; url='admin.php?mod=UpdateDish&idMonAn=$idMonAn'");
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
    } else {
        echo '<script>alert("Phải thêm nguyên liệu")</script>';
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