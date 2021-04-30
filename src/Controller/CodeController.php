<?php
namespace App\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Finder\Finder;
class CodeController
{
    /**
     * @Route("/code/day4")
    */
    public function day4():Response
    {
        $list = self::read_file('day4.txt');
        // break passport by empty lines
        $list_new = preg_replace("/\r\n\r\n/", "---", $list);
        $list_new = preg_replace("/\r\n/", " ", $list_new);

        // digest the list as array
        $list_array = explode("---", $list_new);

        // parameters
        $req_array = ['byr', 'iyr', 'eyr', 'hgt', 'hcl', 'ecl', 'pid']; //skipping pid
        $req_pass = 7;

        // treat package by package
        $tot_pass = 0;
        foreach ($list_array as $line)
        {
            // break the line by white spaces
            $line = preg_replace("/\r|\n/", "", $line);
            $line_array = explode(" ", $line);
            // check each key against the list of valid keys
            $req_nb = 0;
            foreach ($line_array as $line_tmp)
            {
                $line_values = explode(":", $line_tmp);

                if (in_array($line_values[0], $req_array))
                {
                    $req_nb++;
                }
            }
            if ($req_nb >= $req_pass)
            {
                $tot_pass++;                
            }            
        }
        // Return result
        $number = random_int(0, 100);

        return new Response('<html><body>Total Valid: ' . $tot_pass . '</body></html>'
        );
    }
    /**
     * @Route("/code/day9")
     */
    public function day9():Response
    {
       
       $list = self::read_file('day9.txt');
        // digest the list as array
        $list_array = explode("\n", $list);
        foreach ($list_array as $key => $line)
        {
            $list_array[$key] = (int)preg_replace("/\r|\n/", "", $line);
        }

        // variables
        $pb_len = 5;

        // test each value after preamble
        for ($i = $pb_len;$i < count($list_array);$i++)
        {
            if (!self::check_sum($list_array, $i, $pb_len))
            {
                break;
            }
        }

        return new Response('<html><body>Invalid Key: ' . $list_array[$i] . '</body></html>'
        );
            
    }

    // function to check a key against <$len> previous fields
    function check_sum($list, $index, $len)
    {
        // keep <$len> previous values
        $list_tmp = array_slice($list, $index - $len, $len);
        rsort($list_tmp);
        $key = $list[$index];

        $found = false;
        foreach ($list_tmp as $value)
        {
            $target = $key - $value;
            if (array_search($target, $list_tmp))
            {
                $found = true;
                break;
            }
        }
        return $found;
    }

    function read_file($name){
    	 $finder = new Finder();
        $files = $finder->files()
            ->name($name)
            ->in(__DIR__);
        foreach ($finder as $file)
        {
            $list = $file->getContents();
            
        }
        return $list;
    }
}
        
