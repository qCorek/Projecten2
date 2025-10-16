<?php
require_once 'classes/Person.php';
require_once 'classes/Patient.php';
require_once 'classes/Staff.php';
require_once 'classes/Doctor.php';
require_once 'classes/Nurse.php';
require_once 'classes/Appointment.php';

use Hospital\{Patient, Doctor, Nurse, Appointment}; 


// Maak objecten aan
$patient1 = new Patient("John Doe", 0);
$doctor1 = new Doctor("Dr. Smith");
$nurse1 = new Nurse("Nurse Jane");
$nurse2 = new Nurse("Nurse Mike");

// Maak afspraken
$appointment1 = new Appointment(
    $patient1,
    $doctor1,
    new DateTime("2025-10-16 10:00"),
    new DateTime("2025-10-16 11:30"),
    [$nurse1, $nurse2]
);

// Salarisberekening (simpele versie)
$doctor1->setSalary($appointment1->getTimeDifference() * 100);
$nurse1->setSalary(500 + 20);  // vast salaris + bonus
$nurse2->setSalary(500 + 20);

// Output
echo "<h2>Appointment Info</h2>";
echo "Patient: " . $appointment1->getPatient()->getName() . "<br>";
echo "Doctor: " . $appointment1->getDoctor()->getName() . "<br>";
echo "Nurses: ";
foreach ($appointment1->getNurses() as $n) {
    echo $n->getName() . " ";
}
echo "<br>";
echo "Duration: " . $appointment1->getTimeDifference() . " hour(s)<br>";
echo "Total cost: €" . $appointment1->getCosts() . "<br>";

echo "<h2>Salaries</h2>";
echo "Doctor salary: €" . $doctor1->getSalary() . "<br>";
echo "Nurse1 salary: €" . $nurse1->getSalary() . "<br>";
echo "Nurse2 salary: €" . $nurse2->getSalary() . "<br>";
