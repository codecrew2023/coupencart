<?php
$cartsy_lite_read_more_text = esc_html__('Read More', 'cartsy-lite');
$cartsy_lite_thumbnailUrl = get_the_post_thumbnail_url();

$cartsy_lite_class = "";

if ($cartsy_lite_thumbnailUrl) {
    $cartsy_lite_class = "cartsylite_has_post_thumb";
} else {
    $cartsy_lite_class = "cartsylite_no_post_thumb";
}

$cartsy_lite_has_post_format = has_post_format(["status", "link", "quote", "chat"]);

?>

<article id="post-<?php the_ID(); ?>" <?php post_class($cartsy_lite_class); ?> <?php if ($cartsy_lite_has_post_format && $cartsy_lite_thumbnailUrl) { ?> style="background-image: url(<?php echo esc_url($cartsy_lite_thumbnailUrl); ?>)" <?php } ?>>
    <?php if (!$cartsy_lite_has_post_format) { ?>
        <?php if (has_post_thumbnail()) : ?>
            <div class="entry-media">
                <a href="<?php echo esc_url(get_permalink()); ?>" rel="bookmark">
                    <?php 
                    if (function_exists('cartsy_lite_post_thumbnail')) {
                        cartsy_lite_post_thumbnail(); 
                    }
                    ?>
                </a>
            </div>
            <!-- .entry-media -->
        <?php endif; ?>

        <header class="entry-header">
            <div class="entry-meta">
                <?php
                cartsy_lite_post_meta();
                if (get_post_type() === 'post') {
                    if (function_exists('cartsy_lite_post_category')) {
                        cartsy_lite_post_category();
                    }
                }
                ?>
            </div>
            <!-- .entry-meta -->
            <?php
            the_title('<h2 class="entry-title"><a href="' . esc_url(get_permalink()) . '" rel="bookmark">', '</a></h2>');
            ?>
        </header>
        <!-- .entry-header -->
        <?php if (!empty(get_the_excerpt())) { ?>
        <div class="entry-content">
            <?php
            the_excerpt();
            ?>
        </div>
        <!-- .entry-content -->
        <?php } ?>
        <footer class="entry-footer">
            <a class="cartsylite-read-more" href="<?php echo esc_url(get_permalink()); ?>">
                <?php echo wp_kses_post($cartsy_lite_read_more_text); ?>
            </a>
        </footer>
        <!-- .entry-footer -->
    <?php } else { ?>
        <a class="cartsylite_blog_post_link" href="<?php echo esc_url(get_permalink()); ?>" rel="bookmark"></a>
        <?php
        the_title('<h2 class="entry-title">', '</h2>');
        ?>
        
        <?php if (has_post_format("status")) { ?>
            <i class="dashicons dashicons-media-document"></i>
        <?php } elseif (has_post_format("link")) { ?>
            <i class="dashicons dashicons-admin-links"></i>
        <?php } elseif (has_post_format("quote")) { ?>
            <i class="dashicons dashicons-format-quote"></i>
        <?php } elseif (has_post_format("chat")) { ?>
            <i class="dashicons dashicons-format-chat"></i>
        <?php } else { ?>
            <i class="dashicons dashicons-media-document"></i>
        <?php } ?>
    <?php } ?>
</article><!-- #post-<?php the_ID(); ?> -->