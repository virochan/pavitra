<?php

class TecherListShalarth extends AppModel {

    var $name = "TecherListShalarth";
    public $useDbConfig = 'use_db_Shalarth';
    public $useTable = 'mst_dcps_emp'; //db=Shalarth schema=public          mst_dcps_emp__dcps_emp_ord_id
    public $virtualFields = array('dcps_emp_ord_id' => 'CONCAT(TecherListShalarth.sevarth_id|| \'-\' ||TecherListShalarth.ddo_code)'); //Cddir.=model name

    public function get($shalaarthTchCd) { //TO Fetch Shalaarth Records
          $query = "SELECT mst.dcps_emp_id,mst.org_emp_mst_id,mst.emp_name,gender,mst.dob,mst.doj,mst.designation,desg.desig_desc,sanch_tch_id ,ddo_code,mst.sevarth_id
                   FROM shalarth.mst_dcps_emp AS mst,shalarth.mst_payroll_designation as desg 
                  WHERE
                  mst.sevarth_id =  upper('" . $shalaarthTchCd . "')  AND CAST(mst.designation as bigint)  = CAST(desg.org_designation_id as bigint) order by mst.emp_name";
//exit();
        $result = $this->query($query);
        if ($result <> NULL)
            return $result;
        else {
            return 0;
        }
    }

    public function getNontchrShalarthInfo($shalaarthTchCd) { //TO Fetch Shalaarth Records
        $query = "SELECT mst.dcps_emp_id,mst.sevarth_id,mst.org_emp_mst_id,mst.emp_name,gender,mst.dob,mst.doj,mst.designation,
                       desg.desig_desc,sanch_tch_id,mst.ddo_code,ddo.dice_code
                   FROM 
			shalarth.mst_dcps_emp AS mst,
			shalarth.mst_payroll_designation AS desg, 
			shalarth.mst_dcps_ddo_office AS ddo
                  WHERE
                  mst.sevarth_id =  '" . $shalaarthTchCd . "' AND	mst.type_emp = 'Non teaching'
		AND 	CAST(mst.designation as bigint)  = CAST(desg.org_designation_id as bigint) 
		AND     mst.ddo_code = ddo.ddo_code 
order by mst.emp_name";
//        exit();
        $result = $this->query($query);
        if ($result <> NULL)
            return $result;
        else {
            return 0;
        }
    }
    
      public function getTchrShalarthInfoTeachingStaff($shalaarthTchCd) { //TO Fetch Shalaarth Records
        $query = "SELECT mst.dcps_emp_id,mst.sevarth_id,mst.org_emp_mst_id,mst.emp_name,gender,mst.dob,mst.doj,mst.designation,
                       desg.desig_desc,sanch_tch_id,mst.ddo_code,ddo.dice_code
                   FROM 
			shalarth.mst_dcps_emp AS mst,
			shalarth.mst_payroll_designation AS desg, 
			shalarth.mst_dcps_ddo_office AS ddo
                  WHERE
                  mst.sevarth_id =  '" . $shalaarthTchCd . "' AND	mst.type_emp = 'Teaching'
		AND 	CAST(mst.designation as bigint)  = CAST(desg.org_designation_id as bigint) 
		AND     mst.ddo_code = ddo.ddo_code 
order by mst.emp_name";
//       echo "".$query; exit();
        $result = $this->query($query);
        if ($result <> NULL)
            return $result;
        else {
            return 0;
        }
    }
    
    
    
      public function getTchrShalarthInfoNonTeachingStaff($shalaarthTchCd) { //TO Fetch Shalaarth Records
        $query = "SELECT mst.dcps_emp_id,mst.sevarth_id,mst.org_emp_mst_id,mst.emp_name,gender,mst.dob,mst.doj,mst.designation,
                       desg.desig_desc,sanch_tch_id,mst.ddo_code,ddo.dice_code
                   FROM 
			shalarth.mst_dcps_emp AS mst,
			shalarth.mst_payroll_designation AS desg, 
			shalarth.mst_dcps_ddo_office AS ddo
                  WHERE
                  mst.sevarth_id =  '" . $shalaarthTchCd . "' AND	mst.type_emp = 'Non teaching'
		AND 	CAST(mst.designation as bigint)  = CAST(desg.org_designation_id as bigint) 
		AND     mst.ddo_code = ddo.ddo_code 
order by mst.emp_name";
//       echo "".$query; exit();
        $result = $this->query($query);
        if ($result <> NULL)
            return $result;
        else {
            return 0;
        }
    }

    public function getUnmapShalarth($DdoCode, $inClausStr) { //TO Fetch Shalaarth Records
        $query = "SELECT dcps_emp_id, org_emp_mst_id, dcps_id, emp_name, emp_name_marathi,
father_or_husband, salutation, gender, dob, doj, designation
FROM  shalarth.mst_dcps_emp WHERE sevarth_id  IN $inClausStr AND ddo_code='" . $DdoCode . "' AND type_emp = 'Teaching' ";

        $result = $this->query($query);
        if ($result <> NULL)
            return $result;
        else {
            return 0;
        }
    }

    public function getAll($tchr_cd_shalarth) { //TO Fetch All Fields from Shalaarth Master
        $query = "SELECT *  FROM shalarth.mst_dcps_emp AS mst WHERE mst.dcps_emp_id =  '" . $tchr_cd_shalarth . "' order by mst.emp_name";
        $result = $this->query($query);
        if ($result <> NULL)
            return $result;
        else {
            return 0;
        }
    }

    public function getshalaid($tchshalaid) {

        $cluswcd = $this->query("select * FROM shalarth.mst_dcps_emp where dcps_emp_id IN " . $tchshalaid . ";");

        if ($cluswcd <> NULL)
            return $cluswcd;
        else {
            return 0;
        }
    }

    public function getTchrShalarthInfoInDdoCode($inDdoCode) { //TO Fetch Shalaarth Records
        $query = "SELECT mst.dcps_emp_id,mst.org_emp_mst_id,mst.emp_name,mst.gender,mst.dob,mst.doj,mst.designation,mst.first_designation,mst.sevarth_id,ddo.ddo_code 
FROM shalarth.mst_dcps_emp as mst ,shalarth.mst_dcps_ddo_office as ddo
  WHERE mst.ddo_code IN " . $inDdoCode . " 
      AND  mst.ddo_code = ddo.ddo_code
      AND mst.type_emp = 'Teaching'
    order by emp_name DESC";
        $result = $this->query($query);

        if ($result <> NULL)
            return $result;
        else {
            return 0;
        }
    }
    public function getNonTchrShalarthInfoInDdoCode($inDdoCode) { //TO Fetch Shalaarth Records
        $query = "SELECT mst.dcps_emp_id,mst.org_emp_mst_id,mst.emp_name,mst.gender,mst.dob,mst.doj,mst.designation,mst.first_designation,mst.sevarth_id,ddo.ddo_code 
FROM shalarth.mst_dcps_emp as mst ,shalarth.mst_dcps_ddo_office as ddo
  WHERE mst.ddo_code IN " . $inDdoCode . " 
      AND  mst.ddo_code = ddo.ddo_code
      AND mst.type_emp = 'Non teaching'
    order by emp_name DESC";
        $result = $this->query($query);

        if ($result <> NULL)
            return $result;
        else {
            return 0;
        }
    }
    

}

?>