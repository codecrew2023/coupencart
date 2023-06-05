<?php
if ( !defined( 'WPINC' ) ) { die; }

/**
 * Class Wpsmcal
 *
 * @package RH Link
 */

class Wpsmcal {
	
	/**
	 * Main version of the plugin
	 */
	public $version;
	
	/**
	 * Output base WP filter for Remote URL
	 */
	private $filter_base = 'rehub_create_btn_url';
	
	/**
	 * Output second WP filter for cloaking & rewriting Remote URL
	 */
	private $filter_name = 'rh_post_offer_url_filter';
	
	/**
	 * Meta Post field where the Remote URL is saved
	 */
	private $meta_name = 'rehub_offer_product_url';

	/**
	 * Class constructor. Includes essential files and initializes the class attributes.
	 */
	public function __construct( $version = '1.0.0' ) {
		register_activation_hook( __FILE__, array( $this, 'activate_plugin' ) );
		register_deactivation_hook( __FILE__, array( $this, 'deactivate_plugin' ) );
		
		$this->version = $version;
		$this->options = $this->load_options();
		$this->load_dependencies();
		
		$сloaking = new Wpsmcal_Cloaking($version, $this->options);
		$сloaking->add_actions();
		
		if( $this->options['cactive'] == 'yes' ){
			$сloaking->activate();
		}
		
		$statictics = new Wpsmcal_Statistic( $version, $this->options );
		$statictics->add_actions();
		
		if( $this->options['sactive'] == 'yes' ){
			$statictics->inside_activate();
		}
		
		if( $this->options['gactive'] == 'yes' ){
			$statictics->analitics_activate();
		}
		
		$rewrite = new Wpsmcal_Rewrite( $version, $this->options );
		$rewrite->add_actions();
		$rewrite_options = $rewrite->load_options();
		
		if( $rewrite_options['ractive'] == 'yes' ){
			$rewrite->activate();
		}

		// Import / Export activate
		$ie =  new Wpsmcal_ImportExport( $version, $this->options );
		$ie->add_actions();
		
		add_action( 'admin_init', array( $this, 'permalink_settings_init' ) );
		add_action( 'admin_init', array( $this, 'permalink_settings_save' ) );
		add_action( 'admin_menu', array( $this, 'options_page' ) );
		add_action( 'admin_init', array( $this, 'register_settings' ) );
		add_action( 'admin_enqueue_scripts', array( $this, 'enqueue_admin_script' ) );
	}
	
	/**
	 * Activates plugin anf clean Rewrite / redirect rules in WP
	 */
	public function activate_plugin() {
		flush_rewrite_rules();
	}

	/**
	 * Deactivates plugin anf clean Rewrite / redirect rules in WP
	 */
	public function deactivate_plugin() {
		flush_rewrite_rules();
	}
	
	/**
	 * Loads subClasses to the parent Class
	 */
	private function load_dependencies() {
		require_once 'class-wpsmcal-cloaking.php';
		require_once 'class-wpsmcal-statistic.php';
		require_once 'class-wpsmcal-rewrite.php';
		require_once 'class-wpsmcal-import-export.php';
	}
	
	/**
	 * Gets global variable 'filter_base' for subClasses
	 */
	public function get_filter_base() {
		return $this->filter_base;
	}
	
	/**
	 * Gets global variable 'filter_name' for subClasses
	 */
	public function get_filter_name() {
		return $this->filter_name;
	}
	
	/**
	 * Gets global variable 'meta_name' for subClasses
	 */
	public function get_meta_name() {
		return $this->meta_name;
	}

	/**
	 * Gets Remote base prefix from Setings -> Permalinks. Default value: 'go'.
	 */	
	static public function get_affiliate_base() {
		$permalinks = get_option( 'wpsmcal_permalinks' );
		if ( !$permalinks || !isset( $permalinks['affiliate_base'] ) || $permalinks['affiliate_base'] == '' ) {
			return 'go';
		}
		return $permalinks['affiliate_base'];
	}

