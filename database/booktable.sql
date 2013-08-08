drop table books;

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