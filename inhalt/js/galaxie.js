var info = {
    uid: '',
    sid: '',
    sprache: 'de',
    bildpfad: '',
    umfang: 1000
}
var settings = {
    enabletooltips: false,
    tooltip_planetkolonisten: false,
    tooltip_planetbasisres: false,
    tooltip_planetmineralien: false,
    tooltip_planetanlagen: false,
    tooltip_planetlogbuch: false,
    tooltip_schifffracht: false,
    tooltip_schiffspezialmission: false,
    tooltip_schifflogbuch: false,
    tooltip_schiffbasiswerte: false,
    enableshipimages: false,
	scrollbars: false
}

var IE = document.all?true:false;
var NS = (!document.all && document.getElementById)?true:false;
if (!IE && !NS) {document.captureEvents(Event.MOUSEMOVE);}


function http_get_string(file, definition) {
    var flag = true;
    for(var arg in definition) {
        if(flag) {
            flag = false;
            file += '?'+arg+'='+definition[arg];
        } else {
            file += '&'+arg+'='+definition[arg];
        }
    }
    return file;
}

function getMouseXY(e) {
    if (IE) {
        var tempX = event.clientX + document.body.scrollLeft;
        var tempY = event.clientY + document.body.scrollTop;
    } else {
        var tempX = e.pageX;
        var tempY = e.pageY;
    }
	if (settings.scrollbars) {
		tempX = tempX - parseInt(document.getElementById("complete_contentwrapper").style.left);
		tempY = tempY - parseInt(document.getElementById("complete_contentwrapper").style.top);
	} else {
        tempX = tempX + parseInt(document.getElementById("complete").scrollLeft);
        tempY = tempY + parseInt(document.getElementById("complete").scrollTop);
	}
    if (tempX < 0) tempX = 0;
    if (tempY < 0) tempY = 0;
    return [tempX, tempY];
}

function fensterbreit() {
    if (window.innerWidth) {
        return window.innerWidth;
    } else {
        if (document.body && document.body.offsetWidth) {
            return document.body.offsetWidth;
        } else {
            return 0;
        }
    }
}

function fensterhoch() {
    if (window.innerHeight) {
        return window.innerHeight;
    } else {
        if (document.body && document.body.offsetHeight) {
            return document.body.offsetHeight;
        } else {
            return 0;
        }
    }
}

function movemap(wertx, werty) {
    wertx -= fensterbreit() / 2;
    werty -= fensterhoch() / 2;
	if (settings.scrollbars) {
        var scrollDiv = document.getElementById("complete");
        if(scrollDiv.contentScroll) scrollDiv.contentScroll(wertx,werty,false);
    } else {
		document.getElementById("complete").scrollLeft = wertx;
		document.getElementById("complete").scrollTop = werty;
	}
}
function movemapfirst(wertx, werty) {
    wertx -= fensterbreit() / 2;
    werty -= fensterhoch() / 2;
    document.getElementById("complete").scrollLeft = wertx;
    document.getElementById("complete").scrollTop = werty;
}

function subfunk(sid) {
    var oben = 100;
    var links = Math.ceil((screen.width-580)/2);
    window.open(
        http_get_string('kommunikation_subfunk.php', {
            fu: 3,
            emp: sid,
            uid: info.uid,
            sid: info.sid,
            sprache: info.sprache
        }),
        'subfunk',
        'resizable=no,scrollbars=no,width=580,height=180,top='+oben+',left='+links
    );
}

function funk(sid) {
    if (parent.mittelinksoben.document.getElementById("globals").kursmodus.value!=1) {
        subfunk(sid);
    }
}

function punkte_zeichnen(startX, startY, endX, endY) {
    var schrittX = (endX-startX)/20;
    var schrittY = (endY-startY)/20;

    for(var i=1; i<=20; i++) {
        var dom_punkt = document.getElementById('punkt'+i);
        dom_punkt.style.left = (startX + schrittX*i) + 'px';
        dom_punkt.style.top  = (startY + schrittY*i) + 'px';
        dom_punkt.style.visibility = 'visible';
    }
}
function auswahlrand_zeichnen(posX, posY) {
    var dom_auswahlrand = document.getElementById('auswahlrand');

    dom_auswahlrand.style.left = (posX - 8) + 'px';
    dom_auswahlrand.style.top  = (posY - 8) + 'px';
    dom_auswahlrand.style.visibility = 'visible';
}

