<?php
$lang['hilfe']['stufe']='Stufe {1}';
$lang['hilfe']['cx']='{1} Cx';
$lang['hilfe']['kt']='{1} KT';

$lang['hilfe']['ueberschrift'][1]='Techlevel Rumpf';
$lang['hilfe']['text'][1]="Der Technologielevel Rumpf einer Sternenbasis legt fest, welche Schiffshüllen auf der Sternenbasis konstruiert werden können. Eine Sternenbasis mit Techlevel Rumpf 5 kann zB. sämtliche Schiffe der Techlevel 1-5 produzieren.<br><br> Ein Upgrade eines Techlevels nimmt keinen Zug in Anspruch.<br><br>";

$lang['hilfe']['ueberschrift'][2]='Techlevel Antrieb';
$lang['hilfe']['text'][2]="Der Technologielevel Antrieb einer Sternenbasis legt fest, welche Antriebe auf der Sternenbasis konstruiert werden können. Eine Sternenbasis mit Techlevel Antrieb 5 kann zB. sämtliche Antriebe der Techlevel 1-5 produzieren.<br><br> Ein Upgrade eines Techlevels nimmt keinen Zug in Anspruch.<br><br>";

$lang['hilfe']['ueberschrift'][3]='Techlevel Antrieb';
$lang['hilfe']['text'][3]="Der Technologielevel Energetik einer Sternenbasis legt fest, welche energetischen Waffensysteme auf der Sternenbasis konstruiert werden können. Eine Sternenbasis mit Techlevel Energetik 5 kann zB. sämtliche energetischen Waffensysteme der Techlevel 1-5 produzieren.<br><br> Ein Upgrade eines Techlevels nimmt keinen Zug in Anspruch.<br><br>";

$lang['hilfe']['ueberschrift'][4]='Techlevel Projektile';
$lang['hilfe']['text'][4]="Der Technologielevel Projektile einer Sternenbasis legt fest, welche auf Projektile basierenden Waffensysteme auf der Sternenbasis konstruiert werden können. Eine Sternenbasis mit Techlevel Projektile 5 kann zB. sämtliche auf Projektile basierenden Waffensysteme der Techlevel 1-5 produzieren.<br><br> Ein Upgrade eines Techlevels nimmt keinen Zug in Anspruch.<br><br>";

$lang['hilfe']['ueberschrift'][5]='Abwehr-Anlagen';
$lang['hilfe']['text'][5]="Die Abwehr-Anlagen des Planeten bilden zusammen mit dem eventuell vorhandenen Abwehr-Anlagen einer Sternenbasis das planetare Verteidigungssystem. Die Anzahl der Abwehr-Anlagen auf einem Planeten bestimmt den Techlevel der energetischen Waffen, sowie die Anzahl der Jägerstartrampen. Beide Abwehr-Anlagen (Planet und Sternenbasis) bestimmen durch ihre gemeinsame Anzahl die Anzahl der energetischen Waffen im Verteidigungssystem. Eine vorhandene Sternenbasis trägt 5 zusätztzliche Jägerrampen hinzu.<br><br>Die maximale Anzahl der Abwehr-Anlagen auf Planeten wird von der Größe der Bevölkerung bestimmt.<br><br>";
$lang['hilfe'][5][0]='Kosten pro Anlage auf Planeten';
$lang['hilfe'][5][1]="<br>Wird der Bau automatisiert, so versucht die Bevölkerung jede Runde resourcenabhängig das Maximum an Abwehr-Anlagen zu produzieren.";

$lang['hilfe']['ueberschrift'][6]='Fabriken';
$lang['hilfe']['text'][6]="Jede Fabrik produziert eine Kilotonne Vorräte pro Monat.<br><br>Die maximale Anzahl der Fabriken wird von der Größe der Bevölkerung bestimmt.<br><br>";
$lang['hilfe'][6][0]='Kosten pro Fabrik';
$lang['hilfe'][6][1]="<br>Wird der Bau automatisiert, so versucht die Bevölkerung jede Runde resourcenabhïängig das Maximum an Fabriken zu bauen.";

