<?php

require 'functions.php';

$dbname = "imdb_movies";

// Movies table
$table_name = 'Movies';
$schema_of_table = "imdb_title_id varchar(255), 
title varchar(255), 
original_title varchar(255),
year int,
date_published int,
genre varchar(255),
duration float,
country varchar(255),
language varchar(255),
director varchar(255),
writer varchar(255),
production_company varchar(255),
actors varchar(255),
description varchar(255),
avg_vote float,
votes int,
budget float,
usa_gross_income float,
worlwide_gross_income float,
metascore float,
reviews_from_users float,
reviews_from_critics float,
PRIMARY KEY (imdb_title_id)";

// init Movies
initTable($dbname, $table_name, $schema_of_table);


//Names table
$table_name = "Names";
$schema_of_table = "imdb_name_id varchar(255),
name varchar(255),
birth_name varchar(255),
height float,
bio varchar(255),
birth_details varchar(255),
date_of_birth varchar(255),
place_of_birth varchar(255),
death_details varchar(255),
date_of_death varchar(255),
place_of_death varchar(255),
reason_of_death varchar(255),
spouses_string varchar(255),
spouses int,
divorces int,
spouses_with_children int,
children int,
PRIMARY KEY (imdb_name_id)";

// init Names
initTable($dbname, $table_name, $schema_of_table);

// Movie_characters
$table_name = "Movie_characters";
$schema_of_table = "imdb_title_id varchar(255),
ordering int,
imdb_name_id varchar(255),
category varchar(255),
job varchar(255),
characters varchar(255),
FOREIGN KEY (`imdb_title_id`) REFERENCES `Movies`(`imdb_title_id`),
FOREIGN KEY (`imdb_name_id`) REFERENCES `Names`(`imdb_name_id`)";

// init Movie_characters
initTable($dbname, $table_name, $schema_of_table);

// users
$table_name = "Users";
$schema_of_table = "
	user_id int PRIMARY KEY AUTO_INCREMENT,
    uid varchar(255),
    pseudo varchar(255),
    email varchar(255),
    password varchar(255)";
// init Users
initTable($dbname, $table_name, $schema_of_table);
