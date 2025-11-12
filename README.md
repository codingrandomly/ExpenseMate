# ExpenseMate 💰# ExpenseMate - Educational Expense Tracker# 💰 ExpenseMate - Smart Expense Management System



A professional, multi-page PHP expense tracker application with CSV-based data persistence.



## Features![PHP](https://img.shields.io/badge/PHP-8.0+-blue.svg)**ExpenseMate** is a modern, user-friendly expense tracking and management application built with PHP, MySQL, HTML, CSS, and JavaScript. It helps users track their daily expenses, visualize spending patterns, and manage monthly budgets with intelligent alerts.



✅ **Dashboard** - Real-time statistics and visualizations  ![License](https://img.shields.io/badge/License-Educational-green.svg)

✅ **Add Expense** - Form-based expense entry with validation  

✅ **View Expenses** - Table view with real-time search and delete functionality  ![Status](https://img.shields.io/badge/Status-Complete-brightgreen.svg)## 🎯 Features

✅ **Reports** - Analytics, charts, and CSV export  

✅ **Settings** - Dark mode and preferences  

✅ **Responsive Design** - Bootstrap 5 framework  

✅ **Data Visualization** - Chart.js integration  A comprehensive educational expense tracker project demonstrating all PHP curriculum concepts from UNIT-I through UNIT-IV.✨ **Core Features:**



## Project Structure- 🔐 **Secure Authentication** - User registration and login with password hashing



```---- 📊 **Dashboard Overview** - Quick summary of today's, weekly, monthly, and yearly expenses

ExpenseMate/

├── index.php              # Entry point (redirects to dashboard)- ➕ **Add Expenses** - Easy expense logging with category selection and date picker

├── expenses.csv           # Data storage file (auto-created)

├── includes/## 🎯 Project Purpose- 📈 **Visual Reports** - Interactive charts showing category-wise and date-wise expense breakdown

│   ├── config.php         # Configuration, database logic, and OOP classes

│   ├── header.php         # Navigation and styling- 💸 **Budget Management** - Set monthly spending limits with automatic alerts

│   └── footer.php         # Footer and scripts

└── pages/This project serves as a complete learning resource covering:- ⚠️ **Budget Alerts** - Get notified when monthly spending exceeds set limits

    ├── dashboard.php      # Main dashboard with statistics

    ├── add_expense.php    # Add new expense form- ✅ UNIT-I: PHP Fundamentals (Variables, Operators, Control Statements, Arrays)- 📱 **Responsive Design** - Works seamlessly on desktop, tablet, and mobile devices

    ├── view_expenses.php  # View and manage expenses

    ├── reports.php        # Analytics and data export- ✅ UNIT-II: Functions & Form Handling (GET/POST, Sessions, Cookies)- 🌙 **Dark Theme UI** - Modern dark interface with smooth animations

    └── settings.php       # Settings and preferences

```- ✅ UNIT-III: File Operations & OOP (Classes, Inheritance, Exception Handling)



## Installation & Usage- ✅ UNIT-IV: File I/O & AJAX (CSV Storage, JSON, Asynchronous Operations)## 🛠️ Tech Stack



### Prerequisites

- PHP 8.0+

- No database required (uses CSV for storage)---| Component | Technology |



### Quick Start|-----------|-----------|



1. Clone the repository:## 🚀 Quick Start| **Backend** | PHP 8+ |

```bash

git clone https://github.com/codingrandomly/ExpenseMate.git| **Database** | MySQL 5.7+ |

cd ExpenseMate

```### 1. **Start the Server**| **Frontend** | HTML5, CSS3, JavaScript (Vanilla) |



2. Start the PHP development server:```bash| **Charts** | Chart.js |

```bash

php -S localhost:8000cd /workspaces/ExpenseMate| **Icons** | Font Awesome 6 |

```

php -S localhost:8000

3. Open your browser and navigate to:

``````## 📋 Prerequisites

http://localhost:8000

```



## Key Features Explained### 2. **Open in Browser**- PHP 7.4 or higher



### 📊 Dashboard```- MySQL Server (5.7+)

- Today's expenses summary

- Month's expenses summaryhttp://localhost:8000- Apache/Nginx with mod_rewrite support

- Total expenses count and amount

- Category-wise pie chart```- Modern web browser

- Recent 5 expenses list



### ➕ Add Expense

- Date picker (auto-fills today)### 3. **Start Using**## 🚀 Installation & Setup

- Category dropdown (7 categories)

- Description and amount fields- Click "Add Expense" to add your first expense

- Notes section

- Form validation (regex)- View expenses in the "View Expenses" section### Step 1: Clone or Download the Repository

- Server-side validation

- Check "Dashboard" for statistics```bash

### 👀 View Expenses

- Table display of all expenses- Analyze spending in "Reports"cd /workspaces/ExpenseMate

- Real-time search functionality

- Category badges with color coding```

- Delete functionality with confirmation

- Responsive table design---



### 📈 Reports### Step 2: Database Setup

- Category breakdown with percentages

- Progress bars for each category## 📋 Features1. Create a MySQL database named `expensemate`

- Pie chart visualization

- Summary statistics2. Import the database schema:

- CSV download functionality

- Clear all data option### Dashboard   ```bash



### ⚙️ Settings- 📊 **Statistics**: Today, Monthly, Total, and Entry count   mysql -u root -p expensemate < sql/database.sql

- Dark mode toggle (persisted via cookies)

- Theme customization- 📈 **Chart**: Visual breakdown by category (Doughnut Chart)   ```

- Feature list

- About section- 📝 **Recent Expenses**: Last 5 transactions   (Leave password empty if no password is set)

- Danger zone (clear all data)



## Curriculum Concepts Demonstrated

### Add Expense### Step 3: Configure Database Connection

### UNIT-I: Fundamentals

- ✅ Variables and data types- 📅 **Date Picker**: Easy date selectionEdit `src/config/db.php` and update credentials if needed:

- ✅ Arrays and associative arrays

- ✅ Control statements (if/else, foreach loops)- 📌 **Categories**: 7 predefined categories (Food, Transport, Shopping, Bills, Entertainment, Healthcare, Other)```php

- ✅ Regular expressions (preg_match)

- ✅ String manipulation- 💰 **Amount**: Precise decimal supportdefine('DB_HOST', 'localhost');  // Your database host

- ✅ Math operations

- 📝 **Notes**: Optional additional detailsdefine('DB_USER', 'root');       // Your database user

### UNIT-II: Forms & Web

- ✅ Forms (GET and POST methods)define('DB_PASS', '');           // Your database password

- ✅ Form validation and sanitization

- ✅ Sessions (session_start)### View Expensesdefine('DB_NAME', 'expensemate');// Database name

- ✅ Cookies (dark mode persistence)

- ✅ HTTP methods- 📋 **Table Format**: All expenses in organized table```



### UNIT-III: Advanced- 🔍 **Search**: Real-time search by description, category, or amount

- ✅ Object-Oriented Programming (Classes, Properties, Methods)

- ✅ Encapsulation (private/public access modifiers)- 🗑️ **Delete**: Remove individual expenses### Step 4: Start PHP Development Server

- ✅ File I/O operations (fopen, fgetcsv, fputcsv)

- ✅ Exception handling (try-catch)- 🎨 **Color Coding**: Category-based color indicators```bash

- ✅ CSV file manipulation

php -S localhost:8000

### UNIT-IV: Integration

- ✅ Multi-page application architecture### Reports & Analysis```

- ✅ Code reusability (includes)

- ✅ Data persistence- 📊 **Category Summary**: Total spending per category with percentages

- ✅ Dynamic content generation

- 📥 **Download CSV**: Export all expenses for external analysis### Step 5: Access the Application

## OOP Classes

- 📤 **Upload CSV**: Import expenses from CSV fileOpen your browser and navigate to:

### Category Class

```php- 🗑️ **Clear Data**: Remove all expenses (with confirmation)```

class Category {

    private $id, $name, $icon, $color;http://localhost:8000

    public function getId() {...}

    public function getName() {...}### Settings```

    public function getIcon() {...}

    public function getColor() {...}- 🌙 **Dark Mode**: Toggle dark/light theme (saved in cookies)

}

```- 🔒 **Persistent Storage**: All data saved locally in CSV file## 📖 Usage Guide



### Expense Class

```php

class Expense {---### 1. **Signup**

    private $id, $date, $category, $description, $amount, $notes;

    public function getId() {...}- Click "Sign Up" on the home page

    public function toArray() {...}

    // ... getters## 🏗️ Project Architecture- Enter your full name, email, and password (min. 8 characters)

}

```- Confirm your password



### ExpenseTracker Class### File Structure- Click "Sign Up" to create your account

```php

class ExpenseTracker {```

    private function loadExpenses() {...}

    private function saveExpenses() {...}ExpenseMate/### 2. **Login**

    public function addExpense() {...}

    public function deleteExpense() {...}├── index.php                  # Main application (850+ lines)- Use your registered email and password

    public function getExpenses() {...}

    public function getTotalByCategory() {...}├── api.php                    # AJAX endpoints- You'll be redirected to the dashboard upon successful login

    // ... more methods

}├── expenses.csv              # Data storage (auto-created)

```

├── CURRICULUM_MAPPING.md     # Detailed curriculum coverage### 3. **Dashboard**

## Technologies Used

└── README.md                 # This file- View quick expense summaries:

- **Backend**: PHP 8.0.30

- **Frontend**: HTML5, CSS3, JavaScript (ES6)```  - Today's expenses

- **Styling**: Bootstrap 5 (CDN)

- **Visualization**: Chart.js (CDN)  - Yesterday's expenses

- **Icons**: Font Awesome 6 (CDN)

- **Storage**: CSV files### Object-Oriented Design  - This week's total



## File I/O Operations  - This month's total



All data is stored in `expenses.csv` using PHP's file operations:#### Category Class  - This year's total

- `fopen()` - Open file for reading/writing

- `fgetcsv()` - Read CSV data```php  - All-time total

- `fputcsv()` - Write CSV data

- `fclose()` - Close file handleclass Category {



## Browser Compatibility    private $id;### 4. **Add Expense**



- Chrome (Latest)    protected $name;- Click "Add Expense" in the navigation menu

- Firefox (Latest)

- Safari (Latest)    private $icon;- Select a category (Food, Transport, Shopping, Bills, Entertainment, Healthcare, Other)

- Edge (Latest)

    private $color;- Enter the expense item and amount

## License

    - Add optional details

This project is open source and available under the MIT License.

    // Getters for encapsulation- Select the expense date

## Author

}- Click "Add Expense" to save

Created for educational purposes to demonstrate PHP fundamentals and web development concepts.

```

---

### 5. **View Reports**

**Ready to track your expenses? Start using ExpenseMate today!** 🚀

#### Expense Class- Click "Reports" in the navigation menu

```php- View interactive charts:

class Expense {  - **Pie Chart**: Category-wise expense breakdown

    private $id;  - **Bar Chart**: Recent 10 days expense trend

    private $date;

    private $category;### 6. **Manage Budget**

    private $description;- Click "Budget" in the navigation menu

    private $amount;- Set your monthly spending limit

    private $notes;- View current month summary:

      - Budget limit

    public function toArray()  // Serialization  - Current expenses

}  - Remaining budget

```- Budget alerts will trigger when expenses exceed the limit



#### ExpenseTracker Class## 📁 Project Structure

```php

class ExpenseTracker {```

    private $dataFile;ExpenseMate/

    private $expenses[];├── index.php                    # Home page

    ├── README.md                    # Project documentation

    public function loadExpenses()     // File I/O: Read├── auth/

    public function saveExpenses()     // File I/O: Write│   ├── login.php               # Login page

    public function addExpense()       // Create│   ├── signup.php              # Signup page

    public function deleteExpense()    // Delete│   └── logout.php              # Logout handler

    public function getTotalByCategory() // Analysis├── pages/

}│   ├── dashboard.php           # Main dashboard

```│   ├── add_expense.php         # Add expense form

│   ├── report.php              # Reports with charts

---│   └── set_budget.php          # Budget management

├── src/

## 📚 Curriculum Coverage│   ├── config/

│   │   └── db.php              # Database configuration

### UNIT-I: PHP Fundamentals (11 Hours)│   ├── helpers/

│   │   └── sanitize.php        # Input sanitization

#### ✅ Data Types & Variables│   └── api/

- String: Description, category names│       └── get_dashboard_data.php  # API endpoint

- Integer/Float: Amount, calculations├── includes/

- Boolean: Preferences│   ├── navbar.php              # Navigation bar

- Array: Expenses, categories│   └── footer.php              # Footer

├── assets/

#### ✅ Super Global Variables│   ├── css/

- `$_POST`: Form submission│   │   ├── main.css            # Main stylesheet

- `$_GET`: Delete parameters│   │   └── dashboard.css       # Dashboard styles

- `$_SERVER["REQUEST_METHOD"]`: HTTP method detection│   └── js/

- `$_COOKIE`: Dark mode preference│       ├── main.js             # Main JavaScript

│       └── dashboard.js        # Dashboard scripts

#### ✅ Operators & Expressions├── sql/

```php│   └── database.sql            # Database schema

$percentage = ($total / $totalExpense) * 100;  // Arithmetic└── my-ts-node-project/         # TypeScript project (isolated)

$csv .= "row\n";                               // String concatenation```

if ($amount <= 0)                              // Comparison

if ($handle && !file_exists())                 // Logical## 🔒 Security Features

```

- ✅ **Password Hashing** - Uses PHP's `password_hash()` with bcrypt

#### ✅ Regular Expressions- ✅ **Prepared Statements** - SQL injection prevention via prepared queries

```php- ✅ **Input Sanitization** - HTML entity encoding and trimming

preg_match('/^\d{4}-\d{2}-\d{2}$/', $date)     // Date validation- ✅ **Session Management** - Secure session handling with automatic redirects

preg_match('/^[a-zA-Z0-9\s\-,\.]+$/', $text)  // Text validation- ✅ **CSRF Protection Ready** - Structure supports token implementation

```

## 📊 Database Schema

#### ✅ Control Statements

- **if-else**: Input validation, file checks### Users Table

- **foreach**: Iterating expenses and categories- `id` - Primary key

- **while**: Reading CSV file line by line- `full_name` - User's full name

- **switch**: Action handling in API- `email` - Unique email address

- `password_hash` - Hashed password

#### ✅ Arrays- `created_at` - Account creation timestamp

- **Indexed**: `$expenses[]` array

- **Associative**: `$categories[]` with properties### Expenses Table

- **Multi-dimensional**: Nested category data- `id` - Primary key

- **Functions**: `array_slice()`, `array_reverse()`, `array_map()`, `count()`- `user_id` - Reference to users

- `category` - Expense category

---- `item` - Expense description

- `details` - Optional details

### UNIT-II: Functions & Form Handling (11 Hours)- `amount` - Expense amount

- `expense_date` - Date of expense

#### ✅ Functions: Defining & Calling- `created_at` - Record creation timestamp

```php

public function addExpense($date, $category, $description, $amount, $notes = "")### Budgets Table

{- `id` - Primary key

    // Function implementation- `user_id` - Reference to users

}- `year` - Budget year

- `month` - Budget month

$tracker->addExpense($date, $category, $description, $amount);  // Calling- `limit_amount` - Monthly spending limit

```- `created_at` - Record creation timestamp



#### ✅ Parameter Passing### Categories Table

- **By Value**: Most primitive types- `id` - Primary key

- **By Reference**: Object instances (implicit)- `name` - Category name

- **Default Parameters**: `$notes = ""`

## 🧪 Test Account

#### ✅ Inbuilt Functions Used

- **String**: `trim()`, `htmlspecialchars()`, `strlen()`, `strtolower()`A test account is pre-configured in the database:

- **Array**: `count()`, `array_slice()`, `array_reverse()`, `array_map()`- **Email**: `test@example.com`

- **File**: `fopen()`, `fgetcsv()`, `fputcsv()`, `fclose()`, `file_exists()`, `unlink()`- **Password**: `password123`

- **Date**: `date()`, `strpos()`

- **Type**: `is_numeric()`, `isset()`## 🐛 Troubleshooting



#### ✅ Variable Scope| Issue | Solution |

- **Global**: `$categories`, `$tracker` at file level|-------|----------|

- **Local**: Function/method-specific variables| "Database connection failed" | Check MySQL is running and credentials in `src/config/db.php` are correct |

- **Class**: Private `$dataFile`, public methods| "Port 8000 already in use" | Use a different port: `php -S localhost:8001` |

| Blank pages | Check PHP error logs and ensure all required files exist |

#### ✅ HTML Forms| Charts not loading | Verify Chart.js CDN is accessible or check browser console |

```html| Budget alerts not showing | Ensure database has budget records for the current month |

<!-- GET Method for deletion -->

<a href="index.php?action=delete&id=<?php echo $id; ?>">## 🚀 Future Enhancements



<!-- POST Method for adding -->- 📧 Email notifications for budget alerts

<form method="POST" action="index.php">- 🗑️ Edit and delete expense functionality

    <input type="date" name="date">- 🔍 Advanced search and filtering

    <select name="category">- 📥 CSV/PDF export of expenses

    <input type="number" name="amount">- 📊 Advanced analytics dashboard

    <input type="submit">- 🔄 Recurring expense templates

</form>- 👥 Multi-user family budgeting

```

## 📝 License

#### ✅ State Management

- **Sessions**: `session_start()` initializedThis project is created for educational purposes as a college project.

- **Cookies**: Dark mode preference stored

- **Query Strings**: `?action=delete&id=123`## 👨‍💻 Author

- **Hidden Fields**: `<input type="hidden" name="action">`

Created with ❤️ using PHP, MySQL, HTML, CSS & JavaScript

---

---

### UNIT-III: File Operations & OOP (11 Hours)

**Happy Expense Tracking with ExpenseMate! 💰**

#### ✅ File Operations

**Reading Files**:
```php
$handle = fopen($this->dataFile, "r");
while (($data = fgetcsv($handle)) !== false) {
    // Process CSV row
}
fclose($handle);
```

**Writing Files**:
```php
$handle = fopen($this->dataFile, "w");
fputcsv($handle, [$id, $date, $category, $description, $amount]);
fclose($handle);
```

**File Existence**:
```php
if (file_exists($this->dataFile)) { }
```

**File Deletion**:
```php
if (file_exists("expenses.csv")) {
    unlink("expenses.csv");  // Delete file
}
```

#### ✅ OOP Concepts

**Classes & Objects**:
- 3 main classes: `Category`, `Expense`, `ExpenseTracker`
- Object instantiation: `new Expense(...)`
- Object references: `$expense->getId()`

**Access Modifiers**:
- `private`: `$dataFile`, `$amount` (only in class)
- `public`: All getter methods (accessible globally)
- `protected`: Ready for inheritance

**Constructors**:
```php
public function __construct($id, $date, $category, $description, $amount, $notes = "")
{
    $this->id = $id;
    // Initialize properties
}
```

**Encapsulation**:
- Private properties prevent direct modification
- Public getters provide controlled access
- Business logic in methods

**Inheritance** (Extensible):
```php
// Could extend to:
abstract class Entity {
    protected $id;
    public function getId() { return $this->id; }
}

class Expense extends Entity { }
```

#### ✅ Exception Handling
```php
try {
    $handle = fopen($this->dataFile, "r");
    if (!$handle) {
        throw new Exception("Could not open file");
    }
} catch (Exception $e) {
    echo "Error: " . htmlspecialchars($e->getMessage());
}
```

---

### UNIT-IV: AJAX & File-Based Storage (11 Hours)

#### ✅ File-Based Database
- **Storage**: CSV format (`expenses.csv`)
- **Format**: ID, Date, Category, Description, Amount, Notes
- **Loading**: Line-by-line with `fgetcsv()`
- **Saving**: Row-by-row with `fputcsv()`

#### ✅ JSON Operations
```php
// PHP to JavaScript
const data = <?php echo json_encode($array); ?>;

// JavaScript to PHP (form submission)
```

#### ✅ AJAX Implementation
```javascript
// Fetch API for async operations
fetch('api.php?action=clear', { method: 'POST' })
    .then(response => response.json())
    .then(data => location.reload());

// Real-time search without page refresh
searchInput.addEventListener('keyup', function() {
    // Filter table based on input
});
```

#### ✅ API Endpoints (`api.php`)
- `/api.php?action=clear`: Delete all expenses
- `/api.php?action=search`: Search expenses
- `/api.php?action=stats`: Get statistics
- `/api.php?action=categories`: Get category totals

---

## 🎨 User Interface

### Design Features
- **Responsive**: Works on desktop, tablet, mobile
- **Modern**: Bootstrap 5 framework
- **Dark Mode**: Toggle between light/dark themes
- **Accessible**: Font Awesome icons, semantic HTML
- **Smooth**: CSS transitions and animations
- **Color-Coded**: Category-specific colors for expenses

### Technology Stack
| Component | Technology |
|-----------|-----------|
| Backend | PHP 8.0+ |
| Frontend | HTML5, CSS3, Bootstrap 5 |
| Scripting | JavaScript (Vanilla) |
| Data | CSV Files |
| Charts | Chart.js |
| Icons | Font Awesome 6 |

---

## 📊 Data Format

### CSV Storage Format
```
id,date,category,description,amount,notes
1234abcd,2024-11-12,food,Lunch at cafe,250.00,Tuesday lunch
5678efgh,2024-11-12,transport,Taxi to office,150.00,Morning commute
```

### JSON Export Format
```json
[
  {
    "id": "1234abcd",
    "date": "2024-11-12",
    "category": "food",
    "description": "Lunch at cafe",
    "amount": 250.00,
    "notes": "Tuesday lunch"
  }
]
```

---

## ⚙️ How It Works

### Adding an Expense
1. User fills form (date, category, description, amount, notes)
2. Form validates using JavaScript and regex (UNIT-I)
3. POST request sends data to `index.php`
4. `ExpenseTracker::addExpense()` processes request
5. New `Expense` object created
6. Data saved to `expenses.csv` (UNIT-III: File I/O)
7. Page redirects, success message displays

### Viewing Expenses
1. All expenses loaded from CSV (UNIT-III: File operations)
2. `foreach` loop renders table rows (UNIT-I: Loops)
3. JavaScript search filters table in real-time (UNIT-IV: AJAX)
4. Categories color-coded using associative arrays (UNIT-I: Arrays)

### Deleting an Expense
1. User clicks delete button
2. GET request with `?action=delete&id=xyz`
3. `ExpenseTracker::deleteExpense()` finds and removes expense
4. CSV file rewritten without deleted expense
5. Page refreshes to show updated list

### Analytics
1. Dashboard calculates totals using `foreach` (UNIT-I)
2. `getTotalByCategory()` groups expenses (UNIT-I: Arrays)
3. Chart.js renders doughnut chart from data
4. Percentages calculated using arithmetic operators (UNIT-I)

---

## 🧪 Example Usage

### Adding First Expense
```
1. Open http://localhost:8000
2. Click "Add Expense"
3. Date: 2024-11-12 (auto-filled today)
4. Category: 🍕 Food
5. Description: Coffee at Cafe
6. Amount: 125.50
7. Notes: Morning coffee break
8. Click "Add Expense"
✓ Success! Expense saved to expenses.csv
```

### Searching
```
1. Go to "View Expenses"
2. Type "coffee" in search box
3. Table filters to show only matching expenses
4. Real-time update without page refresh
```

### Analyzing Spending
```
1. Go to "Dashboard"
2. View category breakdown chart
3. Hover over segments to see percentages
4. Recent expenses shown in sidebar
```

---

## 📝 Code Examples

### Variable Declaration (UNIT-I)
```php
$totalExpense = 0;           // Integer
$message = "";               // String
$expenses = [];              // Array
$isDarkMode = true;          // Boolean
$amount = 125.50;            // Float
```

### Regular Expression (UNIT-I)
```php
if (!preg_match('/^\d{4}-\d{2}-\d{2}$/', $date)) {
    throw new Exception("Invalid date format");
}
```

### Class Definition (UNIT-III)
```php
class Expense {
    private $id;             // Private property
    private $amount;         // Private property
    
    public function getId() {  // Public getter
        return $this->id;
    }
}
```

### File Operations (UNIT-III)
```php
// Read CSV
$handle = fopen("expenses.csv", "r");
while (($data = fgetcsv($handle)) !== false) {
    // Process $data
}
fclose($handle);

// Write CSV
fputcsv($handle, [$id, $date, $category, ...]);
```

### Form Handling (UNIT-II)
```php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $date = $_POST['date'];
    $category = $_POST['category'];
    $tracker->addExpense($date, $category, ...);
}
```

---

## 🔄 Learning Path

### Beginner
1. Understand class structure
2. Study `Expense` and `Category` classes
3. Learn file I/O in `ExpenseTracker::loadExpenses()`

### Intermediate
1. Modify expense properties
2. Add new expense categories
3. Change CSS styling
4. Add new form fields

### Advanced
1. Convert CSV to MySQL database (UNIT-IV)
2. Add user authentication (UNIT-II: Sessions)
3. Implement pagination (UNIT-I: Arrays)
4. Add monthly charts (UNIT-IV: Chart rendering)
5. Email notifications (UNIT-II: Mail function)

---

## ✨ Key Learning Points

1. **OOP in PHP**: Classes, objects, encapsulation, access modifiers
2. **File I/O**: Reading, writing, parsing CSV files
3. **Form Handling**: GET/POST methods, validation
4. **State Management**: Sessions, cookies, query strings
5. **Arrays**: Indexed, associative, multi-dimensional
6. **Control Flow**: if-else, loops, switch statements
7. **Regular Expressions**: Pattern matching for validation
8. **Exception Handling**: try-catch blocks
9. **AJAX**: Async operations, real-time updates
10. **Data Persistence**: File-based storage, serialization

---

## 🚀 Future Enhancements

- [ ] Database migration (MySQL/PDO)
- [ ] User authentication system
- [ ] Multiple user support
- [ ] Budget setting and alerts
- [ ] Recurring expenses
- [ ] Advanced reports (charts by month, trends)
- [ ] Data export to Excel
- [ ] Mobile app version
- [ ] Cloud synchronization
- [ ] Real-time collaboration

---

## 📖 Resources

### Official Documentation
- [PHP Manual](https://www.php.net/manual/)
- [Bootstrap 5 Docs](https://getbootstrap.com/docs/5.0/)
- [Chart.js Documentation](https://www.chartjs.org/)

### Related Topics
- [Web Application Fundamentals](https://developer.mozilla.org/en-US/docs/Learn/Server-side)
- [PHP Best Practices](https://www.php.net/manual/en/appendix.bestpractices.php)
- [Web Form Security](https://owasp.org/www-community/attacks/xss/)

---

## 📄 License

Educational Project - Free to use and modify for learning purposes

---

## 👨‍🎓 About This Project

**Purpose**: Educational demonstration of PHP curriculum concepts  
**Audience**: Computer Science students (2nd Semester)  
**Curriculum**: UNIT-I through UNIT-IV  
**Difficulty**: Intermediate  
**Time to Learn**: 4-6 weeks  

---

## 🙋 Support

For issues or questions:
1. Check the `CURRICULUM_MAPPING.md` for detailed explanations
2. Review code comments for curriculum references
3. Test features using the examples provided
4. Modify and experiment with the code

---

## ✅ Checklist for Understanding

- [ ] I can explain all three classes (Category, Expense, ExpenseTracker)
- [ ] I understand how data is stored and retrieved from CSV
- [ ] I can identify all UNIT-I concepts in the code
- [ ] I can modify the form to add new fields
- [ ] I can add a new expense category
- [ ] I understand the POST/GET form handling
- [ ] I can write a query to search expenses
- [ ] I understand exception handling
- [ ] I can modify the CSS styling
- [ ] I can add a new AJAX endpoint

---

**Happy Learning! 🎉**

For detailed curriculum mapping, see `CURRICULUM_MAPPING.md`

---

*Last Updated: November 12, 2025*  
*Status: ✅ Production Ready*
