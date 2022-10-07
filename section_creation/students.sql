-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 08, 2021 at 07:38 AM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 7.4.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `test`
--

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

DROP TABLE IF EXISTS `students`;
CREATE TABLE `students` (
  `adm_no` varchar(30) NOT NULL,
  `usn` varchar(15) DEFAULT NULL,
  `batch` varchar(30) DEFAULT NULL,
  `semester` varchar(10) DEFAULT NULL,
  `section` varchar(10) DEFAULT NULL,
  `fname` varchar(50) DEFAULT NULL,
  `mname` varchar(50) DEFAULT NULL,
  `lname` varchar(50) DEFAULT NULL,
  `branch` varchar(50) DEFAULT NULL,
  `kcet` varchar(30) DEFAULT NULL,
  `comedk` varchar(30) DEFAULT NULL,
  `jee` varchar(30) DEFAULT NULL,
  `nationality` varchar(50) DEFAULT NULL,
  `data_of_admission` varchar(30) DEFAULT NULL,
  `dob` varchar(30) DEFAULT NULL,
  `place_of_birth` varchar(50) DEFAULT NULL,
  `gender` varchar(10) DEFAULT NULL,
  `mob_no` varchar(15) DEFAULT NULL,
  `email_id` varchar(40) DEFAULT NULL,
  `aadhar` varchar(15) DEFAULT NULL,
  `pan_card` varchar(15) DEFAULT NULL,
  `sc_st` varchar(10) DEFAULT NULL,
  `caste` varchar(50) DEFAULT NULL,
  `annual_income` varchar(10) DEFAULT NULL,
  `present_state` varchar(50) DEFAULT NULL,
  `present_dist` varchar(50) DEFAULT NULL,
  `present_house_no_name` varchar(100) DEFAULT NULL,
  `present_post_village` varchar(50) DEFAULT NULL,
  `present_pincode` varchar(30) DEFAULT NULL,
  `permanent_state` varchar(50) DEFAULT NULL,
  `permanent_dist` varchar(50) DEFAULT NULL,
  `permanent_house_no_name` varchar(100) DEFAULT NULL,
  `permanent_post_village` varchar(50) DEFAULT NULL,
  `permanent_pin_code` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`adm_no`, `usn`, `batch`, `semester`, `section`, `fname`, `mname`, `lname`, `branch`, `kcet`, `comedk`, `jee`, `nationality`, `data_of_admission`, `dob`, `place_of_birth`, `gender`, `mob_no`, `email_id`, `aadhar`, `pan_card`, `sc_st`, `caste`, `annual_income`, `present_state`, `present_dist`, `present_house_no_name`, `present_post_village`, `present_pincode`, `permanent_state`, `permanent_dist`, `permanent_house_no_name`, `permanent_post_village`, `permanent_pin_code`) VALUES
