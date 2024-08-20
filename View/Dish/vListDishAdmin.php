<?php
include_once("Controller/cDish.php");

$p = new controlDish();

$wait = 1;
$list_monan  = $p->getAllDishWait($wait);
 
$list_duyet = $p->getAllDishWait(0);
$DeleteDish = $p->getDeleteTemporaryDish();
?>

<main id="main" class="main">

  <div class="pagetitle">

    <h1>Danh sách món ăn</h1>

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
            <h5 class="card-title">Món ăn đã duyệt</h5>

            <a href="admin.php?mod=BinTemporary"  style="position: absolute; right: 5%; top:20px"> <i style="font-size: 25px; color: #000;" class="fa-solid fa-trash-can"></i><span style="position: absolute; font-size:12px; margin-top: -10px; color: #fff; background-color: red; border-radius: 50%; padding: 0px 4px;"><?php if (!empty($DeleteDish)) {
                                                                                                                                                                                                                                                                                                    echo count($DeleteDish);
                                                                                                                                                                                                                                                                                                  } else {
                                                                                                                                                                                                                                                                                                    echo '0';
                                                                                                                                                                                                                                                                                                  } ?></span> </a>

<style>
 @keyframes bounce {
  0%, 20%, 50%, 80%, 100% {
    transform: translateY(0);
  }
  40% {
    transform: translateY(-5px);
  }
  60% {
    transform: translateY(-3px);
  }
}

.duyet {
  display: inline-block;
  animation: bounce 1s infinite;
}

</style>

            <button  class="btn btn-primary"><a href="admin.php?mod=ListDishWait" style="color: #fff;">Duyệt món</a></button>
            <?php if(!empty($list_duyet)){ ?>
              <span class="text-danger duyet">Có <?php echo count($list_duyet); ?> món cần duyệt</span>

           <?php }else { ?>
            <span>Không có món nào cần duyệt</span>
            <?php } ?>
            <table class="table datatable">
              <thead>
                <tr>
                  <th scope="col">STT</th>
                  <th scope="col">Tên món</th>
                  <th scope="col">Giá</th>
                  <th scope="col">Hình ảnh</th>
                  <th scope="col">Loại Món Ăn</th>
                  <th scope="col">Tác vụ</th>

                </tr>
              </thead>
              <tbody>
                <?php
                $i = 1;
                foreach ($list_monan as $item) { ?>
                  <tr>
                    <th scope="row"><?php echo  $i++ ?></th>
                    <td><?php echo $item['tenMon'] ?></td>
                    <td><?php echo currency_format($item['gia']) ?></td>
                    <td><img style="width: 100px; height: 40px;" src="assets/imageDish/<?php echo $item['hinhAnhMon'] ?>" alt=""></td>
                    <td><?php echo $item['tenLoai'] ?></td>
                    <td><button  class="btn btn-secondary">
                      <a href="admin.php?mod=DeleteDish&idMonAn=<?php echo $item['idMonAn'] ?>"  style="color: #fff;"  onclick="return confirm('Bạn chắc chắn muốn xóa chứ!')">Xóa</a></button> 
                    <button class="btn btn-secondary"><a href="admin.php?mod=UpdateDish&idMonAn=<?php echo $item['idMonAn'] ?>"  style="color: #fff;">Sửa</a></button></td>

                  </tr>
                <?php } ?>

              </tbody>
            </table>

          </div>
        </div>

      </div>
    </div>
  </section>

</main>