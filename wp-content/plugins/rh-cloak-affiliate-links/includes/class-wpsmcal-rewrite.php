<?php
if ( !defined( 'WPINC' ) ) die;

/**
 * Class Wpsmcal_Rewrite
 *
 * @package RH Link
 */
 
class Wpsmcal_Rewrite extends Wpsmcal {

	/**
	 * Class constructor. Includes essential files and initializes the class attributes.
	 **/
	public function __construct( $version, $options ) {
		$this->version = $version;
		$this->wpsmcal_options = $options;
		$this->options = $this->load_options();
		$this->filter_name = parent::get_filter_name();
	}
	
	/**
	 * Registers the actions of this class with WordPress.
	 */
	public function add_actions(){
		add_action( 'admin_menu', array( $this, 'create_page' ), 11 );
		add_action( 'admin_init', array($this, 'create_options' ), 11 );
	}
	
	/**
	 * Activates Rewriting function
	 */
	public function activate(){
		add_filter( 'the_content', array( $this, 'rewrite_user_links' ) );
		// add_filter( 'comment_text', array( $this, 'rewrite_user_links' ), 10, 2 );
		add_filter( $this->filter_name, array( $this, 'rewrite_offer_link' ), 8, 2 );
	}
	
	/**
	 * Creates the settings section, resgisters setting and adds settings fields.
	 */
	public function create_options(){
		add_settings_section( 'rewrite_settings', esc_html__( 'Rewrite settings', 'wpsmcal' ), array( $this, 'section_settings_desc' ), 'wpsmcal-rewrites' );
		$fields = $this->get_settings_fields();
		foreach( $fields as $key => $value ){
			add_settings_field( $value['slug'], $value['name'], $value['callback'], $value['page'], $value['section'] );
		}
	}
	
	/**
	 * Default plugin options
	 */
	public function default_options() {
		return array(
			'ractive' => 'no',
			'rewrite_fields' => array(),
		);
	}

	/**
	 * Loads and update plugin options
	 */
	public function load_options() {
		$wpsmcal_options = $this->wpsmcal_options;
		$default_options = $this->default_options();
		if( isset( $wpsmcal_options['ractive'] ) && isset( $wpsmcal_options['rewrite_fields'] ) ){
			$default_options['ractive'] = $wpsmcal_options['ractive'];
			$default_options['rewrite_fields'] = $wpsmcal_options['rewrite_fields'];
		}
		$options = array_merge( $default_options, get_option( 'wpsmcal_rewrites', array() ) );
		update_option( 'wpsmcal_rewrites', $options );
		return $options;
	}
	
	/**
	 * Callback function of the Section description
	 */
	function section_settings_desc() {
		esc_html_e( 'The function rewrites user Affiliate URLs in the Post content and in the buttons.', 'wpsmcal' );
		printf( '<br><strong>%s</strong> ', esc_html__( 'NOTE!', 'wpsmcal' ) );
		esc_html_e( 'If you have coded link for rewriting, please, decode it previously. It can have wrong symbols and can not be rewrited.', 'wpsmcal' );
	}
	
	/**
	 * Fields of the Settings page
	 */
	public function get_settings_fields() {
		return array(
			array(
				'slug' => 'activate_rewrite',
				'name' => esc_html__( 'Active rewriting', 'wpsmcal' ),
				'callback' => array( $this, 'field_activate' ),
				'page' => 'wpsmcal-rewrites',
				'section' => 'rewrite_settings',
			),
			array(
				'slug' => 'rewrite_fields',
				'name' => esc_html__( 'Affiliate parametrs', 'wpsmcal' ),
				'callback' => array( $this, 'field_parametrs' ),
				'page' => 'wpsmcal-rewrites',
				'section' => 'rewrite_settings',
			),
		);
	}
	
	/**
	 * The field to enable the ReWrite function
	 */
	public function field_activate() { 
	?>
		<input type="radio" value="yes" name="wpsmcal_rewrites[ractive]" <?php checked( $this->options['ractive'], 'yes', true ); ?> /> <?php esc_html_e( 'Yes', 'wpsmcal' ); ?>&nbsp;
		<input type="radio" value="no" name="wpsmcal_rewrites[ractive]" <?php checked( $this->options['ractive'], 'no', true ); ?> /> <?php esc_html_e( 'No', 'wpsmcal' ); ?>
	<?php
	}
	
