-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Generation Time: Jul 20, 2024 at 08:41 PM
-- Server version: 5.7.39
-- PHP Version: 7.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `easybid_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `contracts`
--

CREATE TABLE `contracts` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `contract_id` varchar(255) NOT NULL,
  `contract_name` varchar(255) NOT NULL,
  `contract_value` int(11) NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `status` enum('Active','Completed') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `contracts`
--

INSERT INTO `contracts` (`id`, `user_id`, `contract_id`, `contract_name`, `contract_value`, `start_date`, `end_date`, `status`) VALUES
(1, 1, 'CON001', 'Construction of Office Complex', 980000, '2023-06-25', '2033-07-30', 'Active'),
(2, 1, 'CON002', 'IT System Upgrade', 280000, '2023-06-30', '2024-09-12', 'Completed'),
(3, 1, 'CON003', 'Renewable Energy Research', 320000, '2023-06-20', '2027-04-10', 'Active'),
(4, 1, 'CON004', 'Urban Development Initiative', 700000, '2023-06-20', '2024-06-20', 'Completed'),
(5, 1, 'CON005', 'Environmental Conservation Project', 450000, '2023-07-02', '2028-09-12', 'Active'),
(6, 1, 'CON006', 'Advanced Manufacturing Hub', 600000, '2023-09-30', '2032-09-30', 'Active'),
(7, 1, 'CON007', 'Cloud Migration Services', 400000, '2023-10-30', '2024-08-12', 'Completed'),
(8, 1, 'CON008', 'Healthcare Facility Design', 500000, '2023-12-12', '2033-11-19', 'Active'),
(9, 1, 'CON009', 'Data Analytics Platform Development', 350000, '2024-01-19', '2026-09-23', 'Active'),
(10, 1, 'CON010', 'IT Support Services', 400000, '2024-02-19', '2025-03-16', 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `my_rfp_overview`
--

CREATE TABLE `my_rfp_overview` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `proposal_id` varchar(50) NOT NULL,
  `title` varchar(255) NOT NULL,
  `estimated_value` int(11) NOT NULL,
  `submission_date` date NOT NULL,
  `status` enum('Submitted','Under Review','In Progress','Reviewed') NOT NULL,
  `decision` enum('Pending','Accepted','Rejected','RFI') DEFAULT 'Pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `my_rfp_overview`
--

INSERT INTO `my_rfp_overview` (`id`, `user_id`, `proposal_id`, `title`, `estimated_value`, `submission_date`, `status`, `decision`) VALUES
(1, 1, 'PRO001', 'IT Services for Govt Agencies', 150000, '2023-06-25', 'Submitted', 'Pending'),
(2, 1, 'PRO002', 'Construction of Office Complex', 980000, '2023-06-15', 'Submitted', 'Accepted'),
(3, 1, 'PRO003', 'Security System Upgrade', 300000, '2023-06-20', 'Under Review', 'Pending'),
(4, 1, 'PRO004', 'Software Development Project', 180000, '2023-06-25', 'Submitted', 'Pending'),
(5, 1, 'PRO005', 'Renewable Energy Installation', 500000, '2023-06-28', 'Submitted', 'Pending'),
(6, 1, 'PRO006', 'Infrastructure Modernization', 700000, '2023-06-10', 'In Progress', 'RFI'),
(7, 1, 'PRO007', 'Healthcare Facility Renovation', 400000, '2023-06-18', 'Submitted', 'Pending'),
(8, 1, 'PRO008', 'Public Transit System Upgrade', 250000, '2023-06-22', 'In Progress', 'RFI'),
(9, 1, 'PRO009', 'IT System Upgrade', 280000, '2023-06-12', 'Reviewed', 'Accepted'),
(10, 1, 'PRO010', 'Environmental Impact Study', 420000, '2023-06-08', 'Reviewed', 'Rejected'),
(11, 1, 'PRO011', 'Educational Software Development', 180000, '2023-06-30', 'Under Review', 'Pending'),
(12, 1, 'PRO012', 'Bridge Construction Project', 870000, '2023-06-17', 'Submitted', 'Pending'),
(13, 1, 'PRO013', 'Telecommunications Infrastructure', 550000, '2023-06-23', 'Under Review', 'Pending'),
(14, 1, 'PRO014', 'Renewable Energy Research', 320000, '2023-06-19', 'Reviewed', 'Accepted'),
(15, 1, 'PRO015', 'Public Health Initiative', 200000, '2023-06-14', 'In Progress', 'RFI'),
(16, 1, 'PRO016', 'IT Infrastructure Upgrade', 380000, '2023-06-28', 'Submitted', 'Pending'),
(17, 1, 'PRO017', 'Public Transportation Expansion', 950000, '2023-06-20', 'Reviewed', 'Rejected'),
(18, 1, 'PRO018', 'Cybersecurity Enhancement Project', 500000, '2023-06-25', 'Under Review', 'Pending'),
(19, 1, 'PRO019', 'Urban Development Initiative', 700000, '2023-06-18', 'Reviewed', 'Accepted'),
(20, 1, 'PRO020', 'Healthcare Facility Renovation', 250000, '2023-06-16', 'In Progress', 'RFI'),
(21, 1, 'PRO021', 'Educational Outreach Program', 180000, '2023-06-22', 'Submitted', 'Pending'),
(22, 1, 'PRO022', 'Environmental Conservation Project', 450000, '2023-06-27', 'Reviewed', 'Accepted'),
(23, 1, 'PRO023', 'Smart City Initiative', 800000, '2023-07-10', 'In Progress', 'RFI'),
(24, 1, 'PRO024', 'Renewable Energy Infrastructure', 500000, '2023-08-05', 'Submitted', 'Pending'),
(25, 1, 'PRO025', 'Emergency Response System Upgrade', 600000, '2024-02-15', 'Under Review', 'Pending'),
(26, 1, 'PRO026', 'Rural Broadband Expansion', 350000, '2024-04-22', 'Reviewed', 'Rejected'),
(27, 1, 'PRO027', 'Advanced Manufacturing Hub', 600000, '2023-09-30', 'Reviewed', 'Accepted'),
(28, 1, 'PRO028', 'Community Health Center Renovation', 400000, '2023-11-18', 'Submitted', 'Pending'),
(29, 1, 'PRO029', 'Sustainable Agriculture Project', 280000, '2024-01-08', 'In Progress', 'RFI'),
(30, 1, 'PRO030', 'IT Infrastructure Upgrade', 250000, '2023-09-15', 'Reviewed', 'Accepted'),
(31, 1, 'PRO031', 'Security Services for Government Buildings', 180000, '2023-10-02', 'Submitted', 'Pending'),
(32, 1, 'PRO032', 'Facility Maintenance Services', 300000, '2023-10-10', 'In Progress', 'RFI'),
(33, 1, 'PRO033', 'Cloud Migration Services', 400000, '2023-10-18', 'Reviewed', 'Accepted'),
(34, 1, 'PRO034', 'Web Development for Government Portal', 150000, '2023-11-01', 'Submitted', 'Pending'),
(35, 1, 'PRO035', 'Environmental Assessment for National Park', 280000, '2023-11-05', 'Under Review', 'Pending'),
(36, 1, 'PRO036', 'Legal Consulting Services', 320000, '2023-11-10', 'Submitted', 'Rejected'),
(37, 1, 'PRO037', 'Energy Efficiency Audit', 200000, '2023-11-15', 'Submitted', 'Pending'),
(38, 1, 'PRO038', 'Disaster Recovery Planning', 350000, '2023-11-20', 'In Progress', 'RFI'),
(39, 1, 'PRO039', 'Training Program Development', 180000, '2023-12-01', 'Submitted', 'Pending'),
(40, 1, 'PRO040', 'Healthcare Facility Design', 500000, '2023-12-05', 'Submitted', 'Accepted'),
(41, 1, 'PRO041', 'Transportation Infrastructure Study', 280000, '2023-12-10', 'In Progress', 'Pending'),
(42, 1, 'PRO042', 'Cybersecurity Assessment', 220000, '2023-12-15', 'Submitted', 'Pending'),
(43, 1, 'PRO044', 'Marketing Campaign for Tourism Promotion', 150000, '2023-12-20', 'Submitted', 'Rejected'),
(44, 1, 'PRO044', 'Mobile App Development', 400000, '2023-12-25', 'Submitted', 'Pending'),
(45, 1, 'PRO045', 'Environmental Impact Assessment', 300000, '2024-01-05', 'In Progress', 'Pending'),
(46, 1, 'PRO046', 'Financial Consulting Services', 280000, '2024-01-10', 'In Progress', 'Pending'),
(47, 1, 'PRO047', 'Data Analytics Platform Development', 350000, '2024-01-15', 'Submitted', 'Accepted'),
(48, 1, 'PRO048', 'Infrastructure Upgrade for Government Buildings', 500000, '2024-01-20', 'In Progress', 'RFI'),
(49, 1, 'PRO049', 'Educational Program Evaluation', 200000, '2024-01-25', 'Submitted', 'Pending'),
(50, 1, 'PRO050', 'Public Health Awareness Campaign', 180000, '2024-02-01', 'Submitted', 'Pending');

-- --------------------------------------------------------

--
-- Table structure for table `rfps`
--

CREATE TABLE `rfps` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `category` varchar(50) DEFAULT NULL,
  `status` enum('Open','Closed') DEFAULT 'Open',
  `description` text,
  `release_date` date DEFAULT NULL,
  `submission_deadline` date DEFAULT NULL,
  `estimated_value` int(11) DEFAULT NULL,
  `project_scope` text,
  `submission_requirements` text,
  `contact_name` varchar(255) DEFAULT NULL,
  `contact_position` varchar(255) DEFAULT NULL,
  `contact_email` varchar(255) DEFAULT NULL,
  `contact_phone` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `rfps`
--

INSERT INTO `rfps` (`id`, `title`, `category`, `status`, `description`, `release_date`, `submission_deadline`, `estimated_value`, `project_scope`, `submission_requirements`, `contact_name`, `contact_position`, `contact_email`, `contact_phone`) VALUES
(101, 'IT Infrastructure Upgrade\r\n', 'IT', 'Open', 'Upgrade existing IT systems and hardware to improve performance and security. The project includes updating servers, network equipment, and ensuring compatibility with current software applications.\n', '2024-06-11', '2024-07-30', 150000, '- Upgrade network infrastructure. - Replace outdated servers and workstations. - Implement enhanced security measures. - Ensure minimal downtime during the upgrade process. - Provide training for staff on new systems.\r\n', '- Detailed project plan. - Budget breakdown. - Timeline. - Previous relevant experience. - Team qualifications. - Compliance with regulatory standards.\r\n', 'John Doe\r\n', 'IT Project Manager\r\n', 'john.doe@govagency.com\r\n', '(123) 456-7890'),
(102, 'Office Supplies Procurement', 'Procurement', 'Open', 'Supply office materials required for daily operations. The project involves providing a comprehensive range of office supplies, including stationery, electronics, and ergonomic office furniture.', '2024-07-15', '2024-08-15', 25000, '- Provide and deliver office supplies including stationery, cleaning products, and other necessary materials.\r\n- Ensure timely delivery to avoid disruptions in office operations.\r\n- Maintain a consistent stock level for high-demand items.\r\n- Offer competitive pricing and volume discounts.\r\n- Provide regular updates on inventory status and supply chain issues.', '- Detailed list of office supplies to be provided.\r\n- Pricing breakdown for each item and bulk purchase.\r\n- Delivery schedule and timeline.\r\n- Evidence of previous contracts or experience in supplying office materials.\r\n- Qualifications of the supply chain and logistics team.\r\n- Compliance with quality standards and procurement regulations.', 'Sarah Johnson', 'Procurement Manager', 'sarah.johnson@govnet.com', '(555) 123-4567'),
(103, 'Software Development', 'Software', 'Open', 'Develop a new software application to streamline internal processes. The project involves designing, coding, testing, and deploying a user-friendly application with robust features and security protocols.', '2024-05-25', '2024-08-13', 200000, '- Design user interface and user experience.\n- Develop core functionalities.\n- Integrate with existing systems.\n- Conduct rigorous testing.\n- Provide training and support post-deployment.', '- Detailed technical proposal.\n- Project timeline.\n- Cost estimate.\n- Developer team profiles.\n- Case studies of similar projects.\n- Compliance with industry standards.', 'Alice Smith', 'Lead Software Engineer', 'alice.smith@softwarecompany.com', '(234) 567-8901'),
(104, 'Security Services', 'Security', 'Open', 'Provide comprehensive security services including on-site guards, surveillance systems, and emergency response protocols for a high-profile government building.', '2024-07-01', '2024-09-13', 50000, '- Install and monitor surveillance systems.\n- Deploy trained security personnel.\n- Develop emergency response plans.\n- Regular security audits and reports.', '- Security personnel qualifications.\n- Detailed security plan.\n- Equipment specifications.\n- Cost breakdown.\n- References from previous clients.', 'Bob Johnson', 'Security Director', 'bob.johnson@securitycompany.com', '(345) 678-9012'),
(105, 'Event Management', 'Event Planning', 'Open', 'Organize and manage a series of corporate events including conferences, workshops, and seminars. Services include venue selection, catering, guest management, and event coordination.', '2024-06-25', '2024-08-30', 30000, '- Plan and execute event logistics.\n- Coordinate with vendors and suppliers.\n- Manage guest lists and invitations.\n- Provide on-site event support.\n- Post-event evaluation and feedback.', '- Event management experience.\n- Detailed event plan.\n- Vendor and venue proposals.\n- Cost estimate.\n- References and case studies.', 'Carol Davis', 'Event Coordinator', 'carol.davis@eventplanner.com', '(456) 789-0123'),
(106, 'IT Support Services', 'IT', 'Closed', 'Provide ongoing IT support services for government offices, including troubleshooting, system maintenance, and technical support. The goal is to ensure smooth and uninterrupted IT operations.', '2023-06-25', '2023-07-30', 100000, '- Offer 24/7 technical support.\n- Regular system maintenance.\n- Immediate troubleshooting for critical issues.\n- Update and patch management.\n- IT infrastructure reviews and improvements.', '- Support service proposal.\n- Technical support capabilities.\n- Service level agreements.\n- Cost structure.\n- IT support team credentials.', 'David Brown', 'IT Support Manager', 'david.brown@itsupport.com', '(567) 890-1234'),
(107, 'Healthcare Consulting', 'Consulting', 'Open', 'Provide consulting services to improve healthcare facilities\' operational efficiency, patient care quality, and compliance with regulations. This includes conducting thorough assessments, developing actionable strategies, and supporting implementation efforts.', '2024-05-25', '2023-07-28', 200000, '- Conduct comprehensive facility assessments.\n- Develop tailored improvement strategies.\n- Support implementation of recommendations.\n- Provide training for staff.\n- Ensure adherence to healthcare regulations.', '- Consulting experience in healthcare.\n- Detailed assessment and strategy plan.\n- Implementation support.\n- Cost estimate.\n- References from similar projects.', 'Emily Wilson', 'Healthcare Consultant', 'emily.wilson@healthcareconsulting.com', '(678) 901-2345'),
(108, 'Construction of Public Library', 'Construction', 'Open', 'Construct a new public library designed to serve the community with state-of-the-art facilities. This project encompasses architectural design, site preparation, building construction, and interior setup.', '2024-07-15', '2024-07-24', 500000, '- Design and build library structure.\n- Site preparation and foundation work.\n- Interior design including bookshelves, reading areas, and technology integration.\n- Landscaping and external improvements.\n- Ensure compliance with building codes and regulations.', '- Detailed construction plan.\n- Budget breakdown.\n- Timeline.\n- Contractor experience and references.\n- Compliance with regulatory standards.', 'Frank Harris', 'Project Manager', 'frank.harris@constructioncompany.com', '(789) 012-3456'),
(109, 'Cybersecurity Audit', 'Security', 'Closed', 'Perform a comprehensive cybersecurity audit to evaluate the effectiveness of existing security measures and identify vulnerabilities. This includes risk analysis, system reviews, and actionable recommendations for enhancing security.', '2024-06-21', '2023-07-19', 150000, '- Conduct vulnerability assessments.\n- Perform risk analysis.\n- Review and evaluate existing security measures.\n- Provide detailed recommendations for improvement.\n- Prepare a comprehensive audit report.', '- Detailed audit proposal.\n- Experience in cybersecurity.\n- Methodology and approach.\n- Cost estimate.\n- Team qualifications and references.', 'Grace Lee', '', 'grace.lee@cybersecurityaudit.com', '(890) 123-4567'),
(110, 'Website Design', 'Web Development', 'Closed', 'Redesign the government portal website to enhance user experience, accessibility, and functionality. This project includes creating a modern design, integrating advanced features, and ensuring cross-browser compatibility.', '2023-06-25', '2023-07-30', 80000, '- Develop a new, modern website design.\n- Integrate advanced features and functionalities.\n- Ensure compatibility across different browsers.\n- Conduct user testing and gather feedback.\n- Provide ongoing support and maintenance post-launch.', '- Design proposal.\n- Development plan.\n- Cost estimate.\n- Experience and qualifications of development team.\n- References and samples of previous work.', 'Helen King', 'Web Developer', 'helen.king@webdesign.com', '(901) 234-5678'),
(111, 'Environmental Impact Study', 'Environment', 'Open', 'Conduct an environmental impact study to evaluate the potential effects of a new project on local ecosystems, water resources, and public health. This includes developing recommendations to mitigate any negative impacts.', '2023-06-25', '2023-07-30', 250000, '- Assess potential impacts on local ecosystems.\n- Evaluate effects on water resources.\n- Analyze potential health risks to the community.\n- Provide recommendations for mitigating negative impacts.\n- Compile a detailed report of findings and recommendations.', '- Detailed study proposal.\n- Experience in environmental assessments.\n- Methodology and approach.\n- Cost estimate.\n- References and previous project experience.', 'Ian Thompson', 'Environmental Scientist', 'ian.thompson@environmentalstudy.com', '(012) 345-6789');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `state` varchar(20) NOT NULL,
  `business_license` varchar(50) NOT NULL,
  `city` varchar(50) NOT NULL,
  `address` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `first_name`, `last_name`, `username`, `email`, `phone`, `state`, `business_license`, `city`, `address`, `password`) VALUES
(1, 'Capstone', 'Group', 'capstone', 'capstone@gwu.edu', '1234567890', 'DC', '1234567', 'Washington', '123 ABC St', '$2y$10$Cb1YOAOhHIsqetP6orTGmukw3Dlkt1t1.sJvN047Ja39ifI8ONZXW');

-- --------------------------------------------------------

--
-- Table structure for table `user_proposals`
--

CREATE TABLE `user_proposals` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `quarter` varchar(10) NOT NULL,
  `proposals` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user_proposals`
