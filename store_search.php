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
 $tpl->set_file(array("background"=>"_html/store_search.php"));
 $tpl->set_block("background","GCTStoreListBlock","StoreListRW");

 if (isset($_SERVER['REQUEST_METHOD']) && $_SERVER['REQUEST_METHOD']=='POST')
 {
    if (isset($_POST['q'])) $_gct_search_string = trim($_POST['q']);
    else $_gct_search_string = "";

    $_gct_search_string_LN = strlen($_gct_search_string);
    if ($_gct_search_string_LN > 64)   // exploit/hacking attempt detected!
    {
       $_gct_search_string = substr($_gct_search_string,64);
    }
    if ($_gct_search_string_LN > 0)
    {
       $_gct_stringEX = explode(" ",$_gct_search_string);
       $_gct_like_match = "";

       foreach ($_gct_stringEX as $_gct_stringE)
       {
         if ($_gct_like_match != "") $_gct_like_match.= " OR ";
         $_gct_like_match .= "_gct_store_info.store_name LIKE   \"%$_gct_stringE%\"";
       }

       $_dataRW = $_gct_MyDB->_gct_query("SELECT _gct_store_info.store_logo,
                                                 _gct_store_info.store_name,
                                                 _gct_store_info.store_id,
                                                 _gct_store_info.store_available,
                                                 _gct_store_info.store_category_id
                                          FROM
                                                 _gct_store_info
                                          WHERE                                          
                                                 $_gct_like_match");
       $_gct_match_count = 0;
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
             $_gct_match_count++;
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
       $tpl->set_var("string",$_gct_search_string);
       $tpl->set_var("no_match","$_gct_match_count");
    }
    else
    {
       $tpl->set_var("star_icon","");
       $tpl->set_var("store_name","");
       $tpl->set_var("store_buttons","");
       $tpl->set_var("string",$_gct_search_string);
       $tpl->set_var("no_match","0");
       $tpl->parse("StoreListRW","GCTStoreListBlock",true);   
    }
 }
 else
 {
    $tpl->set_var("star_icon","");
    $tpl->set_var("store_name","");
    $tpl->set_var("store_buttons","");
    $tpl->set_var("string",$_gct_search_string);
    $tpl->set_var("no_match","0");
    $tpl->parse("StoreListRW","GCTStoreListBlock",true);   
 }
 
 $tpl->parse("background", array("background"));
 $tpl->finish("background");
 $tpl->p("background");
?>
