<?php
function data() {
echo 'Executing db worker';
}
?>

<script>
    setInterval(() => {
        var a = "<?php data();?>";
        console.log('------------'+a+'--------------');
    }, 5000);
    </script>
