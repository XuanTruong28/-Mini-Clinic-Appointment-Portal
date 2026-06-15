<h1>Form Đặt Lịch Khám</h1>
<p>Submit đến <strong>POST /appointments</strong>. Có field honeypot ẩn và validate server-side.</p>

<?php if (!empty($errors['_global'])): ?>
    <div class="alert error"><?= h($errors['_global']) ?></div>
<?php endif; ?>

<form method="post" action="/appointments" class="card">
    <div class="form-group">
        <label>Họ tên bệnh nhân</label>
        <input name="name" value="<?= h($old['name'] ?? '') ?>">
        <?php if (!empty($errors['name'])): ?><div class="error-text"><?= h($errors['name']) ?></div><?php endif; ?>
    </div>
    <div class="form-group">
        <label>Email</label>
        <input name="email" value="<?= h($old['email'] ?? '') ?>">
        <?php if (!empty($errors['email'])): ?><div class="error-text"><?= h($errors['email']) ?></div><?php endif; ?>
    </div>
    <div class="form-group">
        <label>Số điện thoại</label>
        <input name="phone" value="<?= h($old['phone'] ?? '') ?>">
        <?php if (!empty($errors['phone'])): ?><div class="error-text"><?= h($errors['phone']) ?></div><?php endif; ?>
    </div>
    <div class="form-group">
        <label>Chuyên khoa cần khám</label>
        <select name="specialty">
            <option value="">-- Chọn chuyên khoa --</option>
            <option value="general" <?= (($old['specialty'] ?? '') === 'general') ? 'selected' : '' ?>>Khám tổng quát</option>
            <option value="cardiology" <?= (($old['specialty'] ?? '') === 'cardiology') ? 'selected' : '' ?>>Tim mạch</option>
            <option value="dermatology" <?= (($old['specialty'] ?? '') === 'dermatology') ? 'selected' : '' ?>>Da liễu</option>
            <option value="pediatrics" <?= (($old['specialty'] ?? '') === 'pediatrics') ? 'selected' : '' ?>>Nhi khoa</option>
        </select>
        <?php if (!empty($errors['specialty'])): ?><div class="error-text"><?= h($errors['specialty']) ?></div><?php endif; ?>
    </div>
    <div class="form-group">
        <label>Mô tả triệu chứng lâm sàng</label>
        <textarea name="symptoms"><?= h($old['symptoms'] ?? '') ?></textarea>
        <?php if (!empty($errors['symptoms'])): ?><div class="error-text"><?= h($errors['symptoms']) ?></div><?php endif; ?>
    </div>
    
    <div class="honeypot">
        <label>Website</label>
        <input name="website" tabindex="-1" autocomplete="off">
    </div>

    <button class="btn primary" type="submit">Gửi lịch khám</button>
    <a class="btn secondary" href="/appointments">Quay lại</a>
</form>