<?php
include_once("Controller/cDish.php");

$p = new controlDish();

$wait = 1;
$list_monan  = $p->getAllDishWait($wait);

$DeleteDish = $p->getDeleteTemporaryDish();

?>

<main id="main" class="main">

  <div class="pagetitle">

    <h1>Danh sách món ăn</h1>

    <nav>
      <ol class="breadcrumb">

        <li class="breadcrumb-item">Customer Manager</li>

      </ol>
    </nav>
  </div><!-- End Page Title -->

  <section class="section">
    <div class="row">
      <div class="col-lg-12">

        <div class="card">
          <div class="card-body">
            <h5 class="card-title">Món ăn đã xóa</h5>


            <a href="admin.php?mod=BinTemporary" style="position: absolute; right: 5%; top:20px"> <i style="font-size: 25px; color: #000;" class="fa-solid fa-trash-can"></i><span style="position: absolute; font-size:12px; margin-top: -10px; color: #fff; background-color: red; border-radius: 50%; padding: 0px 4px;"><?php if (!empty($DeleteDish)) {
                                                                                                                                                                                                                                                                                                    echo count($DeleteDish);
                                                                                                                                                                                                                                                                                                  } else {
                                                                                                                                                                                                                                                                                                    echo '0';
                                                                                                                                                                                                                                                                                                  } ?></span> </a>


            <table class="table datatable">
              <thead>
                <tr>
                  <th scope="col">STT</th>
                  <th scope="col">Tên món</th>
                  <th scope="col">Giá</th>
                  <th scope="col">Hình ảnh</th>
                  <th scope="col">Loại Món Ăn</th>
                  <th scope="col">Tác vụ món</th>

                </tr>
              </thead>
              <tbody>
                <?php
                $i = 1;
                if (!empty($DeleteDish)) {
                  foreach ($DeleteDish as $item) { ?>
                    <tr>
                      <th scope="row"><?php echo  $i++ ?></th>
                      <td><?php echo $item['tenMon'] ?></td>
                      <td><?php echo currency_format($item['gia']) ?></td>
                      <td><img style="width: 100px; height: 40px;" src="assets/imageDish/<?php echo $item['hinhAnhMon'] ?>" alt=""></td>
                      <td><?php echo $item['tenLoai'] ?></td>
                      <td>
                        <button class="btn btn-success"><a href="admin.php?mod=RestoreDish&idMonAn=<?php echo $item['idMonAn'] ?>" style="color: #fff;">Khôi phục</a></button>
                        <button class="btn btn-danger"><a href="admin.php?mod=DeletePermanently&idMonAn=<?php echo $item['idMonAn'] ?>" style="color: #fff;" onclick="return confirm('Bạn chắc chắn muốn xóa chứ!')">Xóa vĩnh viễn</a></button>

                      </td>

                    </tr>
                <?php }
                }?>

              </tbody>
            </table>

          </div>
        </div>

      </div>
    </div>
  </section>

</main>

