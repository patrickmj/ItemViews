<?php

class ItemView extends Omeka_Record_AbstractRecord
{
    public $item_id;
    public $last_viewed;
    public $total_views;

    public function beforeSave($args)
    {
        $this->last_viewed = Zend_Date::now()->toString('yyyy-MM-dd HH:mm:ss');
    }
    
    public function getItem()
    {
        $db = get_db();
        $item = $db->getTable('Item')->find($this->item_id);
        return $item;
    }
}
