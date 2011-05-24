<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 

class Getprices {

    function getprices()
    {
        $this->CI =& get_instance();
        $this->CI->load->library('isbn');
    }
        
    function flipgraph($isbn10)
    {
        //no problems works fine  
        $yql_base_url = "http://query.yahooapis.com/v1/public/yql";
        $yql_q_root = "select * from html where url=\"http://www.flipgraph.com/product/books/";
        $yql_tail = "/1/\" and xpath=\"//strong[@class=\'flipRate\']\"";

   
        $yql_query = $yql_q_root.$isbn10.$yql_tail;
        $yql_query_url = $yql_base_url . "?q=" . urlencode($yql_query);
   
        $session = curl_init($yql_query_url);
        curl_setopt($session, CURLOPT_RETURNTRANSFER,true);
        $xml_response = curl_exec($session);
        
        $parsed_xml = simplexml_load_string($xml_response);
        //print_r($parsed_xml);   
         //echo "<br>flipgraph Price: ";
         //echo $parsed_xml->results->strong->span;
        if(isset($parsed_xml->results->strong->span))
        return trim(str_replace("Rs.", "", $parsed_xml->results->strong->span));
        else
        return "N/A";
          
          
    }
   
   
   function aonebooks($isbn10)
   {
        $yql_base_url = "http://query.yahooapis.com/v1/public/yql";
        $yql_q_root = "select * from html where url=\"http://www.a1books.co.in/searchdetail.do?a1Code=booksgoogle&itemCode=";
        $yql_tail = "\" and xpath=\"//span[@class=\'salePrice\']\"";

        $yql_query = $yql_q_root.$isbn10.$yql_tail;
        $yql_query_url = $yql_base_url . "?q=" . urlencode($yql_query);
   
        $session = curl_init($yql_query_url);
        curl_setopt($session, CURLOPT_RETURNTRANSFER,true);
        $xml_response = curl_exec($session);
        //print_r($xml_response);
        $parsed_xml = @simplexml_load_string($xml_response);
         //print_r($parsed_xml);
         //echo $parsed_xml->results->span;
         if(isset($parsed_xml->results->span))
         return trim(str_replace("INR", "", $parsed_xml->results->span));
         else
         return "N/A";
        //print_r($parsed_xml);     
             
   }
   
   
   function rediffbooks($isbn10)
   {
        $yql_base_url = "http://query.yahooapis.com/v1/public/yql";
        $yql_q_root = "select * from html where url=\"http://books.rediff.com/book/ISBN:";
        $yql_tail = "\" and xpath=\"//strong\"";

        $yql_query = $yql_q_root.$isbn10.$yql_tail;
        $yql_query_url = $yql_base_url . "?q=" . urlencode($yql_query);
   
        $session = curl_init($yql_query_url);
        curl_setopt($session, CURLOPT_RETURNTRANSFER,true);
        $xml_response = curl_exec($session);
        //print_r($xml_response);
        $parsed_xml = simplexml_load_string($xml_response);
         //echo "<br>Rediff Books Price";
         //echo $parsed_xml->results->strong;
         //print_r($parsed_xml);
         //echo "Rediff Book Price: ".$parsed_xml->results->Strong[5];
         $rediff=$parsed_xml->asXML();
         //echo $rediff;
         //parse_str($rediff);
         $s1=stripos($rediff,"Rs.");
         $s2=stripos($rediff,"Free");
         $rediff_price = trim(str_replace("Rs.", "",strip_tags(substr($rediff,$s1,$s2-$s1))));
         if (strlen($rediff_price) !=0)
            return $rediff_price;
         else
            return "N/A"; 
         
    }
   
   
   function infibeam($isbn10)
   {
        $yql_base_url = "http://query.yahooapis.com/v1/public/yql";
        $yql_q_root = "select * from html where url=\"http://www.infibeam.com/Books/search?q=";
        $yql_tail = "\" and xpath=\"//span[@class=\'infiPrice amount\']\"";

        $yql_query = $yql_q_root.$isbn10.$yql_tail;
        $yql_query_url = $yql_base_url . "?q=" . urlencode($yql_query);
   
        $session = curl_init($yql_query_url);
        curl_setopt($session, CURLOPT_RETURNTRANSFER,true);
        $xml_response = curl_exec($session);
        //print_r($xml_response);
        $parsed_xml = @simplexml_load_string($xml_response);
         //echo "<br>infibeam Books ";
         
         if(isset($parsed_xml->results->span))
         return trim(strip_tags($parsed_xml->results->span));
         else
         return "N/A";
         
        //return $parsed_xml->results->span->asXML();
          
     //    print_r($phpObj);     
   }
   
   
   
