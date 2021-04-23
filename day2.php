<?php
$file = fopen("day2.txt", "r");
$inputArr = array();
//Output lines until EOF is reached
while (!feof($file))
{
    $line = fgets($file);
    $inputArr[] = trim($line);
}
fclose($file);
echo $output = passwordPhilosophy($inputArr);

/**
 * Each line gives the password policy and then the password. The password policy indicates the lowest and
 * highest number of times a given letter must appear for the password to be valid. For example, 1-3 a means
 * that the password must contain a at least 1 time and at most 3 times.
 * In the above example, 2 passwords are valid. The middle password, cdefg, is not; it contains no instances of b, but needs at least 1.
 * The first and third passwords are valid: they contain one a or nine c, both within the limits of their respective policies.
 * How many passwords are valid according to their policies?
 */
function passwordPhilosophy($input)
{
    $items = $input; //print_r($items);die;
    $correctPasswords = 0;

    // cycle through each line and separate the validation rules from the password, then
    foreach ($items as $item)
    {
        list($rules, $password) = array_map('trim', explode(':', $item));
        // take the elements of the rules you need to match the password against
        preg_match("/(\d+)-(\d+)\s(\w)/", $rules, $matches);
        $letter = $matches[3];

        // get a lest of password letters with their occurrencies
        $letters = array_count_values(str_split($password));
        if (array_key_exists($letter, $letters) && $letters[$letter] >= (int)$matches[1] && $letters[$letter] <= (int)$matches[2])
        {
            $correctPasswords++;
        }
    }

    return sprintf("Correct passwords: %d\n", $correctPasswords);
}

