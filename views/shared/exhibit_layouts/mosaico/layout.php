<?php
//Comprobar si está establecida cada opción y guardarla en una variable
$ancho = isset($options['width'])
? html_escape($options['width'])
: '100%';

$size = isset($options['file-size'])
? html_escape($options['file-size'])
: 'fullsize';

$anchoporcent = isset($options['percentwidth'])
? html_escape($options['percentwidth'])
: '25%';
?>
<script>
if (typeof jQuery == 'undefined') {  
	  document.write('<script type="text/javascript" src="http://code.jquery.com/jquery-1.9.1.min.js"><\/script>');
	}
</script>
<script src="http://masonry.desandro.com/masonry.pkgd.min.js"></script>
<style>
.grid-item .download-file, .download-file img { width: 100%; height: 100%; }
.grid-item { min-width: <?php echo $width; ?>px; margin-bottom: 5px; width: <?php echo $percentwidth; ?>% }
.grid { padding-left: 4%; padding-right: 4%; }
.gutter-sizer { width: 4%; }

</style>
<div class="grid" id="grid">
<div class="gutter-sizer"></div>
    <?php foreach ($attachments as $attachment): ?>
    <div class="grid-item">
        <?php echo $this->exhibitAttachment($attachment, array('imageSize' => $size)); ?>
    </div>
    <?php endforeach; ?>
</div>
<script>
window.onload=function() {
	var elem = document.querySelector('.grid');
	var msnry = new Masonry( elem, {
		itemSelector: '.grid-item',
		  columnWidth: '.grid-item',
		  percentPosition: true,
		  gutter: '.gutter-sizer',
		  isAnimated: true
		});
	msnry.layout();
	};
</script>