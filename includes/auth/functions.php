<?php
require_once __DIR__ . '/../config/database.php';

// Register a new user
function registerUser($name, $email, $password, $role = 'Employee')
{
    $pdo = getDbConnection();

    try {
        // Check if user exists
        $stmt = $pdo->prepare("SELECT id FROM users WHERE email = :email");
        $stmt->execute(['email' => $email]);

        if ($stmt->rowCount() > 0) {
            return ['success' => false, 'message' => 'Email already exists'];
        }

        // Hash password
        $hashedPassword = password_hash($password, PASSWORD_BCRYPT);

        // Insert user
        $stmt = $pdo->prepare("
            INSERT INTO users (name, email, password, role) 
            VALUES (:name, :email, :password, :role)
        ");

        $result = $stmt->execute([
            'name' => $name,
            'email' => $email,
            'password' => $hashedPassword,
            'role' => $role
        ]);

        if ($result) {
            return ['success' => true, 'message' => 'User registered successfully'];
        }

        return ['success' => false, 'message' => 'Registration failed'];
    } catch (PDOException $e) {
        error_log("Registration error: " . $e->getMessage());
        return ['success' => false, 'message' => 'An error occurred during registration'];
    }
}

// Login user
function loginUser($email, $password)
{
    $pdo = getDbConnection();

    try {
        $stmt = $pdo->prepare("SELECT * FROM users WHERE email = :email");
        $stmt->execute(['email' => $email]);

        if ($stmt->rowCount() === 0) {
            return ['success' => false, 'message' => 'Invalid credentials'];
        }

        $user = $stmt->fetch();

        if (password_verify($password, $user['password'])) {
            // Set session
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['user_name'] = $user['name'];
            $_SESSION['user_email'] = $user['email'];
            $_SESSION['user_avatar'] = $user['avatar'];
            $_SESSION['user_role'] = $user['role'];
            $_SESSION['logged_in'] = true;

            return [
                'success' => true,
                'message' => 'Login successful',
                'user' => [
                    'id' => $user['id'],
                    'name' => $user['name'],
                    'email' => $user['email'],
                    'avatar' => $user['avatar'],
                    'role' => $user['role']
                ]
            ];
        }

        return ['success' => false, 'message' => 'Invalid credentials'];
    } catch (PDOException $e) {
        error_log("Login error: " . $e->getMessage());
        return ['success' => false, 'message' => 'An error occurred during login'];
    }
}

// Get user by ID
function getUserById($userId)
{
    $pdo = getDbConnection();

    try {
        $stmt = $pdo->prepare("SELECT id, name, email, avatar, role FROM users WHERE id = :id");
        $stmt->execute(['id' => $userId]);

        return $stmt->fetch();
    } catch (PDOException $e) {
        error_log("Get user error: " . $e->getMessage());
        return null;
    }
}

// Get all users
function getAllUsers()
{
    $pdo = getDbConnection();

    try {
        $stmt = $pdo->query("SELECT id, name, email, avatar, role FROM users ORDER BY name");
        return $stmt->fetchAll();
    } catch (PDOException $e) {
        error_log("Get all users error: " . $e->getMessage());
        return [];
    }
}

// Update user profile
function updateUserProfile($userId, $name, $email)
{
    $pdo = getDbConnection();

    try {
        $stmt = $pdo->prepare("
            UPDATE users 
            SET name = :name, email = :email 
            WHERE id = :id
        ");

        $result = $stmt->execute([
            'name' => $name,
            'email' => $email,
            'id' => $userId
        ]);

        if ($result) {
            return ['success' => true, 'message' => 'Profile updated successfully'];
        }

        return ['success' => false, 'message' => 'Update failed'];
    } catch (PDOException $e) {
        error_log("Update profile error: " . $e->getMessage());
        return ['success' => false, 'message' => 'An error occurred'];
    }
}

// Change password
function changePassword($userId, $oldPassword, $newPassword)
{
    $pdo = getDbConnection();

    try {
        // Get current password
        $stmt = $pdo->prepare("SELECT password FROM users WHERE id = :id");
        $stmt->execute(['id' => $userId]);
        $user = $stmt->fetch();

        if (!$user) {
            return ['success' => false, 'message' => 'User not found'];
        }

        // Verify old password
        if (!password_verify($oldPassword, $user['password'])) {
            return ['success' => false, 'message' => 'Current password is incorrect'];
        }

        // Update password
        $hashedPassword = password_hash($newPassword, PASSWORD_BCRYPT);
        $stmt = $pdo->prepare("UPDATE users SET password = :password WHERE id = :id");
        $result = $stmt->execute([
            'password' => $hashedPassword,
            'id' => $userId
        ]);

        if ($result) {
            return ['success' => true, 'message' => 'Password changed successfully'];
        }

        return ['success' => false, 'message' => 'Password change failed'];
    } catch (PDOException $e) {
        error_log("Change password error: " . $e->getMessage());
        return ['success' => false, 'message' => 'An error occurred'];
    }
}
