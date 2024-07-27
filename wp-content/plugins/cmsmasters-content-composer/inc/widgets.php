<?php
/**
 * @package 	WordPress Plugin
 * @subpackage 	CMSMasters Content Composer
 * @version		2.3.4
 * 
 * CMSMasters Custom Widgets
 * Created by CMSMasters
 * 
 */


/**
 * Advertisement Widget Class
 */
class WP_Widget_Custom_Advertisement extends WP_Widget {
	function __construct() {
		$widget_ops = array( 
			'classname' => 		'widget_custom_advertisement_entries', 
			'description' => 	esc_attr__('Your advertisement', 'cmsmasters-content-composer') 
		);
		
		$control_ops = array( 
			'width' => 	600 
		);
		
		parent::__construct('custom-advertisement', esc_attr__('Advertisement', 'cmsmasters-content-composer'), $widget_ops, $control_ops);
	}
	
	function widget($args, $instance) {
		extract($args);
		
		$title = apply_filters('widget_title', empty($instance['title']) ? esc_attr__('Advertisement', 'cmsmasters-content-composer') : $instance['title'], $instance, $this->id_base);
        $image1 = isset($instance['image1']) ? $instance['image1'] : '';
        $link1 = isset($instance['link1']) ? $instance['link1'] : '';
        $image2 = isset($instance['image2']) ? $instance['image2'] : '';
        $link2 = isset($instance['link2']) ? $instance['link2'] : '';
        $image3 = isset($instance['image3']) ? $instance['image3'] : '';
        $link3 = isset($instance['link3']) ? $instance['link3'] : '';
        $image4 = isset($instance['image4']) ? $instance['image4'] : '';
        $link4 = isset($instance['link4']) ? $instance['link4'] : '';
        $image5 = isset($instance['image5']) ? $instance['image5'] : '';
        $link5 = isset($instance['link5']) ? $instance['link5'] : '';
        $image6 = isset($instance['image6']) ? $instance['image6'] : '';
        $link6 = isset($instance['link6']) ? $instance['link6'] : '';
		
		echo $before_widget;
		
		if ($title) { 
			echo $before_title . esc_html($title) . $after_title;
		}
		
		echo '<div class="adv_image_wrap">';
		
		if ($image1 != '' && $link1 != '') {
			echo '<figure class="adv_widget_image">' . 
				'<a href="' . esc_url($link1) . '" target="_blank">' . 
					'<img src="' . esc_url($image1) . '" width="125" height="125" alt="" />' . 
				'</a>' . 
			'</figure>';
		}

		if ($image2 != '' && $link2 != '') {
			echo '<figure class="adv_widget_image">' . 
				'<a href="' . esc_url($link2) . '" target="_blank">' . 
					'<img src="' . esc_url($image2) . '" width="125" height="125" alt="" />' . 
				'</a>' . 
			'</figure>';
		}

		if ($image3 != '' && $link3 != '') {
			echo '<figure class="adv_widget_image">' . 
				'<a href="' . esc_url($link3) . '" target="_blank">' . 
					'<img src="' . esc_url($image3) . '" width="125" height="125" alt="" />' . 
				'</a>' . 
			'</figure>';
		}

		if ($image4 != '' && $link4 != '') {
			echo '<figure class="adv_widget_image">' . 
				'<a href="' . esc_url($link4) . '" target="_blank">' . 
					'<img src="' . esc_url($image4) . '" width="125" height="125" alt="" />' . 
				'</a>' . 
			'</figure>';
		}

		if ($image5 != '' && $link5 != '') {
			echo '<figure class="adv_widget_image">' . 
				'<a href="' . esc_url($link5) . '" target="_blank">' . 
					'<img src="' . esc_url($image5) . '" width="125" height="125" alt="" />' . 
				'</a>' . 
			'</figure>';
		}

		if ($image6 != '' && $link6 != '') {
			echo '<figure class="adv_widget_image">' . 
				'<a href="' . esc_url($link6) . '" target="_blank">' . 
					'<img src="' . esc_url($image6) . '" width="125" height="125" alt="" />' . 
				'</a>' . 
			'</figure>';
		}
		
        echo '</div>';
		
        echo $after_widget;
    }
	
	function update($new_instance, $old_instance) {
		$instance = $old_instance;
		
		$instance['title'] = strip_tags($new_instance['title']);
        $instance['image1'] = strip_tags($new_instance['image1']);
        $instance['link1'] = strip_tags($new_instance['link1']);
        $instance['image2'] = strip_tags($new_instance['image2']);
        $instance['link2'] = strip_tags($new_instance['link2']);
        $instance['image3'] = strip_tags($new_instance['image3']);
        $instance['link3'] = strip_tags($new_instance['link3']);
        $instance['image4'] = strip_tags($new_instance['image4']);
        $instance['link4'] = strip_tags($new_instance['link4']);
        $instance['image5'] = strip_tags($new_instance['image5']);
        $instance['link5'] = strip_tags($new_instance['link5']);
        $instance['image6'] = strip_tags($new_instance['image6']);
        $instance['link6'] = strip_tags($new_instance['link6']);
		
		return $instance;
	}
	
