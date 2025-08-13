<?php
/**
 * Partial template for displaying source metadata.
 *
 * @package ehri_training
 */

$source = $args['source'];

// Performance optimization: Get all metadata in a single query instead of 9 separate queries.
$source_meta = get_term_meta( $source->term_id );

$location        = $source_meta['term_location'][0] ?? '';
$source_file     = $source_meta['term_source_file'][0] ?? '';
$source_name     = $source_meta['term_source_name'][0] ?? '';
$source_url      = $source_meta['term_source_url'][0] ?? '';
$image           = $source_meta['term_feature_image'][0] ?? '';
$translation     = $source_meta['term_translation_file'][0] ?? '';
$transcript      = $source_meta['term_transcription_file'][0] ?? '';
$collection_name = $source_meta['term_collection_name'][0] ?? '';
$collection_url  = $source_meta['term_collection_url'][0] ?? '';
?>

<div class="source-description">
	<?php echo wp_kses_post( $source->description ); ?>
</div>
<?php if ( $location ) : ?>
	<div class="source-location">
		<h3 class="field-label"><?php esc_html_e( 'Location' ); ?></h3>
		<?php echo esc_html( $location ); ?>
	</div>
<?php endif; ?>

<?php if ( $source_file ) : ?>
	<div class="source-file">
		<h3 class="field-label"><?php esc_html_e( 'Source' ); ?></h3>
		<div class="file-ref">
			<img alt="PDF File Icon"
				src="<?php echo esc_url( get_template_directory_uri() . '/images/application-pdf.png' ); ?>"
				class="file-icon">
			<a href="<?php echo esc_url( wp_get_attachment_url( $source_file ) ); ?>" target="_blank">
				<?php echo esc_html( get_the_title( $source_file ) ); ?>
			</a>
		</div>
	</div>
<?php endif; ?>

<?php if ( $source_name || $source_url ) : ?>
	<div class="source-text">
		<h3 class="field-label"><?php esc_html_e( 'Source' ); ?></h3>
		<?php if ( $source_url ) : ?>
			<a href="<?php echo esc_url( $source_url ); ?>" target="_blank">
				<?php echo esc_html( $source_name ? $source_name : $source_url ); ?>
			</a>
		<?php else : ?>
			<?php echo esc_html( $source_name ); ?>
		<?php endif; ?>
	</div>
<?php endif; ?>

<?php if ( $image ) : ?>
	<div class="source-featured-image">
		<h3 class="field-label"><?php esc_html_e( 'Image' ); ?></h3>
		<a href="<?php echo esc_url( wp_get_attachment_url( $image ) ); ?>" target="_blank">
				<img src="<?php echo esc_url( wp_get_attachment_image_url( $image ) ); ?>"
				alt="Featured image for <?php echo esc_html( $source->name ); ?>">
		</a>
	</div>
<?php endif; ?>

<?php if ( $translation ) : ?>
	<div class="source-file">
		<h3 class="field-label"><?php esc_html_e( 'Translation' ); ?></h3>
		<div class="file-ref">
			<img alt="PDF File Icon"
				src="<?php echo esc_url( get_template_directory_uri() . '/images/application-pdf.png' ); ?>"
				class="file-icon">
			<a href="<?php echo esc_url( wp_get_attachment_url( $translation ) ); ?>" target="_blank">
				<?php echo esc_html( get_the_title( $translation ) ); ?>
			</a>
		</div>
	</div>
<?php endif; ?>

<?php if ( $transcript ) : ?>
	<div class="source-file">
		<h3 class="field-label"><?php esc_html_e( 'Transcript' ); ?></h3>
		<div class="file-ref">
			<img alt="PDF File Icon"
				src="<?php echo esc_url( get_template_directory_uri() . '/images/application-pdf.png' ); ?>"
				class="file-icon">
			<a href="<?php echo esc_url( wp_get_attachment_url( $transcript ) ); ?>" target="_blank">
				<?php echo esc_html( get_the_title( $transcript ) ); ?>
			</a>
		</div>
	</div>
<?php endif; ?>

<?php if ( $collection_name || $collection_url ) : ?>
	<div class="source-collection">
		<h3 class="field-label"><?php esc_html_e( 'Collection' ); ?></h3>
		<?php if ( $collection_url ) : ?>
			<a href="<?php echo esc_url( $collection_url ); ?>" target="_blank">
				<?php echo esc_html( $collection_name ? $collection_name : $collection_url ); ?>
			</a>
		<?php else : ?>
			<?php echo esc_html( $collection_name ); ?>
		<?php endif; ?>
	</div>
<?php endif; ?>
