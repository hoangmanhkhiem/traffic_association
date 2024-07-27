<?php $assets_path = CLI_PLUGIN_URL . 'images/'; ?>
<style>
/************/

.text-center {
	text-align: center !important;
}

.mx-auto {
	margin-right: auto !important;
	margin-left: auto !important;
}

.my-0 {
	margin-top: 0 !important;
	margin-bottom: 0 !important;
}

.d-flex {
	display: flex !important;
}

.v-center {
	align-items: center !important;
}

.wt-white-wrapper {
	background-color: #fff;
	padding: 8px;
}

.px-10 {
	padding-left: 10px;
	padding-right: 10px;
}

.text-right {
	text-align: right !important;
}

.my-35 {
	margin-top: 35px;
	margin-bottom: 35px;
}

.wt-bg {
	padding: 10px;
	background-image: url(
	<?php
	echo esc_url( $assets_path . 'bg.svg' );
	?>
	);
	background-repeat: no-repeat;
	background-position: center;
	background-size: cover;
}

h3.wt-sidebar-title {
	font-style: normal;
	font-weight: bold;
	font-size: 20px;
	line-height: 26px;
	text-align: center;
	color: #000000;
	margin-bottom: 20px;
}

.wt-primary-btn {
	background: #2D9FFF;
	border-radius: 7px;
	font-style: normal;
	font-weight: 600;
	font-size: 14px;
	line-height: 19px;
	padding: 10px 15px;
	color: #FFFFFF;
	display: inline-block;
	text-align: center;
	margin: 0 auto 30px auto;
}

.wt-primary-btn:hover,
.wt-primary-btn:focus {
	outline: none;
	text-decoration: none;
	transition: all .2s ease;
	transform: translateY(2px);
	box-shadow: none;
	opacity: .8;
}
.wt-primary-btn:hover {
	color: #fff;
}

.wt-moneyback-support-wrapper {
	background: #E2F2FF;
	border-radius: 13px;
	padding: 17px 12px;
}

.wt-moneyback-support-wrapper>div {
	padding: 6px;
	width: 50%;
}

.wt-moneyback-support-wrapper img {
	filter: drop-shadow(0px 11px 21px rgba(34, 112, 177, 0.26));
	width: 36px;
	height: auto;
	margin-right: 10px;
}

.wt-moneyback-support-wrapper p {
	font-style: normal;
	font-weight: 600;
	font-size: 12px;
	line-height: 13px;
	color: #000000;
	margin: 0;
}

ul.wt-gdprpro-features {
	margin: 0;
	padding: 8px 24px;
}

.wt-gdprpro-features li {
	font-style: normal;
	font-weight: 400;
	font-size: 13px;
	line-height: 19px;
	color: #000000;
	list-style: none;
	margin: 0 0 24px 0;
	padding-left: 32px;
	position: relative;
}

.wt-gdprpro-features li b {
	font-weight: bold;
}

.wt-gdprpro-features li:before {
	content: '';
	position: absolute;
	height: 16px;
	width: 16px;
	margin-top: 2px;
	background-image: url(
	<?php
	echo esc_url( $assets_path . 'list-icon.svg' );
	?>
	);
	background-size: contain;
	background-repeat: no-repeat;
	background-position: center;
	left: 0;
}

.wt-gdprpro-features li:last-child {
	margin-bottom: 0;
}

.wt-link {
	font-style: normal;
	font-weight: 600;
	font-size: 14px;
	line-height: 18px;
	text-decoration: underline;
	color: #1093F2;
	display: inline-block;
	margin-bottom: 35px;
	cursor: pointer;
}

.wt-link:hover, .wt-link:focus {
	text-decoration: none;

}

.wt-free-pro-table {
	overflow-x: auto;
	border-radius: 7px;
	border: 0.5px solid #d3d3d3;
}

.wt-free-pro-table table {
	width: 100%;
	min-width: 400px;
	border-collapse: collapse;
}

.wt-free-pro-table table th {
	font-style: normal;
	font-weight: bold;
	font-size: 15px;
	line-height: 28px;
	color: #000000;
	padding: 15px;
	text-align: center;
}

.wt-free-pro-table table th {
	border-right: 0.5px solid #d3d3d3;
	border-bottom: 0.5px solid #d3d3d3;
	border-left: none;
	border-top: none;
}

.wt-free-pro-table table tr th:first-child {
	background-color: #F8F9FA;
}

.wt-free-pro-table table tr th:last-child {
	border-right: none;
}

.wt-free-pro-table table td {
	border-right: 0.5px solid #d3d3d3;
	border-bottom: 0.5px solid #d3d3d3;
	border-left: none;
	border-top: none;
	padding: 20px 40px;
	font-style: normal;
	font-weight: 600;
	font-size: 14px;
	line-height: 20px;
	color: #3A3A3A;
	text-align: center;
}

.wt-free-pro-table table td p.light {
	margin: 10px 0 0 0;
	font-style: normal;
	font-weight: 300;
	font-size: 14px;
	line-height: 20px;
}

.wt-free-pro-table table tr td:first-child {
	text-align: left;
	background-color: #F8F9FA;
}

.wt-free-pro-table table tr td:last-child {
	border-right: none;
}

.wt-free-pro-table table tr:last-child td {
	border-bottom: none;
}

.wt-free-pro-table table a {
	font-style: normal;
	font-weight: 600;
	font-size: 14px;
	line-height: 24px;
	text-decoration: underline;
	color: #2DB3FF;
}

.wt-free-pro-table table a:hover {
	text-decoration: none;
}

.wt-free-pro-table .wt-cli-badge {
	background-size: contain;
	background-repeat: no-repeat;
	background-position: center;
	height: 20px;
	width: 20px;
	display: inline-block;
}

.wt-cli-badge.wt-cli-success {
	background-image: url(
	<?php
	echo esc_url( $assets_path . 'tick.svg' );
	?>
	);
}

.wt-cli-badge.wt-cli-error {
	background-image: url(
	<?php
	echo esc_url( $assets_path . 'cross.svg' );
	?>
	);
}

.wt-colored-wrapper {
	background-color: #F5FAFF;
	display: inline-block;
	border-radius: 0 0 13px 13px;
}

.wt-blue-text {
	color: #2D9FFF;
}

</style>

<div class="wt-cli-sidebar" style="max-width: 365px;margin-top:45px">
	<div class="wt-white-wrapper">
		<div class="wt-bg">
			<h3 class="wt-sidebar-title text-center">
				<?php
				echo wp_kses(
					__( "You are using the legacy version! <span class='wt-blue-text'>Migrate to the new UI</span> for better experience and advanced features", 'cookie-law-info' ),
					array(
						'span'      => array(
							'class' => array()
						),
					)
					);
				?>
			</h3>
			<p class="text-center my-0"><a id="wt-cli-migrate-btn" class="wt-primary-btn" onclick="wtCliAdminFunctions.showModal('wt-cky-migration-modal')"><?php echo esc_html( _e( 'Migrate Now', 'cookie-law-info' ) ); ?></a></p>
		</div>
		<ul class="wt-gdprpro-features">
			<li><b><?php echo esc_html( __( 'Get the new, WCAG-compliant cookie consent banner.', 'cookie-law-info' ) ); ?></b></li>
			<li><b><?php echo esc_html( __( 'Access new free features', 'cookie-law-info' ) ); ?></b>
				<?php echo esc_html( __( '— Set consent expiration, disable prior consent, hide consent categories, choose colour scheme (light/dark/custom), generate cookie/privacy policy, etc.', 'cookie-law-info' ) ); ?>
			</li>
			<li>
				<b><?php echo esc_html( __( 'Access additional free and premium features by connecting to CookieYes web app (Optional)', 'cookie-law-info' ) ); ?></b>                						  
				<?php echo esc_html(
					__( '— Cookie scan, Consent log, Support for Google Consent Mode v2, IAB TCF v2.2 banner, Google’s Additional Consent Mode, etc.', 'cookie-law-info' )
				); ?>
			</li>
		</ul>
		<p class="text-center my-0"> <a href="https://www.cookieyes.com/documentation/ui-migration" class="wt-link" target="_blank"><?php echo esc_html( __( 'Learn more about migration', 'cookie-law-info' ) ); ?></a></p>
	</div>
