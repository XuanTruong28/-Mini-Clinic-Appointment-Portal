<?php
namespace App\Controllers;

class AppointmentController {
    private array $allowedSpecialties = ['general', 'cardiology', 'dermatology', 'pediatrics'];

    public function index(): void {
        view('appointments/index', [
            'view' => 'appointments/index',
            'items' => $this->loadAppointments(),
        ]);
    }

    public function create(): void {
        view('appointments/create', [
            'view' => 'appointments/create',
            'old' => flash_get('old', []),
            'errors' => flash_get('errors', []),
            'allowedSpecialties' => $this->allowedSpecialties,
        ]);
    }

    public function store(): void {
        $data = [
            'name'      => trim($_POST['name'] ?? ''),
            'email'     => trim($_POST['email'] ?? ''),
            'phone'     => trim($_POST['phone'] ?? ''),
            'specialty' => trim($_POST['specialty'] ?? ''),
            'symptoms'  => trim($_POST['symptoms'] ?? ''),
            'website'   => trim($_POST['website'] ?? ''),
        ];

        $errors = $this->validate($data);

        if (!empty($errors)) {
            flash_set('errors', $errors);
            flash_set('old', $data);
            redirect('/appointments/create');
        }

        $this->saveAppointment($data);
        $_SESSION['last_appointment_submit_at'] = time();

        flash_set('success', 'Đặt lịch thành công. PRG đã redirect về GET /appointments.');
        redirect('/appointments');
    }

    private function validate(array $data): array {
        $errors = [];

        if ($data['website'] !== '') {
            $errors['_global'] = 'Yêu cầu bị từ chối do phát hiện hành vi giống bot.';
        }

        $lastSubmit = $_SESSION['last_appointment_submit_at'] ?? 0;
        if ($lastSubmit && time() - $lastSubmit < 5) {
            $errors['_global'] = 'Bạn gửi quá nhanh. Vui lòng thử lại sau vài giây.';
        }

        if ($data['name'] === '') {
            $errors['name'] = 'Vui lòng nhập họ tên.';
        } elseif (mb_strlen($data['name']) < 2) {
            $errors['name'] = 'Họ tên phải có ít nhất 2 ký tự.';
        }

        if ($data['email'] === '') {
            $errors['email'] = 'Vui lòng nhập email.';
        } elseif (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
            $errors['email'] = 'Email không đúng định dạng.';
        }

        if ($data['phone'] === '') {
            $errors['phone'] = 'Vui lòng nhập số điện thoại.';
        } elseif (!preg_match('/^[0-9+\-\s]{9,15}$/', $data['phone'])) {
            $errors['phone'] = 'Số điện thoại chỉ gồm số, khoảng trắng, + hoặc -, dài 9-15 ký tự.';
        }

        if ($data['specialty'] === '' || !in_array($data['specialty'], $this->allowedSpecialties, true)) {
            $errors['specialty'] = 'Vui lòng chọn chuyên khoa hợp lệ.';
        }

        if ($data['symptoms'] !== '' && mb_strlen($data['symptoms']) > 300) {
            $errors['symptoms'] = 'Mô tả không được vượt quá 300 ký tự.';
        }

        return $errors;
    }

    private function storageFile(): string {
        return __DIR__ . '/../../storage/appointments.json';
    }

    private function loadAppointments(): array {
        if (!file_exists($this->storageFile())) return [];
        $json = file_get_contents($this->storageFile());
        return json_decode($json, true) ?: [];
    }

    private function saveAppointment(array $data): void {
        $items = $this->loadAppointments();
        $items[] = [
            'id'         => 'A' . str_pad((string)(count($items) + 1), 3, '0', STR_PAD_LEFT),
            'name'       => $data['name'],
            'email'      => $data['email'],
            'phone'      => $data['phone'],
            'specialty'  => $data['specialty'],
            'symptoms'   => $data['symptoms'],
            'created_at' => date('Y-m-d H:i:s'),
        ];
        file_put_contents($this->storageFile(), json_encode($items, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
    }
}