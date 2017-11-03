<?php

namespace Demo\AffiliateMembers\Model;

use Demo\AffiliateMembers\Api\Data\AffiliatemembersInterface;

class Affiliatemembers extends \Magento\Framework\Model\AbstractModel implements AffiliatemembersInterface
{

    /**
     * Construct.
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init('Demo\AffiliateMembers\Model\ResourceModel\Affiliatemembers');
    }

    /**
     * Return affiliate member id.
     *
     * @return string
     */
    public function getAffiliateMemberId()
    {
        return $this->getData(self::ID);
    }

    /**
     * Set affiliate member id.
     *
     * @param string $id Affiliate member id.
     *
     * @return void
     */
    public function setAffiliateMemberId($id)
    {
        $this->setData(self::ID, $id);
    }

    /**
     * Get affiliate member name.
     *
     * @return string
     */
    public function getName()
    {
        return $this->getData(self::NAME);
    }

    /**
     * Set affiliate member name.
     *
     * @param string $name
     *
     * @return void
     */

    public function setName($name)
    {
        $this->setData(self::NAME, $name);
    }

    /**
     * Get affiliate member status.
     *
     * @return string
     */
    public function getStatus()
    {
        return $this->getData(self::STATUS);
    }

    /**
     * Set affiliate member status.
     *
     * @param string $status
     *
     * @return void
     */
    public function setStatus($status)
    {
        $this->setData(self::STATUS, $status);
    }

    /**
     * Get profile image.
     *
     * @return string
     */
    public function getProfileImage()
    {
        return $this->getData(self::PROFILE_IMAGE);
    }

    /**
     * Set profile image.
     *
     * @param string $profileImage
     *
     * @return void
     */
    public function setProfileImage($profileImage)
    {
        $this->setData(self::PROFILE_IMAGE, $profileImage);
    }

    /**
     * Get created date.
     *
     * @return string|null
     */
    public function getCreated()
    {
        return $this->getData(self::CREATED);
    }

    /**
     * Set created date.
     *
     * @param string $createdDate
     *
     * @return void
     */
    public function setCreated($createdDate)
    {
        $this->setData(self::CREATED, $createdDate);
    }

    /**
     * Get modified date.
     *
     * @return string|null
     */

    public function getModified()
    {
        return $this->getData(self::MODIFIED);
    }

    /**
     * Set modified date.
     *
     * @param string $modifiedDate
     *
     * @return void
     */
    public function setModified($modifiedDate)
    {
        $this->setData(self::MODIFIED, $modifiedDate);
    }
}