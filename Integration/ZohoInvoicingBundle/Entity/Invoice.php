<?php

namespace Integration\ZohoInvoicingBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Oro\Bundle\EntityConfigBundle\Metadata\Annotation\Config;
use Oro\Bundle\EntityConfigBundle\Metadata\Annotation\ConfigField;
use Integration\ZohoInvoicingBundle\Entity\Interfaces\IntegrationAwareInterface;
use Integration\ZohoInvoicingBundle\Entity\Interfaces\OriginAwareInterface;
use BeSimple\SoapBundle\ServiceDefinition\Annotation as Soap;
use Oro\Bundle\OrganizationBundle\Entity\Organization;
use OroCRM\Bundle\ChannelBundle\Model\ChannelAwareInterface;

use Oro\Bundle\IntegrationBundle\Model\IntegrationEntityTrait;

/**
 * Invoice
 *
 * @SuppressWarnings(PHPMD.ExcessivePublicCount)
 * @SuppressWarnings(PHPMD.ExcessiveClassComplexity)
 * @SuppressWarnings(PHPMD.TooManyFields)
 *
 * @ORM\Table(name="zohocrm_invoices")
 * @ORM\Entity(repositoryClass="Integration\ZohoInvoicingBundle\Entity\InvoiceRepository")
 * @ORM\HasLifecycleCallbacks
 *
 * @Config(
 *      defaultValues={
 *          "ownership"={
 *              "owner_type"="USER",
 *              "owner_field_name"="owner",
 *              "owner_column_name"="owner_id",
 *              "organization_field_name"="organization",
 *              "organization_column_name"="organization_id"
 *          },
 *          "entity"={
 *              "icon"="icon-shopping-cart"
 *          },
 *          "security"={
 *              "type"="ACL",
 *              "group_name"=""
 *          }
 *      }
 * )
 */


class Invoice{
    use IntegrationEntityTrait;
    /**
     * @var User
     * @ORM\ManyToOne(targetEntity="Oro\Bundle\UserBundle\Entity\User")
     * @ORM\JoinColumn(name="owner_id", referencedColumnName="id", onDelete="SET NULL")
     * @Soap\ComplexType("string", nillable=true)
     */
    private $owner;

    /**
     * @var Organization
     *
     * @ORM\ManyToOne(targetEntity="Oro\Bundle\OrganizationBundle\Entity\Organization")
     * @ORM\JoinColumn(name="organization_id", referencedColumnName="id", onDelete="SET NULL")
     * @Soap\ComplexType("string", nillable=true)
     */
    private $organization;

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
     * @ORM\Column(name="invoice_id", type="string", length=255)
     */
    private $invoiceId;

    /**
     * @var string
     *
     * @ORM\Column(name="customer_name", type="string", length=255)
     */
    private $customerName;

    /**
     * @var string
     *
     * @ORM\Column(name="customer_id", type="string", length=255)
     */
    private $customerId;

    /**
     * @var string
     *
     * @ORM\Column(name="status", type="string", length=100)
     */
    private $status;

    /**
     * @var string
     *
     * @ORM\Column(name="invoice_number", type="string", length=255)
     */
    private $invoiceNumber;

