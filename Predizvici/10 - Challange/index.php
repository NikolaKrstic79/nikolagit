<?php

interface Printable {
    public function printInfo();
    public function sneakpeek();
    public function fullInfo();
}

class Furniture implements Printable {
    private $width;
    private $length;
    private $height;
    private $is_for_seating;
    private $is_for_sleeping;

    public function __construct($width, $length, $height) {
        $this->width = $width;
        $this->length = $length;
        $this->height = $height;
    }

    public function getForSeating() {
        return $this->is_for_seating;
    }

    public function setForSeating($isForSeating) {
        $this->is_for_seating = $isForSeating;
    }

    public function getForSleeping() {
        return $this->is_for_sleeping;
    }

    public function setForSleeping($isForSleeping) {
        $this->is_for_sleeping = $isForSleeping;
    }

    public function area() {
        return $this->width * $this->length;
    }

    public function volume() {
        return $this->area() * $this->height;
    }

    public function printInfo() {
        $sleepingStatus = $this->is_for_sleeping ? 'sleeping"' : 'sitting only';
        echo get_class($this) . ", $sleepingStatus, " . $this->area() . "cm2<br>";
    }

    public function sneakpeek() {
        echo get_class($this) . "<br>";
    }

    public function fullInfo() {
        $sleepingStatus = $this->is_for_sleeping ? 'sleeping' : 'sitting only';
        echo get_class($this) . ", $sleepingStatus, " . $this->area() . "cm2, width: $this->width cm, length: $this->length cm, height: $this->height cm<br>";
    }
}

class Sofa extends Furniture {
    private $seats;
    private $armrests;
    private $length_opened;

    public function __construct($width, $length, $height) {
        parent::__construct($width, $length, $height);
    }

    public function getSeats() {
        return $this->seats;
    }

    public function setSeats($seats) {
        $this->seats = $seats;
    }

    public function getArmrests() {
        return $this->armrests;
    }

    public function setArmrests($armrests) {
        $this->armrests = $armrests;
    }

    public function getLengthOpened() {
        return $this->length_opened;
    }

    public function setLengthOpened($lengthOpened) {
        $this->length_opened = $lengthOpened;
    }

	public function areaOpened() {
    if ($this->getForSleeping()) {
        return $this->area();
    } else {
        return "This is only sittable, it has $this->armrests armrests and $this->seats seats";
    }
}

}

class Bench extends Sofa {
    public function __construct($width, $length, $height) {
        parent::__construct($width, $length, $height);
    }
}

class Chair extends Furniture {
    public function __construct($width, $length, $height) {
        parent::__construct($width, $length, $height);
    }
}

$furniture = new Furniture(40, 20, 10);
$furniture->setForSeating(true);
$furniture->setForSleeping(false);
$furniture->printInfo();
$furniture->sneakpeek();
$furniture->fullInfo();

$sofa = new Sofa(60, 30, 10);
$sofa->setForSeating(true);
$sofa->setForSleeping(false);
$sofa->setSeats(4);
$sofa->setArmrests(3);
$sofa->setLengthOpened(120);

echo "area: " . $sofa->area() . "cm2<br>";
echo "volume: " . $sofa->volume() . "cm3<br>";
echo $sofa->areaOpened() . "<br>";

$sofa->setForSleeping(true);
$sofa->setLengthOpened(120);

echo $sofa->areaOpened() . "<br>";

$bench = new Bench(30, 10, 10);
$bench->setForSeating(true);
$bench->setForSleeping(true);
$bench->setSeats(3);
$bench->setArmrests(0);
echo $bench->areaOpened() . "<br>";

$chair = new Chair(30, 30, 40);
$chair->setForSeating(true);
$chair->setForSleeping(false);
$chair->printInfo();
$chair->sneakpeek();
$chair->fullInfo();
?>

<!doctype html>
<html lang="en">

<head>
  <title>gangam style</title>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Bootstrap CSS v5.2.1 -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

</head>

<body style="background-color: #333333; color: azure;">
  <header>
    <!-- place navbar here -->
  </header>
  <mains>

  </main>
  <footer>
    <!-- place footer here -->
  </footer>
  <!-- Bootstrap JavaScript Libraries -->
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
    integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous">
  </script>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"
    integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous">
  </script>
</body>

</html>