$lang['hilfe']['ueberschrift'][7]='Vorräte';
$lang['hilfe']['text'][7]="Vorräte werden zum Bau von zB. Fabriken, Minen oder auch Abwehr-Anlagen benötigt. Sie können auch zum Preis von 1 Cantox pro 1 Kilotonne verkauft werden.<br><br>Jede Fabrik produziert eine Kilotonne Vorräte pro Monat.<br><br>Wird der Verkauf automatisiert, so werden sämtliche Vorräte, die am Ende eines Monats übrig bleiben von der Bevölkerung verkauft.";

$lang['hilfe']['ueberschrift'][8]='Minen';
$lang['hilfe']['text'][8]="Minen schürfen nach den 4 Rohstoffen Lemin, Baxterium, Rennurbin und Vomisaan im Planetenkern. Baxterium, Rennurbin und Vomisaan  werden zum Bau von Schiffen, Sternenbasen und Schiffskomponeten benötigt. Bei Lemin hingegen handelt es sich um einen flüchtigen Treibstoff.<br><br>Die Konzentration gibt an, wieviele Minen benötigt werden, um eine Kilotonne des Rohstoffes pro Monat zu fördern.<br><br>";
$lang['hilfe'][8][0]='hochkonzentriert';
$lang['hilfe'][8][1]='konzentriert';
$lang['hilfe'][8][2]='verteilt';
$lang['hilfe'][8][3]='weit getreut';
$lang['hilfe'][8][4]='flüchtig';
$lang['hilfe'][8][5]='{1} Mine';
$lang['hilfe'][8][6]='{1} Minen';
$lang['hilfe'][8][7]="<br>Die maximale Anzahl der Minen wird von der Größe der Bevölkerung bestimmt.<br><br>";
$lang['hilfe'][8][8]='Kosten pro Mine';
$lang['hilfe'][8][9]="<br>Wird der Bau automatisiert, so versucht die Bevölkerung jede Runde resourcenabhängig das Maximum an Minen zu bauen.";

$lang['hilfe']['ueberschrift'][9]='Hüllenproduktion';
$lang['hilfe']['text'][9]="Ein fertiges Schiff setzt sich aus der Schiffshülle sowie den Komponenten Antriebe, energetische Waffensysteme und projektibasierende Waffensysteme zusammen. Die Schiffshülle bestimmt dabei die Anzahl der einzelnen Komponenten, sowie die speziellen Fertigkeiten des Schiffes.<br><br>Um eine Schiffshülle produzieren zu können, muss man den entsprechenden Techlevel Rumpf in der Raumbasis erreicht haben. Der benötigte Techlevel ist in der zweiten Spalte zu sehen, wobei die Namen der Schiffe, die aus diesem Grunde nicht produziert werden können, in grau gehalten sind. Schiffshüllen, die aus Mangel an Rohstoffen bzw. Cantox nicht       produziert werden können, erscheinen zwar ganz normal, aber der entsprechende Button zum produzieren erscheint auch hier nicht.<br><br>Die letzte Spalte \"Lager\" zeigt an, wieviel Hüllen des entsprechenden Types bereits in den Lagern der Sternenbasis liegen.";

$lang['hilfe']['ueberschrift'][10]='Abwehr-Anlagen';
$lang['hilfe']['text'][10]="Die Abwehr-Anlagen des Planeten bilden zusammen mit dem eventuell vorhandenen Abwehr-Anlagen einer Sternenbasis das planetare Verteidigungssystem. Die Anzahl der Abwehr-Anlagen auf einem Planeten bestimmt den Techlevel der energetischen Waffen, sowie die Anzahl der Jägerstartrampen. Beide Abwehr-Anlagen (Planet und Sternenbasis) bestimmen durch ihre gemeinsame Anzahl die Anzahl der energetischen Waffen im Verteidigungssystem. Eine vorhandene Sternenbasis trägt 5 zusätzliche Jägerrampen hinzu.<br><br>Die maximale Anzahl der Abwehr-Anlagen auf Sternenbasen beträgt 50.<br><br>";
$lang['hilfe'][10][0]='Kosten pro Anlage auf Sternenbasis';

$lang['hilfe']['ueberschrift'][11]='Antriebssysteme';
$lang['hilfe']['text'][11]="Die Antriebsart bestimmt den maximalen sicheren Warpfaktor, den ein Schiffe ohne Schaden zu nehmen erreichen kann. Die Anzahl der Triebwerke ist hierbei unerheblich.<br><br>Jedes Schiff kann ohne weiteres schneller fliegen, als der eigene maximale sichere Warpfaktor. überschreitet man diesen, so wirkt sich das enorm auf den Leminverbrauch aus.<br><br>So kann zB. ein Schiff mit einem Sonnensegel (Warp 1) ohne weiteres Warp 9 fliegen, nur reicht das Lemin sehr wahrscheinlich nicht mehr für den Heimflug.";

