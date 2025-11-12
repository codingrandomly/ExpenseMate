<?php
/**
 * ExpenseMate Configuration & Database Class
 * UNIT-III: OOP - Classes, Objects, File I/O, Exception Handling
 */

session_start();

// ============== UNIT-III: Object-Oriented Programming ==============

/**
 * Category Class - UNIT-III: Classes and Objects
 */
class Category
{
    private $id;
    protected $name;
    private $icon;
    private $color;

    public function __construct($id, $name, $icon, $color)
    {
        $this->id = $id;
        $this->name = $name;
        $this->icon = $icon;
        $this->color = $color;
    }

    public function getId() { return $this->id; }
    public function getName() { return $this->name; }
    public function getIcon() { return $this->icon; }
    public function getColor() { return $this->color; }
}

/**
 * Expense Class - UNIT-III: Classes and Objects
 */
class Expense
{
    private $id;
    private $date;
    private $category;
    private $description;
    private $amount;
    private $notes;

    public function __construct($id, $date, $category, $description, $amount, $notes = "")
    {
        $this->id = $id;
        $this->date = $date;
        $this->category = $category;
        $this->description = $description;
        $this->amount = (float)$amount;
        $this->notes = $notes;
    }

    public function getId() { return $this->id; }
    public function getDate() { return $this->date; }
    public function getCategory() { return $this->category; }
    public function getDescription() { return $this->description; }
    public function getAmount() { return $this->amount; }
    public function getNotes() { return $this->notes; }

    public function toArray()
    {
        return [
            'id' => $this->id,
            'date' => $this->date,
            'category' => $this->category,
            'description' => $this->description,
            'amount' => $this->amount,
            'notes' => $this->notes
        ];
    }
}

/**
 * ExpenseTracker Class - UNIT-III: File Operations & OOP
 */
class ExpenseTracker
{
    private $dataFile = "expenses.csv";
    private $expenses = [];

    public function __construct()
    {
        $this->loadExpenses();
    }

    /**
     * UNIT-III: File Operations - Reading from files
     */
    private function loadExpenses()
    {
        try {
            if (file_exists($this->dataFile)) {
                $handle = fopen($this->dataFile, "r");
                if (!$handle) {
                    throw new Exception("Could not open file");
                }

                while (($data = fgetcsv($handle)) !== false) {
                    if (count($data) >= 5) {
                        $this->expenses[] = new Expense(
                            $data[0], $data[1], $data[2], $data[3], $data[4], $data[5] ?? ""
                        );
                    }
                }
                fclose($handle);
            }
        } catch (Exception $e) {
            // Silent fail on load
        }
    }

    /**
     * UNIT-III: File Operations - Writing to files
     */
    private function saveExpenses()
    {
        try {
            $handle = fopen($this->dataFile, "w");
            if (!$handle) {
                throw new Exception("Could not open file for writing");
            }

            foreach ($this->expenses as $expense) {
                $row = $expense->toArray();
                fputcsv($handle, [
                    $row['id'],
                    $row['date'],
                    $row['category'],
                    $row['description'],
                    $row['amount'],
                    $row['notes']
                ]);
            }
            fclose($handle);
            return true;
        } catch (Exception $e) {
            return false;
        }
    }

    /**
     * UNIT-I: Regular Expression validation
     */
    public function addExpense($date, $category, $description, $amount, $notes = "")
    {
        if (!preg_match('/^\d{4}-\d{2}-\d{2}$/', $date)) {
            throw new Exception("Invalid date format");
        }
        if (!is_numeric($amount) || $amount <= 0) {
            throw new Exception("Invalid amount");
        }

        $id = uniqid();
        $this->expenses[] = new Expense($id, $date, $category, $description, $amount, $notes);
        $this->saveExpenses();
        return $id;
    }

    public function getExpenses()
    {
        return $this->expenses;
    }

    public function deleteExpense($id)
    {
        foreach ($this->expenses as $key => $expense) {
            if ($expense->getId() === $id) {
                unset($this->expenses[$key]);
                $this->saveExpenses();
                return true;
            }
        }
        return false;
    }

    public function getExpensesByCategory($category)
    {
        $filtered = [];
        foreach ($this->expenses as $expense) {
            if ($expense->getCategory() === $category) {
                $filtered[] = $expense;
            }
        }
        return $filtered;
    }

    public function getTotalByCategory()
    {
        $totals = [];
        foreach ($this->expenses as $expense) {
            $cat = $expense->getCategory();
            if (!isset($totals[$cat])) {
                $totals[$cat] = 0;
            }
            $totals[$cat] += $expense->getAmount();
        }
        return $totals;
    }

    public function clearAllExpenses()
    {
        $this->expenses = [];
        return $this->saveExpenses();
    }
}

// UNIT-I: Associated Arrays for categories
$categories = [
    'food' => ['name' => 'Food', 'icon' => '🍕', 'color' => '#FF6B6B'],
    'transport' => ['name' => 'Transport', 'icon' => '🚗', 'color' => '#4ECDC4'],
    'shopping' => ['name' => 'Shopping', 'icon' => '🛍️', 'color' => '#FFD93D'],
    'bills' => ['name' => 'Bills', 'icon' => '📄', 'color' => '#6C5CE7'],
    'entertainment' => ['name' => 'Entertainment', 'icon' => '🎬', 'color' => '#A29BFE'],
    'healthcare' => ['name' => 'Healthcare', 'icon' => '⚕️', 'color' => '#FF7675'],
    'other' => ['name' => 'Other', 'icon' => '📌', 'color' => '#95A5A6']
];

// Initialize tracker
$tracker = new ExpenseTracker();

// UNIT-II: Cookies for dark mode
$darkMode = isset($_COOKIE['darkMode']) ? $_COOKIE['darkMode'] === 'true' : false;

?>
