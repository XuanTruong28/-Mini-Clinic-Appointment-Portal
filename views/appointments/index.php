<?php /** @var array $items */ ?>
<h1>Danh sách lịch hẹn</h1>
<p><a class="btn primary" href="/appointments/create">Đặt lịch mới</a></p>

<table class="table">
    <thead>
        <tr>
            <th>ID</th><th>Họ tên</th><th>Email</th><th>Phone</th><th>Chuyên khoa</th><th>Ngày đăng ký</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($items as $item): ?>
        <tr>
            <td><?= h($item['id']) ?></td>
            <td><?= h($item['name']) ?></td>
            <td><?= h($item['email']) ?></td>
            <td><?= h($item['phone']) ?></td>
            <td><?= h(ucfirst($item['specialty'])) ?></td>
            <td><?= h($item['created_at']) ?></td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>