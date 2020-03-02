
<div class="box">
    <div id="tab_div" class="box-header">
    
        <!--col-sm-5 TABS START-->
        <ul class="nav nav-tabs nav-tabs-left">
            <li class="active">
                <a href="#office_fee" data-toggle="tab"><i class="icon-plus"></i> 
                    តម្លៃសំលៀកបំពាក់
                </a></li>          
            
        </ul>
        <!--col-sm-5 TABS END-->
        
    </div>
    <div class="box-content">
		<div class="tab-content">
            		<div class="tab-pane box active"> 
                    
                    
            <div class="row">
                <div class="col-md-12">
                	<div class="panel panel-primary" data-collapsed="0">
                
                		<div class="panel-body">
                    <?php echo form_open(base_url().'index.php?admin/dressFee/insertDressFeeDetail', array('class' => 'form-horizontal validatable','target'=>'_top'));?>
                        
                         <div class="form-group">
                            <label for="field-1" class="col-sm-3 control-label">Dress</label>
                            <div class="col-sm-5">
                                <select id="dress" name="dress">
									<?php 
                                        
                                        $query = $this->db->query('SELECT id,name,unit_price FROM dress order by id desc'); 
                                        $result = $query->result_array();
                                        foreach($result as $row):
                                        ?>  
                                            <option value="<?php echo $row['id'];?>" price="<?php echo  $row['unit_price'];?>">
                                                <?php echo $row['name'];?>
                                            </option>
                                        <?php
                                        endforeach;
                                        ?> 
                                </select>
                            </div>
                         </div> 
                         
                         <div class="form-group">
                                <label for="field-1" class="col-sm-3 control-label">Size</label>
                                <div class="col-sm-5">
                                    <select id="size" name="size" required disabled>
							<?php
                                $this->db->select('id,name');
                                $this->db->from('size');                                
                                
                                $query = $this->db->get(); 
                                $size = $query->result_array();
                                foreach($size as $row):
                                ?>  
                                    <option value="<?php echo $row['id'];?>">
                                        <?php echo $row['name'];?>
                                    </option>
                                <?php
                                endforeach;
                                ?> </select>
                                </div>
                            </div> 
                            <div class="form-group">
                                <label for="field-1" class="col-sm-3 control-label">Unit</label>
                                <div class="col-sm-5">
                                    <input type="text" id="unit" name="unit" required />
                                </div>
                            </div> 
                            
                            <div class="form-group">
                                <label for="field-1" class="col-sm-3 control-label">Unit Price</label>
                                <div class="col-sm-5">
                                    <input type="text" id="unit_price" name="unit_price" required readonly />
                                </div>
                            </div> 
                            
                            <div class="form-group">
                                <label for="field-1" class="col-sm-3 control-label">Amount</label>
                                <div class="col-sm-5">
                                    <input type="text" id="amount" name="amount" required readonly />
                                </div>
                            </div>  

                        	
                        			</div> 
                       			 </div>
                       	 	</div>
                        </div>
                        <!--TABLE LISTING STARTS-->
                        <div class="tab-pane box" id="dress-list"> 
                        	<table class="table table-bordered datatable" id="table_export">
                                <thead>
                                    <tr class="header-table">                                            
                                        <td>លរ</td>   
                                        <td style="width:40%;"><?php echo get_phrase('dress');?></td>  
                                        <td><?php echo get_phrase('size');?></td>
                                        <td><?php echo get_phrase('unit');?></td>
                                        <td><?php echo get_phrase('unit_price');?></td>  
                                        <td><?php echo get_phrase('amount');?></td>                                            
                                    </tr>
                                </thead>
                                    <tbody>
                                        <?php 
                                        $sql = "
                                        
                                                select 
                                                    d.name as name,
                                                    s.name As size,
                                                    sum(dd.unit) as unit,
                                                    dd.unit_price,
                                                    sum(dd.amount) as amount
                                                     
                                                from dress d
                                                inner join dress_detail dd on dd.dress_id = d.id 
                                                left join size s on s.id = dd.size_id
                                                
                                                where brand_id = ?
                                                group by d.name,
                                                    dd.unit_price,
                                                    s.name
                                         "; 
    
                                        $dressDetail = $this->db->query($sql,array($this->session->userdata('branch_id')))->result_array(); 
                                        $i=1;                       
                                        foreach($dressDetail as $row): 
                                        ?>
                                            <tr>                                                
                                                <td align="center">&nbsp;<?php echo $i;?></td>
                                                <td>&nbsp;<?php echo $row['name'];?></td>
                                                <td align="center"><?php echo $row['size'];?>&nbsp;</td>
                                                <td align="right"><?php echo number_format($row['unit'],0);?>&nbsp;</td>
                                                <td align="right"><?php echo $row['unit_price'];?>&nbsp;</td>
                                                <td align="right"><?php echo number_format($row['amount'],0);?>&nbsp;</td>
                                            </tr>                                            
                                        <?php
                                        $i++;
                                        endforeach;
                                        ?>
                                    </tbody>
                                </table> 
                        </div> 
                        <!--TABLE LISTING ENDS-->
                        
                      
                <div class="form-actions" style="text-align:center; margin-top:50px;">  
                    <button type="submit" class="btn btn-gray"><?php echo get_phrase('save');?></button>
                </div>
                            
         	</form>
        </div>
    </div>
</div>

<script language="javascript"  type="text/javascript">
    $(document).ready(function() {
        $("#dress")[0].selectedIndex=-1;

        $("#grade").change(function(){            
            var grade =$(this).val();
            var class_level = (grade<=9)?1:2;                   
            var codi = {"class_level":class_level};
            getFilter("filterSize",codi,"size");

            var type_id;
            if(grade<=9){
                type_id = {"0":1,"1":2,"5":5};                
            }else{
                type_id = {"0":6};
            }
            var codi = {"type_id":type_id};
            getFilter("filterDress",codi,"dress");
        });
        $("#dress").change(function(){            
            var unit_price = $("#dress option:selected").attr("price");
			if($("#dress option:selected").val()=='1' || 
				$("#dress option:selected").val()=='2'|| 
				$("#dress option:selected").val()=='11'|| 
				$("#dress option:selected").val()=='12'){
					$('#size').removeAttr('disabled');
				
			}else{
				$('#size').attr('disabled',true);
			}
            $("#unit_price").val(unit_price.trim());
			if($("#unit_price").val()==25){
				var codi = {"class_level":1};
				getFilter("filterSize",codi,"size");
			}else{ 
				var codi = {"class_level":2};
				getFilter("filterSize",codi,"size");
			}
			
			

        });

        $("#unit").keydown(function(event){
            // Allow only backspace and delete
            if(event.keyCode == 46 || event.keyCode == 8){
                // let it happen, don't do anything

            // Ensure that it is a number and stop the keypress
            }else if(event.keyCode < 48 || event.keyCode > 57){
                event.preventDefault();
            }   

        });
        $("#unit").keyup(function(event){
            var unit_price = $("#unit_price").val();
            var unit = $("#unit").val();
            var amount = unit*unit_price;
            $("#amount").val(amount);     

        });
        
        function getFilter(filterLink,condition,combobox) {            
            $.ajax({
                url: "<?php echo base_url();?>index.php?admin/dressFee/"+filterLink,
                type: "POST",
                data: {
                    '<?php echo $this->security->get_csrf_token_name(); ?>':'<?php echo $this->security->get_csrf_hash(); ?>',
                    condition: condition
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
    });
</script>