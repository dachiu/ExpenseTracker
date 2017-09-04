# Privileges for `cs602_user`@`localhost`

GRANT ALL PRIVILEGES ON *.* TO 'cs602_user'@'localhost' IDENTIFIED BY PASSWORD '*4A30CD65B933E246ED9BE4656778079486D967CA' WITH GRANT OPTION;

GRANT ALL PRIVILEGES ON `cs602\_user\_%`.* TO 'cs602_user'@'localhost';
 
 create table userData(
 uid int primary key not null auto_increment,
 firstName varchar(50) not null,
 lastName varchar(50) not null,
 emailAddress varchar(50) not null,
 password varchar(50) not null);

create table expense(
 id int primary key not null auto_increment,
 userId int not null,
 entryDate varchar(50) not null,
 amount varchar(10) not null,
 category varchar(25) not null,
 type varchar(20) not null,
 foreign key (userId) references userData(uid));

insert into userData(firstName, lastName, emailAddress, password) values(
 'John', 'Doe', 'john@email.com', 'password');

insert into userData(firstName, lastName, emailAddress, password) values(
 'Jane', 'Doe', 'jane@email.com', 'password'); 

insert into expense(entryDate, amount, category, type, userId) values(
 '04-17-2017', '200', 'electricity', 'expense', 1);

insert into expense(entryDate, amount, category, type, userId)  values(
 '04-10-2017', '100', 'gas', 'expense', 1);

insert into expense(entryDate, amount, category, type, userId)  values(
 '04-08-2017', '300', 'water', 'expense', 1);

insert into expense(entryDate, amount, category, type, userId)  values(
 '04-28-2017', '600', 'rent', 'expense', 2); 

insert into expense(entryDate, amount, category, type, userId)  values(
 '04-16-2017', '150', 'water', 'expense', 2); 

insert into expense(entryDate, amount, category, type, userId)  values(
 '04-01-2017', '1600', 'job', 'income', 2); 

 insert into expense(entryDate, amount, category, type, userId)  values(
 '04-08-2017', '120', 'water', 'income', 2); 

  insert into expense(entryDate, amount, category, type, userId)  values(
 '04-13-2017', '80', 'water', 'income', 2); 