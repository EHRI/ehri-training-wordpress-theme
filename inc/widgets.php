<?php
/**
 * EHRI custom widgets.
 *
 * @package ehri_training
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

if ( ! function_exists( 'ehri_training_add_unit_chapter_meta_box' ) ) {
	/**
	 * Add a meta box to posts and pages for setting chapter letter.
	 *
	 * @return void
	 */
	function ehri_training_add_unit_chapter_meta_box() {
		$screens = array( 'post', 'page' );
		foreach ( $screens as $screen ) {
			add_meta_box(
				'unit_chapter',                        // Unique ID.
				'Unit Chapter',                       // Box title.
				'ehri_training_unit_chapter_html', // Content callback, must be of type callable.
				$screen,                                   // Post type.
				'side'                              // Position.
			);
		}
	}
}
add_action( 'add_meta_boxes', 'ehri_training_add_unit_chapter_meta_box' );

// Meta box HTML.
if ( ! function_exists( 'ehri_training_unit_chapter_html' ) ) {
	/**
	 * Render the HTML for the unit chapter meta box.
	 *
	 * @param WP_Post $post The post object.
	 */
	function ehri_training_unit_chapter_html( $post ) {
		$value = get_post_meta( $post->ID, '_unit_chapter', true );
		?>
		<?php wp_nonce_field( 'ehri_training_unit_chapter_nonce', 'unit_chapter_nonce' ); ?>
		<label for="unit_chapter">
			<input type="text" pattern="[a-z]" maxlength="1" id="unit_chapter" name="unit_chapter"
				   value="<?php echo esc_attr( $value ); ?>"/>
		</label>
		<p class="components-form-token-field__help">Fill in the number of the chapter if applicable. This should be a
			letter (a,b,c,d,e,f...)</p>
		<?php
	}
}

if ( ! function_exists( 'ehri_training_save_unit_chapter_meta' ) ) {
	/**
	 * Save the sort order meta box data.
	 *
	 * @param int $post_id The ID of the post being saved.
	 */
	function ehri_training_save_unit_chapter_meta( $post_id ) {
		// Check if nonce field exists before validating.
		if ( ! isset( $_POST['unit_chapter_nonce'] ) ) {
			return $post_id; // Meta box not present, skip validation.
		}

		// Now validate the nonce.
		$nonce = sanitize_text_field( wp_unslash( $_POST['unit_chapter_nonce'] ) );
		if ( ! wp_verify_nonce( $nonce, 'ehri_training_unit_chapter_nonce' ) ) {
			return $post_id; // Invalid nonce.
		}

		// Check user capabilities.
		if ( ! current_user_can( 'edit_post', $post_id ) ) {
			return $post_id;
		}

		if ( array_key_exists( 'unit_chapter', $_POST ) && '' !== $_POST['unit_chapter'] ) {
			update_post_meta(
				$post_id,
				'_unit_chapter',
				wp_unslash( $_POST['unit_chapter'] )
			);
		} else {
			delete_post_meta( $post_id, '_unit_chapter' );
		}
	}
}

add_action( 'save_post', 'ehri_training_save_unit_chapter_meta' );


if ( ! function_exists( 'ehri_training_add_sort_order_meta_box' ) ) {
	/**
	 * Add a meta box to posts and pages for setting sort order.
	 *
	 * @return void
	 */
	function ehri_training_add_sort_order_meta_box() {
		$screens = array( 'post', 'page' );
		foreach ( $screens as $screen ) {
			add_meta_box(
				'sort_order',                        // Unique ID.
				'Sort Order',                       // Box title.
				'ehri_training_sort_order_html', // Content callback, must be of type callable.
				$screen,                                 // Post type.
				'side'                            // Position.
			);
		}
	}
}
add_action( 'add_meta_boxes', 'ehri_training_add_sort_order_meta_box' );

// Meta box HTML.
if ( ! function_exists( 'ehri_training_sort_order_html' ) ) {
	/**
	 * Render the HTML for the sort order meta box.
	 *
	 * @param WP_Post $post The post object.
	 */
	function ehri_training_sort_order_html( $post ) {
		$value = get_post_meta( $post->ID, '_sort_order', true );
		?>
		<?php wp_nonce_field( 'ehri_training_sort_order_nonce', 'sort_order_nonce' ); ?>
		<label for="sort_order">
			<input type="number" id="sort_order" name="sort_order" min="1" max="20"
				   value="<?php echo esc_attr( $value ); ?>"/>
		</label>
		<p class="components-form-token-field__help">Indicate the order of chapters in the table of contents and on the
			unit pages. You can use numbers between 1 and 20.</p>
		<?php
	}
}

