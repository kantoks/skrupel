<?php
$langfile_1='hilfe_antriebe';

if($_GET["fu"]>=1){
  include ("../inc.conf.php");
  include ("inc.header.php");
  ?>
  <body text="#000000" bgcolor="#444444"  link="#000000" vlink="#000000" alink="#000000" leftmargin="0" rightmargin="0" topmargin="0" marginwidth="0" marginheight="0">
    <script language=JavaScript>parent.document.title='<?php echo $lang['hilfe_antriebe'][$_GET["fu"]][0]; ?>';</script>
    <br>
    <table border="0" cellspacing="0" cellpadding="4" width="100%">
      <tr>
        <td colspan="5" style="font-size:18px; font-weight:bold; filter:DropShadow(color=black, offx=2, offy=2)">
          <center>
  <?php
  echo $lang['hilfe_antriebe'][$_GET["fu"]][0];
  ?>
          </center>
        </td>
      </tr>
      <tr>
        <td>
          <br>
          <center>
  <?php
  echo str_replace('{1}',$lang['hilfe_antriebe'][$_GET["fu"]][1],$lang['hilfe_antriebe']['maxwarp']);
  ?>
          </center>
        </td>
      </tr>
      <tr>
        <td style="color:#aaaaaa;"><br>
  <?php
  echo $lang['hilfe_antriebe'][$_GET["fu"]][2];
  ?>
        </td>
      </tr>
    </table>
  <?php
  include ("inc.footer.php");
}else{
  include ("../inc.conf.php");
  include ("inc.header.php");
  ?>
<frameset framespacing="0" border="false" frameborder="0" rows="18,*,16">
  <frameset framespacing="0" border="false" frameborder="0" cols="114,*,114">
    <frame name="rahmen1" scrolling="no" marginwidth="0" marginheight="0" noresize src="aufbau.php?fu=34&bildpfad=<?php echo $bildpfad; ?>" target="_self">
    <frame name="rahmen2" scrolling="no" marginwidth="0" marginheight="0" noresize src="aufbau.php?fu=20&bildpfad=<?php echo $bildpfad; ?>" target="_self">
    <frame name="rahmen3" scrolling="no" marginwidth="0" marginheight="0" noresize src="aufbau.php?fu=35&bildpfad=<?php echo $bildpfad; ?>" target="_self">
  </frameset>
  <frameset framespacing="0" border="false" frameborder="0" cols="18,*,18">
    <frameset framespacing="0" border="false" frameborder="0" rows="80,*,92">
      <frame name="rahmen15" scrolling="no" marginwidth="0" marginheight="0" noresize src="aufbau.php?fu=25&bildpfad=<?php echo $bildpfad; ?>" target="_self">
      <frame name="rahmen16" scrolling="no" marginwidth="0" marginheight="0" noresize src="aufbau.php?fu=26&bildpfad=<?php echo $bildpfad; ?>" target="_self">
      <frame name="rahmen17" scrolling="no" marginwidth="0" marginheight="0" noresize src="aufbau.php?fu=27&bildpfad=<?php echo $bildpfad; ?>" target="_self">
    </frameset>
    <frame name="rahmen12" scrolling="auto" marginwidth="0" marginheight="0" noresize src="hilfe_antriebe.php?fu=<?php echo $_GET["fu2"]; ?>&uid=<?php echo $uid; ?>&sid=<?php echo $sid; ?>" target="_self">
    <frameset framespacing="0" border="false" frameborder="0" rows="80,*,92">
      <frame name="rahmen18" scrolling="no" marginwidth="0" marginheight="0" noresize src="aufbau.php?fu=28&bildpfad=<?php echo $bildpfad; ?>" target="_self">
      <frame name="rahmen19" scrolling="no" marginwidth="0" marginheight="0" noresize src="aufbau.php?fu=29&bildpfad=<?php echo $bildpfad; ?>" target="_self">
      <frame name="rahmen20" scrolling="no" marginwidth="0" marginheight="0" noresize src="aufbau.php?fu=30&bildpfad=<?php echo $bildpfad; ?>" target="_self">
    </frameset>
  </frameset>
  <frameset framespacing="0" border="false" frameborder="0" cols="114,*,114">
    <frame name="rahmen6" scrolling="no" marginwidth="0" marginheight="0" noresize src="aufbau.php?fu=36&bildpfad=<?php echo $bildpfad; ?>" target="_self">
    <frame name="rahmen7" scrolling="no" marginwidth="0" marginheight="0" noresize src="aufbau.php?fu=23&bildpfad=<?php echo $bildpfad; ?>" target="_self">
    <frame name="rahmen8" scrolling="no" marginwidth="0" marginheight="0" noresize src="aufbau.php?fu=37&bildpfad=<?php echo $bildpfad; ?>" target="_self">
  </frameset>
</frameset>
<noframes>
  <body>
  <?php
  include ("inc.footer.php"); 
}
