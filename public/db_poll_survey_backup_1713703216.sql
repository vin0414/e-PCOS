

CREATE TABLE `tblaccount` (
  `accountID` int(11) NOT NULL AUTO_INCREMENT,
  `EmailAddress` varchar(255) DEFAULT NULL,
  `Password` varchar(255) DEFAULT NULL,
  `Fullname` varchar(45) DEFAULT NULL,
  `Status` int(11) DEFAULT NULL,
  `Role` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`accountID`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

INSERT INTO tblaccount VALUES("1","vinmogate@gmail.com","$2y$10$HJ4mi5vC0v8aj2kG5I0NeeBFPLo4uH8X15yt9eo9nDlAtmK5XRFUe","Administrator","1","Administrator");
INSERT INTO tblaccount VALUES("2","juan.delacruz@gmail.com","$2y$10$us29sJH.kT8kHBlKc6rWr.CQYmmTQxZ6ELA1qcJLJOTLnVnfMJdbC","Juan Dela Cruz","1","Standard User");



CREATE TABLE `tblblogs` (
  `blogsID` int(11) NOT NULL AUTO_INCREMENT,
  `Title` varchar(255) DEFAULT NULL,
  `Details` longtext,
  `accountID` int(11) DEFAULT NULL,
  `Date` varchar(45) DEFAULT NULL,
  `Image` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`blogsID`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

INSERT INTO tblblogs VALUES("1","Quick Brown Fox","There are times when I just want to look at your face
With the stars in the night
There are times when I just want to feel your embrace
In the cold night
I just cant believe that you are mine now
You were just a dream that I once knew
I never thought I would be right for you
I just cant compare you with anything in this world
You're all I need to be with forevermore
All those years, I've longed to hold you in my arms
I've been dreaming of you
Every night, I've been watching all the stars that fall down
Wishing you would be mine
I just cant believe that you are mine now
You were just a dream that I once knew
I never thought I would be right for you
I just cant compare you with anything in this world
You're all I need to be with forevermore
Time and again
There are these changes that we cannot end
As sure as time keeps going on and on
My love for you will be forevermore
Wishing you would be mine
I just cant believe that you are mine now
You were just a dream that I once knew
I never thought I would be right for you
I just cant compare you with anything in this world
As endless as forever
Our love will stay together
You're all I need to be with forever more
(As endless as forever
our love will stay together)
You're all I need
To be with forevermore...","1","2024-04-21","Mascot-03.png");
INSERT INTO tblblogs VALUES("2","Web Development Languages","List of programming languages for creating website:
PHP,
JavaScript
Java
HTML
CSS","1","2024-04-21","Mascot-03.png");



CREATE TABLE `tblchoice` (
  `choiceID` int(11) NOT NULL AUTO_INCREMENT,
  `questionID` int(11) DEFAULT NULL,
  `Details` longtext,
  PRIMARY KEY (`choiceID`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

INSERT INTO tblchoice VALUES("1","1","I'm doing completely okay.");
INSERT INTO tblchoice VALUES("2","1","Nothing exceptional, just ok.");
INSERT INTO tblchoice VALUES("3","1","Really, not that good. It was not particularly good.");
INSERT INTO tblchoice VALUES("4","2","Yes, I am getting 3-7 days of bleeding every month.");
INSERT INTO tblchoice VALUES("5","2","No, I get 21 - 35 days period");
INSERT INTO tblchoice VALUES("6","2","No, I have missed three months or more in a row.");
INSERT INTO tblchoice VALUES("7","3","Yes, it is really evident or obvious. ");
INSERT INTO tblchoice VALUES("8","3","No, I don’t have excessive hair in these areas.");
INSERT INTO tblchoice VALUES("9","3","Yes, but mostly excessive in one area only.");



CREATE TABLE `tblcustomer` (
  `customerID` int(11) NOT NULL AUTO_INCREMENT,
  `EmailAddress` varchar(255) DEFAULT NULL,
  `Password` varchar(255) DEFAULT NULL,
  `Fullname` varchar(45) DEFAULT NULL,
  `Status` int(11) DEFAULT NULL,
  `Token` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`customerID`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

INSERT INTO tblcustomer VALUES("1","vinmogate@gmail.com","$2y$10$l25qvNGQpV.NxNpxJQtIFOw1ZpFg8YM7rbavK4fYjHuwur6tgVUdO","Warvin B Mogate","1","fHUceOg7FY0Xn8vZ4o2K");



CREATE TABLE `tblcustomerinfo` (
  `infoID` int(11) NOT NULL AUTO_INCREMENT,
  `customerID` int(11) DEFAULT NULL,
  `Age` varchar(45) DEFAULT NULL,
  `Location` varchar(255) DEFAULT NULL,
  `Date` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`infoID`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

INSERT INTO tblcustomerinfo VALUES("1","1","33","near Salitran, Salitran, Dasmarinas","2024-04-20");
INSERT INTO tblcustomerinfo VALUES("2","1","25","near Bagong Bayan, Dasmarinas V, Dasmarinas","2024-04-21");



CREATE TABLE `tbldoctors` (
  `doctorID` int(11) NOT NULL AUTO_INCREMENT,
  `Name` varchar(45) DEFAULT NULL,
  `Specialty` varchar(45) DEFAULT NULL,
  `Contact` varchar(45) DEFAULT NULL,
  `Image` varchar(45) DEFAULT NULL,
  `Status` int(11) DEFAULT NULL,
  PRIMARY KEY (`doctorID`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

INSERT INTO tbldoctors VALUES("1","Juan Dela Cruz MD","Obgyne","09876123123","Mascot-03.png","1");



CREATE TABLE `tblinquiry` (
  `inquiryID` int(11) NOT NULL AUTO_INCREMENT,
  `DateTime` varchar(45) DEFAULT NULL,
  `Name` varchar(45) DEFAULT NULL,
  `Email` varchar(45) DEFAULT NULL,
  `Subject` varchar(45) DEFAULT NULL,
  `Message` longtext,
  `Status` int(11) DEFAULT NULL,
  PRIMARY KEY (`inquiryID`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

INSERT INTO tblinquiry VALUES("1","","Warvin B Mogate","vinmogate@gmail.com","Test","sample here","1");
INSERT INTO tblinquiry VALUES("2","","Warvin B Mogate","vinmogate@gmail.com","Renewal of domain and hosting","sample of message here","1");
INSERT INTO tblinquiry VALUES("3","2024-04-09 11:56:23 am","Juan Dela Cruz MD","vinmogate@gmail.com","Test","Test Message","1");



CREATE TABLE `tbllogs` (
  `logID` int(11) NOT NULL AUTO_INCREMENT,
  `accountID` int(11) DEFAULT NULL,
  `Date` varchar(45) DEFAULT NULL,
  `Time` varchar(45) DEFAULT NULL,
  `Activities` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`logID`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;

INSERT INTO tbllogs VALUES("1","1","2024-04-21","02:04:47 pm","Logged On");
INSERT INTO tbllogs VALUES("2","1","2024-04-21","02:04:04 pm","Tag as Done/Completed");
INSERT INTO tbllogs VALUES("3","1","2024-04-21","02:04:19 pm","Reset password");
INSERT INTO tbllogs VALUES("4","1","2024-04-21","02:04:29 pm","Deactivated selected account");
INSERT INTO tbllogs VALUES("5","1","2024-04-21","02:04:09 pm","Activated selected account");
INSERT INTO tbllogs VALUES("6","1","2024-04-21","02:04:26 pm","Update the selected Blog");
INSERT INTO tbllogs VALUES("7","1","2024-04-21","02:04:38 pm","Update the selected Blog");
INSERT INTO tbllogs VALUES("8","1","2024-04-21","03:04:30 pm","Logged Out");
INSERT INTO tbllogs VALUES("9","1","2024-04-21","05:04:14 pm","Logged On");
INSERT INTO tbllogs VALUES("10","1","2024-04-21","05:04:06 pm","Logged Out");
INSERT INTO tbllogs VALUES("11","1","2024-04-21","07:04:05 pm","Logged On");



CREATE TABLE `tblquestion` (
  `questionID` int(11) NOT NULL AUTO_INCREMENT,
  `surveyID` int(11) DEFAULT NULL,
  `Sequence` varchar(45) DEFAULT NULL,
  `Question` longtext,
  `Date` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`questionID`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

INSERT INTO tblquestion VALUES("1","1","Question 1","How did your day go?","2024-04-20");
INSERT INTO tblquestion VALUES("2","1","Question 2","Do you get normal menstrual cycle?","2024-04-20");
INSERT INTO tblquestion VALUES("3","1","Question 3","Do you have excessive hair on your face, legs,back, and arms?","2024-04-20");



CREATE TABLE `tblrecords` (
  `recordID` int(11) NOT NULL AUTO_INCREMENT,
  `customerID` int(11) DEFAULT NULL,
  `questionID` int(11) DEFAULT NULL,
  `choiceID` int(11) DEFAULT NULL,
  `surveyID` int(11) DEFAULT NULL,
  `Date` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`recordID`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

INSERT INTO tblrecords VALUES("1","1","1","1","1","2024-04-20");
INSERT INTO tblrecords VALUES("2","1","2","4","1","2024-04-20");
INSERT INTO tblrecords VALUES("3","1","3","8","1","2024-04-20");
INSERT INTO tblrecords VALUES("4","1","1","2","1","2024-04-21");
INSERT INTO tblrecords VALUES("5","1","2","4","1","2024-04-21");
INSERT INTO tblrecords VALUES("6","1","3","8","1","2024-04-21");



CREATE TABLE `tblreservation` (
  `reservationID` int(11) NOT NULL AUTO_INCREMENT,
  `Date` varchar(45) DEFAULT NULL,
  `Time` varchar(45) DEFAULT NULL,
  `Event_Name` varchar(255) DEFAULT NULL,
  `Surname` varchar(255) DEFAULT NULL,
  `Firstname` varchar(45) DEFAULT NULL,
  `MiddleName` varchar(45) DEFAULT NULL,
  `Suffix` varchar(45) DEFAULT NULL,
  `Contact` varchar(45) DEFAULT NULL,
  `BirthDate` varchar(45) DEFAULT NULL,
  `Gender` varchar(45) DEFAULT NULL,
  `Address` longtext,
  `Status` int(11) DEFAULT NULL,
  `customerID` int(11) DEFAULT NULL,
  PRIMARY KEY (`reservationID`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

INSERT INTO tblreservation VALUES("1","2024-04-10","02:00 PM","Obstetrics and Gynecology","Mogate","Warvin","B","","09876542312","1990-04-14","Male","Sample Address","3","1");
INSERT INTO tblreservation VALUES("2","2024-04-10","10:00 AM","Obstetrics and Gynecology","Mogate","Warvin","B","","09876543212","1990-04-14","Male","Dasmarinas Cavite","3","1");
INSERT INTO tblreservation VALUES("3","2024-04-10","08:00 AM","Gynecology","Dela Cruz","Josefa","P","","09873223432","1995-10-12","Female","Sample address here","3","1");
INSERT INTO tblreservation VALUES("4","2024-04-11","10:00 AM","Obstetrics","Antonio","Juanita","S","","09871231312","1986-12-25","Female","sample address","3","0");



CREATE TABLE `tblsurvey` (
  `surveyID` int(11) NOT NULL AUTO_INCREMENT,
  `Title` varchar(45) DEFAULT NULL,
  `Details` longtext,
  `Type_Survey` varchar(45) DEFAULT NULL,
  `Status` int(11) DEFAULT NULL,
  PRIMARY KEY (`surveyID`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

INSERT INTO tblsurvey VALUES("1","Sample Title","Sample here","Multiple Choice","1");
INSERT INTO tblsurvey VALUES("2","Sample new Title","N/A","Ranking Poll","0");

