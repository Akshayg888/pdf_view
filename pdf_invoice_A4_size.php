<!-- BEGIN PAGE CONTENT-->

<!-- BEGIN GLOBAL MANDATORY STYLES 



<link href="<?php //echo $this->config->item("global_url")?>plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css"/>

<link href="<?php //echo $this->config->item("global_url")?>plugins/simple-line-icons/simple-line-icons.min.css" rel="stylesheet" type="text/css"/>-->

<link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet" type="text/css"/>

<link href="<?php echo $this->config->item("global_url")?>plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>

<link href="<?php echo $this->config->item("global_url")?>plugins/uniform/css/uniform.default.css" rel="stylesheet" type="text/css"/>

<link href="<?php echo $this->config->item("global_url")?>plugins/bootstrap-switch/css/bootstrap-switch.min.css" rel="stylesheet" type="text/css"/>

<!-- END GLOBAL MANDATORY STYLES -->

<!-- BEGIN THEME STYLES -->

<link href="<?php echo $this->config->item("global_url")?>css/components.css" rel="stylesheet" type="text/css"/>



<link href="<?php echo $this->config->item("base_url_asset")?>assets/admin/layout/css/layout.css" rel="stylesheet" type="text/css"/>

<link href="<?php echo $this->config->item("base_url_asset")?>assets/admin/layout/css/themes/default.css" rel="stylesheet" type="text/css" id="style_color"/>



<style>

 hr{

 	margin: 5px 0 !important;

 }

 body {

 background-color:#ffffff;

 font-size:12px;

 font-family: Georgia, FontAwesome;

}

tr.border_bottom th {

  border-bottom:1px solid #000000;

  height:25px;

}

tr.border_top td {

  border-top:1px solid #000000;

}

tr.space_bottom td {

   height:18px;

}

@page {

 margin-left: 10px;

 margin-right: 10px;

 margin-bottom: 10px;

 margin-top: 10px;

 sheet-size: A5;

}

</style>

