<?php

namespace lib\models;

use DateTime;
use Exception;
use lib\models\AbstractEntity;
use services\Utils;

class Booking extends AbstractEntity
{
    private int $userId;
    private int $roomId;
    private string $title;
    private DateTime $startAt;
    private DateTime $endAt;
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

    public function getStartAt(): DateTime
    {
        return $this->startAt;
    }

    /**
     * @throws Exception
     */
    public function setStartAt(string $startDate): void
    {
        $this->startAt = new DateTime($startDate);
    }

    public function getEndAt(): DateTime
    {
        return $this->endAt;
    }

    /**
     * @throws Exception
     */
    public function setEndAt(string $endDate): void
    {
        $this->endAt = new DateTime($endDate);
    }

    public function getParticipantsCount(): int
    {
        return $this->participantsCount;
    }

    public function setParticipantsCount(int $participantsCount): void
    {
        $this->participantsCount = $participantsCount;
    }

    /**
     * @throws Exception
     */
    public function getRoomName(): string
    {
        $roomManager = new RoomManager();
        return $roomManager->getById($this->roomId)->getName();
    }

    /**
     * @throws Exception
     */
    public function getFormatedStartDate(int $format): string
    {
        $startDate = $this->startAt;
        return Utils::formatDate($format, $startDate);
    }

    /**
     * @throws Exception
     */
    public function getFormatedStartHour(): string
    {
        $startDate = $this->startAt;
        return $startDate->format("H\hi");
    }

    /**
     * @throws Exception
     */
    public function getFormatedEndDate(int $format): string
    {
        $endDate = $this->endAt;
        return Utils::formatDate($format, $endDate);
    }

    /**
     * @throws Exception
     */
    public function getFormatedEndHour(): string
    {
        $endDate = $this->endAt;
        return $endDate->format("H\hi");
    }

    /**
     * @throws Exception
     */
    public function getUserName(): string
    {
        $userManager = new UserManager();
        return $userManager->getById($this->userId)->getName();
    }

    /**
     * Permits to get the info from the request to build the object
     * @throws Exception
     */
    public function buildFromRequest(): void
    {
        $this->setUserId($_SESSION["user"]["id"]);
        $this->setRoomId(Utils::request("roomSelected"));
        $this->setTitle(htmlspecialchars(Utils::request("title")));
        $this->setStartAt(Utils::request("startDate"));
        $this->setEndAt(Utils::request("endDate"));
        $this->setParticipantsCount(Utils::request("participantCount"));
    }
}
