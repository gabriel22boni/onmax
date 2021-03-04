<?php
	if($this->show_header) {
		$this->load->view($this->show_header); //Metatags,CSS,JS..
	}
	
	if($this->show_top){
		$this->load->view($this->show_top); //Menu,Banner..
	}
			
	if($this->show_left){
		$this->load->view($this->show_left); //Coluna da Esquerda
	}
	
	if($this->show_main){		
		($this->router_class == 'home') ? $class_home = '-home' : $class_home = '';
		echo '<div id="total-container'.$class_home.'">';				
			$this->load->view($this->show_main); // Conteudo do site		
		echo '</div>';
	}
	
	if($this->show_right){
		$this->load->view($this->show_right); //Coluna da Direita
	}
	
	if($this->show_main2) {
		$this->load->view($this->show_main2);
	}

	/*if($this->show_trocalinks) {
		$this->load->view($this->show_trocalinks); // Faixa de troca de Links
	} */
	
	if($this->show_footer) {		
		$this->load->view($this->show_footer);
	}
	
	if($this->show_janela_modal) {
		//echo '<a rel="modal" href="#window_demo">[ Abrir Janela Modal ]</a>';
		$this->load->view($this->show_janela_modal);
		echo '<div id="mascara"></div>';
	}
echo '</body>
</html>';
?>