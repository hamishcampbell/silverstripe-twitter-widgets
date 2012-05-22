<?php
/**
 * Creates a Twitter Profile Widget
 * 
 * Utilizes the twitter javascript widget class to build a dynamic widget for inclusion
 * within a SilverStripe Widget area.
 *
 * @package widgets
 * @subpackage twitterwidgetpack
 * @author Hamish Campbell <hn.campbell@gmail.com>
 * @copyright copyright (c) 2010, Hamish Campbell 
 */
class TwitterProfileWidget extends Widget {

	static $title = "Twitter Profile";

	static $cmsTitle = "Twitter Profile Widget";

	static $description = "Displays tweets live from Twitter.com";

	protected $type = 'profile';

	protected $version = 2;		

	static $db = array(
		'TwitterUser' => 'Varchar(20)',
		'TweetCount' => 'Int',
		'TweetInterval' => 'Int',
		'SizeHeight' => 'Int',
		'SizeWidth' => 'Int',
		'SizeWidthAuto' => 'Boolean',		
		'ShellBackground' => 'Varchar(7)',
		'ShellColor' => 'Varchar(7)',
		'TweetBackground' => 'Varchar(7)',
		'TweetColor' => 'Varchar(7)',
		'LinkColor' => 'Varchar(7)',
		'FeatureScrollbars' => 'Boolean',
		'FeatureLoop' => 'Boolean',
		'FeatureLive' => 'Boolean',
		'FeatureHashtags' => 'Boolean',
		'FeatureTimestamp' => 'Boolean',
		'FeatureAvatars' => 'Boolean',
		'FeatureBehavior' => "Enum('default, all', 'default')",
	);

	static $defaults = array(
		'TweetCount' => 4,
		'TweetInterval' => 10000,
		'SizeHeight' => 300,
		'SizeWidth' => 250,
		'SizeWidthAuto' => true,
		'ShellBackground' => '#333333',
		'ShellColor' => '#ffffff',
		'TweetBackground' => '#000000',
		'TweetColor' => '#ffffff',
		'LinkColor' => '#4AED05',
		'FeatureScrollbars' => false,
		'FeatureLoop' => false,
		'FeatureLive' => false,
		'FeatureHashtags' => true,
		'FeatureTimestamp' => true,
		'FeatureAvatars' => false,
		'FeatureBehavior' => 'default',
	);

	function getCMSFields() {
		$fields = new FieldSet(
			new TextField('TwitterUser', 'Account Name'),
			new DropdownField('TweetCount', 'Number of Tweets', range(1, 20)),
			new NumericField('SizeHeight', 'Height (px)'),
			new TextField('ShellBackground', 'UI Background Color'),
			new TextField('ShellColor', 'UI Text Color'),
			new TextField('TweetBackground', 'Tweet Background Color'),
			new TextField('TweetColor', 'Tweet Background Color'),
			new TextField('LinkColor', 'Link Color'),
			new CheckboxField('FeatureScrollbars', 'Display Scrollbars'),
			new CheckboxField('FeatureLoop', 'Loop Results'),
			new CheckboxField('FeatureHashtags', 'Display Hashtags'),
			new CheckboxField('FeatureTimestamp', 'Display Timestamp'),
			new CheckboxField('FeatureAvatars', 'Display Avatars')
		);
		return $fields;
	}

	function User() {
		return Convert::raw2js($this->TwitterUser);
	}

	protected function WidgetSetup() {
		return array(
			'version' => $this->version,
			'type' => $this->type,
			'rpp' => $this->TweetCount,
			'interval' => $this->TweetInterval,
			'width' => ($this->SizeWidthAuto ? 'auto' : $this->SizeWidth),
			'height' => $this->SizeHeight,
			'theme' => array(
				'shell' => array(
					'background' => $this->ShellBackground,
					'color' => $this->ShellColor,
				),
				'tweets' => array(
					'background' => $this->TweetBackground,
					'color' => $this->TweetColor,
					'links' => $this->LinkColor,
				)
			),
			'features' => array(
				'scrollbar' => ($this->FeatureScrollbars ? true : false),
				'loop' => ($this->FeatureLoop ? true : false),
				'live' => ($this->FeatureLive ? true : false),
				'hashtags' => ($this->FeatureHashTags ? true : false),
				'timestamp' => ($this->FeatureTimestamp ? true : false),
				'avatars' => ($this->FeatureAvatars ? true : false),
				'behavior' => $this->FeatureBehavior,
			)
		);
	}

	function WidgetSetupJSON() {
		$settings = $this->WidgetSetup();
		return Convert::raw2json($settings);
	}

}
?>