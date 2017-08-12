<?php

define('ITEM_VIEWS_PLUGIN_DIR', PLUGIN_DIR . '/ItemViews');
include(ITEM_VIEWS_PLUGIN_DIR . '/functions.php');

class ItemViewsPlugin extends Omeka_Plugin_AbstractPlugin
{
    protected $_hooks = array(
        'install',
        'uninstall',
        'upgrade'
        
    );
    
    public function hookInstall()
    {
        $db = $this->_db;
        $sql = "
            CREATE TABLE IF NOT EXISTS `$db->ItemView` (
              `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
              `item_id` int(11) UNSIGNED NOT NULL,
              `last_viewed` datetime NOT NULL,
              `total_views` int(10) UNSIGNED NOT NULL,
              PRIMARY KEY (`id`)
            ) ENGINE=MyISAM CHARSET=utf8 COLLATE=utf8_unicode_ci;

        ";
        $db->query($sql);
    }
    
    public function hookUpgrade($args)
    {
        $oldVersion = $args['old_version'];
        $newVersion = $args['new_version'];
        
        if (version_compare($oldVersion, '1.0.1', '<')) {
            $db = $this->_db;
            $sql = "
                ALTER TABLE `$db->ItemView` CHANGE `id` `id` INT(11) UNSIGNED NOT NULL AUTO_INCREMENT;
                   ";
            $db->query($sql);
        }
    }
    
    public function hookUninstall()
    {
        $db = $this->_db;
        $sql = "DROP TABLE `$db->ItemView`;";
        $db->query($sql);
    }
    
    public function setUp()
    {
        parent::setUp();
        require_once(ITEM_VIEWS_PLUGIN_DIR . '/libraries/ItemViews_ControllerPlugin.php');
        Zend_Controller_Front::getInstance()->registerPlugin(new ItemViews_ControllerPlugin);
    }
    
}
