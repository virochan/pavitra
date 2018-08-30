<?php

class CheckLogin extends AppModel {

    public $useDbConfig = 'use_db_Tech_shala';
    var $name = "CheckLogin";
    var $useTable = 'shala_user_map'; //db=Teacher schema=shala

    public function get($user_id) {
        $flag = 1;
        try {
            $length = strlen(trim($user_id));

//              $query = "Select * from shala.shala_user,shala.shala_user_map,shala.shala_module,shala.shala_role "
//                    . "where shala_user.user_id = '" . $user_id . "'
//			and shala_user.user_id=shala_user_map.user_id 
//                        and shala_module.module_id = shala_user_map.module_id
//                         and shala_user_map.role_id = shala_role.role_id LIMIT 1
//                        ";

//            if (($user_id == '27250509605' && $length == 11) ||($user_id == '27280107902') ){
                $query = "Select * from shala.shala_user,shala.shala_user_map,shala.shala_module,shala.shala_role,shala.shala_all_school   
                          where shala_user.user_id = '" . $user_id . "'
			and shala_user.user_id=shala_user_map.user_id 
                        and shala_module.module_id = shala_user_map.module_id
                         and shala_user_map.role_id = shala_role.role_id  
                            and school_close !='Y'
                           LIMIT 1
                        ";
//            }
//            if ($user_id != '27250509605' && $length == 11) {
//
//                $query = "Select * from shala.shala_user,shala.shala_user_map,shala.shala_module,shala.shala_role,shala.shala_all_school   
//                          where shala_user.user_id = '" . $user_id . "'
//			and shala_user.user_id=shala_user_map.user_id 
//                        and shala_module.module_id = shala_user_map.module_id
//                         and shala_user_map.role_id = shala_role.role_id 
//                         and shala_user.user_id=shala_all_school.schcd  
//                          and ( management_details = 19  OR management_details = 16 )
//                           and ( school_management = 2  OR school_management = 1 )
//                           and school_close !='Y'
//                           LIMIT 1
//                        ";
////                master.shala_schmgt ==>schmgt_id
//            } else {
//
//                $query = "Select * from shala.shala_user,shala.shala_user_map,shala.shala_module,shala.shala_role,shala.shala_all_school   
//                          where shala_user.user_id = '" . $user_id . "'
//			and shala_user.user_id=shala_user_map.user_id 
//                        and shala_module.module_id = shala_user_map.module_id
//                         and shala_user_map.role_id = shala_role.role_id  
//                           LIMIT 1
//                        ";
//            }

            /* change query shala schema to master
             * Select * from master.shala_user,master.shala_user_map,master.shala_module,master.shala_role "
              . "where shala_user.user_id = '" . $user_id . "'
              and shala_user.user_id=shala_user_map.user_id
              and shala_module.module_id = shala_user_map.module_id
              and shala_module.module_id = shala_user_map.module_id LIMIT 1

             */
//and shala_role.role_id =shala_user_map.role_id
            //and shala_module.module_id = shala_role.module_id
//        exit();//    and shala_user.user_password = '" . $password . "' 

            $result = $this->query($query);
            if ($result <> NULL)
                return $result;
            else {
                //$result=0;
                return 0;
            }
        } catch (Exception $e) {
            return 0;
        }
    }

    public function changePassward($user_id, $user_password) {

        try {
            $query = "UPDATE shala.shala_user SET user_password='".$user_password."' WHERE user_id='".$user_id."';";
            $result = $this->query($query);
            if ($result <> NULL)
                return $result;
            else
                return 0;
        } catch (Exception $e) {
            return 0;
        }
    }

}

?>