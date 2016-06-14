-- Table Declarations for Project Nova
-- Version: V0609
-- Author: Phoenix

CREATE DATABASE if not exists nova;
ALTER DATABASE nova CHARACTER SET utf8;
-- SHOW DATABASES;
USE nova;

DROP TABLE if exists CMTAuthors cascade;
DROP TABLE if exists CMTBooks cascade;
DROP TABLE if exists FAVAuthors cascade;
DROP TABLE if exists FAVBooks cascade;
DROP TABLE if exists HSAuthors cascade;
DROP TABLE if exists HSBooks cascade;
DROP TABLE if exists Members cascade;
DROP TABLE if exists Links cascade;
DROP TABLE if exists BookDetails cascade;
DROP TABLE if exists Books cascade;
DROP TABLE if exists GenreDetails cascade;
DROP TABLE if exists Genres cascade;
DROP TABLE if exists AuthorDetails cascade;
DROP TABLE if exists Authors cascade;
DROP TABLE if exists CountryDetails cascade;
DROP TABLE if exists Countries cascade;
DROP TABLE if exists Languages cascade;

CREATE TABLE Languages(
    LCode char(5) primary key,
    LName varchar(100) not null,
    HomePage TEXT
);

CREATE TABLE Authors(
    AID varchar(100) not null,
    LCode char(5) not null,
    AName varchar(200) not null,
    ADesc TEXT,
    primary key(AID,LCode),
    FOREIGN KEY(LCode) REFERENCES Languages(LCode) ON UPDATE CASCADE ON DELETE CASCADE
);

CREATE TABLE Genres(
    GCode varchar(10) not null,
    LCode char(5) not null,
    GName varchar(200) not null,
    GLink TEXT,
    primary key(GCode,LCode),
    FOREIGN KEY(LCode) REFERENCES Languages(LCode) ON UPDATE CASCADE ON DELETE CASCADE
);

CREATE TABLE Books(
    BID varchar(100) primary key,
    AID varchar(100) not null,
    GCode varchar(10) not null,
    ORelease DATE default 0,
    Clicks INT UNSIGNED default 0,
    Rating INT UNSIGNED default NULL,
    FOREIGN KEY(AID) REFERENCES Authors(AID) ON UPDATE CASCADE ON DELETE CASCADE,
    FOREIGN KEY(GCode) REFERENCES Genres(GCode) ON UPDATE CASCADE ON DELETE CASCADE
);

CREATE TABLE BookDetails(
    BID varchar(100) not null,
    LCode char(5) not null,
    BName TEXT not null,
    BRelease DATE not null default 0,
    WCount INT default NULL,
    BUpdate DATE not null default 0,
    BDesc TEXT,
    primary key(BID,LCode),
    FOREIGN KEY(BID) REFERENCES Books(BID) ON UPDATE CASCADE ON DELETE CASCADE,
    FOREIGN KEY(LCode) REFERENCES Languages(LCode) ON UPDATE CASCADE ON DELETE CASCADE
);

CREATE TABLE Links(
    URL TEXT not null,
    LType TEXT not null,
    BID varchar(100) not null,
    LCode char(5) not null,
    LChecksum INT unsigned not null,
    primary key(LChecksum, BID, LCode),
    FOREIGN KEY(BID) REFERENCES Books(BID) ON UPDATE CASCADE ON DELETE CASCADE,
    FOREIGN KEY(LCode) REFERENCES Languages(LCode) ON UPDATE CASCADE ON DELETE CASCADE
);

CREATE TABLE Members(
    UserName varchar(20) primary key,
    UserPass char(40) not null, -- Encrypt the password in SHA1, no actual password stored
    LangPref char(5) default 'eng',
    SectionID char(40),
    FOREIGN KEY(LangPref) REFERENCES Languages(LCode) ON UPDATE CASCADE ON DELETE SET NULL
);

CREATE TABLE HSBooks(
    UserName varchar(20) not null,
    BID varchar(100) not null,
    LastVisit DATETIME not null,
    primary key(UserName, BID),
    FOREIGN KEY(UserName) REFERENCES Members(UserName) ON UPDATE CASCADE ON DELETE CASCADE,
    FOREIGN KEY(BID) REFERENCES Books(BID) ON UPDATE CASCADE ON DELETE CASCADE
);

CREATE TABLE HSAuthors(
    UserName varchar(20) not null,
    AID varchar(100) not null,
    LastVisit DATETIME not null,
    primary key(UserName, AID),
    FOREIGN KEY(UserName) REFERENCES Members(UserName) ON UPDATE CASCADE ON DELETE CASCADE,
    FOREIGN KEY(AID) REFERENCES Authors(AID) ON UPDATE CASCADE ON DELETE CASCADE
);

CREATE TABLE FAVBooks(
    UserName varchar(20) not null,
    BID varchar(100) not null,
    AddedAt DATE not null,
    primary key(UserName, BID),
    FOREIGN KEY(UserName) REFERENCES Members(UserName) ON UPDATE CASCADE ON DELETE CASCADE,
    FOREIGN KEY(BID) REFERENCES Books(BID) ON UPDATE CASCADE ON DELETE CASCADE
);

CREATE TABLE FAVAuthors(
    UserName varchar(20) not null,
    AID varchar(100) not null,
    AddedAt DATE not null,
    primary key(UserName, AID),
    FOREIGN KEY(UserName) REFERENCES Members(UserName) ON UPDATE CASCADE ON DELETE CASCADE,
    FOREIGN KEY(AID) REFERENCES Authors(AID) ON UPDATE CASCADE ON DELETE CASCADE
);

CREATE TABLE CMTBooks(
	CMTID int not null auto_increment primary key,
    TStamp timestamp not null,
    BID varchar(100) not null,
    Content TEXT not null,
    FOREIGN KEY(BID) REFERENCES Books(BID) ON UPDATE CASCADE ON DELETE CASCADE
);

CREATE TABLE CMTAuthors(
	CMTID int not null auto_increment primary key,
    TStamp timestamp not null,
    AID varchar(100) not null,
    Content TEXT not null,
    FOREIGN KEY(AID) REFERENCES Authors(AID) ON UPDATE CASCADE ON DELETE CASCADE
);
