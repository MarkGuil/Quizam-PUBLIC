<?php

function connectDatabase()
{
    $mysql = new mysqli('localhost', 'root', '', 'users');
    return $mysql;
}

function getQuestion($id)
{

    $mysql = connect();
    $result = $mysql->query("SELECT * FROM `questions` WHERE `id`='$id'");
    return $result->fetch_assoc();
}

function updateQuestion($id, $question)
{

    $mysql = connect();
    $mysql->query("UPDATE  `questions` SET `question`='$question' WHERE `id`='$id'");
}
function updatePoints($id, $points)
{

    $mysql = connect();
    $mysql->query("UPDATE `questions` SET `points`='$points' WHERE `id`='$id'");
}

function updateTimer($id, $time)
{

    $mysql = connect();
    $mysql->query("UPDATE `questions` SET `timer`='$time' WHERE `id`='$id'");
}

function getAnswer($id)
{

    $mysql = connect();
    $result = $mysql->query("SELECT * FROM `answers` WHERE `question_id`='$id'");
    return $result->fetch_assoc();
}

function getCurrentAnswer($id)
{

    $mysql = connect();
    $result = $mysql->query("SELECT * FROM `answers` WHERE `id`='$id'");
    return $result->fetch_assoc();
}

function updateAnswer($id, $answer)
{

    $mysql = connect();
    $mysql->query("UPDATE `answers` SET `answer`='$answer' WHERE `id`='$id'");
}

function getOptions($id)
{

    $mysql = connect();
    $result = $mysql->query("SELECT * FROM `choices` WHERE `id`='$id'");
    return $result->fetch_assoc();
}

function updateOption($id, $option)
{
    $mysql = connect();
    $mysql->query("UPDATE `choices` SET `option`='$option' WHERE `id`='$id'");
}

function updateImage($id, $newPath)
{
    $mysql = connect();
    $mysql->query("UPDATE `questions` SET `pic_path`='$newPath' WHERE `id`='$id'");
}

function removeImage($id)
{
    $mysql = connect();
    $mysql->query("UPDATE `questions` SET `pic_path`='' WHERE `id`='$id'");
}
// function getImage($id){

//     $mysql = connect();
//     $result = $mysql->query("SELECT * FROM `questions` ");
//     return $result->fetch_assoc();
// }