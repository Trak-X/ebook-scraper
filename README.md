# Ebooks downloader and Details 
## For [it-ebooks](http://it-ebooks.info/)

###The repository consists of 4 files :

**config.php**
: Edit here your database credentials to store information about ebooks in a table .

**details-scrape.php**
: As the name suggests , it scrapes and fills up the table of ebooks data exclusively without downloading them .

**ebooks-download.php**
: Downloads the ebooks as well as fills the table ( Optional - Set it in config.php )

**simple_html_dom.php** 
: The tool i used to scrape the website .

##Your Job 

    php5 ebooks-download.php
    php5 details-scrape.php

#####Sit back and watch . { Dont forget to edit config.php }
    