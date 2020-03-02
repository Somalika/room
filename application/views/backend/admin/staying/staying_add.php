<div class="row">
	<div class="col-md-12">
		<div class="panel panel-primary" data-collapsed="0">
        	<div class="panel-heading">
            	<div class="panel-title" >
            		<i class="entypo-plus-circled"></i>
					<?php echo get_phrase('add_new_staying');?>
            	</div>
            </div>
			<div class="panel-body">
                <?php echo form_open(base_url() . 'index.php?admin/stayings/create/' , array('class' => 'form-horizontal form-groups-bordered validate', 'enctype' => 'multipart/form-data'));?>
					<input type="hidden" name="building_id" value="<?php echo $this->uri->segment(5);?>" />
					<div class="form-group">
						<label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('name');?></label>

						<div class="col-sm-5">
							<input type="text" class="form-control" name="name" data-validate="required" data-message-required="<?php echo get_phrase('value_required');?>" value="" autofocus>
						</div>
					</div>
                    <div class="form-group">
						<label for="field-2" class="col-sm-3 control-label"><?php echo get_phrase('gender');?></label>

						<div class="col-sm-5">
							<select name="gender" class="form-control">
                              <option value=""><?php echo get_phrase('select');?></option>
                              <?php
									$gender = $this->db->get('gender')->result_array();
									foreach($gender as $row):
										?>
                                		<option value="<?php echo $row['genderid'];?>">
												<?php echo $row['gender'];?>
                                                </option>
                                    <?php
									endforeach;
								?>
                          </select>
						</div>
					</div>
					<div class="form-group">
						<label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('date_in');?></label>

						<div class="col-sm-5">
							<input type="text" class="form-control datepicker fill-up" name="date_in"/>
						</div>
					</div>

					<div class="form-group">
						<label for="field-2" class="col-sm-3 control-label"><?php echo get_phrase('id_card');?></label>

						<div class="col-sm-5">
							<input type="text" class="form-control" name="id_card" value="" >
						</div>
					</div>
					<div class="form-group">
						<label for="field-2" class="col-sm-3 control-label"><?php echo get_phrase('phone');?></label>

						<div class="col-sm-5">
							<input type="text" class="form-control" name="phone" value="" >
						</div>
					</div>
					<div class="form-group">
						<label for="field-2" class="col-sm-3 control-label"><?php echo get_phrase('job');?></label>

						<div class="col-sm-5">
							<input type="text" class="form-control" name="job" value="" >
						</div>
					</div>
					<div class="form-group">
						<label for="field-2" class="col-sm-3 control-label"><?php echo get_phrase('number_person');?></label>

						<div class="col-sm-5">
							<input type="text" class="form-control" name="number_person" value="" >
						</div>
					</div>

					<div class="form-group">
						<label for="field-2" class="col-sm-3 control-label"><?php echo get_phrase('room');?></label>

						<div class="col-sm-5">
							<select name="room_id" class="form-control selectboxit" data-validate="required" data-message-required="<?php echo get_phrase('value_required');?>">
                              <option value=""><?php echo get_phrase('select');?></option>
                              <?php
							  		$sql ="select * from room where room_id not in(select room_id from staying where type_id in(3,4,6))";
									$room = $this->db->query($sql)->result_array();
									foreach($room as $row):
										?>
                                		<option value="<?php echo $row['room_id'];?>">
												<?php echo $row['name'];?>
                                                </option>
                                    <?php
									endforeach;
								?>
                          </select>
						</div>
					</div>
					<div class="form-group">
						<label for="field-2" class="col-sm-3 control-label"><?php echo get_phrase('booking');?></label>

						<div class="col-sm-5">
							<input type="text" class="form-control" name="booking" />
						</div>
					</div>

                    <div class="form-group">
						<div class="col-sm-offset-3 col-sm-5">
							<button type="submit" class="btn btn-info"><?php echo get_phrase('add_staying');?></button>
                    		<button type="button" class="btn btn-info" data-dismiss="modal">Close</button>
						</div>
					</div>
                <?php echo form_close();?>
            </div>
        </div>
    </div>
</div>
<div style="clear: both"></div>
<br />
<br />
<br />
<br />
<br />
<br />