<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Description of Feedreader_sources_model
 *
 * @author No-CMS Module Generator
 */
class Feedreader_sources_model extends  CMS_Model{
    
    public function get_sources(){
        $query = $this->db->select('feedreader_sources.url')
            ->from($this->t('feedreader_sources').' as feedreader_sources')
            ->get();
        $result = $query->result_array();
        return $result;
    }
    
    public function get_data($keyword, $page=0){
        $limit = 10;
        $query = $this->db->select('feedreader_sources.id, feedreader_sources.url')
            ->from($this->t('feedreader_sources').' as feedreader_sources')
            ->like('feedreader_sources.url', $keyword)
            ->limit($limit, $page*$limit)
            ->get();
        $result = $query->result();
        return $result;
    }

}
