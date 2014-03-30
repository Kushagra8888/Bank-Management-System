/* My sql version
 * Create the table
 */
CREATE DATABASE IF NOT EXISTS bankmanagementsystem ;
USE  bankmanagementsystem ;

create table customer(custid integer NOT NULL AUTO_INCREMENT, 
	name varchar(25), 
	login VARCHAR(10) NOT NULL UNIQUE , 
	email varchar(25), 
	address varchar(50), 
	phone integer, 
	ssn_no integer, 
	Primary key (custid));

create table accounts( accountno integer NOT NULL AUTO_INCREMENT, 
	owner integer, 
	account_type varchar(10), 
	balance integer, 
	date_of_opening date,
	Primary key(accountno), 
	FOREIGN KEY(owner) REFERENCES customer(custid) ON DELETE CASCADE);

create table employee( emp_id integer NOT NULL AUTO_INCREMENT,
	login VARCHAR(10) NOT NULL UNIQUE, 
	manager integer, 
	department varchar(10),
	name varchar (25), 
	isManager tinyint DEFAULT 0, 
	ssn integer UNIQUE, 
	primary key(emp_id));

Create table transactions (transaction_id integer NOT NULL AUTO_INCREMENT,
	accountno INTEGER ,
 	type VARCHAR(20),
 	mode VARCHAR(20),
 	amount INTEGER, 
	date DATE,
 	foreign key(accountno) references accounts(accountno) ON DELETE CASCADE, 
	primary key(transaction_id)); 

Create table departments (dept_no integer NOT NULL AUTO_INCREMENT, 
	name VARCHAR(25), 
	Primary key(dept_no));