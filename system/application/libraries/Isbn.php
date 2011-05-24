<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 

class Isbn {

   
    function isbn13to10($isbn)
    {
        $isbn = substr($isbn,3,9);
        $total=0;
        for($i=0; $i<9; $i++) { $total += (substr($isbn, $i, 1) * (11-($i+1))); }
        $checkdigit = 11-($total % 11);
        if($checkdigit == 10) { $checkdigit = "X"; } elseif($checkdigit == 11) { $checkdigit = '0'; }
        $isbn .= $checkdigit;
        return $isbn;
    }
    
    function isbn10to13($isbn)
    {
        if (!preg_match('{^([0-9]{9})[0-9xX]$}', $isbn, $matches)) {
        # number is not 10 digits
        return false;}

        # sum the digits with their weights and add the checksum for the 978 prefix
        $sum_of_digits = 38 + 3 * ($isbn{0} + $isbn{2} + $isbn{4} + $isbn{6} + $isbn{8}) +
                               $isbn{1} + $isbn{3} + $isbn{5} + $isbn{7};

        # divide the sum_of_digits by the modulus number (10) to find the remainder
        # and then minus 10 to get the check digit
        $check_digit = (10 - ($sum_of_digits % 10)) % 10;

        # return isbn with check_digit
        return '978' . $matches[1] . $check_digit;
    }
    
   /* public function convert($isbn) {
		$isbn2 = substr("978" . trim($isbn), 0, -1);
		$sum13 = self::genchksum13($isbn2);
		$isbn13 = "$isbn2-$sum13";
		return ($isbn13);
	}
   */
	public function gettype($isbn) {
		$isbn = trim($isbn);
		if (preg_match('%[0-9]{12}?[0-9Xx]%s', $isbn)) {
			return 13;
		} else if (preg_match('%[0-9]{9}?[0-9Xx]%s', $isbn)) {
			return 10;
		} else {
			return -1;
		}
	}

	public function check($isbn) {
            $isbnlen = strlen($isbn);
            if (is_numeric(substr($isbn,2,3)))
            {
            if ($isbnlen == 10)
            {
		$isbn = trim($isbn);
		$chksum = substr($isbn, -1, 1);
		$isbn = substr($isbn, 0, -1);
		if (preg_match('/X/i', $chksum)) { $chksum="10"; }
		$sum = $this->genchksum10($isbn);
                if($sum==11)
                $sum=0;
		if ($chksum == $sum){
			return 1;
                }else{
                        return 0;
		}
            }
            elseif ($isbnlen == 13)
            {
                $isbn = trim($isbn);
		$chksum = substr($isbn, -1, 1);
		$isbn = substr($isbn, 0, -1);
		if (preg_match('/X/i', $chksum)) { $chksum="10"; }
		$sum = $this->genchksum13($isbn);
		if ($chksum == $sum){
		        return 1;
                        
		}else{
			return false;
		}
            }
            else
            {
                return false;
            }
            }
            else
            {
                return false;
            }
	}

	public function genchksum13($isbn) {
		$isbn = trim($isbn);
                $tb=0;
		for ($i = 0; $i <= 12; $i++) {
			$tc = substr($isbn, -1, 1);
			$isbn = substr($isbn, 0, -1);
			$ta = ($tc*3);
			$tci = substr($isbn, -1, 1);
			$isbn = substr($isbn, 0, -1);
			$tb = $tb + $ta + $tci;
		}
		$tg = ($tb / 10);
		$tint = intval($tg);
		if ($tint == $tg) { return 0; }
		$ts = substr($tg, -1, 1);
		$tsum = (10 - $ts);
		return $tsum;
	}

	public function genchksum10($isbn) {
		$t = 2;
		$isbn = trim($isbn);
                $b="";
                $a="";
                for($i = 0; $i <= 9; $i++){
			$b = $b + $a;
			$c = substr($isbn, -1, 1);
			$isbn = substr($isbn, 0, -1);
			$a = ($c * $t);
			$t++;
		}
		$s = ($b / 11);
		$s = intval($s);
		$s++;
		$g = ($s * 11);
		$sum = ($g - $b); 
		return $sum;
	}


}

