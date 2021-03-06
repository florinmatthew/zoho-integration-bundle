<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Integration\ZohoInvoicingBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Oro\Bundle\EntityConfigBundle\Metadata\Annotation\Config;
use Oro\Bundle\EntityConfigBundle\Metadata\Annotation\ConfigField;
use Oro\Bundle\IntegrationBundle\Model\IntegrationEntityTrait;
use Integration\ZohoInvoicingBundle\Entity\Interfaces\ZohoEntityType;
/**
 * Description of Currencies
 *
 * @author Florian Matthew <florin.gligor@reea.net>
 */

/**
 * @ORM\Entity(repositoryClass="Integration\ZohoInvoicingBundle\Entity\CurrenciesRepository")
 * @ORM\Table(name="zoho_currencies",
 *    uniqueConstraints={
 *        @ORM\UniqueConstraint(name="zh_currency_id_tax_zhid_cid_unq", columns={"currency_id", "channel_id"})
 *    } 
 * )
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
 */
class Currencies implements ZohoEntityType{
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
     * @ORM\Column(name="currency_id", type="string", length=255)
     */
    private $currencyId;
    
    /**
     * @var string
     *
     * @ORM\Column(name="currency_code", type="string", length=50)
     */
    private $currencyCode;
    
    /**
     * @var string
     *
     * @ORM\Column(name="currency_name", type="string", length=255)
     */
    private $currencyName;
    
    /**
     * @var string
     *
     * @ORM\Column(name="currency_symbol", type="string", length=10)
     */
    private $currencySymbol;
    
    /**
     * @var string
     *
     * @ORM\Column(name="price_precision", type="string", length=10)
     */
    private $pricePrecision;
    
    /**
     * @var string
     *
     * @ORM\Column(name="currency_format", type="string", length=100)
     */
    private $currencyFormat;
    
    /**
     * @var boolean
     *
     * @ORM\Column(name="is_base_currency", type="boolean")
     */
    private $isBaseCurrency;
    
    /**
     * @var float
     *
     * @ORM\Column(name="exchange_rate", type="float")
     */
    private $exchangeRate;
    
    /**
     * @var string
     *
     * @ORM\Column(name="effective_date", type="string", nullable=true)
     */
    private $effectiveDate;

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
     * Set currencyId
     *
     * @param string $currencyId
     * @return Currencies
     */
    public function setCurrencyId($currencyId)
    {
        $this->currencyId = $currencyId;

        return $this;
    }

    /**
     * Get currencyId
     *
     * @return string 
     */
    public function getCurrencyId()
    {
        return $this->currencyId;
    }

    /**
     * Set currencyCode
     *
     * @param string $currencyCode
     * @return Currencies
     */
    public function setCurrencyCode($currencyCode)
    {
        $this->currencyCode = $currencyCode;

        return $this;
    }

    /**
     * Get currencyCode
     *
     * @return string 
     */
    public function getCurrencyCode()
    {
        return $this->currencyCode;
    }

    /**
     * Set currencyName
     *
     * @param string $currencyName
     * @return Currencies
     */
    public function setCurrencyName($currencyName)
    {
        $this->currencyName = $currencyName;

        return $this;
    }

    /**
     * Get currencyName
     *
     * @return string 
     */
    public function getCurrencyName()
    {
        return $this->currencyName;
    }

    /**
     * Set currencySymbol
     *
     * @param string $currencySymbol
     * @return Currencies
     */
    public function setCurrencySymbol($currencySymbol)
    {
        $this->currencySymbol = $currencySymbol;

        return $this;
    }

    /**
     * Get currencySymbol
     *
     * @return string 
     */
    public function getCurrencySymbol()
    {
        return $this->currencySymbol;
    }

    /**
     * Set pricePrecision
     *
     * @param string $pricePrecision
     * @return Currencies
     */
    public function setPricePrecision($pricePrecision)
    {
        $this->pricePrecision = $pricePrecision;

        return $this;
    }

    /**
     * Get pricePrecision
     *
     * @return string 
     */
    public function getPricePrecision()
    {
        return $this->pricePrecision;
    }

    /**
     * Set currencyFormat
     *
     * @param string $currencyFormat
     * @return Currencies
     */
    public function setCurrencyFormat($currencyFormat)
    {
        $this->currencyFormat = $currencyFormat;

        return $this;
    }

    /**
     * Get currencyFormat
     *
     * @return string 
     */
    public function getCurrencyFormat()
    {
        return $this->currencyFormat;
    }

    /**
     * Set isBaseCurrency
     *
     * @param boolean $isBaseCurrency
     * @return Currencies
     */
    public function setIsBaseCurrency($isBaseCurrency)
    {
        $this->isBaseCurrency = $isBaseCurrency;

        return $this;
    }

    /**
     * Get isBaseCurrency
     *
     * @return boolean 
     */
    public function getIsBaseCurrency()
    {
        return $this->isBaseCurrency;
    }

    /**
     * Set exchangeRate
     *
     * @param float $exchangeRate
     * @return Currencies
     */
    public function setExchangeRate($exchangeRate)
    {
        $this->exchangeRate = $exchangeRate;

        return $this;
    }

    /**
     * Get exchangeRate
     *
     * @return float 
     */
    public function getExchangeRate()
    {
        return $this->exchangeRate;
    }

    /**
     * Set effectiveDate
     *
     * @param \DateTime $effectiveDate
     * @return Currencies
     */
    public function setEffectiveDate($effectiveDate)
    {
        $this->effectiveDate = $effectiveDate;

        return $this;
    }

    /**
     * Get effectiveDate
     *
     * @return \DateTime 
     */
    public function getEffectiveDate()
    {
        return $this->effectiveDate;
    }
}
