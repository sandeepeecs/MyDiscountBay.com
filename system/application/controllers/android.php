<?php

class Android extends Controller {

	function Welcome()
	{
		parent::Controller();	
	}
	
	function index()
	{
		$this->load->view('home');
	}
        
        function write_xml() {
    // Load XML writer library
            $this->load->library('MY_Xml_writer');
    
    // Initiate class
            $xml = new MY_Xml_writer;
            $xml->setRootName('mdb');
            $xml->initiate();
    
    // Start branch 1
           // $xml->startBranch('bookdetails');
    
    // Set branch 1-1 and its nodes
           // $xml->startBranch('bookdetails', array('country' => 'usa')); // start branch 1-1
            $xml->startBranch('bookdetails');           
            $xml->addNode('title', 'book-title');
            $xml->addNode('author', 'book-author');
           // $xml->addNode('author', 'bookauthor', array(), true);
            $xml->endBranch();
    
    // Set branch 1-2 and its nodes
            $xml->startBranch('bookprices');
            $xml->addNode('flipkart', 'Toyota');
            $xml->addNode('infibeam', 'Corolla');
            $xml->addNode('iandmark', 'Corolla');
            $xml->endBranch();
    
    // End branch 1
         //   $xml->endBranch();
        
    // Start branch 2
         /*   $xml->startBranch('bikes'); // start branch
        
    // Set branch 2-1  and its nodes
            $xml->startBranch('bike', array('country' => 'usa')); // start branch
            $xml->addNode('make', 'Harley-Davidson');
            $xml->addNode('model', 'Soft tail', array(), true);
            $xml->endBranch();
    
    // End branch 2
            $xml->endBranch();*/
    
    // Print the XML to screen
            $xml->getXml(true);
        }
        
        
    function prices($isbn) {
        $this->load->library('MY_Xml_writer');
    
        if(!$this->isbn->check($isbn))
		{			
			$message = "The ISBN number is not Valid Sorry for in the inconveniance";
                        echo $message;
			
		}
		else{
			
			$flipkart=$this->flipkart->getdata_html($isbn);
                        $title = $flipkart['title'];
			$author = $flipkart['author'];
                        $img = $this->google->fkimgurl($isbn);
                        $fkprice= $flipkart['price'];
                        $ibprice=$this->getprices->infibeam($isbn);
                        $lmprice=$this->getprices->landmark($isbn);
                    
    
    
    
    // Load XML writer library
            
    
    // Initiate class
            $xml = new MY_Xml_writer;
            $xml->setRootName('mdb');
            $xml->initiate();
    
    
    
    // Set branch 1-1 and its nodes
           // $xml->startBranch('bookdetails', array('country' => 'usa')); // start branch 1-1
            $xml->startBranch('bookdetails');           
            $xml->addNode('title', $title);
            $xml->addNode('author', $author);
            $xml->addNode('img', $img);
           // $xml->addNode('author', 'bookauthor', array(), true);
            $xml->endBranch();
    
    // Set branch 1-2 and its nodes
             $xml->startBranch('bookprices');
	     $xml->addNode('numberofprices', '3');
	     
	     $xml->startBranch('bookstore');
	     $xml->addNode('bsname', 'Flipkart');
	     $xml->addNode('price', 'Rs. '.$fkprice);
	     $xml->endBranch();
	     
	     $xml->startBranch('bookstore');
	     $xml->addNode('bsname', 'Infibeam');
	     $xml->addNode('price', 'Rs. '.$ibprice);
	     $xml->endBranch();
	     
	     $xml->startBranch('bookstore');
	     $xml->addNode('bsname', 'Landmark');
	     $xml->addNode('price', 'Rs. '.$lmprice);
	     $xml->endBranch();
            
	    
	    /*$xml->addNode('flipkart', 'Rs. '.$fkprice);
            $xml->addNode('infibeam', 'Rs. '.$ibprice);
            $xml->addNode('iandmark', 'Rs. '.$lmprice);*/
            $xml->endBranch();
    
   
            $xml->getXml(true);
        }
        
        
    }
        
        
    
        
        
        
}