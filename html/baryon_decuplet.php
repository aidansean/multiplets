<?php

$g['c_w'                 ] = 500 ;
$g['c_h'                 ] = 500 ;
$g['x0'                  ] = 0.5*$g['c_w'] ;
$g['y0'                  ] = 0.5*$g['c_h'] ;
$g['offset'              ] = 0 ;
$g['xy_z_angle'          ] = 0 ;
$g['z_scale'] = (isset($_GET['z']) ) ? $_GET['z'] : 0.9 ;
$g['circle_radius'       ] = 20 ;
$g['circle_outline'      ] = 'rgb(0,0,0)' ;
$g['circle_stroke_weight'] = 2 ;
$g['circle_fill'         ] = 'rgb(225,225,255)' ;
$g['plane_opacity'       ] = 0.75 ;
$g['plane_fill'          ] = 'rgb(255,200,200)' ;
$g['scale'               ] = 100 ;
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
$p[-1] = xy(  0    ,     0 , 0 ) ; // Origin

$p[0]  = xy( -1.5  ,  2*$s , 0 ) ; // Delta-
$p[1]  = xy( -0.5  ,  2*$s , 0 ) ; // Delta0
$p[2]  = xy(  0.5  ,  2*$s , 0 ) ; // Delta+
$p[3]  = xy(  1.5  ,  2*$s , 0 ) ; // Delta++

$p[4]  = xy(  1    ,     0 , 0 ) ; // Sigma+*
$p[5]  = xy( -1    ,     0 , 0 ) ; // Sigma-*
$p[6]  = xy(  0.0  ,   0.0 , 0 ) ; // Sigma0*

$p[7]  = xy( -0.5  , -2*$s , 0 ) ; // Chi-
$p[8]  = xy(  0.5  , -2*$s , 0 ) ; // Chi0

$p[9]  = xy(  0.0  , -4*$s , 0 ) ; // Chi0

$g['p'] = $p ;

draw_triangle_plane() ;
draw_triangle_outline() ;
draw_Y_axis() ;
draw_I_axis() ;
draw_JP() ;
draw_uuu() ;
draw_ddd() ;
draw_sss() ;
for($i=0 ; $i<10 ; $i++) draw_baryon($p[$i], $baryons[$i]) ;

$string[] = '</svg>' . PHP_EOL ;
echo implode($string) ;

function draw_Y_axis(){
	$r0 = xy( 0 ,  -2   , 0 ) ;
	$r1 = xy( 0 , 1.15 , 0 ) ;
	$r2 = xy( 0 ,-1.15 , 0 ) ;
	axis($r0, $r1) ;
	axis($r0, $r2) ;
	$r3 = xy( -0.1 , 1.05 , 0 ) ;
	$r4 = xy(  0.1 , 1.05 , 0 ) ;
	axis($r1, $r3) ;
	axis($r1, $r4) ;
	$r5 = xy( -0.1 , 1.4 , 0 ) ;
	label($r5, 'Y') ;
}

function draw_I_axis(){
	$r0 = xy( 0   , 0 ,  0 ) ;
	$r1 = xy( 1.4 , 0 , 0 ) ;
	$r2 = xy(-1.4 , 0 , 0 ) ;
	axis($r0, $r1) ;
	axis($r0, $r2) ;
	$r3 = xy(  1.25 ,  0.1 , 0 ) ;
	$r4 = xy(  1.25 , -0.1 , 0 ) ;
	axis($r1, $r3) ;
	axis($r1, $r4) ;
	$r5 = xy( 1.45 , 0.1 , 0 ) ;
	label($r5, 'I') ;
}

function draw_uuu(){
    global $g , $string , $s ;
    $r = xy(  1.32 , 3*$s , 0) ;
	$string[] = '<text ' .
		'x="' . write_float($r['x']) . '" ' .
		'y="' . write_float($r['y']) . '" ' . 
		'font-family="' . $g['font_family'] . '" font-size="' . $g['font_size'] . '" font-style="italic">' . 'uuu' . '</text>' . PHP_EOL ;
}
function draw_ddd(){
    global $g , $string , $s ;
    $r = xy( -1.72 , 3*$s , 0) ;
	$string[] = '<text ' .
		'x="' . write_float($r['x']) . '" ' .
		'y="' . write_float($r['y']) . '" ' . 
		'font-family="' . $g['font_family'] . '" font-size="' . $g['font_size'] . '" font-style="italic">' . 'ddd' . '</text>' . PHP_EOL ;
}
function draw_sss(){
    global $g , $string , $s ;
    $r = xy( -0.15 , -4.8*$s , 0) ;
	$string[] = '<text ' .
		'x="' . write_float($r['x']) . '" ' .
		'y="' . write_float($r['y']) . '" ' . 
		'font-family="' . $g['font_family'] . '" font-size="' . $g['font_size'] . '" font-style="italic">' . 'sss' . '</text>' . PHP_EOL ;
}

