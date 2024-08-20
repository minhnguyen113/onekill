<?php
include_once("Controller/cDish.php");

$p = new controlDish();

$wait = 0;
$list_monan  = $p->getAllDishWait($wait);

$DeleteDish = $p->getDeleteTemporaryDish();
?>

<main id="main" class="main">

  <div class="pagetitle">

    <h1>Danh sách món ăn chờ duyệt </h1>

    <nav>
      <ol class="breadcrumb">

        <li class="breadcrumb-item">Món ăn</li>

      </ol>
    </nav>
  </div><!-- End Page Title -->

  <section class="section">
    <div class="row">
      <div class="col-lg-12">

        <div class="card">
          <div class="card-body">
            <h5 class="card-title">Món ăn chờ duyệt</h5>


            <a href="admin.php?mod=BinTemporary" style="position: absolute; right: 5%; top:20px"> <i style="font-size: 25px; color: #000;" class="fa-solid fa-trash-can"></i><span style="position: absolute; font-size:12px; margin-top: -10px; color: #fff; background-color: red; border-radius: 50%; padding: 0px 4px;"><?php if (!empty($DeleteDish)) {
                                                                                                                                                                                                                                                                                                                              echo count($DeleteDish);
                                                                                                                                                                                                                                                                                                                            } else {
                                                                                                                                                                                                                                                                                                                              echo '0';
                                                                                                                                                                                                                                                                                                                            } ?></span> </a>


            <button class="btn btn-primary"><a href="admin.php?mod=ListDishAdmin" style="color: #fff;">Món đã duyệt</a></button>
            <form action="" method="post">
              <table class="table datatable">
                <thead>
                  <tr>
                    <th scope="col">STT</th>
                    <th scope="col">Tên món</th>
                    <th scope="col">Giá</th>
                    <th scope="col">Hình ảnh</th>
                    <th scope="col">Loại Món Ăn</th>
                    <th scope="col">Duyệt món</th>
                    <th scope="col">Tác vụ</th>

                  </tr>
                </thead>
                <tbody>
                  <?php
                  $i = 1;
                  if (!empty($list_monan)) {
                    foreach ($list_monan as $item) { ?>
                      <tr>
                        <th scope="row"><?php echo  $i++ ?></th>
                        <td><?php echo $item['tenMon'] ?></td>
                        <td><?php echo currency_format($item['gia']) ?></td>
                        <td><img style="width: 100px; height: 40px;" src="assets/imageDish/<?php echo $item['hinhAnhMon'] ?>" alt=""></td>
                        <td><?php echo $item['tenLoai'] ?></td>
                        <td><button class="btn btn-success"><input type="checkbox" name="<?php echo $item['idMonAn']  ?>" id=""></button></td>
                        <td><button class="btn btn-secondary">
                            <a href="admin.php?mod=DeleteDish&idMonAn=<?php echo $item['idMonAn'] ?>" style="color: #fff;" onclick="return confirm('Bạn chắc chắn muốn xóa chứ!')">Xóa</a></button>
                          <button class="btn btn-secondary"><a href="" style="color: #fff;">Sửa</a></button>
                        </td>
                      </tr>
                  <?php }
                  } ?>

                </tbody>
              </table>
              <input type="submit" value="Duyệt món" name="btn_duyet">
            </form>
          </div>
        </div>

      </div>
    </div>
  </section>

</main>

<?php

if(isset($_POST['btn_duyet'])){
$idMonAn = array();

foreach ($_POST as $index => $item) {
  if ($item == 'on') {
    $idMonAn[] = $index;
  }
}
if(!empty($idMonAn)){
$p->AcceptDish($idMonAn);
echo header("refresh: 0; url='admin.php?mod=ListDishWait'");

} else {
  echo '<script>alert("Chưa chọn món để duyệt")</script>';
}
}