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
    _gct_redirect("login.php?rd=buy_certificate.php");

 $_gct_MyDB = new _GCT_DB_Class();

 $tpl=new Template(".","keep");
 $tpl->set_file(array("background"=>"_html/buy_certificate.php"));
 $tpl->set_block("background","GCTStoreCategoryBlock","StoreCategoryRW");
 $tpl->set_block("background","GCTStoreCategoryBlock2","StoreCategoryRW2");

 $_dataRW = $_gct_MyDB->_gct_query("SELECT _gct_store_category.icon,
                                           _gct_store_category.caption,
                                           _gct_store_category.category_id,
                                           UNIX_TIMESTAMP(_gct_store_category.ndate) AS n_date
                                    FROM
                                           _gct_store_category");
 if (mysql_num_rows($_dataRW))
 {
    $_gct_store_index = 0;
    while ($_rw = mysql_fetch_object($_dataRW))
    {
       if ($_gct_store_index > 9)
       {
          $tpl->set_var("store_icon2",$_rw->icon);
          $tpl->set_var("script_location2","store_category.php?categoryid=$_rw->category_id");
          $tpl->set_var("store_caption2",stripslashes($_rw->caption));

          $tpl->parse("StoreCategoryRW2","GCTStoreCategoryBlock2",true);

       }
       else
       {
          $tpl->set_var("store_icon",$_rw->icon);
          $tpl->set_var("script_location","store_category.php?categoryid=$_rw->category_id");
          $tpl->set_var("store_caption",stripslashes($_rw->caption));

          $tpl->parse("StoreCategoryRW","GCTStoreCategoryBlock",true);
       }
       $_gct_store_index++;
    }
    $_gct_MyDB->_gct_free($_dataRW);
 }

 $tpl->parse("background", array("background"));
 $tpl->finish("background");
 $tpl->p("background");
?>
