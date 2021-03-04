<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Calendarios{ 

  var $mes = array(
                   '01' => 'JANEIRO',
                   '02' => 'FEVEREIRO',
                   '03' => 'MAR&Ccedil;O',
                   '04' => 'ABRIL',
                   '05' => 'MAIO',
                   '06' => 'JUNHO',
                   '07' => 'JULHO',
                   '08' => 'AGOSTO',
                   '09' => 'SETEMBRO',
                   '10' => 'OUTUBRO',
                   '11' => 'NOVEMBRO',
                   '12' => 'DEZEMBRO'
                  );

  function mes_anterior($dia,$mes,$ano){
    if($mes == 1){
       $man = 12;
       $aan = $ano - 1;
    } else {
       $man = $mes - 1;
       $aan = $ano;
    }

    $val = checkdate($man,$dia,$aan);
    if($val == 0){
      $dia = 1;
    } //calendario.php?data='.sprintf("%02.0f",$dia).'/'.sprintf("%02.0f",$man).'/'.$aan.'
    echo '<p onClick="anterior(this.id)" id="'.sprintf("%02.0f",$dia).'/'.sprintf("%02.0f",$man).'/'.$aan.'" style="cursor:pointer; font-size:10px; margin-right:3px;"><<</p>';
  }

  function mes_proximo($dia,$mes,$ano){
    if($mes == 12){
       $mpr = 1;
       $apr = $ano + 1;
    } else {
       $mpr = $mes + 1;
       $apr = $ano;
    }

    $val = checkdate($mpr,$dia,$apr);
    if($val == 0){
      $dia = 1;
    } //calendario.php?data='.sprintf("%02.0f",$dia).'/'.sprintf("%02.0f",$mpr).'/'.$apr.'
    echo '<p onClick="proximo(this.id)" id="'.sprintf("%02.0f",$dia).'/'.sprintf("%02.0f",$mpr).'/'.$apr.'" style="cursor:pointer; font-size:10px; margin-left:17px;">>></p>';
  }

  function ano_anterior($dia,$mes,$ano){
    $aan = $ano - 1;
    //echo '<a href="calendario.php?data='.sprintf("%02.0f",$dia).'/'.sprintf("%02.0f",$mes).'/'.$aan.'">«</a>';
  }

  function ano_proximo($dia,$mes,$ano){
    $apr = $ano + 1;
   // echo '<a href="calendario.php?data='.sprintf("%02.0f",$dia).'/'.sprintf("%02.0f",$mes).'/'.$apr.'">»</a>';
  }
   
  function cria($data,$datas_evento){
	  
	 $CI =& get_instance();
	  
    $arr = explode("/",$data);
    @$dia = $arr[0];
    @$mes = $arr[1];
    @$ano = $arr[2];

	
    if(($dia == '') OR ($mes = '') OR ($ano = '')){
      $data = date("d/m/Y");
      $arr = explode("/",$data);
      $dia = $arr[0];
      $mes = $arr[1];
      $ano = $arr[2];
    }

    $arr = explode("/",$data);
    $dia = $arr[0];
    $mes = $arr[1];
    $ano = $arr[2];

    $val = checkdate($mes,$dia,$ano); // Verifica se a data é válida
    if($val == 1){
      $ver = date('d/m/Y', mktime(0,0,0,$mes,$dia,$ano));
    } else {
      $ver = date('d/m/Y', mktime(0,0,0,date(m),date(d),date(Y)));
    }

    $arr = explode("/",$ver);
    $dia = $arr[0];
    $mes = $arr[1];
    $ano = $arr[2];

    $ult = date("d", mktime(0,0,0,$mes+1,0,$ano));
    $dse = date("w", mktime(0,0,0,$mes,1,$ano));

    $tot = $ult+$dse;
    if($tot != 0){
      $tot = $tot+7-($tot%7);
    }

    for($i=0;$i<$tot;$i++){
      $dat = $i-$dse+1;
      if(($i >= $dse) AND ($i < ($dse+$ult))){
        $aux[$i]  = '
          <td ';

	//faz o foreach para ver qual é a data que tem o evento cadastrado
	  $aux_end = 1;
	  foreach($datas_evento as $dt):
		  $data_calendario = explode('-',$dt['data_evento']);
		  
		  $newData = date("Y-m-d", mktime(0, 0, 0, $mes, $dat, $ano) );
		  if($newData >= $dt['data_evento'] && $newData <= $dt['data_final'] && $aux_end)
		  {
			  
			  $newData2 = explode("-",$newData);
			  
			  //caso tenha um evento na data o campo é prenchido com um background definido pelo usuario
			  $aux[$i] .= 'class="date_has_event" onclick="mostra_evento(\''.$newData2[2].'/'.$newData2[1].'/'.$newData2[0].'\');" style="background-color:'.$dt['cor_evento'].'; cursor:pointer;"';
			  $aux_end = 0;
		  }
	  endforeach;
	  
	  if($aux_end){
		  //caso a data não seja igual a cadastrada e mostrado a data normalmente
		  $aux[$i] .= 'class="calendario_dias date_has_event" ';
	  }
	  
	  /*//faz o foreach para ver qual é a data que tem o evento cadastrado
	foreach($datas_evento as $de):
	
		$datas_even = explode("-",$de['data_evento']);
	foreach($datas_evento as $dt):
		$data_calendario = explode('-',$dt['data_evento']);
		

      if(($dat == @$data_calendario[2]) AND ($mes == @$data_calendario[1]) AND ($ano == @$data_calendario[0]))
	  {
		  //caso tenha um evento na data o campo é prenchido com um background definido pelo usuario
          $aux[$i] .= 'class="date_has_event" onclick="mostra_evento(\''.$CI->helps->FormataDataPagina($dt['data_evento']).'\');" style="background-color:'.$dt['cor_evento'].'; cursor:pointer;"';
        } else {
		  //caso a data não seja igual a cadastrada e mostrado a data normalmente
          $aux[$i] .= 'class="calendario_dias date_has_event" ';
        }
	endforeach;
	
endforeach;*/


		  $aux[$i] .= '>'.$dat.'
          </td>';
		 
		 
       // $aux[$i] .= '><span style="cursor:pointer;"><a href="'.base_url().'">'.$dat.'</a></span>
         // </td>
       // ';
      } else {
        $aux[$i] = '
          <td>
          </td>
        ';
    }

    if(($i%7) == 0){
      $aux[$i] = '<tr align="center">'.$aux[$i];
    }

    if(($i%7) == 6){
      $aux[$i] .= '</tr>';
    }
  }

  echo '
  <table cellspacing="0" cellpadding="0" id="calendario_tabela" align="center">
    <tr>
      <td>
        <table cellspacing="2" cellpadding="2">
          <tr class="calendario_mes_ano">
            <td>
  ';
  $this->mes_anterior($dia,$mes,$ano);
  echo '
            </td>
            <td colspan="5">'.$this->mes[$mes].'/'.$ano.'</td>
            <td>
  ';
  $this->mes_proximo($dia,$mes,$ano);
  echo '
</td>
          </tr>

          <tr class="calendario_mes_ano">
            <td>
  ';
  $this->ano_anterior($dia,$mes,$ano);
  echo '
            </td>
            <td colspan="5"></td>
            <td>
  ';
  $this->ano_proximo($dia,$mes,$ano);
  echo '
            </td>
          </tr>

          <tr class="calendario_semana">
            <td width="30" height="25">D</td>
            <td width="30" height="25">S</td>
            <td width="30" height="25">T</td>
            <td width="30" height="25">Q</td>
            <td width="30" height="25">Q</td>
            <td width="30" height="25">S</td>
            <td width="30" height="25">S</td>
          </tr>
  ';
  echo implode(' ',$aux);
  if(count($aux) == 35){
    echo '
          <tr>
            <td colspan="7">&nbsp;</td>
          </tr>
    ';
  };
  
         /* <tr>
            <td class="calendario_mes_ano" colspan="7" align="center">[ <a href="calendario.php?data='.date(d).'/'.date(m).'/'.date(Y).'">Hoje</a> ]</td>
          </tr>*/
      echo '  </table>
      </td>
    </tr>
  </table>
  ';
   } 
} 

?>