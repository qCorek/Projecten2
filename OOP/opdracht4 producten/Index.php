<?php
namespace Webshop;

// ======= Abstracte class Product =======
abstract class Product {
    private string $name;
    private float $purchasePrice;
    private int $tax;
    private float $profit;
    private string $description;
    protected string $category;

    public function __construct(string $name, float $purchasePrice, int $tax, float $profit, string $description) {
        $this->name = $name;
        $this->purchasePrice = $purchasePrice;
        $this->tax = $tax;
        $this->profit = $profit;
        $this->description = $description;
    }

    // Getters
    public function getName(): string {
        return $this->name;
    }

    public function getCategory(): string {
        return $this->category;
    }

    public function getSalesPrice(): float {
        $base = $this->purchasePrice + $this->profit;
        return $base + ($base * $this->tax / 100);
    }

    public function getDescription(): string {
        return $this->description;
    }

    // Abstracte methoden
    abstract public function getInfo(): string;
    abstract public function setCategory(): void;
}


// ======= Music class =======
class Music extends Product {
    private string $artist;
    private array $numbers = [];

    public function __construct(string $name, float $purchasePrice, int $tax, float $profit, string $description, string $artist, array $numbers) {
        parent::__construct($name, $purchasePrice, $tax, $profit, $description);
        $this->artist = $artist;
        $this->numbers = $numbers;
        $this->setCategory();
    }

    public function setArtist(string $artist): void {
        $this->artist = $artist;
    }

    public function addNumber(string $number): void {
        $this->numbers[] = $number;
    }

    public function setCategory(): void {
        $this->category = "Music";
    }

    public function getInfo(): string {
        $html = "<ul>";
        $html .= "<li>{$this->artist}</li>";
        $html .= "<li>Extra info<ul>";
        foreach ($this->numbers as $number) {
            $html .= "<li>{$number}</li>";
        }
        $html .= "</ul></li></ul>";
        return $html;
    }
}


// ======= Movie class =======
class Movie extends Product {
    private string $quality;

    public function __construct(string $name, float $purchasePrice, int $tax, float $profit, string $description, string $quality) {
        parent::__construct($name, $purchasePrice, $tax, $profit, $description);
        $this->quality = $quality;
        $this->setCategory();
    }

    public function setQuality(string $quality): void {
        $this->quality = $quality;
    }

    public function setCategory(): void {
        $this->category = "Movie";
    }

    public function getInfo(): string {
        return "<ul><li>{$this->quality}</li></ul>";
    }
}


// ======= Game class =======
class Game extends Product {
    private string $genre;
    private array $requirements = [];

    public function __construct(string $name, float $purchasePrice, int $tax, float $profit, string $description, string $genre, array $requirements) {
        parent::__construct($name, $purchasePrice, $tax, $profit, $description);
        $this->genre = $genre;
        $this->requirements = $requirements;
        $this->setCategory();
    }

    public function setGenre(string $genre): void {
        $this->genre = $genre;
    }

    public function addRequirement(string $requirement): void {
        $this->requirements[] = $requirement;
    }

    public function setCategory(): void {
        $this->category = "Game";
    }

    public function getInfo(): string {
        $html = "<ul>";
        $html .= "<li>{$this->genre}</li>";
        $html .= "<li>Extra info<ul>";
        foreach ($this->requirements as $req) {
            $html .= "<li>{$req}</li>";
        }
        $html .= "</ul></li></ul>";
        return $html;
    }
}


// ======= ProductList class =======
class ProductList {
    private array $products = [];

    public function addProduct(Product $product): void {
        $this->products[] = $product;
    }

    public function getProducts(): array {
        return $this->products;
    }

    public function showProducts(): void {
        echo "<table border='1' cellpadding='8' style='border-collapse: collapse;'>";
        echo "<tr><th>Category</th><th>Naam product</th><th>Verkoopprijs</th><th>Info</th></tr>";

        foreach ($this->products as $product) {
            echo "<tr>";
            echo "<td>{$product->getCategory()}</td>";
            echo "<td>{$product->getName()}</td>";
            echo "<td>" . number_format($product->getSalesPrice(), 2) . "</td>";
            echo "<td>{$product->getInfo()}</td>";
            echo "</tr>";
        }

        echo "</table>";
    }
}


// ======= TESTDATA =======
$music1 = new Music("Test1", 4.50, 21, 1.00, "Album van Artiest 1", "Artiest 1", ["number 1", "number 2"]);
$music2 = new Music("Test2", 9.00, 21, 2.00, "Album van Artiest 2", "Artiest 2", ["number 3", "number 4"]);

$movie1 = new Movie("Starwars 1", 9.00, 21, 2.00, "Science Fiction", "DVD");
$movie2 = new Movie("Starwars 2", 14.00, 21, 3.00, "Science Fiction", "Blueray");

$game1 = new Game("Call of Duty 1", 4.50, 21, 1.00, "First Person Shooter", "FPS", ["8gb geheugen", "970 GTX"]);
$game2 = new Game("Call of Duty 2", 8.00, 21, 2.00, "First Person Shooter", "FPS", ["16gb geheugen", "2070 RTX"]);

$productList = new ProductList();
$productList->addProduct($music1);
$productList->addProduct($music2);
$productList->addProduct($movie1);
$productList->addProduct($movie2);
$productList->addProduct($game1);
$productList->addProduct($game2);

// ======= OUTPUT =======
echo "<h2>Product Overzicht</h2>";
$productList->showProducts();
?>
