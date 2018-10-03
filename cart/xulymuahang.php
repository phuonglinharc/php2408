<?php
session_start();
// session_destroy();
include 'sanpham.php';
include 'helper.php';

$id = $_POST['id'];

$sp = searchProduct($id,$arrSP); // [] || boolean
$_SESSION['cart'] = isset($_SESSION['cart']) ? $_SESSION['cart'] : [];
    // if(!isset($_SESSION['cart'])) 
    //     $_SESSION['cart']  = [];
if($sp){
    if(array_key_exists($id,$_SESSION['cart'])){
        $_SESSION['cart'][$id]['soluong'] = $_SESSION['cart'][$id]['soluong']  + 1;
    }
    else{
        $sp['soluong'] = 1;
        $_SESSION['cart'][$id] = $sp;
    }
    
    $total = 0;
    foreach($_SESSION['cart'] as $sp){
        $total +=$sp['soluong'];
    }

    echo json_encode([
        'code'=>1,
        'data'=>[
            'total'=>$total,
            'view'=>callView()
        ],
        'message'=>'Them thanh cong'
    ]);
}
else{
    echo json_encode([
        'code'=>0,
        'data'=>'',
        'message'=>'Khong tim thay sp'
    ]);
}


?>