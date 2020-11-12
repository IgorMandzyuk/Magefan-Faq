<?php


namespace Magefan\Faq\Api\Data;

interface FaqInterface {

    /**
     * Constants for keys of data array.
     */
    const FAQ_ID = 'id';
    const QUESTION = 'question';
    const ANSWER = 'answer';
    const PRODUCT_SKU = 'product_sku';
    const STATUS = 'status';

    /**
     * Get id
     *
     * @return int|null
     */
    public function getId();

    /**
     * Set id
     *
     * @param int $id
     * @return $this
     */
    public function setId($id);

    /**
     * Get question
     *
     * @return string|null
     */
    public function getQuestion();

    /**
     * Set question
     *
     * @param string $question
     * @return $this
     */
    public function setQuestion(string $question);

    /**
     * Get answer
     *
     * @return string|null
     */
    public function getAnswer();

    /**
     * Set answer
     *
     * @param string $answer
     * @return $this
     */
    public function setAnswer(string $answer);

    /**
     * Get product sku
     *
     * @return string|null
     */
    public function getProductSku();

    /**
     * Set product sku
     *
     * @param string $product_sky
     * @return $this
     */
    public function setProductSku(string $product_sky);


    /**
     * status
     *
     * @return bool|null
     */
    public function Status();

    /**
     * Set status
     *
     * @param int|bool $status
     * @return $this
     */
    public function setStatus($status);
}