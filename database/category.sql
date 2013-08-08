drop table category;

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