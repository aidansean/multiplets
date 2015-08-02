<?php
include_once($_SERVER['FILE_PREFIX']."/project_list/project_object.php") ;
$github_uri   = "https://github.com/aidansean/multiplets" ;
$blogpost_uri = "http://aidansean.com/projects/?tag=multiplets" ;
$project = new project_object("multiplets", "Particle multiplets", "https://github.com/aidansean/multiplets", "http://aidansean.com/projects/?tag=multiplets", "multiplets/images/project.jpg", "multiplets/images/project_bw.jpg", "For my thesis I needed to describe many of the know mesons and baryons.  To better illustrate their relation to each other I decided to create an SVG image showing a three dimensional representation in isospin and weak hypercharge space.", "Physics", "HTML,PHP,SVG") ;
?>