<?php


namespace SilverStripe\FluentSnapshots;


use SilverStripe\ORM\DataList;
use SilverStripe\Snapshots\Snapshot;
use SilverStripe\Snapshots\SnapshotPublishable;
use TractorCow\Fluent\Model\Locale;

class FluentSnapshotPublishable extends SnapshotPublishable
{
    /**
     * @return DataList
     */
    public function getSnapshots()
    {
        $list = parent::getSnapshots();

        return $list->filter([
            'LocaleID' => Locale::getCurrentLocale()->ID,
        ]);
    }

    /**
     * @param null $origin
     * @return Snapshot
     */
    protected function createSnapshot($origin = null)
    {
        $locale = Locale::getCurrentLocale();
        $snapshot = parent::createSnapshot($origin);
        $snapshot->LocaleID = $locale ? $locale->ID : 0;

        return $snapshot;
    }
}