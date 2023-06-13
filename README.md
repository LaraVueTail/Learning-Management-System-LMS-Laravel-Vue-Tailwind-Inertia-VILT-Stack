
## Changes Made:-

# index.html:
- Added dark mode and switch and scripts.

# Middleware:
- `AdminCheck` - Created a middleware for checking if a teacher is Admin and registered it into Kernel as 'admin_check'.
- `RedirectIfAuthenticated` - Changes authentication redirect mechanism to include both student dashboard and teacher dashboard.
- `HandleInertiaRequests` - Added necessary shared data to inertia middleware.
- `can:view,chapter` - A policy to check id the student enrolled to the course or not.

# Models:
- `Teacher` - Created a separate teacher model other than normal user(student) to store data for teachers. Created a Event for deleting the model - So that to assign admin user for the course handled by the the teacher.

# Policies & Gates:
- `TeacherPolicy` - Created a policy for Teacher model to check if they have admin access or not based on the 'is_admin' value. Also created a gate named 'admin' to use the policy.
- `ChapterPolicy`- To check if the student enrolled to the course or not. created before function to chacke if admin or assigned Teacher.

# Providers:
- `AppServiceProvider` - Added model $guard = [].
- `AuthServiceProvider` - Added 'admin' Gate and registered policies.

# Services:
- `FileManagement` - Created a service for adding, updating, deleting and moving files.

# config:
- `admin.php` - Created an admin config file to fetch admin credentials given in .env file.
- `auth.php` - Added a new auth for guard and provider for teacher.
- `filesystems` - Specify the location to store files.

# Controllers:
- Created controllers for User(student), Teacher etc.
- `UserController` - Since we have two types of users if authenticate both of them and redirect to respective dashboards.