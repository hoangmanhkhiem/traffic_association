<?php
/**
 * Provide an admin area view for the Slider Modal Options
 *
 * This file is used to markup the admin-facing aspects of the plugin.
 * @author    ThemePunch <info@themepunch.com>
 * @link      https://www.themepunch.com/
 * @copyright 2024 ThemePunch
 */
 
if(!defined('ABSPATH')) exit();
?>

<!-- UNDERLAY FOR MODALS -->
<div id="rb_modal_underlay"></div>

<!-- DECISION MODAL -->
<div class="_TPRB_ rb-modal-wrapper" data-modal="rbm_decisionModal">
	<div class="rb-modal-inner">
		<div class="rb-modal-content">
			<div id="rbm_decisionModal" class="rb_modal form_inner">
				<div class="rbm_header"><i id="decmod_icon" class="rbm_symbol material-icons">info</i><span id="decmod_title" class="rbm_title"><?php _e('Decision Modal Title', 'revslider');?></span></div>
				<div class="rbm_content">
					<div id="decmod_maintxt"></div>
					<div id="decmod_subtxt"></div>
					<div class="div75"></div>
					<div id="decmod_do_btn" class="rbm_darkhalfbutton mr10"><i id="decmod_do_icon" class="material-icons">add_circle_outline</i><span id="decmod_do_txt"><?php _e('Do It', 'revslider');?></span></div><!--
					--><div id="decmod_dont_btn" class="rbm_darkhalfbutton"><i id="decmod_dont_icon" class="material-icons">add_circle_outline</i><span id="decmod_dont_txt"><?php _e('Dont Do It', 'revslider');?></span></div>
				</div>
			</div>
		</div>
	</div>
</div>

<!-- PREVIEW MODAL -->
<div class="_TPRB_ rb-modal-wrapper" data-modal="rbm_preview">
	<div class="rb-modal-inner">
		<div class="rb-modal-content">
			<div id="rbm_preview" class="rb_modal form_inner">
				<div class="rbm_header"><i class="rbm_symbol material-icons">search</i><span class="rbm_title"><?php _e('Preview', 'revslider');?></span><span class="rbm_subtitle"><i class="material-icons">photo</i><span id="rbm_preview_moduletitle">Some Module Title</span></span><span class="rbm_preview_sizes"><i data-ref="d" class="rbm_prev_size_sel material-icons selected">desktop_windows</i><i data-ref="n" class="rbm_prev_size_sel material-icons">laptop</i><i data-ref="t" class="rbm_prev_size_sel material-icons">tablet_mac</i><i data-ref="m" class="rbm_prev_size_sel material-icons">phone_android</i></span><div data-clipboard-action="copy" data-clipboard-target="#copy_shortcode_from_preview" class="copypreviewshortcode basic_action_button autosize rightbutton" style="margin-top:10px;margin-right:30px"><i class="material-icons">content_paste</i><?php _e('Copy Embed Code', 'revslider');?></div><i class="rbm_close material-icons">close</i></div>	
				<div class="rbm_content">
					<input style="position:absolute; top:0px; left:0px;height:0px;width:100%; opacity:0; overflow:hidden; outline:none;border:none" class="inputtocopy" id="copy_shortcode_from_preview" readonly="" value="[rev_slider alias=&quot;slider1&quot;][/rev_slider]">
					<div id="rbm_preview_live"></div>
				</div>
			</div>
		</div>
	</div>
</div>

