<?php

/**
 * Class Farm
 * Отвечает на добавление коров и кур в хлев, вывод информации
 * о численности животных, сбор продуктов и вывод результатов
 */
class Farm
{
    protected $numberOfCows;
    protected $numberOfHens;
    protected $cows;
    protected $hens;

    /**
     * Добавляет животных каждого типа в хлев
     * @param $number int Число животных для добавления в хлев
     * @param $animal string Названия категории животных (коровы, куры)
     */
    public function addAnimals($number, $animal)
    {
        $arr = [];
        for ($i = 0; $i < $number; $i++) $arr[] = array(uniqid() => $animal === 'cow' ? Cow::produceMilk() : Hen::produceEggs());
        if ($animal === 'cow') {
            $this->numberOfCows = $number;
            $this->cows = $arr;
        } else {
            $this->numberOfHens = $number;
            $this->hens = $arr;
        }
    }

    /**
     * Выводит на страницу информацию о численности животных в хлеве
     */
    public function showMessage()
    {
        echo "В хлеве <b>$this->numberOfCows коров</b> и <b>$this->numberOfHens кур</b>.<br/>";
    }

    /**
     * Осуществляет дойку коров и сбор яиц у кур
     * @return array Массив, включающий два массива чисел
     * с количеством продуктов от каждой коровы и курицы
     */
    public function getFood()
    {
        $litresOfMilk = [];
        $numberOfEggs = [];
        for ($i = 0; $i < $this->numberOfCows; $i++) $litresOfMilk[] = Cow::produceMilk();
        for ($i = 0; $i < $this->numberOfHens; $i++) $numberOfEggs[] = Hen::produceEggs();
        return [$litresOfMilk, $numberOfEggs];
    }

    /**
     * Подсчет общего объема надоенного молока
     * и собранных яиц со всех коров и кур на ферме
     */
    function getFinalResult()
    {
        function sum($a, $b)
        {
            $a += $b;
            return $a;
        }

        $litres = array_reduce($this->getFood()[0], 'sum');
        $eggs = array_reduce($this->getFood()[1], 'sum');
        echo "Всего было надоено <b>$litres литров молока</b> и <b>$eggs штук яиц</b>.";
    }
}

class Cow
{
    public function produceMilk()
    {
        return rand(8, 12);
    }
}

class Hen
{
    public function produceEggs()
    {
        return round(rand(0, 1));
    }
}

$farm = new Farm();

// Добавляем в хлев животных
$farm->addAnimals(10, 'cow');
$farm->addAnimals(20, 'hens');

// Вывод на страницу информации о численности животных
$farm->showMessage();

// Вывод общего объема надоенного молока и собранных яиц
// со всех коров и кур на ферме
$farm->getFinalResult();


