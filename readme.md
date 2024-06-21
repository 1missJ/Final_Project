# Online Enrollment System

Welcome to the Online Enrollment System! This guide will help you set up and run the website on your localhost using XAMPP.

## Prerequisites

Before you begin, make sure you have the following software installed on your system:

- [XAMPP](https://www.apachefriends.org/index.html) (which includes Apache, MySQL, and PHP)

## Installation and Setup

Follow these steps to set up the Online Enrollment System on your local machine:

### 1. Download XAMPP

If you haven't already, download and install XAMPP from [here](https://www.apachefriends.org/index.html).

### 2. Start Apache and MySQL

Open the XAMPP Control Panel and start the Apache and MySQL services.

### 3. Download the Online Enrollment System Code

Download the source code of the Online Enrollment System from the repository or the provided zip file. Extract the contents of the zip file if necessary.

### 4. Move the Code to XAMPP's htdocs Directory

Copy the entire project folder to XAMPP's `htdocs` directory. This directory is typically located at:

C:\xampp\htdocs\

Your project structure should look something like this:

C:\xampp\htdocs\OES\

### 5. Access the Online Enrollment System

Open your web browser and navigate to:

http://localhost/OES/

You should see the homepage of the Online Enrollment System.

## Troubleshooting

- **Apache/MySQL not starting:** Ensure no other application is using port 80 (for Apache) or port 3306 (for MySQL). You might need to stop services like Skype or change the ports in the XAMPP settings.
- **404 Not Found:** Double-check the project folder name and the URL you are accessing. It should match the folder name in `htdocs`.
- **Database Connection Error:** Verify the database configuration in your project's settings. Ensure MySQL is running and the credentials are correct.

## Contributing

If you wish to contribute to the project, please follow the standard procedure of forking the repository, making changes, and submitting a pull request.

## License

This project is licensed under the MIT License. See the `LICENSE` file for more information.

---

Thank you for using the Online Enrollment System! If you encounter any issues, feel free to open an issue in the repository or contact the project maintainers. Happy enrolling!