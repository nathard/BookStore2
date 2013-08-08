drop table orderSummary;
drop table orders;
drop table books;
drop table category;
drop table users;

create table users(
FIRSTNAME varchar2(20),
LASTNAME varchar2(20),
USERNAME varchar2(15) default '' NOT NULL,
PASSWORD varchar2(32) default '' NOT NULL,
EMAIL varchar2(50) default '' NOT NULL,
PHONE varchar2(15),
COMPANY varchar2(25),
ADDRESS varchar2(50),
POSTCODE number(5),
CITY varchar2(15),
STATE varchar2(28),
Primary key (USERNAME)
);

INSERT INTO users VALUES ('axl', 'p', 'axl', '39c869cf2ba63b2c17e901df0f6ba1b4', 'axl@mail.com', '123456789', 'bookstore', '100 T street',1234,'Melb','Queensland');
commit;

create table category(
CATEGORYID number(3) NOT NULL,
CATEGORYNAME varchar2(25),
Primary key (CATEGORYID)
);

INSERT INTO category VALUES (1, 'Business and Economics');
INSERT INTO category VALUES (2, 'Computing');
INSERT INTO category VALUES (3, 'Cookery and Drinks');
INSERT INTO category VALUES (4, 'Fiction');
INSERT INTO category VALUES (5, 'Society and Culture');

commit;

create table books(
BOOKID number(3) NOT NULL,
TITLE varchar2(60),
AUTHOR varchar2(50),
PUBLISHER varchar2(30),
ISBN1 varchar2(10),
ISBN2 varchar2(13),
YEAR number(4),
PRICE number(6,2),
IMAGE varchar2(15),
QUANTITY number(2),
CATEGORYID number(2),
Primary key (BOOKID),
Foreign key (CATEGORYID) references category
);


INSERT INTO books VALUES (1,'White Fang','Kathleen Olmstead, Jack London, Dan Andreasen','Sterling','1402725000', '9781402725005',2006,25.00,'wf.jpg',10,4);
INSERT INTO books VALUES (2,'Summer Cooking', 'Elizabeth David', 'Grub Street', '1908117044', '9781908117045',2011,15.00,'cook.jpg',5,3);
INSERT INTO books VALUES (3,'Fundamentals of financial management', 'James C. Van Horne, John M. Wachowicz', 'Financial Times/Prentice Hall', '0273685988', '9780273685982', 2005, 37.00, 'finance.jpg',4,1);
INSERT INTO books VALUES (4,'Business Information Systems: Analysis, Design and Practice', 'Graham Curtis, David Cobham', 'Pearson Education', '0273713825', '9780273713821', 2008, 55.50, 'is.jpg',6,1);
INSERT INTO books VALUES (5,'Microsoft SQL Server 2008 Management and Administration', 'Ross Mistry, Rand Morimoto', 'Sams', '067233044X', '9780672330445', 2009, 70.20, 'sql.jpg',7,2);
INSERT INTO books VALUES (6,'Mastering Microsoft Exchange Server 2007', 'Barry Gerber, Jim McBee', 'John Wiley and Sons', '0470042893', '9780470042892', 2007, 80.60, 'me2007.jpg',8,2);
INSERT INTO books VALUES (7,'Visual Basic 2008: how to program', 'Paul J. Deitel, Harvey M. Deitel', 'Prentice Hall', '013605305X', '9780136053057', 2009, 62.00, 'vb.jpg',3,2);
INSERT INTO books VALUES (8,'XML : a beginner guide','Dave Mercer', 'McGraw-Hill', '0071606262', '9780071606264', 2009, 20.00, 'XML.jpg',2,2);
INSERT INTO books VALUES (9,'Fedora Bible 2011 Edition: Featuring Fedora Linux 14', 'Christopher Negus, Eric Foster-Johnson', 'John Wiley and Sons', '047094496X', '9780470944967', 2011, 50.00, 'fedora.jpg',5,2);
INSERT INTO books VALUES (10,'Media/Society: Industries, Images, and Audiences', 'William Hoynes, David Croteau, Stefania Milan', 'SAGE Publications', '1412974208', '9781412974202',2011,63.00,'media.jpg',3,5);
INSERT INTO books VALUES (11,'Visual C# 2008 How to Program', 'Paul J. Deitel, Harvey M. Deitel', 'Prentice Hall', '013605322X', '9780136053224', 2008, 60.30, 'csharp.jpg',6,2);
INSERT INTO books VALUES (12,'CCNP switching study guide', 'Todd Lammle, Kevin Hales', 'Sybex', '0782127118', '9780782127119', 2001,46.30, 'ccnp.jpg',7,2);

commit;

create table orders(
ORDERID number(3) default '' NOT NULL,
USERNAME varchar2(15),
DATEORDER DATE,
ORDERTOTAL number(8,2),
STATUS varchar2 (7),
SHIPPING_FIRSTNAME varchar2(20),
SHIPPING_LASTNAME varchar2(20),
SHIPPING_UNITNO number(4),
SHIPPING_STREET varchar2(30),
SHIPPING_CITY varchar2(15),
SHIPPING_POSTCODE number(5),
SHIPPING_STATE varchar2(28),
CARDTYPE varchar2(11),
CARDNO varchar2(32),
csc varchar2 (32),
CardMonth number(2),
CardYear number(2),
Primary key (ORDERID),
Foreign key (USERNAME) references users
);

INSERT INTO orders VALUES (1, 'axl', to_date('27082011','DDMMYYYY'), 194, 'shipped', 'jenny', 'n',16, 'Orange', 'Sydney',2290,'New South Wales','','','','','');
INSERT INTO orders VALUES (2, 'axl', to_date('27072011','DDMMYYYY'), 75.55, 'shipped', 'kaim', 'h',99, 'Watermelon', 'Free', 1111, 'Western Australia','','','','','');

commit;


create table orderSummary(
ORDERID number(3),
BOOKID number(3),
Quantity number(2),
Primary key (ORDERID, BOOKID),
Foreign key (BOOKID) references books,
Foreign key (ORDERID) references orders
);

INSERT INTO orderSummary VALUES(1,1,2);
INSERT INTO orderSummary VALUES(1,7,2);
INSERT INTO orderSummary VALUES(2,4,1);

commit;



select * from books;
select * from orderSummary;
select * from users;
select * from orders;
select * from category;
