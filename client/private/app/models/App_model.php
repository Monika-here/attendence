<?php
class App_model extends CI_Model {

  public function __construct()
  {
      $this->load->database();
      $this->load->helper(array('url','support_helper'));
      $this->load->library('session');
      $this->user_data = $this->get_user_data();
  }

  public function get_user_data()
  {
    $_user_data = $this->session->get_userdata();
    if(isset($_user_data) && isset($_user_data['unique_token']) && !empty($_user_data['unique_token'])){
      /*Session data exists*/
      $_user_details = $this->db->get_where('employees', array('deleted' => 0,'unique_token' => $_user_data['unique_token']), 1)->row_array();
      if(!$_user_details)$this->unset_user_session();
    }
    return $_user_data;
  }

  public function sign_in($_input = array())
  {
    $_return = array('status' => FALSE, 'msg' => 'Unique Token is incorrect! Try Again!');
    $_user_details = $this->db->get_where('employees', array('deleted' => 0,'unique_token' => $_input['token'],'status!=' => 'in_active'), 1)->row_array();

    if(isset($_user_details) && !empty($_user_details)){
      $_attendence_row = $this->get_table_row('attendence',FALSE,FALSE, array('emp_id' => $_user_details['id'], 'DATE(sign_in)' => date('Y-m-d')));
      if(isset($_attendence_row) && !empty($_attendence_row)){
        $this->session->set_userdata(array(
          'id' => $_user_details['id'],'unique_token' => $_user_details['unique_token'],'logged_in' => TRUE,
        ));
        $_return['success'] = TRUE;
        $_return['msg'] = 'Your attendence is already recorded for the day!';
        return $_return;
      }else{
        $_insert_status = $this->perform_insert('attendence', array('emp_id' => $_user_details['id'],'sign_in' => date("Y-m-d H:i:s")));
        if(isset($_insert_status) && !empty($_insert_status)){
          $this->session->set_userdata(array(
            'id' => $_user_details['id'],'unique_token' => $_user_details['unique_token'],'logged_in' => TRUE,
          ));
          $_return['success'] = TRUE;
          $_return['msg'] = 'Signed in Successfully!';
          return $_return;
        }
      }

    }return $_return;
  }

  public function update_table_row($table, $_search_by_array = array(), $_data = array(), $_limit = FALSE){
    if(empty($_search_by_array) || empty($_data))return FALSE;
    $_data['updated_date'] = date("Y-m-d H:i:s");
    $this->db->set($_data);
    $this->db->where($_search_by_array);
    $this->db->update($table);
    if($_limit){$this->db->limit($_limit);}
    if($this->db->affected_rows() > 0){
      return $_search_by_array;
    }return FALSE;
  }

  public function perform_insert($table_name, $data)
  {
    $this->db->insert($table_name, $data);
    return $this->db->insert_id();
  }

  public function get_table_row($_table = FALSE, $_search_by = FALSE, $_value = FALSE, $_conditions = array())
  {
    if(!$_table) return FALSE;
    $_input = ($_conditions && is_array($_conditions) && !empty($_conditions)) ? $_conditions : array();
    if($_search_by && $_value) $_input[$_search_by] = $_value;
    $_input['deleted'] = 0;
    $_query = $this->db->get_where($_table, $_input);
    if($_result = $_query->row_array()){
      return $_result;
    }return FALSE;
  }

}
