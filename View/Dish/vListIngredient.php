<?php
include_once("Controller/cDish.php");


$p = new controlDish();

$list =  $p->getNguyenLieu();
$delete = $p->getNguyenLieuDelete();

?>

<main id="main" class="main">

    <div class="pagetitle">
   
        <h1>Danh sách nguyên liệu</h1>

      <nav>
        <ol class="breadcrumb">
      
        <li class="breadcrumb-item">nguyên liệu</li>

        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section">
      <div class="row">
        <div class="col-lg-12">

          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Quản lý</h5>
      
              <a href="admin.php?mod=ListIngredientDelete" style="position: absolute; right: 5%; top:20px"> <i style="font-size: 25px; color: #000;" class="fa-solid fa-trash-can"></i><span style="position: absolute; font-size:12px; margin-top: -10px; color: #fff; background-color: red; border-radius: 50%; padding: 0px 4px;"><?php if (!empty($delete)) {
                                                                                                                                                                                                                                                                                                    echo count($delete);
                                                                                                                                                                                                                                                                                                  } else {
                                                                                                                                                                                                                                                                                                    echo '0';
                                                                                                                                                                                                                                                                                                  } ?></span> </a>
              

              <!-- Table with stripped rows -->
              <table class="table datatable">
                <thead>
                  <tr>
                    <th scope="col">STT</th>
                    <th scope="col">Tên nguyên liệu</th>
                    <th scope="col">Hình ảnh</th>
                    <th scope="col">Tác vụ</th>
                

                  </tr>
                </thead>
                <tbody>
                <?php  
                $i =1;
                foreach($list as $item) { ?>
                  <tr>
                    <th scope="row"><?php echo  $i++ ?></th>
                    <td><?php echo $item['tenNguyenLieu'] ?></td>
                    <td><img style="width: 100px; height: 40px;" src="assets/imageIngredient/<?php echo $item['hinhAnh'] ?>" alt=""></td>
                    <td><button class="btn btn-secondary"><a href="admin.php?mod=DeleteIngredient&idNguyenLieu=<?php echo$item['idNguyenLieu'] ?>" class="text-light" onclick="return confirm('Bạn chắc chắn muốn xóa chứ!')">Xóa</a></button></td>
             

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

