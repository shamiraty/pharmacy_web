-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 18, 2024 at 05:25 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.0.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pharmacy_shop`
--

-- --------------------------------------------------------

--
-- Table structure for table `medicine_stock`
--

CREATE TABLE `medicine_stock` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `expiry_date` date NOT NULL,
  `quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `medicine_stock`
--

INSERT INTO `medicine_stock` (`id`, `name`, `price`, `expiry_date`, `quantity`) VALUES
(1, 'Paracetamol', 1.50, '2025-01-01', 0),
(2, 'Ibuprofen', 2.00, '2025-02-01', 0),
(3, 'Aspirin', 1.75, '2025-03-01', 0),
(4, 'Amoxicillin', 5.00, '2025-04-01', 0),
(5, 'Ciprofloxacin', 7.00, '2025-05-01', 98),
(6, 'Metformin', 3.50, '2025-06-01', 108),
(7, 'Atorvastatin', 6.00, '2025-07-01', 72),
(8, 'Omeprazole', 4.00, '2025-08-01', 100),
(9, 'Lisinopril', 3.00, '2025-09-01', 100),
(10, 'Amlodipine', 2.50, '2025-10-01', 100),
(11, 'Simvastatin', 5.50, '2025-11-01', 0),
(12, 'Azithromycin', 8.00, '2025-12-01', 0),
(13, 'Hydrochlorothiazide', 1.25, '2025-01-15', 0),
(14, 'Losartan', 4.50, '2025-02-15', 0),
(15, 'Gabapentin', 3.75, '2025-03-15', 94),
(16, 'Tramadol', 6.50, '2025-04-15', 64),
(17, 'Citalopram', 4.25, '2025-05-15', 99),
(18, 'Montelukast', 5.75, '2025-06-15', 104),
(19, 'Levothyroxine', 2.75, '2025-07-15', 114),
(20, 'Metoprolol', 3.25, '2025-08-15', 124),
(33, 'Paracetamol', 5.99, '2024-12-31', 100),
(34, 'Aspirin', 3.49, '2025-06-30', 0),
(35, 'Ibuprofen', 4.79, '2023-11-15', 120),
(36, 'Omeprazole', 8.25, '2025-02-28', 80),
(37, 'Metformin', 6.50, '2024-09-30', 90),
(38, 'Lisinopril', 7.89, '2024-10-31', 110),
(39, 'Simvastatin', 9.75, '2023-08-31', 95),
(40, 'Amoxicillin', 12.45, '2023-12-31', 130),
(41, 'Prednisone', 11.30, '2024-07-15', 70),
(42, 'Levothyroxine', 15.20, '2025-01-31', 85),
(43, 'Atorvastatin', 14.50, '2023-09-30', 105),
(44, 'Citalopram', 10.75, '2024-03-31', 125),
(45, 'Metoprolol', 13.60, '2024-04-30', 100),
(46, 'Escitalopram', 11.99, '2024-05-31', 115),
(47, 'Warfarin', 6.80, '2023-07-31', 135),
(48, 'Clopidogrel', 9.25, '2024-02-29', 95),
(49, 'Gabapentin', 7.50, '2023-10-31', 110),
(50, 'Losartan', 8.99, '2024-11-30', 120),
(51, 'Azithromycin', 14.99, '2024-08-31', 80),
(52, 'Bupropion', 12.75, '2025-04-30', 105),
(53, 'Duloxetine', 15.30, '2023-06-30', 0),
(54, 'Quetiapine', 11.25, '2024-01-31', 0),
(55, 'Pregabalin', 16.50, '2023-05-31', 0),
(56, 'Alprazolam', 18.99, '2024-12-31', 0),
(57, 'Fluoxetine', 9.80, '2025-06-30', 0),
(58, 'Venlafaxine', 14.25, '2023-11-15', 95),
(59, 'Trazodone', 10.99, '2025-02-28', 110),
(60, 'Ciprofloxacin', 12.75, '2024-09-30', 120),
(61, 'Mirtazapine', 13.50, '2024-10-31', 105),
(62, 'Pantoprazole', 8.95, '2023-08-31', 0),
(63, 'Bisoprolol', 11.45, '2023-12-31', 115),
(64, 'Risperidone', 9.60, '2024-07-15', 90),
(65, 'Amitriptyline', 10.20, '2025-01-31', 80),
(66, 'Hydrochlorothiazide', 7.99, '2023-09-30', 125),
(67, 'Clonazepam', 15.75, '2024-03-31', 95),
(68, 'Carvedilol', 12.80, '2024-04-30', 110),
(69, 'Lorazepam', 14.99, '2024-05-31', 105),
(70, 'Olanzapine', 16.80, '2023-07-31', 85),
(71, 'Doxycycline', 11.25, '2024-02-29', 120),
(72, 'Tramadol', 10.50, '2023-10-31', 100),
(73, 'Furosemide', 9.99, '2024-11-30', 110),
(74, 'Buprenorphine', 13.20, '2024-08-31', 95),
(75, 'Lisinopril', 12.75, '2025-04-30', 100),
(76, 'Folic Acid', 6.50, '2023-06-30', 115),
(77, 'Digoxin', 8.25, '2024-01-31', 90),
(78, 'Acetaminophen', 7.99, '2023-05-31', 105),
(79, 'Meloxicam', 9.75, '2024-12-31', 90),
(80, 'Cephalexin', 8.49, '2025-06-30', 120),
(81, 'Metronidazole', 7.79, '2023-11-15', 100),
(82, 'Tamsulosin', 6.25, '2025-02-28', 109),
(83, 'Diazepam', 11.50, '2024-09-30', 80),
(84, 'Cefuroxime', 10.89, '2024-10-31', 94),
(85, 'Methotrexate', 15.75, '2023-08-31', 104),
(86, 'Clobetasol', 12.45, '2023-12-31', 114),
(87, 'Naproxen', 11.30, '2024-07-15', 70),
(88, 'Prednisolone', 13.20, '2025-01-31', 83),
(89, 'Dicyclomine', 7.50, '2023-09-30', 119),
(90, 'Lamotrigine', 9.50, '2024-03-31', 110),
(91, 'Dexamethasone', 8.75, '2024-04-30', 95),
(92, 'Diphenhydramine', 6.80, '2024-05-31', 100),
(93, 'Cyclobenzaprine', 9.99, '2023-07-31', 125),
(94, 'Fluticasone', 12.25, '2024-02-29', 105),
(95, 'Hydroxyzine', 10.75, '2023-10-31', 115),
(96, 'Prednisolone', 11.99, '2024-11-30', 95),
(97, 'Sulfamethoxazole', 14.99, '2024-08-31', 90),
(98, 'Mupirocin', 13.75, '2025-04-30', 105),
(99, 'Clotrimazole', 11.30, '2023-06-30', 110),
(100, 'Doxazosin', 12.50, '2024-01-31', 85),
(101, 'Sotalol', 9.99, '2023-05-31', 100),
(102, 'Terbinafine', 15.25, '2024-12-31', 95),
(103, 'Fexofenadine', 12.99, '2025-06-30', 115),
(104, 'Tizanidine', 10.75, '2023-11-15', 105),
(105, 'Fentanyl', 8.99, '2025-02-28', 110),
(106, 'Ketoconazole', 11.75, '2024-09-30', 120),
(107, 'Latanoprost', 14.20, '2024-10-31', 100),
(108, 'Aripiprazole', 13.45, '2023-08-31', 115),
(109, 'Levetiracetam', 9.75, '2023-12-31', 90),
(110, 'Nortriptyline', 10.25, '2024-07-15', 80),
(111, 'Nitrofurantoin', 7.99, '2025-01-31', 125),
(112, 'Cyclosporine', 12.60, '2023-09-30', 95),
(113, 'Leflunomide', 10.99, '2024-03-31', 110),
(114, 'Lidocaine', 8.80, '2024-04-30', 105),
(115, 'Dutasteride', 9.80, '2024-05-31', 85),
(116, 'Cefdinir', 13.50, '2023-07-31', 120),
(117, 'Cetirizine', 11.50, '2024-02-29', 100),
(118, 'Nystatin', 14.99, '2023-10-31', 110),
(119, 'Budesonide', 16.25, '2024-11-30', 95),
(120, 'Triamcinolone', 12.75, '2024-08-31', 105),
(121, 'Ipratropium', 11.30, '2025-04-30', 100),
(122, 'Verapamil', 10.50, '2023-06-30', 115),
(123, 'Spironolactone', 9.99, '2024-01-31', 90),
(124, 'Buspirone', 15.25, '2023-05-31', 105),
(125, 'Promethazine', 14.99, '2024-12-31', 90),
(126, 'Ezetimibe', 11.99, '2025-06-30', 115),
(127, 'Raloxifene', 10.75, '2023-11-15', 105),
(128, 'Fluconazole', 9.99, '2025-02-28', 110),
(129, 'Sumatriptan', 12.75, '2024-09-30', 120),
(130, 'Phenytoin', 14.20, '2024-10-31', 100),
(131, 'Atorvastatin', 9.75, '2024-12-31', 90),
(132, 'Gabapentin', 8.49, '2025-06-30', 120),
(133, 'Pregabalin', 7.79, '2023-11-15', 100),
(134, 'Citalopram', 6.25, '2025-02-28', 110),
(135, 'Venlafaxine', 11.50, '2024-09-30', 80),
(136, 'Fluoxetine', 10.89, '2024-10-31', 95),
(137, 'Sertraline', 15.75, '2023-08-31', 105),
(138, 'Paroxetine', 12.45, '2023-12-31', 115),
(139, 'Mirtazapine', 11.30, '2024-07-15', 70),
(140, 'Duloxetine', 13.20, '2025-01-31', 85),
(141, 'Bupropion', 7.50, '2023-09-30', 120),
(142, 'Escitalopram', 9.50, '2024-03-31', 110),
(143, 'Amitriptyline', 8.75, '2024-04-30', 95),
(144, 'Buspirone', 6.80, '2024-05-31', 100),
(145, 'Clomipramine', 9.99, '2023-07-31', 125),
(146, 'Trazodone', 12.25, '2024-02-29', 105),
(147, 'Olanzapine', 10.75, '2023-10-31', 115),
(148, 'Quetiapine', 11.99, '2024-11-30', 95),
(149, 'Lurasidone', 14.99, '2024-08-31', 90),
(150, 'Risperidone', 13.75, '2025-04-30', 105),
(151, 'Paliperidone', 11.30, '2023-06-30', 110),
(152, 'Ziprasidone', 12.50, '2024-01-31', 85),
(153, 'Aripiprazole', 9.99, '2023-05-31', 100),
(154, 'Lithium Carbonate', 15.25, '2024-12-31', 95),
(155, 'Lamotrigine', 12.99, '2025-06-30', 115),
(156, 'Topiramate', 10.75, '2023-11-15', 105),
(157, 'Carbamazepine', 8.99, '2025-02-28', 110),
(158, 'Oxcarbazepine', 11.75, '2024-09-30', 120),
(159, 'Levetiracetam', 14.20, '2024-10-31', 100),
(160, 'Valproic Acid', 13.45, '2023-08-31', 115),
(161, 'Phenytoin', 9.75, '2023-12-31', 90),
(162, 'Primidone', 10.25, '2024-07-15', 80),
(163, 'Lacosamide', 7.99, '2025-01-31', 125),
(164, 'Pregabalin', 12.60, '2023-09-30', 95),
(165, 'Stiripentol', 10.99, '2024-03-31', 110),
(166, 'Tiagabine', 8.80, '2024-04-30', 105),
(167, 'Vigabatrin', 9.80, '2024-05-31', 85),
(168, 'Perampanel', 13.50, '2023-07-31', 120),
(169, 'Ezogabine', 11.50, '2024-02-29', 100),
(170, 'Clobazam', 14.99, '2023-10-31', 110),
(171, 'Rufinamide', 16.25, '2024-11-30', 95),
(172, 'Zonisamide', 12.75, '2024-08-31', 105),
(173, 'Brivaracetam', 11.30, '2025-04-30', 100),
(174, 'Ethosuximide', 10.50, '2023-06-30', 115),
(175, 'Phenobarbital', 9.99, '2024-01-31', 90),
(176, 'Clonazepam', 15.25, '2023-05-31', 105),
(177, 'Clobazam', 14.99, '2024-12-31', 90),
(178, 'Diazepam', 11.99, '2025-06-30', 115),
(179, 'Lorazepam', 10.75, '2023-11-15', 105),
(180, 'Alprazolam', 9.99, '2025-02-28', 110),
(181, 'Oxazepam', 12.75, '2024-09-30', 120),
(182, 'Temazepam', 14.20, '2024-10-31', 100),
(183, 'Aspirin', 10.00, '2024-07-08', 0);

