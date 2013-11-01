/*
SQLyog Ultimate v9.02 
MySQL - 5.5.20-log : Database - openbooth
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
/*Table structure for table `coupon` */

DROP TABLE IF EXISTS `coupon`;

CREATE TABLE `coupon` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(64) NOT NULL,
  `description` text NOT NULL,
  `code` varchar(64) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `used` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `code` (`code`)
) ENGINE=InnoDB AUTO_INCREMENT=483 DEFAULT CHARSET=latin1;

/*Data for the table `coupon` */

insert  into `coupon`(`id`,`name`,`description`,`code`,`timestamp`,`used`) values (469,'','','855172','2012-11-13 07:27:11',0),(470,'','','200387','2012-12-02 09:54:42',0),(471,'','','849597','2012-12-02 10:08:47',0),(472,'','','301406','2012-12-02 10:08:52',0),(473,'','','384600','2012-12-02 10:08:53',0),(474,'','','269931','2012-12-02 10:08:54',0),(475,'','','244360','2012-12-02 10:10:14',0),(476,'','','761843','2012-12-02 10:11:07',0),(477,'','','678485','2012-12-02 10:11:53',0),(478,'','','184567','2012-12-02 10:14:15',0),(479,'','','895959','2012-12-02 10:14:21',0),(480,'','','517398','2012-12-02 10:18:35',0),(481,'','','640142','2012-12-02 10:37:25',0),(482,'','','389956','2012-12-03 18:06:37',0);

/*Table structure for table `ingredient` */

DROP TABLE IF EXISTS `ingredient`;

CREATE TABLE `ingredient` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `menuItemid` int(11) NOT NULL,
  `name` varchar(64) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `menuItemid` (`menuItemid`),
  CONSTRAINT `ingredient_ibfk_1` FOREIGN KEY (`menuItemid`) REFERENCES `menuitem` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=61 DEFAULT CHARSET=latin1;

/*Data for the table `ingredient` */

insert  into `ingredient`(`id`,`menuItemid`,`name`) values (14,26,'Cherries'),(15,28,'Honey'),(16,28,'Toffee'),(17,28,'Nuts'),(18,29,'Ham'),(19,29,'Swiss Cheese'),(20,29,'Mayonnaise'),(21,30,'Pepperoni'),(22,30,'Mozzarella'),(23,30,'Black Olives'),(24,30,'Pineapple'),(25,31,'Shrimp'),(26,31,'Potatoes'),(27,33,'Peanuts'),(28,33,'Ice Cream'),(29,33,'Chocolate Chunks'),(30,34,'Cream cheese'),(31,34,'Butter'),(32,35,'Garlic'),(33,35,'Fresh Basil'),(34,35,'Pine Nuts'),(35,35,'Lettuce'),(36,42,'Cucumber Slices'),(37,42,'Ice'),(38,42,'Gin'),(39,42,'Vodka'),(40,42,'Lemon Juice'),(41,42,'Worcester Sauce'),(49,43,'Pineapple Juice'),(50,43,'Grenadine'),(51,43,'Carribean Rum'),(52,43,'Cheap Gin'),(53,43,'Olive Juice'),(54,40,'Grenadine'),(55,40,'Menthomint Schnapps'),(56,41,'Vanilla Rum'),(57,41,'Strawberry Rum'),(58,41,'Amaretto'),(59,41,'Strawberry Syrup'),(60,41,'Milk');

/*Table structure for table `menuitem` */

DROP TABLE IF EXISTS `menuitem`;

CREATE TABLE `menuitem` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `price` float NOT NULL,
  `name` varchar(64) NOT NULL,
  `description` text NOT NULL,
  `type` int(11) NOT NULL,
  `calories` int(11) NOT NULL DEFAULT '500',
  `available` tinyint(1) NOT NULL DEFAULT '1',
  `picturepath` varchar(128) NOT NULL,
  `keywords` varchar(128) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=44 DEFAULT CHARSET=latin1;

/*Data for the table `menuitem` */

