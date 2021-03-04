<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
|--------------------------------------------------------------------------
| File and Directory Modes
|--------------------------------------------------------------------------
|
| These prefs are used when checking and setting modes when working
| with the file system.  The defaults are fine on servers with proper
| security, but you may wish (or even need) to change the values in
| certain environments (Apache running a separate process for each
| user, PHP under CGI with Apache suEXEC, etc.).  Octal values should
| always be used to set the mode correctly.
|
*/
define('PER_PAGE_WEB',50);
define('PER_PAGE_ADMIN',50);
define('PREF_TABLE', 'max_');
define('TITLE_SITE_ADMIN','Administra&ccedil;&atilde;o MaxFama - ');
define('MAIL_TO','contato@onmax.com.br');
define('MAIL_FROM','webmasters@onmax.com.br');
define('MAIL_BCC','');
define('FILE_READ_MODE', 0644);
define('FILE_WRITE_MODE', 0666);
define('DIR_READ_MODE', 0755);
define('DIR_WRITE_MODE', 0777);
define('SERVER_NAME', $_SERVER['SERVER_NAME']); //VERIFICA SE O SITE ESTA NO SERVIDOR LOCAL OU AR

define('SANBOX', 0);

if (!(SANBOX)) {
	define('EMAILPAGSEGURO', 'ybrasil@ybrasil.com.br');
	define('TOKENPAGSEGURO', '116e34e8-3511-45d0-8499-f75017e5dd83bf28c603434f937fd580b3e9b29d050bad67-460a-4a45-958f-e9019ae20dd4');
	define('URLNOTIFICACAO', 'https://www.onmax.com.br/pagseguro/retornoPagamento.php');

    define('SCRIPTPAGSEGURO', 'https://stc.pagseguro.uol.com.br/pagseguro/api/v2/checkout/pagseguro.directpayment.js');
    define('URLPAGSEGURO', 'https://ws.pagseguro.uol.com.br/v2/');

} else {
    define('EMAILPAGSEGURO', 'gccamargo@gmail.com');
	define('TOKENPAGSEGURO', 'D89D0DCAAAAC47E39F5419AFC8D102BB');
	define('URLNOTIFICACAO', 'https://www.onmax.com.br/pagseguro/retornoPagamento.php');

    define('SCRIPTPAGSEGURO', 'https://stc.sandbox.pagseguro.uol.com.br/pagseguro/api/v2/checkout/pagseguro.directpayment.js');
    define('URLPAGSEGURO', 'https://ws.sandbox.pagseguro.uol.com.br/v2/');
}


/*
|--------------------------------------------------------------------------
| File Stream Modes
|--------------------------------------------------------------------------
|
| These modes are used when working with fopen()/popen()
|
*/

define('FOPEN_READ',							'rb');
define('FOPEN_READ_WRITE',						'r+b');
define('FOPEN_WRITE_CREATE_DESTRUCTIVE',		'wb'); // truncates existing file data, use with care
define('FOPEN_READ_WRITE_CREATE_DESTRUCTIVE',	'w+b'); // truncates existing file data, use with care
define('FOPEN_WRITE_CREATE',					'ab');
define('FOPEN_READ_WRITE_CREATE',				'a+b');
define('FOPEN_WRITE_CREATE_STRICT',				'xb');
define('FOPEN_READ_WRITE_CREATE_STRICT',		'x+b');


/* End of file constants.php */
/* Location: ./application/config/constants.php */