<!--ADDONS INSTALLATION MODAL-->
<div class="_TPRB_ rb-modal-wrapper" data-modal="rbm_addons">
	<div class="rb-modal-inner">
		<div class="rb-modal-content">
			<div id="rbm_addons" class="rb_modal form_inner">
				<div class="rbm_header"><i class="rbm_symbol material-icons">extension</i><span class="rbm_title"><?php _e('Addons', 'revslider');?></span><i class="rbm_close material-icons">close</i><div id="check_addon_updates_wrap"><div id="check_addon_updates" class="basic_action_button autosize"><i class="material-icons">refresh</i><?php _e('Check for Updates', 'revslider');?></div><div id="process_all_addon_updates" class="ale_i_allupdateaddon  basic_action_coloredbutton autosize basic_action_button autosize"><i class="material-icons">get_app</i><?php _e('Update All', 'revslider');?></div></div></div>
				<div id="addon_overviewheader_wrap">
						<div id="addon_overviewheader" class="addon_overview_header">
							<div class="rs_fh_left"><input class="flat_input" id="searchaddons" type="text" placeholder="<?php _e('Search Addons...', 'revslider');?>"/></div>
							<div class="rs_fh_right" style="margin-right:-5px">
								<select id="sel_addon_sorting" data-evt="updateAddonsOverview" data-evtparam="#addon_sorting" class="addon_sortby tos2 nosearchbox callEvent" data-theme="autowidthinmodal"><option value="datedesc"><?php _e('Sort by Date', 'revslider');?></option><option value="pop"><?php _e('Sort by Popularity', 'revslider');?></option><option value="title"><?php _e('Sort by Title', 'revslider');?></option></select>
								<select id="sel_addon_filtering" data-evt="updateAddonsOverview" data-evtparam="#addon_filtering" class="addon_filterby tos2 nosearchbox callEvent" data-theme="autowidthinmodal"><option value="all"><?php _e('Show all Addons', 'revslider');?></option><option value="action"><?php _e('Action Needed', 'revslider');?></option><option value="installed"><?php _e('Installed Addons', 'revslider');?></option><option value="notinstalled"><?php _e('Not Installed Addons', 'revslider');?></option><option value="activated"><?php _e('Activated Addons', 'revslider');?></option></select>							
							</div>
							<div class="tp-clearfix"></div>
						</div>
					</div>
				<div id="rbm_addonlist" class="rbm_content"></div>
				<div id="rbm_addon_details">
					<div class="rbm_addon_details_inner"><div class="div20"></div><div class="ale_i_title"><?php _e('Slider Revolution Addons', 'revslider');?></div><div class="ale_i_content"><?php _e('Please select an Addon to start with.', 'revslider');?></div><div class="div20"></div></div>
				</div>
				<div id="rbm_configpanel_savebtn"><i class="material-icons mr10">save</i><span class="rbm_cp_save_text"><?php _e('Save Configuration', 'revslider');?></span></div>
			</div>
		</div>
	</div>
</div>

<!-- TRACKING MODAL -->
<div class="_TPRB_ rb-modal-wrapper" data-modal="rbm_tracking_firstgo">
	<div class="rb-modal-inner">
		<div class="rb-modal-content">
			<div id="rbm_tracking_firstgo" class="rb_modal form_inner">
				<div id="rbm_des_rocket" class="rbm_deco rbm_des_rocket"></div>
				<div id="rbm_des_charts" class="rbm_deco rbm_des_charts"></div>
				<div id="rbm_des_rsicon" class="rbm_deco rbm_des_rsicon"></div>
				<div class="rbm_header"><i class="rbm_close material-icons">close</i></div>					
				<div class="rbm_content">														
					<div class="mcg_page_title"><?php _e('Help Us Make Slider Revolution Better!','revslider'); ?></div>
					<div class="tracking_content_box">
						<div class="mcg_page_subtitle"><?php _e('I agree to share data related to my Slider Revolution usage<br>with the development team to help improve the plugin.','revslider'); ?></div>
						<div class="mcg_page_content"><?php _e('You can always change this agreement with one click in the Global Settings.','revslider'); ?></div>
						
						<div class="div25"></div>
						<purplebutton id="rbm_track_enable" style="display:inline-block;" class=""><?php _e('Yes, that‘s fine!', 'revslider');?></purplebutton>
						<div class="div10"></div>
						<graybutton id="rbm_track_disable" style="display:inline-block;" class=""><?php _e('No, thanks.', 'revslider');?></graybutton>
						<div class="div50"></div>						
						<a target="_blank" rel="noopener"  href=" https://www.sliderrevolution.com/plugin-privacy-policy/" class="simpletext smalllink" style="display:inline-block;"><?php _e('View our detailled data collection policy', 'revslider');?></a>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<!--DEACTIVATED WARNING MODAL-->
