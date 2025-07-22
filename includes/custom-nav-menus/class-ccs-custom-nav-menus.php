<?php
/**
 * Custom Nav Menus class.
 *
 * @package    WordPress
 * @subpackage cheleyCamps
 * @since      cheleyCamps 1.0
 */

/**
 * Class used to implement custom "mega" nav menus.
 */
class CCS_Custom_Nav_Menus {
	/**
	 * Where this code is being run from.
	 *
	 * @var string
	 */
	private $snippet_url;

	/**
	 * Filename of the default template this class should use to display.
	 *
	 * @var string
	 */
	private $default_template = 'template.php';

	/**
	 * Constructor.
	 *
	 * Sets up defaults for custom menus as well as defines various actions and filters.
	 */
	public function __construct() {
		global $pagenow;

		// Figure out current file URL so this snippet can be placed and included anywhere.
		$file = __FILE__;

		// Get correct URL and path to wp-content.
		$content_url = untrailingslashit( dirname( dirname( get_stylesheet_directory_uri() ) ) );
		$content_dir = untrailingslashit( dirname( dirname( get_stylesheet_directory() ) ) );

		// Fix path on Windows.
		$file        = str_replace( '\\', '/', $file );
		$content_dir = str_replace( '\\', '/', $content_dir );
		$url         = str_replace( $content_dir, $content_url, $file );
		$url         = str_replace( basename( $file ), '', $url );

		$this->snippet_url = $url;

		// Styles/scripts.
		if ( 'nav-menus.php' === $pagenow ) {
			add_action( 'admin_enqueue_scripts', array( $this, 'enqueue_scripts' ) );
		}

		// Register custom actions/filters.
		add_action( 'init', array( $this, 'register_cpt' ) );
		add_action( 'admin_init', array( $this, 'add_metabox' ) );
		add_action( 'wp_ajax_ccs_custom_nav_menus', array( $this, 'ajax_callback' ) );
		add_action( 'save_post_ccs_custom_menu_item', array( $this, 'menu_item_template_save' ), 20, 3 );

		// ACF location for custom menu item.
		add_filter( 'acf/location/rule_types', array( $this, 'acf_location_rule' ) );
		add_filter( 'acf/location/rule_values/ccs_menu_item_template', array( $this, 'acf_location_rule_values' ) );
		add_filter( 'acf/location/rule_match/ccs_menu_item_template', array( $this, 'acf_location_rule_matcher' ), 10, 3 );
	}

	/**
	 * Add scripts and styles required by the custom menus interface.
	 */
	public function enqueue_scripts() {
		wp_enqueue_script(
			'ccs-custom-nav-menus-script',
			$this->snippet_url . 'scripts/script.js',
			array( 'jquery' ),
			'1.0',
			true
		);

		wp_localize_script(
			'ccs-custom-nav-menus-script',
			'NMAS',
			array(
				'ajaxUrl' => admin_url( 'admin-ajax.php' ),
				'nonce'   => wp_create_nonce( 'custom_nav_menus_ajax' ),
			)
		);

		wp_enqueue_style(
			'ccs-custom-nav-menus-style',
			$this->snippet_url . 'dist/style.css',
			array(),
			'1.0'
		);
	}