function draw_JP(){
    $x = -1.5 ;
    $y = -1.0 ;
	$r0 = xy( $x      , $y      , 0 ) ;
	$r1 = xy( $x+0.15 , $y-0.1  , 0 ) ;
	$r2 = xy( $x+0.24 , $y      , 0 ) ;
	$r3 = xy( $x+0.42 , $y-0.11 , 0 ) ;
	$r4 = xy( $x+0.46 , $y-0.05 , 0 ) ;
	$r5 = xy( $x+0.49 , $y      , 0 ) ;
	$r6 = xy( $x+0.57 , $y-0.1  , 0 ) ;
	global $g , $string ;
	$string[] = '<text ' .
		'x="' . write_float($r0['x']) . '" ' .
		'y="' . write_float($r0['y']) . '" ' . 
		'font-family="' . $g['font_family'] . '" font-size="' . $g['font_size'] . '" font-style="italic">' . 'J' . '</text>' . PHP_EOL ;
	$string[] = '<text ' .
		'x="' . write_float($r1['x']) . '" ' .
		'y="' . write_float($r1['y']) . '" ' . 
		'font-family="' . $g['font_family'] . '" font-size="' . (0.5*$g['font_size']) . '" font-style="italic">' . 'P' . '</text>' . PHP_EOL ;
	$string[] = '<text ' .
		'x="' . write_float($r2['x']) . '" ' .
		'y="' . write_float($r2['y']) . '" ' . 
		'font-family="' . $g['font_family'] . '" font-size="' . $g['font_size'] . '" font-style="italic">' . '=' . '</text>' . PHP_EOL ;
	$string[] = '<text ' .
		'x="' . write_float($r3['x']) . '" ' .
		'y="' . write_float($r3['y']) . '" ' . 
		'font-family="' . $g['font_family'] . '" font-size="' . (0.7*$g['font_size']) . '" font-style="italic">' . '3' . '</text>' . PHP_EOL ;
	$string[] = '<text ' .
		'x="' . write_float($r4['x']) . '" ' .
		'y="' . write_float($r4['y']) . '" ' . 
		'font-family="' . $g['font_family'] . '" font-size="' . (0.75*$g['font_size']) . '" font-style="italic">' . '/' . '</text>' . PHP_EOL ;
	$string[] = '<text ' .
		'x="' . write_float($r5['x']) . '" ' .
		'y="' . write_float($r5['y']) . '" ' . 
		'font-family="' . $g['font_family'] . '" font-size="' . (0.75*$g['font_size']) . '" font-style="italic">' . '2' . '</text>' . PHP_EOL ;
	$string[] = '<text ' .
		'x="' . write_float($r6['x']) . '" ' .
		'y="' . write_float($r6['y']) . '" ' . 
		'font-family="' . $g['font_family'] . '" font-size="' . (0.75*$g['font_size']) . '" font-style="italic">' . '+' . '</text>' . PHP_EOL ;
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

function draw_triangle_outline(){
	global $g ;
	$p = $g['p'] ;
	$r0 = $p[0] ;
	$r1 = $p[3] ;
	$r2 = $p[9] ;
	outline($r0, $r1) ;
	outline($r1, $r2) ;
	outline($r2, $r0) ;
}

function draw_triangle_plane(){
	global $g ;
	$p = $g['p'] ;
	$q[] = $p[0] ;
	$q[] = $p[3] ;
	$q[] = $p[9] ;
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
	$Delta  = '&#x0394;' ;
	$Chi    = '&#x039E;' ;
	$Lambda = '&#x039B;' ;
	$Omega  = '&#x03A9;' ;
	
	$baryon['name'] = '' ;
		$box['dx'] = -3 ; $box['dy'] =   2 ; $box['text'] = '<tspan>' . $Delta . '</tspan>'   ; $boxes[] = $box ;
		$box['dx'] =  6 ; $box['dy'] = -10 ; $box['text'] = '<tspan font-size="14">-</tspan>' ; $boxes[] = $box ;
		$baryon['boxes'] = $boxes ;
	$baryons[0] = $baryon ;
	unset($boxes) ;
	unset($baryon) ;
	
	$baryon['name'] = '' ;
		$box['dx'] = -3 ; $box['dy'] =   2 ; $box['text'] = '<tspan>' . $Delta . '</tspan>'   ; $boxes[] = $box ;
		$box['dx'] =  6 ; $box['dy'] = -10 ; $box['text'] = '<tspan font-size="14">0</tspan>' ; $boxes[] = $box ;
		$baryon['boxes'] = $boxes ;
	$baryons[1] = $baryon ;
	unset($boxes) ;
	unset($baryon) ;
	
	$baryon['name'] = '' ;
		$box['dx'] = -3 ; $box['dy'] =   2 ; $box['text'] = '<tspan>' . $Delta . '</tspan>'   ; $boxes[] = $box ;
		$box['dx'] =  6 ; $box['dy'] = -10 ; $box['text'] = '<tspan font-size="14">+</tspan>' ; $boxes[] = $box ;
		$baryon['boxes'] = $boxes ;
	$baryons[2] = $baryon ;
	unset($boxes) ;
	unset($baryon) ;
	
	$baryon['name'] = '' ;
		$box['dx'] = -6 ; $box['dy'] =   2 ; $box['text'] = '<tspan>' . $Delta . '</tspan>'   ; $boxes[] = $box ;
		$box['dx'] =  6 ; $box['dy'] = -10 ; $box['text'] = '<tspan font-size="14">++</tspan>' ; $boxes[] = $box ;
		$baryon['boxes'] = $boxes ;
	$baryons[3] = $baryon ;
	unset($boxes) ;
	unset($baryon) ;
	
	$baryon['name'] = '' ;
		$box['dx'] = -8 ; $box['dy'] =   2 ; $box['text'] = '<tspan>' . $Sigma . '</tspan>'   ; $boxes[] = $box ;
		$box['dx'] =  3 ; $box['dy'] =  -3 ; $box['text'] = '<tspan font-size="20">*</tspan>' ; $boxes[] = $box ;
		$box['dx'] = 10 ; $box['dy'] = -10 ; $box['text'] = '<tspan font-size="14">-</tspan>' ; $boxes[] = $box ;
		$baryon['boxes'] = $boxes ;
	$baryons[4] = $baryon ;
	unset($boxes) ;
	unset($baryon) ;
	
	$baryon['name'] = '' ;
		$box['dx'] = -8 ; $box['dy'] =   2 ; $box['text'] = '<tspan>' . $Sigma . '</tspan>'   ; $boxes[] = $box ;
		$box['dx'] =  3 ; $box['dy'] =  -3 ; $box['text'] = '<tspan font-size="20">*</tspan>' ; $boxes[] = $box ;
		$box['dx'] = 10 ; $box['dy'] = -10 ; $box['text'] = '<tspan font-size="14">0</tspan>' ; $boxes[] = $box ;
		$baryon['boxes'] = $boxes ;
	$baryons[5] = $baryon ;
	unset($boxes) ;
	unset($baryon) ;
	
	$baryon['name'] = '' ;
		$box['dx'] = -8 ; $box['dy'] =   2 ; $box['text'] = '<tspan>' . $Sigma . '</tspan>'   ; $boxes[] = $box ;
		$box['dx'] =  3 ; $box['dy'] =  -3 ; $box['text'] = '<tspan font-size="20">*</tspan>' ; $boxes[] = $box ;
		$box['dx'] = 10 ; $box['dy'] = -10 ; $box['text'] = '<tspan font-size="14">+</tspan>' ; $boxes[] = $box ;
		$baryon['boxes'] = $boxes ;
	$baryons[6] = $baryon ;
	unset($boxes) ;
	unset($baryon) ;
	
	$baryon['name'] = '' ;
		$box['dx'] = -8 ; $box['dy'] =   2 ; $box['text'] = '<tspan>' . $Chi . '</tspan>'     ; $boxes[] = $box ;
		$box['dx'] =  3 ; $box['dy'] =  -3 ; $box['text'] = '<tspan font-size="20">*</tspan>' ; $boxes[] = $box ;
		$box['dx'] = 10 ; $box['dy'] = -10 ; $box['text'] = '<tspan font-size="14">+</tspan>' ; $boxes[] = $box ;
		$baryon['boxes'] = $boxes ;
	$baryons[7] = $baryon ;
	unset($boxes) ;
	unset($baryon) ;
	
	$baryon['name'] = '' ;
		$box['dx'] = -8 ; $box['dy'] =   2 ; $box['text'] = '<tspan>' . $Chi . '</tspan>'     ; $boxes[] = $box ;
		$box['dx'] =  3 ; $box['dy'] =  -3 ; $box['text'] = '<tspan font-size="20">*</tspan>' ; $boxes[] = $box ;
		$box['dx'] = 10 ; $box['dy'] = -10 ; $box['text'] = '<tspan font-size="14">-</tspan>' ; $boxes[] = $box ;
		$baryon['boxes'] = $boxes ;
	$baryons[8] = $baryon ;
	unset($boxes) ;
	unset($baryon) ;
	
	$baryon['name'] = '' ;
		$box['dx'] = -2 ; $box['dy'] =   2 ; $box['text'] = '<tspan>' . $Omega . '</tspan>'   ; $boxes[] = $box ;
		$box['dx'] = 10 ; $box['dy'] = -10 ; $box['text'] = '<tspan font-size="14">-</tspan>' ; $boxes[] = $box ;
		$baryon['boxes'] = $boxes ;
	$baryons[9] = $baryon ;
	unset($boxes) ;
	unset($baryon) ;
	
	/*
	0  Sigma +
	1  p
	2  n
	3  Sigma -
	4  Chi -
	5  Chi 0
	6  Lambda
	7  Sigma 0
	*/

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