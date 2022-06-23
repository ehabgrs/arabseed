<h3>Last Added</h3>
<?php 
//$news_archive_link we set at frontend controller
//$news_archive_link function we created at pag_m model to get the page we set as archive model 
echo anchor($news_archive_link , '+ News archive');

//function get_articles_links in cms_helper
//recent_articles we set at frontend controller
echo get_articles_links($recent_articles) ;
?>