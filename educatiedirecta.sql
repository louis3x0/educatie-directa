-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 27, 2024 at 11:05 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `educatiedirecta`
--

-- --------------------------------------------------------

--
-- Table structure for table `applications`
--

CREATE TABLE `applications` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `teacher_id` int(11) NOT NULL,
  `status` varchar(255) NOT NULL,
  `details` text DEFAULT NULL,
  `applied_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `applications`
--

INSERT INTO `applications` (`id`, `user_id`, `teacher_id`, `status`, `details`, `applied_at`) VALUES
(33, 1, 5, 'approved', NULL, '2024-04-26 12:48:35'),
(34, 6, 5, 'pending', NULL, '2024-04-26 16:12:36');

-- --------------------------------------------------------

--
-- Table structure for table `elevi`
--

CREATE TABLE `elevi` (
  `ID` int(11) NOT NULL,
  `Nume` varchar(255) NOT NULL,
  `NumarTelefon` varchar(20) DEFAULT NULL,
  `ID_Utilizator` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `elevi`
--

INSERT INTO `elevi` (`ID`, `Nume`, `NumarTelefon`, `ID_Utilizator`) VALUES
(1, 'Ion Popescu', '0723456789', NULL),
(2, 'Maria Ionescu', '0723456790', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `judete_romania`
--

CREATE TABLE `judete_romania` (
  `id` int(11) NOT NULL,
  `nume_judet` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `judete_romania`
--

INSERT INTO `judete_romania` (`id`, `nume_judet`) VALUES
(1, 'Alba'),
(2, 'Arad'),
(3, 'Argeș'),
(4, 'Bacău'),
(5, 'Bihor'),
(6, 'Bistrița-Năsăud'),
(7, 'Botoșani'),
(8, 'Brașov'),
(9, 'Brăila'),
(10, 'București'),
(11, 'Buzău'),
(12, 'Caraș-Severin'),
(13, 'Călărași'),
(14, 'Cluj'),
(15, 'Constanța'),
(16, 'Covasna'),
(17, 'Dâmbovița'),
(18, 'Dolj'),
(19, 'Galați'),
(20, 'Giurgiu'),
(21, 'Gorj'),
(22, 'Harghita'),
(23, 'Hunedoara'),
(24, 'Ialomița'),
(25, 'Iași'),
(26, 'Ilfov'),
(27, 'Maramureș'),
(28, 'Mehedinți'),
(29, 'Mureș'),
(30, 'Neamț'),
(31, 'Olt'),
(32, 'Prahova'),
(33, 'Satu Mare'),
(34, 'Sălaj'),
(35, 'Sibiu'),
(36, 'Suceava'),
(37, 'Teleorman'),
(38, 'Timiș'),
(39, 'Tulcea'),
(40, 'Vaslui'),
(41, 'Vâlcea'),
(42, 'Vrancea');

-- --------------------------------------------------------

--
-- Table structure for table `materii_meditatii`
--

CREATE TABLE `materii_meditatii` (
  `id` int(11) NOT NULL,
  `nume_materie` varchar(255) NOT NULL,
  `categorie` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `materii_meditatii`
--

INSERT INTO `materii_meditatii` (`id`, `nume_materie`, `categorie`) VALUES
(1, 'Anatomie', 'Științe reale'),
(2, 'Biologie', 'Științe reale'),
(3, 'Chimie', 'Științe reale'),
(4, 'Contabilitate', 'Științe reale'),
(5, 'Economie', 'Științe reale'),
(6, 'Fizică', 'Științe reale'),
(7, 'Informatică', 'Științe reale'),
(8, 'Logică', 'Științe reale'),
(9, 'Matematică', 'Științe reale'),
(10, 'Medicină', 'Științe reale'),
(11, 'Programare', 'Științe reale'),
(12, 'Cultură civică', 'Științe umane'),
(13, 'Drept', 'Științe umane'),
(14, 'Filosofie', 'Științe umane'),
(15, 'Geografie', 'Științe umane'),
(16, 'Istorie', 'Științe umane'),
(17, 'Psihologie', 'Științe umane'),
(18, 'Sociologie', 'Științe umane'),
(19, 'Limba latină', 'Limbă și literatură'),
(20, 'Limba și literatură magheară', 'Limbă și literatură'),
(21, 'Limba și literatură română', 'Limbă și literatură'),
(22, 'Literatură universală', 'Limbă și literatură'),
(23, 'Anatomie', 'Științe reale'),
(24, 'Biologie', 'Științe reale'),
(25, 'Chimie', 'Științe reale'),
(26, 'Contabilitate', 'Științe reale'),
(27, 'Economie', 'Științe reale'),
(28, 'Fizică', 'Științe reale'),
(29, 'Informatică', 'Științe reale'),
(30, 'Logică', 'Științe reale'),
(31, 'Matematică', 'Științe reale'),
(32, 'Medicină', 'Științe reale'),
(33, 'Programare', 'Științe reale'),
(34, 'Cultură civică', 'Științe umane'),
(35, 'Drept', 'Științe umane'),
(36, 'Filosofie', 'Științe umane'),
(37, 'Geografie', 'Științe umane'),
(38, 'Istorie', 'Științe umane'),
(39, 'Psihologie', 'Științe umane'),
(40, 'Sociologie', 'Științe umane'),
(41, 'Limba latină', 'Limbă și literatură'),
(42, 'Limba și literatură magheară', 'Limbă și literatură'),
(43, 'Limba și literatură română', 'Limbă și literatură'),
(44, 'Literatură universală', 'Limbă și literatură'),
(45, 'Limba arabă', 'Limbi străine'),
(46, 'Limba chineză', 'Limbi străine'),
(47, 'Arhitectură', 'Artă'),
(48, 'Desen', 'Artă'),
(49, 'Canto', 'Muzică'),
(50, 'Chitară', 'Muzică'),
(51, 'Alte materii', 'Alte materii');

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `message` varchar(255) NOT NULL,
  `read_status` tinyint(1) DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `notifications`
--

INSERT INTO `notifications` (`id`, `user_id`, `message`, `read_status`, `created_at`) VALUES
(17, 5, 'O nouă cerere de mediere a fost trimisă de un student. Te rugăm să revizuiești cererea și să răspunzi în consecință.', 0, '2024-04-26 12:48:35'),
(18, 5, 'O nouă cerere de mediere a fost trimisă de un student. Te rugăm să revizuiești cererea și să răspunzi în consecință.', 0, '2024-04-26 16:12:36');

-- --------------------------------------------------------

--
-- Table structure for table `orarelevi`
--

CREATE TABLE `orarelevi` (
  `ID` int(11) NOT NULL,
  `ID_Elev` int(11) DEFAULT NULL,
  `ID_Profesor` int(11) DEFAULT NULL,
  `DataOra` date NOT NULL,
  `Durata` int(11) NOT NULL,
  `Confirmat` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `orarprofesori`
--

CREATE TABLE `orarprofesori` (
  `ID` int(11) NOT NULL,
  `ID_Profesor` int(11) DEFAULT NULL,
  `ZiuaSaptamanii` enum('Luni','Marti','Miercuri','Joi','Vineri','Sambata','Duminica') NOT NULL,
  `OraInceput` time NOT NULL,
  `OraSfarsit` time NOT NULL,
  `Disponibil` tinyint(1) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `profesori`
--

CREATE TABLE `profesori` (
  `ID` int(11) NOT NULL,
  `Nume` varchar(255) NOT NULL,
  `Experienta` varchar(255) DEFAULT NULL,
  `Ocupatie` varchar(255) DEFAULT NULL,
  `Studii` varchar(255) DEFAULT NULL,
  `Calificari` text DEFAULT NULL,
  `Materia` varchar(255) NOT NULL,
  `PretSedinta` decimal(10,2) DEFAULT NULL,
  `NumarTelefon` varchar(20) DEFAULT NULL,
  `Descriere` text DEFAULT NULL,
  `Locatie` varchar(255) DEFAULT NULL,
  `DataInscriere` date DEFAULT NULL,
  `NumarRecenzii` int(11) DEFAULT 0,
  `NumarRecomandari` int(11) DEFAULT 0,
  `ImagineProfil` varchar(255) DEFAULT NULL,
  `ID_Utilizator` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `profesori`
--

INSERT INTO `profesori` (`ID`, `Nume`, `Experienta`, `Ocupatie`, `Studii`, `Calificari`, `Materia`, `PretSedinta`, `NumarTelefon`, `Descriere`, `Locatie`, `DataInscriere`, `NumarRecenzii`, `NumarRecomandari`, `ImagineProfil`, `ID_Utilizator`) VALUES
(1, 'Louis', '5 ani în managementul proiectelor IT', 'Manager Proiect', 'Masterat în Informatică Aplicată', 'Certificat PMP, Agile Scrum Master', 'Informatica', 100.00, '2352', 'Cu o abordare strategică și axată pe rezultate, am condus echipe', 'Dolj', '2024-04-26', 0, 0, 'https://t4.ftcdn.net/jpg/04/70/29/97/360_F_470299797_UD0eoVMMSUbHCcNJCdv2t8B2g1GVqYgs.jpg', 5);

-- --------------------------------------------------------

--
-- Table structure for table `recenzii`
--

CREATE TABLE `recenzii` (
  `ID` int(11) NOT NULL,
  `ID_Profesor` int(11) DEFAULT NULL,
  `ID_Elev` int(11) DEFAULT NULL,
  `TextRecenzie` text DEFAULT NULL,
  `Rating` int(11) DEFAULT NULL,
  `DataRecenzie` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `recenzii`
--

INSERT INTO `recenzii` (`ID`, `ID_Profesor`, `ID_Elev`, `TextRecenzie`, `Rating`, `DataRecenzie`) VALUES
(1, 1, 1, 'Un profesor foarte bun, recomand!', 5, '2023-12-01'),
(2, 1, 1, 'Explicațiile sunt clare și concise.', 4, '2023-12-05');

-- --------------------------------------------------------

--
-- Table structure for table `recomandari`
--

CREATE TABLE `recomandari` (
  `ID` int(11) NOT NULL,
  `ID_Profesor` int(11) DEFAULT NULL,
  `ID_Elev` int(11) DEFAULT NULL,
  `TextRecomandare` text DEFAULT NULL,
  `DataRecomandare` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `recomandari`
--

INSERT INTO `recomandari` (`ID`, `ID_Profesor`, `ID_Elev`, `TextRecomandare`, `DataRecomandare`) VALUES
(1, 1, 1, 'Lecțiile lui Stefan au fost de mare ajutor pentru examenele mele.', '2023-12-10'),
(2, 1, 2, 'Cu ajutorul lui am reușit să înțeleg bazele programării.', '2023-12-12');

-- --------------------------------------------------------

--
-- Table structure for table `sesiuni`
--

CREATE TABLE `sesiuni` (
  `id` int(11) NOT NULL,
  `id_profesor` int(11) DEFAULT NULL,
  `id_student` int(11) DEFAULT NULL,
  `data` date DEFAULT NULL,
  `link` varchar(255) DEFAULT NULL,
  `ora_de_inceput` time DEFAULT NULL,
  `ora_de_sfarsit` time DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `sesiuni`
--

INSERT INTO `sesiuni` (`id`, `id_profesor`, `id_student`, `data`, `link`, `ora_de_inceput`, `ora_de_sfarsit`) VALUES
(42, 5, 1, '2024-04-26', 'https://meet.google.com/', '12:00:00', '14:00:00'),
(43, 5, 1, '2024-04-26', '', '01:00:00', '00:00:00'),
(44, 5, 1, '2024-04-27', 'https://meet.google.com/', '15:00:00', '16:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `full_name` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `sex` enum('male','female','other') NOT NULL,
  `role` enum('admin','tutor','student') NOT NULL,
  `terms_and_conditions_accepted` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `full_name`, `password`, `email`, `phone`, `sex`, `role`, `terms_and_conditions_accepted`) VALUES
(1, 'Louis Aurel', '$2y$10$tzlEYQe0i3jHdOXEFv3ZT.8vVo/oYyJs08/.VZVz9NWyjm8JjJv0S', 'louisrd1337@gmail.com', '0757987021', 'male', 'student', 1),
(5, 'Louis Mediator', '$2y$10$TsR0IhNpdKnDDbXDGxmVJuHTgoWQz.H8St3yXNoip8M7txAknhCte', 'louismediator@gmail.com', '07547457453', 'male', 'tutor', 1),
(6, 'Elev', '$2y$10$WYnqLA7XJtZUQWxyDPbbj.meezQR.PFqcT32AHbxCH1y2Drq6JjTy', 'elev@gmail.com', '0744537435', 'male', 'student', 1),
(7, 'Cont Elev', '$2y$10$6WVERd2NMtTQX8Bq9C5u4euweL/XJveouH3gRSfgblFmP1qfrVvl6', 'conteelev@gmail.com', '0757947034', 'female', 'student', 1),
(8, 'eleevtest', '$2y$10$/jz8GodZ6hPY5k9HIMgpo.6rxtHdrZeg/P0nUVgSh8mbU.KUhDvXy', 'elevtest@gmail.com', '0734743743', 'male', 'student', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `applications`
--
ALTER TABLE `applications`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_user_id` (`user_id`),
  ADD KEY `applications_ibfk_2` (`teacher_id`);

