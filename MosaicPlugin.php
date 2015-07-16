<?php
class MosaicPlugin extends Omeka_Plugin_AbstractPlugin {
	protected $_hooks = array ('exhibit_builder_page_head');
	protected $_filters = array ('exhibit_layouts');
	public function filterExhibitLayouts($layouts) {
		$layouts ['mosaic'] = array (
				'name' => __ ( 'Mosaic' ),
				'description' => __ ( 'Show elements tiled as a mosaic.' ) 
		);
		return $layouts;
	}
	public function hookExhibitBuilderPageHead($args) {
		if (array_key_exists('mosaic', $args['layouts'])) {
			queue_js_url(url('/highslide/highslide-full.js'));
			queue_css_url(url('/highslide/highslide.css'));
		}
	}
}
?>