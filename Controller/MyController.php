<?php
// timezone set
date_default_timezone_set('Asia/Kolkata');
// require model file
require_once("Model/MyModel.php");
// session start
session_start();
// create class for get info from model file
class MyController extends MyModel {

    function __construct() {
        // get construct from parent class model
        parent::__construct();
        // set path in server
        if (isset($_SERVER['PATH_INFO'])) {
            
            switch ($_SERVER['PATH_INFO']) {

                case '/index':
                    include'Views/index.php';
       
                break;
                case '/getCountrisData':
                    // 1 make Rest API for access country data and then write jquery in index
                    $countryData = $this->SelectData('countries');
                    $html = '';
                    foreach ($countryData['Data'] as $value) {
                        $html .= "<option value='" . $value->id ."'>" . $value->name ."</option>";
                    }
                    // echo "<pre>";
                    print_r($html);
                    break;
                case '/getStatesData':
                    // 5 make Rest API for access State data and then write jquery in index
                    $stateData = $this->SelectData('states',['	
                    country_id' => $_REQUEST['country']]);
                    $html = '';
                    foreach ($stateData['Data'] as $value) {
                        $html .= "<option value='" . $value->id ."'>" . $value->name ."</option>";
                    }
                    // echo "<pre>";
                    print_r($html);
                    break;  
                case '/getCitiesData':
                    // 10 make Rest API for access State data and then write jquery in index
                    $citiesData = $this->SelectData('cities',['	
                    state_id' => $_REQUEST['state']]);
                    $html = '';
                    foreach ($citiesData['Data'] as $value) {
                        $html .= "<option value='" . $value->id ."'>" . $value->name ."</option>";
                    }
                    // echo "<pre>";
                    print_r($html);
                    break;     
        }
    } else {
        ?>
        <script type="text/javascript">
            window.location.href = 'index';
        </script>
        <?php
    }
}

}

$obj = new MyController;
?>