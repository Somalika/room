<style type="text/css">
    td.column1{
        width: 60px;
        text-align: center;
        vertical-align: center;
    }
    td.column2{
        width: 400px;
        padding-left: 10px;
    }
    td.column3{
        width: 60px;
        text-align: center;
        vertical-align: center;
    }    
    td input[type="text"]{
        margin-top: 10px;
        margin-left: 10px;
        margin-right: 10px; 
    }
    td input[type="checkbox"]{
        margin-top: 0px;        
        /* Double-sized Checkboxes */
        -ms-transform: scale(1.5); /* IE */
        -moz-transform: scale(1.5); /* FF */
        -webkit-transform: scale(1.5); /* Safari and Chrome */
        -o-transform: scale(1.5); /* Opera */
    }
    .table-header{
        text-align: center;
        font-size: 13px;
        font-weight: bold;
    }
    td,table{
        border-color:#E8E8E8;
    }
    table{
        border-width: 0px;
    }
    
</style>

<div class="box">
    <div id="tab_div" class="box-header">
    
    	<!--CONTROL TABS START-->
		<ul class="nav nav-tabs nav-tabs-left">
            <li class="active">
                <a href="#office_fee" data-toggle="tab"><i class="icon-plus"></i> 
                    ថ្លៃរដ្ឋបាល
                </a></li> 
            
		</ul>
    	<!--CONTROL TABS END-->
        
	</div>
	<div class="box-content">
        <div class="tab-content">
            <div class="tab-pane  active" id="office_fee" style="padding: 20px;width:80%;">
                <form id="setupfee">
                <label>Select Grade:</label>
                <select id="grade" name="grade" required>                                
                    <?php
                    $this->db->select('class_id,name');
                    $this->db->from('class');                                
                    
                    $query = $this->db->get(); 
                    $country = $query->result_array();
                    foreach($country as $row):
                    ?>
                        <option value="<?php echo $row['class_id'];?>">
                            <?php echo $row['name'];?>
                        </option>
                    <?php
                    endforeach;
                    ?>                              
                </select>
                <table border="1">
                    <tr class="table-header">
                        <td>Check</td>
                        <td>Fee Name</td>
                        <td>Value</td>
                    </tr>
                    <?php
                    $this->db->select('id,fee_name');
                    $this->db->from('other_fee');                                
                    $array = array('status' => 1);
                    $this->db->where($array);
                    $query = $this->db->get(); 
                    $country = $query->result_array();
                    foreach($country as $row):
                    ?>
                        <tr>
                            <td class="column1"><input other_fee_id="<?php echo $row['id'];?>" name="checks" type="checkbox" /></td>
                            <td class="column2">
                                <?php echo $row['fee_name'];?>
                            </td>
                            <td class="column3"><input name="prices" type="text" disabled="true" required /></td>
                        </tr>                    
                    <?php
                    endforeach;
                    ?>   
                </table>
                <div style="margin-top:50px;"><center>
                    <button name="save" type="button" class="btn btn-gray"><?php echo get_phrase('save');?></button></center>
                </div>
                </form>
            </div>            
		</div>
	</div>
</div>

<script language="javascript"  type="text/javascript">
    $(document).ready(function() {
        $("#grade")[0].selectedIndex=-1;
    	$('td input[type=checkbox]').change(function() {
            var checked = $(this).is(":checked");
            var textBox = $(this).parent().parent().find("input[name=prices]");
            if(checked){
                textBox.removeAttr('disabled');               
                //inputBox.removeAttr('disabled');
                //$("select[name=district]").removeAttr('disabled');
            }else{
                textBox.attr('disabled','true');
            }
        });

		$('button[name=save]').click(function() {
            //$("input:checkbox:not(:checked)").val();
            //console.log($("input:checkbox:not(:checked)").attr("other_fee_id"));
            var grade_id = $("#grade").val();
            var gradeText = "grade "+ $("#grade option:selected").text().trim();            
            if($("#grade")[0].selectedIndex==-1){
                $("#grade").focus();
                return; 
            }
            var checks = $("input:checked");            
            var data=[];
            for (var i = 0; i < checks.length; i++) {
                var textBox = $(checks[i]).parent().parent().find("input[name=prices]");
                if(textBox.val().trim()==""){
                   $(textBox).focus();
                   return; 
                }
                var other_fee_id = $(checks[i]).attr("other_fee_id");
                //console.log(textBox.val());
                var item = {
                    "other_fee_id": other_fee_id,
                    "grade_id":grade_id,
                    "price":textBox.val(),
                    "description":gradeText
                };                
                data.push(item);         
            };

            var deleteKeys=[];
            $("input:checkbox:not(:checked)").each(function(){                
                deleteKeys.push($(this).attr("id_detail"));
            });
            //console.log(data);            
            saveFeeInfoDetail(data,deleteKeys); 
        });

        $("#grade").change(function() {
            $("input[type=text]").val("");
            $("input[type=checkbox]").prop("checked", false);;          
            var grade_id = $(this).val();            
            feeInfoDetail(grade_id);
            //$(this).find('option:selected').text().trim();
            //var value = $("[name='MyName'] option:selected").text().trim();            
        }); 

        function saveFeeInfoDetail(data,deleteKeys) {            
            $.ajax({
                url: "<?php echo base_url();?>index.php?admin/setUpFee/saveFeeInfoDetail",
                type: "POST",
                data: {
                    '<?php echo $this->security->get_csrf_token_name(); ?>':'<?php echo $this->security->get_csrf_hash(); ?>',
                    'data': data,
                    'deleteKeys':deleteKeys
                },
                cache: false,
                success: function(data){                    
                	window.location.href="<?php echo base_url();?>index.php?admin/setUpFee";
                	//obj = JSON && JSON.parse(data) || $.parseJSON(data);
                	
                },
                error:function(){
                    alert("failure");
                }   
            }); 
        }
        function feeInfoDetail(grade_id) {            
            $.ajax({
                url: "<?php echo base_url();?>index.php?admin/setUpFee/feeInfoDetail",
                type: "POST",
                data: {
                    '<?php echo $this->security->get_csrf_token_name(); ?>':'<?php echo $this->security->get_csrf_hash(); ?>',
                    'grade_id': grade_id
                },
                cache: false,
                success: function(data){
                    //$("table")[0].reset();                    
                    obj = JSON && JSON.parse(data) || $.parseJSON(data);
                    var checkboxes = $('td input[type=checkbox]');
                    //console.log(checkboxes);
                    for(var i=0;i<checkboxes.length;i++){
                        var other_fee_id = $(checkboxes[i]).attr("other_fee_id");
                        inner:
                        for(var j=0;j<obj.length;j++){
                            //console.log(obj[j].other_fee_id);
                            if(other_fee_id == obj[j].other_fee_id){
                                //note
                                $(checkboxes[i]).prop("checked", true);
                                $(checkboxes[i]).attr("id_detail",obj[j].id)
                                var textBox = $(checkboxes[i]).parent().parent().find("input[name=prices]");
                                textBox.val(obj[j].price);
                                break inner;
                            }
                        }
                    }                    
                },
                error:function(){
                    alert("failure");
                }   
            }); 
        }        
    });
</script>