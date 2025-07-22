<?php
/**
 * ACF Integration.
 *
 * This component adds ACF options pages.
 *
 * @package    WordPress
 * @subpackage cheleyCamps
 * @since      cheleyCamps 1.0
 */

defined( 'ABSPATH' ) || die();

/**
 * Class handing this themes custom ACF functionality.
 */
class Theme_Core_ACF extends Theme_Core_Component {

	/**
	 * Kicks off this class' functionality.
	 */
	protected function init() {
		$this->add_acf_pages();
	}

	/**
	 * Register the ACF option pages defined in settings file.
	 * This function also checks if the option pages settings are enabled, and that ACF is
	 * installed and enabled in the first place.
	 */
	private function add_acf_pages() {
		if (
			! isset( $this->settings->acf_options ) || // There are no ACF settings.
			true !== $this->settings->acf_options->init || // ACF is disabled in settings.
			! function_exists( 'acf_add_options_page' )    // ACF is not installed.
		) {
			return;
		}

		// Create options page.
		acf_add_options_page(
			array(
				'page_title' => $this->settings->acf_options->page_title,
				'menu_title' => $this->settings->acf_options->menu_title,
				'menu_slug'  => $this->settings->acf_options->menu_slug,
			)
		);

		// Create all options subpages.
		if ( isset( $this->settings->acf_options->subpages ) ) {
			foreach ( $this->settings->acf_options->subpages as $subpage ) {
				if ( isset( $subpage->parent_slug ) ) {
					$parent_slug = $subpage->parent_slug;
				} else {
					$parent_slug = $this->settings->acf_options->menu_slug;
				}

				if ( isset( $subpage->post_id ) ) {
					$subpage_post_id = $subpage->post_id;
				} else {
					$subpage_post_id = 'options';
				}

				acf_add_options_sub_page(
					array(
						'page_title'  => $subpage->page_title,
						'menu_title'  => $subpage->menu_title,
						'parent_slug' => $parent_slug,
						'post_id'     => $subpage_post_id,
					)
				);
			}
		}
	}
}
