<?php


function htmlMail($sujet, $htmlEmail, $txtEmail, $dest, $exp, $expname="") {
	$txtEmail = str_replace(chr(92),"",$txtEmail);

	//css
	$css = "table { width: 540px; margin-left: 25px; background-color: #F9F9F9; } \n";
	$css .= "td { border: 1px solid #999999; line-height:22px; } \n";
	$css .= "body { background-color: #FFFFFF } \n";
	$css .= "body,td,th { font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 12px; color: #333333; } \n";
	$css .= "td { padding: 10px; } \n";
	$css .= "a { color: #ca3001; } a:hover { text-decoration: none; } \n";
	$css .= "img { margin: 10px 25px; vertical-align: middle; } \n";
	$css .= "h1 { font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 12px; margin: 10px 0 10px 0; text-decoration: underline; } \n";
	$css .= "h2 { font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 11px; color: #162e60; margin: 10px 0 0 0; } \n";
	
	//entête et bas de page
	$entete = "";
	$entete .= "<table>\n\t<tr>\n\t\t<td>";
	$baspage = "\n\t\t</td>\n\t</tr>\n</table>";
	
	//html
	$html = "<html>\n<head>\n<style type=\"text/css\">\n<!--\n".$css."\n-->\n</style>\n</head>\n";
	$html .= "<body>\n".$entete.$htmlEmail.$baspage."\n</body>\n</html>";
	
	//mail
	
	/*$mail = new htmlMimeMailEx();
	$mail -> setTo($dest);
	$mail -> setFrom($exp);
	//$mail -> setReplyTo($exp);

	$mail -> setSubject($sujet);
	$mail -> setHtml($html, $txtEmail);
	$result = $mail -> send();*/
	
	$mail = new htmlMimeMail();
	$mail->setTextCharset('UTF-8');
	$mail->setHtmlCharset('UTF-8');
	$mail->setHeadCharset('UTF-8');
	$mail->setHtml($html, $txtEmail);
	$mail->setFrom($exp);
	$mail->setSubject($sujet);
	//$mail->setBcc("arnaud@luxauto.lu");

	$result = $mail->send(array($dest));
	
	return $result ? true : false;	
}
?>