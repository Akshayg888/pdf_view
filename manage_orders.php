<div class="page-bar">
    <?php echo $bredcrumbs;?>
</div>
<div class="row">
    <div class="col-md-12"> 
        <div class="portlet box grey-cascade">
            <div class="portlet-title">
                <div class="caption"> <i class="fa fa-globe"></i>Manage Orders</span></div>
                <div class="tools"> <a href="javascript:;" class="collapse"> </a></div>
            </div>
            <div class="portlet-body">
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
                <div class="table-toolbar">
                    <div class="filter-form hidden-xs">
                        <style>
                            .form-inline .input-parent {
                                display: inline-block;
                            }
                            .filter-form .form-control {
                                background-color: #fff;
                                border:1px solid #979797 !important;
                                background-image: none !important;
                            }
                            .beatpicker-clear beatpicker-clearButton button{
                                display:none !important;
                            }
                        </style>
                        <div class="col-md-12">
                            <?php
                            $attributes = array('class' => 'form-inline', 'id' => 'myform');
                            echo form_open('orders/index/',$attributes);
                            ?>
                            <div class="form-group">
                                <label class="control-label">From</label>
                                <div class="input-group input-medium date date-picker" data-date-format="yyyy-mm-dd">
                                    <input type="text" class="form-control" id="fromdate" name="fromdate" required="required" value= "<?php echo $sdate; ?>">
                                    <span class="input-group-btn">
                                        <button class="btn default" type="button"><i class="fa fa-calendar"></i></button>
                                    </span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label">To</label>
                                <div class="input-group input-medium date date-picker" data-date-format="yyyy-mm-dd" >
                                    <input type="text" class="form-control" id="todate" name="todate" required="required" value="<?php echo $todate; ?>">
                                    <span class="input-group-btn">
                                        <button class="btn default" type="button"><i class="fa fa-calendar"></i></button>
                                    </span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label">Client Name</label>
                                <?php echo form_dropdown('client_id',$clientList,$client_id,'class="form-control select2me" tabindex="0" placeholder= "Select Client" id="client_id"');?>
                            </div>
                            <div class="form-group">
                                <input  type="submit" name="submit" value="Filter"   class="btn green"/>
                                <input  type="submit" name="reset" value="Reset"   class="btn btn-wht"/>
                            </div>
                            <?php echo form_close(); ?>
                        </div>
                    </div>
                </div>
                <div class="table-toolbar">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="btn-group" style="float:right;">
                                <a href="<?php echo base_url();?>orders/add/"><span id="sample_editable_1_new" class="btn green"> Add Order <i class="fa fa-plus"></i> </span></a>
                            </div>
                        </div>
                    </div>
                </div>
                <table class="table table-striped table-bordered table-hover" id="sample_2">
                    <thead>
                        <tr>
                            <th width="5%"> Sr.No </th>
                            <th width="10%"> Date </th>
                            <th width="12%"> Order Number</th>
                            <th width="20%"> Customer Name </th>
                            <th width="20%"> Mobile Number </th>
                            <th width="10%"> Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $count_orders = count($ordersArray);

                        if($count_orders > 0)
                        {
                            $k = 1;
                            foreach($ordersArray as $order_row)
                            {
                                $class = 'green';
                                if($order_row['order_status'] == 'Pending'){
                                    $class = 'short';
                                }
                                ?>
                                <tr class="odd gradeX <?php echo $class; ?>" >
                                    <td> <?php echo $k; ?> </td>
                                    <td> <?php echo $order_row['order_date'];?> </td>
                                    <td> <a href="<?php echo base_url();?>orders/view_order/<?php echo $order_row['order_id'];?>" title="View" alt="View"><?php echo $order_row['order_number'] ?></a> </td>
                                    <td> <?php echo $order_row['client_name']; ?> </td>
                                    <td> <?php echo $order_row['mobile_number']; ?> </td>
                                    <td>
                                        <a href="<?php echo base_url();?>orders/view_order/<?php echo $order_row['order_id'];?>" class="btn default btn-xs green" title="view Order" alt="view Order"><i class="fa fa-eye"></i></a>
                                        <?php if ($order_row['order_status'] == 'Pending') {
                                            ?>

                                            <a href="<?php echo base_url();?>orders/edit/<?php echo $order_row['order_id'];?>" class="btn default btn-xs purple" title="Edit Order" alt="Edit Order"><i class="fa fa-edit"></i></a>

                                            <a href="javascript:void(0)" onclick="close_order(<?php echo $order_row['order_id'];?>)" class="btn default btn-xs red" title="Delete Order" alt="Delete Order"><i class="fa fa-trash-o"></i></a>
                                        <?php } ?>
                                    </td> 
                                </tr>
                                <?php  $k++;
                            }
                        }?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="close_order" tabindex="-1" role="basic" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title"> Cancel Order </h4>
            </div>
            <div class="modal-body">
                Are you sure to delete this order?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn default" id="yes"> Yes </button>
                <button type="button" class="btn default" id="no" data-dismiss="modal"> No </button>
            </div>
        </div>
    </div>
</div>
<script src="<?php echo $this->config->item("base_url_asset")?>assets/admin/pages/scripts/users.js"></script>
<script src="<?php echo $this->config->item("base_url_asset")?>assets/admin/pages/scripts/users.js"></script>
<script type="text/javascript">
function close_order(order_id)
{
    $('#close_order').modal();
    $('#close_order #yes').click(function(){
        var url = base_url+'orders/close';
        $.post(url,
        {
            order_id:order_id,
        },function(responseText){
            if(responseText == 1){
                location.href = base_url+'orders';
            } else {
                alert('Something went wrong with you');
            }
        });
    });
}
</script>