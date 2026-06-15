# Mini Clinic Appointment Portal

Dự án này là bài tập thực hành Lab04. Ứng dụng mô phỏng hệ thống đặt lịch khám tại phòng khám. Mã nguồn được xây dựng bằng PHP thuần. Kiến trúc phần mềm áp dụng mô hình Front Controller và MVC cơ bản. Trọng tâm của dự án là thực thi các kỹ thuật bảo mật form và quản lý phiên làm việc an toàn.

## Tính năng nổi bật

* Chống lỗ hổng XSS bằng hàm xử lý đầu ra an toàn.
* Validate dữ liệu phía server nghiêm ngặt.
* Áp dụng kỹ thuật PRG nhằm ngăn chặn lỗi submit trùng form.
* Tích hợp bẫy Honeypot ẩn để chặn bot spam tự động.
* Giới hạn tần suất gửi form liên tục bằng session.
* Đăng nhập an toàn kết hợp cơ chế tái tạo Session ID.
* Xóa sạch toàn bộ dữ liệu phiên khi người dùng đăng xuất.

## Cấu trúc thư mục

* `app/`: Chứa các bộ điều khiển và hàm hỗ trợ lõi.
* `public/`: Chứa file điểm vào duy nhất và tài nguyên tĩnh.
* `storage/`: Nơi lưu trữ dữ liệu dạng JSON.
* `views/`: Chứa mã HTML hiển thị giao diện.

## Yêu cầu môi trường

* Máy tính đã cài đặt PHP phiên bản 8.0 trở lên.
* Đã cài đặt trình quản lý thư viện Composer.

## Hướng dẫn cài đặt và chạy dự án

**Bước 1:** Mở công cụ dòng lệnh (Terminal hoặc PowerShell) tại thư mục gốc của dự án.

**Bước 2:** Chạy dự án
php -S localhost:8000 -t public