// JavaScript Document

/* common js scripts */

//var screenname		=	'';

var popup_opened	=	false;

 var emirate_coordinates = [[1,1],['25.271139','55.307485'],['24.466667','54.366667'],['25.357522','55.391865'],['25.403023','55.491797'],['25.513234','55.569084'],['25.800693','55.976199'],['25.117388','56.352568']];

 var location_json_array = {"2":{"03531":"Abu Dhabi Gate City","09656":"AbuDhabi-Al Ain (Highway)","01457":"Airport Road","01458":"Al Aryam","03532":"Al Badaa","03533":"Al Bahia","03534":"Al Baraha","01459":"Al Barza","03535":"Al Bateen","08489":"Al Bateen Al Ain","03536":"Al Dhafrah","03537":"Al Falah City","03538":"Al Ghadeer","09620":"Al Gurm West","01460":"Al Hosn","03539":"Al Hudayriat Island","03540":"Al Ittihad Road","03541":"Al Karamah","03542":"Al Khaleej Al Arabi Street","03543":"Al Khalidiya","03544":"Al Maffraq","01461":"Al Maha","08139":"Al Maharba","03545":"Al Manaseer","03546":"Al Manhal","03547":"Al Maqtaa","01462":"Al Markaz","03548":"Al Markaziyah","01463":"Al Mina","01464":"Al Muneera","09286":"Al Muntazah","03549":"Al Mushrif","03550":"Al Nahda Abu Dhabi","01465":"Al Nahyan","03551":"Al Nahyan Camp","03552":"Al Najda Street","05992":"Al Nasr Street","03553":"Al Qurm","01466":"Al Raha","03554":"Al Raha Beach","03555":"Al Raha Gardens","03556":"Al Raha Golf Gardens","03557":"Al Rahba","03558":"Al Rawdah","03559":"Al Reef","01467":"Al Reef Villas","01468":"Al Reem","03560":"Al Reem Island","01469":"Al Rehhan","03561":"Al Ruwais","06675":"Al Safarat District","03562":"Al Samha","03563":"Al Shahama","03564":"Al Shamkha","03565":"Al Sowwah","03567":"Al Wathba","03568":"Al Zaab","025378":"Al Zahraa","01470":"Arabian Village","08585":"Bain Al Jessrain","03569":"Baniyas","03570":"Between Two Bridges","03571":"Building Materials City","08342":"Capital Centre","01471":"Capital Plaza","03572":"City Downtown","01472":"Corniche","03573":"Corniche Area","03574":"Corniche Road","03575":"Danet Abu Dhabi","03576":"Defence Street","01473":"Delma Street","03577":"Desert Village","03578":"Eastern Road","03579":"Electra Street","08945":"Firdous Street","03580":"Ghantoot","03581":"Grand Mosque District","01474":"Hamdan Street","03582":"Hydra Village","03583":"Jawazat Street","01475":"Khalidia","01476":"Khalifa City (all)","01477":"Khalifa City A","01478":"Khalifa City B","01479":"Khalifa City C","03584":"Khalifa Street","08301":"Liwa Street","03585":"Lulu Island","03586":"Madinat Zayed","03587":"Marina Village","03588":"Masdar City","01480":"Mbz","03589":"Mohamed Bin Zayed City","03590":"Muroor Area","01481":"Musaffah Industrial Area","03591":"Mussafah","01483":"New Khalifa City","03592":"Nurai Island","01484":"Officers City","05678":"Officers Club Area","03593":"Saadiyat Island","03594":"Salam Street","03595":"Sas Al Nakhl","03596":"Tourist Club Area","08110":"World Trade Center","03597":"Yas Island","03598":"Zayed Military City","07501":"Zayed Sports City"},"3":{"01773":"Abu Shagara","06750":"Al Azra","09497":"Al Badie","03626":"Al Barashi","08107":"Al Blaida Area","03627":"Al Butina","01776":"Al Ettihad Street","06771":"Al Faisht","06768":"Al Falaj","01777":"Al Ghafeyah Area","06543":"Al Gharayen","09614":"Al Gharb","06783":"Al Goaz","025671":"AL Hazannah","09787":"Al Heerah","03628":"Al Jubail","01779":"Al Khaldeia Area","03629":"Al Khan","01781":"Al Khezamia","03630":"Al Majaz","01783":"Al Mamzar - Sharjah","01784":"Al Mareija","08071":"AL Mujarrah","01785":"Al Nahda Sharjah","01786":"Al Naimiya Area","01787":"Al Nekhailat","03631":"Al Nouf","01789":"Al Nujoom Islands","01790":"Al Qasbaa","01791":"Al Qasemiya","025633":"Al Rahmaniya","03633":"Al Ramla","01793":"Al Riffa Area","03634":"Al Shahba","06774":"Al Sharq","01795":"Al Taawon","01796":"Al Wahda","01797":"Cornich Al Buhaira","03637":"Halwan","01799":"Hamriyah Free Zone","03638":"Maysaloon","03639":"Muelih","09572":"Mughaider","01802":"Rolla Area","01803":"Sharjah Airport Freezone (SAIF)","01804":"Sharjah Industrial Area","08274":"Tilal City","01805":"Umm Khanoor","03640":"Wasit"},"1":{"08845":"Acacia Avenues","08238":"Academic City","06032":"Akoya","07420":"Akoya Oxygen","025312":"Al Awir","08327":"Al Bada'a","05981":"Al Barari","017":"Al Barsha","082":"Al Furjan","04924":"Al Garhoud","07480":"Al Hamriya","09483":"Al Jaddaf","05790":"Al Jafiliya","07297":"Al Karama","06119":"Al Khail Heights","05780":"Al Khawaneej","05684":"Al Mamzar","06573":"Al Mizhar","075":"Al Nahda","09298":"Al Nahda 2","076":"Al Quoz","06297":"Al Qusais","06067":"Al Rashidiya","072":"Al Rigga","07147":"Al Safa","05773":"Al Sufouh","06000":"Al Twar","05715":"Al Warqaa","05695":"Al Warsan","05709":"Al Wasl","012":"Arabian Ranches","08851":"Arjan","018":"Bur Dubai","013":"Business Bay","04940":"Culture Village","044":"Deira","036":"DIFC","014":"Discovery Gardens","024":"Downtown Dubai","06378":"Downtown Jebel Ali","09406":"Dubai Creek Club Residences","074":"Dubai Healthcare City","08779":"Dubai Hills Estate","05814":"Dubai Industrial City","079":"Dubai Internet City","070":"Dubai Investment Park","015":"Dubai Marina","05911":"Dubai Maritime City","078":"Dubai Media City","09469":"Dubai Pearl","06006":"Dubai Studio City","05745":"Dubai Waterfront","05889":"Dubai World Central","033":"Dubailand","06008":"DuBiotech","05795":"Emirates Golf Course","026":"Emirates Hills","05680":"Festival City","031":"Green Community","020":"Greens","054":"IMPZ","027":"International City","019":"JBR","073":"Jebel Ali","030":"Jumeirah","042":"Jumeirah Golf Estates","04916":"Jumeirah Heights","039":"Jumeirah Islands","022":"Jumeirah Lake Towers","040":"Jumeirah Park","053":"Jumeirah Village Circle","05712":"Jumeirah Village Triangle","034":"Lakes","06342":"Majan","025":"Meadows","05904":"Meydan City","037":"Mirdiff","06132":"Mohammad Bin Rashid City","047":"Motor City","05777":"Muhaisnah","05979":"Nad Al Hamar","05986":"Nad Al Sheba","023":"Old Town","035":"Other","07980":"Oud Al Muteena","09554":"Oud Metha","05758":"Palm Jebel Ali","016":"Palm Jumeirah","05809":"Pearl Jumeirah Island","05951":"Ras Al Khor","06004":"Reem","038":"Satwa","028":"Sheikh Zayed Road","055":"Silicon Oasis","043":"Sports City","021":"Springs","06384":"Technology Park","08131":"TechnoPark","048":"TECOM","041":"The Gardens","06036":"The Hills","08065":"The Lagoons","07570":"The Views","08689":"The Villa","04934":"The World Islands","09205":"Town Square","06064":"Umm Ramool","029":"Umm Suqueim","032":"Victory Heights","068":"World Trade Centre","06753":"Zabeel Road"},"4":{"01816":"Ain Ajman","01343":"Ajman Boulevard","01817":"Ajman Corniche Road","01818":"Ajman Downtown","01819":"Ajman Industrial Area","01820":"Ajman Marina","01821":"Ajman Meadows","01822":"Ajman Uptown","01823":"Al Ameera Village","07246":"Al Bustan","01824":"Al Humaid City","01825":"Al Ittihad Village","01826":"Al Naemiyah","01827":"Al Rashidiya","01828":"Al Rumaila","03611":"Al Zahraa","08232":"Al Zorah","01830":"Awali City","01831":"Corniche Ajman","01832":"Emirates City","06264":"Garden City","01833":"Green City","03612":"Manama","01835":"Marmooka City","03613":"Muehat","03614":"Musheiref","01838":"New Industrial Area","01839":"Park View City","06495":"Sheikh Khalifa Bin Zayed"},"8":{"03599":"Al Ain Industrial Area","03600":"Al Buraymi","03601":"Al Faqa","03602":"Al Hili","09047":"Al Jahili","03603":"Al Jimi","03604":"Al Khabisi","03605":"Al Maqam","03606":"Al Markhaniya","09050":"Al Mutarad","09053":"Al Oyoun Village","03607":"Al Sinaiya","03608":"Al Tawiya","025233":"Falaj Hazza","03609":"Tawam","03610":"Zakher"},"6":{"09082":"Al Dhaith","01442":"Al Hamra (all)","03615":"Al Hamra Village","01443":"Al Marjan Island","08507":"Al Nakheel","06047":"Al Qusaidat","05994":"Al Seer","01444":"Bab Al Bahr","03616":"Cornich Ras Al Khaima","01445":"Cove","08716":"Cove Rotana","03617":"Dana Island","01446":"Golf Apartments","01447":"Granada","01448":"Julfar","01449":"Julfar Office","01450":"Julfar Residential","09653":"Khuzam","01451":"Luxury B Villa","01452":"Luxury C Villa","01453":"Malibu","01454":"Marina Apartments","03618":"Mina Al Arab","01455":"Oceana Apartments","03619":"RAK Financial City","03620":"RAK Industrial And Technology Park","03621":"Ras Al Khaimah Creek","03622":"Ras Al Khaimah Gateway","03623":"Ras Al Khaimah Waterfront","01456":"Royal Breeze Villas","03624":"Saraya Islands","08184":"Sheikh Mohammed Bin Zayed Road","03625":"Yasmin Village"},"5":{"01812":"Al Salam City","06333":"Amwaj Resort","01813":"Emirates Modern Industrial","01810":"Khor Al Beidah","01811":"Umm Al Quwain Marina","03641":"White Bay"},"7":{"01809":"Corniche Al Fujairah","01807":"Downtown Fujairah","01808":"Sheikh Hamad Bin Abdullah St"}};

    var sub_location_json_array = {"45":{"021548":"Ajman Corniche Road","021551":"Ajman Downtown","021554":"Ajman Industrial Area","021557":"Ajman Marina","021560":"Ajman Meadows","021563":"Ajman Uptown","021566":"Al Ameera Village","021569":"Al Humaid City","021572":"Al Ittihad Village","021575":"Al Naemiyah","021581":"Al Rumaila","021584":"Al Zahraa","021587":"Awali City","021590":"Corniche Ajman","021593":"Emirates City","021596":"Green City","021599":"Manama","021602":"Marmooka City","021605":"Muehat","021608":"Musheiref","021611":"New Industrial Area","021614":"Park View City","021545":"Ain Ajman","015320":"Ajman Boulevard"},"46":{"021446":"Al Brashi","021449":"Al Butina","021452":"Al Ettihad Street","021455":"Al Ghafeyah Area","021458":"Al Jubail","021461":"Al Khaldeia Area","021464":"Al Khan","021467":"Al Khezamia","021470":"Al Majaz","021473":"Al Mamzar - Sharjah","021476":"Al Mareija","021479":"Al Nahda-sharjah","021482":"Al Naimiya Area","021485":"Al Nekhailat","021488":"Al Nouf","021491":"Al Nujoom Islands","021494":"Al Qasbaa","021497":"Al Qasemiya","021500":"Al Ramla","021503":"Al Riffa Area","021506":"Al Shahba","021509":"Al Taawon","021512":"Al Wahda","021515":"Cornich Al Buhaira","021518":"Halwan","021521":"Hamriyah Free Zone","021524":"Maysaloon","021527":"Muelih","021530":"Rolla Area","021533":"Sharjah Airport Freezone (SAIF)","021536":"Sharjah Industrial Area","021539":"Umm Khanoor","021542":"Wasit","021443":"Abu Shagara"},"50":{"021620":"Downtown Fujairah","021623":"Sheikh Hamad Bin Abdullah St","021617":"Corniche Al Fujairah"},"51":{"021629":"Emirates Modern Industrial","021632":"Khor Al Beidah","021635":"Umm Al Quwain Marina","021638":"White Bay","021626":"Al Salam City"},"8065":{"08454":"Dubai Creek Residence Tower 3 North","02101":"Al Khayal","02102":"Al Laylak","025417":"Creekside 18","08068":"Dubai Creek Harbour","08446":"Dubai Creek Residence Tower 1 North","08443":"Dubai Creek Residence Tower 1 South","08452":"Dubai Creek Residence Tower 2 North","08932":"Dubai Creek Residence Tower 2 South","08938":"Dubai Creek Residence Tower 3 South","02103":"Phase 1","02104":"Phase 2","02105":"Phase 3"},"3560":{"04416":"Horizon Towers","09151":"A3 Tower","04398":"Addax Park Tower","04412":"Addax Port Office Tower","05996":"Al Durrah Tower","04431":"Al Maha Tower","04399":"Al Odaid Beach Residences","04440":"Al Sharq Towers","04448":"Al Wifaq Tower","09187":"Amaya Tower 1","09184":"Amaya Tower 2","04998":"Amaya Towers","04449":"Amber Tower","04450":"Atlantis Towers","04451":"Aurora Towers","04441":"Bay Centre Marina-The Marinas","06114":"Bay View Tower","04452":"Beach Towers","04413":"Burooj Crystal","04414":"Burooj Terraces","04432":"Burooj Views","025254":"C2 Tower","025257":"C3 Tower","025495":"City Of Lights","04401":"Creek Tower","04453":"Creek Towers","04454":"Dari Towers","04402":"Dynasty Tower","04455":"Empire Tower","04403":"Falcon Crest Tower","022784":"Falconcrest Tower","04404":"First Gulf Bank Tower","04415":"Harbour Heights","09145":"Helix Tower","022745":"Hydra 55 Towers","05737":"Hydra Avenue","09518":"Hydra Avenue C4","09521":"Hydra Avenue C5","09524":"Hydra Avenue C6","04405":"Hydra Avenue Hotel Apartments","04417":"Hydra Avenue Towers","04418":"Hydra Corporate Towers","04419":"Hydra Executive Towers","04406":"Hydra Heights","04420":"Hydra Hollywood Tower","04407":"Hydra Platinum Tower","04456":"Hydra Square Tower","022694":"Infinity Tower","04421":"Julfar Residence","04408":"Juman Tower","04457":"Lilac Tower","04458":"Lime Tower","08277":"Mag 5 (b2 Tower)","04459":"Mangrove Place","022727":"Marina Bay","025701":"Marina Bay By DAMAC","08875":"Marina Bay-City Of Lights","04422":"Marina Bay-Najmat","04434":"Marina Blue Tower","04435":"Marina Heights","08761":"Marina Heights 1","08764":"Marina Heights 2","04409":"Marina Rise Tower","04423":"Marina Spirit","09611":"Marina Square","06321":"Marina Square Building 14","06318":"Marina Square Building 15","06315":"Marina Square Building 18","025154":"Meera Shams Tower 1","025158":"Meera Shams Tower 2","07450":"Najmat Abu Dhabi","04424":"Ocean Pearl","04436":"Ocean Terrace","04460":"Oceanscape","04425":"Omega Towers","04410":"Onyx Tower","04437":"Panoramic Heights","04442":"Pearl Bay","04438":"RAK Tower","04461":"Reem Diamond","04443":"Residential Marina-The Marinas","04444":"Resort Marina-The Marinas","022661":"Rresort Marina-The Marinas","05813":"Sea View Tower","04426":"Sedrawan Tower","05744":"Shams Abu Dhabi","025662":"Shams Gate District","04427":"Sigma Tower 1","09148":"Sigma Tower 2","022712":"Sigma Towers","04428":"Sky Garden","04411":"Sky Garden Residence","04469":"Sky Tower","04429":"Solaris Towers","04445":"Solitaire Tower","04470":"Sun Tower","04430":"Synergy Towers","04439":"Tala Tower","04462":"Tameer Towers","04433":"Tamouh Tower","04471":"The ARC","04472":"The Gate Tower 1","04473":"The Gate Tower 2","04474":"The Gate Tower 3","09244":"The Kite Residences - Aabar Properties","07738":"The Wave","04446":"The Wings","04447":"Time Tower","04463":"X1 Tower","04464":"X2 Tower","04465":"X3 Tower","04466":"Y5 Tower","04467":"Y6 Tower","04468":"Z7 Tower"},"1457":{"09713":"Jannah Place","09109":"Abu Dhabi Airports - Airport Area","07228":"Al Dana Tower","04281":"Al Dhabi Building","025710":"Al Faiz Building","04282":"Al Fardan Building","08262":"Al Odaid Office Tower","04283":"Al Taghreed Tower","08259":"Fotouh Al Khair","06976":"Marks And Spencers Building","04284":"Owaida Tower","08253":"Rawda Building","025318":"Rawdhat","09310":"Rihab Tower","05812":"Rihan Heights","08256":"Sheikh Nahyan Bin Zayed Tower"},"5904":{"06582":"Polo Townhouse","07651":"Derby Residences","09748":"Diamond Business Park","06213":"Grand Views","025151":"Meydan Avenue","09745":"Meydan Business Park","024887":"Millennium Estate","05905":"Millennium Estates","07102":"Polo Residences","05944":"Sobha City"},"24":{"02046":"18 Burj Dubai Boulevard","02047":"29 Boulevard (all)","06354":"29 Boulevard Podium","05655":"29 Boulevard Tower 1","05656":"29 Boulevard Tower 2","06051":"48 Burjgate","02048":"8 Boulevard Walk","02064":"Address Downtown Hotel","02065":"Address Dubai Mall Hotel","02049":"Al Saaha","02050":"Armani Hotel Apartments","01902":"Armani Residences","06052":"Bay's Edge","02051":"Boulevard Central (all)","05754":"Boulevard Central Podium","05657":"Boulevard Central Tower 1","05658":"Boulevard Central Tower 2","06681":"Boulevard Crescent 1","07156":"Boulevard Crescent 2","09017":"Boulevard Heights Podium","07648":"Boulevard Heights Tower 1","08437":"Boulevard Heights Tower 2","02052":"Boulevard Plaza","08052":"Boulevard Plaza 1","08055":"Boulevard Plaza 2","06408":"Boulevard Point","01917":"Burj Al Nujoom","01903":"Burj Khalifa","014696":"Burj Khalifa (all)","03195":"Burj Park (all)","03021":"Burj Park 1","03022":"Burj Park 2","01904":"Burj Park 3","03023":"Burj Park 4","01905":"Burj Park 5","03321":"Burj Place (all)","03037":"Burj Place 1","03038":"Burj Place 2","014708":"Burj Residence 1","014735":"Burj Residence 10","014711":"Burj Residence 2","014714":"Burj Residence 3","014717":"Burj Residence 4","014720":"Burj Residence 5","014723":"Burj Residence 6","014726":"Burj Residence 7","014729":"Burj Residence 8","014732":"Burj Residence 9","010583":"Burj Residences (all)","01906":"Burj Square","03199":"Burj Views (all)","03034":"Burj Views A","03035":"Burj Views B","03036":"Burj Views C","05885":"Burj Views Podium","05949":"Burj Vista","06043":"Burj Vista 1","05991":"Burj Vista 2","05642":"Burjside Boulevard","05643":"Burjside Terrace","09515":"Business Tower","03200":"Claren (all)","03469":"Claren 1","03470":"Claren 2","025438":"Claren Tower Podium","05957":"Cosmopolitan Building","06522":"Damac Maison","08597":"Damac Maison Dubai Mall Street","09121":"Downtown Views","06348":"Elite Downtown Residence","05977":"Emaar Boulevard","010532":"Emaar Business Square","02054":"Emaar Square","09665":"Emaar Square Bldg 1","09668":"Emaar Square Bldg 2","09671":"Emaar Square Bldg 3","09674":"Emaar Square Bldg 4","09680":"Emaar Square Bldg 6","09569":"Forte","09638":"Forte 1","09641":"Forte 2","06462":"Fountain Views 1","06465":"Fountain Views 2","06468":"Fountain Views 3","02055":"Grand Boulevard","03202":"Lofts (all)","02056":"Lofts Central","02053":"Lofts East","02067":"Lofts Podium","02068":"Lofts West","02066":"Mansion","07974":"Maram Residence","02057":"North Ridge","06847":"Opera Grand","06104":"Prive","08969":"Priv\u00e9 Hotel Apartment","06405":"Radisson Blu Hotel","025046":"RP Heights","03201":"South Ridge (all)","02058":"South Ridge 1","02059":"South Ridge 2","02060":"South Ridge 3","02061":"South Ridge 4","02062":"South Ridge 5","02063":"South Ridge 6","05661":"Southridge Podium Villas","025683":"Standard Chartered Tower","03523":"Standpoint","05687":"Standpoint A","05688":"Standpoint B","05693":"The Address BLVD","05776":"The Address Fountain View","024902":"The Address Sky View","05910":"The Address Sky View Tower 1","07105":"The Address Sky View Tower 2","06099":"The Distinction","05874":"The Ramada Hotel","03203":"The Residences (all)","03024":"The Residences 1","03033":"The Residences 10","03025":"The Residences 2","03026":"The Residences 3","03027":"The Residences 4","03028":"The Residences 5","03029":"The Residences 6","03030":"The Residences 7","03031":"The Residences 8","03032":"The Residences 9","06062":"The Signature","07726":"The Sterling","07915":"The Sterling East","07912":"The Sterling West","06279":"The Summit","06061":"Upper Crest","06375":"Vida Residence","07498":"Zafran"},"1477":{"08046":"18 Villas Complex","08043":"34 Villas Project","08040":"Al Dhafrah Complex","09722":"Al Forsan Village","06567":"Al Rayanna","08013":"Al Rayyana","04542":"Complex 14","04543":"Complex 16","04544":"Complex 17","04545":"Complex 18","04546":"Complex 3","04547":"Complex 8","04548":"Golf Gardens","025324":"Khalifa City A","05666":"Liwa Oasis Compound","08016":"Villa Compound"},"15":{"02137":"23 Marina","02242":"Address Dubai Marina","02138":"Al Anbar","02139":"Al Anbar Villas","02140":"Al Areifi","025345":"Al Dar Tower","02141":"Al Duaa","02184":"Al Fairooz Tower","02142":"Al Fairooz Villas","02143":"Al Fardan","03210":"Al Fattan (all)","03448":"Al Fattan 1","03449":"Al Fattan 2","06516":"Al Fattan Marine Plaza","010853":"Al Habtoor","02144":"Al Habtoor Business Tower","03126":"Al Habtoor Residential","07708":"Al Husn Marina","03451":"Al Majara (all)","02145":"Al Majara 1","02146":"Al Majara 2","02147":"Al Majara 3","02148":"Al Majara 4","02149":"Al Majara 5","025248":"Al Majara 6","02150":"Al Marjan Villas","02151":"Al Mass","08280":"Al Mass Villas","02152":"Al Mesk","02153":"Al Mesk Villas","03255":"Al Sahab (all)","02154":"Al Sahab 1","02155":"Al Sahab 2","02156":"Al Seef","06201":"Al Shebani Residence","02157":"Al Yass","03125":"Ariyana","02158":"Ary","010898":"Atessa","02243":"Atlantic","02159":"Attessa Tower","010901":"Aurora","02160":"Aurora Tower","02161":"Avant","02954":"Azure (all)","02162":"Azure 1","02163":"Azure 2","02164":"Bay Central","05644":"Bay Central East","05645":"Bay Central West","02244":"Bayside","02165":"Bayside Residence","010919":"Beauport","02166":"Beauport Tower","02167":"Belvedere","02168":"Blakely","02169":"Bonaire","02170":"Botanica","06811":"Bunyan Tower","02171":"Casa De Sol","02172":"Casa Del Mar","02245":"Cascades","06014":"Cayan Tower","07513":"Central Tower","07318":"Centro Towers","03465":"Channel","025348":"City Premiere Hotel Apartments","06669":"Continental Tower","02173":"Damac Heights","07531":"DAMAC Residenze By Fendi Casa","03265":"Dec (all)","03472":"Dec 1","02174":"Dec 2","02175":"Delphine","02176":"Dorra Bay","010952":"Dream","02177":"Dream Tower","08175":"Dream Tower 1","08178":"Dream Tower 2","02178":"Dubai Pearl","06077":"Dusit Residence","02179":"Eden Blue","02180":"Elite Residence","03258":"Emaar 6 (all)","02181":"Emerald Residence","02182":"Emirates Crown","05962":"Escan Tower","024581":"Escon Tower","02183":"Fairfield","010973":"Fairooz","07315":"Gargash Tower","03262":"Grosvenor House (all)","02958":"Grosvenor House Hotel","02957":"Grosvenor House Residence","03160":"Gulf National","015800":"Habtoor Residential","02185":"Harbour Residences","02186":"Horizon","02187":"Infinity","025306":"Intercontinental Hotel","02188":"Iris Blue","08001":"Jannah Place Dubai Marina","03214":"Jewels (all)","02961":"Jewels 1","02962":"Jewels 2","02189":"Kg","02190":"Kpm","02191":"La Residencia Del Mar","02192":"La Riviera","02193":"Le Reve","02194":"Light House","02195":"Mag 218","02196":"Manchester","011093":"Marina","02197":"Marina 101","03162":"Marina 23","02198":"Marina Arcade","09259":"Marina Bay Suites","02953":"Marina Crown","03257":"Marina Diamond (all)","02199":"Marina Diamond 1","02200":"Marina Diamond 2","02201":"Marina Diamond 3","02202":"Marina Diamond 4","02203":"Marina Diamond 5","02204":"Marina Diamond 6","025227":"Marina Diamond 7","02205":"Marina Dreams","06069":"Marina First Tower","07024":"Marina Gate","07807":"Marina Gate 1","07810":"Marina Gate 2","07813":"Marina Gate 3","02206":"Marina Heights","09079":"Marina Hotel Apartments","02207":"Marina Mansions","02208":"Marina Park","02209":"Marina Pearl","02210":"Marina Pinnacle","02211":"Marina Plaza","03206":"Marina Promenade (all)","025179":"Marina Promenade Attessa","025182":"Marina Promenade Aurora","025185":"Marina Promenade Beauport","025188":"Marina Promenade Delphine","025191":"Marina Promenade Paloma","025194":"Marina Promenade Shemara","011069":"Marina Quay (all)","02212":"Marina Quay East","02213":"Marina Quay North","02214":"Marina Quay West","07039":"Marina Quays","07036":"Marina Quays Villas","011072":"Marina Residence","02215":"Marina Residences A","08893":"Marina Residences B","02216":"Marina Sail","03261":"Marina Sky (all)","02955":"Marina Sky 1","02956":"Marina Sky 2","03177":"Marina Sky 3","02217":"Marina Square","02218":"Marina Star","02219":"Marina Suites","02220":"Marina Terrace","02221":"Marina Tower","03209":"Marina View (all)","03504":"Marina View 1","03505":"Marina View 2","02222":"Marina Walk","03260":"Marina Wharf (all)","02223":"Marina Wharf 1","02224":"Marina Wharf 2","025713":"Marina Wharf 3","03208":"Marinascape (all)","06105":"Marinascape Avant","06106":"Marinascape Oceanic","08086":"Marriott Harbour Hotel And Suites","02136":"Murjan","05772":"My Tower","06459":"No.9","07309":"Nuran Marina Serviced Residences","06162":"Oasis Beach Tower","02227":"Ocean Heights","02225":"Oceanic","02228":"Opal Marina","04933":"Orra","011126":"Paloma","02229":"Paloma Tower","02230":"Panoramic","03211":"Park Island (all)","025167":"Park Island Blakely","025170":"Park Island Bonaire","025173":"Park Island Fairfield","025176":"Park Island Sanibel","02231":"Pentominium","07507":"Pier 7","02232":"Pier 8","02246":"Point","02233":"Princess","011144":"Residencia Del Mar","02235":"Royal Oceanic","02236":"Sanibel","011159":"Shemara","02237":"Shemara Tower","03213":"Silverene (all)","02960":"Silverene A","02959":"Silverene B","02238":"Sky View","02239":"South","08286":"Sparkle Tower 1","08289":"Sparkle Tower 2","08292":"Sparkle Tower 3","025492":"Sparkle Towers","025330":"Stella Maris","06666":"Sukoon Tower","02240":"Sulafa","02247":"Summit","02241":"Supreme","02965":"Tamani Hotel","05892":"TFG Marina Hotel","09734":"The Address Dubai Marina","025665":"The One Hotel","09683":"The Radisson Blu Residence","02250":"Time Place","02251":"Torch","02252":"Trident Bayside","02253":"Trident Grand Residence","02254":"Trident Marinascape","05886":"Trident Oceanic","02255":"Trident Waterfront","02248":"Waterfront","03215":"Waves (all)","02964":"Waves A","02963":"Waves B","02256":"West","05771":"West Avenue","02257":"Westside Marina","07312":"Wyndham Dubai Marina","02258":"Yacht Bay","02249":"Zen","03127":"Zulekha","02259":"Zumurud"},"3574":{"04505":"3 Sails Tower","04503":"AL Diar Tower 1","04504":"AL Diar Tower 2","04506":"Al Souq Tower","04507":"Baynuna Tower 1","04508":"Baynuna Tower 2","04509":"Corniche Tower","08911":"Etihad Tower 1","08914":"Etihad Tower 2","08917":"Etihad Tower 3","08920":"Etihad Tower 4","08923":"Etihad Tower 5","04510":"Falcon Tower","04511":"Golden Beach Tower","05811":"Nation Tower A","04512":"Oryx Tower","06985":"Silver Tower"},"78":{"025627":"32 Villas TECOM","03147":"Al Shatha","03405":"Al Thuraya (all)","03135":"Al Thuraya 1","03136":"Al Thuraya 2","011243":"Business Central A","011246":"Business Central B","07087":"Business Central Tower 1","07090":"Business Central Tower 2","08872":"Concord Tower","025230":"Cordoba Residence","07258":"Dubai Jewel Tower","05806":"Fraser Suites","015365":"Gloria Hotel","02260":"Media One"},"53":{"02590":"7 West Residences","02646":"Abjar","07723":"Aces Chateau","02647":"Al Duaa Gardens","015557":"Al Khail","015530":"Al Mahra (all)","012431":"Al Mahra 1","012440":"Al Mahra 2","06258":"Alfa Residence","02592":"Angelica Residence","02648":"Apex Suites","02649":"Arabian","02708":"Arabian Villas","05787":"Ashai Tower","02650":"Astoria Residence","05650":"Autumn Apartments","09566":"Bachour Villas","02651":"Baynonah Business Centre","02593":"Blue Ice","025236":"Botanica","03365":"Cadi (all)","02626":"Cadi 1","02627":"Cadi 2","02628":"Cadi 3","02629":"Cadi 4","02630":"Cadi 5","02594":"Cappadocia","025393":"Casa Blanca Townhouses","09493":"Casa Royale","02709":"Celestica","02631":"Centre Court","09596":"Condor Castle Building","012632":"Dana","06083":"Dana Tower","02595":"Desert Rose","03366":"Diamond Arch (all)","02652":"Diamond Arch 1","02653":"Diamond Arch Ii","02654":"Diamond Views","03367":"Diamond Views (all)","02655":"Diamond Views 1","02656":"Diamond Views 2","02657":"Diamond Views 3","02658":"Diamond Views 4","02659":"Diamond Views 5","05922":"District 10","05923":"District 11","05924":"District 12","05925":"District 13","05926":"District 14","05927":"District 15","05928":"District 16","05929":"District 17","05930":"District 18","05931":"District 19","05932":"District 20","05933":"District 21","05934":"District 22","05935":"District 23","05936":"District 24","05937":"District 25","05938":"District 26","05939":"District 27","05940":"District 28","05941":"District 29","05915":"District 3","05942":"District 30","05916":"District 4","05917":"District 5","05918":"District 6","05919":"District 7","05920":"District 8","05921":"District 9","02660":"Dorna","02596":"Dunes","02661":"Eclipse","02632":"Eden Residence 2","02710":"El Matador","06853":"Emirates Garden 1","06856":"Emirates Garden 2","02662":"Emirates Gardens","02663":"Excellence Residence","02711":"Fairway Heights","025668":"Florence 2","02597":"Fortunato","02664":"Garden Heights","02598":"Gardenia","06417":"Gardenia 1","06420":"Gardenia 2","02599":"German Supreme","08319":"Ghalia Constella","02665":"Global Royal","02600":"Golden Heights","09548":"Grand Paradis I","09452":"Grand Paradis II","02601":"Green Court","09062":"Habitat","06288":"Hanover Square","02699":"Heights Golden","025336":"Hyati Residence","012473":"Hydra Twin","07075":"Hydra Twin Towers","012476":"Imperial Residence","02603":"Indigo Ville","07744":"Indigo Ville 1","07747":"Indigo Ville 2","07750":"Indigo Ville 3","07753":"Indigo Ville 4","07756":"Indigo Ville 5","07759":"Indigo Ville 6","07762":"Indigo Ville 7","07765":"Indigo Ville 8","08579":"Inner Circle","06501":"Iris Park","03368":"Jehaan (all)","02666":"Jehaan Residence 2","02667":"Jehaan Residence 3","02668":"Jehaan Residence 9","02669":"Jehaan Residences","03369":"Jouri (all)","02633":"Jouri 1","02634":"Jouri 2","02635":"Jouri 3","02636":"Jouri 4","02637":"Jouri 5","02638":"Jouri 6","02639":"Jouri Residence","03370":"Judi Palace (all)","02640":"Judi Palace A","02641":"Judi Palace B","02604":"Jumeirah Suites","05768":"Jumeirah Village (all)","025546":"Jumeirah Village Circle Villas","03440":"Jumeirah Village Triangle  (all)","012689":"Jumeirah Wave","02670":"Jumeirah Wave Tower","05786":"Kensington Manor","02642":"Knightsbridge Court","02643":"La Riviera Estate","05872":"Las Casas","03093":"Lavander","025618":"Lavender 1","025621":"Lavender 2","03232":"Lawns (all)","02700":"Lawns 1","02701":"Lawns 2","02702":"Lawns 3","02703":"Lawns 5","02605":"Le Grand Chateau","03094":"Le Residence","02671":"Les Maisonettes","09707":"Lilac Park","06549":"Lolena Residence","05873":"Lootah Development","05997":"Lotus Park","02606":"Magnolia 1","025300":"Magnolia 2","02607":"Maimoon Twin","02672":"Mak Star","025704":"Mangolia 1","025707":"Mangolia 2","02704":"Manhattan","02673":"Maple 1","025624":"Maple 2","07720":"Marwa Homes","06759":"Masaar Residence","02712":"Mediterranean Type","02608":"Melissa Residence","02674":"Metropolis Lofts","02675":"Mirabella","06868":"Mirabella 1","06871":"Mirabella 2","06874":"Mirabella 3","06877":"Mirabella 4","06880":"Mirabella 5","06883":"Mirabella 6","06886":"Mirabella 7","02610":"Mirage Residence","07054":"Monte Carlo","02611":"Mosaic","05975":"Mulberry 1","05976":"Mulberry 2","02612":"Mulberry Mansion","06041":"Mulberry Park","06699":"Nakheel Townhouses","07519":"Nakheel Villas","02613":"Noora Residence","02614":"Olgana Residence","02615":"Orchid","08324":"Oudah Tower","09400":"Outer Circle","07138":"Pacific Wave Residence","06597":"Park Corner","02676":"Park View","07291":"Park Villas","02645":"Parkvale Residences","02677":"Pisa Residence","02622":"Plaza","02678":"Plaza Residences","012713":"Plaza Residential","02679":"Prime Business Centre","02680":"Prudential","02681":"Quattro","02682":"Quattro Hotel & Business Park","02683":"R&r","08558":"Reef Residence","03095":"Reflections","03371":"Reliance (all)","02684":"Reliance 12","02685":"Reliance 2","02686":"Reliance 6","02687":"Reliance 7","02688":"Reliance 8","02689":"Rigel","06471":"Rose 1","06474":"Rose 2","02690":"Rose Garden","02616":"Rotating","02617":"Rufi Downtown","02691":"Rufi Lake View","02692":"Sahara","02693":"Sandoval Gardens","09304":"Sandoval Lane","02644":"Sariin","02618":"Seasons Community","02694":"Serena 2","02619":"Serena Residence","02695":"Serenity Lakes","05888":"Shamal Terraces","025239":"Signature Villas","02620":"Silver Heights","03372":"Silver Stallion (all)","02713":"Silver Stallion S 1","02714":"Silver Stallion S 2","012434":"Silvertallion","02696":"Sobha Daffodil","012608":"Soraya 1","07078":"Soraya Tower","07609":"Spring","07099":"Suites In The Skai","07606":"Summer","02697":"Sunrise Gardens","02698":"Sunset Gardens","02705":"Tulip Park","02706":"Tuscan Residences","02707":"U","02623":"Valencia Park","06777":"Vantage","025242":"Viceroy JV","06796":"Villa Myra","06799":"Villa Pera","012539":"Wave Business","02624":"West End","02625":"Westar La Residencia Del Sol","06790":"Westar Les Castelets","06793":"Westar Les Maisonettes","07600":"Westar Terrace Garden","07603":"Winter","07141":"Zaya Hameni"},"79":{"03110":"@1","03119":"@10","03120":"@11","03121":"@12","03122":"@13","03123":"@14","03111":"@2","03112":"@3","03113":"@4","03114":"@5","03115":"@6","03116":"@7","03117":"@8","03118":"@9"},"3554":{"08650":"A Sana 2","05646":"Al Bandar","04345":"Al Barza","04348":"Al Dana","06919":"Al Hadeel","04349":"Al Lissaily","022943":"Al Maha","04350":"Al Maha (All)","08773":"Al Maha 1","08776":"Al Maha 2","04346":"Al Manara","05638":"Al Muneera","04351":"Al Muneera Townhouses-Island","04352":"Al Muneera Townhouses-Mainland","022934":"Al Nada","04353":"Al Nada (All)","08653":"Al Nada 1","07357":"Al Nada 2","022952":"Al Naseem","04347":"Al Naseem Residences A","08659":"Al Naseem Residences B","08662":"Al Naseem Residences C","06079":"Al Rahba (All)","05659":"Al Rahba 1","05660":"Al Rahba 2","04355":"Al Razeen","04356":"Al Rumaila","022931":"Al Sana","04354":"Al Sana 1","08881":"Al Sana 2","04357":"Al Seef","04358":"Al Shaleela","04359":"Al Thurayya","04360":"Al Zahiya","04926":"Al Zeina","09154":"Al Zeina - Residential Tower A","09157":"Al Zeina - Residential Tower B","09160":"Al Zeina - Residential Tower C","09163":"Al Zeina - Residential Tower D","09166":"Al Zeina - Residential Tower E","09169":"Al Zeina - Residential Tower F","08674":"Al Zeina Beachfront Villa","08668":"Al Zeina Podium Villas","08671":"Al Zeina Sky Villas","08665":"Al Zeina Townhouses","09542":"Al Zeina Villas","04361":"Beach Villas","04362":"Building A","08794":"Building A1","08797":"Building A2","04363":"Building B","08800":"Building B1","08803":"Building B2","04364":"Building C","08806":"Building C1","08809":"Building C2","04365":"Building D","08884":"Building D3","04366":"Building E","08812":"Building E1","08815":"Building E2","08818":"Building E3","04367":"Building F","04368":"Building G","04369":"Khor Al Raha","04370":"Mira Residence 1","04371":"Mira Residence 2","04372":"Mira Residence 3","04373":"Mira Residence 4"},"33":{"09172":"A Villas","05876":"Abidos Hotel","016607":"Acacia","015161":"Aegean Villa","03059":"Aegean Villa North","09599":"Aegean Villa South","02106":"Ajmal Sarah","06219":"Al Baraha","015683":"Al Barari (all)","010715":"Al Mazaya Villas","06390":"Al Rabia","07594":"Al Ramth","07597":"Al Thammam","07837":"Al Thammam 16","07834":"Al Thammam 61","03173":"Al Waha Villas","07867":"Aladdin Tower","09742":"Aldea","07864":"Ali Baba Tower","02377":"Almasah","02378":"Andalusia North","09602":"Andalusia South","010721":"Andalusian Villa","09465":"Arabella Townhouses","02109":"Arabian Crown","03061":"Aralia","02110":"Arjan","02111":"Asmaran","09175":"B Villas","02112":"Bawadi","02113":"Bellagio","02114":"Berlin Business","015686":"Bromellia","03460":"Butonia","09178":"C Villas","07861":"Caesar Tower","015689":"Camellia","02115":"Cassia Park","02116":"Cinderella","025656":"City Of Arabia","02117":"Cleopatra","03055":"Cordoba","09181":"D Villas","017408":"Dahlia","02118":"Desert Sun","03152":"Detroit Office","02119":"Diamond Business Center","07555":"Dubai LifeStyle City","07543":"Dubai Taj Mahal","06276":"Dubailand Residence Complex","02120":"Durar Residence Complex","07870":"Eye Park Tower 1","07873":"Eye Park Tower 2","07876":"Eye Park Tower 3","07879":"Eye Park Tower 4","07882":"Eye Park Tower 5","07885":"Eye Park Tower 6","03334":"Falcon City (all)","07552":"Falcon City Villas","02010":"G Office","02121":"Golf City","06486":"Granada","03056":"Grenada","07546":"Hanging Gardens Of Babylon","025267":"Hercules","02011":"I & M","05875":"Indigo Valley","015692":"Jasmine","06859":"La Fontana","025719":"Layan Community","02132":"Layan Villa","015695":"Leaf 16","015698":"Leaf 22","015701":"Leaf 28","02122":"Legends","02123":"Lime Tree Valley","06058":"Lincoln Park","06116":"Living Legends","02124":"Liwan","06345":"Madison Residences","05887":"Majan","02379":"Mallorca","02125":"Marbella","07858":"Marco Polo","03506":"Maysan 1","03507":"Maysan 2","03508":"Maysan 3","02107":"Mazaya","02012":"Metro","02126":"Mizin","05968":"Mudon","025270":"Napoleon","09608":"New World South","010787":"New World Villa","03510":"New World Villa North","07840":"Pacific Village","02134":"Palmarosa","010790":"Park Avenue Residence","03058":"Phoenix","07069":"Platinum One","09495":"Ponderosa","07849":"Quantum Business Tower","025279":"Queen Sheba","02128":"Queue Point","07843":"Rahat Villas","025276":"Rapunzel","02129":"Remraam","03516":"Sanali","07831":"Sanali Flamingo","010799":"Sanali I","03517":"Sanali Iconic","07828":"Sanali Quantum","09605":"Santa Fe South","015167":"Santa Fe Villa","03060":"Santa Fe Villa Northa","02130":"Sebco Residences","025273":"Shakespeare","07627":"Siena Villa Drappo","025264":"Sinbad","07855":"Sindbad Tower","02131":"Siraj","015131":"Skycourt","07630":"Skycourt Towers","07612":"Skycourt Towers A","07615":"Skycourt Towers B","07618":"Skycourt Towers C","07621":"Skycourt Towers D","07624":"Skycourt Towers E","03519":"Skycourt Towers F","07852":"Snow White Tower","06076":"Solitaire Cascades","07846":"Sunrise Villas","02133":"Teema","025157":"The Centro","05767":"The Reserve","06531":"The Sustainable City","03204":"The Villa (all)","08608":"The Villa C1","07549":"Town Of Venice","09026":"Town Square","07825":"Townhouses Community","03054":"Valencia","02013":"Wadi Walk","02135":"Windsor","02014":"Wings Of Arabia","09424":"Zahra By Nshama","08384":"Zen By Indigo","08387":"Zen By Indigo - Aura","08390":"Zen By Indigo - Bliss","08393":"Zen By Indigo - Eternity","09418":"Zen By Indigo - Harmony","08396":"Zen By Indigo - Heaven","08399":"Zen By Indigo - Nirvana","08402":"Zen By Indigo - Serene","03530":"Zenith Twin Tower"},"6036":{"06195":"A1 Tower","06273":"A2 Tower","06282":"C1 Tower","06285":"C2 Tower","06037":"The Hills","06399":"Vida B1","06402":"Vida B2","06805":"Vida Hotel","06294":"VIDA Residence"},"47":{"025133":"Abbey Crescent","08181":"Apex Atrium","07216":"Barton House 1","07213":"Barton House 2","03350":"Bennett House (all)","02730":"Bennett House 1","02731":"Bennett House 2","08145":"Bungalow Area-motor City","03351":"Claverton House (all)","02732":"Claverton House 1","02733":"Claverton House 2","02734":"Control","07303":"Daytona House","02735":"Detroit House","03352":"Dickens Circus (all)","02736":"Dickens Circus 1","02737":"Dickens Circus 2","02738":"Dickens Circus 3","02739":"Dickens House","02740":"East Lands Park","025142":"Easton Court","08163":"Family Villa","03353":"Fox Hill (all)","02741":"Fox Hill 1","02742":"Fox Hill 2","02743":"Fox Hill 3","02744":"Fox Hill 4","02745":"Fox Hill 5","02746":"Fox Hill 6","02747":"Fox Hill 7","02748":"Fox Hill 8","02749":"Fox Hill 9","09142":"Grandstand 1","03073":"Green Community","08157":"Luxury Villa","03354":"Marlowe House (all)","02750":"Marlowe House 1","02751":"Marlowe House 2","06231":"New Bridge Hills","06234":"New Bridge Hills 1","06237":"New Bridge Hills 2","06240":"New Bridge Hills 3","06243":"New Bridge Hills 4","03233":"Norton Court (all)","02752":"Norton Court 1","02753":"Norton Court 2","02754":"Norton Court 3","02755":"Norton Court 4","03355":"Regent House (all)","02756":"Regent House 1","02757":"Regent House 2","03441":"Shakespeare Circus (all)","03188":"Shakespeare Circus 1","03189":"Shakespeare Circus 2","03190":"Shakespeare Circus 3","015341":"Sherlock Circus (all)","02758":"Sherlock Circus 1","02759":"Sherlock Circus 2","02760":"Sherlock Circus 3","02761":"Sherlock Court","02762":"Sherlock House","03357":"Sherlock House (all)","02763":"Sherlock House 1","02764":"Sherlock House 2","02765":"Sherlock House 3","08154":"Terraced Apartments","08151":"Townhouses","02766":"Uptown Motorcity","025136":"Weston Court","03358":"Widcombe House (all)","02767":"Widcombe House 1","02768":"Widcombe House 2","02769":"Widcombe House 3","02770":"Widcombe House 4","07237":"Windsor Crescent"},"44":{"025552":"Abu Baker Al Siddique Road","06552":"Abu Hail","025218":"Airport Free Zone","03068":"Airport Road Building","02086":"Al Badia Oasis","02087":"Al Badia Residences","02088":"Al Badia Village","06312":"Al Baraha","02029":"Al Buteen Plaza","03069":"Al Fattan Plaza","03070":"Al Jawhara","05797":"Al Khabisi","02030":"Al Maktoum Road","03453":"Al Meraikhi","02031":"Al Muraqqabat","09139":"Al Murar","01856":"Al Quds Street","01857":"Al Qusais 1","01858":"Al Qusais 2","01859":"Al Qusais Industrial Area","02032":"Al Ras","03134":"Al Ras Building","02033":"Al Reqqa Street","09076":"Al Sabkha","025477":"Al Serkal Building","05947":"Al Shoala Building","08330":"Alliance Business Centre","01860":"Amman Street","01861":"Baghdad Street","05798":"Baniyas Road","01862":"Beirout Street","09376":"Capital Tower","06357":"Centurion Star Tower","025423":"Creekside Residence","05728":"Deira Commercial Building","08010":"Deira Islands","02034":"Emaar","025510":"Emaar Tower A","07354":"Emaar Tower B","01863":"Emirates Stars","06054":"ETA Star House","09455":"Fish Round About","08555":"Galadari Plaza","05727":"Gold Land Building","09322":"Gold Souq","03489":"Green Tower","03071":"Hor Al Anz","02089":"Marsa Plaza","03509":"Muhaisnah","09068":"Murshid Bazar","03154":"Nadd Shamma","02035":"Naif","03072":"Old Labour Office","09824":"Omniyat Square","02036":"Port Saeed","01864":"Rainbow Residence","08561":"Rigga Road","07540":"Riggat Al Buteen","08552":"Salah Al Din Street","09295":"Taj Palace Hotel","08546":"The Galleria Residence","05729":"The Square","02380":"Transemirates Building","02037":"Twin"},"3595":{"06564":"Abu Dhabi Golf Club","022232":"Sas Al Nakheel","04587":"Sas Al Nakhl"},"3590":{"04570":"Abu Dhabi Unversity Tower","09100":"Al Diar Palm Hotel Apartments","04571":"Al Falah Tower","025752":"Al Maqtaa 1","05943":"Al Murjan Tower","025725":"Al Muroor Tower","04565":"Al Nedal Tower","025161":"Al Rayhan Villas","04572":"Barclays Tower A","06970":"Burooj Bin Ahmed","04566":"Chain Tower","06841":"Dusit Thani","025785":"Emirates Compound","04573":"Guardian Tower","04567":"Habib Bank Tower","04564":"Hadbat Al Zafranah","04568":"Mafco Building","025294":"MBH Building","08440":"Muroor Area","08441":"Muroor Villas","04569":"Twin Tower","08543":"Vision Links Hotel Apartment"},"16":{"02813":"Abu Keibal","02815":"Al Anbara","02816":"Al Basri","02817":"Al Dabas","03163":"Al Das","02818":"Al Farood","02819":"Al Fattan Palm Resort","02820":"Al Habool","02814":"Al Hallawi","02821":"Al Hamri","02822":"Al Haseer","02823":"Al Hatimi","02824":"Al Khudrawi","02825":"Al Khushkar","02826":"Al Msalli","02827":"Al Nabat","013172":"Al Sarood","02828":"Al Sarrood","02829":"Al Sedaifa District","02830":"Al Sefri","02831":"Al Shahla","02832":"Al Sultana","02833":"Al Tamr","06372":"Anantara North Residence","06049":"Anantara Residences","06369":"Anantara South Residence","02834":"Ashoka Villas","06780":"Atlantis The Palm","07633":"Azure Residences","02835":"Balqis Residence","02836":"Canal Cove","05818":"Canal Cove Frond A","05819":"Canal Cove Frond B","05820":"Canal Cove Frond C","05821":"Canal Cove Frond D","05822":"Canal Cove Frond E","05823":"Canal Cove Frond F","05824":"Canal Cove Frond G","05825":"Canal Cove Frond H","05826":"Canal Cove Frond I","05827":"Canal Cove Frond J","05828":"Canal Cove Frond K","05829":"Canal Cove Frond L","05830":"Canal Cove Frond M","05831":"Canal Cove Frond N","05832":"Canal Cove Frond O","05833":"Canal Cove Frond P","02838":"Central Rotunda","05960":"Club Vista Mare","025462":"Delano Dubai","05965":"Dream Palm Residence","09280":"Dukes Oceana","02839":"Emerald Palace","03236":"Fairmont Residence (all)","02991":"Fairmont Residence North","02992":"Fairmont Residence South","013211":"Frond A","013214":"Frond B","013217":"Frond C","013220":"Frond D","013223":"Frond E","013226":"Frond F","013229":"Frond K","013232":"Frond L","013235":"Frond M","013238":"Frond O","013241":"Frond P","03235":"Frond Villas (all)","013244":"Garden Homes","02851":"Garden Homes (all)","05834":"Garden Homes Frond A","05835":"Garden Homes Frond B","05836":"Garden Homes Frond C","05837":"Garden Homes Frond D","05838":"Garden Homes Frond E","05839":"Garden Homes Frond F","05840":"Garden Homes Frond G","05841":"Garden Homes Frond H","05842":"Garden Homes Frond I","05843":"Garden Homes Frond J","05844":"Garden Homes Frond K","05845":"Garden Homes Frond L","05846":"Garden Homes Frond M","05847":"Garden Homes Frond N","05848":"Garden Homes Frond O","05849":"Garden Homes Frond P","03237":"Golden Mile (all)","02975":"Golden Mile 1","02984":"Golden Mile 10","02976":"Golden Mile 2","02977":"Golden Mile 3","02978":"Golden Mile 4","02979":"Golden Mile 5","02980":"Golden Mile 6","02981":"Golden Mile 7","02982":"Golden Mile 8","02983":"Golden Mile 9","05708":"Grandeur Maurya Residence","05707":"Grandeur Mughal Residence","02852":"Grandeur Residence","02853":"Jash Falqa","05640":"Jash Hamad","05884":"Jumeirah Zabeel Saray","03277":"Kempinski (all)","02854":"Kempinski Hotel Emerald Palace","02855":"Kempinski Palm Residence","03238":"Kingdom Of Sheba (all)","03239":"Marina Residence (all)","02985":"Marina Residence 1","02986":"Marina Residence 2","02987":"Marina Residence 3","02988":"Marina Residence 4","02989":"Marina Residence 5","02990":"Marina Residence 6","09584":"Muraba Residences","013274":"Nabat","03278":"Oceana (all)","02858":"Oceana Adriatic","02859":"Oceana Aegean","02860":"Oceana Atlantic","02861":"Oceana Baltic","02837":"Oceana Caribbean","02862":"Oceana Pacific","02857":"Oceana Southern","02863":"Palm Terrace","08298":"Palm Tower","05648":"Palm Views","07276":"Palm Views East","07273":"Palm Views West","05649":"Palma Residences","09530":"Serenia Residences","025399":"Serenia Residences East","025396":"Serenia Residences North","025402":"Serenia Residences West","03241":"Shoreline Apartments (all)","013301":"Signature Villas","02864":"Signature Villas (all)","05850":"Signature Villas Frond A","05851":"Signature Villas Frond B","05852":"Signature Villas Frond C","05853":"Signature Villas Frond D","05854":"Signature Villas Frond E","05855":"Signature Villas Frond F","05856":"Signature Villas Frond G","05857":"Signature Villas Frond H","05858":"Signature Villas Frond I","05859":"Signature Villas Frond J","05860":"Signature Villas Frond K","05861":"Signature Villas Frond L","05862":"Signature Villas Frond M","05863":"Signature Villas Frond N","05864":"Signature Villas Frond O","05865":"Signature Villas Frond P","06534":"Sofitel Dubai The Palm","03280":"Taj (all)","02865":"Taj Exotica Resort&spa","02866":"Taj Grandeur Residences","06672":"The 8","06786":"The Crescent","09551":"The One","06591":"The Palm Tower Residences","03279":"Tiara (all)","02973":"Tiara Amber","02968":"Tiara Aquamarine","02969":"Tiara Diamond","02971":"Tiara Emerald","02868":"Tiara Hotel","02970":"Tiara Ruby","02974":"Tiara Sapphire","02972":"Tiara Tanzanite","08890":"Viceroy Beach Villas","05966":"Viceroy Hotel","08887":"Viceroy Residence"},"70":{"03101":"Abyaar Business Center","015641":"Annex Warehouse","08116":"Ava Residences","025245":"Centurion Residences","02090":"Dubai Lagoon","02091":"Dunes Village","02092":"European Business Center","02093":"Ewan Residence","02094":"Falcon House","02095":"Gateways Apartments","03102":"Grand Stores Warehouses","06414":"Laguna Centrale","05752":"Lake Apartments","08614":"Lily Residences","09501":"Lotus Residence","07591":"North West Apartment","02099":"Palisades","05881":"Phase 1","05882":"Phase 2","02096":"Regent Business Park","02097":"Ritaj","09503":"Rowan Residence","07393":"Royal Estates","02098":"Schon Business Park","09505":"Winterberry Residence"},"1822":{"04654":"Acacia","04652":"Ajman Boulevard","022034":"Ajman One","04653":"Ajman One Tower 1","08375":"Ajman One Tower 10","08378":"Ajman One Tower 11","08381":"Ajman One Tower 12","08351":"Ajman One Tower 2","08354":"Ajman One Tower 3","08357":"Ajman One Tower 4","08360":"Ajman One Tower 5","08363":"Ajman One Tower 6","08366":"Ajman One Tower 7","08369":"Ajman One Tower 8","08372":"Ajman One Tower 9","07390":"Aqaar","04655":"Begonia","04656":"Camellia","06615":"Dahlia","04657":"Erica","04658":"Escape Villas","08600":"Jatropha","06507":"Kentia","06504":"VIP Villa"},"5981":{"07042":"Acacia","05982":"Al Barari Villas","06823":"Ashjar","07045":"Bromellia","07048":"Camellia","07051":"Dahlia","09136":"Desert Leaf 5","025516":"Jasmin Leaf 1","025513":"Jasmin Leaf 3","025519":"Jasmin Leaf 8","025522":"Jasmin Leaf 9","05983":"Jasmine Leaf","06432":"Seventh Heaven","09029":"Silk 4","09091":"The Nest","06826":"The Reserve","06829":"Wadi Al Safa"},"30":{"015059":"Acacia Avenues","03142":"Al Fattan Villa","09313":"City Walk","07783":"Island 2","02483":"Jumeirah 1","02484":"Jumeirah 2","02485":"Jumeirah 3","09118":"Jumeirah Bay Island","02486":"Mms","08830":"Redwood Park","02487":"Safa","03141":"Splendour Villas","05891":"Sunset Mall","08101":"The Village"},"5773":{"03045":"Acacia Avenues","06147":"AK Residence","08617":"Al Bahia 2","05774":"Al Sufouh 1","05775":"Al Sufouh 2","05999":"Hilliana Tower","08169":"J Five","08049":"J5","06423":"Olgana Tower"},"8779":{"09214":"Acacia Park Heights","09124":"Dubai Hills Grove","09127":"Dubai Hills View","09757":"Fairways","09539":"Maple","06555":"Mulberry At Park Heights","025465":"Parkways"},"3541":{"07926":"AD One Tower","023081":"Al Karama","04304":"Al Karamah"},"3594":{"04585":"ADCP Building","025303":"Al Seef Village Mall","025773":"Andalus Al Seef Resort & Spa","04586":"Bloom Gardens","09799":"Nowailey Building","08492":"Salam HQ"},"52":{"017489":"Adnec Area","015467":"Airport Road","015470":"Al Aryam","015473":"Al Barza","017336":"Al Hosn","015479":"Al Maha","017327":"Al Markaz","015482":"Al Mina","017330":"Al Muneera","017342":"Al Nahyan","016841":"Al Raha","015485":"Al Reef Villas","016628":"Al Reem","017339":"Al Rehhan","015488":"Arabian Village","016490":"Capital Plaza","015491":"Corniche","015494":"Delma Street","015503":"Hamdan Street","015506":"Khalidia","015512":"Khalifa City (all)","015509":"Khalifa City A","017348":"Khalifa City B","017354":"Khalifa City C","015527":"Mbz","015476":"Musaffah Industrial Area","017351":"New Khalifa City","015518":"Officers City","015521":"Silver Wave","015524":"Sky"},"1791":{"09394":"Afamia Tower","06082":"Al Mahatah","04877":"Lotus Tower","04878":"Sunlight Tower"},"71":{"09818":"Afnan Square","09821":"Ayka Square","023810":"Omniyat Square","023807":"Square"},"22":{"02537":"Ag","02538":"Al Saqran","03297":"Al Seef (all)","02539":"Al Seef 1","02540":"Al Seef 2","02541":"Al Seef 3","02542":"Al Shera","02543":"Al Waleed Paradise","02544":"Almas","02535":"Arch","03298":"Armada (all)","03457":"Armada 1","03458":"Armada 2","03459":"Armada 3","02545":"Au","06429":"Bobyan Tower","02546":"Bonnington","02547":"Concorde","02548":"Corporate","02549":"Dome","02550":"Dubai Arch","03224":"Dubai Gate (all)","02551":"Dubai Gate 1","02552":"Dubai Gate 2","02553":"Dubai Star","09751":"Fancy Rose","09754":"Fancy Rose Apartment Building","02554":"Fortune Executive","02555":"Fortune Tower","02556":"Global Lake View","06952":"Gold Tower","02557":"Goldcrest Executive","03225":"Goldcrest Views (all)","02558":"Goldcrest Views 1","02559":"Goldcrest Views 2","03226":"Green Lakes (all)","03486":"Green Lakes 1","03487":"Green Lakes 2","03488":"Green Lakes 3","02561":"Hds","02560":"Hds Business Centre","03231":"Icon (all)","03492":"Icon 1","03493":"Icon 2","02562":"Indigo","05907":"Indigo Icon","06159":"J2 Tower","06072":"Jewellery And Gemplex","03227":"Jumeirah Bay (all)","014399":"Jumeirah Bay 1","014396":"Jumeirah Bay 2","014402":"Jumeirah Bay 3","02583":"Jumeirah Bay X1","02584":"Jumeirah Bay X2","025755":"Jumeirah Bay X2","03151":"Jumeirah Bay X3","025758":"Jumeirah Bay X3","03228":"Jumeirah Business Center (all)","03495":"Jumeirah Business Center 1","03496":"Jumeirah Business Center 2","03497":"Jumeirah Business Center 3","03498":"Jumeirah Business Center 4","03499":"Jumeirah Business Center 5","02536":"Lago Vista","02563":"Laguna","06609":"Laguna Movenpick","03500":"Lake City","02564":"Lake Point","02565":"Lake Shore","02566":"Lake Terrace","02567":"Lake View","02568":"Lakeside Residence","02569":"Liwa Heights","02570":"Madina","02571":"Mag 214","03223":"Mazaya Business Avenue (all)","021365":"Mazaya Business Avenue 1","021368":"Mazaya Business Avenue 2","021371":"Mazaya Business Avenue 3","03185":"Mazaya Business Avenue AA1","03186":"Mazaya Business Avenue BB1","03187":"Mazaya Business Avenue BB2","02572":"O2","08929":"One JLT","02573":"One Lake Plaza","02574":"Palladium","02575":"Platinum","09065":"Pullman Jumeirah Lakes Towers Hotel And Residence","06026":"Red Diamond","02576":"Reef","03299":"Saba (all)","03513":"Saba 1","03514":"Saba 2","03515":"Saba 3","06955":"Silver Tower","02577":"Swiss","02578":"Tamweel","02579":"Tiffany","03302":"V (all)","02580":"V1","02581":"V3","02582":"Vista Del Lago","05747":"Vue De Lac","03300":"Wind (all)","03527":"Wind 1","03528":"Wind 2","014390":"X (all)"},"13":{"09629":"AG Tower","07321":"Al Boraq","01907":"Al Manara","06612":"Al Shafar Building","06958":"Allure Company","01908":"Aspect","07252":"ATRIA","01909":"B2b","08972":"Bareeq Tower","01996":"Bay Gate","01910":"Bay Residence","01911":"Bay Square","06702":"Bay Square Building 1","06729":"Bay Square Building 10","06732":"Bay Square Building 11","06735":"Bay Square Building 12","06738":"Bay Square Building 13","06705":"Bay Square Building 2","06708":"Bay Square Building 3","06711":"Bay Square Building 4","06714":"Bay Square Building 5","06717":"Bay Square Building 6","06720":"Bay Square Building 7","06723":"Bay Square Building 8","06726":"Bay Square Building 9","09256":"Bays Edge","01912":"Bayswater","025779":"Belhabb Tower","01913":"Binary","05883":"Blue Bay Tower","01914":"Boris Becker Business","010055":"Bristol","08966":"Bristol Tower 1","01915":"Bristol Tower 2","01916":"Burj Al Alam","010061":"Burj Al Nujoom","06808":"Burj Damac 4","06039":"Burj Damac 5","07324":"Burj Damac 6","05762":"Burj Pacific","01918":"Burlington","01919":"Business","05998":"Business Central","05945":"Business Resident Centre","01920":"Canada Business Centre","01921":"Capital Bay","09716":"Capital Bay Hotel Apartments","07636":"Capital Bay Tower 1","07639":"Capital Bay Tower 2","09002":"Capital Bay Tower A","09005":"Capital Bay Tower B","09008":"Capital Bay Tower C","05726":"Capital Golden","01922":"Centre Boulevard","01923":"Churchill Executive","01924":"Churchill Residency","01925":"Citadel","01926":"Clayton Residency","01927":"Clover","03138":"Commercial Villa","01997":"Corner","01928":"Corporate Bay","01929":"Court","01930":"Crystal","05909":"Damac Business Tower","08594":"Damac Maison Canal Views","08591":"Damac Maison Cour Jardin","06411":"Damac Towers","07375":"Damac Towers By Paramount","07327":"Dancing Towers","08996":"Danish Tower","01931":"Dec Business","01932":"Desert Dream","01933":"Dream Bay","01934":"Elite","07330":"Emirates Park Tower 1","07333":"Emirates Park Tower 2","01935":"Empire Heights","07995":"ENI Coral Tower","03130":"Escape Tower","08947":"Eve's Tower","01936":"Exchange","03474":"Executive","03249":"Executive (all)","01940":"Executive A","01941":"Executive B","01937":"Executive Bay","01942":"Executive C","01943":"Executive D","01944":"Executive E","01945":"Executive F","03475":"Executive G","01946":"Executive H","01938":"Executive Hotel & Office","01947":"Executive I","01948":"Executive J","01949":"Executive K","01950":"Executive L","01951":"Executive M","01939":"Executive Suites","09343":"Executive Tower A","09340":"Executive Tower B","09346":"Executive Tower C","09349":"Executive Tower D","09352":"Executive Tower E","09355":"Executive Tower F","09358":"Executive Tower G","09361":"Executive Tower H","09364":"Executive Tower I","09367":"Executive Tower J","09370":"Executive Tower K","09373":"Executive Tower L","09334":"Executive Tower M","09337":"Executive Towers","03476":"Executive Villas","01952":"Fairview Residency","08483":"Falcon Tower","01953":"Fgb","01954":"Fifty One","06210":"Fifty One Tower","01955":"Fortune Avenue","01956":"Fortune Bay","01998":"Forum","01957":"Gemini","08949":"Global Bay View","01958":"Green Emirates","01959":"Grosvenor","01960":"Hamilton","01961":"Haz","03491":"Hydra","07780":"International Business Tower","01962":"Iris Bay","01963":"Iris Crystal","01964":"Jumeirah Wave Business","06059":"La Residence Tower 1","07336":"La Residence Tower 2","01965":"Lake Central","01999":"Lotus","03502":"Lotus Residence A","03503":"Lotus Residence B","09041":"Majestine Allure","05731":"Manazel Al Safa","01966":"Matex","01967":"Mayfair","06070":"Mayfair Residency","05985":"MBK Tower","025339":"Merano Tower","01968":"Metropolis","01970":"Michael Schumacher","01969":"Michael Schumacher Business Avenue","09023":"Millennium Tower (Bright Start Tower)","010247":"Moon","01971":"Moon Tower","07339":"Nadra Tower","025480":"NAIA Breeze","01972":"Niki Lauda","02952":"O 14","08975":"O14","05961":"Oberoi Tower","01973":"Octavian","06024":"Omniyat Tower","01974":"One Business Bay","01975":"Ontario","01976":"Opal","01977":"Opus","01978":"Oval","01979":"Oxford","010205":"Pad","07525":"Paramount Hotel & Residences","06654":"Paramount Tower","07903":"Paramount Tower 1","07906":"Paramount Tower 2","07909":"Paramount Tower 3","01980":"Park Central","01981":"Park Lane","09590":"Park Regis","02001":"Peninsula","01982":"Platinum","06117":"Plaza Boutique","01983":"Polaris","08978":"Porsche Design Towers","01984":"Prime","02002":"Prism","06922":"Prive","05686":"Radisson Blu Hotel","07342":"Rawasi Tower","06031":"RBC Tower","01985":"Regal","08074":"Safeer Tower 1","08077":"Safeer Tower 2","01986":"Sami Business","01987":"Sanctuary","01988":"Santeville","01989":"Scala","03252":"Shobha Ivory (all)","07366":"Signature By Damac","01991":"Silver","025212":"Silver Bay Tower","01990":"Silver Star","025209":"Silver Tower","07348":"Singapore Tower","03518":"Sky","08981":"Sky Tower 1","08984":"Sky Tower 2","01992":"Skyscraper","010214":"Sobha Ivory","03196":"Sobha Ivory (all)","03520":"Sobha Ivory 1","03521":"Sobha Ivory 2","01993":"Sobha Sapphire","010325":"Starhill","03524":"Starhill Towers & Gallery 1","08987":"Starhill Towers & Gallery 2","01994":"Stratos Plaza","08990":"Symphony Tower","01995":"Tamani Art","05755":"Tamani Art Tower","06639":"The Atria","08993":"The Conclave","06015":"The Cosmopolitan","02000":"The Pad","07345":"The Sky Villa","06046":"The Vogue","07522":"Tower 51","016895":"U-bora","03526":"U-bora 1","08247":"U-bora Tower 2","08080":"Ubora Tower 1","08083":"Ubora Tower 2","02003":"Victory Bay","02004":"Vision","025782":"Volante Tower","02005":"Waters Edge","07351":"West Bay Tower","06802":"West Heights","02006":"West Wharf","010367":"Westburry Square","02007":"Westburry Tower 1","025043":"Westburry Tower 2","02008":"Windsor Manor","02009":"Xl"},"1816":{"04616":"Ain Ajman Tower","04617":"Gold Crest Smart Tower"},"4924":{"04925":"Airport Road Area"},"1817":{"04618":"Ajman Corniche Residences"},"1819":{"04647":"Ajman Industrial 1","04648":"Ajman Industrial 2"},"1821":{"04651":"Ajman Meadows"},"1818":{"08632":"Ajman Pearl","04629":"Al Jurf 1","04630":"Al Jurf 2","04631":"Al Jurf 3","04632":"Al Khail Tower 1","04633":"Al Khail Tower 2","04634":"Al Khail Tower 3","04635":"Al Khor Towers","04636":"Al Nakheel","04638":"Al Rashidiya Towers","04619":"Atrium 360","04620":"Falaknaz Pride","04639":"Falcon Tower 1","04640":"Falcon Tower 2","04641":"Falcon Tower 3","04642":"Falcon Tower 4","04643":"Falcon Tower 5","04644":"Falcon Tower 6","04645":"Horizon Towers","04646":"Times Square","04621":"Tower A1","04622":"Tower A2","04623":"Tower A3","04624":"Tower B1","04625":"Tower B2","04626":"Tower B3","04627":"Tower C1","04628":"Tower C2"},"6032":{"06033":"Akoya","07417":"Akoya Park","08456":"Artesia","08459":"Augusta","06034":"Brookfield 1","06035":"Brookfield 2","06100":"Brookfield 3","06089":"Golf Horizon","06090":"Golf Panorama","06838":"Golf Promenade","06092":"Golf Terrace","06084":"Golf Veduta Hotel Apartment","06091":"Golf Vista","06447":"Jasmine A","06630":"Jasmine B","06627":"Long View","07816":"LORETTO A","07819":"LORETTO B","06633":"Orchid A","06636":"Orchid B","06456":"Pelham","06450":"Phoenix","06088":"Picadilly Green","06087":"Queens Meadow","025288":"Richmond","06624":"Rochester","06261":"Rockwood","06040":"Silver Springs","06570":"The Trump Estates","06453":"Trinity","06038":"Trump International Golf Club","06085":"Whitefield"},"7420":{"09446":"Akoya Oxygen","09686":"Odora","09449":"Vista Lux"},"18":{"01893":"Al Abbas Building","03446":"Al Abra Building","025215":"Al Fahidi Street","05764":"Al Jadaf","06053":"Al Kifaf Commercial Building","02715":"Al Majid Building","03171":"Al Mankhool","02716":"Al Masood Building","03454":"Al Mina","07699":"Al Raffa","05724":"Al Raffa Building","01895":"Al Refaa","01896":"Al Sharafi Building","01897":"Al Souk Al Kabeer","05723":"ART Building","06023":"AU Tower","03175":"Bastikya","01898":"Bin Hendi Tower","03013":"Burjuman Business Centre","025558":"BurJuman Residence","02016":"Cascade Manor","02017":"Cascade Ville","03014":"Centrepoint Apartments","02717":"City Apartments","02018":"D1","02811":"Desert Home Residence","02026":"Estate","08095":"Golden Sand Building","02019":"Iris Amber","01899":"Jauaan Salem Building","03172":"Karama","05730":"Karama Gold Building","017504":"Khalid Bin Waleed","03176":"Khalid Bin Waleed Street","09421":"La Maison","025567":"Liwa Building","02020":"Lotus","025561":"Manazel","025573":"Mankhool Road","08122":"Meena Bazar","05725":"Musalla Mall","02021":"Nastaran","02022":"Noor","03157":"Oud Metha","02023":"Palazzo Versace","02015":"Podium","02024":"Rose","01900":"Rose Building","02025":"Santeview","03522":"Spectrum","09827":"Square","025564":"Style Building","03164":"Sultan Business Center","01901":"Sun Shine 4","06022":"The Business Center","02812":"Wafi Residence","02027":"Yas","02028":"Yuvi Residence"},"7297":{"07300":"Al Abbas Building","025597":"Al Attar Centre","025591":"Al Kazim Building","07528":"Al Khaleej Building","025588":"Al Khazna Centre","025603":"Carrera Building","025582":"Green Building","025594":"Karama Centre","08241":"Karama Shopping Center","025600":"Lulu Centre","025579":"Red Building","025585":"Yellow Building"},"1785":{"04860":"Al Ahlam Tower","06603":"Al Canay Building","04861":"Al Nada Tower","04862":"Al Nahda Complex","04863":"Al Zain Tower","04864":"Aliya Tower","025659":"Golden Sands Tower","04865":"Gulf Pearl Tower","04866":"Lootah Tower","04868":"Moon Tower 1","04869":"Moon Tower 2","04867":"Orchid Tower","08465":"Ramada Hotel","08564":"Sahara Tower 1","08570":"Sahara Tower 2","08567":"Sahara Tower 3","08573":"Sahara Tower 4","08576":"Sahara Tower 5","04870":"Sharjah Gate"},"3543":{"04308":"Al Ahlia Tower","04322":"Al Ain Tower","06865":"Al Aryam Tower","04309":"Al Hana Tower","04306":"Al Hosn","04307":"Al Istiqlal Street","04310":"Al Khubairah Tower","04311":"Al Ras Al Akhdar","04323":"Al Safa Tower","04312":"Al Sawari Tower","04313":"Al Waha Tower","04314":"Amwaj Tower","04320":"Crescent Tower 1","04321":"Crescent Tower 2","04315":"First Gulf Bank Building","08899":"Ghanada Tower","04316":"Khalidiya Palace Towers","04324":"Khalidiya Tower","04326":"Khalidiya Tower A","04327":"Khalidiya Tower B","04328":"Khalidiya Village","09796":"Manara Tower","08537":"Mermaid Building","04325":"Montazah Tower","06973":"Nakeel Tower","04317":"Park Tower","09710":"Pearl Plaza Tower","04318":"Sheikha Salama Building","09463":"Shining Tower","04319":"The Crystal Tower"},"3599":{"04603":"Al Ain Industrial Area"},"3606":{"09071":"Al Ain Ladies Club","04611":"Green Land Compound"},"1832":{"04690":"Al Ajyaal Residency","04691":"Al Hambra Towers","04692":"Al Shalal Tower","04693":"Altitude Tower","04694":"Burj Al Furqan","04695":"Chapal The Glory","04696":"Chapal The Harmony","04697":"Chapal The Legacy","04698":"Chapal The Presidency","04699":"Chocolate Tower","04700":"Crimson Court","04701":"Crown Residencia","04702":"Crystal Residency","04724":"Emirates Lake Tower 1","04725":"Emirates Lake Tower 2","04726":"Emirates Pearls","04703":"ETA Star","04704":"Eye Tower","04705":"Fayrooz Tower","04706":"Fifth Avenue Ajman","04707":"Fortune Residency","04727":"Goldcrest Dreams 1","04728":"Goldcrest Dreams 2","04729":"Goldcrest Dreams 3","04730":"Goldcrest Dreams 4","04708":"Golf Tower","04731":"Green Lake Tower 1","04732":"Green Lake Tower 2","04709":"Kahraman Tower","04710":"Lake Signature","04733":"Lake View Tower 1","04734":"Lake View Tower 2","04735":"Lake View Tower 3","04736":"Lake View Tower 4","04711":"Lavender Tower","04712":"Lilies Tower","07735":"Majestic Towers","04713":"Money Tower","04714":"Music Tower","04715":"Orbit Tower","04737":"Paradise Lake Tower","08405":"Paradise Lakes Tower B2","08408":"Paradise Lakes Tower B3","08411":"Paradise Lakes Tower B4","08414":"Paradise Lakes Tower B5","08417":"Paradise Lakes Tower B6","08420":"Paradise Lakes Tower B7","08423":"Paradise Lakes Tower B8","08426":"Paradise Lakes Tower B9","04716":"Pearl Tower","04738":"Rainbow Tower 1","04739":"Rainbow Tower 2","04740":"Rainbow Tower 3","04717":"Rockland Residence","04718":"Royal Oasis","04719":"Sahara Tower","04720":"Savannah Tower","04741":"Shami Tower 1","04742":"Shami Tower 2","04721":"Tawakal Twin Towers","04722":"Unique Tower","04723":"Venice Tower"},"20":{"02389":"Al Alka","02390":"Al Alka 1","02391":"Al Alka 2","02392":"Al Alka 3","07288":"Al Alka 4","02393":"Al Arta","02394":"Al Arta 1","02395":"Al Arta 2","02396":"Al Arta 3","02397":"Al Arta 4","02398":"Al Dhafra","02399":"Al Dhafra 1","02400":"Al Dhafra 2","02401":"Al Dhafra 3","02402":"Al Dhafra 4","07675":"Al Dhafrah 1","07678":"AL Dhafrah 2","07681":"Al Dhafrah 3","07684":"Al Dhafrah 4","02403":"Al Ghaf","02404":"Al Ghaf 1","02405":"Al Ghaf 2","02406":"Al Ghaf 3","02407":"Al Ghaf 4","02408":"Al Ghozlan","02409":"Al Ghozlan 1","02410":"Al Ghozlan 2","02411":"Al Ghozlan 3","02412":"Al Ghozlan 4","02413":"Al Jaz","02414":"Al Jaz 1","02415":"Al Jaz 2","02416":"Al Jaz 3","02417":"Al Jaz 4","03131":"Al Nakheel","02418":"Al Nakheel 1","02419":"Al Nakheel 2","02420":"Al Nakheel 3","02421":"Al Nakheel 4","02422":"Al Samar","02423":"Al Samar 1","02424":"Al Samar 2","02425":"Al Samar 3","02426":"Al Samar 4","02427":"Al Sidir","02428":"Al Sidir 1","02429":"Al Sidir 2","02430":"Al Sidir 3","02431":"Al Sidir 4","05948":"Al Thanyah 3","02432":"Al Thayal","02433":"Al Thayal 1","02434":"Al Thayal 2","02435":"Al Thayal 3","02436":"Al Thayal 4","013511":"Arno","013514":"Arno B","02437":"Canal Villas","013517":"Fairways (all)","013520":"Fairways East","013523":"Fairways North","013526":"Fairways West","03243":"Golf (all)","03482":"Golf 1","03483":"Golf 2","03484":"Golf 3","011825":"Golf Villas","03295":"Greens Low Rise (all)","013550":"Links (all)","013541":"Links Canal Apartments","013553":"Links East","011828":"Links Golf Apartment","013556":"Links West","013544":"Mosella Residences","05763":"Skai Residency","013547":"Tanaro","025197":"The Onyx Tower 1","025200":"The Onyx Tower 2","013559":"Travo A","013562":"Travo B","013565":"Turia","02944":"Turia A","02945":"Turia B","013571":"Una","03018":"Views","014642":"Views 1","015941":"Views 2"},"1823":{"04659":"Al Ameera Village"},"42":{"09587":"Al Andalus","02505":"Castellon","02506":"Earth Residences","02507":"Fireside","02508":"Flame Tree Ridge","09440":"Hacienda-Orange Lake","02509":"Juniper Way","05788":"Lime Tree Valley","05789":"Olive Point","02510":"Orange Lake","09434":"Provencal-Orange Lake","08827":"Redwood","08833":"Redwood Avenue","09437":"Riviera-Orange Lake","025384":"Royal Golf Villas","02511":"Sanctuary Falls","02512":"Sienna Lakes","02513":"Sundials","07378":"Tarragona","09443":"Tuscan-Orange Lake","02514":"Valencia Grove","02515":"Whispering Pines","06108":"Wildflower"},"17":{"03447":"Al Ansari","09563":"Al Attar Business Center","01840":"Al Barsha 1","01841":"Al Barsha 2","01842":"Al Barsha 3","07261":"Al Barsha Business Centre","05770":"Al Barsha South","06895":"Al Sayegh Building","01843":"Al Shafar Building","06898":"Al Shaya Building","05967":"API Business Suites","05803":"Auris Metro Central","05721":"Barsha  Valley","08092":"Barsha Business Square","05722":"Barsha Horizon","025653":"Barsha South Villas","023801":"Barsha Valley","06901":"Bin Khalid Building","06904":"Boutique Hotel Apartments","03471":"Code","05799":"Corp Hotel","02085":"Dubai Biotech","05800":"Dunes Hotel","08680":"Dusseldorf Business Point","07471":"Emerald Building","07477":"Emerald Court","03477":"Faraidooni","03012":"Gold And Diamond Park","07012":"Golden Sands","03128":"Green Barsha Villas","06762":"Hadia Tower","05955":"Heritage Building","06651":"La Fontana Di Trevi","05801":"Marmara","07732":"Montrose","03139":"Murad","025677":"Pinnacle Bldg","08935":"Rasis Business Center","08089":"Sama Building","05984":"The Light Building","08336":"Villa Lantana","08710":"Yes Business Center","05751":"Yes Business Centre","06186":"Zumurud Bldg"},"3629":{"04824":"Al Anwar Tower","09319":"Al Bandary Twin Tower","04825":"Al Burj Tower","04826":"Al Dana Tower","06102":"Al Ghanem Business Centre","04827":"Al Ghazal Tower","04828":"Al Hilal Tower","04829":"Al Kanana Building","04830":"Al Khan Lagoon Tower","09247":"Al Khan Street","04884":"Al Marwa Tower 1","04885":"Al Marwa Tower 2","04886":"Al Marwa Tower 3","04831":"Al Rund Tower","04832":"Al Shahd Tower","04833":"Al Sondos Tower","04839":"Al Taawoon Tower 1","06141":"Al Taawoon Tower 2","04841":"Al Taawoon Tower 3","08229":"Asas Tower","04834":"Beach Tower","06438":"Beach Tower 2","04835":"Beach Towers","04836":"Narjes Tower","04837":"Palm Tower","04842":"Rose Tower 1","04843":"Rose Tower 2","04838":"Style Tower"},"3596":{"04589":"Al Aryam Tower","04590":"Al Ryami Tower","04591":"Banana Building","025737":"Bay View Tower","09578":"Beach Rotana","04592":"Falahi Tower","08951":"Firdous Street","04588":"Mina Road","08531":"Noura Al Futtaim Building","08534":"Sahara Hotel Apartment","08620":"Sahara Hotel Apartment 4"},"28":{"02871":"Al Attar","03043":"Al Attar Business","02870":"Al Attar Commercial","08434":"Al Habtoor Residences","03450":"Al Hawai","06435":"Al Maidoor Building","06222":"Al Manar Tower","025145":"Al Moosa Tower 1","025148":"Al Moosa Tower 2","025432":"Al Murooj Rotana Hotel","06558":"Al Rostamani Tower A","06561":"Al Rostamani Tower B","06071":"Al Safa Tower","08250":"Al Saqr Business Tower","02872":"Al Sondos","03456":"Al Tayer","06228":"API Trio Towers","03174":"Ascott Park Place","03039":"Aspin","07918":"Bldg 2020","05877":"Blue Tower","09719":"Brashy Building","06204":"Burj Al Salam","02873":"Capricorn","03466":"Chelsea","03467":"City 1","03468":"City 2","06588":"Conrad","03140":"Ct","02874":"Damas","09103":"DIFC Trade Centre","06017":"DNI Building","03165":"Dusit Hotel","06925":"DXB Tower","02875":"Emaar Business Park","02876":"Emirates","05878":"Emirates Grand Hotel","08104":"Emirates Tower","02877":"Fairmont Hotel","03041":"Falcon","025630":"Four Points Hotel By Sheraton","03132":"Ghaya Residence","08172":"Grosvenor Commercial Tower","07360":"H Office Tower","05732":"Holiday Centre","03148":"Jumeirah Emirates","06324":"Latifa Tower","02878":"Mall Of Emirates","03149":"Manazel Al Safa","06696":"Mazaya Centre","06291":"Maze Tower","02879":"Millennium Plaza","09020":"Millennium Tower","02880":"Monarch","02881":"Nassima","06025":"New Mazda Complex","02882":"Oasis","06817":"Oasis Centre","05866":"Park Place Tower","03042":"Rolex","03040":"Sama","08549":"Shangri-la","025282":"Sheraton Grand Hotel","02883":"Single Business","02884":"Tecom","02885":"Toyota Building","025638":"Trade Center Hotel Apartments","08468":"Union Tower","08333":"White Crown Building","06747":"World Trade Center Residence","02886":"World Trade Center-commercial","03529":"Zabeel"},"23":{"02771":"Al Attareen","06074":"Al Bahar Residences","03020":"Al Saaha Offices","02772":"Al Tajer Residence","04922":"Burj Nujoom","03234":"Kamoon (all)","02773":"Kamoon 1","02774":"Kamoon 2","02775":"Kamoon 3","02776":"Kamoon 4","03309":"Miska (all)","02777":"Miska 1","02778":"Miska 2","02779":"Miska 3","02780":"Miska 4","02781":"Miska 5","03310":"Mystica (all)","02782":"Mystica 1","02783":"Mystica 2","02784":"Mystica 3","03311":"Reehan (all)","02785":"Reehan 1","02786":"Reehan 2","02787":"Reehan 3","02788":"Reehan 4","02789":"Reehan 5","02790":"Reehan 6","02791":"Reehan 7","02792":"Reehan 8","05647":"Souk Al Bahar","08098":"The Old Town Island","03312":"Yansoon (all)","02793":"Yansoon 1","02794":"Yansoon 2","02795":"Yansoon 3","02796":"Yansoon 4","02797":"Yansoon 5","02798":"Yansoon 6","02799":"Yansoon 7","02800":"Yansoon 8","02801":"Yansoon 9","03313":"Zaafaran (all)","02802":"Zaafaran 1","02803":"Zaafaran 2","02804":"Zaafaran 3","02805":"Zaafaran 4","02806":"Zaafaran 5","03314":"Zanzebeel (all)","02807":"Zanzebeel 1","02808":"Zanzebeel 2","02809":"Zanzebeel 3","02810":"Zanzebeel 4"},"25312":{"025315":"Al Awir"},"3532":{"04285":"Al Badaa"},"37":{"025474":"Al Badi Complex","02727":"Al Badiya","03452":"Al Manal Compound","024404":"Al Mizhar 1","024407":"Al Mizhar 2","03455":"Al Muhasinah","02728":"Courtyard Apartments","08528":"Garden Apartments","03063":"Ghoroob","025459":"Mirdif Tulip","03064":"Shorooq","08686":"Shorouq","02729":"Uptown Mirdif"},"5680":{"024023":"Al Badia","07267":"Al Badia Hill Side Village","05681":"Al Badia Residences","06606":"Festival Tower","07264":"Marsa Plaza"},"3533":{"04286":"Al Bahia"},"3534":{"04287":"Al Baraha"},"3538":{"04294":"Al Baraha Village","04295":"Al Buhayra Village","04296":"Al Khaleej Village","04297":"Al Khubaira Village","08791":"Al Sabeel","08788":"Al Waha","04298":"Falaj Village","04299":"Liwa Village","04300":"Liwa Village Villas"},"9497":{"09499":"Al Barashi"},"3626":{"04818":"Al Barashi Villas","023339":"Al Brashi"},"3535":{"04288":"Al Bateen Airport","09793":"Al Bateen Complex","04289":"Al Bateen Villas","07801":"Al Ettihad Tower 1","07798":"Al Ettihad Tower 2","07795":"Al Ettihad Tower 3","07792":"Al Ettihad Tower 4","07789":"Al Ettihad Tower 5","04290":"Al Ettihad Towers","024488":"Al Marasy","05867":"Marasy"},"3542":{"08136":"Al Bateen Park","04305":"Al Khaleej Al Arabi Street","07243":"Exhibition Centre"},"19":{"06013":"Al Bateen Residences & Hotel Tower","06513":"Al Fattan Hotel Apartment","06177":"Al Fattan Marine Tower","03222":"Amwaj (all)","02504":"Amwaj 1","02503":"Amwaj 2","02502":"Amwaj 3","02501":"Amwaj 4","02500":"Amwaj 5","03221":"Bahar (all)","02499":"Bahar 1","02498":"Bahar 2","02497":"Bahar 3","02496":"Bahar 4","02495":"Bahar 5","02494":"Bahar 6","025224":"Bahar 7","08588":"JA Oasis Beach Tower","03220":"Murjan (all)","02493":"Murjan 1","02492":"Murjan 2","02491":"Murjan 3","02490":"Murjan 4","02489":"Murjan 5","02488":"Murjan 6","09704":"Ramada Plaza Hotel","03219":"Rimal (all)","02993":"Rimal 1","02994":"Rimal 2","02995":"Rimal 3","02996":"Rimal 4","02997":"Rimal 5","02998":"Rimal 6","06060":"Royal Beach Residence","03293":"Sadaf (all)","02999":"Sadaf 1","03000":"Sadaf 10","03001":"Sadaf 2","025221":"Sadaf 3","03002":"Sadaf 4","03003":"Sadaf 5","03004":"Sadaf 6","03005":"Sadaf 7","03006":"Sadaf 8","03007":"Sadaf 9","03294":"Shams (all)","03008":"Shams 1","03009":"Shams 2","03010":"Shams 3","03011":"Shams 4"},"38":{"06492":"Al Bidaa","02869":"Al Diyafa Street","03066":"Al Hudaiba","03473":"Dune Building","03065":"Jafaliya","03067":"Satwa Road"},"3600":{"04604":"Al Buraymi"},"3627":{"04819":"Al Butina"},"27":{"02445":"Al Dana 1","02446":"Al Dana 2","02447":"Al Jawzaa","02448":"Cbd","02449":"China","02450":"Desert Square","025405":"Dragon Mart","025408":"Dragon Mart 1","025411":"Dragon Mart 2","02451":"Dream Square","02452":"Emirates Cluster","02453":"England","08960":"Fakhruddin Hotel Apartments By Auris","02454":"Forbidden City","02455":"France","02456":"Global Garden View","02457":"Global Point","02458":"Greece","02459":"Indigo Optima","02460":"Indigo Spectrum 1","011909":"Indigo Spectrum 2","02461":"Italy","02462":"Karrawan 1","02463":"Lady Ratan Manor","02464":"Lake District","02465":"Morocco","02466":"Optima","02467":"Persia","09190":"Phase 3","07132":"Prime Residence A","07135":"Prime Residence B","02468":"Prime Residency","02469":"Ritz Residence","02470":"Riviera Dreams","02471":"Riviera Lake View","02472":"Riviera Residence","08878":"Royalex Apartments","02473":"Rufi Gardens","07495":"Rufi Prime View","02474":"Russia","02475":"Sallal","06156":"SP Residence","02476":"Spain","02477":"Supreme Residency","02478":"Toronto","06537":"Trafalgar Central","02479":"Trafalgar Executive","08963":"Trafalgar Tower","02480":"Universal Apartments","02481":"Vancouver","06118":"Warsan Village"},"3636":{"022541":"Al Dana Tower","022535":"Al Wahda City Towers","022532":"Al Wahda Street","023534":"Capital Tower","022538":"Grand Millennium Al Wahda Hotel"},"3575":{"025435":"Al Dana Tower","04513":"Burj Al Jewn","04514":"Burj Al Yaqout","025722":"Danat Abu Dhabi","04515":"Guardian Towers","04516":"Sorouh Tower"},"1796":{"04484":"Al Dana Tower","04486":"Al Wahda City Towers","06982":"Al Wahda Commercial","06979":"Al Wahda Residential","04487":"Al Wahda Street","04883":"Capital Tower","04485":"Grand Millennium Al Wahda Hotel"},"9572":{"09575":"Al Darari"},"3578":{"025791":"Al Dhabi Residence Complex","06997":"Al Qurm","04519":"East Corniche Road","09460":"East Mangroves Complex","025680":"Eastern Mangroves Complex","09507":"Eastern Mangroves Hotel And Spa By Anantara","09513":"Eastern Mangroves Marina","09511":"Eastern Mangroves Promenade","09509":"Eastern Mangroves Suites By Jannah","05908":"Khalifa Park","06994":"Mangrove One","025309":"Ministries Complex","04520":"Park Rotana"},"3536":{"04291":"Al Dhafrah 1","04292":"Al Dhafrah 2"},"9082":{"09088":"Al Dhaith North","09085":"Al Dhaith South"},"3551":{"08941":"Al Diar Sawa Hotel Apartments","04340":"Al Nahyan Camp"},"3630":{"04845":"Al Dorra Tower","08283":"Al Ferasa Tower","04846":"Al Maha Tower","09644":"Al Majaz 1","09647":"Al Majaz 2","09650":"Al Majaz 3","08193":"Al Mohannad Tower","04847":"Al Safyia Building","04848":"Al Yasmin Tower","04849":"Capital Tower","04850":"Copmas Tower","04854":"Dar Al Majaz","04851":"Eissal Al Youssifi Towers","04852":"Emirates Sails Tower","08125":"Lamya Towers","04855":"Palm Tower 1","04856":"Palm Tower 2","04857":"Palm Tower 3","04853":"Saeed Al Ghafli Building"},"1776":{"04820":"Al Ettihad Street"},"48":{"06123":"Al Fahad Tower 1","06126":"Al Fahad Tower 2","06168":"Al Hassani Tower","03079":"Al Khatoom","08839":"Al Meshal","015440":"Al Noor (all)","09032":"Al Noor 1","02888":"Al Noor 2","03361":"Al Noor Towers","03080":"Al Saraya","02889":"Al Shafar","02890":"Al Shahed","015392":"Al Shaiba","06246":"Al Shaiba Tower","06249":"Al Shaiba Tower 1","06252":"Al Shaiba Tower 2","03081":"Al Yassat","03082":"Al-meer Building","03078":"Api","03205":"Api (all)","03083":"Arenco","03362":"Art (all)","03076":"Art 2","025695":"Art 3","03077":"Art 4","05802":"Auris Hotel","05808":"Auris Metro Central","05804":"Belle Vue Hotel","09769":"Boutique 7 Hotel And Suites","03074":"Carrefour Building","02891":"Cayan Business Center","05805":"Comfort Inn","02892":"Concord","03143":"Crown Plaza","02893":"Crown Residence","08647":"Crystal Blue Tower","05963":"Damac Heights","05738":"Dubai Pearl","05757":"Euro Tower","02894":"Executive Heights","05756":"First Central Hotel Apartments","024473":"First Central Tower","09593":"Gloria Hotel Apartments","09802":"Grand Belle Vue Hotel Apartment","06063":"Grand Central Hotel","03360":"Green View (all)","03084":"Green View 1","03085":"Green View 2","02895":"Grosvenor Business","09283":"Hawai Residence","09431":"Hilliana Tower","09732":"Home To Home Hotel Apartments","09815":"I Rise Office","03161":"I-rise","02896":"Icon","013397":"Ikon","015416":"Leader","05879":"Legacy Hotel","07729":"Liwa Heights Tower","02897":"Madison Residency","015419":"Manhattan","05973":"Metro Central Hotel Apartments","03086":"National Bond Plaza","03091":"Oasis Residence","02900":"One","03363":"Onyx (all)","013370":"Onyx 1","013403":"Onyx 2","09253":"Onyx Business Hotel Tower 3","02887":"Onyx Tower 1","07081":"Onyx Tower 2","025483":"Oryx Tower","08605":"Phoenix Tower","08836":"Ramee Rose","03087":"Rania Apartment","08926":"Rose 6 Building","03088":"Row House","06029":"Sheikha Noora Building","03090":"Silicon Plaza","08348":"Sky Central Hotel","02898":"Smart Heights","08758":"Stella Tower","06078":"Tameem House","013409":"Tecom 1","013412":"Tecom 2","02899":"Tecom Tower 1","07084":"Tecom Tower 2","015356":"Tecom Twin Towers","05750":"Tecom Two Towers","09307":"Time Crystal Hotel Apartments","06832":"Time Oak","03092":"Warsan Building","03089":"Windsor Crescent","03075":"Yassat Gloria Hotel Apartments"},"3537":{"04293":"Al Falah City"},"3572":{"04497":"Al Falah Street","04498":"Al Markaziya","04499":"Al Rahma Tower","04501":"Defense Road","04500":"Y Tower"},"76":{"01850":"Al Falasi Warehouse","01851":"Al Khail Gate","06018":"Al Quoz 1","06019":"Al Quoz 2","08134":"Al Quoz 4","03156":"Al Quoz Business Centre","01852":"Al Quoz Industrial District","01853":"Al Sayyah Building","01854":"Al Serkal Building","023759":"Al Shafar Investment","016040":"Alserkal","01855":"Badiya Warehouse","09193":"Camellia","016043":"Dubai Euro Group","016583":"Focus Art Gallery","09196":"Gardenia","06020":"Industrial Area 1","03144":"Industrial Area 2","03145":"Industrial Area 3","06021":"Industrial Area 4","016046":"Lotus Plaza","09199":"Magnolia","016502":"Umm Al Sheif","09202":"Villosa"},"1807":{"04769":"Al Fanar 1","04770":"Al Fanar 2"},"3601":{"022178":"Al Faqa","04605":"Al Faqa"},"82":{"05769":"Al Furjan (all)","05669":"Al Hejaz","023996":"Almasa","05670":"Almasa 1","05671":"Almasa 2","06030":"Avenue Residence","025615":"Azizi Daisy","07657":"Azizi Feirouz","09560":"Azizi Freesia","07714":"Azizi Iris","07306":"Azizi Liatris","07660":"Azizi Orchid","07489":"Azizi Residence","025612":"Azizi Tulip","05673":"Azizi Yasamine","06642":"Dubai Style Townhouse","06044":"Dubai Style Villas","05667":"East Village","05674":"Feirouz 3","03159":"Masakin","025504":"Murano Residences","05668":"North Village","06444":"Phase 1","05672":"Quortaj","05677":"South Village","07144":"The Dreamz","05675":"Village Centre","05676":"West Village","024005":"Yasamine"},"1777":{"04821":"Al Ghafeyah Area"},"1474":{"08623":"Al Ghaith Tower","04529":"Dalma Residence","04530":"Emirates Tower","04531":"Golden Falcon Tower","04528":"Hamdan Tower","04534":"Liwa Centre Tower 1","04535":"Liwa Centre Tower 2","04536":"Liwa Centre Tower 3","04532":"Royal Tower","04533":"Vision Downtown"},"9620":{"09623":"Al Gurm Resort"},"1824":{"04660":"Al Hadeel Tower","04661":"Al Hilal Tower","04669":"Al Rashed 1","04670":"Al Rashed 2","04671":"Al Rashid 5","04672":"Al Rashid 6","04673":"Al Rashid 7","04674":"Al Rashid 8","04675":"Blossom Tower 1","04676":"Blossom Tower 2","04662":"Calthorpe Tower","04663":"Global Pearl Residence","04677":"Highfield Towers","04664":"Humaid Gate Tower","04665":"Infinity Tower","04666":"Royal Lake View","04678":"Savannah Heights Tower 1","04679":"Savannah Heights Tower 2","04667":"Springfield","04668":"Tricon Lake Front"},"1795":{"06546":"Al Hafeet Tower","09728":"Al Saad Residence Tower","025731":"Al Thuraya Tower","07096":"Al Waha Residence Tower","06814":"Asas Tower","04882":"Majestic Tower","09397":"Manazil Tower 3"},"26":{"02366":"Al Hambra Villa","03439":"Emirate Hills Villas (all)","02367":"Montgomerie Maisonettes","02368":"Park Lands","05711":"Private Portfolio","011618":"Section E","011621":"Section H","011624":"Section J","011627":"Section L","011630":"Section P","011633":"Section R","011636":"Section W","02369":"Sector E","02370":"Sector H","05706":"Sector HT","02371":"Sector J","02372":"Sector L","02373":"Sector P","02374":"Sector R","05641":"Sector S","05705":"Sector V","02375":"Sector W","02376":"Signature Homes","09689":"Signature Villas"},"49":{"016601":"Al Hamra (all)","017288":"Al Marjan Island","016847":"Bab Al Bahr","016844":"Cove","015449":"Golf Apartments","015452":"Granada","017312":"Julfar","016850":"Julfar Office","016853":"Julfar Residential","015455":"Luxury B Villa","015458":"Luxury C Villa","016487":"Malibu","016598":"Marina Apartments","015461":"Oceana Apartments","015464":"Royal Breeze Villas"},"3615":{"04776":"Al Hamra Fort Hotel","04772":"Al Hamra Golf Resort","04773":"Al Hamra Lagoon","08516":"Al Hamra Marina","04774":"Al Hamra Residences","04775":"Al Hamra Views","08498":"Al Hamra Village","08199":"Al Hamra Village Townhouses","07387":"Bayti Townhomes","08205":"Duplexes","06844":"Falcon Island","04777":"Golf Apartments","04780":"Marina Apartments","04778":"Oceana Apartments","08208":"Palace Hotel","023222":"Royal Breeze","07989":"Royal Breeze 1","04779":"Royal Breeze 2","07992":"Royal Breeze 3","08220":"Royal Breeze 4","08223":"Royal Breeze 5","08202":"Royal Breeze Townhouses"},"25671":{"025674":"AL Hazannah"},"3602":{"04606":"Al Hilli","04607":"Beda Bint Soud","09044":"Hili Rayhaan By Rotana"},"3540":{"04303":"Al Ittihad Road"},"1825":{"04680":"Al Ittihad Village"},"1808":{"04771":"Al Jaber Tower"},"9483":{"09485":"Al Jaddaf","09487":"Couture Condominiums","09489":"Iris Amber Tower","09744":"Marriot Executive Apartments"},"5790":{"05791":"Al Jafiliya","025387":"Chelsea Plaza Hotel"},"3603":{"04608":"Al Jimi"},"3628":{"04822":"Al Jubail"},"3604":{"04609":"Al Khabisi"},"6119":{"06120":"Al Khail Heights Building","07201":"Al Khail Heights Building 10A","07204":"Al Khail Heights Building 10B","07207":"Al Khail Heights Building 11A","07210":"Al Khail Heights Building 11B","06907":"Al Khail Heights Building 1A","06910":"Al Khail Heights Building 1B","06913":"Al Khail Heights Building 2A","06916":"Al Khail Heights Building 2B","07159":"Al Khail Heights Building 3A","07162":"Al Khail Heights Building 3B","07165":"Al Khail Heights Building 4A","07168":"Al Khail Heights Building 4B","07171":"Al Khail Heights Building 5A","07174":"Al Khail Heights Building 5B","07177":"Al Khail Heights Building 6A","07180":"Al Khail Heights Building 6B","07183":"Al Khail Heights Building 7A","07186":"Al Khail Heights Building 7B","07189":"Al Khail Heights Building 8A","07192":"Al Khail Heights Building 8B","07195":"Al Khail Heights Building 9A","07198":"Al Khail Heights Building 9B"},"3584":{"04551":"Al Khaili Tower","04552":"Al Noor Tower","07456":"Emerald Tower","07453":"Galaxy Tower","09425":"Garden View Tower","04553":"Lafzaeyya Tower","07465":"Lulu Tower 1","07468":"Luxury Tower 2","04554":"The Blue Tower","07462":"UBL Tower"},"1779":{"04823":"Al Khaldeia Area"},"1773":{"08629":"Al Kharag","04816":"Freish Al Siyabi Building","04817":"Khalfan Al Fandi Building"},"5780":{"05781":"Al Khawaneej 1","05782":"Al Khawaneej 2"},"1781":{"04844":"Al Khezamia"},"7501":{"07504":"Al Madina Al Riadiya","025743":"Rihan Heights"},"3544":{"04329":"Al Maffraq"},"1464":{"04927":"Al Maha","04928":"Al Muneera Townhouses-Island","04929":"Al Muneera Townhouses-Mainland","04930":"Al Nada","023678":"Al Sana"},"3549":{"06967":"Al Maha Complex","04336":"Al Musalla Area","025788":"Al Yasat Compound","04337":"Mushrif Gardens","04338":"Mushrif Heights","08429":"Mushrif Mall Area","06931":"Palm Oasis"},"8139":{"08142":"Al Maharba"},"12":{"01865":"Al Mahra","02589":"Al Mahra 1","02591":"Al Mahra 2","03191":"Al Reem (all)","01866":"Al Reem 1","01867":"Al Reem 2","01868":"Al Reem 3","025351":"Al Reem 4","025354":"Al Reem 5","01869":"Alma","06510":"Alma 1","05765":"Alma 2","03192":"Alvorada (all)","01870":"Alvorada 1","01871":"Alvorada 2","01872":"Alvorada 3","01873":"Alvorada 4","07234":"Aseel Villas","01874":"Avenida","08638":"Azalea","05766":"Casa","01875":"Golf Homes","01876":"Hattan","025363":"Hattan 1","025357":"Hattan 2","025360":"Hattan 3","07645":"La Avenida 2","06366":"Lila Villas","05946":"Mira","03246":"Mirador (all)","01877":"Mirador 1","01878":"Mirador 2","03247":"Mirador La Coleccion (all)","01879":"Mirador La Coleccion 1","01880":"Mirador La Coleccion 2","06101":"Palma","03194":"Palmera (all)","01881":"Palmera 1","01882":"Palmera 2","01883":"Palmera 3","01884":"Palmera 4","01885":"Polo Homes","06441":"Rasha Villas","06198":"Rosa","03245":"Saheel (all)","01886":"Saheel 1","01887":"Saheel 2","01888":"Saheel 3","01889":"Saheel 4","025366":"Saheel 5","025369":"Saheel 6","025372":"Saheel 7","025375":"Saheel 8","06820":"Samara","03380":"Savannah (all)","01890":"Savannah 1","01891":"Savannah 2","01892":"Terranova","06489":"Yasmin"},"29":{"03158":"Al Manara","03153":"Al Thanya","09730":"Amber Residency","03044":"Compound Villa","03150":"Pavilions","03146":"Umm Al Sheif","03331":"Umm Sequeim (all)","02947":"Umm Suqeim 1","02948":"Umm Suqeim 2","02949":"Umm Suqeim 3"},"5709":{"07534":"Al Manara","07537":"Al Samaya Building","05710":"Al Wasl Road"},"3545":{"04331":"Al Manaseer"},"1783":{"09316":"Al Manazel","04858":"Magestic Tower"},"3546":{"04332":"Al Manhal"},"6753":{"06756":"Al Manzel","07900":"Zabeel 1","07897":"Zabeel Road"},"3579":{"025441":"Al Manzel Hotel Apartment","04521":"Arzana Tower","04522":"Dhafir Tower","04523":"Electra Tower","04524":"Global Tower","04525":"Sama Tower"},"3605":{"04610":"Al Maqam"},"3547":{"04333":"Al Maqtaa","05682":"Al Maqtaa Village","08896":"Shangri La Residences"},"1784":{"04859":"Al Mareija"},"3555":{"04374":"Al Mariah Community","04375":"Al Tharwaniyah Community","08785":"Al Ward","04376":"Hemaim Community","04377":"Khannour Community","04378":"Lehweih Community","04379":"Muzera Community","04380":"Qattouf Community","04381":"Samra Community","04382":"Sidra Community","04383":"Yasmin Community"},"1443":{"08196":"Al Marjan Island Resort & Spa","04782":"Amwaj","08501":"Bab Al Bahr","04781":"Blue Mirage","04787":"Flamingo","04786":"Global Sea View","04783":"Kahraman","04791":"Marbella Bay","08504":"Marjan Island Plot","04784":"Marmar","04792":"Pacific Bora Bora","04793":"Pacific Polynesia","04794":"Pacific Samoa","04795":"Pacific Tonga","04788":"Santorini","04789":"Starfish","04790":"Terrapin","04785":"Yakout"},"3624":{"04810":"Al Marsa","04811":"Al Sahab","04812":"Al Wahat","04813":"Saraya Village"},"1797":{"023537":"Al Marwa Tower 1","023540":"Al Marwa Tower 2","023543":"Al Marwa Tower 3","09292":"Blue Tower","04887":"Canal Star Tower","04888":"Jawahar Tower"},"3552":{"08271":"Al Masaood Tower","09467":"Al Nahel Tower","08268":"Dhafir Tower","08265":"Sola Tower","04341":"Vision Twin Towers","07929":"Zakher Time Residence"},"3583":{"04539":"Al Mazroui Tower","04540":"Liwa Tower","04541":"Morjan Tower"},"6573":{"06576":"Al Mizhar 1","06579":"Al Mizhar 2"},"73":{"08462":"Al Muntazah Complex","02364":"Amber Residence","03103":"Business Centre","02069":"Capital Square","02070":"Celestial Heights","02071":"Deyaar Business Park","02482":"Deyaar Park","010598":"Deyaar Park 3","010601":"Deyaar Park A","010604":"Deyaar Park B","02072":"F-s","02073":"Image Residence","02074":"Integral","05683":"JAFZA","09775":"Jebel Ali Freezone North","09778":"Jebel Ali Freezone South","08635":"Jebel Ali Hills","05689":"Jebel Ali Industrial 1","05690":"Jebel Ali Industrial 2","05691":"Jebel Ali Industrial 3","05692":"Jebel Ali Industrial 4","09781":"Jebel Ali Port","02075":"Kpm 2","02076":"Kpm 3","02077":"Orion","02365":"Residential City","02078":"Rufi Royal Residence","010631":"Schon Residences","02081":"Signet","02080":"Suburbia","02082":"World Wide"},"9614":{"09617":"Al Musalla"},"9050":{"09059":"Al Mutarad"},"1826":{"04681":"Al Naemiya Tower 1","04682":"Al Naemiya Tower 2","04683":"Al Naemiya Tower 3","04684":"Rawan Building"},"3550":{"04339":"Al Nahda Abu Dhabi"},"1465":{"05959":"Al Nahyan","09533":"Al Sawa Palm Hotel Apartments"},"1786":{"04871":"Al Naimiya Area"},"1812":{"04908":"Al Naseem","04909":"Al Rawda","04910":"Al Waha"},"9554":{"025692":"Al Nasr Plaza","09557":"Pyramid Centre","025686":"The Spectrum Building"},"5992":{"05993":"Al Nasr Street"},"75":{"06050":"Al Nawras Hotel","01849":"Al Shamsi Buillding","015656":"Burj Building","06765":"Canary Building","07920":"Emirates Stars Hotel Apartments"},"1787":{"04872":"Al Nekhailat"},"1790":{"06519":"Al Nesr Tower","07219":"Al Noor Tower","04875":"Al Shahid Tower","04876":"Queen Tower"},"3631":{"04873":"Al Nouf"},"9053":{"09056":"Al Oyoun Village"},"9787":{"09772":"Al Qadsiya","025746":"Sharqan"},"3553":{"04342":"Al Qurm Gardens","04343":"Al Qurm Resort","04344":"Al Qurm Street"},"6047":{"06048":"Al Qusaidat"},"6297":{"06300":"Al Qusais 1","06303":"Al Qusais 2","06306":"Al Qusais 3","06309":"Al Qusais Industrial Area","07240":"Manazel Deira Building"},"6342":{"06360":"Al Rabia Tower"},"1466":{"025251":"Al Raha Mall","08821":"Building F","09106":"Qutuf"},"3557":{"04390":"Al Rahba"},"25633":{"025636":"Al Rahmaniya 1"},"3633":{"04879":"Al Ramla East","04880":"Al Ramla West"},"1827":{"04685":"Al Rashidiya"},"3558":{"04391":"Al Rawdah"},"1467":{"09473":"Al Reef Downtown","09481":"Arabian Village","09475":"Contemporary Village","09479":"Desert Village","09477":"Mediterranean Style"},"3559":{"04923":"Al Reef Downtown","04392":"Al Reef Tower","08449":"Al Reef Villas","04393":"Amber Tower","04394":"Arabian Style","04395":"Contemporary Style","04396":"Desert Style","08322":"Hydra Village","04397":"Mediterranean Style"},"72":{"03124":"Al Rigga"},"1828":{"04686":"Al Rumaila"},"3561":{"04475":"Al Ruwais","05748":"Dubai Grand Hotel"},"3593":{"04579":"Al Saadiyat Avenue","04581":"Arabian Villas","08056":"Contemporary Villas","08842":"Hidd Al Saadiyat","08999":"Mamsha Al Saadiyat","04580":"Marina Al Saadiyat","08059":"Mediterranean Villas","05699":"Nurai","09736":"Park View","05703":"Saadiyat Beach","025486":"Saadiyat Beach Golf Views","08603":"Saadiyat Beach Residences","09632":"Saadiyat Beach Villas","09581":"Saadiyat Cultural District","04582":"Saadiyat Lagoons","04583":"Saadiyat Promenade","04584":"Saadiyat Resort","025342":"Soho Square Residences","06477":"St Regis","08062":"St. Regis"},"7147":{"07150":"Al Safa 1","07153":"Al Safa 2"},"1804":{"09133":"Al Saja'a","04895":"Industrial Area 1","04896":"Industrial Area 10","04897":"Industrial Area 13","04898":"Industrial Area 2","04899":"Industrial Area 3","04900":"Industrial Area 4","04901":"Industrial Area 5","04902":"Industrial Area 6","04903":"Industrial Area 7","04904":"Industrial Area 8","04905":"Industrial Area 9"},"3562":{"04476":"Al Samha"},"36":{"08582":"Al Saqr Business Tower","07510":"Burj Daman","02038":"Carrera","09662":"Central Park Office Tower","09659":"Central Park Residential Tower","06189":"Central Park Tower","09011":"Currency House Offices","09014":"Currency House Residences","02044":"Daman","03197":"Emirates Financial (all)","03168":"Emirates Financial North","09698":"Emirates Financial North Tower","03169":"Emirates Financial South","09701":"Emirates Financial South Tower","07285":"ETA Star","02042":"Gate 1","03478":"Gate 2","03479":"Gate 3","03480":"Gate 4","02045":"Index","02040":"Liberty House","02041":"Limestone","07255":"Murooj Rotana Building","03342":"Park (all)","015194":"Park 1","015197":"Park 2","09692":"Park Tower 1","09695":"Park Tower 2","02039":"Park Tower A","03062":"Park Tower B","07486":"Park Towers","025501":"Park Towers Podium","03133":"Ritz Carlton Residences","02043":"Sky Gardens","03198":"The Gate (all)","09491":"World Trade Centre Residences"},"1472":{"025776":"Al Saqr Tower"},"5994":{"05995":"Al Seer"},"3563":{"04477":"Al Shahama","04478":"New Shahama"},"3634":{"04881":"Al Shahba"},"3632":{"023510":"Al Shahid Tower","023513":"Queen Tower"},"3564":{"04479":"Al Shamkha"},"3607":{"04612":"Al Sinaiya"},"3608":{"04613":"Al Tawiya"},"6000":{"06001":"Al Twar 1","06002":"Al Twar 2","06003":"Al Twar 3"},"5715":{"05716":"Al Warqaa 1","05717":"Al Warqaa 2","05718":"Al Warqaa 3","05719":"Al Warqaa 4","05720":"Al Warqaa 5"},"5695":{"05696":"Al Warsan 1","05697":"Al Warsan 2","05698":"Al Warsan 3","09790":"Dubai Textile City"},"3567":{"04488":"Al Wathba Tower"},"7480":{"07483":"Al Wuheida"},"3640":{"025297":"Al Yash","04907":"Wasit"},"3568":{"04489":"Al Zaab"},"3639":{"06113":"Al Zahia","04892":"Muelih"},"3611":{"025381":"Al Zahraa","04687":"Al Zahraa"},"6264":{"06585":"Almond Tower","06267":"Jasmine Towers","06270":"Mandarin Tower"},"1444":{"06095":"Amwaj","06057":"Fayrouz","06056":"Kahraman","06096":"Marmar","06055":"Yakout"},"3641":{"07888":"Amwaj Resort","04915":"White Bay"},"3597":{"07923":"Ansam","04593":"Staybridge Suites","025734":"Yas West"},"5911":{"08190":"ANWA","05912":"Dubai Maritime City","06080":"Jumeirah Waterfront","06081":"Paramount Hotel"},"55":{"02261":"Apricot","025770":"Arabian Gates","02262":"Atrium Gold","02263":"Axis Residence 1","02264":"Axis Residence 2","02265":"Axis Residence 3","02266":"Axis Residence 4","02267":"Axis Residence 5","02268":"Axis Residence 6","02269":"Axis Residence 8","02270":"Axis Residence 9","03216":"Axis Residences (all)","09262":"Axis Silver","09527":"Binghatti Apartments","025716":"Binghatti Views","02271":"Cambridge Business Centre","02281":"Cedre Villa","011348":"Cedre Villas","02272":"Coral Residence","02273":"Cordoba Palace","06115":"Donna Tower","06961":"Donna Tower 1","06964":"Donna Tower 2","02297":"Dunes","06693":"Executive Villa","016034":"Head Quarter","07516":"Imperial Building","05956":"Intercontinental College Accommodation","02274":"It Plaza","02275":"Jade Residence","02276":"La Vista Residence","07372":"Le Presidium","02277":"Le Solarium","07642":"Liwan Tower","02278":"Lynx Business","09112":"Mirage Residence","02279":"Narcissus Building","08316":"Nibras Tower","025749":"Nova Tower","02280":"Oasis High Park","08128":"Oasis Star","015614":"Palace","03100":"Palace Tower 1","08860":"Palace Tower 2","02282":"Park Avenue","07066":"Park Avenue Commercial Tower","07063":"Park Avenue Residence","02283":"Park Terrace","08166":"Platinum Residences","02284":"Ruby Residence","02286":"Saima Heights","02287":"Sapphire","08007":"Semmer Villas","03184":"Sevenam Crown","02288":"Silicon Arch","06042":"Silicon Avenue","06850":"Silicon Gate 1","02289":"Silicon Gates","02290":"Silicon Gates 2","06525":"Silicon Gates 3","09726":"Silicon Gates 4","02291":"Silicon Heights","02292":"Silicon Heights 2","02293":"Silicon Residences","02294":"Silicon Star","02285":"Sit","06171":"SIT Tower","02295":"Solarim Building","06073":"SP Oasis","02296":"Spring Oasis","02298":"Springs","05736":"Suntech","025489":"The Blue Oasis","025549":"The Domain","025333":"The Icon Tower","09115":"The White Palace","09130":"Topaz Residence","06687":"Townhouse Villa","06690":"Twin Villa","02299":"University View","02300":"Vortex"},"43":{"06107":"Arabian","06393":"Arena Apartments","09217":"Auris Fakhruddin Hotel Apartments","02302":"Bangash Residence","06387":"Bermuda Views","06789":"Bloomingdale","02353":"Bridge","02303":"Calida","02304":"Canal Residence","02305":"Century","03343":"Champions (all)","03461":"Champions 1","03462":"Champions 2","03463":"Champions 3","03464":"Champions 4","02306":"Chapal Destiny","02307":"Chess","07741":"Classic Soccer Tower","02308":"Coral Hotel Apartment","02309":"Cricket","02310":"Crown Avenue","02354":"Cube","02311":"Destiny","02355":"Diamond","02312":"Eagle Heights","02313":"Eden Garden","03344":"Elite (all)","02314":"Elite Sports Residence 1","08626":"Elite Sports Residence 10","02315":"Elite Sports Residence 2","02316":"Elite Sports Residence 3","02317":"Elite Sports Residence 4","02301":"Elite Sports Residence 5","02318":"Elite Sports Residence 6","02319":"Elite Sports Residence 7","06480":"Elite Sports Residence 8","06684":"Elite Sports Residence 9","05950":"European","025019":"European Building","02320":"Frankfurt","02321":"Gallery Villas","02322":"Gateway","03345":"German Sports (all)","02323":"German Sports 1","03481":"German Sports 2","02324":"Giovanni Boutique Suites","03346":"Global Golf (all)","02325":"Global Golf Residence","02326":"Global Golf Residence 2","06216":"Golden Tulip","02327":"Golf","03485":"Golf View","08611":"Grand Horizon 1","02328":"Hamza","02329":"Hub Canal","02330":"Hub Canal 2","02331":"Ice Hockey","02332":"Kensington Royal","025471":"Lime Light Twin Tower","02333":"Links View","02356":"Matrix","02357":"Medalist","02334":"Mediterranean","03347":"Oasis (all)","03511":"Oasis 1","03512":"Oasis 2","08954":"Oasis Tower 1","08957":"Oasis Tower 2","02335":"Oliva Village","03348":"Olympic Park (all)","02336":"Olympic Park 1","02337":"Olympic Park 2","02338":"Olympic Park 3","02339":"Olympic Park 4","02340":"Park View","06192":"Prime Villa","02341":"Profile Residence","06180":"Red Residence","011534":"Royal Residence","02342":"Royal Residence 1","08244":"Royal Residence 2","02343":"Rufi Century","06129":"Rufi Golf Greens","02344":"Rufi Park View","02345":"Rufi Rose Gardens","02346":"Rufi Twin","06330":"Rufi Water Front","02347":"Shami Sports","02348":"Soccer","02349":"Spanish","02358":"Spirit","02350":"Sports One","02351":"Stadium Point","02352":"Tennis","06225":"The Arena","03525":"Twin","025321":"UniEstate Sports Tower","02359":"Universal","02360":"Venetian","06165":"Wimbledon Tower","03349":"Zenith (all)","02361":"Zenith A1","02362":"Zenith A2","02363":"Zenith A3"},"5712":{"05969":"Arabian Townhouse","05970":"Arabian Villas","024344":"Arabic","05913":"District 1","05914":"District 2","07381":"District 3B","07426":"District 4B","025644":"DISTRICT 5C","025525":"District 8U","025456":"District 8V","025537":"District 9E","025764":"District 9G","025203":"El Matador Tower","05714":"Green Park","02602":"Imperial Residence","05713":"Jumeirah Village Triangle","07804":"Magnolia Residence","025206":"Mangolia Residence","024347":"Mediterannean","05971":"Mediterranean Townhouse","05972":"Mediterranean Villas","06153":"Pacific Edmonton Elm","025507":"Park Inn Residence","06094":"Point Residencia","025258":"The Imperial Residence A","025261":"The Imperial Residence B"},"1835":{"04746":"Arc Tower","04747":"Burj Regent","04748":"DIO Twin Tower","04749":"Downtown Avenue","04750":"Emerald Vista","04751":"Global City Tower","04752":"Gold Tower","04753":"Konig Tower","04754":"Monarch Tower","04755":"Samaa Tower","04756":"Sat Lake Residency","04758":"Shami Garden Tower I","04759":"Shami Garden Tower II","04757":"Tulip Residence"},"7570":{"02932":"Arno","07573":"Arno A","02933":"Arno B","03242":"Fairways (all)","02934":"Fairways East","02935":"Fairways North","02936":"Fairways West","07576":"Golf Tower 1","07693":"Golf Tower 2","07696":"Golf Tower 3","08734":"Golf Towers","08737":"Golf Towers 2","02438":"Golf Villas","03244":"Links (all)","02937":"Links Canal Apartments","02940":"Links East","08752":"Links East Tower","02439":"Links Golf Apartment","08725":"Mosela","02938":"Mosela Waterside Residences","08728":"Panorama At The Views","08304":"Panorama At The Views Tower 1","08307":"Panorama At The Views Tower 2","08310":"Panorama At The Views Tower 3","08313":"Panorama At The Views Tower 4","04932":"Panorama Tower","02939":"Tanaro","07585":"The Links Villas","07588":"The Links West Tower","03019":"The Views 1","03129":"The Views 2","08743":"Travo","02942":"Travo A","02943":"Travo B","08749":"Travo Tower A","08746":"Travo Tower B","08731":"Turia","07579":"Turia Tower A","07582":"Turia Tower B","02946":"Una Riverside","08722":"Una Riverside Residence"},"9298":{"09301":"Art 5"},"1463":{"09458":"Aryam Tower","025291":"Jannah Burj Al Sarab","08755":"Mina Road","04335":"Silver Wave Tower"},"4940":{"04941":"Babil","04942":"Cascade Manor","04943":"Cascade Ville","04944":"D1 Tower","07977":"Dubai Wharf","04945":"Iris Amber","04946":"Iris Asmar","06027":"Jaddaf Plot","04947":"La Mer Tower","04948":"Lotus Tower","07225":"Manazel Al Khor","04949":"Nastaran","08522":"Niloofar Tower","04950":"Nur Tower","04951":"Palazzo Versace","04952":"Podium Tower","04953":"Rhodi Residence","04954":"Rose Tower","04958":"Santeview 1","04959":"Santeview 2","04955":"The Estate Tower","04956":"Yas","04957":"Yuvi Residence"},"5745":{"05746":"Badrah","09220":"Badrah Building 1","09223":"Badrah Building 2","09226":"Badrah Building 3","09229":"Badrah Building 4","09232":"Badrah Building 5","09235":"Badrah Building 6","09238":"Badrah Building 7","09241":"Badrah Building 8","06363":"Madinat Al Arab","05964":"Veneto Villas"},"8845":{"08848":"Bahia Residence","08869":"Cloud 9","09740":"Decora Villas"},"3569":{"04490":"Baniyas"},"5814":{"06937":"Base Metal Zone","06940":"Chemical Zone","05816":"Dubai Industrial City","05906":"Dubai Spanish Villas","06934":"Food And Beverage Zone","025689":"Industrial Zone","06943":"Machinery & Mechanical Equipment Zone","06946":"Mineral Products Zone","06949":"Sahara Living","05815":"Sahara Meadows"},"3592":{"05701":"Beachfront Estate","04578":"Nurai Island","025468":"Nurai Resort","05702":"Seaside Estate","05700":"Water Villa"},"54":{"011831":"Beirut","07072":"Beirut Towers","03217":"Centrium (all)","011834":"Centrium 1","011837":"Centrium 2","011840":"Centrium 3","07093":"Centrium Tower 1","07015":"Centrium Tower 2","07018":"Centrium Tower 3","07021":"Centrium Tower 4","03218":"Crescent (all)","03099":"Crescent 1","015596":"Crescent 2","02440":"Dana Gardens","07474":"Ghaya Grand Hotel","05793":"IMPZ","02441":"Lago Vista","03373":"Lago Vista (all)","03096":"Lago Vista 1","03097":"Lago Vista 2","03374":"Lakeside (all)","03098":"Lakeside 1","02442":"Lakeside 2","07000":"Lakeside Tower A","07003":"Lakeside Tower B","07006":"Lakeside Tower C","07009":"Lakeside Tower D","025498":"Midtown","02443":"Oakwood Residency","06663":"Qasr Sabah","02444":"Ramada Residence","05869":"The Crescent A","05870":"The Crescent B","05871":"The Crescent C"},"3573":{"06988":"Bel Ghailam","08113":"Burj Mohammed Bin Rashid At WTC","04502":"Corniche Area","06528":"Etihad Towers","05665":"Khalidiya Centre","05663":"Khalidiya Palace Tower","08495":"Meera Tower","05664":"Reem Tower","05662":"Saheel Tower","08525":"Time Meera Residence","08119":"World Trade Center"},"3618":{"04799":"Bermuda","08295":"Flamingo Villas","04800":"Granada","08513":"Lagoon","025037":"Lagoon B1","025076":"Lagoon B10","025079":"Lagoon B11","025082":"Lagoon B12","025085":"Lagoon B13","025088":"Lagoon B14","025091":"Lagoon B15","025094":"Lagoon B16","025097":"Lagoon B17","025100":"Lagoon B18","025103":"Lagoon B19","025040":"Lagoon B2","025106":"Lagoon B20","025109":"Lagoon B20A","025112":"Lagoon B20B","025115":"Lagoon B21","025121":"Lagoon B21A","025118":"Lagoon B21B","025124":"Lagoon B22","025127":"Lagoon B23","025130":"Lagoon B24","025055":"Lagoon B3","025058":"Lagoon B4","025061":"Lagoon B4","025034":"Lagoon B5","025064":"Lagoon B6","025067":"Lagoon B7","025070":"Lagoon B8","025073":"Lagoon B9","025049":"Lagoon Building 1","025052":"Lagoon Building 2","08226":"Lagoon Walk","04801":"Malibu","04802":"Marbella","04803":"The Beachfront"},"3570":{"025162":"Binal Jesrain","04491":"Fairmont Villas","025761":"Urban Oasis Compound"},"32":{"07363":"Bloomingdale Townhouses","03047":"Calida","03048":"Carmen","03049":"Esmeralda","015089":"Esmerelda","03050":"Estella","07711":"Fortuna Village","03053":"Moon Vilas","03051":"Morella","03046":"Novelia","03052":"Oliva","08683":"Victory Heights(all)"},"1789":{"04874":"Blue Bay"},"3571":{"04492":"BMC 16","04493":"BMC 7","04494":"Commercial District","04495":"Prestige Towers","04496":"Residential District"},"74":{"03105":"Building 25","015653":"Building 26","06174":"Building 49","08713":"Dubai Health Care City (DHCC)","08519":"Hyatt Regency Creek Heights","06028":"Ibn Sina Building","03104":"Jumeirah Al Khor"},"31":{"07279":"Bungalows","07567":"Bungalows Area West","08160":"Family Villas East","07564":"Family Villas West","02381":"Garden Apartments East","025453":"Garden West Apartments","02384":"Green Community East","02385":"Green Community West","02387":"Lake Apartments","07561":"Luxury Villas Area West","07282":"Luxury Villas East","08866":"South West Apartments","02388":"Terrace Apartments","08148":"Townhouses Area East","07558":"Townhouses Area West","025414":"West Phase 3"},"14":{"03183":"Cactus (bldgs 230-263)","03180":"Contemporary (bldgs 108-137)","06600":"Ibn Battuta Gate","03179":"Mediterranean (bldgs 38-107)","08432":"Mediterranean Cluster","03182":"Mesoamerican (bldgs 203-229)","03181":"Mogul (bldgs 148-202)","03178":"Zen Bldgs (1-37)"},"6675":{"06678":"Capital Gate"},"8342":{"08345":"Capital Gate"},"3548":{"04334":"Capital Plaza","07060":"Sama Tower"},"6008":{"09250":"Cayan Cantara","06009":"DuBiotech"},"5889":{"06594":"Celestia","05890":"Dubai World Central","09536":"MAG 5 Boulevard","07057":"Residential City","06255":"Tenora"},"1839":{"04763":"Century Tower 1","04764":"Century Tower 2","04765":"ICT Tower 1","04766":"ICT Tower 2","04767":"Park View Tower"},"39":{"02516":"Cluster 1-5","02517":"Cluster 11-15","02518":"Cluster 16-20","02519":"Cluster 21-25","02520":"Cluster 26-30","02521":"Cluster 31-35","02522":"Cluster 36-40","02523":"Cluster 41-45","02524":"Cluster 46-50","02525":"Cluster 6-10","05792":"Contemporary Cluster","02526":"Costa Del Sol","012185":"Entertainment Foyer","07962":"Entertainment Foyer- Mediterranean","07971":"Entertainment Foyer-Contemporary","07968":"Entertainment Foyer-European","07965":"Entertainment Foyer-Islamic","02527":"Entertainment Foyer-Oasis","02528":"European Cluster","07950":"Garden Hall -Tropical","07959":"Garden Hall- Contemporary","07956":"Garden Hall- European","07953":"Garden Hall- Islamic","06093":"Garden Hall-Mediterranean","02529":"Garden Hall-Oasis","012191":"Garden Home","02530":"Islamic Clusters","07492":"Island Two","08540":"Jumeirah Islands Townhouses","02531":"Jumeirah Mansions","07947":"Master View - Tropical","07938":"Master View- Contemporary","07935":"Master View- European","07932":"Master View- Islamic","06207":"Master View-Mediterranean","07941":"Master View-Oasis","07944":"Master View-The Mansions","02532":"Mediterranean Clusters","02533":"Oasis Clusters","025576":"The Mansions","02534":"Tropical Clusters"},"4916":{"05898":"Cluster A","05899":"Cluster B","05900":"Cluster C","05901":"Cluster D","05902":"Cluster E","05903":"Cluster F","04917":"Frond A","04918":"Frond B","04919":"Frond C","04920":"Frond D","08471":"Jumeirah Heights Tower A","08474":"Jumeirah Heights Tower B","08477":"Jumeirah Heights Tower C","08480":"Jumeirah Heights Tower E","04921":"Loft Cluster","021641":"Loft Cluster East","025285":"Loft Cluster West"},"3619":{"04804":"Commercial Centre"},"4934":{"04935":"Coral Island","04936":"Germany Island","04937":"Jasmine Gardens","06621":"Lebanon World Islands","04938":"Oqyana","05974":"Pearl Island","04939":"Perseus - Rostov Island","06396":"The Heart Of Europe","06426":"The Mont Royal Hotel","06103":"Tropical Island"},"8689":{"08704":"Cordoba","08707":"Golf Tower 3","08701":"Granada","08908":"Hacienda","08698":"Mallorca","08695":"Marbella","08692":"Valencia"},"3616":{"04796":"Cornich Ras Al Khaima"},"1831":{"04689":"Corniche Ajman"},"1809":{"04768":"Corniche Al Fujairah"},"9406":{"025555":"Creek Golf & Yacht Club","09409":"Creek Views Villa","09415":"Golf Course Views Villa","025606":"Lake View Villas","09412":"Lakes Views Villa"},"3617":{"04797":"Dana Island"},"6333":{"06339":"Dana Tower","06336":"Morjan Tower"},"34":{"03338":"Deema (all)","02901":"Deema 1","02902":"Deema 2","02903":"Deema 3","02904":"Deema 4","02905":"Forat","013433":"Ghadeer","02906":"Ghadeer (all)","05636":"Ghadeer 1","05637":"Ghadeer 2","03339":"Hattan (all)","02907":"Hattan 1","02908":"Hattan 2","02909":"Hattan 3","013436":"Hattan E1","013439":"Hattan E2","017384":"Hattan E3","013442":"Hattan L1","013445":"Hattan L2","03340":"Maeen (all)","02911":"Maeen 1","02912":"Maeen 2","02913":"Maeen 3","05704":"Maeen 4","02914":"Maeen 5","07423":"The Lakes","015185":"Zulal (all)","02915":"Zulal 1","02916":"Zulal 2","02917":"Zulal 3","03341":"Zulal 4"},"3576":{"04517":"Defence Street"},"3577":{"04518":"Desert Village"},"3581":{"04527":"Desert Village","05694":"Rihan Heights"},"6132":{"09738":"District 11-Jade At The Fields","08905":"District One","06744":"Dubai Hills Estate","09626":"Mediterranean","06098":"Meydan Sobha","07822":"Millenium Villas","08004":"Millennium Square","06135":"Mohammad Bin Rashid City","06741":"Park Heights","08902":"Sobha Hartland","025327":"Viridian At The Fields"},"6006":{"06007":"Dubai Studio City","09325":"Glitz 1","09328":"Glitz 2","09331":"Glitz 3"},"5795":{"05796":"Emirates Golf Course Residences"},"1813":{"04911":"Emirates Modern Industrial"},"6066":{"06835":"Falcon Tower 1"},"115":{"021656":"Frond (all)","021644":"Frond A","021647":"Frond B","021650":"Frond C","021653":"Frond D"},"5758":{"05760":"Garden Homes","05759":"Signature Villas","05761":"Water Homes","07369":"Waterfront"},"3556":{"04384":"Gardenia","04385":"Jouri","04386":"Khuzama","04387":"Lailak","04388":"Narjis","04389":"Orchid"},"3580":{"04526":"Ghantoot"},"8232":{"08235":"Golf Community"},"3637":{"04889":"Halwan"},"1799":{"04890":"Hamriyah Free Zone"},"9760":{"09763":"Hanging Garden Tower"},"9205":{"09094":"Hayat 1","09097":"Hayat 2","025426":"Jenna 1","025429":"Jenna 11","025528":"Jenna 2","09391":"Safi","025531":"Warda","09274":"Zahra 1","09277":"Zahra 2","09211":"Zahra Apartments","025534":"Zahra Breeze","09208":"Zahra Townhouses"},"40":{"02585":"Heritage","06889":"Heritage Large","06892":"Heritage Small","02586":"Legacy","06109":"Legacy Large","06150":"Legacy Nova","06110":"Legacy Small","02587":"Meditterranean","06483":"Nova Villa","02588":"Regional","06111":"Regional Large","06112":"Regional Small"},"5678":{"05679":"Hills Abu Dhabi"},"3582":{"05743":"Hydra Avenue","04537":"Hydra Pavilion Tower","04538":"Hydra Premier Tower","06016":"Hydra Village","08767":"Zone 4","08770":"Zone 7","025164":"Zone 8"},"3591":{"08863":"ICAD - Industrial City Of Abu Dhabi","04574":"M246","04575":"M250","04576":"M251","04577":"Mussafah Industrial Area"},"3589":{"04560":"Jawaher Madinat MBZ","04561":"Mohamed Bin Zayed Centre","04562":"Palm Tower","04563":"Sahara Complex"},"1448":{"04798":"Julfar"},"3621":{"04806":"Julfar Commercial Tower","04807":"Julfar Residence Tower"},"8507":{"08510":"Julfar Towers"},"68":{"07894":"Jumeirah Living","07891":"Luxury Homes","02950":"World Trade Centre Residence","05895":"World Trade Centre Residence A","05896":"World Trade Centre Residence B","05897":"World Trade Centre Residence C"},"1478":{"04549":"Khalifa City B"},"1479":{"04550":"Khalifa City C"},"1810":{"04912":"Khor Al Beidah"},"35":{"03501":"Lake View"},"8851":{"025767":"Lincoln Park Tower","08854":"The Light Commercial Tower"},"3585":{"04555":"Lulu Island"},"3586":{"04556":"Madinat Zayed"},"3588":{"04559":"Madinat Zayed"},"1811":{"04913":"Magellan","04914":"Mistral"},"3635":{"023531":"Majestic Tower"},"3612":{"04745":"Manama"},"1484":{"06991":"Mangrove Village"},"3531":{"04279":"Mangrove Village","04280":"Seashore"},"1820":{"04649":"Marina Bay","04650":"Marina Promonade"},"3587":{"025390":"Marina Royale Compound","04557":"Marina Villas","04558":"Royal Marina Villas"},"3638":{"04891":"Maysaloon"},"25":{"02718":"Meadows 1","02719":"Meadows 2","02720":"Meadows 3","02721":"Meadows 4","02722":"Meadows 5","02723":"Meadows 6","02724":"Meadows 7","02725":"Meadows 8","02726":"Meadows 9"},"1833":{"04743":"Meeza","04744":"Nasa"},"1473":{"025609":"MF Villa"},"6004":{"06005":"Mira","07108":"Mira 1","07111":"Mira 2","07114":"Mira 3","07117":"Mira 4","07231":"Mira 5","06540":"Mira Oasis","07120":"Mira Oasis 1","07123":"Mira Oasis 2","07126":"Mira Oasis 3"},"3613":{"04760":"Muehat"},"5777":{"05778":"Muhaisnah 1","05783":"Muhaisnah 2","05784":"Muhaisnah 3","05785":"Muhaisnah 4","05779":"Sonapur"},"3614":{"04761":"Musheiref"},"5979":{"05980":"Nad Al Hamar"},"5986":{"05987":"Nad Al Sheba 1","05988":"Nad Al Sheba 2","05989":"Nad Al Sheba 3","05990":"Nad Al Sheba 4"},"1838":{"04762":"New Industrial Area"},"3539":{"04301":"North Hudayriat","04302":"South Hudayriat"},"7246":{"07249":"Orient Towers"},"7980":{"07986":"Oud Al Muteena","07983":"Villas Area"},"5809":{"05810":"Pearl Jumeirah Island"},"1475":{"025728":"Prestige"},"3620":{"04805":"RAK Industrial And Technology Park"},"3622":{"04808":"Ras Al Khaimah Gateway"},"5951":{"05952":"Ras Al Khor Industrial 1","05953":"Ras Al Khor Industrial 2","05954":"Ras Al Khor Industrial 3"},"9286":{"09289":"Rawdhat"},"1802":{"04893":"Rolla Square"},"6378":{"02079":"Schon Residences","06381":"Suburbia"},"3610":{"04615":"Shaab Al Askar"},"1803":{"04894":"Sharjah Airport Freezone (SAIF)"},"6495":{"06498":"Sonya Tower"},"3565":{"04480":"Sowwah Square Tower 1","04481":"Sowwah Square Tower 2","04482":"Sowwah Square Tower 3","04483":"Sowwah Square Tower 4"},"21":{"02918":"Springs 1","02919":"Springs 10","02920":"Springs 11","02921":"Springs 12","07270":"Springs 13","02922":"Springs 14","02923":"Springs 15","02924":"Springs 2","02925":"Springs 3","02926":"Springs 4","02927":"Springs 5","02928":"Springs 6","02929":"Springs 7","02930":"Springs 8","02931":"Springs 9"},"3609":{"04614":"Tawam"},"6384":{"08719":"Techno Park"},"3625":{"04814":"Terrace Apartments","04815":"Yasmin Tower"},"1830":{"04688":"The Cavendish Tower"},"3623":{"04809":"The Cove"},"8184":{"08187":"The Cove Rotana"},"5684":{"05685":"The Square"},"1805":{"04906":"Umm Khanoor"},"6064":{"06065":"Umm Ramool"},"9469":{"09471":"West Tower"},"3598":{"04594":"Zayed Military City Tower 1","04595":"Zayed Military City Tower 2","04596":"Zayed Military City Tower 3","04597":"Zayed Military City Tower 4","04598":"Zayed Military City Tower 5","04599":"Zayed Military City Tower 6","04600":"Zayed Military City Tower 7","04601":"Zayed Military City Tower 8","04602":"Zayed Military City Tower 9"}};

    var current_agent_id = config.user.userid;

