<?php include ROOT . '/views/layouts/header.php'; ?>

<section>
    <div class="container">
        <div class="row">
            <h1>Кабинет пользователя</h1>
            <?php echo '<h2>Привет ' . $user['name'] . '!</h2>'; ?>
            <ul>
                <li><a href="/cabinet/edit">Изменить данные профиля</a></li>
                <li><a href="/cabinet/history">Список покупок</a></li>
            </ul>
        </div>
    </div>
</section>

<?php include ROOT . '/views/layouts/footer.php'; ?>