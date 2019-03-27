<?php


namespace SilverStripe\FluentSnapshots;

use SilverStripe\ORM\DataList;
use SilverStripe\ORM\Queries\SQLSelect;
use SilverStripe\Snapshots\Snapshot;
use SilverStripe\Snapshots\SnapshotPublishable;
use TractorCow\Fluent\Model\Locale;

class FluentSnapshotPublishable extends SnapshotPublishable
{
    /**
     * @return DataList
     */
    public static function getSnapshots()
    {
        $list = parent::getSnapshots();

        return $list->filter([
            'LocaleID' => static::getLocaleID(),
        ]);
    }

    /**
     * @param null $origin
     * @return Snapshot
     */
    protected function createSnapshot($origin = null)
    {
        $snapshot = parent::createSnapshot($origin);
        $snapshot->LocaleID = static::getLocaleID();

        return $snapshot;
    }

    /**
     * @param array $snapShotIDs
     * @return SQLSelect
     */
    public function getPublishedVersionQuery($snapShotIDs)
    {
        $query = parent::getPublishedVersionQuery($snapShotIDs);
        $query->addWhere(
            ['LocaleID = ?' => static::getLocaleID()]
        );

        return $query;
    }

    /**
     * @return int
     */
    protected static function getLocaleID()
    {
        $locale = Locale::getCurrentLocale();

        return $locale ? $locale->ID : 0;
    }
}
