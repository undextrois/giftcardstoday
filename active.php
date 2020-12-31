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

 $tpl=new Template(".","keep");
 $tpl->set_file(array("background"=>"_html/active.php"));

 $tpl->parse("background", array("background"));
 $tpl->finish("background");
 $tpl->p("background");
?>
