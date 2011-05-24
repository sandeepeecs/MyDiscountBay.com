<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

 class Amazon
    {
	/*** Your Amazon Access Key Id         * @access private         * @var string      */
        private $public_key     = "AKIAJZZZTS55H6BLB4JQ";
        
        /** * Your Amazon Secret Access Key * @access private  * @var string        */
        private $private_key    = "fP+f1lczhWL5wxkB0Obg25Eaho4K1NIMw/kChux1";
        
        /** * Constants for product types   * @access public     * @var string     */
        /* Only three categories are listed here.  More categories can be found here:
            http://docs.amazonwebservices.com/AWSECommerceService/latest/DG/APPNDX_SearchIndexValues.html */
        
        const MUSIC = "Music";
        const DVD   = "DVD";
        const GAMES = "VideoGames";
	const BOOKS   = "Books";

         function amazon()
        {
            $this->CI =& get_instance();
            $this->CI->load->library('isbn');
        }
        
        
        function getdata($isbn)
        {
            
            if($this->CI->isbn->check($isbn))
		{
			if($this->CI->isbn->gettype($isbn)==10)
			$isbn=$isbn;
			elseif($this->CI->isbn->gettype($isbn)==13)
			$isbn = $this->CI->isbn->isbn13to10($isbn);
		
                //echo "<br>the isbn is ".$isbn."<br>";
		try
		{$result = $this->getItemByAsin($isbn);}
		catch(Exception $e){ echo $e->getMessage();}
		if($result)
		{
			//check each var for isset to find if the info is present (will get some errors sometimes)
                        foreach($result->Items->Item->ItemAttributes->Author as $authorname){
                        $autho = $authorname. " ,"   ;}
                        if(isset($result->Items->Item->EditorialReviews->EditorialReview->Content))
                        $desc=$result->Items->Item->EditorialReviews->EditorialReview->Content;
                        else
                        $desc="No Data Avalible";
			$amazondata = array(			
                                    'title' =>$result->Items->Item->ItemAttributes->Title,
                                    'author' =>$autho,
                                    'Sales_Rank' => $result->Items->Item->SalesRank,
                                    'ASIN' => $result->Items->Item->ASIN,
                                    'ISBN13' => $result->Items->Item->ItemAttributes->EAN,
                                    'binding' => $result->Items->Item->ItemAttributes->Binding,
                                    'numberOfPages'=> $result->Items->Item->ItemAttributes->NumberOfPages,
                                    'publisher' => $result->Items->Item->ItemAttributes->Label,
                                    'price' => $result->Items->Item->ItemAttributes->ListPrice->FormattedPrice,
                                    'publication_date' => $result->Items->Item->ItemAttributes->PublicationDate,
                                    'description'=> $desc,
                                    'medimage'=> $result->Items->Item->MediumImage->URL,
                                    'smallimage'=>$result->Items->Item->SmallImage->URL
                        	);
                
                return $amazondata;
                }
                }
		else
		return false;
            
        }
        
        
        
        /**
         * Check if the xml received from Amazon is valid
         * @param mixed $response xml response to check
         * @return bool false if the xml is invalid
         * @return mixed the xml response if it is valid
         * @return exception if we could not connect to Amazon
         */
	function verifyXmlResponse($response)
        {
            if ($response === False)
            {
                //throw new Exception("Could not connect to Amazon");
                return False;
            }
            else
            {
                if (isset($response->Items->Item->ItemAttributes->Title))
                {
                    return ($response);
                }
                else
                {
                    //throw new Exception("Invalid xml response.");
                    return False;
		}
            }
        }
        
        
        /**
         * Query Amazon with the issued parameters
         * 
         * @param array $parameters parameters to query around
         * @return simpleXmlObject xml query response
         */
         function queryAmazon($parameters)
        {
            return $this->aws("com", $parameters, $this->public_key, $this->private_key);
        }
        
        
        /**
         * Return details of products searched by various types
         * 
         * @param string $search search term
         * @param string $category search category         
         * @param string $searchType type of search
         * @return mixed simpleXML object
         */
         function searchProducts($search, $category, $searchType = "UPC")
        {
            $allowedTypes = array("UPC", "TITLE", "ARTIST", "KEYWORD");
            $allowedCategories = array("Music", "DVD", "VideoGames", "Books");
            
            switch($searchType) 
            {
                case "UPC" :    $parameters = array("Operation"     => "ItemLookup",
                                                    "ItemId"        => $search,
                                                    "SearchIndex"   => $category,
                                                    "IdType"        => "UPC",
                                                    "ResponseGroup" => "Medium");
                                break;
                
                case "TITLE" :  $parameters = array("Operation"     => "ItemSearch",
                                                    "Title"         => $search,
                                                    "SearchIndex"   => $category,
                                                    "ResponseGroup" => "Medium");
                                break;
            
            }
            
            $xml_response = $this->queryAmazon($parameters);
            
            return $this->verifyXmlResponse($xml_response);

        }
        
        
        /**
         * Return details of a product searched by UPC
         * 
         * @param int $upc_code UPC code of the product to search
         * @param string $product_type type of the product
         * @return mixed simpleXML object
         */
         function getItemByUpc($upc_code, $product_type)
        {
            $parameters = array("Operation"     => "ItemLookup",
                                "ItemId"        => $upc_code,
                                "SearchIndex"   => $product_type,
                                "IdType"        => "UPC",
                                "ResponseGroup" => "Medium");
                                
            $xml_response = $this->queryAmazon($parameters);
            
            return $this->verifyXmlResponse($xml_response);

        }
        
        
        /**
         * Return details of a product searched by ASIN
         * 
         * @param int $asin_code ASIN code of the product to search
         * @return mixed simpleXML object
         */
         function getItemByAsin($asin_code)
        {
            $parameters = array("Operation"     => "ItemLookup",
                                "ItemId"        => $asin_code,
                                "ResponseGroup" => "Medium");
                                
            $xml_response = $this->queryAmazon($parameters);
            
            return $this->verifyXmlResponse($xml_response);
        }
        
        
        /**
         * Return details of a product searched by keyword
         * 
         * @param string $keyword keyword to search
         * @param string $product_type type of the product
         * @return mixed simpleXML object
         */
         function getItemByKeyword($keyword, $product_type)
        {
            $parameters = array("Operation"   => "ItemSearch",
                                "Keywords"    => $keyword,
                                "SearchIndex" => $product_type);
                                
            $xml_response = $this->queryAmazon($parameters);
            
            return $this->verifyXmlResponse($xml_response);
        }




function  aws($region,$params,$public_key,$private_key)
{

    $method = "GET";
    $host = "ecs.amazonaws.".$region; // must be in small case
    $uri = "/onca/xml";
    
    
    $params["Service"]          = "AWSECommerceService";
    $params["AWSAccessKeyId"]   = $public_key;
    $params["Timestamp"]        = gmdate("Y-m-d\TH:i:s\Z");
    $params["Version"]          = "2009-03-31";

    /* The params need to be sorted by the key, as Amazon does this at
      their end and then generates the hash of the same. If the params
      are not in order then the generated hash will be different thus
      failing the authetication process.
    */
    ksort($params);
    
    $canonicalized_query = array();

    foreach ($params as $param=>$value)
    {
        $param = str_replace("%7E", "~", rawurlencode($param));
        $value = str_replace("%7E", "~", rawurlencode($value));
        $canonicalized_query[] = $param."=".$value;
    }
    
    $canonicalized_query = implode("&", $canonicalized_query);

    $string_to_sign = $method."\n".$host."\n".$uri."\n".$canonicalized_query;
    
    /* calculate the signature using HMAC with SHA256 and base64-encoding.
       The 'hash_hmac' function is only available from PHP 5 >= 5.1.2.
    */
    $signature = base64_encode(hash_hmac("sha256", $string_to_sign, $private_key, True));
    
    /* encode the signature for the request */
    $signature = str_replace("%7E", "~", rawurlencode($signature));
    
    /* create request */
    $request = "http://".$host.$uri."?".$canonicalized_query."&Signature=".$signature;

    /* I prefer using CURL */
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL,$request);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_TIMEOUT, 15);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);

    $xml_response = curl_exec($ch);
    
    /* If cURL doesn't work for you, then use the 'file_get_contents'
       function as given below.
    */
    //$xml_response = file_get_contents($request);
    
    if ($xml_response === False)
    {
        return False;
    }
    else
    {
        /* parse XML */
        //print_r( $xml_response);
        $parsed_xml = @simplexml_load_string($xml_response);
        return ($parsed_xml === False) ? False : $parsed_xml;
        
    }
}

}
