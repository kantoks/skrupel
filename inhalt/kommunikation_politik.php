<?php
require_once ('../inc.conf.php'); 
 require_once ('inc.hilfsfunktionen.php');
$langfile_1 = 'kommunikation_politik';
$fuid = int_get('fu');

if ($fuid==1) {
    include ("inc.header.php");
    ?>
    <frameset framespacing="0" border="false" frameborder="0" cols="50%,50%">
        <frame name="politik1" scrolling="no" marginwidth="0" marginheight="0" noresize src="kommunikation_politik.php?fu=2&uid=<?php echo $uid; ?>&sid=<?php echo $sid; ?>" target="_self">
        <frame name="politik2" scrolling="no" marginwidth="0" marginheight="0" noresize src="kommunikation_politik.php?fu=3&uid=<?php echo $uid; ?>&sid=<?php echo $sid; ?>" target="_self">
    </frameset>
    <body>
        <?php
    include ("inc.footer.php");
}
if ($fuid==2) {
    include ("inc.header.php");
    ?>
    <body text="#000000" bgcolor="#444444" link="#000000" vlink="#000000" alink="#000000" leftmargin="0" rightmargin="0" topmargin="0" marginwidth="0" marginheight="0">
        <?php
        $zeiger = @mysql_query("SELECT spiel,partei_a,partei_b,status,optionen FROM $skrupel_politik where spiel=$spiel");
        $polanzahl = @mysql_num_rows($zeiger);
        if ($polanzahl>=1) {
            for ($i=0; $i<$polanzahl;$i++) {
                $ok = @mysql_data_seek($zeiger,$i);
                $array = @mysql_fetch_array($zeiger);
                $status=$array["status"];
                $partei_a=$array["partei_a"];
                $partei_b=$array["partei_b"];
                $optionen=$array["optionen"];
                $beziehung[$partei_a][$partei_b]['status']=$status;
                $beziehung[$partei_b][$partei_a]['status']=$status;
                $beziehung[$partei_a][$partei_b]['optionen']=$optionen;
                $beziehung[$partei_b][$partei_a]['optionen']=$optionen;
            }
        }
        $icon_bilder=array("","krieg","handel","nichtangriff","bund","allianz");
        function icon($partei_a,$partei_b) {
            global $beziehung,$bildpfad,$lang;

            if (!isset($beziehung[$partei_a][$partei_b]['status'])) {
                $beziehung[$partei_a][$partei_b]['status'] = 0;
                $beziehung[$partei_a][$partei_b]['optionen'] = 0;
            }
            $statuss=$beziehung[$partei_a][$partei_b]['status'];
            $optionenn=$beziehung[$partei_a][$partei_b]['optionen'];
            $icon_bilder=array("","krieg","handel","nichtangriff","bund","allianz");
            $icon='<img src="../bilder/empty.gif" width="25" height="25">';
            if ($statuss==1) { $icon='<img src="'.$bildpfad.'/icons/'.$icon_bilder[$statuss].'.gif" width="25" height="25" title="'.$lang['kommunikationpolitik']['icon'][$statuss][0].'">';
            }elseif ($statuss>1) {
                if($optionenn==0) {
                    $icon='<img src="'.$bildpfad.'/icons/'.$icon_bilder[$statuss].'.gif" width="25" height="25" title="'.$lang['kommunikationpolitik']['icon'][$statuss][0].'">';
                }elseif($optionenn==1) {
                    $icon="<img src=\"".$bildpfad."/icons/".$icon_bilder[$statuss]."_br.gif\" width=\"25\" height=\"25\" title=\"".$lang['kommunikationpolitik']['icon'][$statuss][1]."\">";
                }elseif($optionenn>1){
                    $icon='<img src="'.$bildpfad.'/icons/'.$icon_bilder[$statuss].'_br.gif" width="25" height="25" title="'.str_replace('{1}',$optionenn,$lang['kommunikationpolitik']['icon'][$statuss][2]).'">';
                }
            }
            return $icon;
        }
        $zeiger2 = @mysql_query("SELECT * FROM $skrupel_spiele where id=$spiel");
        $array2 = @mysql_fetch_array($zeiger2);
        $spiel=$array2["id"];
        for($i=1;$i<11;$i++){
            $spieler_t="spieler_".$i;
            $array_spieler[$i]=$array2["$spieler_t"];
            if ($array_spieler[$i]>=1) {
                $zeiger_temp= @mysql_query("SELECT * FROM $skrupel_user where id=".$array_spieler[$i]."");
                $array_temp = @mysql_fetch_array($zeiger_temp);
                $username[$i]="<b>".$array_temp["nick"]."</b>";
            } else {
                $username[$i]=$lang['kommunikationpolitik']['slot_n'];
            }
        }
        ?>
        <center>
            <table border="0" cellspacing="0" cellpadding="0" height="100%">
                <tr>
                    <td>
                        <table border="0" cellspacing="0" cellpadding="0">
                            <tr>
                                <td></td>
                                <td><img src="../bilder/empty.gif" width="25" height="25"></td>
                                <?php
                                for($i=10;$i>1;$i--){
                                    ?>
                                    <td style="color:<?php echo $spielerfarbe[$i]; ?>;">
                                        <center><b><?php echo $i?></b></center>
                                    </td>
                                    <td bgcolor="<?php echo $spielerfarbe[$i]; ?>">
                                        <img src="../bilder/empty.gif" width="1" height="25">
                                    </td>
                                    <?php
                                }
                                ?>
                                <td><img src="../bilder/empty.gif" width="3"></td>
                            </tr>
                            <?php
                            for($i=1;$i<11;$i++){
                                ?>
                                <tr>
                                    <td>
                                        <table border="0" cellspacing="0" cellpadding="0" width="100%">
                                            <tr>
                                                <td><img src="../bilder/empty.gif" width="1" height="24"></td>
                                                <td style="color:<?php echo $spielerfarbe[$i]; ?>;" width="100%"><?php echo $username[$i]; ?></td>
                                            </tr>
                                            <tr>
                                                <td bgcolor="<?php echo $spielerfarbe[$i]; ?>"><img src="../bilder/empty.gif" width="1" height="1"></td>
                                                <td bgcolor="<?php echo $spielerfarbe[$i]; ?>"><img src="../bilder/empty.gif" width="1" height="1"></td>
                                            </tr>
                                        </table>
                                    </td>
                                    <td>
                                        <table border="0" cellspacing="0" cellpadding="0">
                                            <tr>
                                                <td><img src="../bilder/empty.gif" width="1" height="24"></td>
                                                <td style="color:<?php echo $spielerfarbe[$i]; ?>;">
                                                    <center><b><?php echo $i?></b></center>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td bgcolor="<?php echo $spielerfarbe[$i]; ?>"><img src="../bilder/empty.gif" width="1" height="1"></td>
                                                <td bgcolor="<?php echo $spielerfarbe[$i]; ?>"><img src="../bilder/empty.gif" width="25" height="1"></td>
                                            </tr>
                                        </table>
                                    </td>
                                    <?php
                                    for($j=10;$j>$i;$j--){
                                        ?>
                                        <td bgcolor="<?php /*if($array_spieler[$i]){*/echo $spielerfarbe[$i];/*}elseif($array_spieler[$j] and !$array_spieler[$i]){echo $spielerfarbe[$j];}*/ ?>"><?php echo icon($i,$j); ?></td>
                                        <td bgcolor="<?php /*if($array_spieler[$j] and $array_spieler[$i]){*/echo $spielerfarbe[$j];/*}elseif(!$array_spieler[$j] and $array_spieler[$i]){echo $spielerfarbe[$i];}*/ ?>"><img src="../bilder/empty.gif" width="1" height="25"></td>
                                        <?php
                                    }
                                    ?>
                                    <td>
                                        <table border="0" cellspacing="0" cellpadding="0">
                                            <tr>
                                                <td><img src="../bilder/empty.gif" width="25" height="24"></td>
                                            </tr>
                                            <tr>
                                                <td bgcolor="<?php echo $spielerfarbe[$i]; ?>"><img src="../bilder/empty.gif" width="24" height="1"></td>
                                            </tr>
                                        </table>
                                    </td>
                                    <td bgcolor="<?php echo $spielerfarbe[$i]; ?>"><img src="../bilder/empty.gif" width="1" height="25"></td>
                                    <?php
                                    if($i>5){
                                        for($j=0;$j<2*($i-2);$j++){
                                            ?>
                                            <td></td>
                                            <?php
                                        }
                                        ?>
                                        <td><img src="<?php echo $bildpfad?>/icons/<?php echo $icon_bilder[$i-5]?>.gif" width="25" height="25" title="<?php echo $lang['kommunikationpolitik']['icon'][$i-5][0]?>"></td>
                                        <td></td>
                                        <td><?php echo $lang['kommunikationpolitik']['icon'][$i-5][0]; ?></td>
                                        <?php
                                    }
                                    ?>
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
    include ("inc.footer.php");
}
if ($fuid==3) {
    include ("inc.header.php");
    ?>
    <body text="#000000" bgcolor="#444444" link="#000000" vlink="#000000" alink="#000000" leftmargin="0" rightmargin="0" topmargin="0" marginwidth="0" marginheight="0">
        <form name="formular" method="post" action="kommunikation_politik.php?fu=4&uid=<?php echo $uid; ?>&sid=<?php echo $sid; ?>">
        <center>
            <table border="0" cellspacing="0" cellpadding="0" height="100%">
                <tr>
                    <td>
                        <center>
                            <img src="../lang/<?php echo $spieler_sprache; ?>/topics/politik.gif" width="105" height="32" title="<?php echo $lang['kommunikationpolitik']['politik']?>">
                            <br><br>
                            <?php
                            $verhandlung = false;
                            $begegnung = array();
                            if ($module[4]==1) {
                                $zeiger = @mysql_query("SELECT partei_b FROM $skrupel_begegnung where spiel=$spiel and partei_a=$spieler");
                                $polanzahl = @mysql_num_rows($zeiger);
                                if ($polanzahl>=1) {
                                    for ($i=0; $i<$polanzahl;$i++) {
                                        $ok = @mysql_data_seek($zeiger,$i);
                                        $array = @mysql_fetch_array($zeiger);
                                        $partei_b=$array["partei_b"];
                                        $begegnung[$partei_b]=1;
                                        $verhandlung = true;
                                    }
                                }
                            }
                            if (($verhandlung == true) or ($module[4]==0)) {
                                ?>
                                <table border="0" cellspacing="0" cellpadding="0">
                                    <?php
                                    $art=array("1","6","2","3","4","5","7");
                                    $icon_bilder=array("krieg","nokrieg","handel","nichtangriff","bund","allianz","no");
                                    for($i=0;$i<7;$i++){
                                        ?>
                                        <tr>
                                            <td><input type="radio" name="art" value="<?php echo $art[$i];?>"></td>
                                            <td><table border="0" cellspacing="0" cellpadding="0"><tr>
                                            <td><img src="<?php echo $bildpfad; ?>/icons/<?php echo $icon_bilder[$i]?>.gif" width="25" height="25" title="<?php echo $lang['kommunikationpolitik']['handlung'][$i]?>"></td>
                                            <td><?php echo $lang['kommunikationpolitik']['handlung'][$i]?></td>
                                                <td><img src="../bilder/empty.gif" width="3" height="25"></td>
                                            <td><a href="javascript:hilfe(<?php echo 41+$i;?>);"><img src="<?php echo $bildpfad; ?>/icons/hilfe.gif" border="0" width="17" height="17"></a></td>
                                            </tr></table></td>
                                        </tr>
                                        <?php
                                    }
                                    $zahl=0;
                                    $array_spieler=array('',$spieler_1,$spieler_2,$spieler_3,$spieler_4,$spieler_5,$spieler_6,$spieler_7,$spieler_8,$spieler_9,$spieler_10);
                                    for($i=1;$i<11;$i++){
                                        if (($module[4]==0) or (isset($begegnung[$i]))) {
                                            if (($array_spieler[$i]>=1) and ($i<>$spieler)) {
                                                $zeiger = @mysql_query("SELECT * FROM $skrupel_user where id=$array_spieler[$i]");
                                                $array = @mysql_fetch_array($zeiger);
                                                $nick=$array["nick"];
                                                $feind[$zahl][0]=$nick;
                                                $feind[$zahl][1]=$spielerfarbe[$i];
                                                $feind[$zahl][2]=$i;
                                                $zahl++;
                                            }
                                        }
                                    }
                                    ?>
                                    <tr>
                                        <td colspan="2">&nbsp;</td>
                                    </tr>
                                    <tr>
                                        <td colspan="2">
                                            <select name="spielernummer" style="width:230px;">
                                                <option value="0">--- <?php echo $lang['kommunikationpolitik']['empfwaehlen']; ?> ---</option>
                                                <?php
                                                for ($n=0;$n<$zahl;$n++) {
                                                    ?>
                                                    <option value="<?php echo $feind[$n][2]; ?>" style="background-color:<?php echo $feind[$n][1]; ?>;"><?php echo $feind[$n][0]; ?></option>
                                                    <?php
                                                }
                                                ?>
                                            </select>
                                        </td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td colspan="2">&nbsp;<br><br></td>
                                    </tr>
                                    <tr>
                                        <td colspan="2"><center><input type="submit" name="bla" value="<?php echo $lang['kommunikationpolitik']['erklaerunguebermitteln']; ?>" style="width:230px;"></center></td>
                                    </tr>
                                </table>
                                <?php
                            } else {
                                echo $lang['kommunikationpolitik']['allein'];
                            }
                            ?>
                            </form>
                        </center>
                    </td>
                </tr>
            </table>
        </center>
        <?php
    include ("inc.footer.php");
}
if ($fuid==4) {
    $langfile_2 = 'kommunikation_politik_b';
    include ("inc.header.php");
    $art = int_post('art');
    $spielernummer = int_post('spielernummer');
    $zeiger = @mysql_query("SELECT spiel,partei_a,partei_b,status,optionen FROM $skrupel_politik where spiel=$spiel");
    $polanzahl = @mysql_num_rows($zeiger);
    if ($polanzahl>=1) {
        for ($i=0; $i<$polanzahl;$i++) {
            $ok = @mysql_data_seek($zeiger,$i);
            $array = @mysql_fetch_array($zeiger);
            $status=$array["status"];
            $partei_a=$array["partei_a"];
            $partei_b=$array["partei_b"];
            $optionen=$array["optionen"];
            $beziehung[$partei_a][$partei_b]['status']=$status;
            $beziehung[$partei_a][$partei_b]['optionen']=$optionen;
        }
    }
    $volk_a=$spieler;
    $volk_b=$spielernummer;
    $partei_a=$volk_a;
    $partei_b=$volk_b;
    if ($volk_a>$volk_b) { $temp=$volk_b;$volk_b=$volk_a;$volk_a=$temp; }
        //$partei_a=$volk_a;
        //$partei_b=$volk_b;
        if (!isset($beziehung[$volk_a][$volk_b]['status'])) {
            $beziehung[$volk_a][$volk_b]['status']=0;
            $beziehung[$volk_a][$volk_b]['optionen']=0;
        }
    ?>
    <body text="#000000" bgcolor="#444444" link="#000000" vlink="#000000" alink="#000000" leftmargin="0" rightmargin="0" topmargin="0" marginwidth="0" marginheight="0">
        <center>
            <table border="0" cellspacing="0" cellpadding="0" height="100%">
                <tr>
                    <td>
                        <center>
                            <img src="../lang/<?php echo $spieler_sprache; ?>/topics/politik.gif" width="105" height="32" title="<?php echo $lang['kommunikationpolitik']['politik']?>">
                            <br><br>
                            <?php
                            $meldung="";
                            if (!$art) {
                                $meldung=$lang['kommunikationpolitik']['keinebotschaft'];
                            } else {
                                if ($spielernummer==0) {
                                    $meldung=$lang['kommunikationpolitik']['keinvolk'];
                                } else {
                                    if ($art==1) {
                                        if ($beziehung[$volk_a][$volk_b]['status']==1) {
                                            $meldung=$lang['kommunikationpolitik']['bereitskrieg'];
                                        } else {
                                            if ($beziehung[$volk_a][$volk_b]['status']>1) {
                                                $meldung=$lang['kommunikationpolitik']['bereitsabkommen'];
                                            } else {
                                                $text=str_replace(array('{1}','{2}'),array($spielerfarbe[$spieler],$spieler_name),$lang['kommunikationpolitik_b']['hatdenkriegerklaert']);
                                                neuigkeit(4,"../bilder/news/politik.jpg",$spielernummer,"$text");
                                                $meldung=$lang['kommunikationpolitik']['habendenkriegerklaert'];
                                                $zeigertemp = @mysql_query("INSERT INTO $skrupel_politik (partei_a,partei_b,status,optionen,spiel) values ($volk_a,$volk_b,1,0,$spiel)");
                                                ?>
                                                <script language=JavaScript>
                                                    parent.politik1.window.location='kommunikation_politik.php?fu=2&uid=<?php echo $uid; ?>&sid=<?php echo $sid; ?>';
                                                </script>
                                                <?php
                                            }
                                        }
                                    }
                                    if ($art==2) {
                                        if ($beziehung[$volk_a][$volk_b]['status']==2) {
                                            $meldung=$lang['kommunikationpolitik']['bereitshandelsabkommen'];
                                        } else {
                                            if ($beziehung[$volk_a][$volk_b]['status']>2) {
                                                $meldung=$lang['kommunikationpolitik']['bereitsabkommen'];
                                            } else {
                                                if ($beziehung[$volk_a][$volk_b]['status']==1) {
                                                    $meldung=$lang['kommunikationpolitik']['zurzeitkrieg'];
                                                } else {
                                                    $total=0;
                                                    $zeiger = @mysql_query("SELECT count(*) as total FROM $skrupel_politik_anfrage where ((partei_a=$partei_b and partei_b=$partei_a) or (partei_a=$partei_a and partei_b=$partei_b)) and spiel=$spiel");
                                                    $array = @mysql_fetch_array($zeiger);
                                                    $total=$array["total"];
                                                    if ($total!=1) {
                                                        $meldung=$lang['kommunikationpolitik']['anfrageuebermittelt'];
                                                        $zeigertemp = @mysql_query("INSERT INTO $skrupel_politik_anfrage (partei_a,partei_b,art,zeit,spiel) values ($partei_b,$partei_a,2,3,$spiel)");
                                                    } else {
                                                        $meldung=$lang['kommunikationpolitik']['bereitsgespraeche'];
                                                    }
                                                }
                                            }
                                        }
                                    }
                                    if ($art==3) {
                                        if ($beziehung[$volk_a][$volk_b]['status']==3) {
                                            $meldung=$lang['kommunikationpolitik']['bereitsnichtangriff'];
                                        } else {
                                            if ($beziehung[$volk_a][$volk_b]['status']>3) {
                                                $meldung=$lang['kommunikationpolitik']['bereitsabkommen'];
                                            } else {
                                                if ($beziehung[$volk_a][$volk_b]['status']==1) {
                                                    $meldung=$lang['kommunikationpolitik']['zurzeitkrieg'];
                                                } else {
                                                    $total=0;
                                                    $zeiger = @mysql_query("SELECT count(*) as total FROM $skrupel_politik_anfrage where ((partei_a=$partei_b and partei_b=$partei_a) or (partei_a=$partei_a and partei_b=$partei_b)) and spiel=$spiel");
                                                    $array = @mysql_fetch_array($zeiger);
                                                    $total=$array["total"];
                                                    if ($total!=1) {
                                                        $meldung=$lang['kommunikationpolitik']['anfrageuebermittelt'];
                                                        $zeigertemp = @mysql_query("INSERT INTO $skrupel_politik_anfrage (partei_a,partei_b,art,zeit,spiel) values ($partei_b,$partei_a,3,3,$spiel)");
                                                    } else {
                                                        $meldung=$lang['kommunikationpolitik']['bereitsgespraeche'];
                                                    }
                                                }
                                            }
                                        }
                                    }
                                    if ($art==4) {
                                        if ($beziehung[$volk_a][$volk_b]['status']==4) {
                                            $meldung=$lang['kommunikationpolitik']['bereitsvoelker'];
                                        } else {
                                            if ($beziehung[$volk_a][$volk_b]['status']>4) {
                                                $meldung=$lang['kommunikationpolitik']['bereitsabkommen'];
                                            } else {
                                                if ($beziehung[$volk_a][$volk_b]['status']==1) {
                                                    $meldung=$lang['kommunikationpolitik']['zurzeitkrieg'];
                                                } else {
                                                    $total=0;
                                                    $zeiger = @mysql_query("SELECT count(*) as total FROM $skrupel_politik_anfrage where ((partei_a=$partei_b and partei_b=$partei_a) or (partei_a=$partei_a and partei_b=$partei_b)) and spiel=$spiel");
                                                    $array = @mysql_fetch_array($zeiger);
                                                    $total=$array["total"];
                                                    if ($total!=1) {
                                                        $meldung=$lang['kommunikationpolitik']['anfrageuebermittelt'];
                                                        $zeigertemp = @mysql_query("INSERT INTO $skrupel_politik_anfrage (partei_a,partei_b,art,zeit,spiel) values ($partei_b,$partei_a,4,3,$spiel)");
                                                    } else {
                                                        $meldung=$lang['kommunikationpolitik']['bereitsgespraeche'];
                                                    }
                                                }
                                            }
                                        }
                                    }
                                    if ($art==5) {
                                        if ($ziel_id==6) {
                                            $meldung=$lang['kommunikationpolitik']['keineweitereallianz'];
                                        } else {
                                            if ($beziehung[$volk_a][$volk_b]['status']==5) {
                                                $meldung=$lang['kommunikationpolitik']['bereitsallianz'];
                                            } else {
                                                if ($beziehung[$volk_a][$volk_b]['status']==1) {
                                                    $meldung=$lang['kommunikationpolitik']['zurzeitkrieg'];
                                                } else {
                                                    $total=0;
                                                    $zeiger = @mysql_query("SELECT count(*) as total FROM $skrupel_politik_anfrage where ((partei_a=$partei_b and partei_b=$partei_a) or (partei_a=$partei_a and partei_b=$partei_b)) and spiel=$spiel");
                                                    $array = @mysql_fetch_array($zeiger);
                                                    $total=$array["total"];
                                                    if ($total!=1) {
                                                        $meldung=$lang['kommunikationpolitik']['anfrageuebermittelt'];
                                                        $zeigertemp = @mysql_query("INSERT INTO $skrupel_politik_anfrage (partei_a,partei_b,art,zeit,spiel) values ($partei_b,$partei_a,5,3,$spiel)");
                                                    } else {
                                                        $meldung=$lang['kommunikationpolitik']['bereitsgespraeche'];
                                                    }
                                                }
                                            }
                                        }
                                    }
                                    if ($art==6) {
                                        if ($beziehung[$volk_a][$volk_b]['status']!=1) {
                                            $meldung=$lang['kommunikationpolitik']['keinkrieg'];
                                        } else {
                                            $meldung=$lang['kommunikationpolitik']['friedenerbeten'];
                                            $total=0;
                                            $zeiger = @mysql_query("SELECT count(*) as total FROM $skrupel_politik_anfrage where partei_a=$spielernummer and partei_b=$spieler and spiel=$spiel");
                                            $array = @mysql_fetch_array($zeiger);
                                            $total=$array["total"];
                                            if ($total!=1) {
                                                $zeigertemp = @mysql_query("INSERT INTO $skrupel_politik_anfrage (partei_a,partei_b,art,zeit,spiel) values ($spielernummer,$spieler,1,3,$spiel)");
                                            }
                                        }
                                    }
                                    if ($art==7) {
                                        if (($beziehung[$volk_a][$volk_b]['status']==0) or ($beziehung[$volk_a][$volk_b]['status']==1)) {
                                            $meldung=$lang['kommunikationpolitik']['keinabkommen'];
                                        } else {
                                            if ($beziehung[$volk_a][$volk_b]['optionen']>=1) {
                                                $meldung=$lang['kommunikationpolitik']['bereitsgebrochen'];
                                            } else {
                                                $total=0;
                                                $zeiger = @mysql_query("SELECT count(*) as total FROM $skrupel_politik_anfrage where ((partei_a=$partei_b and partei_b=$partei_a) or (partei_a=$partei_a and partei_b=$partei_b)) and spiel=$spiel");
                                                $array = @mysql_fetch_array($zeiger);
                                                $total=$array["total"];
                                                if ($total!=1) {
                                                    if ($beziehung[$volk_a][$volk_b]['status']==2) {
                                                        $zeitraum=3;
                                                        $meldung=$lang['kommunikationpolitik']['handelendet'];
                                                        $text=str_replace(array('{1}','{2}'),array($spielerfarbe[$spieler],$spieler_name),$lang['kommunikationpolitik_b']['handelgebrochen']);
                                                    }elseif ($beziehung[$volk_a][$volk_b]['status']==3) {
                                                        $zeitraum=6;
                                                        $meldung=$lang['kommunikationpolitik']['nichtangriffendet'];
                                                        $text=str_replace(array('{1}','{2}'),array($spielerfarbe[$spieler],$spieler_name),$lang['kommunikationpolitik_b']['nachtangriffgebrochen']);
                                                    }elseif ($beziehung[$volk_a][$volk_b]['status']==4) {
                                                        $zeitraum=9;
                                                        $meldung=$lang['kommunikationpolitik']['voelkerendet'];
                                                        $text=str_replace(array('{1}','{2}'),array($spielerfarbe[$spieler],$spieler_name),$lang['kommunikationpolitik_b']['voelkergebrochen']);
                                                    }elseif ($beziehung[$volk_a][$volk_b]['status']==5) {
                                                        if ($ziel_id==6) {
                                                            $meldung=$lang['kommunikationpolitik']['nichtbrechen'];
                                                        } else {
                                                            $zeitraum=12;
                                                            $meldung=$lang['kommunikationpolitik']['allianzendet'];
                                                            $text=str_replace(array('{1}','{2}'),array($spielerfarbe[$spieler],$spieler_name),$lang['kommunikationpolitik_b']['allianzgebrochen']);
                                                        }
                                                    }
                                                    neuigkeit(4,"../bilder/news/politik.jpg",$spielernummer,"$text");
                                                    ?>
                                                    <script language=JavaScript>
                                                        parent.politik1.window.location='kommunikation_politik.php?fu=2&uid=<?php echo $uid; ?>&sid=<?php echo $sid; ?>';
                                                    </script>
                                                    <?php
                                                    $zeigertemp = @mysql_query("UPDATE $skrupel_politik set optionen=$zeitraum where spiel=$spiel and partei_a=$volk_a and partei_b=$volk_b");
                                                } else {
                                                    $meldung=$lang['kommunikationpolitik']['ingespraechen'];
                                                }
                                            }
                                        }
                                    }
                                }
                            }
                            ?>
                            <br>
                            <?php
                            echo $meldung;
                            ?>
                            <br><br><br>
                            <table border="0" cellspacing="0" cellpadding="0">
                                <tr>
                                    <td><form name="formular" method="post" action="kommunikation_politik.php?fu=3&uid=<?php echo $uid; ?>&sid=<?php echo $sid; ?>"></td>
                                    <td><input type="submit" class="button" value="<?php echo $lang['kommunikationpolitik']['zurueck']; ?>"></td>
                                    <td></form></td>
                                </tr>
                            </table>
                        </center>
                    </td>
                </tr>
            </table>
        </center>
        <?php
    include ("inc.footer.php");
}
if ($fuid==5) {
    $langfile_2 = 'kommunikation_politik_b';
    include ("inc.header.php");
    $art = int_post('art');
    $spielernummer = int_post('spieler2');
    $anfrage_id=int_get('anf');
    $zeiger = @mysql_query("SELECT * FROM $skrupel_politik_anfrage where partei_a=$spieler and spiel=$spiel and id=$anfrage_id");
    $anzahl = @mysql_num_rows($zeiger);
    if ($anzahl==1) {
        $array = @mysql_fetch_array($zeiger);
        $partei_b=$array["partei_b"];
        $art=$array["art"];
        $volk_a=$spieler;
        $volk_b=$partei_b;
        if ($volk_a>$volk_b) { $temp=$volk_b;$volk_b=$volk_a;$volk_a=$temp; }
        if ($art==1) {
            $zeigertemp = @mysql_query("DELETE FROM $skrupel_politik where partei_a=$volk_a and spiel=$spiel and partei_b=$volk_b ");
            $text=str_replace(array('{1}','{2}'),array($spielerfarbe[$spieler],$spieler_name),$lang['kommunikationpolitik_b']['jafrieden']);
            neuigkeit(4,"../bilder/news/politik.jpg",$partei_b,"$text");
        }
        if ($art==2) {
            $zeigertemp = @mysql_query("DELETE FROM $skrupel_politik where partei_a=$volk_a and spiel=$spiel and partei_b=$volk_b ");
            $zeigertemp = @mysql_query("INSERT INTO $skrupel_politik (partei_a,partei_b,status,optionen,spiel) values ($volk_a,$volk_b,2,0,$spiel)");
            $text=str_replace(array('{1}','{2}'),array($spielerfarbe[$spieler],$spieler_name),$lang['kommunikationpolitik_b']['jahandel']);
            neuigkeit(4,"../bilder/news/politik.jpg",$partei_b,"$text");
        }
        if ($art==3) {
            $zeigertemp = @mysql_query("DELETE FROM $skrupel_politik where partei_a=$volk_a and spiel=$spiel and partei_b=$volk_b ");
            $zeigertemp = @mysql_query("INSERT INTO $skrupel_politik (partei_a,partei_b,status,optionen,spiel) values ($volk_a,$volk_b,3,0,$spiel)");
            $text=str_replace(array('{1}','{2}'),array($spielerfarbe[$spieler],$spieler_name),$lang['kommunikationpolitik_b']['janichtangriff']);
            neuigkeit(4,"../bilder/news/politik.jpg",$partei_b,"$text");
        }
        if ($art==4) {
            $zeigertemp = @mysql_query("DELETE FROM $skrupel_politik where partei_a=$volk_a and spiel=$spiel and partei_b=$volk_b ");
            $zeigertemp = @mysql_query("INSERT INTO $skrupel_politik (partei_a,partei_b,status,optionen,spiel) values ($volk_a,$volk_b,4,0,$spiel)");
            $text=str_replace(array('{1}','{2}'),array($spielerfarbe[$spieler],$spieler_name),$lang['kommunikationpolitik_b']['javoelker']);
            neuigkeit(4,"../bilder/news/politik.jpg",$partei_b,"$text");
        }
        if ($art==5) {
            $zeigertemp = @mysql_query("DELETE FROM $skrupel_politik where partei_a=$volk_a and spiel=$spiel and partei_b=$volk_b ");
            $zeigertemp = @mysql_query("INSERT INTO $skrupel_politik (partei_a,partei_b,status,optionen,spiel) values ($volk_a,$volk_b,5,0,$spiel)");
            $text=str_replace(array('{1}','{2}'),array($spielerfarbe[$spieler],$spieler_name),$lang['kommunikationpolitik_b']['jaallianz']);
            neuigkeit(4,"../bilder/news/politik.jpg",$partei_b,"$text");
            $zeigertemp = @mysql_query("SELECT * FROM $skrupel_spiele where id=$spiel");
            $array_temp = @mysql_fetch_array($zeigertemp);
            $rasse_a=$array_temp["spieler_".$volk_a."_rasse"];
            $rasse_b=$array_temp["spieler_".$volk_b."_rasse"];
            //allianzkuatoh
            if(($rasse_a==$rasse_b)and($rasse_b=="kuatoh")){
                $zeiger_temp2 = @mysql_query("SELECT * FROM $skrupel_konplaene where besitzer=$volk_a and spiel=$spiel ");
                $zeiger_temp3 = @mysql_query("SELECT * FROM $skrupel_konplaene where besitzer=$volk_b and spiel=$spiel ");
                $schiffanzahl2 = @mysql_num_rows($zeiger_temp2);
                $schiffanzahl3 = @mysql_num_rows($zeiger_temp3);
                $k=0;
                if($schiffanzahl2>=1){
                    for($i=0;$i<$schiffanzahl2;$i++){
                    $ok = @mysql_data_seek($zeiger_temp2,$i);
                    $array_temp[$i] = @mysql_fetch_array($zeiger_temp2);
                    }
                }
                if($schiffanzahl3>=1){
                for($i=0;$i<$schiffanzahl3;$i++){
                    $ok = @mysql_data_seek($zeiger_temp3,$i);
                    $array_temp_t = @mysql_fetch_array($zeiger_temp3);
                    $drinn=1;
                    for($j=0;$j<$schiffanzahl2;$j++){
                        if(($array_temp_t["rasse"]===$array_temp[$j]["rasse"])and($array_temp_t["klasse_id"]===$array_temp[$j]["klasse_id"])){
                            $drinn=0;
                        }
                    }
                    if($drinn){
                        $h=$schiffanzahl2+$k;
                        $array_temp[$h]=$array_temp_t;
                        $k++;
                    }
                    }
                }
                $schiffanzahl2=$schiffanzahl2+$k;
                if($schiffanzahl2>=1){
                    $zeigertemp = @mysql_query("DELETE FROM $skrupel_konplaene where spiel=$spiel and (besitzer=$volk_a or besitzer=$volk_b)");
                    for($i=0;$i<$schiffanzahl2;$i++){
                        $rasse=$array_temp[$i]["rasse"];
                        $klasse=$array_temp[$i]["klasse"];
                        $klasse_id=$array_temp[$i]["klasse_id"];
                    $techlevel=$array_temp[$i]["techlevel"];
                        $sonstiges=$array_temp[$i]["sonstiges"];
                        $zeiger_temp = @mysql_query("INSERT INTO $skrupel_konplaene (besitzer,spiel,rasse,klasse,klasse_id,techlevel,sonstiges) values ($volk_a,$spiel,'$rasse','$klasse',$klasse_id,$techlevel,'$sonstiges')");
                        $zeiger_temp = @mysql_query("INSERT INTO $skrupel_konplaene (besitzer,spiel,rasse,klasse,klasse_id,techlevel,sonstiges) values ($volk_a,$spiel,'$rasse','$klasse',$klasse_id,$techlevel,'$sonstiges')");
                    }
                }
            } 
        }
        $zeigertemp = @mysql_query("DELETE FROM $skrupel_politik_anfrage where partei_a=$spieler and spiel=$spiel and id=$anfrage_id");
    }
    ?>
    <body text="#000000" bgcolor="#444444" link="#000000" vlink="#000000" alink="#000000" leftmargin="0" rightmargin="0" topmargin="0" marginwidth="0" marginheight="0">
        <script language="JavaScript">
            window.location='uebersicht_neuigkeiten.php?fu=1&uid=<?php echo $uid; ?>&sid=<?php echo $sid; ?>';
        </script>
        <?php
    include ("inc.footer.php");
}
if ($fuid==6) {
    $langfile_2 = 'kommunikation_politik_b';
    include ("inc.header.php");
    $art = int_post('art');
    $spielernummer = int_post('spieler2');
    $anfrage_id=int_get('anf');
    $zeiger = @mysql_query("SELECT * FROM $skrupel_politik_anfrage where partei_a=$spieler and spiel=$spiel and id=$anfrage_id");
    $anzahl = @mysql_num_rows($zeiger);
    if ($anzahl==1) {
        $array = @mysql_fetch_array($zeiger);
        $partei_b=$array["partei_b"];
        $art=$array["art"];
        if ($art==1) {
            $text=str_replace(array('{1}','{2}'),array($spielerfarbe[$spieler],$spieler_name),$lang['kommunikationpolitik_b']['neinfrieden']);
            neuigkeit(4,"../bilder/news/politik.jpg",$partei_b,"$text");
        }
        if ($art==2) {
            $text=str_replace(array('{1}','{2}'),array($spielerfarbe[$spieler],$spieler_name),$lang['kommunikationpolitik_b']['neinhandel']);
            neuigkeit(4,"../bilder/news/politik.jpg",$partei_b,"$text");
        }
        if ($art==3) {
            $text=str_replace(array('{1}','{2}'),array($spielerfarbe[$spieler],$spieler_name),$lang['kommunikationpolitik_b']['neinnichtangriff']);
            neuigkeit(4,"../bilder/news/politik.jpg",$partei_b,"$text");
        }
        if ($art==4) {
            $text=str_replace(array('{1}','{2}'),array($spielerfarbe[$spieler],$spieler_name),$lang['kommunikationpolitik_b']['neinvoelker']);
            neuigkeit(4,"../bilder/news/politik.jpg",$partei_b,"$text");
        }
        if ($art==5) {
            $text=str_replace(array('{1}','{2}'),array($spielerfarbe[$spieler],$spieler_name),$lang['kommunikationpolitik_b']['neinallianz']);
            neuigkeit(4,"../bilder/news/politik.jpg",$partei_b,"$text");
        }
        $zeigertemp = @mysql_query("DELETE FROM $skrupel_politik_anfrage where partei_a=$spieler and spiel=$spiel and id=$anfrage_id");
    }
    ?>
    <body text="#000000" bgcolor="#444444" link="#000000" vlink="#000000" alink="#000000" leftmargin="0" rightmargin="0" topmargin="0" marginwidth="0" marginheight="0">
        <script language="JavaScript">
            window.location='uebersicht_neuigkeiten.php?fu=1&uid=<?php echo $uid; ?>&sid=<?php echo $sid; ?>';
        </script>
        <?php
    include ("inc.footer.php");
}
