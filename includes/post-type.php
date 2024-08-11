<?php
/**
 * Here we will create custom post type.
 */

class weDevs_Academy_WP_Plugin_Post_Type {

	public function __construct() {
		add_action( 'init', array( $this, 'init' ) );
		add_action( 'add_meta_boxes', array( $this, 'add_meta_boxes' ) );
		add_action( 'save_post_wedevs_post', array( $this, 'save_wedevs_post' ) );

		add_action( 'cmb2_admin_init', array( $this, 'cmb2_admin_init' ) );
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

	/**
	 * Add necessary meta boxes.
	 */
	public function add_meta_boxes() {
		add_meta_box(
			'academy-post-meta-box-1',
			'Meta Box One',
			array( $this, 'academy_post_meta_box_1_callback' ),
			'wedevs_post'
		);
	}

	public function academy_post_meta_box_1_callback( $post ) {
		$your_text = get_post_meta( $post->ID, '_your_text', true );
		$associate_page_id = get_post_meta( $post->ID, '_associate_page_id', true );

		$posts = get_posts( array(
			'post_type' => 'page',
		) );
		?>
		<div class="inside">
			<p class="post-attributes-label-wrapper menu-order-label-wrapper">
				<label class="post-attributes-label">Your Text Field</label>
			</p>
			<input type="text" name="your_text" value="<?php echo $your_text ? $your_text : 'You name'; ?>">

			<p class="post-attributes-label-wrapper menu-order-label-wrapper">
				<label class="post-attributes-label">Select Your Item</label>
			</p>
			<select name="associate_page_id" id="">
				<?php foreach( $posts as $new_post ): ?>
				<option value="<?php echo $new_post->ID; ?>" <?php echo $associate_page_id == $new_post->ID ? 'selected' : ''; ?>><?php echo $new_post->ID; ?></option>
				<?php endforeach; ?>
			</select>
		</div>
		<?php
	}

	/**
	 * Trigger when save post
	 */
	public function save_wedevs_post( $post_id ) {
		if ( isset( $_POST['your_text'] ) ) {
			$your_text = sanitize_text_field( $_POST['your_text'] );
			update_post_meta( $post_id, '_your_text', $your_text );
		}

		if ( isset( $_POST['associate_page_id'] ) ) {
			$associate_page_id = intval( $_POST['associate_page_id'] );
			update_post_meta( $post_id, '_associate_page_id', $associate_page_id );
		}
	}

	public function cmb2_admin_init() {
		$cmb = new_cmb2_box( array(
			'id'            => 'test_metabox',
			'title'         => 'Test Metabox',
			'object_types'  => array( 'wedevs_post', ),
		) );

		$cmb->add_field( array(
			'name'       => 'Test Text',
			'desc'       => 'field description (optional)',
			'id'         => 'yourprefix_text',
			'type'       => 'text',
			'repeatable' => true,
		) );

		$group_field_id = $cmb->add_field( array(
			'id'          => 'wiki_test_repeat_group',
			'type'        => 'group',
			'description' => __( 'Generates reusable form entries', 'cmb2' ),
			'repeatable'  => true, // use false if you want non-repeatable group
			'options'     => array(
				'group_title'       => __( 'Entry {#}', 'cmb2' ), // since version 1.1.4, {#} gets replaced by row number
				'add_button'        => __( 'Add Another Entry', 'cmb2' ),
				'remove_button'     => __( 'Remove Entry', 'cmb2' ),
				'sortable'          => true,
				'closed'         => true, // true to have the groups closed by default
			),
		) );

		$cmb->add_group_field( $group_field_id, array(
			'name' => 'Entry Title',
			'id'   => 'title',
			'type' => 'text',
			'repeatable' => true, // Repeatable fields are supported w/in repeatable groups (for most types)
		) );

		$cmb->add_group_field( $group_field_id, array(
			'name' => 'Entry Image',
			'id'   => 'image',
			'type' => 'file',
		) );
	}
}