    function form($instance) {
        $title = isset($instance['title']) ? esc_attr($instance['title']) : '';
		$image1 = isset($instance['image1']) ? esc_attr($instance['image1']) : '';
		$link1 = isset($instance['link1']) ? esc_attr($instance['link1']) : '';
		$image2 = isset($instance['image2']) ? esc_attr($instance['image2']) : '';
		$link2 = isset($instance['link2']) ? esc_attr($instance['link2']) : '';
		$image3 = isset($instance['image3']) ? esc_attr($instance['image3']) : '';
		$link3 = isset($instance['link3']) ? esc_attr($instance['link3']) : '';
		$image4 = isset($instance['image4']) ? esc_attr($instance['image4']) : '';
		$link4 = isset($instance['link4']) ? esc_attr($instance['link4']) : '';
		$image5 = isset($instance['image5']) ? esc_attr($instance['image5']) : '';
		$link5 = isset($instance['link5']) ? esc_attr($instance['link5']) : '';
		$image6 = isset($instance['image6']) ? esc_attr($instance['image6']) : '';
		$link6 = isset($instance['link6']) ? esc_attr($instance['link6']) : '';
        ?>
        <p>
            <label for="<?php echo esc_attr($this->get_field_id('title')); ?>"><?php esc_html_e('Title', 'cmsmasters-content-composer'); ?>:<br />
                <input class="widefat" id="<?php echo esc_attr($this->get_field_id('title')); ?>" name="<?php echo esc_attr($this->get_field_name('title')); ?>" type="text" value="<?php echo esc_attr($title); ?>" />
            </label>
        </p>
        <p class="l_half">
            <label for="<?php echo esc_attr($this->get_field_id('image1')); ?>"><?php esc_html_e('Image', 'cmsmasters-content-composer'); ?> #1:<br />
                <input class="widefat" id="<?php echo esc_attr($this->get_field_id('image1')); ?>" name="<?php echo esc_attr($this->get_field_name('image1')); ?>" type="text" value="<?php echo esc_attr($image1); ?>" />
            </label>
        </p>
        <p class="r_half">
            <label for="<?php echo esc_attr($this->get_field_id('link1')); ?>"><?php esc_html_e('Link', 'cmsmasters-content-composer'); ?> #1:<br />
                <input class="widefat" id="<?php echo esc_attr($this->get_field_id('link1')); ?>" name="<?php echo esc_attr($this->get_field_name('link1')); ?>" type="text" value="<?php echo esc_attr($link1); ?>" />
            </label>
        </p>
        <p class="l_half">
            <label for="<?php echo esc_attr($this->get_field_id('image2')); ?>"><?php esc_html_e('Image', 'cmsmasters-content-composer'); ?> #2:<br />
                <input class="widefat" id="<?php echo esc_attr($this->get_field_id('image2')); ?>" name="<?php echo esc_attr($this->get_field_name('image2')); ?>" type="text" value="<?php echo esc_attr($image2); ?>" />
            </label>
        </p>
        <p class="r_half">
            <label for="<?php echo esc_attr($this->get_field_id('link2')); ?>"><?php esc_html_e('Link', 'cmsmasters-content-composer'); ?> #2:<br />
                <input class="widefat" id="<?php echo esc_attr($this->get_field_id('link2')); ?>" name="<?php echo esc_attr($this->get_field_name('link2')); ?>" type="text" value="<?php echo esc_attr($link2); ?>" />
            </label>
        </p>
        <p class="l_half">
            <label for="<?php echo esc_attr($this->get_field_id('image3')); ?>"><?php esc_html_e('Image', 'cmsmasters-content-composer'); ?> #3:<br />
                <input class="widefat" id="<?php echo esc_attr($this->get_field_id('image3')); ?>" name="<?php echo esc_attr($this->get_field_name('image3')); ?>" type="text" value="<?php echo esc_attr($image3); ?>" />
            </label>
        </p>
        <p class="r_half">
            <label for="<?php echo esc_attr($this->get_field_id('link3')); ?>"><?php esc_html_e('Link', 'cmsmasters-content-composer'); ?> #3:<br />
                <input class="widefat" id="<?php echo esc_attr($this->get_field_id('link3')); ?>" name="<?php echo esc_attr($this->get_field_name('link3')); ?>" type="text" value="<?php echo esc_attr($link3); ?>" />
            </label>
        </p>
        <p class="l_half">
            <label for="<?php echo esc_attr($this->get_field_id('image4')); ?>"><?php esc_html_e('Image', 'cmsmasters-content-composer'); ?> #4:<br />
                <input class="widefat" id="<?php echo esc_attr($this->get_field_id('image4')); ?>" name="<?php echo esc_attr($this->get_field_name('image4')); ?>" type="text" value="<?php echo esc_attr($image4); ?>" />
            </label>
        </p>
        <p class="r_half">
            <label for="<?php echo esc_attr($this->get_field_id('link4')); ?>"><?php esc_html_e('Link', 'cmsmasters-content-composer'); ?> #4:<br />
                <input class="widefat" id="<?php echo esc_attr($this->get_field_id('link4')); ?>" name="<?php echo esc_attr($this->get_field_name('link4')); ?>" type="text" value="<?php echo esc_attr($link4); ?>" />
            </label>
        </p>
        <p class="l_half">
            <label for="<?php echo esc_attr($this->get_field_id('image5')); ?>"><?php esc_html_e('Image', 'cmsmasters-content-composer'); ?> #5:<br />
                <input class="widefat" id="<?php echo esc_attr($this->get_field_id('image5')); ?>" name="<?php echo esc_attr($this->get_field_name('image5')); ?>" type="text" value="<?php echo esc_attr($image5); ?>" />
            </label>
        </p>
        <p class="r_half">
            <label for="<?php echo esc_attr($this->get_field_id('link5')); ?>"><?php esc_html_e('Link', 'cmsmasters-content-composer'); ?> #5:<br />
                <input class="widefat" id="<?php echo esc_attr($this->get_field_id('link5')); ?>" name="<?php echo esc_attr($this->get_field_name('link5')); ?>" type="text" value="<?php echo esc_attr($link5); ?>" />
            </label>
        </p>
        <p class="l_half">
            <label for="<?php echo esc_attr($this->get_field_id('image6')); ?>"><?php esc_html_e('Image', 'cmsmasters-content-composer'); ?> #6:<br />
                <input class="widefat" id="<?php echo esc_attr($this->get_field_id('image6')); ?>" name="<?php echo esc_attr($this->get_field_name('image6')); ?>" type="text" value="<?php echo esc_attr($image6); ?>" />
            </label>
        </p>
        <p class="r_half">
            <label for="<?php echo esc_attr($this->get_field_id('link6')); ?>"><?php esc_html_e('Link', 'cmsmasters-content-composer'); ?> #6:<br />
                <input class="widefat" id="<?php echo esc_attr($this->get_field_id('link6')); ?>" name="<?php echo esc_attr($this->get_field_name('link6')); ?>" type="text" value="<?php echo esc_attr($link6); ?>" />
            </label>
        </p>
        <div class="cl"></div>
        <?php
    }
}


