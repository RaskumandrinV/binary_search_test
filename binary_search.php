<?
function binarySearch($file_name,$key) {
    $file = new SplFileObject($file_name);

    $beg = 0;
    $file->seek($file->getSize());
    $end = $file->key();

    while($beg<=$end) {
        $middle_value = floor(($beg+$end)/2);
        $file->seek($middle_value);
        $delimeter = "\t";
        $exploded_string = explode($delimeter,$file->current());
        $string_compare=strnatcmp($exploded_string[0],$key);
        if($string_compare>0){
            $end = $middle_value-1;
        } elseif($string_compare<0) {
            $beg = $middle_value+1;
        } else {
            return $exploded_string[1];
        }
    }
    return 'undef';
}

$file = 'file.txt';
$key = 'key343';
echo binarySearch($file,$key)."<br />";
?>