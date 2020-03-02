<?php
	$edit_data = $this->db->get_where('staying' , array('staying_id' => $param2 ))->row();
?>

<div class="row">
	<div class="col-md-12">
		<div class="panel panel-primary" data-collapsed="0">
        	<div class="panel-heading">
            	<div class="panel-title" >
            		<i class="entypo-plus-circled"></i>
					<?php echo get_phrase('edit_new_staying');?>
            	</div>
            </div>
			<div class="panel-body">
                <?php echo form_open(base_url() . 'index.php?admin/stayings/edit', array('class' => 'form-horizontal form-groups-bordered validate', 'enctype' => 'multipart/form-data'));?> 
                	<input type="hidden" name="building_id" value="<?php echo $this->uri->segment(6);?>" />
					<input type="hidden" name="staying_id" value="<?php echo $param2;?>"/>
					<div class="form-group">
						<label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('name');?></label>
                        
						<div class="col-sm-5">
							<input type="text" class="form-control" name="name" data-validate="required" data-message-required="<?php echo get_phrase('value_required');?>" 
								value="<?php echo $edit_data->staying_name?>">
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
                                		<option value="<?php echo $row['genderid'];?>" <?php if ($edit_data->gender_id == $row['genderid'])
                                				echo 'selected';?>>
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
							<input type="text" class="form-control datepicker fill-up" name="date_in" value="<?php echo date('m/d/Y',strtotime($edit_data->date_in));?>"/>
						</div>
					</div>
					
					<div class="form-group">
						<label for="field-2" class="col-sm-3 control-label"><?php echo get_phrase('id_card');?></label>
                        
						<div class="col-sm-5">
							<input type="text" class="form-control" name="id_card" value="<?php echo $edit_data->id_card?>" >
						</div> 
					</div> 
					<div class="form-group">
						<label for="field-2" class="col-sm-3 control-label"><?php echo get_phrase('phone');?></label>
                        
						<div class="col-sm-5">
							<input type="text" class="form-control" name="phone" value="<?php echo $edit_data->phone?>" >
						</div> 
					</div>
					<div class="form-group">
						<label for="field-2" class="col-sm-3 control-label"><?php echo get_phrase('job');?></label>
                        
						<div class="col-sm-5">
							<input type="text" class="form-control" name="job" value="<?php echo $edit_data->job?>" >
						</div> 
					</div>
					<div class="form-group">
						<label for="field-2" class="col-sm-3 control-label"><?php echo get_phrase('number_person');?></label>
                        
						<div class="col-sm-5">
							<input type="text" class="form-control" name="number_person" value="<?php echo $edit_data->number_person?>" >
						</div> 
					</div>

					<div class="form-group">
						<label for="field-2" class="col-sm-3 control-label"><?php echo get_phrase('room');?></label>
                        
						<div class="col-sm-5">
							<select name="room_id" class="form-control" >
                              <option value=""><?php echo get_phrase('select');?></option>
                              <?php 
									$sql ="select * from room where room_id in(".$edit_data->room_id.")";
									$room = $this->db->query($sql)->result_array();
									foreach($room as $row2):
										?>
                                		<option value="<?php echo $row2['room_id'];?>"
                                			<?php if ($edit_data->room_id == $row2['room_id'])
                                				echo 'selected';?>>
													<?php echo $row2['name'];?>
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
							<input type="text" class="form-control" name="booking" value="<?php echo $edit_data->booking?>"/>
						</div> 
					</div>
					<div class="form-group">
						<label for="field-2" class="col-sm-3 control-label"><?php echo get_phrase('old_water');?></label>
                        
						<div class="col-sm-5">
							<input type="text" class="form-control" name="old_water" value="<?php echo $edit_data->old_water?>"/>
						</div> 
					</div>
					<div class="form-group">
						<label for="field-2" class="col-sm-3 control-label"><?php echo get_phrase('old_elect');?></label>
                        
						<div class="col-sm-5">
							<input type="text" class="form-control" name="old_elect" value="<?php echo $edit_data->old_elect?>"/>
						</div> 
					</div>
                    
					<div class="form-group">
						<label for="field-2" class="col-sm-3 control-label"><?php echo get_phrase('is_staying');?></label>
                        
						<div class="col-sm-5">
							<select id="is_staying" name="is_staying" class="form-control">
                              <option value=""><?php echo get_phrase('select');?></option>
                              <?php 
									$type = $this->db->get_where('type',array('status'=>2))->result_array();
									foreach($type as $row3):
                                        $selected = $edit_data->type_id == $row3['type_id']?' selected':'';
										?>
                                		<option value="<?php echo $row3['type_id'];?>" <?php echo $selected;?>>
													<?php echo $row3['type_name'];?>
                                        </option>
                                    <?php
									endforeach;
								?>
                          </select>
                            <?php
                                $tobeleave = "";
                                if(!empty($edit_data->tobe_leave)){
                                    $tobeleave = $edit_data->tobe_leave;
                                }else{
                                    $tobeleave = date('m/d/Y');
                                }
                                //
                                $display = "";
                                if($edit_data->type_id==6){
                                    $display= '';
                                }else if($edit_data->type_id==5) {
                                    $display= '';
                                }else{
                                    $display='style="display:none"';
                                }
                            ?>

                            <input type="text" class="form-control datepicker fill-up" <?php echo $display;?>
                                   name="tobe_leave" id="tobe_leave" value="<?php echo date('m/d/Y',strtotime($tobeleave));?>"/>

                        </div>
					</div>

 
                    
                    <div class="form-group">
						<div class="col-sm-offset-3 col-sm-5">
							<button type="submit" class="btn btn-info"><?php echo get_phrase('update');?></button>
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

<script>
    $("#is_staying").change(function (e){
        if($(this).val()==6){
            $("#tobe_leave").css('display','');
        }else if($(this).val()==5) {
            $("#tobe_leave").css('display','');
        }else{
            $("#tobe_leave").css('display','none');
        };
        console.log($(this).val());
    });
</script>