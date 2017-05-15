-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1
-- Время создания: Май 15 2017 г., 08:40
-- Версия сервера: 10.1.21-MariaDB
-- Версия PHP: 7.0.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `manage_servises`
--

-- --------------------------------------------------------

--
-- Структура таблицы `db1_p_bf_sms_action`
--

CREATE TABLE `db1_p_bf_sms_action` (
  `id` int(11) NOT NULL,
  `sms_id` int(11) NOT NULL COMMENT 'ID в CRM',
  `sms_stamp` datetime DEFAULT NULL COMMENT 'Дата',
  `sms_direction` varchar(10) DEFAULT NULL COMMENT 'Тип',
  `sms_from` varchar(15) DEFAULT NULL COMMENT 'Отправитель',
  `sms_to` varchar(15) DEFAULT NULL COMMENT 'Получатель',
  `sms_text` varchar(1000) DEFAULT NULL COMMENT 'Текст СМС',
  `response_id` int(11) DEFAULT NULL COMMENT 'ID ответной СМС',
  `response_stamp` datetime DEFAULT NULL COMMENT 'Дата ответа'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Буфер процесса "СМС акция"' ROW_FORMAT=COMPACT;

--
-- Дамп данных таблицы `db1_p_bf_sms_action`
--

INSERT INTO `db1_p_bf_sms_action` (`id`, `sms_id`, `sms_stamp`, `sms_direction`, `sms_from`, `sms_to`, `sms_text`, `response_id`, `response_stamp`) VALUES
(3, 481323, '2017-02-27 11:00:24', 'in', '+38095XXXXXXX', '+38067XXXXXXX', 'XX 1234567', NULL, '2017-02-27 02:18:20');


--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `db1_p_bf_sms_action`
--
ALTER TABLE `db1_p_bf_sms_action`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `sms_id` (`sms_id`),
  ADD KEY `response_stamp` (`response_stamp`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `db1_p_bf_sms_action`
--
ALTER TABLE `db1_p_bf_sms_action`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=589;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
