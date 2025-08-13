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
		$term_id                    = $term ? $term->term_id : 0;
		$term_unit                  = $term_id ? get_term_meta( $term_id, 'term_unit', true ) : '';
		$term_teaser                = $term_id ? get_term_meta( $term_id, 'term_teaser', true ) : '';
		$term_source_file_id        = $term_id ? get_term_meta( $term_id, 'term_source_file', true ) : '';
		$term_source_name           = $term_id ? get_term_meta( $term_id, 'term_source_name', true ) : '';
		$term_source_url            = $term_id ? get_term_meta( $term_id, 'term_source_url', true ) : '';
		$term_feature_image_id      = $term_id ? get_term_meta( $term_id, 'term_feature_image', true ) : '';
		$term_translation_file_id   = $term_id ? get_term_meta( $term_id, 'term_translation_file', true ) : '';
		$term_transcription_file_id = $term_id ? get_term_meta( $term_id, 'term_transcription_file', true ) : '';
		$term_location              = $term_id ? get_term_meta( $term_id, 'term_location', true ) : '';
		$term_collection_name       = $term_id ? get_term_meta( $term_id, 'term_collection_name', true ) : '';
		$term_collection_url        = $term_id ? get_term_meta( $term_id, 'term_collection_url', true ) : '';
		?>

		<?php echo wp_nonce_field( 'ehri_training_source_metadata_nonce', 'ehri_training_source_metadata_nonce', true, false ); ?>

		<tr class="form-field">
			<th scope="row"><label for="term_unit"><?php _e( 'Unit' ); ?></label></th>
			<td>
				<select name="term_unit" id="term_unit">
					<option value=""><?php _e( 'Select Unit' ); ?></option>
					<?php
					$units = get_terms( array(
						'taxonomy' => 'unit'
					) );
					foreach ( $units as $unit ) {
						echo '<option value="' . esc_attr( $unit->slug ) . '" ' .
							 selected( $term_unit, $unit->slug, false ) . '>' .
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
			<th scope="row"><label for="term_source_file"><?php _e( 'Source (PDF)' ); ?></label></th>
			<td>
				<input type="hidden" name="term_source_file" id="term_source_file"
					   value="<?php echo esc_attr( $term_source_file_id ); ?>">
				<div id="term_source_file_wrapper">
					<?php if ( $term_source_file_id ) : ?>
						<img alt="PDF File Icon"
							 src="<?php echo esc_url( get_template_directory_uri() . '/images/application-pdf.png' ); ?>"
							 class="file-icon">
						<?php echo esc_html( get_the_title( $term_source_file_id ) ); ?>
					<?php endif; ?>
				</div>
				<p>
					<input type="button" class="button button-secondary" id="term_source_file_button"
						   value="<?php _e( 'Select File' ); ?>"/>
					<input type="button" class="button button-secondary" id="term_source_file_remove"
						   value="<?php _e( 'Remove File' ); ?>"/>
				</p>
			</td>
		</tr>

		<tr class="form-field">
			<th scope="row"><label for="term_source_name"><?php _e( 'Source Name' ); ?></label></th>
			<td>
				<input type="text" name="term_source_name" id="term_source_name"
					   value="<?php echo esc_attr( $term_source_name ); ?>" class="regular-text">
				<p class="description"><?php _e( 'Enter the name of the source.' ); ?></p>
			</td>
		</tr>

		<tr class="form-field">
			<th scope="row"><label for="term_source_url"><?php _e( 'Source URL' ); ?></label></th>
			<td>
				<input type="url" name="term_source_url" id="term_source_url"
					   value="<?php echo esc_url( $term_source_url ); ?>" class="regular-text">
				<p class="description"><?php _e( 'Enter the URL of the source.' ); ?></p>
			</td>
		</tr>


		<tr class="form-field">
			<th scope="row"><label for="term_collection_name"><?php _e( 'Collection Name' ); ?></label></th>
			<td>
				<input type="text" name="term_collection_name" id="term_collection_name"
					   value="<?php echo esc_attr( $term_collection_name ); ?>" class="regular-text">
				<p class="description"><?php _e( 'Enter the name of the collection.' ); ?></p>
			</td>
		</tr>

		<tr class="form-field">
			<th scope="row"><label for="term_collection_url"><?php _e( 'Collection URL' ); ?></label></th>
			<td>
				<input type="url" name="term_collection_url" id="term_collection_url"
					   value="<?php echo esc_url( $term_collection_url ); ?>" class="regular-text">
				<p class="description"><?php _e( 'Enter the URL of the collection.' ); ?></p>
			</td>
		</tr>

		<tr class="form-field">
			<th scope="row"><label for="term_feature_image"><?php _e( 'Image' ); ?></label></th>
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
			<th scope="row"><label for="term_translation_file"><?php _e( 'English Translation (PDF)' ); ?></label></th>
			<td>
				<input type="hidden" name="term_translation_file" id="term_translation_file"
					   value="<?php echo esc_attr( $term_translation_file_id ); ?>">
				<div id="term_translation_file_wrapper">
					<?php if ( $term_translation_file_id ) : ?>
						<img alt="PDF File Icon"
							 src="<?php echo esc_url( get_template_directory_uri() . '/images/application-pdf.png' ); ?>"
							 class="file-icon">
						<?php echo esc_html( get_the_title( $term_translation_file_id ) ); ?>
					<?php endif; ?>
				</div>
				<p>
					<input type="button" class="button button-secondary" id="term_translation_file_button"
						   value="<?php _e( 'Select File' ); ?>"/>
					<input type="button" class="button button-secondary" id="term_translation_file_remove"
						   value="<?php _e( 'Remove File' ); ?>"/>
				</p>
			</td>
		</tr>

		<tr class="form-field">
			<th scope="row"><label for="term_transcription_file"><?php _e( 'Transcription (PDF)' ); ?></label></th>
			<td>
				<input type="hidden" name="term_transcription_file" id="term_transcription_file"
					   value="<?php echo esc_attr( $term_transcription_file_id ); ?>">
				<div id="term_transcription_file_wrapper">
					<?php if ( $term_transcription_file_id ) : ?>
						<img alt="PDF File Icon"
							 src="<?php echo esc_url( get_template_directory_uri() . '/images/application-pdf.png' ); ?>"
							 class="file-icon">
						<?php echo esc_html( get_the_title( $term_transcription_file_id ) ); ?>
					<?php endif; ?>
				</div>
				<p>
					<input type="button" class="button button-secondary" id="term_transcription_file_button"
						   value="<?php _e( 'Select File' ); ?>"/>
					<input type="button" class="button button-secondary" id="term_transcription_file_remove"
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

		// Check nonce is set and valid
		if ( ! isset( $_POST['ehri_training_source_metadata_nonce'] ) ||
			 ! wp_verify_nonce( sanitize_text_field( wp_unslash( $_POST['ehri_training_source_metadata_nonce'] ) ), 'ehri_training_source_metadata_nonce' ) ) {
			return $term_id;
		}

		// Check user capabilities
		if ( ! current_user_can( 'edit_term', $term_id, 'source' ) ) {
			return $term_id;
		}

		if ( isset( $_POST['term_unit'] ) ) {
			update_term_meta(
				$term_id,
				'term_unit',
				sanitize_text_field( $_POST['term_unit'] )
			);
		} else {
			delete_term_meta( $term_id, 'term_unit' );
		}

		if ( isset( $_POST['term_location'] ) ) {
			update_term_meta(
				$term_id,
				'term_location',
				sanitize_text_field( $_POST['term_location'] )
			);
		} else {
			delete_term_meta( $term_id, 'term_location' );
		}

		if ( isset( $_POST['term_source_file'] ) ) {
			update_term_meta(
				$term_id,
				'term_source_file',
				$_POST['term_source_file']
			);
		} else {
			delete_term_meta( $term_id, 'term_source_file' );
		}

		if ( isset( $_POST['term_source_name'] ) ) {
			update_term_meta(
				$term_id,
				'term_source_name',
				sanitize_text_field( $_POST['term_source_name'] )
			);
		}

		if ( isset( $_POST['term_source_url'] ) ) {
			update_term_meta(
				$term_id,
				'term_source_url',
				sanitize_url( $_POST['term_source_url'] )
			);
		} else {
			delete_term_meta( $term_id, 'term_source_url' );
		}

		if ( isset( $_POST['term_collection_name'] ) ) {
			update_term_meta(
				$term_id,
				'term_collection_name',
				sanitize_text_field( $_POST['term_collection_name'] )
			);
		} else {
			delete_term_meta( $term_id, 'term_collection_name' );
		}

		if ( isset( $_POST['term_collection_url'] ) ) {
			update_term_meta(
				$term_id,
				'term_collection_url',
				sanitize_url( $_POST['term_collection_url'] )
			);
		} else {
			delete_term_meta( $term_id, 'term_collection_url' );
		}

		if ( isset( $_POST['term_teaser'] ) ) {
			update_term_meta(
				$term_id,
				'term_teaser',
				sanitize_textarea_field( $_POST['term_teaser'] )
			);
		} else {
			delete_term_meta( $term_id, 'term_teaser' );
		}

		if ( isset( $_POST['term_feature_image'] ) ) {
			update_term_meta(
				$term_id,
				'term_feature_image',
				$_POST['term_feature_image']
			);
		} else {
			delete_term_meta( $term_id, 'term_feature_image' );
		}

		if ( isset( $_POST['term_translation_file'] ) ) {
			update_term_meta(
				$term_id,
				'term_translation_file',
				$_POST['term_translation_file']
			);
		} else {
			delete_term_meta( $term_id, 'term_translation_file' );
		}

		if ( isset( $_POST['term_transcription_file'] ) ) {
			update_term_meta(
				$term_id,
				'term_transcription_file',
				$_POST['term_transcription_file']
			);
		} else {
			delete_term_meta( $term_id, 'term_transcription_file' );
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

		wp_localize_script(
			'term-metadata-js',
			'SourceMetadata',
			array(
				'pdfIconUrl' => get_template_directory_uri() . '/images/application-pdf.png',
			)
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