/***********pre-set*/

$(function(){

		$('#myForm input, #myForm select, #myForm textarea, #myForm a').prop('disabled', true);

			

	});

/* mark all check boxes */

function toggleChecked(status) {

				var value = [];

				var count =  0;

				$("#listings_row tbody input[type=checkbox]").each( function() {

				$(this).attr("checked",status);

	

				if( $(this).val() != ''){

                                        value.push($(this).val());

                                        count++;

				}

                                   

}); 

                                        value = value.toString();

                    if(screenname=='deals') { deals_checkboxes(value); };

					if(screenname=='leads') { leads_checkboxes(value); };

					if(screenname=='landlord') { landlord_checkboxes(value); };

					if(screenname=='accounts' || screenname=='developers_accounts' ){ accounts_checkboxes(value); };

                    if(screenname=='developers_listings'){ developers_checkboxes(value); };



					var controller = '';

					if(screenname=='landlord'){

						controller = 'generate_landlord';

					}else if(screenname=='developers_customers'){

                                            	controller = 'developers_customers';

                                        }

					else{

						controller = 'generate';

					}

				        $('#emailPDF').val(value);

					$('#exportPDF').val(value);

					$('#emailCSV').val(value);

					

                                        $('#exportPDFIds').val(value.toString());

                                        $('#emailHTML').val(value);

                                        $('#bulk_change_items_count').html(count);

                                        $('#bulk_update_ids').val(value);

					$('#ExportToPDF').html('<div style="display:none;" id="downloadPDFtables_animation"><img src="'+mainurl+'application/views/images/ajax-loader.gif" width="48" height="48" /><br>Download PDF in progress. Please wait.</div><a id="downloadPDFtables_div" class="popup_a" href="'+mainurl+'index.php/'+controller+'/exportPDF?exportPDF='+value+'"><img src="'+mainurl+'application/views/images/pdf_big.png?ts=10" width="32" height="32"><br>Download PDF</a>'); // update download button link

					$('#ExportToCSV').html('<div style="display:none;" id="downloadCSV_animation"><img src="'+mainurl+'application/views/images/ajax-loader.gif" width="48" height="48" /><br>Download CSV in progress. Please wait.</div><a id="downloadCSV_div" class="popup_a" href="'+mainurl+'index.php/'+controller+'/exportCSV?exportCSV='+value+'"><img src="'+mainurl+'application/views/images/excel_big.png?ts=10" width="32" height="32"><br>Download Excel</a>'); // update download button link

					$('#email_count').text(count);

					$('#ExportToPDFbrochure').html('<div style="display:none;" id="downloadPDF_animation"><img src="'+mainurl+'application/views/images/ajax-loader.gif" width="48" height="48" /><br>Download PDF Brochure in progress. Please wait.</div><a id="downloadPDF_div" class="popup_a" href="'+mainurl+'index.php/'+controller+'/emailPDF?emailPDF='+value+'&export=yes"><img src="'+mainurl+'application/views/images/pdf_big.png?ts=10" width="32" height="32"><br>Download PDF Brochure</a>'); // update download button link

					

					if(screenname=='landlord' || screenname=='leads' || screenname=='listings'){

						setSelectedCheckboxes();

					}

					

			}

