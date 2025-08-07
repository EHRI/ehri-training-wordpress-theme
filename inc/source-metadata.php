<?php
/**
 * Add custom metadata fields to taxonomy terms
 */

if ( ! function_exists( "ehri_training_render_source_metadata_fields" ) ) {
	/**
	 * Render source metadata fields.
	 *
	 * @param WP_Term|null $term The term being edited (null for new terms)
	 */
	function ehri_training_render_source_metadata_fields( $term = null ) {
		$term_id               = $term ? $term->term_id : 0;
		$term_unit             = $term_id ? get_term_meta( $term_id, 'term_unit', true ) : '';
		$term_teaser           = $term_id ? get_term_meta( $term_id, 'term_teaser', true ) : '';
		$term_feature_image_id = $term_id ? get_term_meta( $term_id, 'term_feature_image', true ) : '';
		$term_file_1_id        = $term_id ? get_term_meta( $term_id, 'term_file_1', true ) : '';
		$term_file_2_id        = $term_id ? get_term_meta( $term_id, 'term_file_2', true ) : '';
		$term_location         = $term_id ? get_term_meta( $term_id, 'term_location', true ) : '';
		$term_collection_name  = $term_id ? get_term_meta( $term_id, 'term_collection_name', true ) : '';
		$term_collection_url   = $term_id ? get_term_meta( $term_id, 'term_collection_url', true ) : '';
		?>
		<tr class="form-field">
			<th scope="row"><label for="term_unit"><?php _e( 'Unit' ); ?></label></th>
			<td>
				<select name="term_unit" id="term_unit">
					<option value=""><?php _e( 'Select Unit' ); ?></option>
					<?php
					$units = get_terms( array(
						'taxonomy'   => 'unit',
						'hide_empty' => false,
					) );
					foreach ( $units as $unit ) {
						echo '<option value="' . esc_attr( $unit->term_id ) . '" ' .
							 selected( $term_unit, $unit->term_id, false ) . '>' .
							 esc_html( $unit->name ) . '</option>';
					}
					?>
				</select>
				<p class="description"><?php _e( 'Select the unit this source belongs to.' ); ?></p>
			</td>
		</tr>

		<tr class="form-field">
			<th scope="row"><label for="term_teaser"><?php _e( 'Short Description' ); ?></label></th>
			<td>
				<textarea name="term_teaser" id="term_teaser" rows="5"
						  cols="50"><?php echo esc_textarea( $term_teaser ); ?></textarea>
				<p class="description"><?php _e( 'Enter a short description for this source.' ); ?></p>
			</td>
		</tr>

		<tr class="form-field">
			<th scope="row"><label for="term_location"><?php _e( 'Location' ); ?></label></th>
			<td>
				<input type="text" name="term_location" id="term_location"
					   value="<?php echo esc_attr( $term_location ); ?>" class="regular-text">
				<p class="description"><?php _e( 'Enter the location of this source.' ); ?></p>
			</td>
		</tr>

		<tr class="form-field">
			<th scope="row"><label for="term_collection_name"><?php _e( 'Collection Name' ); ?></label></th>
			<td>
				<input type="text" name="term_collection_name" id="term_collection_name"
					   value="<?php echo esc_attr( $term_collection_name ); ?>" class="regular-text">
				<p class="description"><?php _e( 'Enter the name of the source collection.' ); ?></p>
			</td>
		</tr>

		<tr class="form-field">
			<th scope="row"><label for="term_collection_url"><?php _e( 'Collection URL' ); ?></label></th>
			<td>
				<input type="url" name="term_collection_url" id="term_collection_url"
					   value="<?php echo esc_url( $term_collection_url ); ?>" class="regular-text">
				<p class="description"><?php _e( 'Enter the URL of the source collection.' ); ?></p>
			</td>
		</tr>

		<tr class="form-field">
			<th scope="row"><label for="term_feature_image"><?php _e( 'Scan Image' ); ?></label></th>
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

		<tr class="form-field">
			<th scope="row"><label for="term_file_1"><?php _e( 'Source File' ); ?></label></th>
			<td>
				<input type="hidden" name="term_file_1" id="term_file_1"
					   value="<?php echo esc_attr( $term_file_1_id ); ?>">
				<div id="term_file_1_wrapper">
					<?php if ( $term_file_1_id ) : ?>
						<?php echo esc_html( get_the_title( $term_file_1_id ) ); ?>
					<?php endif; ?>
				</div>
				<p>
					<input type="button" class="button button-secondary" id="term_file_1_button"
						   value="<?php _e( 'Select File' ); ?>"/>
					<input type="button" class="button button-secondary" id="term_file_1_remove"
						   value="<?php _e( 'Remove File' ); ?>"/>
				</p>
			</td>
		</tr>

		<tr class="form-field">
			<th scope="row"><label for="term_file_2"><?php _e( 'Source Translation' ); ?></label></th>
			<td>
				<input type="hidden" name="term_file_2" id="term_file_2"
					   value="<?php echo esc_attr( $term_file_2_id ); ?>">
				<div id="term_file_2_wrapper">
					<?php if ( $term_file_2_id ) : ?>
						<?php echo esc_html( get_the_title( $term_file_2_id ) ); ?>
					<?php endif; ?>
				</div>
				<p>
					<input type="button" class="button button-secondary" id="term_file_2_button"
						   value="<?php _e( 'Select File' ); ?>"/>
					<input type="button" class="button button-secondary" id="term_file_2_remove"
						   value="<?php _e( 'Remove File' ); ?>"/>
				</p>
			</td>
		</tr>
		<?php
	}
}