   function landmark($isbn10)
   {
        //url="http://www.landmarkonthenet.com/product/SearchPaging.aspx?code=9780755347544&type=0&num=0"
        //and xpath="//span[@id=\'ctl00_ContentPlaceHolder1_rptBook_ctl00_lblsplprice\']"
        $yql_base_url = "http://query.yahooapis.com/v1/public/yql";
        $yql_q_root = "select * from html where url=\"http://www.landmarkonthenet.com/product/SearchPaging.aspx?code=";
        $yql_tail = "&type=0&num=0\" and  xpath=\"//span[@id=\'ctl00_ContentPlaceHolder1_rptBook_ctl00_lblsplprice\']\"";

        $yql_query = $yql_q_root.$isbn10.$yql_tail;
        $yql_query_url = $yql_base_url . "?q=" . urlencode($yql_query);
   
        $session = curl_init($yql_query_url);
        curl_setopt($session, CURLOPT_RETURNTRANSFER,true);
        $xml_response = curl_exec($session);
        //print_r($xml_response);
        $parsed_xml = @simplexml_load_string($xml_response);
         //echo "<br>infibeam Books ";
         
         if(isset($parsed_xml->results->span))
         return trim(strip_tags(str_replace("/-", "",$parsed_xml->results->span)));
         else
         return "N/A";
         
        //return $parsed_xml->results->span->asXML();
          
     //    print_r($phpObj);     
   }
   
    
    
     function odyssey($isbn10)
   {
        //url="http://www.odyssey360.com/searchresults.aspx?srchQuery=1&isbn=9781849162753&catagory=0&price=NULL&format=NULL"
        //and xpath="//font"
        $yql_base_url = "http://query.yahooapis.com/v1/public/yql";
        $yql_q_root = "select * from html where url=\"http://www.odyssey360.com/searchresults.aspx?srchQuery=1&isbn=";
        $yql_tail = "&catagory=0&price=NULL&format=NULL\" and  xpath=\"//font\"";

        $yql_query = $yql_q_root.$isbn10.$yql_tail;
        $yql_query_url = $yql_base_url . "?q=" . urlencode($yql_query);
   
        $session = curl_init($yql_query_url);
        curl_setopt($session, CURLOPT_RETURNTRANSFER,true);
        $xml_response = curl_exec($session);
        //print_r($xml_response);
        $parsed_xml = @simplexml_load_string($xml_response);
         //echo "<br>infibeam Books ";
         //echo $parsed_xml->results->font->strong;
         //print_r ($parsed_xml);
         $data = $parsed_xml->xpath("//strong");
         if(isset($data[0][0]))
         $oddprice = $data[0][0];
         else
         $oddprice="";
         
         $oddprice = trim(str_replace("Rs.", "",$oddprice));
         if (strlen($oddprice) !=0)
            return $oddprice;
         else
            return "N/A"; 
         
   }


    function indiaplaza($isbn)
    {
        
        $url = 'http://www.indiaplaza.in/search.aspx?catname=Books&srchkey=&srchVal='.$isbn;
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt( $ch, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows; U; Windows NT 5.1; rv:1.7.3) Gecko/20041001 Firefox/0.10.1" );
        curl_setopt($ch, CURLOPT_MAXREDIRS, 10);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        
        $body = curl_exec($ch);
        $retcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);
        
        //print_r($body);
        $body = str_get_html($body);
       /* if (isset($body->find('span[style="color:#ac021e;"]', 0)->plaintext)) {
            $price=trim(str_replace("Rs.","",$body->find('span[style="color:#ac021e;"]', 0)->plaintext));
            return substr($price,0,strrpos($price," "));
        }
        else
        return "N/A"; */
       
