<?php

$g['c_w'                 ] = 550 ;
$g['c_h'                 ] = 700 ;
$g['x0'                  ] = 0.5*$g['c_w'] ;
$g['y0'                  ] = 0.5*$g['c_h'] ;
$g['offset'              ] = 0.25*pi() ;
if(isset($_GET['phi']) ) $g['offset'] = pi()*$_GET['phi']/180 ;
$g['xy_z_angle'          ] = 0.4*pi() ;
if(isset($_GET['theta']) ) $g['xy_z_angle'] = pi()*$_GET['theta']/180 ;
$g['z_scale'             ] = 0.9 ;
if(isset($_GET['z']) ) $g['z_scale'] = $_GET['z'] ;
$g['circle_radius'       ] = 20 ;
$g['circle_outline'      ] = 'rgb(0,0,0)' ;
$g['circle_stroke_weight'] = 2 ;
$g['circle_fill'         ] = 'rgb(225,225,255)' ;
$g['plane_opacity'       ] = 0.75 ;
$g['plane_fill'          ] = 'rgb(255,200,200)' ;
$g['scale'               ] = 200 ;
$g['axis_color'          ] = 'rgb(0,0,0)' ;
$g['axis_stroke_width'   ] = 2 ;
$g['wire_color'          ] = 'rgb(150,0,150)' ;
$g['wire_stroke_width'   ] = 1 ;
$g['wire_opacity'        ] = 0.4 ;
$g['outline_color'       ] = 'rgb(150,0,0)' ;
$g['outline_stroke_width'] = 4 ;
$g['outline_opacity'     ] = 0.5 ;
$g['font_family'         ] = 'georgia' ;
$g['font_size'           ] = 24 ;

header("Content-type: image/svg+xml") ;
$string[] = '<svg width="' . write_int($g['c_w']) . '" height="' . write_int($g['c_h']) . '" ' ;
$string[] = 'version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">' . PHP_EOL ;

$baryons = array() ;
define_baryons() ;

// Baryon points
$s = 0.25*sqrt(3) ;
$d = 0.15 ;
$p[-1] = xy(  0    ,     0 ,  0 ) ; // Origin

$p[0]  = xy(  1    ,     0 , -1 ) ; // Sigma+
$p[1]  = xy(  0.5  ,  2*$s , -1 ) ; // p
$p[2]  = xy( -0.5  ,  2*$s , -1 ) ; // n
$p[3]  = xy( -1    ,     0 , -1 ) ; // Sigma-
$p[4]  = xy( -0.5  , -2*$s , -1 ) ; // Chi-
$p[5]  = xy(  0.5  , -2*$s , -1 ) ; // Chi0

$p[6]  = xy( -0   ,  0.5    ,  0 ) ; //
$p[7]  = xy( -0   ,  0.5-$d ,  0 ) ; // Lambdac+
$p[8]  = xy( -$s  , -0.25   ,  0 ) ; // Chic0
$p[9]  = xy(  $s  , -0.25   ,  0 ) ; // Chic+
$p[10] = xy(  0   ,  0.5+$d ,  0 ) ; // Sigmac+
$p[11] = xy( -$s  , -0.25   ,  0 ) ; // X
$p[12] = xy(  $s  , -0.25   ,  0 ) ; // X

$p[13] = xy(  2*$s ,  0.5  ,  0 ) ; // Sigamc0
$p[14] = xy( -2*$s ,  0.5  ,  0 ) ; // Sigmac++
$p[15] = xy(  0    , -1    ,  0 ) ; // Omegac0

$p[16] = xy(  0    ,  -0.5 ,  1 ) ; // Omega++
$p[17] = xy(  $s   ,  0.25 ,  1 ) ; // Chic++
$p[18] = xy( -$s   ,  0.25 ,  1 ) ; // Chic+

$p[19] = xy( -0.1  ,  -0.1 , -1 ) ; // Lambda
$p[20] = xy(  0.1  ,   0.1 , -1 ) ; // Sigma0
$g['p'] = $p ;

