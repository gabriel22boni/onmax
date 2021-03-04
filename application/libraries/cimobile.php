<?php if (! defined ( 'BASEPATH' ))exit ( 'No direct script access allowed' );
/*
	CodeIgniter Library Powered By:
 _       _                        _   
| |     | |                      | |  
| |_ ___| |_ _ __ __ _ _ __   ___| |_ 
| __/ _ \ __| '__/ _` | '_ \ / _ \ __|
| ||  __/ |_| | | (_| | | | |  __/ |_ 
 \__\___|\__|_|  \__,_|_| |_|\___|\__|

		www.tetranet.com.br
*/

// --------------------------------------------------------------------------------------------------

/**
 * This library was inplemented on alexking plugin for Wordpress
 * We made modifications, adaptations, improovements, add ons and
 * other stuffs using the alexking plugin as a base.
 * 
 * WordPress Mobile Edition
 * Copyright (c) 2002-2008 Alex King
 * http://alexking.org/projects/wordpress
 * 
 * Released under the GPL license
 * http://www.opensource.org/licenses/gpl-license.php
 * 
 * This program is distributed in the hope that it will be useful, but
 * WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
 * 
 */

// --------------------------------------------------------------------------------------------------

/**
 * CodeIgniter Mobile Class
 *
 * (EN) 
 * This class enables you to optimize your websites for mobile devices
 * giving an easy way to identify browsers and other utilities to use 
 * for cellphones, etc.
 * 
 * HOW-TO
 * We tried to make simpler the use of this library. It has 2 files 
 * the first one is this here ie. the library. The seconde file 
 * is a small controller to put in  your controllers folder. This 
 * controller is responsible for redirections when the mobile or 
 * desktop version is forced to run. 
 * 
 * The use of cimobile is simple, here is the code to put in each 
 * controller and or method:
 * 
 * <code>
 * //loading the library - let AUTO setted for automatic recognition
 * $this->load->library('cimobile', array('browser_type' => 'AUTO') );
 * 
 * //checking if is mobile or not to load the right template
 * if( $this->cimobile->check_mobile() )
 * {
 * 	//This method 'desktop_link' return the LINK for desktop version of the site
 * 	echo $this->cimobile->desktop_link('Goes to desktop version');
 * 	// CI MOBILE TEMPLATE
 * }
 * else
 * {
 * 	//This method 'mobile_link' return the LINK for mobile version of the site
 * 	echo $this->cimobile->mobile_link('Goes to mobile version');	
 * 	// CI DESKTOP TEMPLATE
 * }
 * 
 * //THATS IT  =)
 * </code>
 * 
 * 
 * -- PUBLIC METHODS --
 * 
 * mobile_link		Generates a link to force the mobile version
 * desktop_link		Generates a link to force the desktop version
 * is_valid_imei	Return true if the IMEI number is valid
 * 
 * 
 * 
 * (PT-BR) 
 * Esta classe permite você otimizar seu website para celulares e outros
 * dispositivos móveis, oferecendo uma forma fácil para identificar browsers
 * e outras utilidades para dispositivos móveis.
 * 
 *
 * @package		CodeIgniter
 * @subpackage	Libraries
 * @category	Libraries
 * @author		TetraNet <contato@tetranet.com.br>
 * @link		http://www.tetranet.com.br/blog/cimobile-a-biblioteca-para-dispositivos-moveis-do-codeigniter/
 * @version		1.2
 */


class Cimobile 
{
	
	private $CI				= null;
	private $browser_type	= null;
	
	
	/**
	 * Constructor
	 * 
	 * Constructor to load the deafult setting, prepare the class to work etc.
	 *
	 * @access	public
	 * @param	mixed $params  browser_type = AUTO/reject_mobile/force_mobile
	 */
	function __construct( $params )
	{
		if( function_exists('get_instance') ) 
		{
			// Load original CI object to global CI variable
			$this->CI =& get_instance();
			
			// Loading ci cookie helper to cache user preferences
			$this->CI->load->helper('cookie');
			
			// Loading mobile configuration
			$this->CI->config->load('mobi');
		} 
		else
		{
			// Problems...
			$this->CI = null;
			show_error('Some featutres of cimobile wont work, because get_instance function doesnt exist!');
		}
		
		
		// Holding the value of the URI requested not the URL though.
		$_SERVER['REQUEST_URI'] = ( isset($_SERVER['REQUEST_URI']) ? $_SERVER['REQUEST_URI'] : 
									$_SERVER['SCRIPT_NAME'] . (( isset($_SERVER['QUERY_STRING']) ? 
									'?' . $_SERVER['QUERY_STRING'] : '')));
		
		
		// Force or not the use of the mobile webiste
		if( $params['browser_type'] != 'AUTO' )
		{	
			$domain		= preg_replace("/^[\w]{2,6}:\/\/([\w\d\.\-]+).*$/","$1", base_url());
			$domain 	= "." . preg_replace("/^www\./", "", $domain);
			$path		= '/';
			
			switch( $params['browser_type'] ) 
			{
				case 'reject_mobile':
					$cookie = array
					(
						'name'   => 'browsertype',
						'value'  => 'reject_mobile',
						'expire' => time() + 300000,
						'domain' => $domain,
						'path'   => $path,
						'prefix' => 'cimobile_',
					);
					
					set_cookie( $cookie ); 
					$this->browser_type = $params['browser_type'];
					break;
				
				case 'force_mobile':					
					$cookie = array
					(
						'name'   => 'browsertype',
						'value'  => 'force_mobile',
						'expire' => time() + 300000,
						'domain' => $domain,
						'path'   => $path,
						'prefix' => 'cimobile_',
					);
										
					set_cookie( $cookie ); 
					$this->browser_type = $params['browser_type'];
					break;
			}
		}
		else
		{
			// check if cimobile cookie is available
			if( $value = get_cookie('cimobile_browsertype', true) )
				$this->browser_type = $value;
		}
	
	}
	
	
	
