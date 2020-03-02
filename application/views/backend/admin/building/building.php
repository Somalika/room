<div class="row">
	<div class="col-md-12">
    
    	<!------CONTROL TABS START------>
		<ul class="nav nav-tabs bordered">
			<li class="active">
            	<a href="#list" data-toggle="tab"><i class="entypo-menu"></i> 
					<?php echo get_phrase('building_list');?>
                    	</a></li>
			<li>
            	<a href="#add" data-toggle="tab"><i class="entypo-plus-circled"></i>
					<?php echo get_phrase('add_building');?>
                    	</a></li>
		</ul>
    	<!------CONTROL TABS END------>
        
		<div class="tab-content">
            <!----TABLE LISTING STARTS-->
            <div class="tab-pane box active" id="list">
				
                <table class="table table-bordered datatable" id="table_export">
                	<thead>
                		<tr>
                    		<th><div>#</div></th>
                    		<th><div><?php echo get_phrase('build_name');?></div></th>
                            <th><div><?php echo get_phrase('numeric_room');?></div></th>
                            <th><div><?php echo get_phrase('numeric_room');?></div></th>
                            <th><div><?php echo get_phrase('numeric_room');?></div></th>
                            <th><div><?php echo get_phrase('numeric_room');?></div></th>
                            <th><div><?php echo get_phrase('numeric_room');?></div></th>
                            <th></th>
						</tr>
					</thead>
                    <tbody>
                    	<?php $count = 1;foreach($building as $row):?>
                        <tr>
                            <td><?php echo $count++;?></td>
							<td><?php echo $row['name'];?></td>
                            <td><?php echo $row['name_numeric'];?></td>
                            <td><?php echo $row['name_numeric'];?></td>
                            <td><?php echo $row['name_numeric'];?></td>
                            <td><?php echo $row['name_numeric'];?></td>
                            <td><?php echo $row['name_numeric'];?></td>
                            <td><a href="#" onclick="showAjaxModal('<?php echo base_url();?>index.php?modal/popup/building/modal_edit_building/<?php echo $row['building_id'];?>');">
                                            <i class="entypo-pencil"></i></a>
        					</td>
                        </tr>
                        <?php endforeach;?>
                    </tbody>
                </table>
			</div>
            <!----TABLE LISTING ENDS--->
            
            
			<!----CREATION FORM STARTS---->
			<div class="tab-pane box" id="add" style="padding: 5px">
                <div class="box-content">
                	<?php echo form_open(base_url() . 'index.php?admin/building/create' , array('class' => 'form-horizontal form-groups-bordered validate','target'=>'_top'));?>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="padded">
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label"><?php echo get_phrase('building_name');?></label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" name="name" data-validate="required" data-message-required="<?php echo get_phrase('value_required');?>"/>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label"><?php echo get_phrase('number_of_rooms');?></label>
                                        <div class="col-sm-3">
                                            <input type="number" step="any" class="form-control" name="name_numeric"/>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label"><?php echo get_phrase('contact_person');?></label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" name="name_numeric"/>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label"><?php echo get_phrase('phone');?></label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" name="phone"/>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label"><?php echo get_phrase('email');?></label>
                                        <div class="col-sm-9">
                                            <input type="email" class="form-control" name="email"/>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label"><?php echo get_phrase('description');?></label>
                                        <div class="col-sm-9">
                                            <textarea type="text" class="form-control" name="description"></textarea>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-sm-3">&nbsp;</label>
                                        <div class="col-sm-9">
                                            <input type="checkbox" name="status"/>
                                            <label class="control-label"><?php echo get_phrase('status');?></label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label class="col-sm-3 control-label"><?php echo get_phrase('address');?></label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" name="address"/>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-3 control-label"><?php echo get_phrase('address1');?></label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" name="address1"/>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-3 control-label"><?php echo get_phrase('address2');?></label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" name="address2"/>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-3 control-label"><?php echo get_phrase('address3');?></label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" name="address3"/>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-sm-12 col-sm-offset-10">
                                <button type="submit" class="btn btn-info"><?php echo get_phrase('add_building');?></button>
                            </div>
                        </div>
                    </form>                
                </div>                
			</div>
			<!----CREATION FORM ENDS-->
		</div>
	</div>
</div>



<!-----  DATA TABLE EXPORT CONFIGURATIONS ---->                      
<script type="text/javascript">

	jQuery(document).ready(function($)
	{
		

		var datatable = $("#table_export").dataTable();
		
		$(".dataTables_wrapper select").select2({
			minimumResultsForSearch: -1
		});
	});
		
</script> 