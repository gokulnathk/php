<?php
fscanf(STDIN, "%d\n", $n);
$count = 0;
for ($i = 5; $n/$i >= 1; $i *=5) {
    $count += floor($n/$i);
}
echo $count;
?>