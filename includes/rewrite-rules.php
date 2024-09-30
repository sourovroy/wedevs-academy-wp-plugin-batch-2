<?php

class weDevs_Academy_WP_Plugin_Rewrite_Rules {

	public function __construct() {
		add_action( 'init', array( $this, 'init' ) );

		add_filter( 'template_include', array( $this, 'template_include' ) );
	}

	public function init() {
		add_rewrite_tag('%something%', '([^&]+)');
		add_rewrite_tag('%something_value%', '([^&]+)');

		add_rewrite_rule(
			'something/([^/]+)/?$',
			'index.php?something=true&something_value=$matches[1]',
			'top'
		);

	}

	public function template_include( $template ) {
		if ( 'true' === get_query_var( 'something' ) ) {
			return __DIR__ . '/templates/something.php';
		}

		return $template;
	}
}
