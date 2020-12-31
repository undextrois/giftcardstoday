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
 if (!session_is_registered("user"))
    _gct_redirect("login.php?rd=sell_certificate.php");

 _gct_redirect("my_credit.php");

 $_gct_MyDB = new _GCT_DB_Class();

 $tpl=new Template(".","keep");
 $tpl->set_file(array("background"=>"_html/sell_certificate.php"));

 $tpl->parse("background", array("background"));
 $tpl->finish("background");
 $tpl->p("background");
?>