function toggleChecked2(status) {

					var value = [];

					var count = 0;

					

					$("#matching_properties input[type=checkbox]").each( function() {

						$(this).attr("checked",status);

						if($(this).val()!=''){

								value+=$(this).attr('value')+',';

								count++;

						}

							

					$('#email_count').html(count);

					$('#listing_ids').val(value);

					}); 

			}

function toggleCheckedPopUp(status) {

	

					var value = [];

					var count = 0;

					

					$("#dataTables-owner-rentals input[type=checkbox]").each( function() {

						

						$(this).attr("checked",status);

						

						//if($(this).val()!=''){

								//value+=$(this).attr('value')+',';

								//count++;

					//	}

							

					//$('#email_count').html(count);

					//$('#listing_ids').val(value);

					}); 

			}

			

/* enable & disable popup */

function disable_popup() {	

			$(".popup_a").each(function() {

				if( isFormPopup($(this).attr('id')) ){

                   $(this).attr('href','# Disabled');

				}

            });

			$('select, input').removeClass('form_fields_error');

			$('.auto_location').attr('id', 'asdasdas');

		

}





    function fnRefreshDatatabe(dtName){

    $('#'+dtName).dataTable().fnDraw();

}



/* default border color*/

function default_border_color_form_table () {

	$('#table_1'). animate({ borderTopColor: '#CCCCCC', borderRightColor: '#CCCCCC', borderLeftColor: '#CCCCCC', borderBottomColor: '#CCCCCC' }, 500);

}

