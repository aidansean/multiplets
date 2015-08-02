<?php

$g['c_w'] = 800 ;
$g['c_h'] = 800 ;

$g['offset'] = pi()/10 ;
$g['xy_z_angle'] = pi()/3 ;
$g['hex_r'] = 200 ;
$g['tri_r'] = 100 ;
$g['axis_length'] = 0.4 ;
$g['line_color'] = 'rgb(0,150,0)' ;
$g['circle_radius'] = 20 ;

header("Content-type: image/svg+xml") ;
$string[] = '<svg width="' . write_int($g['c_w']) . '" height="' . write_int($g['c_h']) . '" ' ;
$string[] = 'version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">' . PHP_EOL ;

$meson[0]  = '<tspan dx="2" dy="8"  font-size="30">&#x03C0;</tspan><tspan font-size="20" dx="2" dy="-10">+</tspan>' ;
$meson[1]  = '<tspan dx="2" dy="10" font-size="24">K</tspan><tspan font-size="20" dx="2" dy="-16">+</tspan>' ;
$meson[2]  = '<tspan dx="2" dy="10" font-size="24">K</tspan><tspan font-size="16" dx="2" dy="-16">0</tspan>' ;
$meson[3]  = '<tspan dx="2" dy="8"  font-size="30">&#x03C0;</tspan><tspan font-size="20" dx="2" dy="-10">-</tspan>' ;
$meson[4]  = '<tspan dx="2" dy="10" font-size="24">K</tspan><tspan font-size="20" dx="2" dy="-16">-</tspan>' ;
$meson[5]  = '<tspan dx="2" dy="10" font-size="24">K</tspan><tspan font-size="16" dx="2" dy="-16">0</tspan>' ;

$meson[6]  = '<tspan dx="2" dy="10" font-size="24">D</tspan><tspan font-size="16" dx="-2" dy="-16">+</tspan><tspan font-size="20" dx="-8" dy="20">s</tspan>' ;
$meson[7]  = '<tspan dx="2" dy="10" font-size="24">D</tspan><tspan font-size="16" dx="0" dy="-16">0</tspan>' ;
$meson[8]  = '<tspan dx="2" dy="10" font-size="24">D</tspan><tspan font-size="16" dx="0" dy="-16">+</tspan>' ;

$meson[9]  = '<tspan dx="2" dy="8" font-size="24">D</tspan><tspan font-size="16" dx="0" dy="-14">-</tspan><tspan font-size="18" dx="-8" dy="20">s</tspan>' ;
$meson[10] = '<tspan dx="2" dy="10" font-size="24">D</tspan><tspan font-size="16" dx="0" dy="-16">0</tspan>' ;
$meson[11] = '<tspan dx="2" dy="10" font-size="24">D</tspan><tspan font-size="16" dx="0" dy="-14">-</tspan>' ;

$meson[12] = '<tspan dx="2" dy="10" font-size="30">&#x03C0;</tspan><tspan font-size="12" dx="2" dy="-14">0</tspan>' ;
$meson[13] = '<tspan dx="2" dy="8"  font-size="30">&#x03B7;</tspan>' ;
$meson[14] = '<tspan dx="2" dy="10" font-size="30">&#x03B7;\'</tspan>' ;
$meson[15] = '<tspan dx="2" dy="8"  font-size="30">&#x03B7;</tspan><tspan font-size="16" dx="0" dy="6">c</tspan>' ;

// Axes
$x0 = 0.5*$g['c_w'] ;
$y0 = 0.5*$g['c_h'] ;

$x1 = $x0 ;
$y1 = $y0 ;
$x2 = $x0 ;
$y2 = $y0 + $g['axis_length']*$g['c_h'] ;
$string[] = '<line ' .
	'x1="' . write_float($x1) . '" ' .
	'y1="' . write_float($y1) . '" ' .
	'x2="' . write_float($x2) . '" ' .
	'y2="' . write_float($y2) . '" ' .
	'stroke="rgb(0,0,0)" stroke-width="2" />' .PHP_EOL ;
$x1 = $x0 ;
$y1 = $y0 ;
$x2 = $x0 ;
$y2 = $y0 - $g['axis_length']*$g['c_h'] ;
$string[] = '<line ' .
	'x1="' . write_float($x1) . '" ' .
	'y1="' . write_float($y1) . '" ' .
	'x2="' . write_float($x2) . '" ' .
	'y2="' . write_float($y2) . '" ' .
	'stroke="rgb(0,0,0)" stroke-width="2" />' .PHP_EOL ;

