 <?php
    require_once __DIR__ . '/../../includes/config/config.php';
    require_once __DIR__ . '/../../includes/helpers/session.php';
    require_once __DIR__ . '/../../includes/helpers/functions.php';

    header('Content-Type: application/json');

    // Get JSON input
    $input = json_decode(file_get_contents('php://input'), true);

    if (!isset($input['name']) || !isset($input['email']) || !isset($input['password'])) {
        http_response_code(400);
        echo json_encode([
            'success' => false,
            'message' => 'Name, email, and password are required'
        ]);
        exit;
    }

    $name = trim($input['name']);
    $email = trim($input['email']);
    $password = $input['password'];

    // Validate input
    if (empty($name) || empty($email) || empty($password)) {
        http_response_code(400);
        echo json_encode([
            'success' => false,
            'message' => 'All fields are required'
        ]);
        exit;
    }

    // Validate email format
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        http_response_code(400);
        echo json_encode([
            'success' => false,
            'message' => 'Invalid email format'
        ]);
        exit;
    }

    // Validate password (minimum 6 characters)
    if (strlen($password) < 6) {
        http_response_code(400);
        echo json_encode([
            'success' => false,
            'message' => 'Password must be at least 6 characters'
        ]);
        exit;
    }

    // Register user with default Employee role
    $result = registerUser($name, $email, $password, 'Employee');

    if ($result['success']) {
        // Auto-login after registration
        $loginResult = loginUser($email, $password);
        if ($loginResult['success']) {
            http_response_code(200);
            echo json_encode([
                'success' => true,
                'user' => $loginResult['user']
            ]);
        } else {
            http_response_code(200);
            echo json_encode([
                'success' => true,
                'message' => 'Registration successful. Please login.'
            ]);
        }
    } else {
        http_response_code(400);
        echo json_encode([
            'success' => false,
            'message' => $result['message']
        ]);
    }
