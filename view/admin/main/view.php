<div class="breadcrumb">
    <a href="/">Главная</a> / <a href="/admin/main">Задачи</a> / <span>Новая задача</span>
</div>

<div id="content">
    <div class="row">
        <div class="col-lg-12">
            <form method="get" action="/admin/main/update?id=<?= $task['id'] ?>">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <td>
                                ID
                            </td>
                            <td>
                                Имя пользователя
                            </td>
                            <td>
                                E-mail
                            </td>
                            <td>
                                Сообщение
                            </td>
                            <td>
                                Статус
                            </td>
                            <td>
                                Действие
                            </td>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>
                                <?= $task['id'] ?>
                                <input type="hidden" name="id" value="<?= $task['id'] ?>">
                            </td>
                            <td>
                                <?= $task['username'] ?>
                            </td>
                            <td>
                                <?= $task['email'] ?>
                            </td>
                            <td>
                                <textarea name="content"><?= $task['content'] ?></textarea>
                            </td>
                            <td>
                                <input type="checkbox" id="checkbox" name="status" value="1" <?= ($task['status'] ==
                                1) ? 'checked' : '' ?>>
                            </td>
                            <td>
                                <input type="submit" class="btn btn-primary" value="Сохранить" />
                            </td>
                        </tr>
                    </tbody>
                </table>
            </form>
        </div>
    </div>
</div>