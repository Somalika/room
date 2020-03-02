<div class="row">
	<div class="col-md-12">
			
			<ul class="nav nav-tabs bordered">
				<li class="active">
					<a aria-expanded="true" href="#unpaid" data-toggle="tab">
						<span class="hidden-xs">Create Single Invoice</span>
					</a>
				</li>
				<!--li class="">
					<a aria-expanded="false" href="#paid" data-toggle="tab">
						<span class="hidden-xs">Create Mass Invoice</span>
					</a>
				</li-->
			</ul>
			
			<div class="tab-content"> 
				<div class="tab-pane active" id="unpaid">

				<!-- creation of single invoice -->
				<?php echo form_open(base_url() . 'index.php?admin/invoice/create/' , array('class' => 'form-horizontal form-groups-bordered validate ajax-submit', 'enctype' => 'multipart/form-data'));?>
                <input type="hidden" id="room_price" name="room_price" />
                <input type="hidden" id="staying_id" name="staying_id" />
                <input type="hidden" id="water_unit_price" name="water_unit_price" />
                <input type="hidden" id="elect_unit_price" name="elect_unit_price" />
                
                <input type="hidden" id="water_old_date" name="water_old_date" />
                <input type="hidden" id="elect_old_date" name="elect_old_date" />
                <input type="hidden" id="next_paid_date" name="next_paid_date" />
                
                
                
				<div class="row">
					<div class="col-md-6">
	                        <div class="panel panel-default panel-shadow" data-collapsed="0">
	                            <div class="panel-heading">
	                                <div class="panel-title">Invoice Informations</div>
	                            </div>
	                            <div class="panel-body">
	                                
	                                <div class="form-group">
	                                    <label class="col-sm-3 control-label">building</label>
	                                    <div class="col-sm-9">
	                                        <select name="building_id" class="form-control" onchange="return get_building(this.value)">
	                                        	<option value="">Select building</option>
                                                <?php 
													$sql = "
														select * from building
													";
													$result = $this->db->query($sql)->result_array(); 
													foreach($result as $row){
												?>
												<option value="<?php echo $row["building_id"] ?>"><?php echo $row["name"] ?></option>
												<?php }?>
	                                        		                                            
	                                        </select> 
	                                    </div>
	                                </div>

	                                <div class="form-group">
		                                <label class="col-sm-3 control-label">room</label>
		                                <div class="col-sm-9">
		                                    <select name="room_id" class="form-control" style="width:100%;" id="room_selection_holder" onchange="return get_old_usage(this.value)">
		                                        <option value="">Select room First</option>
		                                    	
		                                    </select>
		                                </div>
		                            </div> 
	                                <div class="form-group">
	                                    <label class="col-sm-3 control-label">Water</label>
	                                    <div class="col-sm-2">
	                                        <input class="form-control" id="water_old" name="water_old" type="text" readonly placeholder="old" />
	                                    </div>
                                        <div class="col-sm-2">
	                                        <input class="form-control" id="water_new" name="water_new" type="text" placeholder="new" onkeypress="return isNumberKey(event)"/>
	                                    </div>
                                        <div class="col-sm-2">
	                                        <input class="form-control" id="water_usage" name="water_usage" type="text" readonly placeholder="usage" />
	                                    </div> 
                                        <div class="col-sm-3">
	                                      	<input class="form-control" id="water_amount" type="text" readonly placeholder="total"/>
	                                    </div>
	                                </div>
	                                <div class="form-group">
	                                    <label class="col-sm-3 control-label">Electricity</label>
	                                    <div class="col-sm-2">
	                                        <input class="form-control" id="elect_old" name="elect_old" type="text" readonly placeholder="old" />
	                                    </div> 
                                        <div class="col-sm-2">
	                                        <input class="form-control" id="elect_new" name="elect_new" type="text" placeholder="new" onkeypress="return isNumberKey(event)"/>
	                                    </div>
                                        <div class="col-sm-2">
	                                        <input class="form-control" id="elect_usage" name="elect_usage" type="text" readonly placeholder="usage" />
	                                    </div>
                                        <div class="col-sm-3">
	                                        <input class="form-control" id="elect_amount" type="text" readonly placeholder="total" />
	                                    </div>
	                                </div>
	                                <div class="form-group">
	                                    <label class="col-sm-3 control-label">Description</label>
	                                    <div class="col-sm-9">
	                                        <input class="form-control" name="description" type="text">
	                                    </div>
	                                </div>

	                                <div class="form-group">
	                                    <label class="col-sm-3 control-label">Date</label>
	                                    <div class="col-sm-9">
	                                        <input class="datepicker form-control" name="date" data-validate="required" data-message-required="Value Required" type="text" /> Note: this date using for date recording water and electricity usage and issue invoice to whom's staying.
	                                    </div>
	                                </div>
	                                
	                            </div>
	                        </div>
	                    </div>

	                    <div class="col-md-6">
                        <div class="panel panel-default panel-shadow" data-collapsed="0">
                            <div class="panel-heading">
                                <div class="panel-title">Payment Informations</div>
                            </div>
                            <div class="panel-body">
                                
                                <div class="form-group">
                                    <label class="col-sm-3 control-label">Room price</label>
                                    <div class="col-sm-9">
                                        <input class="form-control" id="amount" name="amount" placeholder="Enter Total Amount" data-validate="required" data-message-required="Value Required" type="text">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-3 control-label">Payment room</label>
                                    <div class="col-sm-9">
                                        <input class="form-control" id="amount_paid" name="amount_paid" placeholder="Enter Payment Amount" data-validate="required" data-message-required="Value Required" type="text">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-3 control-label">Payment water </label>
                                    <div class="col-sm-9">
                                        <input class="form-control" id="amount_water" name="amount_water" placeholder="Enter Payment Amount" data-validate="required" data-message-required="Value Required" type="text">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-3 control-label">Payment elect</label>
                                    <div class="col-sm-9">
                                        <input class="form-control" id="amount_elect" name="amount_elect" placeholder="Enter Payment Amount" data-validate="required" data-message-required="Value Required" type="text">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-3 control-label">Status</label>
                                    <div class="col-sm-9">
                                        <select name="status" class="form-control">
                                            <option value="unpaid">Unpaid</option>
                                            <option value="paid">Paid</option>
                                        </select> 
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-3 control-label">Method</label>
                                    <div class="col-sm-9">
                                        <select name="method" class="form-control">
                                            <option value="1">Cash</option>
                                            <option value="2">Check</option>
                                            <option value="3">Card</option>
                                        </select> 
                                    </div>
                                </div>
                                
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-5">
                                <button type="submit" class="btn btn-info">Add Invoice</button>
                            </div>
                        </div>
                    </div>


	                </div>
	              	</form>
				<!-- creation of single invoice -->
					
				</div>
				
			</div>
			
			
	</div>
