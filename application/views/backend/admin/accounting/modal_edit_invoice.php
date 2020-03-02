<?php
 $sql = "
		select 
			*,
			invd.water_old,
			invd.water_new,
			invd.water_usage,
			invd.water_price,
			invd.total_water_price,
			invd.elect_old,
			invd.elect_new,
			invd.elect_usage,
			invd.elect_price,
			invd.total_elect_price
			
		from invoice inv
		inner join invoice_detail invd on invd.invoice_id = inv.invoice_id 
		where inv.is_paid = 'unpaid'
		and inv.invoice_id = ?
		
	"; 
	
	$result = $this->db->query($sql,array($this->uri->segment(5)))->row();
?> 

<div class="row">
	<div class="col-md-12">
		<div class="panel panel-default panel-shadow" data-collapsed="0">
			<div class="panel-heading">
                <div class="panel-title">Edit Invoice</div>
            </div>
<?php echo form_open(base_url() . 'index.php?admin/invoice/edit_invoice/' , array('class' => 'form-horizontal form-groups-bordered validate', 'enctype' => 'multipart/form-data'));?>

            <input type="hidden" id="water_unit_price" name="water_unit_price" value="<?php echo $result->water_price;?>"/>
            <input type="hidden" id="elect_unit_price" name="elect_unit_price" value="<?php echo $result->elect_price;?>"/>
            <input type="hidden" id="invoice_id" name="invoice_id" value="<?php echo $result->invoice_id;?>"/>
            <input type="hidden" id="room_id" name="room_id" value="<?php echo $result->room_id;?>"/>

            <div class="panel-body"> 
                <input type="hidden" id="next_paid_date" name="next_paid_date" value="<?php echo $result->end_billing_date;?>" />
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Water Price</label>
                        <div class="col-sm-9"><input class="form-control" type="text" readonly value="<?php echo $result->water_price;?>"/></div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Electricity Price</label>
                        <div class="col-sm-9"><input class="form-control" type="text" readonly value="<?php echo $result->elect_price;?>"/></div>
                    </div>
					<div class="form-group">

                        <label class="col-sm-3 control-label">Water</label>
                        <div class="col-sm-2">
                            <input class="form-control" id="water_old" name="water_old" type="text" readonly placeholder="old"
                                   value="<?php echo $result->water_old;?>"/>
                        </div>
                        <div class="col-sm-2">
                            <input class="form-control" id="water_new" name="water_new" type="text" placeholder="new" onkeypress="return isNumberKey(event)"
                                   value="<?php echo $result->water_new;?>"/>
                        </div>
                        <div class="col-sm-2">
                            <input class="form-control" id="water_usage" name="water_usage" type="text" readonly placeholder="usage"
                                   value="<?php echo $result->water_usage;?>"/>
                        </div>
                        <div class="col-sm-3">
                            <input class="form-control" id="water_amount" name="water_amount" type="text" readonly placeholder="total"
                                   value="<?php echo $result->total_water_price;?>"/>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Electricity</label>
                        <div class="col-sm-2">
                            <input class="form-control" id="elect_old" name="elect_old" type="text" readonly placeholder="old"
                                   value="<?php echo $result->elect_old;?>"/>
                        </div>
                        <div class="col-sm-2">
                            <input class="form-control" id="elect_new" name="elect_new" type="text" placeholder="new" onkeypress="return isNumberKey(event)"
                                   value="<?php echo $result->elect_new;?>"/>
                        </div>
                        <div class="col-sm-2">
                            <input class="form-control" id="elect_usage" name="elect_usage" type="text" readonly placeholder="usage"
                                   value="<?php echo $result->elect_usage;?>"/>
                        </div>
                        <div class="col-sm-3">
                            <input class="form-control" id="elect_amount" name="elect_amount" type="text" readonly placeholder="total"
                                   value="<?php echo $result->total_elect_price;?>"/>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Description</label>
                        <div class="col-sm-9">
                            <input class="form-control" name="description" type="text" value="<?php echo $result->description;?>">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-3 control-label">Date</label>
                        <div class="col-sm-9">
                            <input class="datepicker form-control" name="date" data-validate="required" data-message-required="Value Required" type="text"
                                   value="<?php echo date('m/d/Y',strtotime($result->invoice_date));?>"/> Note: this date using for date recording water and electricity usage and issue invoice to whom's staying.
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-sm-5 pull-right">
                            <button type="submit" class="btn btn-info">Edit Invoice</button>
                            <button type="button" class="btn btn-info" data-dismiss="modal">Close</button>
                        </div>
                    </div>

                </form>
		</div>
	</div>
</div>

 <script>
     // calcultion
     $('#water_new').on('input',function(evt){

         var old = $('#water_old').val();
         var ne = $('#water_new').val();

         var usage = parseInt(ne) - parseInt(old);
         $('#water_usage').val(usage);

         var twater = parseInt($('#water_usage').val()) * parseInt($('#water_unit_price').val());
         console.log($('#water_usage').val());
         console.log($('#water_unit_price').val());

         $('#water_amount').val(parseInt($('#water_usage').val()) * parseInt($('#water_unit_price').val()));
         //
         //var t_water = parseInt(usage) * parseInt(_water_price) *parseInt($('#water_usage').val());
         $('#amount_water').val(parseInt($('#water_usage').val()) * parseInt($('#water_unit_price').val()));

     });
     $('#elect_new').on('input',function(evt){
         var old = $('#elect_old').val();
         var ne = $('#elect_new').val();

         var usage = parseInt(ne) - parseInt(old);
         $('#elect_usage').val(usage);
         $('#elect_amount').val(parseInt($('#elect_usage').val()) * parseInt($('#elect_unit_price').val()));
         //
         //var t_elect = parseInt(usage) * parseInt(_elect_price) *parseInt($('#elect_usage').val());
         $('#amount_elect').val(parseInt($('#elect_usage').val()) * parseInt($('#elect_unit_price').val()));

     });
 </script>