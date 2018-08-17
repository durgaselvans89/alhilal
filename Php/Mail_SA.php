<?php

	class Mail_SA{

		public function sendMail($to, $subject, $message){
			
			$strmail = "";	
			try{
				$from = "support@excellencebuilder.co.uk";

				$headers1 = "MIME-Version: 1.0\r\n";
				$headers1 .= "Content-type: text/html; charset=iso-8859-1\r\n";

				$headers1 .= "To: ".$to."\r\n";
				$headers1 .= "From: ".$from."\r\n";
				ini_set("SMTP", "mail.synadevelopment.com"); 
				if(mail($to, $subject, $message, $headers1)){
					$strmail = "Your message has been sent !";
				}
				else{
					$strmail = "Failed";
				}
			}
			catch(Exception $exception){
				die($exception);
			}
			return $strmail;

		}
		public function sendMailFrom($from, $to, $subject, $message){
			
			$strmail = "";	
			try{
				//$from = "support@excellencebuilder.co.uk";

				$headers1 = "MIME-Version: 1.0\r\n";
				$headers1 .= "Content-type: text/html; charset=iso-8859-1\r\n";

				$headers1 .= "To: ".$to."\r\n";
				$headers1 .= "From: ".$from."\r\n";
				ini_set("SMTP", "mail.synadevelopment.com"); 
				if(mail($to, $subject, $message, $headers1)){
					$strmail = "Your message has been sent!";
				}
				else{
					$strmail = "Failed";
				}
			}
			catch(Exception $exception){
				die($exception);
			}
			return $strmail;

		}
	}

?>