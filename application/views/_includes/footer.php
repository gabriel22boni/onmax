<footer>
  <div class="container-fluid">
    <div class="row justify-items-center">
        <div class="col-md-12 justify-items-center titulo-area" style="text-align: center; padding: 40px 0px 10px 0px;">
          <h4><strong>Faça parte do casting das agências</strong></h4>
            <a href="http://www.maxfama.com.br" target="_blank"><img alt="Max Fama" src="<?php echo base_url(); ?>_img/logo_maxfama.png" width="180"></a>
            <a href="http://www.tessmodels.com.br" target="_blank"><img alt="Tess Models" src="<?php echo base_url(); ?>_img/logo_tess.png" width="180"></a>
            <a href="http://www.agenciakids.com" target="_blank"><img alt="Agência Kids" src="<?php echo base_url(); ?>_img/logo_kids.png" width="180"></a>
            <a href="http://www.myagency.com.br" target="_blank"><img alt="My Agency" src="<?php echo base_url(); ?>_img/logo_myagency.png" width="180"></a>
            <a href="http://www.ymodel.com.br" target="_blank"><img alt="Y Model" src="<?php echo base_url(); ?>_img/logo_ymodel.png" width="180"></a>
            <a href="http://www.sntv.com.br" target="_blank"><img alt="SNTV" src="<?php echo base_url(); ?>_img/logo_sntv.png" width="180"></a>
            <a href="http://www.centraldocasting.com.br" target="_blank"><img alt="Central do Casting" src="<?php echo base_url(); ?>_img/logo_central.png" width="180"></a>
            <a href="http://www.onmax.com.br"><img alt="On Max" src="<?php echo base_url(); ?>_img/logo_onmax.png" width="180"></a>
        </div>
    </div>
  </div>
  
  <div id="bg-menu-rodape">
    <div class="container">
      <nav id="menu_footer">
          <ul>
              <li><a href="<?php echo base_url(); ?>" title="Início" class="sem-imagem">INÍCIO</a></li>
              <li><a href="<?php echo base_url(); ?>onmaxfama" title="FAÇA PARTE" class="sem-imagem"><strong>FAÇA PARTE</strong></a></li>
              <li><a href="<?php echo base_url(); ?>clientes" title="CLIENTES" class="sem-imagem">CLIENTES</a></li>
              <li><a href="<?php echo base_url(); ?>faq" title="FAQ" class="sem-imagem">DÚVIDAS</a></li>
              <li><a href="<?php echo base_url(); ?>contato" title="Contato">CONTATO</a></li>
          </ul>
       </nav>
      </div>
    </div>
  <div id="bg-endereco-rodape">
    <div class="container">
      <div class="col-xs-6 col-sm-4 col-md-3">
        <div class="box-left">
           <span class="navbar-text" style="padding-top:17px; height: 100px; font-size:48px;">
              <a href="https://www.facebook.com/maxfama" target="_blank" style="padding: 0.3vw;"><ion-icon name="logo-facebook" class="text-white" size="large"></ion-icon></a>
              <a href="https://www.instagram.com/maxfama_oficial" target="_blank" style="padding: 0.3vw;"><ion-icon name="logo-instagram" class="text-white" size="large"></ion-icon></a>          
              <a href="https://www.youtube.com/user/maxfama" target="_blank" style="padding: 0.3vw;"><ion-icon name="logo-youtube" class="text-white" size="large"></ion-icon></a>
              
            </span>
        </div>
        
      </div>
      <div class="col-xs-6 col-sm-4 col-md-4 box-contato-rodape">          
        <p><span>SAC</span> <br/><a href="mailto:sac@onmax.com.br" title="sac@maxfama.com.br" class="link">sac@onmax.com.br</a></p>
        <!--<p><span>SELEÇÃO</span> <br/><a href="mailto:selecao@maxfama.com.br" title="selecao@maxfama.com.br" class="link">selecao@maxfama.com.br</a></p>
        <p><span>CONTATO</span> <br/><a href="mailto:maxfama@maxfama.com" title="maxfama@maxfama.com.br" class="link">maxfama@maxfama.com.br</a></p>
		<p><span>MARKETING</span> <br/><a href="mailto:marketing@ybrasil.com.br" title="marketing@ybrasil.com.br" class="link">marketing@ybrasil.com.br</a></p>
        <p><span>Solicitação de Modelos para seu trabalho</span> <br/><a href="mailto:maxfama@maxfama.com.br" title=" maxfama@maxfama.com.br" class="link">maxfama@maxfama.com.br</a><br/><a href="mailto:comercial2@ymodel.com.br" title="comercial2@ymodel.com.br" class="link">comercial2@ymodel.com.br</a></p> -->        
      </div>
      <div class="col-xs-12 col-sm-4 col-md-5 logo-rodape"><img src="<?php echo base_url().'_img/logo-max-fama-rodape.gif?';?>" alt="Logo MaxFama" class="img-responsive"/></div>
    </div>
  </div>
  <div id="box-copyright">
    <div class="container">
       <div id="copyright">© <script type="text/javascript">var theDate=new Date(); document.write(theDate.getFullYear()); </script> <strong style="font-size: 14px;">maxfama</strong> MODELING AGENCY Todos os direitos reservados</div>
    </div>
  </div>


</footer>

<?php if($this->uri->segment(1) != 'pagamento'){ ?>
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url();?>_js/bootstrap.min.js"></script>
  
<?php } else{ ?>
    <script type="text/javascript" src="//code.jquery.com/jquery-1.12.4.min.js" charset="utf-8"></script>
    <script type="text/javascript" src="<?php echo base_url();?>_js/bootstrap.min.js"></script>
    <script type="text/javascript" src="<?php echo SCRIPTPAGSEGURO; ?>"></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>_js/pagseguro.js"></script>

<?php } ?>

<script src="https://unpkg.com/ionicons@5.2.3/dist/ionicons.js"></script>
    
<script type="text/javascript" src="<?php echo base_url(); ?>_js/jquery/jquery.nivo.slider.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>_js/jquery/jquery-validate.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>_js/jquery/jquery.fancybox.js?v=2.1.4"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>_js/jquery/jquery.fancybox-media.js?v=1.0.5"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>_js/oauthpopup.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>_js/jquery.slicknav.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>_js/jquery.cbpFWSlider.min.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>_js/jquery.lazyload.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>_js/funcoes.js?cache=<?=time()?>"></script>
<script type="text/javascript"> var fullpath = '<?php echo base_url(); ?>'; </script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery.maskedinput/1.4.1/jquery.maskedinput.min.js"></script>