<?php 
/**
 * @package 	WordPress
 * @subpackage 	Schule
 * @version		1.0.0
 * 
 * Admin Panel Post, Project, Profile Settings
 * Created by CMSMasters
 * 
 */


function schule_options_single_tabs() {
	$tabs = array();
	
	
	$tabs['post'] = esc_attr__('Post', 'schule');
	
	if (CMSMASTERS_PROJECT_COMPATIBLE && class_exists('Cmsmasters_Projects')) {
		$tabs['project'] = esc_attr__('Project', 'schule');
	}
	
	if (CMSMASTERS_PROFILE_COMPATIBLE && class_exists('Cmsmasters_Profiles')) {
		$tabs['profile'] = esc_attr__('Profile', 'schule');
	}
	
	
	return apply_filters('cmsmasters_options_single_tabs_filter', $tabs);
}


function schule_options_single_sections() {
	$tab = schule_get_the_tab();
	
	
	switch ($tab) {
	case 'post':
		$sections = array();
		
		$sections['post_section'] = esc_attr__('Blog Post Options', 'schule');
		
		
		break;
	case 'project':
		$sections = array();
		
		$sections['project_section'] = esc_attr__('Portfolio Project Options', 'schule');
		
		
		break;
	case 'profile':
		$sections = array();
		
		$sections['profile_section'] = esc_attr__('Person Block Profile Options', 'schule');
		
		
		break;
	default:
		$sections = array();
		
		
		break;
	}
	
	
	return apply_filters('cmsmasters_options_single_sections_filter', $sections, $tab);
} 