	/**
	 * Default plugin options
	 */
	public function default_options() {
		return array(
			'cactive' => 'no',
			'status' => '302',
			'robots' => 'no',
			'slug' => 'no',
			'domains' => '',
			'sactive' => 'no',
			'paged' => 20,
			'gactive' => 'no',
			'ga_key' => '',
		);
	}

	/**
	 * Loads and update plugin options
	 */
	public function load_options() {
		$wpsmcal_options = get_option( 'wpsmcal_options' );
		if( isset( $wpsmcal_options['ractive'] ) && isset( $wpsmcal_options['rewrite_fields'] ) ){
			$rewrite_options = array( 'ractive' => $wpsmcal_options['ractive'], 'rewrite_fields' => $wpsmcal_options['rewrite_fields'] );
			update_option( 'wpsmcal_rewrites', $rewrite_options );
		}
		$options = array_merge( $this->default_options(), get_option( 'wpsmcal_options', array() ) );
		update_option( 'wpsmcal_options', $options );
		return $options;
	}
	
	/**
	 * Adds Settings page of the plugin to Admin area
	 */
	public function options_page() {  
		add_menu_page( __( 'RH Link Pro', 'wpsmcal' ), __( 'RH Link Pro', 'wpsmcal' ), 'manage_options', 'wpsmcal-options',  array( $this, 'build_options_page' ), 'dashicons-carrot' );
	}

	/**
	 * Creates Settings page of the plugin with form
	 */
	public function build_options_page() {
		?>
		<div class="wrap" id="wpsmcal_options">
			<h2><?php _e( 'RH Link Pro Settings', 'wpsmcal' ); ?></h2>
			<form method="post" action="options.php">
				<?php
				//wp_nonce_field( 'update-wpsmcal-options' );
				settings_fields( 'wpsmcal-options' );
				do_settings_sections( 'wpsmcal-options' );
				submit_button();
				?>
			</form>
		</div>
		<?php
	}

	/**
	 * Registers Settings page for the plugin and validate them
	 */
	public function register_settings() {
		register_setting( 'wpsmcal-options', 'wpsmcal_options', array( $this, 'validate' ) );
		register_setting( 'wpsmcal-rewrites', 'wpsmcal_rewrites', array( $this, 'validate' ) );
	}
	
	/**
	 * Adds the field of the Affiliate base prefix in Setings -> Permalinks
	 */
	public function permalink_settings_init() {
		add_settings_field( 'wpsmcal_redirect_slug', __( 'Affiliate link base', 'wpsmcal' ), array( $this, 'permalink_input' ), 'permalink', 'optional' );
	}

	/**
	 * Registers Settings page for the plugin and validate them
	 */
	public function permalink_input() {
		$permalinks = get_option( 'wpsmcal_permalinks' );
		$post_rdct = ($this->options['slug'] == 'yes') ? '/%post_id%-%postname%/' : '/%post_id%/';
		?>
		<input name="wpsmcal_affiliate_base" type="text" class="regular-text code" value="<?php if ( isset( $permalinks['affiliate_base'] ) ) echo esc_attr( $permalinks['affiliate_base'] ); ?>" placeholder="<?php echo _x( 'go', 'slug', 'wpsmcal' ); ?>" /><code><?php echo $post_rdct; ?></code>
		<?php
	}

	/**
	 * Saves the value of the Affiliate base prefix in Setings -> Permalinks
	 */
	public function permalink_settings_save() {
		if ( !is_admin() ) 
			return;

		if ( isset( $_POST['wpsmcal_affiliate_base'] ) ) {
			$wpsmcal_affiliate_base = sanitize_text_field( $_POST['wpsmcal_affiliate_base'] );
			$permalinks = get_option( 'wpsmcal_permalinks' );
			if ( ! $permalinks ) {
				$permalinks = array();
			}
			$permalinks['affiliate_base'] = untrailingslashit( $wpsmcal_affiliate_base );
			update_option( 'wpsmcal_permalinks', $permalinks );
		}
	}