       foreach($body->find('div[class="tier1box2"]') as $article) {
          $price=$article->plaintext;
          //print_r($price);
          $s1=stripos($price,"Our Price : Rs.");
         $s2=stripos($price,"List");
        $fprice = trim(str_replace("Our Price : Rs.", "",strip_tags(substr($price,$s1,$s2-$s1))));
        return $fprice;
          }
          return 'N/A';
         
    }

    function crossword($isbn)
    {
        
        $url = 'http://www.crossword.in/books/search?q='.$isbn;
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt( $ch, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows; U; Windows NT 5.1; rv:1.7.3) Gecko/20041001 Firefox/0.10.1" );
        curl_setopt($ch, CURLOPT_MAXREDIRS, 10);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        
        $body = curl_exec($ch);
        $retcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);
        
        //print_r($body);
        $body = str_get_html($body);
        if (isset($body->find('span[class="variant-final-price"]', 0)->plaintext)) {
            $price=trim(str_replace("R","",$body->find('span[class="variant-final-price"]', 0)->plaintext));
            //return substr($price,0,strrpos($price," "));
            return $price;
        }
        else
        return "N/A";
       
    }
    
    
    
    function pustak($isbn)
    {
        
        $url = 'http://www.pustak.co.in/pustak/books/search?searchType=book&q='.$isbn.'&page=1&type=genericSearch';
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt( $ch, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows; U; Windows NT 5.1; rv:1.7.3) Gecko/20041001 Firefox/0.10.1" );
        curl_setopt($ch, CURLOPT_MAXREDIRS, 10);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        
        $body = curl_exec($ch);
        $retcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);
        
        //print_r($body);
        $body = str_get_html($body);
        if (isset($body->find('span[class="prod_pg_prc_font"]', 0)->plaintext)) {
            $price=trim(str_replace("INR","",$body->find('span[class="prod_pg_prc_font"]', 0)->plaintext));
            //return substr($price,0,strrpos($price," "));
            return $price;
        }
        else
        return "N/A";
    }
    
    function tradus($isbn)
    {
        $url = 'http://www.tradus.in/search/tradus_search/'.$isbn.'?filters=tid:357';
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt( $ch, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows; U; Windows NT 5.1; rv:1.7.3) Gecko/20041001 Firefox/0.10.1" );
        curl_setopt($ch, CURLOPT_MAXREDIRS, 10);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        
        $body = curl_exec($ch);
        $retcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);
        
        //print_r($body);
        $body = str_get_html($body);
              
       foreach($body->find('div[class="prsng"]') as $article) {
          $price=$article->plaintext;
          $s1=stripos($price,"Offer:");
         $s2=stripos($price,"Save:");
        $fprice = trim(str_replace("Offer:", "",strip_tags(substr($price,$s1,$s2-$s1))));
        return $fprice;
          }
          return 'N/A';
    }
    
    function syr($isbn)
    {
        
        $url = 'http://www.stackyourrack.com/search-query='.$isbn;
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt( $ch, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows; U; Windows NT 5.1; rv:1.7.3) Gecko/20041001 Firefox/0.10.1" );
        curl_setopt($ch, CURLOPT_MAXREDIRS, 10);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        
        $body = curl_exec($ch);
        $retcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);
        
        //print_r($body);
        $body = str_get_html($body);
        if (isset($body->find('span[class="price_discount_srch"]', 0)->plaintext)) {
            $price=$body->find('span[class="price_discount_srch"]', 0)->plaintext;
            
          //print_r($price);
         
        $fprice = trim(str_replace("Rs.", "",$price));
        return $fprice;
            
        }
        else
        return "N/A";
    }
    
    
    
    function bookadda($isbn)
    {
        
        $url = 'http://www.bookadda.com/search/'.$isbn;
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt( $ch, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows; U; Windows NT 5.1; rv:1.7.3) Gecko/20041001 Firefox/0.10.1" );
        curl_setopt($ch, CURLOPT_MAXREDIRS, 10);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        
        $body = curl_exec($ch);
        $retcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);
        
        //print_r($body);
        $body = str_get_html($body);
        if (isset($body->find('span[class="boldtext ourpriceredtext"]', 0)->plaintext)) {
            $price=$body->find('span[class="boldtext ourpriceredtext"]', 0)->plaintext;
            
          //print_r($price);
         
        $fprice = trim(str_replace("Rs.", "",$price));
        return $fprice;
            
        }
        else
        return "N/A";
    }
    

}
