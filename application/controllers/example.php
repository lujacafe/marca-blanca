<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Example extends CI_Controller {

    /**
     * Index Page for this controller.
     *
     * Maps to the following URL
     * 		http://example.com/index.php/example
     * 	- or -  
     * 		http://example.com/index.php/example/index
     * 	- or -
     * Since this controller is set as the default controller in 
     * config/routes.php, it's displayed at http://example.com/
     *
     * So any other public methods not prefixed with an underscore will
     * map to /index.php/example/<method_name>
     * @see http://codeigniter.com/user_guide/general/urls.html
     */
    public function index($typeOfConfiguration = 1) {
        /*
          JSON = 1
          XML = 2

          Default file is JSON
         */

        //Call url helper to use base_url() function
        $this->load->helper('url');

        if ($typeOfConfiguration == 1) {

            //Load .json file
            $jsonData = file_get_contents("affiliates.json");

            //GET affiliates from JSON
            $affiliates = json_decode($jsonData, true);

            //GET selected affiliate data
            $selectedAffiliate = $affiliates[$_SERVER['HTTP_HOST']];

            //Array of data to view
            $this->data = $selectedAffiliate;

            //Load view with data of affiliate
            $this->load->view('index', $this->data);
        } else if ($typeOfConfiguration == 2) {
            $doc = new DOMDocument();

            //Load .xml file
            $doc->load('affiliates.xml');

            //GET affiliates from DOM 
            $affiliates = $doc->getElementsByTagName("affiliate");

            //Iterate affiliates 
            foreach ($affiliates as $affiliate) {
                $names = $affiliate->getElementsByTagName("webName");
                $webName = $names->item(0)->nodeValue;

                if (strtolower($webName) == strtolower($_SERVER['HTTP_HOST'])) {
                    //GET selected affiliate data
                    $url = $affiliate->getElementsByTagName('url')->item(0)->nodeValue;
                    $natsWebcams = $affiliate->getElementsByTagName('natsWebcams')->item(0)->nodeValue;
                    $natsMainPage = $affiliate->getElementsByTagName('natsMainPage')->item(0)->nodeValue;
                    $cssFolder = $affiliate->getElementsByTagName('cssFolder')->item(0)->nodeValue;
                    $googleAnalyticsID = $affiliate->getElementsByTagName('googleAnalyticsID')->item(0)->nodeValue;

                    //Array of data to view
                    $this->data = array(
                        'url' => $url,
                        'natsWebcams' => $natsWebcams,
                        'natsMainPage' => $natsMainPage,
                        'cssFolder' => $cssFolder,
                        'googleAnalyticsID' => $googleAnalyticsID
                    );

                    break;
                }
            }

            //Load view with data of affiliate
            $this->load->view('index', $this->data);
        }
    }

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */