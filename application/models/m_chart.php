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
        }

        public function alldata($area_name, $brand_name, $date_from = null, $date_to = null) {
            $this->db->select('compliance, COUNT(*) as total, SUM(compliance) as compliance_sum');
            $this->db->from('report_product');
            $this->db->join('store', 'report_product.store_id = store.store_id');
            $this->db->join('store_area', 'store.area_id = store_area.area_id');
            $this->db->join('product', 'report_product.product_id = product.product_id');
            $this->db->join('product_brand', 'product.brand_id = product_brand.brand_id');
            $this->db->where('store_area.area_name', $area_name);
            $this->db->where('product_brand.brand_name', $brand_name);
            if ($date_from != null && $date_to != null) {
                $this->db->where('report_product.tanggal >=', $date_from);
                $this->db->where('report_product.tanggal <=', $date_to);
            }
            $query = $this->db->get();
            $compliance_data = $query->row_array();
            if ($compliance_data['total'] == 0) {
                return "Data tidak tersedia";
            } else {
                $compliance_avg = $compliance_data['compliance_sum'] / $compliance_data['total'];
                $nilai = $compliance_avg * 100;
                return $nilai;
            }
        }

        public function dataarea($area_name, $brand_name, $date_from = null, $date_to = null) {
            $this->db->select('compliance, COUNT(*) as total, SUM(compliance) as compliance_sum');
            $this->db->from('report_product');
            $this->db->join('store', 'report_product.store_id = store.store_id');
            $this->db->join('store_area', 'store.area_id = store_area.area_id');
            $this->db->join('product', 'report_product.product_id = product.product_id');
            $this->db->join('product_brand', 'product.brand_id = product_brand.brand_id');
            $this->db->where('product_brand.brand_name', $brand_name);
            if ($area_name != null && $date_from != null && $date_to != null) {
            $this->db->where('store_area.area_name', $area_name);
                $this->db->where('report_product.tanggal >=', $date_from);
                $this->db->where('report_product.tanggal <=', $date_to);
            }
            $query = $this->db->get();
            $compliance_data = $query->row_array();
            if ($compliance_data['total'] == 0) {
                return "Data tidak tersedia";
            } else {
                $compliance_avg = $compliance_data['compliance_sum'] / $compliance_data['total'];
                $nilai = $compliance_avg * 100;
                return $nilai;
            }
        }
}
