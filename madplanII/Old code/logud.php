<?php
session_start();
session_destroy();
header("location:madplan.php");
// log ud og redirekt til madplan.php 