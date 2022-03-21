<?php
function get_product_by_id($id)
{
    $item = db_fetch_row("SELECT * FROM `list_product` WHERE `id` = {$id}");
    $item['url_add_cart'] = "?mod=cart&action=add&id={$id}";
    $item['url'] = "?mod=category&action=detail&id={$id}";
    return $item;
}
function add_cart($id)
{

    $item = get_product_by_id($id);

    #Thêm thông tin vào giỏ hàng

    $qty = 1;
    if (isset($_SESSION['cart']) && array_key_exists($id, $_SESSION['cart']['buy'])) {
        $qty = $_SESSION['cart']['buy'][$id]['qty'] + 1;
    }

    $_SESSION['cart']['buy'][$id] = array(
        'id' => $item['id'],
        'url' => $item['url'],
        'product_title' => $item['product_title'],
        'price' => $item['price'],
        'product_thumb' => $item['product_thumb'],
        'code' => $item['code'],
        'qty' => $qty,
        'sub_total' => $item['price'] * $qty,
    );
    // Cập nhật hóa đơn
    update_info_cart($id);
}
function update_info_cart()
{
    if (isset($_SESSION['cart'])) {
        $num_order = 0;
        $total = 0;
        foreach ($_SESSION['cart']['buy'] as $item) {
            $num_order += $item['qty'];
            $total += $item['sub_total'];
        }

        $_SESSION['cart']['info'] = array(
            'num_order' => $num_order,
            'total' => $total,
        );
    }
}
function get_list_buy_cart()
{
    if (isset($_SESSION['cart'])) {
        foreach ($_SESSION['cart']['buy'] as $item) {
            $item['url_delete_cart'] = "?mod=cart&action=delete&id={$item['id']}";
            $_SESSION['cart']['buy'][$item['id']] = $item;
        }

        return $_SESSION['cart']['buy'];
    }
    return FALSE;
}

function get_num_order_cart()
{
    if (isset($_SESSION['cart'])) {
        return $_SESSION['cart']['info']['num_order'];
    }
    return FALSE;
}

function get_total_cart()
{
    if (isset($_SESSION['cart'])) {
        return $_SESSION['cart']['info']['total'];
    }
    return FALSE;
}

function delete_cart($id)
{
    if (isset($_SESSION['cart'])) {
        # Xóa sản phẩm có $id trong giỏ hàng
        unset($_SESSION['cart']['buy'][$id]);
        update_info_cart();
    }
}
function delete_all()
{
    if (isset($_SESSION['cart'])) {
        # Xóa tất cả sản phẩm trong giỏ hàng

        unset($_SESSION['cart']);
    }
}

function update_cart($qty)
{
    

    foreach ($qty as $id => $new_qty) {

        $_SESSION['cart']['buy'][$id]['qty'] = $new_qty;
        $_SESSION['cart']['buy'][$id]['sub_total'] = $new_qty * $_SESSION['cart']['buy'][$id]['price'];
    }
    update_info_cart();
}
