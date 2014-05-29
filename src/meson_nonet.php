<?php

$g['c_w'                 ] = 600 ;
$g['c_h'                 ] = 600 ;
$g['x0'                  ] = 0.5*$g['c_w'] ;
$g['y0'                  ] = 0.5*$g['c_h'] ;
$g['offset'              ] = 0.25*pi() ;
$g['xy_z_angle'          ] = pi()/3 ;
$g['z_scale'             ] = 0.8 ;
$g['circle_radius'       ] = 20 ;
$g['circle_outline'      ] = 'rgb(0,0,0)' ;
$g['circle_stroke_weight'] = 2 ;
$g['circle_fill'         ] = 'rgb(225,225,255)' ;
$g['plane_opacity'       ] = 0.75 ;
$g['plane_fill'          ] = 'rgb(200,255,200)' ;
$g['scale'               ] = 200 ;
$g['axis_color'          ] = 'rgb(0,0,0)' ;
$g['axis_stroke_width'   ] = 2 ;
$g['wire_color'          ] = 'rgb(0,0,150)' ;
$g['wire_stroke_width'   ] = 1 ;
$g['wire_opacity'        ] = 0.2 ;
$g['outline_color'       ] = 'rgb(0,150,0)' ;
$g['outline_stroke_width'] = 4 ;
$g['outline_opacity'     ] = 0.5 ;
$g['font_family'         ] = 'Georgia' ;
$g['font_size'           ] = 24 ;

header("Content-type: image/svg+xml") ;
$string[] = '<svg width="' . write_int($g['c_w']) . '" height="' . write_int($g['c_h']) . '" ' ;
$string[] = 'version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">' . PHP_EOL ;

$meson = array() ;
define_mesons() ;

// Meson points
$s = 0.25*sqrt(3) ;
$p[-1] = xy(  0    ,     0 ,  0 ) ; // Origin

$p[0]  = xy(  1    ,     0 ,  0 ) ; // pi+
$p[1]  = xy(  0.5  ,  2*$s ,  0 ) ; // K+
$p[2]  = xy( -0.5  ,  2*$s ,  0 ) ; // K0
$p[3]  = xy( -1    ,     0 ,  0 ) ; // pi-
$p[4]  = xy( -0.5  , -2*$s ,  0 ) ; // K-
$p[5]  = xy(  0.5  , -2*$s ,  0 ) ; // K0bar

$p[6]  = xy(  0    ,   0.5 ,  1 ) ; // Ds+
$p[7]  = xy( -$s   , -0.25 ,  1 ) ; // D0
$p[8]  = xy(  $s   , -0.25 ,  1 ) ; // D+

$p[9]  = xy(  0    ,  -0.5 , -1 ) ; // Ds-
$p[10] = xy(  $s   ,  0.25 , -1 ) ; // D0bar
$p[11] = xy( -$s   ,  0.25 , -1 ) ; // D-

$p[12] = xy(  0.15 ,  0.2 ,  0 ) ; // pi0
$p[13] = xy( -0.15 ,  0.2 ,  0 ) ; // eta
$p[14] = xy( -0.15 , -0.2 ,  0 ) ; // eta'
$p[15] = xy(  0.15 , -0.2 ,  0 ) ; // etac
$g['p'] = $p ;

//wire($p[4], $p[6]) ;
//wire($p[5], $p[6]) ;

wire($p[0], $p[8] ) ;
wire($p[0], $p[10]) ;
wire($p[1], $p[6] ) ;
wire($p[1], $p[10]) ;
wire($p[2], $p[6] ) ;
wire($p[2], $p[11]) ;
wire($p[3], $p[7] ) ;
wire($p[3], $p[11]) ;
wire($p[4], $p[7] ) ;
wire($p[4], $p[9] ) ;
wire($p[5], $p[8] ) ;
wire($p[5], $p[9] ) ;

wire($p[], $p[]) ;

draw_hexagon_plane_backward() ;
draw_hexagon_outline_backward() ;
draw_upper_triangle_plane(2) ;
draw_upper_triangle_plane(1) ;
draw_lower_triangle_plane(2) ;
draw_lower_triangle_plane(3) ;
draw_lower_triangle_line(3) ;
draw_upper_triangle_line(1) ;
draw_meson($p[15], 15) ; // eta c hides behind C axis
draw_C_axis() ;
draw_upper_triangle_plane(3) ;
draw_lower_triangle_plane(1) ;
draw_hexagon_plane_forward() ;
draw_hexagon_outline_forward() ;
draw_Y_axis() ;
draw_I_axis() ;
draw_upper_triangle_line(2) ;
draw_upper_triangle_line(3) ;
draw_lower_triangle_line(1) ;
draw_lower_triangle_line(2) ;
for($i=0 ; $i<15 ; $i++) draw_meson($p[$i], $i) ;

