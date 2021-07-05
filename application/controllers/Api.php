<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require_once APPPATH . 'libraries/REST_Controller.php';
use Restserver\Libraries\REST_Controller;

class Api extends REST_Controller{

  public function __construct(){
    parent::__construct();
    $this->load->database();
  }

    function index_get()
    {
      echo 'GET Request NOT Acceptable <br>'.current_url();
    }

    function index_post()
    {
      echo 'POST Request NOT Acceptable<br>'.current_url();
    }

    function index_put()
    {
      echo 'PUT Request Not Acceptable <br>'.current_url();
    }
    function index_delete()
    {
      echo 'DELETE Request Not Acceptable <br>'.current_url();
    }


    // Bagian endpoint untuk produk

    function products_get(){

      $id_uri  = $this->uri->segment(3);
      $name    = $this->get('name');
      
      if($id_uri != ''){
        
        $this->db->where('product_id', $id_uri);
        $pro = $this->db->get('product')->result();
      }else if($name != ''){
        
        $this->db->where('product_name', $name);
        $pro = $this->db->get('product')->result();
      }else{

        $pro = $this->db->get('product')->result();
      }

      $this->response($pro, 200);
    }


    
    function products_post(){
      $data = ['product_id'=>$this->post('product_id'),
               'product_name'=>$this->post('product_name'),
               'price'=>$this->post('price') ? $this->post('price') : NULL];
      $simpan = $this->db->insert('product', $data);
      if ($simpan) {
        $this->response([
          'status'=>'Success',
          'Inserted'=>$data],'HTTP_OK');
      }
    }


    function products_put(){

      $id_produk = $this->uri->segment(3);

      $data = ['product_id'=>$id_produk,
               'product_name'=>$this->put('product_name') ? $this->put('product_name') : NULL,
               'price'=>$this->put('price') ? $this->put('price') : NULL];

      $this->db->where('product_id', $id_produk);
      $update = $this->db->update('product', $data);

      if($update){
        $this->response([
          'status'=>'Success',
          'Updated'=>$data],'HTTP_OK');
      }
    }


    function products_delete(){

        $id_produk = $this->uri->segment(3);

        $this->db->where('product_id', $id_produk);
        $delete = $this->db->delete('product');
        if($delete){
             $this->response([
            'status'=>'Success'],'HTTP_OK');
        } 
    }


    // Bagian endpoint untuk customer

    function customers_get(){

      $id_uri  = $this->uri->segment(3);
      $name    = $this->get('name');
      
      if($id_uri != ''){
        
        $this->db->where('customer_id', $id_uri);
        $pro = $this->db->get('customer')->result();
      }else if($name != ''){
        
        $this->db->where('customer_name', $name);
        $pro = $this->db->get('customer')->result();
      }else{

        $pro = $this->db->get('customer')->result();
      }

      $this->response($pro, 200);
    }


    
    function customers_post(){
      $data = ['customer_id'=>$this->post('customer_id'),
               'customer_name'=>$this->post('customer_name'),
               'address'=>$this->post('address') ? $this->post('address') : NULL];
      $simpan = $this->db->insert('customer', $data);
      if($simpan) {
        $this->response([
          'status'=>'Success',
          'Inserted'=>$data],'HTTP_OK');
      }
    }


    function customers_put(){

      $id_customer = $this->uri->segment(3);

      $data = ['customer_id'=>$id_customer,
               'customer_name'=>$this->put('customer_name') ? $this->put('customer_name') : NULL,
               'address'=>$this->put('address') ? $this->put('address') : NULL];

      $this->db->where('customer_id', $id_customer);
      $update = $this->db->update('customer', $data);

      if($update){
        $this->response([
          'status'=>'Success',
          'Updated'=>$data],'HTTP_OK');
      }
    }


    function customers_delete(){

        $id_customer = $this->uri->segment(3);

        $this->db->where('customer_id', $id_customer);
        $delete = $this->db->delete('customer');
        if($delete){
             $this->response([
            'status'=>'Success'],'HTTP_OK');
        } 
    }

}