<div class="invoice" style="background-color:#ffffff; ">

				<div class="row" style="min-height:500px; border:1px solid #000000; margin:0px 0;" >

					<div >

						<table class="table table-striped " style="margin-bottom: 0px;">

						

						<tr>

							<th width="4%" style="border-bottom:1px solid #000000; border-right:1px solid #000000; text-align:center;">

								 SR.

							</th>

							<th width="45%" style="border-bottom:1px solid #000000; border-right:1px solid #000000; text-align:center;">

								 &nbsp;Description 

							</th>

							
							<th width="10%" style="border-bottom:1px solid #000000; border-right:1px solid #000000; text-align:center;">

								 HSN

							</th>

							<th width="10%" style="border-bottom:1px solid #000000; border-right:1px solid #000000; text-align:center;">

								 Quantity

							</th>

							<th width="10%" style="border-bottom:1px solid #000000; border-right:1px solid #000000; text-align:center;">

								 Rate

							</th>
							 

							<th width="9%" style="border-bottom:1px solid #000000; border-right:1px solid #000000; text-align:center;">

								 GST % 

							</th>
							
							 
							<th colspan="2" width="12%" style="border-bottom:1px solid #000000; text-align:center;">

								Amount

							</th>

							

						</tr>

						<br/><br/>

						<?php 

						$cnt= 1;

						//$orderTotal = $discountAmt = $forwardingAmt = 0.00;

					  $orderTotal = $subTotal = $totalSgst = $totalCgst= $totalIgst = $toatalQty = $toatalAmount = $discountAmt = $maxTaxPer = $forwardingAmt = $loadingAmt = $totalGrossAmt = 0.00;

						foreach($orderProducts as $product){ 
						 $prodTotal =  $rowTaxPer = $discountAmt =  0.00;
						 $prodRowTotal = $product['order_qty']*$product['order_rate']; 
						 $rowDiscount = round((($prodRowTotal*$product['discount_per'])/100),2); 
						 $prodTotal = ($prodRowTotal-$rowDiscount); 
						 $toatalAmount +=$prodTotal; 
						 $totalGrossAmt += $totalGrossAmt+$prodRowTotal;
						 $toatalQty += $product['order_qty']; 
						 $gstPer = ($product['sgst_per']+$product['cgst_per']+$product['igst_per']);
					  ?> 

						<tr>

							<td align="center" style="border:none; border-right:1px solid #000000; padding-top:5px; vertical-align:top;font-size:11px;">

							<?php echo $cnt;?></td>

							<td align="left" style="border:none; border-right:1px solid #000000; padding-top:5px; vertical-align:top; padding-left:2px;font-size:11px;"><b style="font-weight: bold;"><?php echo $product['category'];?></b> - <?php echo $product['prod_ref_name'];?><br/><b style="font-weight: bold;">Serial No:</b>  <?php echo $product['serial_no'];?>
							</td>

							<td style="border:none; border-right:1px solid #000000;vertical-align:top; padding-top:5px;font-size:11px;" align="right"><?php echo $product['hsn_code'];?>&nbsp;</td>
							

							<td style="border:none; border-right:1px solid #000000;vertical-align:top; padding-top:5px;font-size:11px;" align="right"><?php echo number_format(trim($product['order_qty']),2).' '.$product['prod_unit'];?>&nbsp;</td>

							<td style="border:none; border-right:1px solid #000000;vertical-align:top; padding-top:5px; font-size:11px;" align="right"><?php echo $product['order_rate']; ?>&nbsp;</td> 
							    

							<td style="border:none; border-right:1px solid #000000;vertical-align:top; padding-top:5px; font-size:11px;" align="right">

							<?php 

							// SGST $

									if($product['sgst_per'] > 0) { $sgstAmt = round((($product['sgst_per']*$prodTotal)/100),2);}else{ $sgstAmt = 0.00; }

									    $totalSgst +=  $sgstAmt;

								    // CGST

									if($product['cgst_per'] > 0) { $cgstAmt = round((($product['cgst_per']*$prodTotal)/100),2);}else{  $cgstAmt = 0.00; } 

										$totalCgst +=  $cgstAmt;

								    // IGST

									if($product['igst_per'] > 0) { $igstAmt = round((($product['igst_per']*$prodTotal)/100),2); }else{ $igstAmt = 0.00; } 

										$totalIgst +=  $igstAmt;

							echo number_format(($product['sgst_per']+$product['cgst_per']+$product['igst_per']),2); ?>%&nbsp;</td>
							
							 

							<td  colspan="2" style="border:none; vertical-align:top; padding-top:5px; font-size:11px;" align="right"><?php echo number_format($prodTotal,2); ?>&nbsp;</td>

						</tr>

						

						<?php 

							 //$orderTotal +=$prodTotal+$sgstAmt+$cgstAmt+$igstAmt; 

						     $subTotal +=$prodTotal+$sgstAmt+$cgstAmt+$igstAmt;

							 $rowTaxPer = $product['sgst_per']+$product['cgst_per']+$product['igst_per']; 

							 if($rowTaxPer > $maxTaxPer ){

								$maxTaxPer = $rowTaxPer;

							 }

							 

							$cnt++;

							

							if( isset($hsnArray[$gstPer]) ){

									$hsnArray[$gstPer]['Taxable_amt'] += $prodTotal;

									$hsnArray[$gstPer]['sgst_per'] = $product['sgst_per'];

									$hsnArray[$gstPer]['sgstAmt'] += $sgstAmt;

									$hsnArray[$gstPer]['cgst_per'] = $product['cgst_per'];

;									$hsnArray[$gstPer]['cgstAmt'] += $cgstAmt;

									$hsnArray[$gstPer]['igst_per'] = $product['igst_per'];

									$hsnArray[$gstPer]['igstAmt'] += $igstAmt;

								}else{

									$hsnArray[$gstPer] = [];

									$hsnArray[$gstPer]['Taxable_amt'] = [];

									$hsnArray[$gstPer]['Taxable_amt'] = $prodTotal;

									$hsnArray[$gstPer]['sgst_per'] = [];

									$hsnArray[$gstPer]['sgst_per'] = $product['sgst_per'];

									$hsnArray[$gstPer]['sgstAmt'] = [];

									$hsnArray[$gstPer]['sgstAmt'] = $sgstAmt;

									$hsnArray[$gstPer]['cgst_per'] = [];

									$hsnArray[$gstPer]['cgst_per'] = $product['cgst_per'];

									$hsnArray[$gstPer]['cgstAmt'] = [];

									$hsnArray[$gstPer]['cgstAmt'] = $cgstAmt;

									$hsnArray[$gstPer]['igst_per'] = [];

									$hsnArray[$gstPer]['igst_per'] = $product['igst_per'];

									$hsnArray[$gstPer]['igstAmt'] = [];

									$hsnArray[$gstPer]['igstAmt'] = $igstAmt;

								}

							

							

						} ?>

						

						<?php 

						

						

						if($cnt <6 ){ 

						   for($k=$cnt; $k<=6; $k++){ ?>

						   	<tr>

							<td style="border:none; border-right:1px solid #000000;padding-top:5px;">&nbsp;<br/>&nbsp;<br/></td>
							<td style="border:none; border-right:1px solid #000000; padding-top:5px;">&nbsp;</td>
							<td style="border:none; border-right:1px solid #000000; padding-top:5px;">&nbsp;</td>
							<td style="border:none; border-right:1px solid #000000; padding-top:5px;">&nbsp;</td>
							<td style="border:none; border-right:1px solid #000000; padding-top:5px;">&nbsp;</td> 
							<td style="border:none; border-right:1px solid #000000; padding-top:5px;">&nbsp;</td> 
							 
							
							<td style="border:none; padding-top:5px;">&nbsp; </td>

							</tr>

						   

						<?php }

							

						}// EO if ?>

						

						 <?php 

							 $totalSgst = round($totalSgst,2); 

							 $totalCgst = round($totalCgst,2); 

							 $totalIgst = round($totalIgst,2); 

							 $toatalAmount = round($toatalAmount,2);  

							 $orderTotal = $toatalAmount+$totalSgst+$totalCgst+$totalIgst;   

							 $extraTax = 0.00;

							 $loadingAmt = $orderDetails[0]['loadingAmt'];

							 $toatalAmount = round(($toatalAmount+$loadingAmt),2); 

							 $extraTax += round((($maxTaxPer* $loadingAmt)/100),2); 

							 $forwardingAmt = $orderDetails[0]['forwardingAmt'];

							 $toatalAmount = round(($toatalAmount+ $forwardingAmt),2); 

							 $extraTax += round((($maxTaxPer* $forwardingAmt)/100),2);

							   
							if($totalSgst > 0){

								$totalSgst += round(($extraTax/2),2);

							}	 
							if($totalCgst > 0){

								$totalCgst += round(($extraTax/2),2);

							} 

							if($totalIgst > 0){
								$totalIgst += round($extraTax,2);
							}

							?>  

						</table>

					</div>

				</div>
				<div class="row" style="display: block;  " >
					<div class="col-xs-12">
						<table class="table table-striped1 " border="0" style="border-left:1px solid #000000; !important; margin-bottom: 0px; padding-bottom: 0px;border-right:1px solid #000000;border-bottom:1px solid #000000;">
						 <?php 

							 

							  

							?> 

						<tr class="border_top">

							<td colspan="6" align="left" width="69%" style=" border:1px solid #000000; border-left:0px;font-weight:bold; border-right:1px solid #000000;" ></td>

							<td  width="20%" colspan="2" align="right" style=" border:1px solid #000000; border-left:0px;border-top:0px;font-weight:bold;" >Forwarding Amount&nbsp;&nbsp;&nbsp;</td>							

							<td  width="12%" class="hidden-480" align="right" style=" border:1px solid #000000; border-left:0px;font-weight:bold; border-right:1px solid #000000;" ><?php 

							 $forwardingAmt = $orderDetails[0]['forwardingAmt'];

							 

							  echo number_format($forwardingAmt,2);

							?>&nbsp;</td>

						</tr>

						<tr class="border_top">
							<?php 
								$count_orders = count($orderDetails);
								if($count_orders > 0)
								{ 
								  foreach($orderDetails as $order_row )
								  { ?>

							
							<td  align="left" style=" border:1px solid #000000; border-left:0px;font-weight:bold;text-align:left; border-right:0px solid #000000;" ><span style="font-weight:bold;">&nbsp; MODE OF PAYMENT</span></td>
							
							 <?php 
							 if($order_row['type'] == 'Finance'){
							 	?>
							<td colspan="5" align="left" style="border:1px solid #000000; border-left:0px;font-weight:bold;text-align:left; border-right:1px solid #000000;"><strong> Finance Company: </strong> <?php echo $order_row['finance_name'];?> </td>

							<?php }elseif($order_row['type'] == 'Bank'){?>
								<td colspan="5" align="left" style="border:1px solid #000000; border-left:0px;font-weight:bold;text-align:left; border-right:1px solid #000000;"><strong> Bank Name </strong> <?php echo $order_row['bank_name'];?> </td>	
							<?php }else{?>

								<td colspan="5" style="border:1px solid #000000; border-left:0px;font-weight:bold;text-align:left; border-right:1px solid #000000;"></td><?php } ?>

							<td colspan="2" align="right" style=" border:1px solid #000000; border-left:0px;font-weight:bold;" >Taxable Amount&nbsp;&nbsp;&nbsp;</td>							

							<td class="hidden-480" align="right" ><?php echo number_format($toatalAmount,2); $subTotal = $orderTotal;?>&nbsp;</td>

						</tr>

						<tr>

							<td  align="left" style=" border:1px solid #000000; border-left:0px; text-align:left; border-right:0px solid #000000;" ><span style="font-weight:bold;">&nbsp;CASH ADVANCE:</span> <?php if($order_row['cash_advance'] == 0){ echo  '-';}else{echo $order_row['cash_advance'];}?>  </td>
							<?php 
							 if($order_row['type'] == 'Finance'){
							 	?>
							<td colspan="5" align="left" style="border:1px solid #000000; border-left:0px;font-weight:bold;text-align:left; border-right:1px solid #000000;"><strong> Delivery Order No: </strong> <?php echo $order_row['do_no'];?> </td>
							<?php }elseif ($order_row['type'] == 'Bank'){
								 	?>
								<td colspan="5" align="left" style="border:1px solid #000000; border-left:0px;font-weight:bold;text-align:left; border-right:1px solid #000000;"><strong> Cheque No: </strong> <?php echo $order_row['cheque_no'];?> </td>	
							 <?php }else{?>
							 	<td colspan="5" style="border:1px solid #000000; border-left:0px;font-weight:bold;text-align:left; border-right:1px solid #000000;"></td><?php } ?>

							<td colspan="2" align="right" style=" border:1px solid #000000; border-left:0px;font-weight:bold;">Output SGST&nbsp;&nbsp;&nbsp;</td>							

							<td class="hidden-480" align="right" style=" border:1px solid #000000; border-right:0px;"><?php  

							if($totalSgst > 0){

								$totalSgst += round(($extraTax/2),2);

							}							

							echo number_format($totalSgst,2);?>&nbsp;</td>

						</tr>

						<tr>

							<td align="left" style=" border:1px solid #000000; border-left:0px;text-align:left ;border-right:0px solid #000000;" ><span style="font-weight:bold;">&nbsp;BANK ADVANCE:</span> <?php if($order_row['bank_advance']==0){echo '-';}else{echo $order_row['bank_advance'];}?> </td>

							<?php 
							 if($order_row['type'] == 'Finance'){
							 	?>
							<td colspan="5" align="left" style="border:1px solid #000000; border-left:0px;font-weight:bold;text-align:left; border-right:1px solid #000000;"><strong>Down Payment: </strong> <?php echo $order_row['downpayment'];?> </td>
							<?php }elseif($order_row['type'] == 'Bank'){?>
							
								<td colspan="5" align="left" style="border:1px solid #000000; border-left:0px;font-weight:bold;text-align:left; border-right:1px solid #000000;"><strong> Reference No: </strong> <?php echo $order_row['ref_no'];?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </td>	
							<?php }else{?>

								<td colspan="5" style="border:1px solid #000000; border-left:0px;font-weight:bold;text-align:left; border-right:1px solid #000000;"></td><?php } ?>
							<td colspan="2" align="right" style=" border:1px solid #000000; border-left:0px;font-weight:bold;">Output CGST&nbsp;&nbsp;&nbsp;</td>							

							<td class="hidden-480" align="right" style=" border:1px solid #000000; border-right:0px;"><?php  

							if($totalCgst > 0){

								$totalCgst += round(($extraTax/2),2);

							}

							echo number_format($totalCgst,2);?>&nbsp;</td>

						</tr>

						<tr>

							<td align="left" style=" border:1px solid #000000; border-left:0px;text-align:left; border-right:0px solid #000000;" ><span style="font-weight:bold;">&nbsp;UPI ADVANCE:</span> <?php if($order_row['upi_advance']==0){ echo '-'; }else{echo $order_row['upi_advance'];}?></td>

							<?php 
							 if($order_row['type'] == 'Finance'){
							 	?>
							<td colspan="5" align="left" style="border:1px solid #000000; border-left:0px;font-weight:bold;text-align:left; border-right:1px solid #000000;"><strong>EMI: </strong> <?php echo $order_row['emi_amount'];?> </td>
							<?php }else{?>	
							<td colspan="5" style="border:1px solid #000000; border-left:0px;font-weight:bold;text-align:left; border-right:1px solid #000000;"></td><?php } ?>

							<td colspan="2" align="right" style=" border:1px solid #000000; border-left:0px;font-weight:bold;">Output IGST&nbsp;&nbsp;&nbsp;</td>							

							<td class="hidden-480" align="right" style=" border:1px solid #000000; border-right:0px;"><?php  

							if($totalIgst > 0){

								$totalIgst += round($extraTax,2);

							}

							echo number_format($totalIgst,2);?>&nbsp;</td>

						</tr>

						

						

				

						<tr>

							<td  align="left" style=" border:1px solid #000000;border-left:0px; text-align:left; border-right:0px solid #000000;" ><span style="font-weight:bold;">&nbsp;COD ADVANCE:</span> <?php if($order_row['cod_advance'] == 0){ echo '-'; }else{ echo $order_row['cod_advance'];}?></td>

							<?php 
							 if($order_row['type'] == 'Finance'){
							 	?>
							<td colspan="5" align="left" style="border:1px solid #000000; border-left:0px;font-weight:bold;text-align:left; border-right:1px solid #000000;"><strong>Tenure: </strong> <?php echo $order_row['tenor'];?>&nbsp;<strong>Scheme: </strong> <?php echo $order_row['scheme'];?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;  </td>
							<?php }else{?>	
							<td colspan="5" style="border:1px solid #000000; border-left:0px;font-weight:bold;text-align:left; border-right:1px solid #000000;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td><?php } ?>



							<td colspan="2" align="right" style=" border:1px solid #000000; border-left:0px;font-weight:bold;">Round Off&nbsp;&nbsp;&nbsp;</td>							

							<td class="hidden-480" align="right" style=" border:1px solid #000000; border-right:0px;">

							<?php

							$finalTotal = round(((($orderTotal + $forwardingAmt+$loadingAmt+$extraTax)-$discountAmt)-$orderDetails[0]['amount']),2);

							$finalRoundOff = round($finalTotal);

							// echo $orderTotal.'==>'.$finalTotal.'==>'.$finalRoundOff;

							

							echo round(($finalRoundOff-$finalTotal),2); ?>&nbsp;</td>

						</tr>

						<?php 
								$totalAdv=round(($order_row['cod_advance']+$order_row['cash_advance']+$order_row['upi_advance']+$order_row['bank_advance']),2);


						?>
						<tr>
							<td colspan="6" align="left" style=" border:1px solid #000000;border-left:0px; text-align:left; border-right:1px solid #000000;" ><span style="font-weight:bold;">&nbsp;
							<td colspan="2" align="right" style=" border:1px solid #000000; border-left:0px;font-weight:bold;">Advance Amount&nbsp;&nbsp;&nbsp;</td>	

							<td style="border-bottom:1px solid #000000; font-weight:bold; " id="finalTotal" align="right">
								<?php echo $totalAdv; /*$orderDetails[0]['advance_amount']*/ ?>
							</td>
						</tr>

						<tr>
							<td colspan="6" align="left" style=" border:1px solid #000000;border-left:0px; text-align:left; border-right:1px solid #000000;" ><span style="font-weight:bold;">&nbsp;
							<td colspan="2" align="right" style=" border:1px solid #000000; border-left:0px;font-weight:bold;">Exchange Amount&nbsp;&nbsp;&nbsp;</td>	

							<td style="border-bottom:1px solid #000000; font-weight:bold; " id="finalTotal" align="right">
								<?php echo $orderDetails[0]['amount'] ?>
							</td>
						</tr>

					    <tr class="border_top" >

						<td colspan="6" align="left" style=" border:none; border-bottom:1px solid #000000; border-left:0px;  border-right:1px solid #000000;" ></td>

							<td colspan="2" style="border-bottom:1px solid #000000; border-left:0px; border-right:1px solid #000000; font-weight:bold;" align="right">Total&nbsp;&nbsp;&nbsp;</td>							

							<td style="border-bottom:1px solid #000000; font-weight:bold; " id="finalTotal" align="right"><?php 

							$finalTotal = ($orderTotal + $forwardingAmt+$loadingAmt+$extraTax)-$discountAmt-$orderDetails[0]['amount']-$orderDetails[0]['advance_amount'];

							

							echo number_format(round($finalTotal),2);?>&nbsp;</td>
						

						</tr>

						<tr class="space_bottom">

							<td colspan="9" align="left" style=" text-align:left;  margin-bottom:-10px; font-weight:bold;">

								&nbsp;&nbsp;&nbsp; Rs: <?php  echo ucwords(amountToWards(round($finalTotal))); ?>

							</td>
						<?php } } ?>
						</tr> 	 
						</table>
					</div>
				</div>
				<div class="row" style="min-height:500px; border:1px solid #000000; border-bottom:none; margin:10px 0;">

					<div>

						<table class="table table-striped" style="margin:0; padding:">

						<tr class="border_bottom">

									

									<th width="20%" style="border-bottom:1px solid #000000; border-right:1px solid #000000; text-align:center;">

										 &nbsp;GST % 

									</th>

									<th width="20%" style="border-bottom:1px solid #000000; border-right:1px solid #000000; text-align:center;">

										 Taxable Value

									</th>

									<th width="20%" colspan="2" style="border-bottom:1px solid #000000; border-right:1px solid #000000; text-align:center;">

										 SGST  

									</th>

									 

									<th width="20%"   colspan="2"  style="border-bottom:1px solid #000000; border-right:1px solid #000000; text-align:center;">

										 CGST  

									</th>

									 

									<th width="20%"  colspan="2"  style="border-bottom:1px solid #000000; text-align:center;">

										 IGST

									</th>

									

								</tr>

								<tr>

									<td width="10%" style="border-bottom:1px solid #000000; text-align:center;">&nbsp;

										  

									</td>

									<td width="10%" style="border-bottom:1px solid #000000; text-align:center;">&nbsp;

										 

									</td>

									<td width="10%" style="border-bottom:1px solid #000000; text-align:center;  border-right:1px solid #000000; font-weight:bold;">

										 Rate 

									</td>

									<td width="10%"  style="border-bottom:1px solid #000000; text-align:center;font-weight:bold;  border-right:1px solid #000000;">

										 Amount 

									</td>

									<td width="10%"  style="border-bottom:1px solid #000000; text-align:center;font-weight:bold;  border-right:1px solid #000000;">

										 Rate 

									</td>

									<td width="10%"  style="border-bottom:1px solid #000000; text-align:center;font-weight:bold;  border-right:1px solid #000000;">

										 Amount 

									</td>

									<td width="10%"  style="border-bottom:1px solid #000000; text-align:center;font-weight:bold;  border-right:1px solid #000000;">

										 Rate 

									</td>

									<td width="10%"  style="border-bottom:1px solid #000000; text-align:center;font-weight:bold;">

										 Amount 

									</td>

									 

									

								</tr>

							 

								<?php

								foreach($hsnArray as $hsncod => $hsnAr){

									//print_r($hsnAr); die;

									?>

									<tr>

										<td align="right" style="border:1px solid #000000; border-left:0px;text-align:right;">

											<?php

												echo $hsncod;

											?>&nbsp;%&nbsp;&nbsp;

										</td>

										<td align="right" style="border:1px solid #000000; border-left:0px; text-align:right;">

											<?php

												echo number_format($hsnAr['Taxable_amt'], 2);

											?>&nbsp;

										</td>

										<td align="right" style="border:1px solid #000000; border-left:0px; text-align:right;">

											<?php

												echo $hsnAr['sgst_per'];

											?>%&nbsp;

										</td>

										<td align="right" style="border:1px solid #000000; border-left:0px;text-align:right;">

											<?php

												echo number_format($hsnAr['sgstAmt'],2);

											?>&nbsp;

										</td>

										<td align="right" style="border:1px solid #000000; border-left:0px;text-align:right;">

											<?php

												echo $hsnAr['cgst_per'];

											?>%&nbsp;

										</td>

										<td align="right" style="border:1px solid #000000; border-left:0px; text-align:right;">

											<?php

												echo number_format($hsnAr['cgstAmt'],2);

											?>&nbsp;

										</td>

										<td align="right" style="border:1px solid #000000; border-left:0px;text-align:right;">

											<?php

												echo $hsnAr['igst_per'];

											?>%&nbsp;

										</td>

										<td align="right" style="border:1px solid #000000; border-left:0px; text-align:right;">

											<?php

												echo number_format($hsnAr['igstAmt'],2);

											?>&nbsp;

										</td>

									</tr>

									<?php

								}

								?>

							</tbody>

						</table>	

					</div>

				</div>
				<div class="row" style="border:1px solid #000000; margin:0px 0;">

					<div class="col-xs-7" style="padding-right: 2px;">

						<div class="well123" style="background:#ffffff; text-align:justify;">

							

							<span style="font-size:11px;"><span style="font-weight:bold;">Terms & Conditions.</span><br/>

							<ul class="list-unstyled" style="font-size:9px;">
						  
							<li>
								<strong style="font-weight:bold;">1) Goods once sold will not be taken back.</strong>
							</li>
							<li>
								<strong style="font-weight:bold;">2) Interest @18%p.a. will be charged if the payment is not made with in the stipulated time.</strong>
							</li> 
							
							  
							<li>
								<strong style="font-weight:bold;">3) Subject to 'Nashik' Jurisdiction only.</strong>
							</li>
							<li>
								<strong style="font-weight:bold;">4) Warranty will be given by as per company rules</strong>
							</li>
							 <li>
								<strong style="font-weight:bold;">5) No responsibility for any loans of breakage in transit</strong>
							</li>
							<li>
								<strong style="font-weight:bold;">6) Cheque return charges Rs.500/- extra.</strong>
							</li> 
							 
						</ul></span> <br/>Subject To <?php echo $firmDetails[0]['firm_jurisdiction']?> Jurisdiction.<br/>
							 <span style="font-weight: bold;">Payment Term: </span>Advance<br/>
							 <span style="font-weight: bold;">Goods sold will not be taken back </span>

						</div>

					</div>

					<div class="col-xs-4" style="float: right;">

						<div class="well123" style="background:#ffffff;text-align:right;">

							<span style="font-weight:bold;">For <?php echo $orderDetails[0]['firm_name']; ?><br/><br/><br/></span> 

							<span style="font-weight:bold;">Authorised Signatory</span>

						</div> 
					</div>

				</div>

			</div>

<!-- END PAGE CONTENT-->