<?php

class UnhlsSpecimen extends Eloquent
{
	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'specimens';

	public $timestamps = false;

	/**
	 * Specimen status constants
	 */
	const NOT_COLLECTED = 1;
	const ACCEPTED = 2;
	const REJECTED = 3;
	const REFERRED = 4;
	/**
	 * Enabling soft deletes for specimen details.
	 *
	 * @var boolean
	 */
	// protected $softDelete = true;//it wants deleted at fills,

	/**
	 * Test Phase relationship
	 */
	public function testPhase()
	{
		return $this->belongsTo('TestPhase');
	}
	
	/**
	 * Specimen Status relationship
	 */
	public function specimenStatus()
	{
		return $this->belongsTo('SpecimenStatus');
	}
	
	/**
	 * Specimen Type relationship
	 */
	public function specimenType()
	{
		return $this->belongsTo('SpecimenType');
	}

	/**
	 * Rejected specimen relationship
	 */
	public function rejectedSpecimen()
	{
		return $this->belongsTo('PreAnalyticSpecimenRejection', 'specimen_id');
	}

	/**
	 * Test relationship
	 */
	public function test()
    {
        return $this->hasOne('UnhlsTest', 'specimen_id');
    }

    /**
	 * referrals relationship
	 */
	public function referral()
    {
        return $this->belongsTo('Referral');
    }
    
    /**
	 * User (accepted) relationship
	 */
	public function acceptedBy()
	{
		return $this->belongsTo('User', 'accepted_by', 'id');
	}

    /**
	 * Check if specimen is referred
	 *
	 * @return boolean
	 */
    public function isReferred()
    {
    	if(is_null($this->referral))
    	{
    		return false;
    	}
    	else {
    		return true;
    	}
    }

    /**
    * Check if specimen is NOT_COLLECTED
    *
    * @return boolean
    */
    public function isNotCollected()
    {
        if($this->specimen_status_id == UnhlsSpecimen::NOT_COLLECTED)
        {
            return true;
        }
        else {
            return false;
        }
    }
    
    /**
    * Check if specimen is ACCEPTED
    *
    * @return boolean
    */
    public function isAccepted()
    {
        if($this->specimen_status_id == UnhlsSpecimen::ACCEPTED)
        {
            return true;
        }
        else {
            return false;
        }
    }
    
    /**
    * Check if specimen is rejected
    *
    * @return boolean
    */
    public function isRejected()
    {
        if($this->specimen_status_id == UnhlsSpecimen::REJECTED)
        {
            return true;
        }
        else {
            return false;
        }
    }

}