</div>
<div class="wt-cky-migration-modal wt-cli-modal" id="wt-cky-migration-modal">
	<span class="wt-cli-modal-js-close">×</span>
	<div class="wt-cli-modal-header"><h4><?php echo esc_html( _e( 'Ready to migrate to the new UI?', 'cookie-law-info' ) ); ?></h4></div>
	<div class="wt-cli-modal-body">
		<?php echo '<b>' . esc_html( __( 'Please review the following before proceeding:', 'cookie-law-info' ) ) . '</b>'; ?>
		<ul class="wt-cli-bullet-list-main">
			<li>
				<?php
				echo wp_kses(
					__( '<strong>Cookie bar and other shortcodes</strong> will be replaced with <strong>easier customization methods.</strong>', 'cookie-law-info' ),
					array(
						'p'      => array(),
						'strong' => array(),
					)
				);
				?>
			</li>
			<li>
				<?php
				echo wp_kses(
					__( '<strong>After migrating, you can add custom CSS to:</strong>', 'cookie-law-info' ),
					array(
						'p'      => array(),
						'strong' => array(),
					)
				);
				?>
			</li>
			<ul class="wt-cli-bullet-list">
				<li>
					<?php echo esc_html( __( 'Change the font format of the cookie banner (available in the premium plans).', 'cookie-law-info' ) ); ?>
				</li>
				<li>
					<?php echo esc_html( __( 'Customize the position of the revisit consent button (from the right/left margin).', 'cookie-law-info' ) ); ?>
				</li>
				<li>
					<?php echo esc_html( __( 'Change the button size.', 'cookie-law-info' ) ); ?>
				</li>
			</ul>
			<li>
				<?php
				echo wp_kses(
					__( '<strong>The following customization features will no longer be available:</strong>', 'cookie-law-info' ),
					array(
						'p'      => array(),
						'strong' => array(),
					)
				);
				?>
			</li>
			<ul class="wt-cli-bullet-list">
				<li>
					<?php echo esc_html( __( 'Changing the button to a link.', 'cookie-law-info' ) ); ?>
				</li>
				<li>
					<?php echo esc_html( __( 'Redirecting to the URL on click.', 'cookie-law-info' ) ); ?>
				</li>
				<li>
					<?php echo esc_html( __( 'Animating the cookie banner (On Load/Hide).', 'cookie-law-info' ) ); ?>
				</li>
				<li>
					<?php echo esc_html( __( 'Allowing the cookie banner to move with page scroll.', 'cookie-law-info' ) ); ?>
				</li>
				<li>
					<?php echo esc_html( __( 'Accepting cookie consent on the page scroll or delay action on the cookie banner.', 'cookie-law-info' ) ); ?>
				</li>
			</ul>
			<li>
				<?php
				echo wp_kses(
					__( 'The <strong>popup layout</strong> for the banner and the <strong>option to use both "GDPR" and "US State Laws" consent templates</strong> will be <strong>available in the premium plans</strong> with <strong>advanced geo-targeting.</strong>', 'cookie-law-info' ),
					array(
						'p'      => array(),
						'strong' => array(),
					)
				);
				?>
			</li>
			<li>
				<?php
				echo wp_kses(
					__( 'From the new plugin UI, you can navigate to <strong>Cookie Manager > Add Cookie > Advanced settings</strong> and add the pattern that identifies the script <strong>(Script URL Pattern)</strong> to manually block cookies before obtaining user consent.', 'cookie-law-info' ),
					array(
						'p'      => array(),
						'strong' => array(),
					)
				);
				?>
			</li>
		</ul>
		<p>
			<?php
			echo wp_kses(
				__( 'Alternatively, you can <strong>connect to the CookieYes web app (optional)</strong> to utilize the <strong>cookie scan feature,</strong> which <strong>discovers, categorizes, and automatically blocks</strong> your website cookies prior to consent.', 'cookie-law-info' ),
				array(
					'p'      => array(),
					'strong' => array(),
				)
			);
			?>
		</p>
		<div class="wt-cli-action-container">
			<div class="wt-cli-action-group">
				<a id="wt-cli-ckyes-support" href="https://www.cookieyes.com/support/" target="_blank" class="wt-cli-ckyes-support">
					<?php echo esc_html__( 'Contact Support', 'cookie-law-info' ); ?>
					<span class="dashicons dashicons-external"></span>
				</a>
				<a href="<?php echo esc_attr( wp_nonce_url( add_query_arg( 'migrate', 'start', admin_url( 'edit.php?post_type=cookielawinfo&page=cookie-law-info' ) ), 'migrate', '_wpnonce' ) ); ?>" class="wt-primary-btn" rel="noopener noreferrer">
					<?php echo esc_html__( 'Start Migration', 'cookie-law-info' ); ?>
				</a>
			</div>
		</div>
	</div>
</div>