	/**
	 * Validates settings fields before saving
	 */
	public function validate( $input ) {			
		if ( !isset( $input ) || empty( $input ) ) 
			return $input;
		
		$new_input = $new_value = array();
		
		foreach( $input as $key => $value ) {
			if( $key == 'cactive' ){
				$new_input['cactive'] = $value;
			}
			if( $key == 'status' ){
				$new_input['status'] = $value;
			}
			if( $key == 'robots' ){
				$new_input['robots'] = $value;
			}
			if( $key == 'slug' ){
				$new_input['slug'] = $value;
			}
			if( $key == 'domains' ){
				$new_input['domains'] = sanitize_textarea_field( $value );
			}
			if( $key == 'sactive' ){
				$new_input['sactive'] = $value;
			}
			if( $key == 'paged' ){
				$new_input['paged'] = $value;
			}
			if( $key == 'gactive' ){
				$new_input['gactive'] = $value;
			}
			if( $key == 'ga_key' ){
				$new_input['ga_key'] = sanitize_text_field( $value );
			}
			if( $key == 'ractive' ){
				$new_input['ractive'] = $value;
			}
			if( $key == 'roles_rewrite' && is_array( $value ) ){
				$new_input['roles_rewrite'] = $value;
			}
			if( $key == 'rewrite_fields' && is_array( $value )  ) {
				for( $i = 0; $i <= count( $value ); $i++){
					if( empty( $value[$i]['checkdomain'] ) ) {
						continue;
					} else {
						$new_value[] = $value[$i];
					}
				}
				$new_input['rewrite_fields'] = $new_value; 
			}
		}
		return $new_input;
	}
	
	/**
	 * Creates an associative array of roles in which each element has role slug as the key and role name as value e.g. 'administrator' => 'Administrator'
	 */
	public function get_roles(){
		global $wp_roles;
		$roles = $wp_roles->roles;
		$roles_arr = array();
		foreach ($roles as $key => $role) {
			$roles_arr[$key] = $role['name'];
		}
		return $roles_arr;
	}
	
	/**
	 * Registers and Enqueues admin JS script for Settings page
	 */
	public function enqueue_admin_script( $page ) {
		if(strpos($page, 'wpsmcal')) {
			wp_enqueue_style( 'wpsmcal_admin_style', WPSMCAL_URIPATH . 'assets/css/wpsmcal-admin.css', array(), $this->version, 'all' );
			wp_enqueue_script( 'wpsmcal_admin_script', WPSMCAL_URIPATH . 'assets/js/wpsmcal-admin.js', array('jquery'), $this->version, true );
			
			$translation_array = array( 
				'ajax_url' => admin_url( 'admin-ajax.php', 'relative' ),
				'nonce' => wp_create_nonce('ajaxed-nonce'),
				'headerUsers' => esc_html__('Users list', 'wpsmcal'),
				'headerPosts' => esc_html__('Posts list', 'wpsmcal'),
				'loader' => esc_html__('loading...', 'wpsmcal'),
				'importNotValid' => esc_html__('Error: Enter the JSON in valid format', 'wpsmcal'),
				'importSuccess' => esc_html__('Import succeed, option page will be refreshed..', 'wpsmcal'),
				'importErrorData' => esc_html__('Error: Imported data is incorrect', 'wpsmcal'),
				'exportErrorData' => esc_html__('Error: Export failed. Try again.', 'wpsmcal'),
			);
			wp_localize_script( 'wpsmcal_admin_script', 'translation', $translation_array );
			
			$json_roles_arr = json_encode( $this->get_roles() );
			wp_add_inline_script( 'wpsmcal_admin_script', '/* <![CDATA[ */var rolesArray = '.$json_roles_arr.';/* ]]> */', 'before' );
		}
	}
}