$lang['hilfe']['ueberschrift'][12]='Waffensysteme';
$lang['hilfe']['text'][12]="Die einzelnen Waffensysteme verfügen über unterschiedliche Durchschlagskraft. Die Anzahl der Systeme bestimmt die Schüsse des Systems pro Kampfphase. Raumjäger machen immer einen Schaden von 4%, wobei die Anzahl der Hanger angeben, wieviele Jäger pro Kampfrunde starten können.<br><br>";
$lang['hilfe'][12][0]='energetische Waffen';
$lang['hilfe'][12][1]='projektilbasierende Waffen';
$lang['hilfe'][12][2]='RS';
$lang['hilfe'][12][3]='CS';
$lang['hilfe'][12][4]="<br>Die projektilbasierenden Waffensysteme treffen mit einer Wahrscheinlichkeit von 66% + 6% je Erfahrungslevel.<br><br>";
$lang['hilfe'][12][5]=array('Laser','Phaser','Plasma Blaster','Disruptor','Tachionenstrahler','Desintegrator','Gravitraktor','Potentialverdichter','Tryxoker','Partikel-Vortex');
$lang['hilfe'][12][6]=array('Fusionsraketen','Photonentorpedos','Transformkanone','Gammabomben','Fissionstorpedos','Mun-Katapult','Quantentorpedos','Micromitgeschütz','Singularitätswerfer','Novabomben');
$lang['hilfe'][12][7]='Normalmodus';
$lang['hilfe'][12][8]='Kapermodus';
$lang['hilfe'][12][9]='<br>RS-Rumpfschaden<br>CS-Crewschaden';

$lang['hilfe']['ueberschrift'][13]='Spezialmissionen';
$lang['hilfe']['text'][13]="Ein Schiff kann immer nur eine Spezialmission gleichzeitig ausführen. Eine Spezialmission ist nicht einmalig, sondern eher eine Richtlinie an das Schiff, diese Mission auszuführen, solange es nicht zu einem Widerruf kommt.<br><br>Welche Spezialmissionen zur Verfügung stehen hängt ganz allein vom Schiffstyp ab.<br><br>Spezialmissionen, die in der momentanen Situation nicht ausgeführt werden können, werden einfach nicht beachtet, bis sie wieder durchführbar sind.<br><br>Die Spezialmission \"Planetenbombardement\" wirkt zB. nur, wenn sich das entsprechende Schiff in einer feindlichen Umlaufbahn befindet. Im All bringt diese Mission nichts, wird aber sofort wieder durchgeführt, sobald man sich erneut in einem fremden Planetenorbit befindet.";

$lang['hilfe']['ueberschrift'][14]='Scanning';
$lang['hilfe']['text'][14]="Planeten und fremde Schiffe im Scanbereich (innerhalb des blauen Kreises um das eigene Schiff) können gescannt werden. Man erhält einige grobe Angaben über die Ziele.<br><br>Insbesondere beim Erobern von fremden Kolonien ist es wichtig zu wissen, ob die eigenen Kolonisten zahlreich genug sind, um sich gegen die Fremden behaupten zu können.";

$lang['hilfe']['ueberschrift'][15]='Transporterraum';
$lang['hilfe']['text'][15]="Im Transporterraum kann man aufs Einfachste Waren hinab auf den Planeten bzw. vom Planeten hinauf in die Lagerräume des Schiffes beamen.<br><br>Links stehen die Waren der Lagerräume des Schiffes und rechts die vorhandenen Waren auf der Planetenoberfläche. über die Schieberegler lässt sich schnell einstellen, wo welche Waren hingehören. Mit dem Button \"Transport durchführen\" werden entsprechende Befehle von einem Crewman durchgeführt.<br><br>Sind die Schieberegler zu grob, weil insgesamt eine zu große Menge einer Ware vorhanden ist, so kann man den Schieberegler auch einfach anklicken und mit den Cursortasten bedienen.<br><br>Zu beachten sind die maximalen Kapazitäten der Lagerräume und der Tanks des Schiffes.<br><br>1 KT Baxterium, Rennurbin, Vomisaan sowie Vorräte nehmen jeweils eine KT Lagerraum ein.<br><br>1 KT Lemin füllt eine KT Platz der Tanks. Lemin läßt sich nicht in den normalen Lagerräumen unterbringen.<br><br>100 Kolonisten mitsamt ihren Habseligkeiten benötigen 1 KT Platz der normalen Lagerräume.<br><br>Cantox benötigen keinen nennenswerten Platz.";

