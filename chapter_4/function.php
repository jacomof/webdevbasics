<?php

function longdate(int $timestamp){
    return date("l F jS Y", $timestamp);
}

echo longdate(time() - 2*24*60*60);