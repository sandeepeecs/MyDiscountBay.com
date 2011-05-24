<?php

$this->load->view('include/header');
?>

<div class="post">
			<div class="details">
				<img class="double-border" src="<?php echo $img ?>" alt="book image" />
			</div>
			<div class="body">
			<h3><a href="#">Title : <?php echo $title ?></a></h3>
				<h3>book store Price's</h3>
				
				<table id="hor-minimalist-b" summary="Employee Pay Sheet">
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
					        <td>Rs. <?php echo $lmprice ?></td>
					        <td>No</td>
					        <td>No</td>
						</tr>
						<tr>
						<td><a href="http://www.odyssey360.com/searchresults.aspx?srchQuery=1&isbn=<?php echo $isbn ?>&catagory=0&price=NULL&format=NULL" target="_blank" >odyssey </a></td>
						<td>Rs.<?php echo $oddprice ?></td>
						<td>No</td>
						<td>No</td>
						</tr>
						<tr>
						<td><a href="http://www.flipkart.com/search-book?affid=INsandeep2&query=<?php echo $isbn ?>" target="_blank" >Flipkart</a></td>
					        <td>Rs.<?php echo $fkprice ?></td>
						<td>Yes</td>
						<td>Yes</td>
						</tr>
						<tr>
						<td><a href="http://www.infibeam.com/Books/search?q=<?php echo $isbn ?>" target="_blank" >infibeam </a></td>	
						<td>Rs.<?php echo $ibprice ?></td>
						<td>Yes</td>
						<td>Yes</td>
						</tr>
						<tr>
						<td><a href="http://www.flipgraph.com/product/books/<?php echo $isbn ?>/1/" target="_blank" >Flipgraph </a></td>	
						<td>Rs.<?php echo $fgprice ?></td>
						<td>No</td>
						<td>No</td>
						</tr>
						<tr>
						<td><a href="http://www.a1books.co.in/searchdetail.do?a1Code=booksgoogle&itemCode=<?php echo $isbn ?>" target="_blank" >A1books </a></td>	
						<td>Rs.<?php echo $aoneprice ?></td>
						<td>No</td>
						<td>No</td>
						</tr>
						<tr>
						<td><a href="http://books.rediff.com/book/ISBN:<?php echo $isbn ?>" target="_blank" >Rediff books</a></td>	
						<td>Rs.<?php echo $rbprice ?> </td>
						<td>No</td>
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