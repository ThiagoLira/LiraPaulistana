<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php

require_once('PHPMailer-master/class.phpmailer.php');
require_once('PHPMailer-master/class.smtp.php');

//define("UPLOAD_DIR", "uploads/");

if(!$_POST) exit;




if(!$_FILES['file']){
    echo '<div class="error_message">Atenção! Currículo não enviado!</div>';
    exit();
}

// Email address verification, do not edit.
function isEmail($email2) {
	return(preg_match("/^[-_.[:alnum:]]+@((([[:alnum:]]|[[:alnum:]][[:alnum:]-]*[[:alnum:]])\.)+(ad|ae|aero|af|ag|ai|al|am|an|ao|aq|ar|arpa|as|at|au|aw|az|ba|bb|bd|be|bf|bg|bh|bi|biz|bj|bm|bn|bo|br|bs|bt|bv|bw|by|bz|ca|cc|cd|cf|cg|ch|ci|ck|cl|cm|cn|co|com|coop|cr|cs|cu|cv|cx|cy|cz|de|dj|dk|dm|do|dz|ec|edu|ee|eg|eh|er|es|et|eu|fi|fj|fk|fm|fo|fr|ga|gb|gd|ge|gf|gh|gi|gl|gm|gn|gov|gp|gq|gr|gs|gt|gu|gw|gy|hk|hm|hn|hr|ht|hu|id|ie|il|in|info|int|io|iq|ir|is|it|jm|jo|jp|ke|kg|kh|ki|km|kn|kp|kr|kw|ky|kz|la|lb|lc|li|lk|lr|ls|lt|lu|lv|ly|ma|mc|md|me|mg|mh|mil|mk|ml|mm|mn|mo|mp|mq|mr|ms|mt|mu|museum|mv|mw|mx|my|mz|na|name|nc|ne|net|nf|ng|ni|nl|no|np|nr|nt|nu|nz|om|org|pa|pe|pf|pg|ph|pk|pl|pm|pn|pr|pro|ps|pt|pw|py|qa|re|ro|ru|rw|sa|sb|sc|sd|se|sg|sh|si|sj|sk|sl|sm|sn|so|sr|st|su|sv|sy|sz|tc|td|tf|tg|th|tj|tk|tm|tn|to|tp|tr|tt|tv|tw|tz|ua|ug|uk|um|us|uy|uz|va|vc|ve|vg|vi|vn|vu|wf|ws|ye|yt|yu|za|zm|zw)$|(([0-9][0-9]?|[0-1][0-9][0-9]|[2][0-4][0-9]|[2][5][0-5])\.){3}([0-9][0-9]?|[0-1][0-9][0-9]|[2][0-4][0-9]|[2][5][0-5]))$/i",$email2));
}

if (!defined("PHP_EOL")) define("PHP_EOL", "\r\n");


$name     = $_POST['name'];
$email2    = $_POST['email'];

$comments = $_POST['comments'];
$target_file = $_FILES['file']['tmp_name'];
//$website = $_POST['website'];



$arquivo = $_FILES["file"]["name"];
$ext = end((explode(".", $arquivo))); # extra () to prevent notice

//echo $ext;

// Allow only PDF
if(!$ext == "pdf") {
    echo '<div class="error_message">Atenção! Currículo deve estar no formato pdf!</div>';
    exit();
}




if(trim($name) == '') {
	echo '<div class="error_message">Attention! You must enter your name.</div>';
	exit();
} else if(trim($email2) == '') {
	echo '<div class="error_message">Attention! Please enter a valid email address.</div>';
	exit();
} else if(!isEmail($email2)) {
	echo '<div class="error_message">Attention! You have enter an invalid e-mail address, try again.</div>';
	exit();
}

 if(trim($comments) == '') {
	echo '<div class="error_message">Attention! Please enter your message.</div>';
	exit();
} 

if(get_magic_quotes_gpc()) {
	$comments = stripslashes($comments);
}








$email = new PHPMailer();

$email->From      = $email2;
$email->FromName  = $name;
$email->Subject   = "Curriculo de " . $name ;


if(isset($_POST['website'])){
$email->Body      = $comments . "\r\n" . 'Site pessoal: ' . $_POST['website'] ."\r\n". 'Email : ' . $email2;
}
else{
$email->Body      = $comments ."\r\n". 'Email : ' . $email2;
}

$email->AddAddress( 'thlira15@gmail.com' );

$email->IsSMTP(); // telling the class to use SMTP

$email->SMTPDebug  = 2;                     // enables SMTP debug information (for testing)

$email->SMTPAuth   = true;                  // enable SMTP authentication

$email->SMTPSecure = "tls";                 // sets the prefix to the servier

$email->Host       = "smtp.gmail.com";      // sets GMAIL as the SMTP server

$email->Port       = 587;                   // set the SMTP port for the GMAIL server

$email->Username   = "thlira15@gmail.com";  // GMAIL username

$email->Password   = "R3tsandrows";            // GMAIL password

//$mail->IsHTML(true);



$email->AddAttachment( $target_file , "curriculo.pdf"  );


if(!$email->send()) {
    //echo 'Message could not be sent.';
    //echo 'Mailer Error: ' . $mail->ErrorInfo;
} else {
    //echo 'Message has been sent';
}








