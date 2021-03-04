<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	http://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There area two reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router what URI segments to use if those provided
| in the URL cannot be matched to a valid route.
|
*/

$route['default_controller'] 												= "home";
$route['404_override'] 														= 'error';

$route['home/baby']															= "home/index/9";
$route['home/kids']															= "home/index/10";
$route['home/teens']														= "home/index/11";
$route['home/women']														= "home/index/12";
$route['home/men']															= "home/index/13";
$route['home/types']														= "home/index/14";
$route['home/seniors']														= "home/index/15";
$route['home/plus-size']													= "home/index/16";

// $route['trabalhos/baby']													= "trabalhos/index/9";
// $route['trabalhos/baby/pagina/(:num)']										= "trabalhos/index/9";
// $route['trabalhos/baby/pagina']												= "trabalhos/index/9";

// $route['trabalhos/kids']													= "trabalhos/index/10";
// $route['trabalhos/kids/pagina/(:num)']										= "trabalhos/index/10";
// $route['trabalhos/kids/pagina']												= "trabalhos/index/10";

// $route['trabalhos/teens']													= "trabalhos/index/11";
// $route['trabalhos/teens/pagina/(:num)']										= "trabalhos/index/11";
// $route['trabalhos/teens/pagina']											= "trabalhos/index/11";

// $route['trabalhos/women']													= "trabalhos/index/12";
// $route['trabalhos/women/pagina/(:num)']										= "trabalhos/index/12";
// $route['trabalhos/women/pagina']											= "trabalhos/index/12";

// $route['trabalhos/men']														= "trabalhos/index/13";
// $route['trabalhos/men/pagina/(:num)']										= "trabalhos/index/13";
// $route['trabalhos/men/pagina']												= "trabalhos/index/13";

// $route['trabalhos/types']													= "trabalhos/index/14";
// $route['trabalhos/types/pagina/(:num)']										= "trabalhos/index/14";
// $route['trabalhos/types/pagina']											= "trabalhos/index/14";

// $route['trabalhos/seniors']													= "trabalhos/index/15";
// $route['trabalhos/seniors/pagina/(:num)']									= "trabalhos/index/15";
// $route['trabalhos/seniors/pagina']											= "trabalhos/index/15";

// $route['trabalhos/plus-size']												= "trabalhos/index/16";
// $route['trabalhos/plus-size/pagina/(:num)']									= "trabalhos/index/16";
// $route['trabalhos/plus-size/pagina']										= "trabalhos/index/16";

$route['selecoes/baby']														= "selecoes/index/9";
$route['selecoes/baby/pagina/(:num)']										= "selecoes/index/9";
$route['selecoes/baby/pagina']												= "selecoes/index/9";

$route['selecoes/kids']														= "selecoes/index/10";
$route['selecoes/kids/pagina/(:num)']										= "selecoes/index/10";
$route['selecoes/kids/pagina']												= "selecoes/index/10";

$route['selecoes/teens']													= "selecoes/index/11";
$route['selecoes/teens/pagina/(:num)']										= "selecoes/index/11";
$route['selecoes/teens/pagina']												= "selecoes/index/11";

$route['selecoes/women']													= "selecoes/index/12";
$route['selecoes/women/pagina/(:num)']										= "selecoes/index/12";
$route['selecoes/women/pagina']												= "selecoes/index/12";

$route['selecoes/men']														= "selecoes/index/13";
$route['selecoes/men/pagina/(:num)']										= "selecoes/index/13";
$route['selecoes/men/pagina']												= "selecoes/index/13";

$route['selecoes/types']													= "selecoes/index/14";
$route['selecoes/types/pagina/(:num)']										= "selecoes/index/14";
$route['selecoes/types/pagina']												= "selecoes/index/14";

$route['selecoes/seniors']													= "selecoes/index/15";
$route['selecoes/seniors/pagina/(:num)']									= "selecoes/index/15";
$route['selecoes/seniors/pagina']											= "selecoes/index/15";

$route['selecoes/plus-size']												= "selecoes/index/16";
$route['selecoes/plus-size/pagina/(:num)']									= "selecoes/index/16";
$route['selecoes/plus-size/pagina']											= "selecoes/index/16";

$route['resultado/(:num)']													= "resultado/index/$1";
$route['resultado/codigo/(:num)']											= "resultado/codigo/$1";

$route['trabalhos/(:num)/(:any)']											= "trabalhos/detalhes/$1/$2";
$route['selecoes/(:num)/(:any)']											= "selecoes/detalhes/$1/$2";

$route['modelos/baby']														= 'modelos/index/1';
$route['modelos/baby/(:num)']												= 'modelos/resultado/$1';
$route['modelos/kids']														= 'modelos/index/2';
$route['modelos/kids/(:num)']												= 'modelos/resultado/$1';
$route['modelos/teens']														= 'modelos/index/3';
$route['modelos/teens/(:num)']												= 'modelos/resultado/$1';
$route['modelos/women']														= 'modelos/index/4';
$route['modelos/women/(:num)']												= 'modelos/resultado/$1';
$route['modelos/men']														= 'modelos/index/5';
$route['modelos/men/(:num)']												= 'modelos/resultado/$1';
$route['modelos/types']														= 'modelos/index/6';
$route['modelos/types/(:num)']												= 'modelos/resultado/$1';
$route['modelos/seniors']													= 'modelos/index/7';
$route['modelos/seniors/(:num)']											= 'modelos/resultado/$1';
$route['modelos/plus-size']													= 'modelos/index/8';
$route['modelos/plus-size/(:num)']											= 'modelos/resultado/$1';
$route['modelos/(:num)/(:any)']												= 'modelos/detalhes/$1/$2';



$route['agencia/(:num)/(:any)']												= 'agencia/detalhes/$1/$2';
$route['parceiros/(:num)/(:any)']											= 'parceiros/detalhes/$1/$2';
$route['news/(:num)/(:any)']												= 'news/detalhes/$1/$2';

$route['pagamento/premium']												    = 'pagamento/index/premium';
$route['pagamento/diamante']											    = 'pagamento/index/diamante';

$route['pagamento-efetuado']											    = 'pagamento_efetuado/index';



// ADMIN
$route['(:any)/pagina']														= "$1/index";
$route['(:any)/pagina/(:num)']												= "$1/index";

/* End of file routes.php */
/* Location: ./application/config/routes.php */