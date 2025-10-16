<?php
namespace Hospital;

use DateTime;
use DateInterval;

class Appointment {
    private Patient $patient;
    private Doctor $doctor;
    private array $nurses = [];
    private DateTime $beginTime;
    private DateTime $endTime;

    private static array $appointments = [];
    private static int $count = 0;

    public function __construct(
        Patient $patient,
        Doctor $doctor,
        DateTime $beginTime,
        DateTime $endTime,
        array $nurses = []
    ) {
        $this->patient = $patient;
        $this->doctor = $doctor;
        $this->beginTime = $beginTime;
        $this->endTime = $endTime;
        $this->nurses = $nurses;

        self::$appointments[] = $this;
        self::$count++;
    }

    public static function getAllAppointments(): array {
        return self::$appointments;
    }

    public function getPatient(): Patient {
        return $this->patient;
    }

    public function getDoctor(): Doctor {
        return $this->doctor;
    }

    public function getNurses(): array {
        return $this->nurses;
    }

    public function getBeginTime(): string {
        return $this->beginTime->format('Y-m-d H:i');
    }

    public function getEndTime(): string {
        return $this->endTime->format('Y-m-d H:i');
    }

    public function getTimeDifference(): float {
        $diff = $this->beginTime->diff($this->endTime);
        return $diff->h + ($diff->i / 60);
    }

    public function getCosts(): float {
        $doctorRate = 100.0;  // €100 per uur voor dokter
        $nurseBonus = 20.0;   // €20 per afspraak per nurse
        $hours = $this->getTimeDifference();

        $total = $hours * $doctorRate + (count($this->nurses) * $nurseBonus);
        return $total;
    }
}
