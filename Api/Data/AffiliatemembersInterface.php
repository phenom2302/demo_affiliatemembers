<?php

namespace Demo\AffiliateMembers\Api\Data;

interface AffiliatemembersInterface
{
    /**
     * Field names.
     */
    const ID = 'affiliatemember_id';
    const NAME = 'name';
    const STATUS = 'status';
    const CREATED = 'created';
    const MODIFIED = 'modified';
    const PROFILE_IMAGE = 'profile_image';

    /**
     * Return affiliate member id.
     *
     * @return string
     */
    public function getAffiliateMemberId();

    /**
     * Set affiliate member id.
     *
     * @param string $id Affiliate member id.
     *
     * @return void
     */
    public function setAffiliateMemberId($id);

    /**
     * Get affiliate member name.
     *
     * @return string
     */
    public function getName();

    /**
     * Set affiliate member name.
     *
     * @param string $name
     *
     * @return void
     */

    public function setName($name);

    /**
     * Get affiliate member status.
     *
     * @return string
     */
    public function getStatus();

    /**
     * Set affiliate member status.
     *
     * @param string $status
     *
     * @return void
     */
    public function setStatus($status);

    /**
     * Get profile image.
     *
     * @return string
     */
    public function getProfileImage();

    /**
     * Set profile image.
     *
     * @param string $profileImage
     *
     * @return void
     */
    public function setProfileImage($profileImage);

    /**
     * Get created date.
     *
     * @return string|null
     */
    public function getCreated();

    /**
     * Set created date.
     *
     * @param string $createdDate
     *
     * @return void
     */
    public function setCreated($createdDate);

    /**
     * Get modified date.
     *
     * @return string|null
     */

    public function getModified();

    /**
     * Set modified date.
     *
     * @param string $modifiedDate
     *
     * @return void
     */
    public function setModified($modifiedDate);
}