$string[] = '</svg>' . PHP_EOL ;
echo implode($string) ;

function draw_C_axis(){
	$r0 = xy( 0 , 0 , 0   ) ;
	$r1 = xy( 0 , 0 , 1.6 ) ;
	$r2 = xy( 0 , 0 ,-1.6 ) ;
	axis($r0, $r1) ;
	axis($r0, $r2) ;
	$r3 = xy( 0 , -0.1 , 1.5 ) ;
	$r4 = xy( 0 ,  0.1 , 1.5 ) ;
	axis($r1, $r3) ;
	axis($r1, $r4) ;
	$r5 = xy( 0 , 0 , 1.7 ) ;
	label($r5, 'C') ;
}

function draw_Y_axis(){
	$r0 = xy( 0 , 0   , 0 ) ;
	$r1 = xy( 0 , 1.5 , 0 ) ;
	$r2 = xy( 0 ,-1.5 , 0 ) ;
	axis($r0, $r1) ;
	axis($r0, $r2) ;
	$r3 = xy( -0.1 , 1.4 , 0 ) ;
	$r4 = xy(  0.1 , 1.4 , 0 ) ;
	axis($r1, $r3) ;
	axis($r1, $r4) ;
	$r5 = xy( 0 , 1.7 , 0 ) ;
	label($r5, 'Y') ;
}

function draw_I_axis(){
	$r0 = xy( 0   , 0 , 0 ) ;
	$r1 = xy( 1.5 , 0 , 0 ) ;
	$r2 = xy(-1.5 , 0 , 0 ) ;
	axis($r0, $r1) ;
	axis($r0, $r2) ;
	$r3 = xy(  1.4 ,  0.1 , 0 ) ;
	$r4 = xy(  1.4 , -0.1 , 0 ) ;
	axis($r1, $r3) ;
	axis($r1, $r4) ;
	$r5 = xy( 1.6 , 0 , 0 ) ;
	label($r5, 'I') ;
}

function label($r, $text){
	global $g , $string ;
	$string[] = '<text ' .
		'x="' . write_float($r['x']) . '" ' .
		'y="' . write_float($r['y']) . '" ' .
		'font-family="' . $g['font_family'] . '" font-size="' . $g['font_size'] . '" font-style="italic">' . 
		$text . 
		'</text>' . PHP_EOL ;
}

function draw_hexagon_outline_backward(){
	global $g ;
	$p = $g['p'] ;
	$r0 = $p[3] ;
	$r1 = $p[4] ;
	$r2 = $p[5] ;
	$r3 = $p[0] ;
	outline($r0, $r1) ;
	outline($r1, $r2) ;
	outline($r2, $r3) ;
}

function draw_hexagon_outline_forward(){
	global $g ;
	$p = $g['p'] ;
	$r0 = $p[0] ;
	$r1 = $p[1] ;
	$r2 = $p[2] ;
	$r3 = $p[3] ;
	outline($r0, $r1) ;
	outline($r1, $r2) ;
	outline($r2, $r3) ;
}

function draw_hexagon_plane_backward(){
	global $g ;
	$p = $g['p'] ;
	$q[] = $p[3] ;
	$q[] = $p[4] ;
	$q[] = $p[5] ;
	$q[] = $p[0] ;
	plane($q) ;
}

function draw_hexagon_plane_forward(){
	global $g ;
	$p = $g['p'] ;
	$q[] = $p[0] ;
	$q[] = $p[1] ;
	$q[] = $p[2] ;
	$q[] = $p[3] ;
	plane($q) ;
}

function draw_upper_triangle_line($i){
	global $g ;
	$p = $g['p'] ;
	$r1 = $p[$i%3+6] ;
	$r2 = $p[($i+1)%3+6] ;
	outline($r1, $r2) ;
}

function draw_lower_triangle_line($i){
	global $g ;
	$p = $g['p'] ;
	$r1 = $p[$i%3+9]  ;
	$r2 = $p[($i+1)%3+9] ;
	outline($r1, $r2) ;
}

