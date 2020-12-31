<?
/****************************************************************************
  Giftcardtoday.com
  Feb 13, 2005

 ****************************************************************************/

 class _GCT_DB_Class
 {
   var $_gct_con_hnd;                       /* database connection handler */
   var $_gct_db_lnk;                        /* database link */

   /* initialize mysql connection */

   function _GCT_DB_ini()
   {
     $this->_gct_con_hnd = @mysql_connect($GLOBALS['_GCT_config']['host'],
                                          $GLOBALS['_GCT_config']['user'],
                                          $GLOBALS['_GCT_config']['pass']);
     if (!$this->_gct_con_hnd) _gct_plug_err("unable to connect to mysql server");
     $this->_gct_db_lnk = @mysql_select_db($GLOBALS['_GCT_config']['db']);
     if (!$this->_gct_db_lnk) _gct_plug_err("unable to select database");
   }

   function _GCT_DB_Class()
   {
     $this->_GCT_DB_ini();
   }

   /* close mysql connection */

   function _gct_destroy()
   {
     @mysql_close ($this->_gct_con_hnd);
     $this->_gct_con_hnd = null;
     $this->_gct_db_lnk = null;
   }

   /* query data */

   function _gct_query($_prm_query)
   {
     if (!$this->_gct_con_hnd)
         $this->_GCT_DB_ini();  /* make sure that we are connected */
     $this->_gct_catch
     (
        ($_result=mysql_query($_prm_query))
     );

   return $_result;
   }

   /* free result */

   function _gct_free($_prm_result)
   {
     @mysql_free_result($_prm_result);
   }

   /* generic error handler */

   function _gct_catch($_prm_stat)
   {
     if ($_prm_stat == false)
     {
        $_errmsg = mysql_error();
        $this->_gct_destroy();
        _gct_plug_err($_errmsg);
     }
   }
 }
?>
