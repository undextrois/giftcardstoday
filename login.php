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

 $_gct_new_location = "index.php";
 $_gct_new_location = (isset($_POST['rd']) ? trim($_POST['rd']) : trim($_GET['rd']));

 $tpl=new Template(".","keep");

 // force logout
 if (session_is_registered("user")) session_unregister("user");

 if (isset($_SERVER['REQUEST_METHOD']) && $_SERVER['REQUEST_METHOD'] == 'POST')
 {
    $_gct_user = trim($_POST['user']);
    $_gct_user_LN = strlen($_gct_user);
    $_gct_pass = trim($_POST['pass']);
    $_gct_pass_LN = strlen($_gct_pass);

    if (($_gct_user_LN >= 1 && $_gct_user_LN <= 16) &&
        ($_gct_pass_LN >= 1 && $_gct_pass_LN <= 16))
    {
       $_dataRW = $_gct_MyDB->_gct_query("SELECT _gct_login_info.user,
                                                 _gct_login_info.pass,
                                                 _gct_login_info.status
                                          FROM
                                                 _gct_login_info
                                          WHERE
                                                 _gct_login_info.user='".mysql_escape_string($_gct_user)."'");
       if (mysql_num_rows($_dataRW))
       {
          $_rw = mysql_fetch_object($_dataRW);
          $_gct_tpass = stripslashes($_rw->pass);
          $_gct_status = stripslashes($_rw->status);
          $_gct_MyDB->_gct_free($_dataRW);

          if ($_gct_status != 'Active' || $_gct_status == 'Suspended')
          {
              $tpl->set_file(array("background"=>"_html/auth_required.php"));
          }
          else if ($_gct_status == 'Removed')
          {
              $tpl->set_file(array("background"=>"_html/login.php"));
          }
          else
          {
             if ($_gct_tpass == $_gct_pass)
             {
                session_register("user");
                $_SESSION['user'] = $_gct_user;
                _gct_redirect($_gct_new_location);
             }
             else
             {
               @session_destroy();
               $tpl->set_file(array("background"=>"_html/login.php"));
             }
          }
       }
    }
 }
 else
 {
    $tpl->set_file(array("background"=>"_html/login.php"));
 }

 $tpl->set_var("script_redirect",$_gct_new_location);
 $tpl->set_var("script_tag",$_SERVER['PHP_SELF']);

 $tpl->parse("background", array("background"));
 $tpl->finish("background");
 $tpl->p("background");
?>
