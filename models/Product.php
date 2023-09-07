<?php

namespace app\models;

use Ramsey\Uuid\Uuid;

/**
 * This is the model class for table "product".
 *
 * @property string $id
 * @property string $name
 * @property string $description
 * @property float $price
 */
class Product extends \yii\db\ActiveRecord
{
    const STATUS_DELETED = 0;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'product';
    }
    /**
     * {@inheritdoc}
     */
    public function __construct($config = [])
    {
        parent::__construct($config);

        // Generar un UUID v4 y asignarlo al atributo 'id' al crear una nueva instancia
        $this->id = Uuid::uuid4()->toString();
        $this->available = true;
    }

    public function getProductCategories()
    {
        return $this->hasMany(ProductCategory::class, ['idProduct' => 'id']);
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'price'], 'required'],
            [['price'], 'number'],
            [['id'], 'string', 'max' => 100],
            [['name'], 'string', 'max' => 255],
            [['id'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'name' => 'Name',
            'price' => 'Price',
        ];
    }
}