--
-- Indexes for table `elevi`
--
ALTER TABLE `elevi`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `judete_romania`
--
ALTER TABLE `judete_romania`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `materii_meditatii`
--
ALTER TABLE `materii_meditatii`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orarelevi`
--
ALTER TABLE `orarelevi`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `ID_Elev` (`ID_Elev`),
  ADD KEY `ID_Profesor` (`ID_Profesor`);

--
-- Indexes for table `orarprofesori`
--
ALTER TABLE `orarprofesori`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `ID_Profesor` (`ID_Profesor`);

--
-- Indexes for table `profesori`
--
ALTER TABLE `profesori`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `recenzii`
--
ALTER TABLE `recenzii`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `ID_Profesor` (`ID_Profesor`),
  ADD KEY `ID_Elev` (`ID_Elev`);

--
-- Indexes for table `recomandari`
--
ALTER TABLE `recomandari`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `ID_Profesor` (`ID_Profesor`),
  ADD KEY `ID_Elev` (`ID_Elev`);

--
-- Indexes for table `sesiuni`
--
ALTER TABLE `sesiuni`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `applications`
--
ALTER TABLE `applications`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `elevi`
--
ALTER TABLE `elevi`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `judete_romania`
--
ALTER TABLE `judete_romania`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT for table `materii_meditatii`
--
ALTER TABLE `materii_meditatii`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- AUTO_INCREMENT for table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `orarelevi`
--
ALTER TABLE `orarelevi`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `orarprofesori`
--
ALTER TABLE `orarprofesori`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `profesori`
--
ALTER TABLE `profesori`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `recenzii`
--
ALTER TABLE `recenzii`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `recomandari`
--
ALTER TABLE `recomandari`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `sesiuni`
--
ALTER TABLE `sesiuni`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `applications`
--
ALTER TABLE `applications`
  ADD CONSTRAINT `applications_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `applications_ibfk_2` FOREIGN KEY (`teacher_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `fk_teacher_id` FOREIGN KEY (`teacher_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `fk_user_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `orarelevi`
--
ALTER TABLE `orarelevi`
  ADD CONSTRAINT `orarelevi_ibfk_1` FOREIGN KEY (`ID_Elev`) REFERENCES `elevi` (`ID`),
  ADD CONSTRAINT `orarelevi_ibfk_2` FOREIGN KEY (`ID_Profesor`) REFERENCES `profesori` (`ID`);

--
-- Constraints for table `orarprofesori`
--
ALTER TABLE `orarprofesori`
  ADD CONSTRAINT `orarprofesori_ibfk_1` FOREIGN KEY (`ID_Profesor`) REFERENCES `profesori` (`ID`);

--
-- Constraints for table `recenzii`
--
ALTER TABLE `recenzii`
  ADD CONSTRAINT `recenzii_ibfk_1` FOREIGN KEY (`ID_Profesor`) REFERENCES `profesori` (`ID`),
  ADD CONSTRAINT `recenzii_ibfk_2` FOREIGN KEY (`ID_Elev`) REFERENCES `elevi` (`ID`);

--
-- Constraints for table `recomandari`
--
ALTER TABLE `recomandari`
  ADD CONSTRAINT `recomandari_ibfk_1` FOREIGN KEY (`ID_Profesor`) REFERENCES `profesori` (`ID`),
  ADD CONSTRAINT `recomandari_ibfk_2` FOREIGN KEY (`ID_Elev`) REFERENCES `elevi` (`ID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
