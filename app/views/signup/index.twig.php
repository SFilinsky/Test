<h2>Sign up using this form</h2>

<form method='post'>

    <p>
        <label for="name">Name</label>
        <?= $form->render('name') ?>
    </p>
    <p>
        <label for="email">E-Mail</label>
        <?= $form->render('email') ?>
    </p>

    <p>
        <?= $this->tag->submitButton('Register') ?>
    </p>

</form>