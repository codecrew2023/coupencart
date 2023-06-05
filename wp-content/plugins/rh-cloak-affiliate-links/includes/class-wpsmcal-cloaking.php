<?php
if ( !defined( 'WPINC' ) ) die;

/**
 * Class Wpsmcal_Cloaking
 *
 * @package RH Link
 */

class Wpsmcal_Cloaking extends Wpsmcal {

	/**
	 * Class constructor. Includes essential files and initializes the class attributes.
	 */
	public function __construct( $version, $options ) {
		$this->version = $version;
		$this->options = $options;
		$this->base = parent::get_affiliate_base();
		$this->filter_base = parent::get_filter_base();
		$this->filter_name = parent::get_filter_name();
		$this->meta_name = parent::get_meta_name();

	}
	
	/**
	 * Registers the actions of this class with WordPress.
	 */
	public function add_actions(){
		add_action( 'admin_menu', array( $this, 'create_page' ) );
		add_action( 'admin_init', array( $this, 'create_options' ) );
	}
	
	/**
	 * Activates Cloaking function
	 */
	public function activate(){
		add_filter( 'query_vars', array( $this, 'query_vars' ) );
		add_filter( 'rewrite_rules_array', array( $this, 'rewrite_rules_array' ) );
		add_filter( 'robots_txt', array( $this, 'robots_txt' ), 10, 2 );
		add_filter( $this->filter_base, array( $this, 'get_offer_url' ), 101, 2 );
		add_action( 'template_redirect', array( $this, 'template_redirect' ) );		
	}

	/**
	 * Creates the settings section, resgisters setting and adds settings fields.
	 */
	function create_options() {
		add_settings_section( 'general_settings', esc_html__( 'Cloaking settings', 'wpsmcal' ), array( $this, 'section_settings_desc' ), 'wpsmcal-options' );
		$fields = $this->get_settings_fields();
		foreach( $fields as $key => $value ){
			if ( $value['slug'] == 'wpsmcal_robots' && !get_option('permalink_structure') )
				continue;
			add_settings_field( $value['slug'], $value['name'], $value['callback'], $value['page'], $value['section'] );
		}	
	}

	/**
	 * Callback function of the Section description
	 */
	function section_settings_desc() {
		?>
		<div class="notice notice-warning is-dismissible">
			<p><?php esc_html_e( 'If you enabled/disabled "Active cloaking" option, please, go to WordPress Settings and resave Permalinks.', 'wpsmcal' ); ?></p>
			<button type="button" class="notice-dismiss"><span class="screen-reader-text"><?php esc_html_e( 'Dismiss this notice.', 'wpsmcal' ); ?></span></button>
		</div>
		<?php
	}

	/**
	 * Fields of the Settings page
	 */
	public function get_settings_fields() {
		return array(
			array(
				'slug' => 'wpsmcal_cactive',
				'name' => esc_html__( 'Active cloaking', 'wpsmcal' ),
				'callback' => array( $this, 'field_activate' ),
				'page' => 'wpsmcal-options',
				'section' => 'general_settings',
			),
			array(
				'slug' => 'wpsmcal_status',
				'name' => esc_html__( 'Status Code', 'wpsmcal' ),
				'callback' => array( $this, 'field_status' ),
				'page' => 'wpsmcal-options',
				'section' => 'general_settings',
			),
			array(
				'slug' => 'wpsmcal_robots',
				'name' => esc_html__( 'Add to Robots.txt', 'wpsmcal' ),
				'callback' => array( $this, 'field_robots' ),
				'page' => 'wpsmcal-options',
				'section' => 'general_settings',
			),
			array(
				'slug' => 'wpsmcal_slug',
				'name' => esc_html__( 'Add Post slug', 'wpsmcal' ),
				'callback' => array( $this, 'field_slug' ),
				'page' => 'wpsmcal-options',
				'section' => 'general_settings',
			),
			array(
				'slug' => 'wpsmcal_domains',
				'name' => esc_html__( 'Exclude domains', 'wpsmcal' ),
				'callback' => array( $this, 'field_domains' ),
				'page' => 'wpsmcal-options',
				'section' => 'general_settings',
			),
		);
	}
	
	/**
	 * The field to enable the function
	 */
	function field_activate() { 
	?>
		<input type="radio" value="yes" name="wpsmcal_options[cactive]" <?php checked( $this->options['cactive'], 'yes', true ); ?> /> <?php esc_html_e( 'Yes', 'wpsmcal' ); ?>&nbsp;
		<input type="radio" value="no" name="wpsmcal_options[cactive]" <?php checked( $this->options['cactive'], 'no', true ); ?> /> <?php esc_html_e( 'No', 'wpsmcal' ); ?>
	<?php
	}
	
	/**
	 * The select field for chosing Redirect server status
	 */
	function field_status() { 
	?>
		<select id="wwcal_status" name="wpsmcal_options[status]">
			<option value="301" <?php selected( $this->options['status'], '301', true ); ?>><?php esc_html_e( '301 (Moved Permanently)', 'wpsmcal' ); ?></option>
			<option value="302" <?php selected( $this->options['status'], '302', true ); ?>><?php esc_html_e( '302 (Found/Temporary Redirect)', 'wpsmcal' ); ?></option>
			<option value="307" <?php selected( $this->options['status'], '307', true ); ?>><?php esc_html_e( '307 (Temporary Redirect)', 'wpsmcal' ); ?></option>
		</select>
		<p class="description"><?php esc_html_e( 'Server HTTP response when redirecting links.', 'wpsmcal' ); ?></p>
	<?php
	}

