<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

 class Kookoo
    {
	
         function kookoo()
        {
            $this->CI =& get_instance();
            $this->CI->load->library('isbn');
        }
        
        public function response ($sid)
        {    
	    header( "content-type: application/xml; UTF-8" );
		$this->xml= new DOMDocument("1.0", "UTF-8");
          
            $this->response= $this->xml->createElement("response");
            if($sid!="")
            {
		$this->response->setAttribute( "sid", $sid );
            }
        }

	public function Collectdtmf($l,$t,$o)
        {    
		  
            $this->collectdtmf= $this->xml->createElement("collectdtmf");
            $this->collectdtmf->setAttribute( "l", $l );
            $this->collectdtmf->setAttribute( "t", $t);
            $this->collectdtmf->setAttribute( "o", $o);
            $this->response->appendChild( $this->collectdtmf);
        }
//playtext
        public function playtext($text)
        {

            $this->xml_track =$this->xml->createElement("playtext",$text);
            $this->response->appendChild($this->xml_track);
        }

//playaudio
        public function playaudio($url)
        {
            $this->xml_track = $this->xml->createElement( "playaudio",$url);
            $this->response->appendChild($this->xml_track );
        }
        
        public function sendsms($text,$no)
        {
    
            $this->xml_track = $this->xml->createElement( "sendsms",$text);
            $this->xml_track->setAttribute( "to", $no );
            $this->response->appendChild($this->xml_track );
        }

//playtext
        public function addPlayText($text)
        {

            $this->xml_track =$this->xml->createElement("playtext",$text);
            $this->collectdtmf->appendChild($this->xml_track);
        }
        //playaudio

        public function addPlayAudio($url)
        {
            $this->xml_track = $this->xml->createElement( "playaudio",$url);
            $this->collectdtmf->appendChild($this->xml_track );
        }
    //hangup
        public function hangup()
        {
            $this->xml_track = $this->xml->createElement( "hangup");
            $this->response->appendChild($this->xml_track );
        }
//
        public function playdtmf()
        {
            $this->xml_track = $this->xml->createElement( "playdtmf-i");
            $this->response->appendChild($this->xml_track );
        }
//recordtag

        public function record($filename)
        {
            $this->xml_track = $this->xml->createElement( "record",$filename);
            $this->response->appendChild($this->xml_track );
        }

// Parse the XML.and Deconstruct
    
        public function getXML()
        {
        
            $this->xml->appendChild( $this->response);
            print $this->xml->saveXML();
        }
 
    }