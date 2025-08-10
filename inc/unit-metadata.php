<?php
/**
 * Add custom metadata fields to taxonomy terms
 */


// Add the form fields for term editing
if ( ! function_exists( "ehri_training_render_unit_metadata_fields" ) ) {
	function ehri_training_render_unit_metadata_fields( $term = null ) {
		$term_id               = $term ? $term->term_id : 0;
		$term_teaser           = $term_id ? get_term_meta( $term_id, 'term_teaser', true ) : '';
		$term_feature_image_id = $term_id ? get_term_meta( $term_id, 'term_feature_image', true ) : '';
		?>
		<?php echo wp_nonce_field( 'ehri_training_unit_metadata_nonce', 'ehri_training_unit_metadata_nonce', true, false ); ?>

		<tr class="form-field">
			<th scope="row"><label for="term_teaser"><?php _e( 'Teaser' ); ?></label></th>
			<td>
            <textarea name="term_teaser" id="term_teaser" rows="5"
					  cols="50"><?php echo esc_textarea( $term_teaser ); ?></textarea>
				<p class="description"><?php _e( 'Enter a brief teaser for this term.' ); ?></p>
			</td>
		</tr>

		<tr class="form-field">
			<th scope="row"><label for="term_feature_image"><?php _e( 'Feature Image' ); ?></label></th>
			<td>
				<input type="hidden" name="term_feature_image" id="term_feature_image"
					   value="<?php echo esc_attr( $term_feature_image_id ); ?>">
				<div id="term_feature_image_wrapper">
					<?php if ( $term_feature_image_id ) : ?>
						<img alt="Featured Image"
							 src="<?php echo wp_get_attachment_image_url( $term_feature_image_id, 'medium' ); ?>"
							 style="max-width:300px;height:auto;">
					<?php endif; ?>
				</div>
				<p>
					<input type="button" class="button button-secondary" id="term_feature_image_button"
						   value="<?php _e( 'Select Image' ); ?>"/>
					<input type="button" class="button button-secondary" id="term_feature_image_remove"
						   value="<?php _e( 'Remove Image' ); ?>"/>
				</p>
			</td>
		</tr>
		<?php
	}
}

// Save the term metadata
if ( ! function_exists( "ehri_training_save_unit_metadata" ) ) {
	function ehri_training_save_unit_metadata( $term_id ) {
		// Check nonce is set and valid
		if ( ! isset( $_POST['ehri_training_unit_metadata_nonce'] ) ||
			 ! wp_verify_nonce( sanitize_text_field( wp_unslash( $_POST['ehri_training_unit_metadata_nonce'] ) ), 'ehri_training_unit_metadata_nonce' ) ) {
			return $term_id;
		}

		// Check user capabilities
		if ( ! current_user_can( 'edit_term', $term_id, 'source' ) ) {
			return $term_id;
		}

		if ( isset( $_POST['term_teaser'] ) ) {
			update_term_meta(
				$term_id,
				'term_teaser',
				sanitize_textarea_field( $_POST['term_teaser'] )
			);
		}

		if ( isset( $_POST['term_feature_image'] ) ) {
			update_term_meta(
				$term_id,
				'term_feature_image',
				$_POST['term_feature_image']
			);
		}
	}
}

// Enqueue necessary scripts
if ( ! function_exists( "ehri_training_enqueue_unit_metadata_scripts" ) ) {
	function ehri_training_enqueue_unit_metadata_scripts() {
		if ( ! did_action( 'wp_enqueue_media' ) ) {
			wp_enqueue_media();
		}

		wp_enqueue_script(
			'term-metadata-js',
			get_template_directory_uri() . '/js/term-metadata.js',
			array( 'jquery' ),
			'1.0.0',
			true
		);
	}
}

// Hook everything up
if ( ! function_exists( "ehri_training_init_unit_metadata" ) ) {
	function ehri_training_init_unit_metadata() {
		add_action( "unit_add_form_fields", 'ehri_training_render_unit_metadata_fields' );
		add_action( "unit_edit_form_fields", 'ehri_training_render_unit_metadata_fields' );
		add_action( "created_unit", 'ehri_training_save_unit_metadata' );
		add_action( "edited_unit", 'ehri_training_save_unit_metadata' );
		add_action( 'admin_enqueue_scripts', 'ehri_training_enqueue_unit_metadata_scripts' );
	}
}

add_action( 'init', 'ehri_training_init_unit_metadata' );
