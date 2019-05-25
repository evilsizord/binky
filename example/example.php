<?php
/**
 * Example email using Binky
 */

require "../../../pharse/pharse.php";		// replace with your path to Pharse
require "../binky.php";

$b = new Binky();
$b->startBuffering();

/************** YOUR EMAIL HERE **********************************/   ?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xmlns:v="urn:schemas-microsoft-com:vml" xmlns:o="urn:schemas-microsoft-com:office:office">

<head>
  <meta content="text/html;charset=utf-8" http-equiv="Content-Type" />
  <meta content="en-us" http-equiv="Content-Language" />
  <title>Example Email</title>
</head>

<body style="padding:0;margin:0;background-color:#00447c;color:#00447c;">
<preheader>Compelling preheader text goes here</preheader>
<container width="100%" bgcolor="#00447c" id="wrapper">
	
    <!-- HEADER -->
	<container width="600" id="header">
		<row>
			<column>
				<p
					style="padding: 0; margin: 10px 0; font-family: arial,sans-serif; font-size: 12px; text-align: center; line-height: 24px;">
					<a style="color: #57B6FF; text-decoration: none;"
					href="email.html">View in browser</a>
				</p>
			</column>
		</row>
		<row bgcolor="#ffd500">
			<column bgcolor="#ffd500" padding="20px 30px 20px 30px">
				<img border="0" style="border:none; display:block; margin:0 auto" src="logo_1.png" width="330" height="73" alt="Company logo"/>
			</column>
		</row>
        <row width="520" align="center">
			<column padding="25px 0 25px 0" textalign="center">
				<p style="padding: 0; margin: 0; font-family: arial, sans-serif; font-size: 22px; line-height: 26px; color: #ffffff; text-align:center;">
                   Lorem ipsum Catchy Intro Text
				</p>
			</column>
		</row>
	</container>

    <!-- BODY -->
    <container id="body" width="600" bgcolor="#ffffff">
        <row>
            <column padding="30px 30px 30px 30px">
                <p class="default">
                    Nulla quis scelerisque purus. Fusce auctor massa orci. Integer nec lorem id leo ultrices blandit vel et nulla. Pellentesque eget aliquet mi. Duis dui felis, scelerisque quis rutrum gravida, maximus vitae metus. Maecenas ut diam lacus. In scelerisque.
                </p>
                <p class="default">
                    Nulla quis scelerisque purus. Fusce auctor massa orci. Integer nec lorem id leo ultrices blandit vel et nulla. Pellentesque eget aliquet mi. Duis dui felis, scelerisque quis rutrum gravida, maximus vitae metus. Maecenas ut diam lacus. In scelerisque.
                </p>
            </column>
        </row>
    </container>

    <!-- FOOTER -->
    <container id="footer" width="600">
    	<row align="center">
			<column width="450" padding="20px 0 20px 0">
                <p style="padding: 0; margin: 5px 0; color: #fff; font-family: arial,sans-serif; font-size: 13px; line-height: 21px;">
					<a style="text-decoration: underline; color: #fff;" href="#"><strong>Your Company name</strong></a> <br/>
					Lorem ipsum road, 123 London <br/>
					<a style="color:#ffffff; text-decoration:underline;" href="#">Unsubscribe</a>
				</p>
			</column>
    		<column width="50" padding="20px 0 20px 0">
				<a href="#" style="text-decoration:none;">
					<img alt="Facebook" class="default" height="30" src="social-circle-facebook.png" width="30" />
				</a>
			</column>
    		<column width="50" padding="20px 0 20px 0;">
				<a href="#" style="color:#ffffff; text-decoration:none;">
					<img alt="Twitter" class="default" height="30" src="social-circle-twitter.png" vspace="0" width="30"/>
				</a>
			</column>
			<column width="50" padding="20px 0 20px 0;">
				<a href="#" style="color:#ffffff; text-decoration:none;">
					<img alt="LinkedIn" class="default" height="30"  src="social-circle-linkedin.png" vspace="0" width="30"/>
				</a>
			</column>
		</row>
	</container>
</container>

<!-- Google analytics pixel -->
<gapixel ua="297365-15" cn="Peer Letter" cs="Batch1"/>

</body>
</html>

<?php  /************** END EMAIL **********************************/

$b->stopBuffering();
$b->render();