wire($p[0], $p[13]) ;
wire($p[1], $p[13]) ;
wire($p[2], $p[14]) ;
wire($p[3], $p[14]) ;
wire($p[4], $p[15]) ;
wire($p[5], $p[15]) ;

wire($p[14], $p[18]) ;
wire($p[13], $p[17]) ;
wire($p[15], $p[16]) ;

draw_hexagon_plane_backward() ;
draw_hexagon_outline_backward() ;
draw_upper_triangle_plane(2) ;
draw_upper_triangle_plane(1) ;
draw_top_triangle_plane(2) ;
draw_top_triangle_plane(3) ;
draw_top_triangle_line(3) ;
draw_upper_triangle_line(1) ;
draw_baryon($p[15], 15) ; // eta c hides behind C axis
draw_C_axis() ;
draw_upper_triangle_plane(3) ;
draw_top_triangle_plane(1) ;
draw_hexagon_plane_forward() ;
draw_hexagon_outline_forward() ;
draw_Y_axis() ;
draw_I_axis() ;
draw_upper_triangle_line(2) ;
draw_upper_triangle_line(3) ;
draw_top_triangle_line(1) ;
draw_top_triangle_line(2) ;
for($i=0 ; $i<21 ; $i++){
	if($i==6 ) continue ;
	if($i==11) continue ;
	if($i==12) continue ;
	draw_baryon($p[$i], $baryons[$i]) ;
}

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
	$r0 = xy( 0 , 0   , -1 ) ;
	$r1 = xy( 0 , 1.5 , -1 ) ;
	$r2 = xy( 0 ,-1.5 , -1 ) ;
	axis($r0, $r1) ;
	axis($r0, $r2) ;
	$r3 = xy( -0.1 , 1.4 , -1 ) ;
	$r4 = xy(  0.1 , 1.4 , -1 ) ;
	axis($r1, $r3) ;
	axis($r1, $r4) ;
	$r5 = xy( 0 , 1.7 , -1 ) ;
	label($r5, 'Y') ;
}

function draw_I_axis(){
	$r0 = xy( 0   , 0 , -1 ) ;
	$r1 = xy( 1.5 , 0 , -1 ) ;
	$r2 = xy(-1.5 , 0 , -1 ) ;
	axis($r0, $r1) ;
	axis($r0, $r2) ;
	$r3 = xy(  1.4 ,  0.1 , -1 ) ;
	$r4 = xy(  1.4 , -0.1 , -1 ) ;
	axis($r1, $r3) ;
	axis($r1, $r4) ;
	$r5 = xy( 1.6 , 0 , -1 ) ;
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
	$r1 = $p[$i%3+13] ;
	$r2 = $p[($i+1)%3+13] ;
	outline($r1, $r2) ;
}

function draw_top_triangle_line($i){
	global $g ;
	$p = $g['p'] ;
	$r1 = $p[$i%3+16]  ;
	$r2 = $p[($i+1)%3+16] ;
	outline($r1, $r2) ;
}

function draw_upper_triangle_plane($i){
	global $g ;
	$p = $g['p'] ;
	$q[] = $p[$i%3+13] ;
	$q[] = $p[($i+1)%3+13] ;
	$q[] = xy(0,0,0) ;
	plane($q) ;
}

