<?php
require_once __DIR__ . '/Person.php';
require_once __DIR__ . '/Student.php';
require_once __DIR__ . '/Teacher.php';
require_once __DIR__ . '/Group.php';
require_once __DIR__ . '/Schooltrip.php';
require_once __DIR__ . '/SchooltripList.php';

use Schooltrip\{Group, Student, Teacher, Schooltrip, SchooltripList};

$groupA = new Group("sod2a");
$groupB = new Group("sod2b");

$trip = new Schooltrip("Efteling");

$list1 = new SchooltripList();
$list1->setTeacher(new Teacher("Koningsstein", 3500));
$list1->addStudentToList(new Student("Piet", $groupA, false));
$list1->addStudentToList(new Student("Jan", $groupA, true));
$list1->addStudentToList(new Student("Kees", $groupA, true));

$list2 = new SchooltripList();
$list2->setTeacher(new Teacher("Brugge", 3400));
$list2->addStudentToList(new Student("Klaas", $groupB, true));
$list2->addStudentToList(new Student("Mohammed", $groupB, false));
$list2->addStudentToList(new Student("Eefje", $groupB, true));

$list3 = new SchooltripList();
$list3->setTeacher(new Teacher("Drimmelen", 3200));
$list3->addStudentToList(new Student("Martijn", $groupB, false));
$list3->addStudentToList(new Student("Pieter", $groupA, true));

$trip->addSchooltripList($list1);
$trip->addSchooltripList($list2);
$trip->addSchooltripList($list3);

echo "<h1>Schooltrip: {$trip->getName()}</h1>";
foreach ($trip->getSchooltripLists() as $list) {
    $teacher = $list->getTeacher()?->getName() ?? "Geen docent";
    echo "<h2>Docent: {$teacher}</h2>";
    echo "<table border='1' cellpadding='5' cellspacing='0'>";
    echo "<tr><th>Student</th><th>Klas</th><th>Betaald</th></tr>";
    foreach ($list->getStudentList() as $student) {
        $paid = $student->hasPaid() ? "Ja" : "Nee";
        echo "<tr><td>{$student->getName()}</td><td>{$student->getClassName()->getName()}</td><td>{$paid}</td></tr>";
    }
    echo "</table><br>";
}
?>
