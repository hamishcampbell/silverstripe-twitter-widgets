<?php
/**
 * Creates a Twitter Lists Widget
 * 
 * Utilizes the twitter javascript widget class to build a dynamic widget for inclusion
 * within a SilverStripe Widget area.
 *
 * @package widgets
 * @subpackage twitterwidgetpack
 * @author Hamish Campbell <hn.campbell@gmail.com>
 * @copyright copyright (c) 2010, Hamish Campbell 
 */
class TwitterListWidget extends TwitterProfileWidget {

	static $title = "Twitter Lists";

	static $cmsTitle = "Twitter Lists Widget";

	static $description = "Displays tweets from a list from Twitter.com";

	protected $type = 'list';	

	static $db = array(
		'ListTitle' => 'Varchar(255)',
		'ListSubject' => 'Varchar(255)',
		'ListName' => 'Varchar(255)',
	);

	static $defaults = array(
		'FeatureAvatars' => true,
	);

	function getCMSFields() {
		$fields = new FieldSet(
			new TextField('ListTitle', 'Title'),
			new TextField('ListSubject', 'Subject'),
			new TextField('ListName', 'List Name')
		);
		$fields->merge(parent::getCMSFields());
		return $fields;
	}

	function ListName() {
		return Convert::raw2js($this->ListName);
	}

	function WidgetSetupJSON() {
		$settings = $this->WidgetSetup();
		$settings['type'] = $this->type;
		$settings['title'] = $this->ListTitle;
		$settings['subject'] = $this->ListSubject;
		return Convert::raw2json($settings);
	}
	
}
?>