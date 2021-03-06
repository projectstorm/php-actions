<?php namespace storm\actions;
/**
 * @author Dylan Vorster
 */
class ClassCheckNodeFactory extends ValidationNodeFactory{
	
	public function __construct() {
		parent::__construct("CORE\\type", ClassCheckNode::class);
	}
	
	public function generate() {
		return new ClassCheckNode(ValidationNode::class);
	}

}