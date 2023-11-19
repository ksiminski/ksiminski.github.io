<!DOCTYPE html>
<!--[if lt IE 7 ]><html class="ie ie6" lang="en"> <![endif]-->
<!--[if IE 7 ]><html class="ie ie7" lang="en"> <![endif]-->
<!--[if IE 8 ]><html class="ie ie8" lang="en"> <![endif]-->
<!--[if (gte IE 9)|!(IE)]><!--><html lang="en"> <!--<![endif]-->

<?php 
function getItems ($path = '.')
{ 
   
   $ignore = array( 'cgi-bin', '.', '..' ); 
   // Directories to ignore when listing output. Many hosts 
   // will deny PHP access to the cgi-bin. 
   
   $dh = @opendir ($path); 
   
   //$pliki[];
   
   while (false !== ($file = readdir($dh)))
   { 
      if (!in_array($file, $ignore))
      { 
         if (!is_dir("$path/$file"))
         { 
            $pliki[] = $file;
         } 
      } 
   }
   /**/
   closedir($dh); 

   
   // teraz trzeba wypisac pliki
   rsort($pliki);
   //$napis = "";
   foreach ($pliki as $plik)
   {
      //int preg_match ( string $pattern , string $subject [, array &$matches [, int $flags = 0 [, int $offset = 0 ]]] )
      $link  = "";
      $nazwa = "";
      
      preg_match ('/\(.+\)/i', $plik, $wyniki);
      if (count($wyniki) > 0)
      {
         $link = $wyniki[0];
         $link = str_replace ("(", "", $link);
         $link = str_replace (")", "", $link);
         //echo $link;
      }
      
      $publikowac = false;
      preg_match('/[+]/i', $plik, $topublish);
      if (count($topublish) > 0)
      {
         $publikowac = true;
      }
      
      // odcinam ".pdf":      
      $nazwa = str_replace(".pdf", "", $plik);  
      $nazwa = str_replace("[+]", "", $nazwa);      
      
      // odcinam link do wydawcy:
      $pozycja = strpos($nazwa, "(");
      if ($pozycja !== false) // istnieje link do wydawcy, wiec go odcinam
      {
         $nazwa = substr($nazwa, 0, $pozycja);
         //echo $nazwa;
      }
      
      // teraz trzeba to wszystko wypisac:
      
      $linia ="<li>";
      $linia .= "<strong>$nazwa</strong>";
      
      if ($publikowac or $link != "")
      { 
         // trzeba wygenerowac nawiasy
         $linia .= " (";
         if ($publikowac)
         {
            $linia .= "&#8595;&nbsp;<a href='$path/$plik'>pdf</a>";
         }
         if ($publikowac and $link != "")
            $linia .= ", ";    
         if ($link != "")
         {
            $linia .= "for original paper go to &#8594;&nbsp;<a href='http://$link'>$link</a>";
         }
         $linia .= ")";   
      }
      
      $linia .= "</li>";
      
      echo $linia;
      

   }
   

   
} 
?>

<head>

	<!-- Basic Page Needs
  ================================================== -->
	<meta charset="utf-8">
	<title>Krzysztof Simiński</title>
	<meta name="description" content="">
	<meta name="author" content="">

	<!-- Mobile Specific Metas
  ================================================== -->
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

	<!-- CSS
  ================================================== -->
	<link rel="stylesheet" href="stylesheets/base.css">
	<link rel="stylesheet" href="stylesheets/skeleton.css">
	<link rel="stylesheet" href="stylesheets/layout.css">

	<!--[if lt IE 9]>
		<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
	<![endif]-->

	<!-- Favicons
	================================================== -->
	<link rel="shortcut icon" href="images/favicon.ico">
	<link rel="apple-touch-icon" href="images/apple-touch-icon.png">
	<link rel="apple-touch-icon" sizes="72x72" href="images/apple-touch-icon-72x72.png">
	<link rel="apple-touch-icon" sizes="114x114" href="images/apple-touch-icon-114x114.png">

</head>
<body>



	<!-- Primary Page Layout
	================================================== -->

	<!-- Delete everything in this .container and get started on your own site! -->

	<div class="container">
		<div class="sixteen columns">  <!-- pelna szerokosc -->
			<h1 class="remove-bottom" style="margin-top: 40px">Krzysztof Simiński</h1>
			<!--<h5>Version 1.2</h5>-->
			<hr />
		</div>
      
      <article class = "sixteen columns">
         <div class="three columns">
            <img class="scale-with-grid" src="images/politechnika_sl_logo_pion_pl_rgb.png" />
         </div>

         <div class="twelve columns">
            <h3>Papers</h3>
            <ol>
               <?php
                  $_GET['bib']='ksiminski.bib';
                  $_GET['all']=1;
                  include( 'bibtexbrowser.php' );
               ?> 
            </ol>
         </div>
      </article>

      <hr />

      <article class = "sixteen columns">
         <div class="three columns">
            <a href="index.html">back to main page</a>
         </div>
         
         <div class="three columns">
            <a href="http://platforma.polsl.pl/rau2/course/view.php?id=116">students' area</a>
         </div>
         
         <div class="three columns">
            <a href="http://sun.aei.polsl.pl/~ksim/fotki/Zarzecze/index.html">photos</a>
         </div>

         
      </article>

      <!--<center>
         <h6>2012-10-27</h6>
      </center>      
      -->
      
      
      
      
      <!--
      <div class="three columns">
			<h3>Photography</h3>
			<p><a href="http://sun.aei.polsl.pl/~ksim/fotki/Zarzecze/index.html">Some photos</a>. </p>
		</div>
      -->
	</div><!-- container -->

</br>
<!-- End Document
================================================== -->
</body>
</html>
