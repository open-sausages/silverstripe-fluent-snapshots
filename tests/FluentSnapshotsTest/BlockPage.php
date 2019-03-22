<?php

namespace SilverStripe\FluentSnapshots\Tests\FluentSnapshotsTest;

use SilverStripe\Dev\TestOnly;
use SilverStripe\ORM\DataObject;
use SilverStripe\Security\Permission;
use SilverStripe\Forms\FieldList;
use SilverStripe\Forms\TabSet;
use SilverStripe\Versioned\Versioned;
use TractorCow\Fluent\Extension\FluentExtension;

class BlockPage extends DataObject implements TestOnly
{
    private static $db = [
        'Title' => 'Varchar',
    ];

    private static $has_one = [
        'BlockArea' => BlockArea::class,
    ];

    private static $owns = [
        'BlockArea',
    ];
    
    private static $translate = [
        'Title',
        'BlockAreaID',
    ];

    private static $extensions = [
        Versioned::class,
        FluentExtension::class,
    ];

    private static $table_name = 'FluentSnapshotsTest_BlockPage';

    private static $singular_name = 'BlockPage';

    private static $plural_name = 'BlockPages';

    private static $default_sort = 'ID ASC';
}