-- --------------------------------------------------------

--
-- Table structure for table `out_of_stock`
--

CREATE TABLE `out_of_stock` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `expiry_date` date NOT NULL,
  `quantity` int(11) NOT NULL,
  `date_added` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `out_of_stock`
--

INSERT INTO `out_of_stock` (`id`, `name`, `price`, `expiry_date`, `quantity`, `date_added`) VALUES
(1, 'Paracetamol', 1.50, '2025-01-01', 0, '2024-07-17 19:10:15'),
(11, 'Simvastatin', 5.50, '2025-11-01', 0, '2024-07-18 17:33:54'),
(12, 'Azithromycin', 8.00, '2025-12-01', 0, '2024-07-18 17:33:54'),
(13, 'Hydrochlorothiazide', 1.25, '2025-01-15', 0, '2024-07-18 17:33:54'),
(14, 'Losartan', 4.50, '2025-02-15', 0, '2024-07-18 17:33:54'),
(34, 'Aspirin', 3.49, '2025-06-30', 0, '2024-07-18 17:33:12'),
(53, 'Duloxetine', 15.30, '2023-06-30', 0, '2024-07-18 17:36:03'),
(54, 'Quetiapine', 11.25, '2024-01-31', 0, '2024-07-18 17:36:03'),
(55, 'Pregabalin', 16.50, '2023-05-31', 0, '2024-07-18 17:36:03'),
(56, 'Alprazolam', 18.99, '2024-12-31', 0, '2024-07-18 17:36:04'),
(57, 'Fluoxetine', 9.80, '2025-06-30', 0, '2024-07-18 17:36:04');

