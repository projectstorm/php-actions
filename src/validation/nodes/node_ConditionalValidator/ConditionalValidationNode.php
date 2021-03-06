<?php namespace storm\actions;
/**
 * A conditional validation node runs simple logical expressions
 * on a provided value as well as the input value
 * 
 * @author Dylan Vorster
 */
class ConditionalValidationNode extends ValidationNode{
	
	protected $type;
	protected $value;
	
	const TYPE_EQUALS = '=';
	const TYPE_GREATER_THAN_EQUALS = '>=';
	const TYPE_LESS_THAN_EQUALS = '<=';
	const TYPE_GREATER_THAN = '>';
	const TYPE_LESS_THAN = '<';
	
	/**
	 * 
	 * @param type $type Must be one of the TYPE_ constants provided in this class
	 * @param type $value
	 * @throws ValidationException
	 */
	public function __construct($type,$value) {
		parent::__construct();
		if(array_search($type, ['=','>=','<=','>','<']) === false){
			throw new ValidationException("Incorrect type flag passed into conditional validation node with type: {$type}");
		}
		$this->type = $type;
		$this->value = $value;
	}
	
	public function match($value) {
		switch ($this->type){
			case self::TYPE_EQUALS:
				if(!($value == $this->value)){
					throw new ValidationException("value does not match {$this->value}");
				}
				return true;
			case self::TYPE_GREATER_THAN:
				if(!($value > $this->value)){
					throw new ValidationException("value was not greater than {$this->value}");
				}
				return true;
			case self::TYPE_GREATER_THAN_EQUALS:
				if(!($value >= $this->value )){
					throw new ValidationException("values was not greater than or equal to {$this->value}");
				}
				return true;
			case self::TYPE_LESS_THAN:
				if(!($value < $this->value)){
					throw new ValidationException("value was not less than {$this->value}");
				}
				return true;
			case self::TYPE_LESS_THAN_EQUALS:
				if(!($value <= $this->value)){
					throw new ValidationException("values was noy less than or equal to {$this->value}");
				}
				return true;
		}
		throw new ValidationException("Unknown Conditional Type: [{$this->type}]");
	}
	
	public function deserialize($data) {
		parent::deserialize($data);
		$this->type = $data['operator'];
		$this->value = $data['value'];
	}
	
	public function serialize() {
		$response = parent::serialize();
		$response['operator'] = $this->type;
		$response['value'] = $this->value;
		return $response;
	}

}