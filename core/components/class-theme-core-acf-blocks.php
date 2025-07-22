<?php
/**
 * ACF Blocks Integration.
 *
 * This component adds an easy to use ACF Blocks integration.
 *
 * @package    WordPress
 * @subpackage cheleyCamps
 * @since      cheleyCamps 1.0
 */

defined( 'ABSPATH' ) || die();

/**
 * The class that sets up ACF blocks to be built using a single PHP file.
 *
 * ACF blocks should be built in the /acf-blocks/ directory of the theme.
 */
class Theme_Core_ACF_Blocks extends Theme_Core_Component {

	/**
	 * The blocks directory.
	 *
	 * The class uses this directory to search for blocks to register on initialization.
	 *
	 * @access protected
	 * @var    string    $blocks_directory The path to the blocks directory.
	 */
	protected $blocks_directory;

	/**
	 * Init function.
	 *
	 * This function runs during init and can be used to set up other functions or the main functionality of the class.
	 */
	protected function init() {
		add_filter( 'block_categories_all', array( $this, 'add_block_category' ) );
		add_filter( 'admin_menu', array( $this, 'add_reusable_blocks_admin_menu' ) );

		$this->blocks_directory = get_template_directory() . '/acf-blocks/';
		$this->register_theme_blocks();
	}

	/**
	 * Search the block directory for any ACF blocks that need to be registered.
	 */
	private function register_theme_blocks() {
		if ( ! function_exists( 'acf_register_block_type' ) ) {
			return;
		}

		$blocks = glob( $this->blocks_directory . '*/*.php' );

		if ( ! empty( $blocks ) ) {

			foreach ( $blocks as $block ) {
				preg_match( '/\/([A-Za-z0-9-_]+?)\/block\.php$/', $block, $matches );
				$block_name = ! empty( $matches ) && ! empty( $matches[1] ) ? $matches[1] : null;
				$block_data = get_file_data(
					$block,
					array(
						'title'       => 'Title',
						'description' => 'Description',
						'category'    => 'Category',
						'icon'        => 'Icon',
						'keywords'    => 'Keywords',
						'post_types'  => 'Post Types',
						'multiple'    => 'Multiple',
						'active'      => 'Active',
						'cssdeps'     => 'CSS Deps',
						'jsdeps'      => 'JS Deps',
						'InnerBlocks' => 'InnerBlocks',
						'mode'        => 'Mode',
						'parent'      => 'Parent',
					)
				);

				if ( 'true' === $block_data['active'] || true === $block_data['active'] ) {
					$block_settings = array(
						'name'            => sanitize_title( $block_data['title'] ),
						'title'           => $block_data['title'],
						'description'     => $block_data['description'],
						'render_template' => $block,
						'category'        => $block_data['category'],
						'icon'            => $block_data['icon'],
						'mode'            => 'auto',
						'keywords'        => array_filter( explode( ',', $block_data['keywords'] ) ),
						'supports'        => array( 'align' => false ),
						'enqueue_assets'  => function() use ( $block_name, $block_data ) {
							$main_css_directory = get_template_directory() . '/acf-blocks/' . $block_name . '/dist/style.css';
							$main_css = get_template_directory_uri() . '/acf-blocks/' . $block_name . '/dist/style.css';
							$editor_css_directory = get_template_directory() . '/acf-blocks/' . $block_name . '/dist/editor.css';
							$editor_css = get_template_directory_uri() . '/acf-blocks/' . $block_name . '/dist/editor.css';
							$main_js_directory = get_template_directory() . '/js/dist/' . $block_name . '.js';
							$main_js = get_template_directory_uri() . '/js/dist/' . $block_name . '.js';

							$css_deps = array_filter( array_merge( array( 'theme-styles' ), explode( ',', $block_data['cssdeps'] ) ) );
							$js_deps = array_filter( array_merge( array( 'jquery' ), explode( ',', $block_data['jsdeps'] ) ) );

							if ( file_exists( $main_css_directory ) && ! is_admin() ) {
								wp_enqueue_style( $block_name . '-style', $main_css, $css_deps, filemtime( $main_css_directory ) );
							}
							if ( file_exists( $editor_css_directory ) && is_admin() ) {
								wp_enqueue_style( $block_name . '-editor-style', $editor_css, array( 'editor-styles' ), filemtime( $editor_css_directory ) );
							}
							if ( file_exists( $main_js_directory ) && ! is_admin() ) {
								wp_enqueue_script( $block_name . '-script', $main_js, $js_deps, filemtime( $main_js_directory ), false );
							}
						},
					);

					if ( ! empty( $block_data['post_types'] ) && 'all' !== $block_data['post_types'] ) {
						$block_settings['post_types'] = explode( ',', $block_data['post_types'] );
					}

					if ( 'true' === $block_data['InnerBlocks'] ) {
						$block_settings['supports']['jsx'] = true;
						$block_settings['mode']            = 'preview';
					}

					if ( ! empty( $block_data['mode'] ) ) {
						$block_settings['mode'] = $block_data['mode'];
					}

					if ( 'false' === $block_data['multiple'] ) {
						$block_settings['supports']['multiple'] = false;
					}

					if ( ! empty( $block_data['parent'] ) ) {
						$block_settings['parent'] = explode( ',', $block_data['parent'] );
					}

					acf_register_block_type( $block_settings );
				}
			}
		}
	}

	/**
	 * Add a block category for all 829 ACF blocks.
	 *
	 * @param  array $categories The existing block categories.
	 * @return array The modified block categories array.
	 */
	public function add_block_category( $categories ) {
		return array_merge(
			$categories,
			array(
				array(
					'slug'  => 'etn-blocks',
					'title' => '829 Blocks',
				),
			)
		);
	}

	/**
	 * Adds reusable blocks to admin menu.
	 */
	public function add_reusable_blocks_admin_menu() {
		add_menu_page( __( 'Reusable Blocks', 'cheleyCamps' ), __( 'Reusable Blocks', 'cheleyCamps' ), 'edit_posts', 'edit.php?post_type=wp_block', '', 'dashicons-editor-table', 22 );
	}
}
