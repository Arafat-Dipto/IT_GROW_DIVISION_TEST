<?php

class Connection
{
    public $conn;

    public function __construct()
    {
        $this->conn = new PDO("mysql:host=localhost;dbname=test", "root", "");
    }

    //get all contacts
    public function getList()
    {
        $statement = $this->conn->prepare("SELECT * FROM events");
        $statement ->execute();
        $data = $statement->fetchAll();
        return $data;
    }

    //get all employees
    public function getEmployees()
    {
        $statement = $this->conn->prepare("SELECT employee_name FROM `events` GROUP By employee_name;");
        $statement ->execute();
        $data = $statement->fetchAll();
        return $data;
    }

    //get all events
    public function getEvents()
    {
        $statement = $this->conn->prepare("SELECT event_name FROM `events` GROUP By event_name;");
        $statement ->execute();
        $data = $statement->fetchAll();
        return $data;
    }

    //get all event dates
    public function getEventDates()
    {
        $statement = $this->conn->prepare("SELECT event_date FROM `events` GROUP By event_date;");
        $statement ->execute();
        $data = $statement->fetchAll();
        return $data;
    }

    //add a contact
    public function addData($participation_id, $employee_name, $employee_mail, $event_id, $event_name, $participation_fee, $event_date)
    {
        $statement = $this->conn->prepare("INSERT INTO events (participation_id,employee_name,employee_mail,event_id,event_name,participation_fee,event_date) VALUES(:participation_id,:employee_name,:employee_mail,:event_id,:event_name,:participation_fee,:event_date)");
        $statement->execute(
            array(
                ':participation_id'  => $participation_id,
                ':employee_name'     => $employee_name,
                ':employee_mail'     => $employee_mail,
                ':event_id'          => $event_id,
                ':event_name'        => $event_name,
                ':participation_fee' => $participation_fee,
                ':event_date'        => $event_date
            )
        );
    }

}
