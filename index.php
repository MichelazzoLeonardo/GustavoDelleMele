<?php
//creating database
$servername = 'localhost';
$username = 'root';
$password = '';
$dbname = 'minecraft_farms';

$conn = new mysqli($servername, $username, $password);
$sql = "CREATE DATABASE IF NOT EXISTS $dbname;";

$conn->query($sql);

//creating tables
$conn = new mysqli($servername, $username, $password, $dbname);

$sql = "CREATE TABLE IF NOT EXISTS user (
  username varchar(64) NOT NULL,
  email varchar(64) NOT NULL,
  password varchar(60) NOT NULL
);";
$conn->query($sql);

$sql = "CREATE TABLE IF NOT EXISTS farm (
  owner varchar(64) NOT NULL,
  name varchar(64) NOT NULL PRIMARY KEY,
  version varchar(64) NOT NULL,
  rates varchar(500) NOT NULL,
  type varchar(16) NOT NULL,
  afkable varchar(16) NOT NULL,
  overworld varchar(16) NOT NULL,
  nether varchar(16) NOT NULL,
  end varchar(16) NOT NULL,
  tutorial varchar(200) NOT NULL,

  FOREIGN KEY (owner) REFERENCES user(username)
);";
$conn->query($sql);

header('Location:pages/community.php');

/*

USER:
||  username    ||  email       ||  password    ||

FARM:
||  owner   ||  name    ||  version ||  rates   ||  type    ||  afkable ||  overworld   ||  nether  ||  end ||  tutorial    ||

*/
