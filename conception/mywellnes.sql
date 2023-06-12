-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jun 09, 2023 at 04:01 PM
-- Server version: 8.0.31
-- PHP Version: 8.0.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `mywellnes`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

DROP TABLE IF EXISTS `admin`;
CREATE TABLE IF NOT EXISTS `admin` (
  `id_adm` int NOT NULL AUTO_INCREMENT,
  `adm_name` varchar(50) DEFAULT NULL,
  `adm_lastename` varchar(50) DEFAULT NULL,
  `adm_email` varchar(50) DEFAULT NULL,
  `adm_pswrd` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id_adm`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `completed_tasks`
--

DROP TABLE IF EXISTS `completed_tasks`;
CREATE TABLE IF NOT EXISTS `completed_tasks` (
  `id_mb` int NOT NULL,
  `id_tsk` int NOT NULL,
  PRIMARY KEY (`id_mb`,`id_tsk`),
  KEY `id_tsk` (`id_tsk`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `completed_tasks`
--

INSERT INTO `completed_tasks` (`id_mb`, `id_tsk`) VALUES
(1, 72),
(1, 73);

-- --------------------------------------------------------

--
-- Table structure for table `goal`
--

DROP TABLE IF EXISTS `goal`;
CREATE TABLE IF NOT EXISTS `goal` (
  `id_goal` int NOT NULL AUTO_INCREMENT,
  `gl_name` varchar(50) DEFAULT NULL,
  `gl_goal` varchar(255) DEFAULT NULL,
  `gl_state` varchar(50) DEFAULT NULL,
  `id_mb` int NOT NULL,
  PRIMARY KEY (`id_goal`),
  KEY `id_mb` (`id_mb`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `journal`
--

DROP TABLE IF EXISTS `journal`;
CREATE TABLE IF NOT EXISTS `journal` (
  `id_jr` int NOT NULL AUTO_INCREMENT,
  `jr_name` varchar(50) DEFAULT NULL,
  `jr_date` date DEFAULT NULL,
  `jr_content` varchar(8000) DEFAULT NULL,
  `jr_state` varchar(50) DEFAULT NULL,
  `is_prooved` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `jr_likes` int NOT NULL,
  `jr_saves` int NOT NULL,
  `id_mb` int NOT NULL,
  PRIMARY KEY (`id_jr`),
  KEY `id_mb` (`id_mb`)
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `journal`
--

INSERT INTO `journal` (`id_jr`, `jr_name`, `jr_date`, `jr_content`, `jr_state`, `is_prooved`, `jr_likes`, `jr_saves`, `id_mb`) VALUES
(1, 'Positive  Day', '2023-06-09', 'Today, I had a productive day at work. I completed all my tasks and received positive feedback from my supervisor. It felt great to be recognized for my hard work and dedication. In the evening, I went for a refreshing walk in the park and enjoyed the beautiful sunset. It was a peaceful moment that allowed me to clear my mind and appreciate the simple joys of life.\r\n\r\nOverall, today was a good day filled with accomplishments and moments of serenity. I\'m grateful for the opportunities and experiences that came my way. Tomorrow, I plan to continue this positive momentum and make progress towards my goals.\r\n\r\nEnd of log entry.\r\n\r\nIn this example, the log entry provides a brief summary of the day\'s activities, emotions, and reflections. It captures key highlights without going into extensive detail.', 'published', '1', 2, 0, 1),
(8, 'Finding Inner Strength', '2023-06-09', 'Faced a challenge today that pushed me out of my comfort zone. Despite the initial fear, I tapped into my inner strength and embraced the opportunity for growth. Proud of myself for taking the leap', 'unpublished', '1', 2, 1, 4),
(2, 'Reflections on a Productive Day', '2023-06-09', '\r\nToday was a productive day, despite the challenges. I woke up early, feeling motivated and ready to tackle my tasks. I started by organizing my workspace, decluttering my desk, and creating a to-do list for the day.\r\n\r\nThroughout the day, I focused on completing one task at a time, staying focused and avoiding distractions. I made progress on a project that has been lingering for a while, and it felt great to finally see it coming together.\r\n\r\nIn the afternoon, I took short breaks to recharge and clear my mind. I went for a walk outside and practiced deep breathing exercises. These moments of mindfulness helped me maintain my energy and stay focused.\r\n\r\nBy the end of the day, I had accomplished most of my tasks. I felt a sense of satisfaction and fulfillment, knowing that I had made the most of my time and efforts. It\'s days like these that remind me of my capabilities and motivate me to keep pushing forward.\r\n\r\nDespite the occasional setbacks and moments of self-doubt, I am grateful for days like today. They serve as a reminder that with determination and a positive mindset, I can overcome any challenges and achieve my goals.\r\n\r\nLooking forward to more productive days ahead!', 'published', '1', 2, 0, 1),
(3, 'Morning Reflections', '2023-06-09', 'Today, I woke up feeling grateful for the new day ahead. I spent some time meditating and setting positive intentions for the day. Excited to see what unfolds!', 'unpublished', '1', 3, 0, 1),
(4, 'Nature\'s Beauty', '2023-06-09', 'Took a walk in the park today and marveled at the beauty of nature. The colorful flowers and chirping birds instantly lifted my spirits. Grateful for moments of tranquility.', 'published', '1', 1, 0, 2),
(5, 'A Moment of Joy', '2023-06-09', 'Had a heartwarming conversation with a loved one today. Their words of encouragement and support brought tears of joy to my eyes. Feeling blessed to have such amazing people in my life', 'unpublished', '1', 0, 0, 2),
(6, 'Self-Care Saturday', '2023-06-09', 'Dedicated today to self-care. Indulged in a bubble bath, read my favorite book, and treated myself to a delicious homemade meal. Taking time for self-nurturing is truly rejuvenating.', 'published', '1', 1, 1, 3),
(7, 'Gratitude', '2023-06-09', 'Today, I am grateful for the simple pleasures in life - a warm cup of coffee, a sunny day, and laughter shared with friends. Gratitude fills my heart with joy and contentment.', 'unpublished', '1', 2, 0, 3),
(9, 'Acts of Kindness', '2023-06-09', 'Spread kindness today by helping a stranger carry their groceries, offering a listening ear to a friend in need, and leaving positive notes for coworkers. Small acts of kindness create ripples of positivity', 'unpublished', '1', 0, 1, 4),
(10, 'Embracing Imperfection', '2023-06-09', 'Realized that imperfection is a beautiful part of being human. Instead of striving for perfection, I embraced my flaws and celebrated my unique journey. Embracing imperfection is liberating', 'unpublished', '1', 2, 0, 4);

-- --------------------------------------------------------

--
-- Table structure for table `likes`
--

DROP TABLE IF EXISTS `likes`;
CREATE TABLE IF NOT EXISTS `likes` (
  `id_mb` int NOT NULL,
  `id_jr` int NOT NULL,
  PRIMARY KEY (`id_mb`,`id_jr`),
  KEY `id_jr` (`id_jr`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `likes`
--

INSERT INTO `likes` (`id_mb`, `id_jr`) VALUES
(1, 1),
(1, 2),
(1, 3),
(1, 4),
(1, 6),
(1, 7),
(1, 8),
(1, 10),
(2, 7),
(2, 8),
(3, 1),
(3, 3),
(3, 10);

-- --------------------------------------------------------

--
-- Table structure for table `members`
--

DROP TABLE IF EXISTS `members`;
CREATE TABLE IF NOT EXISTS `members` (
  `id_mb` int NOT NULL AUTO_INCREMENT,
  `mb_name` varchar(50) DEFAULT NULL,
  `mb_last_name` varchar(50) DEFAULT NULL,
  `mb_birth` date DEFAULT NULL,
  `mb_gender` varchar(50) DEFAULT NULL,
  `mb_email` varchar(50) DEFAULT NULL,
  `mb_pswrd` varchar(255) DEFAULT NULL,
  `mb_score` int DEFAULT NULL,
  `is_blocked` bit(1) DEFAULT NULL,
  `cmp_date` date NOT NULL,
  `id_plan` int NOT NULL,
  PRIMARY KEY (`id_mb`),
  KEY `id_plan` (`id_plan`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `members`
--

INSERT INTO `members` (`id_mb`, `mb_name`, `mb_last_name`, `mb_birth`, `mb_gender`, `mb_email`, `mb_pswrd`, `mb_score`, `is_blocked`, `cmp_date`, `id_plan`) VALUES
(1, 'hiba', 'trifi', '2023-06-02', 'male', 'trifi.hiba.solicode@gmail.com', '$2y$10$ZVuDANjSlSHRcqq2UYpOsue7nh8XQag3TMhmark5oCAe.FVauxxGm', 44, b'1', '2023-06-08', 2),
(2, 'user ', 'two', '2023-05-29', 'male', 'user2@gmail.com', '$2y$10$RkIqhATvIMAvdHZ1aQNEyu5fNewf2s99wXXoJ0Tnme./xAK627W2G', 100, b'1', '2023-06-09', 3),
(3, 'user', 'three', '2023-05-30', 'female', 'user3@gmail.com', '$2y$10$sBarhTkmlWb9.TGNf/CjJO2a.tM/WHMT4VQ8tyr1z/ZAnq1tw8pWq', 60, b'1', '2023-06-09', 2),
(4, 'user', 'four', '2021-06-09', 'prefer_not_to_say', 'user4@gmail.com', '$2y$10$RIyfwGyFPyoz0EPb4hFNveIBIv5tFuDw0Ws9tSmEgiGBa./UCAH/m', 48, b'1', '2023-06-09', 2);

-- --------------------------------------------------------

--
-- Table structure for table `plan`
--

DROP TABLE IF EXISTS `plan`;
CREATE TABLE IF NOT EXISTS `plan` (
  `id_plan` int NOT NULL,
  `pl_name` varchar(50) DEFAULT NULL,
  `pl_introduction` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `pl_state` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id_plan`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `plan`
--

INSERT INTO `plan` (`id_plan`, `pl_name`, `pl_introduction`, `pl_state`) VALUES
(1, 'Thrive and Flourish', 'Designed to empower you on your journey towards optimal well-being. This plan is carefully crafted to support individuals in nurturing their mental health and building a foundation for lasting resilience. Remember, your well-being is a top priority, and b', NULL),
(2, 'Empowerment Pathway', 'Congratulations on choosing the Empowerment Pathway! This plan is designed for those seeking to take their well-being to the next level. Here, we will delve deeper into practices that promote emotional balance, personal growth, and self-discovery. Each ta', NULL),
(3, 'Thriving Radiance', 'Welcome to Thriving Radiance, where we embark on an extraordinary journey of self-discovery and personal transformation. This plan is tailored for individuals who are ready to embrace their full potential and radiate resilience, joy, and purpose. Within e', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `save`
--

DROP TABLE IF EXISTS `save`;
CREATE TABLE IF NOT EXISTS `save` (
  `id_mb` int NOT NULL,
  `id_jr` int NOT NULL,
  PRIMARY KEY (`id_mb`,`id_jr`),
  KEY `id_jr` (`id_jr`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `save`
--

INSERT INTO `save` (`id_mb`, `id_jr`) VALUES
(1, 6),
(1, 8),
(1, 9);

-- --------------------------------------------------------

--
-- Table structure for table `tasks`
--

DROP TABLE IF EXISTS `tasks`;
CREATE TABLE IF NOT EXISTS `tasks` (
  `id_tsk` int NOT NULL AUTO_INCREMENT,
  `tsk_task` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `tsk_description` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `id_plan` int NOT NULL,
  PRIMARY KEY (`id_tsk`),
  KEY `id_plan` (`id_plan`)
) ENGINE=MyISAM AUTO_INCREMENT=91 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `tasks`
--

INSERT INTO `tasks` (`id_tsk`, `tsk_task`, `tsk_description`, `id_plan`) VALUES
(74, 'Repeat positive affirmations to yourself for 5 minutes.', 'Harness the power of positive self-talk for increased self-belief.', 2),
(73, 'Read a book or take an online course on a topic of interest for 30 minutes.', 'Expand your knowledge and explore new ideas through reading or learning online.', 2),
(72, 'Write in your journal for 15 minutes, exploring your thoughts and emotions.', 'Gain self-insight and emotional clarity through journaling.', 2),
(71, 'Practice a 10-minute guided meditation session.', 'Cultivate mindfulness and inner calm through guided meditation.', 2),
(70, 'Research and schedule an appointment with a therapist or counselor.', 'Take a step towards seeking professional support for your well-being.', 1),
(69, 'Identify and challenge one negative thought with a positive affirmation.', 'Build a positive mindset by challenging negative thoughts.', 1),
(68, 'Set a small achievable goal for the day and accomplish it.', 'Boost motivation and confidence by setting and achieving goals.', 1),
(67, 'Call or video chat with a loved one for at least 15 minutes.', 'Strengthen connections and social support through meaningful conversations.', 1),
(66, 'Take a relaxing bath or practice a mindfulness exercise.', 'Relax and unwind through self-care and mindfulness practices.', 1),
(65, 'Spend 30 minutes engaging in a creative hobby or activity.', 'Nurture your creativity and find joy in artistic expression.', 1),
(64, 'Write down three things you\'re grateful for today.', 'Cultivate gratitude by acknowledging the positives in your life.', 1),
(63, 'Create a bedtime routine and stick to it for a week.', 'Establish healthy sleep habits for improved well-being.', 1),
(62, 'Go for a 30-minute brisk walk or engage in any other physical activity.', 'Boost your energy and mood with physical exercise.', 1),
(61, 'Complete a 10-minute guided meditation session.', 'Practice mindfulness through guided meditation.', 1),
(75, 'Engage in a 30-minute workout or physical activity.', 'Energize your body and mind with regular physical exercise.', 2),
(76, 'Practice deep breathing exercises for 10 minutes to reduce stress.', 'Relieve stress and promote relaxation through deep breathing techniques.', 2),
(77, 'Express your needs and boundaries assertively in a specific situation.', 'Develop assertiveness skills to communicate effectively and honor your boundaries.', 2),
(78, 'Perform an act of kindness or volunteer for a cause you care about.', 'Spread positivity and contribute to the well-being of others through acts of kindness.', 2),
(79, 'Reflect on your personal growth journey for 20 minutes.', 'Take time to reflect on your progress and personal development.', 2),
(80, 'Practice self-compassion and forgiveness towards yourself and others.', 'Cultivate self-compassion and let go of resentment through forgiveness.', 2),
(81, 'Engage in a 15-minute meditation session focusing on self-awareness.', 'Deepen your self-awareness and inner connection through meditation.', 3),
(82, 'Create a vision board representing your goals and aspirations.', 'Visualize and manifest your dreams by creating a vision board.', 3),
(83, 'Complete a challenging workout or physical activity for 45 minutes.', 'Push your limits and boost your physical fitness with a challenging workout.', 3),
(84, 'Practice a relaxation technique of your choice for 20 minutes.', 'Relax your mind and body through a chosen relaxation technique.', 3),
(85, 'Connect with a supportive friend or mentor for a meaningful conversation.', 'Seek support and guidance from a trusted friend or mentor.', 3),
(86, 'Engage in a self-care activity that makes you feel nurtured and pampered.', 'Prioritize self-care and indulge in activities that bring you joy and relaxation.', 3),
(87, 'Practice assertiveness by expressing your needs in a difficult situation.', 'Communicate your needs confidently and assertively in challenging circumstances.', 3),
(88, 'Engage in a volunteer activity that aligns with your passions and values.', 'Contribute to a cause you care about through volunteering.', 3),
(89, 'Reflect on your achievements and areas of growth for 30 minutes.', 'Celebrate your accomplishments and identify areas for personal growth.', 3),
(90, 'Write a letter of gratitude to someone who has positively influenced your life.', 'Express gratitude and appreciation to someone who has made a positive impact on your life.', 3);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