	/**
	 * The field to set up the Redirect path in the Robots file
	 */
	function field_robots() { 
	?>
		<input type="radio" value="yes" name="wpsmcal_options[robots]" <?php checked( $this->options['robots'], 'yes', true ); ?> /> <?php esc_html_e( 'Yes', 'wpsmcal' ); ?>&nbsp;
		<input type="radio" value="no" name="wpsmcal_options[robots]" <?php checked( $this->options['robots'], 'no', true ); ?> /> <?php esc_html_e( 'No', 'wpsmcal' ); ?>
		<p class="description"><?php esc_html_e( 'Add the path configured in Permalinks Settings to your robots.txt file to prevent any search engines from attempting to view or index it.', 'wpsmcal' ); ?></p>
	<?php
	}

	/**
	 * The field to set up the Redirect link with Post ID & Post slug
	 */
	function field_slug() { 
	?>
		<input type="radio" value="yes" name="wpsmcal_options[slug]" <?php checked( $this->options['slug'], 'yes', true ); ?> /> <?php esc_html_e( 'Yes', 'wpsmcal' ); ?>&nbsp;
		<input type="radio" value="no" name="wpsmcal_options[slug]" <?php checked( $this->options['slug'], 'no', true ); ?> /> <?php esc_html_e( 'No', 'wpsmcal' ); ?>
		<p class="description"><?php esc_html_e( 'Add Post slug in the redirect link.', 'wpsmcal' ); ?></p>
	<?php
	}
	
	/**
	 * The field to set up domains which will not cloak
	 */
	function field_domains() { 
	?>
		<textarea rows="4" cols="40" name="wpsmcal_options[domains]"><?php if( isset( $this->options['domains'] ) ): echo $this->options['domains']; endif; ?></textarea>
		<p class="description"><?php esc_html_e( 'Place each domain name in the new line which the plugin should not cloak.', 'wpsmcal' ); ?></p>
	<?php
	}

	/**
	 * Creates the cloaking page in plugin menu
	 */
	public function create_page(){
		$parent_slug = 'wpsmcal-options';
		$page_title = esc_html__( 'RH Link Settings', 'wpfepp-plugin' );
		$menu_title = esc_html__( 'Settings', 'wpsmcal' );
		$capability = 'manage_options';
		$menu_slug = 'wpsmcal-options';
		add_submenu_page( $parent_slug, $page_title, $menu_title, $capability, $menu_slug );
	}

	/**
	 * Catches WP query argumens
	 */
	function query_vars( $vars) {
		$vars[] = $this->base;
		return $vars;
	}
	
	/**
	 * Gets ready URL to redirect
	 */
	function get_offer_url( $offer_url, $postid = '' ) {
		if( empty($offer_url) )
			return;

		$restricted = $this->options['domains'];
		if( $restricted ){
			$restricted_arr = array_map( 'trim', explode( PHP_EOL, $restricted ) );
			foreach( $restricted_arr as $restricted_domain ){
				$match_restricted = strpos( $offer_url, $restricted_domain );
				if( $match_restricted )
					return $offer_url;
			}
		}
		
		global $post;
		
		if( !empty( $postid ) ){
			$post_rdct = $postid;
		} 
		elseif( $this->options['slug'] == 'yes' ){
			$post_rdct = $post->ID .'-'. $post->post_name;
		}
		else{
			$post_rdct = $post->ID;
		}

		if ( get_option( 'permalink_structure' ) ) {
			return user_trailingslashit( home_url() . '/' . $this->base . '/' . $post_rdct );
		} else {
			return home_url() . '/index.php?' . $this->base . '=' . $post_rdct;
		}
	}

	/**
	 * Redirecting scheme
	 */
	function template_redirect() {
		global $wp_query;
		
		$external_link = '';
		
		if ( isset( $wp_query->query_vars[$this->base] ) ) {
			$base = get_query_var( $this->base );
 			if( is_string( $base ) ){
				$array = explode( '-', $base);
				if( is_numeric( $array[0] ) ){
					$post_id = (int) $array[0];
				} else {
					$post_id = $base; // a string
				}
			} else {
				$post_id = (int) get_query_var( $this->base );
			}
			
			if( is_numeric( $post_id ) )
				$external_link = get_post_meta( $post_id, $this->meta_name, true );
			
			$external_link = apply_filters( 'wpsmcal_filter_url', $external_link, $post_id );
			$external_link = apply_filters( $this->filter_name, $external_link);
			$external_link = htmlspecialchars_decode(trim( $external_link ));

			if ( $external_link != '' ) {
				do_action( 'wpsmcal_clickthrough', $post_id );
				wp_redirect( $external_link, $this->options['status'] );
				die;
			} else {
				do_action( 'wpsmcal_clickthrough_fail', $post_id );
			}
		}
	}
	
	/**
	 * Rewrites WP rules for redirection
	 */
	function rewrite_rules_array( $rules ) {
		$new_rules = array( $this->base . '/([^/]+)/?$' => 'index.php?' . $this->base . '=$matches[1]' );
		$rules = $new_rules + $rules;
		return $rules;
	}
	
	/**
	 * Adds redirect Path to Disallow section of the Robots file
	 */
	function robots_txt( $output, $public ) {
		if ( $this->options['robots'] == 'yes' && get_option('permalink_structure') ) {
			$site_url = parse_url( site_url() );
			$path = (!empty( $site_url['path'] )) ? $site_url['path'] : '';
			$text = "Disallow: $path/" . $this->base . "/\n";
			$text = apply_filters( 'wpsmcal_robots_txt', $text );
			$output .= $text;
		}
		return $output;
	}
}
