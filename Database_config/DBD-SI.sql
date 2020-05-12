CREATE DATABASE DBD_SI;

USE DBD_SI;

CREATE TABLE  IF NOT EXISTS  DBD_USER ( 
id_user VARCHAR(50) NOT NULL, 
username VARCHAR(255) NOT NULL UNIQUE,
password_user VARCHAR(255) NOT NULL,
role_user ENUM('0','1') NOT NULL,
PRIMARY KEY(id_user)
);

CREATE TABLE IF NOT EXISTS DBD_RS ( 
id_rs VARCHAR(50) NOT NULL,
id_user VARCHAR(50) NOT NULL,
name_rs VARCHAR(255) NOT NULL UNIQUE,  
email_rs VARCHAR(255) UNIQUE,
handphone_rs VARCHAR(20) UNIQUE,
address_rs TEXT NOT NULL,
region_rs VARCHAR(10) NOT NULL,
lat_rs VARCHAR(50) NOT NULL,
lon_rs VARCHAR(50) NOT NULL,
PRIMARY KEY(id_rs),
CONSTRAINT FK_RS_USER FOREIGN KEY (id_user) REFERENCES DBD_user(id_user)
);


CREATE TABLE IF NOT EXISTS DBD_DIRJEN( 
id_dirjen VARCHAR(50) NOT NULL,
id_user VARCHAR(50) NOT NULL,
name_dirjen VARCHAR(255) NOT NULL UNIQUE,  
email_dirjen VARCHAR(255) UNIQUE,
handphone_dirjen VARCHAR(20) UNIQUE,
PRIMARY KEY(id_dirjen),
CONSTRAINT FK_DIRJEN_USER FOREIGN KEY (id_user) REFERENCES DBD_user(id_user)
);


CREATE TABLE IF NOT EXISTS DBD_CASE( 
id_case VARCHAR(50) NOT NULL,
id_rs VARCHAR(50) NOT NULL,
status_case ENUM('0','1','2') NOT NULL,  
age_case int(10) NOT NULL,
gender_case ENUM('0','1') NOT NULL,
update_date_case DATE NOT NULL,
PRIMARY KEY(id_case),
CONSTRAINT FK_KASUS_RS FOREIGN KEY (id_rs) REFERENCES DBD_RS(id_rs)
);

CREATE TABLE IF NOT EXISTS DBD_RECAP( 
id_recap VARCHAR(50) NOT NULL,
id_rs VARCHAR(50) NOT NULL,
status_recap ENUM('0','1','2') NOT NULL,
amount_recap INT(255) NOT NULL,
date_recap DATE NOT NULL,
PRIMARY KEY(id_recap),
CONSTRAINT FK_REKAP_RS FOREIGN KEY (id_rs) REFERENCES DBD_RS(id_rs)
);


CREATE TABLE IF NOT EXISTS `dbd_ci_sessions` (
        `id` varchar(128) NOT NULL,
        `ip_address` varchar(45) NOT NULL,
        `timestamp` int(10) unsigned DEFAULT 0 NOT NULL,
        `data` blob NOT NULL,
        KEY `ci_sessions_timestamp` (`timestamp`)
);

ALTER TABLE ci_sessions ADD PRIMARY KEY (id);
