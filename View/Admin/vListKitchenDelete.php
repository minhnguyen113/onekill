
<?php

include_once("Controller/cManagement.php");
$p = new controlManagement();

$DeleteDish =$p->getAllKitchenDelete();

?>
<main id="main" class="main">

    <div class="pagetitle">
   
      <h1>Danh sách nhân viên bếp bị xóa</h1>
      <nav>
        <ol class="breadcrumb">
       
            <li class="breadcrumb-item">Nhân viên bếp</li>

        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section">
      <div class="row">
        <div class="col-lg-12">

          <div class="card">
            <div class="card-body">
            <h5 class="card-title"><a href="admin.php?mod=KitchenManager"><i class="fa-solid fa-arrow-left-long"></i> Quay lại</a></h5>
      
              
              <a href="admin.php?mod=ListKitchenDelete" style="position: absolute; right: 5%; top:20px"> <i style="font-size: 25px; color: #000;" class="fa-solid fa-trash-can"></i><span style="position: absolute; font-size:12px; margin-top: -10px; color: #fff; background-color: red; border-radius: 50%; padding: 0px 4px;"><?php if (!empty($DeleteDish)) {
                                                                                                                                                                                                                                                                                                    echo count($DeleteDish);
                                                                                                                                                                                                                                                                                                  } else {
                                                                                                                                                                                                                                                                                                    echo '0';
                                                                                                                                                                                                                                                                                                  } ?></span> </a>

              <!-- Table with stripped rows -->
              <table class="table datatable">
                <thead>
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col">Mã nhân viên</th>
                    <th scope="col">Họ tên</th>
                    <th scope="col">Chức vụ</th>
                    <th scope="col">Email</th>
                    <th scope="col">Tác vụ</th>

                  </tr>
                </thead>
                <tbody>
                <?php  
                $i =1;
                if(!empty($DeleteDish)){
                foreach($DeleteDish as $item) { ?>
                  <tr>
                    <th scope="row"><?php echo  $i++ ?></th>
                    <td><?php echo $item['maNhanVien'] ?></td>
                    <td><?php echo $item['hoTen'] ?></td>
                    <td><?php echo $item['tenRole'] ?></td>
                    <td><?php echo $item['email'] ?></td>
                    <td><button  class="btn btn-secondary"><a  style="color: #fff;" href="admin.php?mod=RestoreUser&po=Kitchen&idTaiKhoan=<?php echo $item['idTaiKhoan'] ?>">Khôi phục</a></button>
                    <button  class="btn btn-secondary"><a href="admin.php?mod=DeleteUser&po=Kitchen&idTaiKhoan=<?php echo $item['idTaiKhoan'] ?>"  style="color: #fff;"  onclick="return confirm('Bạn chắc chắn muốn xóa vĩnh viễn chứ!')">Xóa vĩnh viễn</a></button></td>

                  </tr>
                  <?php }} else{
                 ?>
              
                </tbody>
              </table>
              <h5 class="text-center  text-danger">Không có tài khoản nào bị xóa !</h5>
                <?php } ?>
         
            </div>
          </div>

        </div>
      </div>
    </section>

  </main>