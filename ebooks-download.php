<?php
include_once('../config.php');
include_once('./assets/simple_html_dom.php');

for($i = 1 ; $i < 1372 ; $i++){
	do{	$link = 'http://it-ebooks.info/book/'.$i.'/';
		$html = file_get_html($link);
		 			
		 			$a 		= $html->find('a[itemprop]');
		  			$title	=( $html->find('h1[itemprop]') ) ;
					$b 		= $html->find('b[itemprop]');

								$ebook['title']		=$title[0]->innertext;
								$ebook['publisher']	=$a[0]->innertext;
								$ebook['authors']	=$b[0]->innertext;
								$ebook['isbn']		=$b[1]->innertext;
								$ebook['year']		=$b[2]->innertext;
								$ebook['pages']		=$b[3]->innertext;
								$ebook['language']	=$b[4]->innertext;
								$ebook['format']	=$b[5]->innertext;
								$ebook['link']		=$link;

echo $ebook['title']."\n" ;

if(strpos($html->plaintext , 'images/404.png' ) >= 0 )break;

}while($ebook['title'] == null );
if($SET_DETAILS_ON)mysql_query("INSERT INTO Details1 ( id , title , publisher , author , isbn , year , pages , language , format , link ) VALUES ( '".$i."' , '".$ebook['title']."', '".$ebook['publisher']."', '".$ebook['authors']."', '".$ebook['isbn']."', '".$ebook['year']."', '".$ebook['pages']."', '".$ebook['language']."', '".$ebook['format']."', '".$ebook['link']."' )  ");
$download = $html->find('[id=dl]');
exec("wget http://it-ebooks.info".stripcslashes($download[0]->href )." -O ".$i.".".strtolower($ebook['format']) ); 

	
}