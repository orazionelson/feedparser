<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Feedreader_widget extends CMS_Controller {
	
	protected $limit="";
	protected $sources=array();
	protected $rss_url="";
	
    public function feed(){
		//models
        $this->load->model('feedreader_sources_model');
        $this->load->model('feedreader_config_model');       
        
        //libraries
        $this->load->library('feedparser');
  
		// get feed sources and module configuration
		$sources=$this->feedreader_sources_model->get_sources();
		$config=$this->feedreader_config_model->get_config();
		
		$this->limit=$config['flimit'];
		// class trigger
		$rss = new feedparser;
		$this->rss=$rss;
		
		// set options
		$rss->cache_dir   = './'.$config['cache_dir'];//'./modules/feedreader/feedcache'; // cartella per la cache
		$rss->cache_time  = $config['cache_time'];      // durata della cache (secondi)
		$rss->date_format = $config['date_format'];     // formato per la data
		//$rss->CDATA       = 'content'; // contenuto del tag CDATA
		
		// Cicle feed URLS 		
		foreach($sources as $key=>$link){
			$rs[]=$rss->get($link['url'],$this->limit);			
			}
		
		$ratio=12/count($rs);
		if($ratio<3) {$ratio=3;}
		
        $data['feeds'] = $rs;
        $data['ratio'] = $ratio;
        
        if(count($data['feeds'])>0){
            $this->view($this->cms_module_path().'/widget_feedreader', $data);
        }
    }
     
}
