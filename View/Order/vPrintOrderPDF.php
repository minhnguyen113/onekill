<?php

include_once("Controller/cOrder.php");

$p = new controlOrder();
$idTaiKhoan = $_SESSION['is_login']['idTaiKhoan'];
$idThanhToan = $_GET['idThanhToan'];
$pay = $p->getThanhToanByIdTaiKhoanAndIdDonHang($idTaiKhoan, $idThanhToan);



class PDF extends tFPDF
{
    // Page header
    function Header()
    {
        // Logo and header information

        $this->Image('assets/admin/img/favicon.png', 93, 5, 25);
        $this->SetFont('Arial', 'B', 12);
        $this->Cell(80);
        $this->SetTextColor(255, 0, 0);
        $this->SetFont('Arial', 'BI', 18);
        $this->Cell(30, 50, 'ONEKILL', 0, 0, 'C');

        // Thiết lập lại màu chữ về mặc định (đen)
        $this->SetTextColor(0, 0, 0);
        $this->Ln(10);
        $this->Cell(80);
        $this->SetFont('Arial', 'B', 12);
        $this->Cell(30, 40, 'BEP AN TAP DOAN DOANH NGHIEP ONEKILL', 0, 0, 'C');
        $this->Ln(10);
        $this->Cell(80);
        $this->SetFont('Arial', '', 10);
        $this->Cell(30, 30, '12 Nguyen Van Bao, Phuong 4, Go Vap, TP.HCM', 0, 0, 'C');
        $this->Ln(10);
        $this->Cell(80);
        $this->Cell(30, 17, 'Ma so thue: 123456789', 0, 0, 'C');
        $this->Ln(10);
        $this->Cell(80);
        $this->Cell(30, 4, 'email: onekill@gmail.com', 0, 0, 'C');
        $this->Ln(10);
        $this->Cell(80);
        $this->Cell(30, -8, 'Hotline: 0123456789', 0, 0, 'C');
        $this->Ln(10);
    }

    // Page footer
    function Footer()
    {
        $this->SetY(-15);
        $this->SetFont('Arial', 'I', 8);
        $this->Cell(0, 10, 'Page ' . $this->PageNo(), 0, 0, 'C');
    }
}

// Create PDF object
$pdf = new PDF();

// Add a page
$pdf->AddPage();
$pdf->SetLeftMargin(20);
$pdf->SetRightMargin(20);
// Set font
$pdf->AddFont('DejaVu', '', 'DejaVuSansCondensed.ttf', true);
$pdf->SetFont('DejaVu', '', 15);


// // Output order information

$pdf->SetFont('Arial', 'BI', 15);

$pdf->Cell(0, 10, 'THONG TIN HOA DON', 0, 1, 'C');

$pdf->SetFont('DejaVu', '', 12);

$pdf->Cell(80, 10, 'Tên khách hàng: ', 0, 0);
$pdf->Cell(50);
$tenKhachHang =  $pay[0]['hoTen'];
$pdf->Cell(0, 10, "$tenKhachHang", 0, 1);

$maDonHang =  $pay[0]['idThanhToan'];

$pdf->Cell(80, 0, 'Mã Đơn hàng: ', 0, 0);
$pdf->Cell(50);
$pdf->Cell(0, 0, "$maDonHang", 0, 1);

$pdf->Cell(80, 10, 'Ngày giờ:', 0, 0);
$pdf->Cell(50);




$ngayGio = date("H:i:s d/m/Y", strtotime( $pay[0]['ngayThanhToan']));

$pdf->Cell(80, 10, "$ngayGio", 0, 1);

// // Output order items

for ($i = 0; $i < count($pay); $i++) {
    $tenMon = $pay[$i]['tenMon'];
    $soLuong = $pay[$i]['soLuong'];
    $gia = $pay[$i]['gia'];
    $tong = $soLuong * $gia;
    $soTien =$pay[$i]['soTien'];

    $gia = currency_format($gia);
    $tong = currency_format($tong);
    $soTien = currency_format($soTien);

    $pdf->Cell(0, 10, "$tenMon:", 0, 1);
    $pdf->Cell(80, 0, "$soLuong x $gia", 0, 0);
    $pdf->Cell(50);
    $pdf->Cell(0, 00, "$tong", 0, 1);
    $pdf->Ln(4);
}

// // Add more order items as needed

// // Output total
$pdf->Line(10, $pdf->GetY(), 190, $pdf->GetY());


$pdf->Cell(80, 10, 'Tổng cộng:', 0, 0);
$pdf->Cell(50);
$pdf->Cell(0, 10, "$soTien", 0, 1);


// // Thank you message
$pdf->Cell(0, 10, 'Cảm ơn quý khách', 0, 1, 'C');
$pdf->Cell(0, 10, 'Hẹn gặp lại', 0, 1, 'C');

// // Additional information
$pdf->Cell(0, 10, 'Phiếu tính tiền chỉ có giá trị trong ngày', 0, 1, 'C');

// // Output barcode
$pdf->SetFont('Arial', 'B', 15);
$pdf->Cell(0, 10, '||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||', 0, 0, 'C');

$pdf->Ln(8);



$pdf->Cell(0, 10, '076627010000012000138123111111000033838392', 0, 1, 'C');

// Output to browser
$pdf->Output();


// echo count($pay);
// echo "<pre>";
// print_r($pay);
