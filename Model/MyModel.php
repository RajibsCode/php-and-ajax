<?php
// for report alert mysql
mysqli_report(MYSQLI_REPORT_STRICT);
// model class
class MyModel {

    public $connection = '';
    // database connection here
    function __construct() {
        try {
            $this->connection = new mysqli("localhost", "root", "", "ajax_demo");
        } catch (Exception $e) {
            $msg = $e->getMessage();
            $folderName = "DBErrorLog";
            if (!file_exists($folderName)) {
                mkdir($folderName); // in windows its working 
                // mkdir($folderName,0777,true); // ubuntu require permission 
            }
            $FileName = $folderName . "/ErrorLog_" . date("d_M_Y") . ".txt";
            file_put_contents($FileName, PHP_EOL . "TIME:>> " . date('Y-m-d H:i A') . PHP_EOL . "ErrorMessage:>> " . $msg . PHP_EOL, FILE_APPEND);
        }
    }
    // insert query dynamic
    function InsertData($tbl, $data) {
        $clms = implode(',', array_keys($data));
        $vals = implode("','", $data);
        $InsertSQL = "INSERT INTO $tbl($clms)VALUES('$vals')";
        //echo $InsertSQL; exit;
        $InsertEx = $this->connection->query($InsertSQL);
        if ($InsertEx == 1) {
            $Response["Data"] = '';
            $Response["Message"] = 'Success';
            $Response["Code"] = '1';
        } else {
            $Response["Data"] = '';
            $Response["Message"] = 'Try again';
            $Response["Code"] = '0';
        }
        return $Response;
    }
    // select query dynamic
    function SelectData($tbl,$where = ''){
        $Sql= " SELECT * FROM $tbl";
        if ($where != '') {
            $Sql .= " WHERE ";
            foreach ($where as $key => $value) {
                $Sql .= " $key = '$value' AND";
            }
            $Sql = rtrim($Sql,'AND');
        }
        $Ex= $this->connection->query($Sql);
        if ($Ex->num_rows > 0) {

            while ($FetchData = $Ex->fetch_object()) {
                $allData[] = $FetchData;
            }
            $Res['Data'] = $allData;
            $Res['Code'] = 1;
            $Res['Msg'] = "Success";
        }else{
            $Res['Data'] = 0;
            $Res['Code'] = 0;
            $Res['Msg'] = "no data";
        }
        return $Res;
    }


}

?>
