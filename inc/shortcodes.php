<?php
/**
 * Shortcodes for the EHRI Training theme.
 *
 * @package ehri_training
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

if ( ! function_exists( 'ehri_training_source_shortcode' ) ) {
	/**
	 * Shortcode to display a source with a title and content, given
	 * the source slug, e.g. [source slug="example-source"].
	 *
	 * @param array $atts Shortcode attributes.
	 *
	 * @return string HTML output of the source.
	 */
	function ehri_training_source_shortcode( $atts ): string {
		$atts = shortcode_atts(
			array(
				'slug' => '',
			),
			$atts,
			'source'
		);

		if ( empty( $atts['slug'] ) ) {
			return '<p>' . esc_html__( 'No source slug provided.', 'ehri_training' ) . '</p>';
		}

		$source = get_term_by( 'slug', $atts['slug'], 'source' );

		if ( ! $source ) {
			return '<p>' . esc_html__( 'Source not found.', 'ehri_training' ) . '</p>';
		}

		ob_start();
		// Render all the relevant source info: title, description, location, links etc:
		?>
		<div class="source-shortcode-wrapper">
			<details class="source-shortcode-info">
				<summary>
					<div class="source-icon">
						<img src="<?php echo esc_url( get_template_directory_uri() . '/images/doc.svg' ); ?>"
							 alt="<?php echo esc_attr( $source->name ); ?> Icon">
					</div>
					<?php $image = get_term_meta( $source->term_id, "term_feature_image", true ); ?>
					<?php if ( $image ): ?>
						<div class="source-featured-image">
							<h3 class="field-label"><?php esc_html_e( 'Image' ); ?></h3>
							<img src="<?php echo wp_get_attachment_image_url( $image, 'large' ); ?>"
								 alt="Featured image for <?php echo esc_html( $source->name ); ?>">
						</div>
					<?php endif; ?>
					<h2 class="source-title">
						<?php echo esc_html( $source->name ); ?>
					</h2>
					<?php $teaser = get_term_meta( $source->term_id, 'term_teaser', true ); ?>
					<?php if ( $teaser ): ?>
						<p class="source-teaser"><?php echo esc_html( $teaser ); ?></p>
					<?php endif; ?>
				</summary>

				<div class="source-shortcode-details">
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
								<a href="<?php echo esc_url( wp_get_attachment_url( $source_file ) ); ?>"
								   target="_blank">
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

					<?php $translation = get_term_meta( $source->term_id, "term_translation_file", true ); ?>
					<?php if ( $translation ): ?>
						<div class="source-file">
							<h3 class="field-label"><?php esc_html_e( 'Translation' ); ?></h3>
							<div class="file-ref">
								<img alt="PDF File Icon"
									 src="<?php echo esc_url( get_template_directory_uri() . '/images/application-pdf.png' ); ?>"
									 class="file-icon">
								<a href="<?php echo esc_url( wp_get_attachment_url( $translation ) ); ?>"
								   target="_blank">
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
								<a href="<?php echo esc_url( wp_get_attachment_url( $transcript ) ); ?>"
								   target="_blank">
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
				</div>
			</details>
		</div>
		<?php
		return ob_get_clean();
	}
}

add_shortcode( 'source', 'ehri_training_source_shortcode' );