--

INSERT INTO `user_proposals` (`id`, `user_id`, `quarter`, `proposals`) VALUES
(1, 1, 'Q1 2023', 4215),
(2, 1, 'Q2 2023', 5312),
(3, 1, 'Q3 2023', 6251),
(4, 1, 'Q4 2023', 3841),
(5, 1, 'Q1 2024', 7821),
(6, 1, 'Q2 2024', 11984);

-- --------------------------------------------------------

--
-- Table structure for table `user_revenue`
--

CREATE TABLE `user_revenue` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `date` date NOT NULL,
  `revenue` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user_revenue`
--

INSERT INTO `user_revenue` (`id`, `user_id`, `date`, `revenue`) VALUES
(1, 1, '2024-06-17', '10000.00'),
(2, 1, '2024-06-18', '30162.00'),
(3, 1, '2024-06-19', '26263.00'),
(4, 1, '2024-06-20', '18394.00'),
(5, 1, '2024-06-21', '18287.00'),
(6, 1, '2024-06-22', '28682.00'),
(7, 1, '2024-06-23', '31274.00'),
(8, 1, '2024-06-24', '33259.00'),
(9, 1, '2024-06-25', '25849.00'),
(10, 1, '2024-06-26', '24159.00'),
(11, 1, '2024-06-27', '32651.00'),
(12, 1, '2024-06-28', '31984.00'),
(13, 1, '2024-06-29', '38451.00');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `contracts`
--
ALTER TABLE `contracts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `my_rfp_overview`
--
ALTER TABLE `my_rfp_overview`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `rfps`
--
ALTER TABLE `rfps`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `user_proposals`
--
ALTER TABLE `user_proposals`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `user_revenue`
--
ALTER TABLE `user_revenue`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `contracts`
--
ALTER TABLE `contracts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `my_rfp_overview`
--
ALTER TABLE `my_rfp_overview`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT for table `rfps`
--
ALTER TABLE `rfps`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=130;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `user_proposals`
--
ALTER TABLE `user_proposals`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `user_revenue`
--
ALTER TABLE `user_revenue`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `contracts`
--
ALTER TABLE `contracts`
  ADD CONSTRAINT `contracts_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `my_rfp_overview`
--
ALTER TABLE `my_rfp_overview`
  ADD CONSTRAINT `my_rfp_overview_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `user_proposals`
--
ALTER TABLE `user_proposals`
  ADD CONSTRAINT `user_proposals_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `user_revenue`
--
ALTER TABLE `user_revenue`
  ADD CONSTRAINT `user_revenue_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
