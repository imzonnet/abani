<?php

namespace Roots\Sage;

use Roots\Sage\Config;
use Roots\Sage\Wrapper;

$browser_link = 'http://browsehappy.com/';

?>

<?php get_template_part( 'templates/head' ); ?>
<body <?php body_class(); ?>>
<!--[if lt IE 9]>
<div class="alert alert-warning">
	<?php _e('You are using an <strong>outdated</strong> browser. Please <a href="', 'sage'); ?>
		<?php echo esc_html($browser_link); ?>
		<?php _e('">upgrade your browser</a> to improve your experience.', 'sage'); ?>
</div>
<![endif]-->
<?php
/** Include header **/
do_action( 'get_header' );
get_template_part( 'templates/header' );

include Wrapper\template_path();

/** Include footer**/
get_template_part( 'templates/footer' );
wp_footer();
?>
</body>
</html>
