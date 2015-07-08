<?php
class MosaicPlugin extends Omeka_Plugin_AbstractPlugin {
	protected $_hooks = array ();
	protected $_filters = array ('exhibit_layouts');
	public function filterExhibitLayouts($layouts) {
		$layouts ['mosaic'] = array (
				'name' => __ ( 'Mosaic' ),
				'description' => __ ( 'Show elements tiled as a mosaic.' ) 
		);
		return $layouts;
	}
}
?>