	/*
	 * Check Mobile
	 * 
	 * Function to check if the browser is mobile or not.
	 * 
	 * @access	public
	 * @return boolean
	 */
	public function check_mobile() 
	{
		// force the use the desktop browser
		if( ! isset($_SERVER["HTTP_USER_AGENT"]) || $this->browser_type == 'reject_mobile' ) return false;
		
		// check any pages to be excluded from the mobile version
		// needs some improvements for ci
		if( $this->mobile_exclude() ) return false;		
			
		// force the use of the mobile desktop
		if( $this->browser_type == 'force_mobile' ) return true;
		
		
		/*
		 	List of mobile devices to be excluded
		 */
		$whitelist = array
		(
			'Stand Alone/QNws'
		);
		
		
		foreach( $whitelist as $browser ) 
		{
			if( strstr($_SERVER["HTTP_USER_AGENT"], $browser) ) return false;
		}
		
		
		// Getting from config the list of mobile devices to be recognized
		$small_browsers = $this->CI->config->item('small_browsers');
		
		foreach( $small_browsers as $browser ) 
		{
			if( strstr($_SERVER["HTTP_USER_AGENT"], $browser) ) 
			{
				return true;
			}
		}
		return false;
	}
	
	
	
	/**
	 * Mobile Exclude
	 * 
	 * Check any pages to be excluded from the mobile version 
	 * needs some improvements for ci use.
	 * 
	 * @access	private
	 * @return	boolean
	 */
	private function mobile_exclude() 
	{
		$exclude = false;
		
		$pages_to_exclude = array
		(
			'admin'
			,'intro_flash.php'
		);
		
		
		foreach( $pages_to_exclude as $exclude_page ) 
		{
			if( strstr( strtolower($_SERVER['REQUEST_URI']), $exclude_page) ) 
			{
				$exclude = true;
			}
		}
		return $exclude;
	}
	
	
	
	/**
	 * Mobile Link
	 * 
	 * Return a link to force the use of the mobile version.
	 * 
	 * @access	public
	 * @param	string $phrase The phrase to be the link.
	 * @return	string 
	 */	
	public function mobile_link( $phrase = null ) 
	{		
		if( $phrase == null )
			$phrase = 'Mobile Edition';
		
		return '<a href="'.base_url().'mobiredirect/index/force_mobile">'.$phrase.'</a>';
	}
	
	
	
	/**
	 * Desktop Link
	 * 
	 * Return a link to force the use of the desktop version.
	 * 
	 * @access	public
	 * @param	string $phrase The phrase to be the link.
	 * @return	string 
	 */
	public function desktop_link( $phrase = null ) 
	{		
		if( $phrase == null )
			$phrase = 'Desktop Edition';
		
		return '<a href="'.base_url().'mobiredirect/index/reject_mobile">'.$phrase.'</a>';
	}
	
	
	
	/**
	 * Is Valid IMEI 
	 * 
	 * Function to check if the IMEI number is valid or not.
	 * The main algorithm was taken from:
	 * http://forum.gsmhosting.com/vbb/archive/index.php/t-224211.html  
	 * Contribuição do Website DesbloquearMeuCelular.Com.Br
	 * 
	 * @access	public
	 * @param	$cod_imei	The IMEI code if came with other characters thers no problem.
	 * 
	 * @return	boolean
	 */
	public function is_valid_imei( $cod_imei )
	{
		$error		=   false;
		$cod_imei 	=   preg_replace("/[^0-9]/", "", $cod_imei);  	
		$error		= ! ctype_digit( $cod_imei )		? true : false;			
		$error 		=   strlen($cod_imei) != 15			? true : false;
		$error		=   $cod_imei == '000000000000000'	? true : false;
		$cs 		=   0;
		
		if( ! $error )
		{
			for( $i = 0; $i < 14; $i += 2 )
			{
				$dodd = $cod_imei[ $i + 1 ] << 1;
				$cs  += $cod_imei[ $i ] + (int)( $dodd / 10 ) + ( $dodd % 10 );
			}
			
			$cs = ( 10 - ( $cs % 10 ) ) % 10;
			
			return $cs == $cod_imei[ 14 ] ? true : false;
		}
		else return false;
	}
	
}



# END Cimobile class
# Location: ./application/libraries/cimobile.php
# EOF cimobile.php