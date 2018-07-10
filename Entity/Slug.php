<?php

namespace snakemkua\Warp12Bundle\Entity;
use Behat\Transliterator\Transliterator as UrlTrans;

/**
 * Slug
 */
class Slug
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var string
     */
    private $src;

    /**
     * @var string
     */
    private $url;

    /**
     * @var string
     */
    private $class;

    /**
     * @var \DateTime
     */
    private $dateCreated;

    /**
     * @var \snakemkua\Warp12Bundle\Entity\Page
     */
    private $consumer;


    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set src
     *
     * @param string $src
     *
     * @return Slug
     */
    public function setSrc($src)
    {
        $this->src = trim($src);

        return $this;
    }

    /**
     * Get src
     *
     * @return string
     */
    public function getSrc()
    {
        return $this->src;
    }

    /**
     * Set url
     *
     * @param string $url
     *
     * @return Slug
     */
    public function setUrl($url)
    {
        $this->url = $url;

        return $this;
    }

    /**
     * Get url
     *
     * @return string
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * Set class
     *
     * @param string $class
     *
     * @return Slug
     */
    public function setClass($class)
    {
        $this->class = $class;

        return $this;
    }

    /**
     * Get class
     *
     * @return string
     */
    public function getClass()
    {
        return $this->class;
    }

    /**
     * Set dateCreated
     *
     * @param \DateTime $dateCreated
     *
     * @return Slug
     */
    public function setDateCreated($dateCreated)
    {
        $this->dateCreated = $dateCreated;

        return $this;
    }

    /**
     * Get dateCreated
     *
     * @return \DateTime
     */
    public function getDateCreated()
    {
        return $this->dateCreated;
    }

    /**
     * Set consumer
     *
     * @param \snakemkua\Warp12Bundle\Entity\Page $consumer
     *
     * @return Slug
     */
    public function setConsumer(\snakemkua\Warp12Bundle\Entity\Page $consumer = null)
    {
        $this->consumer = $consumer;

        return $this;
    }

    /**
     * Get consumer
     *
     * @return \snakemkua\Warp12Bundle\Entity\Page
     */
    public function getConsumer()
    {
        return $this->consumer;
    }

    public function generateUrl() {
        if ($this->getSrc() and strlen($this->getSrc()) > 0) {
            $this->setUrl(UrlTrans::transliterate($this->getSrc()));
        }
    }

    /**
     * @var integer
     */
    private $targetId;


    /**
     * Set targetId
     *
     * @param integer $targetId
     *
     * @return Slug
     */
    public function setTargetId($targetId)
    {
        $this->targetId = $targetId;

        return $this;
    }

    /**
     * Get targetId
     *
     * @return integer
     */
    public function getTargetId()
    {
        return $this->targetId;
    }
    /**
     * @var boolean
     */
    private $current = true;


    /**
     * Set current
     *
     * @param boolean $current
     *
     * @return Slug
     */
    public function setCurrent($current)
    {
        $this->current = $current;

        return $this;
    }

    /**
     * Get current
     *
     * @return boolean
     */
    public function getCurrent()
    {
        return $this->current;
    }
    /**
     * @var string
     */
    private $class_previous;


    /**
     * Set classPrevious
     *
     * @param string $classPrevious
     *
     * @return Slug
     */
    public function setClassPrevious($classPrevious)
    {
        $this->class_previous = $classPrevious;

        return $this;
    }

    /**
     * Get classPrevious
     *
     * @return string
     */
    public function getClassPrevious()
    {
        return $this->class_previous;
    }
}
