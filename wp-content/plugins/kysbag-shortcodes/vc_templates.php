<?php

/** Home page template */
$data            = array();
$data['name']    = __( 'Home Page', 'kysbag' );
$data['content'] = <<<CONTENT
[vc_row full_width="stretch_row_content_no_spaces"][vc_column width="1/1"][rev_slider_vc alias="sliderpreview"][/vc_column][/vc_row][vc_row][vc_column width="1/3"][oss_services 1="
<h4>BIG" 2="SALE" 3="FOR</h4>
" 4="
<h3>SUMMER</h3>
" 5="
&lt;div" 6="class=````discount````&gt;&lt;span" 7="class=````big````&gt;10&lt;span" 8="class=````small````&gt;%" 9="off

" 10="``" 11="ctn=``" 12="
<h4>BIG" 13="SALE" 14="FOR</h4>
" 15="
<h3>SUMMER</h3>
" 16="&lt;p" 17="class=````discount````&gt;&lt;span" 18="class=````big````&gt;20&lt;span" 19="class=````small````&gt;%" 20="off

" 21="``" class="sale" bg="1809" value="``10``" ctn=""]
<h4><a href="#">BIG SALE FOR</a></h4>
<h3><a href="#">SUMMER</a></h3>
[discount value="15"][/discount][/oss_services][/vc_column][vc_column width="1/3"][oss_services ctn="
<h3>2014</h3>
<h4>FASHION BAG</h4>
" class="trending" bg="1791"]
<h3><a href="#">2014</a></h3>
<h4><a href="#">FASHION BAG</a></h4>
[/oss_services][/vc_column][vc_column width="1/3"][oss_services ctn="
<h3>FREE</h3>
<h4>SHIPPING</h4>
<h5>WITH ORDER OVER $100</h5>
" class="shipping"]
<h3><a href="3">FREE</a></h3>
<h4><a href="3">SHIPPING</a></h4>
<h5><a href="3">WITH ORDER OVER $100</a></h5>
[/oss_services][/vc_column][/vc_row][vc_row][vc_column width="1/1"][oss_products_query title="Hot Bags" per_page="30" exclude="1" exclude_posts="37,47,"][/vc_column][/vc_row][vc_row][vc_column width="1/1"][oss_products_query title="New Bags" per_page="30" exclude="" orderby="date"][/vc_column][/vc_row][vc_row][vc_column width="1/1"][oss_testimonials per_page="2" exclude=""][/vc_column][/vc_row][vc_row][vc_column width="2/3"][oss_recent_posts title="From Blog" per_page="2" exclude="1" exclude_cat="" load_more="1" exclude_posts="1175"][/vc_column][vc_column width="1/3"][oss_video_bags title="Video Bags" ctn="

Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.

" link="https://www.youtube.com/watch?v=QgleKO4pbyQ"][/vc_column][/vc_row]
CONTENT;

vc_add_default_templates( $data );