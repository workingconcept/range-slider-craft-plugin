<?php
/**
 * RangeSlider plugin for Craft CMS 3.x
 *
 * Field for defining ranges with a nice UI.
 *
 * @link      https://workingconcept.com
 * @copyright Copyright (c) 2018 Working Concept
 */

namespace workingconcept\rangeslider;

use workingconcept\rangeslider\fields\RangeSliderField;

use Craft;
use craft\base\Plugin;
use craft\services\Fields;
use craft\events\RegisterComponentTypesEvent;
use yii\base\Event;

/**
 * @author    Working Concept
 * @package   RangeSlider
 * @since     1.0.0
 */

class RangeSlider extends Plugin
{
	public static $plugin;

	public function init()
    {
        parent::init();
		self::$plugin = $this;

		Event::on(
            Fields::class,
            Fields::EVENT_REGISTER_FIELD_TYPES,
            function (RegisterComponentTypesEvent $event) {
                $event->types[] = RangeSliderField::class;
            }
        );

        Craft::info(
            Craft::t(
                'range-slider',
                '{name} plugin loaded',
                ['name' => $this->name]
            ),
            __METHOD__
        );
    }

    public function getVersion()
	{
		return '1.0.0';
	}

}