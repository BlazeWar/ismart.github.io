<?php

function construct()
{
    //    echo "DÙng chung, load đầu tiên";
    load_model('index');
}

function indexAction()
{
    load('helper', 'format');
    $list_mobile = get_product_by_cat_id(1);
    $list_laptop = get_product_by_cat_id(2);

    $info_cat_mobile = get_info_cat(1);
    $info_cat_laptop = get_info_cat(2);
    $list_product = get_list_product();
    // show_array($list_url_add_cart);
    $data = array(
        'list_product' => $list_product,
        'list_mobile' => $list_mobile,
        'list_laptop' => $list_laptop,
        'info_cat_mobile' => $info_cat_mobile,
        'info_cat_laptop' => $info_cat_laptop,
    );
    load_view('index', $data);
}

function addAction()
{
    echo "Thêm dữ liệu";
}

function editAction()
{
}
