<?php

namespace Integration\ZohoInvoicingBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Oro\Bundle\EntityConfigBundle\Metadata\Annotation\Config;
use Oro\Bundle\EntityConfigBundle\Metadata\Annotation\ConfigField;
use OroCRM\Bundle\ChannelBundle\Model\ChannelAwareInterface;
use Oro\Bundle\IntegrationBundle\Model\IntegrationEntityTrait;
use Integration\ZohoInvoicingBundle\Entity\Interfaces\ZohoEntityType;
/**
 * Items
 *
 * @ORM\Table(name="zohocrm_products",
 *      uniqueConstraints={
 *          @ORM\UniqueConstraint(name="zh_product_zhid_cid_unq", columns={"item_id", "channel_id"})
 *      }                      
 * )
 * @ORM\Entity(repositoryClass="Integration\ZohoInvoicingBundle\Entity\ProductRepository")
 * @ORM\HasLifecycleCallbacks()
 * @Config(
 *      defaultValues={
 *          "entity"={
 *              "icon"="icon-shopping-cart"
 *          },
 *          "ownership"={
 *              "owner_type"="USER",
 *              "owner_field_name"="owner",
 *              "owner_column_name"="owner_id",
 *              "organization_field_name"="organization",
 *              "organization_column_name"="organization_id"
 *          },
 *          "security"={
 *              "type"="ACL",
 *              "group_name"=""
 *          }
 *      }
 * )
 * 
 * @SuppressWarnings(PHPMD.ExcessiveClassComplexity)
 * @SuppressWarnings(PHPMD.ExcessivePublicCount)
 *
 */
class Product implements ZohoEntityType{
    
    use IntegrationEntityTrait;
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="item_id", type="string", length=255)
     */
    private $itemId;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="item_name", type="string", length=255)
     */
    private $itemName;

    /**
     * @var string
     *
     * @ORM\Column(name="status", type="string", length=100)
     */
    private $status;

    /**
     * @var string
     *
     * @ORM\Column(name="source", type="string", length=255)
     */
    private $source;

    /**
     * @var boolean
     *
     * @ORM\Column(name="is_liked_with_zohocrm", type="boolean")
     */
    private $isLikedWithZohocrm;

    /**
     * @var string
     *
     * @ORM\Column(name="zcrm_product_id", type="string", length=255, nullable=true)
     */
    private $zcrmProductId;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text", nullable=true)
     */
    private $description;

    /**
     * @var float
     *
     * @ORM\Column(name="rate", type="float")
     */
    private $rate;

    /**
     * @var string 
     */
    private $taxOriginId;
    
    /**
     * @var Integration
     *
     * @ORM\ManyToOne(targetEntity="Integration\ZohoInvoicingBundle\Entity\Tax")
     * @ORM\JoinColumn(name="tax_id", referencedColumnName="id", onDelete="SET NULL")
     */
    protected $tax;
    
    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }
    
    public function setTaxOriginId($taxOriginId){
        $this->taxOriginId = $taxOriginId;
        
        return $this;
    }
    
    public function getTaxOriginId(){
        return $this->taxOriginId;
    }

    /**
     * Set itemId
     *
     * @param string $itemId
     * @return Product
     */
    public function setItemId($itemId)
    {
        $this->itemId = $itemId;

        return $this;
    }

    /**
     * Get itemId
     *
     * @return string 
     */
    public function getItemId()
    {
        return $this->itemId;
    }

    /**
     * Set name
     *
     * @param string $name
     * @return Product
     */
    public function setName($name)
    {
        $this->name = $name;

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
     * Set itemName
     *
     * @param string $itemName
     * @return Product
     */
    public function setItemName($itemName)
    {
        $this->itemName = $itemName;

        return $this;
    }

    /**
     * Get itemName
     *
     * @return string 
     */
    public function getItemName()
    {
        return $this->itemName;
    }

    /**
     * Set status
     *
     * @param string $status
     * @return Product
     */
    public function setStatus($status)
    {
        $this->status = $status;

        return $this;
    }

    /**
     * Get status
     *
     * @return string 
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Set source
     *
     * @param string $source
     * @return Product
     */
    public function setSource($source)
    {
        $this->source = $source;

        return $this;
    }

    /**
     * Get source
     *
     * @return string 
     */
    public function getSource()
    {
        return $this->source;
    }

    /**
     * Set isLikedWithZohocrm
     *
     * @param boolean $isLikedWithZohocrm
     * @return Product
     */
    public function setIsLikedWithZohocrm($isLikedWithZohocrm)
    {
        $this->isLikedWithZohocrm = $isLikedWithZohocrm;

        return $this;
    }

    /**
     * Get isLikedWithZohocrm
     *
     * @return boolean 
     */
    public function getIsLikedWithZohocrm()
    {
        return $this->isLikedWithZohocrm;
    }

    /**
     * Set zcrmProductId
     *
     * @param string $zcrmProductId
     * @return Product
     */
    public function setZcrmProductId($zcrmProductId)
    {
        $this->zcrmProductId = $zcrmProductId;

        return $this;
    }

    /**
     * Get zcrmProductId
     *
     * @return string 
     */
    public function getZcrmProductId()
    {
        return $this->zcrmProductId;
    }

    /**
     * Set description
     *
     * @param string $description
     * @return Product
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
     * Set rate
     *
     * @param float $rate
     * @return Product
     */
    public function setRate($rate)
    {
        $this->rate = $rate;

        return $this;
    }

    /**
     * Get rate
     *
     * @return float 
     */
    public function getRate()
    {
        return $this->rate;
    }

    /**
     * Set tax
     *
     * @param \Integration\ZohoInvoicingBundle\Entity\Tax $tax
     * @return Product
     */
    public function setTax(\Integration\ZohoInvoicingBundle\Entity\Tax $tax = null)
    {
        $this->tax = $tax;

        return $this;
    }

    /**
     * Get tax
     *
     * @return \Integration\ZohoInvoicingBundle\Entity\Tax 
     */
    public function getTax()
    {
        return $this->tax;
    }
}
