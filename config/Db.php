<?php


$connection = new mysqli(getenv("DB_HOST"),getenv("DB_USER"),getenv("DB_PASS"),getenv("DB_NAME"));

if($connection->connect_error){
    die($connection->connect_error);
}
$sqls = [
   'users' => 'create table users ( id varchar(255) primary key, email varchar(255) not null, password varchar(255) not null );',
   'personal_info' => 'create table personal_info (personal_info_id varchar(255), user_id varchar(255), label varchar(255), value varchar(255) , primary key ( personal_info_id ), foreign key ( user_id ) references users( id ));',
   'phone_book' => 'create table phone_book (phone_book_id varchar(255), user_id varchar(255), label varchar(255), value varchar(255), primary key (phone_book_id), foreign key (user_id) references users(id));' ,
   'book_date' => 'create table book_date (  date_id varchar(255), date_type varchar(255), submit_date datetime, which_table varchar(5), primary key (date_id) );'
];
foreach($sqls as $tableName => $query ){
    if ($connection->query($query) !== TRUE) {
        error_log(date("Y-m-d H:i:s")." Error creating table $tableName: ".$connection->error."\n",3,getcwd().'/var/logs/error.log');
      } 
}