<div class="_TPRB_ rb-modal-wrapper" data-modal="rbm_notactive_warning">
	<div class="rb-modal-inner">
		<div class="rb-modal-content">
			<div id="rbm_notactive_warning" class="rb_modal form_inner">
				<div class="rbm_header"><i class="rbm_close material-icons">close</i></div>	
				<div class="rbm_content">
					<div class="mcg_page mcg_selected">
						<div class="dcenter">							
							<div class="bigredwarning"><i class="material-icons">error_outline</i></div>
							<div class="mcg_page_title warningtext"><?php _e('URGENT', 'revslider');?></div>
							<div class="mcg_page_title"><?php _e('Your Slider Revolution License Has Been Deactivated!', 'revslider');?></div>
							<div><a class="simpletext smalllink" target="_blank" rel="noopener" href="https://www.sliderrevolution.com/faq/why-was-my-slider-revolution-license-deactivated/?utm_source=admin&utm_medium=button&utm_campaign=srusers&utm_content=deactivatedfaq"><?php _e('Wondering why this happened? Click here!', 'revslider');?></a></div>
							<div class="div35"></div>
							<div class="dr_warningbox">
								<div class="mcg_page_subtitle"><i class="material-icons warningicon">block</i></div>
								<div class="div15"></div>
								<div class="mcg_page_subtitle"><?php _e('All of the premium features including templates, media assets,<br>and add-ons have been removed from your website.', 'revslider');?></div>
								<div class="div15"></div>
								<div class="mcg_page_content"><?php _e('We can help you restore everything right now, all you have to do is choose one of<br>the options below:', 'revslider');?></div>
								<div class="div25"></div>
								<purplebutton id="pb_closeandregister" style="display:inline-block; margin-right:10px" class="mcg_next_page"><?php _e('Register Licence Key', 'revslider');?></purplebutton>
								<a target="_blank" rel="noopener"  href="https://account.sliderrevolution.com/portal/?utm_source=admin&utm_medium=button&utm_campaign=srusers&utm_content=members" style="display:inline-block;" class="bluebutton normal mcg_quit_page"><?php _e('Buy License Key', 'revslider');?></a>
								<div class="div10"></div>
							</div>
							<div class="div10"></div>
							<div class="dr_warningbox">
								<div class="mcg_page_subtitle"><i class="material-icons warningicon">do_not_touch</i></div>
								<div class="div15"></div>
								<div class="mcg_page_subtitle"><?php _e('Please note you don’t have access to Premium 1-on-1 support<br>right now ...', 'revslider');?></div>
								<div class="div15"></div>
								<div class="mcg_page_content"><?php _e('.. however, as soon as you reactivate your license, our top-rated support team will<br>ensure that your website is fully functional.', 'revslider');?></div>
								<div class="div25"></div>
								<purplebutton id="pb_closeandregister" style="display:inline-block; margin-right:10px" class="mcg_next_page"><?php _e('Register Licence Key', 'revslider');?></purplebutton>
								<a target="_blank" rel="noopener"  href="https://account.sliderrevolution.com/portal/?utm_source=admin&utm_medium=button&utm_campaign=srusers&utm_content=members" style="display:inline-block;" class="bluebutton normal mcg_quit_page"><?php _e('Buy License Key', 'revslider');?></a>
								<div class="div10"></div>
							</div>													
						</div>						
					</div>										
				</div>
			</div>
		</div>
	</div>
</div>

<!--DEACTIVATED ADDONS WARNING MODAL-->
<div class="_TPRB_ rb-modal-wrapper" data-modal="rbm_notactiveaddon_warning">
	<div class="rb-modal-inner">
		<div class="rb-modal-content">
			<div id="rbm_notactiveaddon_warning" class="rb_modal form_inner">
				<div class="rbm_header"><i class="rbm_close material-icons">close</i></div>	
				<div class="rbm_content">
					<div class="mcg_page mcg_selected">
						<div class="dcenter">							
							<div class="bigyellowwarning"><i class="material-icons">error_outline</i></div>
							<div class="mcg_page_title"><?php _e('There is a problem with some of your<br>Slider Revolution modules', 'revslider');?></div>
							<div class="simpletext"><?php _e('These modules are using <a class="smalllink" target="_blank" rel="noopener" href="https://www.sliderrevolution.com/expand-possibilities-with-addons/?utm_source=admin&utm_medium=button&utm_campaign=srusers&utm_content=addons">addons</a> which are deactivated or not installed:', 'revslider');?></a></div>
							<div class="div45"></div>
							<div id="list_of_deactivated_addons"></div>
							<div class="div55"></div>
							<div class="simpletext"><?php _e('Press the button below to install & activate<br>all addons required by your modules.','revslider'); ?></div>
							<div class="div40"></div>
							<purplebutton id="naa_install_all" class="mcg_next_page"><?php _e('Fix All Addons', 'revslider');?></purplebutton>							
							<div class="div40"></div>
						</div>						
					</div>										
				</div>
			</div>
		</div>
	</div>
</div>


