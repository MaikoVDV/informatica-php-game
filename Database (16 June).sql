-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jun 16, 2023 at 06:26 PM
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
-- Database: `informatica-site`
--

-- --------------------------------------------------------

--
-- Table structure for table `current_games`
--

CREATE TABLE `current_games` (
  `join_code` int(8) NOT NULL,
  `host_user` int(11) NOT NULL,
  `access_group` text NOT NULL DEFAULT 'public',
  `question_category` int(11) NOT NULL,
  `game_state` text NOT NULL DEFAULT 'Lobby',
  `current_question` smallint(6) NOT NULL DEFAULT 0
) ;

--
-- Dumping data for table `current_games`
--

INSERT INTO `current_games` (`join_code`, `host_user`, `access_group`, `question_category`, `game_state`, `current_question`) VALUES
(656208, 1, 'Multiplayer', 1, 'Game', 0),
(705990, 4, 'Multiplayer', 1, 'Game', 1),
(761582, 2, 'Multiplayer', 1, 'Game', 0);

-- --------------------------------------------------------

--
-- Table structure for table `posted_messages`
--

CREATE TABLE `posted_messages` (
  `content` text NOT NULL,
  `author_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `posted_messages`
--

INSERT INTO `posted_messages` (`content`, `author_id`) VALUES
('uwusindefuthills of the himalayas with kim yeoung un', 2),
('gaming', 1),
('we did it joe!!!!', 3),
('uwu *sniffs your hair*', 2),
('Google \"obama kunduz hospital\"', 4),
('Good evening, everyone.  Just a few days ago, a little before 2:30 a.m. in the morning, a man smashed the back windows and broke into the home of the speaker of the House of Representatives, the third-highest-ranking official in America. He carried in his backpack zip ties, duct tape, rope and a hammer.  As he told the police, he had come looking for Nancy Pelosi to take her hostage, to interrogate her, to threaten to break her kneecaps. But she wasn’t there. Her husband, my friend Paul Pelosi, was home alone. The assailant tried to take Paul hostage. He woke him up, and he wanted to tie him up. The assailant ended up using a hammer to smash Paul’s skull. Thankfully, by the grace of God, Paul survived.  All this happened after the assault, and it just — it’s hard to even say. It’s hard to even say. After the assailant entered the home asking: “Where’s Nancy? Where’s Nancy?” Those are the very same words used by the mob when they stormed the United States Capitol on January the 6th, when they broke windows, kicked in the doors, brutally attacked law enforcement, roamed the corridors hunting for officials and erected gallows to hang the former vice president, Mike Pence.  It was an enraged mob that had been whipped up into a frenzy by a president repeating over and over again the Big Lie, that the election of 2020 had been stolen. It’s a lie that fueled the dangerous rise in political violence and voter intimidation over the past two years.  Even before January the 6th, we saw election officials and election workers in a number of states subject to menacing calls, physical threats, even threats to their very lives. In Georgia, for example, the Republican secretary of state and his family were subjected to death threats because he refused to break the law and give into the defeated president’s demand: Just find him 11,780 votes. Just find me 11,780 votes.  Election workers, like Shaye Moss and her mother, Ruby Freeman, were harassed and threatened just because they had the courage to do their job and stand up for the truth, to stand up for our democracy. This institution, this intimidation, this violence against Democrats, Republicans and nonpartisan officials just doing their jobs, are the consequence of lies told for power and profit, lies of conspiracy and malice, lies repeated over and over to generate a cycle of anger, hate, vitriol and even violence.  In this moment, we have to confront those lies with the truth. The very future of our nation depends on it. My fellow Americans, we’re facing a defining moment, an inflection point. We must with one overwhelming unified voice speak as a country and say there’s no place, no place for voter intimidation or political violence in America. Whether it’s directed at Democrats or Republicans. No place, period. No place ever.  I speak today near Capitol Hill, near the U.S. Capitol, the citadel of our democracy. I know there’s a lot at stake in these midterm elections, from our economy, to the safety of our streets, to our personal freedoms, to the future of health care and Social Security, Medicare. It’s all important. But we’ll have our differences, we’ll have our difference of opinion. And that’s what it’s supposed to be.  But there’s something else at stake, democracy itself. I’m not the only one who sees it. Recent polls have shown an overwhelming majority of Americans believe our democracy is at risk, that our democracy is under threat. They too see that democracy is on the ballot this year, and they’re deeply concerned about it.  So today, I appeal to all Americans, regardless of party, to meet this moment of national and generational importance. We must vote knowing what’s at stake and not just the policy of the moment, but institutions that have held us together as we’ve sought a more perfect union are also at stake. We must vote knowing who we have been, what we’re at risk of becoming.  Look, my fellow Americans, the old expression, “Freedom is not free,” it requires constant vigilance. From the very beginning, nothing has been guaranteed about democracy in America. Every generation has had to defend it, protect it, preserve it, choose it. For that’s what democracy is. It’s a choice, a decision of the people, by the people and for the people. The issue couldn’t be clearer, in my view.  We the people must decide whether we will have fair and free elections, and every vote counts. We the people must decide whether we’re going to sustain a republic, where reality’s accepted, the law is obeyed and your vote is truly sacred.  We the people must decide whether the rule of law will prevail or whether we will allow the dark forces and thirst for power put ahead of the principles that have long guided us.  You know, American democracy is under attack because the defeated former president of the United States refused to accept the results of the 2020 election. If he refuses to accept the will of the people, if he refuses to accept the fact that he lost, he’s abused his power and put the loyalty to himself before loyalty to the Constitution. And he’s made a big lie an article of faith in the MAGA Republican Party, the minority of that party.  The great irony about the 2020 election is that it’s the most attacked election in our history. And, yet, there’s no election in our history that we can be more certain of its results. Every legal challenge that could have been brought was brought. Every recount that could have been undertaken was undertaken. Every recount confirmed the results. Wherever fact or evidence had been demanded, the Big Lie has been proven to be just that, a big lie. Every single time.  Yet now extreme MAGA Republicans aim to question not only the legitimacy of past elections, but elections being held now and into the future. The extreme MAGA element of the Republican Party, which is a minority of that party, as I said earlier, but it’s its driving force. It’s trying to succeed where they failed in 2020, to suppress the right of voters and subvert the electoral system itself. That means denying your right to vote and deciding whether your vote even counts.  Instead of waiting until an election is over, they’re starting well before it. They’re starting now. They’ve emboldened violence and intimidation of voters and election officials. It’s estimated that there are more than 300 election deniers on the ballot all across America this year. We can’t ignore the impact this is having on our country. It’s damaging, it’s corrosive and it’s destructive.  And I want to be very clear, this is not about me, it’s about all of us. It’s about what makes America America. It’s about the durability of our democracy. For democracies are more than a form of government. They’re a way of being, a way of seeing the world, a way that defines who we are, what we believe, why we do what we do. Democracy is simply that fundamental.  We must, in this moment, dig deep within ourselves and recognize that we can’t take democracy for granted any longer. With democracy on the ballot, we have to remember these first principles. Democracy means the rule of the people, not the rule of monarchs or the moneyed, but the rule of the people.  Autocracy is the opposite of democracy. It means the rule of one, one person, one interest, one ideology, one party. To state the obvious, the lives of billions of people, from antiquity till now, have been shaped by the battle between these competing forces, between the aspirations of the many and the greed and power of the few, between the people’s right for self-determination, and the self-seeking autocrat, between the dreams of a democracy and the appetites of an autocracy.  What we’re doing now is going to determine whether democracy will long endure and, in my view, is the biggest of questions, whether the American system that prizes the individual bends toward justice and depends on the rule of law, whether that system will prevail. This is the struggle we’re now in, a struggle for democracy, a struggle for decency and dignity, a struggle for prosperity and progress, a struggle for the very soul of America itself.  Make no mistake, democracy is on the ballot for all of us. We must remember that democracy is a covenant. We need to start looking out for each other again, seeing ourselves as we the people, not as entrenched enemies. This is a choice we can make. Disunion and chaos are not inevitable. There’s been anger before in America. There’s been division before in America. But we’ve never given up on the American experiment. And we can’t do that now.  The remarkable thing about American democracy is this. Just enough of us on just enough occasions have chosen not to dismantle democracy, but to preserve democracy. We must choose that path again. Because democracy is on the ballot, we have to remember that even in our darkest moments, there are fundamental values and beliefs that unite us as Americans, and they must unite us now.  What are they? Well, I think, first, we believe the vote in America’s sacred, to be honored, not denied; respected, not dismissed; counted, not ignored. A vote is not a partisan tool, to be counted when it helps your candidates and tossed aside when it doesn’t. Second, we must, with an overwhelming voice, stand against political violence and voter intimidation, period. Stand up and speak against it.  We don’t settle our differences, America, with a riot, a mob, or a bullet, or a hammer. We settle them peacefully at the ballot box. We have to be honest with ourselves, though. We have to face this problem. We can’t turn away from it. We can’t pretend it’s just going to solve itself.  There’s an alarming rise in the number of our people in this country condoning political violence, or simply remaining silent, because silence is complicity. To the disturbing rise of voter intimidation, the pernicious tendency to excuse political violence or at least, at least trying to explain it away. We can’t allow this sentiment to grow. We must confront it head on now. It has to stop now.  I believe the voices excusing or calling for violence and intimidation are a distinct minority in America. But they’re loud, and they are determined. We have to be more determined. All of us who reject political violence and voter intimidation, and I believe that’s the overwhelming majority of the American people, all of us must unite to make it absolutely clear that violence and intimidation have no place in America.  And, third, we believe in democracy. That’s who we are as Americans. I know it isn’t easy. Democracy’s imperfect. It always has been. But you’re all called to defend it now, now. History and common sense tell us that liberty, opportunity and justice thrive in a democracy, not in an autocracy.  At our best, America’s not a zero-sum society or for you to succeed, someone else has to fail. A promise in America is big enough, is big enough, for everyone to succeed. Every generation opening the door of opportunity just a little bit wider. Every generation including those who’ve been excluded before.  We believe we should leave no one behind, because each one of us is a child of God, and every person, every person is sacred. If that’s true, then every person’s rights must be sacred as well. Individual dignity, individual worth, individual determination, that’s America, that’s democracy and that’s what we have to defend.  Look, even as I speak here tonight, 27 million people have already cast their ballot in the midterm elections. Millions more will cast their ballots in the final days leading up to November the 9th — 8th, excuse me. And for the first time — this is the first time since the national election of 2020.  Once again we’re seeing record turnout all over the country. And that’s good. We want Americans to vote. We want every American’s voice to be heard. Now we have to move the process forward. We know that more and more ballots are cast in early voting or by mail in America. We know that many states don’t start counting those ballots till after the polls close on Nov. 8.  That means in some cases we won’t know the winner of the election for a few days — until a few days after the election. It takes time to count all legitimate ballots in a legal and orderly manner. It’s always been important for citizens in the democracy to be informed and engaged. Now it’s important for a citizen to be patient as well. That’s how this is supposed to work.  This is also the first election since the events of Jan. 6 when the armed, angry mob stormed the U.S. Capitol. I wish I could say the assault on our democracy ended that day, but I cannot.  As I stand here today, there are candidates running for every level of office in America — for governor, Congress, attorney general, secretary of state — who won’t commit, that will not commit to accepting the results of the election that they’re running in. This is a path to chaos in America. It’s unprecedented. It’s unlawful, and it’s un-American.  As I’ve said before, you can’t love your country only when you win. This is no ordinary year. So I ask you to think long and hard about the moment we’re in. In a typical year, we’re often not faced with questions of whether the vote we cast will preserve democracy or put us at risk. But this year we are. This year I hope you’ll make the future of our democracy an important part of your decision to vote and how you vote.  I hope you’ll ask a simple question of each candidate you might vote for. Will that person accept the legitimate will of the American people and the people voting in his district or her district? Will that person accept the outcome of the election, win or lose? The answer to that question is vital. And, in my opinion, it should be decisive. And the answer to that question hangs in the future of the country we love so much, and the fate of the democracy that has made so much possible for us.  Too many people have sacrificed too much for too many years for us to walk away from the American project and democracy. Because we’ve enjoyed our freedoms for so long, it’s easy to think they’ll always be with us no matter what. But that isn’t true today. In our bones, we know democracy is at risk. But we also know this. It’s within our power, each and every one of us, to preserve our democracy.  And I believe we will. I think I know this country. I know we will. You have the power, it’s your choice, it’s your decision, the fate of the nation, the fate of the soul of America lies where it always does, with the people, in your hands, in your heart, in your ballot.  My fellow Americans, we’ll meet this moment. We just need to remember who we are. We are the United States of America. There’s nothing, nothing beyond our capacity if we do it together.  May God bless you all. May God protect our troops. May God bless those standing guard over our democracy. Thank you, and godspeed.', 2),
('hallo', 5);

-- --------------------------------------------------------

--
-- Table structure for table `questions`
--

CREATE TABLE `questions` (
  `id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `title` text NOT NULL,
  `sub_title` text DEFAULT NULL,
  `correct_answer` tinyint(4) NOT NULL,
  `answer_1` text NOT NULL,
  `answer_2` text NOT NULL,
  `answer_3` text DEFAULT NULL,
  `answer_4` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `questions`
--

INSERT INTO `questions` (`id`, `category_id`, `title`, `sub_title`, `correct_answer`, `answer_1`, `answer_2`, `answer_3`, `answer_4`) VALUES
(1, 1, 'What color is a blue whale?', 'I\'m talking about the color of their skin. Not that that matters or something; I\'m not racist.', 1, 'Blue', 'Red', 'Brown', 'Piss-Yellow'),
(2, 1, 'What sound do foxes make when they laugh?', NULL, 3, 'tee hee hee, tee hee hee, tee hee hee', 'HAHAHAHAHAHAHA WAT LEUK', 'ghi-ghi-gha-ghi', 'Foxes don\'t laugh'),
(3, 1, 'What animal species ate Amelia Earhart?', 'Hint: She crashed on land.', 2, 'Lobsters', 'Coconut crabs', 'She ate herself to survive', 'Monke'),
(4, 1, 'How many tentacles does an octopus have?', 'Hint: Octo means 8 in Latin', 3, '0', '6', '8', '2');

-- --------------------------------------------------------

--
-- Table structure for table `question_categories`
--

CREATE TABLE `question_categories` (
  `id` int(11) NOT NULL,
  `author_id` int(11) NOT NULL,
  `name` text NOT NULL,
  `description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `question_categories`
--

INSERT INTO `question_categories` (`id`, `author_id`, `name`, `description`) VALUES
(1, 1, 'Animals!!!', 'Questions about animals!!!!!!! Yayyyy :D');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` text NOT NULL,
  `password` text NOT NULL,
  `join_date` date NOT NULL DEFAULT current_timestamp(),
  `current_game` int(11) DEFAULT NULL,
  `selected_answer` text DEFAULT NULL,
  `correct_answers` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `join_date`, `current_game`, `selected_answer`, `correct_answers`) VALUES
(1, 'Maiko', 'welkom2020', '2023-04-20', 656208, NULL, 5),
(2, 'Joe Biden', 'i was in the foothills of the himalayas', '2023-04-20', 656208, NULL, 6),
(3, 'Kamala \"we did it joe\" Harris', 'we did it joe', '2023-04-20', NULL, NULL, 0),
(4, 'Baraggo Bama', 'kunduz', '2023-05-08', 656208, NULL, 0),
(5, 'Niek Mijlinx', '123password!', '2023-05-08', NULL, NULL, 0),
(7, '/', 'JoeBidenIsSexy', '2023-05-15', NULL, NULL, 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `current_games`
--
ALTER TABLE `current_games`
  ADD PRIMARY KEY (`join_code`),
  ADD UNIQUE KEY `Limit lobbies created by user` (`host_user`),
  ADD KEY `Question category foreign key` (`question_category`);

--
-- Indexes for table `posted_messages`
--
ALTER TABLE `posted_messages`
  ADD KEY `Author ID contraint` (`author_id`);

--
-- Indexes for table `questions`
--
ALTER TABLE `questions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `Category ID` (`category_id`);

--
-- Indexes for table `question_categories`
--
ALTER TABLE `question_categories`
  ADD PRIMARY KEY (`id`),
  ADD KEY `Author ID constraint` (`author_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`) USING HASH,
  ADD KEY `Current game foreign key` (`current_game`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `questions`
--
ALTER TABLE `questions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `question_categories`
--
ALTER TABLE `question_categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `current_games`
--
ALTER TABLE `current_games`
  ADD CONSTRAINT `Host user foreign key` FOREIGN KEY (`host_user`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `Question category foreign key` FOREIGN KEY (`question_category`) REFERENCES `question_categories` (`id`);

--
-- Constraints for table `posted_messages`
--
ALTER TABLE `posted_messages`
  ADD CONSTRAINT `Author ID contraint` FOREIGN KEY (`author_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `questions`
--
ALTER TABLE `questions`
  ADD CONSTRAINT `Category ID` FOREIGN KEY (`category_id`) REFERENCES `question_categories` (`id`);

--
-- Constraints for table `question_categories`
--
ALTER TABLE `question_categories`
  ADD CONSTRAINT `Author ID constraint` FOREIGN KEY (`author_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `Current game foreign key` FOREIGN KEY (`current_game`) REFERENCES `current_games` (`join_code`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
