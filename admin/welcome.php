<?php
if ($_GET["fu"]==1) {
  include ("../inc.conf.php");
  include ("../lang/".$language."/lang.admin.welcome.php");
  include ("inc.header.php");
  if(($ftploginname==$admin_login) and ($ftploginpass==$admin_pass)){
    ?>
<body text="#ffffff" bgcolor="#444444" link="#000000" vlink="#000000" alink="#000000" leftmargin="0" rightmargin="0" topmargin="0" marginwidth="0" marginheight="0">
  <center>
    <table border="0" height="100%" cellspacing="0" cellpadding="0">
      <tr>
        <td>
          <center>
            <img src="../bilder/logo_login.gif" width="329" height="208"><br>
            <table border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td style="font-size:20px; font-weight:bold; filter:DropShadow(color=black, offx=2, offy=2)">
    <?php
    echo $lang['admin']['welcome']['admin'];
    ?>
                </td>
              </tr>
            </table>
          </center>
        </td>
      </tr>
    </table>
  </center>
    <?php
  }
  include ("inc.footer.php");
}