function draw_upper_triangle_plane($i){
	global $g ;
	$p = $g['p'] ;
	$q[] = $p[$i%3+6] ;
	$q[] = $p[($i+1)%3+6] ;
	$q[] = xy(0,0,1) ;
	plane($q) ;
}

function draw_lower_triangle_plane($i){
	global $g ;
	$p = $g['p'] ;
	$q[] = $p[$i%3+9]  ;
	$q[] = $p[($i+1)%3+9] ;
	$q[] = xy( 0 , 0 , -1 ) ;
	plane($q) ;
}

function axis($r1, $r2){
	global $g , $string ;
	$string[] = '<line ' .
		'x1="' . write_float($r1['x']) . '" ' .
		'y1="' . write_float($r1['y']) . '" ' .
		'x2="' . write_float($r2['x']) . '" ' .
		'y2="' . write_float($r2['y']) . '" ' .
		'stroke="' . $g['axis_color'] . '" stroke-width="' . $g['axis_stroke_width'] . '" />' .PHP_EOL ;
}

function outline($r1, $r2){
	global $g , $string ;
	$string[] = '<line ' .
		'x1="' . write_float($r1['x']) . '" ' .
		'y1="' . write_float($r1['y']) . '" ' .
		'x2="' . write_float($r2['x']) . '" ' .
		'y2="' . write_float($r2['y']) . '" ' .
		'stroke="' . $g['outline_color'] . '" stroke-width="' . $g['outline_stroke_width'] . '" />' .PHP_EOL ;
}

function plane($p){
	global $g , $string ;
	$q = $p[count($p)-1] ;
	$str = '<path d="M ' . write_float($q['x']) . ',' . write_float($q['y']) . ' ' ; 
	for($i=0 ; $i<count($p) ; $i++)
	{
		$r = $p[$i] ;
		$str = $str . 'L ' . write_float($r['x']) . ',' . write_float($r['y']) . ' ' ;
	}
	$str = $str . '" stroke-width="0" fill="' . $g['plane_fill'] . '" fill-opacity="' . $g['plane_opacity'] . '" />' .PHP_EOL ; ;
	$string[] = $str ;
}

function wire($r1, $r2){
	global $g , $string ;
	$string[] = '<line ' .
		'x1="' . write_float($r1['x']) . '" ' .
		'y1="' . write_float($r1['y']) . '" ' .
		'x2="' . write_float($r2['x']) . '" ' .
		'y2="' . write_float($r2['y']) . '" ' .
		'stroke="' . $g['wire_color'] . '" stroke-width="' . $g['wire_stroke_width'] . '" opacity="' . $g['wire_opacity'] . '"/>' .PHP_EOL ;
}

function draw_meson($r, $m){
	global $g , $string , $meson ;
	$string[] = '<circle ' .
		'cx="' . write_float($r['x']) . '" ' .
		'cy="' . write_float($r['y']) . '" ' .
		'r="' . write_float($g['circle_radius']) . '" ' . 
		'stroke="' . $g['circle_outline'] . '" stroke-weight="' . $g['circle_stroke_weight'] . '" fill="' . $g['circle_fill'] . '"/>' . PHP_EOL ;
	$string[] = '<text ' . 
		'x="' . write_float($r['x']) . '" ' . 
		'y="' . write_float($r['y']) . '" ' . 
		'font-family="georgia" font-style="italic" text-anchor="middle">' . 
		$meson[$m] . 
		'</text>' . PHP_EOL ;
}

function define_mesons(){
	global $meson ;
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
}

function write_int($int){ return sprintf("%d", $int) ; }
function write_float($float){ return sprintf("%.2f", $float) ; }

function xy($u, $v, $w){
	global $g ;
	// Rotate in u-v plane
	$u = $u*$g['scale'] ;
	$v = $v*$g['scale'] ;
	$w = $w*$g['scale'] ;
	$u_new = $u*cos($g['offset']) + $v*sin($g['offset']) ;
	$v_new = $v*cos($g['offset']) - $u*sin($g['offset']) ;
	$u = $u_new ;
	$v = $v_new ;
	// Rotate v back into plane
	$v = $v*cos($g['xy_z_angle']) ;
	$r['x'] = 0.5*$g['c_w'] + $u ;
	$r['y'] = 0.5*$g['c_h'] + $v - $g['z_scale']*$w ;
	return $r ;
}

?>