<style type="text/css">
	.table-scrollable .form-control{
		width:100% !important;
	}
	input[type='text'], input[type='number'], .select2me{
		min-width:120px !important;
	}
</style>
<div class="page-bar"><?php echo $bredcrumbs; ?></div>
<?php
$attributes = array('class' => 'horizontal-form', 'id' => 'myform');
echo form_open_multipart('orders/edit/'.$orderDetails[0]['order_id'],$attributes);

$arr_submit = array(
	'name' => 'submit',
	'value' => $pagetitle,
	'class' => 'btn green'
);

$data_gst_per = array('' => 'Select GST', '0' => '0 %', '6' => '6 %', '10' => '10 %', '12' => '12 %', '18' => '18 %', '28' => '28 %');

?>
<div class="row">
	<div class="col-md-12">
		<div class="portlet box green">
			<div class="portlet-title">
				<div class="caption"> <i class="fa fa-gift"></i><?php echo $pagetitle.' '.$orderDetails[0]['order_number']; ?> </div>
				<div class="tools"><a href="javascript:;" class="collapse"></a></div>
			</div>
			<div class="portlet-body form"> 
				<?php if(validation_errors()){?>
					<div class="alert alert-danger display-hide" style="display: block;">
						<button class="close" data-close="alert"></button>
					You have some form errors. Please check below. </div>
				<?php } ?>
				<?php if(isset($_SESSION['suc_msg'])){ ?> 
					<div class="alert alert-<?php echo $_SESSION['msg-type']; ?>">
						<?php echo $_SESSION['suc_msg'];
						unset($_SESSION['suc_msg']); unset($_SESSION['msg-type']);
						?>
					</div>
				<?php } ?>
				<div class="form-body">		
					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label class="control-label" for="client_id">Client Name<span class="required" aria-required="true"> *</span> </label>
								<?php 
								$client_id = set_value('client_id');				  
								echo form_dropdown('client_id',$client_data,$orderDetails[0]['client_id'],'class="form-control select2me" id="client_id" tabindex="0" placeholder= "Select Product" required="required"');?>				  
								<span class="help-block help-block-error" for="client_id" style="color:#F30;"><?php echo form_error('client_id'); ?></span>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label class="control-label" for="client_name">Contact Person<span class="required" aria-required="true"> *</span></label>                  
								<?php 
								$client_name = set_value('client_name');				  
								$data_client_name = array(
									'name'			=> 'client_name',
									'id'			=> 'client_name',
									'value'			=> $orderDetails[0]['client_name'],
									'class'			=> 'form-control',
									'required' 		=> 'required',
									'maxlength' 	=> '30',
									'placeholder' 	=> 'Contact Person'
								);
								echo form_input($data_client_name); 
								?>
								<span class="help-block help-block-error" for="client_name" style="color:#F30;"><?php echo form_error('client_name'); ?></span>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label class="control-label" for="email">Email<span class="required" aria-required="true"> *</span></label>
								<?php 
								$email = set_value('email');				  
								$data_email = array(
									'name'			=> 'email',
									'type'			=> 'email',
									'id'			=> 'email',
									'value'			=> $orderDetails[0]['email'],
									'class'			=> 'form-control',
									'required' 		=> 'required', 
									'placeholder'	=> 'Example@email.com'
								);
								echo form_input($data_email); 
								?>
								<span class="help-block help-block-error" for="email" style="color:#F30;"><?php echo form_error('email'); ?></span>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label class="control-label" for="mobile_no">Mobile Number<span class="required" aria-required="true"> *</span></label>                  
								<?php 
								$mobile_no = set_value('mobile_no');				  
								$data_mobile_no = array(
									'name'			=> 'mobile_no',
									'id'			=> 'mobile_no',
									'type'			=> 'number',
									'step'			=> 'any',
									'value'			=> $orderDetails[0]['mobile_number'],
									'class'			=> 'form-control',
									'required' 		=> 'required', 
									'placeholder' 	=> 'Mobile Number'
								);
								echo form_input($data_mobile_no); 
								?>
								<span class="help-block help-block-error" for="mobile_no" style="color:#F30;"><?php echo form_error('mobile_no'); ?></span>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label class="control-label" for="order_date">Order Date <span class="required" aria-required="true"> *</span></label>                  
								<?php 
								$order_date = set_value('order_date');				  
								$data_order_date = array(
									'name'			=> 'order_date',
									'id'			=> 'order_date',
									'value'			=> $orderDetails[0]['order_date'],
									'class'			=> 'form-control',
									'maxlength'		=> '14',
									'required'		=> 'required',
									'placeholder' 	=> 'Order Date'
								);
								?>
								<div class="input-group input-medium date date-picker" data-date-format="yyyy-mm-dd" data-date="<?php echo date('Y-m-d');?>">
									<?php echo form_input($data_order_date);  ?>
									<span class="input-group-btn">
										<button class="btn default" type="button"><i class="fa fa-calendar"></i></button>
									</span>
								</div>
								<span class="help-block help-block-error" for="order_date" style="color:#F30;"><?php echo form_error('order_date'); ?></span>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label class="control-label">City<span class="required" aria-required="true"> *</span></label>
								<?php
								$city = set_value('city');				  
								$data_city = array(
									'name'		=> 'city',
									'id'        => 'city',
									'value'     => $orderDetails[0]['city'],
									'required' 	=> 'required',
									'class'		=> 'form-control',
									'maxlength' => '30',
								);
								echo form_input($data_city); ?> <span class="help-block help-block-error" for="city" style="color:#F30;"><?php echo form_error('city'); ?></span>
							</div>
						</div>
						
					</div>
					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label class="control-label" for="state_code">State<span class="required" aria-required="true"> *</span></label>
								<?php 

								$state_id = set_value('state_code');
								echo form_dropdown('state_code',$gst_state_codes,$orderDetails[0]['state_code'],'class="select2me form-control" required="required" tabindex="0"');?> 
								<span class="help-block help-block-error" for="state_code" style="color:#F30;"><?php echo form_error('state_code'); ?></span>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label class="control-label" for="gst_num"> GST No </label>
								<?php 
								$gst_num = set_value('gst_num');				  
								$data_gst_num = array(
									'name'			=> 'gst_num',
									'id'			=> 'gst_num',
									'value'			=> $orderDetails[0]['gstin_number'],
									'class'			=> 'form-control',
									'required' 		=> 'required', 
									'placeholder'	=> 'GST No'
								);
								echo form_input($data_gst_num); 
								?>
								<span class="help-block help-block-error" for="gst_num" style="color:#F30;"><?php echo form_error('gst_num'); ?></span>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label class="control-label" for="address">Address <span class="required" aria-required="true"> *</span></label>
								<?php 
								$address = set_value('address');				  
								$data_address = array(
									'name'			=> 'address',
									'id'			=> 'address',
									'value'			=> $orderDetails[0]['billing_address'],
									'class'			=> 'form-control',
									'required'		=> 'required',
									'cols'			=> '20',
									'rows'			=> '2',
									'placeholder'	=> 'Billing Address'
								);
								echo form_textarea($data_address); 
								?>
								<span class="help-block help-block-error" for="address" style="color:#F30;"><?php echo form_error('address'); ?></span>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label class="control-label" for="shipping_address"> Shipping Address </label>
								<?php 
								$shipping_address = set_value('shipping_address');				  
								$data_shipping_address = array(
									'name'			=> 'shipping_address',
									'id'			=> 'shipping_address',
									'value'			=> $orderDetails[0]['shipping_address'],
									'class'			=> 'form-control',
									'cols'			=> '20',
									'rows'			=> '2',
									'placeholder'	=> 'Shipping Address'
								);
								echo form_textarea($data_shipping_address); 
								?>
								<span class="help-block help-block-error" for="shipping_address" style="color:#F30;"><?php echo form_error('shipping_address'); ?></span>
							</div>
						</div>
					</div>
					<div class="row"> 
						
						<div class="col-md-6">
							<div class="form-group">
								<label class="control-label" for="is_gst"> Is GST Bill <span class="required" aria-required="true"> *</span> </label>
								<?php 

								$gst_array = array('yes' => 'Yes', 'no' => 'No' );
								$is_gst = set_value('is_gst');				  
								echo form_dropdown('is_gst',$gst_array,$orderDetails[0]['is_gst'],'class="form-control select2me" id="is_gst" tabindex="0" placeholder= "Select Product" required="required"');?>				  
								<span class="help-block help-block-error" for="is_gst" style="color:#F30;"><?php echo form_error('is_gst'); ?></span>
							</div>
						</div>
					</div> 
				</div>
			</div>
		</div>
	</div>
