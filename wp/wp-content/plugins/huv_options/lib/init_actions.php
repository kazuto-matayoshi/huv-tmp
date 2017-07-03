<?php
if ( !class_exists( 'HUV_init_actions' ) ) {
	class HUV_init_actions {
		public function __construct( $option ) {
			$this->option = $option;

			// var_dump($this->option[0]);
			if ( $this->option[0] === 'change' ) {
				add_action( 'login_head', function () {
					echo '<style type="text/css">h1 a { width: auto !important; background: url(' . $this->option[1] . ') no-repeat !important; background-size: contain !important; background-position: center !important; }</style>';
				} );
			} else {
				// add_action
				add_action( 'login_head', function () {
					echo '<style type="text/css">h1 a { width: auto !important; background: url(' . get_template_directory_uri() . '/login.png) no-repeat !important; background-size: contain !important; background-position: center !important; }</style>';
				} );
			}
		}
	}
}


