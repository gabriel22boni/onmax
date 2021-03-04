<?php  if(isset($titulo)) { $this->load->view('admin/_includes/header',$titulo); } else { $this->load->view('admin/_includes/header');} ?>

<?php $this->load->view($main_content); ?>

<?php $this->load->view('admin/_includes/footer'); ?>