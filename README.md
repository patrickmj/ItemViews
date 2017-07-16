# ItemViews
Omeka plugin to keep track of item views and display recent and popular items

## About

The plugin stores data about the views of items. When an item is viewed (i.e., it's `show` page is loaded), the plugin stores the datetime, and increments the number of views. No user data is recorded.

## Usage

The plugin adds four functions for displaying the data:

```
/**
 * Return an array of recently viewed Items, ordered by most recently viewed
 * 
 * @param number $count
 * @return array
 */
function item_views_get_recent($count = 10)

/**
 * Return array of Items, ordered by number of views
 * 
 * @param number $count
 * @return array
 */
function item_views_get_popular($count = 10)

/**
 * Return HTML for recently viewed items
 * 
 * @param number $count
 * @return string
 */
function item_views_recently_viewed_items($count = 10)

/**
 * Return HTML for popular items
 * 
 * @param number $count
 * @return string
 */
function item_views_popular_items($count = 10)
```