</div>

<script type="text/javascript">
 
    function get_building_mass(building_id) {
    	
        $.ajax({
            url: '<?php echo base_url();?>index.php?admin/get_building_mass/' + building_id, 
            success: function(response){
                jQuery('#room_selection_holder_mass').html(response);
            }
        });

        
    } 
	
    function get_building(building_id) {
        $.ajax({
            url: '<?php echo base_url();?>index.php?admin/get_building/' + building_id ,
            success: function(response)
            {
                jQuery('#room_selection_holder').html(response);
            }
        });
    } 
	
    function get_old_usage(room_id) {
        $.ajax({
            url: '<?php echo base_url();?>index.php?admin/get_old_usage/' + room_id ,
            success: function(response)
            { 
				var json =  JSON.parse(response);
                $('#water_old').val(json.water_old_usage);
                $('#water_new').val(json.w_new_usage);
                $('#water_usage').val(json.w_usage_amount);

                //total water
                $('#water_amount').val(parseInt(json.w_usage_amount) * parseInt(json.water_price)+' Riels');
                $('#amount_water').val(parseInt(json.w_usage_amount) * parseInt(json.water_price)+' Riels');

                // elect
                $('#elect_old').val(json.elect_old_usage);
                $('#elect_new').val(json.e_new_usage);
                $('#elect_usage').val(json.e_usage_amount);

                // total elect
                $('#elect_amount').val(parseInt(json.e_usage_amount) * parseInt(json.electricity)+' Riels');
                $('#amount_elect').val(parseInt(json.e_usage_amount) * parseInt(json.electricity) +' Riels');


                $('#room_price').val(json.room_price);
				$('#staying_id').val(json.staying_id);  
				 
				$('#water_unit_price').val(json.water_price); 
				$('#elect_unit_price').val(json.electricity); 
				$('#amount').val(json.room_price +' USD'); 
				$('#amount_paid').val(json.room_price +' USD'); 
				
				 // using for water and electronic
				$('#water_old_date').val(json.water_old_date); 
				$('#elect_old_date').val(json.elect_old_date); 
				// using for room next paid date
				$('#next_paid_date').val(json.next_paid_date); 
				
				
				  
            }
        });
    } 
	
	// calcultion
	$('#water_new').on('input',function(evt){ 
		 
		var old = $('#water_old').val();
		var ne = $('#water_new').val();
		
		var usage = parseInt(ne) - parseInt(old);
		$('#water_usage').val(usage); 

		var twater = parseInt($('#water_usage').val()) * parseInt($('#water_unit_price').val());
		
		$('#water_amount').val(parseInt($('#water_usage').val()) * parseInt($('#water_unit_price').val())+' Riels'); 
		//
		//var t_water = parseInt(usage) * parseInt(_water_price) *parseInt($('#water_usage').val());
		$('#amount_water').val(parseInt($('#water_usage').val()) * parseInt($('#water_unit_price').val())+' Riels');
		 
	});
	$('#elect_new').on('input',function(evt){
		var old = $('#elect_old').val();
		var ne = $('#elect_new').val();
		
		var usage = parseInt(ne) - parseInt(old);
		$('#elect_usage').val(usage);  
		$('#elect_amount').val(parseInt($('#elect_usage').val()) * parseInt($('#elect_unit_price').val()) +' Riels'); 
		//
		//var t_elect = parseInt(usage) * parseInt(_elect_price) *parseInt($('#elect_usage').val());
		$('#amount_elect').val(parseInt($('#elect_usage').val()) * parseInt($('#elect_unit_price').val()) +' Riels');
		
	}); 
	
	
	function select() {
		var chk = $('.check');
			for (i = 0; i < chk.length; i++) {
				chk[i].checked = true ;
			}

		//alert('asasas');
	}
	function unselect() {
		var chk = $('.check');
			for (i = 0; i < chk.length; i++) {
				chk[i].checked = false ;
			}
	}
	
	
	function isNumberKey(evt){
		var charCode = (evt.which) ? evt.which : event.keyCode
		if (charCode > 31 && (charCode < 48 || charCode > 57))
			return false;
		return true;
	}
</script>