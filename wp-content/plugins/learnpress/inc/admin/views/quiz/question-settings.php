<?php
/**
 * Question template.
 *
 * @since 3.0.0
 */

learn_press_admin_view( 'quiz/question-answer' );
learn_press_admin_view( 'quiz/question-meta' );
?>

<script type="text/x-template" id="tmpl-lp-quiz-question-settings">
	<div class="question-settings" :class="[question.open ? 'table-row' : 'hide-if-js', isHiddenSettings(question.id) ? 'closed' : '']">
		<template v-if="!supportAnswerOptions">
			<?php do_action( 'learn-press/quiz-editor/question-js-component' ); ?>
		</template>
		<template v-else-if="isFillInBlank">
			<lp-quiz-fib-question-answer :question="question"></lp-quiz-fib-question-answer>
		</template>
		<template v-else>
			<lp-quiz-question-answers :question="question"></lp-quiz-question-answers>
		</template>

		<lp-quiz-question-meta :question="question"></lp-quiz-question-meta>
	</div>
</script>


<script type="text/javascript">
	jQuery(function ($) {
		var $Vue = window.$Vue || Vue;
		var $store = window.LP_Quiz_Store;

		$Vue.component('lp-quiz-question-settings', {
			template: '#tmpl-lp-quiz-question-settings',
			props: ['question', 'index'],
			computed: {
				supportAnswerOptions: function () {
					return $store.getters['lqs/supportAnswerOptions'].indexOf(this.question.type.key) !== -1;
				},
				isFillInBlank: function() {
					return this.question.type.key === 'fill_in_blanks';
				},
			},

			methods: {
				isHiddenSettings: function (id) {
					return $.inArray(id, $store.getters['lqs/hiddenQuestionsSettings']) !== -1;
				}
			}
		})
	})
</script>