	/**
	 * Grouped Fields which chnges user Affiliate parametrs
	 */
	public function field_parametrs() { 
		$domains = $affids = array();
		$fields_arr = $this->options['rewrite_fields']; 
		$roles_arr = parent::get_roles();
		
		foreach( $fields_arr as $key => $value ) {
			$domains[$key] = $this->options['rewrite_fields'][$key]['checkdomain'];
			$affids[$key] = $this->options['rewrite_fields'][$key]['afftag'];
		}
		
		asort( $domains );
		asort( $affids );
		?>
		<table class="wpsmcal-group-titles">
			<tr>
				<td>
				<?php if( empty( $fields_arr ) ) { ?>
					<?php esc_html_e( 'Affiliate domain', 'wpsmcal' ); ?>
				<?php } else { ?>
					<?php  ?>
					<select id="domains_list">
						<option value="" selected="selected"><?php esc_html_e( 'Affiliate domain', 'wpsmcal' ); ?></option>
						<?php foreach( $domains as $domain ) { ?>
						<option value="<?php echo $domain; ?>"><?php echo $domain; ?></option>
						<?php } ?>
					</select>
				<?php } ?>
				</td>
				<td>
				<?php if( empty( $fields_arr ) ) { ?>
					<?php esc_html_e( 'Aff. ID or Network URL', 'wpsmcal' ); ?>
				<?php } else { ?>
					<?php  ?>
					<select id="afftags_list">
						<option value="" selected="selected"><?php esc_html_e( 'Your aff ID/Network', 'wpsmcal' ); ?></option>
						<?php foreach( $affids as $affid ) { ?>
						<option value="<?php echo $affid; ?>"><?php echo $affid; ?></option>
						<?php } ?>
					</select>
				<?php } ?>
				</td>
				<td><?php esc_html_e( 'Tag parameter or empty', 'wpsmcal' ); ?></td>
				<td><?php esc_html_e( 'Feasibility', 'wpsmcal' ); ?></td>
				<td><?php esc_html_e( 'Set as deeplink', 'wpsmcal' ); ?></td>
			</tr>
		</table>
		<?php if( empty( $fields_arr ) ) { ?>
		<table class="wpsmcal-group-inputs">
			<tr class="wpsmcal-group-input">
				<td><input type="text" value="" name="wpsmcal_rewrites[rewrite_fields][0][checkdomain]" /></td>
				<td><input type="text" value="" name="wpsmcal_rewrites[rewrite_fields][0][afftag]" /></td>
				<td><input type="text" value="" name="wpsmcal_rewrites[rewrite_fields][0][affstring]" /></td>
				<td><input type="number" value="100" name="wpsmcal_rewrites[rewrite_fields][0][random]" min="0" max="100" step="10">%</td>
				<td>
					<input type="radio" value="yes" name="wpsmcal_rewrites[rewrite_fields][0][aff_move]" /> <?php esc_html_e( 'Yes', 'wpsmcal' ); ?>&nbsp;
					<input type="radio" value="no" name="wpsmcal_rewrites[rewrite_fields][0][aff_move]" checked="checked" /> <?php esc_html_e( 'No', 'wpsmcal' ); ?>
				</td>
			</tr>
			<tr class="wpsmcal-group-roles">
				<td colspan="5">
					<?php foreach( $roles_arr as $role => $role_value ): ?>
					<label for="wpsmcal_rewrites[rewrite_fields][0][roles_rewrite][<?php echo $role; ?>]"><?php echo $role_value; ?>: </label>
					<input type="hidden" name="wpsmcal_rewrites[rewrite_fields][0][roles_rewrite][<?php echo $role; ?>]" value="0" />
					<input type="checkbox" name="wpsmcal_rewrites[rewrite_fields][0][roles_rewrite][<?php echo $role; ?>]" value="1" />
					<?php endforeach; ?>
					<p class="description"><?php esc_html_e( 'Choose user roles whose links will be rewritten. No chosen roles mean the rewriting for all roles.', 'wpsmcal' ); ?></p>
				</td>
			</tr>
		</table>
		<?php } else { ?>
		<table class="wpsmcal-group-inputs">
			<?php foreach( $fields_arr as $key => $value ) { ?>
			<tr class="wpsmcal-group-input">
				<td><input type="text" class="checkdomain" value="<?php echo $this->options['rewrite_fields'][$key]['checkdomain']; ?>" name="wpsmcal_rewrites[rewrite_fields][<?php echo $key; ?>][checkdomain]" /></td>
				<td><input type="text" class="afftag" value="<?php echo $this->options['rewrite_fields'][$key]['afftag']; ?>" name="wpsmcal_rewrites[rewrite_fields][<?php echo $key; ?>][afftag]" /></td>
				<td><input type="text" value="<?php echo $this->options['rewrite_fields'][$key]['affstring']; ?>" name="wpsmcal_rewrites[rewrite_fields][<?php echo $key; ?>][affstring]" /></td>
				<td><input type="number" value="<?php echo $this->options['rewrite_fields'][$key]['random']; ?>" name="wpsmcal_rewrites[rewrite_fields][<?php echo $key; ?>][random]" min="0" max="100" step="10">%</td>
				<?php if( !isset( $this->options['rewrite_fields'][$key]['aff_move']) ): $this->options['rewrite_fields'][$key]['aff_move'] = 'no'; endif; ?>
				<td><input type="radio" value="yes" name="wpsmcal_rewrites[rewrite_fields][<?php echo $key; ?>][aff_move]" <?php checked( $this->options['rewrite_fields'][$key]['aff_move'], 'yes', true ); ?> /> <?php esc_html_e( 'Yes', 'wpsmcal' ); ?>&nbsp;
				<input type="radio" value="no" name="wpsmcal_rewrites[rewrite_fields][<?php echo $key; ?>][aff_move]" <?php checked( $this->options['rewrite_fields'][$key]['aff_move'], 'no', true ); ?> /> <?php esc_html_e( 'No', 'wpsmcal' ); ?></td>
			</tr>
			<tr class="wpsmcal-group-roles">
				<td colspan="5">
				<?php foreach( $roles_arr as $role => $role_value ): ?>
				<?php $checked_role = (isset($this->options['rewrite_fields'][$key]['roles_rewrite'][$role])) ? $this->options['rewrite_fields'][$key]['roles_rewrite'][$role] : ''; ?>
				<label for="wpsmcal_rewrites[rewrite_fields][<?php echo $key; ?>][roles_rewrite][<?php echo $role; ?>]"><?php echo $role_value; ?>: </label>
				<input type="hidden" name="wpsmcal_rewrites[rewrite_fields][<?php echo $key; ?>][roles_rewrite][<?php echo $role; ?>]" value="0" />
				<input type="checkbox" name="wpsmcal_rewrites[rewrite_fields][<?php echo $key; ?>][roles_rewrite][<?php echo $role; ?>]" value="1" <?php checked( $checked_role ); ?> />
				<?php endforeach; ?>
				</td>
			</tr>
			<?php } ?>
		</table>
		<?php } ?>
		<br>
		<a href="#" id="wpsmcal_add_fields" class="button button-secondary"><?php esc_html_e( 'Add More', 'wpsmcal' ); ?></a><br><br>
		<ul class="wpsmcal-notice notice notice-info">
			<li><?php esc_html_e( '- To rewrite or add your affiliate tag: domain.com/?tag=afftag-01. Example: "domain.com" | "afftag-02" | "tag=" | 50% | No', 'wpsmcal' ); ?></li>
			<li><?php esc_html_e( '- To rewrite an affiliate tag in a link without query: domain.com/ref/member_abcd1234. Example: "domain.com" | "abcd2222" | "member_" | 100% | No', 'wpsmcal' ); ?></li>
			<li><?php esc_html_e( '- To set a direct product link: domain.com/product/123 as a deeplink. Example: "domain.com" | "http://affiliate.net/ref.php?user=7151&reflink=" | "" | 100% | Yes', 'wpsmcal' ); ?></li>
			<li><?php esc_html_e( '- To delete any link group just clean up "Affiliate domain" field and Save Changes.', 'wpsmcal' ); ?></li>
			<li><?php esc_html_e( 'Also, you can choose user roles whose links will be rewritten. No chosen roles mean the rewriting works for all roles.', 'wpsmcal' ); ?></li>
			
		</ul>
		<?php
	}
	