$x1 = $x0 ;
$y1 = $y0 ;
$x2 = $x0 + $g['axis_length']*$g['c_w']*cos($g['offset']) ;
$y2 = $y0 - $g['axis_length']*$g['c_w']*sin($g['offset'])*cos($g['xy_z_angle']) ;
$string[] = '<line ' .
	'x1="' . write_float($x1) . '" ' .
	'y1="' . write_float($y1) . '" ' .
	'x2="' . write_float($x2) . '" ' .
	'y2="' . write_float($y2) . '" ' .
	'stroke="rgb(0,0,0)" stroke-width="2"/>' .PHP_EOL ;
$x1 = $x0 ;
$y1 = $y0 ;
$x2 = $x0 - $g['axis_length']*$g['c_w']*cos($g['offset']) ;
$y2 = $y0 + $g['axis_length']*$g['c_w']*sin($g['offset'])*cos($g['xy_z_angle']) ;
$string[] = '<line ' .
	'x1="' . write_float($x1) . '" ' .
	'y1="' . write_float($y1) . '" ' .
	'x2="' . write_float($x2) . '" ' .
	'y2="' . write_float($y2) . '" ' .
	'stroke="rgb(0,0,0)" stroke-width="2"/>' .PHP_EOL ;

$x1 = $x0 ;
$y1 = $y0 ;
$x2 = $x0 + $g['axis_length']*$g['c_w']*cos(pi()/2+$g['offset']) ;
$y2 = $y0 - $g['axis_length']*$g['c_w']*sin(pi()/2+$g['offset'])*cos($g['xy_z_angle']) ;
$string[] = '<line ' .
	'x1="' . write_float($x1) . '" ' .
	'y1="' . write_float($y1) . '" ' .
	'x2="' . write_float($x2) . '" ' .
	'y2="' . write_float($y2) . '" ' .
	'stroke="rgb(0,0,0)" stroke-width="2"/>' .PHP_EOL ;
$x1 = $x0 ;
$y1 = $y0 ;
$x2 = $x0 - $g['axis_length']*$g['c_w']*cos(pi()/2+$g['offset']) ;
$y2 = $y0 + $g['axis_length']*$g['c_w']*sin(pi()/2+$g['offset'])*cos($g['xy_z_angle']) ;
$string[] = '<line ' .
	'x1="' . write_float($x1) . '" ' .
	'y1="' . write_float($y1) . '" ' .
	'x2="' . write_float($x2) . '" ' .
	'y2="' . write_float($y2) . '" ' .
	'stroke="rgb(0,0,0)" stroke-width="2"/>' .PHP_EOL ;

// Hexagon
for($i=0 ; $i<6 ; $i++)
{
	$x0 = 0.5*$g['c_w'] ;
	$y0 = 0.5*$g['c_h'] ;
	$x1 = $x0 +  20*cos($g['offset']+2*$i*pi()/6) ;
	$y1 = $y0 -  20*sin($g['offset']+2*$i*pi()/6)*cos($g['xy_z_angle']) ;
	$x2 = $x0 + $g['hex_r']*cos($g['offset']+2*$i*pi()/6) ;
	$y2 = $y0 - $g['hex_r']*sin($g['offset']+2*$i*pi()/6)*cos($g['xy_z_angle']) ;
	$x3 = $x0 + $g['hex_r']*cos($g['offset']+2*($i+1)*pi()/6) ;
	$y3 = $y0 - $g['hex_r']*sin($g['offset']+2*($i+1)*pi()/6)*cos($g['xy_z_angle']) ;
	
	$string[] = '<line ' .
		'x1="' . write_float($x1) . '" ' .
		'y1="' . write_float($y1) . '" ' .
		'x2="' . write_float($x2) . '" ' .
		'y2="' . write_float($y2) . '" ' .
		'stroke="' . $g['line_color'] . '" stroke-width="4" stroke-opacity="0.5"/>' .PHP_EOL ;
	$string[] = '<line ' .
		'x1="' . write_float($x2) . '" ' .
		'y1="' . write_float($y2) . '" ' .
		'x2="' . write_float($x3) . '" ' .
		'y2="' . write_float($y3) . '" ' .
		'stroke="' . $g['line_color'] . '" stroke-width="4" stroke-opacity="0.5"/>' .PHP_EOL ;
}
for($i=0 ; $i<6 ; $i++)
{
	$x0 = 0.5*$g['c_w'] ;
	$y0 = 0.5*$g['c_h'] ;
	$x1 = $x0 +  20*cos($g['offset']+2*$i*pi()/6) ;
	$y1 = $y0 -  20*sin($g['offset']+2*$i*pi()/6)*cos($g['xy_z_angle']) ;
	$x2 = $x0 + $g['hex_r']*cos($g['offset']+2*$i*pi()/6) ;
	$y2 = $y0 - $g['hex_r']*sin($g['offset']+2*$i*pi()/6)*cos($g['xy_z_angle']) ;
	
	$string[] = '<circle ' .
		'cx="' . write_float($x2) . '" ' .
		'cy="' . write_float($y2) . '" ' .
		'r="' . write_float($g['circle_radius']) . '" ' . 
		'stroke="rgb(0,0,255)" stroke-weight="2" fill="rgb(255,255,255)"/>' . PHP_EOL ;
	$string[] = '<text ' . 
		'x="' . write_float($x2) . '" ' . 
		'y="' . write_float($y2) . '" ' . 
		'font-family="georgia" font-style="italic" text-anchor="middle">' . 
		$meson[$i] . 
		'</text>' . PHP_EOL ;
}