function enable_popup() {	

			$(".popup_a").each(function() {

               	if( isFormPopup($(this).attr('id')) ){

                   $(this).attr('href','#?w=740');

				}

			$('.auto_location').attr('id', '_auto_location');

			

            });

}





/*************************AGENTS*********/



//get agents with selected 

 $.getJSON(config.siteUrl+'common/getAgents', function(data){

	 var agentback = data;

  //check for agents

  if(config.user.user_access==3)

  {

     var len = data.length;

    for (var i = 0; i< len; i++) {

	

	   if(admid == data[i].id)

	{

        html += '<option selected="" value="' + data[i].id + '">' + data[i].name + '</option>';

   }else{

        html += '<option value="' + data[i].id + '">' + data[i].name + '</option>';

		}

    }

  }else{

    var html = "<option  value=''>Select</option>";

   

    var len = data.length;

    for (var i = 0; i< len; i++) {

	html += '<option value="' + data[i].id + '">' + data[i].name + '</option>';

	

	

    }

}

	$('#agent_id').append(html);

	$('#reffered_by_agent').append(html);

	$('#agent_rent_sold').append(html);

	

	//for all agents

	var html_all = "<option  value=''>Select</option>";

	 var html_name = "<option  value=''>Select</option>";

    var len = agentback.length;

    for (var i = 0; i< len; i++) {

	html_all += '<option value="' + agentback[i].id + '">' + agentback[i].name + '</option>';

	html_name += '<option value="' + agentback[i].name + '">' + agentback[i].name + '</option>';

	}

	$('#14').append(html_all);

	$('#assigned_to_id').append(html_all);

	

	

	//for listings

	if(screenname == 'listings')

	{

		

		$('#assigned_to_id_addtask').append(html_all);

	}

		// for leads page

		if(screenname == 'leads')

		{

			$('#agent_id_2').append(html_all);

			$('#agent_id_3').append(html_all);

			$('#agent_id_4').append(html_all);

			$('#agent_id_5').append(html_all);

			$('#agent_1_id').append(html_all);

			$('#agent_2_id').append(html_all);

			$('#agent_3_id').append(html_all);

			$('#agent_4_id').append(html_all);

			$('#as_created_by').append(html_all);

			$('#25').append(html_all);

			$('#26').append(html_all);

			$('#27').append(html_all);

			$('#28').append(html_all);

			$('#29').append(html_all);

			

			

		}

		// for deals page

		if(screenname == 'deals')

		{

			$('#agent_1_id').append(html_all);

			$('#agent_2_id').append(html_all);

			$('#agent_3_id').append(html_all);

			$('#as_created_by_name').append(html_all);

			$('#16').append(html_all);

			

			

		}

		//landlords/contacts

		if(screenname == 'landlord')

		{

			$('#26').append(html_all);

			$('#56').append(html_all);

		}

		//for history

		if(screenname == 'history')

		{

			

			$('#0').append(html_name);

		}

	

	// $('.selectpicker').selectpicker('refresh');

});

 

 

