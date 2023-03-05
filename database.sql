CREATE DATABASE `new`;

use new;

CREATE TABLE `aimtrainer_data` (
  `id` int(200) NOT NULL,
  `username` text(200) NOT NULL,
  `highscore` int(200) NOT NULL,
  `games` int(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 DEFAULT COLLATE utf8_czech_ci;

CREATE TABLE `game2_data` (
  `id` int(200) NOT NULL,
  `username` text(200) NOT NULL,
  `highscore` int(200) NOT NULL,
  `games` int(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 DEFAULT COLLATE utf8_czech_ci;

CREATE TABLE `userdata` (
  `id` int(200) NOT NULL,
  `username` text(200) NOT NULL,
  `pass` text(200) NOT NULL,
  `creation` DATE 
) ENGINE=InnoDB DEFAULT CHARSET=utf8 DEFAULT COLLATE utf8_czech_ci;

ALTER TABLE `aimtrainer_data`
  ADD PRIMARY KEY (`Id`);

ALTER TABLE `game2_data`
  ADD PRIMARY KEY (`Id`);

ALTER TABLE `userdata`
  ADD PRIMARY KEY (`Id`);

ALTER TABLE `aimtrainer_data`
  MODIFY `Id` int(20) NOT NULL AUTO_INCREMENT;

ALTER TABLE `game2_data`
  MODIFY `Id` int(50) NOT NULL AUTO_INCREMENT;

ALTER TABLE `userdata`
  MODIFY `Id` int(50) NOT NULL AUTO_INCREMENT;
COMMIT;
