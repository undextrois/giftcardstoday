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

 session_start();

 $tpl=new Template(".","keep");
 $tpl->set_file(array("background"=>"_html/index.php"));
 $tpl->set_block("background","GCTStoreCategoryBlock","StoreCategoryRW");

 // $tpl->set_var("security_patch","");        /* remove security patch */

 $_gct_session_active = false;
 $_gct_session_id = false;

 if (session_is_registered("user"))
 {
    // this is vulnerable for now
    // i'll just try to fix session scheme, maybe, later

    $_gct_session_id = trim($_SESSION['user']);
    $_gct_session_active = true;

    $tpl->set_var("session_greetings","<font face=\"Arial\" size=\"2\">Welcome, <strong>$_gct_session_id!</strong></font>");
    $tpl->set_var("register_link","<font face=\"Arial\" size=\"2\">If you are not <strong>$_gct_session_id</strong>, <a href=\"register.php\"><font color=\"#0000FF\">Click Here</font></a></font>");
    $tpl->set_var("login_link","logout.php");
 }
 else
 {
    
    $tpl->set_var("session_greetings","<font face=\"Arial\" size=\"2\"><strong>New to GiftCardsToday.com? <a href=\"register.php\">Click Here</a> to Register!</strong></font>");
    $tpl->set_var("register_link","<font face=\"Arial\" size=\"2\"><strong>New Users? <a href=\"register.php\"><font color=\"#0000FF\">Click Here</font></a> to Register.</strong></font>");
    $tpl->set_var("login_link","login.php");
 } 

 $_dataRW = $_gct_MyDB->_gct_query("SELECT _gct_store_category.icon,
                                           _gct_store_category.caption,
                                           _gct_store_category.category_id,
                                           UNIX_TIMESTAMP(_gct_store_category.ndate) AS n_date
                                    FROM
                                           _gct_store_category");
 if (mysql_num_rows($_dataRW))
 {
    while ($_rw = mysql_fetch_object($_dataRW))
    {
       $tpl->set_var("store_icon",$_rw->icon);
       $tpl->set_var("script_location","store_category.php?categoryid=$_rw->category_id");
       $tpl->set_var("store_caption",stripslashes($_rw->caption));
       $tpl->parse("StoreCategoryRW","GCTStoreCategoryBlock",true);
    }
    $_gct_MyDB->_gct_free($_dataRW);
 }

 $tpl->parse("background", array("background"));
 $tpl->finish("background");
 $tpl->p("background");
?>
