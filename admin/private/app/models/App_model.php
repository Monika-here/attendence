<?php
class App_model extends CI_Model {

  public function __construct()
  {
      $this->load->database();
      $this->items_per_page = 50;
  }

  public function add_employee($_input = array())
  {
    $_unique_token = $this->generate_token(6,'employees','unique_token');
    if(isset($_unique_token) && !empty($_unique_token)){
      $_data = array(
        'name' => htmlspecialchars($_input['name']),
        'status' => htmlspecialchars($_input['status']),
        'email' => (isset($_input['email']) && !empty($_input['email'])) ? $_input['email'] : NULL,
        'mobile' => (isset($_input['mobile']) && !empty($_input['mobile'])) ? $_input['mobile'] : NULL,
        'unique_token' => $_unique_token,
      );
      return $this->db->insert('employees', $_data);
    }
  }

  private function generate_token($_limit = 12, $_table_name = FALSE, $_table_col = FALSE)
  {
    $_auth_key =  FALSE;
    $_allowed_characters = '0123456789';
    $_auth_key = substr(str_shuffle($_allowed_characters), 0, $_limit);
    if($_table_name && $_table_col && (strlen($_auth_key) == $_limit)){
      if($this->get_table_row($_table_name, $_table_col, $_auth_key))$this->generate_token();
    }
    return $_auth_key;
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

  public function list_employees($_page_no = FALSE, $_search = FALSE)
  {
    $this->db->select('*');
    $this->db->from('employees');
    if($_search)$this->db->like('name', $_search);
    $this->db->where('deleted','0');
    $this->db->order_by('id', 'DESC');
    $_items_per_page = ($this->input->get('items_per_page') && !empty($this->input->get('items_per_page')) && (intval($this->input->get('items_per_page')) > 0)) ? intval($this->input->get('items_per_page')) : $this->items_per_page;

    $_skip_count = ($_page_no - 1) * $_items_per_page;
    $this->db->limit($_items_per_page, $_skip_count);

    if($_query=$this->db->get()){
      $_rows = $_query->result_array();
      $_data = array(
        'rows' => $_rows,
        'page_no' => $_page_no,
        'start_url' => 'list_employees/1/',
        'items_per_page' => $_items_per_page,
        'query' => 'select count(*) as count from employees where deleted=0',
      );
      $_result = $this->create_pagination_block($_data);
      if($_result) return $_result;
    }
    return FALSE;
  }

  public function create_pagination_block($_data = array())
  {
    if(!$_data && empty($_data) && $_data['rows'] && $_data['start_url'] && $_data['query'] && $_data['page_no'])return FALSE;
    $_result = array();
    $_items_per_page = (isset($_data['items_per_page']) && !empty($_data['items_per_page']) && (intval($_data['items_per_page']) > 0)) ? $_data['items_per_page'] : $this->items_per_page;
    $_skip_count = ($_data['page_no'] - 1) * $_items_per_page;
    $_result['items'] = $_data['rows'];
    $_result['items_count'] = count($_result['items']);
    $_result['page_no'] = $_data['page_no'];
    if(($_result['items'] <= 0) && ($_result['items'] > 1)){
      redirect(base_url($_data['start_url']));
    }
    $_result['items_per_page'] = $_items_per_page;
    $_result['item_start'] = ($_result['items_count'] > 0) ? ($_skip_count + 1) : 0;
    $_result['item_end'] = ($_skip_count + $_result['items_count']);
    $_result['total_items'] = $this->table_count_by_query($_data['query']);
    return $_result;
  }

  public function table_count_by_query($_sql = FALSE)
  {
    if($_query = $this->db->query($_sql)){
      $_result = $_query->row_array();
      return intval($_result['count']);
    }return FALSE;
  }

  public function edit_employee($input = array())
  {
    if(!isset($input['id']) || empty($input['id']))return FALSE;
    $data = array(
      'name' => htmlspecialchars($input['name']),
      'email' => (isset($input['email']) && !empty($input['email'])) ? $input['email'] : NULL,
      'mobile' => (isset($input['mobile']) && !empty($input['mobile'])) ? $input['mobile'] : '',
      'status' => htmlspecialchars($input['status']),
      'updated_date' => date("Y-m-d H:i:s"),
    );
    return $this->update_table_row('employees',array('id' => $input['id']),$data, 1);
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

  public function delete_table_row($table, $search_by, $id){
    if($id === FALSE)return FALSE;
    $this->db->set('deleted', '1');
    $this->db->set('deleted_date', date("Y-m-d H:i:s"));
    $this->db->where($search_by, $id);
    return $this->db->update($table);
  }

  public function todays_attendence($_page_no = 1)
  {
    //$_data = $this->app_model->get_query_result('select a.id,a.name,a.mobile,a.email,a.status,b.sign_in from employees as a left join attendence as b on a.id=b.emp_id where a.deleted=0 and DATE(sign_in)=CURDATE()');
    $this->db->select('a.id,a.name,a.mobile,a.email,b.sign_in,b.status,b.sign_out');
    $this->db->from('employees as a');
    $this->db->join('attendence as b','a.id=b.emp_id','left');
    $this->db->where('a.deleted','0');
    $this->db->where('DATE(sign_in)', date('Y-m-d'));
    $this->db->order_by('b.sign_in', 'DESC');
    $_items_per_page = ($this->input->get('items_per_page') && !empty($this->input->get('items_per_page')) && (intval($this->input->get('items_per_page')) > 0)) ? intval($this->input->get('items_per_page')) : $this->items_per_page;

    $_skip_count = ($_page_no - 1) * $_items_per_page;
    $this->db->limit($_items_per_page, $_skip_count);

    if($_query=$this->db->get()){
      $_rows = $_query->result_array();
      $_data = array(
        'rows' => $_rows,
        'page_no' => $_page_no,
        'start_url' => 'list_attendence/1/',
        'items_per_page' => $_items_per_page,
        'query' => 'select count(*) as count from employees as a left join attendence as b on a.id=b.emp_id where a.deleted=0 and DATE(sign_in)=CURDATE()',
      );
      $_result = $this->create_pagination_block($_data);
      if($_result) return $_result;
    }
    return FALSE;
  }

  public function get_query_result($_sql = FALSE)
  {
    if(!$_sql)return FALSE;
    $result = FALSE;
    if($_query = $this->db->query($_sql))$result = $_query->result_array();
    if(!$result || !is_array($result) || (count($result) < 1))return FALSE;
    return $result;
  }

}
