<?php
/*
This program is free and open source, released into the public domain.

Daniel Barnes http://nasonfish.com/

Not exactly python...

This is a program that evaluates exponents of i to values.
It's not complicated, it's not hard, it's not even python, but
it's sort of neat looking.

So, have fun with your eyes! :P

Used by running on a web server, and submitting the form on this page.
*/
?>

<link href='http://fonts.googleapis.com/css?family=IM+Fell+English:400italic' rel='stylesheet' type='text/css'>
<style>
i{
font-family: 'IM Fell English', serif;
margin-right: 5px;
}
</style>
<?php
$y = array(
0 => '1',
1 => '<i>i</i>',
2 => '-1',
3 => '-<i>i</i>'
);
if(isset($_GET['x'])){
    echo '<span style="font-size: 30px;"><i>i</i><span style="vertical-align: super; font-size: 14px;">' . $_GET["x"] . "</span> = ". $y[$_GET["x"] % 4] . '</span>';
}
?>
<form>
  <span style="font-size: 30px;"><i>i</i><span style="vertical-align: super; font-size: 14px;"><input name='x'/></span></span>
  <button style="display: none;" type="submit"> = (Submit!)</button>
</form>
