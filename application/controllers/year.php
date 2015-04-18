<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Year extends CI_Controller {

    /**
     * Index Page for this controller.
     *
     * Maps to the following URL
     * 		http://example.com/index.php/welcome
     * 	- or -  
     * 		http://example.com/index.php/welcome/index
     * 	- or -
     * Since this controller is set as the default controller in 
     * config/routes.php, it's displayed at http://example.com/
     *
     * So any other public methods not prefixed with an underscore will
     * map to /index.php/welcome/<method_name>
     * @see http://codeigniter.com/user_guide/general/urls.html
     */
    public function __construct() {
        parent::__construct();
        $this->load->model('Year_Model');
    }

    public function index() {
        if (!$this->session->userdata('logged_in')) {
            redirect('login', 'refresh');
        }

        $data['navbar'] = "admin";

        $data['page_title'] = "Year Planer";
        $data['first_name'] = $this->session->userdata('first_name');
        $userid = $this->session->userdata['id'];

       
        //Getting user type
        $data['user_type'] = $this->session->userdata['user_type'];


        //Getting Current Academic Year Details
        $data['current_year'] =  $this->Year_Model->get_academic_year_details();

        //Get All Academic Years
        $data['all_years'] =  $this->Year_Model->get_all_academic_years();

        //For Admin Views
        if($data['user_type'] == 'A'){

            //Passing it to the View
            $this->load->view('templates/header', $data);
            $this->load->view('navbar_main', $data);
            $this->load->view('navbar_sub', $data);

            //View Year Planer Admin
            $this->load->view('year/year');
            
            $this->load->view('/templates/footer');
        } elseif($data['user_type'] == 'T'){


            //Passing it to the View
            $this->load->view('templates/header', $data);
            $this->load->view('navbar_main', $data);
            $this->load->view('navbar_sub', $data);
            
            //View Year Planer  Teacher
            
            $this->load->view('/templates/footer');
        } else {
            //Passing it to the View
            $this->load->view('templates/header', $data);
            $this->load->view('navbar_main', $data);
            $this->load->view('navbar_sub', $data);
            
            //View Year Planer 
            
            $this->load->view('/templates/footer');
        }

    }
    
    /* Add Academic Year Function
     * This Function will help you to add new Academic Years to the System
     */
    public function add_academic_year(){
        $data['navbar'] = "admin";

        $data['page_title'] = "Year Planer";
        $data['first_name'] = $this->session->userdata('first_name');
        $userid = $this->session->userdata['id'];

            //Passing it to the View
        $this->load->view('templates/header', $data);
        $this->load->view('navbar_main', $data);
        $this->load->view('navbar_sub', $data);

        //View Year Planer
        $this->load->view('year/add_year');
            
        $this->load->view('/templates/footer');        
    }

    /*
    *Add Academic year to the database
    */
    public function add_year(){
        $data['navbar'] = "admin";

        $data['page_title'] = "Year Planer";
        $data['first_name'] = $this->session->userdata('first_name');
        $userid = $this->session->userdata['id'];

        $this->load->library('form_validation');
        $this->form_validation->set_rules('txt_name', 'Name', "required|xss_clean");
        $this->form_validation->set_rules('txt_startdate', 'Start Date', "required|xss_clean");
        $this->form_validation->set_rules('txt_enddate', 'End Date', "required|xss_clean");
        $this->form_validation->set_rules('txt_t1_startdate', 'Term 01 Start Date', "required|xss_clean");
        $this->form_validation->set_rules('txt_t1_enddate', 'Term 01 End Date', "required|xss_clean");
        $this->form_validation->set_rules('txt_t2_startdate', 'Term 02 Start Date', "required|xss_clean");
        $this->form_validation->set_rules('txt_t2_enddate', 'Term 02 End Date', "required|xss_clean");
        $this->form_validation->set_rules('txt_t3_startdate', 'Term 03 Start Date', "required|xss_clean");
        $this->form_validation->set_rules('txt_t3_enddate', 'Term 03 End Date', "required|xss_clean");

        $data['page_title'] = "Leave Management";

        if($this->form_validation->run() == FALSE){

            //Passing it to the View
            $this->load->view('templates/header', $data);
            $this->load->view('navbar_main', $data);
            $this->load->view('navbar_sub', $data);
            $this->load->view('year/add_year', $data);
            $this->load->view('/templates/footer');

        } else{

            $name = $this->input->post('txt_name'); 
            $start_date = $this->input->post('txt_startdate'); 
            $end_date = $this->input->post('txt_enddate'); 
            $status = $this->input->post('cmb_status'); 
            $t1_start_date = $this->input->post('txt_t1_startdate'); 
            $t1_end_date = $this->input->post('txt_t1_enddate'); 
            $t2_start_date = $this->input->post('txt_t2_startdate'); 
            $t2_end_date = $this->input->post('txt_t2_enddate'); 
            $t3_start_date = $this->input->post('txt_t3_startdate'); 
            $t3_end_date = $this->input->post('txt_t3_enddate'); 


            $noofdates=date_diff(date_create($start_date),date_create($end_date));
            //No of days in the Year
            $sdate = $noofdates->format("%a");

            $dateold = date_diff(date_create($start_date),date_create($end_date));
            $dateoldc = $dateold->format("%R%a");
            
            //Date Validation
            if($sdate == '0'){
                $data['error_message'] = "Start date cannot be the End date of Academic Year";
            } 
            elseif($end_date < $start_date){
                $data['error_message'] = "Start Date cannot be greater than End date";
            }
            //Date Validations for Terms
            elseif ($start_date  >  $t1_start_date) {
                $data['error_message'] = "Term 01 Start date cannot be less than the Year Start date";
            }elseif ( $t1_start_date >  $t2_start_date) {
                $data['error_message'] = "Term 02 Start date cannot be less than the Term 1 Start date";
            }
            else{

                //Initiating the Array
                $dataset = array();
                $newdate = $start_date;

                //Running a forloop till the end of end date with value 0
                for($x = 0; $x <= $sdate; $x++){
                    $dataset[$newdate] = "1" ;
                    $newdate = strtotime($newdate);
                    $newdate = strtotime("+1 day", $newdate);
                    $newdate = date('Y-m-d', $newdate);
                }

                $noofdates=date_diff(date_create($t1_start_date),date_create($t1_end_date));
                //No of days in between Term 1 start and end 
                $t1days = $noofdates->format("%a");
                $newdate = $t1_start_date;
                //Overiding the values on term 01
                for ($i=0; $i <= $t1days  ; $i++) { 
                    $dataset[$newdate] = "0" ;
                    $newdate = strtotime($newdate);
                    $newdate = strtotime("+1 day", $newdate);
                    $newdate = date('Y-m-d', $newdate);
                
                }

                $noofdates=date_diff(date_create($t2_start_date),date_create($t2_end_date));
                //No of days in between Term 1 start and end 
                $t1days = $noofdates->format("%a");
                $newdate = $t2_start_date;
                //Overiding the values on term 01
                for ($i=0; $i <= $t1days  ; $i++) { 
                    $dataset[$newdate] = "0" ;
                    $newdate = strtotime($newdate);
                    $newdate = strtotime("+1 day", $newdate);
                    $newdate = date('Y-m-d', $newdate);
                
                }

                $noofdates=date_diff(date_create($t3_start_date),date_create($t3_end_date));
                //No of days in between Term 1 start and end 
                $t1days = $noofdates->format("%a");
                $newdate = $t3_start_date;
                //Overiding the values on term 01
                for ($i=0; $i <= $t1days  ; $i++) { 
                    $dataset[$newdate] = "0" ;
                    $newdate = strtotime($newdate);
                    $newdate = strtotime("+1 day", $newdate);
                    $newdate = date('Y-m-d', $newdate);
                
                }  

                //Add 1 to Saturdays and Sundays again                            

                //Data Passing
                $data['daysof'] = $sdate;
                $data['dataarr'] = $dataset;

                

                $stucture = http_build_query($dataset, '', ', ');
                    

                $tt = TRUE;
                // if($this->Year_Model->add_new_academic_year($name, $start_date, $end_date, $status, $t1_start_date, $t1_end_date, $t2_start_date, $t2_end_date, $t3_start_date, $t3_end_date, $stucture) == TRUE)
                if($tt == TRUE)
                
                {
                    $data['succ_message'] = "Academic Year Added Sucessfully";

                     //Passing it to the View
                    $this->load->view('templates/header', $data);
                    $this->load->view('navbar_main', $data);
                    $this->load->view('navbar_sub', $data);
                    $this->load->view('year/add_year', $data);
                    $this->load->view('/templates/footer');   
                }

                else{
                    $data['error_message'] = "Failed to Add";
                }
            }

             //Passing it to the View with errors
                    $this->load->view('templates/header', $data);
                    $this->load->view('navbar_main', $data);
                    $this->load->view('navbar_sub', $data);
                    $this->load->view('year/add_year', $data);
                    $this->load->view('/templates/footer'); 
            
        }
    }

    //View Academic Year
    public function view_year($id){
        $data['navbar'] = "admin";

        $data['page_title'] = "Year Planer";
        $data['first_name'] = $this->session->userdata('first_name');
        $userid = $this->session->userdata['id'];

        //Get Year Details 
        $data['year'] =  $this->Year_Model->get_academic_year_by_id($id);

            //Passing it to the View
        $this->load->view('templates/header', $data);
        $this->load->view('navbar_main', $data);
        $this->load->view('navbar_sub', $data);

        //View Year Planer
        $this->load->view('year/view_year', $data);
            
        $this->load->view('/templates/footer');
    }
   
}

/* Coded by Udara Karunarathna @P0dda */
/* Location: www.udara.info */