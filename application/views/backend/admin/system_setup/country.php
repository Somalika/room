<style type="text/css">
	input{
		margin-top: 10px;
		width: 190px;
	}
	select{
		width: 200px!important;
		margin-top: 20px;
	}
</style>

<div class="box">
	<div class="box-header">
    
    	<!--CONTROL TABS START-->
		<ul class="nav nav-tabs nav-tabs-left">
			<li class="active">
            	<a href="#list" data-toggle="tab"><i class="icon-align-justify"></i> 
					<?php echo get_phrase('country');?>
		</ul>
    	<!--CONTROL TABS END-->
        
	</div>
	<div class="box-content padded">
		<div class="tab-content">
            <!--TABLE LISTING STARTS-->
            <div class="tab-pane box <?php if(!isset($edit_data))echo 'active';?>" id="list"> 
                <table width="100%">  
					<tr>
						<td>Country</td> 
						<td>Nationality</td> 
						<td>Province</td> 
						<td>District</td>
						<td>Commune</td>
					</tr> 
					<tr>
						<td>
							<select id="countries" name="countries" style="width:105px;" size="10" >
								
								<?php
								$this->db->select('id,country,name');
						        $this->db->from('location');						        
						        $array = array('type' => 1);
						        $this->db->where($array);
						        $query = $this->db->get(); 
								$country = $query->result_array();
								foreach($country as $row):
								?>
									<option key="<?php echo $row['id'];?>" value="<?php echo $row['country'];?>">
										<?php echo $row['name'];?>
									</option>
								<?php
								endforeach;
								?>								
							</select>
							<br />
							<form name="country" class="validatable">
							<div class="control-group">							
								<input type="text" class="validate[required]" name="country" />
								<br />
								<a value="add-country" class="location btn btn-gray btn-small">
	                               	<?php echo get_phrase('add_new');?>
	                            </a>
	                            <a value="update-country" class="location btn btn-gray btn-small">
	                               	<?php echo get_phrase('update');?>
	                            </a>
                            </div>
                            </form>                            
						</td> 
						<td>
							<select id="nationality" name="nationality" style="width:105px;" size="10" >
								
							</select>
							<br />
							<form name="nationality" class="validatable">
							<div class="control-group">
								<input type="text" class="validate[required]" name="nationality" />
								<br />
								<a value="add-nationality" class="location btn btn-gray btn-small">
	                               	<?php echo get_phrase('add_new');?>
	                            </a>
	                            <a value="update-nationality" class="location btn btn-gray btn-small">
	                               	<?php echo get_phrase('update');?>
	                            </a>
                            </div>
                            </form>
						</td> 
						<td>
							<select id="province" name="province" style="width:105px;" size="10" >
								
							</select>
							<br />
							<form name="province" class="validatable">
							<div class="control-group">
								<input type="text" class="validate[required]" name="province" />
								<br />
								<a value="add-province"class="location btn btn-gray btn-small">
	                               	<?php echo get_phrase('add_new');?>
	                            </a>
	                            <a value="update-province"class="location btn btn-gray btn-small">
	                               	<?php echo get_phrase('update');?>
	                            </a>
                            </div>
                            </form>
						</td> 
						<td>
							<select id="district" name="district" style="width:105px;" size="10" >
								
							</select>
							<br />
							<form name="district" class="validatable">
							<div class="control-group">
								<input type="text" class="validate[required]" name="district" />
								<br />
								<a value="add-district"class="location btn btn-gray btn-small">
	                               	<?php echo get_phrase('add_new');?>
	                            </a>
	                            <a value="update-district"class="location btn btn-gray btn-small">
	                               	<?php echo get_phrase('update');?>
	                            </a>
                            </div>
                            </form>
						</td>
						<td>
							<select id="commune" name="commune" style="width:105px;" size="10" >
								
							</select>
							<br />
							<form name="commune" class="validatable">
							<div class="control-group">
								<input type="text" class="validate[required]" name="commune" />
								<br />
								<a value="add-commune"class="location btn btn-gray btn-small">
	                               	<?php echo get_phrase('add_new');?>
	                            </a>
	                            <a value="update-commune"class="location btn btn-gray btn-small">
	                               	<?php echo get_phrase('update');?>
	                            </a>
                            </div>
                            </form>
						</td>
					</tr> 
                </table>
			</div>
            <!--TABLE LISTING ENDS--> 
            
		</div>
	</div>
</div>

