<?php
/*
This program is free and open source, released into the public domain.

Daniel Barnes http://nasonfish.com/

This looks like an awful and unfinished program for 
finding quadratic equations when given different information
about the equations. It looks super awful, I think it's best
to leave it alone.

It was supposed to shot every single step it went through to
find the equation, but I didn't get that far.

It's a web form, so it's not command-line.
*/
if($_GET['submitted'] == 1){
 echo "Our points: (" . $_GET['x1'] . ', ' . $_GET['y1'] . '), (' . $_GET['x2'] . ', ' . $_GET['y2'] . '), (' . $_GET['x3'] . ', ' . $_GET['y3'] . ')<br/><hr/><br/>';
 switch($_GET['type']){
  case '3_nums':
    echo "Okay, we're given 3 random points<br/>";
    echo $_GET['y1'] . " = " . pow($_GET['x1'], 2) . 'a + ' . $_GET['x1'] . 'b + c<br/>';
    echo $_GET['y2'] . " = " . pow($_GET['x2'], 2) . 'a + ' . $_GET['x2'] . 'b + c<br/>';
    echo $_GET['y3'] . " = " . pow($_GET['x3'], 2) . 'a + ' . $_GET['x3'] . 'b + c<br/>';
    echo "Checking if any equations will be able to be used to solve for c...";
    if($_GET['x1'] == 0 || $_GET['x2'] == 0 || $_GET['x3'] == 0){
        echo "yes<br/>";
        if($_GET['x1'] == 0){
           $c = $_GET['y1'];
           $ex1 = $_GET['x2'];
           $ey1 = $_GET['y2'] - $c;
           $ex2 = $_GET['x3'];
           $ey2 = $_GET['y3'] - $c;
        } elseif($_GET['x2'] == 0){
           $c = $_GET['y2'];
           $ex1 = $_GET['x1'];
           $ey1 = $_GET['y1'] - $c;
           $ex2 = $_GET['x3'];
           $ey2 = $_GET['y3'] - $c;
        } else {
           $c = $_GET['y3'];
           $ex1 = $_GET['x1'];
           $ey1 = $_GET['y1'] - $c;
           $ex2 = $_GET['x2'];
           $ey2 = $_GET['y2'] - $c;
        }
        echo 'c = ' . $c . '<br/><hr/><br/>';
        echo "Our equations:<br/>";
        echo $ey1." = " . pow($ex1, 2) . 'a + ' . $ex1 . 'b<br/>';
        echo $ey2." = " . pow($ex2, 2) . 'a + ' . $ex2 . 'b<br/><hr/><br/>';
        echo "Let's multiply by the coefficient of the other b for both equations so we can eliminate!<br/>";
        echo ($ey1 * $ex2) . " = " . ($ex2 * pow($ex1, 2)) . 'a + ' .($ex2 * $ex1).'b<br/>';
        echo "MINUS: " . ($ey2 * $ex1) . " = " . ($ex1 * pow($ex2, 2)) . 'a + ' .($ex1 * $ex2).'b<br/>';
        echo "EQUALS: ". (($ey1 * $ex2) - ($ey2 * $ex1)) . " = " . (($ex2 * pow($ex1, 2)) - ($ex1 * pow($ex2, 2))) . 'a<br/>';
        $a = (($ey1 * $ex2) - ($ey2 * $ex1)) / (($ex2 * pow($ex1, 2)) - ($ex1 * pow($ex2, 2)));
        echo $a . " = a<br/><hr/><br/>";
        echo "Let's plug it in!<br/>";
        echo $ex1 . " = " . (pow($ex1, 2)*$a) . ' + ' . $ex1 . 'b<br/>';
        echo $ex1 - (pow($ex1, 2)*$a) . ' = ' . $ex1 . 'b<br/>';
        $b = ($ex1 - (pow($ex1, 2)*$a)) / $ex1;
        echo $b . ' = b<br/><hr/><br/>';
        echo 'Equation: ' . 'y = ' . $a . 'x^2 + ' . $b . 'x + ' . $c . '<br/><hr/><br/>';
    } else {
      echo "no<br/>";
      echo "If we multiply the 3rd equation by -1 and eliminate the 'c' from the other equations...<br/><hr/><br/>";
      echo (-$_GET['y1']) . " = " . (-pow($_GET['x1'], 2)) . 'a - ' . $_GET['x1'] . 'b - c<br/>';
      echo "MINUS: ".$_GET['y2'] . " = " . pow($_GET['x2'], 2) . 'a + ' . $_GET['x2'] . 'b + c<br/>';
      echo "EQUALS: " . ($_GET['y2'] - $_GET['y1']) . " = " . (pow($_GET['x2'], 2) - pow($_GET['x1'], 2)) . 'a + ' . ($_GET['x2'] - $_GET['x1']) . 'b<br/><hr/><br/>';
      echo (-$_GET['y1']) . " = " . (-pow($_GET['x1'], 2)) . 'a - ' . $_GET['x1'] . 'b - c<br/>';
      echo "MINUS: ".$_GET['y3'] . " = " . pow($_GET['x3'], 2) . 'a + ' . $_GET['x3'] . 'b + c<br/>';
      echo "EQUALS: " . ($_GET['y3'] - $_GET['y1']) . " = " . (pow($_GET['x3'], 2) - pow($_GET['x1'], 2)) . 'a + ' . ($_GET['x3'] - $_GET['x1']) . 'b<br/><hr/><br/>';
      echo "Now, we can solve one system";
    }
    break;
  case 'vertex':
    echo "Vertex equation: y = a(x - h)^2 - k<br/>";
    echo "Vertex: (" . $_GET['x1'] . ', ' . $_GET['y1'] . ")<br/>";
    echo "Start with: y = a(x +" . (-$_GET['x1']) . ')^2 + ' . $_GET['y1'] . '<br/>';
    echo "Plug in other point: " . $_GET['y2'] . ' = a('.$_GET['x2'].' + '.(-$_GET['x1']).')^2  + ' . $_GET['y1'] . '<br/>';
    echo $_GET['y2'] - $_GET['y1'] . ' = a(' . ($_GET['x2'] - $_GET['x1']) . ')^2<br/>';
    $a = ($_GET['y2'] - $_GET['y1']) / pow($_GET['x2'] - $_GET['x1'], 2);
    echo "a = ".($_GET['y2'] - $_GET['y1']) .' / ('. $_GET['x2'] - $_GET['x1'] . ') = ' .($_GET['y2'] - $_GET['y1']) .' / ('. pow($_GET['x2'] - $_GET['x1'], 2) . ') = '. $a . '<br/>';
    echo "Equation: y = " . $a . '(x - ' . $_GET['x1'] . ') + ' . $_GET['y1'] . '<br/><hr/><br/>';
    break;
  case 'zeros':
    break;
 }
}
?>

<form>
<select id="type" name="type">
<option value="3_nums">3 Points</option>
<option value="vertex">Vertex and a point</option>
<option value="zeros">Zeros and a point</option>
</select>
<br/>
(<input name="x1"/>, <input name="y1"/>)
<br/>
(<input name="x2"/>, <input name="y2"/>)
<br/>
(<input name="x3" class="no-v"/>, <input class="no-v" name="y3"/>)
<input name="submitted" value="1" style="display: none;"/>
<button type="submit">Submit!</button>
</form>

<script src="http://nasonfish.com/simpledom.js"></script>
<script>
simpleDOM("#type").bind('click', function(){
if(simpleDOM(this).val() == "vertex"){
simpleDOM(".no-v").hide();
} else {
simpleDOM(".no-v").show();
}
});
</script>

