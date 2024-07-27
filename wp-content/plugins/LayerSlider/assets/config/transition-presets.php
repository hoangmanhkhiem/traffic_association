<?php

$presets = [

	'opening-transition' => [

		[
			'name' => __('Sliding in (from right)', 'LayerSlider'),
			'data' => '{ "styles": {}, "transition": { "offsetxin":"right","easingin":"easeOutQuint","fadein":false}}'
		],

		[
			'name' => __('Falling in (bouncing)', 'LayerSlider'),
			'data' => '{ "styles": {}, "transition": { "offsetyin":"top","durationin":"1500","easingin":"easeOutBounce","fadein":false}}'
		],

		[
			'name' => __('Sliding in & growing (from bottom)', 'LayerSlider'),
			'data' => '{ "styles": {}, "transition": { "offsetyin":"bottom","scalexin":"0","scaleyin":"0","durationin":"750","easingin":"easeOutBack","fadein":false}}'
		],

		[
			'name' => __('Growing (elastic)', 'LayerSlider'),
			'data' => '{ "styles": {}, "transition": { "scalexin":"0","scaleyin":"0","durationin":"1500","easingin":"easeOutElastic","fadein":false}}'
		],

		[
			'name' => __('Spinning & fading in (fast)', 'LayerSlider'),
			'data' => '{ "styles": {}, "transition": { "rotatein":"-720","easingin":"easeOutQuint"}}'
		],

		[
			'name' => __('Rotating in (vertically)', 'LayerSlider'),
			'data' => '{ "styles": {}, "transition": { "rotateyin":"90","durationin":"800","easingin":"easeOutQuad","fadein":false}}'
		],

		[
			'name' => __('Rotating in (swing)', 'LayerSlider'),
			'data' => '{ "styles": {}, "transition": { "rotatexin":"-90","transformoriginin":"center top","durationin":"2000","easingin":"easeOutElastic","fadein":false}}'
		],

		[
			'name' => __('Rotating in (counter-clockwise)', 'LayerSlider'),
			'data' => '{ "styles": {}, "transition": { "rotatein":"180","transformoriginin":"center sliderbottom","durationin":"1500","easingin":"easeOutQuint"}}'
		],

		[
			'name' => __('Hanging (swing)', 'LayerSlider'),
			'data' => '{ "styles": {}, "transition": { "rotatein":"110","transformoriginin":"center slidertop","durationin":"3000","easingin":"easeOutElastic","fadein":false}}'
		],

		[
			'name' => __('Rotating & scaling in (random)', 'LayerSlider'),
			'data' => '{ "styles": {}, "transition": { "scalexin":"1.5","scaleyin":"1.5","rotatein":"random(120,-120)","rotatexin":"random(120,-120)","rotateyin":"random(120,-120)","durationin":"1200","easingin":"easeOutQuart"}}'
		]
	],


	'opening-text-transition' => [
		[
			'name' => __('Rotating text by chars', 'LayerSlider'),
			'data' => '{"styles":{},"transition":{"transitionin":false,"textoverflowin":"visible","textstartatin":"transitioninstart + 0","textstartatintiming":"0","texttypein":"chars_asc","textrotatexin":"-90","texttransformoriginin":"50% 50% 0.4em","textdurationin":"600","textshiftin":"25"}}'
		],

		[
			'name' => __('Moving chars from center', 'LayerSlider'),
			'data' => '{"styles":{},"transition":{"transitionin":false,"textoverflowin":"visible","textstartatin":"transitioninstart + 0","textstartatintiming":"0","texttypein":"chars_center","textoffsetxin":"0|20|-20|40|-40|60|-60|80|-80|100|-100|120|-120|140|-140|160|-160|180|-180|200|-200|220|-220|240|-240|260|-260|280|-280|300|-300|320|-320|340|-340|360|-360|380|-380|400|-400|420|-420|440|-440|460|-460|480|-480|500|-500|520|-520|540|-540|560|-560|580|-580|600|-600|620|-620|640|-640|660|-660|680|-680|","textdurationin":"750","textshiftin":"0","texteasingin":"easeOutCubic"}}'
		],

		[
			'name' => __('Comb-like rotating by chars', 'LayerSlider'),
			'data' => '{"styles":{},"transition":{"transitionin":false,"textoverflowin":"hidden","textstartatin":"transitioninstart + 0","textstartatintiming":"0","texttypein":"chars_asc","textoffsetyin":"100lh|-100lh","textrotatein":"90|-90","textdurationin":"750","textshiftin":"75","texteasingin":"easeOutQuint","textfadein":false}}'
		],

		[
			'name' => __('Random scaling by chars', 'LayerSlider'),
			'data' => '{"styles":{},"transition":{"transitionin":false,"textoverflowin":"visible","textstartatin":"transitioninstart + 0","textstartatintiming":"0","texttypein":"chars_rand","textscalexin":"0","textscaleyin":"2.5lh","textdurationin":"400","texteasingin":"easeInBack","textfadein":false}}'
		],

		[
			'name' => __('Rotating elastic by words', 'LayerSlider'),
			'data' => '{"styles":{},"transition":{"transitionin":false,"textoverflowin":"visible","textstartatin":"transitioninstart + 0","textstartatintiming":"0","texttypein":"words_asc","textscaleyin":"1.2","textrotatein":"30","texttransformoriginin":"right center|left center","textstartatintiming":"transitioninstart","textdurationin":"1500","textshiftin":"100","texteasingin":"easeOutElastic"}}'
		],

		[
			'name' => __('Scaling in from center by chars', 'LayerSlider'),
			'data' => '{"styles":{},"transition":{"transitionin":false,"textoverflowin":"visible","textstartatin":"transitioninstart + 0","textstartatintiming":"0","texttypein":"chars_center","textscaleyin":"0","textdurationin":"500","textshiftin":"20","texteasingin":"easeOutQuint","textfadein":false}}'
		],

		[
			'name' => __('Rotating random from the edges by chars', 'LayerSlider'),
			'data' => '{"styles":{},"transition":{"transitionin":false,"textoverflowin":"visible","textstartatin":"transitioninstart + 0","textstartatintiming":"0","texttypein":"chars_edge","textscaleyin":"2","textrotatein":"random(120,-120)","textstartatintiming":"transitioninstart","textdurationin":"1000","textshiftin":"20","texteasingin":"easeOutQuint"}}'
		],

		[
			'name' => __('Rotating & scaling random by chars', 'LayerSlider'),
			'data' => '{"styles":{},"transition":{"transitionin":false,"textoverflowin":"visible","textstartatin":"transitioninstart + 0","textstartatintiming":"0","texttypein":"chars_asc","textoffsetxin":"random(-100,100)","textoffsetyin":"random(-200,200)","textscalexin":"2","textscaleyin":"2","textrotatein":"random(120,-120)","textrotatexin":"random(120,-120)","textrotateyin":"random(120,-120)","textdurationin":"1500","textshiftin":"0","texteasingin":"easeOutQuad"}}'
		],

		[
			'name' => __('Moving vertically random by chars', 'LayerSlider'),
			'data' => '{"styles":{},"transition":{"transitionin":false,"textoverflowin":"hidden","textstartatin":"transitioninstart + 0","textstartatintiming":"0","texttypein":"chars_rand","textoffsetyin":"-1000lh|1000lh","textdurationin":"600","textshiftin":"40","texteasingin":"easeOutBack","textfadein":false}}'
		],

		[
			'name' => __('Spinning & scaling random by chars', 'LayerSlider'),
			'data' => '{"styles":{},"transition":{"transitionin":false,"textoverflowin":"visible","textstartatin":"transitioninstart + 0","textstartatintiming":"0","texttypein":"chars_rand","textscalexin":"0","textscaleyin":"0","textrotatein":"random(180,720)","texttransformoriginin":"slidercenter slidermiddle","textdurationin":"2000","texteasingin":"easeOutQuint","textfadein":false}}'
		],

		[
			'name' => __('Concentric rotating by chars', 'LayerSlider'),
			'data' => '{"styles":{},"transition":{"transitionin":false,"textoverflowin":"visible","textstartatin":"transitioninstart + 0","textstartatintiming":"0","texttypein":"chars_center","textoffsetxin":"-50|50","textoffsetyin":"50|-50","textrotatein":"90","textshiftin":"20","texteasingin":"easeOutQuint"}}'
		],

		[
			'name' => __('Slot machine random by chars', 'LayerSlider'),
			'data' => '{"styles":{},"transition":{"transitionin":false,"textoverflowin":"visible","textstartatin":"transitioninstart + 0","textstartatintiming":"0","texttypein":"chars_rand","textrotatexin":"630","textdurationin":"800","textshiftin":"30","texteasingin":"easeOutQuint","textfadein":false}}'
		],

		[
			'name' => __('Falling chars from top random', 'LayerSlider'),
			'data' => '{"styles":{},"transition":{"transitionin":false,"textoverflowin":"visible","textstartatin":"transitioninstart + 0","textstartatintiming":"0","texttypein":"chars_rand","textoffsetyin":"top","textrotatein":"random(120,-120)","textshiftin":"100","texteasingin":"easeOutBounce","textfadein":false}}'
		]
	],


	'loop-transition' => [
		[
			'name' => __('Spinning (infinite)', 'LayerSlider'),
			'data' => '{ "styles": {}, "transition": { "looprotate":"360","loopduration":"2000","loopcount":"-1"}}'
		],

		[
			'name' => __('Spinning (3D, infinite)', 'LayerSlider'),
			'data' => '{ "styles": {}, "transition": { "looprotatey":"-360","loopduration":"2000","loopcount":"-1"}}'
		],

		[
			'name' => __('Pulsing (slow, infinite)', 'LayerSlider'),
			'data' => '{ "styles": {}, "transition": { "loopscalex":"1.1","loopscaley":"1.1","loopduration":"1000","loopeasing":"easeInOutQuad","loopcount":"-1","loopyoyo":true}}'
		],

		[
			'name' => __('Levitating (slow, infinite)', 'LayerSlider'),
			'data' => '{ "styles": {}, "transition": { "loopoffsety":"-25lh","loopduration":"2000","loopeasing":"easeInOutQuad","loopcount":"-1","loopyoyo":true}}'
		],

		[
			'name' => __('Getting Attention (pulse, 2x)', 'LayerSlider'),
			'data' => '{ "styles": {}, "transition": { "loopscalex":"1.1","loopscaley":"1.1","loopduration":"200","loopeasing":"easeInOutQuad","loopcount":"2","loopyoyo":true}}'
		],

		[
			'name' => __('Getting Attention (jump, 2x)', 'LayerSlider'),
			'data' => '{ "styles": {}, "transition": { "loopoffsety":"-35lh","loopduration":"200","loopeasing":"easeOutQuad","loopcount":"2","loopyoyo":true}}'
		],

		[
			'name' => __('Slot Machine', 'LayerSlider'),
			'data' => '{ "styles": {}, "transition": { "looprotatex":"-1800","loopeasing":"easeOutCirc","loopcount":"1"}}'
		],

		[
			'name' => __('Vibrating', 'LayerSlider'),
			'data' => '{ "styles": {}, "transition": { "loopoffsety":"5","loopscalex":"1.01","loopscaley":"1.01","loopduration":"10","loopcount":"-1","loopyoyo":true,"loopfilter":"blur(1px)"}}'
		],

		[
			'name' => __('Turning Into Mist (infinite)', 'LayerSlider'),
			'data' => '{ "styles": {}, "transition": { "loopscalex":"4","loopscaley":"4","loopduration":"1500","loopeasing":"easeOutQuad","loopcount":"-1","loopopacity":"0","loopfilter":"blur(10px)"}}'
		],

		[
			'name' => __('Rotating (random, infinite)', 'LayerSlider'),
			'data' => '{ "styles": {}, "transition": { "looprotate":"random(120,-120)","looprotatex":"random(120,-120)","looprotatey":"random(120,-120)","loopduration":"3000","loopeasing":"easeInOutQuad","loopcount":"-1","loopyoyo":true}}'
		]
	],


	'ending-text-transition' => [
		[
			'name' => __('Fading out to right by chars', 'LayerSlider'),
			'data' => '{"styles":{},"transition":{"transitionout":false,"textoverflowout":"visible","textstartatout":"slidechangeonly","textstartatouttiming":"slidechangeonly","texttypeout":"chars_desc","textoffsetxout":"100","textdurationout":"500","texteasingout":"easeInQuint"}}'
		],

		[
			'name' => __('Rotating out text by chars', 'LayerSlider'),
			'data' => '{"styles":{},"transition":{"texttypeout":"chars_asc","textrotatexout":"90","texttransformoriginout":"50% 50% 0.4em","textstartatout":"slidechangeonly","textstartatouttiming":"slidechangeonly","textdurationout":"600","textshiftout":"25","textoverflowout":"visible"}}'
		],

		[
			'name' => __('Moving text from center', 'LayerSlider'),
			'data' => '{"styles":{},"transition":{"texttypeout":"chars_center","textoffsetxout":"0|-20|20|-40|40|-60|60|-80|80|-100|100|-120|120|-140|140|-160|160|-180|180|-200|200|-220|220|-240|240|-260|260|-280|280|-300|300|-320|320|-340|340|-360|360|-380|380|-400|400|-420|420|-440|440|-460|460|-480|480|-500|500|-520|520|-540|540|-560|560|-580|580|-600|600|-620|620|-640|640|-660|660|-680|680|","textstartatout":"slidechangeonly","textstartatouttiming":"slidechangeonly","textshiftout":"0","texteasingout":"easeOutCubic","textoverflowout":"visible"}}'
		],

		[
			'name' => __('Spinning out by chars', 'LayerSlider'),
			'data' => '{"styles":{},"transition":{"transitionout":false,"textoverflowout":"visible","textstartatout":"slidechangeonly","textstartatouttiming":"slidechangeonly","texttypeout":"chars_asc","textscalexout":"0.3","textscaleyout":"0.3","textrotateout":"360","texttransformoriginout":"50% 75%","textdurationout":"800","textshiftout":"60","texteasingout":"easeInBack"}}'
		],

		[
			'name' => __('Comb-like rotating by words', 'LayerSlider'),
			'data' => '{"styles":{},"transition":{"transitionout":false,"textoverflowout":"visible","textstartatout":"slidechangeonly","textstartatouttiming":"slidechangeonly","texttypeout":"words_asc","textoffsetyout":"-50lh|50lh","textrotatexout":"90|-90","textdurationout":"600","textshiftout":"0","texteasingout":"easeInOutQuad"}}'
		],

		[
			'name' => __('Random disappearing chars vertically', 'LayerSlider'),
			'data' => '{"styles":{},"transition":{"transitionout":false,"textstartatout":"slidechangeonly","texttypeout":"chars_edge","textoffsetyout":"random(-100,100)","textscalexout":"0","textscaleyout":"0","textdurationout":"300","texteasingout":"easeInBack","textoverflowout":"visible"}}'
		],

		[
			'name' => __('Exploding text randomly', 'LayerSlider'),
			'data' => '{"styles":{},"transition":{"textoffsetxout":"random(-100,100)","textoffsetyout":"random(-200,200)","textscalexout":"2","textscaleyout":"2","textrotateout":"random(120,-120)","textrotatexout":"random(120,-120)","textrotateyout":"random(120,-120)","textstartatout":"slidechangeonly","textstartatouttiming":"slidechangeonly","textdurationout":"1000","textshiftout":"0","texteasingout":"easeOutQuad","textoverflowout":"visible"}}'
		],

		[
			'name' => __('Genie effect', 'LayerSlider'),
			'data' => '{"styles":{},"transition":{"texttypeout":"chars_center","textoffsetyout":"bottom","textscalexout":"0","texttransformoriginout":"slidercenter slidermiddle","textstartatout":"slidechangeonly","textstartatouttiming":"slidechangeonly","textdurationout":"500","textshiftout":"30","texteasingout":"easeInCubic","textoverflowout":"visible"}}'
		],

		[
			'name' => __('Flying away by chars', 'LayerSlider'),
			'data' => '{"styles":{},"transition":{"texttypeout":"chars_rand","textoffsetxout":"random(-1000,1000)","textoffsetyout":"random(-1000,1000)","textscalexout":"0","textscaleyout":"0","textrotateout":"random(500,-500)","texttransformoriginout":"slidercenter slidermiddle","textstartatout":"slidechangeonly","textstartatouttiming":"slidechangeonly","textdurationout":"700","texteasingout":"easeInBack","textoverflowout":"visible"}}'
		],

		[
			'name' => __('Rotating words along a cylinder', 'LayerSlider'),
			'data' => '{"styles":{},"transition":{"texttypeout":"words_edge","textscalexout":"2","textscaleyout":"2","textrotateyout":"-30|30","texttransformoriginout":"slidercenter center","textstartatout":"slidechangeonly","textstartatouttiming":"slidechangeonly"}}'
		],

		[
			'name' => __('Moving vertically random by chars', 'LayerSlider'),
			'data' => '{"styles":{},"transition":{"texttypeout":"chars_rand","textoffsetyout":"-1000lh|1000lh","textstartatout":"slidechangeonly","textstartatouttiming":"slidechangeonly","textdurationout":"600","textshiftout":"40","texteasingout":"easeInBack","textoverflowout":"hidden"}}'
		],

		[
			'name' => __('Slot Machine random by chars', 'LayerSlider'),
			'data' => '{"styles":{},"transition":{"texttypeout":"chars_rand","textrotatexout":"630","textstartatout":"slidechangeonly","textstartatouttiming":"slidechangeonly","textdurationout":"500","texteasingout":"easeInQuint","textfadeout":false,"textoverflowout":"hidden"}}'
		],

		[
			'name' => __('Flowing down chars', 'LayerSlider'),
			'data' => '{"styles":{},"transition":{"texttypeout":"chars_rand","textscalexout":".6","textscaleyout":"7","texttransformoriginout":"center 15%","textstartatout":"slidechangeonly","textstartatouttiming":"slidechangeonly","textdurationout":"1500","texteasingout":"easeInQuart","textoverflowout":"visible"}}'
		],

		[
			'name' => __('Jumping out chars on the top', 'LayerSlider'),
			'data' => '{"styles":{},"transition":{"texttypeout":"chars_rand","textoffsetyout":"-150sh","textstartatout":"slidechangeonly","textstartatouttiming":"slidechangeonly","textdurationout":"2000","textshiftout":"20","texteasingout":"easeInBounce","textfadeout":false,"textoverflowout":"visible"}}'
		]
	],


	'ending-transition' => [
		[
			'name' => __('Sliding out (to left)', 'LayerSlider'),
			'data' => '{ "styles": {}, "transition": { "offsetxout":"left","easingout":"easeInQuart","fadeout":false}}'
		],

		[
			'name' => __('Shrinking', 'LayerSlider'),
			'data' => '{ "styles": {}, "transition": { "scalexout":"0","scaleyout":"0","fadeout":false}}'
		],

		[
			'name' => __('Growing & fading out', 'LayerSlider'),
			'data' => '{ "styles": {}, "transition": { "scalexout":"4","scaleyout":"4","easingout":"swing"}}'
		],

		[
			'name' => __('Jumping down & fading out', 'LayerSlider'),
			'data' => '{ "styles": {}, "transition": { "offsetyout":"300lh","scalexout":"1.2","scaleyout":"1.2","rotatexout":"-60","easingout":"easeInBack"}}'
		],

		[
			'name' => __('Turning forward', 'LayerSlider'),
			'data' => '{ "styles": {}, "transition": { "rotatexout":"-90","transformoriginout":"center bottom","easingout":"easeInQuart","fadeout":false}}'
		],

		[
			'name' => __('Spinning & fading out', 'LayerSlider'),
			'data' => '{ "styles": {}, "transition": { "rotateout":"720"}}'
		],

		[
			'name' => __('Spinning & fading out (3D)', 'LayerSlider'),
			'data' => '{ "styles": {}, "transition": { "rotatexout":"810","easingout":"easeOutQuint"}}'
		],

		[
			'name' => __('Rotating out (counter-clockwise)', 'LayerSlider'),
			'data' => '{ "styles": {}, "transition": { "rotateout":"-180","transformoriginout":"center sliderbottom","easingout":"easeInOutQuad","fadeout":false}}'
		],

		[
			'name' => __('Elastic growing @ fading out', 'LayerSlider'),
			'data' => '{ "styles": {}, "transition": { "scalexout":"1.1","scaleyout":"1.5","easingout":"easeInElastic"}}'
		],

		[
			'name' => __('Fading out & rotating (random)', 'LayerSlider'),
			'data' => '{ "styles": {}, "transition": { "scalexout":"1.3","scaleyout":"1.3","rotateout":"random(60,-60)","rotatexout":"random(60,-60)","rotateyout":"random(60,-60)","easingout":"easeOutQuart"}}'
		]
	],


	'hover-transition' => [
		[
			'name' => __('Sliding up (by 10%)', 'LayerSlider'),
			'data' => '{ "styles": {}, "transition": { "hoveroffsety":"-10lh","hoverdurationin":"200","hovereasingin":"easeOutQuint"}}'
		],

		[
			'name' => __('Sliding to right (by 50%)', 'LayerSlider'),
			'data' => '{ "styles": {}, "transition": { "hoveroffsetx":"50lw","hoverdurationin":"400","hovereasingin":"easeOutQuint"}}'
		],

		[
			'name' => __('Growing', 'LayerSlider'),
			'data' => '{ "styles": {}, "transition": { "hoverscalex":"1.1","hoverscaley":"1.1","hoverdurationin":"100","hovereasingin":"easeOutQuint"}}'
		],

		[
			'name' => __('Growing (elastic)', 'LayerSlider'),
			'data' => '{ "styles": {}, "transition": { "hoverscalex":"1.1","hoverscaley":"1.1","hoverrotatex":"0.001","hoverdurationin":"1000","hoverdurationout":"300","hovereasingin":"easeOutElastic","hovereasingout":"easeOutQuint"}}'
		],

		[
			'name' => __('Skewing (horizontally)', 'LayerSlider'),
			'data' => '{ "styles": {}, "transition": { "hoverskewx":"10","hoverdurationin":"350","hovereasingin":"easeOutQuint"}}'
		],

		[
			'name' => __('Skewing (vertically)', 'LayerSlider'),
			'data' => '{ "styles": {}, "transition": { "hoverskewy":"2","hoverdurationin":"350","hovereasingin":"easeOutQuint"}}'
		],

		[
			'name' => __('Fading out (to 50%)', 'LayerSlider'),
			'data' => '{ "styles": {}, "transition": { "hoverdurationin":"200","hovereasingin":"easeOutQuint","hoveropacity":"0.5"}}'
		],

		[
			'name' => __('Growing & rotating', 'LayerSlider'),
			'data' => '{ "styles": {}, "transition": { "hoverscalex":"1.1","hoverscaley":"1.1","hoverrotate":"-2","hoverdurationin":"250","hovereasingin":"easeOutQuint"}}'
		],

		[
			'name' => __('Turning (3D, vertically)', 'LayerSlider'),
			'data' => '{ "styles": {}, "transition": { "hoverrotatex":"30","hoverdurationin":"350","hovereasingin":"easeOutQuint"}}'
		],

		[
			'name' => __('Turning (3D, horizontally)', 'LayerSlider'),
			'data' => '{ "styles": {}, "transition": { "hoverrotatey":"-35","hovertransformorigin":"left center","hovertransformperspective":"800","hoverdurationin":"1000","hoverdurationout":"400","hovereasingin":"easeOutQuint"}}'
		],

		[
			'name' => __('Changing text color', 'LayerSlider'),
			'data' => '{ "styles": {}, "transition": { "hoverdurationin":"350","hovereasingin":"easeOutQuint","hovercolor":"#30b7ff"}}'
		]
	]

];