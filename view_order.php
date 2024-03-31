<style>
    td {
        padding: 3px !important;
        text-align:right;
    }

    body {
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
echo form_open_multipart('orders/view_order/'.$orderDetails[0]['order_id'],$attributes);

$arr_submit = array(
    'name' => 'submit',
    'value' => 'Confirm Order',
    'class' => 'btn green'
);  

$arr_save = array(
    'name' => 'submit',
    'value' => 'Print Order',
    'class' => 'btn blue'
);  
?>
<div class="invoice">
    <div class="row invoice-logo" style="text-align:center;" >
        <div class="col-xs-12 invoice-logo-space">
            <div class="col-xs-12">
                <strong style="font-size:14px; font-weight:bold;"> Order </strong>
            </div>
            <div class="col-xs-12">
                <span style="font-size:30px; font-weight:bold; text-transform:uppercase;"><?php  echo $orderDetails[0]['disply_name']; ?>&nbsp;</span><br/>
                <span style="text-align:center; font-weight:bold;"></span><?php echo $firmDetails[0]['firm_address']; ?><br/>
                <strong style="font-weight:bold;">GST No:</strong> <?php echo $firmDetails[0]['gst_num']; ?>&nbsp;&nbsp;&nbsp;
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
            <ul class="list-unstyled">
                <li>
                    <strong>M/S. <?php echo $orderDetails[0]['contact_person']; ?>   </strong>
                </li>
                <li>
                    <strong>Contact : </strong>
                    <?php
                    $address = $orderDetails[0]['shipping_address'];
                    if ($orderDetails[0]['shipping_address'] == '') {
                        $address = $orderDetails[0]['billing_address'];
                    }
                    echo nl2br($address);
                    ?>
                </li>
                <li>
                    <span><?php echo $orderDetails[0]['mobile_number']; ?> </span>
                </li>
                <li>
                    <strong>Email:</strong> <?php echo $orderDetails[0]['email']; ?>
                </li>
            </ul>
        </div>
        <div class="col-xs-4 invoice-payment">
            <ul class="list-unstyled">
                <li>
                    <strong>Order Number:</strong> <?php echo $orderDetails[0]['order_number']; ?>
                </li>  
                <li>
                    <strong>Order Date:</strong> <?php echo date('d M Y',strtotime($orderDetails[0]['order_date'])); ?>
                </li> 
            </ul>
        </div>
    </div>
    <div class="row" style="min-height:500px;">
        <div class="col-xs-12">
            <table class="table table-bordered" border="0">
                <thead>
                    <tr>
                        <th width="5%" style="border-bottom:1px solid #DDDDDD; text-align:center;"> Sr. No. </th>
                        <th width="20%" style="border-bottom:1px solid #DDDDDD; text-align:center;"> Product Name </th>
                        <th width="10%" style="border-bottom:1px solid #DDDDDD; text-align:center;"> QTY </th>
                        <th width="10%" style="border-bottom:1px solid #DDDDDD; text-align:center;"> Unit </th>
                        <th width="10%" style="border-bottom:1px solid #DDDDDD; text-align:center;"> Price / Unit </th> 
                        <th width="10%" style="border-bottom:1px solid #DDDDDD; text-align:center;"> Total Amt </th>
                        <th width="12%" style="border-bottom:1px solid #DDDDDD; text-align:center;"> Disc. Amt %  </th>
                        <?php if ($orderDetails[0]['is_gst'] == 'yes') { ?>
                            <th width="10%" style="border-bottom:1px solid #DDDDDD; text-align:center;"> GST Amt % </th>
                        <?php }?> 
                        <th width="12%" style="border-bottom:1px solid #DDDDDD; text-align:center;"> Final Amt </th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $cnt= 1;
                    $orderTotal = $subTotal = $toatalQty = $finalTotalAmount = $totalDiscountAmt = $maxTaxPer = $forwardingAmt = $loadingAmt = $totalQty = $totalgstAmt = $gstAmt = $col = 0.00;

                    foreach($orderProducts as $product){

                        $finalTotal = $discountAmt =  0.00;
                        $prodRowTotal = $product['product_qty'] * $product['product_rate'];
                        $rowDiscount = round((($prodRowTotal * $product['product_discount'])/100),2); 
                        $totalDiscountAmt += $rowDiscount;
                        $finalTotal = ($prodRowTotal-$rowDiscount); 
                        $toatalQty += $product['product_qty'];
                        ?>
                        <tr>
                            <td align="right"><?php echo $cnt;?> &nbsp; </td>
                            <td style="text-align: left;">&nbsp; &nbsp;<?php echo $product['product_name'];?> &nbsp; </td>
                            <td align="right"><?php echo $product['product_qty'];?></td>
                            <td style="text-align: left;"> &nbsp; &nbsp;<?php echo $product['product_unit'];?>&nbsp;</td>
                            <td class="hidden-480"  align="right"><?php echo $product['product_rate']; ?>&nbsp;</td>  
                            <td class="hidden-480"  align="right"><?php echo $prodRowTotal; ?> &nbsp;</td>
                            <td class="hidden-480"  align="right"><?php echo $product['product_discount']; ?> &nbsp;</td>
                            <?php if ($orderDetails[0]['is_gst'] == 'yes') { 
                                $col = 1;
                                $gstPer = ($product['sgst_per'] + $product['cgst_per'] + $product['igst_per']);
                                $gstAmt = ($finalTotal*($gstPer/100));
                                $finalTotal = ($finalTotal + $gstAmt);
                            ?>
                                <td class="hidden-480" align="right"><?php echo number_format(($gstPer),2); ?>  &nbsp; </td>
                            <?php }?>
                            <td class="hidden-480" align="right"><?php echo number_format(($finalTotal),2)?> &nbsp;</td>
                        </tr>
                        <?php
                        $totalgstAmt += $gstAmt; 
                        $finalTotalAmount += $finalTotal; 
                        $totalQty = $totalQty + $product['product_qty'];
                        $subTotal += $prodRowTotal;
                        $cnt++;
                    } ?>


                    <?php if($cnt < 18 ){
                        for($k=$cnt; $k<=18; $k++){ ?>

                            <tr>
                                <td style="border:none; border-right:1px solid #DDDDDD;">&nbsp;</td> 
                                <td style="border:none; border-right:1px solid #DDDDDD;">&nbsp;</td>
                                <td style="border:none; border-right:1px solid #DDDDDD;">&nbsp;</td>
                                <?php if ($orderDetails[0]['is_gst'] == 'yes') { ?>
                                    <td style="border:none; border-right:1px solid #DDDDDD;">&nbsp;</td>
                                <?php }?>
                                <td style="border:none; border-right:1px solid #DDDDDD;">&nbsp;</td>
                                <td style="border:none; border-right:1px solid #DDDDDD;">&nbsp;</td>
                                <td style="border:none; border-right:1px solid #DDDDDD;">&nbsp;</td>
                                <td style="border:none; border-right:1px solid #DDDDDD;">&nbsp;</td>
                            </tr>
                        <?php }
                    } ?>
                    <?php 
                    $finalTotalAmount = round($finalTotalAmount,2);  
                    $orderTotal = $finalTotalAmount;
                    ?>  

                    <tr>
                        <td colspan="2" align="right"> Total </td>              
                        <td align="right"> <?php echo $totalQty; ?></td>              
                        <td colspan="<?php echo (4 + $col); ?>" align="right"> Sub Total </td>              
                        <td class="hidden-480" id="subTotal" align="right" ><?php 
                        echo number_format(round($subTotal),2);?> </td>
                    </tr>
                    <tr>
                        <td colspan="<?php echo (7 + $col); ?>" align="right"> Total Discount </td>              
                        <td class="hidden-480" id="totalDiscountAmt" align="right" ><?php 
                        echo number_format(round($totalDiscountAmt),2);?> </td>
                    </tr>
                    <?php if ($orderDetails[0]['is_gst'] == 'yes') {
                        ?>
                        <tr>
                            <td colspan="<?php echo (7 + $col); ?>" align="right"> Total GST </td>              
                            <td class="hidden-480" id="totalgstAmt" align="right"> <?php 
                            echo number_format(round($totalgstAmt),2);?> </td>
                        </tr>
                    <?php } ?>
                    <tr>
                        <td colspan="<?php echo (7 + $col); ?>" align="right"> Final Amount </td>              
                        <td class="hidden-480" id="finalTotalAmount" align="right">
                            <input type="hidden" name="order_total_amount" id="order_total_amount" value="<?php echo round($finalTotalAmount); ?>">
                        <?php echo number_format(round($finalTotalAmount),2);?> </td>
                    </tr>
                    <?php if ($orderDetails[0]['order_status'] == 'Pending') {
                        ?>
                        <tr>
                            <td colspan="<?php echo (7 + $col); ?>" align="right"> Paid Amount </td>              
                            <td class="hidden-480" id="paidTotalAmount" align="right"><input type="number" name="paid_amount" id="paid_amount" value="" class="form-control" required="required" min="0" max = "<?php echo round($finalTotalAmount); ?>"> </td>
                        </tr>
                    <?php }elseif($orderDetails[0]['order_status'] == 'Completed'){
                        ?>
                        <tr>
                            <td colspan="<?php echo (7 + $col); ?>" align="right"> Paid Amount </td>              
                            <td class="hidden-480" id="paidTotalAmount" align="right"><?php echo number_format(round($orderDetails[0]['paid_amount']),2);?> </td>
                        </tr>
                    <?php } ?>
                    
                    <?php if ($orderDetails[0]['order_status'] == 'Pending') {
                        ?>
                        <tr>
                            <td colspan="<?php echo (7 + $col); ?>" align="right"> Pending Amount </td>              
                            <td class="hidden-480" align="right"> <input type="number" class="form-control" name="pending_amount" id="pending_amount" value="" readonly> </td>
                        </tr>
                    <?php }elseif($orderDetails[0]['order_status'] == 'Completed'){
                        ?>
                        <tr>
                            <td colspan="<?php echo (7 + $col); ?>" align="right"> Pending Amount </td>              
                            <td class="hidden-480" align="right"><?php echo number_format(round($orderDetails[0]['pending_amount']),2);?> </td>
                        </tr>
                    <?php } ?>

                    <tr>
                        <td colspan="<?php echo (8 + $col); ?>" align="left" style=" text-align:left;  margin-bottom:-10px; height: 25px;">
                            &nbsp;&nbsp;&nbsp; Rs: <?php  echo ucwords(amountToWards(round($finalTotalAmount))); ?>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
    <div class="row" style="border:1px solid #D6D6D6; margin:10px 0;">
        <div class="col-xs-9">
            <div class="well123" style="background:#ffffff; text-align:justify;"> 
                <span > We declare that this order shows the actual price of the goods described and that all particulars are true and correct.<br/><br/>
                    
                    <b style="font-weight: bold;"></b> 
                </span> 
                <br/><br/> SUBJECT TO NASIK JURISDICTION          
            </div>
        </div>
        <div class="col-xs-3 invoice-block" style="text-align:right;">
            <div class="well" style="background:#ffffff;">
                <span style="font-weight:bold;"> For <?php echo $firmDetails[0]['disply_name']; ?> </span><br/><br/><br/><br/>
                <span style="font-weight:bold;">Authorised Signatory</span>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-xs-4"> </div>
        <div class="col-xs-8 invoice-block" style="text-align:right;">
            <?php
            if($orderDetails[0]['order_status'] == 'Pending' ){
                echo form_submit($arr_submit);
            }else if($orderDetails[0]['order_status'] == 'Completed'){

                echo form_submit($arr_save);
            } ?>
        </div>
    </div>
</div>
<?php echo form_close();  ?>
<script type="text/javascript">
    $('#paid_amount').change(function(){
        var paid_amount = parseInt($('#paid_amount').val());
        var order_total_amount = parseInt($('#order_total_amount').val());
        
        if(paid_amount <= order_total_amount) {
            var pending_amount = order_total_amount - paid_amount;
            $('#pending_amount').val(pending_amount);
        }else{
            $('#pending_amount').val('');
            alert('Enter Paid Amount is less than Final Amount');
        }
    });
</script>