$lang['hilfe']['ueberschrift'][16]='Flugkontrolle';
$lang['hilfe']['text'][16]="Es ist recht einfach, den Kurs eines Schiffes festzulegen.<br><br>Als erstes aktiviert man den Kursmodus durch Klick der entsprechenden Checkbox. Ist der Kursmodus aktiviert, ist man nicht in der Lage einen anderen Menupunkt auszuwählen oder irgendwas anderes zu tun. Der Kursmodus deaktiviert sich erst wenn man einen Kurs bestätigt oder den Kursmodus händisch über die Checkbox widerruft.<br><br>Ist der Kursmodus aktiv und klickt man auf die Karte, so wird eine entsprechnde Kursroute des aktiven Schiffes zum markierten Punktgezeigt und entsprechende Werte berechnet. Man sollte auch unter Geschwindigkeit die gewünschte Warpgeschwindigkeit einstellen. Sofort wird berechnet, wie lange der Flug dauert und wie hoch der Treibstoffverbrauch ist.<br><br>";
$lang['hilfe'][16][0][0]='Zielkoordinaten';
$lang['hilfe'][16][0][1]='Zielbezeichnung';
$lang['hilfe'][16][0][2]='Entfernung';
$lang['hilfe'][16][0][3]='Geschwindigkeit';
$lang['hilfe'][16][0][4]='Dauer';
$lang['hilfe'][16][0][5]='Leminverbrauch';
$lang['hilfe'][16][1][0]='Hier werden die Zielkoordinaten angezeigt.';
$lang['hilfe'][16][1][1]='Um was handelt es sich bei dem Ziel. Entweder um den freien Raum, einen Feind oder einen Planeten. Ist es ein Planet so wird der Name des Planeten genannt.';
$lang['hilfe'][16][1][2]='Die Entfernung in Lichtjahren zum Ziel.';
$lang['hilfe'][16][1][3]='Hier kann man die gewünschte Warpgeschwindigkeit definieren. Geschwindikeiten, bei denen erhöhter Leminverbrauch stattfindet, erscheinen rot.';
$lang['hilfe'][16][1][4]='Die Monate, die das Schiff bei der ausgwählten Geschwindigkeit zum Zielpunkt benötigt. Ein Monat entspricht einem Spielzug.';
$lang['hilfe'][16][1][5]='Wieviel Treibstoff wird verbraucht, um an das Ziel zu gelangen.';
$lang['hilfe'][16][2]='Wenn man den Flugplan bestätigt, färben sich die Markierungen in der eigenen Spielerfarbe ein. Geschieht dies nicht, so konnte die Route nicht festgelegt werden und die entsprechende Meldung erscheint. Routen, deren erste Etappe schon mehr Lemin verbaucht als das Schiff in Ihren Tank hat werden nicht übernommen. Ausserdem werden alle Flugdaten gelöscht, wenn eine Gschwindigkeit von 0 Warp angegeben wird.';

$lang['hilfe']['ueberschrift'][17]='Logbuch';
$lang['hilfe']['text'][17]="Das Logbuch eines Schiffes dient als Möglichkeit sich zu einzelnen Schiffen Notizen zu machen. Sie erscheinen als Tooltipp in der Galaxieansicht.";

$lang['hilfe']['ueberschrift'][18]='Autorefuel';
$lang['hilfe']['text'][18]="Erreicht das Schiff einen Planeten, so versucht es eigenständig seinen Tank zu füllen.";

$lang['hilfe']['ueberschrift'][19]='Terraforming';
$lang['hilfe']['text'][19]="Befindet sich das Schiff in einem Orbit so erhöht bzw. senkt es die Planetentemperatur um einen Grad pro Monat. Was es nun genau tut, ist der Schiffsbeschreibung zu entnehmen.";