if ( ! function_exists( 'ehri_training_save_sort_order_meta' ) ) {
	/**
	 * Save the sort order meta box data.
	 *
	 * @param int $post_id The ID of the post being saved.
	 */
	function ehri_training_save_sort_order_meta( $post_id ) {
		// Check if nonce field exists before validating.
		if ( ! isset( $_POST['sort_order_nonce'] ) ) {
			return $post_id; // Meta box not present, skip validation.
		}

		// Now validate the nonce.
		$nonce = sanitize_text_field( wp_unslash( $_POST['sort_order_nonce'] ) );
		if ( ! wp_verify_nonce( $nonce, 'ehri_training_sort_order_nonce' ) ) {
			return $post_id; // Invalid nonce.
		}

		// Check user capabilities.
		if ( ! current_user_can( 'edit_post', $post_id ) ) {
			return $post_id;
		}

		if ( array_key_exists( 'sort_order', $_POST ) && '' !== $_POST['sort_order'] ) {
			update_post_meta(
				$post_id,
				'_sort_order',
				wp_unslash( intval( $_POST['sort_order'] ) )
			);
		} else {
			delete_post_meta( $post_id, '_sort_order' );
		}
	}
}

add_action( 'save_post', 'ehri_training_save_sort_order_meta' );


if ( ! function_exists( 'ehri_training_add_next_chapter_meta_box' ) ) {
	/**
	 * Add a meta box to posts and pages for setting next chapter.
	 *
	 * @return void
	 */
	function ehri_training_add_next_chapter_meta_box() {
		$screens = array( 'post', 'page' );
		foreach ( $screens as $screen ) {
			add_meta_box(
				'next_chapter',                        // Unique ID.
				'Next Chapter',                       // Box title.
				'ehri_training_next_chapter_html', // Content callback, must be of type callable.
				$screen,                                 // Post type.
				'side'                            // Position.
			);
		}
	}
}
add_action( 'add_meta_boxes', 'ehri_training_add_next_chapter_meta_box' );


if ( ! function_exists( 'ehri_training_next_chapter_html' ) ) {
	/**
	 * Render the HTML for the next chapter meta box.
	 *
	 * @param WP_Post $post The post object.
	 */
	function ehri_training_next_chapter_html( $post ) {
		$value = get_post_meta( $post->ID, '_next_chapter', true );
		?>
		<?php wp_nonce_field( 'ehri_training_next_chapter_nonce', 'next_chapter_nonce' ); ?>
		<label for="next_chapter" class="sr-only"><?php echo __( 'Next Chapter' ); ?></label>
		<select name="next_chapter" id="next_chapter">
		<option value=""><?php echo esc_html__( 'Select next chapter', 'ehri-training' ); ?></option>
		<?php
		// Get all posts of type 'post' to select the next chapter.
		$posts = get_posts(
			array(
				'post_type'      => 'post',
				'posts_per_page' => - 1,
				'post_status'    => 'publish',
				'orderby'        => 'title',
				'order'          => 'ASC',
			)
		);
		foreach ( $posts as $p ) {
			printf(
				'<option value="%d" %s>%s</option>',
				$p->ID,
				selected( $value, $p->ID, false ),
				esc_html( $p->post_title )
			);
		}
		?>
		<p class="components-form-token-field__help">Select the next chapter.</p>
		<?php
	}
}

if ( ! function_exists( 'ehri_training_save_next_chapter_meta' ) ) {
	/**
	 * Save the sort order meta box data.
	 *
	 * @param int $post_id The ID of the post being saved.
	 */
	function ehri_training_save_next_chapter_meta( $post_id ) {
		// Check if nonce field exists before validating.
		if ( ! isset( $_POST['next_chapter_nonce'] ) ) {
			return $post_id; // Meta box not present, skip validation.
		}

		// Now validate the nonce.
		$nonce = sanitize_text_field( wp_unslash( $_POST['next_chapter_nonce'] ) );
		if ( ! wp_verify_nonce( $nonce, 'ehri_training_next_chapter_nonce' ) ) {
			return $post_id; // Invalid nonce.
		}

		// Check user capabilities.
		if ( ! current_user_can( 'edit_post', $post_id ) ) {
			return $post_id;
		}

		if ( array_key_exists( 'next_chapter', $_POST ) && '' !== $_POST['next_chapter'] ) {
			update_post_meta(
				$post_id,
				'_next_chapter',
				wp_unslash( intval( $_POST['next_chapter'] ) )
			);
		} else {
			delete_post_meta( $post_id, '_next_chapter' );
		}
	}
}

add_action( 'save_post', 'ehri_training_save_next_chapter_meta' );