<script language="javascript"  type="text/javascript">
    $(document).ready(function() {
    	$(".location").click(function(){    		
    		if($(this).attr("value").trim()=="add-country"){
    			//console.log($("#countries").val());
    			//$("input[name=country]").val();
    			//console.log($("input[name=country]").val());
    			//console.log($("#countries").val());
    			var country = $("input[name=country]"),
    				data={
    					"name":country.val(),
    					"type":1
    				};    			
    			if(country.val()){
    				insertLocation("country",data,"countries");
    				country.val('');
    				return;
    			}
    			$("form[name=country]").submit();
    			//insertLocation("country",data,"countries");		
    		}
    		if($(this).attr("value").trim()=="update-country"){
    			var country = $("input[name=country]");    			
    			if(country.val().trim() && $("#countries").val()){
    				var data={"name":country.val()};
    				var key=$("#countries option:selected").attr("key");
    				
    				if(country.val()){
	    				updateLocation(data,key,"countries");
	    				country.val('');
	    				return;
	    			}
	    			$("form[name=country]").submit();
    			}
    		}

    		if($(this).attr("value").trim()=="add-nationality"){
    			//console.log("document");
    			var nationality = $("input[name=nationality]");
    			if($("#countries").val()){
    				var data={
    						"country_id":$("#countries").val(),
    						"nationality":nationality.val()
    					};
    				
    				if(nationality.val()){
	    				insertCountry(data,"nationality");
	    				nationality.val('');
	    				return;
	    			}
	    			$("form[name=nationality]").submit();
    			}		
    		}
    		if($(this).attr("value").trim()=="update-nationality"){
    			//Check have value in nationality textbox and selected in combo nationality ?    			
    			var nationality = $("input[name=nationality]");
    			if(nationality.val().trim() && $("#nationality").val()){
    				var data={"nationality":nationality.val()};
    				var key=$("#nationality option:selected").attr("key");
    				
    				if(nationality.val()){
	    				updateCountry(data,key,"nationality");
	    				nationality.val('');
	    				return;
	    			}
	    			$("form[name=nationality]").submit();
    			}
    		}

    		if($(this).attr("value").trim()=="add-province"){
    			var province = $("input[name=province]");
    			if($("#countries").val()){
    				var data={
    					"name":province.val(),
    					"type":2,
    					"country":$("#countries").val()
    				};
    				
    				if(province.val()){
	    				insertLocation("province",data,"province");
	    				province.val('');
	    				return;
	    			}
	    			$("form[name=province]").submit();
    			}    			
    		}
    		if($(this).attr("value").trim()=="update-province"){
    			//Check have value in province textbox and selected in combo province ?
    			var province = $("input[name=province]");    			
    			if(province.val().trim() && $("#province").val()){
    				var data={"name":province.val()};
    				var key=$("#province option:selected").attr("key");
    				updateLocation(data,key,"province");
    				if(province.val()){
	    				updateLocation(data,key,"province");
	    				province.val('');
	    				return;
	    			}
	    			$("form[name=province]").submit();
    			}
    		}

    		if($(this).attr("value").trim()=="add-district"){
    			var district = $("input[name=district]");
    			if($("#province").val()){    				
    				var data={
    					"name":district.val(),
    					"type":3,
    					"country":$("#countries").val(),
    					"province":$("#province").val()
    				};
    				
    				if(district.val()){
	    				insertLocation("district",data,"district");
	    				district.val('');
	    				return;
	    			}
	    			$("form[name=district]").submit();
    			}
    		}
    		if($(this).attr("value").trim()=="update-district"){
    			//Check have value in district textbox and selected in combo district ?
    			var district = $("input[name=district]");    			
    			if(district.val().trim() && $("#district").val()){
    				var data={"name":district.val()};
    				var key=$("#district option:selected").attr("key");
    				
    				if(district.val()){
	    				updateLocation(data,key,"district");
	    				district.val('');
	    				return;
	    			}
	    			$("form[name=district]").submit();
    			}
    		}

    		if($(this).attr("value").trim()=="add-commune"){
    			var commune = $("input[name=commune]");
    			if($("#district").val()){
    				var data={
    					"name":commune.val(),
    					"type":4,
    					"country":$("#countries").val(),
    					"province":$("#province").val(),
    					"district":$("#district").val()
    				};
    				
    				if(commune.val()){
	    				insertLocation("commune",data,"commune");
	    				commune.val('');
	    				return;
	    			}
	    			$("form[name=commune]").submit();
    			}
    		}
    		if($(this).attr("value").trim()=="update-commune"){
    			//Check have value in commune textbox and selected in combo commune ?
    			var commune = $("input[name=commune]");    			
    			if(commune.val().trim() && $("#commune").val()){
    				var data={"name":commune.val()};
    				var key=$("#commune option:selected").attr("key");
    				
    				if(commune.val()){
	    				updateLocation(data,key,"commune");
	    				commune.val('');
	    				return;
	    			}
	    			$("form[name=commune]").submit();
    			}
    		}    		
    	});
    	$("#countries").change(function() {

    		var countries = $("#countries"),
    			textSelected = $("#countries option:selected").text();
    		$("input[name=country]").val(textSelected.trim());    		
        	var codi = {"country_id":countries.val()};
			getFilter("filterNationality",codi, "nationality");
				codi = {"country":countries.val(),"type":2};
			getFilter("filterProvince",codi, "province");

			$("#district").empty();
			$("#commune").empty();                     
            
		});
		$("#nationality").change(function() {

    		var nationality = $("#nationality"),
    			textSelected = $("#nationality option:selected").text();
    		$("input[name=nationality]").val(textSelected.trim());       	                     
            
		});
		$("#province").change(function() {
			var province = $("#province"),
    			textSelected = $("#province option:selected").text();
    		$("input[name=province]").val(textSelected.trim());

        	var codi = {"country":$("#countries").val(),"type":3,"province":province.val()};
			getFilter("filterDistrict",codi, "district");                     
            
		});
		$("#district").change(function() {
			var district = $("#district"),
    			textSelected = $("#district option:selected").text();
    		$("input[name=district]").val(textSelected.trim());

        	var codi = {"country":$("#countries").val(),"type":4,"province":$("#province").val(),"district":district.val()};
			getFilter("filterCommune",codi, "commune");                     
            
		});

		$("#commune").change(function() {
			var commune = $("#commune"),
    			textSelected = $("#commune option:selected").text();
    		$("input[name=commune]").val(textSelected.trim());   		                     
            
		});
		
		function getFilter(filterLink,condition,combobox) {            
            $.ajax({
                url: "<?php echo base_url();?>index.php?admin/country/"+filterLink,
                type: "POST",
                data: {
                    '<?php echo $this->security->get_csrf_token_name(); ?>':'<?php echo $this->security->get_csrf_hash(); ?>',
                    'condition': condition
                },
                cache: false,
                success: function(data){
                	//console.log(data);					
                    $("#"+combobox).empty().append(data);
					$("#"+combobox)[0].selectedIndex=-1;
                },
                error:function(){
                    alert("failure");
                }   
            }); 
        }
        function insertLocation(insertType,data,combobox) {            
            $.ajax({
                url: "<?php echo base_url();?>index.php?admin/country/insertLocation",
                type: "POST",
                data: {
                    '<?php echo $this->security->get_csrf_token_name(); ?>':'<?php echo $this->security->get_csrf_hash(); ?>',
                    'data': data,
                    'insertType':insertType
                },
                cache: false,
                success: function(data){
                	console.log(data);
                	obj = JSON && JSON.parse(data) || $.parseJSON(data);
                	var value;
                	switch(insertType){
                		case 'country'	: value=obj.country;break;
                		case 'province'	: value=obj.province;break;
                		case 'district'	: value=obj.district;break;
                		case 'commune'	: value=obj.commune;break;
                	}			
                    $("#"+combobox).append("<option value='"+value+"'>"+obj.name+"</option>");
					
					//Clear value in textbox
					//$("[name="+combobox+"]").val("");
                },
                error:function(){
                    alert("failure");
                }   
            }); 
        }
        function updateLocation(data,key,combobox) {            
            $.ajax({
                url: "<?php echo base_url();?>index.php?admin/country/updateLocation",
                type: "POST",
                data: {
                    '<?php echo $this->security->get_csrf_token_name(); ?>':'<?php echo $this->security->get_csrf_hash(); ?>',
                    'data': data,
                    'key':key
                },
                cache: false,
                success: function(data){                	
                	obj = JSON && JSON.parse(data) || $.parseJSON(data);					
                    $("#"+combobox+" option:selected").text(obj.name);
					//Clear value in textbox
					//$("[name="+combobox+"]").val("");
                },
                error:function(){
                    alert("failure");
                }   
            }); 
        }
        function updateCountry(data,key,combobox) {            
            $.ajax({
                url: "<?php echo base_url();?>index.php?admin/country/updateCountry",
                type: "POST",
                data: {
                    '<?php echo $this->security->get_csrf_token_name(); ?>':'<?php echo $this->security->get_csrf_hash(); ?>',
                    'data': data,
                    'key':key
                },
                cache: false,
                success: function(data){                	                	
                	obj = JSON && JSON.parse(data) || $.parseJSON(data);					
                    $("#"+combobox+" option:selected").text(obj.nationality);
					//Clear value in textbox
					//$("[name="+combobox+"]").val("");
                },
                error:function(){
                    alert("failure");
                }   
            }); 
        }
        function insertCountry(data,combobox) {            
            $.ajax({
                url: "<?php echo base_url();?>index.php?admin/country/insertCountry",
                type: "POST",
                data: {
                    '<?php echo $this->security->get_csrf_token_name(); ?>':'<?php echo $this->security->get_csrf_hash(); ?>',
                    'data': data
                },
                cache: false,
                success: function(data){
                	console.log(data);
                	obj = JSON && JSON.parse(data) || $.parseJSON(data);                				
                    $("#"+combobox).append("<option value='"+obj.id+"'>"+obj.nationality+"</option>");
					//$("#"+combobox)[0].selectedIndex=-1;
                },
                error:function(){
                    alert("failure");
                }   
            }); 
        }
    });
</script>