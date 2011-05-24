<?php

class Welcome extends Controller {

	function Welcome()
	{
		parent::Controller();	
	}
	
	function index()
	{
		$this->load->view('home');
	}
	
	function about()
	{
		$this->load->view('about');
	}
	
	function contact()
	{
		$data = array(
				'message' => "You can send us an Email : contact@mydiscountbay.com"
			);
			$this->load->view('message',$data);
	}
	
	function form()
	{
    
		$title = $this->input->post('s');
		//$this->google->search($title,"www.flipkart.com");
		//$this->search($isbn);
		if($this->isbn->check($title))
		{
			$this->bookpage($title);
			
		}
		else{
		$results = array(
		//'resultsfk' => $this->google->search($title,"www.flipkart.com"),
		//'resultsib' => $this->google->search($title,"www.infibeam.com")
		'resultsfk' => $this->google->twosearch($title),
		'resultsib' => ""
		);
   
		$this->load->view('results',$results); }
	}
	
	function bookpage($isbn)
	{
		
		if(!$this->isbn->check($isbn))
		{
			
			$data = array(
				'message' => "The ISBN number is not Valid Sorry for in the inconveniance"
			);
			$this->load->view('message',$data);
		}
		else{
			
			$flipkart=$this->flipkart->getdata_html($isbn);
			
			$amazon=$this->amazon->getdata($isbn);
			if($amazon)
			{
				$title = $amazon['title'];
				$author = $amazon['author'];
				$publisher = $amazon['publisher'];
				$desc = $amazon['description'];
				if(isset($img))
				$img = $amazon['medimage'];
				else
				$img= $this->google->fkimgurl($isbn);//make title author and publisher from flipkart.
			}
			else
			{
				$title = $flipkart['title'];
				$author = $flipkart['author'];
				$publisher = "No Data";
				$desc = NULL;
				$img = $this->google->fkimgurl($isbn);//make title author and publisher from flipkart.
			}
			
			
			
			//book review
			$goodread = $this->goodread->rev($isbn);
			
			
			$bookdata = array(
				'title' => $title,
				'author' => $author,
				'fkprice'=> $flipkart['price'],
				'img'=>$img,
				'review'=>$goodread,
				'publisher'=>$publisher,
				'isbn'=>$isbn,
				'description' => $desc  );
	
			$this->load->view('abook',$bookdata); 
			
					
		}
					
					
	}
	
	function bookpageold($isbn)
	{
		
		if(!$this->isbn->check($isbn))
		{
			
			$data = array(
				'message' => "The ISBN number is not Valid Sorry for in the inconveniance"
			);
			$this->load->view('message',$data);
		}
		else{
			
			$flipkart=$this->flipkart->getdata_html($isbn);
			
			$amazon=$this->amazon->getdata($isbn);
			if($amazon)
			{
				$title = $amazon['title'];
				$author = $amazon['author'];
				$publisher = $amazon['publisher'];
				$desc = $amazon['description'];
				$img = $amazon['medimage'];
			}
			else
			{	echo "in else path";
				$title = $flipkart['title'];
				$author = $flipkart['author'];
				$publisher = "No Data";
				$desc = "No Data Avalible ";
				$img = $this->google->fkimgurl($isbn);//make title author and publisher from flipkart.
			}
			
			
			//book review
			$goodread = $this->goodread->rev($isbn);
			
			
			//book Prices
			$aoneprice=$this->getprices->aonebooks($isbn);
			$fgprice=$this->getprices->flipgraph($isbn);
			$rbprice=$this->getprices->rediffbooks($isbn);
			$ibprice=$this->getprices->infibeam($isbn);
			$lmprice=$this->getprices->landmark($isbn);
			$oddprice=$this->getprices->odyssey($isbn);
			
			
			$bookdata = array(
				'title' => $title,
				'author' => $author,
				'fkprice'=> $flipkart['price'],
				'fgprice'=> $fgprice,
				'aoneprice'=>$aoneprice,
				'ibprice'=>$ibprice,
				'rbprice'=>$rbprice,
				'lmprice'=>$lmprice,
				'oddprice'=>$oddprice,
				'img'=>$img,
				'review'=>$goodread,
				'publisher'=>$publisher,
				'isbn'=>$isbn,
				'description' => $desc  );
	
			$this->load->view('book',$bookdata); 
			
					
		}
					
					
	}
	
	
	
	function gsearch($title)
	{
		
		$this->google->search($title,"www.flipkart.com");
		
	}
	
	function amazon($title)
	{
		
		$amazon=$this->amazon->getdata($title);
		print_r($amazon);
		if($amazon)
		{
		echo $amazon['title'];
		echo $amazon['author'];
		echo $amazon['publisher'];
		echo $amazon['description'];
		echo $amazon['medimage'];
		echo $amazon['smallimage'];
		}
	
	}
	
	
	function goodread($title)
	{
		
		$goodread = $this->goodread->rev($title);
		echo $goodread;
		
	}
	function goodreads()
	{
		
		$title = $this->input->post('s');
		$goodread = $this->goodread->rev($title);
		echo $goodread;
		
	}
	
	function flipkart($title)
	{
		
		$flipkart=$this->flipkart->getdata_html($title);
		//echo $flipkart;
		
	}
	
	function bookprices($isbn13)
	{
		
		$flipkart=$this->getprices->aonebooks($isbn13);
		echo $flipkart;
		echo "<br>";
		$flipkart=$this->getprices->flipgraph($isbn13);
		echo $flipkart;
		echo "<br>";
		$flipkart=$this->getprices->rediffbooks($isbn13);
		echo $flipkart;
		echo "<br>";
		$flipkart=$this->getprices->infibeam($isbn13);
		echo $flipkart;
		echo "<br>";
		$flipkart=$this->getprices->landmark($isbn13);
		echo $flipkart;
		echo "<br>";
		$flipkart=$this->getprices->odyssey($isbn13);
		echo $flipkart;
		echo "<br>";
		$flipkart=$this->flipkart->getdata($isbn13);
		echo $flipkart['price'];
	}
	
	
	function syr($isbn13)
	{
		
		$flipkart=$this->getprices->bookadda($isbn13);
		echo "<br> new";
		echo $flipkart;
		echo "<br>";
	}
	
}
/*nd of file welcome.php */
/* Location: ./system/application/controllers/welcome.php */