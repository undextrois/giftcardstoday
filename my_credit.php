<?
/****************************************************************************
  Giftcardtoday.com
  Feb 13, 2005

 ****************************************************************************/

 require_once ("_conf/_gct_conf.php");
 require_once ("_lib/_gct_template.php");
 require_once ("_lib/_gct_common.php");
 require_once ("_lib/_gct_error.php");
 require_once ("_lib/_gct_db.php");
 require_once ("_lib/_gct_session.php");

 session_start();

 $tpl=new Template(".","keep"); 

 if (session_is_registered("user"))
 {
    $tpl->set_file(array("background"=>"_html/my_credit.php"));
    $tpl->set_var("script_tag",$_SERVER['PHP_SELF']);
 }
 else
 {
    _gct_redirect("login.php");
 }

 $tpl->parse("background", array("background"));
 $tpl->finish("background");
 $tpl->p("background");
?>
