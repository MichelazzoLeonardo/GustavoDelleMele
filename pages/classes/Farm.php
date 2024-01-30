<?php

class Farm {
    public $name;
    public $version;
    public $rates;
    public $type;
    public $afkable;
    public $overworld;
    public $nether;
    public $end;

    public function __construct($name, $version, $rates, $type, $afkable, $overworld, $nether, $end) {
        $this->setName($name);
        $this->setVersion($version);
        $this->setRates($rates);
        $this->setType($type);
        $this->setAfk($afkable);
        $this->setOverworld($overworld);
        $this->setNether($nether);
        $this->setEnd($end);
    }
    public function getName() {
        return $this->name;
    }
    public function setName($name) {
        $this->name = $name;
    }
    public function getVersion() {
        return $this->version;
    }
    public function setVersion($version)
    {
        $this->version = $version;
    }
    public function getRates()
    {
        return $this->rates;
    }
    public function setRates($rates)
    {
        $this->rates = $rates;
    }
    public function getType()
    {
        return $this->type;
    }
    public function setType($type)
    {
        $this->type = $type;
    }
    public function getAfk()
    {
        return $this->afkable;
    }
    public function setAfk($afk)
    {
        $this->afkable = $afk;
    }
    public function getOverworld()
    {
        return $this->overworld;
    }
    public function setOverworld($overworld)
    {
        $this->overworld = $overworld;
    }
    public function getNether()
    {
        return $this->nether;
    }
    public function setNether($nether)
    {
        $this->nether = $nether;
    }
    public function getEnd()
    {
        return $this->end;
    }
    public function setEnd($end)
    {
        $this->end = $end;
    }

    public function getFarm() {
        return array(
            'name' => $this->getName(),
            'version' => $this->getVersion(),
            'rates' => $this->getRates(),
            'type' => $this->getType(),
            'afkable' => $this->getAfk(),
            'overworld' => $this->getOverworld(),
            'nether' => $this->getNether(),
            'end' => $this->getEnd()
        );
    }
}