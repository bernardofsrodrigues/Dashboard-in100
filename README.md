# Dashboard In100 - Loan Margin Inquiry

This is a dashboard developed to allow users to perform automated loan margin inquiries using the in100 robot via API. Users can log in, upload an Excel file containing CPFs for inquiry, execute automated queries, and download the results in a new Excel file.

## Technologies Used

- **Python**: Programming language used to create the automation script.
- **Flask**: Web framework used to create the server and application routes.
- **Pandas**: Python library for data manipulation and analysis.
- **MySQL**: Database used to store the query results.
- **Selenium**: Browser automation tool to interact with the web interface.
- **Requests**: Python library for making HTTP requests.
- **HTML/CSS/JavaScript**: Used for creating the user interface.
- **PHP**: Used for the backend of the login system and database interaction.

## Features

1. **User Login:**
   - Users log in to the system through an HTML/CSS/PHP form.
   - Credentials are verified against a MySQL database.

2. **Excel File Upload (CPF Data):**
   - After logging in, users can upload an Excel file containing CPFs for inquiry.

3. **Automated Query with in100 Robot:**
   - The Python server uses Selenium to automate queries using the in100 robot via API.
   - CPFs are processed in batches, querying the availability of loan margins.

4. **Storage of Query Results:**
   - Query results are stored in a MySQL database associated with the user.

5. **Download Consulted Data:**
   - After the queries are finished, users can download the consulted data in a new Excel file.

## Requirements

- Python 3.x
- Flask
- Pandas
- Selenium
- MySQL
- API Requests (in100)
- PHP (for the login system and database interaction)

## Installation and Usage

1. **Clone the repository**:

   ```bash
   git clone https://github.com/your-username/Dashboard-in100
    ```
2. **Install Dependencies:**

   ```bash
   pip install -r requirements.txt  
   ```
3. **MySQL Database Configuration**

Before starting the dashboard, make sure to configure the MySQL database and update the connection information in the Python script to enable interaction with the database.

4. **Start Flask Server**

To start the Flask server and run the dashboard, use the following command:

```bash
python app.py
```
5. **Access Dashboard in the Browser**

After starting the server, access the dashboard in your preferred browser using the following URL:

```url
http://localhost:5000/
```
Log in with your credentials and utilize all available functionalities in the dashboard.

## Notes

- Make sure to have the appropriate WebDriver (e.g., ChromeDriver) configured for Selenium.
- This project was developed to be executed in a local development environment. Ensure to configure environment variables and access   permissions correctly.
- Be aware of the usage policies of the in100 API and query limits to avoid blocks or access restrictions.

## Author

Developed by Bernardo Rodrigues