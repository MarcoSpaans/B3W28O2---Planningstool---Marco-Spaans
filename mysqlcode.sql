-- create table planning
CREATE TABLE IF NOT EXISTS `planning` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `Name_Game` varchar(255) NOT NULL,
  `Start_Time` varchar(255) NOT NULL,
  `Time_Span` varchar(255) NOT NULL,
  `Explain_person` varchar(255) NOT NULL
);

ALTER TABLE `planning`
  ADD PRIMARY KEY (`ID`);

  ALTER TABLE `games`
    MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

-- create table players
CREATE TABLE `players` (
  `ID` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `Player_Name` varchar(255) NOT NULL,
  `Name_Game` varchar(255) NOT NULL,
  `Start_Time` varchar(255) NOT NULL
);
