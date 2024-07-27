<?php
/**
 * Template for displaying curriculum tab of single course.
 *
 * @author  ThimPress
 * @package  Learnpress/Templates
 * @version  4.0.3
 */

defined( 'ABSPATH' ) || exit();

if ( empty( $args ) ) {
	return;
}

if ( isset( $args['section'] ) ) {
	$section = $args['section'];
} else {
	return;
}
?>

<li id="section-<?php echo esc_attr( $section['section_id'] ); ?>" class="section" data-section-id="<?php echo esc_attr( $section['section_id'] ); ?>">
	<div class="section-header">
		<div class="section-left">
			<div class="wrapper-section-title">
				<h3 class="section-title">
				 <?php echo ! empty( $section['section_name'] ) ? esc_html( $section['section_name'] ) : _x( 'Untitled', 'template title empty', 'learnpress' ); ?>
				</h3>
				<?php if ( ! empty( $section['section_description'] ) ) : ?>
					<p class="section-desc"><?php echo wp_kses_post( $section['section_description'] ); ?></p>
				<?php endif; ?>
			</div>

			<span class="section-toggle">
				<i class="lp-icon-caret-down"></i>
				<i class="lp-icon-caret-up"></i>
			</span>
		</div>
	</div>

	<?php
		$controller = new LP_REST_Lazy_Load_Controller();
		$request    = new WP_REST_Request();
		$request->set_param( 'sectionId', $section['section_id'] );
		$response    = $controller->course_curriculum_items( $request );
		$object_data = $response->get_data();
	?>
	<div class="section-item" data-section-id="<?php echo esc_attr( $section['section_id'] ); ?>">
		<ul class="section-content">
			<?php echo wp_kses_post( $object_data->data->content ?? $object_data->data ?? $object_data ? $object_data->data->content : '' ); ?>
		</ul>

		<?php if ( isset( $object_data ) && ! empty( $object_data->data->pages ) && $object_data->data->pages > 1 ) : ?>
			<div class="section-item__loadmore" data-page="1">
				<button><?php esc_html_e( 'Show more items', 'learnpress' ); ?></button>
			</div>
		<?php endif; ?>
	</div>
</li>
