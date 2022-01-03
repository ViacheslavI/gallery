<form method="POST" action="/user/signup" class="w-50 mt-2">
    <div class="form-group row">
        <label for="name" class="col-md-4 col-form-label text-md-right">Name</label>

        <div class="col-md-6">
            <input id="name" type="text" class="form-control" name="name"
                   placeholder="enter name" required autocomplete="name"
                   value="<?= isset($_SESSION['form_data']['name']) ? h($_SESSION['form_data']['name']) : ''; ?>"
                   autofocus>

        </div>
    </div>

    <div class="form-group row">
        <label for="email" class="col-md-4 col-form-label text-md-right">Email</label>

        <div class="col-md-6">
            <input id="email" type="email" class="form-control " name="email"
                   placeholder="enter email"
                   value="<?= isset($_SESSION['form_data']['email']) ? h($_SESSION['form_data']['email']) : ''; ?>"
                   required autocomplete="email">
        </div>
    </div>

    <div class="form-group row">
        <label for="password" class="col-md-4 col-form-label text-md-right">Password</label>

        <div class="col-md-6">
            <input id="password" type="password" class="form-control" placeholder="enter password"
                   name="password" required autocomplete="new-password">
        </div>
    </div>

    <div class="form-group row">
        <label for="password-confirm" class="col-md-4 col-form-label text-md-right">Confirm Password</label>

        <div class="col-md-6">
            <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required
                   placeholder="confirm password" autocomplete="new-password">
        </div>
    </div>

    <div class="form-group row mb-0">
        <div class="col-md-6 offset-md-4">
            <button type="submit" class="btn btn-primary" value="Register">
                Register
            </button>
        </div>
    </div>
</form>
<?php if(isset($_SESSION['form_data'])) unset($_SESSION['form_data']); ?>