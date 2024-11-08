<?php

namespace lib\models;

use Exception;
use lib\models\AbstractEntity;
use services\Utils;

class Room extends AbstractEntity
{
    private string $name;
    private ?string $place = null;
    private int $capacity;

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function getPlace(): ?string
    {
        return $this->place;
    }

    public function setPlace(?string $place): void
    {
        $this->place = $place;
    }

    public function getCapacity(): int
    {
        return $this->capacity;
    }

    public function setCapacity(int $capacity): void
    {
        $this->capacity = $capacity;
    }

    /**
     * @throws Exception
     */
    public function buildFromRequest(): void
    {
        $this->setName(htmlspecialchars(Utils::request("name")));
        $this->setPlace(htmlspecialchars(Utils::request("place")));
        $this->setCapacity(Utils::request("capacity"));
    }

}