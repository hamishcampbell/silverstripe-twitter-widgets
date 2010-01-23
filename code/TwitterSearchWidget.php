<?php
/**
 * Creates a Twitter Search Widget
 * 
 * Utilizes the twitter javascript widget class to build a dynamic widget for inclusion
 * within a SilverStripe Widget area.
 *
 * @package widgets
 * @subpackage twitterwidgetpack
 * @author Hamish Campbell <hn.campbell@gmail.com>
 * @copyright copyright (c) 2010, Hamish Campbell 
 */
class TwitterSearchWidget extends TwitterProfileWidget {

	static $title = "Twitter Search";

	static $cmsTitle = "Twitter Search Widget";

	static $description = "Displays tweets from Twitter.com";

	protected $type = 'search';	

	static $db = array(
		'SearchPhrase' => 'Varchar(255)',
		'SearchTitle' => 'Varchar(255)',
		'SearchSubject' => 'Varchar(255)',
	);

	static $defaults = array(
		'FeatureAvatars' => true,
	);

	function getCMSFields() {
		$fields = new FieldSet(
			new TextField('SearchPhrase', 'Search For'),
			new TextField('SearchTitle', 'Title'),
			new TextField('SearchSubject', 'Subject')
		);
		$fields->merge(parent::getCMSFields());
		$fields->removeByName('TwitterUser');
		return $fields;
	}

	function WidgetSetupJSON() {
		$settings = $this->WidgetSetup();
		$settings['type'] = $this->type;
		$settings['title'] = $this->SearchTitle;
		$settings['search'] = $this->SearchPhrase;
		$settings['subject'] = $this->SearchSubject;
		return Convert::raw2json($settings);
	}
	
}
?>