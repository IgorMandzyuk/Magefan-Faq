<?php


namespace Magefan\Faq\Model;

use Magento\Framework\Model\AbstractModel;
use Magento\Framework\DataObject\IdentityInterface;
use Magefan\Faq\Api\Data\FaqInterface;

class Faq extends AbstractModel implements FaqInterface, IdentityInterface
{

    const CACHE_TAG = 'magefan_faq';

    protected $_cacheTag = self::CACHE_TAG;

    protected $_eventPrefix = self::CACHE_TAG;

    /**
     * Initialize resource model
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init(\Magefan\Faq\Model\ResourceModel\Faqmodel::class);
    }

    /**
     * Return unique ID(s)
     *
     * @return string[]
     */
    public function getIdentities()
    {
        return [self::CACHE_TAG . '_' . $this->getId()];
    }

    /**
     * Get id
     *
     * @return int|null
     */
    public function getId()
    {
        return $this->getData(self::FAQ_ID);
    }

    /**
     * Set id
     *
     * @param  int $id
     * @return $this
     */
    public function setId($id)
    {
        return $this->setData(self::FAQ_ID, $id);
    }

    /**
     * Get question
     *
     * @return string|null
     */
    public function getQuestion()
    {
        return $this->getData(self::QUESTION);
    }

    /**
     * Set question
     *
     * @param  string $question
     * @return $this
     */
    public function setQuestion($question)
    {
        return $this->setData(self::QUESTION, $question);
    }

    /**
     * Get answer
     *
     * @return string|null
     */
    public function getAnswer()
    {
        return $this->getData(self::ANSWER);
    }

    /**
     * Set answer
     *
     * @param  string $answer
     * @return $this
     */
    public function setAnswer($answer)
    {
        return $this->setData(self::ANSWER, $answer);
    }

    /**
     * Get product sku
     *
     * @return string|null
     */
    public function getProductSku()
    {
        return $this->getData(self::PRODUCT_SKU);
    }

    /**
     * Set product sku
     *
     * @param  string $product_sku
     * @return $this
     */
    public function setProductSku($product_sku)
    {
        return $this->setData(self::PRODUCT_SKU, $product_sku);
    }

    /**
     * status
     *
     * @return bool|null
     */
    public function status()
    {
        return $this->getData(self::STATUS);
    }

    /**
     * Set status
     *
     * @param  int|bool $status
     * @return $this
     */
    public function setStatus($status)
    {
        return $this->setData(self::STATUS, $status);
    }
}
