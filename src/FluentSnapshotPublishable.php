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
    public function getSnapshots()
    {
        $list = parent::getSnapshots();

        return $list->filter([
            'LocaleID' => $this->getLocaleID(),
        ]);
    }

    /**
     * @param null $origin
     * @return Snapshot
     */
    protected function createSnapshot($origin = null)
    {
        $snapshot = parent::createSnapshot($origin);
        $snapshot->LocaleID = $this->getLocaleID();

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
            ['LocaleID = ?' => $this->getLocaleID()]
        );

        return $query;
    }

    /**
     * @return int
     */
    protected function getLocaleID()
    {
        $locale = Locale::getCurrentLocale();

        return $locale ? $locale->ID : 0;
    }
}