function draw_top_triangle_plane($i){
	global $g ;
	$p = $g['p'] ;
	$q[] = $p[$i%3+16]  ;
	$q[] = $p[($i+1)%3+16] ;
	$q[] = xy( 0 , 0 , 1 ) ;
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

function draw_baryon($r, $baryon){
	global $g , $string ;
	$string[] = '<circle ' .
		'cx="' . write_float($r['x']) . '" ' .
		'cy="' . write_float($r['y']) . '" ' .
		'r="' . write_float($g['circle_radius']) . '" ' . 
		'stroke="' . $g['circle_outline'] . '" stroke-weight="' . $g['circle_stroke_weight'] . '" fill="' . $g['circle_fill'] . '"/>' . PHP_EOL ;
	draw_character($baryon, $r['x'], $r['y']) ;
}

function define_baryons(){
	global $baryons ;
	
	$Sigma  = '&#x03A3;' ;
	$Chi    = '&#x039E;' ;
	$Lambda = '&#x039B;' ;
	$Omega  = '&#x03A9;' ;
	
	$baryon['name'] = '' ;
		$box['dx'] = -2 ; $box['dy'] =   2 ; $box['text'] = '<tspan>' . $Sigma . '</tspan>'   ; $boxes[] = $box ;
		$box['dx'] = 10 ; $box['dy'] = -10 ; $box['text'] = '<tspan font-size="14">+</tspan>' ; $boxes[] = $box ;
		$baryon['boxes'] = $boxes ;
	$baryons[0] = $baryon ;
	unset($boxes) ;
	unset($baryon) ;
	
	$baryon['name'] = '' ;
		$box['dx'] = 2 ; $box['dy'] =  -2 ; $box['text'] = '<tspan>p</tspan>'   ; $boxes[] = $box ;
		$baryon['boxes'] = $boxes ;
	$baryons[1] = $baryon ;
	unset($boxes) ;
	unset($baryon) ;
	
	$baryon['name'] = '' ;
		$box['dx'] = 0 ; $box['dy'] =   0 ; $box['text'] = '<tspan>n</tspan>'   ; $boxes[] = $box ;
		$baryon['boxes'] = $boxes ;
	$baryons[2] = $baryon ;
	unset($boxes) ;
	unset($baryon) ;
	
	$baryon['name'] = '' ;
		$box['dx'] = -2 ; $box['dy'] =   2 ; $box['text'] = '<tspan>' . $Sigma . '</tspan>'   ; $boxes[] = $box ;
		$box['dx'] = 12 ; $box['dy'] = -10 ; $box['text'] = '<tspan font-size="14">-</tspan>' ; $boxes[] = $box ;
		$baryon['boxes'] = $boxes ;
	$baryons[3] = $baryon ;
	unset($boxes) ;
	unset($baryon) ;
	
	$baryon['name'] = '' ;
		$box['dx'] = -2 ; $box['dy'] =   2 ; $box['text'] = '<tspan>' . $Chi . '</tspan>'   ; $boxes[] = $box ;
		$box['dx'] = 10 ; $box['dy'] = -10 ; $box['text'] = '<tspan font-size="14">-</tspan>' ; $boxes[] = $box ;
		$baryon['boxes'] = $boxes ;
	$baryons[4] = $baryon ;
	unset($boxes) ;
	unset($baryon) ;
	
	$baryon['name'] = '' ;
		$box['dx'] = -2 ; $box['dy'] =   2 ; $box['text'] = '<tspan>' . $Chi . '</tspan>'   ; $boxes[] = $box ;
		$box['dx'] = 10 ; $box['dy'] = -10 ; $box['text'] = '<tspan font-size="14">0</tspan>' ; $boxes[] = $box ;
		$baryon['boxes'] = $boxes ;
	$baryons[5] = $baryon ;
	unset($boxes) ;
	unset($baryon) ;
	
	$baryon['name'] = '' ;
		$baryon['boxes'] = $boxes ;
	$baryons[6] = $baryon ;
	unset($boxes) ;
	unset($baryon) ;
	
	$baryon['name'] = '' ;
		$box['dx'] = -2 ; $box['dy'] =   0 ; $box['text'] = '<tspan>' . $Lambda . '</tspan>'   ; $boxes[] = $box ;
		$box['dx'] = 10 ; $box['dy'] =   7 ; $box['text'] = '<tspan font-size="14">c</tspan>'  ; $boxes[] = $box ;
		$baryon['boxes'] = $boxes ;
	$baryons[7] = $baryon ;
	unset($boxes) ;
	unset($baryon) ;
	
	$baryon['name'] = '' ;
		$box['dx'] = -2 ; $box['dy'] =   2 ; $box['text'] = '<tspan>' . $Chi . '</tspan>'      ; $boxes[] = $box ;
		$box['dx'] = 10 ; $box['dy'] = -10 ; $box['text'] = '<tspan font-size="14">0</tspan>'  ; $boxes[] = $box ;
		$box['dx'] =  8 ; $box['dy'] =   7 ; $box['text'] = '<tspan font-size="14">c</tspan>'  ; $boxes[] = $box ;
		$baryon['boxes'] = $boxes ;
	$baryons[8] = $baryon ;
	unset($boxes) ;
	unset($baryon) ;
	
	$baryon['name'] = '' ;
		$box['dx'] = -2 ; $box['dy'] =   2 ; $box['text'] = '<tspan>' . $Chi . '</tspan>'      ; $boxes[] = $box ;
		$box['dx'] =  8 ; $box['dy'] = -10 ; $box['text'] = '<tspan font-size="14">+</tspan>'  ; $boxes[] = $box ;
		$box['dx'] =  8 ; $box['dy'] =   7 ; $box['text'] = '<tspan font-size="14">c</tspan>'  ; $boxes[] = $box ;
		$baryon['boxes'] = $boxes ;
	$baryons[9] = $baryon ;
	unset($boxes) ;
	unset($baryon) ;
	
	$baryon['name'] = '' ;
		$box['dx'] = -6 ; $box['dy'] =   2 ; $box['text'] = '<tspan>' . $Sigma . '</tspan>'    ; $boxes[] = $box ;
		$box['dx'] =  8 ; $box['dy'] = -10 ; $box['text'] = '<tspan font-size="14">+</tspan>'  ; $boxes[] = $box ;
		$box['dx'] =  8 ; $box['dy'] =   7 ; $box['text'] = '<tspan font-size="14">c</tspan>'  ; $boxes[] = $box ;
		$baryon['boxes'] = $boxes ;
	$baryons[10] = $baryon ;
	unset($boxes) ;
	unset($baryon) ;
	
	$baryon['name'] = '' ;
		$baryon['boxes'] = $boxes ;
	$baryons[11] = $baryon ;
	unset($boxes) ;
	unset($baryon) ;
	
	$baryon['name'] = '' ;
		$baryon['boxes'] = $boxes ;
	$baryons[12] = $baryon ;
	unset($boxes) ;
	unset($baryon) ;
	
	$baryon['name'] = '' ;
		$box['dx'] = -6 ; $box['dy'] =   2 ; $box['text'] = '<tspan>' . $Sigma . '</tspan>'    ; $boxes[] = $box ;
		$box['dx'] =  8 ; $box['dy'] = -10 ; $box['text'] = '<tspan font-size="14">++</tspan>' ; $boxes[] = $box ;
		$box['dx'] =  8 ; $box['dy'] =   7 ; $box['text'] = '<tspan font-size="14">c</tspan>'  ; $boxes[] = $box ;
		$baryon['boxes'] = $boxes ;
	$baryons[13] = $baryon ;
	unset($boxes) ;
	unset($baryon) ;
	
	$baryon['name'] = '' ;
		$box['dx'] = -6 ; $box['dy'] =   2 ; $box['text'] = '<tspan>' . $Sigma . '</tspan>'    ; $boxes[] = $box ;
		$box['dx'] =  8 ; $box['dy'] = -10 ; $box['text'] = '<tspan font-size="14">0</tspan>'  ; $boxes[] = $box ;
		$box['dx'] =  8 ; $box['dy'] =   7 ; $box['text'] = '<tspan font-size="14">c</tspan>'  ; $boxes[] = $box ;
		$baryon['boxes'] = $boxes ;
	$baryons[14] = $baryon ;
	unset($boxes) ;
	unset($baryon) ;
	
	$baryon['name'] = '' ;
		$box['dx'] = -6 ; $box['dy'] =   2 ; $box['text'] = '<tspan>' . $Omega . '</tspan>'    ; $boxes[] = $box ;
		$box['dx'] =  8 ; $box['dy'] = -10 ; $box['text'] = '<tspan font-size="14">0</tspan>'  ; $boxes[] = $box ;
		$box['dx'] =  8 ; $box['dy'] =   7 ; $box['text'] = '<tspan font-size="14">c</tspan>'  ; $boxes[] = $box ;
		$baryon['boxes'] = $boxes ;
	$baryons[15] = $baryon ;
	unset($boxes) ;
	unset($baryon) ;
	
	$baryon['name'] = '' ;
		$box['dx'] = -6 ; $box['dy'] =   2 ; $box['text'] = '<tspan>' . $Omega . '</tspan>'    ; $boxes[] = $box ;
		$box['dx'] =  8 ; $box['dy'] = -10 ; $box['text'] = '<tspan font-size="16">0</tspan>'  ; $boxes[] = $box ;
		$box['dx'] =  8 ; $box['dy'] =   7 ; $box['text'] = '<tspan font-size="14">cc</tspan>'  ; $boxes[] = $box ;
		$baryon['boxes'] = $boxes ;
	$baryons[16] = $baryon ;
	unset($boxes) ;
	unset($baryon) ;
	
	$baryon['name'] = '' ;
		$box['dx'] = -6 ; $box['dy'] =   2 ; $box['text'] = '<tspan>' . $Chi . '</tspan>'    ; $boxes[] = $box ;
		$box['dx'] =  8 ; $box['dy'] = -10 ; $box['text'] = '<tspan font-size="14">++</tspan>'  ; $boxes[] = $box ;
		$box['dx'] =  8 ; $box['dy'] =   7 ; $box['text'] = '<tspan font-size="14">cc</tspan>'  ; $boxes[] = $box ;
		$baryon['boxes'] = $boxes ;
	$baryons[17] = $baryon ;
	unset($boxes) ;
	unset($baryon) ;
	
	$baryon['name'] = '' ;
		$box['dx'] = -6 ; $box['dy'] =   2 ; $box['text'] = '<tspan>' . $Chi . '</tspan>'    ; $boxes[] = $box ;
		$box['dx'] =  8 ; $box['dy'] = -10 ; $box['text'] = '<tspan font-size="14">0</tspan>'  ; $boxes[] = $box ;
		$box['dx'] =  8 ; $box['dy'] =   7 ; $box['text'] = '<tspan font-size="14">cc</tspan>'  ; $boxes[] = $box ;
		$baryon['boxes'] = $boxes ;
	$baryons[18] = $baryon ;
	unset($boxes) ;
	unset($baryon) ;
	
	$baryon['name'] = '' ;
		$box['dx'] = 0 ; $box['dy'] =   2 ; $box['text'] = '<tspan>' . $Lambda . '</tspan>'    ; $boxes[] = $box ;
		$baryon['boxes'] = $boxes ;
	$baryons[19] = $baryon ;
	unset($boxes) ;
	unset($baryon) ;
	
	$baryon['name'] = '' ;
		$box['dx'] = -2 ; $box['dy'] =   2 ; $box['text'] = '<tspan>' . $Sigma . '</tspan>'    ; $boxes[] = $box ;
		$box['dx'] = 10 ; $box['dy'] = -10 ; $box['text'] = '<tspan font-size="14">0</tspan>'  ; $boxes[] = $box ;
		$baryon['boxes'] = $boxes ;
	$baryons[20] = $baryon ;
	unset($boxes) ;
	unset($baryon) ;
	
	/*0  Sigma +
	1  p
	2  n
	3  Sigma -
	4  Chi -
	5  Chi 0
	
	6  -
	7  Lambda c +
	8  Chi c 0
	9  Chi c +
	10 Sigma c +
	11 X
	12 X
	
	13 Sigma 
	14 Sigma 
	15
	
	16
	17
	18
	
	19
	20*/

}

function draw_character($baryon, $x, $y){
	global $g , $string ;
	$boxes = $baryon['boxes'] ;
	if(count($boxes)>0){
		foreach($boxes as $box){
			$box_x = $x + $box['dx'] ;
			$box_y = $y + $box['dy'] + 6 ;
			$string[] = '<text ' . 
				'x="' . $box_x . '" ' . 
				'y="' . $box_y . '" ' . 
				'text-anchor="middle" font-family="' . $g['font_family'] . '" font-style="normal" font-size="24">' . 
				$box['text'] . 
				'</text>' . PHP_EOL ; 
		}
	}
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
	$r['y'] = 0.5*$g['c_h'] + $v - $g['z_scale']*($w-1) ;
	return $r ;
}

?>