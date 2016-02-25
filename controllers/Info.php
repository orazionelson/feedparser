<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Installation script for feedreader
 *
 * @author No-CMS Module Generator
 */
class Info extends CMS_Module {

    //////////////////////////////////////////////////////////////////////////////
    // NAVIGATIONS
    //////////////////////////////////////////////////////////////////////////////
    protected $NAVIGATIONS = array(
            // Feedreader
            array(
                'navigation_name'   => 'index',
                'url'               => 'feedreader',
                'authorization_id'  => PRIV_AUTHORIZED,
                'default_layout'    => NULL,
                'title'             => 'Feedreader',
                'parent_name'       => 'index',
                'index'             => NULL,
                'description'       => NULL,
                'bootstrap_glyph'   => 'glyphicon-flag',
                'notification_url'  => NULL,
                'hidden'            => NULL,
                'static_content'    => NULL,
            ),

        );

    protected $BACKEND_NAVIGATIONS = array(
            // Manage Feeds
            array(
                'entity_name'       => 'feedreader_sources',
                'url'               => 'manage_feedreader_sources',
                'authorization_id'  => PRIV_AUTHORIZED,
                'default_layout'    => 'default-one-column',
                'title'             => 'Manage Feeds',
                'parent_name'       => 'index',
                'index'             => NULL,
                'description'       => NULL,
                'bootstrap_glyph'   => 'glyphicon-wrench',
                'notification_url'  => NULL,
                'hidden'            => NULL,
                'static_content'    => NULL,
            ),
            // Manage Feed Reader Configuration
            array(
                'entity_name'       => 'feedreader_config',
                'url'               => 'manage_feedreader_config/index/edit/1',
                'authorization_id'  => PRIV_AUTHORIZED,
                'default_layout'    => 'default-one-column',
                'title'             => 'Manage Feedreader',
                'parent_name'       => 'index',
                'index'             => NULL,
                'description'       => NULL,
                'bootstrap_glyph'   => 'glyphicon-wrench',
                'notification_url'  => NULL,
                'hidden'            => NULL,
                'static_content'    => NULL,
            ),

        );

    //////////////////////////////////////////////////////////////////////////////
    // CONFIGURATIONS
    //////////////////////////////////////////////////////////////////////////////
    protected $CONFIGS = array();

    //////////////////////////////////////////////////////////////////////////////
    // PRIVILEGES
    //////////////////////////////////////////////////////////////////////////////
    protected $PRIVILEGES = array();

    //////////////////////////////////////////////////////////////////////////////
    // GROUPS
    //////////////////////////////////////////////////////////////////////////////
    protected $GROUPS = array(
            array('group_name' => 'Feedreader Manager', 'description' => 'Feedreader Manager'),
        );
    protected $GROUP_NAVIGATIONS = array();
    protected $GROUP_BACKEND_NAVIGATIONS = array(
            'Feedreader Manager' => array('feedreader_sources', 'feedreader_config')
        );
    protected $GROUP_PRIVILEGES = array();
    protected $GROUP_BACKEND_PRIVILEGES = array(
            'Feedreader Manager' => array(
                'feedreader_sources' => array('read', 'add', 'edit', 'delete', 'list', 'back_to_list', 'print', 'export'),
                'feedreader_config' => array('read', 'add', 'edit', 'delete', 'list', 'back_to_list', 'print', 'export'),
            )
        );

    //////////////////////////////////////////////////////////////////////////////
    // TABLES and DATA
    //////////////////////////////////////////////////////////////////////////////
    protected $TABLES = array(
        // feedreader_sources
        'feedreader_sources' => array(
            'key'    => 'id',
            'fields' => array(
                'id'                   => 'TYPE_INT_UNSIGNED_AUTO_INCREMENT',
                'url'                  => array("type" => 'varchar',    "constraint" => 256, "null" => TRUE),
            ),
        ),
        // feedreader_config
        'feedreader_config' => array(
            'key'    => 'id',
            'fields' => array(
                'id'                   => 'TYPE_INT_UNSIGNED_AUTO_INCREMENT',
                'flimit'                => array("type" => 'int',        "constraint" => 5,   "null" => TRUE),
                'cache_dir'            => array("type" => 'varchar',    "constraint" => 256, "null" => TRUE),
                'cache_time'           => array("type" => 'int',        "constraint" => 11,  "null" => TRUE),
                'date_format'          => array("type" => 'varchar',    "constraint" => 256, "null" => TRUE),
            ),
        ),
    );
    protected $DATA = array(
        
    );

    //////////////////////////////////////////////////////////////////////////////
    // ACTIVATION
    //////////////////////////////////////////////////////////////////////////////
    public function do_activate(){
		$module_path = $this->cms_module_path();
        // TODO : write your module activation script here
        $this->cms_add_widget('feedreader', 'Feed Reader',
            PRIV_EVERYONE, $module_path.'/feedreader_widget/feed');
		
		$data = array('flimit'=>'5',
					  'cache_dir'=>'modules/feedreader/feedcache',
					  'cache_time'=>'3600',
					  'date_format'=>'d/m/y',
					  '_created_at'=>date("Y-m-d H:i:s")
					  );
					  
        $this->db->insert($this->t('feedreader_config'),$data);     
        
        $feeds = array('url'=>'http://news.nationalgeographic.com/rss/index.rss');
        $this->db->insert($this->t('feedreader_sources'),$feeds); 
        
        $feeds = array('url'=>'http://nelsondev.blogspot.com/feeds/posts/default');
        $this->db->insert($this->t('feedreader_sources'),$feeds); 
            
               
    }

    //////////////////////////////////////////////////////////////////////////////
    // DEACTIVATION
    //////////////////////////////////////////////////////////////////////////////
    public function do_deactivate(){
		$this->cms_remove_widget('feedreader');
        // TODO : write your module deactivation script here
    }

    //////////////////////////////////////////////////////////////////////////////
    // UPGRADE
    //////////////////////////////////////////////////////////////////////////////
    public function do_upgrade($old_version){
        $version_part = explode('.', $old_version);
        $major        = $version_part[0];
        $minor        = $version_part[1];
        $build        = $version_part[2];
        $module_path  = $this->cms_module_path();

        // TODO: Add your migration logic here.

        // e.g:
        // if($major <= 0 && $minor <= 0 && $build <=0){
        //      // add some missing fields, navigations or privileges
        // }
    }

}