	/**
	 * Creates the statistics page in plugin menu
	 */
	public function create_page(){
		$parent_slug = 'wpsmcal-options';
		$page_title = esc_html__( 'RH Rewrite Affiliate Links', 'wpfepp-plugin' );
		$menu_title = esc_html__( 'Rewrite links', 'wpsmcal' );
		$capability = 'manage_options';
		$menu_slug = 'wpsmcal-rewrites';
		$callback = array( $this, 'build_page' );
		add_submenu_page( $parent_slug, $page_title, $menu_title, $capability, $menu_slug, $callback );
	}
	
	/**
	 * Sets up the statistics page.
	 */
	public function build_page() {
		?>
		<div class="wrap">
			<h2><?php esc_html_e( 'RH Rewrite Affiliate Links Settings', 'wpsmcal' ); ?></h2>
			<form method="post" action="options.php">
				<?php
				settings_fields( 'wpsmcal-rewrites' );
				do_settings_sections( 'wpsmcal-rewrites' );
				submit_button();
				?>
			</form>
		</div>
		<?php
	}

	/**
	 * Rewrites user Affiliate link in Post Offer field.
	 */
	public function rewrite_offer_link( $offer_post_url, $codeid = null ){
	
		global $post;
		
		if( $codeid !== null ){
			$post = get_post( $codeid );
		}
		
		if( empty( $post ) )
			return $offer_post_url;
		
		$post_id = $post->ID;
		$rewrite_fields = $this->options['rewrite_fields'];
		
		if( empty( $offer_post_url ) && empty( $rewrite_fields ) ) 
			return;
		
		foreach( $rewrite_fields as $key => $rewrite_param ) {
			$active_role = $this->user_active_role( $post->post_author, $key );
			$rand_value = $rewrite_fields[$key]['random'] / 10;
			
			if( false == apply_filters( 'wpsmcal_link_active_role', $active_role, $post ) ) continue;
			if( false == apply_filters( 'wpsmcal_link_random_check', $this->random_check( $rand_value, $post_id ), $post ) ) continue;
			
			$parsed_domain = parse_url( $offer_post_url, PHP_URL_HOST );
			$match_checkdomain = strpos( '-'. $parsed_domain, $rewrite_param['checkdomain'] );
			
			if ( $match_checkdomain ) {
				$afftag = $rewrite_param['afftag'];
				$affstring = $rewrite_param['affstring'];
				
				if( isset( $rewrite_param['aff_move'] ) && $rewrite_param['aff_move'] == 'yes' ){
					$offer_post_url = $afftag . $offer_post_url .'"';
				}
				else{
					$parsed_query = parse_url( $offer_post_url, PHP_URL_QUERY );
					$match_affstring = preg_match("/({$affstring})/", $offer_post_url);

					if( !empty( $parsed_query ) ) {
						foreach( array( '?','&','&amp;' ) as $sym_key ) {
							$sym_affstring = $sym_key . $affstring;
							$match_sym_affstring = strpos( $offer_post_url, $sym_affstring );
							if( $match_sym_affstring ) break;
						}
						if( !empty( $match_sym_affstring ) ) {
							$new_afftag = $affstring . $afftag;
							$affstring = preg_quote( $affstring );
							$offer_post_url = preg_replace( "/({$affstring}).*?(\z|&)/", "{$new_afftag}", $offer_post_url );
							
						}
						else{
							$offer_post_url = $offer_post_url . $affstring . $afftag .'"'; 
						}
					}
					elseif( $match_affstring ){
						$offer_post_url = preg_replace( "/({$affstring})\w+/", "{$afftag}", $offer_post_url );
					}
					else{
						$offer_post_url = $offer_post_url .'?'. $rewrite_param['affstring'] . $afftag;
					}
				}
			}
		}
		
		if( !is_single() ){
			$this->set_counter( $post_id );
		}
	
		return $offer_post_url;
	}
	
