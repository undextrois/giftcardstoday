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

 if (isset($_SERVER['REQUEST_METHOD']) && $_SERVER['REQUEST_METHOD']=='POST')
 {
    if (isset($_POST['ac'])) $_gct_auth_code = trim($_POST['ac']);
    else $_gct_auth_code = "";
    if (isset($_POST['us'])) $_gct_user = trim($_POST['us']);
    else $_gct_user = "";

    $_gct_ath_code_LN = strlen($_gct_auth_code);
    $_gct_user_LN = strlen($_gct_user);

    if (!$_gct_auth_code_LN && $_gct_auth_code_LN > 32)
    {
       $tpl->set_file(array("background"=>"_html/auth_error.php"));
    }
    else if ($_gct_user_LN < 1 || $_gct_user_LN > 16)
    {     
       $tpl->set_file(array("background"=>"_html/auth_error.php"));
    }
    else
    {
       $_dataRW = $_gct_MyDB->_gct_query("SELECT _gct_login_info.user,
                                                 _gct_login_info.auth_code,
                                                 _gct_login_info.status
                                          FROM
                                                 _gct_login_info
                                          WHERE
                                                 _gct_login_info.user = \"".mysql_escape_string($_gct_user)."\"");
       if (mysql_num_rows($_dataRW))
       {
          $_rw = mysql_fetch_object($_dataRW);
          $_gct_status = stripslashes($_rw->status);
          $_gct_auth_codeV = stripslashes($_rw->auth_code);
          $_gct_MyDB->_gct_free($_dataRW);

          if ($_gct_status == "Active")
          {
             $tpl->set_file(array("background"=>"_html/auth_error.php"));
          }
          else if ($_gct_auth_codeV != $_gct_auth_code)
          {
             $tpl->set_file(array("background"=>"_html/auth_error.php"));
          }
          else
          {
             $_gct_MyDB->_gct_query("UPDATE _gct_login_info
                                     SET
                                            _gct_login_info.status = 'Active',
                                            _gct_login_info.mdate = NOW()");
             _gct_redirect("active.php");
          }       
       }
       else
       {
          $tpl->set_file(array("background"=>"_html/auth_error.php"));
       }
    }
 }
 else
 {
    if (isset($_GET['ac'])) $_gct_auth_code = trim($_GET['ac']);
    else $_gct_auth_code = "";
    $_gct_auth_code_LN = strlen($_gct_auth_code);

    if (!$_gct_auth_code_LN || $_gct_auth_code_LN > 32)
    {
       $tpl->set_file(array("background"=>"_html/auth_error.php"));
    }
    else
    {
       $tpl->set_file(array("background"=>"_html/activate.php"));
       $tpl->set_var("ac",$_gct_auth_code);
       $tpl->set_var("script_tag",$_SERVER['PHP_SELF']);
    }
 }

 $tpl->parse("background", array("background"));
 $tpl->finish("background");
 $tpl->p("background");
?>      