/**
 * Divider Widget Class
 */
class WP_Widget_Custom_Divider extends WP_Widget {
	function __construct() {
		$widget_ops = array( 
			'classname' => 		'widget_custom_divider_entries', 
			'description' => 	esc_html__('Divider for widgets rows', 'cmsmasters-content-composer') 
		);
		
		parent::__construct('custom-divider', esc_attr__('Divider', 'cmsmasters-content-composer'), $widget_ops);
	}
	
	function widget($args, $instance) {
		extract($args);
		
        $divider = isset($instance['divider']) ? $instance['divider'] : false;
        $divider_bdr = isset($instance['divider_bdr']) ? $instance['divider_bdr'] : 'solid';
		
		if ($divider) {
			echo '<div class="cmsmasters_widget_divider ' . esc_attr($divider_bdr) . '"></div>';
		} else {
			echo '<div class="cl"></div>';
		}
    }
	
	function update($new_instance, $old_instance) {
		$new_instance = (array) $new_instance;
		
		$instance = array( 
			'divider' => 0 
		);
		
		foreach ($instance as $field => $val) {
			if (isset($new_instance[$field])) {
				$instance[$field] = 1;
			}
		}
		
		$instance['divider_bdr'] = strip_tags($new_instance['divider_bdr']);
		
		return $instance;
	}
	
	function form($instance) {
		$instance = wp_parse_args((array) $instance, array( 
			'divider' => false 
		) );
		$divider_bdr = isset($instance['divider_bdr']) ? esc_attr($instance['divider_bdr']) : 'solid';
        ?>
		<p>
			<input class="checkbox" type="checkbox" <?php checked($instance['divider'], true); ?> id="<?php echo esc_attr($this->get_field_id('divider')); ?>" name="<?php echo esc_attr($this->get_field_name('divider')); ?>" /> 
			<label for="<?php echo esc_attr($this->get_field_id('divider')); ?>"><?php esc_html_e('Show Divider Line', 'cmsmasters-content-composer'); ?></label>
		</p>
        <p>
            <label for="<?php echo esc_attr($this->get_field_id('divider_bdr')); ?>"><?php esc_html_e('Divider Type', 'cmsmasters-content-composer'); ?>:<br />
				<select class="widefat" id="<?php echo esc_attr($this->get_field_id('divider_bdr')); ?>" name="<?php echo esc_attr($this->get_field_name('divider_bdr')); ?>">
					<option value="solid"<?php if ($divider_bdr == 'solid') { echo ' selected="selected"'; } ?>><?php esc_html_e('Solid Line', 'cmsmasters-content-composer'); ?></option>
					<option value="dashed"<?php if ($divider_bdr == 'dashed') { echo ' selected="selected"'; } ?>><?php esc_html_e('Dashed Line', 'cmsmasters-content-composer'); ?></option>
					<option value="dotted"<?php if ($divider_bdr == 'dotted') { echo ' selected="selected"'; } ?>><?php esc_html_e('Dotted Line', 'cmsmasters-content-composer'); ?></option>
					<option value="transparent"<?php if ($divider_bdr == 'transparent') { echo ' selected="selected"'; } ?>><?php esc_html_e('Transparent Line', 'cmsmasters-content-composer'); ?></option>
				</select>
            </label>
        </p>
		<?php
	}
}


/**
 * Embedded Video Widget Class
 */
class WP_Widget_Custom_Video extends WP_Widget {
	function __construct() {
		$widget_ops = array( 
			'classname' => 		'widget_custom_video_entries', 
			'description' => 	esc_attr__('Video from youtube, vimeo or dailymotion', 'cmsmasters-content-composer') 
		);
		
		parent::__construct('custom-video', esc_attr__('Embedded Widget', 'cmsmasters-content-composer'), $widget_ops);
	}
	
	function widget($args, $instance) {
		extract($args);
		
		global $wp_embed;
		
		$wrap_embed = isset($instance['wrap_embed']) ? $instance['wrap_embed'] : true;
		$title = apply_filters('widget_title', empty($instance['title']) ? esc_attr__('Embedded Widget', 'cmsmasters-content-composer') : $instance['title'], $instance, $this->id_base);
        $url = isset($instance['url']) ? $instance['url'] : '';
        $width = isset($instance['width']) ? $instance['width'] : '';
        $height = isset($instance['height']) ? $instance['height'] : '';
		
		echo $before_widget;
		
		if ($title) { 
			echo $before_title . esc_html($title) . $after_title;
		}
		
		if ($url != '') {
			if ($wrap_embed) {
				echo '<div class="cmsmasters_video_wrap">';
			}
			
			echo $wp_embed->run_shortcode('[embed' . 
				(($width != '' && $wrap_embed == '') ? ' width="' . esc_attr($width) . '"' : '') . 
				(($height != '' && $wrap_embed == '') ? ' height="' . esc_attr($height) . '"' : '') . 
			']' . esc_url($url) . '[/embed]');
			
			if ($wrap_embed) {
				echo '</div>';
			}
		}
		
        echo $after_widget;
    }
	
