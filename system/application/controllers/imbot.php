<?php

class Imbot extends Controller {

	function Imbot()
	{
		parent::Controller();	
	}
	
	function index()
	{
		$title = $this->input->post('msg');
		//echo "this is what we fount <br>".$title;
		if($this->isbn->check($title))
		{
			$isbn=$title;
			//$aoneprice=$this->getprices->aonebooks($isbn);
			//$fgprice=$this->getprices->flipgraph($isbn);
			//$rbprice=$this->getprices->rediffbooks($isbn);
			//$ibprice=$this->getprices->infibeam($isbn);
			$lmprice=$this->getprices->landmark($isbn);
			$oddprice=$this->getprices->odyssey($isbn);
			$flipkart=$this->flipkart->getdata_html($isbn);
			
			//echo "we are searching for the book";
			echo "book title :". $flipkart['title'];
			echo "Flipkart Price :". $flipkart['price'];
			echo "<br>Landmark Price :". $lmprice;
			echo "<br>odyssey Price :". $oddprice;
			//echo "<br>infibeam Price :". $lbprice;
			//echo "<br>rediff Books Price :". $rbprice;
		}
		else
		echo "No Book fount with that ISBN";
	}
	
}