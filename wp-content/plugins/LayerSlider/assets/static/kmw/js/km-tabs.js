
/*
	* KM-Tabs
	*
	* (c) 2019-2024 Kreatura Media, AgeraWeb, George K., John G.
	*
*/



;jQuery(document).ready(function(l){l(document).on("click.km-tabs",".km-tabs-list > *:not(.kmw-disabled, .kmw-unselectable, kmw-menutitle)",function(){var t=l(this),a=t.parent(),e=a.closest(".kmw-modal"),m=t.find("kmw-menutext").text(),i=l(a.data("target")),s=a.data("disableAutoRename"),d='[data-kmw-uid="'+l(this).closest(".kmw-modal-container").data("kmwUid")+'"] ',n=d+"kmw-menuitem, "+d+".kmw-menuitem",a=t.index(n),d=t.data("tab-target")||"",n=i.find('[data-tab="'+d+'"]');t.hasClass("kmw-active")||(t.siblings().removeClass("kmw-active"),t.addClass("kmw-active"),d&&n.length?(n.siblings().removeClass("kmw-active"),n.addClass("kmw-active")):(i.children().removeClass("kmw-active"),i.children().eq(a).addClass("kmw-active"))),void 0===s&&e.find("kmw-h1.kmw-modal-title").text(m)})});