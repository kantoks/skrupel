<?php
include ("../inc.conf.php");
include_once ('../inhalt/inc.hilfsfunktionen.php');
include ("../lang/".$language."/lang.admin.index.php");
$conn = @mysql_connect($server.':'.$port,"$login","$password");
$db = @mysql_select_db("$database",$conn);
if($db){
    compressed_output();
    session_name('skrupelAdmin');
    session_start();
    if (isset($_POST['loginname']) && isset($_POST['loginpass'])) {
        $_SESSION['ftploginname'] =$_POST['loginname'];
        $_SESSION['ftploginpass'] =$_POST['loginpass'];
    }
    if(isset($_SESSION['ftploginname']) && $_SESSION['ftploginname'] ==$admin_login && $_SESSION['ftploginpass'] == $admin_pass){
    ?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<title>S K R U P E L - Tribute Compilation - Administration</title>
<META NAME="Author" CONTENT="Bernd Kantoks bernd@kantoks.de">
<meta name="robots" content="index">
<meta name="keywords" content=" ">
</head>
<frameset framespacing="0" border="false" frameborder="0" rows="*,13,107,10">
<frameset framespacing="0" border="false" frameborder="0" rows="50,18,*,16,50">
<frame name="rahmenk" scrolling="no" marginwidth="0" marginheight="0" noresize src="../inhalt/aufbau.php?fu=0" target="_self">
     <frameset framespacing="0" border="false" frameborder="0" cols="60,114,*,114,60">
        <frame name="rahmen0" scrolling="no" marginwidth="0" marginheight="0" noresize src="../inhalt/aufbau.php?fu=0" target="_self">
          <frame name="rahmen1" scrolling="no" marginwidth="0" marginheight="0" noresize src="../inhalt/aufbau.php?fu=19" target="_self">
          <frame name="rahmen2" scrolling="no" marginwidth="0" marginheight="0" noresize src="../inhalt/aufbau.php?fu=20" target="_self">
          <frame name="rahmen3" scrolling="no" marginwidth="0" marginheight="0" noresize src="../inhalt/aufbau.php?fu=21" target="_self">
        <frame name="rahmen4" scrolling="no" marginwidth="0" marginheight="0" noresize src="../inhalt/aufbau.php?fu=0" target="_self">
         </frameset>
     <frameset framespacing="0" border="false" frameborder="0" cols="60,18,*,18,60">
        <frame name="rahmen10" scrolling="no" marginwidth="0" marginheight="0" noresize src="../inhalt/aufbau.php?fu=0" target="_self">
                    <frameset framespacing="0" border="false" frameborder="0" rows="80,*,92">
             <frame name="rahmen15" scrolling="no" marginwidth="0" marginheight="0" noresize src="../inhalt/aufbau.php?fu=25" target="_self">
             <frame name="rahmen16" scrolling="no" marginwidth="0" marginheight="0" noresize src="../inhalt/aufbau.php?fu=26" target="_self">
             <frame name="rahmen17" scrolling="no" marginwidth="0" marginheight="0" noresize src="../inhalt/aufbau.php?fu=27" target="_self">
                    </frameset>
          <frame name="rahmen12" scrolling="auto" marginwidth="0" marginheight="0" noresize src="welcome.php?fu=1" target="_self">
                    <frameset framespacing="0" border="false" frameborder="0" rows="80,*,92">
             <frame name="rahmen18" scrolling="no" marginwidth="0" marginheight="0" noresize src="../inhalt/aufbau.php?fu=28" target="_self">
             <frame name="rahmen19" scrolling="no" marginwidth="0" marginheight="0" noresize src="../inhalt/aufbau.php?fu=29" target="_self">
             <frame name="rahmen20" scrolling="no" marginwidth="0" marginheight="0" noresize src="../inhalt/aufbau.php?fu=30" target="_self">
                    </frameset>
        <frame name="rahmen14" scrolling="no" marginwidth="0" marginheight="0" noresize src="../inhalt/aufbau.php?fu=0" target="_self">
         </frameset>
     <frameset framespacing="0" border="false" frameborder="0" cols="60,114,*,114,60">
        <frame name="rahmen5" scrolling="no" marginwidth="0" marginheight="0" noresize src="../inhalt/aufbau.php?fu=0" target="_self">
          <frame name="rahmen6" scrolling="no" marginwidth="0" marginheight="0" noresize src="../inhalt/aufbau.php?fu=22" target="_self">
          <frame name="rahmen7" scrolling="no" marginwidth="0" marginheight="0" noresize src="../inhalt/aufbau.php?fu=23" target="_self">
          <frame name="rahmen8" scrolling="no" marginwidth="0" marginheight="0" noresize src="../inhalt/aufbau.php?fu=24" target="_self">
        <frame name="rahmen9" scrolling="no" marginwidth="0" marginheight="0" noresize src="../inhalt/aufbau.php?fu=0" target="_self">
         </frameset>
<frame name="rahmenk" scrolling="no" marginwidth="0" marginheight="0" noresize src="../inhalt/aufbau.php?fu=0" target="_self">
</frameset>
<frameset framespacing="0" border="false" frameborder="0" cols="387,*,364">
          <frame name="mitte2links" scrolling="no" marginwidth="0" marginheight="0" noresize src="../inhalt/aufbau.php?fu=31" target="_self">
          <frame name="mitte2mitte" scrolling="no" marginwidth="0" marginheight="0" noresize src="../inhalt/aufbau.php?fu=11" target="_self">
          <frame name="mitte2mitte" scrolling="no" marginwidth="0" marginheight="0" noresize src="../inhalt/aufbau.php?fu=32" target="_self">
         </frameset>
         <frameset framespacing="0" border="false" frameborder="0" cols="56,*,19">
          <frame name="untenlinks" scrolling="no" marginwidth="0" marginheight="0" noresize src="menu.php?fu=2" target="_self">
          <frame name="untenmitte" scrolling="auto" marginwidth="0" marginheight="0" noresize src="menu.php?fu=1" target="_self">
          <frame name="untenrechts" scrolling="no" marginwidth="0" marginheight="0" noresize src="../inhalt/aufbau.php?fu=15" target="_self">
         </frameset>
         <frameset framespacing="0" border="false" frameborder="0" cols="389,*,361">
          <frame name="unten2links" scrolling="no" marginwidth="0" marginheight="0" noresize src="../inhalt/aufbau.php?fu=16" target="_self">
          <frame name="unten2mitte" scrolling="no" marginwidth="0" marginheight="0" noresize src="../inhalt/aufbau.php?fu=17" target="_self">
          <frame name="unten2rechts" scrolling="no" marginwidth="0" marginheight="0" noresize src="../inhalt/aufbau.php?fu=18" target="_self">
         </frameset>
</frameset>
  <body>
  </body>
</html>
<?php } else {
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<title>S K R U P E L</title>
<META NAME="Author" CONTENT="Bernd Kantoks bernd@kantoks.de">
<meta name="robots" content="index">
<meta name="keywords" content=" ">
<META HTTP-EQUIV="imagetoolbar" CONTENT="no">
<style type="text/css">
BODY,P,TD{
    font-family: Verdana;
    font-size: 10px;
    color: #ffffff;
    scrollbar-DarkShadow-Color:#444444;
    scrollbar-3dLight-Color:#444444;
    scrollbar-Track-Color:#444444;
    scrollbar-Face-Color:#555555;
    scrollbar-Shadow-Color:#222222;
    scrollbar-Highlight-Color:#888888;
    scrollbar-Arrow-Color:#555555;
}
A{
    color: #aaaaaa;
    font-weight: bold;
    text-decoration: underline;
}
A:Hover{
    font-weight: bold;
    text-decoration: underline;
    color: #ffffff;
}
INPUT,SELECT{
    background-color: #555555;
    color: #ffffff;
    BORDER-BOTTOM-COLOR: #222222;
    BORDER-LEFT-COLOR: #888888;
    BORDER-RIGHT-COLOR: #222222;
    BORDER-TOP-COLOR: #888888;
    Border-Style: solid;
    Border-Width: 1px;
    font-family: Verdana;
    font-size: 10px;
}
INPUT.eingabe{
    background-color: #555555;
    color: #ffffff;
    BORDER-BOTTOM-COLOR: #888888;
    BORDER-LEFT-COLOR: #222222;
    BORDER-RIGHT-COLOR: #888888;
    BORDER-TOP-COLOR: #222222;
    Border-Style: solid;
    Border-Width: 1px;
    font-family: Verdana;
    font-size: 10px;
}
TEXTAREA{
    background-color: #555555;
    color: #ffffff;
    BORDER-BOTTOM-COLOR: #888888;
    BORDER-LEFT-COLOR: #222222;
    BORDER-RIGHT-COLOR: #888888;
    BORDER-TOP-COLOR: #222222;
    Border-Style: solid;
    Border-Width: 1px;
    font-family: Verdana;
    font-size: 10px;
}
</style>
</head>
<body text="#000000" bgcolor="#000000" scroll="no" background="../bilder/hintergrund.gif" link="#000000" vlink="#000000" alink="#000000" leftmargin="0" rightmargin="0" topmargin="0" marginwidth="0" marginheight="0">
<script language="JavaScript">
<!--
if(parent.frames.length>=1) {
window.top.location.href="index.php";
}
//-->
function check() {
  if(document.formular.login_f.value == "")  {
      alert("<?php echo html_entity_decode($lang['admin']['index']['bittenamen'])?>");
        document.formular.login_f.focus();
        return false;
   }
  if(document.formular.passwort_f.value == "")  {
    alert("<?php echo html_entity_decode($lang['admin']['index']['bittepasswort'])?>");
        document.formular.passwort_f.focus();
        return false;
   }
  return true;
}
</script>
<center><table border="0" height="100%" cellspacing="0" cellpadding="0">
    <tr>
    <td><table border="0" cellspacing="0" cellpadding="0" background="../bilder/login.gif">
             <tr>
                <td><img src="../bilder/empty.gif" border="0" width="1" height="1"></td>
                <td><img src="../bilder/empty.gif" border="0" width="628" height="1"></td>
                <td><img src="../bilder/empty.gif" border="0" width="1" height="1"></td>
             </tr>
             <tr>
                <td><img src="../bilder/empty.gif" border="0" width="1" height="347"></td>
                <td valign="top"><center>
                <img src="../bilder/empty.gif" border="0" width="1" height="30"><br>
        <img src="../bilder/logo_login.gif" width="329" height="208">
                <br>
             <table border="0" cellspacing="0" cellpadding="4">
                 <tr>
          <td><form action="index.php" method="post" name="formular" onSubmit="return check();"></td>
          <td align="right"><?php echo $lang['admin']['index']['name']?></td>
          <td><input type="text" name="loginname" class="eingabe" maxlength="50" style="width:350px;" value=""></td>
          <td></td>
                 </tr>
                 <tr>
                    <td></td>
          <td align="right"><?php echo $lang['admin']['index']['passwort']?></td>
          <td><input type="password" name="loginpass" class="eingabe" maxlength="50" style="width:350px;" value=""></td>
                    <td></td>
                 </tr>
         <tr>
                    <td></td>
          <td align="right">&nbsp;</td>
          <td><input type="submit" name="submit" value="<?php echo $lang['admin']['index']['login']?>" style="width:350px;"></td>
          <td></form></td>
         </tr>
       </table>
                </center></td>
                <td><img src="../bilder/empty.gif" border="0" width="1" height="347"></td>
             </tr>
             <tr>
                <td><img src="../bilder/empty.gif" border="0" width="1" height="1"></td>
                <td><img src="../bilder/empty.gif" border="0" width="628" height="1"></td>
                <td><img src="../bilder/empty.gif" border="0" width="1" height="1"></td>
             </tr>
      </table></td>
    </tr>
</table></center>
</body>
</html>
<?php }
@mysql_close();
} else { ?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<title>Skrupel - Tribute Compilation</title>
<META NAME="Author" CONTENT="Bernd Kantoks bernd@kantoks.de">
<meta name="robots" content="index">
<meta name="keywords" content=" ">
<META HTTP-EQUIV="imagetoolbar" CONTENT="no">
</head>
<body text="#000000" scroll="no" bgcolor="#000000" background="../bilder/hintergrund.gif" link="#000000" vlink="#000000" alink="#000000" leftmargin="0" rightmargin="0" topmargin="0" marginwidth="0" marginheight="0">
<center><table border="0" height="100%" cellspacing="0" cellpadding="0">
<tr><td style="font-family:Verdana;font-size:10px;color:#ffffff;"><nobr><?php echo $lang['admin']['index']['fehler']?></nobr></td></tr>
</table></center>
</body>
</html>
<?php
} 
