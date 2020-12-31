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

 $_gct_error_string = array();
 $_gct_accept_input = true;

 if (isset($_SERVER['REQUEST_METHOD']) && $_SERVER['REQUEST_METHOD'] == 'POST')
 {
    $_gct_fname = trim($_POST['_fname']);
    if (empty($_gct_fname))
    {
        $_gct_accept_input = false;
        $_gct_error_string[] = "* First Name is required";
    }
    $_gct_lname = trim($_POST['_lname']);
    if (empty($_gct_lname))
    {
       $_gct_accept_input = false;
       $_gct_error_string[] = "* Last Name is required";
    }
    $_gct_street_addr1 = trim($_POST['_street_addr1']);
    if (empty($_gct_street_addr1))
    {
       $_gct_accept_input = false;
       $_gct_error_string[] = "* Street address is required";
    }
    $_gct_street_addr2 = trim($_POST['_street_addr2']);
    $_gct_city = trim($_POST['_city']);
    if (empty($_gct_city))
    {
       $_gct_accept_input = false;
       $_gct_error_string[] = "* City is required";
    }
    $_gct_state = trim($_POST['_state']);
    if (empty($_gct_state))
    {
       $_gct_accept_input = false;
       $_gct_error_string[] = "* State is required";
    }
    $_gct_zip_code = trim($_POST['_zip_code']);
    if (empty($_gct_zip_code))
    {
       $_gct_accept_input = false;
       $_gct_error_string[] = "* Zip Code is required";
    }
    $_gct_country = trim($_POST['_country']);
    if (empty($_gct_country))
    {
       $_gct_accept_input = false;
       $_gct_error_string[] = "* Country is required";
    }
    $_gct_phone_no1 = trim($_POST['_phone_no1']);
    if (empty($_gct_phone_no1))
    {
       $_gct_accept_input = false;
       $_gct_error_string[] = "* Primary phone no is required";
    }
    $_gct_phone_no2 = trim($_POST['_phone_no2']);

    $_gct_email = trim($_POST['_email']);
    if (empty($_gct_email))
    {
       $_gct_accept_input = false;
       $_gct_error_string[] = "* E-Mail address is required";
    }
    $_gct_user = trim($_POST['_user']);
    if (empty($_gct_user))
    {
       $_gct_accept_input = false;
       $_gct_error_string[] = "* Username is required";
    }
    $_gct_pass1 = trim($_POST['_pass1']);
    if (empty($_gct_pass1))
    {
       $_gct_accept_input = false;
       $_gct_error_string[] = "* Password is required";
    }
    $_gct_pass2 = trim($_POST['_pass2']);
    if (empty($_gct_pass2))
    {
       $_gct_accept_input = false;
    }
    $_gct_secret_question = trim($_POST['_secret_question']);
    if (empty($_gct_secret_question))
    {
       $_gct_accept_input = false;
    }
    $_gct_secret_answer = trim($_POST['_secret_answer']);
    if (empty($_gct_secret_answer))
    {
       $_gct_accept_input = false;
    }
    $_gct_dob_mm = $_POST['_dob_mm'];
    if (empty($_gct_dob_mm))
    {
       $_gct_accept_input = false;
    }
    $_gct_dob_dd = $_POST['_dob_dd'];
    if (empty($_gct_dob_dd))
    {
       $_gct_accept_input = false;
    }
    $_gct_dob_yyyy = $_POST['_dob_yyyy'];
    if (empty($_gct_dob_yyyy))
    {
       $_gct_accept_input = false;
    }

    $_gct_action = trim($_POST['_action']);    

    if (_gct_is_email($_gct_email))
    {
       $_dataRW = $_gct_MyDB->_gct_query("SELECT _gct_user_info.email
                                          FROM
                                                 _gct_user_info
                                          WHERE
                                                 _gct_user_info.email='".mysql_escape_string($_gct_email)."'");
       if (mysql_num_rows($_dataRW))
       {
          $_gct_accept_input = false;
          $_gct_MyDB->_gct_free($_dataRW);
          $_gct_error_string[] = "* E-Mail address is already in use";
       }
    }
    else
    {
       $_gct_accept_input = false;
    }

    if (_gct_is_user($_gct_user))
    {
       $_dataRW = $_gct_MyDB->_gct_query("SELECT _gct_login_info.user
                                          FROM
                                                 _gct_login_info
                                          WHERE
                                                 _gct_login_info.user='".mysql_escape_string($_gct_user)."'");
       if (mysql_num_rows($_dataRW))
       {
          $_gct_accept_input = false;         
          $_gct_MyDB->_gct_free($_dataRW);
          $_gct_error_string[] = "* Username is already taken";
       }
    }
    else
    {
       $_gct_accept_input = false;
    }

    $_gct_pass1_LN = strlen($_gct_pass1);

    if ($_gct_pass1_LN >= 6 && $_gct_pass1_LN <= 16)
    {
       if ($_gct_pass1 != $_gct_pass2)
       {
          $_gct_accept_input = false;
          $_gct_error_string[] = "* Password did not matched";
       }
    }
    else
    {
      $_gct_accept_input = false;
      $_gct_error_string[] = "* Password did not matched/No password specified";
    }

    if ($_gct_accept_input == true)
    {
       if ($_gct_action == "step_02")
       {
          $tpl=new Template(".","keep");
          $tpl->set_file(array("background"=>"_html/terms_of_service.php"));

          $tpl->set_var("_fname",$_gct_fname);
          $tpl->set_var("_lname",$_gct_lname);
          $tpl->set_var("_street_addr1",$_gct_street_addr1);
          $tpl->set_var("_street_addr2",$_gct_street_addr2);
          $tpl->set_var("_city",$_gct_city);
          $tpl->set_var("_state",$_gct_state);
          $tpl->set_var("_zip_code",$_gct_zip_code);
          $tpl->set_var("_country",$_gct_country);
          $tpl->set_var("_phone_no1",$_gct_phone_no1);
          $tpl->set_var("_phone_no2",$_gct_phone_no2);
          $tpl->set_var("_email",$_gct_email);
          $tpl->set_var("_user",$_gct_user);
          $tpl->set_var("_pass1",$_gct_pass1);
          $tpl->set_var("_pass2",$_gct_pass2);
          $tpl->set_var("_secret_question",$_gct_secret_question);
          $tpl->set_var("_secret_answer",$_gct_secret_answer);
          $tpl->set_var("_dob_mm",$_gct_dob_mm);
          $tpl->set_var("_dob_dd",$_gct_dob_dd);
          $tpl->set_var("_dob_yyyy",$_gct_dob_yyyy);

          $tpl->parse("background", array("background"));
          $tpl->finish("background");
          $tpl->p("background");
       exit;
       }
       else if ($_gct_action == "step_03")
       {
            $_gct_MyDB->_gct_query("
                INSERT INTO _gct_user_info
                SET
                    _gct_user_info.fname = \"".mysql_escape_string($_gct_fname)."\",
                    _gct_user_info.lname = \"".mysql_escape_string($_gct_lname)."\",
                    _gct_user_info.street_addr1 = \"".mysql_escape_string($_gct_street_addr1)."\",
                    _gct_user_info.street_addr2 = \"".mysql_escape_string($_gct_street_addr2)."\",
                    _gct_user_info.city = \"".mysql_escape_string($_gct_city)."\",
                    _gct_user_info.state = \"".mysql_escape_string($_gct_state)."\",
                    _gct_user_info.zip_code = \"".mysql_escape_string($_gct_zip_code)."\",
                    _gct_user_info.country = \"".mysql_escape_string($_gct_country)."\",
                    _gct_user_info.primary_no = \"".mysql_escape_string($_gct_phone_no1)."\",
                    _gct_user_info.secondary_no = \"".mysql_escape_string($_gct_phone_no2)."\",
                    _gct_user_info.email = \"".mysql_escape_string($_gct_email)."\",
                    _gct_user_info.date_of_birth = \"$_gct_yyyy-$_gct_mm-$_gct_dd\",
                    _gct_user_info.info_date = NOW()
            ");

            $_gct_userid = mysql_insert_id();

            $_gct_auth_code = _gct_gen_auth_code();

            $_gct_MyDB->_gct_query("
            INSERT INTO _gct_login_info
            SET
               _gct_login_info.user = \"".mysql_escape_string($_gct_user)."\",
               _gct_login_info.pass = \"".mysql_escape_string($_gct_pass1)."\",
               _gct_login_info.question = \"".mysql_escape_string($_gct_secret_question)."\",
               _gct_login_info.answer = \"".mysql_escape_string($_gct_secret_answer)."\",
               _gct_login_info.userid = $_gct_userid,
               _gct_login_info.auth_code =\"$_gct_auth_code\"");

            $_gct_script = $_SERVER['PHP_SELF'];
            $_gct_location = preg_replace("/register.php/","activate.php",$_gct_script);
            $_gct_location = $_SERVER['SERVER_NAME'] . $_gct_location;

            $_gct_mail = "
            Dear $_gct_user,

            Welcome to GiftCardsToday.com, the internet's only exclusive gift
            certificate marketplace. We appreciate you registering on our site
            however
            to protect the security and integrity of all of our members, we ask
            that you
            first confirm your email address by following the instructions found in
            this
            email.

            --------------

            (1) Please click on the link below to activate your account:

            http://$_gct_location?ac=$_gct_auth_code

            Auth Code: $_gct_auth_code

            --------------

            If you do not confirm your email address by clicking on the above link
            within 72 hours, your account will be erased.

            We thank you in advance for confirming your email address and we'd like to
            be the first to welcome you as our newest member of
            GiftCardsToday.com!


            Sincerely,
            The Gift Cards Today Team
            ";

            @mail($_gct_email, "Welcome to GiftCardsToday.com", $_gct_mail,
                 "From: webmaster@{$_SERVER['SERVER_NAME']}", "-fwebmaster@{$_SERVER['SERVER_NAME']}");

            _gct_redirect("final.php");
       }
    }
 }

 $tpl=new Template(".","keep");
 $tpl->set_file(array("background"=>"_html/register.php"));
 $tpl->set_block("background","GCTMonthListBlock","MonthRW");
 $tpl->set_block("background","GCTDayListBlock","DayRW");
 $tpl->set_block("background","GCTYearListBlock","YearRW");

 for ($n = 1; $n < 31; $n++)
 {
     $tpl->set_var("_dd",$n);
     $tpl->parse("DayRW","GCTDayListBlock",true);
     if ($n <= 12)
     {
        $tpl->set_var("_mm",$n);
        $tpl->parse("MonthRW","GCTMonthListBlock",true);
     }
 }
 $_yyyy = date("Y");
 for ($n = $_yyyy; $n >= ($_yyyy - 100); $n--)
 {
     $tpl->set_var("_yyyy",$n);
     $tpl->parse("YearRW","GCTYearListBlock",true);
 }

 if ($_gct_accept_input==false)
 {
    foreach ($_gct_error_string as $_gct_estr)
    {
      $_gct_errstr.= $_gct_estr . "<br>";
    }
    $tpl->set_var("error_string","ERROR<br>".$_gct_errstr);

    $tpl->set_var("_fname",$_gct_fname);
    $tpl->set_var("_lname",$_gct_lname);
    $tpl->set_var("_street_addr1",$_gct_street_addr1);
    $tpl->set_var("_street_addr2",$_gct_street_addr2);
    $tpl->set_var("_city",$_gct_city);
    $tpl->set_var("_state",$_gct_state);
    $tpl->set_var("_zip_code",$_gct_zip_code);
    $tpl->set_var("_country",$_gct_country);
    $tpl->set_var("_phone_no1",$_gct_phone_no1);
    $tpl->set_var("_phone_no2",$_gct_phone_no2);
    $tpl->set_var("_email",$_gct_email);
    $tpl->set_var("_user",$_gct_user);
    $tpl->set_var("_pass1",$_gct_pass1);
    $tpl->set_var("_pass2",$_gct_pass2);
    $tpl->set_var("_secret_answer",$_gct_secret_answer);
 }
 else
 {
    $tpl->set_var("error_string","");
    $tpl->set_var("_fname","");
    $tpl->set_var("_lname","");
    $tpl->set_var("_street_addr1","");
    $tpl->set_var("_street_addr2","");
    $tpl->set_var("_city","");
    $tpl->set_var("_state","");
    $tpl->set_var("_zip_code","");
    $tpl->set_var("_country","");
    $tpl->set_var("_phone_no1","");
    $tpl->set_var("_phone_no2","");
    $tpl->set_var("_email","");
    $tpl->set_var("_user","");
    $tpl->set_var("_pass1","");
    $tpl->set_var("_pass2","");
    $tpl->set_var("_secret_answer","");
 }

 $tpl->parse("background", array("background"));
 $tpl->finish("background");
 $tpl->p("background");

 function _gct_gen_auth_code()
 {
   $_auth_code = md5(uniqid(rand(), true));
   return $_auth_code;
 }
?>
