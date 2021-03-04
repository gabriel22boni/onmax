<?php
if(!@$quebra) { $quebra = '4'; }
if(is_object($ticket)) $ticket = array($ticket); ?>

<?php for ($i = 1; $i <= 10; $i++) { ?>
<div style="width:208px; height:326px; background-color:#f2f2f2;">AAAA</div>
<?php if($i%$quebra == '0') { echo '<div class="clearall"></div>'; } ?>
<?php } ?>
<div class="clearall"></div>