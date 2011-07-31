<?php 
/* ICQPagerSend Class (0.1A) 
* A class to send messages using ICQ WWP service 
* Author: Davide Rizzi 
* Last mod: 20 May 2003 
* 
* Notes: 
* - this class suppose you want to send the same message to many UINs 
* - If you prefer you can use the static sendMessage(). 
*/ 

class ICQPagerSend { 
    var $from; 
    var $fromemail; 
    var $subject; 
    var $body; 
     
/* 
    constructor ICQPagerSend($from, $fromemail, $subject, $body) 
    returns: none 
    param: $from - name of the sender 
    param: $fromemail - email of the sender 
    param: $subject - subject of the message 
    param: $body - body of the message 
    desc: here you can specify the message, then you send it with sendTo 
*/     
    function ICQPagerSend($from, $fromemail, $subject, $body) { 
        $this->from = urlencode($from); 
        $this->fromemail = urlencode($fromemail); 
        $this->subject = urlencode($subject); 
        $this->body = urlencode($body); 
    } 

/* 
    sendTo($from, $fromemail, $subject, $body, $uin) 
    returns: boolean 
    param: $uin - uin of the recipient 
    desc: sends the message specified in the constructor to the specified UIN 
*/ 
    function sendTo($uin) { 
        return $this->sendMessageX($this->from, $this->fromemail, $this->subject, $this->body, $uin); 
    } 

/* 
    static sendMessage($from, $fromemail, $subject, $body, $uin) 
    returns: boolean 
    param: $from - name of the sender 
    param: $fromemail - email of the sender 
    param: $subject - subject of the message 
    param: $body - body of the message 
    param: $uin - uin of the recipient 
    desc: sends a message to the specified UIN. 
*/     
    function sendMessage($from, $fromemail, $subject, $body, $uin) { 
        return ICQPagerSend::sendMessageX(urlencode($from), urlencode($fromemail), urlencode($subject), urlencode($body), $uin); 
    } 

// "private" function 
    function sendMessageX($from, $fromemail, $subject, $body, $uin) { 
        $fp = fsockopen ('wwp.icq.com', 80, $errno, $errstr, 30) or die("[ERROR - Could not connect to server (wwp.icq.com)]");   
        if(strlen($body) > 380) { 
            $body = substr($body, 0, 380); 
        } 
        $q = 'HEAD /scripts/WWPMsg.dll?from=' . $from . '&fromemail=' . $fromemail . '&subject=' . $subject . '&to=' . trim($uin) . '&body=' . $body . " HTTP/1.0\n\n"; 
        fputs($fp, $q); 
        $res = ''; 
        while(!feof($fp)) { 
            $res .= fgets($fp, 1024); 
        } 
        fclose($fp); 
//print("<pre>$q\n$res<br>\n"); 
        if(strpos($res, '/whitepages/page_me_ok/')) { 
            return true; 
        } 
        return false; 
    } 
} 
?>