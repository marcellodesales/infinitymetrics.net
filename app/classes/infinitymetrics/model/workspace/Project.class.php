<?php
/**
 * Description of Project
 *
 * @author Andres Ardila
 */

class Project
{
    private $name;
    private $leader;
    private $summary;

    public function __construct() {
        //Intentionally left blank.
        //Use builder method to populate object's data members
    }

    public function builder($name, Student $leader, $summary) {
        $this->name = $name;
        $this->leader = $leader;
        $this->summary = $summary;
    }

    public function getName() {
        return $this->name;
    }

    public function getLeader() {
        return $this->leader;
    }

    public function getSummary() {
        return $this->summary;
    }

    public function setName($name) {
        $this->name = $name;
    }

    public function setLeader(Student $leader) {
        $this->leader = $leader;
    }

    public function setSummary($summary) {
        $this->summary = $summary;
    }
}
?>