	function update($new_instance, $old_instance) {
		$new_instance = (array) $new_instance;
		
		$instance = array( 
			'wrap_embed' => 0 
		);
		
		foreach ($instance as $field => $val) {
			if (isset($new_instance[$field])) {
				$instance[$field] = 1;
			}
		}
		
		$instance['title'] = strip_tags($new_instance['title']);
        $instance['url'] = strip_tags($new_instance['url']);
        $instance['width'] = strip_tags($new_instance['width']);
        $instance['height'] = strip_tags($new_instance['height']);
		
		return $instance;
	}
	
    function form($instance) {
        $title = isset($instance['title']) ? esc_attr($instance['title']) : '';
		$url = isset($instance['url']) ? esc_attr($instance['url']) : '';
		$width = isset($instance['width']) ? esc_attr($instance['width']) : '';
		$height = isset($instance['height']) ? esc_attr($instance['height']) : '';
		$instance = wp_parse_args((array) $instance, array( 
			'wrap_embed' => true 
		) );
        ?>
        <p>
            <label for="<?php echo esc_attr($this->get_field_id('title')); ?>"><?php esc_html_e('Title', 'cmsmasters-content-composer'); ?>:<br />
                <input class="widefat" id="<?php echo esc_attr($this->get_field_id('title')); ?>" name="<?php echo esc_attr($this->get_field_name('title')); ?>" type="text" value="<?php echo esc_attr($title); ?>" />
            </label>
        </p>
        <p>
            <label for="<?php echo esc_attr($this->get_field_id('url')); ?>"><?php esc_html_e('Embed URL', 'cmsmasters-content-composer'); ?>:<br />
                <input class="widefat" id="<?php echo esc_attr($this->get_field_id('url')); ?>" name="<?php echo esc_attr($this->get_field_name('url')); ?>" type="text" value="<?php echo esc_attr($url); ?>" />
            </label>
        </p>
        <p>
            <label for="<?php echo esc_attr($this->get_field_id('width')); ?>"><?php esc_html_e('Max Width', 'cmsmasters-content-composer'); ?>:<br />
                <input class="widefat" id="<?php echo esc_attr($this->get_field_id('width')); ?>" name="<?php echo esc_attr($this->get_field_name('width')); ?>" type="text" value="<?php echo esc_attr($width); ?>" />
            </label>
        </p>
        <p>
            <label for="<?php echo esc_attr($this->get_field_id('height')); ?>"><?php esc_html_e('Max Height', 'cmsmasters-content-composer'); ?>:<br />
                <input class="widefat" id="<?php echo esc_attr($this->get_field_id('height')); ?>" name="<?php echo esc_attr($this->get_field_name('height')); ?>" type="text" value="<?php echo esc_attr($height); ?>" />
            </label>
        </p>
		<p>
			<input class="checkbox" type="checkbox" <?php checked($instance['wrap_embed'], true); ?> id="<?php echo esc_attr($this->get_field_id('wrap_embed')); ?>" name="<?php echo esc_attr($this->get_field_name('wrap_embed')); ?>" /> 
			<label for="<?php echo esc_attr($this->get_field_id('wrap_embed')); ?>"><?php esc_html_e('If checked, ignore default video height/max-height and set a 16:9 proportion instead', 'cmsmasters-content-composer'); ?></label>
		</p>
        <div class="cl"></div>
        <?php
    }
}


/**
 * Facebook Widget Class
 */
class WP_Widget_Custom_Facebook extends WP_Widget {
	function __construct() {
		$widget_ops = array( 
			'classname' => 		'widget_custom_facebook_entries', 
			'description' => 	esc_attr__('Your Facebook like box', 'cmsmasters-content-composer') 
		);
		
		parent::__construct('custom-facebook', esc_attr__('Facebook', 'cmsmasters-content-composer'), $widget_ops);
	}
	
	function widget($args, $instance) {
		extract($args);
		
		$title = apply_filters('widget_title', empty($instance['title']) ? esc_attr__('Facebook', 'cmsmasters-content-composer') : $instance['title'], $instance, $this->id_base);
		$url = isset($instance['url']) ? esc_url($instance['url']) : '';
		
		echo $before_widget;
		
		if ($title) { 
			echo $before_title . esc_html($title) . $after_title;
		}
		
		echo '<div id="fb-root"></div>' . 
		'<div class="fb-page" data-href="' . esc_url($url) . '" data-small-header="false" data-adapt-container-width="true" data-hide-cover="false" data-show-facepile="false" data-show-posts="false"><div class="fb-xfbml-parse-ignore"><blockquote cite="' . esc_url($url) . '"><a href="' . esc_url($url) . '">Facebook</a></blockquote></div></div>' . 
		'<div class="cl"></div>' . 
		$after_widget;
	}
	
	function update($new_instance, $old_instance) {
		$instance = $old_instance;
		
		$instance['title'] = strip_tags($new_instance['title']);
        $instance['url'] = strip_tags($new_instance['url']);
		
		return $instance;
	}
	
    function form($instance) {
        $title = isset($instance['title']) ? esc_attr($instance['title']) : '';
        $url = isset($instance['url']) ? esc_attr($instance['url']) : '';
        ?>
        <p>
            <label for="<?php echo esc_attr($this->get_field_id('title')); ?>"><?php esc_html_e('Title', 'cmsmasters-content-composer'); ?>:<br />
                <input class="widefat" id="<?php echo esc_attr($this->get_field_id('title')); ?>" name="<?php echo esc_attr($this->get_field_name('title')); ?>" type="text" value="<?php echo esc_attr($title); ?>" />
            </label>
        </p>
        <p>
            <label for="<?php echo esc_attr($this->get_field_id('url')); ?>"><?php esc_html_e('Facebook Page URL', 'cmsmasters-content-composer'); ?> :<br />
                <input class="widefat" id="<?php echo esc_attr($this->get_field_id('url')); ?>" name="<?php echo esc_attr($this->get_field_name('url')); ?>" type="text" value="<?php echo esc_attr($url); ?>" />
            </label>
        </p>
        <div class="cl"></div>
        <?php
    }
}


