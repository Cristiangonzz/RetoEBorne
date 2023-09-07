<?php

namespace app\models;

use Ramsey\Uuid\Uuid;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "ProductCategory".
 *
 * @property string $id
 * @property string $idProduct
 * @property string $idCategory_Family
 * @property string $idCategory_Group
 */
class ProductCategory extends \yii\db\ActiveRecord
{
    const STATUS_DELETED = 0;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'productcategory';
    }

    public function __construct($config = [])
    {
        parent::__construct($config);

        // Generar un UUID v4 y asignarlo al atributo 'id' al crear una nueva instancia
        $this->id = Uuid::uuid4()->toString();
        $this->available = true;
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'idProduct', 'idCategory_Family', 'idCategory_Group', 'available'], 'required'],
            [['id', 'idProduct', 'idCategory_Family', 'idCategory_Group'], 'string', 'max' => 100],
            [['id'], 'unique'],
        ];
    }
    public function getProduct()
    {
        return $this->hasOne(Product::class, ['id' => 'idProduct']);
    }

    public function getCategoryFamily()
    {
        return $this->hasOne(Category::class, ['id' => 'idCategory_Family']);
    }
    public function getCategoryGroup()
    {
        return $this->hasOne(Category::class, ['id' => 'idCategory_Group']);
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'idProduct' => 'Product',
            'idCategory_Family' => 'Family',
            'idCategory_Group' => 'Group',
        ];
    }
}
