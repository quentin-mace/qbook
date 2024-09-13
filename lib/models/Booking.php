<?php

namespace lib\models;

use DateTime;
use lib\models\AbstractEntity;

class Booking extends AbstractEntity
{
    private int $userId;
    private int $roomId;
    private string $title;
    private ?DateTime $startDate;
    private ?DateTime $endDate;
    private int $participantsCount;

    public function getUserId(): int
    {
        return $this->userId;
    }

    public function setUserId(int $userId): void
    {
        $this->userId = $userId;
    }

    public function getRoomId(): int
    {
        return $this->roomId;
    }

    public function setRoomId(int $roomId): void
    {
        $this->roomId = $roomId;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function setTitle(string $title): void
    {
        $this->title = $title;
    }

    public function getStartDate(): ?DateTime
    {
        return $this->startDate;
    }

    public function setStartDate(?DateTime $startDate): void
    {
        $this->startDate = $startDate;
    }

    public function getEndDate(): ?DateTime
    {
        return $this->endDate;
    }

    public function setEndDate(?DateTime $endDate): void
    {
        $this->endDate = $endDate;
    }

    public function getParticipantsCount(): int
    {
        return $this->participantsCount;
    }

    public function setParticipantsCount(int $participantsCount): void
    {
        $this->participantsCount = $participantsCount;
    }
}