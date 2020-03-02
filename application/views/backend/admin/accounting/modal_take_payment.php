<?php
 $sql = "
		select 
			* 
		from invoice inv
		inner join staying s on s.room_id = inv.room_id
		where inv.is_paid = 'unpaid'
		and inv.room_id = ?
		
	"; 
	
	$result = $this->db->query($sql,array($this->uri->segment(5)))->row();
	 
?>
<div class="row">
	<div class="col-md-12">
        <div class="panel panel-default panel-shadow" data-collapsed="0">
            <div class="panel-heading">
                <div class="panel-title">Payment History</div>
            </div>
            <div class="panel-body">
                
                <table class="table table-bordered">
                	<thead>
                		<tr>
                			<td>Room Amount</td>
                			<td>Water Amount</td>
                			<td>Elect Amount</td>
                			<td>Date</td>
                		</tr>
                	</thead>
                	<tbody>
                	     <tr>
                			<td align="right"><?php echo $result->room_amount;?> USD</td>
                			<td align="right"><?php echo number_format($result->water_amount,0);?> Riels</td>
                			<td align="right"><?php echo number_format($result->elect_amount,0);?> Riels</td>
                			<td align="center"><?php echo date('d M, Y',strtotime($result->invoice_date));?></td>
                		</tr>
                    </tbody>
                </table>
                
            </div>
        </div>
    </div>
</div>

<div class="row">
	<div class="col-md-12">
		<div class="panel panel-default panel-shadow" data-collapsed="0">
			<div class="panel-heading">
                <div class="panel-title">Take Payment</div>
            </div>
            <div class="panel-body"> 
<?php echo form_open(base_url() . 'index.php?admin/invoice/take_payment' , array('class' => 'form-horizontal form-groups-bordered validate', 'enctype' => 'multipart/form-data'));?>
 
                <input type="hidden" id="next_paid_date" name="next_paid_date" value="<?php echo $result->end_billing_date;?>" />
                
					<div class="form-group">
		                <label class="col-sm-3 control-label">Room Amount</label>
		                <div class="col-sm-6">
		                    <input class="form-control" name="room_amount" value="<?php echo $result->room_amount;?>" readonly type="text">
		                </div>
		            </div>

		            <div class="form-group">
		                <label class="col-sm-3 control-label">Water Amount</label>
		                <div class="col-sm-6">
		                    <input class="form-control" name="water_amount" value="<?php echo $result->water_amount;?>" readonly type="text">
		                </div>
		            </div>

		            <div class="form-group">
		                <label class="col-sm-3 control-label">Elect Amount</label>
		                <div class="col-sm-6">
		                    <input class="form-control" name="elect_amount" value="<?php echo $result->elect_amount;?>" readonly type="text">
		                </div>
		            </div> 

		            <div class="form-group">
                        <label class="col-sm-3 control-label">Method</label>
                        <div class="col-sm-6">
                            <select style="display: none;" name="method" class="form-control selectboxit visible">
                                <option value="1">Cash</option>
                                <option value="2">Check</option>
                                <option value="3">Card</option>
                            </select> 
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-3 control-label">Status</label>
                        <div class="col-sm-6">
                            <select style="display: none;" name="status" class="form-control selectboxit visible">
                                <option value="paid">Paid</option>
                                <option value="unpaid">Unpaid</option>
                            </select> 
                        </div>
                    </div>

                    <div class="form-group">
	                    <label class="col-sm-3 control-label">Date</label>
	                    <div class="col-sm-6">
	                        <input class="datepicker form-control" name="timestamp" data-validate="required" data-message-required="Value Required" type="text" />
                            Note: this date using for paid on invoice to whom's staying.
	                    </div>
					</div>

                    <input name="invoice_id" value="<?php echo $result->invoice_id?>" type="hidden">
                    <input name="room_id" value="<?php echo $result->room_id?>" type="hidden">
                    <input name="title" value="<?php echo $result->title?>" type="hidden">
                    <input name="description" value="<?php echo $result->description?>" type="hidden">

		            <div class="form-group">
		                <div class="col-sm-5">
		                    <button type="submit" class="btn btn-info">Take Payment</button>
		                </div>
		            </div>

				</form>			</div>
		</div>
	</div>
</div>

 