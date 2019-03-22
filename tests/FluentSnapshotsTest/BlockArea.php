<?php


namespace SilverStripe\FluentSnapshots\Tests\FluentSnapshotsTest;

use SilverStripe\Dev\TestOnly;
use SilverStripe\ORM\DataObject;
use SilverStripe\Versioned\Versioned;

class BlockArea extends DataObject implements TestOnly
{
    private static $db = [
        'Title' => 'Varchar',
    ];

    private static $has_many = [
        'Blocks' => Block::class,
    ];

    private static $owns = [
        'Blocks',
    ];

    private static $extensions = [
        Versioned::class,
    ];

    private static $table_name = 'FluentSnapshotsTest_BlockArea';

    private static $singular_name = 'BlockArea';

    private static $plural_name = 'BlockAreas';

    private static $default_sort = 'ID ASC';
}
