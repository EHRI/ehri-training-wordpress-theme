<?php

$source = $args['source']; ?>

<div class="source-description">
	<?php echo $source->description; ?>
</div>

<?php $location = get_term_meta( $source->term_id, 'term_location', true ); ?>
<?php if ( $location ): ?>
	<div class="source-location">
		<h3 class="field-label"><?php esc_html_e( 'Location' ); ?></h3>
		<?php echo esc_html( $location ); ?>
	</div>
<?php endif; ?>

<?php $source_file = get_term_meta( $source->term_id, "term_source_file", true ); ?>
<?php if ( $source_file ): ?>
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

<?php $source_name = get_term_meta( $source->term_id, 'term_source_name', true ); ?>
<?php $source_url = get_term_meta( $source->term_id, 'term_source_url', true ); ?>
<?php if ( $source_name || $source_url ): ?>
	<div class="source-text">
		<h3 class="field-label"><?php esc_html_e( 'Source' ); ?></h3>
		<?php if ( $source_url ): ?>
			<a href="<?php echo esc_url( $source_url ); ?>" target="_blank">
				<?php echo esc_html( $source_name ?: $source_url ); ?>
			</a>
		<?php else: ?>
			<?php echo esc_html( $source_name ); ?>
		<?php endif; ?>
	</div>
<?php endif; ?>

<?php $image = get_term_meta( $source->term_id, "term_feature_image", true ); ?>
<?php if ( $image ): ?>
	<div class="source-featured-image">
		<h3 class="field-label"><?php esc_html_e( 'Image' ); ?></h3>
		<a href="<?php echo esc_url( wp_get_attachment_url( $image ) ); ?>" target="_blank">
			<img src="<?php echo wp_get_attachment_image_url( $image ); ?>"
				 alt="Featured image for <?php echo esc_html( $source->name ); ?>">
		</a>
	</div>
<?php endif; ?>

<?php $translation = get_term_meta( $source->term_id, "term_translation_file", true ); ?>
<?php if ( $translation ): ?>
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

<?php $transcript = get_term_meta( $source->term_id, "term_transcription_file", true ); ?>
<?php if ( $transcript ): ?>
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

<?php $collection_name = get_term_meta( $source->term_id, 'term_collection_name', true ); ?>
<?php $collection_url = get_term_meta( $source->term_id, 'term_collection_url', true ); ?>
<?php if ( $collection_name || $collection_url ): ?>
	<div class="source-collection">
		<h3 class="field-label"><?php esc_html_e( 'Collection' ); ?></h3>
		<?php if ( $collection_url ): ?>
			<a href="<?php echo esc_url( $collection_url ); ?>" target="_blank">
				<?php echo esc_html( $collection_name ?: $collection_url ); ?>
			</a>
		<?php else: ?>
			<?php echo esc_html( $collection_name ); ?>
		<?php endif; ?>
	</div>
<?php endif; ?>

