<?php

namespace Markrefaat\LivewireModal;

class LivewireModalField
{
    private $class;
    private $label;
    private $type;
    private $varName;
    private $required = false;
    private $disabled = false;
    private $optionName;
    private $optionValue;
    private $optionMulti;
    private $options;
    private $placeholder;
    private $defer = true;

    public function __construct(string $type)
    {
        $this->type = $type;
    }
    // SETTERS
    public static function type(string $type): LivewireModalField
    {
        return new static ($type);
    }
    public function label($label): self
    {
        $this->label = $label;
        return $this;
    }
    public function varName($varName): self
    {
        $this->varName = $varName;
        return $this;
    }
    public function required($required): self
    {
        $this->required = $required;
        return $this;
    }
    public function disabled($disabled): self
    {
        $this->disabled = $disabled;
        return $this;
    }
    public function optionName($optionName): self
    {
        $this->optionName = $optionName;
        return $this;
    }
    public function optionValue($optionValue): self
    {
        $this->optionValue = $optionValue;
        return $this;
    }
    public function options($options): self
    {
        $this->options = $options;
        return $this;
    }
    public function placeholder($placeholder): self
    {
        $this->placeholder = $placeholder;
        return $this;
    }
    public function class ($class): self
    {
        $this->class = $class;
        return $this;
    }
    public function defer($defer): self
    {
        $this->defer = $defer;
        return $this;
    }
    public function optionMulti($optionMulti): self
    {
        $this->optionMulti = $optionMulti;
        return $this;
    }

    // GETTERS
    public function getType()
    {
        return $this->type;
    }
    public function getLabel()
    {
        return $this->label;
    }
    public function getVarName()
    {
        return $this->varName;
    }
    public function getRequired()
    {
        return $this->required;
    }
    public function getDisabled()
    {
        return $this->disabled;
    }
    public function getOptionName()
    {
        return $this->optionName;
    }
    public function getOptionValue()
    {
        return $this->optionValue;
    }
    public function getOptions()
    {
        return $this->options;
    }
    public function getPlaceholder()
    {
        return $this->placeholder;
    }
    public function getClass()
    {
        return $this->class;
    }
    public function getDefer()
    {
        return $this->defer;
    }
    public function getOptionMulti()
    {
        return $this->optionMulti;
    }
}
