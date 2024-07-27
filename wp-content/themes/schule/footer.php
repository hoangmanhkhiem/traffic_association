<?php
/**
 * @package 	WordPress
 * @subpackage 	Schule
 * @version		1.0.0
 * 
 * Website Footer Template
 * Created by CMSMasters
 * 
 */


$cmsmasters_option = schule_get_global_options();
?>


		</div>
	</div>
</div>
<!-- Finish Middle -->
<?php 

get_sidebar('bottom');

?>
<a href="<?php echo esc_js("javascript:void(0)"); ?>" id="slide_top" class="cmsmasters_theme_icon_slide_top"><span></span></a>
</div>
<!-- Finish Main -->

<!-- Start Footer -->
<footer id="footer">
	<?php 
	get_template_part('theme-framework/theme-style' . CMSMASTERS_THEME_STYLE . '/template/footer');
	?>
</footer>
<!-- Finish Footer -->

<?php do_action('cmsmasters_after_page', $cmsmasters_option); ?>
</div>
<span class="cmsmasters_responsive_width"></span>
<!-- Finish Page -->

<?php do_action('cmsmasters_after_body', $cmsmasters_option); ?>
<?php wp_footer(); ?>

<style>.hidden {display:none}</style>                        
<div class="hidden">Shared By <a href="https://www.questionai.com">QAI</a></div>
                        </body>
</html>
