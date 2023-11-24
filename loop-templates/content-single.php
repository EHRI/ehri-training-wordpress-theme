<?php
/**
 * Single post partial template.
 *
 * @package understrap
 */

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}
?>


<h1 class="post-title" id="page-title"><?php the_title(); ?></h1>

<?php if (has_post_thumbnail()): ?>
    <picture class="featured-image">
        <?php the_post_thumbnail('large'); ?>
    </picture>
<?php endif; ?>

<?php if (has_category('news')) : ?>
    <div class="field field-name-field-datum">
        <span class="date-display-single">
            <?php echo get_the_date('l, F jS, Y'); ?>
        </span>
    </div>
<?php endif; ?>

<div class="post-body">
    <?php the_content(); ?>
</div>