$lang['hilfe']['ueberschrift'][20]='Schiff-Recycling';
$lang['hilfe']['text'][20]="Befindet sich das Schiff in einem Orbit eines Planeten mit einer Sternenbasis so wird es vernichtet. Die Mineralien in den Lagerräumen und im Tank werden auf den Planeten transportiert. Es werden aus dem alten Frack 80% der Baukosten der Hülle an Mineralien wiedergewonnen.";

$lang['hilfe']['ueberschrift'][21]='Sprungtriebwerk';
$lang['hilfe']['text'][21]="Befindet sich genug Lemin im Tank so führt das Schiff einen Raumsprung durch. Welche Entfernungen erreicht werden und wieviel Lemin benötigt wird ist der Schiffsbeschreibung zu entnehmen.";

$lang['hilfe']['ueberschrift'][22]='Tarnfeldgenerator';
$lang['hilfe']['text'][22]="Ist der Tarnfeldgenerator aktiv so ist das Schiff nicht von den Langstreckensensoren des Feindes nicht zu entdecken. Es ist nicht auf der Galaxiekarte zu entdecken, solange es nicht in den Sensorbereich der feindliche Schiffe oder Planeten gerät.";

$lang['hilfe']['ueberschrift'][23]='Quarkreorganisator';
$lang['hilfe']['text'][23]="Der Quarkreorganisator reorganisiert Quark auf subatomarer Ebene und ist in der Lage aus Vorräten und einem Mineral Lemin zu gewinnen. Wieviel Vorräte und welche Mineralien benötigt werden ist der Schiffsbeschreibung zu entnehmen.";

$lang['hilfe']['ueberschrift'][24]='SubpartikelCluster';
$lang['hilfe']['text'][24]="Der Subpartikelcluster ist in der Lage aus Vorräten Mineralien zu gewinnen. Wieviele Vorräte benötigt und welche Mineralien gewonnen werden ist der Schiffsbeschreibung zu entnehmen.";

$lang['hilfe']['ueberschrift'][25]='Sprungtor konstruieren';
$lang['hilfe']['text'][25]="Das Schiff muss die erforderlichen Mineralien in seinen Lagerräumen haben und mindestens 30 Lichtjahre von Planeten und anderen Anomalien entfernt sein. Wird die Spezialmission aktiviert und ist auch kein Flugkurs eingegeben, so baut das Schiff in der nächsten Runde ein Sprungtor. Dieses Sprungtor ist der Anfang eines Transwarpkanals, welcher sich hinter dem Schiff herzieht.<br><br>Fliegt nun ein anderes Schiff in das Sprungtor, so wird es quer durchs All geschleudert und tritt irgendwo wieder in den Normalraum ein. Erst wenn das bauende Schiff ein zweites Tor vollendet, ist der Transwarpkanal stabil und verbindet die beiden Tore.<br><br>Die benötigten Mineralien sind den Schiffsbeschreibungen zu entnehmen.";

$lang['hilfe']['ueberschrift'][26]='Astrophysisches Labor';
$lang['hilfe']['text'][26]="Das Astrophysische Labor erhöht bei Aktivierung die Scannreichweite des Schiffes von den normalen 47 Lichtjahren auf 116 Lichtjahre.";

$lang['hilfe']['ueberschrift'][27]='Planetenbombardement';
$lang['hilfe']['text'][27]="Befindet sich das Schiff in einem feindlichen Orbit so bombardiert es mit seinen Waffen die Planetenoberfläche.<br><br>Die Stärker des Angriffes errechnet sich wie folgt<br><br><center>((Stärke energetische Waffen) * (Anzahl energetische Waffen) + (Stärke projektilbasierende Waffen) * (Anzahl projektilbasierende Waffen) + (Anzahl Hangar) * 35) / 4</center><br>Die resultierende Stärke wird zufällig auf die Bereiche Bevölkerung, Minen, Fabriken und Abwehranlagen verteilt und stellt die entsprechende Vernichtung in Prozent da.";

$lang['hilfe']['ueberschrift'][28]='Erweiterte Sensorenphalanx';
$lang['hilfe']['text'][28]="Das Erweiterte Sensorenphalanx erhöht bei Aktivierung die Scannreichweite des Schiffen von den normalen 47 Lichtjahren auf 85 Lichtjahre.";

