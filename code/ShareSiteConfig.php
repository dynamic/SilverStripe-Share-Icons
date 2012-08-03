<?php

class ShareSiteConfig extends DataExtension {
	
	static $db = array(
		'FacebookApp' => 'Varchar(200)'
	);
	
	public function updateCMSFields(FieldList $fields) {
		$fields->addFieldToTab('Root.Facebook', new TextField('FacebookApp', 'Facebook AppID'));
	}
	
}