<?php
/*
* Exibe a galeria de imagens e chama a função JS para fazer a animação da mesma.
* $this->load->view('_partials/gallery_partials_view', array('row' => $row));
*/
?>
<!--Galeria de imagens-->
<?php if($row->images_gallery){ ?>
    <div class="clearall"></div>
    <div id="galleria">
      <?php foreach($row->images_gallery as $gallery) : ?>
        <img data-description="<?php echo $row->titulo; ?>" src="<?php echo base_url().'_img/_'.$this->router_class.'/_gallery/'.$gallery->imagem.'';?>" />
      <?php endforeach; ?>
    </div>
    <script>
      // Load the classic theme
      Galleria.loadTheme('<?php echo base_url(); ?>src/themes/classic/galleria.classic.js');
      // Initialize Galleria
      $('#galleria').galleria();
    </script>
<?php } ?>
<!--Final Galeria de imagens-->