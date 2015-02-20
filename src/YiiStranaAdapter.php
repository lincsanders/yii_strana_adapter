<?php
use Strana\ConfigHelper;
use Strana\Interfaces\CollectionAdapter;

class YiiStranaAdapter implements CollectionAdapter{

    /**
     * @var \Strana\ConfigHelper
     * Config helper is a helper class, which gives you config values
     *  used by Strana.
     */
    protected $configHelper;

    /**
     * @var
     */
    protected $records;

    public function __construct($records, ConfigHelper $configHelper)
    {
        $this->records = $records;
        $this->configHelper = $configHelper;
    }

    /**
     * This method should limit and offset your records and return.
     */
    public function slice()
    {
        // Here you will get the database object passed to Strana.
        //  Clone it.
        $records = clone($this->records);

        // Get the limit number from Strana config
        $limit = $this->configHelper->getLimit();

        // Get the offset number from Strana config
        $offset = $this->configHelper->getOffset();

        // Return your sliced records
        return $records->findAll(['limit' => $limit, 'offset' => $offset]);
    }

    /**
     * This method should return total count of all of your records.
     */
    public function total()
    {
        // Here you will get the database object passed to Strana.
        //  Clone it.
        $records = clone($this->records);

        // Return your total records count, unsliced.
        return $records->count();
    }
}
