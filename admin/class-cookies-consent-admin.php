<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       https://maturocha.com.ar/
 * @since      1.0.0
 *
 * @package    Cookies_Consent
 * @subpackage Cookies_Consent/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Cookies_Consent
 * @subpackage Cookies_Consent/admin
 * @author     Mati Rocha <matu.rocha@gmail.com>
 */
class Cookies_Consent_Admin {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Cookies_Consent_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Cookies_Consent_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/cookies-consent-admin.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Cookies_Consent_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Cookies_Consent_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/cookies-consent-admin.js', array( 'jquery' ), $this->version, false );

	}

	/**
	 * Adds a settings page link to a menu
	 *
	 * @link 		https://codex.wordpress.org/Administration_Menus
	 * @since 		1.0.0
	 * @return 		void
	 */
	public function add_menu() {

		/*MENU NUEVO */

		$page_title = __( 'Admin Prices', 'cookies-consent-plugin' );
		$menu_title = __( 'Cookies Panel', 'cookies-consent-plugin' );
		$capability = 'manage_options';
		$menu_slug = 'wazabi-panel';
		$icon_menu = 'dashicons-hammer';
		add_menu_page( $page_title, $menu_title, $capability, $menu_slug, '', $icon_menu, 81 );

		$options = get_option('wzb_general_plugin_options');

		if (	!(empty($options)) &&
				( isset($options['wzb_enable_cookies_options'])) ) {

			$sub_page_title = __( 'Cookies Settings', 'price-calculator' );
			$sub_menu_title = __( 'Cookies Settings', 'price-calculator' );
			$sub_menu_slug = 'cookies-settings';
			$sub_menu_function =  array( $this, 'display_cookies_page' );
			add_submenu_page( $menu_slug, $sub_page_title, $sub_menu_title, $capability, $sub_menu_slug, $sub_menu_function );
		
		}	


		$sub_page_title = __( 'Opciones', 'cookies-consent-plugin' );
		$sub_menu_title = __( 'Opciones', 'cookies-consent-plugin' );
		$sub_menu_slug = 'cookies-general-options';
		$sub_menu_function =  array( $this, 'display_general_page' );
		add_submenu_page( $menu_slug, $sub_page_title, $sub_menu_title, $capability, $sub_menu_slug, $sub_menu_function );

		remove_submenu_page( $menu_slug, $menu_slug );

	} // add_menu()

		/**
	 * Adds a settings page link to a menu
	 *
	 * @link 		https://codex.wordpress.org/Administration_Menus
	 * @since 		1.0.0
	 * @return 		void
	 */
	public function add_general_settings() {

		//General Settings Field

		register_setting(
			'wzb_general_plugin_options_group', // Option group
			'wzb_general_plugin_options' // Option name
		);

		add_settings_section(
			'wzb_general_plugin_section', // ID
			'Configuraciones Generales', // Title
			null, // Callback
			'wzb_general_plugin_options' // Page
		);  

		add_settings_field(
			"wzb_enable_chat_options",	// ID
			"Enabled Chat Module",
			array( $this, 'display_checkbox_field' ), 		// // The name of the function responsible for rendering the option interface 
			"wzb_general_plugin_options",		// The page on which this option will be displayed 
			"wzb_general_plugin_section",		// The name of the section to which this field belongs
			array(  
				'wzb_general_plugin_options',  					// The array of arguments to pass to the callback.   
				'wzb_enable_chat_options',
				''
			)
		);  

		add_settings_field(
			"wzb_enable_cookies_options",	// ID
			"Enabled Cookies Module",
			array( $this, 'display_checkbox_field' ), 		// // The name of the function responsible for rendering the option interface 
			"wzb_general_plugin_options",		// The page on which this option will be displayed 
			"wzb_general_plugin_section",		// The name of the section to which this field belongs
			array(  
				'wzb_general_plugin_options',  					// The array of arguments to pass to the callback.   
				'wzb_enable_cookies_options',
				''
			)
		);  


	} // add_new_settings()

	public function add_cookies_settings() {

		register_setting(
			'wzb_cookies_options_group', // Option group
			'wzb_cookies_options' // Option name
		);

		add_settings_section(
			'wzb_cookies_section', // ID
			'Cookies Settings', // Title
			null, // Callback
			'wzb_cookies_options' // Page
		);  

		add_settings_field(
			"wzb_enable_cookies",	// ID
			"Enabled Cookies Consent",
			array( $this, 'display_checkbox_field' ),  		// // The name of the function responsible for rendering the option interface 
			"wzb_cookies_options",		// The page on which this option will be displayed 
			"wzb_cookies_section",		// The name of the section to which this field belongs
			array(  
				'wzb_cookies_options',  					// The array of arguments to pass to the callback.   
				'wzb_enable_cookies',
				''
			)
		); 
		
		add_settings_field(
			"wzb_text_cookies",	// ID
			"Notification Text",
			array( $this, 'display_textarea_field' ), // The name of the function responsible for rendering the option interface 
			"wzb_cookies_options",		// The page on which this option will be displayed 
			"wzb_cookies_section",		// The name of the section to which this field belongs
			array(  
				'wzb_cookies_options',	
				'wzb_text_cookies',
				'The default text to indicate that your site uses cookies'
			)
		);

		add_settings_field(
			"wzb_more_info_cookies",	// ID
			"More Info Text",
			array( $this, 'display_text_field' ), // The name of the function responsible for rendering the option interface 
			"wzb_cookies_options",		// The page on which this option will be displayed 
			"wzb_cookies_section",		// The name of the section to which this field belongs
			array(  
				'wzb_cookies_options',	
				'wzb_more_info_cookies',
				'The default text to use to link to a page providing further information'
			)
		);

		add_settings_field(
			"wzb_more_info_url_cookies",	// ID
			"More Info URL",
			array( $this, 'display_select_pages' ), 		// // The name of the function responsible for rendering the option interface 
			"wzb_cookies_options",		// The page on which this option will be displayed 
			"wzb_cookies_section",		// The name of the section to which this field belongs
			array(  
				'wzb_cookies_options',	
				'wzb_more_info_url_cookies',
				'The page containing further information about your cookie policy'
			)
		);

	}

	public function display_general_page() {

		include( 'partials/admin-general-panel.php' );

	}


	public function display_cookies_page() {

		include( 'partials/admin-cookies-panel.php' );

	}

	public function display_checkbox_field($args)
    {
		$option = $args[0];
		$key = $args[1];
		$options_list = get_option($option);
		$value = (isset($options_list[$key])) ? $options_list[$key] : false;
		$nameField = $option . "[" . $key . "]";

		?>
		<input type="checkbox" name="<?php echo $nameField ?>" value="1" <?php checked(1, $value); ?> />

		<?php

		if (!(empty($args[2]))) { ?>

			<p class="description" id="tagline-description"><?php echo $args[1]; ?></p>
			<?php
		}
	
	}
	
	public function display_text_field($args)
    {
		
		$option = $args[0];
		$key = $args[1];
		$options_list = get_option($option);
		$value = (isset($options_list[$key])) ? esc_attr($options_list[$key]) : '';
		$nameField = $option . "[" . $key . "]";

		?>

		<input type='text' id='<?php echo $key ?>' name='<?php echo $nameField ?>' value='<?php echo $value ?>' />

		<?php

		if (!(empty($args[2]))) { ?>

			<p class="description" id="tagline-description"><?php echo $args[2]; ?></p>
			<?php
		}

	
	}

	public function display_text_field_dynamic($args)
    {

		wp_enqueue_script( 'dynamic-field-js', plugins_url('/js/wzb-chat-dynamic-field.js', __FILE__), array('jquery'), '', true );
		
		$option = $args[0];
		$key = $args[1];
		$options_list = get_option($option);
		$dynamics_fields = $options_list[$key];
		$nameField = $option . "[" . $key . "]";

		?>
		<button data-name="<?php echo $nameField ?>" class="button button-secondary add_field_button">Agregar +</button>
		<div class="dynamic-fields-wrapper">
		<?php
		foreach ($dynamics_fields as $id => $value) {
			//$value = $options_list[$key][$id];
			?>
			<div>
				<input type='text' id='<?php echo $key.'-'.$id ?>' name='<?php echo $nameField ?>[]' value='<?php echo $value; ?>' />
				<?php
				if ($id >= 1) {
					?>
						<a href="#" class="remove_field">Quitar</a>
					<?php	
				}
				?>
			</div>
			<?php
		} ?>

		</div>

		<?php

		if (!(empty($args[2]))) { ?>

			<p class="description" id="tagline-description"><?php echo $args[2]; ?></p>
			<?php
		}

	
	}


	public function display_textarea_field($args)
    {

		$option = $args[0];
		$key = $args[1];
		$options_list = get_option($option);
		$value = (isset($options_list[$key])) ? esc_attr($options_list[$key]) : '';
		$nameField = $option . "[" . $key . "]";

		?>

		<textarea id="<?php echo $key ?>" name="<?php echo $nameField ?>" cols="40" rows="3" class="" aria-required="true" aria-invalid="false" placeholder="Escribir mensaje..."><?php echo $value ?></textarea>


		<?php

		if (!(empty($args[2]))) { ?>

			<p class="description" id="tagline-description"><?php echo $args[2]; ?></p>
			<?php
		}

	
	}
	
	public function display_hours_field($args)
    {

		$option = $args[0];
		$key = $args[1];
		$options_list = get_option($option);
		$value = (isset($options_list[$key])) ? esc_attr($options_list[$key]) : '';
		$nameField = $option . "[" . $key . "]";


		?>

		<input type="time" id="<?php echo $key ?>" name="<?php echo $nameField ?>" value="<?php echo $value ?>" />

		<?php
		if (!(empty($args[2]))) { ?>

			<p class="description" id="tagline-description"><?php echo $args[2]; ?></p>
			<?php
		}

	
	}

	public function display_upload_field($args)
    {

		$option = $args[0];
		$key = $args[1];
		$options_list = get_option($option);
		$image_id = (isset($options_list[$key])) ? $options_list[$key] : false;
		$nameField = $option . "[" . $key . "]";

		if( $image = wp_get_attachment_image_src( $image_id ) ) {
 
			echo '<a href="#" class="wzb-upl-img"><img src="' . $image[0] . '" /></a>
				  <a href="#" class="wzb-rmv-img">Eliminar icono</a>
				  <input type="hidden" class="img-val" name="'.$nameField.'" value="' . $image_id . '">';
		 
		} else {
		 
			echo '<a href="#" class="wzb-upl-img">Upload image</a>
				  <a href="#" class="wzb-rmv-img" style="display:none">Eliminar icono</a>
				  <input type="hidden" class="img-val" name="'.$nameField.'" value="">';
		 
		}

	
	}

	public function display_colorpicker_field($args)
    {

		$option = $args[0];
		$key = $args[1];
		$options_list = get_option($option);
		$color_id = (isset($options_list[$key])) ? $options_list[$key] : '';
		$nameField = $option . "[" . $key . "]";

		?>

		<input id="color_code" class="color-picker" id="<?php echo $key ?>" name="<?php echo $nameField ?>" type="text" value="<?php echo $color_id ?>" />

		<?php

	
	}

	public function display_select_field($args)
  	{
			$option = $args[0];
			$key = $args[1];
			$options_list = get_option($option);
			$value = (isset($options_list[$key])) ? $options_list[$key] : false;
			$options = $args[2];
			$nameField = $option . "[" . $key . "]";
			?>

			<select id="<?php echo $key ?>" name="<?php echo $nameField ?>">
				<?php
				foreach ($options as $key => $label) {
					?>
					<option value="<?php echo $key ?>" <?php selected( $key == $value ); ?>><?php echo $label ?></option>	
					<?php
				}
				?>
			</select>
		
			<?php

	}

	public 	function display_select_pages($args) {
		$option = $args[0];
		$key = $args[1];
		$options_list = get_option($option);
		$value = (isset($options_list[$key])) ? $options_list[$key] : false;
		$options = $args[2];
		$nameField = $option . "[" . $key . "]";
		// Get all pages
		$pages = get_pages();
		?>
		<?php if ( $pages ) { ?>
			<select id="<?php echo $key ?>" name="<?php echo $nameField ?>">
				<option></option>
				<?php foreach ( $pages as $page ) { ?>
					<option value='<?php echo esc_attr( $page->ID ); ?>' <?php selected( $value, $page->ID ); ?>><?php echo esc_html( $page->post_title ); ?></option>
				<?php } ?>
			</select>
					
		<?php
		
		}

		if (!(empty($args[2]))) { ?>
			<p class="description" id="tagline-description"><?php echo $args[2]; ?></p>
			<?php
		}

	}

}
