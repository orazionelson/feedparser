<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Feedreader_widget extends CMS_Controller {
	
	protected $sources=array();
	protected $config=array();
	
    public function feed(){
		//models
        $this->load->model('feedreader_sources_model');
        $this->load->model('feedreader_config_model');       
        
        //libraries
        $this->load->library('SimplePie');
  
		// get feed sources and module configuration
		$sources=$this->feedreader_sources_model->get_sources();
		$config=$this->feedreader_config_model->get_config();
		
		// class trigger
		$feed = new SimplePie();
		$feed->set_feed_url($sources);
		$feed->set_cache_location('./'.$config['cache_dir']);
		$feed->set_item_limit($config['flimit']);
		$feed->init();
		$feed->handle_content_type();
		$items= $feed->get_items();
		foreach ($items as $k=>$item){
			$feedtitles[]=$item->get_feed()->get_title();
			$fitem['feedtitle']=$item->get_feed()->get_title();
			$fitem['date']=$item->get_date($config['date_format']);
			$fitem['authors']=$item->get_authors();
			$fitem['title']=$item->get_title();
			$fitem['permalink']=$item->get_permalink();
			$myfeeds[]=$fitem;
			}
			
		$data['myfeeds']= $myfeeds;
        
        if(count($data['myfeeds'])>0){
            $this->view($this->cms_module_path().'/widget_feedreader', $data);
        }
    }
     
}
