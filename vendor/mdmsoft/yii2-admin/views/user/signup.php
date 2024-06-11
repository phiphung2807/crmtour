<?php
use common\models\User;
use mdm\admin\components\Configs;
use yii\helpers\Html;
use yii\bootstrap5\ActiveForm;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $form yii\bootstrap5\ActiveForm */
/* @var $model \mdm\admin\models\form\Signup */

$this->title = Yii::t('rbac-admin', 'Signup');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-signup">
    <h1><?= Html::encode($this->title) ?></h1>

    <p><em>Vui lòng nhập các thông tin sau:</em></p>
    <?= Html::errorSummary($model)?>
    <div class="row">
        <div class="col-lg-5">
            <?php $form = ActiveForm::begin(['id' => 'form-signup']); ?>
                <?= $form->field($model, 'username') ?>
                <?= $form->field($model, 'fullname') ?>
                <?= $form->field($model, 'sex')->radioList(User::$sexList) ?>
                <?= $form->field($model, 'email') ?>
                <?= $form->field($model, 'password')->passwordInput() ?>
                <div class="mb-3">
                <?= Html::button('Tự động tạo mật khẩu và COPY vào clipboard', [
                    'id' => 'button_generate_password',
                    'onClick' => 'generatePassword()',
                ])?>
                </div>
                <?php
                $roles = Configs::authManager()->getRoles();
                ?>
                <?= $form->field($model, 'role')->checkboxList(ArrayHelper::map($roles, 'name', 'name')) ?>
                <div class="form-group">
                    <?= Html::submitButton(Yii::t('rbac-admin', 'Create'), ['class' => 'btn btn-primary', 'name' => 'signup-button']) ?>
                </div>
            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>
<?php $this->registerJs("
        function generatePassword() {
            var passwdInput = document.getElementById('signup-password');
            passwdInput.type = 'text';
            passwdInput.value = suggestPassword();
            passwdInput.select();
            document.execCommand('copy');
        }
        
        /**
         * Generate a new password and copy it to the password input areas
         *
         * @param passwd_form object   the form that holds the password fields
         *
         * @return boolean  always true
         */
        function suggestPassword () {
            // restrict the password to just letters and numbers to avoid problems:
            // editors and viewers regard the password as multiple words and
            // things like double click no longer work
            var pwchars = 'abcdefghijklmnopqrstuvwxyz0123456789ABCDEFGHIJKLMNOPQRSTUVWYXZ';
            var passwordlength = 16;    // do we want that to be dynamic?  no, keep it simple :)
            var passwd = '';
            var randomWords = new Int32Array(passwordlength);
        
            // First we're going to try to use a built-in CSPRNG
            if (window.crypto && window.crypto.getRandomValues) {
                window.crypto.getRandomValues(randomWords);
            } else if (window.msCrypto && window.msCrypto.getRandomValues) {
                // Because of course IE calls it msCrypto instead of being standard
                window.msCrypto.getRandomValues(randomWords);
            } else {
                // Fallback to Math.random
                for (var i = 0; i < passwordlength; i++) {
                    randomWords[i] = Math.floor(Math.random() * pwchars.length);
                }
            }
        
            for (var i = 0; i < passwordlength; i++) {
                passwd += pwchars.charAt(Math.abs(randomWords[i]) % pwchars.length);
            }
            
            return passwd;
        }
", \yii\web\View::POS_END, 'signup-scripts'); ?>