-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 01, 2023 at 11:46 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `salesdatabase`
--

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `CustomerID` int(11) NOT NULL,
  `CustomerName` varchar(255) NOT NULL,
  `CustomerAddress` varchar(255) NOT NULL,
  `CustomerPhoneNumber` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`CustomerID`, `CustomerName`, `CustomerAddress`, `CustomerPhoneNumber`) VALUES
(1, 'John Doe', '123 Place on earth', '123-456-789'),
(2, 'Jane Smith', '1234 place on earth', '987-654-321'),
(3, 'Thomas Ross', '2 place on earth', '987-654-321'),
(5, 'Bill Harvey', '3 place on earth', '234-346-768'),
(6, 'John Smith', 'Place on earth 5', '564-354-543'),
(7, 'John Wayne', '6 place on earth', '654-534-645');

-- --------------------------------------------------------

--
-- Table structure for table `goods`
--

CREATE TABLE `goods` (
  `GoodsID` int(11) NOT NULL,
  `GoodsDescription` varchar(255) NOT NULL,
  `GoodsPrice` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `goods`
--

INSERT INTO `goods` (`GoodsID`, `GoodsDescription`, `GoodsPrice`) VALUES
(1, 'Product A', 10.00),
(2, 'Product B', 15.00);

-- --------------------------------------------------------

--
-- Table structure for table `invoices`
--

CREATE TABLE `invoices` (
  `InvoiceNumber` int(11) NOT NULL,
  `SalesOrderNumber` int(11) DEFAULT NULL,
  `DateOfSale` date NOT NULL,
  `CustomerID` int(11) NOT NULL,
  `TotalOrderCost` decimal(10,2) NOT NULL,
  `Subtotal` decimal(10,2) NOT NULL,
  `VAT` decimal(10,2) NOT NULL,
  `PostageAndPackaging` decimal(10,2) NOT NULL,
  `GrandTotal` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `invoices`
--

INSERT INTO `invoices` (`InvoiceNumber`, `SalesOrderNumber`, `DateOfSale`, `CustomerID`, `TotalOrderCost`, `Subtotal`, `VAT`, `PostageAndPackaging`, `GrandTotal`) VALUES
(1, 1001, '2023-08-31', 1, 77.00, 60.00, 12.00, 5.00, 82.00),
(2, 1002, '2023-09-05', 2, 23.00, 15.00, 3.00, 5.00, 28.00),
(3, 1003, '2023-09-06', 3, 41.00, 30.00, 6.00, 5.00, 46.00),
(4, 1004, '2023-09-02', 1, 53.00, 40.00, 8.00, 5.00, 58.00),
(5, 1005, '2023-09-15', 3, 113.00, 90.00, 18.00, 5.00, 118.00),
(6, 1006, '2023-08-28', 5, 815.00, 675.00, 135.00, 5.00, 820.00),
(7, 1007, '2023-08-28', 5, 149.00, 120.00, 24.00, 5.00, 154.00),
(8, 1008, '2023-08-11', 2, 65.00, 50.00, 10.00, 5.00, 70.00),
(9, 1009, '2023-08-31', 6, 59.00, 45.00, 9.00, 5.00, 64.00),
(10, 1010, '2023-08-31', 7, 149.00, 120.00, 24.00, 5.00, 154.00);

-- --------------------------------------------------------

--
-- Table structure for table `invoice_items`
--

CREATE TABLE `invoice_items` (
  `InvoiceItemID` int(11) NOT NULL,
  `InvoiceNumber` int(11) NOT NULL,
  `GoodsID` int(11) NOT NULL,
  `Quantity` int(11) NOT NULL,
  `TotalPriceOfOneItem` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `invoice_items`
--

INSERT INTO `invoice_items` (`InvoiceItemID`, `InvoiceNumber`, `GoodsID`, `Quantity`, `TotalPriceOfOneItem`) VALUES
(1, 1, 1, 3, 30.00),
(2, 1, 2, 2, 30.00),
(3, 2, 2, 1, 15.00),
(4, 3, 1, 3, 30.00),
(5, 4, 1, 4, 40.00),
(6, 5, 2, 6, 90.00),
(7, 6, 2, 45, 675.00),
(8, 7, 1, 12, 120.00),
(9, 8, 1, 5, 50.00),
(10, 9, 2, 3, 45.00),
(11, 10, 2, 8, 120.00);

--
-- Triggers `invoice_items`
--
DELIMITER $$
CREATE TRIGGER `update_invoice_totals_trigger` AFTER INSERT ON `invoice_items` FOR EACH ROW BEGIN
    DECLARE invoice_subtotal DECIMAL(10, 2);
    DECLARE invoice_vat DECIMAL(10, 2);
    DECLARE invoice_total DECIMAL(10, 2);

    -- Calculate subtotal for the current invoice
    SELECT SUM(TotalPriceOfOneItem) INTO invoice_subtotal
    FROM Invoice_Items
    WHERE InvoiceNumber = NEW.InvoiceNumber;

    -- Calculate VAT at a rate of 20%
    SET invoice_vat = invoice_subtotal * 0.20;

    -- Calculate total cost (subtotal + VAT + PostageAndPackaging)
    SET invoice_total = invoice_subtotal + invoice_vat + 5.00;

    -- Update the Invoices table with calculated values
    UPDATE Invoices
    SET Subtotal = invoice_subtotal,
        VAT = invoice_vat,
        PostageAndPackaging = 5.00,
        TotalOrderCost = invoice_total,
        GrandTotal = invoice_total + 5.00
    WHERE InvoiceNumber = NEW.InvoiceNumber;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

CREATE TABLE `payments` (
  `PaymentID` int(11) NOT NULL,
  `InvoiceNumber` int(11) NOT NULL,
  `PaymentDate` date NOT NULL,
  `PaymentAmount` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `payments`
--

INSERT INTO `payments` (`PaymentID`, `InvoiceNumber`, `PaymentDate`, `PaymentAmount`) VALUES
(1, 1, '2023-09-01', 60.00),
(2, 1, '2023-09-03', 5.00),
(3, 2, '2023-09-06', 15.00);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`CustomerID`);

--
-- Indexes for table `goods`
--
ALTER TABLE `goods`
  ADD PRIMARY KEY (`GoodsID`);

--
-- Indexes for table `invoices`
--
ALTER TABLE `invoices`
  ADD PRIMARY KEY (`InvoiceNumber`),
  ADD KEY `CustomerID` (`CustomerID`);

--
-- Indexes for table `invoice_items`
--
ALTER TABLE `invoice_items`
  ADD PRIMARY KEY (`InvoiceItemID`),
  ADD KEY `InvoiceNumber` (`InvoiceNumber`),
  ADD KEY `GoodsID` (`GoodsID`);

--
-- Indexes for table `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`PaymentID`),
  ADD KEY `InvoiceNumber` (`InvoiceNumber`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `CustomerID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `goods`
--
ALTER TABLE `goods`
  MODIFY `GoodsID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `invoices`
--
ALTER TABLE `invoices`
  MODIFY `InvoiceNumber` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `invoice_items`
--
ALTER TABLE `invoice_items`
  MODIFY `InvoiceItemID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `PaymentID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `invoices`
--
ALTER TABLE `invoices`
  ADD CONSTRAINT `invoices_ibfk_1` FOREIGN KEY (`CustomerID`) REFERENCES `customers` (`CustomerID`);

--
-- Constraints for table `invoice_items`
--
ALTER TABLE `invoice_items`
  ADD CONSTRAINT `invoice_items_ibfk_1` FOREIGN KEY (`InvoiceNumber`) REFERENCES `invoices` (`InvoiceNumber`),
  ADD CONSTRAINT `invoice_items_ibfk_2` FOREIGN KEY (`GoodsID`) REFERENCES `goods` (`GoodsID`);

--
-- Constraints for table `payments`
--
ALTER TABLE `payments`
  ADD CONSTRAINT `payments_ibfk_1` FOREIGN KEY (`InvoiceNumber`) REFERENCES `invoices` (`InvoiceNumber`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