$lang['hilfe']['ueberschrift'][29]='Subraumverzerrer';
$lang['hilfe']['text'][29]="Ein Subraumverzerrer erzeugt einen Riss im Subraum, welcher sofort wieder ins sich kolabiert und eine gewaltige Schockwelle im Subraum hinterlässt, welche sich über einen Radius von 83 Lichtjahren ausdehnt.<br><br>Er hat 2 Modi. Diese beziehen sich auf den Zeitpunkt der Aktivierung. Im Normalmodus aktiviert er sich vor der normalen Flugphase, im Betamodus danach.<br><br>Schiffe die den Subraumverzerrer einsetzen werden dabei vernichet. Welchen Schaden die umliegenen Schiffe zu erwarten haben findet sich entsprechend in der Schiffbeschreibung.";

$lang['hilfe']['ueberschrift'][30]='Routing';
$lang['hilfe']['text'][30]="Mittels Routing ist es möglich einem Schiff eine feste Route einzugeben, welche es abfliegt bis die Route geändert/gelöscht wird oder der Treibstoff zur Neige geht. Als einzelne Wegpunkte dienen eigene Kolonien, wobei für jeden Wegpunkt definiert werden kann, welche Rohstoffe an Bord und welche auf den Planeten gebeamt werden sollen.<br><br>Als erstes wählt man den anzulaufenden Wegpunkt es wird angeziet welcher Wegpunkt aktuell bearbeitet wir.<br>Dann definiert man das Verhalten des Schiffes im Orbit des Wegpunktes. Es kann für Cantox, Vorräte sowie die 4 Mineralien einzeln festegelegt werden, ob diese hinauf oder hinabgebeamt werden sollen. Man kann sie auch einfach lassen wie sie sind.<br>Nun kann man sich noch überlegen ob das Schiff im Orbit dieser Kolonie warten soll bis es vollbeladen ist oder nicht.<br>Unter \"<b>Passagiere</b>\" kann man zum Passagierraum wechseln, hier kann man entschieden ob Kolonisten, leichte Bodentruppen oder schwere Bodentruppen einsteigen oder austeigen sollen, oder aber auch vielleicht möchte man hier die Einstellung relativ wähle, bei der zb. Kolonisten Einsteigen sollten mehr als die angegebene Grenze den Planeten bewohnen, oder austeigen sollten es anderstherum weniger sein.<br>Mit \"<b>Frachtraum</b>\" kann man wieder zur Mineralienansicht wechseln.<br><br>Danach geht es weiter zum 2 Wegpunkt. Hierzu muss man unter umständen erst ein neuer Wegpunkt \"<b>einfügen</b>\". Sind mindestens zwei Wegpunkte vorhanden, so kann man auch einzelne Wegpunkte wieder \"<b>löschen</b>\". Mit\"<b><</b>\" und \"<b>></b>\" wechselt man zwischen den wegpunkten hin und her. Es können maximal 10 Wegpunkte definiert werden. Die Handhabung der Wegpunkte ist identisch mit der Handhabung der Startkolonie.<br>  <br>Hat man seinen letzten Wegpunkt ausgesucht (Es müssen mindestens zwei Kolonien gewählt sein.) schliesst man die Route ab, dies geschieht vom Frachtraum aus per \"<b>übernehmen</b>\". Von diesem letzten Planeten wird das Schiff wieder die Startkolonie anfliegen.<br><br>Zu guter letzt müssen noch einige grundsätzliche Optionen für die Route festgelegt werden:<br><br><b>Geschwindigkeit</b><br>Mit welcher Geschwindigkeit soll die Route abgeflogen werden?<br><br><b>Mindesttankfüllung</b><br>Egal was die Einstellungen der Wegpunkte sagen, das Schiff versucht diese Tankfüllung durch die Vorräte der Planetn zu erreichen. Auch wenn es an einem Wegpunkt Lemin liefern soll, so behält es diese Tankfüllung, damit es nicht unterwegs aus Treibstoffmangel liegenbleibt.<br><br><b>primärer Rohstoff</b><br>Der Lagerraum ist begrenzt. Als erstes wird versucht ihn mit diesem Rohstoff zu füllen.<br><br>Nachdem die Route erfolgreich eingepflegt wurde, erscheint als Auftrag des Schiffe <b>Route</b> und nach dem nächchsten Zug wird man feststellen, dass die Route mit Linien auf der Karte markiert ist und das Schiff bereits losgeflogen ist.";

