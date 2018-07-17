<?php

    /**
     * @var $username
     * @var $email
     * @var $content
     */

?>
<div id="content">
    <div class="row">
        <div class="col-lg-12">
            <table class="table table-bordered table-hover" style="margin-top: 20px">
                <thead>
                    <tr class="active">
                        <td>
                            <span class="sort-link">Пользователь</span>
                        </td>
                        <td>
                            <span class="sort-link">E-mail</span>
                        </td>
                        <td>
                            <span class="sort-link">Сообщение</span>
                        </td>
                    </tr>
                </thead>
                    <tbody>
                        <tr>
                            <td>
                                <?= $username ?>
                            </td>
                            <td>
                                <?= $email ?>
                            </td>
                            <td>
                                <?= $content ?>
                            </td>
                        </tr>
                    </tbody>
            </table>
        </div>
    </div>
</div>