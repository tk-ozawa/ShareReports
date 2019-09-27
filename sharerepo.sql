-- phpMyAdmin SQL Dump
-- version 4.6.6
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: 2019 年 9 月 27 日 17:09
-- サーバのバージョン： 5.7.27
-- PHP Version: 7.1.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sharerepo`
--

-- --------------------------------------------------------

--
-- テーブルの構造 `reportcates`
--

CREATE TABLE `reportcates` (
  `id` int(11) NOT NULL COMMENT '作業種類ID',
  `rc_name` text NOT NULL COMMENT '種類名',
  `rc_note` text COMMENT '備考',
  `rc_list_flg` int(11) NOT NULL DEFAULT '1' COMMENT 'リスト表示の有無 : 0=非表示\n1=表示',
  `rc_order` int(11) NOT NULL DEFAULT '0' COMMENT '表示順序'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='作業種類';

--
-- テーブルのデータのダンプ `reportcates`
--

INSERT INTO `reportcates` (`id`, `rc_name`, `rc_note`, `rc_list_flg`, `rc_order`) VALUES
(1, '実装', '', 1, 1),
(2, '打合せ', '', 1, 2),
(3, '資料作成', '', 1, 3),
(4, '顧客対応', '', 1, 4),
(5, '設計', '', 1, 5),
(6, 'その他', '', 1, 6);

-- --------------------------------------------------------

--
-- テーブルの構造 `reports`
--

CREATE TABLE `reports` (
  `id` int(11) NOT NULL COMMENT 'レポートID',
  `rp_date` date NOT NULL COMMENT '作業日',
  `rp_time_from` time NOT NULL COMMENT '作業開始時間',
  `rp_time_to` time NOT NULL COMMENT '作業終了時間',
  `rp_content` text NOT NULL COMMENT '作業内容',
  `rp_created_at` datetime NOT NULL COMMENT '登録日時',
  `reportcate_id` int(11) NOT NULL COMMENT '作業種類ID',
  `user_id` int(11) NOT NULL COMMENT '報告者ID'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='レポート';

--
-- テーブルのデータのダンプ `reports`
--

INSERT INTO `reports` (`id`, `rp_date`, `rp_time_from`, `rp_time_to`, `rp_content`, `rp_created_at`, `reportcate_id`, `user_id`) VALUES
(1, '2019-09-22', '13:00:00', '19:30:00', 'レポート管理システムとりあえず完成。\r\n雛形完成して鯖に上げた。', '2019-09-22 23:28:19', 1, 1),
(2, '2019-09-20', '00:34:00', '02:40:00', 'ダミーです。\r\nダミーです。', '2019-09-22 23:35:51', 5, 1),
(3, '2019-09-27', '16:11:00', '18:11:00', 'ダミーデータです。\r\nダミーデータです。', '2019-09-27 16:11:15', 2, 1),
(4, '2019-09-28', '01:55:00', '03:55:00', 'リファクタリングした。\r\n疲れた。', '2019-09-28 01:56:07', 1, 5);

-- --------------------------------------------------------

--
-- テーブルの構造 `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL COMMENT 'ユーザID',
  `us_mail` text NOT NULL COMMENT 'メールアドレス',
  `us_name` text NOT NULL COMMENT '名前',
  `us_password` text NOT NULL COMMENT 'パスワード',
  `us_mail_verify_token` varchar(255) NOT NULL COMMENT 'メール認証用ハッシュ',
  `us_auth` int(11) NOT NULL DEFAULT '2' COMMENT '権限 : 0=終了\n1=管理者\n2=一般'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='ユーザ';

--
-- テーブルのデータのダンプ `users`
--

INSERT INTO `users` (`id`, `us_mail`, `us_name`, `us_password`, `us_mail_verify_token`, `us_auth`) VALUES
(1, 'architshin@websarva.com', '齊藤新三', '$2y$10$C1VVCmx.MqEqhLi5YrchG.4pTLbfCZUW2K7XuZ4NBIf02LIO/uqXC', '', 1),
(2, 'test@test.com', 'テストユーザー', '$2y$10$C1VVCmx.MqEqhLi5YrchG.4pTLbfCZUW2K7XuZ4NBIf02LIO/uqXC', '', 1),
(3, 'taroo1512@gmail.com', 'ozawa_shotaro', '$2y$10$NQgLc5/EI1DID3IIcX5kZuIdZ3mzIneYGnFHELi1QbHNpaEpDwF/2', '039dad36452b0659fac0f3da6ff17eb2', 2),
(4, 't.aroo1512@gmail.com', 'hal太郎', '$2y$10$21xRduCYV/MXshRSTbZHe.Gi4xjPPjsrcfR6n8KjUyBY9uZf15vTC', '3226eea196a685ee29d86702225f89e7', 0),
(5, 'ta.roo1512@gmail.com', 'Develop', '$2y$10$KM3ouH3u3KrNmxIHjjoktOo8Q5PcD8bNjsm6yEH.Jq4PG6XdGYlZO', '68ba4b68c44825d859bfcad47c7c8fbe', 2);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `reportcates`
--
ALTER TABLE `reportcates`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `reports`
--
ALTER TABLE `reports`
  ADD PRIMARY KEY (`id`),
  ADD KEY `reportcate_id` (`reportcate_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `reportcates`
--
ALTER TABLE `reportcates`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '作業種類ID', AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `reports`
--
ALTER TABLE `reports`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'レポートID', AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'ユーザID', AUTO_INCREMENT=6;
--
-- ダンプしたテーブルの制約
--

--
-- テーブルの制約 `reports`
--
ALTER TABLE `reports`
  ADD CONSTRAINT `reports_ibfk_1` FOREIGN KEY (`reportcate_id`) REFERENCES `reportcates` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `reports_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
