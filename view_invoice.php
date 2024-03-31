<!-- BEGIN PAGE CONTENT-->

<style>

td {   

    padding: 3px !important;

	text-align:right;

}

body{

	font-size:11px !important;

}

.well {

	padding:0px;

	margin-bottom:0px;

}

</style>



<div class="page-bar"><?php echo $bredcrumbs; ?></div>

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

<?php  

	    	$attributes = array('class' => 'horizontal-form', 'id' => 'myform');

			

			if($orderDetails[0]['order_status'] == 'Completed'){

				$attributes = array('class' => 'horizontal-form', 'id' => 'myform', 'target' => '_blank');

			}

			

			echo form_open_multipart('orders/view_invoice/'.$orderDetails[0]['order_id'],$attributes);

			

			$arr_submit = array(

								'name' => 'submit',

								'value' => 'Confirm Invoice',

								'class' => 'btn green'

			);	

			

			$arr_save = array(

								'name' => 'submit',

								'value' => 'Save Invoice',

								'class' => 'btn green'

			);	

				  

	   ?>

<div class="invoice">

				<div class="row invoice-logo" style="text-align:center;">

					<div class="col-xs-12 invoice-logo-space">

					   

					   <div class="col-xs-12" style="margin-top: -25px;">

							<strong style="font-weight:bold; font-size:13px"><?php echo ucfirst($order_type); ?> Invoice</strong>

						</div>

						  

						<div class="col-xs-12">

							<span style="font-size:30px; font-weight:bold; text-transform:uppercase;"><?php  echo $orderDetails[0]['disply_name']; ?>&nbsp;</span><br/> 							
							
							<span style="text-align:center; font-weight:bold;"></span><?php echo $firmDetails[0]['firm_address']; ?><br/>

							<strong style="font-weight:bold;">GST No:</strong> <?php echo $firmDetails[0]['gst_num']; ?>&nbsp;&nbsp;&nbsp;</span> 

							<strong style="font-weight:bold;">State:</strong> <?php echo $firmDetails[0]['state_name']; ?> &nbsp;&nbsp;&nbsp; 

							<strong style="font-weight:bold;">State Code:</strong> <?php echo $firmDetails[0]['state_code'];; ?>  <br/>  
							<strong style="font-weight:bold;">Email:</strong> <?php echo $firmDetails[0]['firm_email'];; ?> &nbsp;&nbsp;&nbsp;
							<strong style="font-weight:bold;">Mobile No:</strong> <?php echo $firmDetails[0]['firm_mobile'];; ?> &nbsp;&nbsp;&nbsp;<br/>
									
						</div> 

						 

						 

					</div>

					

				</div>

				<hr/>

				<div class="row">

					<div class="col-xs-8">

						<!--<h3>Client:</h3>-->

						<ul class="list-unstyled">

							<li>

								 M/S: <strong><?php echo $clientInfo[0]['comp_name']; ?>   </strong>

							</li>
							<li>

								<strong>Contact:</strong> <?php echo $clientInfo[0]['primary_contact']; ?>

							</li>
							<li>

								 <?php 

								

								 	$shippingAddress = $orderDetails[0]['shipping_address'];

								 

								 echo nl2br($shippingAddress);

								 ?>

								 

							</li>
							<li>

								<strong>Mobile Number:</strong> <?php echo $clientInfo[0]['primary_mobile']; ?>

							</li>
							
							<li>

								<strong>GSTIN Number:</strong> <?php echo $clientInfo[0]['gstin_num']; ?>

							</li>

							
							<li>

								<strong style="font-weight:bold;">State:</strong> <?php echo $stateName[0]['state_name']; ?>

							</li>

							<li>

								<strong>State Code:</strong> <?php echo $orderDetails[0]['state_code']; ?>

							</li>
							<li>

								<strong>Delivery Date:</strong> <?php if($orderDetails[0]['delivery_date'] == '' || $orderDetails[0]['order_status'] == 'Pending' ){?>

								 

								<input type="date" name="delivery_date" id="delivery_date" placeholder="Delivery Date" class="form-control"  value="" required="required" style="width: 150px !important;" />

								<?php }else { echo $orderDetails[0]['delivery_date']; } ?>

							</li> 
						</ul>

					</div>

					

					<div class="col-xs-4 invoice-payment">

						

						<ul class="list-unstyled">
							 
							<li>

								<strong><?php echo ($order_type == 'tax')?'':'Proforma'; ?> Invoice Number:</strong> <?php echo $orderDetails[0]['invoice_number']; ?>

							</li>  
							 
							<li>

								<strong><?php echo ($order_type == 'tax')?'':'Proforma'; ?> Invoice Date:</strong> <?php echo date('d M Y',strtotime($orderDetails[0]['order_date'])); ?>

							</li> 
							 
							<li>

								<strong>Destination:</strong> <?php if($orderDetails[0]['destination'] == '' || $orderDetails[0]['order_status'] == 'Pending' ){?>

								<input type="hidden" name="vehicle_no" id="vehicle_no" value="NA"  />

								<input type="text" name="destination" id="destination" placeholder="Destination" class="form-control" size="35" value="" required="required"  />

								<?php }else { echo $orderDetails[0]['destination']; } ?>

							</li>
							
							<li>

								<strong>Transport Name:</strong> <?php if($orderDetails[0]['transport_by'] == '' || $orderDetails[0]['order_status'] == 'Pending' ){?>

								 

								<input type="text" name="transport_by" id="transport_by" placeholder="Transport Name" class="form-control" size="35" value="" required="required"  />

								<?php }else { echo $orderDetails[0]['transport_by']; } ?>

							</li> 
							<li>

								<strong>Sales Person Details:</strong> <?php if($orderDetails[0]['sales_person_details'] == '' || $orderDetails[0]['order_status'] == 'Pending' ){?>

								<input type="text" name="sales_person_details" id="sales_person_details" placeholder="Sales Person Details" class="form-control"  value="" required="required"  />

								<?php }else { echo $orderDetails[0]['sales_person_details']; } ?>

							</li>
							
							<li>

								<strong>Delivery Person Details:</strong> <?php if($orderDetails[0]['delivery_person_details'] == '' || $orderDetails[0]['order_status'] == 'Pending' ){?>

								<input type="text" name="delivery_person_details" id="delivery_person_details" placeholder="Delivery Person Details" class="form-control"  value="" required="required"  />

								<?php }else { echo $orderDetails[0]['delivery_person_details']; } ?>

							</li>
							<li>

								<strong>Reference Bill Number:</strong> <?php if($orderDetails[0]['reference_bill_no'] == '' || $orderDetails[0]['order_status'] == 'Pending' ){?>

								<input type="text" name="reference_bill_no" id="reference_bill_no" placeholder="Reference Bill Number" class="form-control"  value="" required="required"  />

								<?php }else { echo $orderDetails[0]['reference_bill_no']; } ?>

							</li>
							


						</ul>

					</div>

				</div>

				<div class="row" style="min-height:500px;">

					<div class="col-xs-12">

						<table class="table table-bordered" border="0">

						<thead>

						<tr>

							<th width="46%" style="border-bottom:1px solid #DDDDDD">

								 Description 

							</th>

							<th width="12%" style="border-bottom:1px solid #DDDDDD">

								 HSN 

							</th>
							

							<th width="12%" style="border-bottom:1px solid #DDDDDD">

								 Quantity

							</th>

							<th width="11%" style="border-bottom:1px solid #DDDDDD">

								 Rate

							</th> 
							 

							<th width="8%" style="border-bottom:1px solid #DDDDDD; text-align:center;">

								 GST %

							</th>
							

							<th width="28%" colspan="6" style="border-bottom:1px solid #DDDDDD">

								Amount

							</th>

							

						</tr>

						</thead>

						<tbody>

						<?php 

						$cnt= 1;

						

						// $orderTotal = $discountAmt = $forwardingAmt = 0.00;

						$orderTotal =$sub_total= $subTotal = $totalSgst = $totalCgst= $totalIgst = $toatalQty = $toatalAmount = $discountAmt = $maxTaxPer = $forwardingAmt = $loadingAmt =0.00;

						$exchange = $orderDetails[0]['amount'];	
						foreach($orderProducts as $product){
						 $prodTotal =  $rowTaxPer = $discountAmt =  0.00;
						 $prodRowTotal = $product['order_qty']*$product['order_rate']; 
						 $rowDiscount = round((($prodRowTotal*$product['discount_per'])/100),2);
						 $prodTotal = ($prodRowTotal-$rowDiscount); 
						  $prod_total = $prodTotal;
						 if($exchange > $prod_total){
						 	$exchange =  $exchange- $prod_total;
						 	$prodTotal = 0;
						 }else{
						 	//echo $prodTotal;die('here');
						 	$prod_total = $prod_total - $exchange ;
						 	//echo $prodTotal;die('here');
						 	$exchange = 0;
						 }
						 $toatalAmount +=$prod_total;
						 $sub_total += $prodTotal;

						 $toatalQty += $product['order_qty'];

						?>

						<tr>


							<td align="left" style="text-align:left; margin-left: 3px;"><b style="font-weight: bold;"><?php echo $product['category'];?></b> - <?php echo $product['prod_ref_name'];?><br/><b style="font-weight: bold;">Serial No:</b>  <?php echo $product['serial_no'];?>
							
							</td>

							<td ><?php echo $product['hsn_code'];?></td>

							<td ><?php echo $product['order_qty'].' '.$product['prod_unit'];?></td>

							<td class="hidden-480" ><?php echo $product['order_rate']; ?></td> 
							 
							<td class="hidden-480" ><?php echo number_format(($product['sgst_per']+$product['igst_per']+$product['cgst_per']),2); ?></td> 

							<?php  

								if($product['sgst_per'] > 0) { 

									$sgstAmt = round((($product['sgst_per']*$prodTotal)/100),2); 

								}else{ $sgstAmt = 0.00; }

								   $totalSgst +=  $sgstAmt;

								   //echo number_format($sgstAmt,2);

								 ?> 
							<?php  if($product['cgst_per'] > 0) { $cgstAmt = round((($product['cgst_per']*$prodTotal)/100),2); }else{  $cgstAmt = 0.00; } 

								$totalCgst +=  $cgstAmt;

								 //echo number_format($cgstAmt,2); /
								?> 

							 
							<?php  if($product['igst_per'] > 0) { $igstAmt = round((($product['igst_per']*$prodTotal)/100),2); }else{ $igstAmt = 0.00; } 

							$totalIgst +=  $igstAmt;

							//echo number_format($igstAmt,2)

							 ?>
							
							<td class="hidden-480" align="right" colspan="6" ><?php echo number_format(($prodTotal),2)?> </td>

						</tr>

						<?php 

							//$orderTotal +=$prodTotal+$sgstAmt+$cgstAmt+$igstAmt; 

						     $subTotal +=$prodTotal+$sgstAmt+$cgstAmt+$igstAmt;

							 $rowTaxPer = $product['sgst_per']+$product['cgst_per']+$product['igst_per']; 

							 if($rowTaxPer > $maxTaxPer ){

								$maxTaxPer = $rowTaxPer;

							 }

							$cnt++;		

							if( isset($hsnArray[$product['hsn_code']]) ){

									$hsnArray[$product['hsn_code']]['Taxable_amt'] += $prodTotal;

									$hsnArray[$product['hsn_code']]['sgst_per'] = $product['sgst_per'];

									$hsnArray[$product['hsn_code']]['sgstAmt'] += $sgstAmt;

									$hsnArray[$product['hsn_code']]['cgst_per'] = $product['cgst_per'];
									$hsnArray[$product['hsn_code']]['cgstAmt'] += $cgstAmt;

									$hsnArray[$product['hsn_code']]['igst_per'] = $product['igst_per'];

									$hsnArray[$product['hsn_code']]['igstAmt'] += $igstAmt;

								}else{

									$hsnArray[$product['hsn_code']] = [];

									$hsnArray[$product['hsn_code']]['Taxable_amt'] = [];

									$hsnArray[$product['hsn_code']]['Taxable_amt'] = $prodTotal;

									$hsnArray[$product['hsn_code']]['sgst_per'] = [];

									$hsnArray[$product['hsn_code']]['sgst_per'] = $product['sgst_per'];

									$hsnArray[$product['hsn_code']]['sgstAmt'] = [];

									$hsnArray[$product['hsn_code']]['sgstAmt'] = $sgstAmt;

									$hsnArray[$product['hsn_code']]['cgst_per'] = [];

									$hsnArray[$product['hsn_code']]['cgst_per'] = $product['cgst_per'];

									$hsnArray[$product['hsn_code']]['cgstAmt'] = [];

									$hsnArray[$product['hsn_code']]['cgstAmt'] = $cgstAmt;

									$hsnArray[$product['hsn_code']]['igst_per'] = [];

									$hsnArray[$product['hsn_code']]['igst_per'] = $product['igst_per'];

									$hsnArray[$product['hsn_code']]['igstAmt'] = [];

									$hsnArray[$product['hsn_code']]['igstAmt'] = $igstAmt;

								}

						} ?> 
						

						<?php if($cnt <18 ){ 

						   for($k=$cnt; $k<=18; $k++){ ?>

						   	<tr>

							<td style="border:none; border-right:1px solid #DDDDDD;">&nbsp;</td>
							<td style="border:none; border-right:1px solid #DDDDDD;">&nbsp;</td>  
							<td style="border:none; border-right:1px solid #DDDDDD;">&nbsp;</td>
							<td style="border:none; border-right:1px solid #DDDDDD;">&nbsp;</td>
							<td style="border:none; border-right:1px solid #DDDDDD;">&nbsp;</td>
							<td colspan="5" style="border:none; border-right:1px solid #DDDDDD;" >&nbsp;</td> 
							
							

							</tr>

						   

						<?php }

							

						}// EO if ?>

						 <?php 

							 $totalSgst = round($totalSgst,2); 

							 $totalCgst = round($totalCgst,2); 

							 $totalIgst = round($totalIgst,2); 

							 $toatalAmount = round($toatalAmount,2); 

							 $orderTotal = $toatalAmount+$totalSgst+$totalCgst+$totalIgst;  ?>

						<tr>

							<td  style="  border-right:1px solid #DDDDDD; text-align:right">&nbsp;Total&nbsp;</td>
							<td style=" border-right:1px solid #DDDDDD; text-align:right;"> </td>
							<td style=" border-right:1px solid #DDDDDD;"><?php echo $toatalQty; ?> Nos&nbsp;</td>	
							<td style=" border-right:1px solid #DDDDDD; text-align:right;"> </td>
							<td style=" border-right:1px solid #DDDDDD; text-align:right;"> </td> 
							<td colspan="6" style=" border-right:1px solid #DDDDDD; text-align:right;" ><?php  echo number_format($sub_total,2);?> </td>
							
							
						</tr> 
							<?php 

							 $extraTax = 0.00;

							 $loadingAmt = $orderDetails[0]['loadingAmt'];

							 $toatalAmount = round(($toatalAmount+$loadingAmt),2); 

							 $extraTax += round((($maxTaxPer* $loadingAmt)/100),2);  

							  
							 $forwardingAmt = $orderDetails[0]['forwardingAmt'];

							 $toatalAmount = round(($toatalAmount+ $forwardingAmt),2); 

							 $extraTax += round((($maxTaxPer* $forwardingAmt)/100),2); 
							 
							 ?> 
						<tr>

							<td colspan="3" align="left" style="text-align:left; font-weight:bold;border: 1px solid #ddd;border-left:0px;"><strong>  </strong> </td>	
							<td colspan="2" style="text-align:left; font-weight:bold;border: 1px solid #ddd;border-left:0px;"></td>


							<td colspan="3" align="right">Other Charges</td>							

							<td class="hidden-480" align="right"><?php  echo number_format($forwardingAmt,2);?> </td>

						</tr>
						<tr>
							<td colspan="3" align="left" style="text-align:left; font-weight:bold;border: 1px solid #ddd;border-left:0px;"><strong>  </strong> </td>	
							<td colspan="2" style="text-align:left; font-weight:bold;border: 1px solid #ddd;border-left:0px;"></td>

							<td colspan="3" align="right">Exchange Amount</td>					
							<td  class="hidden-480" id="finalTotal" align="right" >- <?php 
							echo number_format(round($orderDetails[0]['amount']),2);?> </td>

						</tr>
						<tr> <?php 
								$count_orders = count($finance_details);
								if($count_orders > 0)
								{ 
								  foreach($finance_details as $order_row )
								  { ?>

							<td  align="left" style="text-align:left; font-weight:bold;border: 1px solid #ddd;border-left:0px;"><strong> MODE OF PAYMENT</strong> </td>
							<?php 
							 if($order_row['type'] == 'Finance'){
							 	?>
							<td colspan="4" align="left" style="text-align:left; font-weight:bold;border: 1px solid #ddd;border-left:0px;"><strong> Finance Company: </strong> <?php echo $order_row['finance_name'];?> </td>

								
							<?php }elseif($order_row['type'] == 'Bank'){?>
								<td colspan="4" align="left" style="text-align:left; font-weight:bold;border: 1px solid #ddd;border-left:0px;"><strong> Bank Name :</strong> <?php echo $order_row['bank_name'];?> </td>	
							<?php }else{?>

							

							<td colspan="4" style="text-align:left; font-weight:bold;border: 1px solid #ddd;border-left:0px;"></td><?php } ?>

							<td colspan="3" align="right">Amount Before Tax</td>							

							<td class="hidden-480" align="right"><?php  echo number_format($toatalAmount,2);?> </td>

						</tr>

						<tr>

							<td  align="left" style="text-align:left; border: 1px solid #ddd;border-left:0px;"><strong>  CASH ADVANCE: </strong> <?php if($order_row['cash_advance'] == 0){ echo  '-';}else{ echo $order_row['cash_advance']; }?> </td>	

							<?php 
							 if($order_row['type'] == 'Finance'){
							 	?>
							<td colspan="2" align="left" style="text-align:left; font-weight:bold;border: 1px solid #ddd;border-left:0px;"><strong> Delivery Order No: </strong> <?php echo $order_row['do_no'];?> </td>	
							<?php }elseif ($order_row['type'] == 'Bank'){
								 	?>
								<td colspan="2" align="left" style="text-align:left; font-weight:bold;border: 1px solid #ddd;border-left:0px;"><strong> Cheque No: </strong> <?php echo $order_row['cheque_no'];?> </td>	
							 <?php }else{?>

							<td colspan="2" style="text-align:left; font-weight:bold;border: 1px solid #ddd;border-left:0px;"></td><?php } ?>

							<td colspan="2" style="text-align:left; font-weight:bold;border: 1px solid #ddd;border-left:0px;"></td>

							<td colspan="3" align="right">Output SGST</td>							

							<td class="hidden-480" align="right"><?php  

							if($totalSgst > 0){

								$totalSgst += round(($extraTax/2),2);

							}

							echo number_format($totalSgst,2);?> </td>

						</tr>

						<tr>

							<td  align="left" style="text-align:left;  border: 1px solid #ddd;border-left:0px;"><strong> BANK ADVANCE: </strong> <?php if($order_row['bank_advance']==0){echo '-';}else{ echo $order_row['bank_advance']; }?>  </td>

							<?php 
							 if($order_row['type'] == 'Finance'){
							 	?>
							<td colspan="2" align="left" style="text-align:left; font-weight:bold;border: 1px solid #ddd;border-left:0px;"><strong> Down Payment: </strong> <?php echo $order_row['downpayment'];?> </td>	
							<?php }elseif($order_row['type'] == 'Bank'){?>
							
								<td colspan="2" align="left" style="text-align:left; font-weight:bold;border: 1px solid #ddd;border-left:0px;"><strong> Reference No: </strong> <?php echo $order_row['ref_no'];?> </td>	
							<?php }else{?>

							<td colspan="2" style="text-align:left; font-weight:bold;border: 1px solid #ddd;border-left:0px;"></td><?php } ?>
							<td colspan="2" style="text-align:left; font-weight:bold;border: 1px solid #ddd;border-left:0px;"></td>

							<td colspan="3" align="right">Output CGST</td>							

							<td class="hidden-480" align="right"><?php  

							if($totalCgst > 0){

								$totalCgst += round(($extraTax/2),2);

							}

							echo number_format($totalCgst,2);?> </td>

						</tr>

						<tr>

							<td  align="left" style="text-align:left; border: 1px solid #ddd;border-left:0px;	 "><strong> UPI ADVANCE:</strong> <?php if($order_row['upi_advance']==0){ echo '-'; }else{ echo $order_row['upi_advance'];}?></td>	

							<?php 
							 if($order_row['type'] == 'Finance'){
							 	?>

							<td colspan="2" align="left" style="text-align:left; font-weight:bold;border: 1px solid #ddd;border-left:0px;	"><strong> EMI: </strong> <?php echo $order_row['emi_amount'];?> </td>

							<?php }else{?>	
							<td colspan="2" style="text-align:left; font-weight:bold;border: 1px solid #ddd;border-left:0px;	"></td><?php } ?>

							<td colspan="2" style="text-align:left; font-weight:bold;border: 1px solid #ddd;border-left:0px;	"></td>

							<td colspan="3" align="right">Output IGST</td>							

							<td class="hidden-480" align="right"><?php  

							if($totalIgst > 0){

								$totalIgst += round($extraTax,2);

							}

							echo number_format($totalIgst,2);?> 

							</td>

						</tr>

						<tr>

							<td  align="left" style="text-align:left; border: 1px solid #ddd;border-left:0px;"><strong> COD ADVANCE: </strong> <?php if($order_row['cod_advance'] == 0){ echo '-'; }else{ echo $order_row['cod_advance'];} ?></td>

							<?php 
							 if($order_row['type'] == 'Finance'){
							 	?>

							<td colspan="2" align="left" style="text-align:left; font-weight:bold;border: 1px solid #ddd;border-left:0px;"><strong> Tenure: </strong> <?php echo $order_row['tenor'];?>&nbsp;&nbsp; <strong> Scheme: </strong> <?php echo $order_row['scheme'];?> </td>
							<?php }else{?>	

							<td colspan="2" style="text-align:left; font-weight:bold;border: 1px solid #ddd;border-left:0px;"></td><?php } ?>

							<td colspan="2" style="text-align:left; font-weight:bold;border: 1px solid #ddd;border-left:0px;"></td>

							<td colspan="3" align="right">Round Off</td>


							<td class="hidden-480" align="right"><?php  

							$finalTotal = round(((($orderTotal + $forwardingAmt+$loadingAmt+$extraTax)-$discountAmt)),2);

							$finalRoundOff = round($finalTotal);
							// echo $orderTotal.'==>'.$finalTotal.'==>'.$finalRoundOff;
							echo round(($finalRoundOff-$finalTotal),2);?> </td>

						</tr>
						<?php 
								$totalAdv=round(($order_row['cod_advance']+$order_row['cash_advance']+$order_row['upi_advance']+$order_row['bank_advance']),2);


						?>
						<tr>

							<td colspan="8" align="right">Advance Amount</td>					
							<td  class="hidden-480" id="finalTotal" align="right" ><?php 
							echo $totalAdv/*number_format(round($orderDetails[0]['advance_amount']),2)*/;?> </td>

						</tr>

						
						<tr>

							<td colspan="8" align="right">Total</td>					
							<td class="hidden-480" id="finalTotal" align="right" ><?php 
							echo number_format(round($finalTotal-$totalAdv),2);?> </td>

						</tr>

						<tr style="display: none;">

							<td colspan="6" align="right">Total Paid</td>
							<td class="hidden-480" id="finalTotal" align="right" >

							<input type="hidden" name="total_paid" id="total_paid" style="text-align:right" placeholder="Total Paid" class="form-control" size="10" value="0" required="required"  />

							</td>

						</tr>

						<tr>
							<td colspan="9" align="left" style=" text-align:left;  margin-bottom:-10px;">

								&nbsp;&nbsp;&nbsp; Rs: <?php  echo ucwords(amountToWards(round($finalTotal-$totalAdv))); ?>

							</td>
						<?php } } ?>

						</tr>

						</tbody>

						</table>

					</div>

				</div>

				<div class="row" style="border:1px solid #D6D6D6; margin:10px 0;">

					<div class="col-xs-4">

						<div class="well123" style="background:#ffffff; text-align:justify;">

							<?php if($orderDetails[0]['order_type'] == 'Tax' ){ ?>

							<span style="font-size:7px !important;">Terms & Conditions.<br/>
								We declare that this invoice shows the actual price of the goods described and that all particulars are true and correct.
							  </span>

							<?php } ?>

							<br/><br/> SUBJECT TO <?php echo $firmDetails[0]['firm_jurisdiction']?> JURISDICTION

						</div>

					</div>
					<div class="col-xs-5">

						<div class="well123" style="background:#ffffff; text-align:justify;">

							

							

							<br/><br/>Name:<br/>Contact No:

						</div>

					</div>

					<div class="col-xs-3 invoice-block" style="text-align:right;">

						<div class="well" style="background:#ffffff;">

							<span style="font-weight:bold;">For <?php echo $orderDetails[0]['firm_name']; ?></span><br/><br/><br/><br/>

							<span style="font-weight:bold;">Authorised Signatory</span>

						</div>

					</div>

				</div>

				<div class="row">

					<div class="col-xs-4">
					</div>
					<div class="col-xs-8 invoice-block" style="text-align:right;">
						<!--<a class="btn btn-lg blue hidden-print margin-bottom-5" onClick="javascript:window.print();">

						Print <i class="fa fa-print"></i>

						</a>-->

						 <input name="orderTotal" id="orderTotal" value="<?php echo round($orderTotal); ?>" type="hidden">

						 <input name="finalOrderTotal" id="finalOrderTotal" value="<?php echo round($finalTotal); ?>" type="hidden">

						<?php 

						if($orderDetails[0]['order_status'] == 'Pending' ){

							echo form_submit($arr_submit);

							

							//echo form_submit($arr_save);

						}else if($orderDetails[0]['order_status'] == 'Completed'){ ?>

							<a href="<?php echo base_url();?>orders/add/"><button id="btn" type="button" class="btn green"> Create New Order</button></a>

							<input name="submit_challan" value="Print Invoice" class="btn blue hidden-print" type="submit">
						<?php  } ?>
					</div>
				</div>
			</div>



<?php	echo form_close();	?>		

<?php if($orderDetails[0]['order_status'] == 'Completed123'){
		$locationRediret = "<script type='text/javascript'>
					        window.open('".base_url()."orders/download_invoice/".$order_type."/".$orderDetails[0]['order_id']."', '_blank','width=700, height=700');
					    </script>";
						echo $locationRediret;
} ?>	



			

<!-- END PAGE CONTENT-->