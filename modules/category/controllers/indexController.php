<?php

function construct()
{
    //    echo "DÙng chung, load đầu tiên";
    load_model('index');
}

function indexAction()
{
    load('helper', 'format');
    if (empty($_GET['cat_id'])) {
        $_GET['cat_id'] = "";
    } else {
        $cat_id = (int)$_GET['cat_id'];
    }
    if (empty($cat_id)) {
        $list_mobile = get_product_by_cat_id(1);
        $list_laptop = get_product_by_cat_id(2);

        $info_cat_mobile = get_info_cat(1);
        $info_cat_laptop = get_info_cat(2);
        $data = array(
            'list_mobile' => $list_mobile,
            'list_laptop' => $list_laptop,
            'info_cat_mobile' => $info_cat_mobile,
            'info_cat_laptop' => $info_cat_laptop,
        );
        load_view('index', $data);
    } else {
        # Lấy thông tin của danh mục        
        $info_cat = get_info_cat($cat_id);
        $list_product = get_product_by_cat_id($cat_id);
        
        // echo ($cat_id);
        // show_array($info_cat);
        $data['list_product'] = $list_product;
        $data['info_cat'] = $info_cat;
        load_view('main', $data);
    }
}

function detailAction()
{
    load('helper', 'format');

    $id = (int)$_GET['id'];
    # Lấy sản phẩm theo id

    $item = get_product_by_id($id);
    $data['item'] = $item;

    load_view('detail', $data);
}

function newsAction()
{
    load_view('news');
}
