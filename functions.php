<?php

/**
 * Return an array of recently viewed Items, ordered by most recently viewed
 * 
 * @param number $count
 * @return array
 */
function item_views_get_recent($count = 10)
{
    $db = get_db();
    $items = $db->getTable('ItemView')->findRecentItems($count);
    return $items;
}

/**
 * Return array of Items, ordered by number of views
 * 
 * @param number $count
 * @return array
 */
function item_views_get_popular($count = 10)
{
    $db = get_db();
    $items = $db->getTable('ItemView')->findPopularItems($count);
    return $items;
}

/**
 * Return HTML for recently viewed items
 * 
 * @param number $count
 * @return string
 */
function item_views_recently_viewed_items($count = 10)
{
    $items = item_views_get_recent($count);
    if ($items) {
        $html = '';
        foreach ($items as $item) {
            $html .= get_view()->partial('items/single.php', array('item' => $item));
            release_object($item);
        }
    } else {
        $html = '<p>' . __('No recently viewed items available.') . '</p>';
    }
    return $html;
}

/**
 * Return HTML for popular items
 * 
 * @param number $count
 * @return string
 */
function item_views_popular_items($count = 10)
{
    $items = item_views_get_popular($count);
    if ($items) {
        $html = '';
        foreach ($items as $item) {
            $html .= get_view()->partial('items/single.php', array('item' => $item));
            release_object($item);
        }
    } else {
        $html = '<p>' . __('No popular items available.') . '</p>';
    }
    return $html;
}