insert  into `menuitem`(`id`,`price`,`name`,`description`,`type`,`calories`,`available`,`picturepath`,`keywords`) values (26,8,'Portal (The Cake)','Imagine gnawing into a juicy hunk of meat from Golden Axe, or finally tasting a moist slice of that cake GLaDOS keeps promising you. Dedicated Portal fans understand the pain of chasing a cake that you can never quite find. Using a bunch of standard baking ingredients (with cherries and chocolate for a stylish garnish), you can thwart GLaDOS in real life. Extra points if you refrain from making \"the cake is a lie\" jokes.',1,500,1,'26.jpg','Cherries'),(27,5,'Golden Axe (The Meat)','This amorphous hunk o\' meat is made out of chicken, beef and even some sausage for good measure. While preparing the meat, you\'ll have to be extra careful to keep the whole roll in place. No word on whether it will restore your health or just induce vomiting.',0,500,1,'27.jpg',''),(28,7,'Deus Ex (Chunko Honey Candy Bar)','Saccharine treat, blending chocolate, honey, toffee and nuts in what appears to be one hell of a calorie booster.',2,800,1,'28.jpg','Honey, Toffee, Nuts'),(29,10,'Team Fortress 2 (Sandvich)','This quirky-looking sandwich is the quirky-looking health item for Team Fortress 2\'s Heavy. it\'s the perfect meal if you also want to become a Heavy.',2,1200,1,'29.jpg','Ham, Swiss Cheese, Mayonnaise'),(30,6,'Dead Rising (Golden Brown Pizza)','Dare you to stare at this photo for 30 seconds and NOT dial up your local pizzeria for some takeout. But if you\'re looking to craft your own homemade version, we has got you covered.',1,400,1,'30.jpg','Pepperoni, Mozzarella, Black Olives, Pineapple'),(31,5,'Beyond Good & Evil (Starkos)','These unusual pastries are filled with shrimp, potatoes and all sorts of Jamaican spices. Like Jade in Beyond Good & Evil, you can use Starkos to restore the health of you or your companions while adventuring through the dangerous planet of Hillys. Or you could just eat them while watching TV.',0,500,1,'31.jpg','Shrimp, Potatoes'),(32,8,'Minecraft (Cake)','You won\'t need a pickaxe to dig into this block of square cake from Minecraft, the open world sandbox game that stormed the industry last year. It\'s a basic vanilla cake with some red and white frosting, perfect for both eating and fashioning into large statues of Mario.',2,700,1,'32.jpg',''),(33,6,'Costume Quest (Pizza Sundae)','this Pizza Sundae is pretty much what you\'d imagine: a pizza-shaped sundae. It\'s made out of peanuts, biscuits, ice cream, chocolate chunks and all sorts of other delicious ingredients that I\'m sure developer Double Fine already plans to start cooking up in its own kitchens. For extra Costume Quest cred, wear your spaceman outfit while eating this.',0,500,1,'33.jpg','Peanuts, Ice Cream, Chocolate Chunks'),(34,8,'Skyrim (Sweet Roll)','Don\'t let anybody steal this frosting-covered treat, the likes of which you\'ll find all over the snowy mountains of Skyrim. Cream cheese, butter and pastry dough combine to make one hell of a dessert, the perfect snack for killing dragons or whatever it is that you do.',2,600,1,'34.jpg','Cream cheese, Butter'),(35,5,'Paper Mario (Koopasta)','Nothing says \"delicious\" like a plate full of green pasta, which may be why we devised this pesto-filled dish from Paper Mario. Blend up some garlic, fresh basil and pine nuts to form the base for these tasty-looking green noodles, garnished with a nice chunk of lettuce. Turtles will love it.',1,200,1,'35.jpg','Garlic, Fresh Basil, Pine Nuts, Lettuce'),(36,2,'Rockman E Can Drink','Most of the appeal of this beverage is imagining a little yellow bar hovering behind you and refilling itself with a cheerfully energetic series of beeping noises. This is, in fact, simply a hallucination you\'re having as you lie on the floor in a hyperglycemic coma.',3,800,1,'36.jpg',''),(37,2,'Gamer Grub','Some may not consider this to be a beverage, but it comes in a can and it\'s pretty clearly intended to be swigged. Also, we didn\'t want to risk imbibing Donkey Kong Jungle Juice.',3,500,1,'37.jpg',''),(38,3,'Halo Mountain Dew','This is pretty much just straight up red Mountain Dew with a picture of Master Chief on the bottle. Oh, and a whole 1mg more caffeine. Depending on your personal point of view, The Dew is either the food of the gods, or a revolting fluid secreted into cans by eyeless horrors.',3,500,0,'38.jpg',''),(39,2,'Tekken Jones','Jones is some of the best damn soda ever made, even (or especially) when its being made to taste like turkey-and-gravy or some other foodstuff you\'d never expect to encounter as a carbonated liquid.',3,400,1,'39.jpg',''),(40,5,'Sonic the Hedgehog',' Ingredients: 1 part grenadine, 2 parts Menthomint Schnapps, 4 parts Blue Curacao. Have fun.  ',4,200,1,'40.jpg','Grenadine, Menthomint Schnapps'),(41,5,'Kratos (God of War Cocktail)',' Ingredients: 1 oz. Vanilla rum, 3/4 oz. Strawberry rum, 1/2 oz. Amaretto, 1 splash Everclear, Strawberry syrup, Milk',4,200,1,'41.jpg','Vanilla Rum, Strawberry Rum, Amaretto, Strawberry Syrup, Milk'),(42,4,'Boomer Bile','Boomer Bile (left 4 Dead Mixed Drink)',4,200,1,'42.jpg','Cucumber Slices, Ice, Gin, Vodka, Lemon Juice, Worcester Sauce'),(43,4,'The Mass Effect 3','The Mass Effect 3',4,200,1,'43.jpg','Pineapple Juice, Grenadine, Carribean Rum, Cheap Gin, Olive Juice');

