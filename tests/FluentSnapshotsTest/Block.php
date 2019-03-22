<?php


namespace SilverStripe\FluentSnapshots\Tests\FluentSnapshotsTest;

use SilverStripe\ORM\DataObject;
use SilverStripe\Security\Permission;
use SilverStripe\Forms\FieldList;
use SilverStripe\Forms\TabSet;
use SilverStripe\Versioned\Versioned;
use TractorCow\Fluent\Extension\FluentExtension;

class Block extends DataObject
{
    private static $db = [
        'Title' => 'Varchar',
    ];

    private static $has_one = [
        'Parent' => BlockArea::class,
    ];

    private static $translate = [
        'Title',
    ];

    private static $extensions = [
        Versioned::class,
        FluentExtension::class,
    ];

    private static $table_name = 'FluentSnapshotsTest_Block';

    private static $singular_name = 'Block';

    private static $plural_name = 'Blocks';

    private static $default_sort = 'ID ASC';
}
