<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 

class Google {
    
    function google()
    {
        $this->CI =& get_instance();
        $this->CI->load->library('isbn');
    }
    
    function gsearch($title)
    {
    //This example request includes an optional API key which you will need to
    // remove or replace with your own key.
    // Read more about why it's useful to have an API key.
    // The request also includes the userip parameter which provides the end
    // user's IP address. Doing so will help distinguish this legitimate
    // server-side traffic from traffic which doesn't come from an end-user.
    $url = "http://ajax.googleapis.com/ajax/services/search/web?v=1.0&". "q=".$title."&key=ABQIAAAAALUaFzzv3t014-DQYFa3LLRTSvysYC7I9rNrj0KMl--dyqp8p3BSpFyFz1MZoEWLHAYaSro1d8KBuVw&userip=USERS-IP-ADDRESS";

    // sendRequest
    // note how referer is set manually
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    //curl_setopt($ch, CURLOPT_REFERER, 'http://www.flipkart.com');
    $body = curl_exec($ch);
    curl_close($ch);
    
    // now, process the JSON string
    $json = json_decode($body);
    
    // now have some fun with the results...
    //print_r($json);
    $formattedresults ='';
    foreach($json->responseData->results as $searchresult)
    {
        if($searchresult->GsearchResultClass == 'GwebSearch')
        {
            $formattedresults .= '
            <div class="searchresult">
            <h3><a href="' . $searchresult->unescapedUrl . '">' . $searchresult->titleNoFormatting . '</a></h3>
            <p class="resultdesc">' . $searchresult->content . '</p>
            <p class="resulturl">' . $searchresult->visibleUrl . '</p>
            </div>';
        }
    }
    echo $formattedresults;
    }
    
    function search($title, $domain)
    {

        $url = 'http://ajax.googleapis.com/ajax/services/search/web?rsz=large&v=1.0&q=' . urlencode('site:' . $domain . ' ' . $title )."&key=ABQIAAAALUaFzzv3t014-DQYFa3LLRTSvysYC7I9rNrj0KMl--dyqp8p3BSpFyFz1MZoEWLHAYaSro1d8KBuVw&userip=USERS-IP-ADDRESS";

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        //curl_setopt($ch, CURLOPT_REFERER, 'http://www.flipkart.com');
        $body = curl_exec($ch);
        curl_close($ch);
        $json = json_decode($body);
        //print_r($json);
        $formattedresults="";
        $isbnarray[] = 0;
        $i=1;
        // now $json is an object of Google's search results and we need to iterate through it.

        foreach($json->responseData->results as $searchresult)
        {
            $isbn=$this->get_isbn_url($searchresult->unescapedUrl);
            if($searchresult->GsearchResultClass == 'GwebSearch' && $isbn && !(in_array($isbn, $isbnarray)))
            {
                
                $formattedresults .= '
                <div class="col"> <a href="'.site_url("welcome/bookpage").'/'.$this->get_isbn_url($searchresult->unescapedUrl).'"><img src="'.$this->fkimg($this->get_isbn_url($searchresult->unescapedUrl)).'" alt="book image" /></a>
		<h2><a href="'.site_url("welcome/bookpage").'/'.$isbn.'">'.$searchresult->titleNoFormatting.'</a></h2>
		<p>'.$searchresult->content.'</p></div>';
                array_push($isbnarray, $isbn);
                if($i/4==0)
                $formattedresults.='<div class="x"></div>';
                $i=$i+1;

            }
            
        }
        //print_r($isbnarray);
        return $formattedresults;
        
    }
    
