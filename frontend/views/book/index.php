<?php

use frontend\models\Book;
use yii\helpers\Html;
use yii\bootstrap\Modal;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\BookSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'List Books';
$this->params['breadcrumbs'][] = $this->title;
?>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>


<div class="box box-info">
            <div class="box-header with-border">
            
           <?php if(Yii::$app->user->can('librarian')){ ?>
          			<?= Html::a('Create Book', ['create'], ['class' => 'btn btn-success']) ?>
           <?php }?>
           <?php if(Yii::$app->user->can('student')){ ?>
                <?= Html::a('Brorrow Book', ['borrowbookstudent'], ['class' => 'btn btn-success borrowbookstudent']) ?>
           <?php }?>
           
           
              <div style="text-align: center;">
                  <h3 class="box-title"><?= Html::encode($this->title) ?></h3>
              </div>
              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
              </div>
            </div>
            <!-- /.box-header -->
            
            <div class="box-body">
                <?= GridView::widget([
                    'dataProvider' => $dataProvider,
                    'filterModel' => $searchModel,
                    'columns' => [
                        ['class' => 'yii\grid\SerialColumn'],
            
                        'bookId',
                        'bookName',
                        'referenceNo',
                        'publisher',
                        [
                            'label'=>'Status',
                            'format' => 'raw',
                            'value' => function ($dataProvider) {
                            $bookStatus = Book::find()->where(['bookId'=>$dataProvider->bookId])->One();
                            if($bookStatus->status == 0){
                                $button = 'btn btn-info';
                                $status = 'Available';
                            }elseif ($bookStatus->status == 1){
                                $button = 'btn btn-success';
                                $status = 'Issued';
                            }
                            return '<span class="'.$button.'">'.$status.'</span>';
                            },
                            
                            ],
            
                        ['class' => 'yii\grid\ActionColumn'],
                    ],
                ]); ?>
            </div>
            <!-- /.box-body -->
          </div>

<?php
        Modal::begin([
            'header'=>'<h4>Borrow A Book</h4>',
            'id'=>'borrowbookstudent',
            'size'=>'modal-lg'
            ]);
        echo "<div id='borrowbookstudentContent'></div>";
        Modal::end();
      ?>