/*Table structure for table `notification` */

DROP TABLE IF EXISTS `notification`;

CREATE TABLE `notification` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `description` text NOT NULL,
  `acceptby` int(11) DEFAULT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `type` int(11) NOT NULL DEFAULT '0',
  `orderid` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `acceptby` (`acceptby`),
  CONSTRAINT `notification_ibfk_1` FOREIGN KEY (`acceptby`) REFERENCES `staff` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=latin1;

/*Data for the table `notification` */

insert  into `notification`(`id`,`description`,`acceptby`,`timestamp`,`type`,`orderid`) values (18,'SET FOR DELIVERY',NULL,'2012-11-13 07:29:25',0,1),(19,'SET FOR DELIVERY',NULL,'2012-11-13 07:29:40',0,2);

/*Table structure for table `order` */

DROP TABLE IF EXISTS `order`;

CREATE TABLE `order` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `customername` varchar(64) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `status` int(11) NOT NULL DEFAULT '0',
  `pickuptime` timestamp NULL DEFAULT NULL,
  `tablenumber` int(11) NOT NULL,
  `tabletnumber` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `tablenumber` (`tablenumber`,`tabletnumber`),
  KEY `tabletnumber` (`tabletnumber`),
  CONSTRAINT `order_ibfk_1` FOREIGN KEY (`tablenumber`) REFERENCES `table` (`tablenumber`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `order_ibfk_2` FOREIGN KEY (`tabletnumber`) REFERENCES `table` (`tabletnumber`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

/*Data for the table `order` */

insert  into `order`(`id`,`customername`,`timestamp`,`status`,`pickuptime`,`tablenumber`,`tabletnumber`) values (1,'David','2012-11-13 07:23:41',2,NULL,1,1),(2,'David','2012-11-13 07:24:46',2,NULL,1,1),(3,'David','2012-12-02 15:25:57',0,NULL,1,1),(4,'Debo','2012-12-03 11:12:45',0,NULL,1,1),(5,'David','2013-01-09 22:16:25',0,NULL,1,1);

/*Table structure for table `orderitem` */

DROP TABLE IF EXISTS `orderitem`;

CREATE TABLE `orderitem` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `menuid` int(11) NOT NULL,
  `orderid` int(11) NOT NULL,
  `comp` int(11) DEFAULT NULL,
  `ingredients` text,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `paymentid` int(11) DEFAULT NULL,
  `price` float NOT NULL,
  PRIMARY KEY (`id`),
  KEY `orderid` (`orderid`),
  KEY `menuid` (`menuid`),
  KEY `comp` (`comp`),
  KEY `paymentid` (`paymentid`),
  CONSTRAINT `orderitem_ibfk_1` FOREIGN KEY (`menuid`) REFERENCES `menuitem` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `orderitem_ibfk_2` FOREIGN KEY (`comp`) REFERENCES `staff` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=305 DEFAULT CHARSET=latin1;

/*Data for the table `orderitem` */

insert  into `orderitem`(`id`,`menuid`,`orderid`,`comp`,`ingredients`,`timestamp`,`paymentid`,`price`) values (291,27,1,NULL,'All','2012-11-13 07:23:42',33,5),(292,30,1,NULL,'All','2012-11-13 07:23:42',33,6),(293,29,1,NULL,'All','2012-11-13 07:23:42',33,10),(294,38,1,NULL,'All','2012-11-13 07:23:42',34,3),(295,41,1,NULL,'All','2012-11-13 07:23:42',32,5),(296,35,2,NULL,'Fresh Basil,Lettuce','2012-11-13 07:24:46',34,5),(297,42,2,NULL,'Gin,Vodka,Lemon Juice','2012-11-13 07:24:46',32,4),(298,40,3,NULL,'All','2012-12-02 15:25:57',35,5),(299,41,3,NULL,'All','2012-12-02 15:25:57',35,5),(300,43,3,NULL,'All','2012-12-02 15:25:57',35,4),(301,27,3,NULL,'All','2012-12-02 15:25:57',35,5),(302,29,4,NULL,'All','2012-12-03 11:12:45',36,10),(303,27,5,NULL,'All','2013-01-09 22:16:26',NULL,5),(304,35,5,NULL,'All','2013-01-09 22:16:26',NULL,5);

/*Table structure for table `payment` */

DROP TABLE IF EXISTS `payment`;

CREATE TABLE `payment` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `paymenttype` int(11) NOT NULL,
  `amount` float NOT NULL,
  `tipamount` float NOT NULL,
  `couponcode` varchar(64) DEFAULT NULL,
  `order` int(11) DEFAULT NULL,
  `orderitem` int(11) DEFAULT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `tax` float NOT NULL,
  PRIMARY KEY (`id`),
  KEY `order` (`order`),
  KEY `couponcode` (`couponcode`),
  KEY `orderitem` (`orderitem`),
  CONSTRAINT `payment_ibfk_1` FOREIGN KEY (`order`) REFERENCES `orderitem` (`orderid`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `payment_ibfk_2` FOREIGN KEY (`couponcode`) REFERENCES `coupon` (`code`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `payment_ibfk_3` FOREIGN KEY (`orderitem`) REFERENCES `orderitem` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=37 DEFAULT CHARSET=latin1;

/*Data for the table `payment` */

insert  into `payment`(`id`,`paymenttype`,`amount`,`tipamount`,`couponcode`,`order`,`orderitem`,`timestamp`,`tax`) values (32,0,9,0,NULL,NULL,NULL,'2012-11-13 07:26:05',0.72),(33,0,20.41,0,'855172',NULL,NULL,'2012-11-13 07:28:05',1.51),(34,0,8.64,0,NULL,NULL,NULL,'2012-12-02 10:18:18',0.64),(35,0,20.52,0,NULL,NULL,NULL,'2012-12-02 15:26:30',1.52),(36,0,10.8,0,NULL,NULL,NULL,'2012-12-03 11:15:08',0.8);

/*Table structure for table `staff` */

DROP TABLE IF EXISTS `staff`;

CREATE TABLE `staff` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fname` varchar(64) NOT NULL,
  `lname` varchar(64) NOT NULL,
  `role` int(11) NOT NULL,
  `logincode` varchar(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `logincode` (`logincode`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=latin1;

/*Data for the table `staff` */

insert  into `staff`(`id`,`fname`,`lname`,`role`,`logincode`) values (12,'David','Tuesday',1,'000000'),(13,'Quentin','Mayo',0,'000001'),(14,'Renee','Bryce',2,'000003'),(17,'Sailor','Moont',0,'000006'),(18,'Travis','Barker',0,'226370'),(19,'Mike','Jones',0,'614517'),(20,'Lil','Jon',2,'201129');

/*Table structure for table `table` */

DROP TABLE IF EXISTS `table`;

CREATE TABLE `table` (
  `tablenumber` int(11) NOT NULL,
  `tabletnumber` int(11) NOT NULL,
  `inuse` tinyint(1) NOT NULL DEFAULT '0',
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `notes` text,
  PRIMARY KEY (`id`),
  UNIQUE KEY `tablenumber` (`tablenumber`,`tabletnumber`),
  KEY `tabletnumber` (`tabletnumber`)
) ENGINE=InnoDB AUTO_INCREMENT=783 DEFAULT CHARSET=latin1;

/*Data for the table `table` */

insert  into `table`(`tablenumber`,`tabletnumber`,`inuse`,`id`,`notes`) values (1,1,1,782,NULL);

/*Table structure for table `tabletnotification` */

DROP TABLE IF EXISTS `tabletnotification`;

CREATE TABLE `tabletnotification` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type` int(11) NOT NULL DEFAULT '0',
  `description` text NOT NULL,
  `acceptedby` int(11) DEFAULT NULL,
  `tablenumber` int(11) NOT NULL,
  `tabletnumber` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `acceptedby` (`acceptedby`),
  KEY `tablenumber` (`tablenumber`,`tabletnumber`),
  KEY `tabletnumber` (`tabletnumber`),
  CONSTRAINT `tabletnotification_ibfk_2` FOREIGN KEY (`acceptedby`) REFERENCES `staff` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `tabletnotification_ibfk_3` FOREIGN KEY (`tablenumber`) REFERENCES `table` (`tablenumber`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `tabletnotification_ibfk_4` FOREIGN KEY (`tabletnumber`) REFERENCES `table` (`tabletnumber`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=latin1;

/*Data for the table `tabletnotification` */

insert  into `tabletnotification`(`id`,`type`,`description`,`acceptedby`,`tablenumber`,`tabletnumber`) values (20,0,'HELP REQUEST',NULL,1,1),(21,1,'DRINK REFILL',NULL,1,1);

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