    //searchs two stores and copy past of above code for two stores
    function twosearch($title)
    {

        $url = 'http://ajax.googleapis.com/ajax/services/search/web?rsz=large&v=1.0&q=' . urlencode('site:' ."www.flipkart.com". ' ' . $title )."&key=ABQIAAAALUaFzzv3t014-DQYFa3LLRTSvysYC7I9rNrj0KMl--dyqp8p3BSpFyFz1MZoEWLHAYaSro1d8KBuVw&userip=USERS-IP-ADDRESS";

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        //curl_setopt($ch, CURLOPT_REFERER, 'http://www.flipkart.com');
        $body = curl_exec($ch);
        curl_close($ch);
        $json = json_decode($body);
        //print_r($json);
        $formattedresults="";
        $isbnarray[] = 0;
        $i=1;
        // now $json is an object of Google's search results and we need to iterate through it.

        foreach($json->responseData->results as $searchresult)
        {
            $isbn=$this->get_isbn_url($searchresult->unescapedUrl);
            if($searchresult->GsearchResultClass == 'GwebSearch' && $isbn && !(in_array($isbn, $isbnarray)))
            {
                
                $formattedresults .= '
                <div class="col"> <a href="'.site_url("welcome/bookpage").'/'.$this->get_isbn_url($searchresult->unescapedUrl).'"><img src="'.$this->fkimg($this->get_isbn_url($searchresult->unescapedUrl)).'" alt="book image" /></a>
		<h2><a href="'.site_url("welcome/bookpage").'/'.$isbn.'">'.$searchresult->titleNoFormatting.'</a></h2>
		<p>'.$searchresult->content.'</p></div>';
                array_push($isbnarray, $isbn);
                if($i%4==0)
                $formattedresults.='<div class="x"></div>';
                $i=$i+1;
                //echo ($i%4);

            }
            
        }
        
        
        
        $url = 'http://ajax.googleapis.com/ajax/services/search/web?rsz=large&v=1.0&q=' . urlencode('site:' ."www.infibeam.com". ' ' . $title )."&key=ABQIAAAALUaFzzv3t014-DQYFa3LLRTSvysYC7I9rNrj0KMl--dyqp8p3BSpFyFz1MZoEWLHAYaSro1d8KBuVw&userip=USERS-IP-ADDRESS";

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        //curl_setopt($ch, CURLOPT_REFERER, 'http://www.flipkart.com');
        $body = curl_exec($ch);
        curl_close($ch);
        $json = json_decode($body);
        //print_r($json);
        
        // now $json is an object of Google's search results and we need to iterate through it.

        foreach($json->responseData->results as $searchresult)
        {
            $isbn=$this->get_isbn_url($searchresult->unescapedUrl);
            if($searchresult->GsearchResultClass == 'GwebSearch' && $isbn && !(in_array($isbn, $isbnarray)))
            {
                
                $formattedresults .= '
                <div class="col"> <a href="'.site_url("welcome/bookpage").'/'.$this->get_isbn_url($searchresult->unescapedUrl).'"><img src="'.$this->fkimg($this->get_isbn_url($searchresult->unescapedUrl)).'" alt="book image" /></a>
		<h2><a href="'.site_url("welcome/bookpage").'/'.$isbn.'">'.$searchresult->titleNoFormatting.'</a></h2>
		<p>'.$searchresult->content.'</p></div>';
                array_push($isbnarray, $isbn);
                if($i%4==0)
                $formattedresults.='<div class="x"></div>';
                $i=$i+1;
                //echo ($i%4);

            }
            
        }
        
        
        
        
        
        //print_r($isbnarray);
        return $formattedresults;
        
    }
    
    
    
    
    function fkimg($isbn13)
    {
     
        //echo $url."<br>";
        //$isbn = substr(strrchr($url,"-"),1);
        if(!$this->CI->isbn->check($isbn13))
        {
            return base_url()."images/noimage.jpg";
        }
        $imgurl = "http://img.fkcdn.com/img/".substr($isbn13,10,3)."/".$isbn13.".jpg";
        $ch = curl_init($imgurl);
        curl_setopt($ch, CURLOPT_NOBODY, true);
        curl_exec($ch);
        $retcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        // $retcode > 400 -> not found, $retcode = 200, found.
        curl_close($ch);
        //echo $retcode."<br>";
        if($retcode == 200 && $isbn13 != 0)
        {
            return "http://img.fkcdn.com/img/".substr($isbn13,10,3)."/".$isbn13.".jpg";
        }
        else
        return base_url()."images/noimage.jpg";
    }
    
    
    function fkimgurl($isbn13)
    {
     
        //echo $url."<br>";
        //$isbn = substr(strrchr($url,"-"),1);
        if(!$this->CI->isbn->check($isbn13))
        {
            return base_url()."images/noimage.jpg";
        }
        if($this->CI->isbn->gettype($isbn13)==10)
        $isbn13 = $this->CI->isbn->isbn10to13($isbn13);
	elseif($this->CI->isbn->gettype($isbn13)==13)
	$isbn13=$isbn13;
        
        $imgurl="http://img.fkcdn.com/img/".substr($isbn13,10,3)."/".$isbn13.".jpg";
        $ch = curl_init($imgurl);
        curl_setopt($ch, CURLOPT_NOBODY, true);
        curl_exec($ch);
        $retcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        // $retcode > 400 -> not found, $retcode = 200, found.
        curl_close($ch);
        //echo $retcode."<br>";
        if($retcode == 200 && $isbn13 != 0)
        {
            return "http://img.fkcdn.com/img/".substr($isbn13,10,3)."/".$isbn13.".jpg";
        }
        else
        return base_url()."images/noimage.jpg";
    }
    
    
    
    
    
    function get_isbn_url($url)
    {
        if(substr($url, 11, 8)=="flipkart")
        {
            $isbn = substr(strrchr($url,"-"),1);
            if($this->CI->isbn->check($isbn))
            {
                if($this->CI->isbn->gettype($isbn)== 10)
                $isbn13 =$this->CI->isbn->isbn10to13($isbn);
                else
                $isbn13 = $isbn;
                return $isbn13;
            }
            else
            return 0;    
        }
        elseif (substr($url, 11, 8)=="infibeam")
        {
            $isbn = strrchr($url,"/");
            $isbn = substr($isbn, 1,strpos($isbn,".html")-1);
            if($this->CI->isbn->check($isbn))
            {
                if($this->CI->isbn->gettype($isbn)== 10)
                $isbn13 =$this->CI->isbn->isbn10to13($isbn);
                else
                $isbn13 = $isbn;
                return $isbn13;
            }
            else
            return 0;
        }
        else
        return 0;  
    }
    

    
}