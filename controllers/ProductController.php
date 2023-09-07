<?php

namespace app\controllers;

use app\models\Product;
use app\models\Category;
use app\models\ProductCategory;
use app\models\ProductSearch;

use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use Yii;


/**
 * ProductController implements the CRUD actions for Product model.
 */
class ProductController extends Controller
{
    /**
     * @inheritDoc
     */
    public function behaviors() //metodo de yii que sirve para agregar comportamientos a un controlador como limitar las solicitudes a solo post y no delete 
    {
        return array_merge(
            parent::behaviors(),
            [
                'verbs' => [
                    'class' => VerbFilter::className(),
                    'actions' => [
                        'delete' => ['POST'],
                    ],
                ],
            ]
        );
    }

    /**
     * Lists all Product models.
     *
     * @return string
     */
    
    public function actionIndex()
    {
        $searchModel = new ProductSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Product model.
     * @param string $id ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        $model = $this->findModel($id);

        /// Obtener el modelo ProductCategory relacionado con el id de Product
        $modelProductCategory = ProductCategory::findOne(['idProduct' => $model->id]);
        $modelCategoryGroup = Category::findOne(['id' => $modelProductCategory->idCategory_Group]);
        $modelCategoryFamily = Category::findOne(['id' => $modelProductCategory->idCategory_Family]);

        return $this->render('view', [
            'model' => $model,
            'modelCategoryGroup' => $modelCategoryGroup,
            'modelCategoryFamily' => $modelCategoryFamily,
        ]);
    }

    /**
     * Creates a new Product model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new Product();
        $modelProductCategory = new ProductCategory();
        $modelCategoryGroup = Category::find()->where(['type' => 'Grupo'])->all();
        $modelCategoryFamily =  Category::find()->where(['type' => 'Familia'])->all();


        if ($this->request->isPost) {

            if ($model->load($this->request->post())) {

                $modelProductCategory->idProduct = $model->id;
                $modelProductCategory->idCategory_Family = Yii::$app->request->post('ProductCategory')['idCategory_Family']; //llamo la respuesta del post en _Form de Product
                $modelProductCategory->idCategory_Group = Yii::$app->request->post('ProductCategory')['idCategory_Group']; //llamo la respuesta del post en _Form de Product

                if ($model->save() && $modelProductCategory->save()) {
                    return $this->redirect(['view', 'id' => $model->id]);
                }
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
            'modelCategoryGroup' => $modelCategoryGroup,
            'modelCategoryFamily' => $modelCategoryFamily,
            'modelProductCategory' => $modelProductCategory,
        ]);
    }



    /**
     * Updates an existing Product model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */

    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $modelProductCategory = ProductCategory::findOne(['idProduct' => $id]);
        $modelCategoryGroup = Category::findOne(['id' => $modelProductCategory->idCategory_Group]);
        $modelCategoryFamily = Category::findOne(['id' => $modelProductCategory->idCategory_Family]);

        $modelCategoryGroupAll = Category::find()->where(['type' => 'Grupo'])->all();
        $modelCategoryFamilyAll =  Category::find()->where(['type' => 'Familia'])->all();
        if ($this->request->isPost && $model->load($this->request->post())) {
            $modelProductCategory->idCategory_Family = Yii::$app->request->post('ProductCategory')['idCategory_Family']; //llamo la respuesta del post en _Form de Product
            $modelProductCategory->idCategory_Group = Yii::$app->request->post('ProductCategory')['idCategory_Group']; //llamo la respuesta del post en _Form de Product

            if ($model->save() && $modelProductCategory->save()){
                return $this->redirect(['view', 'id' => $model->id]);
            }
           
        }

        return $this->render('update', [
            'model' => $model,
            'modelProductCategory' => $modelProductCategory,
            'modelCategoryGroup' => $modelCategoryGroup,
            'modelCategoryFamily' => $modelCategoryFamily,
            'modelCategoryGroupAll' => $modelCategoryGroupAll,
            'modelCategoryFamilyAll' => $modelCategoryFamilyAll,
        ]);
    }

    /**
     * Deletes an existing Product model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */

    public function actionDelete($id)
    {
        $modelProduct = $this->findModel($id);
        $modelProduct->available = Product::STATUS_DELETED;
        $modelProduct->save();
        
        if (($modelProductCategory = ProductCategory::findOne(['idProduct' => $id])) !== null){
            $modelProductCategory->available = ProductCategory::STATUS_DELETED;
            $modelProductCategory->save();
        }
       

        return $this->redirect(['index']);
    }


    /**
     * Finds the Product model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id ID
     * @return Product the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */

    protected function findModel($id)
    {
        if (($model = Product::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    protected function findModelProductCategory($id)
    {

        if (($modelProductCategory = ProductCategory::findOne(['idProduct' => $id])) !== null) {
            return $modelProductCategory;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
