<div class="row">
	<div class="col-md-12">
		<div class="panel panel-primary" data-collapsed="0">
        	<div class="panel-heading">
            	<div class="panel-title" >
            		<i class="entypo-plus-circled"></i>
					<?php echo get_phrase('add_new_room');?>
            	</div>
            </div>
			<div class="panel-body">
				
                <?php echo form_open(base_url() . 'index.php?admin/rooms/create/' , array('class' => 'form-horizontal form-groups-bordered validate', 'enctype' => 'multipart/form-data'));?>
	
					<div class="form-group">
						<label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('name');?></label>
                        
						<div class="col-sm-5">
							<input type="text" class="form-control" name="name" data-validate="required" data-message-required="<?php echo get_phrase('value_required');?>" value="" autofocus>
						</div>
					</div>
					
					<div class="form-group">
						<label for="field-2" class="col-sm-3 control-label"><?php echo get_phrase('price');?></label>
                        
						<div class="col-sm-5">
							<input type="text" class="form-control" name="amount" value="" >
						</div> 
					</div>
                    <div class="form-group">
                        <label for="field-2" class="col-sm-3 control-label"><?php echo get_phrase('water_price');?></label>

                        <div class="col-sm-5">
                            <select name="water_price_id" class="form-control selectboxit" data-validate="required" data-message-required="<?php echo get_phrase('value_required');?>">
                                <option value=""><?php echo get_phrase('select');?></option>
                                <?php
                                $price_list = $this->db->get('price_list')->result_array();
                                foreach($price_list as $row2):
                                    ?>
                                    <option value="<?php echo $row2['id'];?>"
                                        <?php if ($edit_data->water_price_id == $row2['id'])
                                            echo 'selected';?>>
                                        <?php echo $row2['price_list'];?>
                                    </option>
                                    <?php
                                endforeach;
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="field-2" class="col-sm-3 control-label"><?php echo get_phrase('electricity_price');?></label>

                        <div class="col-sm-5">
                            <select name="electricity_price_id" class="form-control selectboxit" data-validate="required" data-message-required="<?php echo get_phrase('value_required');?>">
                                <option value=""><?php echo get_phrase('select');?></option>
                                <?php
                                foreach($price_list as $row3):
                                    ?>
                                    <option value="<?php echo $row3['id'];?>"
                                        <?php if ($edit_data->electricity_price_id == $row3['id'])
                                            echo 'selected';?>>
                                        <?php echo $row3['price_list'];?>
                                    </option>
                                    <?php
                                endforeach;
                                ?>
                            </select>
                        </div>
                    </div>

					<div class="form-group">
						<label for="field-2" class="col-sm-3 control-label"><?php echo get_phrase('building');?></label>
                        
						<div class="col-sm-5">
							<select name="building_id" class="form-control selectboxit" data-validate="required" data-message-required="<?php echo get_phrase('value_required');?>">
                              <option value=""><?php echo get_phrase('select');?></option>
                              <?php 
									$buiding = $this->db->get('building')->result_array();
									foreach($buiding as $row):
										?>
                                		<option value="<?php echo $row['building_id'];?>">
												<?php echo $row['name'];?>
                                                </option>
                                    <?php
									endforeach;
								?>
                          </select>
						</div> 
					</div>
 
                    <div class="form-group">
						<div class="col-sm-offset-3 col-sm-5">
							<button type="submit" class="btn btn-info"><?php echo get_phrase('add_room');?></button>
                    		<button type="button" class="btn btn-info" data-dismiss="modal">Close</button>	
						</div>
					</div>
                <?php echo form_close();?>
            </div>
        </div>
    </div>
</div>