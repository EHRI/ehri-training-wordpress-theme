<?php
?>

<div class="social">
    <div class="follow-buttons">
        <?php if ($facebook_url = get_theme_mod('ehrieric_facebook_url')): ?>
        <a href="<?php echo $facebook_url; ?>" target="_blank">
            <i title="Facebook" class="fa-brands fa-2x fa-fw fa-facebook-f"></i>
        </a>
        <?php endif; ?>

        <?php if ($twitter_url = get_theme_mod('ehrieric_twitter_url')): ?>
        <a href="<?php echo $twitter_url; ?>" target="_blank">
            <i title="X (formerly Twitter)" class="fa-brands fa-2x fa-fw fa-x-twitter"></i>
        </a>
        <?php endif; ?>

        <?php if ($linkedin_url = get_theme_mod('ehrieric_linkedin_url')): ?>
        <a href="<?php echo $linkedin_url; ?>" target="_blank">
            <i title="LinkedIn" class="fa-brands fa-2x fa-fw fa-linkedin"></i>
        </a>
        <?php endif; ?>
    </div>
</div>

