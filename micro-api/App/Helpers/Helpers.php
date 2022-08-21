<?php

function dg(...$params){
    echo '<style>
            *{
                background-color: #23272a;
                color: #7289da;
                font-weight: bold;
            }
         </style>
    <pre>';
    
    var_dump(...$params);
    die;
}