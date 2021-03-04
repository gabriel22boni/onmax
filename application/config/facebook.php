<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Facebook configuration constants
 */
if(SERVER_NAME == 'maxfama.dev' || SERVER_NAME == '192.168.0.165') {
	define('FB_APP_ID', '373361672792768');
	define('FB_APP_SECRET', '410157cad0b043ad7b51ba8a320b2a05');
} else {
	define('FB_APP_ID', '373361672792768');
	define('FB_APP_SECRET', '410157cad0b043ad7b51ba8a320b2a05');
}