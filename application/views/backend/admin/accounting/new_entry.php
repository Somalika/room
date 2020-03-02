<div class="row">
	<div class="col-md-12">
		<div class="panel panel-primary" data-collapsed="0">
        	<div class="panel-heading">
            	<div class="panel-title" >
            		<i class="entypo-plus-circled"></i>
					<?php echo get_phrase('new_entry');?>
            	</div>
            </div>
			<div class="panel-body"> 
                <?php echo form_open(base_url() . 'index.php?admin/entry/create' , array('class' => 'form-horizontal form-groups-bordered validate','target'=>'_top'));?>
                  <div class="padded">
                        <input type="hidden" name="room_id" value="<?php echo $this->uri->segment(7);?>" />
                        <input type="hidden" name="staying_id" value="<?php echo $this->uri->segment(9);?>" />
                    <div class="form-group">
						<label for="field-2" class="col-sm-3 control-label"><?php echo get_phrase('room');?></label> 
						<div class="col-sm-5">
							<input type="text" name="room_name"  readonly class="form-control" value="<?php echo str_replace('%20',' ',$this->uri->segment(5));?>" />
						</div> 
					</div>
                    <div class="form-group">
						<label for="field-2" class="col-sm-3 control-label"><?php echo get_phrase('type');?></label>
                        
						<div class="col-sm-5">
							<select name="type_id" class="form-control selectboxit" onChange="onTypeChange(this.value);">
                              <option value=""><?php echo get_phrase('select');?></option> 
                              <?php 
                                    $sql = "
                                        select * from type where status = 1
                                    ";
                                    $result = $this->db->query($sql)->result_array(); 
                                    foreach($result as $row){
										if($row["type_id"]== $this->uri->segment(6)){
											$selected = " selected";
										}else{
											$selected = "";
										}
                                ?>
                                <option value="<?php echo $row["type_id"] ?>" <?php echo $selected;?> ><?php echo $row["type_name"] ?></option>
                                <?php }?>
								 
                          </select>
						</div> 
					</div> 
                    <div class="form-group">
                        <label class="col-sm-3 control-label"><?php echo get_phrase('old_usage');?></label>
                        <div class="col-sm-5">
                            <input type="text" class="form-control" name="old_usage" readonly value="<?php echo $this->uri->segment(8);?>"/>
                        </div>
                    </div>  
                    <div class="form-group">
                        <label class="col-sm-3 control-label"><?php echo get_phrase('new_usage');?></label>
                        <div class="col-sm-5">
                            <input type="text" class="form-control" name="new_usage"/>
                        </div>
                    </div>  
                     
                    <div class="form-group">
                        <label class="col-sm-3 control-label"><?php echo get_phrase('date_entry');?></label>
                        <div class="col-sm-5">
                            <input type="text" class="form-control datepicker fill-up" name="date_entry" value="<?php echo date('m/d/Y')?>"/>
                        </div>
                    </div>  
                    
                    <div class="form-group">
                      <div class="col-sm-offset-3 col-sm-5">
                          <button type="submit" class="btn btn-info"><?php echo get_phrase('add_usage');?></button>
                      </div>
                    </div>
                    </form>  
            </div>
        </div>
    </div>
</div>

<script>
 

	$( "#room_name" ).autocomplete({
		source: function(request, response) {
              $.ajax({ 
		  		url		: "<?php echo base_url();?>index.php?auto/name_lookup",
                data	: {
                    	'<?php echo $this->security->get_csrf_token_name(); ?>':'<?php echo $this->security->get_csrf_hash(); ?>', 
                    	forwhom_auto: $("#room_name").val()
                },
                dataType: "json",
                type	: "POST",
                success: function(data){ 
				  response(data);
                }
            });
        },
        minLength: 2,
        select: 
             function(event, ui) {   
                  
       }  
     });
</script>