	/**
	 * Rewrites user Affiliate parameters to Admin ones.
	 */
	public function set_rewrite_parts( $content, $checkdomain, $affstring, $afftag, $aff_move ) {
		$new_urls = $old_urls = array();
		preg_match_all( '/<a href="(.*?)"/', $content, $matches, PREG_PATTERN_ORDER);
		for( $i = 0; $i < count( $matches[1] ); $i++ ) {
			$finded_url = $matches[1][$i];
			$parsed_domain = parse_url( $finded_url, PHP_URL_HOST );
			$match_checkdomain = strpos( '-'. $parsed_domain, $checkdomain );
			if( $match_checkdomain ) {
				if( $aff_move == 'yes' ){
					$new_urls[$i] =  '"'. $afftag . $finded_url .'"';
					$old_urls[$i] = '"'. $finded_url .'"';
				}
				else{
					$parsed_query = parse_url( $finded_url, PHP_URL_QUERY );
					if( !empty( $parsed_query ) ) {
						$match_affstring = strpos( $finded_url, $affstring );
						if ( !empty( $match_affstring ) ) {
							$new_urls[$i] = preg_replace( "/(". $affstring .").*?(\z|&)/", "$1". $afftag ."$2", $finded_url ) .'"';
						}else{
							$new_urls[$i] = $finded_url .'&amp;'. $affstring . $afftag .'"';
						} 
					}
					else{
						$new_urls[$i]= $finded_url .'?'. $affstring . $afftag .'"';
					}
					$old_urls[$i] = $finded_url .'"';
				}
				
			}
		}
		$urls =array(
			'old_urls' => $old_urls,
			'new_urls' => $new_urls
		);
		return $urls;
	}
	
