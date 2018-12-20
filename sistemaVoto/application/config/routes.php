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

//$route['default_controller'] = "welcome";
$route['404_override'] = 'errors/page_missing';
$route['translate_uri_dashes'] = FALSE;

$route['default_controller'] = 'login';
$route['detalhes'] = 'reuniao/view';
$route['membro/reunioes'] = 'reunioesmembro';
$route['membro/reunioes/abrir/(:any)'] = 'reunioesmembro/abrir_reuniao/$1';
$route['encaminhamento'] = 'pautas/gravarOpcaoVotos';
$route['votacao/esperamod'] = 'pautas/esperaVotacaoModerador';
$route['membro/reunioes/submeter_voto'] = 'reunioesmembro/submeter_voto';
$route['inicio'] = 'login/redirecionar_inicio';
$route['login'] = 'login/logar';
$route['logout'] = 'login/logout';
$route['reunioes'] = 'reuniao/mostrarReunioes';
$route['servidor'] = 'Servidor';
$route['votacao_iniciada'] = 'reunioesmembro/inicia_votacao';
$route['mandar_voto'] = 'pautas/votar';
$route['votacao/resultados'] = 'pautas/mostrarResultado';
$route['votacao/resultado_votacao'] = 'pautas/exibir_resultado';

//$route['default_controller'] = 'pages/view';
//$route['news/(:any)'] = 'news/view/$1';
//$route['news'] = 'news';
//$route['(:any)'] = 'pages/view/$1';



/* End of file routes.php */
/* Location: ./application/config/routes.php */