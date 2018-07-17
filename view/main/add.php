<div class="breadcrumb">
    <a href="/">Главная</a> / <span>Новая задача</span>
</div>

<div class="row">
    <div class="col-lg-12">
        <form id="add-task" class="form-horizontal" method="POST" action="/main/add" enctype="multipart/form-data">

            <div class="form-group">
                <label for="username">Имя пользователя</label>
                <input type="text" id="username" name="username" required value="" class="form-control" />
            </div>
            <div class="form-group">
                <label for="email">E-mail</label>
                <input type="email" id="email" name="email" required value="" class="form-control" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,3}$" />
            </div>
            <div class="form-group">
                <label for="content">Текст задачи</label>
                <input type="text" id="content" name="content" required value="" class="form-control" />
            </div>
            <div class="form-group">
                <label for="img">Картинка</label>
                <input type="file" id="img" name="img" class="form-control" accept=".jpg, .jpeg, .png" />
            </div>
            <div class="form-group">
                <label for="preview"></label>
                <input type="button" id="preview" value="Предпросмотр" class="btn btn-info" />
                <label for="submit"></label>
                <input type="submit" id="submit"  value="Создать задачу" class="btn btn-success" />
            </div>

        </form>
    </div>
</div>

