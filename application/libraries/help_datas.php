<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Help_datas {
	
	public function FormataData($data) {		
		$data = explode('/',$data);
		$data_formatada = $data[2].'-'.$data[1].'-'.$data[0];
		return $data_formatada;
	}
	
	public function FormataData2($data) {		
		$data = explode('/',$data);
		$data_formatada = $data[1].'/'.$data[0].'/'.$data[2];
		return $data_formatada;
	}
	
	public function FormataDataPagina($data) {
		$data = str_replace(' ','-',$data);
		$data = explode('-',$data);
		$data_formatada = $data[2].'/'.$data[1].'/'.$data[0].' '.@$data[3];
		return trim($data_formatada);
	}
	
	public function FormataDataBirthday($data) {
		$data = str_replace(' ','-',$data);
		$data = explode('-',$data);
		$data_formatada = $data[2].'/'.$data[1];
		return trim($data_formatada);
	}
	
	public function semana_atual() {		
		$CI =& get_instance();
		$db_query = $CI->db->query('select DATE_FORMAT(NOW(),"%w") as now');
		$db_result = $db_query->result();
		$semana_atual = $db_result[0]->now;
		return $semana_atual;
	}
	
	public function SomarData($data, $dias, $meses, $ano){
		//A data deve estar no formato dd/mm/yyyy
		$data = explode("/", $data);
		$newData = date("d/m/Y", mktime(0, 0, 0, $data[1] + $meses, $data[0] + $dias, $data[2] + $ano) );
		return $newData;
	}
	
	public function SomarMinutos($data, $minutos){
		//A data deve estar no formato dd/mm/yyyy hh:mm:ss
		$data = str_replace(' ','-',$data);
		$data = str_replace(':','-',$data);
		$data = explode('-',$data);
		$newData = date("d/m/Y H:i:s", mktime($data[3], $data[4]+$minutos, $data[5], $data[0], $data[1], $data[2]) );
		return $newData;
	}
	
	public function mostra_feriados($ano = NULL, $formata_data = NULL) {
		if($ano == NULL) {
			$ano=date("Y");
		}
		foreach($this->feriados_nacionais($ano, $formata_data) as $key => $value) {
			echo $value.' - '.utf8_decode($key).'<br>';						 
		}
	}
	
	public function feriados_nacionais($ano = NULL, $formata_data = FALSE /*"d/m/Y"*/) {
	  if ($ano === null) {
		$ano = intval(date('Y'));
	  }
	  // Limite de 1970 ou após 2037 da easter_date PHP consulta http://www.php.net/manual/pt_BR/function.easter-date.php
	  // A função easter_date() retorna o dia da páscoa em um ano especifico.
	  $pascoa     = easter_date($ano);
	  $dia_pascoa = date('j', $pascoa);
	  $mes_pascoa = date('n', $pascoa);
	  $ano_pascoa = date('Y', $pascoa);
	
	  $feriados = array(
		// Datas Fixas dos feriados Nacionaiis Basileiros
		'Confraternização Universal' => mktime(0, 0, 0, 1,  1,   $ano), // Confraternização Universal - Lei nº 662, de 06/04/49
		'Tiradentes' => mktime(0, 0, 0, 4,  21,  $ano), // Tiradentes - Lei nº 662, de 06/04/49
		'Dia do Trabalhador' => mktime(0, 0, 0, 5,  1,   $ano), // Dia do Trabalhador - Lei nº 662, de 06/04/49
		'Dia da Independência' => mktime(0, 0, 0, 9,  7,   $ano), // Dia da Independência - Lei nº 662, de 06/04/49
		'N. S. Aparecida' => mktime(0, 0, 0, 10,  12, $ano), // N. S. Aparecida - Lei nº 6802, de 30/06/80
		'Todos os santos' => mktime(0, 0, 0, 11,  2,  $ano), // Todos os santos - Lei nº 662, de 06/04/49
		'Proclamação da república' => mktime(0, 0, 0, 11, 15,  $ano), // Proclamação da republica - Lei nº 662, de 06/04/49
		'Natal' => mktime(0, 0, 0, 12, 25,  $ano), // Natal - Lei nº 662, de 06/04/49
		
		// A data destes feriados dependem do dia que cai a páscoa
		//'2ºferia Carnaval' => mktime(0, 0, 0, $mes_pascoa, $dia_pascoa - 48,  $ano_pascoa),//2ºferia Carnaval
		'3ºferia Carnaval	' => mktime(0, 0, 0, $mes_pascoa, $dia_pascoa - 47,  $ano_pascoa),//3ºfeira Carnaval	
		'6ºfeira Santa' => mktime(0, 0, 0, $mes_pascoa, $dia_pascoa - 2 ,  $ano_pascoa),//6ºfeira Santa  
		'Páscoa' => mktime(0, 0, 0, $mes_pascoa, $dia_pascoa     ,  $ano_pascoa),//Pascoa
		'Corpus Christi' => mktime(0, 0, 0, $mes_pascoa, $dia_pascoa + 60,  $ano_pascoa),//Corpus Cirist
	  );
	  
	  asort($feriados);
	  if($formata_data) {
		  foreach($feriados as $key => $value) {
			  $feriados[$key] = date($formata_data,$value);					 
		  }
	  }
	  
	  return $feriados;
	}
	
	public function mostra_datas_comemorativas($ano = NULL, $formata_data = NULL) {
		foreach($this->datas_comemorativas($ano, $formata_data) as $key => $value) {
			echo $value.' - '.utf8_decode($key).'<br>';						 
		}
	}
	
	public function datas_comemorativas($ano = NULL, $formata_data = "d/m/Y") {
	  if ($ano === null) {
		$ano = intval(date('Y'));
	  }
	
	  $feriados = array(
		// Datas Comemorativas Fixas
		'Dia do leitor' => mktime(0, 0, 0, 1,  6,   $ano),
		'Dia do astronauta' => mktime(0, 0, 0, 1,  9,   $ano),
		'Dia do treinador de futebol' => mktime(0, 0, 0, 1,  14,   $ano),
		'Dia mundial do compositor' => mktime(0, 0, 0, 1,  15,   $ano),
		'Dia do farmacêutico' => mktime(0, 0, 0, 1,  20,   $ano),
		'Dia do aposentado' => mktime(0, 0, 0, 1,  24,   $ano),
		'Dia do carteiro' => mktime(0, 0, 0, 1,  25,   $ano),
		'Dia do mercador' => mktime(0, 0, 0, 1,  25,   $ano),
		'Dia do orador' => mktime(0, 0, 0, 1,  25,   $ano),
		'Dia mundial do mágico' => mktime(0, 0, 0, 1,  31,   $ano),
		'Dia do publicitário' => mktime(0, 0, 0, 2,  1,   $ano),
		'Dia do agente fiscal' => mktime(0, 0, 0, 2,  2,   $ano),
		'Dia da papiloscopia' => mktime(0, 0, 0, 2,  5,   $ano),
		'Dia do zelador' => mktime(0, 0, 0, 2,  11,   $ano),
		'Dia do empregado em edifícios em São Paulo' => mktime(0, 0, 0, 2,  12,   $ano),
		'Dia do repórter' => mktime(0, 0, 0, 2,  16,   $ano),
		'Dia nacional do rotariano' => mktime(0, 0, 0, 2,  23,   $ano),
		'Dia do comediante' => mktime(0, 0, 0, 2,  26,   $ano),
		'Dia internacional da mulher' => mktime(0, 0, 0, 3,  8,   $ano),
		'Dia do sogro' => mktime(0, 0, 0, 3,  10,   $ano),
		'Dia do DeMolay' => mktime(0, 0, 0, 3,  18,   $ano),
		'Dia do ator' => mktime(0, 0, 0, 3,  27,   $ano),
		'Dia do diagramador' => mktime(0, 0, 0, 3,  28,   $ano),
		'Dia do revisor' => mktime(0, 0, 0, 3,  8,   $ano),
		'Dia do corretor' => mktime(0, 0, 0, 4,  7,   $ano),
		'Dia do médico legista' => mktime(0, 0, 0, 4,  7,   $ano),
		'Dia nacional do jornalista' => mktime(0, 0, 0, 4,  7,   $ano),
		'Dia do jovem' => mktime(0, 0, 0, 4,  13,   $ano),
		'Dia do beijo' => mktime(0, 0, 0, 4,  13,   $ano),
		'Dia do office boy' => mktime(0, 0, 0, 4,  13,   $ano),
		'Dia do índio' => mktime(0, 0, 0, 4,  19,   $ano),
		'Dia do exército brasileiro' => mktime(0, 0, 0, 4,  19,   $ano),
		'Dia do diplomata' => mktime(0, 0, 0, 4,  20,   $ano),
		'Dia do metalúrgico' => mktime(0, 0, 0, 4,  21,   $ano),
		'Dia do contador' => mktime(0, 0, 0, 4,  25,   $ano),
		'Dia do goleiro' => mktime(0, 0, 0, 4,  26,   $ano),
		'Dia da empregada doméstica' => mktime(0, 0, 0, 4,  27,   $ano),
		'Dia da sogra' => mktime(0, 0, 0, 4,  28,   $ano),
		'Dia do pintor' => mktime(0, 0, 0, 5,  5,   $ano),
		'Dia internacional da criança' => mktime(0, 0, 0, 6,  1,   $ano),
		'Dia do bombeiro brasileiro' => mktime(0, 0, 0, 7, 2,   $ano),
		'Dia do cerealista' => mktime(0, 0, 0, 8,  1,   $ano),
		'Dia do caixeiro viajante' => mktime(0, 0, 0, 9,  1,   $ano),
		'Dia do idoso' => mktime(0, 0, 0, 10,  1,   $ano),
		'Dia de todos os santos' => mktime(0, 0, 0, 11,  1,   $ano),
		'Dia nacional do hoteleiro' => mktime(0, 0, 0, 11,  9,   $ano),
		'Dia da esquadra' => mktime(0, 0, 0, 11,  10,   $ano),
		'Dia do diretor de escola' => mktime(0, 0, 0, 11,  12,   $ano),
		'Dia da criatividade' => mktime(0, 0, 0, 11,  17,   $ano),
		'Dia do biomédico' => mktime(0, 0, 0, 11,  20,   $ano),
		'Dia do numismata' => mktime(0, 0, 0, 12,  1,   $ano),
		'Dia nacional de astronomia' => mktime(0, 0, 0, 12, 2,   $ano),
		'Dia advogado criminalista' => mktime(0, 0, 0, 12, 2,   $ano),
		//'Diadoleitor' => mktime(0, 0, 0, mes,  dia,   $ano),
	  );
	  
	  asort($feriados);
	  if($formata_data) {
		  foreach($feriados as $key => $value) {
			  $feriados[$key] = date($formata_data,$value);					 
		  }
	  }
	  
	  return $feriados;
	}
}