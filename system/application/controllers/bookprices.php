<?php
class Bookprices extends Controller {

	function Welcome()
	{
		parent::Controller();	
	}
        
        function index()
        {
            $this->load->view('home');
        }
        
        function rediffbooks()
        {
                $isbn = $this->input->post('isbn');
                $rediffprice=$this->getprices->rediffbooks($isbn);
		echo "Rs ".$rediffprice;
	}
        
        
        
        function aonebooks()
        {
                $isbn = $this->input->post('isbn');
                $aoneprice=$this->getprices->aonebooks($isbn);
		echo "Rs ".$aoneprice;
	}
        
        function flipgraph()
        {
                $isbn = $this->input->post('isbn');
                $fgprice=$this->getprices->flipgraph($isbn);
		echo "Rs ".$fgprice;
	}
        
        
        function infibeam()
        {
                $isbn = $this->input->post('isbn');
                $ibprice=$this->getprices->infibeam($isbn);
		echo "Rs ".$ibprice;
	}
        
        
        function landmark()
        {
                $isbn = $this->input->post('isbn');
                $lmprice=$this->getprices->landmark($isbn);
		echo "Rs ".$lmprice;
	}
        
        
        function odyssey()
        {
                $isbn = $this->input->post('isbn');
                $oddprice=$this->getprices->odyssey($isbn);
		echo "Rs ".$oddprice;
	}
	
	 function indiaplaza()
        {
                $isbn = $this->input->post('isbn');
                $indiaplaza=$this->getprices->indiaplaza($isbn);
		echo "Rs ".$indiaplaza;
	}
	
	function crossword()
        {
                $isbn = $this->input->post('isbn');
                $crossword=$this->getprices->crossword($isbn);
		echo "Rs ".$crossword;
	}
        
        function pustak()
	{
		$isbn = $this->input->post('isbn');
                $pustak=$this->getprices->pustak($isbn);
		echo "Rs ".$pustak;
	}
        
	function tradus()
	{
		$isbn = $this->input->post('isbn');
                $tradus=$this->getprices->tradus($isbn);
		echo "Rs ".$tradus;
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
			
			//$flipkart=$this->flipkart->getdata_html($isbn);
			
			
				$title = "some title";
				$author = "some author";
				$publisher = "some publisher";
				$desc = "some description";
				$img = "http://localhost/search/images/twitter.jpg";
						
			//book review
			//$goodread = $this->goodread->rev($isbn);
			$goodread="some review";
			
			//book Prices
			//$aoneprice=$this->getprices->aonebooks($isbn);
			//$fgprice=$this->getprices->flipgraph($isbn);
			//$rbprice=$this->getprices->rediffbooks($isbn);
			//$ibprice=$this->getprices->infibeam($isbn);
			//$lmprice=$this->getprices->landmark($isbn);
			//$oddprice=$this->getprices->odyssey($isbn);
			
			
			$bookdata = array(
				'title' => $title,
				'author' => $author,
				'fkprice'=> "Rs 123",
				'fgprice'=> "Rs 123",
				'aoneprice'=>"Rs 123",
				'ibprice'=>"Rs 123",
				'rbprice'=>"Rs 123",
				'lmprice'=>"Rs 123",
				'oddprice'=>"Rs 123",
				'img'=>$img,
				'review'=>$goodread,
				'publisher'=>$publisher,
				'isbn'=>$isbn,
				'description' => $desc  );
	
			$this->load->view('abook',$bookdata); 
			
					
		}
					
					
	}
	
        
        
        
}