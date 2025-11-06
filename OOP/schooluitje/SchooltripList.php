<?php
namespace Schooltrip;

class SchooltripList {
    private array $studentList = [];
    private ?Teacher $teacher = null;

    public function addStudentToList(Student $student): void {
        $this->studentList[] = $student;
    }

    public function setTeacher(Teacher $teacher): void {
        $this->teacher = $teacher;
    }

    public function getStudentList(): array {
        return $this->studentList;
    }

    public function getTeacher(): ?Teacher {
        return $this->teacher;
    }

    public function getPaidStudents(): array {
        return array_filter($this->studentList, fn($s) => $s->hasPaid());
    }
}
