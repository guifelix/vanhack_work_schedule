<?php

function permutations($values, $size)
{
    $a = array();
    $c = pow(count($values), $size);
    for ($i = 0; $i < $c; $i++) {
        $array = array();
        $count = count($values);
        for ($j = 0; $j < $size; $j++) {
            $selector = ($i / pow($count, $j)) % $count;
            $array[$j] = $values[$selector];
        }
        // $a[$i] = $array;
        yield $array;
    }
    // return $a;
}

function numbersReachSum($target, $days, $maxHours)
{
    $results = [];

    foreach (permutations(range(0, $maxHours), $days) as $permutation) {
        if (array_sum($permutation) == $target) {
            array_push(
                $results,
                implode(',', $permutation)
            );
        }
    }

    return $results;
};

function findSchedules($workHours, $dayHours, $pattern)
{

    // if ($workHours == 56) {
    //     return ['8888888'];
    // }

    $result = [];

    $maxHours = 8;

    $arrayPattern = str_split($pattern);
    $missing_days = count(array_keys($arrayPattern, "?"));
    $openDays = array_keys($arrayPattern, "?");

    $func = function ($value) {
        if ($value == '?') {
            return str_replace('?', '', $value);
        }
        return (int)$value;
    };

    $worked = array_sum(array_map($func, $arrayPattern));

    $dif = $workHours - $worked;

    if ($dif <= 8) {
        $maxHours = $dif;
    }

    $permuts = numbersReachSum($dif, $missing_days, $dayHours);

    foreach ($permuts as $key =***REMOVED*** $permut) {
        $newPattern = array_replace(
            $arrayPattern,
            array_combine($openDays, explode(',', $permuts[$key]))
        );

        array_push($result, implode('', $newPattern));
    }

    // sort($result);
    echo '<pre***REMOVED***';
    print_r($result);
    echo '</pre***REMOVED***';
};

findSchedules(56, 8, '???8???');
// findSchedules(3, 2, '??2??00');
// findSchedules(3, 1, '???????');
