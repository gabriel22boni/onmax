<?php
/*
* Exibe a galeria de imagens e chama a função JS para fazer a animação da mesma.
* $this->load->view('_partials/gallery_partials_view', array('row' => $row));
*/
?>

<!--Galeria de imagens-->
<?php if($row->images_gallery){ ?>
    <div class="ppy" id="ppy2">
        <ul class="ppy-imglist">
        <?php foreach($row->images_gallery as $gallery) : ?>
          <li><a><img src="<?php echo base_url().'_img/_'.$this->router_class.'/_gallery/'.$gallery->imagem.'';?>" alt="<?php echo $row->titulo; ?>" /></a></li>
        <?php endforeach; ?>
        </ul>
        <div class="ppy-outer">
            <div class="ppy-stage">
                <!--<div class="ppy-counter">
                    <strong class="ppy-current"></strong> / <strong class="ppy-total"></strong> 
                </div>-->
            </div>
            <div class="ppy-nav">
                <div class="nav-wrap">
                    <a class="ppy-prev" title="Imagem anterior">Anterior</a>
                    <a class="ppy-next" title="Pr&oacute;xima imagem">Próximo</a>
                </div>
            </div>
        </div>
    </div>
    <!-- [example js] begin -->
    <script type="text/javascript">
        <!--//<![CDATA[
        
        $(document).ready(function () {
            $('#ppy2').popeye({
                caption:    false,
                navigation: 'permanent',
                direction:  'left'
            });
        });
        
        //]]>-->
    </script>
<?php } ?>