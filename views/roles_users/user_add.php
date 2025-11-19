<form action="index.php?action=users_store" method="POST" enctype="multipart/form-data">

    <label>Username:</label>
    <input type="text" name="username" required class="form-control">

    <label>Password:</label>
    <input type="password" name="password" required class="form-control">

    <label>Full name:</label>
    <input type="text" name="full_name" required class="form-control">

    <label>Email:</label>
    <input type="email" name="email" class="form-control">

    <label>Phone:</label>
    <input type="text" name="phone" class="form-control">

    <label>Role:</label>
    <select name="role_id" class="form-control">
        <?php foreach ($roles as $r): ?>
            <option value="<?= $r['id'] ?>"><?= $r['name'] ?></option>
        <?php endforeach; ?>
    </select>

    <label>Status:</label>
    <select name="status" class="form-control">
        <option value="1">Active</option>
        <option value="0">Inactive</option>
    </select>

    <label>Avatar:</label>
    <input type="file" name="avatar" class="form-control">

    <br>
    <button type="submit" class="btn btn-primary">Thêm user</button>

</form>
