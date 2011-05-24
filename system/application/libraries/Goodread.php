<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 

class Goodread{
    
    function goodread()
    {
         $this->CI =& get_instance();
         $this->CI->load->library('isbn');
        
    }

    function rev($isbn)
    {
        
         if($this->CI->isbn->check($isbn))
	{
			
                        if($this->CI->isbn->gettype($isbn)==10)
			$isbn=$isbn;
			elseif($this->CI->isbn->gettype($isbn)==13)
			$isbn = $this->CI->isbn->isbn13to10($isbn);
            $url = "http://www.goodreads.com/book/isbn?isbn=".$isbn."&key=FKPRByOkrI94KBiIjKtsQ";
            $session = curl_init($url);
            curl_setopt($session, CURLOPT_RETURNTRANSFER,true);
            $xml_response = curl_exec($session);
            $retcode = curl_getinfo($session, CURLINFO_HTTP_CODE);
            //echo $retcode;
            //echo $xml_response;
            try{ $parsed_xml = simplexml_load_string($xml_response,NULL, LIBXML_NOERROR | LIBXML_NOWARNING); }
            catch(Exception $e){ echo $e->getMessage();}
            
            
            $i=1;
            $review = " ";
        
            if (!isset($parsed_xml->book->reviews->review)) { 
            return false; }
            foreach($parsed_xml->book->reviews->review as $book)
            {
                $review = $review . "<p> Name  ".$book->user->name."<br> Review : ". $book->body."</p> ";
                //echo $book->user->name."name <br>";->asXML()
                //echo $book->body."body <br>";
                //echo $book->reviews->review."<br>";
                //echo $book->isbn."<br>";
                $i=$i+1;
                if($i==6)
                return $review;
            }
        }
        else{
            
            return false;
        }
        
   }


}
