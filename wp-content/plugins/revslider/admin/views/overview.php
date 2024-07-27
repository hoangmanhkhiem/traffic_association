<?php
/**
 * @author    ThemePunch <info@themepunch.com>
 * @link      https://www.themepunch.com/
 * @copyright 2024 ThemePunch
 */

if(!defined('ABSPATH')) exit();
global $SR_GLOBALS;

$system_config	= $rsaf->get_system_requirements();
$current_user	= wp_get_current_user();
$revslider_valid = $rsaf->_truefalse(get_option('revslider-valid', 'false'));
$latest_version	= get_option('revslider-latest-version', RS_REVISION);
$stable_version	= get_option('revslider-stable-version', '4.2');
$latest_version	= ($revslider_valid !== true && version_compare($latest_version, $stable_version, '<')) ? $stable_version : $latest_version;
$code			= get_option('revslider-code', '');
$time			= date('H');
$timezone		= date('e');/* Set the $timezone variable to become the current timezone */
$hi				= __('Good Evening ', 'revslider');
$selling 		= $rsaf->get_addition('selling');
$rs_front_version = $rsaf->get_val($SR_GLOBALS, 'front_version', 7);
if($time < '12'){
	$hi = __('Good Morning ', 'revslider');
}elseif($time >= '12' && $time < '17'){
	$hi = __('Good Afternoon ', 'revslider');
}
$rs_languages	= $rsaf->get_available_languages();
?>
<div id="rb_tlw">
	<?php
	// INCLUDE NEEDED CONTAINERS
	require_once(RS_PLUGIN_PATH . 'admin/views/modals-general.php');
	require_once(RS_PLUGIN_PATH . 'admin/views/modals-overview.php');
	require_once(RS_PLUGIN_PATH . 'admin/views/modals-copyright.php');
	?>
</div>



<div id="rs_overview_menu" class="_TPRB_">
	<div class="rso_scrollmenuitem" data-ref="#rs_overview" ><i class="material-icons">view_module</i><?php _e('Modules', 'revslider');?></div>
	<div class="rso_scrollmenuitem" data-ref="#plugin_update_row" ><i class="material-icons">update</i><?php _e('Updates', 'revslider');?></div>
	<div class="rso_scrollmenuitem" data-ref="#plugin_activation_row"><i class="material-icons">vpn_key</i><?php _e('Activation', 'revslider');?></div>
	<div class="rso_scrollmenuitem" data-ref="#plugin_news_row"><i class="material-icons">library_books</i><?php _e('News', 'revslider');?></div>
	<div class="rso_scrollmenuitem" id="globalsettings" ><i class="material-icons">settings</i><?php _e('Globals', 'revslider');?></div>
	<div class="rso_scrollmenuitem" id="linktodocumentation" ><i class="material-icons">chrome_reader_mode</i><?php _e('FAQ\'s', 'revslider');?></div>
	<div class="rso_scrollmenuitem" id="contactsupport" ><i class="material-icons">contact_support</i><?php _e('Support', 'revslider');?></div>
	<!--<div class="rso_scrollmenuitem lilabuybutton" id="buynow_notregistered"><?php _e('Buy Now', 'revslider');?></div>-->
	<div class="rso_scrollmenuitem" id="rso_menu_notices"><div id="rs_notice_bell" class="notice_level_2"><i id="rs_notice_the_bell" class="material-icons">notifications_active</i></div><div class="notice_level_2" id="rs_notice_counter">0</div><ul id="rs_notices_wrapper"></ul></div>
