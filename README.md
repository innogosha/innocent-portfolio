
Built by https://www.blackbox.ai

---

```markdown
# Innocent G. Shayo's Personal Website

## Project Overview
This is a personal website for Innocent G. Shayo, showcasing his personal information, hobbies, and professional interests. The website includes a contact form for inquiries, a login system for managing contacts, and an interactive dashboard for form submissions. It is designed using HTML, CSS with Tailwind, and PHP for backend functionalities.

## Installation
To run this project locally, please follow these steps:

1. Clone the repository:
   ```bash
   git clone <repository-url>
   ```
   
2. Navigate to the project directory:
   ```bash
   cd <project-directory>
   ```

3. Set up a local server (e.g., XAMPP, MAMP) and configure a new database with the name `personal_website`.

4. Import the provided SQL setup file if available, or create the necessary tables manually:
   - `contacts` for storing submitted contact information.
   - `users` for managing user credentials (if using the login functionality).

5. Update the database connection settings in the PHP files (e.g., `process.php`, `login.php`, `logout.php`, etc.) with your own database credentials.

6. Start your local server and open the site in your browser by navigating to `http://localhost/<project-folder>/index.html`.

## Usage
- **Homepage**: Displays personal information, hobbies, links, and a weekly schedule.
- **Contact Form**: Users can send messages via the contact page (`form.html`).
- **Login Portal**: Login with valid credentials to access the dashboard (`dashboard.php`), which displays recent contact submissions.
- **Dashboard**: Admin users can view submissions from the contact form.
- **Logout**: Users can log out, terminating their session.

## Features
- Responsive design using Tailwind CSS.
- Dynamic content updates reflecting page location and last modified date.
- User authentication allowing restricted access to the dashboard.
- Contact form handling with validation.
- Dashboard for viewing recent submissions with a user-friendly interface.

## Dependencies
The project uses the following dependencies listed in `package.json`:
```json
{
  "dependencies": {
    "tailwindcss": "^2.2.19",
    "font-awesome": "^5.15.4"
  }
}
```
Note: The project is primarily HTML/CSS and does not require extensive JavaScript libraries beyond the CDNs for Tailwind CSS and Font Awesome for icons.

## Project Structure
```
/<project-directory>
│
├── index.html          # Main homepage for the personal site.
├── form.html           # Contact form page.
├── thank-you.html      # Page shown after successful form submission.
├── login.php           # Login page for user authentication.
├── dashboard.php       # User dashboard displaying form submissions.
├── process.php         # PHP handler for processing the contact form submission.
├── logout.php          # Script to log users out.
├── style.css           # Custom styles applied to the HTML elements.
├── test_db.php         # Script to test database connectivity and setup.
├── images/             # Directory for images used in the website.
├── styles/             # Directory for additional styles (if any).
└── README.md           # This README file.
```

## License
This project is open-source. Feel free to use or modify it as needed. Contributions are welcome!
```