    /**
     * @var string
     *
     * @ORM\Column(name="reference_number", type="string", length=255)
     */
    private $referenceNumber;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date", type="date")
     */
    private $date;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="due_date", type="date")
     */
    private $dueDate;

    /**
     * @var integer
     *
     * @ORM\Column(name="currency_id", type="integer")
     */
    private $currencyId;

    /**
     * @var string
     *
     * @ORM\Column(name="currency_code", type="string", length=10)
     */
    private $currencyCode;

    /**
     * @var float
     *
     * @ORM\Column(name="total", type="float")
     */
    private $total;

    /**
     * @var float
     *
     * @ORM\Column(name="ballance", type="float")
     */
    private $ballance;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="created_time", type="datetime")
     */
    private $createdTime;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="last_modified_time", type="datetime")
     */
    private $lastModifiedTime;

    /**
     * @var boolean
     *
     * @ORM\Column(name="is_emailed", type="boolean")
     */
    private $isEmailed;

    /**
     * @var integer
     *
     * @ORM\Column(name="reminders_sent", type="integer")
     */
    private $remindersSent;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="last_reminder_sent_date", type="date")
     */
    private $lastReminderSentDate;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="payment_expected_date", type="date")
     */
    private $paymentExpectedDate;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="last_payment_date", type="date")
     */
    private $lastPaymentDate;

    /**
     * @var string
     *
     * @ORM\Column(name="documents", type="string", length=255)
     */
    private $documents;

    /**
     * @var integer
     *
     * @ORM\Column(name="exchange_rate", type="integer")
     */
    private $exchangeRate;

    /**
     * Get owner
     *
     * @return User
     */
    public function getOwner()
    {
        return $this->owner;
    }

    /**
     * Get organization
     *
     * @return Organization
     */
    public function getOrganization()
    {
        return $this->organization;
    }

    /**
     * Set organization
     *
     * @param Organization $organization
     * @return Call
     */
    public function setOrganization(Organization $organization = null)
    {
        $this->organization = $organization;

        return $this;
    }

    /**
     * Set owner
     *
     * @param User $owner
     * @return Call
     */
    public function setOwner($owner)
    {
        $this->owner = $owner;

        return $this;
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
     * Set invoiceId
     *
     * @param string $invoiceId
     * @return Invoicing
     */
    public function setInvoiceId($invoiceId)
    {
        $this->invoiceId = $invoiceId;

        return $this;
    }

    /**
     * Get invoiceId
     *
     * @return string
     */
    public function getInvoiceId()
    {
        return $this->invoiceId;
    }

    /**
     * Set customerName
     *
     * @param string $customerName
     * @return Invoicing
     */
    public function setCustomerName($customerName)
    {
        $this->customerName = $customerName;

        return $this;
    }

    /**
     * Get customerName
     *
     * @return string
     */
    public function getCustomerName()
    {
        return $this->customerName;
    }

    /**
     * Set customerId
     *
     * @param string $customerId
     * @return Invoicing
     */
    public function setCustomerId($customerId)
    {
        $this->customerId = $customerId;

        return $this;
    }

    /**
     * Get customerId
     *
     * @return string
     */
    public function getCustomerId()
    {
        return $this->customerId;
    }

    /**
     * Set status
     *
     * @param string $status
     * @return Invoicing
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
     * Set invoiceNumber
     *
     * @param string $invoiceNumber
     * @return Invoicing
     */
    public function setInvoiceNumber($invoiceNumber)
    {
        $this->invoiceNumber = $invoiceNumber;

        return $this;
    }

    /**
     * Get invoiceNumber
     *
     * @return string
     */
    public function getInvoiceNumber()
    {
        return $this->invoiceNumber;
    }

    /**
     * Set referenceNumber
     *
     * @param string $referenceNumber
     * @return Invoicing
     */
    public function setReferenceNumber($referenceNumber)
    {
        $this->referenceNumber = $referenceNumber;

        return $this;
    }

    /**
     * Get referenceNumber
     *
     * @return string
     */
    public function getReferenceNumber()
    {
        return $this->referenceNumber;
    }

    /**
     * Set date
     *
     * @param \DateTime $date
     * @return Invoicing
     */
    public function setDate($date)
    {
        $this->date = $date;

        return $this;
    }

    /**
     * Get date
     *
     * @return \DateTime
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * Set dueDate
     *
     * @param \DateTime $dueDate
     * @return Invoicing
     */
    public function setDueDate($dueDate)
    {
        $this->dueDate = $dueDate;

        return $this;
    }

    /**
     * Get dueDate
     *
     * @return \DateTime
     */
    public function getDueDate()
    {
        return $this->dueDate;
    }

    /**
     * Set currencyId
     *
     * @param integer $currencyId
     * @return Invoicing
     */
    public function setCurrencyId($currencyId)
    {
        $this->currencyId = $currencyId;

        return $this;
    }

    /**
     * Get currencyId
     *
     * @return integer
     */
    public function getCurrencyId()
    {
        return $this->currencyId;
    }

    /**
     * Set currencyCode
     *
     * @param string $currencyCode
     * @return Invoicing
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
     * Set total
     *
     * @param float $total
     * @return Invoicing
     */
    public function setTotal($total)
    {
        $this->total = $total;

        return $this;
    }

    /**
     * Get total
     *
     * @return float
     */
    public function getTotal()
    {
        return $this->total;
    }

    /**
     * Set ballance
     *
     * @param float $ballance
     * @return Invoicing
     */
    public function setBallance($ballance)
    {
        $this->ballance = $ballance;

        return $this;
    }

    /**
     * Get ballance
     *
     * @return float
     */
    public function getBallance()
    {
        return $this->ballance;
    }

    /**
     * Set createdTime
     *
     * @param \DateTime $createdTime
     * @return Invoicing
     */
    public function setCreatedTime($createdTime)
    {
        $this->createdTime = $createdTime;

        return $this;
    }

    /**
     * Get createdTime
     *
     * @return \DateTime
     */
    public function getCreatedTime()
    {
        return $this->createdTime;
    }

    /**
     * Set lastModifiedTime
     *
     * @param \DateTime $lastModifiedTime
     * @return Invoicing
     */
    public function setLastModifiedTime($lastModifiedTime)
    {
        $this->lastModifiedTime = $lastModifiedTime;

        return $this;
    }

    /**
     * Get lastModifiedTime
     *
     * @return \DateTime
     */
    public function getLastModifiedTime()
    {
        return $this->lastModifiedTime;
    }

    /**
     * Set isEmailed
     *
     * @param boolean $isEmailed
     * @return Invoicing
     */
    public function setIsEmailed($isEmailed)
    {
        $this->isEmailed = $isEmailed;

        return $this;
    }

    /**
     * Get isEmailed
     *
     * @return boolean
     */
    public function getIsEmailed()
    {
        return $this->isEmailed;
    }

    /**
     * Set remindersSent
     *
     * @param integer $remindersSent
     * @return Invoicing
     */
    public function setRemindersSent($remindersSent)
    {
        $this->remindersSent = $remindersSent;

        return $this;
    }

    /**
     * Get remindersSent
     *
     * @return integer
     */
    public function getRemindersSent()
    {
        return $this->remindersSent;
    }

    /**
     * Set lastReminderSentDate
     *
     * @param \DateTime $lastReminderSentDate
     * @return Invoicing
     */
    public function setLastReminderSentDate($lastReminderSentDate)
    {
        $this->lastReminderSentDate = $lastReminderSentDate;

        return $this;
    }

    /**
     * Get lastReminderSentDate
     *
     * @return \DateTime
     */
    public function getLastReminderSentDate()
    {
        return $this->lastReminderSentDate;
    }

    /**
     * Set paymentExpectedDate
     *
     * @param \DateTime $paymentExpectedDate
     * @return Invoicing
     */
    public function setPaymentExpectedDate($paymentExpectedDate)
    {
        $this->paymentExpectedDate = $paymentExpectedDate;

        return $this;
    }

    /**
     * Get paymentExpectedDate
     *
     * @return \DateTime
     */
    public function getPaymentExpectedDate()
    {
        return $this->paymentExpectedDate;
    }

    /**
     * Set lastPaymentDate
     *
     * @param \DateTime $lastPaymentDate
     * @return Invoicing
     */
    public function setLastPaymentDate($lastPaymentDate)
    {
        $this->lastPaymentDate = $lastPaymentDate;

        return $this;
    }

    /**
     * Get lastPaymentDate
     *
     * @return \DateTime
     */
    public function getLastPaymentDate()
    {
        return $this->lastPaymentDate;
    }

    /**
     * Set documents
     *
     * @param string $documents
     * @return Invoicing
     */
    public function setDocuments($documents)
    {
        $this->documents = $documents;

        return $this;
    }

    /**
     * Get documents
     *
     * @return string
     */
    public function getDocuments()
    {
        return $this->documents;
    }

    /**
     * Set exchangeRate
     *
     * @param integer $exchangeRate
     * @return Invoicing
     */
    public function setExchangeRate($exchangeRate)
    {
        $this->exchangeRate = $exchangeRate;

        return $this;
    }

    /**
     * Get exchangeRate
     *
     * @return integer
     */
    public function getExchangeRate()
    {
        return $this->exchangeRate;
    }
        /**
     *
     * @return string
     */
    public function getChannelName() {
        return 'invoice_channel';
    }
}
