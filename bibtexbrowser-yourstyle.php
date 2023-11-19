<?php
function MyBibliographyStyle(&$bibentry) 
{
  $title = $bibentry->getTitle();
  $type = $bibentry->getType();

  // later on, all values of $entry will be joined by a comma
  $entry=array();

  
  // author
   if ($bibentry->hasField('author')) 
   {
      $author = ' <span class="bibauthor">'.$bibentry->getFormattedAuthorsImproved().'</span>, ';
   }
   else $author = '';

  // title
  // usually in bold: .bibtitle { font-weight:bold; }
  $title = '<span class="bibtitle">'.$title.'</span>';
  if ($bibentry->hasField('url')) $title = ' <a'.(BIBTEXBROWSER_BIB_IN_NEW_WINDOW?' target="_blank" ':'').' href="'.$bibentry->getField("url").'">'.$title.'</a>';
   $coreInfo = $author . $title;

  
  // core info usually contains title + author
  $entry[] = $coreInfo;

  // now the book title
  $booktitle = '';
  if ($type=="inproceedings") {
      $booktitle = '[in] '.$bibentry->getField(BOOKTITLE); }
  if ($type=="incollection") {
      $booktitle = '[chapter in] '.$bibentry->getField(BOOKTITLE);}
  if ($type=="inbook") {
      $booktitle = '[chapter in] '.$bibentry->getField('chapter');}
  if ($type=="article") {
      $booktitle = '[in] '.$bibentry->getField("journal");}

  //// we may add the editor names to the booktitle
  $editor='';
  if ($bibentry->hasField(EDITOR)) {
    $editor = $bibentry->getFormattedEditors();
  }
  if ($editor!='') $booktitle .=' ('.$editor.')';
  // end editor section

  // is the booktitle available
  if ($booktitle!='') {
    $entry[] = '<span class="bibbooktitle">'.$booktitle.'</span>';
  }


  $publisher='';
  if ($type=="phdthesis") {
      $publisher = 'PhD thesis, '.$bibentry->getField(SCHOOL);
  }
  if ($type=="mastersthesis") {
      $publisher = 'Master\'s thesis, '.$bibentry->getField(SCHOOL);
  }
  if ($type=="bachelorsthesis") {
      $publisher = 'Bachelor\'s thesis, '.$bibentry->getField(SCHOOL);
  }
  if ($type=="techreport") {
      $publisher = 'Technical report, '.$bibentry->getField("institution");
  }
  
  if ($type=="misc") {
      $publisher = $bibentry->getField('howpublished');
  }

  if ($bibentry->hasField("publisher")) {
    $publisher = $bibentry->getField("publisher");
  }

  if ($publisher!='') 
     $entry[] = '<span class="bibpublisher">'.$publisher.'</span>';

   if ($bibentry->hasField(YEAR)) 
      $entry[] = $bibentry->getYear();
     
   if ($bibentry->hasField('volume')) 
      $entry[] =  "volume ".$bibentry->getField("volume");
   
   if ($bibentry->hasField('number'))
      $entry[] = "number " . $bibentry->getField("number");
  
   if ($bibentry->hasField('pages'))
		$entry[] = 'pp. ' . str_replace('--', '-', $bibentry->getField('pages'));

  $result = implode(", ",$entry).'.';

  // some comments (e.g. acceptance rate)?
  if ($bibentry->hasField('comment')) 
  {
      if ($bibentry->getField("comment") != '')
         $result .=  " (".$bibentry->getField("comment").")";
  }
  if ($bibentry->hasField('note')) 
  {
      if ($bibentry->getField("note") != '')
         $result .=  " (".$bibentry->getField("note").")";
  }

  // add the Coin URL
  $result .=  "\n".$bibentry->toCoins();

  return $result;
}
?>
