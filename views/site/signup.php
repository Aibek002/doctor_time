
<?php
use yii\helpers\Html;

?>
<h1>Sign up</h1>

<form method="post" action="" class="form-signup">
    <?= Html::hiddenInput(Yii::$app->request->csrfParam, Yii::$app->request->csrfToken) ?>

    <div class="form-group">
        <label for="fullname">Full name</label>
        <input id="fullname" name="fullname" type="text" class="form-control" required maxlength="255">
    </div>

    <div class="form-group">
        <label for="email">Email</label>
        <input id="email" name="email" type="email" class="form-control" required maxlength="255">
    </div>

    <div class="form-group">
        <label for="password">Password</label>
        <input id="password" name="password_hash" type="password" class="form-control" required>
    </div>

    <div class="form-group">
        <label>Gender</label><br>
        <label class="radio-inline"><input type="radio" name="gender" value="male" checked> Male</label>
        <label class="radio-inline"><input type="radio" name="gender" value="female"> Female</label>
        <label class="radio-inline"><input type="radio" name="gender" value="other"> Other</label>
    </div>

    <div class="form-group">
        <label for="phone">Phone</label>
        <input id="phone" name="phone" type="tel" class="form-control" maxlength="50">
    </div>

    <div class="form-group">
        <label for="birthday">Birthday</label>
        <input id="birthday" name="birthday" type="date" class="form-control">
    </div>

    <div class="form-group">
        <button type="submit" class="btn btn-primary">Sign up</button>
        <?= Html::a('Cancel', ['site/index'], ['class' => 'btn btn-default']) ?>
    </div>
</form>