<!--DEACTIVATED ADDONS WARNING MODAL-->
<div class="_TPRB_ rb-modal-wrapper" data-modal="rbm_notmigrated_sr7">
	<div class="rb-modal-inner">
		<div class="rb-modal-content">
			<div id="rbm_notmigrated_sr7" class="rb_modal form_inner">
				<div class="rbm_header"><i class="rbm_close material-icons">close</i></div>	
				<div class="rbm_content">
					<div class="mcg_page mcg_selected">
						<div class="dcenter">							
							<div class="bigyellowwarning"><i class="material-icons">lan</i></div>
							<div class="mcg_page_title"><?php _e('Attention Required:<br>Some Slider Revolution modules encountered errors during SR7 Engine migration.', 'revslider');?></div>							
							<div class="simpletext"><?php _e('Below is a list of modules that need your attention.<br>Despite these issues, affected modules will still function using the old data structure.<br>This may result in reduced performance and lack of future compatibility.','revslider'); ?></div>
							<div class="div45"></div>
							<div id="list_of_tomigrate_modules"></div>		
							<div class="div55"></div>
							<div class="simpletext"><?php _e('To address these migration issues and leverage the full potential of the SR7 Engine, we recommend following our detailed guide. It provides step-by-step instructions to resolve errors and fully upgrade your modules for improved performance and future-proofing.','revslider'); ?></div>					
							<div class="div40"></div>
							<a target="_blank" rel="noopener"  href="https://www.sliderrevolution.com/sr7-velocity-frontend-engine-update/#guidestep7" style="display:inline-block;" class="bluebutton normal mcg_quit_page"><?php _e('Fix Migration Issues', 'revslider');?></a>
							<div class="div40"></div>
						</div>						
					</div>										
				</div>
			</div>
		</div>
	</div>
</div>


<!--CHECKLIST FOR UPDATE-->
<div class="_TPRB_ rb-modal-wrapper" data-modal="rbm_velocity_checklist">
	<div class="rb-modal-inner">
		<div class="rb-modal-content">
			<div id="rbm_velocity_checklist" class="rb_modal form_inner">
				<div class="rbm_header"><i class="rbm_close material-icons">close</i></div>	
				<div class="rbm_content">
					<div class="mcg_page mcg_selected">
						<div class="dcenter">							
							<div class="biglilawarning"></div>							
							<div class="mcg_page_title"><?php _e('Start Using the SR7 "Velocity" Engine for', 'revslider'); ?><br><?php _e('Future-Proof and Enhanced Performance', 'revslider');?></div>
							<div class="div35"></div>
							<div class="dr_warningbox">
								<div class="mcg_page_subtitle"><?php _e('Please check every item on the list in order to unlock','revslider');?><br><?php _e('the power of the SR7 Engine:','revslider') ?></div>
								<div class="div45"></div>
								<div class="v_checkrow" id="velocity_check_1"><div class="v_checklist"><i class="material-icons">check</i></div><div class="mcg_page_content"><?php _e('Yes, I read the','revslider')?></div> <a class="mcg_page_content" href="https://www.sliderrevolution.com/sr7-velocity-frontend-engine-update/" target="_blank" rel="noopener"><?php _e('Update Guide','revslider'); ?></a></div>
								<div class="div20"></div>
								<div class="v_checkrow" id="velocity_check_2"><div class="v_checklist"><i class="material-icons">check</i></div><div class="mcg_page_content" style="opacity:1"><span style="opacity:0.5"><?php _e('Yes, I ran a','revslider')?></span> <a class="mcg_page_content" href="https://www.sliderrevolution.com/sr7-velocity-frontend-engine-update/#guidestep2" target="_blank" rel="noopener"><?php _e('SR7 Engine Pre-Check using the ?srengine=7','revslider'); ?></a><br><span style="opacity:0.5"><?php _e('URL parameter on every page using Slider Revolution','revslider'); ?></span></div></div>
								<div class="div20"></div>
								<div class="v_checkrow" id="velocity_check_3"><div class="v_checklist"><i class="material-icons">check</i></div><div class="mcg_page_content"><?php _e('Yes, I updated any custom or third-party','revslider'); ?></div> <a  class="mcg_page_content" href="https://www.sliderrevolution.com/manual/custom-code-porting-api-reference/" target="_blank"><?php _e('Scripts/CSS','revslider'); ?></a></div>
								<div class="div50"></div>
								<div class="lilabuybutton disabled" id="velocity_go_sr7" style="display:inline-block;width:250px;"><?php _e('Enable SR7 Engine Now', 'revslider');?></div>
								<div class="div10"></div>
								<div class="graybutton" id="velocity_close_checklist" style="display:inline-block; width:250px;"><?php _e("I'm not Ready, yet", 'revslider');?></div>
							</div>
							<div class="div30"></div>
							<a target="_blank" rel="noopener"  href="https://account.sliderrevolution.com/portal/?redirect_to=supportsystem" style="display:inline-block;" class="normal normallink"><?php _e('Feel free to contact us if you have any questions', 'revslider');?></a>
						</div>						
					</div>										
				</div>
			</div>
		</div>
	</div>
</div>


