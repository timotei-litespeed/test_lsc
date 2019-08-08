<?php defined( 'WPINC' ) || exit ; ?>

	<tr>
		<th>
			<?php $id = LiteSpeed_Cache_Config::O_CACHE_LOGIN_COOKIE ; ?>
			<?php $this->title( $id ) ; ?>
		</th>
		<td>
		<?php
			$this->build_input( $id ) ;

			$this->_validate_syntax( $id ) ;

			echo '<p>' . __('SYNTAX: alphanumeric and "_".', 'litespeed-cache')
				. ' ' . __('No spaces and case sensitive.', 'litespeed-cache')
				. ' ' . __('MUST BE UNIQUE FROM OTHER WEB APPLICATIONS.', 'litespeed-cache')
				. '</p>'
				. '<p>'
					. sprintf(__('The default login cookie is %s.', 'litespeed-cache'), '<code>_lscache_vary</code>')
					. ' ' . __('The server will determine if the user is logged in based on the existance of this cookie.', 'litespeed-cache')
					. ' ' . __('This setting is useful for those that have multiple web applications for the same domain.', 'litespeed-cache')
					. ' ' . __('If every web application uses the same cookie, the server may confuse whether a user is logged in or not.', 'litespeed-cache')
					. ' ' . __('The cookie set here will be used for this WordPress installation.', 'litespeed-cache')
				. '</p>'
				. '<p>'
					. __('Example use case:', 'litespeed-cache')
					. '<br />'
					. sprintf(__('There is a WordPress installed for %s.', 'litespeed-cache'), '<u>www.example.com</u>')
					. '<br />'
					. sprintf(__('Then another WordPress is installed (NOT MULTISITE) at %s', 'litespeed-cache'), '<u>www.example.com/blog/</u>')
					. ' ' . __('The cache needs to distinguish who is logged into which WordPress site in order to cache correctly.', 'litespeed-cache')
				. '</p>'
			;

			if ( preg_match( '#[^\w\-]#', $this->__cfg->option( $id ) ) ) {
				echo '<div class="litespeed-callout notice notice-error inline"><p>❌ ' . __( 'Invalid login cookie. Invalid characters found.', 'litespeed-cache' ) . '</p></div>' ;
			}

			if ( defined( 'LITESPEED_ON' ) && $this->__cfg->option( $id ) ) {

				try {
					$cookie_rule = LiteSpeed_Htaccess::get_instance()->current_login_cookie() ;
				} catch ( \Exception $e ) {
					echo '<div class="litespeed-callout notice notice-error inline"><p>' . $e->getMessage() . '</p></div>' ;
				}

				$cookie_arr = explode( ',', $cookie_rule ) ;
				if ( ! in_array( $this->__cfg->option( $id ), $cookie_arr ) ) {
					echo '<div class="litespeed-callout notice notice-warning inline"><p>'
							. __( 'WARNING: The .htaccess login cookie and Database login cookie do not match.', 'litespeed-cache' )
						. '</p></div>'
					;
				}

			}

		?>
		</td>
	</tr>