function agentsOnDemand(control_id)

{

	$.getJSON(config.siteUrl+'common/getAgents', function(data){

	 var agentback = data;



	

	

	//for all agents

	var html_all = "<option  value=''>Select</option>";

    var len = agentback.length;

    for (var i = 0; i< len; i++) {

	html_all += '<option value="' + agentback[i].id + '">' + agentback[i].name + '</option>';

	}

	

	$('#'+control_id).append(html_all);

	

	$('#'+control_id).selectpicker('refresh');

});

}

 function SaveAndClode(){

			$('#fade , .popup_block').fadeOut(function() {

				$('#fade, a.close').remove();  

				/* get stats */	

				//get_states($('#id').val())

			});

	 }

/**

* This funtion checks if the given id is of form popup assuming popup id is "popup-ref" 

**/

function isFormPopup(id)

{

	return (id && $.inArray('popup', id.split('-')) != -1);

}

/* make first letter capital */

function ucfirst(str,force){

          str=force ? str.toLowerCase() : str;

          return str.replace(/(\b)([a-zA-Z])/,

                   function(firstLetter){

                      return   firstLetter.toUpperCase();

                   });

     }



/* function to redraw datatable */

$.fn.dataTableExt.oApi.fnFilterClear  = function ( oSettings )

{

    oSettings.oPreviousSearch.sSearch = "";



    if ( typeof oSettings.aanFeatures.f != 'undefined' )

    {

        var n = oSettings.aanFeatures.f;

        for ( var i=0, iLen=n.length ; i<iLen ; i++ )

        {

            $('input', n[i]).val( '' );

        }

    }



    for ( var i=0, iLen=oSettings.aoPreSearchCols.length ; i<iLen ; i++ )

    {

        oSettings.aoPreSearchCols[i].sSearch = "";

    }

	

    oSettings.oApi._fnReDraw( oSettings );

}