-- --------------------------------------------------------

--
-- Table structure for table `sold_items`
--

CREATE TABLE `sold_items` (
  `transaction_id` bigint(20) NOT NULL,
  `medicine_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `total` decimal(10,2) NOT NULL,
  `sale_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `sold_items`
--

INSERT INTO `sold_items` (`transaction_id`, `medicine_id`, `quantity`, `total`, `sale_date`) VALUES
(1721227994, 2, 1, 2.00, '2024-07-17 14:53:14'),
(1721228023, 2, 1, 2.00, '2024-07-17 14:53:43'),
(1721228092, 2, 138, 276.00, '2024-07-17 14:54:52'),
(1721228522, 1, 1, 1.50, '2024-07-17 15:02:02'),
(1721228581, 1, 9, 13.50, '2024-07-17 15:03:01'),
(1721231320, 2, 100, 200.00, '2024-07-17 15:48:40'),
(1721232352, 3, 196, 343.00, '2024-07-17 16:05:52'),
(1721232352, 4, 28, 140.00, '2024-07-17 16:05:52'),
(1721232352, 5, 63, 441.00, '2024-07-17 16:05:53'),
(1721232615, 1, 100, 150.00, '2024-07-17 16:10:15'),
(1721232615, 2, 100, 200.00, '2024-07-17 16:10:15'),
(1721232615, 3, 100, 175.00, '2024-07-17 16:10:15'),
(1721232615, 4, 100, 500.00, '2024-07-17 16:10:15'),
(1721234754, 13, 1, 1.25, '2024-07-17 16:45:54'),
(1721238323, 5, 1, 7.00, '2024-07-17 17:45:23'),
(1721238323, 6, 1, 3.50, '2024-07-17 17:45:23'),
(1721238323, 7, 1, 6.00, '2024-07-17 17:45:23'),
(1721241781, 82, 1, 6.25, '2024-07-17 18:43:01'),
(1721241781, 84, 1, 10.89, '2024-07-17 18:43:01'),
(1721241781, 85, 1, 15.75, '2024-07-17 18:43:01'),
(1721241781, 86, 1, 12.45, '2024-07-17 18:43:01'),
(1721241781, 88, 2, 26.40, '2024-07-17 18:43:01'),
(1721241781, 89, 1, 7.50, '2024-07-17 18:43:01'),
(1721242743, 5, 1, 7.00, '2024-07-17 18:59:03'),
(1721243171, 6, 1, 3.50, '2024-07-17 19:06:11'),
(1721313192, 34, 150, 523.50, '2024-07-18 14:33:12'),
(1721313234, 11, 59, 324.50, '2024-07-18 14:33:54'),
(1721313234, 12, 69, 552.00, '2024-07-18 14:33:54'),
(1721313234, 13, 138, 172.50, '2024-07-18 14:33:54'),
(1721313234, 14, 84, 378.00, '2024-07-18 14:33:54'),
(1721313363, 53, 90, 1377.00, '2024-07-18 14:36:03'),
(1721313363, 54, 100, 1125.00, '2024-07-18 14:36:03'),
(1721313363, 55, 75, 1237.50, '2024-07-18 14:36:03'),
(1721313363, 56, 85, 1614.15, '2024-07-18 14:36:03'),
(1721313363, 57, 115, 1127.00, '2024-07-18 14:36:04'),
(1721313363, 62, 100, 895.00, '2024-07-18 14:36:04');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `medicine_stock`
--
ALTER TABLE `medicine_stock`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `out_of_stock`
--
ALTER TABLE `out_of_stock`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sold_items`
--
ALTER TABLE `sold_items`
  ADD PRIMARY KEY (`transaction_id`,`medicine_id`),
  ADD KEY `medicine_id` (`medicine_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `medicine_stock`
--
ALTER TABLE `medicine_stock`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=188;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `sold_items`
--
ALTER TABLE `sold_items`
  ADD CONSTRAINT `sold_items_ibfk_1` FOREIGN KEY (`medicine_id`) REFERENCES `medicine_stock` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
