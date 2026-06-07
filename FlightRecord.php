<?php
require_once 'ManageData.php';

class FlightRecord
{
    private $userId;
    private $aircraft;
    private $departureAirport;
    private $arrivalAirport;
    private $flightDate;
    private $durationMinutes;
    private $flightType;
    private $instructorName;
    private $landings;
    private $remarks;
    private $id;

    public function __construct($userId, $aircraft, $departureAirport, $arrivalAirport, $flightDate, $durationMinutes, $flightType, $instructorName, $landings, $remarks, $id = null)
    {
        $this->userId = $userId;
        $this->aircraft = $aircraft;
        $this->departureAirport = strtoupper($departureAirport);
        $this->arrivalAirport = strtoupper($arrivalAirport);
        $this->flightDate = $flightDate;
        $this->durationMinutes = $durationMinutes;
        $this->flightType = $flightType;
        $this->instructorName = $instructorName;
        $this->landings = $landings;
        $this->remarks = $remarks;
        $this->id = $id;
    }

    public function addFlight()
    {
        $dataManager = new ManageData();

        $query = 'INSERT INTO flight_records(user_id, aircraft, departure_airport, arrival_airport, flight_date, duration_minutes, flight_type, instructor_name, landings, remarks)
                  VALUES(:user_id, :aircraft, :departure_airport, :arrival_airport, :flight_date, :duration_minutes, :flight_type, :instructor_name, :landings, :remarks)';

        $dataManager->executeQuery($query, [
            ':user_id' => $this->userId,
            ':aircraft' => $this->aircraft,
            ':departure_airport' => $this->departureAirport,
            ':arrival_airport' => $this->arrivalAirport,
            ':flight_date' => $this->flightDate,
            ':duration_minutes' => $this->durationMinutes,
            ':flight_type' => $this->flightType,
            ':instructor_name' => $this->instructorName,
            ':landings' => $this->landings,
            ':remarks' => $this->remarks
        ]);
    }

    public function updateFlight()
    {
        $dataManager = new ManageData();

        $query = 'UPDATE flight_records
                  SET aircraft = :aircraft,
                      departure_airport = :departure_airport,
                      arrival_airport = :arrival_airport,
                      flight_date = :flight_date,
                      duration_minutes = :duration_minutes,
                      flight_type = :flight_type,
                      instructor_name = :instructor_name,
                      landings = :landings,
                      remarks = :remarks
                  WHERE id = :id AND user_id = :user_id';

        $dataManager->executeQuery($query, [
            ':aircraft' => $this->aircraft,
            ':departure_airport' => $this->departureAirport,
            ':arrival_airport' => $this->arrivalAirport,
            ':flight_date' => $this->flightDate,
            ':duration_minutes' => $this->durationMinutes,
            ':flight_type' => $this->flightType,
            ':instructor_name' => $this->instructorName,
            ':landings' => $this->landings,
            ':remarks' => $this->remarks,
            ':id' => $this->id,
            ':user_id' => $this->userId
        ]);
    }

    public static function getAllFlights($userId)
    {
        $dataManager = new ManageData();

        $query = 'SELECT * FROM flight_records
                  WHERE user_id = :user_id
                  ORDER BY flight_date DESC, id DESC';

        return $dataManager->getData($query, [':user_id' => $userId]);
    }

    public static function getFlightById($id, $userId)
    {
        $dataManager = new ManageData();

        $query = 'SELECT * FROM flight_records
                  WHERE id = :id AND user_id = :user_id';

        return $dataManager->getData($query, [':id' => $id, ':user_id' => $userId], true);
    }

    public static function deleteFlight($id, $userId)
    {
        $dataManager = new ManageData();

        $query = 'DELETE FROM flight_records
                  WHERE id = :id AND user_id = :user_id';

        $dataManager->executeQuery($query, [':id' => $id, ':user_id' => $userId]);
    }

    public static function getSummary($userId)
    {
        $dataManager = new ManageData();

        $query = 'SELECT COUNT(*) AS total_flights,
                         COALESCE(SUM(duration_minutes), 0) AS total_minutes,
                         COALESCE(SUM(landings), 0) AS total_landings
                  FROM flight_records
                  WHERE user_id = :user_id';

        return $dataManager->getData($query, [':user_id' => $userId], true);
    }

    public static function formatDuration($minutes)
    {
        $hours = floor($minutes / 60);
        $remainingMinutes = $minutes % 60;

        return $hours . 'h ' . $remainingMinutes . 'min';
    }
}
