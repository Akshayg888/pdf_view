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

 font-size:11px;

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

 margin-top: 15px;

 sheet-size: A5-L;

}

.row {

	

   

}

</style>

<br>

<div class="invoice" style="background-color:#ffffff; ">

				 			

				<div class="col-xs-12" style="text-align:center;">

						<span style="font-size:14px; font-weight:bold;"><?php  echo $orderDetails[0]['firm_name']; ?>&nbsp;</span><br/>

						<?php if($orderDetails[0]['invoice_firm'] == 1){?>

							<div style="text-align:center;">56/1/3 Shop 8, E Wing, Jay Bhagawati Sankul, Ashwini Colony, Samangoan Rd, Nashik Rd, Nashik<br/>

							<strong style="font-weight:bold;">Mobile: </strong>9822843876&nbsp;&nbsp;&nbsp;9823439042&nbsp;&nbsp;<strong style="font-weight:bold;">GST #: <?php echo $firmDetails[0]['gst_num']; ?></strong> </div>  

						 <?php }/*else if($orderDetails[0]['invoice_firm'] == 2){ ?>

						 	<div style="text-align:center;">Plot No 15, Hirawadi Road, Opp. Bhikusa Paper Mill, Old Aadgoan Naka, Panchavati, Nashik-003<br/>

							<strong style="font-weight:bold;">Mobile: </strong>9860431276&nbsp;&nbsp;&nbsp;<strong style="font-weight:bold;">GST #: <?php echo $firmDetails[0]['gst_num']; ?></strong> </div> 

							 

						 <?php } */?>

						</div>

				 

				 <div class="row" style=" border:1px solid #000000; border-bottom:none; margin:5px 0; margin-bottom: 0px!important; margin-top: 0px!important;" >

				    <div class="col-xs-12" style="float:left; border-bottom:1px solid #000000; ">

								 <div class="col-xs-3" style="font-weight:bold; width:35%; text-align:left;">Bill To</div>

								 <div class="col-xs-1" style="font-weight:bold; width:20%;">Tax Invoice</div>

								  

								  

							

					</div>

					<div class="col-xs-6" style="float:left; ">

						<!--<h3>Client:</h3>-->

						<ul class="list-unstyled">

							

							<li>

								 <span style="font-weight:bold;"><?php echo $orderDetails[0]['comp_name']; ?></span>

							</li>

							<li>

								 <?php 

								 

								 	$shippingAddress = $orderDetails[0]['city'];

								 echo nl2br($shippingAddress);

								 ?>

								 

							</li>

							<?php //if($clientInfo[0]['gstin_num'] != '' ){ ?>

							<li>

								<strong style="font-weight:bold;">GST #:</strong> <?php echo $clientInfo[0]['gstin_num']; ?>

							</li>							

							<?php //} ?>

						</ul>

					</div>

					<div class="col-xs-4" style="float:right; ">

						<!--<h3>Client:</h3>-->

						<ul class="list-unstyled">

							

							<li>

								<strong style="font-weight:bold;">Invoice #:</strong> <?php echo $orderDetails[0]['invoice_number']; ?>

							</li>

							<li>

								<strong style="font-weight:bold;">Invoice Date:</strong> <?php echo date('d M Y',strtotime($orderDetails[0]['order_date'])); ?>

							</li>

							<li>

								<strong style="font-weight:bold;">State:</strong> <?php echo 'Maharashtra';//echo $stateName[0]['state_name']; ?>&nbsp;&nbsp;<strong style="font-weight:bold;">State Code:</strong> <?php echo $orderDetails[0]['state_code']; ?>

							</li>

							

							<li>

								<strong style="font-weight:bold;">Destination:</strong> <?php echo 'Nashik';//echo $orderDetails[0]['destination']; ?>

							</li>					

							

						</ul>

					</div>

					

				</div>

				<div class="row" style="border:1px solid #000000; margin:5px 0; margin-bottom: 0px!important; margin-top: 0px!important;" >

					<div >

						<table class="table table-striped" style="margin-bottom:0px;">

						

						<tr>

							

							<th width="22%" style="border-bottom:1px solid #000000; border-right:1px solid #000000;">

								 &nbsp;Description 

							</th>

							<th width="10%" style="border-bottom:1px solid #000000; border-right:1px solid #000000;text-align:center;">

								 &nbsp;HSN # 

							</th>

							<th width="11%" style="border-bottom:1px solid #000000; border-right:1px solid #000000;text-align:center;">

								 Qty

							</th>

							<th width="9%" style="border-bottom:1px solid #000000; border-right:1px solid #000000;text-align:center;">

								 Rate

							</th>

							<th width="11%" style="border-bottom:1px solid #000000; border-right:1px solid #000000;text-align:center;">

								 Gross Amt

							</th>

							<th width="9%" style="border-bottom:1px solid #000000; border-right:1px solid #000000; text-align:center;">

								 SGST  

							</th>

							 

							<th width="9%"  style="border-bottom:1px solid #000000; border-right:1px solid #000000; text-align:center;">

								 CGST  

							</th>

							 

							<th width="7%"   style="border-bottom:1px solid #000000; border-right:1px solid #000000; text-align:center;">

								 IGST

							</th>

							<th width="12%" style="border-bottom:1px solid #000000; text-align:center;">

								Amount

							</th>

							

						</tr>

						

						<?php 

						$cnt= 1;

						

						//$orderTotal = $discountAmt = $forwardingAmt = 0.00;

						$orderTotal = $subTotal = $totalSgst = $totalCgst= $totalIgst = $toatalQty = $toatalAmount = $discountAmt = $forwardingAmt = 0.00;

						foreach($orderProducts as $product){

						 $prodTotal = 0.00;

						 $prodTotal = $product['order_qty']*$product['order_rate'];

						// $orderTotal +=$prodTotal;

						 $toatalAmount +=$prodTotal;

					  ?>

					  

						<tr>

							

							<td align="left" style="border:none; border-right:1px solid #000000;">&nbsp;<?php echo $product['prod_ref_name'];?></td>

							<td align="right" style="border:none; border-right:1px solid #000000;"><?php echo $product['hsn_code'];?></td>

							<td style="border:none; border-right:1px solid #000000;" align="right"><?php echo $product['order_qty'].' '.$product['prod_unit'];?></td>

							<td style="border:none; border-right:1px solid #000000;" align="right"><?php echo $product['order_rate']; ?></td>

							<td style="border:none; border-right:1px solid #000000;" align="right" ><?php echo number_format($prodTotal,2); ?></td>

							<td style="border:none; border-right:1px solid #000000;" width="5%" align="right"><?php echo number_format($product['sgst_per'],2); ?>%&nbsp;</td>							

							

							<?php  

								if($product['sgst_per'] > 0) { 

									$sgstAmt = (($product['sgst_per']*$prodTotal)/100); 

								}else{ $sgstAmt = 0.00; }

								   $totalSgst +=  $sgstAmt;

								   

								 ?>

							<td style="border:none; border-right:1px solid #000000;" width="5%" align="right"><?php echo number_format($product['cgst_per'],2); ?>%&nbsp;</td>

							

							<?php  if($product['cgst_per'] > 0) { $cgstAmt = (($product['cgst_per']*$prodTotal)/100); }else{  $cgstAmt = 0.00; } 

								$totalCgst +=  $cgstAmt;

								 //echo number_format($cgstAmt,2); 

								

								?>

							<td style="border:none; border-right:1px solid #000000;" width="5%" align="right"><?php echo number_format($product['igst_per'],2); ?>%&nbsp;</td>

							

							<?php  if($product['igst_per'] > 0) { $igstAmt = (($product['igst_per']*$prodTotal)/100); }else{ $igstAmt = 0.00; } 

							$totalIgst +=  $igstAmt;

							//echo number_format($igstAmt,2)

							 ?>

							<td  style="border:none; " align="right"><?php echo number_format(($prodTotal+$sgstAmt+$cgstAmt+$igstAmt),2)?></td>

						</tr>

						

					

						<?php 

							//$orderTotal +=$prodTotal+$sgstAmt+$cgstAmt+$igstAmt; 

						     $subTotal +=$prodTotal+$sgstAmt+$cgstAmt+$igstAmt;

							$cnt++;

							

						} ?>

						

						<?php if($cnt <18 ){ 

							

							

						   for($k=$cnt; $k<=18; $k++){ ?>

						   	<tr>

							<td style="border:none; border-right:1px solid #000000;">&nbsp;</td>

							<td style="border:none; border-right:1px solid #000000;">&nbsp;</td>

							<td style="border:none; border-right:1px solid #000000;">&nbsp;</td>

							<td style="border:none; border-right:1px solid #000000;">&nbsp;</td> 

							<td style="border:none; border-right:1px solid #000000;">&nbsp;</td>

							<td style="border:none; border-right:1px solid #000000;">&nbsp;</td>

							<td style="border:none; border-right:1px solid #000000;">&nbsp;</td> 

							<td style="border:none; border-right:1px solid #000000;">&nbsp;</td> 

							<td style="border:none;">&nbsp;</td>

							</tr>

						   

						<?php }

							

						}// EO if ?>
						<?php 
							 $totalSgst = round($totalSgst,2); 
							 $totalCgst = round($totalCgst,2); 
							 $totalIgst = round($totalIgst,2); 
							 $toatalAmount = round($toatalAmount,2); 
							 
							 $orderTotal = $toatalAmount+$totalSgst+$totalCgst+$totalIgst;  ?>

						<!--<tr style="border:solid 0px #ffffff;"><td colspan="9"><br/>&nbsp;</td></tr>-->

					    <tr>

							 

							<td colspan="4" style="  border-right:1px solid #000000; border-top:1px solid #000000; text-align:right">&nbsp;Total&nbsp;</td>

							<td style=" border-right:1px solid #000000; border-top:1px solid #000000; text-align:right;"><?php echo number_format($toatalAmount,2); ?></td>

							<td style=" border-right:1px solid #000000; border-top:1px solid #000000; text-align:right;" ><?php echo number_format($totalSgst,2); ?>&nbsp;</td> 

							<td style=" border-right:1px solid #000000; border-top:1px solid #000000; text-align:right;" ><?php echo number_format($totalCgst,2); ?>&nbsp;</td> 

							<td style=" border-right:1px solid #000000; border-top:1px solid #000000; text-align:right;" ><?php echo number_format($totalIgst,2); ?>&nbsp;</td> 

							<td style=" border-right:1px solid #000000; border-top:1px solid #000000; text-align:right;"><?php  echo number_format($orderTotal,2); ?></td>

						</tr>

						</table>
						<table class="table table-striped" style="margin-bottom:0px;">
						 <tr>
							 
							<td width="11%" style="border-right:1px solid #000000; border-top:1px solid #000000; text-align:right;font-weight:bold;">&nbsp;Taxable Total&nbsp;</td>
							<td width="11%" style=" border-right:1px solid #000000; border-top:1px solid #000000; text-align:right;font-weight:bold;">Total SGST&nbsp;</td>
							<td width="11%" style=" border-right:1px solid #000000; border-top:1px solid #000000; text-align:right;font-weight:bold;">Total CGST&nbsp;</td>
							<td width="11%" style=" border-right:1px solid #000000; border-top:1px solid #000000; text-align:right;font-weight:bold;">Total IGST&nbsp;</td>
							<td width="11%" style=" border-right:1px solid #000000; border-top:1px solid #000000; text-align:right;font-weight:bold;">Round Off &nbsp;</td>
							<td width="11%" style=" border-right:1px solid #000000; border-top:1px solid #000000; text-align:right;font-weight:bold;">Invoice Total&nbsp;</td>
						</tr>
						 <tr>
							 
							<td style="border-right:1px solid #000000; border-top:1px solid #000000; text-align:right"><?php echo number_format($toatalAmount,2); ?></td>
							<td style=" border-right:1px solid #000000; border-top:1px solid #000000; text-align:right;"><?php echo number_format($totalSgst,2); ?>&nbsp;</td>
							<td style=" border-right:1px solid #000000; border-top:1px solid #000000; text-align:right;"><?php echo number_format($totalCgst,2); ?>&nbsp;</td>
							<td style=" border-right:1px solid #000000; border-top:1px solid #000000; text-align:right;"><?php echo number_format($totalIgst,2); ?>&nbsp;</td>
							<td style=" border-right:1px solid #000000; border-top:1px solid #000000; text-align:right;">
							<?php  
							$finalTotal = round((($orderTotal + $forwardingAmt)-$discountAmt),2);
							$finalRoundOff = round($finalTotal);
							// echo $orderTotal.'==>'.$finalTotal.'==>'.$finalRoundOff;
							
							echo round(($finalRoundOff-$finalTotal),2);?>
							&nbsp;</td>
							<td style="  border-right:1px solid #000000; border-top:1px solid #000000; text-align:right"><?php echo number_format(round($finalTotal),2); ?>&nbsp;</td>
						</tr>
						<tr>
							 
							<td colspan="6" style="border-right:1px solid #000000; border-top:1px solid #000000;">&nbsp;&nbsp;&nbsp; Rs: <?php  echo ucwords(amountToWards(round($finalTotal))); ?></td>
						</tr>
						</table>

					</div>

				</div>

				

				

				<div class="row" style="border:1px solid #000000; border-top:none; margin:5px 0;margin-bottom: 0px!important; margin-top: 0px!important;">

					<div class="col-xs-5">

						<div class="well123" style="background:#ffffff; text-align:justify;">

							

							<span style="font-size:7px;"><span style="font-weight:bold;">Terms & Conditions.</span><br/>

							We declare that this invoice shows the actual price of the goods described and that all particulars are true and correct.<br/>SUBJECT TO NASHIK JURISDICTION ONLY<br/></span>

						</div>

					</div>

					<div class="col-xs-5 invoice-block" style="text-align:right;">

						<div class="well123" style="background:#ffffff;">

							

							<span style="font-weight:bold;">For <?php echo $orderDetails[0]['firm_name']; ?></span><br/><br/>

							 

							<span style="font-weight:bold;">Authorised Signatory</span>

						</div>

						

					</div>

				</div>

			</div>

<!-- END PAGE CONTENT-->