if ( ! function_exists( "ehri_training_save_source_metadata" ) ) {
	/**
	 * Save the term metadata
	 *
	 * @param int $term_id The ID of the term being saved.
	 */
	function ehri_training_save_source_metadata( $term_id ) {
		if ( isset( $_POST['term_unit'] ) ) {
			update_term_meta(
				$term_id,
				'term_unit',
				sanitize_text_field( $_POST['term_unit'] )
			);
		}

		if ( isset( $_POST['term_location'] ) ) {
			update_term_meta(
				$term_id,
				'term_location',
				sanitize_text_field( $_POST['term_location'] )
			);
		}

		if ( isset( $_POST['term_collection_name'] ) ) {
			update_term_meta(
				$term_id,
				'term_collection_name',
				sanitize_text_field( $_POST['term_collection_name'] )
			);
		}

		if ( isset( $_POST['term_collection_url'] ) ) {
			update_term_meta(
				$term_id,
				'term_collection_url',
				sanitize_url( $_POST['term_collection_url'] )
			);
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

		if ( isset( $_POST['term_file_1'] ) ) {
			update_term_meta(
				$term_id,
				'term_file_1',
				$_POST['term_file_1']
			);
		}

		if ( isset( $_POST['term_file_2'] ) ) {
			update_term_meta(
				$term_id,
				'term_file_2',
				$_POST['term_file_2']
			);
		}
	}
}

// Enqueue necessary scripts
if ( ! function_exists( "ehri_training_enqueue_source_metadata_scripts" ) ) {
	function ehri_training_enqueue_source_metadata_scripts() {
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
if ( ! function_exists( "ehri_training_init_source_metadata" ) ) {
	function ehri_training_init_source_metadata() {
		add_action( "source_add_form_fields", 'ehri_training_render_source_metadata_fields' );
		add_action( "source_edit_form_fields", 'ehri_training_render_source_metadata_fields' );
		add_action( "created_source", 'ehri_training_save_source_metadata' );
		add_action( "edited_source", 'ehri_training_save_source_metadata' );
		add_action( 'admin_enqueue_scripts', 'ehri_training_enqueue_source_metadata_scripts' );
	}
}

add_action( 'init', 'ehri_training_init_source_metadata' );
