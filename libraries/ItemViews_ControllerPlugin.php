<?php

class ItemViews_ControllerPlugin extends Zend_Controller_Plugin_Abstract
{
    public function preDispatch(Zend_Controller_Request_Abstract $request)
    {
        $params = $request->getParams();
        if ($params['controller'] == 'items' && $params['action'] == 'show') {
            $db = get_db();
            $itemViewRecord = $db->getTable('ItemView')->findByItem($params['id']);
            if (! $itemViewRecord) {
                $itemViewRecord = new ItemView;
                $itemViewRecord->total_views = 0;
                $itemViewRecord->item_id = $params['id'];
            }
            $itemViewRecord->total_views = $itemViewRecord->total_views + 1;
            $itemViewRecord->save();
        }
    }
}
