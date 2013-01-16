<?php
include_once('../config.php');
include_once('./assets/simple_html_dom.php');
$start = fopen('start.txt' , 'r' );
$i = intval(fgets($start));

while($i < 1373)
{	
	echo $i."\n";
	$check = 0;
	do{	
		$link = 'http://it-ebooks.info/book/'.$i.'/';
		echo $link."\n";
		$html = file_get_html($link);
		 			
		 			$a 		= $html->find('a[itemprop]');
		  			$title	=( $html->find('h1[itemprop]') ) ;
					$b 		= $html->find('b[itemprop]');

								$ebook['title']		=addslashes($title[0]->innertext);
								$ebook['publisher']	=addslashes($a[0]->innertext);
								$ebook['authors']	=addslashes($b[0]->innertext);
								$ebook['isbn']		=addslashes($b[1]->innertext);
								$ebook['year']		=addslashes($b[2]->innertext);
								$ebook['pages']		=addslashes($b[3]->innertext);
								$ebook['language']	=addslashes($b[4]->innertext);
								$ebook['format']	=addslashes($b[5]->innertext);
								$ebook['link']		=addslashes($link);
								echo $ebook['title']."\n" ;
									if(strpos($html->plaintext , 'images/404.png' ) >= 0 )break;
	}while($ebook['title'] == null );
		

		do{
 
 			$check = mysql_query("INSERT INTO Details1 ( id , title , publisher , author , isbn , year , pages , language , format , link ) VALUES ( '".$i."' , '".$ebook['title']."', '".$ebook['publisher']."', '".$ebook['authors']."', '".$ebook['isbn']."', '".$ebook['year']."', '".$ebook['pages']."', '".$ebook['language']."', '".$ebook['format']."', '".$ebook['link']."' )  ");
			}while(!$check);

	$i++;
	file_put_contents("start.txt", $i);
}
	