/**
 * Flickr Widget Class
 */
class WP_Widget_Custom_Flickr extends WP_Widget {
	function __construct() {
		$widget_ops = array( 
			'classname' => 		'widget_custom_flickr_entries', 
			'description' => 	esc_attr__('Your Flickr account latest images', 'cmsmasters-content-composer') 
		);
		
		parent::__construct('custom-flickr', esc_attr__('Flickr', 'cmsmasters-content-composer'), $widget_ops);
	}
	
	function widget($args, $instance) {
		extract($args);
		
		$title = apply_filters('widget_title', empty($instance['title']) ? esc_attr__('Flickr', 'cmsmasters-content-composer') : $instance['title'], $instance, $this->id_base);
		$user = isset($instance['user']) ? $instance['user'] : '';
		$number = isset($instance['number']) ? (int) $instance['number'] : '';
		
        if (empty($instance['number']) || !$number = absint($instance['number'])) {
            $number = 6;
        } elseif ($number < 1) {
            $number = 1;
        } elseif ($number > 15) {
            $number = 15;
        }
		
		echo $before_widget . 
			'<div id="flickr">';
		
		if ($title) { 
			echo $before_title . esc_html($title) . $after_title;
		}
		
		echo '<div class="wrap">' . 
				'<script type="text/javascript" src="http://www.flickr.com/badge_code_v2.gne?count=' . $number . '&amp;display=latest&amp;size=s&amp;layout=x&amp;source=user&amp;user=' . $user . '"></script>' . 
			'</div>' . 
			'<div class="cl"></div>' . 
			'<a href="http://www.flickr.com/photos/' . $user . '" class="more_button" target="_blank"><span>' . esc_html__('More flickr images', 'cmsmasters-content-composer') . '</span></a>' . 
			'</div>' . 
		$after_widget;
	}
	
	function update($new_instance, $old_instance) {
		$instance = $old_instance;
		
		$instance['title'] = strip_tags($new_instance['title']);
        $instance['user'] = strip_tags($new_instance['user']);
        $instance['number'] = absint($new_instance['number']);
		
		return $instance;
	}
	
    function form($instance) {
        $title = isset($instance['title']) ? esc_attr($instance['title']) : '';
        $user = isset($instance['user']) ? esc_attr($instance['user']) : '';
        $number = (isset($instance['number']) && $instance['number'] != 0) ? absint($instance['number']) : 6;
        ?>
        <p>
            <label for="<?php echo esc_attr($this->get_field_id('title')); ?>"><?php esc_html_e('Title', 'cmsmasters-content-composer'); ?>:<br />
                <input class="widefat" id="<?php echo esc_attr($this->get_field_id('title')); ?>" name="<?php echo esc_attr($this->get_field_name('title')); ?>" type="text" value="<?php echo esc_attr($title); ?>" />
            </label>
        </p>

		<?php _deprecated_function( 'Flickr widget', '' ); ?>

        <p>
            <label for="<?php echo esc_attr($this->get_field_id('user')); ?>"><?php esc_html_e('Flickr ID', 'cmsmasters-content-composer'); ?> (<a href="http://www.idgettr.com" target="_blank">idGettr</a>):<br />
                <input class="widefat" id="<?php echo esc_attr($this->get_field_id('user')); ?>" name="<?php echo esc_attr($this->get_field_name('user')); ?>" type="text" value="<?php echo esc_attr($user); ?>" />
            </label>
        </p>
        <p>
            <label for="<?php echo esc_attr($this->get_field_id('number')); ?>"><?php esc_html_e("Enter the number of latest flickr images you'd like to display", 'cmsmasters-content-composer'); ?>:<br /><br />
                <input id="<?php echo esc_attr($this->get_field_id('number')); ?>" name="<?php echo esc_attr($this->get_field_name('number')); ?>" type="text" value="<?php echo esc_attr($number); ?>" size="3" />
                <small class="s_red"><?php esc_html_e('default is', 'cmsmasters-content-composer'); ?> 6</small><br />
            </label>
        </p>
        <div class="cl"></div>
        <?php
    }
}


/**
 * HTML5 Audio Widget Class
 */
class WP_Widget_Custom_HTML5_Audio extends WP_Widget {
	function __construct() {
		$widget_ops = array( 
			'classname' => 		'widget_custom_html5_audio_entries', 
			'description' => 	esc_attr__('Your HTML5 Audio', 'cmsmasters-content-composer') 
		);
		
		$control_ops = array( 
			'width' => 	600 
		);
		
		parent::__construct('custom-html5-audio', esc_attr__('HTML5 Audio', 'cmsmasters-content-composer'), $widget_ops, $control_ops);
	}
	