$lang['hilfe']['ueberschrift'][31]='Logbuch';
$lang['hilfe']['text'][31]="Das Logbuch eines Planeten dient als Möglichkeit sich zu einzelnen Kolonie Notizen zu machen. Sie erscheinen als Tooltipp in der Galaxieansicht.";

$lang['hilfe']['ueberschrift'][32]='Logbuch';
$lang['hilfe']['text'][32]="Das Logbuch einer Sternenbasis dient als Möglichkeit sich zu einzelnen Sternenbasen Notizen zu machen. Sie erscheinen als Tooltipp in der Galaxieansicht.";

$lang['hilfe']['ueberschrift'][33]='Raumfalten-Technologie';
$lang['hilfe']['text'][33]="Mit Raumfalten ist es einer Sternenbasis möglich, Mineralien, Lemin und Cantox an bekannte Planeten, sowie an die eigene Flotte zu versenden.<br><br>Raumfalten bewegen sich mit Warp 12.67 durch den Subraum und legen daher pro Monat 160,53 Lichjahre zurück. Schiffe mit Warp 9 schaffen eine Strecke von maximal 81 Lichtjahren. Die Initialisierung einer Raumfalte verursacht Kosten, welche sich an der zu transportierenden Masse orientieren. Die Kosten werden wie folgt ermittelt<br><br>";
$lang['hilfe'][33][0]="<br>Die Initialisierung einer Raumspalte kostet immer mindestens 75 Cantox.";

$lang['hilfe']['ueberschrift'][34]='Schiff-Reparatur';
$lang['hilfe']['text'][34]="Die Schiffscrew ist in der Lage das eigene Schiff zu reparieren. Hierbei muss sich das Schiff in einem Planetenorbit befinden und benötigt Unterstützung.<br><br>Als Unterstützung kann entweder eine eigene Sternenbasis oder ein eigenes Schiff dienen. Bei Unterstützung durch eine Sternenbasis ist die Crew in der Lage den Schaden am Schiff pro Monat um 11% zu veringern. Bei Unterstützung durch ein dafür konstruiertes Schiff muss dieser Wert der entsprechenden Schiffsbeschreibung entnommen werden.";

$lang['hilfe']['ueberschrift'][35]='Projektile';
$lang['hilfe']['text'][35]="Munition für die projektilbasierenden Waffensysteme müssen auf den Schiffen selbst konstruiert werden. Unabhängig vom System kostet ein Projektil 35 Cantox, 2KT Baxterium und 1KT Rennurbin. Die maximale Anzahl, die auf einem Schiff gelagert werden kann beträgt Abschussrampen*5.<br><br>Projektile werden nicht nur beim Raumkampf, sondern auch beim Orbitalkampf verbraucht. Sind keine Projektile mehr vorhanden, schiesst das entsprechende Waffensystem einfach nicht mehr.<br><br>Der automatische Projektilbau konstruiert bei der Zugberechnung die neuen Projektile vor den Kampfhandlungen.";

$lang['hilfe']['ueberschrift'][36]='Plasmastürme';
$lang['hilfe']['text'][36]="Plasmastürme beeinflussen Schiffe, die sich in ihnen befinden auf folgende Weise:<br><br>-die Fluggeschwindigkeit senkt sich immer auf Warp 5<br>-Spungtore können nicht gebaut werden<br>-Tarnungen werden deaktiviert<br>-zusätzliche Sensoren werden behindert<br>-das astrophysische Labor funktioniert nicht<br>-Sprungtiebwerke fallen aus<br>-Subraumverzerrer fallen aus<br><br>Der Admin eines Spiels kann einstellen mit welcher Wahrscheinlichkeit jede Runde ein Plasmasturm entsteht, wie lange dieser maximal anhält und wieviele davon sich maximal gleichzeitig im Spiel tummeln.";

$lang['hilfe']['ueberschrift'][37]='Optionen';
$lang['hilfe']['text'][37]="Jederzeit kann man den Namen und den Flottenordner eines Schiffes nachträglich editieren.";

$lang['hilfe']['ueberschrift'][38]='Aggressivität';
$lang['hilfe']['text'][38]="Die Aggressivität eines Schiffes kann einen Wert von 1-10 erhalten. Je höher der Wert, desto früher wird gekämpft. Befinden sich also ein Frachter und ein Schlachtschiff an der gleichen Position und ist der Wert des Schlachtschiffes höher, so verteidigt es den Frachter bei einem Angriff.";

