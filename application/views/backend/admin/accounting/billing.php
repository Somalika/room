<div class="row">
	<div class="col-md-12">
		<div class="panel panel-primary" data-collapsed="0">
        	<div class="panel-heading">
            	<div class="panel-title" >
            		<i class="entypo-plus-circled"></i>
					<?php echo get_phrase('process_billing');?>
            	</div>
            </div>
			<div class="panel-body">
				
                <?php echo form_open(base_url() . 'index.php?admin/billing/create/' , array('class' => 'form-horizontal form-groups-bordered validate', 'enctype' => 'multipart/form-data'));?>
	
					<div class="form-group">
						<label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('billing_date');?></label>
                        
						<div class="col-sm-4">
							<input type="text" class="form-control datepicker fill-up" name="billing_date" autofocus>
						</div>
					</div>
					
					<div class="form-group">
						<label for="field-2" class="col-sm-3 control-label"><?php echo get_phrase('from_date');?></label>
                        
						<div class="col-sm-2">
							<input type="text" class="form-control datepicker fill-up" name="from_date"/> 
						</div> 
						<label for="field-1" class="col-sm-1 control-label"><?php echo get_phrase('to_date');?></label>
                        <div class="col-sm-2"> 
							<input type="text" class="form-control datepicker fill-up" name="to_date"/>
						</div> 
					</div>

					<div class="form-group">
						<label for="field-2" class="col-sm-3 control-label"><?php echo get_phrase('comments');?></label>
                        
						<div class="col-sm-5"> 
                        	<textarea style="margin: 0px; height: 98px; width: 428px;"></textarea>
						</div> 
					</div>
 
                    <div class="form-group">
						<div class="col-sm-offset-3 col-sm-5">
							<button type="submit" class="btn btn-info"><?php echo get_phrase('bill');?></button>
						</div>
					</div>
                <?php echo form_close();?>
            </div>
        </div>
    </div>
</div>