	function widget($args, $instance) {
		extract($args);
		
		$title = apply_filters('widget_title', empty($instance['title']) ? esc_attr__('HTML5 Audio', 'cmsmasters-content-composer') : $instance['title'], $instance, $this->id_base);
        $srcmp3 = isset($instance['srcmp3']) ? $instance['srcmp3'] : '';
        $srcogg = isset($instance['srcogg']) ? $instance['srcogg'] : '';
        $srcwebm = isset($instance['srcwebm']) ? $instance['srcwebm'] : '';
        $preload = isset($instance['preload']) ? $instance['preload'] : 'none';
        $autoplay = isset($instance['autoplay']) ? $instance['autoplay'] : false;
        $loop = isset($instance['loop']) ? $instance['loop'] : false;
		
		echo $before_widget;
		
		if ($title) { 
			echo $before_title . esc_html($title) . $after_title;
		}
		
		$attrs = array( 
			'preload' => esc_attr($preload) 
		);
		
		if ($autoplay) {
			$attrs['autoplay'] = 'on';
		}
		
		if ($loop) {
			$attrs['loop'] = 'on';
		}
		
		if ($srcmp3 != '') {
			$attrs[substr(strrchr($srcmp3, '.'), 1)] = esc_url($srcmp3);
		}
		
		if ($srcogg != '') {
			$attrs[substr(strrchr($srcogg, '.'), 1)] = esc_url($srcogg);
		}
		
		if ($srcwebm != '') {
			$attrs[substr(strrchr($srcwebm, '.'), 1)] = esc_url($srcwebm);
		}
		
		$out = '<div class="cmsmasters_audio">' . 
			wp_audio_shortcode($attrs) . 
		'</div>';
		
		echo $out . 
		$after_widget;
    }
	
	function update($new_instance, $old_instance) {
		$instance = $old_instance;
		
		$instance = array( 
			'autoplay' 	=> 0, 
			'loop' 		=> 0 
		);
		
		foreach ($instance as $field => $val) {
			if (isset($new_instance[$field])) {
				$instance[$field] = 1;
			}
		}
		
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['srcmp3'] = strip_tags($new_instance['srcmp3']);
        $instance['srcogg'] = strip_tags($new_instance['srcogg']);
		$instance['srcwebm'] = strip_tags($new_instance['srcwebm']);
		$instance['preload'] = strip_tags($new_instance['preload']);
		
		return $instance;
	}
	
    function form($instance) {
        $title = isset($instance['title']) ? esc_attr($instance['title']) : '';
		$srcmp3 = isset($instance['srcmp3']) ? esc_attr($instance['srcmp3']) : '';
		$srcogg = isset($instance['srcogg']) ? esc_attr($instance['srcogg']) : '';
		$srcwebm = isset($instance['srcwebm']) ? esc_attr($instance['srcwebm']) : '';
		$preload = isset($instance['preload']) ? esc_attr($instance['preload']) : 'none';
		
		$instance = wp_parse_args((array) $instance, array( 
			'autoplay' 	=> false, 
			'loop' 		=> false 
		) );
        ?>
        <p>
            <label for="<?php echo esc_attr($this->get_field_id('title')); ?>"><?php esc_html_e('Title', 'cmsmasters-content-composer'); ?>:<br />
                <input class="widefat" id="<?php echo esc_attr($this->get_field_id('title')); ?>" name="<?php echo esc_attr($this->get_field_name('title')); ?>" type="text" value="<?php echo esc_attr($title); ?>" />
            </label>
        </p>
        <p class="l_half">
            <label for="<?php echo esc_attr($this->get_field_id('srcmp3')); ?>"><?php echo esc_html__('Audio', 'cmsmasters-content-composer') . ' .mp3 ' . esc_html__('File Format URL', 'cmsmasters-content-composer'); ?>:<br />
                <input class="widefat" id="<?php echo esc_attr($this->get_field_id('srcmp3')); ?>" name="<?php echo esc_attr($this->get_field_name('srcmp3')); ?>" type="text" value="<?php echo esc_attr($srcmp3); ?>" />
            </label>
        </p>
        <p class="r_half">
            <label for="<?php echo esc_attr($this->get_field_id('srcogg')); ?>"><?php echo esc_html__('Audio', 'cmsmasters-content-composer') . ' .ogg ' . esc_html__('File Format URL', 'cmsmasters-content-composer'); ?>:<br />
                <input class="widefat" id="<?php echo esc_attr($this->get_field_id('srcogg')); ?>" name="<?php echo esc_attr($this->get_field_name('srcogg')); ?>" type="text" value="<?php echo esc_attr($srcogg); ?>" />
            </label>
        </p>
        <p class="l_half">
            <label for="<?php echo esc_attr($this->get_field_id('srcwebm')); ?>"><?php echo esc_html__('Audio', 'cmsmasters-content-composer') . ' .webm ' . esc_html__('File Format URL', 'cmsmasters-content-composer'); ?>:<br />
                <input class="widefat" id="<?php echo esc_attr($this->get_field_id('srcwebm')); ?>" name="<?php echo esc_attr($this->get_field_name('srcwebm')); ?>" type="text" value="<?php echo esc_attr($srcwebm); ?>" />
            </label>
        </p>
        <p class="r_half">
            <label for="<?php echo esc_attr($this->get_field_id('preload')); ?>"><?php esc_html_e('Preload', 'cmsmasters-content-composer'); ?>:<br />
				<select class="widefat" id="<?php echo esc_attr($this->get_field_id('preload')); ?>" name="<?php echo esc_attr($this->get_field_name('preload')); ?>">
					<option value="none"<?php if ($preload == 'none') { echo ' selected="selected"'; } ?>><?php esc_html_e('Not Preload', 'cmsmasters-content-composer'); ?></option>
					<option value="auto"<?php if ($preload == 'auto') { echo ' selected="selected"'; } ?>><?php esc_html_e('Preload Auto', 'cmsmasters-content-composer'); ?></option>
					<option value="metadata"<?php if ($preload == 'metadata') { echo ' selected="selected"'; } ?>><?php esc_html_e('Preload as Metadata', 'cmsmasters-content-composer'); ?></option>
				</select>
            </label>
        </p>
		<p class="l_half">
			<input class="checkbox" type="checkbox" <?php checked($instance['autoplay'], true); ?> id="<?php echo esc_attr($this->get_field_id('autoplay')); ?>" name="<?php echo esc_attr($this->get_field_name('autoplay')); ?>" /> 
			<label for="<?php echo esc_attr($this->get_field_id('autoplay')); ?>"><?php esc_html_e('Enable Autoplay', 'cmsmasters-content-composer'); ?></label>
		</p>
		<p class="r_half">
			<input class="checkbox" type="checkbox" <?php checked($instance['loop'], true); ?> id="<?php echo esc_attr($this->get_field_id('loop')); ?>" name="<?php echo esc_attr($this->get_field_name('loop')); ?>" /> 
			<label for="<?php echo esc_attr($this->get_field_id('loop')); ?>"><?php esc_html_e('Enable Repeat', 'cmsmasters-content-composer'); ?></label>
		</p>
        <div class="cl"></div>
        <?php
    }
}


