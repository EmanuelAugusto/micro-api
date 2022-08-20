<?php

function dg(...$params){
    echo '<style>
            *{
                background-color: black;
                color: green;
                font-weight: bold;
            }
         </style>
    <pre>';
    
    var_dump(...$params);
    die;
}