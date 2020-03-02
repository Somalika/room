<?php
	$system_name        =	$this->db->get_where('settings' , array('type'=>'system_name'))->row()->description;
	$system_title       =	$this->db->get_where('settings' , array('type'=>'system_title'))->row()->description;
	$text_align         =	$this->db->get_where('settings' , array('type'=>'text_align'))->row()->description;
	$account_type       =	$this->session->userdata('login_type');
	$skin_colour        =   $this->db->get_where('settings' , array('type'=>'skin_colour'))->row()->description;
	//$active_sms_service =   $this->db->get_where('settings' , array('type'=>'active_sms_service'))->row()->description;
	 
	?>
<!DOCTYPE html>
<html lang="en" dir="<?php if ($text_align == 'right-to-left') echo 'rtl';?>">
<head>
	
	<title><?php echo $page_title;?> | <?php echo $system_title;?></title>
    
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<meta name="description" content="nvc water providing" />
	<meta name="author" content="nvcwater" />
	
	

	<?php include 'includes_top.php';?>
	
</head> <!--sidebar-collapsed -->
<body class="page-body <?php if ($skin_colour != '') echo 'skin-' . $skin_colour;?>" >
	<div class="page-container <?php if ($text_align == 'right-to-left') echo 'right-sidebar';?>" >
		<?php include $this->session->userdata('login_type').'_navigation.php';?>
		<div class="main-content">
		
			<?php include 'header.php';?>
            
             <!-- Start: Topbar -->
            <header id="topbar">
                  	<input type="text"  id="quick_search" placeholder="searching room number ..." class="pull-right" style="width:250px; margin-top:3px;" value="<?php echo $filter_data;?>"/>
                <div class="topbar-left">
                  <ol class="breadcrumb"> 
                    <li class="crumb-icon">
                      <a href="?">
                        <span class="glyphicon glyphicon-home"></span>
                      </a>
                    </li> 
                    <li class="crumb-trail"><?php echo $page_title;?></li> 
                  </ol>
                </div> 
            </header>

           <!--h3 style="">
           	<i class="entypo-right-circled"></i> 
				< ?php echo $page_title;?>
           </h3-->

			<?php include $account_type.'/'.$sub_folder.''.$page_name.'.php';?>

			<?php include 'footer.php';?>

		</div>
		<?php //include 'chat.php';?>
        	
	</div>
    <?php include 'modal.php';?>
    <?php include 'includes_bottom.php';?>
    
</body>
</html>

<script>

	 $('#quick_search').keypress(function(e) {
        if ( e.keyCode == 13 ) {  // detect the enter key  
		    window.location.href = '<?php echo base_url();?>index.php?admin/quick_search/'+$("#quick_search").val();
        }
    });

	$( "#quick_search" ).autocomplete({
		source: function(request, response) {
              $.ajax({ 
		  		url		: "<?php echo base_url();?>index.php?auto/name_lookup",
                data	: {
                    	'<?php echo $this->security->get_csrf_token_name(); ?>':'<?php echo $this->security->get_csrf_hash(); ?>', 
                    	forwhom_auto: $("#quick_search").val()
                },
                dataType: "json",
                type	: "POST",
                success: function(data){ 
				  response(data);
                }
            });
        },
        minLength: 2,
        select: 
             function(event, ui) {   
                  
       }  
     });
</script>