<?php
require_once(APPPATH.'models/m_chart.php');

class Chart extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('m_chart');
        $this->load->database();
    }

    public function index() {
		$area = $this->db->get('store_area')->result();
		$brand = $this->db->get('product_brand')->result();
        $area_name = $this->input->post('area_name');
        $brand_name = $this->input->post('brand_name');
        $date_from = $this->input->post('date_from');
        $date_to = $this->input->post('date_to');
        $compliance_data = $this->m_chart->get_data($area_name, $brand_name, $date_from, $date_to);
        // $compliance_data = array_unique(array_map(function($o) { return $o->area_name; }, array_map(function($o) { return $o->brand_name; }, $compliance_data)));
        $compliance_count = count($compliance_data);
        $compliance_sum = array_sum(array_column($compliance_data, 'compliance'));
        $compliance_avg = $compliance_sum / $compliance_count;
        $nilai = $compliance_avg * 100;

        $data = array(
            'area_name' => $area_name,
            'brand_name' => $brand_name,
            'date_from' => $date_from,
            'date_to' => $date_to,
            'compliance_data' => $compliance_data,
            'nilai' => $nilai,
            'area' => $area,
            'brand' => $brand,
            'compliance_avg' => $compliance_avg,
        );
        $this->load->view('v_chart', $data);
    }

    public function alldata() {
        $area = $this->db->get('store_area')->result();
		$brand = $this->db->get('product_brand')->result();
        $date_from = $this->input->post('date_from');
        $date_to = $this->input->post('date_to');
        $nilai1 = $this->m_chart->alldata("DKI Jakarta", "ROTI TAWAR", $date_from, $date_to);
        $nilai2 = $this->m_chart->alldata("Jawa Barat", "ROTI TAWAR", $date_from, $date_to);
        $nilai3 = $this->m_chart->alldata("Kalimantan", "ROTI TAWAR", $date_from, $date_to);
        $nilai4 = $this->m_chart->alldata("Jawa Tengah", "ROTI TAWAR", $date_from, $date_to);
        $nilai5 = $this->m_chart->alldata("Bali", "ROTI TAWAR", $date_from, $date_to);
        $nilai6 = $this->m_chart->alldata("DKI Jakarta", "SUSU KALENG", $date_from, $date_to);
        $nilai7 = $this->m_chart->alldata("Jawa Barat", "SUSU KALENG", $date_from, $date_to);
        $nilai8 = $this->m_chart->alldata("Kalimantan", "SUSU KALENG", $date_from, $date_to);
        $nilai9 = $this->m_chart->alldata("Jawa Tengah", "SUSU KALENG", $date_from, $date_to);
        $nilai10 = $this->m_chart->alldata("Bali", "SUSU KALENG", $date_from, $date_to);
        $data = array(
            'nilai1' => $nilai1,
            'nilai2' => $nilai2,
            'nilai3' => $nilai3,
            'nilai4' => $nilai4,
            'nilai5' => $nilai5,
            'nilai6' => $nilai6,
            'nilai7' => $nilai7,
            'nilai8' => $nilai8,
            'nilai9' => $nilai9,
            'nilai10' => $nilai10,
            'area' => $area,
            'brand' => $brand,
            );
            $this->load->view('v_alldata', $data);
            
        }

        public function dataarea() {
            $area = $this->db->get('store_area')->result();
            $brand = $this->db->get('product_brand')->result();
            $date_from = $this->input->post('date_from');
            $date_to = $this->input->post('date_to');
            $area_name = $this->input->post('area_name');
            $nilai1 = $this->m_chart->alldata($area_name, "ROTI TAWAR", $date_from, $date_to);
            $nilai2 = $this->m_chart->alldata($area_name, "ROTI TAWAR", $date_from, $date_to);
            $nilai3 = $this->m_chart->alldata($area_name, "ROTI TAWAR", $date_from, $date_to);
            $nilai4 = $this->m_chart->alldata($area_name, "ROTI TAWAR", $date_from, $date_to);
            $nilai5 = $this->m_chart->alldata($area_name, "ROTI TAWAR", $date_from, $date_to);
            $nilai6 = $this->m_chart->alldata($area_name, "SUSU KALENG", $date_from, $date_to);
            $nilai7 = $this->m_chart->alldata($area_name, "SUSU KALENG", $date_from, $date_to);
            $nilai8 = $this->m_chart->alldata($area_name, "SUSU KALENG", $date_from, $date_to);
            $nilai9 = $this->m_chart->alldata($area_name, "SUSU KALENG", $date_from, $date_to);
            $nilai10 = $this->m_chart->alldata($area_name, "SUSU KALENG", $date_from, $date_to);
            $data = array(
                'nilai1' => $nilai1,
                'nilai2' => $nilai2,
                'nilai3' => $nilai3,
                'nilai4' => $nilai4,
                'nilai5' => $nilai5,
                'nilai6' => $nilai6,
                'nilai7' => $nilai7,
                'nilai8' => $nilai8,
                'nilai9' => $nilai9,
                'nilai10' => $nilai10,
                'area' => $area,
                'brand' => $brand
                );
                $this->load->view('v_dataarea', $data);
                
            }
}
