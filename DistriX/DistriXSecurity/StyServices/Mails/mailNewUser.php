<?php // Needed to encode in UTF8 ààéàé //
	$body   = '  <div style="text-align:center; padding:0 2em;">';
	$body  .= '    <p>'.$ligne1.' '.$infoUser->getFirstName().',</p>';
	$body  .= '    <p>'.$ligne2.'</p>';
	$body  .= '  </div>';
	
  $body  .= '  </br>';

  $body  .= '  <p style="font-family:Silka Mono; font-style:normal; font-size:17px; font-weight:800; line-height:20px;">';
  $body  .= '    <a href="'.URL_DISTRIX_MAIL.'" target="_blank" style="color:#133a6f;">';
  $body  .= '      '.$ligne3;
  $body  .= '    </a>';
  $body  .= '  </p>';
?>