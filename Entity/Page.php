<?php

namespace snakemkua\Warp12Bundle\Entity;

/**
 * Page
 */
class Page
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var integer
     */
    private $lft;

    /**
     * @var integer
     */
    private $rgt;

    /**
     * @var integer
     */
    private $lvl;

    /**
     * @var string
     */
    private $name;

    /**
     * @var string
     */
    private $title;

    /**
     * @var string
     */
    private $metadescription;

    /**
     * @var string
     */
    private $metakeywords;

    /**
     * @var string
     */
    private $body;

    /**
     * @var \DateTime
     */
    private $dateCreated;

    /**
     * @var \DateTime
     */
    private $dateUpdated;

    /**
     * @var boolean
     */
    private $published = true;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $children;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $urls;

    /**
     * @var \snakemkua\Warp12Bundle\Entity\Page
     */
    private $root;

    /**
     * @var \snakemkua\Warp12Bundle\Entity\Page
     */
    private $parent;

    /**
     * @var string
     */
    private $module;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->children = new \Doctrine\Common\Collections\ArrayCollection();
        $this->urls = new \Doctrine\Common\Collections\ArrayCollection();
    }

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
     * Set lft
     *
     * @param integer $lft
     *
     * @return Page
     */
    public function setLft($lft)
    {
        $this->lft = $lft;

        return $this;
    }

    /**
     * Get lft
     *
     * @return integer
     */
    public function getLft()
    {
        return $this->lft;
    }

    /**
     * Set rgt
     *
     * @param integer $rgt
     *
     * @return Page
     */
    public function setRgt($rgt)
    {
        $this->rgt = $rgt;

        return $this;
    }

    /**
     * Get rgt
     *
     * @return integer
     */
    public function getRgt()
    {
        return $this->rgt;
    }

    /**
     * Set lvl
     *
     * @param integer $lvl
     *
     * @return Page
     */
    public function setLvl($lvl)
    {
        $this->lvl = $lvl;

        return $this;
    }

    /**
     * Get lvl
     *
     * @return integer
     */
    public function getLvl()
    {
        return $this->lvl;
    }

    /**
     * Set name
     *
     * @param string $name
     *
     * @return Page
     */
    public function setName($name)
    {
        $this->name = trim($name);

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set title
     *
     * @param string $title
     *
     * @return Page
     */
    public function setTitle($title)
    {
        $this->title = trim($title);

        return $this;
    }

    /**
     * Get title
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set metadescription
     *
     * @param string $metadescription
     *
     * @return Page
     */
    public function setMetadescription($metadescription)
    {
        $this->metadescription = $metadescription;

        return $this;
    }

    /**
     * Get metadescription
     *
     * @return string
     */
    public function getMetadescription()
    {
        return $this->metadescription;
    }

    /**
     * Set metakeywords
     *
     * @param string $metakeywords
     *
     * @return Page
     */
    public function setMetakeywords($metakeywords)
    {
        $this->metakeywords = $metakeywords;

        return $this;
    }

    /**
     * Get metakeywords
     *
     * @return string
     */
    public function getMetakeywords()
    {
        return $this->metakeywords;
    }

    /**
     * Set body
     *
     * @param string $body
     *
     * @return Page
     */
    public function setBody($body)
    {
        $this->body = $body;

        return $this;
    }

    /**
     * Get body
     *
     * @return string
     */
    public function getBody()
    {
        return $this->body;
    }

    /**
     * Set dateCreated
     *
     * @param \DateTime $dateCreated
     *
     * @return Page
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
     * Set dateUpdated
     *
     * @param \DateTime $dateUpdated
     *
     * @return Page
     */
    public function setDateUpdated($dateUpdated)
    {
        $this->dateUpdated = $dateUpdated;

        return $this;
    }

    /**
     * Get dateUpdated
     *
     * @return \DateTime
     */
    public function getDateUpdated()
    {
        return $this->dateUpdated;
    }

    /**
     * Set published
     *
     * @param boolean $published
     *
     * @return Page
     */
    public function setPublished($published)
    {
        $this->published = $published;

        return $this;
    }

    /**
     * Get published
     *
     * @return boolean
     */
    public function getPublished()
    {
        return $this->published;
    }

    /**
     * Add child
     *
     * @param \snakemkua\Warp12Bundle\Entity\Page $child
     *
     * @return Page
     */
    public function addChild(\snakemkua\Warp12Bundle\Entity\Page $child)
    {
        $this->children[] = $child;

        return $this;
    }

    /**
     * Remove child
     *
     * @param \snakemkua\Warp12Bundle\Entity\Page $child
     */
    public function removeChild(\snakemkua\Warp12Bundle\Entity\Page $child)
    {
        $this->children->removeElement($child);
    }

    /**
     * Get children
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getChildren()
    {
        return $this->children;
    }

    /**
     * Add url
     *
     * @param \snakemkua\Warp12Bundle\Entity\Slug $url
     *
     * @return Page
     */
    public function addUrl(\snakemkua\Warp12Bundle\Entity\Slug $url)
    {
        $this->urls[] = $url;

        return $this;
    }

    /**
     * Remove url
     *
     * @param \snakemkua\Warp12Bundle\Entity\Slug $url
     */
    public function removeUrl(\snakemkua\Warp12Bundle\Entity\Slug $url)
    {
        $this->urls->removeElement($url);
    }

    /**
     * Get urls
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getUrls()
    {
        return $this->urls;
    }

    /**
     * Set root
     *
     * @param \snakemkua\Warp12Bundle\Entity\Page $root
     *
     * @return Page
     */
    public function setRoot(\snakemkua\Warp12Bundle\Entity\Page $root = null)
    {
        $this->root = $root;

        return $this;
    }

    /**
     * Get root
     *
     * @return \snakemkua\Warp12Bundle\Entity\Page
     */
    public function getRoot()
    {
        return $this->root;
    }

    /**
     * Set parent
     *
     * @param \snakemkua\Warp12Bundle\Entity\Page $parent
     *
     * @return Page
     */
    public function setParent(\snakemkua\Warp12Bundle\Entity\Page $parent = null)
    {
        $this->parent = $parent;

        return $this;
    }

    /**
     * Get parent
     *
     * @return \snakemkua\Warp12Bundle\Entity\Page
     */
    public function getParent()
    {
        return $this->parent;
    }


    /**
     * Set module
     *
     * @param string $module
     *
     * @return Page
     */
    public function setModule($module)
    {
        $this->module = $module;

        return $this;
    }

    /**
     * Get module
     *
     * @return string
     */
    public function getModule()
    {
        return $this->module;
    }
    /**
     * @var integer
     */
    private $sortPriority = 0;


    /**
     * Set sortPriority
     *
     * @param integer $sortPriority
     *
     * @return Page
     */
    public function setSortPriority($sortPriority)
    {
        $this->sortPriority = $sortPriority;

        return $this;
    }

    /**
     * Get sortPriority
     *
     * @return integer
     */
    public function getSortPriority()
    {
        return $this->sortPriority;
    }
    /**
     * @var boolean
     */
    private $homepage = false;


    /**
     * Set homepage
     *
     * @param boolean $homepage
     *
     * @return Page
     */
    public function setHomepage($homepage)
    {
        $this->homepage = $homepage;

        return $this;
    }

    /**
     * Get homepage
     *
     * @return boolean
     */
    public function getHomepage()
    {
        return $this->homepage;
    }
}