/**
 * HTML5 Video Widget Class
 */
class WP_Widget_Custom_HTML5_Video extends WP_Widget {
	function __construct() {
		$widget_ops = array( 
			'classname' => 		'widget_custom_html5_video_entries', 
			'description' => 	esc_attr__('Your HTML5 Video', 'cmsmasters-content-composer') 
		);
		
		$control_ops = array( 
			'width' => 	600 
		);
		
		parent::__construct('custom-html5-video', esc_attr__('HTML5 Video', 'cmsmasters-content-composer'), $widget_ops, $control_ops);
	}
	
	function widget($args, $instance) {
		extract($args);
		
		$title = apply_filters('widget_title', empty($instance['title']) ? esc_attr__('HTML5 Video', 'cmsmasters-content-composer') : $instance['title'], $instance, $this->id_base);
        $srcmp4 = isset($instance['srcmp4']) ? $instance['srcmp4'] : '';
        $srcogg = isset($instance['srcogg']) ? $instance['srcogg'] : '';
        $srcwebm = isset($instance['srcwebm']) ? $instance['srcwebm'] : '';
        $poster = isset($instance['poster']) ? $instance['poster'] : '';
        $text = (isset($instance['text']) && $instance['text'] != '') ? $instance['text'] : esc_attr__('Your browser does not support the video tag.', 'cmsmasters-content-composer');
        $preload = isset($instance['preload']) ? $instance['preload'] : 'none';
        $loop = isset($instance['loop']) ? $instance['loop'] : false;
        $autoplay = isset($instance['autoplay']) ? $instance['autoplay'] : false;
		
		echo $before_widget;
		
		if ($title) { 
			echo $before_title . esc_html($title) . $after_title;
		}
		
		$out = '<div class="cmsmasters_video_wrap">';
		
		$attrs = array( 
			'preload' => esc_attr($preload) 
		);
		
		if ($poster != '') {
			$attrs['poster'] = esc_url($poster);
		}
		
		if ($autoplay) {
			$attrs['autoplay'] = 'on';
		}
		
		if ($loop) {
			$attrs['loop'] = 'on';
		}
		
		if ($srcmp4 != '') {
			$attrs[substr(strrchr($srcmp4, '.'), 1)] = esc_url($srcmp4);
		}
		
		if ($srcogg != '') {
			$attrs[substr(strrchr($srcogg, '.'), 1)] = esc_url($srcogg);
		}
		
		if ($srcwebm != '') {
			$attrs[substr(strrchr($srcwebm, '.'), 1)] = esc_url($srcwebm);
		}
		
		$out .= '<div class="cmsmasters_video">' . 
				wp_video_shortcode($attrs) . 
			'</div>' . 
		'</div>';
		
		echo $out . 
		$after_widget;
    }
	
	function update($new_instance, $old_instance) {
		$instance = $old_instance;
		
		$instance = array( 
			'autoplay' 	=> 0, 
			'loop' 		=> 0 
		);
		
		foreach ($instance as $field => $val) {
			if (isset($new_instance[$field])) {
				$instance[$field] = 1;
			}
		}
		
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['srcmp4'] = strip_tags($new_instance['srcmp4']);
        $instance['srcogg'] = strip_tags($new_instance['srcogg']);
		$instance['srcwebm'] = strip_tags($new_instance['srcwebm']);
		$instance['poster'] = strip_tags($new_instance['poster']);
		$instance['text'] = strip_tags($new_instance['text']);
		$instance['preload'] = strip_tags($new_instance['preload']);
		
		return $instance;
	}
	
