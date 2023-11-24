<?php
/**
 * The template for displaying the footer.
 */
?>

<footer id="footer" class="region region-footer">
    <!-- Render the menus -->
    <?php wp_nav_menu(array(
        'menu' => 'secondary-menu',
        'theme_location' => 'primary',
        'container' => 'nav',
        'menu_class' => 'menu',
        'menu_id' => 'secondary-menu',
        'fallback_cb' => false
    )); ?>

    <div class="funding">
        <a href="http://europa.eu/" target="_blank">EHRI is funded by the European Union</a>
    </div>

    <div class="ars">
        <a href="http://prix2018.aec.at/prixwinner/28933/" target="_blank">
            <img alt="Ars Electronica" width="200" height="100" src="<?php echo get_theme_file_uri('images/ars_logo_cropped.jpg'); ?>"/>
        </a>
    </div>
</footer>

</div> <!-- /#page -->

<?php wp_footer(); ?>
<script>
  // Toggle menu class on body when #menubutton is clicked
  document.getElementById('menubutton').addEventListener('click', function () {
    document.body.classList.toggle('menu');
  });

</script>
</body>
</html>