	/**
	 * Register custom post type representing the custom menu item
	 */
	public function register_cpt() {
		$labels = array(
			'name'               => _x( 'Custom Menu Items', 'post type general name', 'themeName-admin' ),
			'singular_name'      => _x( 'Custom Menu Item', 'post type singular name', 'themeName-admin' ),
			'menu_name'          => _x( 'Custom Menu Items', 'admin menu', 'themeName-admin' ),
			'name_admin_bar'     => _x( 'Custom Menu Item', 'add new on admin bar', 'themeName-admin' ),
			'add_new'            => _x( 'Add New', 'custom menu item', 'themeName-admin' ),
			'add_new_item'       => __( 'Add New Custom Menu Item', 'themeName-admin' ),
			'new_item'           => __( 'New Custom Menu Item', 'themeName-admin' ),
			'edit_item'          => __( 'Edit Custom Menu Item', 'themeName-admin' ),
			'view_item'          => __( 'View Custom Menu Item', 'themeName-admin' ),
			'all_items'          => __( 'All Custom Menu Items', 'themeName-admin' ),
			'search_items'       => __( 'Search Custom Menu Items', 'themeName-admin' ),
			'parent_item_colon'  => __( 'Parent Custom Menu Items:', 'themeName-admin' ),
			'not_found'          => __( 'No custom menu items found.', 'themeName-admin' ),
			'not_found_in_trash' => __( 'No custom menu items found in Trash.', 'themeName-admin' ),
		);

		$args = array(
			'labels'             => $labels,
			'public'             => false,
			'publicly_queryable' => false,
			'show_ui'            => true,
			'show_in_menu'       => true,
			'query_var'          => true,
			'rewrite'            => array( 'slug' => 'custom-menu-item' ),
			'capability_type'    => 'post',
			'has_archive'        => true,
			'hierarchical'       => false,
			'menu_position'      => null,
			'menu_icon'          => 'dashicons-menu',
			'supports'           => array( 'title' ),
		);

		register_post_type( 'ccs_custom_menu_item', $args );
	}

	/****************************************************************************************
	 *   CUSTOM METABOXES
	 ****************************************************************************************/

	/**
	 * Create metabox for custom menu items in Appearance -> Menus
	 * CPT is not public, therefore it doesn't appear there by default
	 * Also, we want some custom messages relating to this CPT
	 */
	public function add_metabox() {
		// Apperance -> Menus metabox.
		add_meta_box(
			'ccs-custom-menu-items',
			__( 'Custom Menu Items', 'themeName-admin' ),
			array( $this, 'metabox' ),
			'nav-menus',
			'side',
			'low'
		);

		// CPT metabox (menu item templates).
		add_meta_box(
			'ccs-custom-menu-item-templates',
			__( 'Menu Item Attributes', 'themeName-admin' ),
			array( $this, 'cpt_metabox' ),
			'ccs_custom_menu_item',
			'side',
			'low'
		);
	}

	/**
	 * Generate HTML for the custom metabox.
	 */
	public function metabox() {
		// Grab all the menu item posts.
		$items = get_posts(
			array(
				'post_type'      => 'ccs_custom_menu_item',
				'posts_per_page' => -1,
			)
		);

		// If there are any custom menu items, display metabox similar to the default WordPress ones, otherwise display appropriate message and encourage user to add some.
		if ( ! empty( $items ) ) {

			// The grey box and required opening tags.
			?>
			<div class="posttypediv"><div class="tabs-panel tabs-panel-active"><ul id="ccs-custom-nav-menus" class="categorychecklist">
			<?php

			// All posts as checkboxes.
			foreach ( $items as $item ) {
				?>
				<li>
					<input type="checkbox" id="ccs-cnm-item-<?php esc_attr_e( $item->ID ); ?>" value="<?php esc_attr_e( $item->ID ); ?>">
					<label for="ccs-cnm-item-<?php esc_attr_e( $item->ID ); ?>"><?php esc_html_e( $item->post_title ); ?></label>
				</li>
				<?php
			}

			// Close everything.
			?>
			</ul></div></div>
			<?php

			// Default WordPress code for 'Add to Menu' button and spinner.
			?>
			<p class="button-controls"><span class="add-to-menu">
			<input type="submit" class="button-secondary submit-add-to-menu right" value="<?php echo esc_attr__( 'Add to Menu', 'themeName-admin' ); ?>" name="add-post-type-menu-item" id="ccs-custom-nav-menus-submit" />
			<span class="spinner"></span>
			</span></p>
			<?php

		} else {
			$add_new_url = admin_url( 'edit.php?post_type=ccs_custom_menu_item' );

			?>
			<p class="ccs-cnm-empty-p">
				<?php echo sprintf( wp_kses( __( 'There are no custom menu items yet. Go ahead and add some <a href="%s">here</a>.', 'themeName-admin' ), array( 'a' => array( 'href' => array() ) ) ), esc_url( $add_new_url ) ); ?>
			</p>
			<?php
		}
	}