    function form($instance) {
        $title = isset($instance['title']) ? esc_attr($instance['title']) : '';
		$srcmp4 = isset($instance['srcmp4']) ? esc_attr($instance['srcmp4']) : '';
		$srcogg = isset($instance['srcogg']) ? esc_attr($instance['srcogg']) : '';
		$srcwebm = isset($instance['srcwebm']) ? esc_attr($instance['srcwebm']) : '';
		$poster = isset($instance['poster']) ? esc_attr($instance['poster']) : '';
		$text = (isset($instance['text']) && $instance['text'] != '') ? esc_attr($instance['text']) : esc_attr__('Your browser does not support the video tag.', 'cmsmasters-content-composer');
		$preload = isset($instance['preload']) ? esc_attr($instance['preload']) : 'none';
		
		$instance = wp_parse_args((array) $instance, array( 
			'autoplay' 	=> false, 
			'loop' 		=> false 
		) );
        ?>
        <p class="l_half">
            <label for="<?php echo esc_attr($this->get_field_id('title')); ?>"><?php esc_html_e('Title', 'cmsmasters-content-composer'); ?>:<br />
                <input class="widefat" id="<?php echo esc_attr($this->get_field_id('title')); ?>" name="<?php echo esc_attr($this->get_field_name('title')); ?>" type="text" value="<?php echo esc_attr($title); ?>" />
            </label>
        </p>
        <p class="r_half">
            <label for="<?php echo esc_attr($this->get_field_id('srcmp4')); ?>"><?php echo esc_html__('Video', 'cmsmasters-content-composer') . ' .mp4 ' . esc_html__('File Format Source', 'cmsmasters-content-composer'); ?>:<br />
                <input class="widefat" id="<?php echo esc_attr($this->get_field_id('srcmp4')); ?>" name="<?php echo esc_attr($this->get_field_name('srcmp4')); ?>" type="text" value="<?php echo esc_attr($srcmp4); ?>" />
            </label>
        </p>
        <p class="l_half">
            <label for="<?php echo esc_attr($this->get_field_id('srcogg')); ?>"><?php echo esc_html__('Video', 'cmsmasters-content-composer') . ' .ogg ' . esc_html__('File Format Source', 'cmsmasters-content-composer'); ?>:<br />
                <input class="widefat" id="<?php echo esc_attr($this->get_field_id('srcogg')); ?>" name="<?php echo esc_attr($this->get_field_name('srcogg')); ?>" type="text" value="<?php echo esc_attr($srcogg); ?>" />
            </label>
        </p>
        <p class="r_half">
            <label for="<?php echo esc_attr($this->get_field_id('srcwebm')); ?>"><?php echo esc_html__('Video', 'cmsmasters-content-composer') . ' .webm ' . esc_html__('File Format Source', 'cmsmasters-content-composer'); ?>:<br />
                <input class="widefat" id="<?php echo esc_attr($this->get_field_id('srcwebm')); ?>" name="<?php echo esc_attr($this->get_field_name('srcwebm')); ?>" type="text" value="<?php echo esc_attr($srcwebm); ?>" />
            </label>
        </p>
        <p class="l_half">
            <label for="<?php echo esc_attr($this->get_field_id('poster')); ?>"><?php esc_html_e('Poster URL', 'cmsmasters-content-composer'); ?>:<br />
                <input class="widefat" id="<?php echo esc_attr($this->get_field_id('poster')); ?>" name="<?php echo esc_attr($this->get_field_name('poster')); ?>" type="text" value="<?php echo esc_attr($poster); ?>" />
            </label>
        </p>
        <p class="r_half">
            <label for="<?php echo esc_attr($this->get_field_id('preload')); ?>"><?php esc_html_e('Preload', 'cmsmasters-content-composer'); ?>:<br />
				<select class="widefat" id="<?php echo esc_attr($this->get_field_id('preload')); ?>" name="<?php echo esc_attr($this->get_field_name('preload')); ?>">
					<option value="none"<?php if ($preload == 'none') { echo ' selected="selected"'; } ?>><?php esc_html_e('Not Preload', 'cmsmasters-content-composer'); ?></option>
					<option value="auto"<?php if ($preload == 'auto') { echo ' selected="selected"'; } ?>><?php esc_html_e('Preload Auto', 'cmsmasters-content-composer'); ?></option>
					<option value="metadata"<?php if ($preload == 'metadata') { echo ' selected="selected"'; } ?>><?php esc_html_e('Preload as Metadata', 'cmsmasters-content-composer'); ?></option>
				</select>
            </label>
        </p>
        <p class="l_half">
			<input class="checkbox" type="checkbox" <?php checked($instance['autoplay'], true); ?> id="<?php echo esc_attr($this->get_field_id('autoplay')); ?>" name="<?php echo esc_attr($this->get_field_name('autoplay')); ?>" /> 
			<label for="<?php echo esc_attr($this->get_field_id('autoplay')); ?>"><?php esc_html_e('Enable Autoplay', 'cmsmasters-content-composer'); ?></label>
        </p>
        <p class="r_half">
			<input class="checkbox" type="checkbox" <?php checked($instance['loop'], true); ?> id="<?php echo esc_attr($this->get_field_id('loop')); ?>" name="<?php echo esc_attr($this->get_field_name('loop')); ?>" /> 
			<label for="<?php echo esc_attr($this->get_field_id('loop')); ?>"><?php esc_html_e('Enable Repeat', 'cmsmasters-content-composer'); ?></label>
        </p>
        <div class="cl"></div>
        <?php
    }
}


function cmsmasters_composer_wp_custom_widgets_init() {
	if (!is_blog_installed()) {
		return;
	}
	
	$cmsmasters_custom_widgets = array();
	
	$cmsmasters_custom_widgets = apply_filters('cmsmasters_custom_widgets_filter', $cmsmasters_custom_widgets);
	
	
	if (!empty($cmsmasters_custom_widgets)) {
		foreach ($cmsmasters_custom_widgets as $cmsmasters_custom_widget) {
			register_widget($cmsmasters_custom_widget);
		}
	}
}

add_action('widgets_init', 'cmsmasters_composer_wp_custom_widgets_init', 1);


function cmsmasters_composer_add_custom_widgets($widgets) {
	$widgets[] = 'WP_Widget_Custom_Advertisement';
	
	$widgets[] = 'WP_Widget_Custom_Divider';
	
	$widgets[] = 'WP_Widget_Custom_Facebook';
	
	$widgets[] = 'WP_Widget_Custom_Flickr';
	
	
	if (version_compare(get_bloginfo('version'), '4.8', '<')) {
		$widgets[] = 'WP_Widget_Custom_Video';
		
		$widgets[] = 'WP_Widget_Custom_HTML5_Audio';
		
		$widgets[] = 'WP_Widget_Custom_HTML5_Video';
	}
	
	return $widgets;
}

add_filter('cmsmasters_custom_widgets_filter', 'cmsmasters_composer_add_custom_widgets');

