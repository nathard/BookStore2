drop table orders;
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

select * from orders;

drop table orderSummary;
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

select * from orderSummary;