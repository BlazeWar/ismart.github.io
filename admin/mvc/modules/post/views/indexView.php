<?php
// show_array($list_post);
get_header();
?>
<div id="content">
    <h1>Tin tức</h1>
    <?php if (!empty($list_post)) {
    ?>
        <ul class="list-post">
            <?php
            foreach ($list_post as $item) {
            ?>
                <li>
                    <a href="" class="post-title"><?php echo $item['post_title'] ?></a>
                    <p class="post-desc"><?php echo $item['post_desc'] ?></p>
                </li>
            <?php }
            ?>
        </ul>
    <?php }
    ?>
</div>
<?php
get_footer();
?>