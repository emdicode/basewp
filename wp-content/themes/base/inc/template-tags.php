<?php

if (!function_exists('base_posted_on')):
    function base_posted_on()
    {
        $timeString = '<time class="entry-date published updated">%2$s</time>';
        if (get_the_time('U') !== get_the_modified_time('U')) {
            $timeString = '<time class="entry-date published">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';
        }

        $timeString = sprintf($timeString,
            esc_attr(get_the_time(DATE_W3C)),
            esc_html(get_the_date()),
            esc_attr(get_the_modified_date(DATE_W3C)),
            esc_html(get_the_modified_date())
        );

        $postedOn = sprintf(
            esc_html_x('Posted on %s', 'post date', 'base'),
            '<a href="' . esc_url(get_permalink()) . '" rel="bookmark">' . $timeString . '</a>'
        );

        echo '<span class="posted-on">' . $postedOn . '</span>';
    }
endif;

if (!function_exists('base_posted_by')):
    function base_posted_by()
    {
        $byLine = sprintf(
            esc_html_x('by %s', 'post author', 'base'),
            '<span class="author vcard"><a class="url fn n" href="' . esc_url(get_author_posts_url(get_the_author_meta('ID'))) . '">' . esc_html(get_the_author()) . '</a></span>'
        );

        echo '<span class="">' . $byLine . '</span>';
    }
endif;

if ( ! function_exists( 'base_entry_footer' ) ) :
    /**
     * Prints HTML with meta information for the categories, tags and comments.
     */
    function base_entry_footer() {
        // Hide category and tag text for pages.
        if ( 'post' === get_post_type() ) {
            /* translators: used between list items, there is a space after the comma */
            $categories_list = get_the_category_list( esc_html__( ', ', 'base' ) );
            if ( $categories_list ) {
                /* translators: 1: list of categories. */
                printf( '<p class="cat-links">' . esc_html__( 'Posted in %1$s', 'base' ) . '</p>', $categories_list ); // WPCS: XSS OK.
            }

            /* translators: used between list items, there is a space after the comma */
            $tags_list = get_the_tag_list( '', esc_html_x( ', ', 'list item separator', 'base' ) );
            if ( $tags_list ) {
                /* translators: 1: list of tags. */
                printf( '<p class="tags-links">' . esc_html__( 'Tagged %1$s', 'base' ) . '</p>', $tags_list ); // WPCS: XSS OK.
            }
        }

        if ( ! is_single() && ! post_password_required() && ( comments_open() || get_comments_number() ) ) {
            echo '<p class="comments-link">';
            comments_popup_link(
                sprintf(
                    wp_kses(
                    /* translators: %s: post title */
                        __( 'Leave a Comment<span class="screen-reader-text"> on %s</span>', 'base' ),
                        array(
                            'span' => array(
                                'class' => array(),
                            ),
                        )
                    ),
                    get_the_title()
                )
            );
            echo '</p>';
        }

        edit_post_link(
            sprintf(
                wp_kses(
                /* translators: %s: Name of current post. Only visible to screen readers */
                    __( 'Edit <span class="screen-reader-text">%s</span>', 'base' ),
                    array(
                        'span' => array(
                            'class' => array(),
                        ),
                    )
                ),
                get_the_title()
            ),
            '<p class="edit-link">',
            '</p>'
        );
    }
endif;

if ( ! function_exists( 'base_post_thumbnail' ) ) :
    /**
     * Displays an optional post thumbnail.
     *
     * Wraps the post thumbnail in an anchor element on index views, or a div
     * element when on single views.
     */
    function base_post_thumbnail() {
        if ( post_password_required() || is_attachment() || ! has_post_thumbnail() ) {
            return;
        }

        if ( is_singular() ) :
            ?>

            <div class="post-thumbnail">
                <?php the_post_thumbnail(); ?>
            </div><!-- .post-thumbnail -->

        <?php else : ?>

            <a class="post-thumbnail" href="<?php the_permalink(); ?>" aria-hidden="true" tabindex="-1">
                <?php
                the_post_thumbnail( 'post-thumbnail', array(
                    'alt' => the_title_attribute( array(
                        'echo' => false,
                    ) ),
                ) );
                ?>
            </a>

        <?php
        endif; // End is_singular().
    }
endif;
