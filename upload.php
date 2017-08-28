<?php
$RE_receptor_n='<.*?Receptor.*?Nombre="(.*?)"';
$RE_receptor='<.*?Receptor.*?"(.*?)"';
$RE_emisor_n='<.*?Emisor.*?Nombre="(.*?)"';
$RE_emisor='<.*?Emisor.*?"(.*?)"';
$RE_fecha='.*?((?:2|1)\d{3}(?:-|\/)(?:(?:0[1-9])|(?:1[0-2]))(?:-|\/)(?:(?:0[1-9])|(?:[1-2][0-9])|(?:3[0-1]))(?:T|\s)(?:(?:[0-1][0-9])|(?:2[0-3])):(?:[0-5][0-9]):(?:[0-5][0-9]))';
$RE_concepto='<.*?Concepto.*?descripcion="(.*?)".*?>';
// subiendo el xml al serve
$target_path = "files/";
$target_path = $target_path . basename( $_FILES['uploadedfile']['name']); if(move_uploaded_file($_FILES['uploadedfile']['tmp_name'], $target_path)) { echo "El archivo ". basename( $_FILES['uploadedfile']['name']). " ha sido subido con exito";
$xmlCont=file_get_contents($target_path);
//Extraer fecha del xml
preg_match_all("/".$RE_fecha."/is",$xmlCont, $matches);
$fechaxmlunix=strtotime($matches[1][0]);
$fechaxmlorig=$matches[1][0];
unset($matches);
//Extraer rfc del receptor
preg_match_all('/'.$RE_receptor.'/is',$xmlCont, $matches);
$rfcxmlre=$matches[1][0]; // RFC del receptor
unset($matches);
preg_match_all('/'.$RE_receptor_n.'/is',$xmlCont, $matches);
$nombrexmlre=$matches[1][0]; // Nombre del receptor
unset($matches);
//Extraer datos  del emisor
preg_match_all('/'.$RE_emisor_n.'/is',$xmlCont, $matches);
$nombrexmlem=$matches[1][0]; //  Nombre del emisor
unset($matches);
preg_match_all('/'.$RE_emisor.'/is',$xmlCont, $matches);
$rfcxmlem=$matches[1][0]; // RFC del receptor
unset($matches);
//Extraer descripcion
preg_match_all('/'.$RE_concepto.'/is',$xmlCont, $matches);
$desxml=implode(", ",$matches[1]); // Descripciones de los conceptos separadas por comas
unset($matches);
//imprimiendo resultados
echo "<br />";
echo "<br />";																															
echo "Nombre del receptor: ".$nombrexmlre."<br />";
echo "RFC: ".$rfcxmlre."<br />";
echo "<br />";																															
echo "Nombre del emisor: ".$nombrexmlem."<br />";
echo "RFC emisor es: ".$rfcxmlem."<br />";
echo "<br />";
echo "Conceptos: ".$desxml."<br />";
echo "Fecha de la operación: ".$fechaxmlorig."<br />";
}else{
echo "Ha ocurrido un error, trate de nuevo!";
}
?>
