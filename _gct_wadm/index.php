<?
/****************************************************************************
  Giftcardtoday.com
  Feb 13, 2005

 ****************************************************************************/

 require_once ("../_conf/_gct_conf.php");
 require_once ("../_lib/_gct_template.php");
 require_once ("../_lib/_gct_common.php");
 require_once ("../_lib/_gct_error.php");
 require_once ("../_lib/_gct_db.php");
 require_once ("../_lib/_gct_session.php");

 $_gct_MyDB = new _GCT_DB_Class(); 

 if (isset($_GET['ac'])) $_script_action = trim($_GET['ac']);
 else if (isset($_POST['ac'])) $_script_action = ($_POST['ac']);
 else $_script_action = "";

 define ('GCT_TITLE_MAX_LN',64);
 define ('GCT_ICON_MAX_LN',64);
 define ('GCT_TITLE_MIN_LN',1);
 define ('GCT_ICON_MIN_LN',1);

 $tpl=new Template(".","keep");

 if ($_script_action == 'drop-category-done')
 {
    $tpl->set_file(array("background"=>"../_html/_gct_wadm/drop_category_done.php"));
 }
 else if ($_script_action == 'drop-category')
 {
    $tpl->set_file(array("background"=>"../_html/_gct_wadm/drop_category.php"));
 }
 else if ($_script_action == 'list-category')
 {
    $tpl->set_file(array("background"=>"../_html/_gct_wadm/list_category.php"));
    $tpl->set_block("background","GCTStoreCategoryBlock","StoreCategoryRW");

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
          $tpl->set_var("category_id",$_rw->category_id);
          $tpl->set_var("category_title",stripslashes($_rw->caption));
          $tpl->parse("StoreCategoryRW","GCTStoreCategoryBlock",true);
       }
       $_gct_MyDB->_gct_free($_dataRW);
    }
    else
    {
    }
 }
 else if ($_script_action == 'add-category-done')
 {
    $tpl->set_file(array("background"=>"../_html/_gct_wadm/add_category_done.php"));
 }
 else if ($_script_action == 'add-category')
 {       
    if (isset($_SERVER['REQUEST_METHOD']) && $_SERVER['REQUEST_METHOD']=='POST')
    {
       if (isset($_POST['title'])) $_gct_title = trim($_POST['title']);
       else $_gct_title = "";
       if (isset($_POST['icon'])) $_gct_icon = trim($_POST['icon']);
       else $_gct_icon = "";

       $_gct_title_LN = strlen($_gct_title);
       $_gct_icon_LN = strlen($_gct_icon);

       $_gct_accept_input = true;

       if ($_gct_title_LN < GCT_TITLE_MIN_LN || $_gct_title_LN > GCT_TITLE_MAX_LN)
       {
           $_gct_accept_input = false;
       }
       if ($_gct_icon_LN < GCT_ICON_MIN_LN || $_gct_icon_LN > GCT_ICON_MAX_LN)
       {
           $_gct_accept_input = false;
       }
       if ($_gct_accept_input == true)
       {
          $_dataRW = $_gct_MyDB->_gct_query("SELECT _gct_store_category.caption
                                             FROM
                                                  _gct_store_category
                                             WHERE
                                                  _gct_store_category.caption = \"".mysql_escape_string($_gct_title)."\"");
          if (mysql_num_rows($_dataRW))
          {
             $_gct_MyDB->_gct_free($_dataRW);

             $tpl->set_file(array("background"=>"../_html/_gct_wadm/add_category.php"));

             $tpl->set_var("title",$_gct_title);
             $tpl->set_var("icon",$_gct_icon);
             $tpl->set_var("title_max",GCT_TITLE_MAX_LN);
             $tpl->set_var("icon_max",GCT_ICON_MAX_LN);
             $tpl->set_var("script_tag",$_SERVER['PHP_SELF']);
             $tpl->set_var("ac","add-category");
          }
          else
          {
             $_dataRW = $_gct_MyDB->_gct_query("INSERT INTO _gct_store_category
                                                SET _gct_store_category.caption = \"".mysql_escape_string($_gct_title)."\",
                                                    _gct_store_category.icon = \"".mysql_escape_string($_gct_icon)."\",
                                                    _gct_store_category.ndate = NOW()");
                    
             _gct_redirect("index.php?ac=add-category-done");
          }
       }
       else
       {
          $tpl->set_file(array("background"=>"../_html/_gct_wadm/add_category.php"));

          $tpl->set_var("title",$_gct_title);
          $tpl->set_var("icon",$_gct_icon);
          $tpl->set_var("title_max",GCT_TITLE_MAX_LN);
          $tpl->set_var("icon_max",GCT_ICON_MAX_LN);
          $tpl->set_var("script_tag",$_SERVER['PHP_SELF']);
          $tpl->set_var("ac","add-category");
       }
    }
    else
    {
       $tpl->set_file(array("background"=>"../_html/_gct_wadm/add_category.php"));

       $tpl->set_var("title","");
       $tpl->set_var("icon","");
       $tpl->set_var("title_max",GCT_TITLE_MAX_LN);
       $tpl->set_var("icon_max",GCT_ICON_MAX_LN);
       $tpl->set_var("script_tag",$_SERVER['PHP_SELF']);
       $tpl->set_var("ac","add-category");
    }
 }
 else
 {
    $tpl->set_file(array("background"=>"../_html/_gct_wadm/index.php"));
 }

 $tpl->parse("background", array("background"));
 $tpl->finish("background");
 $tpl->p("background");
?>
