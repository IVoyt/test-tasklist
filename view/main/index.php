<?php
    $direction = 'down';
    $order = 'asc';
    $order_url = '';
    if (isset($_GET['order']) && $_GET['order'] == 'asc') :
        $direction = 'up';
        $order = 'asc';
        $order_url = '&order=asc';
    endif;
    if (isset($_GET['order']) && $_GET['order'] == 'desc') :
        $order_url = '&order=desc';
        $order = 'desc';
        $direction = 'down';
    endif;

    if (isset($_GET['sort'])) :
        $sort = $_GET['sort'];
        $sort_url = '?sort='.$_GET['sort'];
    else : $sort = '';
    endif;

?>

<div class="breadcrumb">
    <span>Главная</span>
</div>

<div id="content">
    <div class="row">
        <div class="col-lg-12">
            <div class="form-group">
                <a href="/main/add" class="btn btn-danger btn-sm pull-right btn-space">Добавить задачу</a>
            </div>
            <table class="table table-bordered table-hover">
                <thead>
                    <tr class="active">
                        <td>
                            <span class="sort-link">#</span>
                        </td>
                        <td>
                            <span class="sort-link">id заявки</span>
                        </td>
                        <td>
                            <a href="/main/index?sort=username&order=<?= ($sort == 'username' && $order == 'asc') ?
                                'desc' : 'asc'
                            ?>"
                               id="username"
                               class="sort-link">Пользователь
                                <i class="fa fa-long-arrow-<?= ($sort == 'username') ? $direction : '' ?>"
                                   style="  font-size: 11px !important;
                                            display: <?= ($sort == 'username') ? 'inline-block' : 'none' ?>">

                                </i>
                            </a>
                        </td>
                        <td>
                            <a href="/main/index?sort=email&order=<?= ($sort == 'email' && $order == 'asc') ? 'desc' :
                            'asc' ?>"
                               id="email"
                               class="sort-link">E-mail
                                <i class="fa fa-long-arrow-<?= ($sort == 'email') ? $direction : '' ?>"
                                   style="  font-size: 11px !important;
                                            display: <?= ($sort == 'email') ? 'inline-block' : 'none' ?>">

                                </i>
                            </a>
                        </td>
                        <td>
                            <span class="sort-link">Сообщение</span>
                        </td>
                        <td>
                            <span class="sort-link">Изображение</span>
                        </td>
                        <td>
                            <a href="/main/index?sort=status&order=<?= ($sort == 'status' && $order == 'asc') ? 'desc' : 'asc' ?>"
                               id="status"
                               class="sort-link">Статус
                                <i class="fa fa-long-arrow-<?= ($sort == 'status') ? $direction : '' ?>"
                                   style="  font-size: 11px !important;
                                            display: <?= ($sort == 'status') ? 'inline-block' : 'none' ?>">

                                </i>
                            </a>
                        </td>
                    </tr>
                </thead>
                <?php foreach ($tasks as $k => $task) : ?>
                    <tbody>
                        <tr>
                            <td>
                                <?= $k + 1 ?>
                            </td>
                            <td>
                                <?= $task['id'] ?>
                            </td>
                            <td>
                                <?= $task['username'] ?>
                            </td>
                            <td>
                                <?= $task['email'] ?>
                            </td>
                            <td>
                                <?= $task['content'] ?>
                            </td>
                            <td>
                                <a target="_blank" href="<?= $web_dir.'/img/'.$task['img'] ?>"><?= $task['img'] ?></a>
                            </td>
                            <td style="text-align: center; color: <?= ($task['status'] == 1) ? '#10a300' : '#9b0000' ?>">
                                <?= ($task['status'] == 0) ? '<i class="fa fa-clock-o"' : '<i class="fa fa-check"' ?>
                            </td>
                        </tr>
                    </tbody>
                <?php endforeach;   ?>
            </table>
            <ul class="pagination">
                <?php for ($i = 0; $i < $pages; $i++) : ?>
                    <li>
                        <a href="/main<?= (isset($sort_url)) ? $sort_url : '' ?><?= (isset($order_url)) ? $order_url : '' ?><?= (!empty($_GET) && (isset($_GET['sort']) || isset($_GET['order']))) ? '&' : '?'?>page=<?= ($i+1) ?>">
                            <?= $i+1 ?>
                        </a>
                    </li>
                <?php endfor; ?>
            </ul>
        </div>
    </div>
</div>