/* popup script */



	$(document).ready(function(){

		

		//When you click on a link with class of poplight and the href starts with a # 

	//live("click", function (){

		$('body').on("click", "a.popup_a[href^=#]" , function() {

			

				var extraHeight	=	0;

			    var extraClass	=	'';

			    //console.log("anchor with class popup_a clicked!");

			    if($(this).attr('id')=='copy_listing_popupid' && $('#id').val() < 1){

			    	

					$('#checkbox_error').show(400); 

					return false;

				}

				//add deal

				if($(this).attr('id')=='add_deal_popup_link' && $('#id').val() < 1){

					$('#checkbox_error').show(400); 

					return false;

				}

				if($(this).attr('id')=='add_deal_popup_link' && $('#id').val()!=0){

					var extraHeight=250;

					$.post(mainurl+"common/add_deal_popup", { 

						id:  $('#id').val()

						},

						function(data) {

						$("#add_deal_window").html(data);

					});

				}

				//add lead

				if($(this).attr('id')=='add_lead_popup_link' && $('#id').val() < 1){

					$('#checkbox_error').show(400); 

					return false;

				}

				if($(this).attr('id')=='add_lead_popup_link' && $('#id').val() != 0){

						var extraHeight=250;

						//populate agents dropdown

						//agentsOnDemand('assigned_to_id_addtask');

						$.post(mainurl + "common/add_lead_popup", { 

							id:  $('#id').val()

							},

							function(data) {

							$("#add_lead_window").html(data);

			         });

				}

				//add task

				if($(this).attr('id')=='add_task_popup_link' && $('#id').val() < 1){

					$('#checkbox_error').show(400); 

					return false;

				}

				if($(this).attr('id')=='add_task_popup_link' && $('#id').val() != 0){

						var extraHeight=250;

						//populate agents dropdown

						agentsOnDemand('assigned_to_id_addtask');

						$.post(mainurl + "common/add_task_popup", { 

							id:  $('#id').val()

							},

							function(data) {

							$("#add_task_window").html(data);

			         });

				}

				//add events

				if($(this).attr('id')=='add_event_popup_link' && $('#id').val() < 1){

					$('#checkbox_error').show(400); 

					return false;

				}

				if($(this).attr('id')=='add_event_popup_link' && $('#id').val()!=0){

					

					agentsOnDemand('cal_id');

					var extraHeight=250;

					$.post(mainurl+"common/add_event_popup", { 

						id:  $('#id').val()

						},

						function(data) {

						$("#add_event_window").html(data);

					});

				}

				//popup images

				

				if($(this).attr('id')=='view_photo_box' || $(this).attr('rel')=='view_photo_box'){

				

						/*Image upload*/

					var options_img = {

						 type: '',

						 rand_key: $('#rand_key').val(),

						 controller: 'listings'

           			 };

      					 $("#file_upload").UPLOAD_IMAGES(options_img);

	 				  /*End image upload*/ 

				}

				//popup owners

					if($(this).attr('id')=='add_landlord_popup_link' || $(this).attr('rel')=='add_landlord_popup'){

						

						var extraHeight=250;

			

					$.post(mainurl+"common/view_landlord_popup", { 

						id:  $('#id').val()

						},

						function(data) {

						$("#view_landlord_window").html('');

						$("#add_landlord_window").html(data);

					});

		        }

				

				//popup leads

				if($(this).attr('id')=='view_lead_popup_link' && $('#id').val()!=0){

			var extraHeight=250;

			$('#popup_record_reference_VL').text($('#ref').val());

			$.post(mainurl+"common/view_lead_popup", { 

				id:  $('#id').val()

				},

				function(data) {

				$("#view_lead_window").html(data);

			});

			}

			

			/* listing terminal */

			

		if($(this).attr('id')=='view_terminal_popup_link' || $(this).attr('link')=='view_terminal_popup_link'){

			var listing_id  = $(this).attr('listing_id');

			var listing_ref = $(this).attr('listing_ref');

            var landlord_id = $(this).attr('landlord_id');

	

			if(!listing_id){

				listing_id = $('#id').val();

			}

			if(!listing_ref){

				listing_ref = $('#ref').val();

			}

			if(!landlord_id){

				landlord_id = $('#landlord_id').val();

			}

			$("#view_terminal_window").html('');

			if(listing_id>0){

				

			var ts = Math.round((new Date()).getTime() / 1000);

			var extraHeight=250;

			$.post(mainurl+"terminals/rentals_viewings/?ts="+ts, { 

				id:  listing_id,

				ref: listing_ref,

                landlord_id: landlord_id

				},

				function(data) {

				$("#view_terminal_window").html(data);

				$('#myForm_viewings #listing_id').val(listing_id)

			});

			}else{

				alert('Please save listing first to add viewings.');

				return false;

				

			}

		}

			

			

			//leads section

				if($(this).attr('rel')=='property_requirements_popup'){

					

			var extraHeight=250;

			extraClass = 'req_popup';

			property_requirements_popup_id =  $(this).attr('popup_id');

			

			var prevId="";

			if (property_requirements_popup_id > 1) { 

				prevId=property_requirements_popup_id - 1; 

			

				var req_data=$('#property_req_'+prevId+'_data').val();

				if (req_data=="") {	

					alert ('Please add details for Property ' + prevId + ' first.'); return false;//exit(); 

				}

			}

			

			$("#prop_req_form")[ 0 ].reset();

			

			

			plot_requirements('['+$('#property_req_'+property_requirements_popup_id).val()+']', property_requirements_popup_id);

		}

		

		//lead page ref section

		if($(this).attr('rel')=='view_linktolistings_leads_popup'){

			var extraHeight=250;

			$("#linklistings_row #reset_filter").click();

			listing_popup_id = $(this).attr('listing_popup_id');

			

			var prevId="";

			if (listing_popup_id > 1) { 

				prevId=listing_popup_id - 1; 

			

				var req_data=$('#property_req_'+prevId+'_data').val();

				if (req_data=="") {	

					alert ('Please add details for Property ' + prevId + ' first.'); exit(); 

				}

			}

			

			

			//selectListings();

		}

			

			

		   if($(this).attr('rel')=='add_view_multi_landlord_popup'){

                var extraHeight=180;

                var landlord_id_list = $(this).parent().parent().find('.ll_id_list_selector').val();

                var  selected = landlord_id_list.split(',');

                selected = selected.filter(function(v) {

                    return (v != '');

                }).join(",");

				

                var type = $(this).attr('type') || '';

                if($('#add_contact').length > 0) {

                    $('#add_contact').attr('type',type);

                }

                $.post(mainurl+"common/add_view_multi_landlord_popup/"+type, {

                        id:  $('#id').val(),

                        selected: selected

                    },

                    function(data) {

                        $("#add_view_multi_landlord_window").html(data);

                    }

                );

            }	

		

			<!---------------------view on table header section-------->

				if($(this).attr('id')=='view_task_popup_link' && $('#id').val()!=0){

					var extraHeight=250;

					$.post(mainurl+"common/view_task_popup", { 

						id:  $('#id').val()

						},

						function(data) {

						$("#view_task_window").html(data);

					});

				}

				if($(this).attr('id')=='view_event_popup_link' && $('#id').val()!=0){

					var extraHeight=250;

					$.post(mainurl+"common/view_event_popup", { 

						id:  $('#id').val()

						},

						function(data) {

						$("#view_event_window").html(data);

					});

				}

				

				if($(this).attr('id')=='view_lead_popup_link' && $('#id').val()!=0){

					var extraHeight=250;

					$.post(mainurl+"common/view_lead_popup", { 

						id:  $('#id').val()

						},

						function(data) {

						$("#view_lead_window").html(data);

					});

				}

				

				if($(this).attr('id')=='view_deal_popup_link' && $('#id').val()!=0){

					var extraHeight=250;

					$.post(mainurl+"common/view_deal_popup", { 

						id:  $('#id').val()

						},

						function(data) {

						$("#view_deal_window").html(data);

					});

				}

		

				//view listings preview
			

	  // if($(this).attr('rel')=='view_html_preview'){
	   	if($(this).attr('id')=='popup_sd'){

	    	// seperate function on click event created,check that

	   //  	if($('#id').val()!=0){

	   //  		var extraHeight=250;

				// var id=$('#id').val();

				// var preview_url = mainurl+'preview/index/'+$('#rand_key').val()+'/'+$('#client_id').val()+'/'+current_agent_id+"/?l_id="+$('input#id').val();

				// //$("#preview_link").html('Direct Link: <a target="_blank" href="'+preview_url+'">'+preview_url+'</a>');

				// window.open(preview_url);

				// return;

				// /*$.post(mainurl+"preview/index/"+$('#rand_key').val()+'/'+$('#client_id').val()+'/', { 

				// 	id:  id

				// 	},

				// 	function(data) {

				// 	$("#view_html_preview_window").html(data);

				// });*/

	   //  	}else{

	   //  		alert("Please select a listing.");

	   //  		return false;

	   //  	}

			

		}

			<!----------------------end view section------------------->

			

			

			});

			

			

			



	});

	/*********************end popup*************/

