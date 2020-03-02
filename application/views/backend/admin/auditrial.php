<div id="dataTables">
    <table cellpadding="0" cellspacing="0" border="0" class="table table-bordered datatable" id="table_export">
        <thead>
            <tr>
                <th width="80"><div>ID</div></th>
                <th width="150"><div><?php echo get_phrase('Date');?></div></th> 
                <th><div><?php echo get_phrase('Description');?></div></th> 
                <th width="200"><div><?php echo get_phrase('User');?></div></th>
                <th width="120"><div><?php echo get_phrase('HOSTNAME');?></div></th>
                <th width="120"><div><?php echo get_phrase('IP');?></div></th>
            </tr>
        </thead>
        <tbody>
            <?php $count = 1;foreach($audit_trial as $row):?>
            <tr>
                <td align="center"><?php echo $count++;?></td> 
                <td align="center"><?php echo $row['AUDIT_DATE'];?></td> 
                <td><?php echo $row['DESCRIPTION'];?></td>  
                <td><?php echo $row['FULL_NAME'];?></td> 
                <td><?php echo $row['HOSTNAME'];?></td> 
                <td><?php echo $row['IP_ADDRESS'];?></td>  
            </tr>
            <?php endforeach;?>
        </tbody>
    </table>
</div> 
<script>
    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            
            reader.onload = function (e) {
                $('#blah').attr('src', e.target.result);
            }
            
            reader.readAsDataURL(input.files[0]);
        }
    }
    
    $("#imgInp").change(function(){
        readURL(this);
    });
</script>