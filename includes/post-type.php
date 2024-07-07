<?php
/**
 * Here we will create custom post type.
 */

class weDevs_Academy_WP_Plugin_Post_Type {

	public function __construct() {
		add_action( 'init', array( $this, 'init' ) );
	}

	public function init() {
		register_post_type( 'wedevs_post', array(
			'public' => true,
			'labels' => array(
				'name' => "weDevs Posts",
				'singular_name' => "weDevs Post",
				'add_new' => "Create new weDevs Post",
				'add_new_item' => "Creating weDevs Post",
				'edit_item' => "Edit Now",
				'search_items' => "Search weDevs",
				'menu_name' => "weDevs",
			),
			'menu_position' => 82,
			'menu_icon' => 'data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIj8+PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciICB2aWV3Qm94PSIwIDAgNTAgNTAiIHdpZHRoPSI1MHB4IiBoZWlnaHQ9IjUwcHgiPiAgICA8cGF0aCBkPSJNIDI1IDEuMDUwNzgxMiBDIDI0Ljc4MjUgMS4wNTA3ODEyIDI0LjU2NTg1OSAxLjExOTc2NTYgMjQuMzgwODU5IDEuMjU5NzY1NiBMIDEuMzgwODU5NCAxOS4yMTA5MzggQyAwLjk1MDg1OTM4IDE5LjU1MDkzOCAwLjg3MDkzNzUgMjAuMTc5MTQxIDEuMjEwOTM3NSAyMC42MTkxNDEgQyAxLjU1MDkzNzUgMjEuMDQ5MTQxIDIuMTc5MTQwNiAyMS4xMjkwNjIgMi42MTkxNDA2IDIwLjc4OTA2MiBMIDQgMTkuNzEwOTM4IEwgNCA0NiBDIDQgNDYuNTUgNC40NSA0NyA1IDQ3IEwgMTkgNDcgTCAxOSAyOSBMIDMxIDI5IEwgMzEgNDcgTCA0NSA0NyBDIDQ1LjU1IDQ3IDQ2IDQ2LjU1IDQ2IDQ2IEwgNDYgMTkuNzEwOTM4IEwgNDcuMzgwODU5IDIwLjc4OTA2MiBDIDQ3LjU3MDg1OSAyMC45MjkwNjMgNDcuNzggMjEgNDggMjEgQyA0OC4zIDIxIDQ4LjU4OTA2MyAyMC44NjkxNDEgNDguNzg5MDYyIDIwLjYxOTE0MSBDIDQ5LjEyOTA2MyAyMC4xNzkxNDEgNDkuMDQ5MTQxIDE5LjU1MDkzOCA0OC42MTkxNDEgMTkuMjEwOTM4IEwgMjUuNjE5MTQxIDEuMjU5NzY1NiBDIDI1LjQzNDE0MSAxLjExOTc2NTYgMjUuMjE3NSAxLjA1MDc4MTIgMjUgMS4wNTA3ODEyIHogTSAzNSA1IEwgMzUgNi4wNTA3ODEyIEwgNDEgMTAuNzMwNDY5IEwgNDEgNSBMIDM1IDUgeiIvPjwvc3ZnPg==',
			'supports' => array( 'title', 'editor', 'thumbnail', 'excerpt', 'page-attributes' ),
			'rewrite' => array(
				'slug' => 'wedevs',
			),
			// 'show_in_rest' => true,
			'hierarchical' => true,
			'has_archive' => true,
		) );

		add_shortcode( 'wedevs-posts', array( $this, 'display_wedevs_posts' ) );
	}

	public function display_wedevs_posts() {
		ob_start();
		include __DIR__ . '/templates/wedevs-posts.php';
		return ob_get_clean();
	}
}
