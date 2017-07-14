<?php
if (! defined('DIRECTACESS')) exit('No direct script access allowed');
	class mail
	{
	
		public function __construct()
		{
		
			
		
		}
		
		public function send($to, $from, $subject, $message)
		{
            $message = '<html lang="en">
                            <head>
                                <meta charset="UTF-8">
                                <title>Pivot-table</title>
                            </head>
                            <body style="margin:0px;color: #000;direction: ltr;font-family: "Lobster", Georgia, Times, serif;letter-spacing: 1px;">
		                        '.$message.'
                            </body>
                        </html>';

            $header = "From: $from\n";
            $header .= "MIME-Version: 1.0\n";
            $header .= "Content-type: text/html; charset=iso-8859-1\n";
			
            $mail_sent = @mail($to, $subject, $message, $header);
			
			if($mail_sent) return true;
			else return false;
		}
		
	}
?>