
<?php
$email_a = 'joasdasdeexample.com';
$email_b = 'bogus';

if (filter_var($email_a, FILTER_VALIDATE_EMAIL)) {
    echo "E-mail (email_a) указан верно.";
}else{
	echo "E-mail (email_a) указан НЕверно.";
}
if (filter_var($email_b, FILTER_VALIDATE_EMAIL)) {
    echo "E-mail (email_b) указан верно.";
}
?>