<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 

class Flipkart{
    
     function flipkart()
        {
            $this->CI =& get_instance();
            $this->CI->load->library('isbn');
            $this->CI->load->helper('dom_helper');
        }

    function getdata($isbn)
   {
         if(!$this->CI->isbn->check($isbn))
            return False;
        $yql_base_url = "http://query.yahooapis.com/v1/public/yql";
        $yql_q_root = "select * from html where url=\"http://www.flipkart.com/search-book?affid=INsandeep2&query=";
        $yql_tail = "\" and xpath=\"//span[@class]\"";
   
        $yql_query = $yql_q_root.$isbn.$yql_tail;
        $yql_query_url = $yql_base_url . "?q=" . urlencode($yql_query);
   
       // $yql_query_url .= "&format=json";
        $session = curl_init($yql_query_url);
        curl_setopt($session, CURLOPT_RETURNTRANSFER,true);
        $xml_response = curl_exec($session);
        
        //print_r ($xml_response);
        
        $parsed_xml = @simplexml_load_string($xml_response);
        //echo "<br>Flipkart Price: ";
        
        
        $data = $parsed_xml->xpath("//span[@class=\"product_our_price\"]");
        if(isset($data[0][0]))
        {
            $fkprice = $data[0][0];
            $fkprice = trim(str_replace("Rs.", "",$fkprice));
        }
         
                  
        $data = $parsed_xml->xpath("//span[@class=\"item_summary_title\"]");
        if(isset($data[0][0]))
        $fktitle = $data[0][0];
        
        $data = $parsed_xml->xpath("//span[@class=\"item_summary_title_author\"]/a");
        if(isset($data[0][0]))
        $fkauthor = $data[0][0];
        
        
       $fkdata =  array(
                        'title' => $fktitle,
                        'author'=> $fkauthor,
                        'price' => $fkprice
                    );
        return $fkdata;
    
    }
    
    function getdata_noyql($isbn)
    {
        if($this->CI->isbn->check($isbn))
         {
           /*
        $yql_base_url = "http://query.yahooapis.com/v1/public/yql";
        $yql_q_root = "select * from html where url=\"http://www.flipkart.com/search-book?dd=0&query=";
        $yql_tail = "\" and xpath=\"//span[@class=\'product_our_price\']|//span[@class=\'item_summary_title\']|//span[@class=\'item_summary_title_author\']\"";
   
        $yql_query = $yql_q_root.$isbn.$yql_tail;
        $yql_query_url = $yql_base_url . "?q=" . urlencode($yql_query);*/
    
        $url = 'http://www.flipkart.com/search-book?affid=INsandeep2&query='.$isbn;
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt( $ch, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows; U; Windows NT 5.1; rv:1.7.3) Gecko/20041001 Firefox/0.10.1" );
        curl_setopt($ch, CURLOPT_MAXREDIRS, 10);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        //curl_setopt($ch, CURLOPT_REFERER, 'http://www.flipkart.com');
        $body = curl_exec($ch);
        $retcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);
        
        //print_r($body);
        $reurl = substr($body,strpos($body,"http://"));
        //print_r( $reurl);
        
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $reurl);
        curl_setopt( $ch, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows; U; Windows NT 5.1; rv:1.7.3) Gecko/20041001 Firefox/0.10.1" );
        curl_setopt($ch, CURLOPT_MAXREDIRS, 10);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        //curl_setopt($ch, CURLOPT_REFERER, 'http://www.flipkart.com');
        $body = curl_exec($ch);
        $retcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);
        
        //print_r($body);
        
        $nonhtml=strip_tags($body, '<span>' );
         //<span class="product_our_price">Rs. 489</span> <span class="item_summary_title_title">
         //class="item_summary_title_author">
        //$parsed_xml = simplexml_load_string($body);
             
        //print_r($nonhtml);
        $nonhtml = strstr($nonhtml, 'item_summary_title_title');
                        
        $endpos= strpos($nonhtml,'</span>');
        $startpos= strpos($nonhtml,'>')+1;
        $fktitle = trim(substr($nonhtml,$startpos,$endpos-$startpos));
        //echo "<br>title: " .$title;
        
        
        $nonhtml = strstr($nonhtml, 'item_summary_title_author');
                        
        $endpos= strpos($nonhtml,'</span>');
        $startpos= strpos($nonhtml,'>')+1;
        $fkauthor = trim(substr($nonhtml,$startpos,$endpos-$startpos));
        //echo "<br>author: " .$author;
        
        $nonhtml = strstr($nonhtml, 'product_our_price');
                        
        $endpos= strpos($nonhtml,'</span>');
        $startpos= strpos($nonhtml,'Rs.')+3;
        $fkprice = trim(substr($nonhtml,$startpos,$endpos-$startpos));
        //echo "<br>price: " .$price;
        
        $fkdata =  array(
                        'title' => $fktitle,
                        'author'=> $fkauthor,
                        'price' => $fkprice
                    );
        return $fkdata;
                             
        }
        else{
        return false;}
    }
    
    
    
     function getdata_html($isbn)
    {
        if($this->CI->isbn->check($isbn))
         {
    
        $url = 'http://www.flipkart.com/search-book?affid=INsandeep2&query='.$isbn;
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt( $ch, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows; U; Windows NT 5.1; rv:1.7.3) Gecko/20041001 Firefox/0.10.1" );
        curl_setopt($ch, CURLOPT_MAXREDIRS, 10);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        //curl_setopt($ch, CURLOPT_REFERER, 'http://www.flipkart.com');
        $body = curl_exec($ch);
        $retcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);
        
        
        $reurl = substr($body,strpos($body,"http://"));
       
       
        //$body = file_get_html($url);
        //print_r($reurl);
         $body = file_get_html($reurl);
        //print_r($body);
        //$body = str_get_html($body);



        $fkauthor =" ";
        /*
        foreach($body->find('div[class="search_result_list"]') as $article) {
          $item['title']     = $article->find('div[class="unit size4of5 lastUnit right"]', 0)->find('a',0)->plaintext;
          $item['author']    = $article->find('span[class="head-tail"]', 0)->find('a',0)->plaintext;
          $item['price']    = trim(str_replace("Rs.","",$article->find('b[class="price"]', 0)->plaintext));
          //$item['price'] = trim(str_replace("Rs.", "",$article->find('span[class="search_results_price"]', 0)->find('b',0)->plaintext));
          $articles[] = $item;
          }
          //print_r($item);
          //print_r($articles);
        
        
        
        foreach($body->find('div[class="line search_result_title"]') as $e){
        $fkurl =  strip_tags($e);}
        */
        //print_r($fkurl);
        
        foreach($body->find('span[class="price our fksk-our"]') as $e){
        $fkprice =  strip_tags($e);}
        
        foreach($body->find('div[class="primary-info"]') as $e)
        $fkauthor = strip_tags($e).", ". $fkauthor  ;
                
        foreach($body->find('div[class="mprod-summary-title fksk-mprod-summary-title"]') as $e){
        $fktitle =  strip_tags($e);}
        //$fktitle = strip_tags($body->find('span[class="item_summary_title_title"]'));
        
        
        $fkdata =  array(
                        'title' => $fktitle,
                        'author'=> $fkauthor,
                        'price' => trim(str_replace("Rs.", "",$fkprice))
                    );
        //print_r($fkdata); 
        
        return $fkdata;
                           
        }
        else{
        return false;}
    }
    
    
    
    
    
    
    


}