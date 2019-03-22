<?php

namespace SilverStripe\FluentSnapshots\Tests;

use SilverStripe\Dev\SapphireTest;
use SilverStripe\FluentSnapshots\FluentSnapshotPublishable;
use SilverStripe\FluentSnapshots\Tests\FluentSnapshotsTest\Block;
use SilverStripe\FluentSnapshots\Tests\FluentSnapshotsTest\BlockArea;
use SilverStripe\FluentSnapshots\Tests\FluentSnapshotsTest\BlockPage;
use SilverStripe\Snapshots\ActivityEntry;
use TractorCow\Fluent\Model\Locale;
use TractorCow\Fluent\State\FluentState;

class FluentSnapshotsTest extends SapphireTest
{
    protected static $extra_dataobjects = [
        Locale::class,
        BlockPage::class,
        Block::class,
        BlockArea::class,
    ];
    
    /**
     * @var BlockPage
     */
    protected $blockpage;

    /**
     * @var BlockArea
     */
    protected $blockarea;

    /**
     * @var Block
     */
    protected $block;

    public function testSnapshotsFilteredByLocale()
    {
        $this->buildState();

        $this->toLocale('en_NZ');
        $this->assertFalse($this->blockpage->hasOwnedModifications());

        $this->toLocale('fr_FR');
        $this->assertFalse($this->blockpage->hasOwnedModifications());

        $this->block->Title = 'Block français changé';
        $this->block->write();
        $this->assertTrue($this->blockpage->hasOwnedModifications());
        $activity = $this->blockpage->getActivityFeed();
        $this->assertCount(1, $activity);
        $this->assertEquals($this->block->ID, $activity->first()->Subject->ID);
        $this->assertEquals(ActivityEntry::MODIFIED, $activity->first()->Action);

        $this->toLocale('en_NZ');
        $this->assertFalse($this->blockpage->hasOwnedModifications());
        $this->assertEmpty($this->blockpage->getActivityFeed());

        $this->block->Title = 'Kiwi block changed';
        $this->block->write();
        $this->assertTrue($this->blockpage->hasOwnedModifications());
        $activity = $this->blockpage->getActivityFeed();
        $this->assertCount(1, $activity);
        $this->assertEquals($this->block->ID, $activity->first()->Subject->ID);
        $this->assertEquals(ActivityEntry::MODIFIED, $activity->first()->Action);

        $this->toLocale('fr_FR');
        $this->assertTrue($this->blockpage->hasOwnedModifications());

        $this->blockpage->publishRecursive();
        $this->assertFalse($this->blockpage->hasOwnedModifications());

        $this->toLocale('en_NZ');
        $this->assertTrue($this->blockpage->hasOwnedModifications());
        $this->blockpage->publishRecursive();
        $this->assertFalse($this->blockpage->hasOwnedModifications());
    }

    protected function buildState()
    {
        Locale::create([
            'Title' => 'NZ',
            'Locale' => 'en_NZ',
        ])->write();
        Locale::create([
            'Title' => 'France',
            'Locale' => 'fr_FR',
        ])->write();

        FluentState::singleton()->setLocale('en_NZ');

        $blockArea = BlockArea::create(['Title' => 'Kiwi block area']);
        $blockArea->write();
        /* @var Block|FluentSnapshotPublishable $block */
        $block = Block::create([
            'Title' => 'Kiwi block',
            'ParentID' => $blockArea->ID,
        ]);

        $block->write();

        /* @var BlockPage|FluentSnapshotPublishable $blockpage */
        $blockpage = BlockPage::create([
            'Title' => 'Kiwi title',
            'BlockAreaID' => $blockArea->ID,
        ]);
        $blockpage->write();

        $blockpage->publishRecursive();

        FluentState::singleton()->setLocale('fr_FR');
        $blockArea = BlockArea::create(['Title' => 'Région block français']);
        $blockArea->write();
        /* @var Block|FluentSnapshotPublishable $block */
        $block = Block::create([
            'Title' => 'Block français',
            'ParentID' => $blockArea->ID,
        ]);

        $block->write();

        $blockpage->Title = 'Title français';
        $blockpage->BlockAreaID = $blockArea->ID;
        $blockpage->write();

        $blockpage->publishRecursive();
    }

    /**
     * Switches the locale state, and requeries the relevant dataobjects to ensure
     * they're hydrated with localised content.
     *
     * @param $locale
     */
    protected function toLocale($locale)
    {
        FluentState::singleton()->setLocale($locale);
        $this->blockpage = BlockPage::get()->first();
        $this->blockarea = BlockArea::get()->byID($this->blockpage->BlockAreaID);
        $this->block = Block::get()->filter('ParentID', $this->blockarea->ID)->first();
    }
}