	/**
	 * Generate HTML for CPT metabox.
	 *
	 * Custom menu item template chooser.
	 */
	public function cpt_metabox() {
		$templates = $this->get_templates();

		wp_nonce_field( 'menu_item_template', 'menu_item_template_nonce' );

		?>

		<p>
			<strong><?php esc_html_e( 'Template', 'themeName-admin' ); ?></strong>
		</p>
		<label for="menu_item_template" class="screen-reader-text"><?php esc_html_e( 'Menu Item Template', 'themeName-admin' ); ?></label>

		<select name="menu_item_template" id="menu_item_template">

			<?php foreach ( $templates as $file => $name ) : ?>
				<?php

				$selected = '';
				$current  = get_post_meta( get_the_ID(), '_template', true );

				$selected = false;
				if ( $file === $current ) {
					$selected = true;
				}

				?>

				<option value="<?php esc_attr_e( $file ); ?>" <?php echo $selected ? 'selected="selected"' : ''; ?>><?php esc_html_e( $name ); ?></option>
			<?php endforeach; ?>

		</select>

		<?php
	}

	/****************************************************************************************
	 *   SAVING DATA / AJAX
	 ****************************************************************************************/

	/**
	 * Save the chosen custom menu item template in post meta.
	 *
	 * @param int     $post_id The post ID of the saved post.
	 * @param WP_Post $post    Post object.
	 * @param bool    $update  Whether this is an existing post being updated.
	 */
	public function menu_item_template_save( $post_id, $post, $update ) {
		if ( $update ) {
			if ( ! isset( $_REQUEST['menu_item_template_nonce'] ) || ! wp_verify_nonce( sanitize_text_field( wp_unslash( $_REQUEST['menu_item_template_nonce'] ) ), 'menu_item_template' ) ) {
				wp_nonce_ays( '' );
			} else {
				$template = $this->default_template;

				if ( isset( $_REQUEST['menu_item_template'] ) ) {
					$template = sanitize_text_field( wp_unslash( $_REQUEST['menu_item_template'] ) );
				}

				update_post_meta( $post_id, '_template', $template );
			}
		}
	}

	/**
	 * 'Add to Menu' ajax callback.
	 *
	 * Generates menu structure items for selected custom menu items.
	 */
	public function ajax_callback() {
		if ( isset( $_POST['nonce'] ) && wp_verify_nonce( sanitize_text_field( wp_unslash( $_POST['nonce'] ) ), 'custom_nav_menus_ajax' ) ) {
			if ( isset( $_POST['post_ids'] ) && ! empty( $_POST['post_ids'] ) ) {
				$post_ids = json_decode( sanitize_text_field( wp_unslash( $_POST['post_ids'] ) ) );

				// Go through post IDs passed via POST and create nav_menu_item CPT for each.
				$item_ids = array();
				foreach ( $post_ids as $pid ) {
					$p = get_post( intval( $pid ) );

					// If no such post exists, skip rest of this iteration.
					if ( ! $p ) {
						continue;
					}

					// Create nav_menu_item CPT, and remember their IDs.
					$args = array(
						'menu-item-title'     => esc_attr( $p->post_title ),
						'menu-item-type'      => 'post_type',
						'menu-item-object'    => 'ccs_custom_menu_item',
						'menu-item-object-id' => intval( $p->ID ),
						'menu-item-url'       => '#',
					);

					$item_ids[] = wp_update_nav_menu_item( 0, 0, $args );
				}

				// If for some reason creation of nav_menu_item CPTS failed, die.
				if ( is_wp_error( $item_ids ) ) {
					die();
				}

				// Go through all added nav_menu_item CPTs.
				$menu_items = array();
				foreach ( $item_ids as $id ) {
					// Setup each menu item (this uses custom filter, otherwise menu will have wrong metabox label and will have no url).
					$menu_item = get_post( $id );

					if ( $menu_item->ID ) {
						// Set menu item label to its title, otherwise it'll be suffixed with "(Pending)".
						$menu_item        = wp_setup_nav_menu_item( $menu_item );
						$menu_item->label = $menu_item->title;
						$menu_items[]     = $menu_item;
					}
				}

				/**
				 * Walk newly created menu items using custom walker if available,
				 * or default Walker_Nav_Menu_Edit if not.
				 *
				 * This generates Menu Structure item HTML, which is returned to calling JS
				 */
				require_once ABSPATH . 'wp-admin/includes/nav-menu.php';

				if ( ! empty( $menu_items ) ) {
					$args = array(
						'after'       => '',
						'before'      => '',
						'link_after'  => '',
						'link_before' => '',
					);

					if ( class_exists( 'Walker_Nav_Menu_Edit_CCS_Custom' ) ) {
						$args['walker'] = new Walker_Nav_Menu_Edit_CCS_Custom();
					} else {
						$args['walker'] = new Walker_Nav_Menu_Edit();
					}

					echo walk_nav_menu_tree(
						$menu_items,
						0,
						(object) $args
					);
				}
			}
		}

		die();
	}

