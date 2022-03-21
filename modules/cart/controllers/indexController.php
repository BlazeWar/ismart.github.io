<?php

function construct()
{
    //    echo "DÙng chung, load đầu tiên";
    load_model('index');
}

function showAction()
{
    load('helper', 'format');
    $list_buy = get_list_buy_cart();
    $data['list_buy'] = $list_buy;
    // show_array($_POST);
    if (isset($_POST['btn_update_cart'])) {
        update_cart($_POST['qty']);
        redirect("?mod=cart&action=show");
    }
    load_view('show', $data);
}

function checkoutAction()
{
    load('helper', 'format');
    $list_buy = get_list_buy_cart();
    $data['list_buy'] = $list_buy;
    load_view('checkout', $data);
}

function addAction()
{
    $id = (int)$_GET['id'];
    add_cart($id);
    redirect('?mod=cart&action=show');
}
function updateAction()
{
}
function deleteAction()
{
    $id = (int)$_GET['id'];
    delete_cart($id);
    redirect('?mod=cart&action=show');
}
function delete_allAction()
{
    delete_all();
    redirect("?mod=cart&action=show");
}
function updateajaxAction()
{
    // $id = $_POST['id'];
    // $qty = $_POST['qty'];
    // // Lấy thông tin sản phẩm
    // $item = get_product_by_id($id);

    // if (isset($_SESSION['cart']) && array_key_exists($id, $_SESSION['cart']['buy'])) {
    //     # Cập nhật số lượng
    //     $_SESSION['cart']['buy'][$id]['qty'] = $qty;
    //     # Cập nhật tổng tiền
    //     $sub_total = $qty * $item['price'];
    //     $_SESSION['cart']['buy'][$id]['sub_total'] = $sub_total;
    //     # Cập nhật toàn bộ giỏ hàng
    //     update_info_cart();
    //     # Lấy tổng giá trị trong giỏ hàng
    //     $total = get_total_cart();


    //     # Giá trị trả về
    //     $data = array(
    //         'sub_total' => currency_format($sub_total),
    //         'total' => currency_format($total),
    //     );

    //     echo json_encode($data);
    // }
}
