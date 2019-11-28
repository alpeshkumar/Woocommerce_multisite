<?php
/**
 * Template part for displaying page content in page.php
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package multisite_Ab
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

    <?php ecommerce_gem_post_thumbnail(); ?>

    <div class="content-wrap">

        <div class="content-wrap-inner">

            <header class="entry-header">
                <?php
				$current_page_id = get_the_ID();
				if (!is_user_logged_in())
				{
					$page_title_align = get_post_meta($current_page_id, 'page_title_align', true);
					
					the_title('<h1 class="entry-title '. $page_title_align .'">', '</h1>');
				}
				else
				{
					the_title('<h1 class="entry-title">', '</h1>');
				}					
				?>
            </header><!-- .entry-header -->

            <div class="entry-content">
                <?php
                the_content(sprintf(
                                /* translators: %s: Name of current post. */
                                wp_kses(esc_html__('Continue reading %s <span class="meta-nav">&rarr;</span>', 'woocommerce-multisite'), array('span' => array('class' => array()))), the_title('<span class="screen-reader-text">"', '"</span>', false)
                ));

                wp_link_pages(array(
                    'before' => '<div class="page-links">' . esc_html__('Pages:', 'woocommerce-multisite'),
                    'after' => '</div>',
                ));
                ?>
            </div><!-- .entry-content -->

            <?php if (get_edit_post_link()) : ?>
                <footer class="entry-footer">
                    <?php
                    edit_post_link(
                            sprintf(
                                    /* translators: %s: Name of current post */
                                    esc_html__('Edit %s', 'woocommerce-multisite'), the_title('<span class="screen-reader-text">"', '"</span>', false)
                            ), '<span class="edit-link">', '</span>'
                    );
                    ?>
                </footer><!-- .entry-footer -->
            <?php endif; ?>

        </div>

    </div>

</article><!-- #post-## -->