var formDataChange = false;

	var formEnabled = false;

	

	 $(function() {

	 	//check if the edit or new button clicked

		$("body").on("click", '#myForm' ,function(event){

			if(formEnabled==false){

			 //  $('#showdata').css('color','red');

			  $('#errortxt').text('To edit or add new record please click on the edit or new button');

			   $('#errorMsg').fadeIn("slow");

			   setTimeout(function() {  

				   $('#errorMsg').fadeOut("slow");

			   }, 5000);

			}

		});

		

				

		/* Check for value change in form */



		$("body").on('change','#myForm',function (event)

		{

		   formDataChange = true;

		});

		

	 });

	 

window.onbeforeunload = function() { 

		  if (formDataChange) {

		    return 'Data not saved!';

		  }

		}



function genRandKey(){

	

	var curMsnew = new Date().getTime();

	var randomnumber=Math.floor(Math.random()*10001);

	var genRandKey=curMsnew+''+randomnumber; //convert to string

	return genRandKey;//.substring(0,20);

	

}

function get_notifications() {

		

		$.post(mainurl+"users/get_notifications/", { 

		},

		   function(data) {

			 var data_split;  

			 data_split = data.split('{break}');

			 $('#noti_count').html(data_split[0]);

		     $('#noti_body').html(data_split[1]);

		   //alert('sss');

		});

		  

}



//get stats			

function get_states(id){

	var jsonstats = null;

	if(screenname == "landlord") { screenname = "contacts";}

	$.getJSON(mainurl+screenname+"/get_"+screenname+"_stats/"+id, function(jsonstats){ 

				$.each(jsonstats, function(key, val) {

				if(screenname=="listings" & key=="leads") { $('#leads').val(val); }

				$('#'+key+'_stats').text('('+val+')');

			});	

	});

}

							

//end stats

$(function(){
	$("#locationMap").on("shown.bs.modal", function() {
        google.maps.event.trigger(map, 'resize');
    });
	  $('#showme_map').click(function(e) 
		   {   
		      e.preventDefault();
		      //google.maps.event.trigger(map, "resize");
		  
      
		  });
   $('#popup_sd').click(function(e) 
   {   
      e.preventDefault();
     
      	if($('#id').val()!=0){

	    		
				var id=$('#id').val();

				var preview_url = mainurl+'preview/index/'+$('#rand_key').val()+'/'+$('#client_id').val()+'/'+current_agent_id+"/?l_id="+$('input#id').val();

				window.open(preview_url);

				return;

				

	    	}else{

	    		alert("Please select a listing.");
	    		return false;
	    		// $('#infotxt').text("Please select a listing first!");
	    		
	    		//  $('#sha').animate({ 'color': '#49AC44'}, "slow"),

       //                                                      $('#sha').fadeIn("slow"),

       //                                                      setTimeout(function() {  

       //                                                          $('#sha').fadeOut("slow")

       //                                                      }, 5000);

	    	}
   });
});

