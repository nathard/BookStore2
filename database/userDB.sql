drop table users;
create table users(
FIRSTNAME varchar2(20),
LASTNAME varchar2(20),
USERNAME varchar2(15) default '' NOT NULL,
PASSWORD varchar2(25) default '' NOT NULL,
EMAIL varchar2(50) default '' NOT NULL,
PHONE varchar2(15),
COMPANY varchar2(25),
ADDRESS varchar2(50),
POSTCODE number(4),
CITY varchar2(15),
STATE varchar2(28),
Primary key (USERNAME)
);

INSERT INTO users VALUES ('axl', 'p', 'axl', 123456, 'axl@mail.com', '123456789', 'bookstore', '100 T street',1234,'Melb','Queensland');
commit;

select * from users;