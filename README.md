💰 MoneySaver - Version 1.0V
MoneySaver is a simple web application to help users manage and track their savings. This version includes two key pages:

✅ Add Money Plan – Add your custom savings plan.

👁️ View Money Plan – View your savings plan in the Baseboard.

📂 Features
Add personalized savings plans.

View saved plans in a clean, summarized format.

Simple UI and easy-to-use navigation.

🛠️ Installation & Setup
1. Clone the Repository
bash
Copy
Edit
git clone https://github.com/yourusername/moneysaver.git
cd moneysaver
2. Set Up the Database
Open your MySQL server.

Import the SQL file located at sql/SaveMoney.sql.

sql
Copy
Edit
-- Create and use the "moneysaver" database
CREATE DATABASE moneysaver;

-- Then import the SQL file
USE moneysaver;
SOURCE path/to/sql/SaveMoney.sql;
✅ Note: The database name must be moneysaver.

🚀 Pages Overview
Page Name	Description
AddMoneyPlan	Add new savings plans to the system
Baseboard	View all saved money plans

📌 Version
Current Version: v1.0

🙌 Contribution
Pull requests are welcome. For major changes, please open an issue first to discuss what you would like to change.

📄 License
This project is open-source and free to use.
