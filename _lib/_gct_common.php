<?
/****************************************************************************
  Giftcardtoday.com
  Feb 13, 2005

 ****************************************************************************/

/****************************************************************************
  misc functions

 ****************************************************************************/

 function _gct_redirect($_prm_url)
 {
   header("location: $_prm_url");
   // this is browser fails to redirect
   exit;
 }

 function _gct_is_email($_prm_email)
 {
   return preg_match("#^(\w+((-\w+)|(\w.\w+))*\@\w+((\.|-)\w+)*\.\w+)$#",$_prm_email,$_m);
 }

 function _gct_is_user($_prm_user)
 {
   return preg_match("#^([A-Za-z_](\w|\_)+)$#",$_prm_user,$_m);
 }
?>