</div>
<div class="row">
	<div class="col-md-12"> 
		<div class="portlet box grey-cascade">
			<div class="portlet-title">
				<div class="caption"> <i class="fa fa-globe"></i> Manage Order Products </div>
				<div class="tools"> <a href="javascript:;" class="collapse"> </a></div>
			</div>
			<div class="portlet-body table-scrollable">
				<table class="table table-striped table-bordered table-hover">
					<thead>
						<tr>
							<th width="25%"> Product Name </th>
							<th width="15%"> QTY </th>			    
							<th width="10%"> Unit </th>
							<th width="10%"> Rate </th>
							<th width="10%"> GST </th>
							<th width="10%"> Discount </th>
							<th width="5%"> Action </th>
						</tr>
					</thead>
					<tbody id="tableBody">
						<?php
						if (sizeof($orderProducts) > 0) {
							foreach ($orderProducts as $key => $value) {
								$totalgst = 0;
							?>
							<tr class="gradeX short odd" id="order_products">
								<td>
									<?php 
									$product_id = set_value('product_id');			  
									echo form_dropdown('product_id[]',$productListArray,$value['product_id'],'class="auto form-control productdata" tabindex="0" id="product_id_1" placeholder= "Select Model" required="required" '); ?>
									<input type="hidden" class="form-control" id="rownums" name="rownums" value= "1" required="required" />
								</td>		
								<td> <input type="number" class="form-control" name="product_qty[]" min="0" id="product_qty_1" value= "<?php echo $value['product_qty']; ?>" placeholder= "Ex. 1000" required="required" /></td>

								<td> <input type="text" class="form-control" name="product_unit[]" id="product_unit_1" value= "<?php echo $value['product_unit']; ?>" placeholder= "Unit" required="required" /></td>	
								
								<td> <input type="text" class="form-control" name="product_rate[]" min="0" id="product_rate_1" value= "<?php echo $value['product_rate']; ?>" placeholder= "EX. 100" required="required" /></td>

								<td> <?php
									$totalgst = ($value['sgst_per'] + $value['igst_per'] + $value['cgst_per']);
									$product_gst = set_value('product_gst');			  
									echo form_dropdown('product_gst[]',$data_gst_per,$totalgst,'class="form-control" tabindex="0" id="product_gst_1" placeholder= "Select GST" required="required" '); ?>
								</td>
								<td> <input type="text" class="form-control" name="product_discount[]"  id="product_discount_1" value= "<?php echo $value['product_discount']; ?>" placeholder= "Discount %" required="required" /> </td>

								<td width="5%"></td>
							</tr>
						<?php } }?>
					</tbody>
				</table>
				<div class="table-toolbar">
					<div class="row">
						<div class="col-md-12">
							<div class="btn-group">
								<div class="btn green add_new_row">
									Add New Product <i class="fa fa-plus"></i>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<div class="row">
	<div class="col-md-12">
		<div class="portlet-body form">
			<div class="form-actions right">
				<div class="row">
					<div class="col-md-offset-3 col-md-9"> <?php echo form_submit($arr_submit)?> <a href="<?php echo base_url();?>orders/index/">
						<button type="button" class="btn default">Cancel</button>
					</a> </div>
					<div class="col-md-6"> </div>
				</div>
			</div>
		</div>
	</div>
