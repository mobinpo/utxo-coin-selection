<?php


namespace App\Service\Wallet;

class CoinSelectionAlgorithm
{

    public function select(array $utxos, float $target)
    {
        if (array_search($target, array_column($utxos, 'amount')) !== false) {
            $needed = [$utxos[array_search($target, array_column($utxos, 'amount'))]];
        } elseif (array_sum(array_column($utxos, 'amount')) == $target) {
            $needed = $utxos;
        } elseif (array_sum(array_column($utxos, 'amount')) < $target) {
            $needed = [];
        } else {
            $needed = $this->minSelect($utxos, $target);
        }
        return $needed;
    }

    private function minSelect(array $arr, float $target)
    {
        $min = $this->minGreaterThan($arr, $target);
        if ($min != null) {
            return $this->clean([$min], $target);
        }
        $minNeeded = null;
        $min = $min->amount ?? 0;
        for ($j = 0; $j < 1000; $j++) {
            $arr2 = $arr;
            $needed = [];
            $sum = 0;
            while (true) {
                $i = rand(0, count($arr2) - 1);
                $sum += $arr2[$i]->amount;
                array_push($needed, $arr2[$i]);
                unset($arr2[$i]);
                $arr2 = array_values($arr2);
                if ($sum >= $target) {
                    break;
                }
            }
            if ($minNeeded === null || count($minNeeded) > count($needed) ||
                (count($minNeeded) === count($needed) && $min >= $sum)) {
                $min = array_sum(array_column($needed, 'amount'));
                $minNeeded = $needed;
            }
            if ($min == $target) {
                break;
            }
        }
        return $this->clean($minNeeded, $target);
    }

    private function minGreaterThan(array $arr, float $target)
    {
        usort($arr, function ($a, $b) {
            if ($a->amount == $b->amount) {
                return 0;
            }
            return ($a->amount > $b->amount) ? +1 : -1;
        });
        $min = null;
        foreach ($arr as $item) {
            if ($item->amount >= $target) {
                $min = $item;
                break;
            }
        }
        return $min;
    }

    private function clean(array $arr, float $target)
    {
        usort($arr, function ($a, $b) {
            if ($a->amount == $b->amount) {
                return 0;
            }
            return ($a->amount < $b->amount) ? +1 : -1;
        });
        $needed = [];
        $sum = 0;
        for ($i = 0; $i < count($arr); $i++) {
            $sum += $arr[$i]->amount;
            array_push($needed, $arr[$i]);
            if ($sum >= $target) {
                break;
            }
        }
        return $needed;
    }
}
