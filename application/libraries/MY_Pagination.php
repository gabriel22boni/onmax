<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class MY_Pagination extends CI_Pagination {
	
	public $num_links			=  5; // Number of "digit" links to show before/after the currently viewed page
	public $first_link			= '&lsaquo; Primeira';
	public $next_link			= '&gt;';
	public $prev_link			= '&lt;';
	public $last_link			= '&Uacute;lima &rsaquo;';
	public $full_tag_open		= '<div class="paginacao">';
	public $full_tag_close		= '</div>';
	
	public function create_auto($config = NULL) { // array('type' => 'web', 'uri_segment' => 3, 'busca' => 'palavra_buscada', 'class' => 'banners', 'model' => 'banners_model', 'model_function' => 'Some', 'maximo' => NULL)
		// Define os valores padrões para esta função
		$config_default['type']				= 'web'; // 'web' ou 'admin'
		$config_default['uri_segment']		= NULL; // O numero da página devera ficar após o uri_segment 'pagina/' ou então informe o uri_segment correto
		$config_default['busca']			= NULL; // Passa os valores da busca para o model
		$config_default['class']			= NULL; // Passa os valores da busca para o model
		$config_default['model']			= NULL; // Carrega automaticamente o model a partir do router->class
		$config_default['model_function']	= 'Some'; // getSome e countSome
		$config_default['maximo']			= NULL; // Numero maximo por pagina
		
		if($config) {
			if(is_string($config)) {
				$config['type'] = $config;
				$config_default = array_merge($config_default,array('type' => $config));
			}
			if(is_array($config)) {
				$config_default = array_merge($config_default,$config);
			}
		}
		// Simplifica o nome das variaveis para facilitar o seu uso.
		$type			= $config_default['type'];
		$uri_segment	= $config_default['uri_segment'];
		$busca			= $config_default['busca'];
		$class			= $config_default['class'];
		$model			= $config_default['model'];
		$model_function	= $config_default['model_function'];
		$maximo			= $config_default['maximo'];
		$countModel		= 'count'.$model_function;
		$getModel		= 'get'.$model_function;
		unset($config);
		
		
		$CI =& get_instance();
		if(!$class) {
			$class = $CI->router->class;
		}
		
		// Define o model a ser usado e instancia ele
		if($model !== FALSE) {
			// Define o model automaticamente caso nao tenha sido definido
			if($model == NULL) {
				$model = $class.'_model';
			}
			
			// Carrega o model
			if($type == 'admin') {
				$CI->load->model('admin/'.$model);
			} else {
				$CI->load->model($model);
			}
		}
		
		
		// Define o base_url da paginacao e pega o numero da pagina atual
		if($uri_segment) {
			// Monta o link da paginacao e descobre o numero da pagina atual
			$base_url = base_url();
			for($i=1; $i++; $i<=($uri_segment - 2)) {
				$base_url .= $CI->uri->segments[$i].'/';
			}
			$base_url .= 'pagina';
			$inicio = (!$CI->uri->segments[$uri_segment]) ? 0 : $CI->uri->segments[$uri_segment];
			$config['base_url'] = $base_url;
		} else {
			// Descobre em que local é exibido o numero da pagina. Depois monta o link da paginacao e descobre o numero da pagina atual
			$base_url = base_url();
			foreach($CI->router->uri->segments as $key=>$value) {
				if($value == 'busca' && $busca == NULL) {
					$busca = @$CI->router->uri->segments[$key + 1];
				}
				if($value == 'pagina') {
					$uri_segment = $key;
					$inicio = @$CI->router->uri->segments[$key + 1];
					break;
				}
				$base_url .= $value.'/';
			}
			$base_url .= 'pagina';
			$inicio = (!isset($inicio)) ? 0 : $inicio;
			$config['base_url'] = $base_url;
		}
		
		if(!$maximo) {
			if($type == 'web') {
				$maximo = PER_PAGE_WEB;
			} elseif($type == 'admin') {
				$CI->session_paginacao = $CI->session->userdata('paginacao');
				$PER_PAGE_ADMIN = @$CI->session_paginacao['PER_PAGE_ADMIN'];
				if($PER_PAGE_ADMIN) {
					$maximo = $PER_PAGE_ADMIN;
				} else {
					$maximo = PER_PAGE_ADMIN;
				}
			}
		}
		$config['cur_page'] = $inicio;
		$config['per_page'] = $maximo;
		$config['uri_segment'] = $uri_segment;
		$config['total_rows'] = ($CI->$model->$countModel($busca));
		$this->initialize($config);
		
		if($type == 'web') {
			$CI->paginacao =  $this->create_web_links();
		} elseif($type == 'admin') {
			$CI->paginacao =  $this->create_admin_links();
		}
		$CI->$class  = $CI->$model->$getModel($maximo,$inicio,$busca);
	}
	
	public function create_web_links() {
		//Personalizacao da paginacao
		$this->full_tag_open = '<div class="paginacao">';
		$this->full_tag_close = '</div>';
		$this->first_link = '';		
		$this->last_link = '';
		$this->next_link = 'Pr&oacute;ximo';
		$this->next_tag_open = '<span class="paginacao_proximo">';
		$this->next_tag_close = '</span>';
		$this->prev_link = 'Anterior';
		$this->prev_tag_open = '<span class="paginacao_anterior">';
		$this->prev_tag_close = '</span>';
		$this->cur_tag_open = '<span class="paginacao_atual">';
		$this->cur_tag_close = '</span>';
		$this->num_tag_open = '<span class="paginacao_numero">';
		$this->num_tag_close = '</span>';
		
		return $this->create_links();
	}
	
	public function create_admin_links() {
		//Personalizacao da paginacao
		$this->num_links = 15;
		$this->full_tag_open = '<div class="paginacao">';
		$this->full_tag_close = '</div>';
		$this->first_link = '';		
		$this->last_link = '';
		$this->next_link = 'Pr&oacute;ximo';
		$this->next_tag_open = '<span class="paginacao_proximo">';
		$this->next_tag_close = '</span>';
		$this->prev_link = 'Anterior';
		$this->prev_tag_open = '<span class="paginacao_anterior">';
		$this->prev_tag_close = '</span>';
		$this->cur_tag_open = '<span class="paginacao_atual">';
		$this->cur_tag_close = '</span>';
		$this->num_tag_open = '<span class="paginacao_numero">';
		$this->num_tag_close = '</span>';
		/*
		$this->num_links = 1;
		$this->full_tag_open		= '<!--  start paging..................................................... -->
										<table border="0" cellpadding="0" cellspacing="0" id="paging-table">
										<tr>
										<td>';
		$this->first_link			= '<div class="page-far-left"></div>';
		$this->prev_link			= '<div class="page-left"></div>';
		$this->cur_tag_open			= '<div id="page-info">Página <strong>';
		$this->cur_tag_close		= '</strong> / '.$this->total_rows.'</div>';
		$this->num_tag_open			= '<div style="display:none">';
		$this->num_tag_close		= '</div>';
		$this->next_link			= '<div class="page-right"></div>';
		$this->last_link			= '<div class="page-far-right"></div>';
		$this->full_tag_close		= '</td>
										<td>
										<select  class="maximo_per_page_admin">
											<option value="">Número de linhas</option>
											<option value="1">1</option>
											<option value="5">5</option>
											<option value="10">10</option>
											<option value="25">25</option>
											<option value="50">50</option>
											<option value="100">100</option>
										</select>
										</td>
										</tr>
										</table>
										<!--  end paging................ -->';
		*/
		return $this->create_links();
	}
	
	public function create_image_links() {
		$this->first_link = FALSE;
		$this->next_link = FALSE;
		$this->prev_link = FALSE;
		$this->last_link = FALSE;
		
		
		
		// If our item count or per-page total is zero there is no need to continue.
		if ($this->total_rows == 0 OR $this->per_page == 0)
		{
			return '';
		}

		// Calculate the total number of pages
		$num_pages = ceil($this->total_rows / $this->per_page);

		// Is there only one page? Hm... nothing more to do here then.
		if ($num_pages == 1)
		{
			return '';
		}

		// Set the base page index for starting page number
		if ($this->use_page_numbers)
		{
			$base_page = 1;
		}
		else
		{
			$base_page = 0;
		}

		// Determine the current page number.
		$CI =& get_instance();

		if ($CI->config->item('enable_query_strings') === TRUE OR $this->page_query_string === TRUE)
		{
			if ($CI->input->get($this->query_string_segment) != $base_page)
			{
				$this->cur_page = $CI->input->get($this->query_string_segment);

				// Prep the current page - no funny business!
				$this->cur_page = (int) $this->cur_page;
			}
		}
		else
		{
			if ($CI->uri->segment($this->uri_segment) != $base_page)
			{
				$this->cur_page = $CI->uri->segment($this->uri_segment);

				// Prep the current page - no funny business!
				$this->cur_page = (int) $this->cur_page;
			}
		}
		
		// Set current page to 1 if using page numbers instead of offset
		if ($this->use_page_numbers AND $this->cur_page == 0)
		{
			$this->cur_page = $base_page;
		}

		$this->num_links = (int)$this->num_links;

		if ($this->num_links < 1)
		{
			show_error('Your number of links must be a positive number.');
		}

		if ( ! is_numeric($this->cur_page))
		{
			$this->cur_page = $base_page;
		}

		// Is the page number beyond the result range?
		// If so we show the last page
		if ($this->use_page_numbers)
		{
			if ($this->cur_page > $num_pages)
			{
				$this->cur_page = $num_pages;
			}
		}
		else
		{
			if ($this->cur_page > $this->total_rows)
			{
				$this->cur_page = ($num_pages - 1) * $this->per_page;
			}
		}

		$uri_page_number = $this->cur_page;
		
		if ( ! $this->use_page_numbers)
		{
			$this->cur_page = floor(($this->cur_page/$this->per_page) + 1);
		}

		// Calculate the start and end numbers. These determine
		// which number to start and end the digit links with
		$start = (($this->cur_page - $this->num_links) > 0) ? $this->cur_page - ($this->num_links - 1) : 1;
		$end   = (($this->cur_page + $this->num_links) < $num_pages) ? $this->cur_page + $this->num_links : $num_pages;

		// Is pagination being used over GET or POST?  If get, add a per_page query
		// string. If post, add a trailing slash to the base URL if needed
		if ($CI->config->item('enable_query_strings') === TRUE OR $this->page_query_string === TRUE)
		{
			$this->base_url = rtrim($this->base_url).'&amp;'.$this->query_string_segment.'=';
		}
		else
		{
			$this->base_url = rtrim($this->base_url, '/') .'/';
		}

		// And here we go...
		$output = '';

		// Render the "First" link
		if  ($this->first_link !== FALSE AND $this->cur_page > ($this->num_links + 1))
		{
			$first_url = ($this->first_url == '') ? $this->base_url : $this->first_url;
			$output .= $this->first_tag_open.'<a '.$this->anchor_class.'href="'.$first_url.'">'.$this->first_link.'</a>'.$this->first_tag_close;
		}

		// Render the "previous" link
		if  ($this->prev_link !== FALSE AND $this->cur_page != 1)
		{
			if ($this->use_page_numbers)
			{
				$i = $uri_page_number - 1;
			}
			else
			{
				$i = $uri_page_number - $this->per_page;
			}

			if ($i == 0 && $this->first_url != '')
			{
				$output .= $this->prev_tag_open.'<a '.$this->anchor_class.'href="'.$this->first_url.'">'.$this->prev_link.'</a>'.$this->prev_tag_close;
			}
			else
			{
				$i = ($i == 0) ? '' : $this->prefix.$i.$this->suffix;
				$output .= $this->prev_tag_open.'<a '.$this->anchor_class.'href="'.$this->base_url.$i.'">'.$this->prev_link.'</a>'.$this->prev_tag_close;
			}

		}

		/*
		**  Esta parte da biblioteca foi editada para exibir imagens ao invés de números
		*/
		// Render the pages
		if ($this->display_pages !== FALSE)
		{
			// Write the digit links
			for ($loop = $start -1; $loop <= $end; $loop++)
			{
				if ($this->use_page_numbers)
				{
					$i = $loop;
				}
				else
				{
					$i = ($loop * $this->per_page) - $this->per_page;
				}

				if ($i >= $base_page)
				{
					if ($this->cur_page == $loop)
					{
						//$output .= $this->cur_tag_open.$loop.$this->cur_tag_close; // Current page
						$output .= '<img src="'.base_url().'_img/_pagination/pagina'.$loop.'_on.png" />'; // Current page
					}
					else
					{
						$n = ($i == $base_page) ? '' : $i;

						if ($n == '' && $this->first_url != '')
						{
							//$output .= $this->num_tag_open.'<a '.$this->anchor_class.'href="'.$this->first_url.'">'.$loop.'</a>'.$this->num_tag_close;
							$output .= '<a '.$this->anchor_class.'href="'.$this->first_url.'"><img src="'.base_url().'_img/_pagination/pagina'.$loop.'_off.png" /></a>';
						}
						else
						{
							$n = ($n == '') ? '' : $this->prefix.$n.$this->suffix;

							$output .= '<a '.$this->anchor_class.'href="'.$this->base_url.$n.'"><img src="'.base_url().'_img/_pagination/pagina'.$loop.'_off.png" /></a>';
						}
					}
				}
			}
		}

		// Render the "next" link
		if ($this->next_link !== FALSE AND $this->cur_page < $num_pages)
		{
			if ($this->use_page_numbers)
			{
				$i = $this->cur_page + 1;
			}
			else
			{
				$i = ($this->cur_page * $this->per_page);
			}

			$output .= $this->next_tag_open.'<a '.$this->anchor_class.'href="'.$this->base_url.$this->prefix.$i.$this->suffix.'">'.$this->next_link.'</a>'.$this->next_tag_close;
		}

		// Render the "Last" link
		if ($this->last_link !== FALSE AND ($this->cur_page + $this->num_links) < $num_pages)
		{
			if ($this->use_page_numbers)
			{
				$i = $num_pages;
			}
			else
			{
				$i = (($num_pages * $this->per_page) - $this->per_page);
			}
			$output .= $this->last_tag_open.'<a '.$this->anchor_class.'href="'.$this->base_url.$this->prefix.$i.$this->suffix.'">'.$this->last_link.'</a>'.$this->last_tag_close;
		}

		// Kill double slashes.  Note: Sometimes we can end up with a double slash
		// in the penultimate link so we'll kill all double slashes.
		$output = preg_replace("#([^:])//+#", "\\1/", $output);

		// Add the wrapper HTML if exists
		$output = $this->full_tag_open.$output.$this->full_tag_close;

		return $output;
	}
}