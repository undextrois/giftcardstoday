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
 $tpl->set_file(array("background"=>"_html/store_category.php"));
 $tpl->set_block("background","GCTStoreListBlock","StoreListRW");

 if (isset($_GET['categoryid']) && intval($_GET['categoryid']))
    $_gct_category_id = intval($_GET['categoryid']);
 else
    _gct_redirect("index.php");

 $_dataRW = $_gct_MyDB->_gct_query("SELECT _gct_store_category.icon,
                                           _gct_store_category.caption,
                                           _gct_store_category.category_id,
                                           UNIX_TIMESTAMP(_gct_store_category.ndate) AS n_date
                                    FROM
                                           _gct_store_category
                                    WHERE
                                           _gct_store_category.category_id = '$_gct_category_id'");

 if (mysql_num_rows($_dataRW))
 {
    $_rw = mysql_fetch_object($_dataRW);
    $tpl->set_var("store_icon",$_rw->icon);
    $tpl->set_var("store_category_caption",stripslashes($_rw->caption));
    $_gct_MyDB->_gct_free($_dataRW);
 }

 $_dataRW = $_gct_MyDB->_gct_query("SELECT _gct_store_info.store_logo,
                                           _gct_store_info.store_name,
                                           _gct_store_info.store_id,
                                           _gct_store_info.store_available,
                                           _gct_store_info.store_category_id
                                    FROM
                                           _gct_store_info
                                    WHERE
                                           _gct_store_info.store_category_id = '$_gct_category_id'");

 if (mysql_num_rows($_dataRW))
 {
    while ($_rw = mysql_fetch_object($_dataRW))
    {
       if ($_rw->store_available=='Y')
          $tpl->set_var("star_icon","<img src=\"images/star.gif\" border=\"0\">");
       else
          $tpl->set_var("star_icon","");
       $tpl->set_var("store_name",stripslashes($_rw->store_name));              
       $tpl->set_var("store_buttons","<input type=\"button\" name=\"view_cert\" value=\"View Certificate\" onClick=\"_view_certificate_onclick($_rw->store_category_id,$_rw->store_id)\"><input type=\"button\" name=\"sell_cert\" value=\"Sell a Certificate\" onClick=\"location='sell_certificate.php'\">");
       $tpl->parse("StoreListRW","GCTStoreListBlock",true);
    }
    $_gct_MyDB->_gct_free($_dataRW);
 }
 else
 {
       $tpl->set_var("star_icon","");
       $tpl->set_var("store_name","");
       $tpl->set_var("store_buttons","");
       $tpl->parse("StoreListRW","GCTStoreListBlock",true);   
 }

 $tpl->parse("background", array("background"));
 $tpl->finish("background");
 $tpl->p("background");
?>
