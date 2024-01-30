<?php

class Farm {
    private $name;
    private $version;
    private $rates;
    private $type;
    private $overworld;
    private $nether;
    private $end;

    public function __construct($name, $version, $rates, $type, $overworld, $nether, $end) {
        $this->setName($name);
        $this->setVersion($version);
        $this->setRates($rates);
        $this->setType($type);
        $this->setOverworld($overworld);
        $this->setNether($nether);
        $this->setEnd($end);
    }
    public function getName() {
        return $this->name;
    }
    private function setName($name) {
        $this->name = $name;
    }
    public function getVersion() {
        return $this->version;
    }
    private function setVersion($version)
    {
        $this->version = $version;
    }
    public function getRates()
    {
        return $this->rates;
    }
    private function setRates($rates)
    {
        $this->rates = $rates;
    }
    public function getType()
    {
        return $this->type;
    }
    private function setType($type)
    {
        $this->type = $type;
    }
    public function getOverworld()
    {
        return $this->overworld;
    }
    private function setOverworld($overworld)
    {
        $this->overworld = $overworld;
    }
    public function getNether()
    {
        return $this->nether;
    }
    private function setNether($nether)
    {
        $this->nether = $nether;
    }
    public function getEnd()
    {
        return $this->end;
    }
    private function setEnd($end)
    {
        $this->end = $end;
    }

    public function getFarm() {
        return array(
            'name' => $this->getName(),
            'version' => $this->getVersion(),
            'rates' => $this->getRates(),
            'type' => $this->getType(),
            'overworld' => $this->getOverworld(),
            'nether' => $this->getNether(),
            'end' => $this->getEnd()
        );
    }
}