function kurs_update(zielX, zielY, zielname, zielid, flug, auswahlrand) {
    var dom_globals = parent.mittelinksoben.document.getElementById("globals");
    var startX = parseInt(dom_globals.schiffx.value);
    var startY = parseInt(dom_globals.schiffy.value);

    punkte_zeichnen(startX, startY, zielX, zielY);
    if (auswahlrand) {
        auswahlrand_zeichnen(zielX, zielY);
	} else {
		document.getElementById('auswahlrand').style.visibility = 'hidden';
	}

    var verbrauchpromonat = dom_globals.verbrauch.value;
    var masse = dom_globals.masse.value;
    var lichtjahre = Math.sqrt((startX-zielX)*(startX-zielX)+(startY-zielY)*(startY-zielY)).toFixed(2);
    var warp = parent.untenmitte.shipsdetails.document.getElementById("formular").warpfaktor.value;

    if (warp>0) {
        var monate = Math.round((lichtjahre / (warp*warp)) + 0.5);
        var verbrauch = Math.round(lichtjahre*verbrauchpromonat*masse/100000);
        if (monate>verbrauch) { verbrauch=monate; }
        if (verbrauchpromonat==0) { verbrauch=0; }
    } else {
        var monate = 0;
        var verbrauch = 0;
    }

    var document_shipdetails = parent.untenmitte.shipsdetails.document;
    document_shipdetails.getElementById('zielxy').innerHTML = zielX + ' / ' + zielY;
    document_shipdetails.getElementById('lichtjahre').innerHTML = lichtjahre + lang.galaxie.lichtjahre;
    document_shipdetails.getElementById('zielname').innerHTML = zielname;
    document_shipdetails.getElementById('verbrauch').innerHTML = verbrauch + lang.galaxie.kt;

    var ant = document_shipdetails.getElementById('zeit');
    if (monate==0) ant.innerHTML = lang.galaxie.unendlich;
    if (monate==1) ant.innerHTML = lang.galaxie.monat;
    if (monate>=2) ant.innerHTML = monate + lang.galaxie.monate;

    var formular_kurseigenschaften = document_shipdetails.getElementById("formular");
    formular_kurseigenschaften.lichtjahref.value = lichtjahre;
    formular_kurseigenschaften.zielxf.value = zielX;
    formular_kurseigenschaften.zielyf.value = zielY;
    formular_kurseigenschaften.zielidf.value = zielid;
    formular_kurseigenschaften.flug.value = flug;
}
function takeship(shid, flottex, flottey, karteX, karteY) {
    if (parent.mittelinksoben.document.globals.kursmodus.value==0) {
        if (flottex>0) {
            parent.untenmitte.window.location = http_get_string('flotte.php', {
                fu: 6,
                shid: shid,
                flottex: flottex,
                flottey: flottey,
                uid: info.uid,
                sid: info.sid,
                sprache: info.sprache
            });
        } else {
            parent.untenmitte.window.location = http_get_string('flotte.php', {
                fu: 2,
                shid: shid,
                uid: info.uid,
                sid: info.sid,
                sprache: info.sprache
            });
        }
    } else {
        var sid = parent.mittelinksoben.document.getElementById("globals").schiffid.value;
        if(!(sid==shid)) {
            kurs_update(karteX, karteY, lang.galaxie.begleitschutz, shid, 4, true);
        }
    }
}
function takebase(bid) {
    if (parent.mittelinksoben.document.getElementById("globals").kursmodus.value != 1) {
        parent.untenmitte.window.location = http_get_string('basen.php', {
            fu: 2,
            baid: bid,
            uid: info.uid,
            sid: info.sid,
            sprache: info.sprache
        });
    }
}
function linie(e) {
    if('preventDefault' in e) e.preventDefault();
    var posinfo = getMouseXY(e);
    var tempX = posinfo[0];
    var tempY = posinfo[1];

    if (parent.mittelinksoben.document.globals.kursmodus.value==1) {
        kurs_update(tempX, tempY, lang.galaxie.freierraum, 0, 1, false);
    } else {
        var xdat = tempX;
        var ydat = tempY;
        var hoch = document.getElementById("tooltip_uebersicht").offsetHeight;
        var breit = document.getElementById("tooltip_uebersicht").offsetWidth;

        if (ydat+hoch > info.umfang-10) { ydat = ydat-hoch; }
        if (xdat+breit > info.umfang-10) { xdat = xdat-breit; }

        var dom_tooltip = document.getElementById("tooltip_uebersicht");
        dom_tooltip.style.left=xdat;
        dom_tooltip.style.top=ydat;
        dom_tooltip.style.visibility='visible';

        document.onmousemove = function(e) {
            document.getElementById("tooltip_uebersicht").style.visibility = 'hidden';
            document.onmousemove = null;
        }
    }
}
function linieplanet(karteX,karteY,pname,pid,eigentum,besitzer) {
    if (parent.mittelinksoben.document.getElementById("globals").kursmodus.value==1) {
        self.focus();
        kurs_update(karteX, karteY, pname, pid, 2, true);
    } else {
        if (eigentum==1) {
            parent.untenmitte.window.location = http_get_string('planeten.php', {
                fu: 2,
                pid: pid,
                uid: info.uid,
                sid: info.sid,
                sprache: info.sprache
            });
        } else {
            if (besitzer>0) {
                subfunk(besitzer);
            }
        }
    }
}
function enemyship(karteX,karteY,sid,besitzer) {
    if (parent.mittelinksoben.document.getElementById("globals").kursmodus.value==1) {
        self.focus();
        kurs_update(karteX, karteY, lang.galaxie.feindkontakt, sid, 3, true);
    } else {
        subfunk(besitzer);
    }
}
function tooltipenemyship(xdat,ydat,beziehung) {
    if(settings.enabletooltips && beziehung>0) {
        var ant=document.getElementById('tip_abkommen');
        switch(beziehung) {
            case 1: ant.innerHTML='<img src="'+info.bildpfad+'/icons/krieg.gif" border="0" width="25" height="25">'; break;
            case 2: ant.innerHTML='<img src="'+info.bildpfad+'/icons/handel.gif" border="0" width="25" height="25">'; break;
            case 3: ant.innerHTML='<img src="'+info.bildpfad+'/icons/nichtangriff.gif" border="0" width="25" height="25">'; break;
            case 4: ant.innerHTML='<img src="'+info.bildpfad+'/icons/bund.gif" border="0" width="25" height="25">'; break;
            case 5: ant.innerHTML='<img src="'+info.bildpfad+'/icons/allianz.gif" border="0" width="25" height="25">'; break;
        }

        var xxdat = xdat-34;
        var yydat = ydat-34;

        var dom_tip = document.getElementById('tooltip_abkommen');
        dom_tip.style.left = xxdat;
        dom_tip.style.top = yydat;
        dom_tip.style.visibility = 'visible';
    }
}
function tooltipenemyshipout() {
    if(settings.enabletooltips) {
        document.getElementById('tooltip_abkommen').style.visibility='hidden';
    }
}
function tooltipbesetzt(xdat,ydat,name,kolonisten,cantox,lemin,min1,min2,min3,minen,fabrik,vorrat,logbuch) {
    if(settings.enabletooltips) {
        document.getElementById('tip_name').innerHTML = name;

        if(settings.tooltip_planetkolonisten) {
            document.getElementById('tip_kolonisten').innerHTML = kolonisten;
        }
        if(settings.tooltip_planetbasisres) {
            document.getElementById('tip_cantox').innerHTML = cantox;
            document.getElementById('tip_vorrat').innerHTML = vorrat;
        }
        if(settings.tooltip_planetmineralien) {
            document.getElementById('tip_lemin').innerHTML = lemin;
            document.getElementById('tip_min1').innerHTML = min1;
            document.getElementById('tip_min2').innerHTML = min2;
            document.getElementById('tip_min3').innerHTML = min3;
        }
        if(settings.tooltip_planetanlagen) {
            document.getElementById('tip_minen').innerHTML = minen;
            document.getElementById('tip_fabrik').innerHTML = fabrik;
        }
        if(settings.tooltip_planetlogbuch) {
            document.getElementById('tip_logbuch').innerHTML = logbuch;
        }

        var hoch = document.getElementById("tooltip_planetbesetzt").offsetHeight;
        var breit = document.getElementById("tooltip_planetbesetzt").offsetWidth;

        if (ydat+hoch > info.umfang-10) { ydat = ydat-hoch-18; }
        if (xdat+breit > info.umfang-10) { xdat = xdat-breit-18; }

        var dom_tip = document.getElementById("tooltip_planetbesetzt");
        dom_tip.style.left = xdat;
        dom_tip.style.top = ydat;
        dom_tip.style.visibility = 'visible';
    }
}
function tooltipbesetztout() {
    if(settings.enabletooltips) {
        document.getElementById("tooltip_planetbesetzt").style.visibility='hidden';
    }
}
function tooltipunbesetzt(xdat,ydat,name,beziehung) {
    if(settings.enabletooltips) {
        document.getElementById('tip_un_name').innerHTML = name;

        var dom_tooltip = document.getElementById("tooltip_planetunbesetzt")

        var hoch = dom_tooltip.offsetHeight;
        var breit = dom_tooltip.offsetWidth;

        dom_tooltip.style.left = xdat;
        dom_tooltip.style.top = ydat;
        dom_tooltip.style.visibility = 'visible';

        if(beziehung>0) {
            var ant = document.getElementById('tip_abkommen');
            switch(beziehung) {
                case 0: ant.innerHTML=''; break;
                case 1: ant.innerHTML='<img src="'+info.bildpfad+'/icons/krieg.gif" border="0" width="25" height="25">'; break;
                case 2: ant.innerHTML='<img src="'+info.bildpfad+'/icons/handel.gif" border="0" width="25" height="25">'; break;
                case 3: ant.innerHTML='<img src="'+info.bildpfad+'/icons/nichtangriff.gif" border="0" width="25" height="25">'; break;
                case 4: ant.innerHTML='<img src="'+info.bildpfad+'/icons/bund.gif" border="0" width="25" height="25">'; break;
                case 5: ant.innerHTML='<img src="'+info.bildpfad+'/icons/allianz.gif" border="0" width="25" height="25">'; break;
            }

            if (ydat+hoch > info.umfang-10) { yydat = ydat; ydat = ydat-hoch-18; }
            if (xdat+breit > info.umfang -10) { xxdat = xdat; xdat = xdat-breit-18; }

            var xxdat = xdat-26-18;
            var yydat = ydat-26-18;

            var dom_tooltip = document.getElementById("tooltip_abkommen");
            dom_tooltip.style.left = xxdat;
            dom_tooltip.style.top = yydat;
            dom_tooltip.style.visibility = 'visible';
        }
    }
}
function tooltipunbesetztout() {
    if(settings.enabletooltips) {
        document.getElementById("tooltip_planetunbesetzt").style.visibility = 'hidden';
        document.getElementById("tooltip_abkommen").style.visibility = 'hidden';
    }
}
function tooltipbasis(xdat,ydat,name,logbuch) {
    if(settings.enabletooltips) {
        document.getElementById('tip_basis_name').innerHTML = name;
        document.getElementById('tip_basis_logbuch').innerHTML = logbuch;

        var dom_tooltip = document.getElementById("tooltip_basis");

        var hoch = dom_tooltip.offsetHeight;
        var breit = dom_tooltip.offsetWidth;

        if (ydat+hoch > info.umfang-10) { ydat = ydat-hoch-18; }
        if (xdat+breit > info.umfang-10) { xdat = xdat-breit-18; }

        dom_tooltip.style.left = xdat;
        dom_tooltip.style.top = ydat;
        dom_tooltip.style.visibility = 'visible';
    }
}
function tooltipbasisout() {
    if(settings.enabletooltips) {
        document.getElementById("tooltip_basis").style.visibility = 'hidden';
    }
}
function tooltipunbasis(xdat,ydat,name) {
    if(settings.enabletooltips) {
        document.getElementById('tip_unbasis_name').innerHTML = name;

        var dom_tooltip = document.getElementById("tooltip_unbasis");

        var hoch = dom_tooltip.offsetHeight;
        var breit = dom_tooltip.offsetWidth;

        if (ydat+hoch > info.umfang-10) { ydat = ydat-hoch-18; }
        if (xdat+breit > info.umfang-10) { xdat = xdat-breit-18; }

        dom_tooltip.style.left = xdat;
        dom_tooltip.style.top = ydat;
        dom_tooltip.style.visibility = 'visible';
    }
}
function tooltipunbasisout() {
    if(settings.enabletooltips) {
        document.getElementById("tooltip_unbasis").style.visibility='hidden';
    }
}

