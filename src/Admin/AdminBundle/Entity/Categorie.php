<?php

namespace Admin\AdminBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Categorie
 *
 * @ORM\Table(name="categorie")
 * @ORM\Entity(repositoryClass="Admin\AdminBundle\Repository\CategorieRepository")
 */
class Categorie
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="nom", type="string", length=255, unique=true)
     */
    private $nom;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text", nullable=true)
     */
    private $description;

    /**
     * @var
     *
     * @ORM\OneToMany(targetEntity="Admin\AdminBundle\Entity\Categorie", mappedBy="parent", cascade={"remove"})
     * @ORM\JoinColumn(nullable=true)
     */
    private $enfants;

    /**
     * @var
     *
     * @ORM\ManyToOne(targetEntity="Admin\AdminBundle\Entity\Categorie", inversedBy="enfants", fetch="EAGER")
     * @ORM\JoinColumn(name="parent", referencedColumnName="id", nullable=true)
     */
    private $parent;

    public function __construct()
    {
        $this->enfants = new ArrayCollection();
    }

    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set nom
     *
     * @param string $$nom
     *
     * @return Categorie
     */
    public function setNom($nom)
    {
        $this->nom = $nom;

        return $this;
    }

    /**
     * Get nom
     *
     * @return string
     */
    public function getNom()
    {
        return $this->nom;
    }

    /**
     * Set description
     *
     * @param string $description
     *
     * @return Categorie
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }


    /**
     * Add enfant
     *
     * @param \Admin\AdminBundle\Entity\Categorie $enfant
     *
     * @return Categorie
     */
    public function addEnfant(\Admin\AdminBundle\Entity\Categorie $enfant)
    {
        $this->enfants[] = $enfant;
        $enfant->setParent($this);

        return $this;
    }

    /**
     * Remove enfant
     *
     * @param \Admin\AdminBundle\Entity\Categorie $enfant
     */
    public function removeEnfant(\Admin\AdminBundle\Entity\Categorie $enfant)
    {
        $this->enfants->removeElement($enfant);
    }

    /**
     * Get enfants
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getEnfants()
    {
        return $this->enfants;
    }

    /**
     * Set parent
     *
     * @param \Admin\AdminBundle\Entity\Categorie $parent
     *
     * @return Categorie
     */
    public function setParent(\Admin\AdminBundle\Entity\Categorie $parent = null)
    {
//        $this->addEnfant($this);
        $this->parent = $parent;

        return $this;
    }

    /**
     * Get parent
     *
     * @return \Admin\AdminBundle\Entity\Categorie
     */
    public function getParent()
    {
        return $this->parent;
    }
}
