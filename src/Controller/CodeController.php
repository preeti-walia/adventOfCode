<?php
namespace App\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Finder\Finder;
class CodeController
{
    /**
     * @Route("/code/day4/part1")
     */
    public function day4a(): Response
    {
        $input = self::read_file('day4a.txt');
        $fields = ['byr', 'iyr', 'eyr', 'hgt', 'hcl', 'ecl', 'pid'];
        $regex = '/(?=.*' . implode(':)(?=.*', $fields) . ':)/';

        $answer = array_reduce(explode(PHP_EOL . PHP_EOL, $input) , function ($carry, $line) use ($regex)
        {
            return $carry += null !== preg_filter($regex, '', str_replace(PHP_EOL, '', $line));
        });

        return new Response('<html><body>Total valid passwords are: ' . $answer . '</body></html>');
    }
    /**
     * @Route("/code/day4/part2")
     */
    public function day4b():Response
    {
        $input = self::read_file('day4b.txt');
        $count = 0;
        $fields = ['byr', 'iyr', 'eyr', 'hgt', 'hcl', 'ecl', 'pid'];
        $regex = '/(?=.*' . implode(':)(?=.*', $fields) . ':)/';

        foreach (explode(PHP_EOL . PHP_EOL, $input) as $passport)
        {
            if (null === preg_filter($regex, '', str_replace(PHP_EOL, '', $passport)))
            {
                continue;
            }
            foreach (preg_split("/[\s,]+/", $passport) as $foundField)
            {
                if (in_array(substr($foundField, 0, 3) , $fields))
                {
                    if (!call_user_func('self::validate' . ucfirst(substr($foundField, 0, 3)) , substr($foundField, 4)))
                    {
                        continue 2;
                    }
                }
            }
            $count++;

        }

        return new Response('<html><body>Total valid passwords are: ' . $count . '</body></html>');
    }

    function validateByr($i)
    {
        return $i >= 1920 && $i <= 2002;
    }

    function validateIyr($i)
    {
        return $i >= 2010 && $i <= 2020;
    }

    function validateEyr($i)
    {
        return $i >= 2020 && $i <= 2030;
    }

    function validateHgt($i)
    {
        return (strpos($i, 'in') !== false && (str_replace('in', '', $i) >= 59 && str_replace('in', '', $i) <= 76)) || (strpos($i, 'cm') !== false && (str_replace('cm', '', $i) >= 150 && str_replace('cm', '', $i) <= 193));
    }

    function validateHcl($i)
    {
        return preg_match('/^#[a-f0-9]{6}/', ($i));
    }

    function validateEcl($i)
    {
        return in_array($i, ['amb', 'blu', 'brn', 'gry', 'grn', 'hzl', 'oth']);
    }

    function validatePid($i)
    {
        return preg_match('/^[0-9]{9}$/', $i);
    }
    /**
     * @Route("/code/day9/part1")
     */
    public function day9a():Response
    {
        $list = self::read_file('day9a.txt');

        $input = explode("\n", $list);
        $preamble = array_splice($input, 0, 25);

        while (self::canBeSumOfTwoTerms(current($input) , $preamble))
        {
            array_shift($preamble);
            $preamble[] = array_shift($input);
        }
        return new Response('<html><body>Invalid Key: ' . current($input) . '</body></html>');

    }

    // function to check a key against <$len> previous fields
    function canBeSumOfTwoTerms($sum, $terms)
    {
        $total = array_fill_keys($terms, true);
        foreach ($terms as $term)
        {
            if (isset($total[$sum - $term]))
            {
                return true;
            }
        }
        return false;
    }

    /**
     * @Route("/code/day9/part2")
     */
    public function day9b():Response
    {

        $list = self::read_file('day9b.txt');

        $input = explode("\n", $list);
        $i = 0;
        // 1124361034 is the output of day9 part1
        while (!$answer = self::testConsecutiveNumbers('1124361034', $i, $input))
        {
            $i++;
        }
        return new Response('<html><body>Invalid Key: ' . $answer . '</body></html>');

    }
    function testConsecutiveNumbers($searchFor, $offset, $input)
    {
        $sum = 0;
        while ($sum < $searchFor)
        {
            $sum += $products[] = $input[$offset++];
        }
        if ($sum == $searchFor)
        {
            return min($products) + max($products);
        }
    }

    function read_file($name)
    {
        $finder = new Finder();
        $files = $finder->files()
            ->name($name)->in(__DIR__);
        foreach ($finder as $file)
        {
            $list = $file->getContents();

        }
        return $list;
    }
}
                
