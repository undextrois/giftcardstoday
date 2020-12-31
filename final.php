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

 $_gct_MyDB = new _GCT_DB_Class();

 $tpl=new Template(".","keep");
 $tpl->set_file(array("background"=>"_html/final.php"));
 $tpl->set_block("background","GCTStoreListBlock","StoreListRW");

 $tpl->parse("background", array("background"));
 $tpl->finish("background");
 $tpl->p("background");
?>
