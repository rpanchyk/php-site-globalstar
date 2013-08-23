-- phpMyAdmin SQL Dump
-- version 3.2.4
-- http://www.phpmyadmin.net
--
-- Хост: localhost
-- Время создания: Июн 23 2011 г., 23:35
-- Версия сервера: 5.1.41
-- Версия PHP: 5.3.1

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- База данных: `globalstar`
--

-- --------------------------------------------------------

--
-- Структура таблицы `fth_category`
--

CREATE TABLE IF NOT EXISTS `fth_category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(256) NOT NULL,
  `rusname` varchar(256) NOT NULL,
  `ord` smallint(5) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=MyISAM  DEFAULT CHARSET=cp1251 AUTO_INCREMENT=8 ;

--
-- Дамп данных таблицы `fth_category`
--

INSERT INTO `fth_category` (`id`, `name`, `rusname`, `ord`) VALUES
(1, 'about', 'О компании', 10),
(2, 'dj', 'Диджеи', 20),
(3, 'pj', 'Пиджеи', 30),
(4, 'tpj', 'Топлесс пиджеи', 40),
(5, 'mc', 'МС', 50),
(6, 'contacts', 'Контакты', 60),
(7, 'partners', 'Партнеры', 70);

-- --------------------------------------------------------

--
-- Структура таблицы `fth_post`
--

CREATE TABLE IF NOT EXISTS `fth_post` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `parent_id` int(11) NOT NULL,
  `cat_id` smallint(5) NOT NULL,
  `head` varchar(256) NOT NULL,
  `post` text NOT NULL,
  `xfield1` varchar(256) DEFAULT NULL,
  `xfield2` smallint(5) DEFAULT NULL,
  `xfield3` smallint(5) DEFAULT NULL,
  `xfield4` smallint(5) DEFAULT NULL,
  `xfield5` text,
  `xfield6` text,
  `date_pub` timestamp NULL DEFAULT NULL,
  `date_add` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `date_edit` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `ord` int(11) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=cp1251 AUTO_INCREMENT=12 ;

--
-- Дамп данных таблицы `fth_post`
--

INSERT INTO `fth_post` (`id`, `parent_id`, `cat_id`, `head`, `post`, `xfield1`, `xfield2`, `xfield3`, `xfield4`, `xfield5`, `xfield6`, `date_pub`, `date_add`, `date_edit`, `ord`) VALUES
(1, 0, 1, 'About', '<div><span style="font-family: courier new,courier;"><strong>Амбидекстри&#769;я</strong> </span>(от <a title="Латинский язык" href="http://ru.wikipedia.org/wiki/%D0%9B%D0%B0%D1%82%D0%B8%D0%BD%D1%81%D0%BA%D0%B8%D0%B9_%D1%8F%D0%B7%D1%8B%D0%BA">лат.</a>&nbsp;<em><span lang="la">ambi</span></em> &mdash; &laquo;оба&raquo; и <a title="Латинский язык" href="http://ru.wikipedia.org/wiki/%D0%9B%D0%B0%D1%82%D0%B8%D0%BD%D1%81%D0%BA%D0%B8%D0%B9_%D1%8F%D0%B7%D1%8B%D0%BA">лат.</a>&nbsp;<em><span lang="la">dexter</span></em> &mdash; &laquo;правый&raquo;, &laquo;ловкий&raquo;) &mdash; отсутствие явно выраженной мануальной  асимметрии. Проявляется тем, что человек или животное в равной степени  владеет правой и левой руками (лапами), без выделения ведущей.  Амбидекстрия может быть обусловлена генетически или выработана<sup id="cite_ref-0" class="reference"><a href="http://ru.wikipedia.org/wiki/%D0%90%D0%BC%D0%B1%D0%B8%D0%B4%D0%B5%D0%BA%D1%81%D1%82%D1%80%D0%B8%D1%8F#cite_note-0">[1]</a></sup> в результате тренировки. Обратное явление, когда человеку сложно использовать обе руки, называют <a class="new" title="Амбисинистрия (страница отсутствует)" href="http://ru.wikipedia.org/w/index.php?title=%D0%90%D0%BC%D0%B1%D0%B8%D1%81%D0%B8%D0%BD%D0%B8%D1%81%D1%82%D1%80%D0%B8%D1%8F&amp;action=edit&amp;redlink=1">амбисинистрией</a>.&#65279;</div>', NULL, NULL, NULL, NULL, '', '', NULL, '2011-06-18 07:21:45', '2011-06-21 07:25:15', NULL),
(2, 0, 6, 'Contacts', '<div>Почти декаданс. Несколько смежных больших комнат, дорогие драппировки,  меха и позолота. Окна во всю стену, два небольших балкона - в спальне и  гостиной. В каждой комнате - паркет из лучших сортов дерева, сложные  узоры, по стенам - гобелены и старые картины, за каждую из таких можно  купить ни один дом в столице. Мебели немного в сравнении с пустым  пространством. В гостиной большой камин, удобный диван напротив,  устланный шкурами черного песца.  Длинный стол, ряд тяжелых стульев с  высокими резными спинками, золотые подсвечники. Дорогие темно-бордовые  портьеры до самого пола, небрежно собранные кольцами, инкрустированными  рубинами. В спальне - широкая постель с балдахином. Отдельная комната  для гардероба, где можно найти все - от военной формы до костюма на  карнавал. Каждая деталь в комнатах при ближайшем рассмотрении стоит  немалых денег. Отличная акустика во всех комнатах. &#65279;</div>', NULL, NULL, NULL, NULL, '', '', NULL, '2011-06-18 07:23:55', '2011-06-18 07:23:55', NULL),
(3, 0, 2, 'Dj Vasya', '<div>Текст записи Dj Vasya<br />Dj Vasya<br />Dj Vasya<br />Dj VasyaDj Vasya Dj VasyaDj VasyaDj VasyaDj VasyaDj VasyaDj VasyaDj VasyaDj VasyaDj Vasya<br /><br />Dj VasyaDj VasyaDj VasyaDj VasyaDj Vasya<br />Dj VasyaDj VasyaDj VasyaDj VasyaDj VasyaDj VasyaDj VasyaDj Vasya<br />Dj VasyaDj VasyaDj VasyaDj VasyaDj VasyaDj VasyaDj VasyaDj VasyaDj Vasya</div>', NULL, NULL, NULL, NULL, '<div>Dj Vasya Dj Vasya Dj Vasya<br /><br />Dj Vasya!!!!!!!!</div>', '<div><img src="../../upload/2_1.jpg" alt="" width="163" height="193" /></div>', NULL, '2011-06-20 08:16:45', '2011-06-23 22:20:20', 1),
(4, 0, 2, 'Feday', '<div>Текст записи FedayFedayFedayFeda yFedayFedayFedayFedayFeday FedayFedayFedayFedayFedayFeday FedayFedayFedayFedayFedayFeday FedayFedayFedayFedayFeday<br />FedayFeday FedayFedayFedayFeday<br /><br /><img src="../../upload/test.jpg" alt="" width="125" height="344" /></div>', NULL, NULL, NULL, NULL, '<div>Feday Feday Feday</div>', '<div><img src="../../upload/Wall-E-1.png" alt="" width="158" height="156" /></div>', NULL, '2011-06-20 22:35:31', '2011-06-23 23:07:16', 4),
(5, 0, 2, 'Моська', '<div><em><span style="font-family: verdana,geneva;"><strong><span style="font-size: xx-large;">Моська</span></strong></span></em><br />Моська Моська Моська Моська Моська Моська<br /><img src="../../upload/murakami_summer-hp.png" alt="" width="409" height="168" /></div>', NULL, NULL, NULL, NULL, '<div>МоськаМоськаМоська</div>', '<div><img src="../../upload/bear.png" alt="" width="155" height="174" /></div>', NULL, '2011-06-20 22:36:48', '2011-06-23 22:25:52', 3),
(6, 0, 2, 'Smakarevich', '<div>Smakarevich<br />Smakarevich<br />Smakarevich SmakarevichSmakarevichSmakarevichSmakarevichSmakarevichSmakarevich Smakarevich</div>', NULL, NULL, NULL, NULL, '<div>Smakarevich Smakarevich</div>', '<div><img src="../../upload/2.jpg" alt="" width="161" height="161" /></div>', NULL, '2011-06-20 22:43:47', '2011-06-23 22:27:27', 77),
(7, 0, 7, 'Партнеры', '<table border="0" cellspacing="0" cellpadding="0" height="100%">\r\n<tbody>\r\n<tr>\r\n<td width="120" align="center" valign="middle"><img src="../../templates/GlobalStar/images/virus_logo.png" alt="" width="100" height="100" /></td>\r\n<td width="120" align="center" valign="middle"><img src="../../templates/GlobalStar/images/kiss_logo.png" alt="" width="100" height="100" /></td>\r\n<td width="120" align="center" valign="middle"><a href="http://google.com"><img src="../../templates/GlobalStar/images/firetrot_logo.png" alt="" width="100" height="100" /></a></td>\r\n<td width="120" align="center" valign="middle"><img src="../../templates/GlobalStar/images/hum_logo.png" alt="" width="100" height="100" /></td>\r\n</tr>\r\n</tbody>\r\n</table>', NULL, NULL, NULL, NULL, '', '', NULL, '2011-06-21 08:16:02', '2011-06-23 23:25:55', NULL);

-- --------------------------------------------------------

--
-- Структура таблицы `fth_user`
--

CREATE TABLE IF NOT EXISTS `fth_user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `login` tinytext NOT NULL,
  `password` tinytext NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=cp1251 AUTO_INCREMENT=2 ;

--
-- Дамп данных таблицы `fth_user`
--

INSERT INTO `fth_user` (`id`, `login`, `password`) VALUES
(1, 'admin', '21232f297a57a5a743894a0e4a801fc3');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
