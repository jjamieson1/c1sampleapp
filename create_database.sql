create table c1_sample_app.application
(
	applicationId int not null auto_increment
		primary key,
	name varchar(100) null,
	description varchar(255) null,
	form text null
)
;

create table c1_sample_app.approvals
(
	approval_id int not null auto_increment
		primary key,
	identity_id varchar(50) not null,
	status varchar(25) default 'Pending Review' null,
	applicationId int null,
	details text null,
	submitted_date date null,
	updated_date date null,
	Approved_date date null
)
;

create table c1_sample_app.identity
(
	identity_id int not null auto_increment
		primary key,
	firstname varchar(25) null,
	lastname varchar(25) null,
	phone varchar(25) null,
	addressLine1 varchar(50) null,
	addressLine2 varchar(50) null,
	city varchar(25) null,
	province varchar(25) null,
	postalcode varchar(7) null,
	email varchar(50) null
)
;


