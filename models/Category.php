<?php

namespace app\models;

use Yii;
use Ramsey\Uuid\Uuid;
/**
 * This is the model class for table "category".
 *
 * @property string $id
 * @property string $name
 * @property string $description
 * @property string $type
 */
class Category extends \yii\db\ActiveRecord
{
    const STATUS_DELETED = 0;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'category';
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
            [['name', 'type'], 'required'],
            [['name', 'type'], 'string', 'max' => 255],
            [['id'], 'unique'],
        ];
    }

    public function getProductCategories()
    {
        return $this->hasMany(ProductCategory::class, ['idCategoryFamily' => 'id']);
    }
    public function getProductCategoriesGroup()
    {
        return $this->hasMany(ProductCategory::class, ['idCategoryGroup' => 'id']);
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'name' => 'Name',
            'type' => 'Type',
        ];
    }
}