function schule_options_single_fields($set_tab = false) {
	if ($set_tab) {
		$tab = $set_tab;
	} else {
		$tab = schule_get_the_tab();
	}
	
	
	$options = array();
	
	
	$defaults = schule_settings_single_defaults();
	
	
	switch ($tab) {
	case 'post':
		$options[] = array( 
			'section' => 'post_section', 
			'id' => 'schule' . '_blog_post_layout', 
			'title' => esc_html__('Layout Type', 'schule'), 
			'desc' => '', 
			'type' => 'radio_img', 
			'std' => $defaults[$tab]['schule' . '_blog_post_layout'], 
			'choices' => array( 
				esc_html__('Right Sidebar', 'schule') . '|' . get_template_directory_uri() . '/framework/admin/inc/img/sidebar_r.jpg' . '|r_sidebar', 
				esc_html__('Left Sidebar', 'schule') . '|' . get_template_directory_uri() . '/framework/admin/inc/img/sidebar_l.jpg' . '|l_sidebar', 
				esc_html__('Full Width', 'schule') . '|' . get_template_directory_uri() . '/framework/admin/inc/img/fullwidth.jpg' . '|fullwidth' 
			) 
		);
		
		$options[] = array( 
			'section' => 'post_section', 
			'id' => 'schule' . '_blog_post_title', 
			'title' => esc_html__('Post Title', 'schule'), 
			'desc' => esc_html__('show', 'schule'), 
			'type' => 'checkbox', 
			'std' => $defaults[$tab]['schule' . '_blog_post_title'] 
		);
		
		$options[] = array( 
			'section' => 'post_section', 
			'id' => 'schule' . '_blog_post_date', 
			'title' => esc_html__('Post Date', 'schule'), 
			'desc' => esc_html__('show', 'schule'), 
			'type' => 'checkbox', 
			'std' => $defaults[$tab]['schule' . '_blog_post_date'] 
		);
		
		$options[] = array( 
			'section' => 'post_section', 
			'id' => 'schule' . '_blog_post_cat', 
			'title' => esc_html__('Post Categories', 'schule'), 
			'desc' => esc_html__('show', 'schule'), 
			'type' => 'checkbox', 
			'std' => $defaults[$tab]['schule' . '_blog_post_cat'] 
		);
		
		$options[] = array( 
			'section' => 'post_section', 
			'id' => 'schule' . '_blog_post_author', 
			'title' => esc_html__('Post Author', 'schule'), 
			'desc' => esc_html__('show', 'schule'), 
			'type' => 'checkbox', 
			'std' => $defaults[$tab]['schule' . '_blog_post_author'] 
		);
		
		$options[] = array( 
			'section' => 'post_section', 
			'id' => 'schule' . '_blog_post_comment', 
			'title' => esc_html__('Post Comments', 'schule'), 
			'desc' => esc_html__('show', 'schule'), 
			'type' => 'checkbox', 
			'std' => $defaults[$tab]['schule' . '_blog_post_comment'] 
		);
		
		$options[] = array( 
			'section' => 'post_section', 
			'id' => 'schule' . '_blog_post_tag', 
			'title' => esc_html__('Post Tags', 'schule'), 
			'desc' => esc_html__('show', 'schule'), 
			'type' => 'checkbox', 
			'std' => $defaults[$tab]['schule' . '_blog_post_tag'] 
		);
		
		$options[] = array( 
			'section' => 'post_section', 
			'id' => 'schule' . '_blog_post_like', 
			'title' => esc_html__('Post Likes', 'schule'), 
			'desc' => esc_html__('show', 'schule'), 
			'type' => 'checkbox', 
			'std' => $defaults[$tab]['schule' . '_blog_post_like'] 
		);
		
		$options[] = array( 
			'section' => 'post_section', 
			'id' => 'schule' . '_blog_post_nav_box', 
			'title' => esc_html__('Posts Navigation Box', 'schule'), 
			'desc' => esc_html__('show', 'schule'), 
			'type' => 'checkbox', 
			'std' => $defaults[$tab]['schule' . '_blog_post_nav_box'] 
		);
		
		$options[] = array( 
			'section' => 'post_section', 
			'id' => 'schule' . '_blog_post_nav_order_cat', 
			'title' => esc_html__('Posts Navigation Order by Category', 'schule'), 
			'desc' => esc_html__('enable', 'schule'), 
			'type' => 'checkbox', 
			'std' => $defaults[$tab]['schule' . '_blog_post_nav_order_cat'] 
		);
		
		if (class_exists('Cmsmasters_Content_Composer')) {
			$options[] = array( 
				'section' => 'post_section', 
				'id' => 'schule' . '_blog_post_share_box', 
				'title' => esc_html__('Sharing Box', 'schule'), 
				'desc' => esc_html__('show', 'schule'), 
				'type' => 'checkbox', 
				'std' => $defaults[$tab]['schule' . '_blog_post_share_box'] 
			);
		}
		
		$options[] = array( 
			'section' => 'post_section', 
			'id' => 'schule' . '_blog_post_author_box', 
			'title' => esc_html__('About Author Box', 'schule'), 
			'desc' => esc_html__('show', 'schule'), 
			'type' => 'checkbox', 
			'std' => $defaults[$tab]['schule' . '_blog_post_author_box'] 
		);
		
		$options[] = array( 
			'section' => 'post_section', 
			'id' => 'schule' . '_blog_more_posts_box', 
			'title' => esc_html__('More Posts Box', 'schule'), 
			'desc' => '', 
			'type' => 'select', 
			'std' => $defaults[$tab]['schule' . '_blog_more_posts_box'], 
			'choices' => array( 
				esc_html__('Show Related Posts', 'schule') . '|related', 
				esc_html__('Show Popular Posts', 'schule') . '|popular', 
				esc_html__('Show Recent Posts', 'schule') . '|recent', 
				esc_html__('Hide More Posts Box', 'schule') . '|hide' 
			) 
		);
		
		$options[] = array( 
			'section' => 'post_section', 
			'id' => 'schule' . '_blog_more_posts_count', 
			'title' => esc_html__('More Posts Box Items Number', 'schule'), 
			'desc' => esc_html__('posts', 'schule'), 
			'type' => 'number', 
			'std' => $defaults[$tab]['schule' . '_blog_more_posts_count'], 
			'min' => '2', 
			'max' => '20' 
		);
		
		$options[] = array( 
			'section' => 'post_section', 
			'id' => 'schule' . '_blog_more_posts_pause', 
			'title' => esc_html__('More Posts Slider Pause Time', 'schule'), 
			'desc' => esc_html__("in seconds, if '0' - autoslide disabled", 'schule'), 
			'type' => 'number', 
			'std' => $defaults[$tab]['schule' . '_blog_more_posts_pause'], 
			'min' => '0', 
			'max' => '20' 
		);
		
		
		break;
	case 'project':
		$options[] = array( 
			'section' => 'project_section', 
			'id' => 'schule' . '_portfolio_project_title', 
			'title' => esc_html__('Project Title', 'schule'), 
			'desc' => esc_html__('show', 'schule'), 
			'type' => 'checkbox', 
			'std' => $defaults[$tab]['schule' . '_portfolio_project_title'] 
		);
		
		$options[] = array( 
			'section' => 'project_section', 
			'id' => 'schule' . '_portfolio_project_details_title', 
			'title' => esc_html__('Project Details Title', 'schule'), 
			'desc' => esc_html__('Enter a project details block title', 'schule'), 
			'type' => 'text', 
			'std' => $defaults[$tab]['schule' . '_portfolio_project_details_title'], 
			'class' => '' 
		);
		
		$options[] = array( 
			'section' => 'project_section', 
			'id' => 'schule' . '_portfolio_project_date', 
			'title' => esc_html__('Project Date', 'schule'), 
			'desc' => esc_html__('show', 'schule'), 
			'type' => 'checkbox', 
			'std' => $defaults[$tab]['schule' . '_portfolio_project_date'] 
		);
		
		$options[] = array( 
			'section' => 'project_section', 
			'id' => 'schule' . '_portfolio_project_cat', 
			'title' => esc_html__('Project Categories', 'schule'), 
			'desc' => esc_html__('show', 'schule'), 
			'type' => 'checkbox', 
			'std' => $defaults[$tab]['schule' . '_portfolio_project_cat'] 
		);
		
		$options[] = array( 
			'section' => 'project_section', 
			'id' => 'schule' . '_portfolio_project_author', 
			'title' => esc_html__('Project Author', 'schule'), 
			'desc' => esc_html__('show', 'schule'), 
			'type' => 'checkbox', 
			'std' => $defaults[$tab]['schule' . '_portfolio_project_author'] 
		);
		
		$options[] = array( 
			'section' => 'project_section', 
			'id' => 'schule' . '_portfolio_project_comment', 
			'title' => esc_html__('Project Comments', 'schule'), 
			'desc' => esc_html__('show', 'schule'), 
			'type' => 'checkbox', 
			'std' => $defaults[$tab]['schule' . '_portfolio_project_comment'] 
		);
		
		$options[] = array( 
			'section' => 'project_section', 
			'id' => 'schule' . '_portfolio_project_tag', 
			'title' => esc_html__('Project Tags', 'schule'), 
			'desc' => esc_html__('show', 'schule'), 
			'type' => 'checkbox', 
			'std' => $defaults[$tab]['schule' . '_portfolio_project_tag'] 
		);
		
		$options[] = array( 
			'section' => 'project_section', 
			'id' => 'schule' . '_portfolio_project_like', 
			'title' => esc_html__('Project Likes', 'schule'), 
			'desc' => esc_html__('show', 'schule'), 
			'type' => 'checkbox', 
			'std' => $defaults[$tab]['schule' . '_portfolio_project_like'] 
		);
		
		$options[] = array( 
			'section' => 'project_section', 
			'id' => 'schule' . '_portfolio_project_link', 
			'title' => esc_html__('Project Link', 'schule'), 
			'desc' => esc_html__('show', 'schule'), 
			'type' => 'checkbox', 
			'std' => $defaults[$tab]['schule' . '_portfolio_project_link'] 
		);
		
		$options[] = array( 
			'section' => 'project_section', 
			'id' => 'schule' . '_portfolio_project_share_box', 
			'title' => esc_html__('Sharing Box', 'schule'), 
			'desc' => esc_html__('show', 'schule'), 
			'type' => 'checkbox', 
			'std' => $defaults[$tab]['schule' . '_portfolio_project_share_box'] 
		);
		
		$options[] = array( 
			'section' => 'project_section', 
			'id' => 'schule' . '_portfolio_project_nav_box', 
			'title' => esc_html__('Projects Navigation Box', 'schule'), 
			'desc' => esc_html__('show', 'schule'), 
			'type' => 'checkbox', 
			'std' => $defaults[$tab]['schule' . '_portfolio_project_nav_box'] 
		);
		
		$options[] = array( 
			'section' => 'project_section', 
			'id' => 'schule' . '_portfolio_project_nav_order_cat', 
			'title' => esc_html__('Projects Navigation Order by Category', 'schule'), 
			'desc' => esc_html__('enable', 'schule'), 
			'type' => 'checkbox', 
			'std' => $defaults[$tab]['schule' . '_portfolio_project_nav_order_cat'] 
		);
		
		$options[] = array( 
			'section' => 'project_section', 
			'id' => 'schule' . '_portfolio_project_author_box', 
			'title' => esc_html__('About Author Box', 'schule'), 
			'desc' => esc_html__('show', 'schule'), 
			'type' => 'checkbox', 
			'std' => $defaults[$tab]['schule' . '_portfolio_project_author_box'] 
		);
		
		$options[] = array( 
			'section' => 'project_section', 
			'id' => 'schule' . '_portfolio_more_projects_box', 
			'title' => esc_html__('More Projects Box', 'schule'), 
			'desc' => '', 
			'type' => 'select', 
			'std' => $defaults[$tab]['schule' . '_portfolio_more_projects_box'], 
			'choices' => array( 
				esc_html__('Show Related Projects', 'schule') . '|related', 
				esc_html__('Show Popular Projects', 'schule') . '|popular', 
				esc_html__('Show Recent Projects', 'schule') . '|recent', 
				esc_html__('Hide More Projects Box', 'schule') . '|hide' 
			) 
		);
		
		$options[] = array( 
			'section' => 'project_section', 
			'id' => 'schule' . '_portfolio_more_projects_count', 
			'title' => esc_html__('More Projects Box Items Number', 'schule'), 
			'desc' => esc_html__('projects', 'schule'), 
			'type' => 'number', 
			'std' => $defaults[$tab]['schule' . '_portfolio_more_projects_count'], 
			'min' => '2', 
			'max' => '20' 
		);
		
		$options[] = array( 
			'section' => 'project_section', 
			'id' => 'schule' . '_portfolio_more_projects_pause', 
			'title' => esc_html__('More Projects Slider Pause Time', 'schule'), 
			'desc' => esc_html__("in seconds, if '0' - autoslide disabled", 'schule'), 
			'type' => 'number', 
			'std' => $defaults[$tab]['schule' . '_portfolio_more_projects_pause'], 
			'min' => '0', 
			'max' => '20' 
		);
		
		$options[] = array( 
			'section' => 'project_section', 
			'id' => 'schule' . '_portfolio_project_slug', 
			'title' => esc_html__('Project Slug', 'schule'), 
			'desc' => esc_html__('Enter a page slug that should be used for your projects single item', 'schule'), 
			'type' => 'text', 
			'std' => $defaults[$tab]['schule' . '_portfolio_project_slug'], 
			'class' => '' 
		);
		
		$options[] = array( 
			'section' => 'project_section', 
			'id' => 'schule' . '_portfolio_pj_categs_slug', 
			'title' => esc_html__('Project Categories Slug', 'schule'), 
			'desc' => esc_html__('Enter page slug that should be used on projects categories archive page', 'schule'), 
			'type' => 'text', 
			'std' => $defaults[$tab]['schule' . '_portfolio_pj_categs_slug'], 
			'class' => '' 
		);
		
		$options[] = array( 
			'section' => 'project_section', 
			'id' => 'schule' . '_portfolio_pj_tags_slug', 
			'title' => esc_html__('Project Tags Slug', 'schule'), 
			'desc' => esc_html__('Enter page slug that should be used on projects tags archive page', 'schule'), 
			'type' => 'text', 
			'std' => $defaults[$tab]['schule' . '_portfolio_pj_tags_slug'], 
			'class' => '' 
		);
		
		
		break;
	case 'profile':
		$options[] = array( 
			'section' => 'profile_section', 
			'id' => 'schule' . '_profile_post_title', 
			'title' => esc_html__('Profile Title', 'schule'), 
			'desc' => esc_html__('show', 'schule'), 
			'type' => 'checkbox', 
			'std' => $defaults[$tab]['schule' . '_profile_post_title'] 
		);
		
		$options[] = array( 
			'section' => 'profile_section', 
			'id' => 'schule' . '_profile_post_details_title', 
			'title' => esc_html__('Profile Details Title', 'schule'), 
			'desc' => esc_html__('Enter a profile details block title', 'schule'), 
			'type' => 'text', 
			'std' => $defaults[$tab]['schule' . '_profile_post_details_title'], 
			'class' => '' 
		);
		
		$options[] = array( 
			'section' => 'profile_section', 
			'id' => 'schule' . '_profile_post_cat', 
			'title' => esc_html__('Profile Categories', 'schule'), 
			'desc' => esc_html__('show', 'schule'), 
			'type' => 'checkbox', 
			'std' => $defaults[$tab]['schule' . '_profile_post_cat'] 
		);
		
		$options[] = array( 
			'section' => 'profile_section', 
			'id' => 'schule' . '_profile_post_comment', 
			'title' => esc_html__('Profile Comments', 'schule'), 
			'desc' => esc_html__('show', 'schule'), 
			'type' => 'checkbox', 
			'std' => $defaults[$tab]['schule' . '_profile_post_comment'] 
		);
		
		$options[] = array( 
			'section' => 'profile_section', 
			'id' => 'schule' . '_profile_post_like', 
			'title' => esc_html__('Profile Likes', 'schule'), 
			'desc' => esc_html__('show', 'schule'), 
			'type' => 'checkbox', 
			'std' => $defaults[$tab]['schule' . '_profile_post_like'] 
		);
		
		$options[] = array( 
			'section' => 'profile_section', 
			'id' => 'schule' . '_profile_post_nav_box', 
			'title' => esc_html__('Profiles Navigation Box', 'schule'), 
			'desc' => esc_html__('show', 'schule'), 
			'type' => 'checkbox', 
			'std' => $defaults[$tab]['schule' . '_profile_post_nav_box'] 
		);
		
		$options[] = array( 
			'section' => 'profile_section', 
			'id' => 'schule' . '_profile_post_nav_order_cat', 
			'title' => esc_html__('Profiles Navigation Order by Category', 'schule'), 
			'desc' => esc_html__('enable', 'schule'), 
			'type' => 'checkbox', 
			'std' => $defaults[$tab]['schule' . '_profile_post_nav_order_cat'] 
		);
		
		$options[] = array( 
			'section' => 'profile_section', 
			'id' => 'schule' . '_profile_post_share_box', 
			'title' => esc_html__('Sharing Box', 'schule'), 
			'desc' => esc_html__('show', 'schule'), 
			'type' => 'checkbox', 
			'std' => $defaults[$tab]['schule' . '_profile_post_share_box'] 
		);
		
		$options[] = array( 
			'section' => 'profile_section', 
			'id' => 'schule' . '_profile_post_slug', 
			'title' => esc_html__('Profile Slug', 'schule'), 
			'desc' => esc_html__('Enter a page slug that should be used for your profiles single item', 'schule'), 
			'type' => 'text', 
			'std' => $defaults[$tab]['schule' . '_profile_post_slug'], 
			'class' => '' 
		);
		
		$options[] = array( 
			'section' => 'profile_section', 
			'id' => 'schule' . '_profile_pl_categs_slug', 
			'title' => esc_html__('Profile Categories Slug', 'schule'), 
			'desc' => esc_html__('Enter page slug that should be used on profiles categories archive page', 'schule'), 
			'type' => 'text', 
			'std' => $defaults[$tab]['schule' . '_profile_pl_categs_slug'], 
			'class' => '' 
		);
		
		
		break;
	}
	
	
	return apply_filters('cmsmasters_options_single_fields_filter', $options, $tab);
}

