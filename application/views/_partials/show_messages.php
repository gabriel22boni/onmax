<?php
// Exibe as mensagens de alerta para o usuario
$global_messages = (array)$this->session->userdata('alert_messages_front');
if($global_messages) {
	foreach($global_messages as $k => $v) {
		if($v) {
			echo '<div class="alert alert-danger">'.$v.'</div>';
			$this->session->unset_userdata('alert_messages_front');
		}
	}
}

// Exibe as mensagens de alerta para o usuario
$global_messages_success = (array)$this->session->userdata('success_messages_front');
if($global_messages_success) {
	foreach($global_messages_success as $k => $v) {
		if($v) {
			echo '<div class="alert alert-success">'.$v.'</div>';
			$this->session->unset_userdata('success_messages_front');
		}
	}
}