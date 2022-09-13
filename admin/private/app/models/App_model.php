<?php
class App_model extends CI_Model {

  public function __construct()
  {
      $this->load->database();
  }

  public function add_employee($_input = array())
  {
    $_unique_token = $this->generate_token(6,'employee','unique_token');
    $_data = array(
      'name' => htmlspecialchars($_input['name']),
      'status' => htmlspecialchars($_input['status']),
      'email' => (isset($_input['email']) && !empty($_input['email'])) ? $_input['email'] : NULL,
      'mobile' => (isset($_input['mobile']) && !empty($_input['mobile'])) ? $_input['mobile'] : NULL,
      'unique_token' => $_unique_token,
    );
    return $this->db->insert('employee', $_data);
  }

  public function generate_token($_limit = 12, $_table_name = FALSE, $_table_col = FALSE)
  {
    $_allowed_characters = '0123456789';
    $_auth_key = substr(str_shuffle($_allowed_characters), 0, $_limit);
    if($_table_name && $_table_col){
      if($this->get_table_row($_table_name, $_table_col, $_auth_key))$this->generate_token();
    }
    return $_auth_key;
  }

  public function get_table_row($_table = FALSE, $_search_by = FALSE, $_value = FALSE, $_conditions = array())
  {
    if(!$_table) return FALSE;
    $_input = ($_conditions && is_array($_conditions) && !empty($_conditions)) ? $_conditions : array();
    $_input[$_search_by] = $_value;
    $_input['deleted'] = 0;
    $_query = $this->db->get_where($_table, $_input);
    if($_result = $_query->row_array()){
      return $_result;
    }return FALSE;
  }

}