function tooltipschiff(xdat,ydat,name,schaden,lemin,mission,kolonisten,cantox,min1,min2,min3,vorrat,logbuch,bild,volk,erfahrung) {
    if(settings.enableshipimages) {
        var bildschiff='../daten/'+volk+'/bilder_schiffe/'+bild;
        bildschiff='<img src='+bildschiff+' width=75 height=50>';
        document.getElementById('tooltip_schiffbildinhalt').innerHTML = bildschiff;

        var ydatb = ydat-70;
        var xdatb = xdat-95;
        if (5>xdatb) { xdatb = xdat; }

        var dom_schiffbild = document.getElementById("tooltip_schiffbild");
        dom_schiffbild.style.left = xdatb;
        dom_schiffbild.style.top = ydatb;
        dom_schiffbild.style.visibility = 'visible';
    }
    if(settings.enabletooltips) {
        document.getElementById('tip_schiffname').innerHTML = name;
        if(settings.tooltip_schiffbasiswerte) {
            document.getElementById('tip_schiffschaden').innerHTML = schaden;
            document.getElementById('tip_schifftank').innerHTML = lemin;
        }
        if(settings.tooltip_schifffracht) {
            document.getElementById('tip_schiffkolonisten').innerHTML = kolonisten;
            document.getElementById('tip_schiffcantox').innerHTML = cantox;
            document.getElementById('tip_schiffmin1').innerHTML = min1;
            document.getElementById('tip_schiffmin2').innerHTML = min2;
            document.getElementById('tip_schiffmin3').innerHTML = min3;
            document.getElementById('tip_schiffvorrat').innerHTML = vorrat;
        }
        if(settings.tooltip_schiffspezialmission) {
            document.getElementById('tip_schiffmission').innerHTML = mission;
        }
        if(settings.tooltip_schifflogbuch) {
            document.getElementById('tip_schifflogbuch').innerHTML = logbuch;
        }

        var bilderf = '../bilder/icons/erf_'+erfahrung+'.gif';
        bilderf = '<img src='+bilderf+' width=22 height=22>';
        document.getElementById('tip_schifferfahrung').innerHTML=bilderf;

        var dom_tooltip = document.getElementById("tooltip_schiff")
        var hoch = dom_tooltip.offsetHeight;
        var breit = dom_tooltip.offsetWidth;

        if (ydat+hoch > info.umfang-10) { ydat = ydat-hoch-18; }
        if (xdat+breit > info.umfang-10) { xdat = xdat-breit-18; }

        dom_tooltip.style.left=xdat;
        dom_tooltip.style.top=ydat;
        dom_tooltip.style.visibility='visible';
    }
}

function tooltipschiffout() {
     if(settings.enabletooltips) {
        document.getElementById("tooltip_schiff").style.visibility='hidden';
     }
     if(settings.enableshipimages) {
        document.getElementById("tooltip_schiffbild").style.visibility='hidden';
     }
}

function tooltipflotte(xdat,ydat,liste) {
    if(settings.enabletooltips) {
        document.getElementById('tip_flotteliste').innerHTML=liste;

        var dom_tooltip = document.getElementById("tooltip_flotte");

        var hoch = dom_tooltip.offsetHeight;
        var breit = dom_tooltip.offsetWidth;

        if (ydat+hoch > info.umfang-10) { ydat = ydat-hoch-18; }
        if (xdat+breit > info.umfang-10) { xdat = xdat-breit-18; }

        dom_tooltip.style.left = xdat;
        dom_tooltip.style.top = ydat;
        dom_tooltip.style.visibility = 'visible';
    }
}

function tooltipflotteout() {
    if(settings.enabletooltips) {
        document.getElementById("tooltip_flotte").style.visibility='hidden';
    }
}