	/**
	 * Rewrites user Affiliate links in Post WP Content.
	 */
	public function rewrite_user_links( $content, $post = '' ) {

		global $post;
		
		if( !$post )
			return $content;
		
		$post_id = $post->ID;
		$rewrite_fields = $this->options['rewrite_fields'];
		
		if( empty( $rewrite_fields ) )
			return $content;
		
		$urls_arr = array(
			'old_urls' => array(),
			'new_urls' => array()
		);
		
		foreach( $rewrite_fields as $key => $rewrite_param ) {
			$active_role = $this->user_active_role( $post->post_author, $key );
			$rand_value = $rewrite_fields[$key]['random'] / 10;
			if( false == apply_filters( 'wpsmcal_links_active_role', $active_role, $post ) ) continue;
			if( false == apply_filters( 'wpsmcal_links_random_check', $this->random_check( $rand_value, $post_id ), $post ) ) continue;
			$aff_move = (isset($rewrite_param['aff_move'])) ? $rewrite_param['aff_move'] : 'no';
			$urls = $this->set_rewrite_parts( $content, $rewrite_param['checkdomain'], $rewrite_param['affstring'], $rewrite_param['afftag'], $aff_move );
			$urls_arr['old_urls'] = array_merge($urls_arr['old_urls'], $urls['old_urls']);
			$urls_arr['new_urls'] = array_merge($urls_arr['new_urls'], $urls['new_urls']);
		}

		if( !empty( $urls_arr ) ){
			$new_content = str_replace( $urls_arr['old_urls'], $urls_arr['new_urls'], $content, $count );
		}else{
			$new_content = $content;
		}
		
		$this->set_counter( $post_id );
		
		return $new_content;
	}
	
	/**
	 * Get activated roles
	 */
	public function user_active_roles( $key ) {
		$roles = $this->options['rewrite_fields'][$key]['roles_rewrite'];
		$active_roles = array();
		foreach( $roles as $role => $value ){
			if( $value ){
				$active_roles[] = $role;
			}
		}
		return $active_roles;
	}
	
	/**
	 * Check if the user has activated roles
	 */
	public function user_active_role( $post_author_id, $key ) {
		$active_roles = $this->user_active_roles( $key );
		$active_role = false;
		
		$user = get_userdata( $post_author_id );
		
		if( empty( $user ) || is_wp_error( $user ) )
			return $active_role;

		$user_roles = $user->roles;
		if( !empty( $active_roles ) ){
			foreach( $user_roles as $user_role ) {
				if( in_array( $user_role, $active_roles ) ) {
					$active_role = true;
					break;
				}
			}
		}else{
			$active_role = true;
		}
		return apply_filters( 'wpsmcal_user_active_role', $active_role, $user_roles );
	}
	
	/**
	 * Random trigger
	 */
	public function random_check( $rand_value, $post_id ) {
		$rand = get_transient( 'count_random_'. $post_id );
		$rand = (!empty($rand)) ? $rand : 1;

		$fortypros = ($rand % 3 == 0 || $rand % 2 == 0) ? true : false;
		$fortycons = ($rand % 3 == 0 && $rand % 2 == 0) ? true : false;
		
		if( $rand_value == 1 && $rand == 1 ) { return true;
		}elseif( $rand_value == 2 && $rand % 5 == 0 ) { return true;
		}elseif( $rand_value == 3 && $rand % 3 == 0 ) { return true;
		}elseif( $rand_value == 4 && ( !$fortypros || $fortycons ) ) { return true;
		}elseif( $rand_value == 5 && $rand % 2 == 0 ) { return true;
		}elseif( $rand_value == 6 && $fortypros ) { 
			if( $fortycons ){ return false; } else { return true; }
		}elseif( $rand_value == 7 && $rand % 3 != 0 ) { return true;
		}elseif( $rand_value == 8 && $rand % 5 != 0 ) { return true;
		}elseif( $rand_value == 9 && $rand != 1 ) { return true;
		}elseif( $rand_value == 10 ) { return true;
		}else{
			return false;
		}
	}
	
	/** 
	 * Sets random counter
	 */
	public function set_counter( $post_id ){
 		$i = get_transient( 'count_random_'. $post_id );
		$i = (!empty($i)) ? $i : 1;
		$i++;
		set_transient( 'count_random_'. $post_id, $i, DAY_IN_SECONDS );
	}
}
