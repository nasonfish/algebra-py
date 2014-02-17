<?php
/*
This program is free and open source, released into the public domain.

Daniel Barnes http://nasonfish.com/

Program for evaluating a three-variable system of equations, to find
a quadratic equation. Given in the form of three points, this program uses
complicated-looking stuff to find things out - it likely won't work with
things with zeros as coefficients though.

Oh well. it was a while ago.

Used with ./quadratic_evaluate.php "(x, y), (x, y), (x, y)"
*/
$coords = $argv[1];//"(20, 26) (40, 34) (50, 32)";
$matches = array();
preg_match("/\(([\d]+), ([\d]+)\)[^\(]*\(([\d]+), ([\d]+)\)[^\(]*\(([\d]+), ([\d]+)\)/", $coords, $matches);
$x1=$matches[1];
$y1=$matches[2];
$x2=$matches[3];
$y2=$matches[4];
$x3=$matches[5];
$y3=$matches[6];
//echo $x1 . $y1 . $x2 . $y2 . $x3 . $y3;
//var_dump($matches);
//$a = ((($x1 - $x3) * ($y1 - $y2)) - (($x1 - $x2) * ($y1 - $y3)))/((($x1-$x3)*(pow($x1, 1) - pow($x2, 2))) - (($x1-$x2)*(pow($x1, 2) - pow($x3, 2))));
//$a = (($y1 - $y2) * ($x1 - $x3)) - (($y1 - $y3) * ($x1 - $x2)) / (((($x1 * $x1) - ($x1 * $x1)) * ($x1 - $x3)) - ((($x1 * $x1) - ($x3 * $x3)) * ($x1 - $x2)));
$a = ((($y1 - $y2) * ($x3 - $x2)) - (($y3 - $y2) * ($x1 - $x2))) / (((pow($x1,2) - pow($x2,2)) * ($x3 - $x2)) - ((pow($x3,2) - pow($x2,2)) * ($x1 - $x2)));
$b = (($y1 - $y2) - ((pow($x1, 2) - pow($x2, 2)) * $a)) / ($x1 - $x2);
$c = $y1 - (pow($x1, 2) * $a) - ($x1 * $b);
echo "Equation: y = " . $a . 'x^2 + ' . $b . 'x + ' . $c . "\r\n";
/* 
y1 = ax1^2 + bx1 + c
 y2 = ax2^2 + bx2 + c
 y3 = ax3^2 + bx3 + c
y1 - y2 = a(x1^2 - x2^2) + b(x1 - x2)
y3 - y2 = a(x3^2 - x2^2) + b(x3 - x2)
(y1 - y2)(x3 - x2) =  a(x1^2 - x2^2)(x3 - x2) + b(x1 - x2)(x3 - x2)
(y3 - y2)(x1 - x2) = a(x3^2 - x2^2)(x1 - x2) + b(x3 - x2)(x1 - x2)
(y1 - y2)(x3 - x2) - (y3 - y2)(x1 - x2) = a((x1^2 - x2^2)(x3 - x2) - (x3^2 - x2^2)(x1 - x2))
((y1 - y2)(x3 - x2) - (y3 - y2)(x1 - x2)) / ((x1^2 - x2^2)(x3 - x2) - (x3^2 - x2^2)(x1 - x2)) = a
$a = ((($y1 - $y2) * ($x3 - $x2)) - ($y3 - $y2)($x1 - $x2)) / (((pow($x1,2) - pow($x2,2)) * (x3 - x2)) - ((pow($x3,2) - pow($x2,2)) * (x1 - x2)));
y1 - y2 = ax1^2 - ax1^2 + bx1 - bx2
y1 - y3 = ax1^2 - ax3^2 + bx1 - bx3

(y1 - y2)(bx1 - bx3) = (ax1^2 - ax1^2)(bx1 - bx3) + (bx1 - bx2)(bx1 - bx3)
(y1 - y3)(bx1 - bx2) = (ax1^2 - ax3^2)(bx1 - bx2) + (bx1 - bx3)(bx1 - bx2)
(y1 - y2)(bx1 - bx3) - (y1 - y3)(bx1 - bx2) = a((x1^2 - x1^2)(bx1 - bx3) - (x1^2 - x3^2)(bx1 - bx2))
(y1 - y2)(bx1 - bx3) - (y1 - y3)(bx1 - bx2) / ((x1^2 - x1^2)(bx1 - bx3) - (x1^2 - x3^2)(bx1 - bx2)) = a
*/

