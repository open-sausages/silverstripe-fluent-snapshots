<?php


namespace SilverStripe\FluentSnapshots;


use SilverStripe\ORM\DataExtension;
use TractorCow\Fluent\Model\Locale;

class FluentSnapshot extends DataExtension
{
    private static $has_one = [
        'Locale' => Locale::class,
    ];
}