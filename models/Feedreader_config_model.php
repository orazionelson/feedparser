<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Description of Feedreader_config_model
 *
 * @author No-CMS Module Generator
 */
class Feedreader_config_model extends  CMS_Model{
	
	public function get_config(){
        $query = $this->db->select('*')
            ->from($this->t('feedreader_config').' as feedreader_config')
			->where('id', 1)
            ->get();
        $result = $query->row_array();
        return $result;
    }

    public function get_data($keyword, $page=0){
        $limit = 10;
        $query = $this->db->select('feedreader_config.id, feedreader_config.flimit, feedreader_config.cache_dir, feedreader_config.cache_time, feedreader_config.date_format')
            ->from($this->t('feedreader_config').' as feedreader_config')
            ->like('feedreader_config.flimit', $keyword)
            ->or_like('feedreader_config.cache_dir', $keyword)
            ->or_like('feedreader_config.cache_time', $keyword)
            ->or_like('feedreader_config.date_format', $keyword)
            ->limit($limit, $page*$limit)
            ->get();
        $result = $query->result();
        return $result;
    }

}