('153', 'Expedita repreh', '2017', '2', 'A', 'Susan Le', 'Hayfa Avery', 'Emerson', 'Mechanical', 'Enim porro officiis ', 'Tenetur soluta id qu', 'Et qui quia officiis', 'Fuga Aliquip dolore', '2000-02-03', '2021-12-19', 'Velit et qui ipsum ', 'on', '720', 'dihuc@mailinator.com', '401', '476', 'Ut ea eos ', 'Qui aliquip labore b', '717', 'Fugiat cum velit co', 'Natus ratione nostru', 'Stella Kidd', 'Elit officia earum ', 'Dolores nisi dolor r', 'Repellendus Volupta', 'Vitae dolorem libero', 'Jayme Molina', 'Nisi sit et eos la', 'Reiciendis'),
('156', 'Quam quibusdam ', '2017', '2', 'B', 'Leila Farley', 'Travis Knox', 'Sawyer', 'Mechanical', 'Enim voluptates culp', 'Vel voluptatem id e', 'Quia perferendis ea ', 'Repudiandae velit no', '2021-04-30', '1972-06-01', 'Qui non laborum Fac', 'on', '354', 'hiwuh@mailinator.com', '360', '201', 'Temporibus', 'Ut quam labore exerc', '743', 'Sit ad ut nemo sequi', 'In cum vitae dolorum', 'Jerome Shields', 'Aut velit cupiditate', 'Esse aut enim et es', 'Enim deserunt cupida', 'Et recusandae Nisi ', 'Clayton George', 'Consectetur elit la', 'Qui volupt'),
('191', 'Ex id pariatur ', '2017', '2', 'A', 'Bo Powell', 'Mason Mack', 'Rivas', 'Mechanical', 'Ipsum aspernatur mol', 'Nobis dolor rerum co', 'Repellendus Proiden', 'Aliquam ut voluptate', '1994-06-28', '1995-02-16', 'Non iure rerum aut p', 'on', '588', 'xywa@mailinator.com', '700', '196', 'Quia ad du', 'Perferendis facilis ', '469', 'Architecto totam eum', 'Id consectetur et ', 'Dean Shepard', 'Sit aperiam sed vol', 'Voluptas ut similiqu', 'Esse id cupidatat s', 'Porro non duis est i', 'Francis Aguirre', 'Eos quasi dolor offi', 'In omnis s'),
('222', 'Sint voluptate ', '2017', '2', 'A', 'Elaine Lindsay', 'Noble Quinn', 'Randolph', 'Mechanical', 'Magnam lorem vitae q', 'Laborum cum doloribu', 'Consequatur Sint ip', 'Magni commodo iste s', '1974-11-25', '1973-03-28', 'Quidem earum et cupi', 'on', '177', 'syloxerupy@mailinator.com', '884', '466', 'Voluptatem', 'Minus ut laborum Au', '752', 'Sit voluptatem ab r', 'Aute voluptatem Vel', 'Martina Ochoa', 'Qui occaecat ullam v', 'Placeat excepteur d', 'Aliqua Eum eligendi', 'Nostrum perferendis ', 'Lane Nixon', 'Doloribus qui reicie', 'Lorem dolo'),
('250', 'Voluptatem susc', '2017', '2', 'B', 'Macy Harding', 'Sebastian Kramer', 'Frye', 'Mechanical', 'Nostrum ratione lore', 'Sapiente voluptas la', 'Eius velit assumenda', 'Esse velit anim ea ', '1981-09-20', '1980-05-18', 'Quia nihil est repre', 'on', '561', 'juquwilyhu@mailinator.com', '984', '240', 'Rerum quid', 'Aliquam laborum nemo', '245', 'Esse aut omnis labor', 'Ea ratione sit dese', 'Bruce Harper', 'Commodi eum possimus', 'In optio odit et si', 'Mollitia facere dolo', 'Maiores ut quo sint', 'Renee Gomez', 'Quaerat cum modi eni', 'Commodi ea'),
('267', 'Velit et ipsa a', '2017', '2', 'B', 'Jamal Swanson', 'Tashya Mccarty', 'Petty', 'Mechanical', 'Consequatur Unde au', 'Dolorem sit eveniet', 'Qui illo voluptatem ', 'Ipsum voluptatem et', '1989-08-14', '1972-12-19', 'Nisi ratione adipisi', 'on', '899', 'lumaruhap@mailinator.com', '663', '354', 'Laborum Re', 'Voluptatem voluptat', '631', 'Blanditiis excepteur', 'Debitis ut ullamco o', 'Nathan Mercado', 'Velit do molestiae e', 'Incididunt aute est ', 'Illum facere non in', 'Voluptatem aut ulla', 'Oprah Davis', 'Consectetur sunt au', 'Qui hic qu'),
('283', 'Incididunt faci', '2017', NULL, NULL, 'Caleb Mcdowell', 'Jena Burt', 'Rogers', 'Electronic & Communication', 'Impedit cum quo asp', 'Qui eligendi incidid', 'Quisquam fugiat ut ', 'At eius harum necess', '2010-05-10', '1974-01-06', 'Molestias pariatur ', 'on', '350', 'tawyrekyq@mailinator.com', '544', '997', 'Fuga Aut r', 'Corporis sed ea odio', '607', 'Est impedit volupta', 'Dolor ea quod dolori', 'Iola Burgess', 'Commodo vitae itaque', 'Et dignissimos quos ', 'Est velit voluptas', 'Ea qui adipisci nisi', 'Heidi Bright', 'Rerum ut sunt aliqu', 'Laudantium'),
('308', 'Cupidatat disti', '2017', '2', 'B', 'Montana Jordan', 'Aladdin Branch', 'Joseph', 'Mechanical', 'Sed dignissimos aliq', 'Quae a dolor est en', 'Sint reprehenderit a', 'Et laborum ipsam ips', '1987-01-19', '1998-12-11', 'Qui molestiae cupidi', 'on', '995', 'fomy@mailinator.com', '311', '235', 'Do qui aut', 'Assumenda adipisicin', '645', 'Ut voluptates tenetu', 'Deserunt dolore nost', 'Maxine Tyler', 'Et velit assumenda f', 'Corporis ut ut at ab', 'Libero qui perspicia', 'Ex nostrud totam sed', 'Isaiah Mcneil', 'Incididunt culpa qua', 'Dolorem it'),
('41', 'Ut repellendus ', '2017', '2', 'B', 'Shellie Mckenzie', 'Isabelle Rivers', 'Bishop', 'Mechanical', 'Maxime ipsa nostrud', 'Sint rem porro reru', 'Minus voluptas ut qu', 'Veritatis in magnam ', '1997-10-23', '1999-04-22', 'Amet distinctio Ip', 'on', '504', 'bipasej@mailinator.com', '723', '901', 'Quo volupt', 'Officia aut qui in d', '446', 'Et aut iure incidunt', 'Enim blanditiis elig', 'Oliver Becker', 'Nam voluptatibus omn', 'Ipsum enim aut expl', 'Possimus doloremque', 'Voluptatem Sunt Nam', 'Priscilla Kent', 'Cumque omnis numquam', 'Perspiciat'),
('465', 'Dolore dignissi', '2017', '2', 'B', 'Jordan Morrow', 'Carla Armstrong', 'Buck', 'Mechanical', 'Dicta molestias simi', 'Aliqua Voluptates s', 'Neque maxime eveniet', 'Sapiente exercitatio', '1970-10-25', '2013-07-05', 'Explicabo Nobis aut', 'on', '99', 'qaha@mailinator.com', '212', '822', 'Delectus m', 'Dolorem sunt nobis ', '516', 'Sint nihil fugit re', 'Laboriosam laborios', 'Rae Eaton', 'Ut occaecat debitis ', 'Magna aspernatur qui', 'Aut aut aliqua Illu', 'Omnis ut voluptatum ', 'Flavia Rosario', 'Deserunt facilis qui', 'Quo cupidi'),
('470', 'Consectetur eve', '2017', '2', 'A', 'Gay Adams', 'Wesley Schmidt', 'Shannon', 'Mechanical', 'Delectus dolore mol', 'Mollitia quibusdam i', 'Accusamus dolores si', 'Iure fugiat adipisci', '2017-01-16', '1987-08-19', 'Eu reiciendis blandi', 'on', '201', 'cewer@mailinator.com', '986', '233', 'Magna vita', 'Laborum Nam lorem a', '130', 'Nostrud voluptatem d', 'Eiusmod velit conse', 'Alfonso Carter', 'Quod praesentium mol', 'Ad ratione ut labore', 'Ut corporis voluptas', 'Et unde earum quia a', 'Zane Everett', 'Corrupti in assumen', 'Velit labo'),
('752', 'Non et nostrud ', '2017', '2', 'B', 'Kane Reed', 'Odette Clements', 'Goodman', 'Mechanical', 'Facere quia nostrud ', 'Nisi nihil ipsa ali', 'Ut at ipsa enim in ', 'Ut sit commodo quia ', '1986-04-20', '2014-06-25', 'Atque fugiat quia au', 'on', '592', 'qosyc@mailinator.com', '790', '125', 'Eum quis n', 'Rem est eveniet sit', '470', 'Placeat commodo tem', 'A adipisicing fugit', 'Cora Marks', 'In et eius accusamus', 'Harum molestiae quia', 'Asperiores et dolor ', 'Sit incidunt exerci', 'Finn Delacruz', 'Elit officia et lor', 'Qui rerum '),
('756', 'Est voluptatum ', '2017', '2', 'A', 'Allegra Wiley', 'Rose Owen', 'Woodward', 'Mechanical', 'Sed nihil est id rep', 'Mollit aspernatur si', 'Dolorum eligendi dol', 'Et sunt lorem nisi i', '2020-10-23', '1990-03-14', 'Voluptas quisquam du', 'on', '612', 'wyfy@mailinator.com', '540', '890', 'Voluptatib', 'Quaerat deserunt cor', '637', 'Corrupti occaecat r', 'Est consectetur od', 'Caleb Compton', 'Error quia impedit ', 'In rerum sed velit ', 'Labore ullam ut nece', 'Saepe deserunt autem', 'Ulla Delgado', 'Doloribus excepteur ', 'Quia nemo '),
('816', 'Aut neque repre', '2017', '2', 'B', 'Jolie Williamson', 'Howard Chan', 'Fletcher', 'Mechanical', 'Doloribus eius dolor', 'Distinctio Do incid', 'Irure voluptatem id', 'Quia lorem distincti', '2011-01-25', '1980-11-06', 'Placeat alias offic', 'on', '60', 'kihiw@mailinator.com', '833', '696', 'Delectus v', 'Libero iste nulla qu', '346', 'Iusto accusamus aspe', 'Laboris earum cum mi', 'Lilah Pennington', 'Sit esse tempora be', 'Optio odio maxime s', 'Et harum at hic arch', 'Perferendis doloribu', 'Bianca Glover', 'Non exercitation ver', 'Enim animi'),
('893', 'Voluptate commo', '2017', '2', 'A', 'Dacey Salinas', 'Amela Harvey', 'Lynch', 'Mechanical', 'Neque nemo itaque se', 'Et accusantium ea la', 'Exercitation culpa e', 'Earum id aperiam eo', '1996-09-15', '2012-12-04', 'Ullamco accusamus es', 'on', '815', 'viviv@mailinator.com', '882', '296', 'Inventore ', 'In dolores quia illu', '21', 'Aperiam natus omnis ', 'Incidunt rerum opti', 'Rafael Hopper', 'Minima non iste enim', 'Adipisicing ex offic', 'Qui cupiditate hic v', 'Ex beatae sequi tene', 'James Clay', 'Aut rerum sed dolore', 'Reprehende'),
('918', 'Non esse perfer', '2017', NULL, NULL, 'Mona Lara', 'Rashad Beach', 'Pacheco', 'Computer Science & Design', 'Rerum quam deserunt ', 'Consequat Error occ', 'Laborum Laborum et ', 'Consequatur ea nisi', '2020-01-11', '1970-06-20', 'Quod sed nihil unde ', 'on', '75', 'zeqyx@mailinator.com', '983', '332', 'Voluptatem', 'Libero distinctio T', '453', 'Odio sed voluptatem', 'Illo debitis sint ut', 'Veronica Holder', 'Quia a est fuga Har', 'Reiciendis quibusdam', 'Id dolorem eum dolor', 'Sunt veniam suscipi', 'Wylie Fernandez', 'Ut voluptatem labor', 'Modi volup'),
('920', 'Quis pariatur U', '2017', '2', 'A', 'Barbara Cooper', 'Akeem Torres', 'Santana', 'Mechanical', 'Excepteur voluptatem', 'Rem cupiditate eos ', 'Omnis ea illum cons', 'Id sit reprehenderi', '1982-10-21', '2021-01-24', 'Qui sit voluptate al', 'on', '370', 'hyzyhar@mailinator.com', '214', '478', 'Cupidatat ', 'Iste magni ut beatae', '526', 'Autem eos et molest', 'In dolorem iste erro', 'Allistair Hansen', 'Ut dolorem autem rep', 'Voluptates quidem te', 'Magna fugiat exerci', 'Ea id ut duis molest', 'Leila Marshall', 'Sed dolor porro esse', 'In sunt te'),
('98', 'Dolorum ex ipsa', '2017', '2', 'A', 'Fiona Coffey', 'Hayden Farmer', 'Stephens', 'Mechanical', 'Error iusto sit hic ', 'Quos vero nihil odit', 'Consequuntur quibusd', 'Sed et odit aut earu', '2012-04-22', '1979-01-04', 'Corrupti harum veni', 'on', '847', 'kulyc@mailinator.com', '131', '962', 'Delectus d', 'Sapiente nihil sit ', '471', 'Velit illo quis temp', 'Quo at ut sapiente a', 'Cassandra Wilder', 'Consectetur beatae m', 'Reprehenderit volupt', 'Minim non quos eaque', 'Ullamco sit quos dic', 'Catherine Carpenter', 'Quod proident et do', 'Modi qui e'),
('994', 'Recusandae Enim', '2017', '2', 'A', 'Elliott Phelps', 'Fitzgerald Livingston', 'Becker', 'Mechanical', 'Dolores quis omnis e', 'Commodo suscipit et ', 'Quis non ipsa et do', 'Omnis lorem unde ut ', '2008-04-12', '1991-02-01', 'Aut quae nisi simili', 'on', '329', 'fosamewud@mailinator.com', '894', '711', 'Molestiae ', 'Voluptas velit elit', '446', 'Ex ex voluptate qui ', 'Eligendi perferendis', 'Price Frazier', 'Culpa lorem hic est', 'Facere nihil dolorem', 'Aperiam lorem quisqu', 'Recusandae Nulla un', 'Hope Nieves', 'Omnis quos sed aliqu', 'Quasi et e');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`adm_no`),
  ADD UNIQUE KEY `usn` (`usn`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
