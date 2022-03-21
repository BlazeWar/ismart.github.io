<?php

function get_list_product()
{
    $result = db_fetch_array("SELECT * FROM `list_product`");

    return $result;
}

function get_product_by_id($id)
{
    $item = db_fetch_row("SELECT * FROM `list_product` WHERE `id` = {$id}");
    $item['url_add_cart'] = "?mod=cart&action=add&id={$id}";
    $item['url'] = "?mod=category&action=detail&id={$id}";
    return $item;
}
function get_product_by_cat_id($cat_id)
{
    $result = db_fetch_array("SELECT * FROM `list_product` WHERE `cat_id` = {$cat_id}");
    $item_detail = array(); //Mảng chứa danh sách sản phẩm theo cat_id     
    foreach ($result as $value) {        
        if ($value['cat_id'] == $cat_id) {
            $value['url_add_cart'] = "?mod=cart&action=add&id={$value['id']}";
            $value['url'] = "?mod=category&action=detail&id={$value['id']}";
            $item_detail[] = $value;
        }
    }
    return $item_detail;
}
function get_info_cat($cat_id)
{
    $result = db_fetch_array("SELECT * FROM `list_product_cat`");

    $t = $cat_id - 1;
    if (array_key_exists($t, $result)) {

        $result[$t]['url'] = "?mod=category&cat_id={$cat_id}";
        // show_array ($result[$t]);
        return $result[$t];
    }

    return FALSE;
}
