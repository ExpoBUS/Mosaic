<?php
//Check whether each option is set and save it in a variable
$width = isset($options['width'])
? html_escape($options['width'])
: '100%';

$size = isset($options['file-size'])
? html_escape($options['file-size'])
: 'fullsize';

$percentwidth = isset($options['percentwidth'])
? html_escape($options['percentwidth'])
: '25%';

$bgcolor = isset($options['bgcolor'])
? html_escape($options['bgcolor'])
: '#FFFFFF';

$borderColor = isset($options['borderColor'])
? html_escape($options['borderColor'])
: '#000000';

$alpha = isset($options['alpha'])
? html_escape($options['alpha'])
: '0';

function hex2rgb($hex) {
   $hex = str_replace("#", "", $hex);

   if(strlen($hex) == 3) {
      $r = hexdec(substr($hex,0,1).substr($hex,0,1));
      $g = hexdec(substr($hex,1,1).substr($hex,1,1));
      $b = hexdec(substr($hex,2,1).substr($hex,2,1));
   } else {
      $r = hexdec(substr($hex,0,2));
      $g = hexdec(substr($hex,2,2));
      $b = hexdec(substr($hex,4,2));
   }
   $rgb = array($r, $g, $b);
   return implode(",", $rgb); // returns the rgb values separated by commas
}
?>
<script>
if (typeof jQuery == 'undefined') {  
	  document.write('<script type="text/javascript" src="http://code.jquery.com/jquery-1.9.1.min.js"><\/script>');
	}
</script>
<script src="http://masonry.desandro.com/masonry.pkgd.min.js"></script>
<style>
.item-sizer { min-width: <?php echo $width; ?>px; margin-bottom: 5px; width: <?php echo $percentwidth; ?>%; }
.grid-item {
	border: 2px solid <?php echo($borderColor)?>;
	background-color: rgba(<?php echo hex2rgb($bgcolor).','.$alpha?>);
}
.highslide-html { background-color: rgba(<?php echo hex2rgb($bgcolor).','.$alpha?>); }
</style>
<script>
function expand(e, n) {
	$(e).find('.contenido>.download-file>img').css('max-height', 0.75*$(window).height()-10);
	var h=0.8*$(window).height();
	var calculado = $(e).find('.download-file').height()/$(e).find('.download-file').width()*0.25*$(window).width();
	calculado = (calculado>$(e).find('.exhibit-item-caption').height())? calculado:$(e).find('.exhibit-item-caption').height()*1.25;
	if(h>calculado)
		h=calculado+20;
	return hs.htmlExpand(e, { contentId: 'item'+n, wrapperClassName: 'highslide-white', outlineType: 'outer-glow', width: 0.5*$(window).width(), height: h, objectWidth: 0.5*$(window).width(), objectHeight: 0.8*$(window).height(), transitions: ['fade'] } );
}</script>
<script>hs.align = 'center';
hs.dimmingOpacity = 0.75;
hs.showCredits = false;
$('.contenido').css('height',$('.highslide-html').css('height'));
</script>
<div class="grid" id="grid">
<div class="gutter-sizer"></div>
    <?php $n=0;
    foreach ($attachments as $attachment): ?>
    <div class="item-sizer">
    <div class="grid-item" onclick="return (expand(this,<?php echo($n);?>));">
    <?php echo $this->exhibitAttachment($attachment, array('imageSize' => $size)); ?>
    
    <div class="highslide-html-content" id="item<?php echo($n);?>" >
    	<div style="height:20px; padding: 2px; text-align: right;">
			<a href="#" onclick="return hs.close(this)" class="control">x</a>
		</div>
		<div class="contenido">
    		<?php echo $this->exhibitAttachment($attachment, array('imageSize' => $size)); ?>
    	</div>
    </div>
    
    </div>
    </div>
    <?php $n++;
    endforeach; ?>
</div>
<script>
window.onload=function() {
	var elem = document.querySelector('.grid');
	msnry = new Masonry( elem, {
		itemSelector: '.item-sizer',
		  columnWidth: '.item-sizer',
		  percentPosition: true,
		  gutter: '.gutter-sizer'
		});
	msnry.layout();
	};
</script>