<?php
get_header()
?>
<div id="main-content-wp" class="home-page clearfix">
    <div class="wp-inner">
        <div class="main-content fl-right">
            <div class="section" id="slider-wp">
                <div class="section-detail">
                    <div class="item">
                        <img src="public/images/slider-01.png" alt="">
                    </div>
                    <div class="item">
                        <img src="public/images/slider-02.png" alt="">
                    </div>
                    <div class="item">
                        <img src="public/images/slider-03.png" alt="">
                    </div>
                </div>
            </div>
            <div class="section" id="support-wp">
                <div class="section-detail">
                    <ul class="list-item clearfix">
                        <li>
                            <div class="thumb">
                                <img src="public/images/icon-1.png">
                            </div>
                            <h3 class="title">Miễn phí vận chuyển</h3>
                            <p class="desc">Tới tận tay khách hàng</p>
                        </li>
                        <li>
                            <div class="thumb">
                                <img src="public/images/icon-2.png">
                            </div>
                            <h3 class="title">Tư vấn 24/7</h3>
                            <p class="desc">1900.9999</p>
                        </li>
                        <li>
                            <div class="thumb">
                                <img src="public/images/icon-3.png">
                            </div>
                            <h3 class="title">Tiết kiệm hơn</h3>
                            <p class="desc">Với nhiều ưu đãi cực lớn</p>
                        </li>
                        <li>
                            <div class="thumb">
                                <img src="public/images/icon-4.png">
                            </div>
                            <h3 class="title">Thanh toán nhanh</h3>
                            <p class="desc">Hỗ trợ nhiều hình thức</p>
                        </li>
                        <li>
                            <div class="thumb">
                                <img src="public/images/icon-5.png">
                            </div>
                            <h3 class="title">Đặt hàng online</h3>
                            <p class="desc">Thao tác đơn giản</p>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="section" id="feature-product-wp">
                <div class="section-head">
                    <h3 class="section-title">Sản phẩm nổi bật</h3>
                </div>
                <div class="section-detail">
                    <?php if (!empty($list_product)) {
                    ?>
                        <ul class="list-item">
                            <?php foreach ($list_product as $item) {
                            ?>
                                <li>
                                    <a href="<?php echo $item['url'] ?>" title="" class="thumb">
                                        <img src="<?php echo $item['product_thumb'] ?>">
                                    </a>
                                    <a href="<?php echo $item['url'] ?>" title="" class="product-name"><?php echo $item['product_title'] ?></a>
                                    <div class="price">
                                        <span class="new"><?php echo currency_format($item['price']) ?></span>
                                        <span class="old"><?php echo currency_format($item['old_price']) ?></span>
                                    </div>
                                    <div class="action clearfix">
                                        <a href="<?php echo $item['url_add_cart'] ?>" title="" class="add-cart fl-left">Thêm giỏ hàng</a>
                                        <a href="?mod=cart&action=checkout" title="" class="buy-now fl-right">Mua ngay</a>
                                    </div>
                                </li>
                            <?php
                            } ?>
                        </ul>
                    <?php
                    } ?>
                </div>
            </div>
            <div class="section" id="list-product-wp">
                <div class="section-head">
                    <h3 class="section-title fl-left"><?php echo $info_cat_mobile['cat_title'] ?></h3>
                    <div class="filter-wp fl-right">
                        <p class="desc">Hiện có <?php echo count($list_mobile) ?> sản phẩm</p>
                        <div class="form-filter">
                            <form method="POST" action="">
                                <select name="select">
                                    <option value="0">Sắp xếp</option>
                                    <option value="1">Từ A-Z</option>
                                    <option value="2">Từ Z-A</option>
                                    <option value="3">Giá cao xuống thấp</option>
                                    <option value="3">Giá thấp lên cao</option>
                                </select>
                                <button type="submit">Lọc</button>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="section-detail">
                    <?php if (!empty($list_mobile)) {
                    ?>
                        <ul class="list-item clearfix">
                            <?php foreach ($list_mobile as $item) {
                            ?>
                                <li>
                                    <a href="<?php echo $item['url'] ?>" title="" class="thumb">
                                        <img src="<?php echo $item['product_thumb'] ?>">
                                    </a>
                                    <a href="<?php echo $item['url'] ?>" title="" class="product-name"><?php echo $item['product_title'] ?></a>
                                    <div class="price">
                                        <span class="new"><?php echo currency_format($item['price']) ?></span>
                                        <span class="old"><?php echo currency_format($item['old_price']) ?></span>
                                    </div>
                                    <div class="action clearfix">
                                        <a href="<?php echo $item['url_add_cart'] ?>" title="Thêm giỏ hàng" class="add-cart fl-left">Thêm giỏ hàng</a>
                                        <a href="?mod=cart&action=checkout" title="Mua ngay" class="buy-now fl-right">Mua ngay</a>
                                    </div>
                                </li>
                            <?php
                            } ?>
                        </ul>
                    <?php
                    } ?>
                </div>
                <div class="section-head clearfix">
                    <h3 class="section-title fl-left"><?php echo $info_cat_laptop['cat_title'] ?></h3>
                    <div class="filter-wp fl-right">
                        <p class="desc">Hiện có <?php echo count($list_laptop) ?> sản phẩm</p>
                        <div class="form-filter">
                            <form method="POST" action="">
                                <select name="select">
                                    <option value="0">Sắp xếp</option>
                                    <option value="1">Từ A-Z</option>
                                    <option value="2">Từ Z-A</option>
                                    <option value="3">Giá cao xuống thấp</option>
                                    <option value="3">Giá thấp lên cao</option>
                                </select>
                                <button type="submit">Lọc</button>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="section-detail">
                    <?php if (!empty($list_laptop)) {
                    ?>
                        <ul class="list-item clearfix">
                            <?php foreach ($list_laptop as $item) {
                            ?>
                                <li>
                                    <a href="<?php echo $item['url'] ?>" title="" class="thumb">
                                        <img src="<?php echo $item['product_thumb'] ?>">
                                    </a>
                                    <a href="<?php echo $item['url'] ?>" title="" class="product-name"><?php echo $item['product_title'] ?></a>
                                    <div class="price">
                                        <span class="new"><?php echo currency_format($item['price']) ?></span>
                                        <span class="old"><?php echo currency_format($item['old_price']) ?></span>
                                    </div>
                                    <div class="action clearfix">
                                        <a href="<?php echo $item['url_add_cart'] ?>" title="Thêm giỏ hàng" class="add-cart fl-left">Thêm giỏ hàng</a>
                                        <a href="?mod=cart&action=checkout" title="Mua ngay" class="buy-now fl-right">Mua ngay</a>
                                    </div>
                                </li>
                            <?php
                            } ?>
                        </ul>
                    <?php
                    } ?>
                </div>
            </div>
        </div>
        <!-- End-content -->
        <?php
        get_sidebar();
        ?>
    </div>
</div>
<?php
get_footer()
?>