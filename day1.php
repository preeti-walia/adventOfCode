<?php
$file = fopen("day1.txt", "r");
$inputArr = array();
//Output lines until EOF is reached
while (!feof($file))
{
    $line = fgets($file);
    $inputArr[] = trim($line);
}

fclose($file);
$year = 2020;

echo $output = reportRepair($inputArr, $year);
function reportRepair($inputArr, $year)
{
    $count = 0;$total = 0;
    $inputArrLen = count($inputArr);
    foreach ($inputArr as $k => $v)
    {
        for ($i = 0;$i < $inputArrLen;$i++)
        {
            if ($v != $inputArr[$i])
            {
                $sum = $v + $inputArr[$i];
                if ($sum == $year)
                {
                    $count++;
                    $total = $v * $inputArr[$i];
                }
            }
        }       
        return sprintf("Total expenses for year $year: %d\n",  $total);
       

    }
}