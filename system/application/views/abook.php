
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="content-type" content="text/html;charset=utf-8" />
	<link href="<?php echo base_url();?>main.css" rel="stylesheet" type="text/css" />
	
	<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js"></script>
	<script type="text/javascript" src="<?php echo base_url();?>js/jquery.tablesorter.js"></script>
 <script type="text/javascript">                                         
  $(document).ready(function() {
  
  $.post("<?php echo  site_url("bookprices/rediffbooks");?>", { isbn: "<?php echo $isbn ?>" },
   function(data){
     $("td#pricerb").html(data);
   });
  
  $.post("<?php echo  site_url("bookprices/aonebooks");?>", { isbn: "<?php echo $isbn ?>" },
   function(data){
     $("td#priceaone").html(data);
   });
  
  $.post("<?php echo  site_url("bookprices/flipgraph");?>", { isbn: "<?php echo $isbn ?>" },
   function(data){
     $("td#pricefg").html(data);
   });
  
  $.post("<?php echo  site_url("bookprices/landmark");?>", { isbn: "<?php echo $isbn ?>" },
   function(data){
     $("td#pricelm").html(data);
   });
  
  $.post("<?php echo  site_url("bookprices/odyssey");?>", { isbn: "<?php echo $isbn ?>" },
   function(data){
     $("td#priceod").html(data);
   });
  
  $.post("<?php echo  site_url("bookprices/infibeam");?>", { isbn: "<?php echo $isbn ?>" },
   function(data){
     $("td#priceib").html(data);
   });

   $.post("<?php echo  site_url("bookprices/indiaplaza");?>", { isbn: "<?php echo $isbn ?>" },
   function(data){
     $("td#priceip").html(data);
   });
   
   $.post("<?php echo  site_url("bookprices/crossword");?>", { isbn: "<?php echo $isbn ?>" },
   function(data){
     $("td#pricecw").html(data);
   });

  $.post("<?php echo  site_url("bookprices/pustak");?>", { isbn: "<?php echo $isbn ?>" },
   function(data){
     $("td#pricepu").html(data);
   });
  
  $.post("<?php echo  site_url("bookprices/tradus");?>", { isbn: "<?php echo $isbn ?>" },
   function(data){
     $("td#pricetr").html(data);
   });
  
  
  $(document).ajaxStop(function() {
  $("#hor-minimalist-b").tablesorter(); 
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
	<div id="content">
		<!--<img src="<?php echo base_url();?>images/logo.jpg" align="left" alt="myDiscountBay.com" />-->
		<h1>myDiscountBay.com</h1><sup>Alpha</sup>
		
		<ul id="menu">
			<li><a href="<?php echo  site_url("welcome");?>">home</a></li>
			<li><a href="<?php echo  site_url("welcome/about");?>">about</a></li>
			<li><a href="<?php echo  site_url("welcome/contact");?>">contact</a></li>
		</ul>
		<div class="searchbox"><?php $attributes = array('id' => 'search','name'=>'searchform');
		echo form_open('welcome/form', $attributes);?>
		
		<input id="searchfield" type="text" name="s" onclick="make_blank();" value="Enter: Title/Author/ISBN" /> 
		<input id="searchsubmit" type="submit" value="Search" /> 
		<?php echo form_close(); ?>
	</div>
		
		
<!-- end header --> 


<div class="post">
			<div class="details">
				<img class="double-border" src="<?php echo $img ?>" alt="book image" />
			</div>
			<div class="body">
			<h3>Title : <?php echo $title ?></h3>
				<h3>book store Price's</h3>
				
				<table id="hor-minimalist-b" summary="Book Prices">
					<thead>
						<tr>
					    	<th scope="col">Book Store</th>
					        <th scope="col">Book Price</th>
					        <th scope="col">Free Shipping</th>
					        <th scope="col">Cash on Delivery</th>
						</tr>
					</thead>
					<tbody>
						<tr>
					    	<td><a href="http://www.landmarkonthenet.com/product/SearchPaging.aspx?code=<?php echo $isbn ?>&type=0&num=0" target="_blank" >Landmark </a></td>
					        <td id="pricelm">Loading...</td>
					        <td>Yes</td>
					        <td>No</td>
						</tr>
						<tr>
						<td><a href="http://www.odyssey360.com/searchresults.aspx?srchQuery=1&isbn=<?php echo $isbn ?>&catagory=0&price=NULL&format=NULL" target="_blank" >odyssey </a></td>
						<td id="priceod">Loading...</td>
						<td>No</td>
						<td>No</td>
						</tr>
						<tr>
						<td><a href="http://www.flipkart.com/search-book?affid=INsandeep2&query=<?php echo $isbn ?>" target="_blank" >Flipkart</a></td>
					        <td>Rs <?php echo $fkprice ?></td>
						<td>Yes</td>
						<td>Yes</td>
						</tr>
						<tr>
						<td><a href="http://www.infibeam.com/Books/search?q=<?php echo $isbn ?>" target="_blank" >infibeam </a></td>	
						<td id="priceib">Loading...</td>
						<td>Yes</td>
						<td>Yes</td>
						</tr>
						<tr>
						<td><a href="http://www.flipgraph.com/product/books/<?php echo $isbn ?>/1/" target="_blank" >coinjoos</a></td>	
						<td id="pricefg">Loading...</td>
						<td>Yes</td>
						<td>No</td>
						</tr>
						<tr>
						<td><a href="http://www.a1books.co.in/searchdetail.do?a1Code=booksgoogle&itemCode=<?php echo $isbn ?>" target="_blank" >A1books </a></td>	
						<td id="priceaone">Loading...</td>
						<td>No</td>
						<td>No</td>
						</tr>
						<tr>
						<td><a href="http://books.rediff.com/book/ISBN:<?php echo $isbn ?>" target="_blank" >Rediff books</a></td>	
						<td id="pricerb">Loading...</td>
						<td>No</td>
						<td>No</td>
						</tr>
						<tr>
						<td><a href="http://www.indiaplaza.in/search.aspx?catname=Books&srchkey=&srchVal=<?php echo $isbn ?>" target="_blank" >IndiaPlaza</a></td>	
						<td id="priceip">Loading...</td>
						<td>No</td>
						<td>No</td>
						</tr>
						<tr>
						<td><a href="http://www.crossword.in/books/search?q=<?php echo $isbn ?>" target="_blank" >crossword</a></td>	
						<td id="pricecw">Loading...</td>
						<td>Yes</td>
						<td>No</td>
						</tr>
						<tr>
						<td><a href="http://www.pustak.co.in/pustak/books/search?searchType=book&q=<?php echo $isbn ?>&page=1&type=genericSearch" target="_blank" >pustak</a></td>	
						<td id="pricepu">Loading...</td>
						<td>Yes</td>
						<td>No</td>
						</tr>
						<tr>
						<td><a href="http://www.tradus.in/search/tradus_search/<?php echo $isbn ?>?filters=tid:357" target="_blank" >tradus</a></td>	
						<td id="pricetr">Loading...</td>
						<td>Yes</td>
						<td>No</td>
						</tr>
						
						</tbody>
					</table>
				
			</div>
                        
			<div class="x"></div>
		</div>
		<div class="fullpage"><h2>Book Info</h2><br>
			<h3>Author : <?php echo $author ?></h3><br>
			     <h3>Publisher : <?php echo $publisher ?></h3><br>
		<div class="desc"> <h3>Book Description</h3> <br><?php echo $description ?></div>
		
		<div class="review"><h3>Book Review</h3><br><?php echo $review ?></div>
		<div class="x"></div>
		</div>


</div>

<?php $this->load->view('include/footer');

?>