// Upper triangle
for($i=0 ; $i<3 ; $i++)
{
	$x0 = 0.5*$g['c_w'] ;
	$y0 = 0.25*$g['c_h'] ;
	$x1 = $x0 + 0*cos($g['offset']+pi()/2+2*$i*pi()/3) ;
	$y1 = $y0 - 0*sin($g['offset']+pi()/2+2*$i*pi()/3)*cos($g['xy_z_angle']) ;
	$x2 = $x0 + $g['tri_r']*cos($g['offset']+pi()/2+2*$i*pi()/3) ;
	$y2 = $y0 - $g['tri_r']*sin($g['offset']+pi()/2+2*$i*pi()/3)*cos($g['xy_z_angle']) ;
	$x3 = $x0 + $g['tri_r']*cos($g['offset']+pi()/2+2*($i+1)*pi()/3) ;
	$y3 = $y0 - $g['tri_r']*sin($g['offset']+pi()/2+2*($i+1)*pi()/3)*cos($g['xy_z_angle']) ;
	
	$string[] = '<line ' .
		'x1="' . write_float($x1) . '" ' .
		'y1="' . write_float($y1) . '" ' .
		'x2="' . write_float($x2) . '" ' .
		'y2="' . write_float($y2) . '" ' .
		'stroke="' . $g['line_color'] . '" stroke-width="4" stroke-opacity="0.5"/>' .PHP_EOL ;
	$string[] = '<line ' .
		'x1="' . write_float($x2) . '" ' .
		'y1="' . write_float($y2) . '" ' .
		'x2="' . write_float($x3) . '" ' .
		'y2="' . write_float($y3) . '" ' .
		'stroke="' . $g['line_color'] . '" stroke-width="4" stroke-opacity="0.5"/>' .PHP_EOL ;
}

for($i=0 ; $i<3 ; $i++)
{
	$x0 = 0.5*$g['c_w'] ;
	$y0 = 0.25*$g['c_h'] ;
	$x2 = $x0 + $g['tri_r']*cos($g['offset']+pi()/2+2*$i*pi()/3) ;
	$y2 = $y0 - $g['tri_r']*sin($g['offset']+pi()/2+2*$i*pi()/3)*cos($g['xy_z_angle']) ;
	
	$string[] = '<circle ' .
		'cx="' . write_float($x2) . '" ' .
		'cy="' . write_float($y2) . '" ' .
		'r="' . write_float($g['circle_radius']) . '" ' . 
		'stroke="rgb(0,0,255)" stroke-weight="2" fill="rgb(255,255,255)"/>' . PHP_EOL ;
	$string[] = '<text ' . 
		'x="' . write_float($x2) . '" ' . 
		'y="' . write_float($y2) . '" ' . 
		'font-family="georgia" font-style="italic" text-anchor="middle">' . 
		$meson[$i+6] . 
		'</text>' . PHP_EOL ;
}

