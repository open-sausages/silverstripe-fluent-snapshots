<?php


namespace SilverStripe\FluentSnapshots;


use SilverStripe\ORM\DataExtension;

class FluentSnapshot extends DataExtension
{
    private static $db = [
        'Locale' => 'Varchar(10)',
    ];

    private static $indexes = [
        'Locale' => true
    ];
}