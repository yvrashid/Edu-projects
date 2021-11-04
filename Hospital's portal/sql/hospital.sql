-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Хост: localhost
-- Время создания: Июл 02 2019 г., 02:19
-- Версия сервера: 8.0.16
-- Версия PHP: 7.3.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `hospital`
--

-- --------------------------------------------------------

--
-- Структура таблицы `doctors`
--

CREATE TABLE `doctors` (
  `id` int(11) NOT NULL,
  `log` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `surname` varchar(20) CHARACTER SET cp1251 COLLATE cp1251_general_ci NOT NULL,
  `name` varchar(20) CHARACTER SET cp1251 COLLATE cp1251_general_ci NOT NULL,
  `middlename` varchar(20) CHARACTER SET cp1251 COLLATE cp1251_general_ci DEFAULT NULL,
  `experience` int(3) NOT NULL,
  `specialty` varchar(20) CHARACTER SET cp1251 COLLATE cp1251_general_ci NOT NULL,
  `isadmin` tinyint(1) NOT NULL DEFAULT '0',
  `isdoctor` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=cp1251;

--
-- Дамп данных таблицы `doctors`
--

INSERT INTO `doctors` (`id`, `log`, `password`, `surname`, `name`, `middlename`, `experience`, `specialty`, `isadmin`, `isdoctor`) VALUES
(1, 'leo_bokeriya', 'f1d7427eabba36b629c6e190487ffef1', 'Бокерия', 'Лео', 'Антонович', 51, 'кардиохирург', 1, 1),
(14, 'yangurazova', 'd5d43fafa8c1217206cd8bbeb3396503', 'Янгуразова ', 'Марьям', 'Алиевна', 2, 'кардиолог', 0, 1),
(15, 'petr_r', '8b3e449a530ad895e881ac7b0ee83203', 'Романовский', 'Петр', '', 12, 'терапевт', 0, 1);

-- --------------------------------------------------------

--
-- Структура таблицы `patients`
--

CREATE TABLE `patients` (
  `id_card` int(7) NOT NULL,
  `doctor_id` int(11) DEFAULT NULL,
  `surname` varchar(20) CHARACTER SET cp1251 COLLATE cp1251_general_ci NOT NULL,
  `name` varchar(20) CHARACTER SET cp1251 COLLATE cp1251_general_ci NOT NULL,
  `middlename` varchar(20) CHARACTER SET cp1251 COLLATE cp1251_general_ci DEFAULT NULL,
  `age` int(3) DEFAULT NULL,
  `diagnosis` varchar(50) CHARACTER SET cp1251 COLLATE cp1251_general_ci NOT NULL,
  `dt` date NOT NULL,
  `appointments` varchar(50) CHARACTER SET cp1251 COLLATE cp1251_general_ci DEFAULT NULL,
  `room` int(5) DEFAULT NULL,
  `depcode` varchar(3) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `address` varchar(20) CHARACTER SET cp1251 COLLATE cp1251_general_ci NOT NULL,
  `job` varchar(20) CHARACTER SET cp1251 COLLATE cp1251_general_ci DEFAULT NULL,
  `log` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=cp1251;

--
-- Дамп данных таблицы `patients`
--

INSERT INTO `patients` (`id_card`, `doctor_id`, `surname`, `name`, `middlename`, `age`, `diagnosis`, `dt`, `appointments`, `room`, `depcode`, `address`, `job`, `log`, `password`) VALUES
(123, 14, 'Гельфанд', 'Михаил', 'Игоревич', 50, 'Аритмия', '2017-02-11', 'нужен покой', 89, 'CFX', 'MSK', 'engineer', 'mike', '18126e7bd3f84b3f3e4df094def5b7de'),
(1234, 17, 'A', 'B', 'C', 19, 'LLL', '2011-11-11', '', NULL, 'SZX', 'LLL', '', 'one', 'f97c5d29941bfb1b2fdab0874906ab82');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `doctors`
--
ALTER TABLE `doctors`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `log` (`log`);

--
-- Индексы таблицы `patients`
--
ALTER TABLE `patients`
  ADD PRIMARY KEY (`id_card`),
  ADD UNIQUE KEY `id_card` (`id_card`),
  ADD UNIQUE KEY `log` (`log`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `doctors`
--
ALTER TABLE `doctors`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