$lang['hilfe']['ueberschrift'][39]='Self-Destruct';
$lang['hilfe']['text'][39]="";

$lang['hilfe']['ueberschrift'][40]='Traktorstrahl';
$lang['hilfe']['text'][40]="Der Traktorstrahl ermöglicht es Schiffen, welche über die Antriebsarten Tech3 bis Tech7 verfügen, ein weiteres eigenens Schiff abzuschleppen, welches sich wiederum auf identischen Koordinaten befindet.<br><br>Welches Schiff nun genau abgeschleppt werden darf ergibt sich aus den Antrieben des Abschleppers. Die maximale Masse, welche vom Traktorstrahl gezogen werden kann beträgt <b>Anzahl der Antriebe * Techlevel der Antriebe * 20</b>.<br><br>Desweiteren können keine Schiffe, welche selber einen Kurs gesetzt oder eine Spezialmission aktiviert haben, abgeschleppt werden. Solche Manöver stören den Traktorstrahl und unterbrechen diesen.<br><br>Schiffe, welche den Traktorstrahl aktiviert haben, fliegen automatisch mit einer Maximalgeschwindigkeit von Warp 7 (oder weniger), da höhere Geschwindigkeiten bei diesem Manöver zu riskant erscheinen.<br><br>Da eine größere Masse bewegt werden muß, erhöht sich logischerweise der Leminverbrauch des abschleppenden Schiffes. Die halbe Masse des abgeschleppten Schiffes wird zur Berechnung des neuen Leminverbrauchs hinzugezogen.";

$lang['hilfe']['ueberschrift'][41]='Krieg erklären';
$lang['hilfe']['text'][41]="Das offizielle Erklären eines Kriegzustandes ist ein rein symbolischer Akt. Sich im Krieg befindliche Völker können kein weiteres Abkommen eingehen.";

$lang['hilfe']['ueberschrift'][42]='Kriegsende erbitten';
$lang['hilfe']['text'][42]="Um den Krieg zu beenden, muß der Frieden erbeten und vom Gegner akzeptiert werden.";

$lang['hilfe']['ueberschrift'][43]='Handelsabkommen';
$lang['hilfe']['text'][43]="Ein Handelsabkommen steigert die Einnahmen beider Völker. Je mehr Kolonien der andere besitzt, desto größer ist der eigene Profit. Haben beide Parteien gleichviel Kolonien, erhöhten sich die Einnahmen auf beiden Seiten um 18%.<br><br>Das Brechen eines Handelsabkommens dauert 3 Monate.";

$lang['hilfe']['ueberschrift'][44]='Nichtangriffspakt';
$lang['hilfe']['text'][44]="Ein Nichtangriffspakt verhindert jeglichen Kampf zwischen beiden Parteien. Schiffe weichen voreinander aus und Schiffe können nicht in den Orbit der Kolonien des Partners eindringen.<br><br>Das Brechen einen Nichtangriffspaktes dauert 6 Monate.";

$lang['hilfe']['ueberschrift'][45]='Völkerbündnis';
$lang['hilfe']['text'][45]="Ein Völkerbündnis verhindert wie der Nichtangriffspakt den gegenseitigen Angriff. Zusätzlich teilen beide Parteien ihre Galaxieansicht.<br><br>Das Brechen eines Völkerbündnisses dauert 9 Monate.";

$lang['hilfe']['ueberschrift'][46]='Allianz';
$lang['hilfe']['text'][46]="Eine Allianz stellt die perfekte Zusammenarbeit zweier Völker dar. Wie das Völkerbündnis verhindert die Allianz den gegenseitigen Angriff. Beide Pateien teilen ihre Galaxieansicht. Zusätzlich ist es einem Volk möglich in den Orbit der befreundeten Kolonien zu fliegen und über den Transporter Waren zu tauschen. Beide Parteien können sich gegenseitig Teile ihrer Flotte überlassen.<br><br>Das Brechen einer Allianz dauert 12 Monate.";

$lang['hilfe']['ueberschrift'][47]='Abkommen brechen';
$lang['hilfe']['text'][47]="Beim Brechen eines Abkommens wird die andere Partei entsprechend in Kenntnis gesetzt. Wie lange das Abkommen noch hält, bevor es endgültig seine Wirkung verliert, hängt von der Art des Abkommens ab.";
?>