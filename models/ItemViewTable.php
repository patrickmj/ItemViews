<?php

class ItemViewTable extends Omeka_Db_Table
{
    public function findByItem($item)
    {
        if (is_numeric($item)) {
            $itemId = $item;
        } else {
            $itemId = $item->id;
        }
        $itemViewRecord = $this->findBySql("item_id = $itemId", array(), true);
        return $itemViewRecord;

    }

    public function findRecentItems($limit = 10)
    {
        $db = get_db();
        $itemTable = $this->getTable('Item');
        $select = $itemTable->getSelectForFindBy(array('limit' => $limit));
        $itemViewAlias = $db->getTable('ItemView')->getTableAlias();
        $select->join(array(
            $itemViewAlias => $db->ItemView,
            "$itemViewAlias.item_id = item.id"),
            array()
        );
        $select->where("$itemViewAlias.item_id = items.id");
        $select->order("$itemViewAlias.last_viewed DESC");
        $results = $itemTable->fetchObjects($select);
        $items = array();
        //I don't know how to SQL join correctly, so this is slop
        foreach($results as $result) {
            $itemId = $result->item_id;
            $items[] = $itemTable->find($itemId);
        }
        
        return $items;
    }
    
    public function findPopularItems($limit = 10)
    {
        $db = get_db();
        $itemTable = $this->getTable('Item');
        $select = $itemTable->getSelectForFindBy(array('limit' => $limit));
        $itemViewAlias = $db->getTable('ItemView')->getTableAlias();
        $select->join(array(
            $itemViewAlias => $db->ItemView,
            "$itemViewAlias.item_id = item.id"),
            array()
            );
        $select->where("$itemViewAlias.item_id = items.id");
        $select->order("$itemViewAlias.total_views DESC");
        $results = $itemTable->fetchObjects($select);
        $items = array();
        //I don't know how to SQL join correctly, so this is slop
        //Also, copy-paste from findRecentItems
        //I'd rather add functionality than refactor
        foreach($results as $result) {
            $itemId = $result->item_id;
            $items[] = $itemTable->find($itemId);
        }
        return $items;
    }
}
