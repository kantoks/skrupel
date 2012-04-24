<?php 

require_once ('../inc.conf.php'); 
require_once ('inc.hilfsfunktionen.php');

open_db();
$langfile_1 = 'uebersicht_neuigkeiten';
$fuid = int_get('fu');

//fu:1 Nachrichten anzeigen {{{
if ($fuid==1) {
    include ("inc.header.php");
    ?>
    <body text="#ffffff" bgcolor="#444444" link="#000000" vlink="#000000" alink="#000000" leftmargin="0" rightmargin="0" topmargin="0" marginwidth="0" marginheight="0">
        <div id="bodybody" class="flexcroll" onfocus="this.blur()">
        <?php 
        $zeiger = @mysql_query("SELECT * FROM $skrupel_politik_anfrage where partei_a=$spieler and spiel=$spiel");
        $anzahl = @mysql_num_rows($zeiger);
        if ($anzahl>=1) {
            ?>
            <center>
                <table border="0" cellspacing="0" cellpadding="0" height="100%">
                    <tr>
                        <td>
                            <center>
                                <img src="../lang/<?php echo $spieler_sprache?>/topics/politik.gif" width="105" height="32" title="Politik">
                                <br><br>
                            </center>
                            <table border="0" cellspacing="0" cellpadding="4">
                                <?php 
                                for ($i=0; $i<$anzahl;$i++) {
                                    $ok = @mysql_data_seek($zeiger,$i);
                                    $array = @mysql_fetch_array($zeiger);
                                    $anfrage_id=$array["id"];
                                    $partei_b=$array["partei_b"];
                                    $art=$array["art"];
                                    
                                    if ($art==1) {
                                        $spieler_name=nick($spieler_id_c[$partei_b]);
                                        $text="<b><font color=".$spielerfarbe[$partei_b].">$spieler_name</font></b> ".$lang['uebersichtneuigkeiten']['art1'];
                                        $button_1=$lang['uebersichtneuigkeiten']['friedenbegruessen'];
                                        $button_2=$lang['uebersichtneuigkeiten']['zumteufeljagen'];
                                    }elseif ($art==2) {
                                        $spieler_name=nick($spieler_id_c[$partei_b]);
                                        $text="<b><font color=".$spielerfarbe[$partei_b].">$spieler_name</font></b> ".$lang['uebersichtneuigkeiten']['art2'];
                                        $button_1=$lang['uebersichtneuigkeiten']['demhandelzustimmen'];
                                        $button_2=$lang['uebersichtneuigkeiten']['abkommenablehnen'];
                                    }elseif ($art==3) {
                                        $spieler_name=nick($spieler_id_c[$partei_b]);
                                        $text="<b><font color=".$spielerfarbe[$partei_b].">$spieler_name</font></b> ".$lang['uebersichtneuigkeiten']['art3'];
                                        $button_1=$lang['uebersichtneuigkeiten']['denfriedenumarmen'];
                                        $button_2=$lang['uebersichtneuigkeiten']['paktablehnen'];
                                    }elseif ($art==4) {
                                        $spieler_name=nick($spieler_id_c[$partei_b]);
                                        $text="<b><font color=".$spielerfarbe[$partei_b].">$spieler_name</font></b> ".$lang['uebersichtneuigkeiten']['art4'];
                                        $button_1=$lang['uebersichtneuigkeiten']['demvorschlagzustimmen'];
                                        $button_2=$lang['uebersichtneuigkeiten']['buendnisablehnen'];
                                    }elseif ($art==5) {
                                        $spieler_name=nick($spieler_id_c[$partei_b]);
                                        $text="<b><font color=".$spielerfarbe[$partei_b].">$spieler_name</font></b> ".$lang['uebersichtneuigkeiten']['art5'];
                                        $button_1=$lang['uebersichtneuigkeiten']['gemeinsamenzielenzustimmen'];
                                        $button_2=$lang['uebersichtneuigkeiten']['allianzablehnen'];
                                    }

                                    ?>
                                    <tr>
                                        <td><center><?php echo $text; ?></center></td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <center>
                                                <table border="0" cellspacing="0" cellpadding="0">
                                                    <tr>
                                                        <td><form name="formular" method="post" action="kommunikation_politik.php?fu=5&anf=<?php echo $anfrage_id?>&uid=<?php echo $uid?>&sid=<?php echo $sid?>"></td>
                                                        <td><input type="hidden" name="spieler2" value="<?php echo $partei_b; ?>" ></td>
                                                        <td><input type="submit" name="bla" value="<?php echo $button_1; ?>" style="width:200px;"></td>
                                                        <td></form></td>
                                                        <td><nobr>&nbsp;&nbsp;</nobr></td>
                                                        <td><form name="formular" method="post" action="kommunikation_politik.php?fu=6&anf=<?php echo $anfrage_id?>&uid=<?php echo $uid?>&sid=<?php echo $sid?>"></td>
                                                        <td><input type="hidden" name="spieler2" value="<?php echo $partei_b; ?>" ></td>
                                                        <td><input type="submit" name="bla2" value="<?php echo $button_2; ?>" style="width:200px;"></td>
                                                        <td></form></td>
                                                    </tr>
                                                </table>
                                            </center>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>&nbsp;</td>
                                    </tr>
                                    <?php 
                                }
                                ?>
                            </table>
                        </td>
                    </tr>
                </table>
            </center>
            <?php 
        } else {
            ?>
            <script language=JavaScript>
                function gefecht(art,sh1,sh2,datum) {
                    oben=100;
                    links=screen.width-400;
                    window.open('gefecht.php?fu='+art+'&sh1='+sh1+'&sh2='+sh2+'&datum='+datum+'&uid=<?php echo $uid?>&sid=<?php echo $sid?>','Gefecht','resizable=no,scrollbars=no,width=300,height=206,top='+oben+',left='+links);
                }
            </script>
            <?php 
            $tag=date('d',time());
            $monat=date('m',time());
            $jahr=date('y',time());
            
            $alter=25+$jahr;
            if (($tag==28) and ($monat==10)) {
                
                $text=str_replace(array('{1}'),array($alter),$lang['uebersichtneuigkeiten']['geburtstag']);
                ?>
                <table border="0" cellspacing="0" width="100%" cellpadding="0">
                    <tr>
                        <td><img src="http://www.skrupel.de/bilder/birthday.jpg" border="0" width="150" height="150"></td>
                        <td><img src="../bilder/empty.gif" border="0" width="20" height="1"></td>
                        <td width="100%">
                            <center>
                                <table border="0" cellspacing="0" cellpadding="0">
                                    <tr>
                                        <td style="font-size:20px; font-weight:bold; filter:DropShadow(color=black, offx=2, offy=2)"><center><?php echo $lang['uebersichtneuigkeiten']['happy']?></center></td>
                                    </tr>
                                    <tr>
                                        <td><?php echo $text?></td>
                                    </tr>
                                </table>
                            </center>
                        </td>
                        <td><img src="../bilder/empty.gif" border="0" width="20" height="1"></td>
                        <td align="right"><img src="http://www.skrupel.de/bilder/birthday.jpg" border="0" width="150" height="150"></td>
                    </tr>
                </table>
                <br><br>
                <?php
            }
            
            $zeiger = @mysql_query("SELECT * FROM $skrupel_neuigkeiten where spieler_id=$spieler and spiel_id=$spiel order by datum desc,art desc,id desc");
            $newsanzahl = @mysql_num_rows($zeiger);
            if ($newsanzahl>=1) {
                ?>
                <center>
                    <table border="0" cellspacing="0" width="100%" cellpadding="0">
                        <?php
                        for ($i=0; $i<$newsanzahl;$i++) {
                            $ok = @mysql_data_seek($zeiger,$i);
                    
                            $array = @mysql_fetch_array($zeiger);
                            $nid=$array["id"];
                            $datum=$array["datum"];
                            $icon=$array["icon"];
                            $inhalt=$array["inhalt"];
                            $sicher=$array["sicher"];
                            $art=$array["art"];
                        
                            $datum=date('d.m.y G:i',$datum);
                        
                            if ($art==5) {
                                $temp=explode(":",$inhalt);
                                $gegner=$temp[0];
                                $inhalt=$temp[1];
                            
                                $inhalt=$inhalt."
                                    <center>
                                        <br><br>
                                        <table border=\"0\" cellspacing=\"0\" cellpadding=\"0\">
                                            <tr>
                                                <td>
                                                <form name=\"formular\" method=\"post\" action=\"uebersicht_neuigkeiten.php?fu=4&nid=$nid&pid=$spieler&spid=$spiel&gegner=$gegner&uid=$uid&sid=$sid\"></td>
                                                <td><input type=\"submit\" name=\"bla\" value=\"".$lang['uebersichtneuigkeiten']['annehmen']."\" style=\"width:120px;\"></td>
                                                <td></form></td>
                                                <td><nobr>&nbsp;&nbsp;</nobr></td>
                                                <td><form name=\"formular\" method=\"post\" action=\"uebersicht_neuigkeiten.php?fu=5&nid=$nid&pid=$spieler&spid=$spiel&gegner=$gegner&uid=$uid&sid=$sid\"></td>
                                                <td><input type=\"submit\" name=\"bla2\" value=\"".$lang['uebersichtneuigkeiten']['ablehnen']."\" style=\"width:120px;\"></td>
                                                <td></form></td>
                                            </tr>
                                        </table>
                                    </center>";
                            }elseif ($art==6) {
                                $temp=explode(":",$inhalt);
                                $gegner=$temp[0];
                                $inhalt=$temp[1];
                            
                                $inhalt=$inhalt."
                                    <center>
                                        <br><br>
                                        <table border=\"0\" cellspacing=\"0\" cellpadding=\"0\">
                                            <tr>
                                                <td><form name=\"formular\" method=\"post\" action=\"uebersicht_neuigkeiten.php?fu=6&nid=$nid&pid=$spieler&spid=$spiel&gegner=$gegner&uid=$uid&sid=$sid\"></td>
                                                <td><input type=\"submit\" name=\"bla\" value=\"".$lang['uebersichtneuigkeiten']['annehmen']."\" style=\"width:120px;\"></td>
                                                <td></form></td>
                                                <td><nobr>&nbsp;&nbsp;</nobr></td>
                                                <td><form name=\"formular\" method=\"post\" action=\"uebersicht_neuigkeiten.php?fu=7&nid=$nid&pid=$spieler&spid=$spiel&gegner=$gegner&uid=$uid&sid=$sid\"></td>
                                                <td><input type=\"submit\" name=\"bla2\" value=\"".$lang['uebersichtneuigkeiten']['ablehnen']."\" style=\"width:120px;\"></td>
                                                <td></form></td>
                                            </tr>
                                        </table>
                                    </center>";
                            }elseif ($art==7) {
                                $temp=explode("::::::",$inhalt);
                                $gegner=$temp[0];
                                $inhalt=$temp[1];
                            
                                $inhalt=$inhalt."
                                    <center>
                                        <br>
                                        <table border=\"0\" cellspacing=\"0\" cellpadding=\"0\">
                                            <tr>
                                                <td><form name=\"formular\" method=\"post\" action=\"kommunikation_subfunk.php?fu=1&an=$gegner&uid=$uid&sid=$sid\"></td>
                                                <td><input type=\"submit\" name=\"bla\" value=\"".$lang['uebersichtneuigkeiten']['antworten']."\" style=\"width:120px;\"></td>
                                                <td></form></td>
                                            </tr>
                                        </table>
                                    </center>";
                            }elseif ($art==8) {
                                $temp=explode("::::::",$inhalt);
                                $forum=$temp[0];
                                $inhalt=$temp[1];
                            
                                $inhalt=$inhalt."
                                    <center>
                                        <br>
                                        <table border=\"0\" cellspacing=\"0\" cellpadding=\"0\">
                                            <tr>
                                                <td><form name=\"formular\" method=\"post\" action=\"kommunikation_board.php?fu=3&fo=1&thema=$forum&uid=$uid&sid=$sid\"></td>
                                                <td><input type=\"submit\" name=\"bla\" value=\"".$lang['uebersichtneuigkeiten']['kommentieren']."\" style=\"width:120px;\"></td>
                                                <td></form></td>
                                            </tr>
                                        </table>
                                    </center>";
                            }
                            ?>
                            <tr>
                                <td rowspan="2" valign="top">
                                    <table border="0" cellspacing="0" cellpadding="0">
                                        <tr>
                                            <td bgcolor="#aaaaaa"><img src="../bilder/empty.gif" border="0" width="1" height="1"></td>
                                            <td bgcolor="#aaaaaa"><img src="../bilder/empty.gif" border="0" width="150" height="1"></td>
                                            <td bgcolor="#aaaaaa"><img src="../bilder/empty.gif" border="0" width="1" height="1"></td>
                                        </tr>
                                        <tr>
                                            <td bgcolor="#aaaaaa"><img src="../bilder/empty.gif" border="0" width="1" height="1"></td>
                                            <td bgcolor="#000000"><center><img src="<?php echo $icon?>"></center></td>
                                            <td bgcolor="#aaaaaa"><img src="../bilder/empty.gif" border="0" width="1" height="1"></td>
                                        </tr>
                                        <tr>
                                            <td bgcolor="#aaaaaa" colspan="3"><img src="../bilder/empty.gif" border="0" width="1" height="1"></td>
                                        </tr>
                                    </table>
                                </td>
                                <td><img src="../bilder/empty.gif" width="5" height="25"></td>
                                <td valign="top" width="100%">
                                    <table border="0" cellspacing="0" width="100%" cellpadding="2">
                                        <tr>
                                            <td width="100%">&nbsp;</td>
                                            <td align="right" style="color:#aaaaaa;"><nobr><?php echo $datum?></nobr></td>
                                            <?php
                                            if (($art==5) or ($art==6)) {
                                                ?>
                                                <td></td>
                                                <td><input type="button" onclick="alert('<?php echo html_entity_decode($lang['uebersichtneuigkeiten']['nichtloeschtbar'])?>');" name="submit" value="<?php echo $lang['uebersichtneuigkeiten']['wirdnichtgeloescht']?>" style="width:120px;"></td>
                                                <td></td>
                                                <?php
                                            } else {
                                                if ($sicher==1) {
                                                    ?>
                                                    <td><form name="formular" method="post" action="uebersicht_neuigkeiten.php?fu=2&nid=<?php echo $nid?>&uid=<?php echo $uid?>&sid=<?php echo $sid?>"></td>
                                                    <td><input type="submit" name="submit" value="<?php echo $lang['uebersichtneuigkeiten']['wirdnichtgeloescht']?>" style="width:120px;"></td>
                                                    <td></form></td>
                                                    <?php
                                                } else {
                                                    ?>
                                                    <td><form name="formular" method="post" action="uebersicht_neuigkeiten.php?fu=3&nid=<?php echo $nid?>&uid=<?php echo $uid?>&sid=<?php echo $sid?>"></td>
                                                    <td><input type="submit" name="submit" value="<?php echo $lang['uebersichtneuigkeiten']['wirdgeloescht']?>" style="width:120px;"></td>
                                                    <td></form></td>
                                                    <?php
                                                }
                                            }
                                            ?>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                            <tr>
                                <td><img src="../bilder/empty.gif" width="5" height="50"></td>
                                <td valign="top"><?php echo $inhalt?></td>
                            </tr>
                            <?php
                        }
                        ?>
                    </table>
                </center>
                <?php
            } else {
                ?>
                <br><br><br><br>
                <center><?php echo $lang['uebersichtneuigkeiten']['keineneuigkeitenvorhanden']?></center>
                <?php
            }
        }
    echo '</div>';
    include ("inc.footer.php");
}
//}}}
//fu:2 Nachricht markieren zum loeschen {{{
if ($fuid==2) {
    

    include ('inc.check.php');

    $nide = int_get('nid');

    @mysql_query("UPDATE $skrupel_neuigkeiten SET sicher=0 WHERE id=$nide AND spieler_id=$spieler;");

    

    $site = "uebersicht_neuigkeiten.php?fu=1&uid=".$uid."&sid=".$sid;
    header("Location: $site");
}
//}}}
//fu:3 Nachricht nicht zum loeschen markieren {{{
if ($fuid==3) {
    

    include ('inc.check.php');

    $nide = int_get('nid');

    $zeiger = @mysql_query("UPDATE $skrupel_neuigkeiten SET sicher=1 WHERE id=$nide AND spieler_id=$spieler;");

    

    $site = "uebersicht_neuigkeiten.php?fu=1&uid=".$uid."&sid=".$sid;
    header("Location: $site");
}
/*/}}}
//fu:4 Friedensangebot annehmen, veraltert {{{
if ($fuid==4) {
    

    include ('inc.check.php');

    $nide = int_get('nid');
    $gegner = int_get('gegner');

    $zeiger_temp = @mysql_query("DELETE FROM $skrupel_politik WHERE status=1 and ((partei_a=$spieler and partei_b=$gegner) or (partei_b=$spieler and partei_a=$gegner)) AND spiel=$spiel");

    $texts = "<b><font color=".$spielerfarbe[$spieler].">$spieler_name</font></b>";
    $text = str_replace(array('{1}'),array($texts),$lang['uebersichtneuigkeiten']['betfrieden']);
    neuigkeit(4,"../bilder/news/politik.jpg",$gegner,$text);

    $zeiger = @mysql_query("DELETE FROM $skrupel_neuigkeiten WHERE id=$nide");

    

    $site = "uebersicht_neuigkeiten.php?fu=1&uid=".$uid."&sid=".$sid;
    header("Location: $site");
}
//}}}
//fu:5 Friedensangebot ablehnen, veraltert {{{
if ($fuid==5) {
    

    $nide = int_get('nid');
    $gegner = int_get('gegner');

    $texts = "<b><font color=".$spielerfarbe[$spieler].">$spieler_name</font></b>";
    $text = str_replace(array('{1}'),array($texts),$lang['uebersichtneuigkeiten']['abfrieden']);
    neuigkeit(4,"../bilder/news/politik.jpg",$gegner,$text);

    $zeiger = @mysql_query("DELETE FROM $skrupel_neuigkeiten WHERE id=$nide");

    

    $site = "uebersicht_neuigkeiten.php?fu=1&uid=".$uid."&sid=".$sid;
    header("Location: $site");
}
//}}}
//fu:6 Friedensangebot ablehnen, veraltert {{{
if ($fuid==6) {


       
    $nide=$_GET["nid"];
    $gegner=$_GET["gegner"];
    $spieler=$_GET["pid"];
    $spiel=$_GET["spid"];
       
    $uid=$_GET["uid"];
    $sid=$_GET["sid"];

    $zeiger2 = @mysql_query("SELECT * FROM $skrupel_spiele where id='$spiel'");
    $array2 = @mysql_fetch_array($zeiger2);
    $spieler_1=$array2["spieler_1"];
    $spieler_2=$array2["spieler_2"];
    $spieler_3=$array2["spieler_3"];
    $spieler_4=$array2["spieler_4"];
    $spieler_5=$array2["spieler_5"];
    $spieler_6=$array2["spieler_6"];
    $spieler_7=$array2["spieler_7"];
    $spieler_8=$array2["spieler_8"];
    $spieler_9=$array2["spieler_9"];
    $spieler_10=$array2["spieler_10"];

    if ($spieler==1) {$spieler_id=$spieler_1;}
    if ($spieler==2) {$spieler_id=$spieler_2;}
    if ($spieler==3) {$spieler_id=$spieler_3;}
    if ($spieler==4) {$spieler_id=$spieler_4;}
    if ($spieler==5) {$spieler_id=$spieler_5;}
    if ($spieler==6) {$spieler_id=$spieler_6;}
    if ($spieler==7) {$spieler_id=$spieler_7;}
    if ($spieler==8) {$spieler_id=$spieler_8;}
    if ($spieler==9) {$spieler_id=$spieler_9;}
    if ($spieler==10) {$spieler_id=$spieler_10;}
    $spieler_name=nick($spieler_id);

    $zeiger_temp = @mysql_query("DELETE FROM $skrupel_politik where partei_a=$spieler and partei_b=$gegner and spiel=$spiel");
    $zeiger_temp = @mysql_query("INSERT INTO $skrupel_politik (partei_a,partei_b,status,spiel) values ($spieler,$gegner,2,$spiel)");

    $texts="<b><font color=".$spielerfarbe[$spieler].">$spieler_name</font></b>";
    $text=str_replace(array('{1}'),array($texts),$lang['uebersichtneuigkeiten']['getallianz']);
    neuigkeit(4,"../bilder/news/politik.jpg",$gegner,"$text");

    $zeiger = @mysql_query("DELETE FROM $skrupel_neuigkeiten where id=$nide");

    $site="uebersicht_neuigkeiten.php?fu=1&uid=".$uid."&sid=".$sid;
    header("Location: $site");

    
}
//}}}
//fu:7 Allianzangebot ablehnen, veraltert {{{
if ($_GET["fu"]==7) {


       
    $nide=$_GET["nid"];
    $gegner=$_GET["gegner"];
    $spieler=$_GET["pid"];
    $spiel=$_GET["spid"];
       
    $uid=$_GET["uid"];
    $sid=$_GET["sid"];

    $zeiger2 = @mysql_query("SELECT * FROM $skrupel_spiele where id='$spiel'");
    $array2 = @mysql_fetch_array($zeiger2);
    $spieler_1=$array2["spieler_1"];
    $spieler_2=$array2["spieler_2"];
    $spieler_3=$array2["spieler_3"];
    $spieler_4=$array2["spieler_4"];
    $spieler_5=$array2["spieler_5"];
    $spieler_6=$array2["spieler_6"];
    $spieler_7=$array2["spieler_7"];
    $spieler_8=$array2["spieler_8"];
    $spieler_9=$array2["spieler_9"];
    $spieler_10=$array2["spieler_10"];

    if ($spieler==1) {$spieler_id=$spieler_1;}
    if ($spieler==2) {$spieler_id=$spieler_2;}
    if ($spieler==3) {$spieler_id=$spieler_3;}
    if ($spieler==4) {$spieler_id=$spieler_4;}
    if ($spieler==5) {$spieler_id=$spieler_5;}
    if ($spieler==6) {$spieler_id=$spieler_6;}
    if ($spieler==7) {$spieler_id=$spieler_7;}
    if ($spieler==8) {$spieler_id=$spieler_8;}
    if ($spieler==9) {$spieler_id=$spieler_9;}
    if ($spieler==10) {$spieler_id=$spieler_10;}
    $spieler_name=nick($spieler_id);

    $texts="<b><font color=".$spielerfarbe[$spieler].">$spieler_name</font></b>";
    $text=str_replace(array('{1}'),array($texts),$lang['uebersichtneuigkeiten']['noallianz']);
    neuigkeit(4,"../bilder/news/politik.jpg",$gegner,"$text");

    $zeiger = @mysql_query("DELETE FROM $skrupel_neuigkeiten where id=$nide");

    $site="uebersicht_neuigkeiten.php?fu=1&uid=".$uid."&sid=".$sid;
    header("Location: $site");

    
}
//}}} */
