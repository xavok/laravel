<?php
$schema = file_get_contents('schema.json');
echo "<?php\n\$schema = ";
var_export(json_decode($schema, true));
echo ";\n";
?>
