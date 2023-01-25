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

    // public function index() {
    //     $date_from = $this->input->post('date_from');
    //     $date_to = $this->input->post('date_to');
    //     $area_name = $this->input->post('area_name');
    //     $brand_name = $this->input->post('brand_name');
    //     $nilai1 = $this->m_chart->get_data("DKI Jakarta", "ROTI TAWAR");
    //     $nilai2 = $this->m_chart->get_data("Jawa Barat", "ROTI TAWAR");
    //     $nilai3 = $this->m_chart->get_data("Kalimantan", "ROTI TAWAR");
    //     $nilai4 = $this->m_chart->get_data("Jawa Tengah", "ROTI TAWAR");
    //     $nilai5 = $this->m_chart->get_data("Bali", "ROTI TAWAR");
    //     $nilai6 = $this->m_chart->get_data("DKI Jakarta", "SUSU KALENG");
    //     $nilai7 = $this->m_chart->get_data("Jawa Barat", "SUSU KALENG");
    //     $nilai8 = $this->m_chart->get_data("Kalimantan", "SUSU KALENG");
    //     $nilai9 = $this->m_chart->get_data("Jawa Tengah", "SUSU KALENG");
    //     $nilai10 = $this->m_chart->get_data("Bali", "SUSU KALENG");
    //     $data = array(
    //         'nilai1' => $nilai1,
    //         'nilai2' => $nilai2,
    //         'nilai3' => $nilai3,
    //         'nilai4' => $nilai4,
    //         'nilai5' => $nilai5,
    //         'nilai6' => $nilai6,
    //         'nilai7' => $nilai7,
    //         'nilai8' => $nilai8,
    //         'nilai9' => $nilai9,
    //         'nilai10' => $nilai10,
    //         'date_from' => $date_from,
    //         'date_to' => $date_to,
    //         'area_name' => $area_name,
    //         );

    //         $db = $this->db;
    //     var_dump($db);
    //         // $data_json = json_encode($data);
    //         $this->load->view('v_chart', $data);
    //         // echo "data: " . $data_json;
            
    //     }
        
//         public function show_chart() {
//             // error_reporting(E_ALL); ini_set('display_errors', 1);
//             // $isi['alldata'] = $this->m_chart->show_chart()->result();
//         // $this->load->view('v_show_chart', $isi);
//         $db = $this->db;
// 		$brand_name = $db->get('product_brand')->result();
// 		$area = $db->get('store_area')->result();
//         $date_from = (date('Y-m-d'));
//         $date_to = (date('Y-m-d'));
//         $area_name = null;
// 		$dataQuery1 = $this->m_chart->show_chart($date_from, $date_to, $area_name)->result_array();
        
//         foreach ($brand_name as $a) {
//             $dataBrand[($a->brand_name)] = [];
//             // var_dump($dataBrand);
//             $data = [];
//             foreach ($area as $s) {
//                $getId = $this->findData($dataQuery1,["brand_name" => $a->brand_name, "area_name" => $s->area_name]);
//                if(!empty($getId)){
//                 $data[($s->area_name)] = $dataQuery1[$getId[0]]['compliance'];
//             }
               
//              } 
//              array_push($dataBrand[($a->brand_name)], $data);
//           };

//           foreach ($dataBrand as $key => $value) {
//             foreach ($value[0] as $key_1 => $value_1) {
//                 $sum[$key_1][] = $value_1;
//             };
//           };
  
//           if(!empty($sum)){
//             foreach ($sum as $key => $value) {
//                 $data_x[$key] = array_sum($value);
//               }
//         }else {
//     $data_x =[];
// }

                
// 		$inputData = $this->input->post();

// 		$query = $this->m_chart->show_chart($inputData['area'],$inputData['dateFrom'],$inputData['dateTo'])->result_array();
// 		$data = [
//             "dataQuery" => $query,
// 			// "rowCount" => $this->db->get('report_product')->num_rows(),
//             "area" => $area,
// 			"brand" => $brand_name,
// 			"data_query" => $dataQuery1,
// 			"rowCount" => $db->get('report_product')->num_rows(),
// 			"data_x" => $data_x,
// 		];
//         // var_dump($data);

// 		$this->load->view('v_show_chart.php', $data);
//         }


//         function findData($array, $search)
//         {

//           // Create the result array
//           $result = array();

//           // Iterate over each array element
//           foreach ($array as $key => $value)
//           {

//             // Iterate over each search condition
//             foreach ($search as $k => $v)
//             {

//               // If the array element does not meet the search condition then continue to the next element
//               if (!isset($value[$k]) || $value[$k] != $v)
//               {
//                 continue 2;
//               }

//             }

//             // Add the array element's key to the result array
//             $result[] = $key;

//           }

//           // Return the result array
//           return $result;

//       }

}
