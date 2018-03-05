-- phpMyAdmin SQL Dump
-- version 4.2.12deb2+deb8u2
-- http://www.phpmyadmin.net
--
-- Client :  localhost
-- Généré le :  Lun 05 Mars 2018 à 11:21
-- Version du serveur :  5.5.57-0+deb8u1
-- Version de PHP :  7.1.13-1+0~20180105151310.14+jessie~1.gbp1086fa

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données :  `GAG`
--

-- --------------------------------------------------------

--
-- Structure de la table `Artiste`
--

CREATE TABLE IF NOT EXISTS `Artiste` (
`idArtiste` int(11) NOT NULL,
  `nom` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `prenom` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `tel` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `image` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `descriptifFR` varchar(2000) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=84 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Contenu de la table `Artiste`
--

INSERT INTO `Artiste` (`idArtiste`, `nom`, `prenom`, `tel`, `image`, `descriptifFR`, `email`) VALUES
(69, 'Pillon', 'Nadine', '0512131415', 'artiste69.jpg', 'La lumi&egrave;re enfouie en fleurs ressurgit C&rsquo;est l&rsquo;ambition d&rsquo;&eacute;terniser sur la toile l&rsquo;&eacute;nergie n&eacute;cessaire &agrave; toute floraison qui motive la peinture de Nadine Pillon. L&rsquo;artiste d&eacute;voile ici ses derni&egrave;res &oelig;uvres, fruit d&rsquo;un travail qui met en lumi&egrave;re le lien qui unie vase nourricier et tiges gr&ecirc;les. C''est ainsi que l&rsquo;on d&eacute;couvre des sc&egrave;nes o&ugrave; le regard est d&eacute;cal&eacute;, surprenant : l&rsquo;artiste se rapproche de ses sujets, met en lumi&egrave;re le vase, tout en transparence o&ugrave; le bouquet insolent ne se montre qu&rsquo;&agrave; peine .Dessus, dessous&hellip; Nous voici priv&eacute;s du panache de ses bouquets ! Nadine Pillon n&rsquo;impose pas, Nadine Pillon sugg&egrave;re et, g&eacute;n&eacute;reuse offre de par les ombres &eacute;tal&eacute;es, une large place &agrave; notre imagination.Une nouvelle approche tout en modernit&eacute;, un souffle nouveau mariant d&eacute;marche esth&eacute;tique figurative et l&eacute;g&egrave;ret&eacute; parfois proche de l&rsquo;abstraction, mais sans exc&egrave;s car pour l&rsquo;artiste, &laquo; ce qui est beau doit rester lisible &raquo;. Elle veut tout saisir sous la pointe de son couteau, emprisonner dans la p&acirc;te &eacute;paisse la force et la t&eacute;nacit&eacute; du bourgeonnement, la flamboyance et la pl&eacute;nitude de la floraison, la fanaison in&eacute;vitable et le triste d&eacute;clin, avant que tout se dilue dans le temps. Ses &oelig;uvres sont une harmonie de couleurs lumineuses qui irradient de gaiet&eacute;, un hymne &agrave; la vie. Ce que nous d&eacute;chiffrons va bien au-del&agrave; de la beaut&eacute; des fleurs. C&rsquo;est une peinture qui nous plonge dans une r&eacute;flexion intime et nous rend humble devant cette nature d&rsquo;une richesse in&eacute;puisable.', 'nP@gmail.com'),
(70, 'Pruneau', 'Nathalie', '0611121314', 'artiste70.jpg', 'L&rsquo;&eacute;tude du corps humain et sa mise en espace permet de mettre en lumi&egrave;re les tensions, les mouvements, toutes les facettes, les asp&eacute;rit&eacute;s de l&rsquo;&acirc;me humaine. De l&rsquo;eau &agrave; la mati&egrave;re, du trait &agrave; la couleur, de la toile au papier se r&eacute;v&eacute;lent des univers imaginaires, des atmosph&egrave;res inattendues.Compos&eacute;s ensemble, ces mod&egrave;les deviennent des personnes tissant des relations entre elles. Le pinceau raconte ainsi une histoire. Comment remplir cet espace &agrave; priori vide? Cr&eacute;er une histoire et tenter de la repr&eacute;senter, de la transmettre &agrave; travers les sensations, les impressions provoqu&eacute;es.Les &acirc;mes humaines ainsi s&rsquo;expriment dans ces moindres recoins, &agrave; la recherche d&rsquo;une sinc&eacute;rit&eacute;, d&rsquo;une v&eacute;rit&eacute;.', 'np@np.fr'),
(71, 'Martinez Loeza', 'Karen', '0785964512', 'artiste71.jpg', 'Depuis mon enfance j&rsquo;ai toujours &eacute;t&eacute; tr&egrave;s influenc&eacute;e par l&rsquo;art. Notamment gr&acirc;ce &agrave; mon p&egrave;re qui &eacute;tait professeur d&rsquo;art et &agrave; mes fr&egrave;res qui travaillaient &eacute;galement dans la peinture. J&rsquo;ai toujours beaucoup aim&eacute; et &eacute;t&eacute; attir&eacute;e par les voitures et les d&eacute;tails de leur conception. C&rsquo;est ainsi qu&rsquo;&agrave; quinze ans, j&rsquo;ai d&eacute;cid&eacute; d&rsquo;&eacute;tudier le design automobile. J&rsquo;ai suivi une formation dans cette branche &agrave; Guadalajara (Mexique) avant de partir quelques mois plus tard pour l&rsquo;Allemagne. Deux ans apr&egrave;s j&rsquo;ai d&eacute;m&eacute;nag&eacute; en France, pays dans lequel je vis actuellement. J&rsquo;ai d&eacute;cid&eacute; de poursuivre ma carri&egrave;re dans l&rsquo;art mais cette fois-ci de mani&egrave;re un peu diff&eacute;rente &agrave; ce que je faisais pr&eacute;c&eacute;demment. J&rsquo;ai commenc&eacute; &agrave; r&eacute;aliser quelques peintures, &agrave; exprimer mes id&eacute;es diff&eacute;remment et plus seulement dans le domaine automobile. Aujourd&rsquo;hui je r&eacute;alise des dessins et des peintures autour des th&eacute;matiques qui me sont ch&egrave;res comme la culture mexicaine, mon pays d&rsquo;origine. Je suis davantage inspir&eacute;e par ma culture depuis que je vis &agrave; l&rsquo;&eacute;tranger et souhaite la faire partager &agrave; travers mes peintures. Aussi je continue d&rsquo;apprendre de nouvelles choses ainsi que des techniques diff&eacute;rentes. Cela me permet de me d&eacute;passer chaque jour tout en faisant ce qui me plait. J&rsquo;ai chang&eacute; de chemin mais pas de but.', 'mKarine@gmail.com'),
(72, 'Langevin', 'Pascal', '0323121415', 'artiste72.jpg', 'Pascal Langevin vit et travaille &agrave; Paris et Belle-&icirc;le en Mer 1978 : Premi&egrave;re exposition personnelle. Aquarelles &ndash;pastels - huiles &agrave; partir de 1980 : Salari&eacute; dans diff&eacute;rentes agences d&rsquo;architecture int&eacute;rieure. Poursuite de son activit&eacute; d''artiste-peintre. Depuis 1996 : Inscrit &agrave; la &laquo; Maison des Artistes &raquo;, il se consacre exclusivement &agrave; la peinture et aux illustrations - perspectives . Expositions personnelles et participations &agrave; des salons d&rsquo;artistes r&eacute;guli&egrave;rement (Salon d&rsquo;automne, Salon du dessin et peinture &agrave; l&rsquo;eau, salon de Colombes, Grand march&eacute; d&rsquo;art contemporain, Art-Metz, salon du XV&deg; &agrave; Paris). Il fait r&eacute;aliser aussi des tapis d&rsquo;apr&egrave;s ses mod&egrave;les, cr&eacute;&eacute; des fresques et sculptures, des peintures command&eacute;es par des architectes et d&eacute;corateurs pour leurs projets.&quot;Mon travail bien qu''abstrait est profond&eacute;ment ancr&eacute; &agrave; la nature. Il s''inspire de ses forces telluriques, a&eacute;riennes et oc&eacute;aniques. Mon imaginaire, nourri par un exercice r&eacute;gulier de dessin et de travail sur le motif, est aussi mis en mouvement par des &quot;trouvailles&quot; picturales que m''offre un hasard que j''invite sur mes toiles. Je m''efforce de m&eacute;nager dans mes tableaux un espace afin que le &quot;specta(c)teur&quot; puisse s''approprier cet univers (dont je ne serais qu''une sorte de m&eacute;dium) en y int&eacute;grant ses propres histoires.&quot; Pascal Langevin', 'pascalL23@gmail.com'),
(73, 'Deneuville', 'Jimmy', '0549635251', 'artiste73.jpg', 'De formation artistique, Jimmy Deneuville exerce une activit&eacute; de graphiste depuis plusieurs ann&eacute;es. Il a &eacute;galement &eacute;t&eacute; directeur artistique pour un magazine r&eacute;gional et pour une collection de d&eacute;coration d''int&eacute;rieure.&quot;J''ai toujours eu envie de renouer avec la cr&eacute;ation pure, l''expression libre de toutes contraintes. Et ce en utilisant d''abord mes outils de travail quotidien &agrave; savoir les outils num&eacute;riques. J''ai donc r&eacute;alis&eacute; une s&eacute;rie de portraits refl&eacute;tant mes influences et mes envies esth&eacute;tiques.Je pense me diriger vers une technique qui m&ecirc;lera impression num&eacute;rique et peinture &agrave; la mani&egrave;re d''un Warhol (toutes proportions gard&eacute;es) toujours en utilisant la machine (reproductive) pour sa neutralit&eacute; froide et le pigment comme trace humaine.&quot;', 'jDenooeu@gmail.com'),
(74, 'Para des pozo', 'Antoine', '0623242526', 'artiste74.jpg', 'Mon approche est expressive et tourn&eacute;e vers l''humain, son c&ocirc;t&eacute; animal, &eacute;motionnel, son &eacute;nergie - tout cela est le point de d&eacute;part - souvent d''apr&egrave;s mod&egrave;le vivant ou mon propre visage comme point de d&eacute;part.Ensuite, une construction va se d&eacute;finir, quasi &eacute;clat&eacute;e, quasi abstraite, avec une recherche des tensions, des d&eacute;s&eacute;quilibres, des couleurs, souvent &agrave; la limite de l''action painting.De fait mon processus de cr&eacute;ation est relativement court - une s&eacute;ance dure quelques heures et plusieurs dessins vont &ecirc;tre produits g&eacute;n&eacute;ralement en tr&egrave;s peu de temps et avec beaucoup de tentatives.Il y a donc aussi un travail important apr&egrave;s coup pour trier et s&eacute;lectionner les oeuvres les plus int&eacute;ressantes (et donc aussi beaucoup de perte et de s&eacute;ances qui n''aboutissent pas).Ma recherche actuelle se complexifie parcequ''elle tend vers la performance et l''utilisation du corps en mouvement. Je questionne de plus en plus la relation du corps au geste du dessin - et aussi le processus &eacute;nerg&eacute;tique dans lequel je travaille. Je m''interroge aussi sur la ritualisation de certaines s&eacute;ances et sur l''exploration de certains &eacute;tats modifi&eacute;s de conscience.', 'paradelsol@gmail.com'),
(75, 'Monestier', 'Fabienne', '0905461232', 'artiste75.jpg', 'J&rsquo;ai fait des &eacute;tudes de cin&eacute;ma exp&eacute;rimental et de gravure &agrave; l''Institut d''Arts Visuels d''Orl&eacute;ans, o&ugrave; j&rsquo;ai obtenu le Dipl&ocirc;me National Sup&eacute;rieur d''Education Plastique en pr&eacute;sentant deux court-m&eacute;trages. Ce qui me plaisait dans le cin&eacute;ma, c''&eacute;tait de dessiner les story-boards...J''aime &eacute;voquer la nature plut&ocirc;t que la copier. Je peins la plupart du temps d''imagination. Tous les sujets sont susceptibles de m''int&eacute;resser un jour, car il sont tous de possibles moteurs d''inspiration et d''interpr&eacute;tation plastique. Mais, j''oserais dire que le sujet est secondaire dans ma d&eacute;marche. Mon vrai moteur d''inspiration, ce sont les techniques picturales. J''utilise &eacute;norm&eacute;ment les couleurs transparentes pour la richesse et la profondeur des tons qu''elles apportent. Je travaille sur toile, bois ou sur papier : huile, aquarelle, encres, crayons de couleur, crayons aquarellables, acrylique, marqueurs, fusain, pierre noire, techniques mixtes... Depuis quelques ann&eacute;es, gr&acirc;ce &agrave; Internet, je vends mes peintures et dessins un peu partout dans le monde.', 'fabfab@gmail.com'),
(76, 'Pierre', 'Fabrice', '0945464748', 'artiste76.jpg', 'www.fabricepierre-photographe.com N&eacute; le 04 septembre 1971 &agrave; Lyon, j&rsquo;ai depuis mon plus jeune &acirc;ge une attirance particuli&egrave;re pour tout ce qui touche &agrave; l&rsquo;art. La musique d&rsquo;abord, avec un apprentissage du piano qui me permet d&rsquo;obtenir le 1er prix et coupe ', 'pierreFabricce@pierreFabrice.fr'),
(77, 'Mispelon', 'Isabelle', '0541424345', 'artiste77.jpg', 'Apr&egrave;s 15 ans d&rsquo;enseignement th&eacute;&acirc;tral aupr&egrave;s de publics scolaires et adultes, Isabelle Mispelon a enrichi son parcours artistique en travaillant avec les peintres Marino Barberio et Jean-Marc Denis puis avec les artistes verriers Perrin ', 'mispelon@mispelon.fr'),
(78, 'Huet-Baron', 'Anne', '0606050604', 'artiste78.jpg', 'N&eacute;e &agrave; Rennes, apr&egrave;s des &eacute;tudes artistiques &agrave; Paris (dipl&ocirc;m&eacute;e de l''ENSAD en 1982) Anne Baron vit et travaille d&eacute;sormais &agrave; Alen&ccedil;on. Elle anime toute l''ann&eacute;e un atelier artistique (cours de peinture &agrave; l''huile, dessin, pastel et aquarelle). Passionn&eacute;e d''aquarelle, elle participe &agrave; de nombreux salons d&eacute;di&eacute;s &agrave; cette technique et propose des stages dans le cadre de ces salons. Anne Baron est membre de la Soci&eacute;t&eacute; Fran&ccedil;aise d''Aquarelle depuis 2015 ainsi que des Artistes ind&eacute;pendants de Basse Normandie.Sa peinture de paysage (vagues, roches, montagnes et for&ecirc;ts) cherche &agrave; exprimer le sentiment romantique de la nature, avec ce qu''elle a de tragique et violent aussi bien que doux et fondu. Ses fleurs &eacute;voquent la beaut&eacute; fragile et &eacute;ph&eacute;m&egrave;re de la vie. Ses personnages un peu oniriques &eacute;voquent parfois des l&eacute;gendes anciennes. C''est un univers complet, une peinture en touches fragment&eacute;es, inspir&eacute;e par le r&eacute;el, emport&eacute;e par le r&ecirc;ve.', 'huetbaranne@gmail.com'),
(79, 'Ivchenkova', 'Tatiana', '0712151613', 'artiste79.jpg', 'Je suis artiste peintre et illustratrice d''origine russe n&eacute;e &agrave; Rostov-sur-le-Don et demeurant &agrave; Paris depuis 2010. J''ai commenc&eacute; mon parcours artistique en Russie en tant que graphiste-illustratrice apr&egrave;s avoir fini l''Acad&eacute;mie d''&Eacute;tat d''Architecture et d''Art. En France, je me suis mise &agrave; la peinture et ai continu&eacute; mes &eacute;tudes &agrave; l''&Eacute;cole Doctorale &quot;Esth&eacute;tique, Sciences et Technologies des Arts&quot;. J''ai particip&eacute; &agrave; plusieurs salons d''art en &Icirc;le-de-France ainsi qu''&agrave; des expositions collectives. Mes &oelig;uvres se trouvent dans des collections particuli&egrave;res en France, en Russie, en Allemagne, en Angleterre, aux &Eacute;tats-Unis, etc.', 'tatiKo@toto.ru'),
(80, 'Cattaneo', 'St&eacute;phane', '0638393736', 'artiste80.jpg', 'N&eacute; &agrave; Paris en 1970, St&eacute;phane Cattaneo vit et travaille en France, dans un petit village du Morbihan, La Roche Bernard. Son int&eacute;r&ecirc;t pour la cr&eacute;ation remonte &agrave; l&rsquo;enfance, lorsqu'' il d&eacute;vorait le journal de Spirou : il r&ecirc;vait de devenir un dessinateur c&eacute;l&egrave;bre. Il d&eacute;couvrit plus tard la peinture et d&eacute;veloppa &agrave; l&rsquo;adolescence un int&eacute;r&ecirc;t aigu pour le travail de Paul Klee, p&eacute;riode &agrave; laquelle il d&eacute;cida de finalement devenir un peintre c&eacute;l&egrave;bre. Puis ce fut le choc consid&eacute;rable du Jazz &agrave; l&rsquo;&acirc;ge adulte : il vibrait au son de Coltrane, Shepp, Dolphy et tant d&rsquo;autres musiciens du free jazz movement &agrave; qui il voulait ressembler. Or, il ne souhaitait pas pour autant devenir un saxophoniste c&eacute;l&egrave;bre : on ne peut pas tout faire, et puis avec le dessin et surtout la peinture, il avait trouv&eacute; ses champs d&rsquo;expression privil&eacute;gi&eacute;s. D&egrave;s lors il s''est efforc&eacute; &agrave; travers la pratique de l&rsquo;improvisation picturale d&rsquo;exprimer des &eacute;motions selon un rythme, des motifs, un alphabet qui ont beaucoup &agrave; voir avec la musique. Il r&eacute;alise d&eacute;sormais un peu partout des &oelig;uvres de grand format sur sc&egrave;ne avec des musiciens anglais, am&eacute;ricains ou fran&ccedil;ais lors d&rsquo;&eacute;v&eacute;nements dans des galeries (Dufay-Bonnet, Paris), sur la sc&egrave;ne de concerts (Black Dog Caf&eacute;, Minneapolis) ou lors de performances dans des festivals (Festijazz, La Paz)&hellip;', 'cattantan@gmail.com'),
(81, 'Fall', 'Ousman', '0546660205', 'artiste81.jpg', 'Photographe et saunier &agrave; Ars en R&eacute; depuis 2004, je vous souhaite une agr&eacute;able promenade sur mes marais salants, &agrave; travers ces tableaux.', 'contact@ousmane-fall.fr'),
(82, 'H&eacute;buterne', 'Lise', '0545454565', 'artiste82.jpg', 'N&eacute;e en 1975, Lise H&eacute;buterne vit et travaille &agrave; Paris. Passionn&eacute;e de livres, elle a commenc&eacute; &agrave; voyager &agrave; travers certains d''entre eux. Notamment, les aventures de Tintin et celles de Nicolas Bouvier.&quot; Partir, voir ce qui se passe ailleurs, loin, ici, l&agrave;-bas; j''en ai toujours r&ecirc;v&eacute; : jusqu''au premier d&eacute;part. Ce besoin de d&eacute;couvrir d''autres lieux, d''autres gens est omnipr&eacute;sent chez moi. Voyageant souvent seule, je pars sac au dos et appareil photo en main. Celui-ci s''est r&eacute;v&eacute;l&eacute;, au fil des ann&eacute;es, mon compagnon de route id&eacute;al. Se taire pour mieux contempler...&quot;Des Am&eacute;riques &agrave; l''Asie, ses photographies sont une invitation aux voyages. Une invitation &agrave; d&eacute;couvrir et re-d&eacute;couvrir le monde et ce qui le compose : &quot; voir ce qu''on ne voit pas, ou plus. Voir autrement. &quot;', 'lise@lise.fr'),
(83, 'Daumas', 'M&eacute;lodie', '0232214578', 'artiste83.jpg', 'Artiste Contemporaine n&eacute;e en 1990, je vis et travaille &agrave; Paris. Mes oeuvres sont le r&eacute;sultat d&rsquo;un voyage de support en support, du geste manuel sur un support papier &agrave; une impression sur papier photographique, du manuel au num&eacute;rique et du dessin &agrave; la photographie. C&rsquo;est une sorte de &laquo;bricolage&raquo; de diff&eacute;rents m&eacute;diums. Je construis mes images, je les fabrique, j&rsquo;assemble des &eacute;l&eacute;ments comme un puzzle ou un patchwork. C&rsquo;est un d&eacute;coupage du temps et des espaces, du visible et de l&rsquo;invisible. C&rsquo;est une sorte de chaos visuel, d&rsquo;accumulation d&rsquo;&eacute;l&eacute;ments qui fonctionnent les uns avec les autres. Le dessin et la photographie ne font qu&rsquo;un. Il y a une atemporalit&eacute; dans ces images qui plonge le spectateur dans un &eacute;tat de contemplation. La photographie n&rsquo;est pas que visuelle. Je veux laisser libre cours &agrave; l&rsquo;imagination sensitive, que le spectateur se laisse porter par ses sensations.', 'melo@daumas.fr');

-- --------------------------------------------------------

--
-- Structure de la table `ArtisteExpose`
--

CREATE TABLE IF NOT EXISTS `ArtisteExpose` (
  `idArtiste` int(11) NOT NULL,
  `idExpo` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Contenu de la table `ArtisteExpose`
--

INSERT INTO `ArtisteExpose` (`idArtiste`, `idExpo`) VALUES
(69, 125),
(70, 125),
(71, 125),
(72, 125),
(74, 125),
(75, 125),
(76, 125),
(77, 125),
(78, 125),
(79, 125),
(80, 125),
(82, 125),
(83, 125),
(81, 128);

-- --------------------------------------------------------

--
-- Structure de la table `Collectif`
--

CREATE TABLE IF NOT EXISTS `Collectif` (
`idCollectif` int(11) NOT NULL,
  `libelleCollectif` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `descriptifFR` varchar(2000) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `tel` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=52 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Contenu de la table `Collectif`
--

INSERT INTO `Collectif` (`idCollectif`, `libelleCollectif`, `descriptifFR`, `email`, `tel`) VALUES
(51, 'Art''n Roll', '&ccedil;a bouge avec Art''nRoll', 'contact@artnroll.fr', '0125456532');

-- --------------------------------------------------------

--
-- Structure de la table `CollectifExpose`
--

CREATE TABLE IF NOT EXISTS `CollectifExpose` (
  `idCollectif` int(11) NOT NULL,
  `idExpo` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `Communaute`
--

CREATE TABLE IF NOT EXISTS `Communaute` (
  `idArtiste` int(11) NOT NULL,
  `idCollectif` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `Donnee_enrichie`
--

CREATE TABLE IF NOT EXISTS `Donnee_enrichie` (
`idDonneeEnrichie` int(11) NOT NULL,
  `urlFichier` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `libelleDonneeEnrichie` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `idTypeDonneEnrichie` int(11) DEFAULT NULL,
  `idOeuvre` int(11) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Contenu de la table `Donnee_enrichie`
--

INSERT INTO `Donnee_enrichie` (`idDonneeEnrichie`, `urlFichier`, `libelleDonneeEnrichie`, `idTypeDonneEnrichie`, `idOeuvre`) VALUES
(1, 'https://www.youtube.com/embed/Tk5DmOFery4', 'Les fleurs Violettes', 4, 43),
(6, 'http://www.angeliqueguillemet-art.com/wp-content/uploads/2018/01/arbre-dautomne-BD-280x200.jpg', 'Arbre', 4, 43),
(7, 'https://i.pinimg.com/736x/3b/58/f9/3b58f9373cb290051eb2f54f029dbb7c--wedding-sweets-wedding-cake.jpg', 'Bulle de pens&eacute;e', 4, 60),
(8, 'https://www.youtube.com/embed/NZlfxWMr7nc', 'Endormez vous', 4, 48);

-- --------------------------------------------------------

--
-- Structure de la table `Emplacement`
--

CREATE TABLE IF NOT EXISTS `Emplacement` (
`idEmplacement` int(11) NOT NULL,
  `coordLeft` float DEFAULT NULL,
  `coordTop` float DEFAULT NULL,
  `idExpo` int(11) DEFAULT NULL,
  `idOeuvreExposee` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB AUTO_INCREMENT=564 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Contenu de la table `Emplacement`
--

INSERT INTO `Emplacement` (`idEmplacement`, `coordLeft`, `coordTop`, `idExpo`, `idOeuvreExposee`) VALUES
(441, 65.6675, 22.6767, 125, 119),
(442, 41.5549, 36.7466, 125, 118),
(443, 65.9943, 58.3131, 125, 117),
(444, 75.5851, 88.6846, 125, 116),
(447, 81.1109, 5.09819, 125, 109),
(448, 46.1229, 55.8977, 125, 108),
(450, 35.6526, 46.0784, 125, 121),
(451, 1.32549, 29.7335, 125, 122),
(453, 59.8322, 35.265, 125, 124),
(454, 59.0855, 9.21415, 125, 125),
(455, 37.7329, 88.2353, 125, 126),
(456, 21.8993, 88.2353, 125, 127),
(458, 12.5379, 88.5569, 125, 130),
(459, 89.6254, 88.8889, 125, 131),
(461, 19.4723, 60.7843, 125, 133),
(462, 23.0551, 65.6863, 125, 134),
(463, 42.0582, 3.22885, 125, 135),
(465, 73.4539, 9.96979, 125, 120),
(466, 95.3328, 15.0407, 125, 110),
(553, 33.5577, 45.9559, 128, 140),
(556, 70.5264, 51.1029, 128, 142),
(559, 73.9108, 51.1029, 128, 141),
(560, 50, 50, 128, 0),
(563, 50, 50, 125, 0);

-- --------------------------------------------------------

--
-- Structure de la table `Exposition`
--

CREATE TABLE IF NOT EXISTS `Exposition` (
`idExpo` int(11) NOT NULL,
  `titre` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `horaireO` time DEFAULT NULL,
  `horaireF` time DEFAULT NULL,
  `theme` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `descriptifFR` varchar(2000) COLLATE utf8_unicode_ci DEFAULT NULL,
  `frequentation` int(11) DEFAULT NULL,
  `dateDeb` date DEFAULT NULL,
  `dateFin` date DEFAULT NULL,
  `teaser` varchar(25) COLLATE utf8_unicode_ci DEFAULT NULL,
  `affiche` varchar(25) COLLATE utf8_unicode_ci DEFAULT NULL,
  `couleurExpo` varchar(7) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=129 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Contenu de la table `Exposition`
--

INSERT INTO `Exposition` (`idExpo`, `titre`, `horaireO`, `horaireF`, `theme`, `descriptifFR`, `frequentation`, `dateDeb`, `dateFin`, `teaser`, `affiche`, `couleurExpo`) VALUES
(125, 'Ultraviolet', '09:00:00', '19:30:00', 'Le violet &agrave; l''honneur', 'Souvent associ&eacute; &agrave; l&rsquo;univers f&eacute;minin, le violet est une couleur qui &eacute;voque le r&ecirc;ve et la d&eacute;licatesse. Conseill&eacute; pour agr&eacute;menter des pi&egrave;ces de r&eacute;flexion (bureaux, biblioth&egrave;ques...), il permettrait &eacute;galement d&rsquo;am&eacute;liorer notre concentration. \r\n\r\nConcentrez-vous donc, pour d&eacute;couvrir notre s&eacute;lection &quot;Ultraviolet&quot; pleine de douceur et de s&eacute;r&eacute;nit&eacute; ! ', 4, '2018-03-07', '2018-03-14', 'teaser.jpg', 'affiche.jpg', '#a832e2'),
(126, 'Mes Marais Salants', '00:00:00', '00:00:00', 'Couleurs de Terre', 'blablablabla', 2, '2018-03-17', '2018-03-24', '', '', '#5e75d2'),
(127, 'Les murs', '00:00:00', '00:00:00', 'Ont des oreilles', 'hahaha', NULL, '2018-03-27', '2018-03-31', NULL, NULL, '#55b05c'),
(128, 'Avant premiere', '00:00:00', '00:00:00', 'Cin&eacute;ma', 'et tout et tout', NULL, '2018-02-20', '2018-02-27', 'teaser.png', '', '#cd2f2f');

-- --------------------------------------------------------

--
-- Structure de la table `Langue`
--

CREATE TABLE IF NOT EXISTS `Langue` (
`idLangue` int(11) NOT NULL,
  `nomLangue` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Contenu de la table `Langue`
--

INSERT INTO `Langue` (`idLangue`, `nomLangue`) VALUES
(1, 'Français'),
(2, 'Anglais'),
(3, 'Russe'),
(4, 'Allemand'),
(5, 'Chinois');

-- --------------------------------------------------------

--
-- Structure de la table `Langue_expo`
--

CREATE TABLE IF NOT EXISTS `Langue_expo` (
  `idExpo` int(11) NOT NULL,
  `idLangue` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Contenu de la table `Langue_expo`
--

INSERT INTO `Langue_expo` (`idExpo`, `idLangue`) VALUES
(125, 1),
(128, 1),
(125, 2),
(128, 2),
(125, 5);

-- --------------------------------------------------------

--
-- Structure de la table `Message_interne`
--

CREATE TABLE IF NOT EXISTS `Message_interne` (
`idMessage` int(11) NOT NULL,
  `dateMessage` date NOT NULL,
  `message` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `idUtilisateur` int(11) DEFAULT NULL,
  `idOeuvre` int(11) DEFAULT NULL,
  `idArtiste` int(11) DEFAULT NULL,
  `idExpo` int(11) DEFAULT NULL,
  `idCollectif` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `Oeuvre`
--

CREATE TABLE IF NOT EXISTS `Oeuvre` (
`idOeuvre` int(11) NOT NULL,
  `titre` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `longueur` decimal(7,2) DEFAULT NULL,
  `hauteur` decimal(7,2) DEFAULT NULL,
  `etat` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `image` varchar(25) COLLATE utf8_unicode_ci DEFAULT NULL,
  `qrcode` varchar(25) COLLATE utf8_unicode_ci DEFAULT NULL,
  `descriptifFR` varchar(2000) COLLATE utf8_unicode_ci DEFAULT NULL,
  `idTypeOeuvre` int(11) DEFAULT NULL,
  `idArtiste` int(11) DEFAULT NULL,
  `idCollectif` int(11) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=66 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Contenu de la table `Oeuvre`
--

INSERT INTO `Oeuvre` (`idOeuvre`, `titre`, `longueur`, `hauteur`, `etat`, `image`, `qrcode`, `descriptifFR`, `idTypeOeuvre`, `idArtiste`, `idCollectif`) VALUES
(25, 'Ce que l''amour doit à la nuit', '80.00', '93.00', 'bon', 'oeuvre25.jpg', 'oeuvre25.png', '« Des couleurs plein les yeux » pourrait résumer le travail de Stéphane Cattaneo. Des paysages lunaires, des imaginaires fleuris, amoureux, des portraits monochromes sont tant de sujets abordés par l’artiste. Multipliant les techniques, il nous dépeint des royaumes et des espaces hors du temps. On se prêterait presque à regarder ses œuvres avec un regard d’enfant ; émerveillé et naïf.', 1, 80, NULL),
(27, 'Two-duck-face', '50.00', '65.00', 'bon', 'oeuvre27.jpg', 'oeuvre27.png', 'Encre de Chine, feutre noir et pastel sec sur papier Canson.', 4, 79, NULL),
(28, 'Le chant sacré de la mer', '29.00', '29.00', 'bon', 'oeuvre28.jpg', 'oeuvre28.png', 'Aquarelle romantique évoquant le sentiment dramatique et excessif des vagues et de l''océan. Les tons bleutés et violacés renforcent la froideur de l''eau. La texture même de l''aquarelle, coulures, éclaboussures contribue à rendre le mouvement véritable des vagues.', 5, 78, NULL),
(30, 'Breaking the waves', '50.00', '50.00', 'bon', 'oeuvre30.jpg', 'oeuvre30.png', 'La violence de la vague qui surgit, l''écume qui vole, la force qui submerge et emporte tout sur son passage, le mouvement sans fin de la mer indomptée.', 1, 77, NULL),
(32, 'Magic spiral', '40.00', '30.00', 'bon', 'oeuvre32.jpg', 'oeuvre32.png', 'Beaucoup de mes photographies sont basées sur la captation des lignes ou des courbes. Je suis fasciné par les images que l''on peut créer en regardant ces détails.', 6, 76, NULL),
(34, 'Feuillages abstrait', '19.00', '24.00', 'bon', 'oeuvre34.jpg', 'oeuvre34.png', '"Feuillages abstraits en violet, bleu et rose", spray paint et acrylique sur panneau de MDF. Une belle atmosphère romantique et végétale, avec des formes de feuillages naturels. Les feuillages sont des ornements purement décoratifs. Je pensais à un paysage de rêve. J''aime la complexité des formes naturelles, de leurs formes et couleurs. La nature est fascinante pour un peintre, même si c''est une nature imaginaire ! Cette œuvre sera livrée avec une facture et un certificat d''authenticité signé. La peinture a une système d''accrochage au dos. Le panneau de MDF fait 0,5cm d''épaisseur.', 1, 75, NULL),
(35, 'Buto No 1', '50.00', '70.00', 'bon', 'oeuvre35.jpg', 'oeuvre35.png', 'Fait partie d''une série autour de la danse Butoh.', 1, 74, NULL),
(37, 'Marylin purple', '100.00', '70.00', 'bon', 'oeuvre37.jpg', 'oeuvre37.png', 'Travail numérique basé sur une photographie de Marilyn Monroe en Noir et Blanc.Impression offset (traceur professionnel) sur papier, contrecollé sur PVC.Marilyn Monroe comme icône d''une époque, référence au Pop art, aux publicités et aux Comics américains des années 60 incrustés en transparence dans les aplats de couleurs.', 4, 73, NULL),
(39, 'Torsion', '50.00', '70.00', 'bon', 'oeuvre39.jpg', 'oeuvre39.png', 'Rester attentif ce que nous offre la nature ! C''est mon objectif en travaillant sur le motif: Ici un pastels secs fait à Belle-ile en mer (sur un fond d''acrylique) devant un bouquet de "Cyprès de Lambert" torturé par le vent. Cadre basique', 4, 72, NULL),
(40, 'Calavera dia de muertos', '31.00', '41.00', 'bon', 'oeuvre40.jpg', 'oeuvre40.png', 'Cette peinture est inspirée par la fête des morts, fête originaire du Mexique, dont les traditions sont un mélange de différentes croyances, en particulier chrétiennes et indigènes. Le jour de la fête des morts, les familles se recueillent sur les tombes de leurs ancêtres et les nettoient, les décorent avec des bougies, déposent de la nourriture et les fleurissent (spécialement avec des fleurs oranges appelées zempaxuchitl). Les âmes des défunts reviennent ensuite sur Terre pour visiter leurs proches et profiter des offrandes.', 5, 71, NULL),
(41, 'Buste vert au pot d''eau', '32.00', '50.00', 'bon', 'oeuvre41.jpg', 'oeuvre41.png', 'A partir d''un croquis assez détaillé travaillé en atelier avec un modèle, j''ai exploré des atmosphères différentes à travers des déclinaisons colorées singulières inspirées des saisons. L''acrylique très liquide permet de travailler sur plusieurs peintures en même temps. Celles-ci se nourrissent les unes des autres. Les couleurs se superposent petit à petit, en transparence ou en aplat. Un travail de va-et-vient s''opèrent. Le cadrage particulier du sujet permet de se concentrer sur le buste et le centre du corps. Le drapé est travaillé en même temps et de la même manière que le corps, comme s''il en faisait partie.', 1, 70, NULL),
(42, 'Tête morte violet', '80.00', '80.00', 'bon', 'oeuvre42.jpg', 'oeuvre42.png', '« Ici durent longtemps, les fleurs qui durent peu » Victor Hugo L''hortensia, l''exception qui confirme la règle... travail au couteau et transparence des pétales aux couleurs', 1, 69, NULL),
(43, 'A toucher le ciel', '60.00', '60.00', 'bon', 'oeuvre43.jpg', 'oeuvre43.png', 'Sur sa tige, l''iris se dresse pour s’offrir aux regards... un enchantement simple.', 1, 69, NULL),
(44, 'Fleurs du mal', '30.00', '40.00', 'bon', 'oeuvre44.jpg', 'oeuvre44.png', '"Volupté, sois toujours ma reine ! Prends le masque d''une sirène Faite de chair et de velours, Ou verse-moi tes sommeils lours Dans le vin informe et mystique, Volupté, fantôme élastique !" Charles Baudelaire', 1, 80, NULL),
(45, 'La promenade au lac', '29.00', '30.00', 'bon', 'oeuvre45.jpg', 'oeuvre45.png', 'inspiration romantique pour cette aquarelle dans les tons pourpres et bruns. Chemin au bord d''un lac, la brume monte et noie le paysage lointain. Seul le sentier est net et accidenté, les arbres et leurs branches sont sculptés par des retraits de matière qui donnent des effets de lumière et de mouvement dans les branches.', 5, 78, NULL),
(46, 'Marylin blue', '80.00', '100.00', 'bon', 'oeuvre46.jpg', 'oeuvre46.png', 'Travail numérique basé sur une photographie de Marilyn Monroe en Noir et Blanc.Impression offset sur papier contrecollé surPVC.D''inspiration Pop Art (les comics et la publicité des années 60 aux Etats-Unis sont présents dans les aplats et dans les contours du visage), j’intègre des jets de peinture comme un rappel à l''Action painting de Pollock. L''iconographie de la Pop culture (bien sûr Andy Warhol) comme dopée aux outils numériques, un reflet qui fait écho à notre époque.', 4, 73, NULL),
(47, 'Paysage rose et turquoise', '40.00', '40.00', 'bon', 'oeuvre47.jpg', 'oeuvre47.png', 'Une déclinaison stylisée d''un paysage de rêve, dans des camaïeux de roses et mauves, agrémentés de touches de turquoise. " Le violet est la couleur de l''année 2018. J''ai joué à l''associer avec du magenta, des pourpres, et des verts gris et turquoises clair, entre turquoise et céladon. J''ai utilisé de l''acrylique et des pastels à la cire pour ajouter des graphismes et animer les surfaces.." Fabienne MonestierL''oeuvre est peinte sur un carton toilé de 3mm d''épaisseur. Elle est prête à être accrochée avec un système au dos.', 5, 75, NULL),
(48, 'Aube glacée 3', '20.00', '20.00', 'bon', 'oeuvre48.jpg', 'oeuvre48.png', 'Aquarelle originale sur papier, 20X20 cm.Paysage d''hiver abstrait en rose, orange et violet. Cette petite aquarelle évoque un matin d''hiver froid, au lever du soleil. La lumière de l''aube dessine les silhouettes des arbres en contrejour. Les arbres dans la brume sont juste suggérés, les effets de flou accentuent l''ambiance atmosphérique de cette peinture.Peinture livrée avec un certificat d''authenticité, signé et une facture. Envoi soigné et suivi.', 5, 75, NULL),
(49, 'Champ de Nièvre', '30.00', '30.00', 'bon', 'oeuvre49.jpg', 'oeuvre49.png', 'Paysage rural,peinture originale, huile sur toile, 30x30x1,6 cm, 2018 .', 1, 79, NULL),
(50, 'Ondine', '50.00', '70.00', 'bon', 'oeuvre50.jpg', 'oeuvre50.png', 'Peinture originale à l''huile, 2017.', 1, 79, NULL),
(51, 'Danse sous la pluie 1', '32.00', '24.00', 'bon', 'oeuvre51.jpg', 'oeuvre51.png', 'Série de dessins inspirée par les danseurs de ballet.Encre de Chine et encre argentée sur papier Canson.', 4, 79, NULL),
(52, 'Forces', '100.00', '50.00', 'bon', 'oeuvre52.jpg', 'oeuvre52.png', 'Photographie en macro des marais salants de l''ile de ré. On y trouve des formes et des couleurs auxquelles on ne s''attend pas. La nature est décidement pleine de surprise', 6, 81, NULL),
(53, 'Mamiwatta', '150.00', '80.00', 'bon', 'oeuvre53.jpg', 'oeuvre53.png', 'Photographie en macro des marais salants de l''ile de ré. On y trouve des formes et des couleurs auxquelles on ne s''attend pas. La nature est décidement pleine de surprise', 6, 81, NULL),
(54, 'Levitation', '100.00', '50.00', 'bon', 'oeuvre54.jpg', 'oeuvre54.png', 'Photographie en macro des marais salants de l''ile de ré. On y trouve des formes et des couleurs auxquelles on ne s''attend pas. La nature est décidement pleine de surprise', 6, 81, NULL),
(55, 'Intime papillon', '150.00', '50.00', 'bon', 'oeuvre55.jpg', 'oeuvre55.png', 'Photographie en macro des marais salants de l''ile de ré. On y trouve des formes et des couleurs auxquelles on ne s''attend pas. La nature est décidement pleine de surprise', 6, 81, NULL),
(56, 'Coupe', '150.00', '50.00', 'bon', 'oeuvre56.jpg', 'oeuvre56.png', 'Photographie en macro des marais salants de l''ile de ré. On y trouve des formes et des couleurs auxquelles on ne s''attend pas. La nature est décidement pleine de surprise', 6, 81, NULL),
(57, 'Orgasme', '150.00', '50.00', 'bon', 'oeuvre57.jpg', 'oeuvre57.png', 'Photographie en macro des marais salants de l''ile de ré. On y trouve des formes et des couleurs auxquelles on ne s''attend pas. La nature est décidement pleine de surprise', 6, 81, NULL),
(58, 'Onsen', '45.00', '30.00', 'bon', 'oeuvre58.jpg', 'oeuvre58.png', 'Japon.La nature offre des tableaux naturels surprenants dès qu''on y regarde de plus près. Ici, la brume d''un onsen (bain thermal) en plen air, de nuit.Photographie numérique.', 6, 82, NULL),
(59, 'Encens', '30.00', '45.00', 'bon', 'oeuvre59.jpg', 'oeuvre59.png', 'Malaisie.Georgetown, Dans la cour d''un temple, un énorme chaudron rempli de sable accueille d''énormes bâtons d''encens.Photographie numérique.', 6, 82, NULL),
(60, 'Anémone', '60.00', '40.00', 'bon', 'oeuvre60.jpg', 'oeuvre60.png', 'Cette œuvre est une photographie numérique couleur créée pour un concours intitulé "Purple".', 6, 83, NULL),
(61, 'Par la fenêtre', '45.00', '30.00', 'bon', 'oeuvre61.jpg', 'oeuvre61.png', 'Cette oeuvre est une photographie numérique qui traite des sensations.', 6, 83, NULL),
(62, 'Tourbillon', '32.00', '24.00', 'bon', 'oeuvre62.jpg', 'oeuvre62.png', 'Cette oeuvre est un mélange d''encre et de feutres.', 4, 83, NULL),
(63, 'Larmes', '32.00', '24.00', 'bon', 'oeuvre63.jpg', 'oeuvre63.png', 'Cette oeuvre est un mélange d''encre et de feutre.', 4, 83, NULL),
(64, 'blue', '60.00', '40.00', 'bon', 'oeuvre64.jpg', 'oeuvre64.png', 'Cette œuvre est une photographie numérique créée pour un concours intitulé "Purple".', 6, 83, NULL),
(65, 'Oeuvre d''essai', '50.00', '50.00', 'bon', 'oeuvre65.jpg', 'oeuvre65.png', 'Ceci est un esssai', NULL, 80, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `OeuvreExposee`
--

CREATE TABLE IF NOT EXISTS `OeuvreExposee` (
`idOeuvreExposee` int(11) NOT NULL,
  `dateEntree` date DEFAULT '1970-01-01',
  `dateSortie` date DEFAULT '1970-01-01',
  `nbVue` int(11) DEFAULT '0',
  `idOeuvre` int(11) NOT NULL,
  `idExpo` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=146 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Contenu de la table `OeuvreExposee`
--

INSERT INTO `OeuvreExposee` (`idOeuvreExposee`, `dateEntree`, `dateSortie`, `nbVue`, `idOeuvre`, `idExpo`) VALUES
(108, '2018-03-01', '1970-01-01', 5, 25, 125),
(109, '2018-03-01', '1970-01-01', 2, 27, 125),
(110, '2018-03-01', '1970-01-01', 0, 28, 125),
(111, '1970-01-01', '1970-01-01', 0, 30, 125),
(112, '1970-01-01', '1970-01-01', 0, 32, 125),
(114, '1970-01-01', '1970-01-01', 0, 35, 125),
(116, '2018-03-01', '1970-01-01', 1, 39, 125),
(117, '2018-03-01', '1970-01-01', 1, 40, 125),
(118, '2018-03-01', '1970-01-01', 2, 41, 125),
(119, '2018-03-01', '1970-01-01', 0, 42, 125),
(120, '2018-03-01', '1970-01-01', 49, 43, 125),
(121, '2018-03-01', '1970-01-01', 0, 44, 125),
(122, '2018-03-01', '1970-01-01', 0, 45, 125),
(124, '2018-03-01', '1970-01-01', 0, 47, 125),
(125, '2018-03-01', '1970-01-01', 2, 48, 125),
(126, '2018-03-01', '1970-01-01', 1, 49, 125),
(127, '2018-03-01', '1970-01-01', 0, 50, 125),
(128, '2018-03-01', '1970-01-01', 0, 51, 125),
(130, '2018-03-01', '1970-01-01', 0, 58, 125),
(131, '2018-03-01', '1970-01-01', 0, 59, 125),
(132, '2018-03-01', '1970-01-01', 6, 60, 125),
(133, '2018-03-01', '1970-01-01', 1, 61, 125),
(134, '2018-03-01', '1970-01-01', 0, 62, 125),
(135, '2018-03-01', '1970-01-01', 2, 63, 125),
(136, '2018-03-01', '1970-01-01', 7, 64, 125),
(139, '1970-01-01', '1970-01-01', 0, 34, 125),
(140, '2018-03-02', '1970-01-01', 0, 56, 128),
(141, '2018-03-03', '1970-01-01', 0, 52, 128),
(142, '2018-03-02', '1970-01-01', 0, 55, 128),
(143, '2018-03-03', '1970-01-01', 0, 54, 128),
(144, '2018-03-03', '1970-01-01', 0, 53, 128),
(145, '2018-03-03', '1970-01-01', 0, 57, 128);

-- --------------------------------------------------------

--
-- Structure de la table `Traduction`
--

CREATE TABLE IF NOT EXISTS `Traduction` (
`idTraduction` int(11) NOT NULL,
  `texteTraduit` varchar(2000) COLLATE utf8_unicode_ci DEFAULT NULL,
  `idArtiste` int(11) DEFAULT NULL,
  `idCollectif` int(11) DEFAULT NULL,
  `idOeuvre` int(11) DEFAULT NULL,
  `idExpo` int(11) DEFAULT NULL,
  `idLangue` int(11) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=106 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Contenu de la table `Traduction`
--

INSERT INTO `Traduction` (`idTraduction`, `texteTraduit`, `idArtiste`, `idCollectif`, `idOeuvre`, `idExpo`, `idLangue`) VALUES
(8, 'Often associated with the feminine universe, violet is a color that evokes dreams and delicacy. Advised to decorate rooms of reflection (offices, libraries ...), it would also improve our concentration.\r\n\r\nSo concentrate, to discover our selection "Ultraviolet" full of sweetness and serenity!', NULL, NULL, NULL, 125, 2),
(9, '\r\n通常与女性的宇宙联系在一起，紫罗兰是一种唤起梦想和美味的颜色。建议装饰反思室（办公室，图书馆......），这也会提高我们的注意力。\r\n\r\n所以专心，发现我们的选择“充满甜蜜和宁静的紫外线”！', NULL, NULL, NULL, 125, 5),
(10, '\r\nBorn in Paris in 1970, Stéphane Cattaneo lives and works in France, in a small village of Morbihan, La Roche Bernard. His interest in creation dates back to childhood, when he devoured Spirou''s diary: he dreamed of becoming a famous cartoonist. He later discovered painting and developed a keen interest in Paul Klee''s work during adolescence, when he finally decided to become a famous painter. Then it was the considerable shock of Jazz in adulthood: it vibrated to the sound of Coltrane, Shepp, Dolphy and so many other musicians of the free jazz movement that he wanted to look like. However, he did not wish to become a famous saxophonist: one can not do everything, and then with drawing and especially painting, he had found his privileged fields of expression. Since then he has worked through the practice of pictorial improvisation to express emotions according to a rhythm, patterns, an alphabet that have a lot to do with music. He now produces large-scale works on stage with English, American or French musicians during events in galleries (Dufay-Bonnet, Paris), on the concert stage (Black Dog Café, Minneapolis) or during performances at festivals (Festijazz, La Paz) ...', 80, NULL, NULL, NULL, 2),
(11, '1970年生于巴黎，StéphaneCattaneo在法国La Roche Bernard的一个小村庄Morbihan居住和工作。他对创作的兴趣可追溯到童年，当时他吞噬了Spirou的日记：他梦想成为一位着名的漫画家。后来他发现了绘画，并对Paul Klee在青春期的作品产生了浓厚的兴趣，最终他决定成为着名的画家。接下来是成年时爵士乐的巨大震撼：它随着Coltrane，Shepp，Dolphy等众多自由爵士乐运动音乐家的声音而震动，他希望看起来像。然而，他不想成为一个着名的萨克斯管吹奏者：一个人不能做任何事情，然后通过绘画和尤其是绘画，他找到了他特有的表达领域。从那时起，他一直通过绘画即兴创作的练习，根据与音乐有很大关系的节奏，模式和字母来表达情感。他现在在音乐会舞台（黑狗咖啡馆，明尼阿波利斯）的画廊（Dufay-Bonnet，巴黎）举办活动期间，或在演出期间，在英国，美国或法国音乐家的舞台上制作大型舞台作品节日表演（Festijazz，拉巴斯）', 80, NULL, NULL, NULL, 5),
(12, '\r\nI am a painter and illustrator of Russian origin born in Rostov-on-Don and living in Paris since 2010. I started my artistic career in Russia as a graphic designer-illustrator after finishing the State Academy of Architecture and Art. In France, I started painting and continued my studies at the Graduate School "Aesthetics, Science and Technology Arts". I participated in several art fairs in Île-de-France as well as in group exhibitions. My works are in private collections in France, Russia, Germany, England, the United States, etc.', 79, NULL, NULL, NULL, 2),
(13, '\r\n我是一位俄罗斯血统的画家和插画家，出生于顿河畔罗斯托夫，自2010年以来一直生活在巴黎。我在俄罗斯完成国立艺术学院后，开始了自己在俄罗斯的艺术生涯，担任平面设计师插画师。建筑和艺术。在法国，我开始绘画并继续在研究生院“美学，科学和技术艺术”的学习。我参加过几次法兰西岛艺术博览会以及组展。我的作品是在法国，俄罗斯，德国，英国，美国等地的私人收藏中。', 79, NULL, NULL, NULL, 5),
(14, 'Born in Rennes, after studying art in Paris (graduated from ENSAD in 1982) Anne Baron now lives and works in Alençon. She runs an artistic workshop all year round (oil painting, drawing, pastel and watercolor classes). Passionate about watercolor, she participates in many exhibitions dedicated to this technique and offers internships as part of these exhibitions. Anne Baron is a member of the French Watercolor Society since 2015 as well as Independent Artists from Lower Normandy. Her landscape painting (waves, rocks, mountains and forests) seeks to express the romantic feeling of nature, with what she Tragic and violent as well as soft and melted. Its flowers evoke the fragile and ephemeral beauty of life. His somewhat dreamy characters sometimes evoke ancient legends. It is a complete universe, a painting in fragmented keys, inspired by the real, carried away by the dream.', 78, NULL, NULL, NULL, 2),
(15, '在巴黎学习艺术后（1982年毕业于ENSAD），出生在雷恩，现在生活和工作在阿朗松。她全年经营一个艺术工作室（油画，素描，粉笔和水彩课程）。对水彩充满热情，她参加了许多致力于这项技术的展览，并提供实习机会作为展览的一部分。 Anne Baron自2015年起就是法国水彩画协会的成员，同时也是下诺曼底的独立艺术家，她的山水画（波浪，岩石，山脉和森林）试图表达浪漫的大自然的感觉，以及她悲剧和暴力以及软和融化。它的花朵唤起了脆弱而短暂的生命之美。他有些梦幻般的人物有时会唤起古老的传说。它是一个完整的宇宙，一幅零碎钥匙的画，受真实启发，被梦想带走。', 78, NULL, NULL, NULL, 5),
(16, 'After 15 years of theater teaching with school and adult audiences, Isabelle Mispelon has enriched her artistic career by working with the painters Marino Barberio and Jean-Marc Denis, then with glass artists Perrin', 77, NULL, NULL, NULL, 2),
(17, '\r\n在與學校和成人觀眾進行了15年的戲劇教學之後，Isabelle Mispelon通過與畫家Marino Barberio和Jean-Marc Denis的合作豐富了她的藝術生涯，然後與玻璃藝術家Perrin', 77, NULL, NULL, NULL, 5),
(18, 'www.fabricepierre-photographe.com Born September 4, 1971 in Lyon, I have since my childhood a special attraction for everything related to art. Music first, with a piano learning that allows me to get the 1st prize and cut', 76, NULL, NULL, NULL, 2),
(19, '\r\nwww.fabricepierre-photographe.com 1971年9月4日出生在里昂，自从我的童年以来，我一直对与艺术有关的一切有着特别的吸引力。音乐第一，钢琴学习，让我获得一等奖，并削减', 76, NULL, NULL, NULL, 5),
(20, '\r\nI studied experimental cinema and printmaking at the Institute of Visual Arts in Orleans, where I obtained the National Diploma of Higher Education Plasticity by presenting two short films. What I liked in the cinema was drawing storyboards ... I like to evoke nature rather than copy it. I paint most of the time with imagination. All subjects are likely to interest me one day, because they are all possible engines of inspiration and plastic interpretation. But, I dare say that the subject is secondary in my approach. My real driving force is pictorial techniques. I use a lot of transparent colors for the richness and depth of the tones they bring. I work on canvas, wood or paper: oil, watercolor, inks, colored pencils, watercolor pencils, acrylic, markers, charcoal, black chalk, mixed media ... For some years, thanks to the Internet, I sell my paintings and drawings all over the world.', 75, NULL, NULL, NULL, 2),
(21, '\r\n我在奥尔良视觉艺术学院学习实验电影和雕刻，在那里我通过两部短片获得了国家高等教育可塑性文凭。我喜欢在电影院里画故事板......我喜欢唤起大自然而不是复制它。我大部分时间都用想象力画画。所有科目都有可能在某一天感兴趣，因为它们都是灵感和塑料解释的可能引擎。但是，我敢说这个问题在我的方法中是次要的。我真正的动力是图像技术。我使用很多透明色来表现它们带来的色调的丰富程度和深度。我在帆布，木材或纸张上工作：油，水彩，墨水，彩色铅笔，水彩铅笔，丙烯酸树脂，标记，木炭，黑色粉笔，混合媒体......多年来，由于互联网，我出售我的绘画和遍布世界各地的图纸。', 75, NULL, NULL, NULL, 5),
(22, '\r\nMy approach is expressive and focused on the human, its animal side, emotional, its energy - all this is the starting point - often from living model or my own face as a starting point. Then, a construction will be defined , almost exploded, almost abstract, with a search for tensions, imbalances, colors, often borderline action painting.De done my creative process is relatively short - a session lasts a few hours and several drawings will be produced usually in a very short time and with a lot of attempts. So there is also an important job after the fact to sort and select the most interesting works (and therefore also a lot of loss and sessions that do not succeed). The current situation is becoming more complex because it tends towards the performance and use of the moving body. I question more and more the relation of the body to the gesture of the drawing - and also the energetic process in which I work. I also wonder about the ritualization of certain sessions and the exploration of some modified states of consciousness.', 74, NULL, NULL, NULL, 2),
(23, '\r\n我的方法是富有表现力的，集中在人，动物，情感和能量 - 所有这些都是起点 - 通常从生活模式或我自己的面部出发，然后定义一个构造，几乎是爆炸性的，几乎抽象的，寻找紧张，不平衡，颜色，往往是边缘行动painting.De做我的创作过程相对较短 - 会议持续几个小时，会产生几个图纸通常在很短的时间内进行了很多尝试，因此在排序和选择最有趣的作品之后还有一项重要的工作（因此还有很多损失和会话不成功）。目前的情况正变得越来越复杂，因为它趋向于运动物体的性能和使用。我越来越质疑身体与绘画姿态的关系 - 也是我工作的精力充沛的过程。我也想知道某些会议的仪式化和意识的一些修改状态的探索。\r\n', 74, NULL, NULL, NULL, 5),
(24, '\r\nArtistic training, Jimmy Deneuville has been a graphic designer for several years. He has also been artistic director for a regional magazine and for an interior decoration collection. "I have always wanted to reconnect with pure creation, the expression free from all constraints. Daily working tools, namely digital tools, so I realized a series of portraits reflecting my influences and my aesthetic desires.I think I''m headed towards a technique that mixes digital printing and painting in the manner of a Warhol (all proportions kept) always using the (reproductive) machine for its cold neutrality and the pigment as a human trace. "', 73, NULL, NULL, NULL, 2),
(25, '藝術培訓，Jimmy Deneuville多年來一直是一名平面設計師。他還擔任區域雜誌和室內裝飾收藏的藝術總監。“我一直想要重新與純粹的創作聯繫起來，這個表達從所有限制中解脫出來。日常工作工具，即數字工具，所以我意識到一系列反映我的影響力和我的審美慾望的肖像。我認為我正在走向一種以沃霍爾的方式混合數字印刷和繪畫的技術（所有比例保持）總是使用（生殖）機器的冷中性和色素作為人類痕跡。“', 73, NULL, NULL, NULL, 5),
(26, '\r\nPascal Langevin lives and works in Paris and Belle-Ile en Mer 1978: First personal exhibition. Watercolors -pastels - oils from 1980: Employed in different interior design agencies. Continuing his activity as an artist-painter. Since 1996: Joined the "House of Artists", he devotes himself exclusively to painting and illustrations - perspectives. Personal exhibitions and participations in artists'' fairs regularly (Salon d''Automne, Salon of drawing and painting with water, living room of Colombes, Grand market of contemporary art, Art-Metz, living room of XV ° in Paris). He has also made carpets according to his models, created frescos and sculptures, paintings commissioned by architects and decorators for their projects. "My work, although abstract, is deeply rooted in nature. telluric, aerial and oceanic forces My imagination, nourished by a regular exercise of drawing and working on the motif, is also set in motion by pictorial "discoveries" that a chance that I invite on my canvases offers me. I strive to create a space in my paintings so that the "specta (c) tor" can appropriate this universe (of which I would be only a kind of medium) by integrating its own stories. " Pascal Langevin', 72, NULL, NULL, NULL, 2),
(27, '\r\nPascal Langevin生活和工作於巴黎和Belle-Ile en Mer 1978年：第一次個人展覽。水彩畫 - 石膏 -  1980年的油：在不同的室內設計機構工作。繼續他的藝術家 - 畫家的活動。自1996年以來：加入“藝術家之家”，他專門致力於繪畫和插圖的角度。定期舉辦個人展覽和藝術家博覽會（沙龍d''Automne，繪畫與水彩沙龍，Colombes的客廳，當代藝術大市場，Art-Metz，巴黎XV°的客廳）。他還根據自己的模型製作了地毯，創作了壁畫和雕塑，由建築師和裝飾師為他們的項目委託繪畫作品。“我的作品雖然抽象，卻深深植根於自然界。地球，海洋和海洋力量我的想像力，通過定期練習繪畫和對主題的工作而得到了滋養，也通過繪畫“發現”啟動，我有機會邀請我的畫布提供給我。我試圖在我的畫作中創造一個空間，這樣，通過整合它自己的故事，“specta（c）tor”可以適應這個宇宙（我將只是一種媒介）。“帕斯卡蘭傑文', 72, NULL, NULL, NULL, 5),
(28, '\r\nSince my childhood I have always been very influenced by art. Notably thanks to my father who was an art teacher and to my brothers who also worked in painting. I have always loved and been drawn to cars and the details of their design. So at fifteen, I decided to study automotive design. I trained in this branch in Guadalajara (Mexico) before leaving a few months later for Germany. Two years later I moved to France, where I live now. I decided to continue my career in art but this time a little different to what I did previously. I started to make some paintings, to express my ideas differently and more only in the automotive field. Today I make drawings and paintings around themes that are dear to me as the Mexican culture, my country of origin. I am more inspired by my culture since I live abroad and wish to share it through my paintings. So I continue to learn new things as well as different techniques. It allows me to surpass myself every day while doing what I like. I changed my path but no goal.', 71, NULL, NULL, NULL, 2),
(29, '自從我小時候，我一直很受藝術影響。值得一提的是，感謝我的父親是美術老師，還有我的兄弟也曾在繪畫中工作過。我一直喜歡並被吸引到汽車和他們的設計細節。所以十五歲時，我決定學習汽車設計。我在瓜達拉哈拉（墨西哥）的這個分支接受過培訓，然後在幾個月後離開德國。兩年後，我搬到了現在居住的法國。我決定繼續我的藝術生涯，但這次與我以前的做法有點不同。我開始製作一些畫作，以不同的方式表達我的想法，更多的只是在汽車領域。今天，我以墨西哥文化和我的原籍國為主題，為我繪製主題圖畫。自從我居住在國外並且希望通過我的畫作分享我的文化之後，我的靈感來自於我的文化。所以我繼續學習新事物以及不同的技術。它可以讓我在做我喜歡的事情的同時每天超越自己。我改變了我的道路，但沒有進球。', 71, NULL, NULL, NULL, 5),
(30, '\r\nThe study of the human body and its setting in space makes it possible to highlight the tensions, the movements, all the facets, the asperities of the human soul. From water to matter, from line to color, from canvas to paper reveal imaginary universes, unexpected atmospheres. Together, these models become people weaving relationships between them. The brush tells a story. How to fill this empty space? To create a story and to try to represent it, to transmit it through the sensations, the provoked impressions. Human souls thus express themselves in these nooks and crannies, in search of a sincerity, a truth.', 70, NULL, NULL, NULL, 2),
(31, '\r\n研究人體及其在太空中的位置，可以突出人類靈魂的緊張局勢，動作，所有方面和粗糙。從水到物質，從線條到彩色，從畫佈到紙張，都展現出想像中的宇宙，意想不到的氛圍。這些模型一起成為編織它們之間關係的人。畫筆講述一個故事。如何填補這個空白空間？創造一個故事並嘗試去表現它，通過感受和煽動的印象來傳遞它。因此，人類的靈魂在這些角落和縫隙中表達自己，尋找真誠和真理。', 70, NULL, NULL, NULL, 5),
(32, 'The light buried in flowers resurfaces It is the ambition to eternalize on the canvas the energy necessary for any flowering that motivates the painting of Nadine Pillon. The artist unveils here his latest works, the fruit of a work that highlights the link that unite food vase and slender rods. Thus we discover scenes where the look is offbeat, surprising: the artist approaches his subjects, brings to light the vase, while transparency where the insolent bouquet is barely shown. below ... We are deprived of the plume of his bouquets! Nadine Pillon does not impose, Nadine Pillon suggests and, generous offer by the spread shadows, a large place to our imagination.Une new approach while modernity, a new breath marrying figurative aesthetic approach and lightness sometimes close to abstraction, but without excess because for the artist, "what is beautiful must remain legible". She wants to seize everything under the tip of her knife, imprisoning in the thick paste the strength and tenacity of the budding, the flamboyance and fullness of flowering, the inevitable wilting and the sad decline, before everything is diluted in time. His works are a harmony of bright colors that radiate gaiety, a hymn to life. What we decipher goes well beyond the beauty of the flowers. It is a painting that immerses us in an intimate reflection and makes us humble before this nature of inexhaustible wealth.', 69, NULL, NULL, NULL, 2),
(33, '\r\n該地埋燈復出花它是野心在畫布上延續所必需的任何開花的能量激發繪畫納丁皮隆。畫家在此揭示了他最後的作品，作品的，突出的是美國支線船舶和纖細的莖鏈接的結果。因此，我們發現場景中看起來是古怪，令人驚訝的藝術家接近他的臣民，突出了花瓶，而透明度其中面露花束顯示，勉強.Dessus下面...我們被剝奪了他的花束羽毛！納丁皮隆沒有，建議納丁皮隆和慷慨建議蔓延的陰影，一個大的地方在我們的新imagination.Une方法而現代呼吸新的審美相結合的方法抽象的具象，有時接近亮度，但沒有多餘，因為對於藝術家來說，“美麗的東西必須清晰可見”。她希望他的刀，被困在麵團厚實力和出芽，華麗和開花的豐滿，必然枯萎和悲傷下降韌性的尖下掌握一切，之前一切都變得隨著時間的推移稀釋。他的作品融合了鮮豔的色彩，散發歡樂，是生活的讚美詩。我們破譯的內容遠遠超出了花的美。這是一幅讓我們沉浸在親密反思中的繪畫，讓我們在取之不盡的財富之前謙卑起來。', 69, NULL, NULL, NULL, 5),
(34, '\r\n"Colors in the eyes" could sum up the work of Stéphane Cattaneo. Lunar landscapes, flowery imaginations, lovers, monochrome portraits are so many topics addressed by the artist. Multiplying the techniques, he depicts kingdoms and spaces out of time. One would lend oneself almost to look at one''s works with a child''s look; amazed and naive.', NULL, NULL, 25, NULL, 2),
(35, '\r\n“眼中的色彩”可以总结StéphaneCattaneo的工作。月球景观，华丽的想象，恋人，单色肖像是艺术家讨论的很多话题。把技术加倍，他用时间来描述王国和空间。人们几乎可以借助孩子的外表来看待自己的作品;惊讶和天真。', NULL, NULL, 25, NULL, 5),
(36, '\r\n"Here are long lasting flowers that last little" Victor Hugo The hydrangea, the exception that confirms the rule ... knife work and transparency of petals colors', NULL, NULL, 42, NULL, 2),
(37, '這裡是持久的鮮花，持續一點”維克多雨果繡球花，例外，證實了規則...刀工作和花瓣顏色的透明度', NULL, NULL, 42, NULL, 5),
(38, '\r\nFrom a rather detailed sketch worked in a workshop with a model, I explored different atmospheres through singular colorful declensions inspired by the seasons. The very liquid acrylic allows to work on several paintings at the same time. These feed on each other. The colors are superimposed little by little, in transparency or in flat. A work of back and forth takes place. The particular framing of the subject allows to focus on the bust and the center of the body. The drapery is worked at the same time and in the same way as the body, as if it were part of it.', NULL, NULL, 41, NULL, 2),
(39, '\r\n我从一个模型车间的相当详细的素描中，探索了不同的氛围，通过季节启发的奇异的多彩declensions。非常流动的丙烯酸可以同时处理多幅画作。这些互相馈送。颜色一点一点地叠加在一起，透明或平坦。一个来回的工作发生。对象的特定构图允许集中于胸部和身体的中心。帷幔在同一时间以与身体一样的方式工作，好像它是它的一部分', NULL, NULL, 41, NULL, 5),
(40, '\r\nThis painting is inspired by the feast of the dead, a feast originating in Mexico, whose traditions are a mixture of different beliefs, especially Christian and indigenous. On the day of the Day of the Dead, families gather at the graves of their ancestors and clean them, decorate them with candles, lay food and flower them (especially with orange flowers called zempaxuchitl). The souls of the deceased then return to Earth to visit their loved ones and enjoy the offerings.', NULL, NULL, 40, NULL, 2),
(41, '这幅画灵感来自于死者的盛宴，这是一场起源于墨西哥的盛宴，其传统融合了不同的信仰，特别是基督教和土着。在死亡日的那天，家属们聚集在祖先的坟墓上并清理它们，用蜡烛装饰它们，放置食物和盛开（尤其是用橙色的花称为zempaxuchitl）。死者的灵魂然后返回地球去拜访他们的亲人并享受奉献。', NULL, NULL, 40, NULL, 5),
(42, '\r\nStay tuned what nature offers us! This is my goal by working on the motive: Here a pastels made in Belle-ile at sea (on an acrylic background) in front of a bunch of "Lambert''s Cypress" tortured by the wind. Basic frame', NULL, NULL, 39, NULL, 2),
(43, '\r\n敬请期待大自然为我们提供的！这是我的动机目标：在这里，在海面上（在丙烯酸背景上）在Belle-ile中制作的粉彩在一群受风折磨的“Lambert''s Cypress”前面。基本框架', NULL, NULL, 39, NULL, 5),
(44, '\r\nDigital work based on a photograph of Marilyn Monroe in Black and White. Offset printing (professional plotter) on paper, laminated on PVC.Marilyn Monroe as an icon of an era, a reference to American Pop art, commercials and comics from the 60s inlaid in transparency in solid colors.', NULL, NULL, 37, NULL, 2),
(45, '\r\n基於瑪麗蓮夢露黑與白照片的數字作品，紙上的膠印（專業繪圖儀），層壓PVC.Marilyn Monroe作為一個時代的圖標，參考60年代的美國流行藝術，商業和漫畫以純色鑲嵌透明。', NULL, NULL, 37, NULL, 5),
(46, 'Part of a series around Butoh dance.', NULL, NULL, 35, NULL, 2),
(47, 'Butoh舞蹈的一部分。', NULL, NULL, 35, NULL, 5),
(48, '\r\n"Abstract foliage in purple, blue and pink", spray paint and acrylic on MDF board. A beautiful romantic and vegetal atmosphere, with natural forms of foliage. The leaves are purely decorative ornaments. I was thinking of a dream landscape. I like the complexity of natural shapes, their shapes and colors. Nature is fascinating for a painter, even if it''s an imaginary nature! This work will be delivered with an invoice and a signed certificate of authenticity. The painting has a system of hanging on the back. The MDF board is 0.5cm thick.', NULL, NULL, 34, NULL, 2),
(49, '\r\n“紫色，藍色和粉紅色的抽象葉子”，在MDF板上噴漆和丙烯酸樹脂。一個美麗的浪漫和植物的氣氛，與自然形式的葉子。葉子純粹是裝飾性的裝飾品。我在想一個夢幻般的景觀。我喜歡自然形狀的複雜性，形狀和顏色。大自然對於畫家來說很吸引人，即使它是一種虛構的本質！這項工作將與發票和簽名的真實性證書一起交付。這幅畫有一個掛在背上的系統。 MDF板厚0.5厘米。', NULL, NULL, 34, NULL, 5),
(50, '\r\nMany of my photographs are based on capturing lines or curves. I am fascinated by the images that can be created by looking at these details.', NULL, NULL, 32, NULL, 2),
(51, '\r\n我的许多照片都是基于捕捉线条或曲线。我对可以通过查看这些细节创建的图像着迷。', NULL, NULL, 32, NULL, 5),
(52, '\r\nThe violence of the wave that arises, the foam that flies, the force that submerges and carries everything in its path, the endless movement of the untamed sea.', NULL, NULL, 30, NULL, 2),
(53, '\r\n产生的浪潮，飞翔的泡沫，淹没和携带一切的力量，以及未开化的海洋的无尽运动。', NULL, NULL, 30, NULL, 5),
(54, '\r\nWatercolor romantic evoking the dramatic and excessive feeling of the waves and the ocean. The bluish and purplish tones reinforce the coldness of the water. The very texture of the watercolor, drips, splashes helps to make the waves true movement.', NULL, NULL, 28, NULL, 2),
(55, '\r\n水彩浪漫唤起波浪和海洋的戏剧性和过度的感觉。蓝色和紫色的色调加强了水的冰冷。水彩的质感，滴水，飞溅有助于让海浪真正运动。', NULL, NULL, 28, NULL, 5),
(56, '\r\nChinese ink, black felt and dry pastel on Canson paper.', NULL, NULL, 27, NULL, 2),
(57, '\r\n中国墨水，黑色毡和干燥的彩色纸在康生纸上。', NULL, NULL, 27, NULL, 5),
(58, 'On its stem, the iris stands to offer itself to the eyes ... a simple enchantment.', NULL, NULL, 43, NULL, 2),
(59, '就其本身而言，虹膜可以让人眼前一亮......一种简单的魅力。', NULL, NULL, 43, NULL, 5),
(60, '\r\n"Voluptuousness, always be my queen, take the mask of a mermaid Made of flesh and velvet, Or pour me your sleep in the formless and mystical wine, Voluptuousness, elastic ghost!" Charles Baudelaire', NULL, NULL, 44, NULL, 2),
(61, '\r\n“妖娆，永远是我的女王，拿着美人鱼的面具用肉和天鹅绒做成，或者把你的睡眠灌入无形神秘的酒，妖娆，有弹性的鬼魂！” Charles Baudelaire', NULL, NULL, 44, NULL, 5),
(62, 'romantic inspiration for this watercolor in purple and brown tones. Path at the edge of a lake, the mist rises and drowns the distant landscape. Only the path is clear and uneven, the trees and their branches are carved by withdrawals of material that give effects of light and movement in the branches.', NULL, NULL, 45, NULL, 2),
(63, '\r\n浪漫的紫色和棕色色调的水彩灵感。在湖边的小路上，雾气升起，淹没了远处的风景。只有路径清澈而不平坦，树木和树枝被树枝上的光线和运动物质的取出所雕刻。', NULL, NULL, 45, NULL, 5),
(64, 'Digital work based on a photograph of Marilyn Monroe in Black and White. Offset printing on laminated paper on PVC. Inspiration Pop Art (comics and advertising of the 60s in the United States are present in solid colors and in the contours of the face ), I incorporate jets of paint as a reminder to Pollock''s Action painting. The iconography of Pop Culture (of course Andy Warhol) as doped with digital tools, a reflection that echoes our times.', NULL, NULL, 46, NULL, 2),
(65, '\r\n基于玛丽莲梦露黑白照片的数字作品在PVC层压纸上的胶印印刷灵感波普艺术（美国60年代的漫画和广告以纯色和脸部轮廓呈现），我将油漆喷射作为提醒Pollock的行动绘画。流行文化的图像（当然是安迪沃霍尔）掺杂了数字工具，这反映了我们的时代', NULL, NULL, 46, NULL, 5),
(66, '\r\nA stylized declination of a dream landscape, in shades of pink and mauve, embellished with touches of turquoise. "Purple is the color of the year 2018. I''ve paired it with magenta, purple, and light gray and turquoise greens, between turquoise and celadon." I used acrylic and pastels with wax to add graphics and animate the surfaces .. "Fabienne Monestier\r\n\r\nThe work is painted on a canvas board 3mm thick. She is ready to hang with a back system.', NULL, NULL, 47, NULL, 2),
(67, '\r\n淡淡的粉紅色和淡紫色，帶有綠松石色調的夢幻風景的程式化傾斜。 “紫色是2018年的顏色。我與綠松石和青瓷之間的洋紅色，紫色，淺灰色和綠松石綠配對。”我使用丙烯酸和用蠟粉蠟添加圖形並使表面動畫。“Fabienne Monestier\r\n\r\n工作被畫在3毫米厚的帆佈板上。她已準備好掛回系統。', NULL, NULL, 47, NULL, 5),
(68, '\r\nOriginal watercolor on paper, 20X20 cm.\r\n\r\nAbstract winter landscape in pink, orange and purple. This little watercolor evokes a cold winter morning at sunrise. The light of dawn draws the silhouettes of trees in the backlight. The trees in the mist are just suggested, the blur effects accentuate the atmospheric atmosphere of this painting.\r\n\r\nPainting delivered with a certificate of authenticity, signed and an invoice. Sending neat and followed.', NULL, NULL, 48, NULL, 2),
(69, '\r\n紙上的原始水彩，20X20厘米。\r\n\r\n抽象的冬季景觀粉色，橙色和紫色。這個小小的水彩在日出時喚起寒冷的冬天的早晨。黎明的光線在背光中畫出了樹木的輪廓。只是建議霧中的樹木，模糊效果突出了這幅畫的氣氛。\r\n\r\n繪畫交付了真實性證書，簽名和發票。發送整齊並遵循。', NULL, NULL, 48, NULL, 5),
(70, 'Rural landscape, original painting, oil on canvas, 30x30x1,6 cm, 2018.', NULL, NULL, 49, NULL, 2),
(71, '\r\n乡村景观，原创油画，布面油画，30x30x1,6厘米，2018年。', NULL, NULL, 49, NULL, 5),
(72, '\r\nSeries of drawings inspired by ballet dancers.Chinese ink and silver ink on Canson paper.', NULL, NULL, 51, NULL, 2),
(73, '\r\n一系列由芭蕾舞演员启发的绘画。在康颂纸上的中国墨水和银色墨水。', NULL, NULL, 51, NULL, 5),
(74, '\r\nMacro photography of the salt marshes of the Ile de Re. There are shapes and colors that are not expected. Nature is definitely full of surprises', NULL, NULL, 52, NULL, 2),
(75, '\r\nIle de Re盐沼的宏观摄影。有没有预期的形状和颜色。自然绝对充满了惊喜', NULL, NULL, 52, NULL, 5),
(76, '\r\nMacro photography of the salt marshes of the Ile de Re. There are shapes and colors that are not expected. Nature is definitely full of surprises', NULL, NULL, 53, NULL, 2),
(77, '\r\nIle de Re盐沼的宏观摄影。有没有预期的形状和颜色。自然绝对充满了惊喜', NULL, NULL, 53, NULL, 5),
(78, '\r\nMacro photography of the salt marshes of the Ile de Re. There are shapes and colors that are not expected. Nature is definitely full of surprises', NULL, NULL, 54, NULL, 2),
(79, '\r\nIle de Re盐沼的宏观摄影。有没有预期的形状和颜色。自然绝对充满了惊喜', NULL, NULL, 54, NULL, 5),
(80, '\r\nMacro photography of the salt marshes of the Ile de Re. There are shapes and colors that are not expected. Nature is definitely full of surprises', NULL, NULL, 55, NULL, 2),
(81, '\r\nIle de Re盐沼的宏观摄影。有没有预期的形状和颜色。自然绝对充满了惊喜', NULL, NULL, 55, NULL, 5),
(82, '\r\nMacro photography of the salt marshes of the Ile de Re. There are shapes and colors that are not expected. Nature is definitely full of surprises', NULL, NULL, 56, NULL, 2),
(83, '\r\nIle de Re盐沼的宏观摄影。有没有预期的形状和颜色。自然绝对充满了惊喜', NULL, NULL, 56, NULL, 5),
(84, '\r\nMacro photography of the salt marshes of the Ile de Re. There are shapes and colors that are not expected. Nature is definitely full of surprises', NULL, NULL, 57, NULL, 2),
(85, '\r\nIle de Re盐沼的宏观摄影。有没有预期的形状和颜色。自然绝对充满了惊喜', NULL, NULL, 57, NULL, 5),
(86, '\r\nPhotographer and saunier in Ars en Ré since 2004, I wish you a pleasant walk on my salt marshes, through these paintings.', 81, NULL, NULL, NULL, 2),
(87, '\r\n自2004年以来，摄影师和摄影师在Ars enRé，我希望你能在我的盐沼上散步，通过这些画作。', 81, NULL, NULL, NULL, 5),
(88, '\r\nBorn in 1975, Lise Hébuterne lives and works in Paris. Passionate about books, she started traveling through some of them. In particular, the adventures of Tintin and those of Nicolas Bouvier. "Leaving, see what is happening elsewhere, far, here, there, I always dreamed of it: until the first departure.This need to discover others places, other people is omnipresent at home, traveling often alone, I go backpack and camera in hand.It has revealed, over the years, my companion ideal road.Sleep to better contemplate ... "From the Americas to Asia, his photographs are an invitation to travel. An invitation to discover and re-discover the world and what makes it up: "to see what we do not see, or more, see differently."', 82, NULL, NULL, NULL, 2),
(89, '\r\nLiseHébuterne生於1975年，在巴黎生活和工作。對書籍充滿熱情，她開始瀏覽其中的一些書籍。特別是，丁丁和尼古拉斯布維爾的冒險。“離開，看看其他地方發生了什麼，遠在這裡，那裡，我一直夢想著：直到第一次離開。這需要發現其他人其他人在家裡無處不在，常常獨自旅行，我背著背包和相機在手。它透露，多年來，我的伴侶的理想之路。更好地思考......“從美洲到亞洲，他的照片是一個旅行邀請。邀請您發現並重新發現這個世界以及它的成就：“看到我們看不到的東西，或者更多，看到不同的東西。”', 82, NULL, NULL, NULL, 5),
(90, '\r\nContemporary artist born in 1990, I live and work in Paris. My works are the result of a support trip in support, from a manual gesture on a paper to a print on photographic paper, from the manual to digital and from drawing to photography. It''s a kind of "DIY" of different mediums. I build my images, I make them, I assemble elements like a puzzle or a patchwork. It is a division of time and space, the visible and the invisible. It is a kind of visual chaos, accumulation of elements that work with each other. Drawing and photography are one. There is an atemporality in these images which plunges the spectator into a state of contemplation. Photography is not only visual. I want to give free rein to the sensitive imagination, that the spectator lets himself be carried by his sensations.', 83, NULL, NULL, NULL, 2),
(91, '\r\n1990年出生的當代藝術家，我在巴黎生活和工作。我的作品是支持旅行的結果，從紙張上的手動手勢到照片紙上的手稿，從手動到數字，從繪畫到攝影。這是一種不同媒介的“DIY”。我建立了我的圖像，我製作了它們，我組裝了一些拼圖或拼湊的元素。它是時間和空間的劃分，可見和不可見。這是一種視覺混亂，積累的元素相互配合。繪畫和攝影是一個。這些圖像中有一種無意識，使觀眾陷入沉思狀態。攝影不僅是視覺的。我想充分發揮敏銳的想像力，觀眾讓自己被他的感受所帶動。', 83, NULL, NULL, NULL, 5),
(92, '\r\nJapan.The nature offers surprising natural paintings as soon as we look closer. Here, the fog of an onsen (thermal bath) in the air, at night. Digital photography.', NULL, NULL, 58, NULL, 2),
(93, '\r\n日本。一旦我们看得更近，大自然就会提供令人惊讶的自然画作。在这里，夜晚的空气中的温泉（温泉浴）的雾。数码摄影。', NULL, NULL, 58, NULL, 5),
(94, 'Malaysia.Georgetown, In the courtyard of a temple, a huge cauldron filled with sand is home to huge sticks of incense. Digital photography.', NULL, NULL, 59, NULL, 2),
(95, '\r\n马来西亚.Georgetown，在一座寺庙的院子里，一个盛满沙子的大锅盛满了巨大的香炉。', NULL, NULL, 59, NULL, 5),
(96, '\r\nThis work is a color digital photograph created for a contest called "Purple".', NULL, NULL, 60, NULL, 2),
(97, '\r\n这部作品是一个彩色数码相片，名为“Purple”。', NULL, NULL, 60, NULL, 5),
(98, 'This work is a digital photograph that deals with sensations.', NULL, NULL, 61, NULL, 2),
(99, '\r\n这项工作是处理感觉的数码照片。', NULL, NULL, 61, NULL, 5),
(100, 'This work is a mixture of ink and felts.', NULL, NULL, 62, NULL, 2),
(101, '\r\n这项工作是墨水和毛毡的混合物。', NULL, NULL, 62, NULL, 5),
(102, '\r\nThis work is a mixture of ink and felts.', NULL, NULL, 63, NULL, 2),
(103, '\r\n这项工作是墨水和毛毡的混合物。', NULL, NULL, 63, NULL, 5),
(104, '\r\nThis work is a digital photograph created for a contest called "Purple".', NULL, NULL, 64, NULL, 2),
(105, '\r\n这部作品是为“紫色”比赛创作的数码照片。', NULL, NULL, 64, NULL, 5);

-- --------------------------------------------------------

--
-- Structure de la table `Type_donnee_enrichie`
--

CREATE TABLE IF NOT EXISTS `Type_donnee_enrichie` (
`idTypeDonneEnrichie` int(11) NOT NULL,
  `libelleTypeDonneEnrichie` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Contenu de la table `Type_donnee_enrichie`
--

INSERT INTO `Type_donnee_enrichie` (`idTypeDonneEnrichie`, `libelleTypeDonneEnrichie`) VALUES
(1, 'Video'),
(2, 'Sonore'),
(3, 'Image'),
(4, 'Lien externe');

-- --------------------------------------------------------

--
-- Structure de la table `Type_oeuvre`
--

CREATE TABLE IF NOT EXISTS `Type_oeuvre` (
`idTypeOeuvre` int(11) NOT NULL,
  `libelleTypeOeuvre` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Contenu de la table `Type_oeuvre`
--

INSERT INTO `Type_oeuvre` (`idTypeOeuvre`, `libelleTypeOeuvre`) VALUES
(1, 'Peinture'),
(2, 'Sculptures'),
(3, 'Tapisserie'),
(4, 'Dessin'),
(5, 'Aquarelle'),
(6, 'Photographie');

-- --------------------------------------------------------

--
-- Structure de la table `Type_utilisateur`
--

CREATE TABLE IF NOT EXISTS `Type_utilisateur` (
`idTypeUtilisateur` int(11) NOT NULL,
  `libelleTypeUtilisateur` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Contenu de la table `Type_utilisateur`
--

INSERT INTO `Type_utilisateur` (`idTypeUtilisateur`, `libelleTypeUtilisateur`) VALUES
(1, 'admin'),
(2, 'utilisateur');

-- --------------------------------------------------------

--
-- Structure de la table `Utilisateur`
--

CREATE TABLE IF NOT EXISTS `Utilisateur` (
`idUtilisateur` int(11) NOT NULL,
  `nom` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `mot_de_passe` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `identifiant` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `prenom` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `idTypeUtilisateur` int(11) DEFAULT NULL,
  `email` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `userState` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Contenu de la table `Utilisateur`
--

INSERT INTO `Utilisateur` (`idUtilisateur`, `nom`, `mot_de_passe`, `identifiant`, `prenom`, `idTypeUtilisateur`, `email`, `userState`) VALUES
(1, 'admin', 'fd934afd8b3a6cb5d774e40ab3e28a4323075d9b', 'admin', 'admin', 1, 'f.boubee@gmail.com', 1);

--
-- Index pour les tables exportées
--

--
-- Index pour la table `Artiste`
--
ALTER TABLE `Artiste`
 ADD PRIMARY KEY (`idArtiste`);

--
-- Index pour la table `ArtisteExpose`
--
ALTER TABLE `ArtisteExpose`
 ADD PRIMARY KEY (`idArtiste`,`idExpo`), ADD UNIQUE KEY `cpl_unik1` (`idArtiste`,`idExpo`), ADD KEY `ArtisteExpose_ibfk_2` (`idExpo`);

--
-- Index pour la table `Collectif`
--
ALTER TABLE `Collectif`
 ADD PRIMARY KEY (`idCollectif`);

--
-- Index pour la table `CollectifExpose`
--
ALTER TABLE `CollectifExpose`
 ADD PRIMARY KEY (`idCollectif`,`idExpo`), ADD KEY `idExpo` (`idExpo`);

--
-- Index pour la table `Communaute`
--
ALTER TABLE `Communaute`
 ADD PRIMARY KEY (`idArtiste`,`idCollectif`), ADD KEY `FK_appartenir_idCollectif` (`idCollectif`);

--
-- Index pour la table `Donnee_enrichie`
--
ALTER TABLE `Donnee_enrichie`
 ADD PRIMARY KEY (`idDonneeEnrichie`), ADD KEY `FK_Donnee_enrichie_idTypeDonneEnrichie` (`idTypeDonneEnrichie`), ADD KEY `FK_Donnee_enrichie_idOeuvre` (`idOeuvre`);

--
-- Index pour la table `Emplacement`
--
ALTER TABLE `Emplacement`
 ADD PRIMARY KEY (`idEmplacement`), ADD KEY `idOeuvreExposee` (`idOeuvreExposee`), ADD KEY `FK_Emplacement_idExpo` (`idExpo`);

--
-- Index pour la table `Exposition`
--
ALTER TABLE `Exposition`
 ADD PRIMARY KEY (`idExpo`);

--
-- Index pour la table `Langue`
--
ALTER TABLE `Langue`
 ADD PRIMARY KEY (`idLangue`);

--
-- Index pour la table `Langue_expo`
--
ALTER TABLE `Langue_expo`
 ADD PRIMARY KEY (`idExpo`,`idLangue`), ADD KEY `FK_affecter_idLangue` (`idLangue`);

--
-- Index pour la table `Message_interne`
--
ALTER TABLE `Message_interne`
 ADD PRIMARY KEY (`idMessage`), ADD KEY `FK_Message_interne_idOeuvre` (`idOeuvre`), ADD KEY `FK_Message_interne_idArtiste` (`idArtiste`), ADD KEY `FK_Message_interne_idExpo` (`idExpo`), ADD KEY `FK_Message_interne_idCollectif` (`idCollectif`), ADD KEY `FK_Message_interne_idUtilisateur` (`idUtilisateur`);

--
-- Index pour la table `Oeuvre`
--
ALTER TABLE `Oeuvre`
 ADD PRIMARY KEY (`idOeuvre`), ADD KEY `FK_Oeuvre_idTypeOeuvre` (`idTypeOeuvre`), ADD KEY `FK_Oeuvre_idArtiste` (`idArtiste`), ADD KEY `FK_Oeuvre_idCollectif` (`idCollectif`);

--
-- Index pour la table `OeuvreExposee`
--
ALTER TABLE `OeuvreExposee`
 ADD PRIMARY KEY (`idOeuvreExposee`), ADD UNIQUE KEY `cpl_unik2` (`idOeuvre`,`idExpo`), ADD KEY `idEmplacement` (`idOeuvre`,`idExpo`), ADD KEY `idOeuvre` (`idOeuvre`), ADD KEY `idExpo` (`idExpo`);

--
-- Index pour la table `Traduction`
--
ALTER TABLE `Traduction`
 ADD PRIMARY KEY (`idTraduction`), ADD KEY `FK_Traduction_idArtiste` (`idArtiste`), ADD KEY `FK_Traduction_idCollectif` (`idCollectif`), ADD KEY `FK_Traduction_idOeuvre` (`idOeuvre`), ADD KEY `FK_Traduction_idExpo` (`idExpo`), ADD KEY `FK_Traduction_idLangue` (`idLangue`);

--
-- Index pour la table `Type_donnee_enrichie`
--
ALTER TABLE `Type_donnee_enrichie`
 ADD PRIMARY KEY (`idTypeDonneEnrichie`);

--
-- Index pour la table `Type_oeuvre`
--
ALTER TABLE `Type_oeuvre`
 ADD PRIMARY KEY (`idTypeOeuvre`);

--
-- Index pour la table `Type_utilisateur`
--
ALTER TABLE `Type_utilisateur`
 ADD PRIMARY KEY (`idTypeUtilisateur`);

--
-- Index pour la table `Utilisateur`
--
ALTER TABLE `Utilisateur`
 ADD PRIMARY KEY (`idUtilisateur`), ADD KEY `FK_Utilisateur_idTypeUtilisateur` (`idTypeUtilisateur`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `Artiste`
--
ALTER TABLE `Artiste`
MODIFY `idArtiste` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=84;
--
-- AUTO_INCREMENT pour la table `Collectif`
--
ALTER TABLE `Collectif`
MODIFY `idCollectif` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=52;
--
-- AUTO_INCREMENT pour la table `Donnee_enrichie`
--
ALTER TABLE `Donnee_enrichie`
MODIFY `idDonneeEnrichie` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT pour la table `Emplacement`
--
ALTER TABLE `Emplacement`
MODIFY `idEmplacement` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=564;
--
-- AUTO_INCREMENT pour la table `Exposition`
--
ALTER TABLE `Exposition`
MODIFY `idExpo` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=129;
--
-- AUTO_INCREMENT pour la table `Langue`
--
ALTER TABLE `Langue`
MODIFY `idLangue` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT pour la table `Message_interne`
--
ALTER TABLE `Message_interne`
MODIFY `idMessage` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `Oeuvre`
--
ALTER TABLE `Oeuvre`
MODIFY `idOeuvre` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=66;
--
-- AUTO_INCREMENT pour la table `OeuvreExposee`
--
ALTER TABLE `OeuvreExposee`
MODIFY `idOeuvreExposee` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=146;
--
-- AUTO_INCREMENT pour la table `Traduction`
--
ALTER TABLE `Traduction`
MODIFY `idTraduction` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=106;
--
-- AUTO_INCREMENT pour la table `Type_donnee_enrichie`
--
ALTER TABLE `Type_donnee_enrichie`
MODIFY `idTypeDonneEnrichie` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT pour la table `Type_oeuvre`
--
ALTER TABLE `Type_oeuvre`
MODIFY `idTypeOeuvre` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT pour la table `Type_utilisateur`
--
ALTER TABLE `Type_utilisateur`
MODIFY `idTypeUtilisateur` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT pour la table `Utilisateur`
--
ALTER TABLE `Utilisateur`
MODIFY `idUtilisateur` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `ArtisteExpose`
--
ALTER TABLE `ArtisteExpose`
ADD CONSTRAINT `ArtisteExpose_ibfk_1` FOREIGN KEY (`idArtiste`) REFERENCES `Artiste` (`idArtiste`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT `ArtisteExpose_ibfk_2` FOREIGN KEY (`idExpo`) REFERENCES `Exposition` (`idExpo`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `CollectifExpose`
--
ALTER TABLE `CollectifExpose`
ADD CONSTRAINT `CollectifExpose_ibfk_1` FOREIGN KEY (`idCollectif`) REFERENCES `Collectif` (`idCollectif`),
ADD CONSTRAINT `CollectifExpose_ibfk_2` FOREIGN KEY (`idExpo`) REFERENCES `Exposition` (`idExpo`);

--
-- Contraintes pour la table `Communaute`
--
ALTER TABLE `Communaute`
ADD CONSTRAINT `FK_appartenir_idArtiste` FOREIGN KEY (`idArtiste`) REFERENCES `Artiste` (`idArtiste`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT `FK_appartenir_idCollectif` FOREIGN KEY (`idCollectif`) REFERENCES `Collectif` (`idCollectif`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `Donnee_enrichie`
--
ALTER TABLE `Donnee_enrichie`
ADD CONSTRAINT `FK_Donnee_enrichie_idOeuvre` FOREIGN KEY (`idOeuvre`) REFERENCES `Oeuvre` (`idOeuvre`),
ADD CONSTRAINT `FK_Donnee_enrichie_idTypeDonneEnrichie` FOREIGN KEY (`idTypeDonneEnrichie`) REFERENCES `Type_donnee_enrichie` (`idTypeDonneEnrichie`);

--
-- Contraintes pour la table `Emplacement`
--
ALTER TABLE `Emplacement`
ADD CONSTRAINT `FK_Emplacement_idExpo` FOREIGN KEY (`idExpo`) REFERENCES `Exposition` (`idExpo`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `Langue_expo`
--
ALTER TABLE `Langue_expo`
ADD CONSTRAINT `FK_affecter_idExpo` FOREIGN KEY (`idExpo`) REFERENCES `Exposition` (`idExpo`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT `FK_affecter_idLangue` FOREIGN KEY (`idLangue`) REFERENCES `Langue` (`idLangue`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `Message_interne`
--
ALTER TABLE `Message_interne`
ADD CONSTRAINT `FK_Message_interne_idUtilisateur` FOREIGN KEY (`idUtilisateur`) REFERENCES `Utilisateur` (`idUtilisateur`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Contraintes pour la table `Oeuvre`
--
ALTER TABLE `Oeuvre`
ADD CONSTRAINT `FK_Oeuvre_idArtiste` FOREIGN KEY (`idArtiste`) REFERENCES `Artiste` (`idArtiste`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT `FK_Oeuvre_idCollectif` FOREIGN KEY (`idCollectif`) REFERENCES `Collectif` (`idCollectif`),
ADD CONSTRAINT `FK_Oeuvre_idTypeOeuvre` FOREIGN KEY (`idTypeOeuvre`) REFERENCES `Type_oeuvre` (`idTypeOeuvre`);

--
-- Contraintes pour la table `OeuvreExposee`
--
ALTER TABLE `OeuvreExposee`
ADD CONSTRAINT `OeuvreExposee_ibfk_2` FOREIGN KEY (`idOeuvre`) REFERENCES `Oeuvre` (`idOeuvre`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT `OeuvreExposee_ibfk_3` FOREIGN KEY (`idExpo`) REFERENCES `Exposition` (`idExpo`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `Traduction`
--
ALTER TABLE `Traduction`
ADD CONSTRAINT `FK_Traduction_idArtiste` FOREIGN KEY (`idArtiste`) REFERENCES `Artiste` (`idArtiste`),
ADD CONSTRAINT `FK_Traduction_idCollectif` FOREIGN KEY (`idCollectif`) REFERENCES `Collectif` (`idCollectif`),
ADD CONSTRAINT `FK_Traduction_idExpo` FOREIGN KEY (`idExpo`) REFERENCES `Exposition` (`idExpo`),
ADD CONSTRAINT `FK_Traduction_idLangue` FOREIGN KEY (`idLangue`) REFERENCES `Langue` (`idLangue`),
ADD CONSTRAINT `FK_Traduction_idOeuvre` FOREIGN KEY (`idOeuvre`) REFERENCES `Oeuvre` (`idOeuvre`);

--
-- Contraintes pour la table `Utilisateur`
--
ALTER TABLE `Utilisateur`
ADD CONSTRAINT `FK_Utilisateur_idTypeUtilisateur` FOREIGN KEY (`idTypeUtilisateur`) REFERENCES `Type_utilisateur` (`idTypeUtilisateur`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