// Lower triangle
for($i=0 ; $i<3 ; $i++)
{
	$x0 = 0.5*$g['c_w'] ;
	$y0 = 0.75*$g['c_h'] ;
	$x1 = $x0 + 0*cos($g['offset']+-pi()/2+2*$i*pi()/3) ;
	$y1 = $y0 - 0*sin($g['offset']+-pi()/2+2*$i*pi()/3)*cos($g['xy_z_angle']) ;
	$x2 = $x0 + $g['tri_r']*cos($g['offset']+-pi()/2+2*$i*pi()/3) ;
	$y2 = $y0 - $g['tri_r']*sin($g['offset']+-pi()/2+2*$i*pi()/3)*cos($g['xy_z_angle']) ;
	$x3 = $x0 + $g['tri_r']*cos($g['offset']+-pi()/2+2*($i+1)*pi()/3) ;
	$y3 = $y0 - $g['tri_r']*sin($g['offset']+-pi()/2+2*($i+1)*pi()/3)*cos($g['xy_z_angle']) ;
	
	$string[] = '<line ' .
		'x1="' . write_float($x1) . '" ' .
		'y1="' . write_float($y1) . '" ' .
		'x2="' . write_float($x2) . '" ' .
		'y2="' . write_float($y2) . '" ' .
		'stroke="' . $g['line_color'] . '" stroke-width="4" stroke-opacity="0.5"/>' .PHP_EOL ;
	$string[] = '<line ' .
		'x1="' . write_float($x2) . '" ' .
		'y1="' . write_float($y2) . '" ' .
		'x2="' . write_float($x3) . '" ' .
		'y2="' . write_float($y3) . '" ' .
		'stroke="' . $g['line_color'] . '" stroke-width="4" stroke-opacity="0.5"/>' .PHP_EOL ;
}

for($i=0 ; $i<3 ; $i++)
{
	$x0 = 0.5*$g['c_w'] ;
	$y0 = 0.75*$g['c_h'] ;
	$x2 = $x0 + $g['tri_r']*cos($g['offset']+-pi()/2+2*$i*pi()/3) ;
	$y2 = $y0 - $g['tri_r']*sin($g['offset']+-pi()/2+2*$i*pi()/3)*cos($g['xy_z_angle']) ;
	
	$string[] = '<circle ' .
		'cx="' . write_float($x2) . '" ' .
		'cy="' . write_float($y2) . '" ' .
		'r="' . write_float($g['circle_radius']) . '" ' . 
		'stroke="rgb(0,0,255)" stroke-weight="2" fill="rgb(255,255,255)"/>' . PHP_EOL ;
	$string[] = '<text ' . 
		'x="' . write_float($x2) . '" ' . 
		'y="' . write_float($y2) . '" ' . 
		'text-anchor="middle">' . $meson[$i+9] . '</text>' . PHP_EOL ;
}

// Quarkonia mesons
for($i=0 ; $i<6 ; $i++)
{
	if($i==0) continue ;
	if($i==3) continue ;
	if($i==1) $j=12 ;
	if($i==2) $j=13 ;
	if($i==4) $j=14 ;
	if($i==5) $j=15 ;
	
	$x0 = 0.5*$g['c_w'] ;
	$y0 = 0.5*$g['c_h'] ;
	$x1 = $x0 + 60*cos($g['offset']+2*$i*pi()/6) ;
	$y1 = $y0 - 60*sin($g['offset']+2*$i*pi()/6)*cos($g['xy_z_angle']) ;
	
	$string[] = '<circle ' .
		'cx="' . write_float($x1) . '" ' .
		'cy="' . write_float($y1) . '" ' .
		'r="' . write_float($g['circle_radius']) . '" ' . 
		'stroke="rgb(0,0,255)" stroke-weight="2" fill="rgb(255,255,255)"/>' . PHP_EOL ;
	$string[] = '<text ' . 
		'x="' . write_float($x1) . '" ' . 
		'y="' . write_float($y1) . '" ' . 
		'font-family="georgia" font-style="italic" text-anchor="middle">' . 
		$meson[$j] . 
		'</text>' . PHP_EOL ;
}

$string[] = '</svg>' . PHP_EOL ;
echo implode($string) ;

function write_int($int){ return sprintf("%d", $int) ; }
function write_float($float){ return sprintf("%.2f", $float) ; }

?>