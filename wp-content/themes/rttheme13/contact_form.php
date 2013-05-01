<?php
$your_email=trim($_POST['your_email']);
$your_web_site_name=trim($_POST['your_web_site_name']);
?>

<?php 
//If the form is submitted
if(isset($_POST['name'])) {
 
		//Check to make sure that the name field is not empty
		if(trim($_POST['name']) === '') {
			$hasError = true;
		} else {
			$name = trim($_POST['name']);
		}
		
		//Check to make sure sure that a valid email address is submitted
		if(trim($_POST['email']) === '')  {
			$hasError = true;
		} else if (!preg_match('^[a-zA-Z0-9_.-]+@[a-zA-Z0-9-]+.[a-zA-Z0-9-.]+$^', trim($_POST['email']))) {
			$hasError = true;
			$errorMessage = $_POST['text_4'];
		} else {
			$email = trim($_POST['email']);
		}

		//phone
		if(isset($_POST['phone'])) $phone = trim($_POST['phone']);
		
		//company name
		if(isset($_POST['company_name'])) $company_name = trim($_POST['company_name']);

		//company url
		if(isset($_POST['company_url'])) $company_url = trim($_POST['company_url']);		
			
		//Check to make sure comments were entered	
		if(trim($_POST['message']) === '') {
			$hasError = true;
		} else {
			if(function_exists('stripslashes')) {
				$comments = stripslashes(trim($_POST['message']));
			} else {
				$comments = trim($_POST['message']);
			}
		}

		//If there is no error, send the email
		if(!isset($hasError)) {

			$emailTo = $your_email;
			$subject = 'Contact Form Submission from '.$name;
			
			//message body 
			$body  ="Name: $name \n\n";
			$body .="Email: $email \n\n";
			if(isset($phone)) $body .="Phone:$phone\n\n";
			if(isset($company_name)) $body .="Company Name: $company_name\n\n";
			if(isset($company_url)) $body .="Company Url: $company_url \n\n";
			$body .="Message: $comments";

			$headers = 'From: '.$your_web_site_name.' <'.$emailTo.'>' . "\r\n" . 'Reply-To: ' . $email;
			
			mail($emailTo, $subject, $body, $headers); 
			$emailSent = true;
		}
} 
?>

<?php if(isset($emailSent) == true) { ?>
	<div class="ok_box">
		<h3><?php echo $_POST['text_1'];?>, <?php echo $name;?></h3>
		<p><?php echo $_POST['text_2'];?></p>
	</div>
<?php } ?>

<?php if(isset($hasError) ) { ?>
	<div class="error_box">
		<?php echo $_POST['text_3'];?>
		<br />
		<?php echo @$errorMessage;?>
	</div>
<?php } ?> 