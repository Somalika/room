<div class="row">
	<div class="col-md-12">
		<div class="panel panel-primary" data-collapsed="0">
        	 
			<div class="panel-body">
            
            
        <?php echo form_open('', array('class' => 'form-horizontal validatable','id'=>'fmPromotion','target'=>'_top'));?>
            <input type="hidden" name="register_id" value="" />
             
             <div class="form-group">
                <label for="field-1" class="col-sm-3 control-label">Promotion Name</label> 
                <div class="col-sm-5"> 
                	<input type="text" id="txtPromotionName" name="txtPromotionName" />
                </div>
            </div>  
             <div class="form-group">
                <label for="field-1" class="col-sm-3 control-label">Start</label> 
                <div class="col-sm-5"> 
                	<input id="txtStartDate" name="txtStartDate" class="datepicker fill-up" type="text" >
                </div>
            </div>  
             <div class="form-group">
                <label for="field-1" class="col-sm-3 control-label">End</label> 
                <div class="col-sm-5"> 
                	<input id="txtEndDate" name="txtEndDate" class="datepicker fill-up" type="text" >
                </div>
            </div>    
             <div class="form-group">
                <label for="field-1" class="col-sm-3 control-label">Number Limited</label> 
                <div class="col-sm-5"> 
                	<input id="txtNumberLimited" name="txtNumberLimited" type="text" >
                </div>
            </div>  
             <div class="form-group">
                <label for="field-1" class="col-sm-3 control-label">Type</label> 
                <div class="col-sm-5"> 
                	<select id="slType" name="slType">
                        <option value="1">For Student</option>
                        <option value="2">For Register</option>
                    </select>
                </div>
            </div>  
              
  
 		<!------ button ------>
        <div class="form-actions" style="text-align:center; margin-top:50px;">  
            <input type="button" id="btnSave" class="btn btn-gray" value="Save" />  
            <input type="reset" class="btn btn-gray" value="Reset" />
            <input type="hidden" id="authenticity_token" name="authenticity_token" value="<?php echo $this->security->get_csrf_hash(); ?>" />
        </div> 
     
	</form>    
    </div>
</div>
</div>    
                