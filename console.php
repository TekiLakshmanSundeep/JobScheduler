<?php 
$appRoot = __DIR__;
$cmd = "php $appRoot/console schedule:run";
$outputPath = '/dev/null';
$cmd = "$cmd > $outputPath &";
$sleep = 60; //$input->getOption('sleep');
 echo $appRoot;
while (true) {
    exec($cmd);
    echo 'Executed ok';
    sleep($sleep);
}
?>