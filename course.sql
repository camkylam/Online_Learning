create database course character set='utf8';
use course;
--
drop database course;
CREATE TABLE `users` (
  `user_id` int(100) NOT NULL primary key AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `image` varchar(100) NOT NULL
);
INSERT INTO `users` (`user_id`, `name`,`email`, `password`, `image`) VALUES
(1, 'CamKy','camky@gmail.com', '123456789', 'pic-2.jpg');
CREATE TABLE `tutors` (
  `tutor_id` int(100)NOT NULL primary key AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `image` varchar(100) NOT NULL
);
INSERT INTO `tutors` (`tutor_id`, `name`,`email`, `password`, `image`) VALUES
(1, 'Admin','admin@gmail.com', '111', 'pic-5.jpg');
CREATE TABLE `playlist` (
  `playlist_id` int(100) NOT NULL primary key AUTO_INCREMENT,
  `tutor_id` int(100) NOT NULL,
  `title` varchar(100) NOT NULL,
  `description` varchar(1000) NOT NULL,
  `thumb` varchar(100) NOT NULL,
  `date` date NOT NULL DEFAULT current_timestamp(),
  `status` varchar(20) NOT NULL DEFAULT 'deactive',
  foreign key (tutor_id) references tutors(tutor_id)
);

CREATE TABLE `content` (
  `content_id` int(100) NOT NULL primary key AUTO_INCREMENT,
  `tutor_id` int(100) NOT NULL,
  `playlist_id` int(100) NOT NULL,
  `title` varchar(100) NOT NULL,
  `description` varchar(1000) NOT NULL,
  `video` varchar(100) NOT NULL,
  `thumb` varchar(100) NOT NULL,
  `date` date NOT NULL DEFAULT current_timestamp(),
  `status` varchar(20) NOT NULL DEFAULT 'deactive',
   foreign key (tutor_id) references tutors(tutor_id),
   foreign key (playlist_id) references playlist(playlist_id)
);

CREATE TABLE `likes` (
  `user_id` int(100)NOT NULL,
  `tutor_id` int(100) NOT NULL,
  `content_id` int(100) NOT NULL
);

CREATE TABLE `contact` (
`id_contact` int(50) NOT NULL primary key AUTO_INCREMENT,
     
  `name` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `number` int(10) NOT NULL,
  `message` varchar(1000) NOT NULL,
    
  
);

CREATE TABLE `comments` (
  `id` int(100) NOT NULL primary key AUTO_INCREMENT,
  `content_id` int(100) NOT NULL,
  `user_id` int(100)NOT NULL,
  `tutor_id` int(100) NOT NULL,
  `comment` varchar(1000) NOT NULL,
  `date` date NOT NULL DEFAULT current_timestamp(),
   foreign key (content_id) references content(content_id),
   foreign key (user_id) references users(user_id),
   foreign key (tutor_id) references tutors(tutor_id)
);

CREATE TABLE `bookmark` (
  `user_id` varchar(20) NOT NULL,
  `playlist_id` varchar(20) NOT NULL
)