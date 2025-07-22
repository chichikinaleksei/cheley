<?php
/**
 * The partial controlling the bottom portion of the header.
 *
 * @package WordPress
 * @subpackage cheleyCamps
 * @since cheleyCamps 1.0
 */

$main_logo        = get_field( 'main_logo', 'options' );
$cta              = get_field( 'h_cta', 'options' );
$next_steps       = get_field( 'h_next_steps_menu', 'options' );
$next_steps_image = wp_get_attachment_image( get_field( 'h_next_steps_image', 'options' ), 'next-steps' );
$next_steps_text  = get_field( 'h_next_steps_text', 'options' );
$menu_desktop = wp_get_nav_menu_object("12" );
?>

<div class="main-header__bottom">
	<button class="c-btn c-btn-back main-header__back" aria-label="Back"></button>
	<p class="main-header__mobile-title"></p>
	<?php if ( ! empty( $main_logo ) ) : ?>
		<a href="<?php echo esc_url( home_url() ); ?>" class="main-header__logo" aria-label="Logo">
			<?php echo wp_kses_post( wp_get_attachment_image( $main_logo, 'main-logo' ) ); ?>
		</a>
	<?php endif; ?>
	<nav class="main-header__nav">
		<?php
		wp_nav_menu(
			array(
				'theme_location' => 'primary',
				'container'      => false,
			)
		);
		?>
	</nav>
	<?php if ( ! empty( $cta ) || ! empty( $next_steps ) ) : ?>
		<div class="main-header__right">
			<?php if ( ! empty( $cta ) ) : ?>
				<div class="main-header__cta">
					<?php
					$buttons_index = 0;
					foreach ( $cta as $item ) :
						$item_button = $item['button'];

						if ( ! empty( $item_button ) ) :
							$item_button_title  = $item_button['title'];
							$item_button_url    = $item_button['url'];
							$item_button_target = $item_button['target'] ? 'target="_blank" rel="noopener"' : 'target="_self"';
							?>
							<a href="<?php echo esc_url( $item_button_url ); ?>" class="main-header__cta-link" <?php echo wp_kses_post( $item_button_target ); ?>>
								<span class="c-btn-text"><?php echo esc_html( $item_button_title ); ?></span>
								<?php if ( 0 === $buttons_index && ( count( $cta ) - 1 ) !== $buttons_index ) : ?>
								<svg width="115" height="83" viewBox="0 0 115 83" fill="none" xmlns="http://www.w3.org/2000/svg">
									<path d="M115 0H0C0 23.4679 0 70.9042 0 80H56.5361C56.9536 80.1203 57.2166 80.3022 57.4498 80.4634C57.9271 80.7936 58.2792 81.0372 59.5756 80.488C62.598 81.5013 65.9275 81.0101 69.2176 80.5246C70.7703 80.2955 72.3142 80.0677 73.813 80H75.4842C76.4543 80.05 77.3984 80.1971 78.3058 80.488C78.2396 81.2218 77.6821 81.3489 77.1186 81.4773C76.5975 81.5961 76.0711 81.716 75.9235 82.3182C84.4136 81.8351 94.1258 81.0132 103.503 80H115C115 0 115 80 115 0Z" fill="#377E96"/>
								</svg>
								<?php endif; ?>
								<?php if ( ( count( $cta ) - 1 ) === $buttons_index && 0 !== $buttons_index ) : ?>
								<svg width="112" height="86" viewBox="0 0 112 86" fill="none" xmlns="http://www.w3.org/2000/svg">
									<path fill-rule="evenodd" clip-rule="evenodd" d="M112 0H2.93255e-05L0 80.0894C4.33406 80.6703 8.94024 81.6859 14.1038 80.488C14.6643 81.1584 15.6264 81.3047 16.5864 81.4506C17.0507 81.5212 17.5145 81.5917 17.9321 81.7214C19.7585 80.7111 21.5781 81.069 23.2884 81.4055C24.1039 81.5659 24.8945 81.7214 25.6492 81.7214C29.3952 81.7214 36.3853 81.4727 39.1349 81.0848C39.6796 81.0065 40.0758 81.2495 40.4151 81.4576C40.6358 81.5929 40.8324 81.7136 41.0303 81.7214C48.5673 82.0994 55.3027 82.7957 61.2589 83.5418C61.9921 83.6371 62.7164 83.7317 63.4319 83.8252C68.0167 84.4241 72.2427 84.9762 76.183 85.372C76.4786 85.4004 76.6404 85.2534 76.8118 85.0978C77.0009 84.9261 77.2015 84.7439 77.6064 84.7752L79.1048 85.372C81.6528 85.7063 83.5951 85.5912 85.4752 85.4799C86.3923 85.4255 87.2946 85.372 88.2453 85.372C89.1631 85.372 90.1028 85.5345 91.0263 85.6942C92.055 85.872 93.0636 86.0464 93.9993 85.9888C95.8356 85.8814 97.6748 85.4683 99.4939 85.0597C101.72 84.5596 103.916 84.0664 106.039 84.1485C107.277 83.1844 108.572 82.2961 109.867 81.4082C110.546 80.9423 111.225 80.4765 111.896 80H112V79.9259C112 79.9259 112 16.1493 112 0Z" fill="#377E96"/>
								</svg>
								<?php endif; ?>
							</a>
							<?php
						endif;
						?>
						<?php
						$buttons_index++;
					endforeach;
					?>
				</div>
			<?php endif; ?>
			<?php if ( ! empty( $next_steps ) ) : ?>
				<div class="main-header__steps">
					<button class="main-header__steps-button c-btn c-btn-primary c-btn-color-normal">
						<?php echo $menu_desktop->name; ?>
						<svg width="127" height="86" viewBox="0 0 127 86" fill="none" xmlns="http://www.w3.org/2000/svg">
							<path d="M127 0H0L0.0291225 81.0773C6.03092 81.3984 12.2342 81.7953 20.8195 82.2909C21.7861 82.3618 22.2102 82.6738 22.564 82.934C23.0315 83.2779 23.3765 83.5316 24.6882 83.0203C27.6799 84.121 31.0223 83.7267 34.3251 83.337C37.5065 82.9617 40.6513 82.5907 43.4105 83.5643C43.3231 84.2959 42.7621 84.4068 42.1951 84.5188C41.6707 84.6224 41.1412 84.727 40.9761 85.3246C51.4779 85.0327 63.8594 84.278 75.1769 83.2535C75.4937 81.7246 74.4086 81.8613 73.3233 81.998C72.4074 82.1134 71.4912 82.2288 71.4175 81.343C73.8917 81.1096 76.275 80.9071 78.5925 80.7101L78.5937 80.71C81.3093 80.4792 83.9346 80.2561 86.5101 80H96.4532L96.4765 80.0238C96.7647 80.3185 97.052 80.6122 97.3955 80.8341C103.767 79.9289 111.83 80.1178 118.684 80.2784H118.684C120.525 80.3216 127 80.38 127 80.38V0Z" fill="#CC4A27"/>
						</svg>
					</button>
					<div class="main-header__steps-submenu">
						<?php if ( ! empty( $next_steps_image ) ) : ?>
							<figure class="main-header__steps-bg"><?php echo wp_kses_post( $next_steps_image ); ?></figure>
						<?php endif; ?>
						<div class="main-header__steps-menu-wrapper">
							<nav class="main-header__steps-menu">
								<?php echo wp_kses_post( $next_steps ); ?>
							</nav>
						</div>
					</div>
				</div>
			<?php endif; ?>
		</div>
	<?php endif; ?>
	<button class="btn-hamburger" aria-label="Button Hamburger">
		<span class="btn-hamburger__icon">
			<span></span>
			<span></span>
			<span></span>
		</span>
	</button>
	<?php get_theme_part( 'header/header-overlay' ); ?>
</div>
