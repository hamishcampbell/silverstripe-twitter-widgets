<?php
/**
 * Creates a Twitter Favourite Tweets Widget
 * 
 * Utilizes the twitter javascript widget class to build a dynamic widget for inclusion
 * within a SilverStripe Widget area.
 *
 * @author Hamish Campbell <hn.campbell@gmail.com>
 * @copyright copyright (c) 2010, Hamish Campbell 
 */
class TwitterFavesWidget extends TwitterProfileWidget {

	static $title = "Twitter Faves";

	static $cmsTitle = "Twitter Faves Widget";

	static $description = "Displays your favourite tweets from Twitter.com";

	protected $type = 'faves';	

	static $db = array(
		'FavesTitle' => 'Varchar(255)',
		'FavesSubject' => 'Varchar(255)',
	);

	static $defaults = array(
		'FeatureAvatars' => true,
	);

	function getCMSFields() {
		$fields = new FieldSet(
			new TextField('FavesTitle', 'Title'),
			new TextField('FavesSubject', 'Subject')
		);
		$fields->merge(parent::getCMSFields());
		return $fields;
	}

	function WidgetSetupJSON() {
		$settings = $this->WidgetSetup();
		$settings['type'] = $this->type;
		$settings['title'] = $this->FavesTitle;
		$settings['subject'] = $this->FavesSubject;
		return Convert::raw2json($settings);
	}
	
}
?>