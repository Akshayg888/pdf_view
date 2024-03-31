<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Orders extends CI_Controller {  

	function __construct()
	{
	  	parent::__construct();
		$this->load->model('products_model');
		$this->load->model('orders_model');
		$this->load->model('clients_model');
		$this->load->library('pagination');
		
		if (!is_admin_logged_in()) {
            redirect('');
        } 
	}

	public function index()
	{    
		$client_id = '';
		$stardate = date('Y-m-01');
	 	$enddate = date('Y-m-30');
	 
		$data['menutitle'] = 'Orders';			
		$data['pagetitle'] = 'Manage Orders';
		$data['bredcrumbs'] = '<ul class="page-breadcrumb"><li> <i class="fa fa-home"></i> <a href="'.base_url().'index_con">Home</a> <i class="fa fa-angle-right"></i> </li><li>Manage Orders</li></ul>';
		
		if($this->input->post('submit') == 'Filter')
		{ 
			$client_id = trim($this->input->post('client_id'));
			$stardate = trim($this->input->post('fromdate'));
			$enddate = trim($this->input->post('todate'));

		}elseif($this->input->post('reset') =='Reset'){
	 		$client_id = '';
	 		$stardate = date('Y-m-01');
	 		$enddate = date('Y-m-30');
	 	}
		$data['client_id'] = $client_id;
		$data['sdate'] = $stardate ;
		$data['todate'] = $enddate;

		$ordersArray = $this->orders_model->getAllOrders($stardate, $enddate, $client_id);
		$data['ordersArray'] = $ordersArray;

		$clientList = $this->clients_model->getAllClients();
		$clientListArray = array('' => 'Select Client Name');
		foreach($clientList as $client){
			$clientListArray[$client['client_id']] = $client['client_name'].' '.$client['mobile_no'];
		}
		$data['clientList'] = $clientListArray;

		if($data != false)
		{
			$this->layout->load_layout('orders/manage_orders',$data);
		}
					
	}

	public function add()
	{
		$data['menutitle'] = 'Orders';
		$data['pagetitle'] = 'Add Order';
		$data['bredcrumbs'] = '<ul class="page-breadcrumb"><li> <i class="fa fa-home"></i> <a href="'.base_url().'index_con">Home</a> <i class="fa fa-angle-right"></i> </li><li><a href="'.base_url().'orders">Manage Orders</a><i class="fa fa-angle-right"></i></li><li>Add Orders</li></ul>';

		$stateList = $this->orders_model->gst_state_codes_list();
		$stateListArray = array(''=>'Select State');
		foreach($stateList as $row){
			$stateListArray[$row['state_code']] = $row['state_name'];
		}
		$data['gst_state_codes'] = $stateListArray;

		$productList = $this->products_model->getAllProducts();
		$productListArray = array(''=>'Select Product');
		foreach($productList as $row){
			$productListArray[$row['product_id']] = $row['product_name'].' - '.$row['category_name'];
		}
		$data['productListArray'] = $productListArray;
		
		$clientList = $this->clients_model->getAllClients();
		$client_data = array('-1'=>'Select Client');
		$client_data[0] = 'Add New Client';
		foreach($clientList as $client){
			$client_data[$client['client_id']] = $client['client_name'].' - '.$client['mobile_no'];
		}
		$data['client_data'] = $client_data;

		if($this->session->userdata('err_msg') != '')
		{
			$data['err_msg'] = $this->session->userdata('err_msg');
			$this->session->unset_userdata('err_msg');
		}
		if(trim($this->input->post('submit')) == '')
		{
			$this->layout->load_layout('orders/add_order', $data);
		}elseif(trim($this->input->post('submit')) == 'Add Order')
		{ 
			$this->form_validation->set_rules('client_id', 'Client Name', 'trim|required|greater_than[-1]');
			$this->form_validation->set_rules('client_name', 'Contact Person', 'trim|required');
			$this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
			if(trim($this->input->post('client_id')) == 0){
				$this->form_validation->set_rules('mobile_no', 'Mobile Number', 'trim|required|is_unique[clients.mobile_no]');
			}else{
				$this->form_validation->set_rules('mobile_no', 'Mobile Number', 'trim|required');
			}
			$this->form_validation->set_rules('order_date', 'Order Date', 'trim|required');
			$this->form_validation->set_rules('city', 'City', 'trim|required');
			$this->form_validation->set_rules('state_code', 'State Name', 'trim|required');
			$this->form_validation->set_rules('address', 'Address', 'trim|required');
			$this->form_validation->set_rules('is_gst', 'Is GST', 'trim|required');

			if ($this->form_validation->run($this) == FALSE)
			{
				$data['client_id'] = trim($this->input->post('client_id'));
				$data['client_name'] = trim($this->input->post('client_name'));
				$data['mobile_no'] = trim($this->input->post('mobile_no'));
				$data['order_date'] = trim($this->input->post('order_date'));
				$data['state_code'] = trim($this->input->post('state_code'));
				$data['address'] = trim($this->input->post('address'));
				$data['shipping_address'] = trim($this->input->post('shipping_address'));
				$data['gst_num'] = trim($this->input->post('gst_num'));
				$data['is_gst'] = trim($this->input->post('is_gst'));
				
				$this->layout->load_layout('orders/add_order',$data);
			} else {
				
				$data_order = array();
				$data_order['client_id'] = trim($this->input->post('client_id'));
				$data_order['contact_person'] = trim($this->input->post('client_name'));
				$data_order['mobile_number'] = trim($this->input->post('mobile_no'));
				$data_order['order_date'] = trim($this->input->post('order_date'));
				$data_order['state_code'] = trim($this->input->post('state_code'));
				$data_order['billing_address'] = trim($this->input->post('address'));
				$data_order['shipping_address'] = trim($this->input->post('shipping_address'));
				$data_order['gstin_number'] = trim($this->input->post('gst_num'));
				$data_order['is_gst'] = trim($this->input->post('is_gst'));
				$data_order['order_status'] = "Pending";
				$data_order['created_by'] = $this->session->userdata('userid');
				$data_order['created_on'] = date('Y-m-d');
				$data_order['updated_by'] = $this->session->userdata('userid');
				$data_order['updated_on'] = date('Y-m-d');

				$data_client = array();
				if (trim($this->input->post('client_id')) == 0) {
					$data_client['client_id'] = trim($this->input->post('client_id'));
					$data_client['client_name'] = trim($this->input->post('client_name'));
					$data_client['mobile_no'] = trim($this->input->post('mobile_no'));
					$data_client['email'] = trim($this->input->post('email'));
					$data_client['city'] = trim($this->input->post('city'));
					$data_client['gst_num'] = trim($this->input->post('gst_num'));
					$data_client['address'] = trim($this->input->post('address'));
					$data_client['status'] = "Active";
					$data_client['created_by'] = $this->session->userdata('userid');
					$data_client['created_on'] = date('Y-m-d');
					$data_client['updated_by'] = $this->session->userdata('userid');
					$data_client['updated_on'] = date('Y-m-d');
				}

				$data_order_prod = array();
				$data_order_prod['product_id'] = $this->input->post('product_id');
				$data_order_prod['product_qty'] = $this->input->post('product_qty');
				$data_order_prod['product_unit'] = $this->input->post('product_unit');
				$data_order_prod['product_rate'] = $this->input->post('product_rate');
				$data_order_prod['product_gst'] = $this->input->post('product_gst');
				$data_order_prod['product_discount'] = $this->input->post('product_discount');

				$id = $this->orders_model->addOrder($data_order,$data_order_prod, $data_client, $data_order['client_id']);

				if($id > 0){
					$arr_msg = array('suc_msg'=>'Order added successfully','msg-type'=>'success');
				}else{
					$arr_msg = array('suc_msg'=>'Failed to create order.','msg-type'=>'danger');
				}
				$this->session->set_userdata($arr_msg);
				redirect('orders/view_order/'.$id);
			}
		}
	}

	public function edit($order_id)
	{
		if($order_id > 0){	
			$data['menutitle'] = 'Orders';
			$data['pagetitle'] = 'Edit Order';
			$data['bredcrumbs'] = '<ul class="page-breadcrumb"><li> <i class="fa fa-home"></i> <a href="'.base_url().'index_con">Home</a> <i class="fa fa-angle-right"></i> </li><li>  <a href="'.base_url().'orders/">Manage Orders</a> <i class="fa fa-angle-right"></i> </li><li>Edit Order</li></ul>';

			$stateList = $this->orders_model->gst_state_codes_list();
			$stateListArray = array('' => 'Select State');
			foreach($stateList as $row){
				$stateListArray[$row['state_code']] = $row['state_name'];
			}
			$data['gst_state_codes'] = $stateListArray;

			$productList = $this->products_model->getAllProducts();
			$productListArray = array('' => 'Select Product');
			foreach($productList as $row){
				$productListArray[$row['product_id']] = $row['product_name'].' - '.$row['category_name'];
			}
			$data['productListArray'] = $productListArray;
			
			$clientList = $this->clients_model->getAllClients();
			$client_data = array('-1' => 'Select Client');
			foreach($clientList as $client){
				$client_data[$client['client_id']] = $client['client_name'].' - '.$client['mobile_no'];
			}
			$data['client_data'] = $client_data;

			$orderDetails = $this->orders_model->getOrderDetails($order_id);
			$data['orderDetails'] = $orderDetails;	

			$orderProducts = $this->orders_model->getOrderProducts($order_id);
			$data['orderProducts'] = $orderProducts;

			if(trim($this->input->post('submit')) == '')
			{
				$this->layout->load_layout('orders/edit_order',$data);
			}elseif(trim($this->input->post('submit')) == 'Edit Order')
			{
				$this->form_validation->set_rules('client_id', 'Client Name', 'trim|required|greater_than[0]');
				$this->form_validation->set_rules('client_name', 'Contact Person', 'trim|required');
				$this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
				$this->form_validation->set_rules('mobile_no', 'Mobile Number', 'trim|required');
				$this->form_validation->set_rules('order_date', 'Order Date', 'trim|required');
				$this->form_validation->set_rules('city', 'City', 'trim|required');
				$this->form_validation->set_rules('state_code', 'State Name', 'trim|required');
				$this->form_validation->set_rules('address', 'Address', 'trim|required');
				$this->form_validation->set_rules('is_gst', 'Is GST', 'trim|required');

				if ($this->form_validation->run($this) == FALSE)
				{
					$this->layout->load_layout('orders/edit_order',$data);
				}
				else
				{
					$data_order = array();
					$data_order['client_id'] = trim($this->input->post('client_id'));
					$data_order['contact_person'] = trim($this->input->post('client_name'));
					$data_order['mobile_number'] = trim($this->input->post('mobile_no'));
					$data_order['order_date'] = trim($this->input->post('order_date'));
					$data_order['state_code'] = trim($this->input->post('state_code'));
					$data_order['billing_address'] = trim($this->input->post('address'));
					$data_order['shipping_address'] = trim($this->input->post('shipping_address'));
					$data_order['gstin_number'] = trim($this->input->post('gst_num'));
					$data_order['is_gst'] = trim($this->input->post('is_gst'));
					$data_order['order_status'] = "Pending";
					$data_order['created_by'] = $this->session->userdata('userid');
					$data_order['created_on'] = date('Y-m-d');
					$data_order['updated_by'] = $this->session->userdata('userid');
					$data_order['updated_on'] = date('Y-m-d');

					$data_order_prod = array();
					$data_order_prod['product_id'] = $this->input->post('product_id');
					$data_order_prod['product_qty'] = $this->input->post('product_qty');
					$data_order_prod['product_unit'] = $this->input->post('product_unit');
					$data_order_prod['product_rate'] = $this->input->post('product_rate');
					$data_order_prod['product_gst'] = $this->input->post('product_gst');
					$data_order_prod['product_discount'] = $this->input->post('product_discount');

					$id = $this->orders_model->updateOrder($data_order,$data_order_prod, $order_id);

					if($id > 0){
						$arr_msg = array('suc_msg'=>'Order Updated successfully!','msg-type'=>'success');
					}else{
						$arr_msg = array('suc_msg'=>'Failed to update order','msg-type'=>'danger');
					}
					$this->session->set_userdata($arr_msg);
					redirect('orders/view_order/'.$order_id);
				}
			}	
		}else {
			redirect('orders/index/');
		}			
	}

	public function add_new_row(){

		$productList = $this->products_model->getAllProducts();
		$productListArray = array(''=>'Select Product');
		foreach($productList as $row){
			$productListArray[$row['product_id']] = $row['product_name'].' - '.$row['category_name'];
		}
		$data['productListArray'] = $productListArray;

		$data_gst_per = array('' => 'Select GST', '0' => '0 %', '6' => '6 %', '10' => '10 %', '12' => '12 %', '18' => '18 %', '28' => '28 %');
		
		$rownums= trim($this->input->post('rownums'))+1;
		$rowHTml = '<tr class="gradeX short odd" id="tr_'.$rownums.'">
			<td>'.
				form_dropdown('product_id[]',$productListArray,'','class="auto form-control productdata" id="product_id_'.$rownums.'" tabindex="0" placeholder= "Select Product" required="required"').'					
				</td>

				<td> <input type="number" class="form-control" name="product_qty[]" min="0" id="product_qty_'.$rownums.'" value= "" placeholder= "Ex. 1000" required="required" /></td>

				<td> <input type="text" class="form-control" name="product_unit[]" id="product_unit_'.$rownums.'" value= "" placeholder= "Unit" required="required" /></td>

				<td> <input type="text" class="form-control" name="product_rate[]" min="0" id="product_rate_'.$rownums.'" value= "" placeholder= "EX. 100" required="required" /></td>

				<td>
					'. form_dropdown('product_gst[]',$data_gst_per,'','class="form-control" tabindex="0" id="product_gst_'.$rownums.'" required="required" ').'
				</td>
				<td> <input type="text" class="form-control" name="product_discount[]"  id="product_discount_'.$rownums.'" value= "" placeholder= "Discount %" required="required" /> </td>
				
				<td width="5%">
					<a class="btn default btn-xs red Delete" href="javascript:void(0)" alt="Delete" title="Delete" data_row="'.$rownums.'"><i class="fa fa-trash-o"></i></a>
				</td>
			</tr> ';
			
			$rowHTml .= '<script>
			$(function(){

				$(".productdata").change(function() {
					var product_id = $(this).val();
					var row_id = $(this).attr("id");
					var rowArray = row_id.split("_");
					if(product_id > 0){
						$.ajax({
							url: SITE_URL+"orders/product_info/",
							type:"POST",
							data:{product_id:product_id},
							async:false,
							dataType: "json",
							success: function(response){
								var outcome = response.outcome;
								if(outcome == 1){
									var product_unit =  response.product_unit;
									var selling_price = response.selling_price; 
									var igst_per = response.igst_per;
									$("#product_unit_"+rowArray[2]).val(product_unit);
									$("#product_rate_"+rowArray[2]).val(selling_price);
									$("#product_gst_"+rowArray[2]).val(igst_per);
								}else{
									alert("Something went wrong with you");
								}
							}
						});	
					}else {
						alert("Please select the product");
					} 
				});

				$(".Delete").click(function() {
					 var data_row = $(this).attr("data_row");
			 		$("#tr_"+data_row).remove();
				});
        	});
			</script>';
		echo $rowHTml;
	}

	public function client_info(){
		$client_id = $this->input->post('client_id');
		if($client_id > 0){
		   $client_info = $this->clients_model->getClientInfo($client_id);
		   
			$result['outcome'] = 1;
			$result['client_name'] = trim($client_info[0]['client_name']);
			$result['mobile_no'] = trim($client_info[0]['mobile_no']);
			$result['email'] = trim($client_info[0]['email']);
			$result['city'] = trim($client_info[0]['city']);
			$result['gst_num'] = trim($client_info[0]['gst_num']);
			$result['address'] = trim($client_info[0]['address']);
				
		}else{
			$result = array('outcome'=>0,'result'=>'Something Went wrong');
		}
		echo json_encode($result); die();
	}

	public function product_info(){
		$product_id = $this->input->post('product_id');
		if($product_id > 0){
		   $product_info = $this->products_model->getProductInfo($product_id);
		   
			$result['outcome'] = 1;
			$result['product_unit'] = trim($product_info[0]['product_unit']);
			$result['sgst_per'] = trim($product_info[0]['sgst_per']);
			$result['cgst_per'] = trim($product_info[0]['cgst_per']);
			$result['igst_per'] = trim($product_info[0]['igst_per']);
			$result['selling_price'] = trim($product_info[0]['selling_price']);
				
		}else{
			$result = array('outcome'=>0,'result'=>'Something Went wrong');
		}
		echo json_encode($result); die();
	}

	public function close()
	{
		$order_id = $this->input->post('order_id');
		if($order_id > 0){
			$data_insert['order_status'] = 'Closed';
			$data_insert['updated_by'] = $this->session->userdata('userid');
			$data_insert['updated_on'] = date('Y-m-d');
			$id = $this->orders_model->cancelOrder($data_insert, $order_id);
			if($id > 0){
				$arr_msg = array('suc_msg'=>'Order Closed successfully!','msg-type'=>'success');
			}else{
				$arr_msg = array('suc_msg'=>'Failed to Close Order','msg-type'=>'danger');
			}
			echo 1;
		}else {
			echo 0;
		}
	}

	public function view_order($order_id) {
		if($order_id > 0)
		{
			$data['pagetitle'] = 'Confirm Order';
			$data['menutitle'] = 'View Order';
			$data['bredcrumbs'] = '<ul class="page-breadcrumb"><li> <i class="fa fa-home"></i> <a href="'.base_url().'index_con">Home</a> <i class="fa fa-angle-right"></i> </li><li><a href="'.base_url().'orders/">Manage Orders</a> <i class="fa fa-angle-right"></i> </li><li>View Order</li></ul>';
			
			$orderDetails = $this->orders_model->getOrderDetails($order_id);	
			$data['orderDetails'] = $orderDetails;

			$orderProducts = $this->orders_model->getOrderProducts($order_id);
			$data['orderProducts'] = $orderProducts;

			$firmDetails = $this->orders_model->getFirmDetails(1);
			$data['firmDetails'] = $firmDetails;
			
			if($this->session->userdata('err_msg') != '')
			{
				$data['err_msg'] = $this->session->userdata('err_msg');
				$this->session->unset_userdata('err_msg');
			}
			if(trim($this->input->post('submit')) == '')
			{
				$this->layout->load_layout('orders/view_order',$data);
			}
			elseif(trim($this->input->post('submit')) == 'Confirm Order')
			{
				$data_order = array();
				$data_order['order_status'] = "Completed";
				$data_order['total_amount'] = trim($this->input->post('order_total_amount'));
				$data_order['paid_amount'] = trim($this->input->post('paid_amount'));
				$pending_amount = trim($this->input->post('order_total_amount')) - trim($this->input->post('paid_amount'));
				$data_order['pending_amount'] = $pending_amount;
				$data_order['updated_by'] = $this->session->userdata('userid');
				$data_order['updated_on'] = date('Y-m-d');
				
				$data_payment = array();
				$data_payment['order_number'] = $orderDetails[0]['order_number'];
				$data_payment['order_id'] = $order_id;
				$data_payment['client_id'] = $orderDetails[0]['client_id'];
				$data_payment['order_total_amount'] = trim($this->input->post('order_total_amount'));
				$data_payment['paid_amount'] = 0;
				$data_payment['status'] = 'Paid';
				$data_payment['remark'] = 'Total Order Amount';
				$data_payment['updated_on'] = date('Y-m-d');
				$data_payment['updated_by'] = trim($this->session->userdata('userid'));
				$data_payment['created_on'] = date('Y-m-d');
				$data_payment['created_by'] = trim($this->session->userdata('userid'));

				$paid_payment = array();
				$paid_payment['order_number'] = $orderDetails[0]['order_number'];
				$paid_payment['order_id'] = $order_id;
				$paid_payment['client_id'] = $orderDetails[0]['client_id'];
				$paid_payment['order_total_amount'] = 0;
				$paid_payment['paid_amount'] = trim($this->input->post('paid_amount'));
				$paid_payment['status'] = 'Paid';
				$paid_payment['remark'] = 'Payment made upon order confirmation';
				$paid_payment['updated_on'] = date('Y-m-d');
				$paid_payment['updated_by'] = trim($this->session->userdata('userid'));
				$paid_payment['created_on'] = date('Y-m-d');
				$paid_payment['created_by'] = trim($this->session->userdata('userid'));

				$id = $this->orders_model->confirmOrder($data_order, $order_id, $data_payment, $paid_payment);

				if($id == 1 ){
					$arr_msg = array('suc_msg'=>'Order number # '.$orderDetails[0]['order_number'].' is updated successfully','msg-type'=>'success');
				}else{
					$arr_msg = array('suc_msg'=>'Failed to update order number '.$orderDetails[0]['order_number'],'msg-type'=>'danger');
				}	 
				$this->session->set_userdata($arr_msg);
				redirect('orders/view_order/'.$order_id);
			} 
			elseif(trim($this->input->post('submit')) == 'Print Order')
			{

				$shippingAddress = $orderDetails[0]['shipping_address'];
				
				$headerHTML = '
				<div class="row" style="text-align:center;" >
					<div class="row">
						<div class="col-xs-2" style="float:left;">
							<img src="'.$this->config->item("base_url_asset").'assets/admin/layout/img/'.$firmDetails[0]['logo_image'].'" alt="" width="110px" />
						</div>
						<div class="col-xs-8" style="width:75%; float:center;">
							<span style="font-size:26px; color:#58a9ec; font-weight:bold; text-transform:uppercase;">'.$firmDetails[0]['disply_name'].'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span><br/>
							<span style="font-size:13px;text-align:center; font-weight:bold;"></span>'.($firmDetails[0]['firm_address']).'<br/>
							<strong style="font-weight:bold;">GST No:</strong> '.$firmDetails[0]['gst_num'].'&nbsp;&nbsp;&nbsp;</span> 
							<strong style="font-weight:bold;">State:</strong> '.$firmDetails[0]['state_name'].' &nbsp;&nbsp;&nbsp; 
							<strong style="font-weight:bold;">State Code:</strong> '.$firmDetails[0]['state_code'].'  <br/> 
							<strong style="font-weight:bold;">Email:</strong> '.$firmDetails[0]['firm_email'].'&nbsp;&nbsp;&nbsp; 
							<strong style="font-weight:bold;">Mobile No:</strong> '.$firmDetails[0]['firm_mobile'].'&nbsp;&nbsp;&nbsp; 
						</div>
					</div>
				</div>
				<div class="row" style=" border:1px solid #000000; margin:10px 0;" >
					<div class="col-xs-6" style="width:44%; float:left;border-right:1px solid #000000; ">
						<ul class="list-unstyled">
						
							<li>
								<span style="font-weight:bold;">M/S: '.$orderDetails[0]['client_name'].'</span>
							</li>
							<li>'.nl2br($orderDetails[0]['billing_address']).' </li>
							<li>
								<strong style="font-weight:bold;">GST Number: </strong>'.$orderDetails[0]['gstin_number'].'
							</li>
							<li>
								<strong style="font-weight:bold;">Contact Name & No: </strong>'.$orderDetails[0]['mobile_number'].'
							</li>						
						</ul>
					</div>
					<div class="col-xs-6" style="width:45%; float:right;">
						<ul class="list-unstyled">
							<li>
								<strong style="font-weight:bold;">Order Number: </strong>'.$orderDetails[0]['order_number'].'
							</li>
							<li>
								<strong style="font-weight:bold;">Order Date: </strong>'. date('d M Y',strtotime($orderDetails[0]['order_date'])).'
							</li> 
						</ul>
					</div>
				</div>';

				require_once APPPATH . '/third_party/mpdf/vendor/autoload.php'; 

				$mpdf = new \Mpdf\Mpdf();
				$mpdf->autoScriptToLang  = true;
                $mpdf->autoLangToFont = true;
				$this->m_pdf->pdf->autoScriptToLang = true;
                $mpdf->autoLangToFont = true;
                 
                $mpdf->SetHTMLHeader($headerHTML);
               	$mpdf->setFooter("<span style='float:left; font-size:15px; color:gray;'>Order By Morya Electricals Deola</span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Page {PAGENO} of {nb}");

                $mpdf->AddPage('', // L - landscape, P - portrait
								'', '', '', '',
								7, // margin_left
								5, // margin right
								60, // margin top
								2, // margin bottom
								5, // margin header
								0,'','','','','','','','','','A4'); // margin footer
                  
				$mpdf->shrink_tables_to_fit = 1;
				if ($orderDetails[0]['is_gst'] == 'yes') {
					$invoice_html = $this->load->view('orders/pdf_order_gst', $data, true);
				}else{
					$invoice_html = $this->load->view('orders/pdf_order', $data, true);
				}

				$pdfFilePath = $orderDetails[0]['client_name'].'- '.$orderDetails[0]['order_number'].".pdf";				

				$mpdf->WriteHTML($invoice_html);
				ob_clean(); 
				$mpdf->Output($pdfFilePath, "I");
			}
		}else{ 
			redirect('orders');
		}
	}
}
?>
