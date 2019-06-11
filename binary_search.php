<?
function binarySearch ($file,$key){
    $handle = fopen($file, "r");
    $end_of_block = '';
    $arr = '';
    while(!feof($handle)){
        $inner_block = fgets($handle,4000);
        mb_convert_encoding($inner_block,'cp1251');
        $inner_block = $end_of_block.$inner_block;
        $end_of_block = preg_replace('/ключ.*x0A/i','',$inner_block);
        $length_end_of_block = -1 * strlen($end_of_block);
        $inner_block = substr($inner_block, 0, $length_end_of_block);
        $exploded = explode('\x0A',$inner_block);
        array_pop($exploded);
        foreach($exploded as $k=>$v){
            $arr[] = explode('\t',$v);
        }
        $begin = 0;
        $end = count($arr)-1;
        while($begin<=$end) {
            $middle_value = floor(($begin+$end)/2);
            $string_compare=strnatcmp($arr[$middle_value][0],$key);
            if($string_compare>0){
                $end = $middle_value-1;
            } elseif($string_compare<0) {
                $begin = $middle_value+1;
            } else {
                return $arr[$middle_value][1];
            }
        }
    }
    return 'undefined';
}

$file = 'file.txt';
$key = 'ключ343';
echo binarySearch($file,$key)."<br />";
?>