<?
/****************************************************************************
  Giftcardtoday.com
  Feb 13, 2005

 ****************************************************************************/

/****************************************************************************
 GCT session class
 ****************************************************************************/

class _GCT_Session_Class
{
  function _gct_session_start()
  {
    session_start();
  }

  function _gct_session_end()
  {
    _gct_redirect($_GCT_config['scripts']['login']);
  }

  function _gct_create_session()
  {

  }
}
?>
