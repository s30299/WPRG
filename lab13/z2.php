<?php
interface Employee
{
    function getSalary();
    function setSalary($salary);
    function getRole();

}
class Manager implements Employee{
    private  $salary;
    private  $employee = [];

    function __construct()
    {
        $this->salary = 0;
    }
    function addEmployee(Employee $employee){
        $this->employee[] = $employee;
    }
    function getEmployees(){
        echo "Employees_list_start<br>";
        foreach ($this->employee as $employee){
            echo $employee;
        }
        echo "Employees_list_end<br>";

    }
    function getSalary(){
        echo $this->salary."<br>";
    }
    function setSalary($salary){
        $this->salary = $salary;
    }
    function getRole(){
        echo "Manager<br>";
    }
}
class Developer implements Employee{
    private $salary;
    private $programmingLanguage;
    function __construct(){
        $this->salary = 0;
        $this->programmingLanguage = "none";
    }
    function getSalary()
    {
        echo $this->salary."<br>";
    }

    public function setSalary( $salary): void
    {
        $this->salary = $salary;
    }
    function getRole(){
        echo "Developer<br>";
    }
    function setProgrammingLanguage($programmingLanguage): void{
        $this->programmingLanguage = $programmingLanguage;
    }
    function getProgrammingLanguage(){
        echo $this->programmingLanguage."<br>";
    }
    function __toString(){
        return $this->getRole()."<br>".$this->getProgrammingLanguage()."<br>".$this->getSalary();
    }
}
class Designer implements Employee{
    private $salary;
    private $designingTool;
    function __construct(){
        $this->salary = 0;
        $this->designingTool = "none";
    }
    function getSalary()
    {
        echo $this->salary."<br>";
    }

    public function setSalary( $salary): void
    {
        $this->salary = $salary;
    }
    function getRole(){
        echo "Designer<br>";
    }
    function setDesigningTool($DesigningTool): void{
        $this->designingTool = $DesigningTool;
    }
    function getDesigningTool(){
        echo $this->designingTool."<br>";
    }
    function __toString(){
        return $this->getRole()."<br>".$this->getDesigningTool()."<br>".$this->getSalary();
    }
}
$developer = new Developer();
$designer = new Designer();
$manager = new Manager();
$developer->setSalary(1000000);
$designer->setSalary(1000001);
$manager->setSalary(1000002);
$developer->setProgrammingLanguage("php");
$designer->setDesigningTool("php");
$manager->addEmployee($developer);
$manager->addEmployee($designer);
$developer->getRole();
$developer->getProgrammingLanguage();
$developer->getSalary();
$designer->getRole();
$designer->getDesigningTool();
$designer->getSalary();
$manager->getRole();
$manager->getEmployees();
$manager->getSalary();