</div>
<div id="rs_overview" class="rs_overview _TPRB_">
	<div id="rsalienfakeplaceholder"></div>
	<!-- WELCOME TO SLIDER REVOLUTION -->
	<div id="rs_welcome_header_area">
		<h2 id="rs_welcome_h2" class="title"><?php echo $hi; echo $current_user->display_name; echo '!'; ?></h2>
		<h3 id="rs_welcome_h3" class="subtitle"><?php _e('You are running Slider Revolution ', 'revslider'); echo RS_REVISION; ?></h3>
		<?php if ($selling === true) { ?>	
			<a href="https://account.sliderrevolution.com/portal/?utm_source=admin&utm_medium=button&utm_campaign=srusers&utm_content=members" target="_blank" rel="noopener" id="rs_memarea_registered" class="basic_action_button longbutton basic_action_lilabutton"><i class="material-icons">person_outline</i><?php _e('Members Area', 'revslider');?></a>
			<!-- <a href="https://account.sliderrevolution.com/portal/?utm_source=admin&utm_medium=button&utm_campaign=srusers&utm_content=members" target="_blank" rel="noopener" id="rs_memarea"></a>					  -->
		<?php } ?>		
	</div>
	
	<div id="sr67-versionbadge" class="<?php echo ($rs_front_version == 7) ? 'v_velocity' : 'v_genesis'; ?>">
		<i class="sr67-badgeicon"><svg xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 -960 960 960" width="24"><path d="M440-280h80v-240h-80v240Zm40-320q17 0 28.5-11.5T520-640q0-17-11.5-28.5T480-680q-17 0-28.5 11.5T440-640q0 17 11.5 28.5T480-600Zm0 520q-83 0-156-31.5T197-197q-54-54-85.5-127T80-480q0-83 31.5-156T197-763q54-54 127-85.5T480-880q83 0 156 31.5T763-763q54 54 85.5 127T880-480q0 83-31.5 156T763-197q-54 54-127 85.5T480-80Zm0-80q134 0 227-93t93-227q0-134-93-227t-227-93q-134 0-227 93t-93 227q0 134 93 227t227 93Zm0-320Z"/></svg></i>
		<div class="sr67-badge-left">
			<div class="simpletext"><?php _e('Frontend Engine', 'revslider');?></div>
			<div id="sr67-engine">SR<?php echo $rs_front_version; ?></div>
		</div><!--
		--><div class="sr67-badge-right">
			<a class="lilasmallbutton" href="https://www.sliderrevolution.com/sr7-velocity-frontend-engine-update/" target="_blank" rel="noopener"><?php _e('Update Guide', 'revslider');?></a>			
			<div id="open_velocity_checklist" class="is_genesis bluesmallbutton" style="margin-left:8px;"><?php _e('Switch to SR7 Engine', 'revslider');?></div>
		</div>
		<div class="sr67-tooltip">
			<div class="is_velocity sr67-tooptip-title"><?php _e("Congratulations!",'revslider');?><br><?php _e("You're running the new",'revslider');?><br><?php _e('SR7 "Velocity" Frontend Engine,', 'revslider');?><br><?php _e("ensuring Future-Proof Performance.", 'revslider');?></div>
			<div class="is_genesis sr67-tooptip-title"><?php _e("Get Future-Proof and Enhanced",'revslider');?><br><?php _e("Performance Now by Switching to the",'revslider');?><br><?php _e('SR7 "Velocity" Engine.', 'revslider');?></div>
			<div class="div20"></div>
			<div class="is_velocity simpletext"><?php _e("For a full guide & change history, please click",'revslider');?><br><?php _e('"Update Guide" on the left','revslider');?></div>
			<div class="is_genesis simpletext"><?php _e("Not sure what you need to do?",'revslider');?><br><?php _e("No problem. We will handhold you through the",'revslider');?><br><?php _e('process in our "Engine guide" on the left.', 'revslider');?></div>
			<div class="sr67-tooltip-arrow"></div>
		</div>
	</div>

	<div id="sr67-minimigration" class="<?php echo ($rs_front_version == 7) ? 'v_velocity' : 'v_genesis'; ?>">
		<i id="sr7_migration_badgeicon" class="sr67-badgeicon"><sr_pulsing_dot></sr_pulsing_dot></i>
		<div class="sr67-badge-left">
			<div class="simpletext"><?php _e('SR7 Data Migration', 'revslider');?></div>
			<div id="sr67-engine"><span id="sr7_migratedcount">0</span>/<span id="sr7_alltomigrate">0</span></div>
		</div>
	</div>

	<!-- CREATE YOUR SLIDERS -->
	<div id="add_new_slider_wrap">
		<div id="new_blank_slider" class="new_slider_block"><i class="material-icons">movie_filter</i><span class="nsb_title"><?php _e('New Blank Module', 'revslider');?></span></div><!--
		--><div id="new_slider_from_template" class="new_slider_block"><i class="material-icons">style</i><span class="nsb_title"><?php _e('New Module from Template', 'revslider');?></span><div id="new_templates_counter" class="new_elements_available">+ 13</div></div><!--
		--><div id="new_slider_import" class="new_slider_block"><i class="material-icons">file_upload</i><span class="nsb_title"><?php _e('Manual Import', 'revslider');?></span></div><!--
		--><div id="add_on_management" class="new_slider_block"><i class="material-icons">extension</i><span class="nsb_title"><?php _e('AddOns', 'revslider');?></span><div id="new_addons_counter" class="new_elements_available">2</div></div>
	</div>

	<!--LIST AND FILTER OF EXISTIN SLIDERS-->
	<div id="existing_sliders" class="overview_wrap">
		<div id="modulesoverviewheader" class="overview_header">
			<div class="rs_fh_left"><input class="flat_input" id="searchmodules" type="text" placeholder="<?php _e('Search Modules...', 'revslider');?>"/></div>
			<div class="rs_fh_right" style="margin-right:-5px">
				<i class="material-icons reset_select" id="reset_sorting">replay</i><select id="sel_overview_sorting" data-evt="updateSlidersOverview" data-evtparam="#reset_sorting" class="overview_sortby tos2 nosearchbox callEvent" data-theme="autowidth"><option value="datedesc"><?php _e('Sort by Creation', 'revslider');?></option><option value="date"><?php _e('Creation Ascending', 'revslider');?></option><option value="title"><?php _e('Sort by Title', 'revslider');?></option><option value="titledesc"><?php _e('Title Descending', 'revslider');?></option></select>
				<i class="material-icons reset_select" id="reset_filtering">replay</i><select id="sel_overview_filtering" data-evt="updateSlidersOverview" data-evtparam="#reset_filtering" class="overview_filterby tos2 nosearchbox callEvent" data-theme="autowidth"><option value="all"><?php _e('Show all Modules', 'revslider');?></option></select>
				<div data-evt="updateSlidersOverview" id="add_folder" class="action_button"><?php _e('Add Folder', 'revslider');?><i class="material-icons">add</i></div>
			</div>
			<div class="tp-clearfix"></div>
		</div>
		<div class="div15"></div>
		<div class="overview_elements" style="z-index:2"><div class="overview_elements_overlay"></div></div>
		<div class="overview_slide_elements" style="z-index:1"><div class="overview_slide_elements_overlay"></div></div>
		<div id="modulesoverviewfooter" class="overview_header_footer">
			<div class="rs_fh_right" style="margin-right:23px">
				<div class="ov-pagination"></div>			
				<select id="pagination_select_2" data-evt="updateSlidersOverview" class="overview_pagination tos2 nosearchbox callEvent" data-theme="nomargin"><option id="page_per_page_0" value="4"></option><option id="page_per_page_1" selected="selected" value="8"></option><option id="page_per_page_2" value="16"></option><option id="page_per_page_3" value="32"></option><option id="page_per_page_4" value="64"></option><option value="all"><?php _e('Show All', 'revslider');?></option></select>				
			</div>
			<div class="tp-clearfix"></div>
		</div>
		<!-- FOLDER LIST -->
		<div id="slider_folders_wrap"></div>
		<div id="slider_folders_wrap_underlay"></div>
	</div>



	<div class="div150"></div>
	<!-- PLUGIN INFORMATIONS -->	
	<div id="plugin_update_row" class="plugin_inforow">
		<!-- PLUGIN UPDATE -->
		<div class="pli_left">
			<h3 class="pli_title"><?php _e('Plugin Updates', 'revslider');?></h3>
			<grayiconbox><i class="material-icons">flag</i></grayiconbox><div class="pli_twoline"><div class="pli_subtitle"><?php _e('Installed Version', 'revslider');?></div><div class="dynamicval pli_subtitle"><?php echo RS_REVISION; ?></div></div>
			<div class="div10"></div>
			<grayiconbox id="available_version_icon"><i class="material-icons">cloud_download</i></grayiconbox><div id="available_version_content" class="pli_twoline"><div class="pli_subtitle"><?php _e('Available Version', 'revslider');?></div><div class="available_latest_version dynamicval pli_subtitle"><?php echo $latest_version; ?></div></div>
			<darkiconbox id="check_for_updates" class="rfloated"><i class="material-icons">refresh</i></darkiconbox>			
			<div class="div50"></div>
			<bluebutton id="updateplugin"><?php _e('Update Now', 'revslider');?></bluebutton>
			<div class="div75"></div>
			<h3 class="pli_title"><?php _e('System Requirements', 'revslider');?></h3>
			<div id="system_requirements">
				<div id="syscheck_upload_folder_writable" class="system_requirement"><i class="material-icons done_icon">done</i><i class="material-icons warning_icon">warning</i><?php _e('Upload folder writable', 'revslider');?></div>
				<div id="syscheck_memory_limit" class="system_requirement"><i class="material-icons done_icon">done</i><i class="material-icons warning_icon">warning</i><?php _e('Memory Limit', 'revslider');?>&nbsp;(<span>256M</span>)</div>
				<div id="syscheck_upload_max_filesize" class="system_requirement"><i class="material-icons done_icon">done</i><i class="material-icons warning_icon">warning</i><?php _e('Upload Max. Filesize', 'revslider');?>&nbsp;(<span>256M</span>)</div>
				<div id="syscheck_post_max_size" class="system_requirement"><i class="material-icons done_icon">done</i><i class="material-icons warning_icon">warning</i><?php _e('Max. Post Size', 'revslider');?>&nbsp;(<span>256M</span>)</div>
				<div id="syscheck_max_allowed_packet" class="system_requirement"><i class="material-icons done_icon">done</i><i class="material-icons warning_icon">warning</i><?php _e('Max. Allowed Package', 'revslider');?>&nbsp;(<span>16M</span>)</div>
				<div id="syscheck_zlib_enabled" class="system_requirement"><i class="material-icons done_icon">done</i><i class="material-icons warning_icon">warning</i><?php _e('Zlib Library', 'revslider');?></div>
				<div id="syscheck_object_library_writable" class="system_requirement"><i class="material-icons done_icon">done</i><i class="material-icons warning_icon">warning</i><?php _e('Object Library', 'revslider');?></div>
				<div id="syscheck_server_connect" class="system_requirement"><i class="material-icons done_icon">done</i><i class="material-icons warning_icon">warning</i><?php _e('ThemePunch Server', 'revslider');?><darkiconbox id="check_for_themepunchserver" class="rfloated"><i class="material-icons">refresh</i></darkiconbox><darkiconbox id="faq_to_systemrequirements" class="rfloated"><a href="https://www.sliderrevolution.com/documentation/system-requirements/" target="_blank" rel="noopener"><i class="material-icons">question_mark</i></a></darkiconbox></div>
			</div>
		</div>
		<!-- PLUGIN HISTORY -->
		<div class="pli_right">
			<h3 class="pli_title"><?php _e('Update History', 'revslider');?></h3>
			<div id="plugin_history" class="pli_update_history"><?php echo file_get_contents(RS_PLUGIN_PATH.'release_log.html'); ?></div>
		</div>
	</div>

	<div class="div150"></div>

	<!-- PLUGIN INFORMATIONS -->	
	<div id="plugin_activation_row" class="plugin_inforow">
		<!-- PLUGIN UPDATE -->
		<div id="activation_area" class="pli_left">	
			<h3 id="activateplugintitle" class="pli_title"><?php echo ($selling === true) ? __('Register License Key', 'revslider') : __('Register Purchase Code', 'revslider');?></h3>
			<row>

				<onehalf style="padding-right:5px"><div id="activated_ornot_box" class="box_with_icon"><i class="material-icons">done</i><?php _e('Registered', 'revslider');?></div></onehalf>
				<onehalf style="padding-left:5px"><a target="_blank" rel="noopener" href="<?php echo ($selling === true) ? 'https://www.sliderrevolution.com/faq/where-to-find-purchase-code/?utm_source=admin&utm_medium=button&utm_campaign=srusers&utm_content=findkey' : 'https://themepunch.com/faq/where-to-find-the-purchase-code/'; ?>" class="box_with_icon"><i class="material-icons">vpn_key</i><?php echo ($selling === true) ? __('Find My Key', 'revslider') : __('Find My Code', 'revslider');?></a></onehalf>
			</row>
			<div class="div10"></div>
			<div id="purchasekey_wrap" class="activated">
				<div id="hide_purchasekey"><?php _e('xxxx xxxx xxxx xxxx', 'revslider');?></div>				
				<input class="codeinput" id="purchasekey" placeholder="<?php echo ($selling === true) ? __('Enter License Key', 'revslider') : __('Enter Purchase Code', 'revslider');?>"/>	
			</div>
			<div class="div25"></div>
			<bluebutton id="activateplugin"><?php echo ($selling === true) ? __('Deregister this Key', 'revslider') : __('Deregister this Code', 'revslider');?></bluebutton>
			<div class="div25"></div>
			<div class="infobox">
				<div class="whitetitle"><?php echo ($selling === true) ? __('1 License Key per Website', 'revslider') : __('1 Purchase Code per Website', 'revslider');?></div>
				<?php if ($selling === true) { ?>
				<div class="simpletext"><?php _e('If you want to use Slider Revolution on another domain, you need to use a different license key.', 'revslider');?></div>
				<?php } else { ?>
				<div class="simpletext"><?php _e('If you want to use Slider Revolution on another domain, you need to use a different license key.', 'revslider');?></div>
				<?php } ?>
				<div class="div25"></div>
				<a class="lilabuybutton" href="https://account.sliderrevolution.com/portal/pricing/?utm_source=admin&utm_medium=button&utm_campaign=srusers&utm_content=buykey" target="_blank" rel="noopener"><?php _e('Buy License Key', 'revslider');?></a>
			</div>
			<div class="div25"></div>
			<div class="infobox">
				<div class="whitetitle" style="display:inline-block"><?php _e('Manage Your Licenses', 'revslider');?></div><div class="rs_new"><?php _e('NEW', 'revslider');?></div>			
				<div class="simpletext"><?php _e('Switch license key registrations, download plugins and get discounts!', 'revslider');?></div>				
				<div class="div25"></div>
				<a class="lilabuybutton" href="https://account.sliderrevolution.com/portal/?utm_source=admin&utm_medium=button&utm_campaign=srusers&utm_content=members" target="_blank" rel="noopener"><?php _e('Go To My Dashboard', 'revslider');?></a>
				<div class="div10"></div>
				<a class="simpletext smalllink" target="_blank" rel="noopener" href="https://www.sliderrevolution.com/get-on-board-the-slider-revolution-dashboard/?utm_source=admin&utm_medium=button&utm_campaign=srusers&utm_content=signup" ><?php _e('I don‘t have a login. How to get access?', 'revslider');?></a>
			</div>
		</div>
		<!-- PLUGIN FEATURES -->
		<div class="pli_right">
			<h3 class="pli_title" id="rs_register_to_unlock"><?php _e('Register to Unlock All Premium Features', 'revslider');?></h3>
			<div class="features_wrapper">				
				<!-- TEMPLATE LIBRARY -->
				<div class="featurebox">
					<div class="box_with_icon not_activated activate_to_unlock"><i class="material-icons">do_not_disturb</i><?php _e('Register to Unlock', 'revslider');?></div>
					<?php require_once(RS_PLUGIN_PATH . 'admin/views/features/premade_template.php'); ?>
				</div><!--				
				--><div class="featurebox">
					<div class="box_with_icon not_activated activate_to_unlock"><i class="material-icons">do_not_disturb</i><?php _e('Register to Unlock', 'revslider');?></div>
					<?php require_once(RS_PLUGIN_PATH . 'admin/views/features/add_ons.php'); ?>					
				</div><!--				
				--><div class="featurebox">
					<div class="box_with_icon not_activated activate_to_unlock"><i class="material-icons">do_not_disturb</i><?php _e('Register to Unlock', 'revslider');?></div>
					<?php require_once(RS_PLUGIN_PATH . 'admin/views/features/object_library.php'); ?>
				</div><!--							
				--><div class="featurebox">
					<div class="box_with_icon not_activated activate_to_unlock"><i class="material-icons">do_not_disturb</i><?php _e('Register to Unlock', 'revslider');?></div>
					<?php require_once(RS_PLUGIN_PATH . 'admin/views/features/support.php'); ?>
				</div>	
			</div>
		</div>
	</div>

	<div class="div150"></div>
	<div id="plugin_news_row" class="plugin_inforow">
		<!-- PLUGIN UPDATE -->
		<div id="cwt_socials" class="pli_left">
			<h3 class="pli_title"><?php _e('Connect with Slider Revolution', 'revslider');?></h3>
			<a class="cwt_link" target="_blank" rel="noopener" href="https://youtube.com/c/sliderrevolution"><grayiconbox class="cwt_youtube"></grayiconbox><div class="pli_twoline"><div class="pli_subtitle"><?php _e('YouTube', 'revslider');?></div><div class="dynamicval pli_subtitle">youtube.com/c/sliderrevolution</div></div></a>
			<div class="div10"></div>
			<a class="cwt_link" target="_blank" rel="noopener" href="https://twitter.com/revslider"><grayiconbox class="cwt_twitter"></grayiconbox><div class="pli_twoline"><div class="pli_subtitle"><?php _e('Twitter', 'revslider');?></div><div class="dynamicval pli_subtitle">twitter.com/revslider</div></div></a>
			<div class="div10"></div>
			<a class="cwt_link" target="_blank" rel="noopener" href="https://www.facebook.com/groups/sliderrevolution.community"><grayiconbox class="cwt_facebook"></grayiconbox><div class="pli_twoline"><div class="pli_subtitle"><?php _e('Facebook', 'revslider');?></div><div class="dynamicval pli_subtitle">facebook.com/.../sliderrevolution.community</div></div></a>
			<div class="div10"></div>
			<a class="cwt_link" target="_blank" rel="noopener" href="https://instagram.com/sliderrevolution"><grayiconbox class="cwt_instagram"></grayiconbox><div class="pli_twoline"><div class="pli_subtitle"><?php _e('Instagram', 'revslider');?></div><div class="dynamicval pli_subtitle">instagram.com/sliderrevolution</div></div></a>
			<div class="div10"></div>			
			<a class="cwt_link" target="_blank" rel="noopener" href="https://dribbble.com/sliderrevolution"><grayiconbox class="cwt_dribbble"></grayiconbox><div class="pli_twoline"><div class="pli_subtitle"><?php _e('Dribbble', 'revslider');?></div><div class="dynamicval pli_subtitle">dribbble.com/sliderrevolution</div></div></a>
			<div class="div100"></div>
			<h3 class="pli_title"><?php _e('Sign up to our Newsletter', 'revslider');?></h3>									
			<!--<input class="codeinput" id="newsletter_mail" placeholder="<?php _e('Enter your Email', 'revslider');?>"/> id="signuptonewsletter" -->
			<a href="https://www.themepunch.com/links/newsletter" target="_blank" rel="noopener"><bluebutton ><?php _e('Sign Up', 'revslider');?></bluebutton></a>
			<div class="div25"></div>
			<div class="infobox">
				<div class="bluetitle"><?php _e('Updates, New Products, Spotlights', 'revslider');?></div>
				<div class="simpletext"><?php _e('Get access to the latest News from Slider Revolution. We promise to never send you Spam!', 'revslider');?></div>
			</div>
		</div>

		<!-- YT NEWS -->
		<div class="pli_right" style="width:100%">
			<h3 class="pli_title"><?php _e('Whats New?', 'revslider');?></h3>
			<div id="rvs_yt_wrapper" class="features_wrapper"></div>
		</div>
	</div>
</div>

<script>
	window.sliderLibrary = JSON.parse(<?php echo $rsaf->json_encode_client_side(array('sliders' => $rs_od)); ?>);
	window.rs_system = JSON.parse(<?php echo $rsaf->json_encode_client_side($system_config); ?>);
	var rvs_f_initOverView_Once = false;
	if (document.readyState === "loading") 
		document.addEventListener('readystatechange',function(){
			if ((document.readyState === "interactive" || document.readyState === "complete") && !rvs_f_initOverView_Once) {
				rvs_f_initOverView_Once = true;
				RVS.ENV.code = "<?php echo $code; ?>";
				RVS.F.initOverView();
			}
		});
	else {
		rvs_f_initOverView_Once = true;
		RVS.F.initOverView();
	}			
</script>
