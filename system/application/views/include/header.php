
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="content-type" content="text/html;charset=utf-8" />
	
	<link href="<?php echo base_url();?>main.css" rel="stylesheet" type="text/css" />
	
<script type="text/javascript"> 
function make_blank()
{
document.searchform.s.value ="";
}
</script>
	<title>MyDiscountBay.com - Find cheapest prices in India</title>
<script type="text/javascript">

  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-18625808-1']);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();

</script>
</head>
<body>
	<div  id="content">
		
		
		<ul id="menu">
			<li><a href="<?php echo  site_url("");?>">home</a></li>
			<li><a href="<?php echo  site_url("welcome/about");?>">about</a></li>
			<li><a href="<?php echo  site_url("welcome/contact");?>">contact</a></li>
		</ul>
        <div id="maintitle" style="padding-top: 55px;">
        <h1 style="padding: 0 0 2px 310px;font-style: normal;font-size: 3.5em;font-style: normal;color: #444242;">MyDiscountBay</h1><sup>beta</sup>
        </div>
		<div class="searchbox"><?php $attributes = array('id' => 'search','name'=>'searchform');
		echo form_open('welcome/form', $attributes);?>
		
		<input id="searchfield" type="text" name="s" onclick="make_blank();" value="Enter: Title/Author/ISBN" /> 
		<input id="searchsubmit" type="submit" value="Search" /> 
		<?php echo form_close(); ?>
	</div>
		
		
<!-- end header --> 
