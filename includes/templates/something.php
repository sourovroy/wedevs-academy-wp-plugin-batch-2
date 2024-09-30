<?php
get_header();

var_dump( get_query_var( 'something_value' ) )
?>

something page content
<br>
<?php

preg_match(
	'/http:\/\/sourov-training\.site\/([^\/]+)/',
	'http://sourov-training.site/something/sfds/',
	$matches
);

print_r($matches[1]);

get_footer();
?>
