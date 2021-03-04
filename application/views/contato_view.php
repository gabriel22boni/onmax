<div style="background-color:#DDD">
  <div class="container">

    <div class="col-md-6 col-md-offset-3" style="align-content: center; margin-top: 60px;">
      <h1 style="font-weight: 300;">Contato</h1>
      <p id="chamada-cadastro">Se voc&ecirc; quer fazer parte do nosso casting e ser um de nossos modelos, <a href="<?php echo base_url().'onmaxfama';?>" class="inscreva_se_login" ><strong>clique aqui</strong></a><br/><br/></p>
      <?php $this->load->view('_partials/show_messages'); ?>

      <script src="https://www.google.com/recaptcha/api.js"></script>
      
      <form id="form_inscrevase" name="form_inscrevase" method="post" action="<?php echo base_url(); ?>contato/enviar">
        <input type="hidden" name="fb_id" id="fb_id" value="" />
        <input type="text" name="nome" id="nome" placeholder="Nome (*):" class="form-control">            
        <input type="text" name="email" id="email" placeholder="E-mail (*):" class="form-control">  
        <input type="text" name="telefone" id="telefone" placeholder="Telefone:" class="form-control">
        <input type="text" name="assunto" id="assunto" placeholder="Assunto:" class="form-control">      
        <textarea name="mensagem" id="mensagem" cols="45" rows="5" placeholder="Mensagem:" class="form-control"></textarea>

        <div class="g-recaptcha" data-sitekey="6Le92s0ZAAAAAJDyLEtbVlIzKvCyWvC9YT65Xgnu"></div>

        <button class="btn" id="enviar-contato" style="padding: 1px 60px 3px 60px; border-radius: 50px; margin-top: 20px; background-color: #b974a1; color: #fff;">ENVIAR</button>
      </form>
    </div>
  </div>
      
</div>