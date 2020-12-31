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


 $_gct_logo_path = "logo/";

 $_gct_MyDB = new _GCT_DB_Class();

 $tpl=new Template(".","keep");
 $tpl->set_file(array("background"=>"_html/view_store_certificate.php"));
 $tpl->set_block("background","GCTStoreListBlock","StoreListRW");
 $tpl->set_block("background","GCTDGCListBlock","DGCListRW");
 $tpl->set_block("background","GCTFVGCListBlock","FVGCListRW");

 /*
 $_dataRW = $_gct_MyDB->_gct_query("SELECT _gct_store_category.icon,
                                           _gct_store_category.caption,
                                           _gct_store_category.category_id,
                                           _gct_store_tbl.icon,
                                           _gct_store_tbl.name,
                                           UNIX_TIMESTAMP(_gct_store_category.ndate) AS n_date
                                    FROM
                                           _gct_store_category,_gct_store_tbl");
 */

 if (isset($_GET['categoryid']) && intval($_GET['categoryid']))
    $_gct_category_id = intval($_GET['categoryid']);
 else
    _gct_redirect("index.php");

 if (isset($_GET['storeid']) && intval($_GET['storeid']))
    $_gct_store_id = intval($_GET['storeid']);
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
                                           _gct_store_info.store_website,
                                           _gct_store_info.store_locator,
                                           _gct_store_info.store_id,
                                           _gct_store_info.store_description,
                                           _gct_store_info.store_category_id
                                    FROM
                                           _gct_store_info
                                    WHERE
                                           _gct_store_info.store_category_id = '$_gct_category_id'
                                    AND
                                          _gct_store_info.store_id = '$_gct_store_id'");

 if (mysql_num_rows($_dataRW))
 {
    $_rw = mysql_fetch_object($_dataRW);
    $tpl->set_var("store_logo",$_gct_logo_path . $_rw->store_logo);
    $tpl->set_var("store_locator","<a href=\"".stripslashes($_rw->store_locator)."\">Click Here</a>");
    $tpl->set_var("store_website",stripslashes($_rw->store_website));
    $tpl->set_var("store_description",stripslashes($_rw->store_description));
    $tpl->set_var("store_name",stripslashes($_rw->store_name));    
    $tpl->set_var("store_buttons","<input type=\"button\" name=\"view_cert\" value=\"View Certificate\" onClick=\"_view_certificate_onclick($_rw->store_category_id,$_rw->store_id)\"><input type=\"button\" name=\"sell_cert\" value=\"Sell a Certificate\">");
    // $tpl->parse("StoreListRW","GCTStoreListBlock",true);
    $_gct_MyDB->_gct_free($_dataRW);
 }
 else
 {
       $tpl->set_var("store_name","");
       $tpl->set_var("store_buttons","");
       // $tpl->parse("StoreListRW","GCTStoreListBlock",true);   
 }

 $_gct_DGC_table = "";
 $_gct_FVGC_table = "";

 $_dataRW = $_gct_MyDB->_gct_query("SELECT _gct_product_info.*
                                    FROM
                                           _gct_product_info
                                    WHERE
                                           _gct_product_info.store_id = '$_gct_store_id'");
 if (mysql_num_rows($_dataRW))
 {
    $_gct_dgc = false;
    $_gct_fvgc = false;
    while ($_rw = mysql_fetch_object($_dataRW))
    {
       $_gct_cs_value = number_format($_rw->cs_value,2);
       $_gct_face_value = number_format($_rw->face_value,2);
       $_gct_comment = stripslashes($_rw->comment);
       $_gct_rating = $_rw->rating;
       $_gct_user = "";
       if ($_rw->cert_type == 'In-Store') $_gct_icon = "tab_ico_instore.gif";
       else if ($_rw->cert_type == 'Online') $_gct_icon = "tab_ico_online.gif";       
       
       if ($_rw->class == "DGC")
       {
          $_gct_DGC_table = "                      <tr>\n"; 
          $_gct_DGC_table.= "                        <td width=\"15%\"><font size=\"2\" face=\"Arial, Helvetica, sans-serif\" color=\"#AF1B05\"><strong>\$ $_gct_cs_value</strong></font></td>\n";
          $_gct_DGC_table.= "                        <td width=\"15%\"><font size=\"2\" face=\"Arial, Helvetica, sans-serif\"><strong>\$ $_gct_face_value</strong></font></td>\n";
          $_gct_DGC_table.= "                        <td width=\"5%\"><font size=\"2\" face=\"Arial, Helvetica, sans-serif\"><a href=\"my_credit.php\"><img src=\"images/buy2.gif\" border=\"0\"></a></font></td>\n";
          $_gct_DGC_table.= "                        <td width=\"15%\"><font size=\"2\" face=\"Arial, Helvetica, sans-serif\"><strong>$_gct_user&nbsp;$_gct_rating</strong></font></td>\n";
          $_gct_DGC_table.= "                        <td width=\"20%\"><font size=\"2\" face=\"Arial, Helvetica, sans-serif\"><img src=\"images/$_gct_icon\" width=\"113\" height=\"21\" border=\"0\"></font></td>\n";
          $_gct_DGC_table.= "                        <td width=\"30%\"><font size=\"2\" face=\"Arial, Helvetica, sans-serif\">$_gct_comment</font></td>\n";
          $_gct_DGC_table.= "                      </tr>\n";
          $tpl->set_var("DGC_table",$_gct_DGC_table);
          $tpl->parse("DGCListRW","GCTDGCListBlock",true);
          $_gct_dgc = true;
       }
       else if ($_rw->class == 'FVGC')
       {
          $_gct_FVGC_table = "                      <tr>\n"; 
          $_gct_FVGC_table.= "                        <td width=\"15%\"><font size=\"2\" face=\"Arial, Helvetica, sans-serif\" color=\"#AF1B05\"><strong>\$ $_gct_cs_value</strong></font></td>\n";
          $_gct_FVGC_table.= "                        <td width=\"15%\"><font size=\"2\" face=\"Arial, Helvetica, sans-serif\"><strong>\$ $_gct_face_value</strong></font></td>\n";
          $_gct_FVGC_table.= "                        <td width=\"5%\"><font size=\"2\" face=\"Arial, Helvetica, sans-serif\"><a href=\"my_credit.php\"><img src=\"images/buy2.gif\" border=\"0\"></a></font></td>\n";
          $_gct_FVGC_table.= "                        <td width=\"15%\"><font size=\"2\" face=\"Arial, Helvetica, sans-serif\"><strong>$_gct_user&nbsp;$_gct_rating</strong></font></td>\n";
          $_gct_FVGC_table.= "                        <td width=\"20%\"><font size=\"2\" face=\"Arial, Helvetica, sans-serif\"><img src=\"images/$_gct_icon\" width=\"113\" height=\"21\" border=\"0\"></font></td>\n";
          $_gct_FVGC_table.= "                        <td width=\"30%\"><font size=\"2\" face=\"Arial, Helvetica, sans-serif\">$_gct_comment</font></td>\n";
          $_gct_FVGC_table.= "                      </tr>\n";
          $tpl->set_var("FVGC_table",$_gct_FVGC_table);
          $tpl->parse("FVGCListRW","GCTFVGCListBlock",true);
          $_gct_fvgc = true;
       }
    }

    if ($_gct_dgc == false)
    {
       $_gct_DGC_table = "<tr><td colspan=\"6\">No Items Available</td></tr>";
       $tpl->set_var("DGC_table",$_gct_DGC_table);
       $tpl->parse("DGCListRW","GCTDGCListBlock",true);
    }
    if ($_gct_fvgc == false)
    {
       $_gct_FVGC_table = "<tr><td colspan=\"6\">No Items Available</td></tr>";
       $tpl->set_var("FVGC_table",$_gct_FVGC_table);
       $tpl->parse("FVGCListRW","GCTFVGCListBlock",true);
    }
    $_gct_MyDB->_gct_free($_dataRW);
 }
 else
 {
    $_gct_DGC_table = "<tr><td colspan=\"6\">No Items Available</td></tr>";
    $tpl->set_var("DGC_table",$_gct_DGC_table);
    $tpl->parse("DGCListRW","GCTDGCListBlock",true);

    $_gct_FVGC_table = "<tr><td colspan=\"6\">No Items Available</td></tr>";
    $tpl->set_var("FVGC_table",$_gct_FVGC_table);
    $tpl->parse("FVGCListRW","GCTFVGCListBlock",true);
 }

 $tpl->parse("background", array("background"));
 $tpl->finish("background");
 $tpl->p("background");
?>
