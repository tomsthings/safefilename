<?php
  require("safefilename.php");
  use safeFilename\safeFilename as SFN;
  $g = "Falsches Üben von Xylophonmusik quält jeden größeren Zwerg.";
  $sfn = new SFN($g);
  $sfn->setReplaceSpace(false);
  $sfn->setDoubleScharfesS(true);
  
  var_dump( $g );
  var_dump( $sfn->result() );


