<?php

class Phone extends Controller {

	function Phone()
	{
		parent::Controller();
                $this->load->library('session');
	}
	
	function call($data)
	{
        	$this->load->library('session');
               // $document = new Document( );

                if($_REQUEST['event']=="NewCall") {
                $document->response("5692");
                $document->collectdtmf('4','#','4000');
                $document->addPlayText("Please Enter the Book. isebean number and terminate with hash eg : 8120305965");
                $_SESSION['state'] = "got book ISBN";
                $document->getXML();

                } else if ($_REQUEST['event']=="GotDTMF" && $_SESSION['state'] == "got book ISBN") {
        	$isbn = $_REQUEST['data'];
        	$document->response("5692");
        	$document->collectdtmf('4','#','4000');
        	$document->addPlayText("we have found book with title so and so. please enter 1and # to continue");
        	$_SESSION['firstNumber']=$isbn;
        	$_SESSION['state'] = "confirm";
        	$document->getXML();
                } else if ($_REQUEST['event']=="GotDTMF" && $_SESSION['state'] == "confirm") {
        	$second = $_REQUEST['data'];
        	$total = $_SESSION['firstNumber']+$second;
        	$document->response("5692");
        	$document->playtext("your book price in flipkart is 123");
        	$document->sendsms("A customer has called to your application for this book : 8120305965","9010789431");
        	$document->hangup();
        
        	$document->getXML();
        	session_destroy();
                }
                
        }
}