</div>
<?php echo form_close(); ?>

<script type="text/javascript">
	$(function(){
		$(".add_new_row").click(function() {
			var rownums = $('#rownums').val();
			$.ajax({
				url: SITE_URL+"orders/add_new_row/",
				type:'POST',
				data:{rownums:rownums},
				async:false,
				success: function(result){
					$('#tableBody').append(result);
					rownums = parseInt(rownums)+1;
					$('#rownums').val(rownums);
				}
			});	
		});

		$("#client_id").change(function() {
			var client_id = $('#client_id').val();
			if(client_id > 0){
				$.ajax({
					url: SITE_URL+"orders/client_info/",
					type:'POST',
					data:{client_id:client_id},
					async:false,
					dataType: "json",
					success: function(response){
						console.log(response);
						var outcome = response.outcome;
						if(outcome == 1){
							var client_name =  response.client_name;
							var mobile_no = response.mobile_no; 
							var email = response.email;
							var city = response.city;
							var gst_num = response.gst_num;
							var address = response.address;
							//alert(response);
							$('#client_name').val(client_name);
							$('#mobile_no').val(mobile_no);
							$('#email').val(email);
							$('#city').val(city);
							$('#gst_num').val(gst_num);
							$('#address').val(address);
							$('#shipping_address').val(address);
						}else{
							alert('Something went wrong with you');
						}
					}
				});	
			}else if(client_id == '-1'){
				alert('Please select the client name');
			} else if(client_id == '0'){
				$('#client_name').val('');
				$('#mobile_no').val('');
				$('#email').val('');
				$('#city').val('');
				$('#gst_num').val('');
				$('#address').val('');
				$('#shipping_address').val('');
			}
		});

		$("#order_products .productdata").change(function() {
			var product_id = $(this).val();
			var row_id = $(this).attr("id");
			var rowArray = row_id.split("_");
			if(product_id > 0){
				$.ajax({
					url: SITE_URL+"orders/product_info/",
					type:'POST',
					data:{product_id:product_id},
					async:false,
					dataType: "json",
					success: function(response){
						var outcome = response.outcome;
						if(outcome == 1){
							var product_unit =  response.product_unit;
							var selling_price = response.selling_price; 
							var igst_per = response.igst_per;
							$('#product_unit_'+rowArray[2]).val(product_unit);
							$('#product_rate_'+rowArray[2]).val(selling_price);
							$('#product_gst_'+rowArray[2]).val(igst_per);
						}else{
							alert('Something went wrong with you');
						}
					}
				});	
			}else {
				alert('Please select the product');
			} 
		});
	});
</script>