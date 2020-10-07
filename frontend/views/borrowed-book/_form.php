<?php


use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use frontend\models\Student;
use frontend\models\Book;
use kartik\date\DatePicker;



/* @var $this yii\web\View */
/* @var $model frontend\models\BorrowedBook */
/* @var $form yii\widgets\ActiveForm */

$students = ArrayHelper::map(Student::find()->all(), 'studentsId', 'fullName');
$books = ArrayHelper::map(Book::find()-> where(['status'=>'0'])->all(), 'bookId', 'bookName');
?>

<div class="borrowedbook-form">

    <?php $form = ActiveForm::begin(['id' => 'borrowed-book-create']); ?>
    
    <?= $form->field($model, 'borrowDate')->hiddenInput(['value'=>date('yy/m/d')])->label(false) ?>

    <?= $form->field($model, 'studentId')->dropDownList($students) ?>
		
    <?= $form->field($model, 'bookId')->dropDownList($books) ?>

    <?= $form->field($model, 'expectedReturnDate')->widget(DatePicker::classname(), [
    'options' => ['placeholder' => 'Enter birth date ...'],
    'pluginOptions' => [
        'autoclose'=>true,
        'format' => 'yyyy/mm/dd'
     
    ]
]);?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