	/****************************************************************************************
	 *   CUSTOM ACF LOCATIONS
	 ****************************************************************************************/

	/**
	 * Add custom location rule for custom menu item templates.
	 *
	 * @param array $choices Array of location options.
	 */
	public function acf_location_rule( $choices ) {
		$keys  = array_keys( $choices );
		$pos   = (int) array_search( 'Page', $keys, true ) + 1;
		$half1 = array_slice( $choices, 0, $pos, true );
		$half2 = array_slice( $choices, $pos, null, true );

		$choices = array_merge( $half1, array( 'Custom Menu Items' => array( 'ccs_menu_item_template' => 'Menu Item Template' ) ), $half2 );

		return $choices;
	}

	/**
	 * Add values for above ACF location rule (template files).
	 *
	 * @param array $choices Array of location options.
	 */
	public function acf_location_rule_values( $choices ) {
		return $this->get_templates();
	}

	/**
	 * Filter matching custom location values (file names, above) with the menu item template
	 * selected on the CPT edit screen (saved in post meta value).
	 *
	 * @param bool  $match   If the rule matches or not.
	 * @param array $rule    The rule specified by the user.
	 * @param array $options The menu item in question.
	 */
	public function acf_location_rule_matcher( $match, $rule, $options ) {
		if ( ! isset( $options['post_id'] ) ) {
			return $match;
		}

		$template = get_post_meta( $options['post_id'], '_template', true );
		$match    = false;

		if ( '==' === $rule['operator'] ) {
			$match = ( $template === $rule['value'] );
		}

		if ( '!=' === $rule['operator'] ) {
			$match = ( $template !== $rule['value'] );
		}

		return $match;
	}

	/****************************************************************************************
	 *   HELPER FUNCTIONS
	 ****************************************************************************************/

	/**
	 * Returns an associative array of custom menu item templates
	 * from custom-menus folder in the template folder, in the following form:
	 *   file-name.php => Template Name
	 */
	private function get_templates() {
		$templates = array( $this->default_template => 'Default Template' );

		$template_files = get_template_directory() . '/custom-menus/*.php';
		$files          = glob( $template_files );

		foreach ( $files as $file ) {
			$headers = get_file_data( $file, array( 'template_name' => 'Menu Item Template' ) );

			if ( $headers['template_name'] && basename( $file ) !== $this->default_template ) {
				$templates[ basename( $file ) ] = $headers['template_name'];
			}
		}

		return $templates;
	}
}

new CCS_Custom_Nav_Menus();