/* functions for buttons */

$(document).ready(function () {

	//initCheckbox();

	$("#new").click(function () {	

	// enable save button

	$('#save').prop('disabled', false);	

		if(screenname=="leads"){

			var landlord_id_lead     = $("#landlord_id").val();

			var landlord_name_lead   = $("#landlord_name").val();

			var landlord_mobile_lead = $("#landlord_mobile").val();

			var landlord_email_lead = $("#landlord_email").val();

		}

	    $("#myForm")[ 0 ].reset();

	    $("#myForm input").attr("checked", false);

	    arr_images.length = 0; //reset the array for images

		

	    if(screenname=='listings' || screenname == "quality_score" || screenname == "leads" || screenname == "deals" || screenname=='landlord' || screenname=='contacts'){

		

			$('#rand_key').val(genRandKey());

			var value='';

            var portalValue = [];

			var count=0;

			$('#tinymce').html(''); 

			// shafiq code
			$("#area_location_id").addClass("required form_fields_error");

			//get portals and count START

			$('#portals #global_portals input:checkbox').each(function() {

                                value+='{'+$(this).val()+'}';

                                count++;

                        });

                        $('#portals #crm_portals input:checkbox').each(function() {

                            portalValue.push($(this).val());

                            count++;

                        });



                        $('#portals_name').val(value);

                        $('#portals_name_arr').val(JSON.stringify(portalValue));

                        $('#portals_count').val(count);	

			// generate key



		}

		

		if(screenname=="leads"){

			$("#landlord_id").val(landlord_id_lead);

			$("#landlord_name").val(landlord_name_lead);

			$("#landlord_mobile").val(landlord_mobile_lead);

			$("#landlord_email").val(landlord_email_lead);

		}

		if(screenname=="listings" || screenname == "quality_score"){

			//marklisting("","");



			$("#features input").attr("checked", false);

			$("#portals input").attr("checked", 'checked');

			$("#showimages").html('No images found');

			$("#photos").val(0);

			$("#pdf_download").html('');

            $('#view_video, #delete_video').css('display','none');

            $('#flagCountry').empty();

            if($('.delete_all').length > 0) {

                $('.delete_all').addClass('inactive');

            }

		}



		$("#area_location_id").find('option:first').attr('selected', 'selected').parent('select');  // set area location to first value  (otherwise reads what ever was previously shown)

		$("#sub_area_location_id").find('option:first').attr('selected', 'selected').parent('select'); // set sub_area_loc to first value  (otherwise reads what ever was previously shown)

		$("#image-sort").html('');  // set images to blank (otherwise displays the images from the previously selected listing)

		

		$("#title").text('Add New record');

		$('#update, #edit, #new, #placeholder').css('display', 'none'); /* This shows the update button when a filed is selected */ 

		$('#Save, #cancel').css('display', 'inline'); /* This shows the update button when a filed is selected */   

		$('#myForm input, #myForm select, #myForm textarea, #myForm a').prop('disabled', false);

		$('#area_location_id, #sub_area_location_id').prop('disabled', true);

                $('#city_id').prop('disabled', true);

		$('#sharingdata').html('');

                 $('#flagCountry').empty(); 

		formEnabled=true;

		enable_popup();

		$('#listing_stats, #shownotes, #showDocuments, #showleadshistory').text('');

		if(screenname == 'landlord'){

			

              //      $("#myForm").validate({rules: { price: { number: true}, size: { number: true },  email: { email:true, require_from_group: [1, ".phone-group"]}, mobile_no_new: { require_from_group: [1, ".phone-group"]} } , errorClass: 'form_fields_error',  errorPlacement: function(error, element) { }}).form() ;

//                    $("#mobile_no_new").addClass('form_fields_error');

//                    $("#email").addClass('form_fields_error');

//                    $('#id').val('');

                

			

			}else if(screenname == 'users'){

                    $("#myForm").validate({rules: {name: { required: true},price: { number: true}, size: { number: true },email: { email:true}} , errorClass: 'form_fields_error',  errorPlacement: function(error, element) { }}).form() ;

                }else{

                    // $("#myForm").validate({rules: { price: { number: true}, size: { number: true }} , errorClass: 'form_fields_error',  errorPlacement: function(error, element) { }}).form() ;

                }

		

		

		$('#table_1'). animate({ borderTopColor: '#467EB8', borderRightColor: '#467EB8', borderLeftColor: '#467EB8', borderBottomColor: '#467EB8' }, 500);

         

		 

		 

	

                  

	});

	

		$("#cancel").click(function () {

			

	   // $("#myForm")[ 0 ].reset();

		$("#title").text('Add New record');

		$('#update, #Save, #edit, #cancel').css('display', 'none'); /* This shows the update button when a filed is selected */

		$('#new').css('display', 'inline');    

		$('#myForm input, #myForm select, #myForm textarea, #myForm a').prop('disabled', true);

		$('#id').val(0);

                $('#flagCountry').empty(); 

                $('#grad').remove();

                $('#score').removeAttr("style");

                $('#status_p').val('');

                $('#password').val('');

		//

		if(screenname=="listings"){

		if(last_id=='' || active_tab=='tab2'){

			$("#myForm")[ 0 ].reset();

		}

		}

		if (last_id>0){

			getSingleRow(last_id);

		}

		

		arr_images.length = 0; //reset the array of images

		formEnabled=false;

		formDataChange = false;

		disable_popup();

		

		default_border_color_form_table ();

		         



			  

		

	});

	

	$("#edit").click(function () {

		$('#edit').css('display', 'none'); /* This shows the update button when a filed is selected */ 

		$('#update').css('display', 'inline'); /* This shows the update button when a filed is selected */ 

		$('#Save').css('display', 'none'); /* This shows the update button when a filed is selected */ 

		$('#new').css('display', 'none'); 

		$('#cancel').css('display', 'inline');

                

		$('#myForm input, #myForm select, #myForm textarea, #myForm a').prop('disabled', false);

		formEnabled=true;

		enable_popup();

		

		$('#table_1'). animate({ borderTopColor: '#B9D40F', borderRightColor: '#B9D40F', borderLeftColor: '#B9D40F', borderBottomColor: '#B9D40F' }, 500);

                

			

	});

        

                



			

});



/* end */

/* function to remove html tags from text */

function convertHtmlToText(data) {

    var inputText = data;

    var returnText = "" + inputText;



    //-- remove BR tags and replace them with line break

    returnText=returnText.replace(/<br>/gi, "\n");

    returnText=returnText.replace(/<br\s\/>/gi, "\n");

    returnText=returnText.replace(/<br\/>/gi, "\n");



    //-- remove P and A tags but preserve what's inside of them

   

    returnText=returnText.replace(/<a.*href="(.*?)".*>(.*?)<\/a>/gi, " $2 ($1)");



    //-- remove all inside SCRIPT and STYLE tags

    returnText=returnText.replace(/<script.*>[\w\W]{1,}(.*?)[\w\W]{1,}<\/script>/gi, "");

    returnText=returnText.replace(/<style.*>[\w\W]{1,}(.*?)[\w\W]{1,}<\/style>/gi, "");

    //-- remove all else

    returnText=returnText.replace(/<(?:.|\s)*?>/g, "");



    //-- get rid of more than 2 multiple line breaks:

    returnText=returnText.replace(/(?:(?:\r\n|\r|\n)\s*){2,}/gim, "\n\n");



    //-- get rid of more than 2 spaces:

    returnText = returnText.replace(/ +(?= )/g,'');



    //-- get rid of html-encoded characters:

    returnText=returnText.replace(/&nbsp;/gi," ");

    returnText=returnText.replace(/&amp;/gi,"&");

    returnText=returnText.replace(/&quot;/gi,'"');

    returnText=returnText.replace(/&lt;/gi,'<');

    returnText=returnText.replace(/&gt;/gi,'>');



    //-- return

    return returnText;

}



// get notes function

function get_notes(screen_name,record_id) {

		var notesx='';

		//$("#notes, #notesx").val('');

		$("#shownotes").html('');

		$.getJSON(mainurl+screen_name+"/notes/"+record_id, function(json){ 

		$("#shownotes").text('');

		$.each(json, function(key, id) {

                    if(key==0) { notesx='Latest: '+id.date; if(screenname=='accounts' | screenname=='developers_accounts'| screenname=='activities' | screenname=='landlord') { notesx+='\nUser: '+id.user_name; notesx+='\nNote: '+id.notes; } }

                    $("#shownotes").append('<div style="border-bottom:#999 solid 1px; padding: 0px 0px 5px 0px; margin: 5px 5px 0px 5px;"><div style="display:inline-block; width:50%; padding: 3px 0 3px 0;">User: '+id.user_name+'</div><div style="display:inline-block;">Date: '+id.date+'</div><div style="padding:3px 0 3px 0;">Note: '+id.notes+'</div></div>');

					

					

		});

		$("#notesx").val(notesx);

		//if(screenname=='activities') {

		//	$("#notesx").val('');

		//}

		   

		 

		});

}





//auto complete locations

$(document).ready(function () {

    $('#auto_location_field').autocomplete({

     	minLength:3,

        source: mainurl+"common/auto_location/",

		 select: function (event, ui) {

            

			//alert(ui.item.area_location_id+' '+ui.item.value)

			var width='';

			if(screenname=='deals'){

				width = '180px';

			}else{

				width = '';

			}

			$('#region_id').val(ui.item.region_id);

	

	

	// set location (get correct select list using function, then set value)		

			var value = ui.item.region_id;

			var snum_dropdown ='';

			snum_dropdown += '<option value="" selected="selected">Select</option>';

			$.each(location_json_array[value], function(key, val) {

				snum_dropdown += '<option value="'+ key*1 +'" >'+ val +'</option>';	

			});

	

			jQuery('#area_location_id').html(snum_dropdown);

			$('#area_location_id').val(ui.item.area_location_id);

			jQuery('#area_location_id').attr('disabled',false);

			jQuery('#sub_area_location_id').attr('disabled',false);

	

	// set location (get correct select list using function, then set value)				

			var value = ui.item.area_location_id;

			

			

			var snum_dropdown ='';

			snum_dropdown += '<option value="" selected="selected">Select</option>';

			$.each(sub_location_json_array[value], function(key, val) {

				snum_dropdown += '<option value="'+ key*1 +'" >'+ val +'</option>';	

			});

			

			 

			jQuery('#sub_area_location_id').html(snum_dropdown);

			$('#sub_area_location_id').val(ui.item.sub_area_location_id);

			

			$('#region_id, #area_location_id, #sub_area_location_id').removeClass('form_fields_error');

                        if(screenname=='Rentals' || screenname=='Sales' || screenname=='listings'){

                            marklisting(emirate_coordinates[ui.item.region_id][0],emirate_coordinates[ui.item.region_id][1]);

                            $('#lat').val(emirate_coordinates[ui.item.region_id][0]);

                            $('#lon').val(emirate_coordinates[ui.item.region_id][1]);

                            setCoordinates(ui.item.area_location_id);

                            if(ui.item.sub_area_location_id>0){

                                setCoordinates(ui.item.sub_area_location_id);

                            }

                            

                            $('#data_auto_location img').trigger('click');

                        }

			

        }

    });

});



function isValidEmailAddress(emailAddress) {

    var pattern = new RegExp(/^((([a-z]|\d|[!#\$%&'\*\+\-\/=\?\^_`{\|}~]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])+(\.([a-z]|\d|[!#\$%&'\*\+\-\/=\?\^_`{\|}~]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])+)*)|((\x22)((((\x20|\x09)*(\x0d\x0a))?(\x20|\x09)+)?(([\x01-\x08\x0b\x0c\x0e-\x1f\x7f]|\x21|[\x23-\x5b]|[\x5d-\x7e]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(\\([\x01-\x09\x0b\x0c\x0d-\x7f]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]))))*(((\x20|\x09)*(\x0d\x0a))?(\x20|\x09)+)?(\x22)))@((([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.)+(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.?$/i);

    return pattern.test(emailAddress);

};







/* function set/get cookies */

function setStoreData(prefix,id,data){

    if(id){

           localStorage.setItem(prefix+id, data);

    }else{

           localStorage.setItem(prefix, data);

    }

}



function getStoreData(prefix,id){

    if(id){

        return localStorage.getItem(prefix+id);

    }else{

        return localStorage.getItem(prefix);

    }

}



function clearStoreData(key){

    if(key){

        localStorage.removeItem(key);

    }else{

        localStorage.clear();

    }

}



function chkListValue(list, value, separator, counts) {

    separator = separator || ",";

    var values = ArrayUnique(list.split(separator));

    var count = 0;

    for(var i = 0 ; i < values.length ; i++) {

      if(values[i] == value && counts !== 1) {

        return true;

      }

      if(values[i]>0){

          count++;

      }

    }

    

    if(counts==1){

        return count;

    }

}



function removeListValue(list, value, separator, duplicate) {

    separator = separator || ",";

    var values = list.split(separator);

    values = ArrayUnique(values);

    for(var i = 0 ; i < values.length ; i++) {

      if(values[i] == value && duplicate!=1) {

        values.splice(i, 1);

      }

    }

    return values.join(separator);

}



function ArrayUnique(list) {

  var result = [];

  $.each(list, function(i, e) {

    if ($.inArray(e, result) == -1) result.push(e);

  });

  return result;

}

/* function set/get cookies end */

function getStatusHistory(screen_name, record_id){

    $.getJSON(mainurl+screen_name+"/statusHistory/"+record_id, function(json){

        $("#showleadshistory").text('');

        $.each(json, function(key, id) {

            $("#showleadshistory").append('<div style="border-bottom:#999 solid 1px; padding: 0px 0px 5px 0px; margin: 5px 5px 0px 5px;"><div style="display:inline-block; width:50%; padding: 3px 0 3px 0;">User: '+id.user_name+'</div><div style="display:inline-block;  width:50%; padding: 3px 0 3px 0; text-align:right;">Date: '+id.date_updated+'</div><div style="padding:3px 0 3px 0;">Status: '+id.status+'</div><div style="padding:3px 0 3px 0;">Sub Status: '+id.sub_status+'</div></div>');

        });

    });

}

function plot_notes(notes_screen, notes) {	

	//[{"user_name":"IPF", "notes":"{ user_name   Adnan    notes   Handover in Aug 13 end. Oqood to be paid by Buyer. Wants a Cash Buyer. ", "date":"14-07-2013 14:25"}", "date":"12-11-2013 16:56"}]

	//"notes":[{"notes":"This is test notes for ref=R-6","date":"2016-01-27 09:20","user_name":"Admin S"},{"notes":"Test 2 for same","date":"2016-01-27 09:52","user_name":"Admin S"}]

	//"notes":[{"notes":"client looking for 1BR Apt","date":"2016-01-27 11:11","user_name":"Royal Home Team - A.M"}]

		$("#notes, #notesx").val(''); 

		$("#shownotes").html('');

		var notesx = '';

		

		try {

			

			//var getNotes = jQuery.parseJSON(notes);

			$.each(notes, function(id, key) {

				

				if(id==0) { notesx='Latest: '+this.date+" "; if(screenname=='accounts' | screenname=='activities' | screenname=='landlord' | screenname=='leads') { notesx+='\nUser: '+this.user_name+" "; notesx+='\nNote: '+this.notes; } }

				$("#shownotes").append('<div style="border-bottom:#999 solid 1px; padding: 0px 0px 5px 0px; margin: 5px 5px 0px 5px;"><div style="display:inline-block; width:50%; padding: 3px 0 3px 0;">User: '+this.user_name+'</div><div style="display:inline-block;  width:50%; padding: 3px 0 3px 0; text-align:right;">Date: '+this.date+'</div><div style="padding:3px 0 3px 0;">Note: '+this.notes+'</div></div>');

			});

		} catch( err ) {

			var re = /", "date":"[0-9]{2}-[0-9]{2}-[0-9]{4} [0-9]{2}:[0-9]{2}"}]/g;

			notes = notes.replace(re,']');

			try {

				

				var getNotes = jQuery.parseJSON(notes);

				

				$.each(getNotes, function(id, key) {

					alert("each two");

					if(id==0) { notesx='Latest: '+this.date+" "; if(screenname=='accounts' | screenname=='activities' | screenname=='landlord' | screenname=='leads') { notesx+='\nUser: '+this.user_name+" "; notesx+='\nNote: '+this.notes; } }

					$("#shownotes").append('<div style="border-bottom:#999 solid 1px; padding: 0px 0px 5px 0px; margin: 5px 5px 0px 5px;"><div style="display:inline-block; background-color:#E1E1E1; width:50%; padding: 3px 0 3px 0;">User: '+this.user_name+'</div><div style="display:inline-block; background-color:#E1E1E1;  width:50%; padding: 3px 0 3px 0; text-align:right;">Date: '+this.date+'</div><div style="padding:3px 0 3px 0;">Note: '+this.notes+'</div></div>');

				});



			} catch( err ) {

				notesx = "Notes are invalid";

			}

			

		}

		

		$("#notesx").val(notesx);   

}              



/* for dropdown and div hiding */

$(function() {

	

		$("body").on("click", ".click", function(event){

				

				//i commented these lines

		

			 if( ( $(this).attr('id')=='_remove_options' || $(this).attr('id')=='_add_options' ) && $('#listings_row input:checked').length == 0){

			 

				$('#checkbox_error').show(400);

			

			}else if(  (( $(this).attr('id')=='share_options' )  && $('#listings_row input:checked').length == 0 )){

                              

                              // $('.dropdown').slideUp(100);

                              // $("#datashare_options_default").slideDown(300).addClass('active');

                              // event.stopPropagation();

                             //   alert($("#datashare_options_default").attr('keyAccess'));



                               var accesskey = $("#datashare_options_default").attr('keyAccess');

                               if( accesskey != 'true'){

                                   $('#checkbox_error').show(400);

                                   return false;

                               }

                               

			}else if(( $(this).attr('id')=='action_options') && $('#id').val()==0){



				//$('#checkbox_error').show(400);



			}else if(( $(this).attr('id')=='view_options') && $('#id').val()==0){

				

				$('#checkbox_error').show(400);

				return false;

				

				

				}else{



				if($(this).attr('item')=="advance_search"){

					$("#dummy_div").css('display','');

				}

				if($(this).attr('id')=='view_options'){

					

					get_states($('#id').val())

				}

				id= $(this).attr('id');

				//$('.dropdown').slideUp(100);

				//$("#data"+id).slideDown(300).addClass('active');

                //$("#datashare_options_default").css('display','none');

				//event.stopPropagation();

			}

		});

						

		$("img").click(function(e) {

			$('.data').slideUp(100);

			$('#auto_location_field').val('');

		});

		

		$("body").on("click", ".overflow", function(event){

			$(this).parents('td').parents('tr').trigger('click');

			event.stopPropagation();

			// To trigger overflow div click to select the tr

		});

		

		$('.dropdown').mouseleave(function(e) {

			if($(this).attr('id')=='dataadvancesearch_options' ||  $(this).attr('id')=='datashare_match_options' ||  $(this).attr('id')=='dataaction_matching_leads'){

				return false;	

			}else{

				//$('.dropdown').slideUp(100);

			}

		});

		

		// To Hide the dropdown on click on body

		$("body").click(function(e){

			var target = $(e.target);    

		    if (!target.parents('div#datasavesearch_options').length && !(target.parents('div#datashare_match_options').length) && !(target.parents('div#dataaction_matching_leads').length)  && !(target.parents('div.has-form').length)) {

		    	if($(this).attr('id')=='dataadvancesearch_options' || $(this).attr('id')=='datashare_match_options' || $(this).attr('id')=='dataaction_matching_leads' || $(this).hasClass('has-form')){

					return false;

				}else{

					if($('.dropdown:visible') && $('.dropdown:visible').attr('id') != 'dataadvancesearch_options' && $('.dropdown:visible').attr('id') != 'datashare_match_options' && $('.dropdown:visible').attr('id') != 'dataaction_matching_leads'){

						//$('.dropdown').slideUp(100);

					}

				}

		    }

		});

		

		$('.close-open-popup').click(function(e) {

			$('.dropdown').slideUp(100);

		});

		

		$("#as_close").click(function(e) {

			$('.dropdown').slideUp(100);

			$("#dummy_div").css('display','none');

		});

		

		$("#datashare_options_default").click(function(e) {

			//$('.dropdown').slideUp(100);

          //  $("#datashare_options_default").slideDown(300).addClass('active');

		});

		

		$("#error_close").click(function(e) {

			$('#checkbox_error').hide(300);

		});

	

});

/* end for dropdown and div hiding */

//                  download pdf brochure

                    

                    var listing_selected = '';

                    if($(this).attr('id')=='checkselectedListings' || $(this).attr('id')=='checkselectedListingsA3'){

			 listing_selected = $('#email_count').text();

			if(listing_selected > 5){

                                $('.dropdown').slideUp(100);

                                var brochure_id = '';

                                $.ajax({

                                    async: false,

                                    url: mainurl+'profile/getbrochureid/',

                                    success: function(data) {

                                        brochure_id=data;

                                    }

                                });

                                

//                          check if the brochure for multiple 

                                if(brochure_id != '45'){

                                   if($(this).attr('id')=='checkselectedListingsA3'){

                                        alert('Sorry! You can only download a maximum of 5 A3 poster at a time.');

                                    }else{

                                       alert('Sorry! You can only download a maximum of 5 pdf brochures at a time.');

                                    }



                                   

                                }else{

                                    if(listing_selected > 21){

                                        alert('Sorry! You can only download a maximum of 21 pdf brochures at a time.');

                                       

                                    }

                                }

                                

			}

                    }

                

                     if($(this).attr('id')=='checkselectedListingsEmail'){

			 listing_selected = $('#email_count').text();

			if(listing_selected > 5){

                                $('.dropdown').slideUp(100);

				alert('Sorry! You can only send a maximum of 5 pdf brochures at a time.');

				//return false;

			}

                        }

//                  END download bruchure



/* code for double click */

$(document).ready(function () {

	$('#listings_row tbody').dblclick(function() {

	  $('html, body').animate({ scrollTop: 0 }, 1000);

	});

});		

/* end */





/* code to animate the form table */

function animate_the_form_table_on_click () {

	$('#table_1'). stop(true, true).animate({ backgroundColor: '#F2F3FF' }, 1000);

	$('#table_1'). stop(true, true).animate({ borderTopColor: '#467EB8', borderRightColor: '#467EB8', borderLeftColor: '#467EB8', borderBottomColor: '#467EB8' }, 1000);

		setTimeout(function() {  

			$('#table_1').animate({ borderTopColor: '#CCC', borderRightColor: '#CCC', borderLeftColor: '#CCC', borderBottomColor: '#CCC' }, 1000);

			$('#table_1'). animate({ backgroundColor: '#fff' }, 1000);

		}, 1000);

}

/* end */



  $(document).ready(function(){

                $(".ltrim").numeric();

				

    });

            $(".ltrim").blur(function() {

                var str = $(this).val();

                $(this).val((ltrim(str, "0")));

            });

 function ltrim(str, chars) {

    chars = chars || "\\s";

    return str.replace(new RegExp("^[" + chars + "]+", "g"), "");

 }

			

	

function clean_up_link(id){

        var id = id.split("/");

        count = id.length - 1;

        link = id[count];

        return link;

}



function changeDeleteLinkStatus(type) {

    if(type == 'photos') {

        if($("#image-sort li").length < 1) {

            $('.delete_all').addClass('inactive');

        }

        else {

            $('.delete_all').removeClass('inactive');

        }

    }

    else {

        if($("#image-sort-floor li").length < 1) {

            $('.delete_all').addClass('inactive');

        }

        else {

            $('.delete_all').removeClass('inactive');

        }

    }

}

