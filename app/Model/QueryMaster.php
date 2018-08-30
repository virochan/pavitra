<?php

class QueryMaster extends AppModel {

    public $useDbConfig = 'default';
    var $useTable = false;
  
    public function databases_fun() {
        $query = $this->query("SELECT datname FROM pg_database WHERE datistemplate = false");
        //print_r($query);
        return ($query);
    }

    public function schemas_fun() {
        $query = $this->query("select schema_name from information_schema.schemata where catalog_name='Teacher' and schema_name <> 'information_schema' and schema_name !~ E'^pg_'");
        //print_r($query);
        return ($query);
    }

    public function execute_q($selected_query) {

        try {
            $query = $this->query($selected_query);
            return ($query);
        } catch (Exception $e) {
            echo $e;
        }
    }

}

?>