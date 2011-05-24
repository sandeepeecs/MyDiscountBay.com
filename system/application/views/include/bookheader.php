
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="content-type" content="text/html;charset=utf-8" />
	<meta name="author" content="Luka Cvrk (www.solucija.com)" />
	<link href="<?php echo base_url();?>main.css" rel="stylesheet" type="text/css" />
	
        
        
 
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js"></script>          
 <script type="text/javascript">                                         
  $(document).ready(function() {
  $.post("http://localhost/search/index.php/bookprices/rediffbooks", { isbn: "<?php echo $isbn ?>" },
   function(data){
     alert("Data Loaded: " + data);
   });
 });
 </script>        
<script type="text/javascript"> 
function make_blank()
{
document.searchform.s.value ="";
}
</script>
	<title>Book Price Comparision site</title>
</head>
<body>
	<div id="content">
		<h1>Deals Bro</h1>
		
		<ul id="menu">
			<li><a href="#">home</a></li>
			<li><a href="#">archive</a></li>
			<li><a href="#">contact</a></li>
		</ul>
		<div class="searchbox"><?php $attributes = array('id' => 'search','name'=>'searchform');
		echo form_open('welcome/form', $attributes);?>
		
		<input id="searchfield" type="text" name="s" onclick="make_blank();" value="Enter: Title/Author/ISBN" /> 
		<input id="searchsubmit" type="submit" value="Search" /> 
		<?php echo form_close(); ?>
	</div>
		
		
<!-- end header --> 

