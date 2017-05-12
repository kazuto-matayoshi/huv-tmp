<?php


if ( !class_exists( 'HUV_init_actions' ) ) {
	class HUV_init_actions {
		public function __construct( $option ) {
			$this->option = $option;


			if ( $this->option['login_logo_radio'] !== 'change' ) {
				// add_action
				add_action( 'login_head', function () {
					var_dump( $this->option['login_logo_radio'] );
					// echo '<style type="text/css">h1 a { width: auto !important; background: url(' . $this->option['login_logo'] . ') no-repeat !important; background-size: contain !important; background-position: center !important; }</style>';
					echo '<style type="text/css">h1 a { width: auto !important; background: url(/wp/wp-content/themes/base/screenshot.png) no-repeat !important; background-size: contain !important; background-position: center !important; }</style>';
				} );
			}
		}
	}
}


