<?php
require_once(BASEPATH.'core/Model.php');

class M_chart extends CI_Model {
    public function get_data($area_name, $brand_name, $date_from, $date_to) {
        $this->db->select('*');
        $this->db->from('report_product');
        $this->db->join('store', 'report_product.store_id = store.store_id');
        $this->db->join('store_area', 'store.area_id = store_area.area_id');
        $this->db->join('product', 'report_product.product_id = product.product_id');
        $this->db->join('product_brand', 'product.brand_id = product_brand.brand_id');
        if(!empty($area_name)){
            $this->db->where('store_area.area_name', $area_name);
        }
        if(!empty($brand_name)){
            $this->db->where('product_brand.brand_name', $brand_name);
        }
        if(!empty($date_from)){
            $this->db->where('report_product.tanggal >=', $date_from);
        }
        if(!empty($date_to)){
            $this->db->where('report_product.tanggal <=', $date_to);
        }
        $this->db->where('store.area_id = store_area.area_id');
        $this->db->where('store.area_id = store_area.area_id');
        $query = $this->db->get();

        return $query->result_array();
    
            
            // if ($date_from != null && $date_to != null) {
            //     $this->db->where('report_product.tanggal >=', $date_from);
            //     $this->db->where('report_product.tanggal <=', $date_to);
            //     }
            // $query = $this->db->get();
        // var_dump($query);

            // $compliance_data = $query->result_array();
            // var_dump($compliance_data);
            // $compliance_count = count($compliance_data);
            // $compliance_sum = array_sum(array_column($compliance_data, 'compliance'));
            // $compliance_avg = $compliance_sum / $compliance_count;
            // $nilai = $compliance_avg * 100;
            // return $nilai;
            // return array('query' => $query, 'compliance_data' => $compliance_data, 'nilai' => $nilai);
            // return array('query' => $query, 'nilai' => $nilai);
            // return (object) array('query' => $query, 'nilai' => $nilai);
        }

        // public function show_chart() {
        //     $this->db->select('*');
        //     $this->db->from('report_product');
        //     $this->db->join('store', 'report_product.store_id = store.store_id');
        //     $this->db->join('store_area', 'store.area_id = store_area.area_id');
        //     $this->db->join('product', 'report_product.product_id = product.product_id');
        //     $this->db->join('product_brand', 'product.brand_id = product_brand.brand_id');
        //     $query = $this->db->get();
        //     return $query;
        // }

        // public function show_chart($date_from, $date_to, $area_name) {
        //     $dateFrom = date('Y-m-d', strtotime($date_from));
        //     $dateTo = date('Y-m-d', strtotime($date_to));
        //     $this->db->select('product_brand.brand_name, store_area.area_name, report_product.compliance');
        //     $this->db->select_sum('report_product.compliance');
        //     $this->db->from('report_product');
        //     $this->db->join('store', 'report_product.store_id = store.store_id');
        //     $this->db->join('store_area', 'store.area_id = store_area.area_id');
        //     $this->db->join('product', 'report_product.product_id = product.product_id');
        //     $this->db->join('product_brand', 'product.brand_id = product_brand.brand_id');
        //     if ($area_name == null) {
        //         $this->db->where('tanggal >=', $dateFrom);
        //         $this->db->where('tanggal <=', $dateTo);
        //     }else{
        //         $this->db->where(['area_name' => $area_name]);
        //         $this->db->where('tanggal >=', $dateFrom);
        //         $this->db->where('tanggal <=', $dateTo);
        //     };
		//     $this->db->group_by(['brand_name', 'area_name']);

        //     $query = $this->db->get();
        //     return $query;
        // }

        
    
}
